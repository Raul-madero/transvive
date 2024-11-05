<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, no_requisicion, DATE_FORMAT(fecha, '%d/%m/%Y') as Datereg, DATE_FORMAT(fecha_requiere, '%d/%m/%Y') as Datereq, tipo_requisicion, area_solicitante, if(estatus = 1, 'Activa', 'Cancelada') as Status FROM requisicion_compra";
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
