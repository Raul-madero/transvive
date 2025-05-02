<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
include('../../conexion.php');
$conection->set_charset('utf8');

if ($rol == 1 || $rol == 6 || $rol == 8) {
$sql = "SELECT tv.id as Id, date_format(tv.fecha, '%d/%m/%Y') as Datereg, tv.semana, tv.cliente, tv.operador, tv.unidad, tv.num_unidad, tv.estatus, tv.ruta, ur.nombre FROM tempregistro_viajes tv inner join usuario ur ON tv.id_supervisor = ur.idusuario";
}else { 
$sql = "SELECT id as Id, fecha, cliente, operador, unidad, num_unidad, personas, hora_inicio, direccion, hora_fin, destino, estatus, if (estatus = 1, 'Activo', 'Cancelado') as Status  FROM tempregistro_viajes where tipo_viaje <> 'Especial' and usuario_id = $idUser";
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