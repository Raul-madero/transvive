<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT ic.id, ic.tipo_incidencia, ic.empleado, em.cargo, DATE_FORMAT(ic.fecha_inicial, '%d/%m/%Y') as Dateini, DATE_FORMAT(ic.fecha_final, '%d/%m/%Y') as Datefin, CONCAT(DATE_FORMAT(ic.fecha_inicial, '%d/%m/%Y'), ' Al ', DATE_FORMAT(ic.fecha_final, '%d/%m/%Y') ) as Periodo, ic.valor, if(ic.estatus = 1, 'Activo', 'Inactivo') as Status FROM incidencias ic INNER JOIN empleados em ON ic.empleado = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno)";
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
