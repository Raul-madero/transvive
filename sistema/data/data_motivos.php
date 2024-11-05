<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, name_motivo, if(estatus = 1, 'Activo', 'Inactivo') as Status FROM motivos_perdida";
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
