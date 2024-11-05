<?php
session_start();
$fcha = date("Y-m-d");
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, titulo, tipo, prioridad, estado as Status FROM tareas WHERE estado = 1 and fecha_vence = '$fcha'";
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
