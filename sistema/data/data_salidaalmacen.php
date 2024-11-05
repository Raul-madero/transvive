<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT oc.id, DATE_FORMAT(oc.fecha, '%d/%m/%Y') as Datereg, oc.serie, oc.folio, if(oc.estatus = 1, 'Activa', 'Cancelada') as Status, cantidad_total, importe_total FROM salida_almacen oc ";
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
