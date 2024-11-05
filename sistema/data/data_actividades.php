<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, actividad, CONCAT(planificacion, ' ', time_planificacion) as Time, time_planificacion, if(estatus = 1, 'Activo', 'Inactivo') as Status FROM tipos_actividades";
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
