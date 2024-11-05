<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
include('../../conexion.php');
$conection->set_charset('utf8');

if ($rol == 1 || $rol == 6 || $rol == 9) {
	$sql = "SELECT rv.id, rv.fecha, rv.cliente, rv.operador, rv.unidad, rv.num_unidad, rv.personas, rv.hora_inicio, rv.hora_fin, rv.direccion, rv.destino, rv.estatus, rv.destino, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus=3 ,'Cancelado',if(rv.estatus=4,'Iniciado',if(rv.estatus=5,'Terminado',''))))) as Status, rv.id_supervisor, us.nombre as supervisor, rv.costo_viaje, rv.sueldo_vuelta, rv.numero_unidades, time_format(rv.hora_inicio, '%H:%i') as Hinicio, rv.hora_fin, time_format(rv.hora_fin, '%H:%i') as Hfin FROM registro_viajes rv left join usuario us ON rv.id_supervisor = us.idusuario where rv.tipo_viaje like '%Especial%'  order by rv.id DESC ";
}else {
$sql = "SELECT rv.id, date_format(rv.fecha, '%d/%m/%Y') as Fcha, rv.cliente, rv.operador, rv.unidad, rv.num_unidad, rv.personas, rv.hora_inicio, rv.direccion, rv.hora_fin, rv.destino, rv.estatus, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado',if(rv.estatus = 3,'Cancelado', if(rv.estatus=4, 'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.id_supervisor, us.nombre as supervisor, rv.costo_viaje, rv.sueldo_vuelta, rv.numero_unidades, time_format(rv.hora_inicio, '%H:%i') as Hinicio, rv.hora_fin, time_format(rv.hora_fin, '%H:%i') as Hfin FROM registro_viajes rv inner join usuario us ON rv.id_supervisor = us.idusuario where rv.estatus <> 2 and rv.tipo_viaje LIKE '%Especial%'  and rv.id_supervisor = $idUser order by id DESC";
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
