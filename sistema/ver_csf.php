<?php
require '../conexion.php';

if (!isset($_GET['id'])) {
    die('ID de proveedor no especificado');
}

$idProveedor = (int)$_GET['id'];

$sql = "SELECT ruta FROM proveedor_csf WHERE proveedor_id = ? LIMIT 1";
$stmt = mysqli_prepare($conection, $sql);
mysqli_stmt_bind_param($stmt, "i", $idProveedor);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $ruta);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($ruta && file_exists("$ruta")) {
    header('Content-Type: application/pdf');
    readfile("$ruta");
    exit;
} else {
    echo "Archivo CSF no encontrado para este proveedor.";
}
?>
