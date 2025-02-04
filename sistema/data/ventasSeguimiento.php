<?php
session_start();
include('../../conexion.php');

if(!$conection) {
    die (json_encode(['error' => 'No se pudo conectar a la base de datos']));
}

$sql = "SELECT * FROM prospectos WHERE DATE(fecha_seguimiento) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
$query = mysqli_query($conection, $sql);
$data = array();
while($row = mysqli_fetch_assoc($query)) {
    // var_dump($row);
    $unidad = isset($row['unidad']) ? $row['unidad'] : 1;
    $origen = isset($row['origen']) ? $row['origen'] : 1;
    $semaforo = isset($row['semaforo']) ? $row['semaforo'] : 1;


    $sql_tipo_unidad = "SELECT unidad FROM tipo_unidad WHERE id = " . $unidad;
    $query_tipo_unidad = mysqli_query($conection, $sql_tipo_unidad);
    $row['tipo_unidad'] = mysqli_fetch_assoc($query_tipo_unidad);

    $sql_origen = "SELECT origen FROM origen_prospecto WHERE id = " . $origen;
    $query_origen = mysqli_query($conection, $sql_origen);
    $row['origen'] = mysqli_fetch_assoc($query_origen);

    $sql_semaforo = "SELECT semaforo FROM semaforo WHERE id = " . $semaforo;
    $query_semaforo = mysqli_query($conection, $sql_semaforo);
    $row['semaforo'] = mysqli_fetch_assoc($query_semaforo);

    $data[] = $row;
}
// var_dump($data);
echo json_encode([
    'data' => $data
])
?>