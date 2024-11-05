<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT p.id, p.empleado_no, concat(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_paterno) as name_empleado, p.fecha_prestamo, p.monto_total, p.descripcion FROM prestamos p INNER JOIN empleados e where p.empleado_no = e.noempleado";
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
