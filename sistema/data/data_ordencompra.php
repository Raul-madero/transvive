<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT oc.id, oc.no_orden, DATE_FORMAT(oc.fecha, '%d/%m/%Y') as Datereg, oc.proveedor, oc.area_solicitante, oc.contacto, if(oc.estatus = 1, 'Activa', 'Cancelada') as Status, pv.nombre FROM orden_compra oc INNER JOIN proveedores pv ON oc.proveedor = pv.id";
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
