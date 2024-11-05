<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
include('../../conexion.php');
$conection->set_charset('utf8');


$sql = "SELECT rv.id, rv.fecha, rv.cliente, rv.operador, rv.unidad, rv.num_unidad, rv.personas, rv.hora_inicio, rv.direccion, rv.hora_fin, rv.destino, rv.estatus, if(rv.estatus = 1,'Activa',if(rv.estatus = 2, 'Ralizada',if(rv.estatus = 3,'Cancelada', if(rv.estatus=4, 'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.id_supervisor, us.nombre as supervisor, rv.costo_viaje FROM registro_viajes rv inner join usuario us ON rv.id_supervisor = us.idusuario where rv.estatus = 1 and rv.tipo_viaje LIKE '%Especial%'  and rv.id_supervisor = $idUser and rv.estatus <> 2 order by id DESC";

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
