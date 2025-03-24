<?php
session_start();
header('Content-Type: application/json');
include('../../conexion.php');

$no_unidad = $_POST['no_unidad'] ?? "";
$semana = $_POST['semana'] ?? "";

if (!$no_unidad || !$semana) {
    echo json_encode(['error' => 'Datos insuficientes']);
    exit;
}

//Calcular la fecha de inicio y fin de la semana
$year = date('Y');
$fecha_inicio = date('Y-m-d', strtotime($year . "W" . str_pad($semana, 2, '0 , STR_PAD_LEFT')));
$fecha_fin = date('Y-m-d', strtotime($fecha_inicio . ' +6 days'));

$letra = strtoupper(substr($no_unidad, 0, 1)); // Obtiene la primera letra

switch ($letra) {
    case 'A':
        $tipo = 'Automóvil';
        break;
    case 'T':
        $tipo = 'Camioneta';
        break;
    case 'C':
        $tipo = 'Camión';
        break;
    case 'S':
        $tipo = 'Sprinter';
        break;
    default:
        $tipo = 'Desconocido';
        break;
}


$sql = "SELECT fecha, COALESCE(SUM(valor_vuelta), 0) AS vueltas, num_unidad FROM registro_viajes WHERE num_unidad = ? AND fecha BETWEEN ? AND ? GROUP BY fecha";
$stmt = $conection->prepare($sql);
$stmt->bind_param('sss', $no_unidad, $fecha_inicio, $fecha_fin);
$stmt->execute();
$result = $stmt->get_result();

$datos = [];
while ($row = $result->fetch_assoc()) {
    $datos[] = [
        'fecha' => $row['fecha'],
        'vueltas' => $row['vueltas'],
        'num_unidad' => $row['num_unidad'],
        'tipo' => $tipo
    ];
}

echo json_encode(['data' => $datos], JSON_UNESCAPED_UNICODE);
exit;