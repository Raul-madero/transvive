<?php
session_start();
include('../../conexion.php');
if(!isset($_POST['semana']) && !isset($_POST['anio'])) {
die(json_encode(array('error'=> 'No se encontraron datos'), JSON_UNESCAPED_UNICODE));
}

$semana = $_POST['semana'];
$anio = $_POST['anio'];

$sql = "SELECT no_unidad FROM unidades WHERE estatus = 1";
$result = mysqli_query($conection, $sql);
if(mysqli_num_rows($result) == 0) {
    die(json_encode(array("error"=> "No se encontraron datos"), JSON_UNESCAPED_UNICODE));
}

$unidades = [];
while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row['no_unidad'];
}

if(count($data) == 0) {
    die(json_encode(array("error"=> "No se encontraron datos"), JSON_UNESCAPED_UNICODE));
}

header('Content-Type: application/json');
echo json_encode([$data, $semana, $anio], JSON_UNESCAPED_UNICODE);
?>
// ✅ Respuesta en JSON