<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, no_quincena, no_empleado, nombre, puesto, estatus, sueldo_bruto, sueldo_diario, dias_laborados, viajes_especiales, viajes_normales, total_especiales, total_normales, sueldo_total, bono, bono_mensual, apoyo_alimenticio, subtotal, caja_ahorro, prestamo_deuda, vacaciones, prima_vacacional, dias_vacaciones, sueldo_quincenal, sueldo_fiscal, impuesto_fiscal, total_efectivo, deposito, total_efectivo + deposito as total_total FROM detalle_temp_nominaquincena ORDER BY no_empleado";
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
