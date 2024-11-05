<?php
session_start();
$semana = $_REQUEST['id'];
//echo '<script language="javascript">alert("juas");</script>';
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT id, no_semana, no_empleado, nombre, cargo, imss, estatus, noalertas, viajes_especiales, viajes_contrato, sueldo_base, bono_categoria, bono_supervisor, bono_semanal, apoyo_mensual, total_especiales, sueldo_adicional, vacaciones, prima_vacacional, total_vueltas, sueldo_bruto, pago_fiscal, deduccion_fiscal, descuento_adeudo, caja, total_nomina, total_general, total_nomina + total_general as total_total, supervisor  FROM detalle_nomina  where no_semana = '$semana' ORDER BY no_empleado";
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
