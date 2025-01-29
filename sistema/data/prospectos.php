<?php
session_start();
include('../../conexion.php');

if(!$conection) {
    die (json_encode(['error' => 'No se pudo conectar a la base de datos']));
}

$sql = "SELECT * FROM prospectos";
$query = mysqli_query($conection, $sql);
$data = array();
while($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}
// var_dump($data);
echo json_encode([
    'data' => $data
])
?>