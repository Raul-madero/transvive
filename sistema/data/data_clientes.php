<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, nombre, nombre_corto, correo, telefono, if(estatus = 1, 'Activo', 'Inactivo') as Status FROM clientes";
$resultset = mysqli_query($conection, $sql) or die("database error:". mysqli_error($conection));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$data[] = $rows;
}
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData"=>$data);
echo json_encode($results);
?>
