<?php
include "../conexion.php";
$conection->set_charset('utf8');

// Validar parámetro
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
var_dump($id);
if ($id <= 0) {
    die("ID inválido.");
}

// Consultar ruta
$query = mysqli_query($conection, "SELECT ruta FROM facturas WHERE no_requisicion = $id");
mysqli_close($conection);

if (!$query || mysqli_num_rows($query) === 0) {
    die("Archivo no encontrado.");
}

$data = mysqli_fetch_assoc($query);
$filename = $data['ruta'];
echo $filename; // Devuelve la ruta del archivo, sin el nombre del archivo

// Validar ruta (evitar acceso fuera de la carpeta)
if (strpos($filename, '..') !== false || substr($ruta, 0, strlen('archivos_compras/')) === 'archivos_compras/') {
    die("Ruta inválida.");
}

// Verificar que el archivo exista físicamente
if (!file_exists($filename)) {
    die("El archivo no existe en el servidor.");
}

// Forzar visualización en el navegador
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=" . basename($filename));
header("Content-Length: " . filesize($filename));
readfile($filename);
exit;
?>
