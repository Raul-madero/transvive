<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, no_orden, DATE_FORMAT(fecha, '%d/%m/%Y') as Datereg, usuario, solicita, unidad, tipo_trabajo, tipo_mantenimiento, if(estatus = 1, 'Abierta', if(estatus=2, 'Cerrada', 'Cancelada')) as Status FROM solicitud_mantenimiento";
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
