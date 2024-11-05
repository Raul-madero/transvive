<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT ua.idusuario, ua.nombre, ua.correo, ua.usuario, ua.rol, if(ua.estatus = 1, 'Activo', 'Inactivo') as Status,
rl.rol as Namerol FROM usuario ua INNER JOIN rol rl ON ua.rol = rl.idrol" ;
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
