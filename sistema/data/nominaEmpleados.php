<?php
session_start();
include("../../conexion.php");

// Validar conexión
if (!$conection) {
    die(json_encode(['error' => 'Error de conexión a la base de datos.']));
}
// var_dump($_POST);
if(isset($_POST['semana']) && isset($_POST['anio']) && !empty($_POST['semana']) && !empty($_POST['anio'])) {
    $sql = "TRUNCATE nomina_temp_2025";
    $result = mysqli_query($conection, $sql);
    $semana = $_POST['semana'];
    $anio = $_POST['anio'];
    //Vaciar tabla de nomina
    if (!$result) {
        die(json_encode(['error' => 'Error al truncar la tabla: ' . mysqli_error($conection)])); 
    }
} else {
    $semana = date('W');
    $anio = date('Y');
}

// Calcular fechas para la semana
$fecha = new DateTime();
$fecha->setISODate($anio, $semana);
$fecha_inicio = $fecha->format('Y-m-d');
$fecha_fin = $fecha->modify('+6 days')->format('Y-m-d');

// Consulta principal con JOIN 
$sql_empleados = "SELECT
e.id,
e.noempleado,
e.sueldo_base,
CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS operador, 
e.cargo, 
IF(e.imss = 'ASEGURADO', 1, 0) AS imss, 
e.estatus, 
(e.bono_semanal + e.bono_categoria + e.bono_supervisor) AS bonos, 
e.prima_vacacional, 
e.caja_ahorro, 
e.supervisor,
(
    SELECT COALESCE(SUM(rv.valor_vuelta), 0)
    FROM registro_viajes rv
    WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) 
      AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
) AS total_vueltas,
(
    SELECT COALESCE(SUM(rv.sueldo_vuelta), 0)
    FROM registro_viajes rv
    WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) 
      AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
) AS sueldo_bruto,
(
    SELECT rv.unidad
    FROM registro_viajes rv
    WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
    LIMIT 1 
) AS unidad,
(
    SELECT rv.num_unidad
    FROM registro_viajes rv
    WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
    LIMIT 1
) AS num_unidad,
(
    SELECT COALESCE(SUM(a.descuento), 0)
    FROM adeudos a
    WHERE a.noempleado = e.noempleado
) AS deducciones
FROM empleados e
WHERE e.estatus = 1 AND e.cargo = 'OPERADOR'";
$result_empleados = mysqli_query($conection, $sql_empleados);
if (!$result_empleados) {
    die(json_encode(['error' => 'Error en la consulta de empleados: ' . mysqli_error($conection)]));
}

$resultado_cuenta_tabla_nomina = mysqli_query($conection, "SELECT COUNT(*) FROM nomina_temp_2025");
if (!$resultado_cuenta_tabla_nomina) {
    die(json_encode(['error' => 'Error al contar registros en nomina_temp_2025: ' . mysqli_error($conection)]));
}

$row_nomina = mysqli_fetch_row($resultado_cuenta_tabla_nomina);
if($row_nomina[0] == 0) {
    $data = [];
    while ($row_empleados = mysqli_fetch_assoc($result_empleados)) {
        // var_dump($row_empleados);
        // exit;
        $nosemana = ($semana . '/' . $anio);
        $noempleado = intval($row_empleados['noempleado']);
        $nombre = $row_empleados['operador'];
        $no_unidad = $row_empleados['num_unidad'];
        $tipo_unidad = $row_empleados['unidad'];
        $total_vueltas = $row_empleados['total_vueltas'];
        $cargo = $row_empleados['cargo'];
        $imss = intval($row_empleados['imss']);
        $sueldo_bruto = floatval((floatval($row_empleados['sueldo_base']) * floatval($row_empleados['total_vueltas'])));
        $bonos = floatval($row_empleados['bonos']);
        $deducciones = floatval($row_empleados['deducciones']);
        $caja_ahorro = floatval($row_empleados['caja_ahorro']);
        $supervisor = $row_empleados['supervisor'];
        $sueldo_base = $row_empleados['sueldo_base'];


        // Preparar datos para inserción (usar consultas preparadas)
        $stmt = mysqli_prepare($conection, "
            INSERT INTO nomina_temp_2025 (
                semana, noempleado, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto,
                bonos, deducciones, caja_ahorro,
                supervisor
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ");
        mysqli_stmt_bind_param($stmt, "sissssidddddds", 
            $nosemana, $noempleado, $nombre, $no_unidad, $tipo_unidad, $cargo, $imss, $sueldo_base, $total_vueltas, $sueldo_bruto,
            $bonos, $deducciones, $caja_ahorro, $supervisor
        );
        
        if (!mysqli_stmt_execute($stmt)) {
            die(json_encode(['error' => 'Error al insertar datos en nomina_temp_2025: ' . mysqli_error($conection)]));
        }
    }
}
    // $stmt = mysqli_prepare($conection, "SELECT pago_fiscal, deduccion_fiscal, neto FROM importes_fiscales WHERE noempleado = ?");
    // mysqli_stmt_bind_param($stmt, "s", $row['noempleado']);
    // mysqli_stmt_execute($stmt);
    // $result_fiscal = mysqli_stmt_get_result($stmt);
    // $row_fiscal = mysqli_fetch_assoc($result_fiscal);

        // Obtener datos fiscales (usar consultas preparadas)
        

//         $pago_fiscal = $row_fiscal['pago_fiscal'] ?? 0;
//         $deduccion_fiscal = $row_fiscal['deduccion_fiscal'] ?? 0;
//         $neto = $row_fiscal['neto'] ?? 0;
//         $efectivo = $sueldo_bruto - $pago_fiscal;

//     }
// }
$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$searchValue = $_POST['search']['value'] ?? '';
$orderColumn = intval($_POST['order'][0]['column']); // Convertir a entero
$orderDir = $_POST['order'][0]['dir'];
$whereClause = "WHERE cargo = 'OPERADOR'";
if (!empty($searchValue)) {
    $whereClause .= " AND (noempleado LIKE '%$searchValue%' OR nombre LIKE '%$searchValue%')";
}

$columns = array('semana', 'noempleado', 'nombre', 'cargo', 'imss', 'sueldo_base', 'supervisor', 'sueldo_bruto', 'nomina_fiscal', 'bonos', 'deposito', 'efectivo', 'deducciones','deduccion_fiscal', 'caja_ahorro', 'supervisor', 'neto');

// Recuperar datos finales
$sql_nomina = "SELECT semana,
                    noempleado, 
                    nombre,
                    no_unidad,
                    tipo_unidad,
                    cargo,
                    imss,
                    sueldo_base,
                    total_vueltas,
                    sueldo_bruto,
                    nomina_fiscal,
                    bonos,
                    deposito_fiscal,
                    efectivo,
                    deducciones,
                    caja_ahorro,
                    supervisor,
                    deduccion_fiscal,
                    neto
                FROM nomina_temp_2025 $whereClause 
                GROUP BY semana, noempleado,
                nombre,
                    no_unidad,
                    tipo_unidad,
                    cargo,
                    imss,
                    sueldo_base,
                    total_vueltas,
                    sueldo_bruto,
                    nomina_fiscal,
                    bonos,
                    deposito_fiscal,
                    efectivo,
                    deducciones,
                    caja_ahorro,
                    supervisor,
                    deduccion_fiscal,
                    neto
                ORDER BY $columns[$orderColumn] $orderDir"; 

$result_nomina = mysqli_query($conection, $sql_nomina);
if (!$result_nomina) {
    die(json_encode(['error' => 'Error en la consulta final: ' . mysqli_error($conection)]));
}

// Obtener el total de registros (sin LIMIT)
$totalRecords = mysqli_num_rows($result_nomina);

// Aplicar LIMIT para la paginación
$sql_nomina .= " LIMIT $start, $length";
$result_nomina = mysqli_query($conection, $sql_nomina); 

while ($row_nomina = mysqli_fetch_assoc($result_nomina)) {
    // echo $row_nomina['neto'];
    $row_nomina['semana'] = $semana;
    $row_nomina['anio'] = $anio;
    $data[] = $row_nomina;
}
// var_dump($data);
// Cerrar conexión y devolver datos
mysqli_close($conection);
echo json_encode(['data' => $data, 
                 'totalRecords' => $totalRecords,
                 'totalFiltered' => $totalRecords], JSON_PRETTY_PRINT);
?>