<?php
session_start();
include ("../../conexion.php");
if($conection->connect_error) {
    die("Error de conexion a la base d edatos". $conection->connect_error);
}

$folio_requisicion = isset($_POST['folio'] ) ? $_POST['folio'] : die("Error al obtener el folio de la requisicion");

$sql = "SELECT * FROM detalle_requisicion WHERE folio_requisicion = ?";
$stmt = $conection->prepare($sql);
$stmt->bind_param("i", $folio_requisicion);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([$data]);
$stmt->close();
$conection->close();