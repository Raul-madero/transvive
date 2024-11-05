<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
include('../../conexion.php');
$conection->set_charset('utf8');

if ($rol == 1 || $rol == 6 || $rol == 8) {
$sql = "SELECT id as Id, fecha, cliente, operador, unidad, num_unidad, personas, hora_inicio, direccion, hora_fin, destino, estatus, if (estatus = 4, 'INICIADO', if(estatus = 5, 'TERMINADO', 'Cancelado')) as Status  FROM registro_viajes where estatus = 4 or estatus = 5";
}else { 
$sql = "SELECT id as Id, fecha, cliente, operador, unidad, num_unidad, personas, hora_inicio, direccion, hora_fin, destino, estatus, if (estatus = 1, 'Activo', 'Cancelado') as Status  FROM registro_viajes where tipo_viaje <> 'Especial' and usuario_id = $idUser";
}
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