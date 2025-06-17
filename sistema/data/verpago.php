<?php
include "../../conexion.php";
$conection->set_charset('utf8');

$orden = isset($_GET['orden']) ? intval($_GET['orden']) : 0;
$requisicion = isset($_GET['id'])? intval($_GET['id']) : 0;
if (intval($orden) <= 0) {
    $query = mysqli_query($conection, "SELECT ruta FROM pagps_proveedor WHERE no_requisicion = $requisicion");
}else {
    $query = mysqli_query($conection, "SELECT ruta FROM pagos_proveedor WHERE o_compra = $orden");
}

mysqli_close($conection);

if (!$query || mysqli_num_rows($query) === 0) {
    die("Archivo no encontrado.");
}

$data = mysqli_fetch_assoc($query);
$filename = $data['ruta'];

if (!file_exists($filename)) {
    die("El archivo no existe en el servidor.");
}

header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=" . basename($filename));
header("Content-Length: " . filesize($filename));
readfile($filename);
exit;