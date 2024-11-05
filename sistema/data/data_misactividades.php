<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT ac.id, ac.titulo, ac.cliente, ac.estado as Status, ct.nombre, date_format(cierre_previsto, '%d-%m-%Y') as Cierre FROM actividades ac
 INNER JOIN clientes ct ON ac.cliente = ct.id ";
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
