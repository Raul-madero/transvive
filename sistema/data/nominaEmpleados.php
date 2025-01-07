<?php
session_start();
include("../../conexion.php");

// Validar conexión
if (!$conection) {
    die(json_encode(['error' => 'Error de conexión a la base de datos.']));
}

if(isset($_GET['semana']) && isset($_GET['anio']) && !empty($_GET['semana']) && !empty($_GET['anio'])) {
    $semana = $_GET['semana'];
    $anio = $_GET['anio'];
    //Vaciar tabla de nomina
    $sql = "TRUNCATE nomina_temp_2025";
    $result = mysqli_query($conection, $sql);
}else {
    $semana = date('W');
    $anio = date('Y');
}
// Calcular fechas para la semana
$fecha = new DateTime();
$fecha->setISODate($anio, $semana);
$fecha_inicio = $fecha->format('Y-m-d');
$fecha_fin = $fecha->modify('+6 days')->format('Y-m-d');

// Consulta principal con JOIN para optimizar las relaciones
$sql = "
    SELECT 
        e.id,
        e.noempleado,
        CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS operador,
        e.cargo,
        IF(e.imss = 'ASEGURADO', 1, 0) AS imss,
        e.estatus,
        (e.bono_semanal + e.bono_categoria + e.bono_supervisor) AS bonos,
        e.prima_vacacional,
        e.caja_ahorro,
        e.supervisor,
        COALESCE(SUM(rv.valor_vuelta), 0) AS total_vueltas,
        SUM(rv.sueldo_vuelta) AS sueldo_bruto,
        rv.unidad,
        rv.num_unidad,
        COALESCE(SUM(a.descuento), 0) + e.caja_ahorro AS deducciones
    FROM 
        empleados e
    LEFT JOIN 
        registro_viajes rv ON rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno)
    LEFT JOIN 
        adeudos a ON a.noempleado = e.id
    WHERE 
        e.estatus = 1 AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'
    GROUP BY 
        e.id, rv.unidad, rv.num_unidad
";
// echo $sql;
$result = mysqli_query($conection, $sql);
$filas = mysqli_num_rows($result);
// echo $filas;


// Manejo de errores en la consulta
if (!$result) {
    die(json_encode(['error' => 'Error en la consulta: ' . mysqli_error($conection)]));
}

$data = [];

$resultado_cuenta_tabla_nomina = mysqli_query($conection, "SELECT COUNT(*) FROM nomina_temp_2025");
$row_nomina = mysqli_fetch_row($resultado_cuenta_tabla_nomina);
// echo $row_nomina();
if($row_nomina[0] == 0) {


// Procesar resultados
while ($row = mysqli_fetch_assoc($result)) {
    $sueldo_bruto = $row['sueldo_bruto'];

    // Obtener datos fiscales
    $sql_fiscal = "SELECT * FROM importes_fiscales WHERE noempleado = " . $row['noempleado'];
    $result_fiscal = mysqli_query($conection, $sql_fiscal);
    $row_fiscal = mysqli_fetch_assoc($result_fiscal);

    $pago_fiscal = $row_fiscal['pago_fiscal'] ?? 0;
    $deduccion_fiscal = $row_fiscal['deduccion_fiscal'] ?? 0;
    $neto = $row_fiscal['neto'] ?? 0;
    $efectivo = $sueldo_bruto - $pago_fiscal;

    // Preparar datos para inserción
    $sql_insercion = "
        INSERT INTO nomina_temp_2025 (
            noempleado, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_bruto,
            nomina_fiscal, bonos, deposito_fiscal, efectivo, deducciones, caja_ahorro,
            supervisor, deduccion_fiscal, neto
        ) VALUES (
            '{$row['noempleado']}', '{$row['operador']}', '{$row['num_unidad']}', '{$row['unidad']}',
            '{$row['cargo']}', {$row['imss']}, $sueldo_bruto, $pago_fiscal, {$row['bonos']},
            $pago_fiscal, $efectivo, {$row['deducciones']}, {$row['caja_ahorro']}, '{$row['supervisor']}',
            $deduccion_fiscal, $neto
        )
    ";
    mysqli_query($conection, $sql_insercion);
}
}

$start = $_GET['start'] ?? 0;
$length = $_GET['length'] ?? 10;
$searchValue = $_GET['search']['value'] ?? '';
$orderColumn = $_GET['order'][0]['column'];
$orderDir = $_GET['order'][0]['dir'];
// echo $orderColumn;
// echo $orderDir;
$whereClause = "WHERE cargo = 'OPERADOR' ";
if (!empty($searchValue)) {
    $whereClause .= "AND noempleado LIKE '%$searchValue%' 
                    OR nombre LIKE '%$searchValue%'";
}

$totalRecordsQuery = "SELECT COUNT(*) as total FROM nomina_temp_2025";
$totalRecordsResult = mysqli_query($conection, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

$columns = array('noempleado', 'nombre', 'no_unidad', 'tipo_unidad', 'cargo', 'imss', 'supervisor');

// Recuperar datos finales
$sql_nomina = "SELECT noempleado, 
                nombre,
                no_unidad,
                tipo_unidad,
                cargo,
                imss,
                SUM(sueldo_bruto),
                SUM(nomina_fiscal),
                SUM(bonos),
                SUM(deposito_fiscal),
                SUM(efectivo),
                SUM(deducciones),
                SUM(caja_ahorro),
                supervisor,
                SUM(deduccion_fiscal),
                SUM(neto)
                 FROM nomina_temp_2025 $whereClause GROUP BY nombre ORDER BY $columns[$orderColumn] $orderDir LIMIT $start, $length";
// echo $sql_nomina;
$result_nomina = mysqli_query($conection, $sql_nomina);

while ($row_nomina = mysqli_fetch_assoc($result_nomina)) {
    $data[] = $row_nomina;
}
$totalRecords = mysqli_num_rows(mysqli_query($conection, "SELECT * FROM nomina_temp_2025"));
// Cerrar conexión y devolver datos
mysqli_close($conection);
echo json_encode(['data' => $data, 
                  'totalRecords' => $totalRecords,
                    'totalFiltered' => $totalRecords], JSON_PRETTY_PRINT);
?>