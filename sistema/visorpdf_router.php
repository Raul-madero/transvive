<?php

include "../conexion.php";
$conection->set_charset('utf8');
$id = $_GET['id']; 
$query = mysqli_query($conection,"SELECT ruta_router FROM ordenes_servicio WHERE folio = $id");
mysqli_close($conection);
$result_query = mysqli_num_rows($query);
$data = mysqli_fetch_assoc($query);
$filename = $data['ruta_router'];
$ruta = $data['ruta_descarga'];
//$nombrefile = $ruta.$filename;
//*$nombreArchivo = '138.pdf'; // Obtén el nombre del archivo en una variable PHP


header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
readfile($filename);
?>