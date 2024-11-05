<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
 $operador = $_SESSION['nombre'];
include('../../conexion.php');
$conection->set_charset('utf8');

//$fcha = date("Y-m-d");

$sql = "SELECT id as Id, fecha, cliente, operador, unidad, num_unidad, personas, hora_inicio, direccion, hora_fin, destino, if(estatus = 1, 'Activo',if(estatus = 4, 'Iniciado', 'Cnacelado')) as Status, ruta  FROM registro_viajes where estatus = 4  and operador ='$operador'";

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