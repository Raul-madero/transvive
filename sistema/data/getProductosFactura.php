<?php
include '../../conexion.php';

$folio = isset($_REQUEST['folio']) ? intval($_REQUEST['folio']) : 0;

$query = mysqli_query($conection, "SELECT codigo, cantidad, descripcion, precio FROM detalle_requisicioncompra WHERE folio = $folio");

$productos = array();

while ($row = mysqli_fetch_assoc($query)) {
    $productos[] = $row;
}

echo json_encode($productos);

mysqli_close($conection);
