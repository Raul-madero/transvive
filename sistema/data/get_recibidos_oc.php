<?php 
include("../../conexion.php");

$orden = $_REQUEST['orden'];

if(!$orden) {
    echo json_encode(array('error'=> 'No es una ordend e compra valida'));
    exit;
}

$query = "SELECT * FROM detalle_ordencompra WHERE folio = ?";
$stmt = $conection->prepare($query);
$stmt->bind_param("s", $orden);
$stmt->execute();
$result = $stmt->get_result();

$productos = [];
while($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);

$stmt->close();
$conection->close();
?>