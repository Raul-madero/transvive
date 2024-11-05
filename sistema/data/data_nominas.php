<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, date_format(fecha, '%d/%m/%Y') as Fechareg, no_nomina, date_format(dia_inicial, '%d/%m/%Y') as Fechaini , date_format(dia_final, '%d/%m/%Y') as Fechafin, if(estatus = 1, 'Autorizada', 'Sin Autorizar') as Status FROM nomina";
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
