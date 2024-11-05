<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, cliente, ruta, no_eco, operador, DATE_FORMAT(horario1, '%H:%i') as Hora1, DATE_FORMAT(horario2, '%H:%i') as Hora2, DATE_FORMAT(horario3, '%H:%i') as Hora3, DATE_FORMAT(hmixto1, '%H:%i') as Hmixto1, dias, if(estatus = 1, 'Activo', 'Inactivo') as Status FROM rutas";
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
