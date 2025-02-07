<?php
include '../../conexion.php';

$semana = isset($_POST['semana']) ? (int) filter_var($_POST['semana'], FILTER_SANITIZE_NUMBER_INT) : '';
$anio = isset($_POST['anio']) ? (int) $_POST['anio'] : date('Y');

if (empty($semana) || empty($anio)) {
    die(json_encode(['error' => 'No se encontraron datos'], JSON_UNESCAPED_UNICODE));
}

// ✅ Calcular inicio y fin de la semana
$primerDiaAño = new DateTime("$anio-01-01");

// Si el primer día del año no es lunes, ajustar al siguiente lunes
if ($primerDiaAño->format('N') != 1) {
    $primerDiaAño->modify('next Monday');
}

$inicioSemana = clone $primerDiaAño;
$inicioSemana->modify('+' . ($semana -2) . ' weeks');

$finSemana = clone $inicioSemana;
$finSemana->modify('+6 days');

$inicioSemanaStr = $inicioSemana->format('Y-m-d');
$finSemanaStr = $finSemana->format('Y-m-d');

// ✅ Consulta de empleados
$supervisor = isset($_POST['supervisor']) ? $_POST['supervisor'] : '';

$sql = "SELECT noempleado, nombres, apellido_paterno, apellido_materno, supervisor 
        FROM empleados 
        WHERE cargo = 'OPERADOR' AND estatus = 1";

// ✅ Aplicar filtro de supervisor correctamente
if (!empty($supervisor)) {
    $sql .= " AND supervisor LIKE '%$supervisor%'";
}

$result = mysqli_query($conection, $sql);

$data_empleado = [];

// ✅ Recorremos empleados
while ($row = mysqli_fetch_assoc($result)) {
    $operador = $row['nombres'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno'];

    // ✅ Consulta de viajes asociados al empleado
    $sql_viajes = "SELECT semana, operador, fecha, cliente, ruta, unidad, num_unidad, horarios, hora_inicio, hora_fin 
                   FROM registro_viajes 
                   WHERE fecha BETWEEN '$inicioSemanaStr' AND '$finSemanaStr' 
                   AND operador = '$operador'";

    $result_viajes = mysqli_query($conection, $sql_viajes);
    $viajes = [];

    while ($viaje = mysqli_fetch_assoc($result_viajes)) {
        $viajes[] = $viaje;
    }

    // ✅ Asociamos los viajes al empleado
    $row['viajes'] = $viajes;
    $data_empleado[] = $row;
}

// ✅ Respuesta en JSON
header('Content-Type: application/json');
echo json_encode(['data' => $data_empleado], JSON_UNESCAPED_UNICODE);
exit;
?>