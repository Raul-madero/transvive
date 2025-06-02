<?php
include "../../conexion.php";
$conection->set_charset('utf8');

$orden = isset($_GET['orden']) ? intval($_GET['orden']) : 0;
if ($orden <= 0) {
    die("Orden de Compra inválida.");
}

$query = mysqli_query($conection, "SELECT ruta FROM pagos_proveedor WHERE orden_compra = $orden");
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