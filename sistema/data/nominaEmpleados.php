<?php
session_start();
include("../../conexion.php");

// Validar conexión
if (!$conection) {
    die(json_encode(['error' => 'Error de conexión a la base de datos.']));
}
// var_dump($_POST);
$sql = "TRUNCATE nomina_temp_2025"; //Vacia la tabla de nomina temporal
$result = mysqli_query($conection, $sql);
if (!$result) {
    die(json_encode(['error' => 'Error al truncar la tabla: ' . mysqli_error($conection)])); 
}

if(isset($_POST['semana']) && isset($_POST['anio']) && !empty($_POST['semana']) && !empty($_POST['anio'])) {
    $semana = $_POST['semana'];
    $nombre_semana = 'Semana ' . $semana;
    $anio = $_POST['anio'];
    //Vaciar tabla de nomina
    $sql = "TRUNCATE nomina_temp_2025"; //Vacia la tabla de nomina temporal
    $result = mysqli_query($conection, $sql);
    if (!$result) {
        die(json_encode(['error' => 'Error al truncar la tabla: ' . mysqli_error($conection)])); 
    }
} else {
    $semana = date('W');
    $anio = date('Y');
    $nombre_semana = 'Semana ' . $semana;
}

// Calcular fechas para la semana
$fecha = new DateTime();
$fecha->setISODate($anio, $semana);
$fecha_inicio = $fecha->format('Y-m-d');
$fecha_fin = $fecha->modify('+6 days')->format('Y-m-d');

$sql_datos_nomina_fiscal = "SELECT COUNT(*) FROM importes_fiscales";
$result_datos_nomina_fiscal = mysqli_query($conection, $sql_datos_nomina_fiscal);
if (!$result_datos_nomina_fiscal) {
    die(json_encode(['error' => 'Error al contar registros en importes_fiscales: ' . mysqli_error($conection)]));
}

$row_datos_nomina_fiscal = mysqli_fetch_row($result_datos_nomina_fiscal);
$sql_empleados = "";
if($row_datos_nomina_fiscal[0] == 0) {
    
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
        SELECT COALESCE(SUM(al.noalertas), 0)
        FROM alertas al
        WHERE al.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
        AND al.semana = '$nombre_semana'
    ) AS noalertas,
    (
        SELECT COUNT(inc.valor)
        FROM incidencias inc
        WHERE inc.empleado = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
        AND inc.nodesemana = '$nombre_semana'
    ) AS faltas,
    (
        SELECT COALESCE(SUM(rv.valor_vuelta * rv.sueldo_vuelta), 0)
        FROM registro_viajes rv
        WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
        AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
    ) AS sueldo_bruto,
    (
        SELECT COALESCE(SUM(rv.valor_vuelta), 0)
        FROM registro_viajes rv
        WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) 
        AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
    ) AS total_vueltas,
    -- (
    --     SELECT COALESCE(SUM(rv.sueldo_vuelta), 0)
    --     FROM registro_viajes rv
    --     WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) 
    --     AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
    -- ) AS sueldo_bruto,
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
        SELECT COALESCE(SUM(IF(
            a.cantidad - (TIMESTAMPDIFF(WEEK, a.fecha_inicial, CURDATE()) * a.descuento) < a.descuento,
            a.cantidad - (TIMESTAMPDIFF(WEEK, a.fecha_inicial, CURDATE()) * a.descuento),
            a.descuento
            )), 0)
        FROM adeudos a
        WHERE a.noempleado = e.noempleado
    ) AS deducciones
    FROM empleados e
    WHERE e.estatus = 1 AND e.cargo = 'OPERADOR' OR e.cargo = 'SUPERVISOR'";
}else {
    $sql_empleados = "SELECT
    e.id,
    e.noempleado,
    e.sueldo_base,
    CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS operador, 
    e.cargo, 
    IF(e.imss = 'ASEGURADO', 1, 0) AS imss, 
    e.estatus, 
    (e.bono_categoria + e.bono_supervisor) AS bonos,
    e.bono_semanal,
    e.prima_vacacional, 
    e.caja_ahorro, 
    e.supervisor,
    (
        SELECT COALESCE(SUM(al.noalertas), 0)
        FROM alertas al
        WHERE al.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
        AND al.semana = '$nombre_semana'

    ) AS noalertas,
    (
        SELECT COUNT(inc.valor)
        FROM incidencias inc
        WHERE inc.empleado = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
        AND inc.nodesemana = '$nombre_semana'
    ) AS faltas,
    (
        SELECT COALESCE(SUM(rv.valor_vuelta * rv.sueldo_vuelta), 0)
        FROM registro_viajes rv
        WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
        AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
    ) AS sueldo_bruto,
    (
        SELECT COALESCE(SUM(rv.valor_vuelta), 0)
        FROM registro_viajes rv
        WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) 
        AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
    ) AS total_vueltas,
    -- (
    --     SELECT COALESCE(SUM(rv.sueldo_vuelta), 0)
    --     FROM registro_viajes rv
    --     WHERE rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) 
    --     AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND valor_vuelta > 0
    -- ) AS sueldo_bruto,
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
        SELECT fi.pago_fiscal 
        FROM importes_fiscales fi
        WHERE fi.noempleado = e.noempleado
    ) AS pago_fiscal,
    (
        SELECT fi.deduccion_fiscal 
        FROM importes_fiscales fi
        WHERE fi.noempleado = e.noempleado
    ) AS deduccion_fiscal, 
    (
        SELECT COALESCE(SUM(IF(
            a.cantidad - (TIMESTAMPDIFF(WEEK, a.fecha_inicial, CURDATE()) * a.descuento) < a.descuento,
            a.cantidad - (TIMESTAMPDIFF(WEEK, a.fecha_inicial, CURDATE()) * a.descuento),
            a.descuento
            )), 0)
        FROM adeudos a
        WHERE a.noempleado = e.noempleado
    ) AS deducciones
    FROM empleados e
    WHERE e.estatus = 1 AND e.cargo = 'OPERADOR' OR e.cargo = 'SUPERVISOR'";
}
$result_empleados = mysqli_query($conection, $sql_empleados);
// var_dump($result_empleados);
if (!$result_empleados) {
    die(json_encode(['error' => 'Error en la consulta de empleados: ' . mysqli_error($conection)]));
}

$resultado_cuenta_tabla_nomina = mysqli_query($conection, "SELECT COUNT(*) FROM nomina_temp_2025");
if (!$resultado_cuenta_tabla_nomina) {
    die(json_encode(['error' => 'Error al contar registros en nomina_temp_2025: ' . mysqli_error($conection)]));
}

$row_nomina = mysqli_fetch_row($resultado_cuenta_tabla_nomina);
    $data = [];
    while ($row_empleados = mysqli_fetch_assoc($result_empleados)) {
        // var_dump($row_empleados);
        // exit;
        $nosemana = ($semana . '/' . $anio);
        $alertas = intval($row_empleados['noalertas']);
        $bono_semanal = ($alertas < 5) ? floatval($row_empleados['bono_semanal']) : 0;
        $noempleado = intval($row_empleados['noempleado']);
        $nombre = $row_empleados['operador'];
        $no_unidad = $row_empleados['num_unidad'];
        $tipo_unidad = $row_empleados['unidad'];
        $total_vueltas = $row_empleados['total_vueltas'];
        $cargo = $row_empleados['cargo'];
        $imss = intval($row_empleados['imss']);
        $sueldo_bruto = ($row_empleados['cargo'] === 'OPERADOR') ? floatval($row_empleados['sueldo_bruto'] - ($row_empleados['faltas'] * $row_empleados['sueldo_base'])) : ((floatval($row_empleados['sueldo_base'] * 7) - ($row_empleados['faltas'] * $row_empleados['sueldo_base'])));
        // $nomina_fiscal = floatval($row_empleados['sueldo_bruto']);
        $bonos = floatval($row_empleados['bonos']) + $bono_semanal;
        $deducciones = floatval($row_empleados['deducciones']);
        $caja_ahorro = floatval($row_empleados['caja_ahorro']);
        $supervisor = $row_empleados['supervisor'];
        $sueldo_base = $row_empleados['sueldo_base'];
        $pago_fiscal = $row_empleados['pago_fiscal'] ?? 0;
        $deduccion_fiscal = $row_empleados['deduccion_fiscal'] ?? 0;
        $efectivo = $sueldo_bruto - $pago_fiscal;

        // Preparar datos para inserción (usar consultas preparadas)
        $stmt = mysqli_prepare($conection, "INSERT INTO nomina_temp_2025 (
                semana, noempleado, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto,
                bonos, deducciones, caja_ahorro,
                supervisor, nomina_fiscal, efectivo, deduccion_fiscal
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ");
        mysqli_stmt_bind_param($stmt, "sissssiddddddsddd", 
            $nosemana, $noempleado, $nombre, $no_unidad, $tipo_unidad, $cargo, $imss, $sueldo_base, $total_vueltas, $sueldo_bruto,
            $bonos, $deducciones, $caja_ahorro, $supervisor, $pago_fiscal, $efectivo, $deduccion_fiscal
        );
        
        if (!mysqli_stmt_execute($stmt)) {
            die(json_encode(['error' => 'Error al insertar datos en nomina_temp_2025: ' . mysqli_error($conection)]));
        }
    }


$sql_empleados_no_operador = "SELECT 
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
                                    SELECT COUNT(inc.valor)
                                    FROM incidencias inc
                                    WHERE inc.empleado = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
                                    AND inc.nodesemana = '$nombre_semana'
                                ) AS faltas,
                                (
                                    SELECT fi.pago_fiscal
                                    FROM importes_fiscales fi
                                    WHERE fi.noempleado = e.noempleado
                                ) AS pago_fiscal,
                                (
                                    SELECT fi.deduccion_fiscal
                                    FROM importes_fiscales fi
                                    WHERE fi.noempleado = e.noempleado
                                )AS deduccion_fiscal,
                                (
                                    SELECT COALESCE(SUM(a.descuento), 0)
                                    FROM adeudos a
                                    WHERE a.noempleado = e.id
                                ) AS deducciones
                                FROM empleados e
                                WHERE e.estatus = 1 AND e.cargo <> 'OPERADOR' AND e.cargo <> 'SUPERVISOR' AND e.sueldo_base > 0";
                                // echo $sql_empleados_no_operador;
$result_empleados_no_operador = mysqli_query($conection, $sql_empleados_no_operador);
if (!$result_empleados_no_operador) {
    die(json_encode(['error' => 'Error en la consulta de empleados: ' . mysqli_error($conection)]));
}

while ($row_empleados_no_operador = mysqli_fetch_assoc($result_empleados_no_operador)) {
    // var_dump($row_empleados_no_operador);
    // exit;
    $nosemana = ($semana . '/' . $anio);
    $noempleado = intval($row_empleados_no_operador['noempleado']);
    $nombre = $row_empleados_no_operador['operador'];
    $cargo = $row_empleados_no_operador['cargo'];
    $imss = intval($row_empleados_no_operador['imss']);
    $sueldo_bruto = ((floatval($row_empleados_no_operador['sueldo_base']) ?? 0) * 7);
    // $nomina_fiscal = floatval($row_empleados_no_operador['sueldo_bruto']);
    $bonos = floatval($row_empleados_no_operador['bonos']);
    $deducciones = floatval($row_empleados_no_operador['deducciones']) + floatval($row_empleados_no_operador['deduccion_fiscal']);
    $caja_ahorro = floatval($row_empleados_no_operador['caja_ahorro']);
    $supervisor = $row_empleados_no_operador['supervisor'];
    $pago_fiscal = $row_empleados_no_operador['pago_fiscal'] ?? 0;
    $deduccion_fiscal = $row_empleados_no_operador['deduccion_fiscal'] ?? 0;
    $efectivo = $sueldo_bruto - $pago_fiscal;
    $sueldo_base = $row_empleados_no_operador['sueldo_base'];

    // Preparar datos para inserción
    $stmt = mysqli_prepare($conection, "INSERT INTO nomina_temp_2025 (
            semana, noempleado, nombre, cargo, imss, sueldo_base, sueldo_bruto,
            bonos, deducciones, caja_ahorro,
            supervisor, nomina_fiscal, efectivo, deduccion_fiscal
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ");
    mysqli_stmt_bind_param($stmt, "sisssdddddsddd", 
        $nosemana, $noempleado, $nombre, $cargo, $imss, $sueldo_base, $sueldo_bruto,
        $bonos, $deducciones, $caja_ahorro, $supervisor, $pago_fiscal, $efectivo, $deduccion_fiscal
    );
    
    if (!mysqli_stmt_execute($stmt)) {
        die(json_encode(['error' => 'Error al insertar datos en nomina_temp_2025: ' . mysqli_error($conection)]));
    }
}

$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$searchValue = $_POST['search']['value'] ?? '';
$orderColumn = intval($_POST['order'][0]['column']); // Convertir a entero
$orderDir = $_POST['order'][0]['dir'];
$whereClause = "";
if (!empty($searchValue)) {
    $whereClause .= " WHERE (noempleado LIKE '%$searchValue%' OR nombre LIKE '%$searchValue%')";
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

// $result_nomina = mysqli_query($conection, $sql_nomina);
// if (!$result_nomina) {
//     die(json_encode(['error' => 'Error en la consulta final: ' . mysqli_error($conection)]));
// }

// Obtener el total de registros (sin LIMIT)
$sql_count_nomina = "SELECT COUNT(*) FROM nomina_temp_2025";
$result_count_total = mysqli_query($conection, $sql_count_nomina);
$totalRecords = mysqli_fetch_row($result_count_total)[0];

//Obtrener el total filtrado
$sql_total_filtered = "SELECT COUNT(*) FROM nomina_temp_2025 $whereClause";
$result_count_filtered = mysqli_query($conection, $sql_total_filtered);
$totalFiltered = mysqli_fetch_row($result_count_filtered)[0];

// Aplicar LIMIT para la paginación
$sql_nomina .= " LIMIT $start, $length";
$result_nomina = mysqli_query($conection, $sql_nomina); 

$sql_total_pagar = "SELECT SUM(sueldo_bruto + bonos - deducciones - deduccion_fiscal -caja_ahorro) AS total_nomina FROM nomina_temp_2025";
$result_total_pagar = mysqli_query($conection, $sql_total_pagar);
$total_nomina = mysqli_fetch_row($result_total_pagar)[0];

while ($row_nomina = mysqli_fetch_assoc($result_nomina)) {
    // echo $row_nomina['neto'];
    $row_nomina['semana'] = $semana;
    $row_nomina['anio'] = $anio;
    $data[] = $row_nomina;
}
// var_dump($data);
$draw = $_POST['draw'] ?? 1;
// Cerrar conexión y devolver datos
mysqli_close($conection);
echo json_encode([
                'draw' => $draw,
                'totalNomina' => $total_nomina,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalFiltered,
                'data' => $data],
                 JSON_PRETTY_PRINT);
?>