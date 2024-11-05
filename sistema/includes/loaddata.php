<?php
session_start();
$User=$_SESSION['user'];
$rol=$_SESSION['rol'];
$idUser = $_SESSION['idUser'];
$operador = $_SESSION['nombre'];
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT rv.id, DATE_FORMAT(rv.fecha, '%d/%m/%Y') as Datereg, rv.cliente, rv.operador, rv.unidad, rv.num_unidad, rv.personas, rv.hora_inicio, rv.direccion, rv.hora_fin, rv.destino, if(rv.estatus = 1, 'Activo', if(rv.estatus = 4, 'Iniciado',if(rv.estatus = 2, 'Realizado','Cancelado'))) as Status, rv.ruta, rv.tipo_viaje, IF (rv.ruta = rt.ruta, rt.liga_maps, '') as linkruta  FROM registro_viajes rv LEFT JOIN routers rt ON rv.cliente = rt.cliente where rv.estatus = 1 and rv.operador ='$operador'";
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
