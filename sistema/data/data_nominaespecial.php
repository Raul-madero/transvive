<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, no_empleado, empleado, cargo, date_format(fecha_ingreso, '%d/%m/%Y') as FechaIngreso, date_format(fecha_pago, '%d/%m/%Y') as FechaPago, dias_aguinaldo, dias_derecho, salario_diario, importe_aguinaldo, importe_fiscal, impuesto_fiscal, deposito, pago_efectivo FROM detalle_temp_nomespecial";
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
