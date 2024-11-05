<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
include('../../conexion.php');
$conection->set_charset('utf8');

if ($rol == 1 || $rol == 6 || $rol == 10) {
$sql = "SELECT id, folio, fecha, nodesemana, estacion, nounidad, placas, operador, supervisor  FROM tempcarga_combustible ";
}else { 
$sql = "SELECT id, folio, fecha, nodesemana, estacion, nounidad, placas, operador, supervisor  FROM tempcarga_combustible";
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