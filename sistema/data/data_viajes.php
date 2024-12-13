<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
include('../../conexion.php');
$conection->set_charset('utf8');
date_default_timezone_set('America/Mexico_City');
$fcha2 = date("Y-m-d");
// $fcha1 = date("Y-m-d",strtotime ( '-1 day' , strtotime ( $fcha2 ) ) );

if ($rol == 1 || $rol == 6 || $rol == 8 || $rol == 9) {
$sql = "SELECT rv.id as Id, date_format(rv.fecha, '%d/%m/%Y') as Fcha, rv.cliente, rv.operador, rv.unidad, rv.num_unidad, rv.personas, rv.hora_inicio, rv.direccion, rv.hora_fin, rv.destino, rv.estatus, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus=3 ,'Cancelado',if(rv.estatus=4,'Iniciado',if(rv.estatus=5,'Terminado',''))))) as Status, rv.semana, rv.hora_inicio, time_format(rv.hora_inicio, '%H:%i') as Hinicio, rv.hora_fin, time_format(rv.hora_fin, '%H:%i') as Hfin, rv.id_supervisor, sp.nombres as nombre, us.nombre as jefe_operaciones FROM registro_viajes rv left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us on ct.id_supervisor = us.idusuario left join supervisores sp ON rv.id_supervisor = sp.idacceso where rv.tipo_viaje <> 'Especial'";
}else { 
$sql = "SELECT id as Id, date_format(fecha, '%d/%m/%Y') as Fcha, cliente, operador, unidad, num_unidad, personas, hora_inicio, time_format(hora_inicio, '%H:%i') as Hinicio, direccion, hora_fin, time_format(hora_fin, '%H:%i') as Hfin, destino, estatus, if(estatus = 1,'Activo',if(estatus = 2, 'Realizado', if(estatus=3 ,'Cancelado',if(estatus=4,'Iniciado',if(estatus=5,'Terminado',''))))) as Status, semana, hora_inicio, hora_fin, id_supervisor, jefe_operaciones  FROM registro_viajes where tipo_viaje <> 'Especial' and usuario_id = $idUser 
-- and fecha between '$fcha1' and '$fcha2' 
and estatus = 1 or estatus = 4 or estatus = 5 
  ";
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