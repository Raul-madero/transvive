<?php
require '../../conexion.php';

$query = "SELECT id, nombre FROM proveedores WHERE estatus = 1 ORDER BY nombre ASC";
$result = mysqli_query($conection, $query);

$proveedores = [];
while ($row = mysqli_fetch_assoc($result)) {
    $proveedores[] = $row;
}

echo json_encode($proveedores);

mysqli_close($conection);