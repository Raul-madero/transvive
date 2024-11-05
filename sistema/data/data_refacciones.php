<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, codigo, codigo_interno, descripcion, marca, rotacion, categoria, modelo, stock_actual, costo,stock_minimo, stock_maximo, impuesto, if(estatus = 1, 'Activo', if(estatus = 2, 'Descontinuado', 'Inactivo')) as Status FROM refacciones";
$resultset = mysqli_query($conection, $sql) or die("database error:". mysqli_error($conection));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$data[] = $rows;
}
$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData"=>$data);
echo json_encode($results);
?>
