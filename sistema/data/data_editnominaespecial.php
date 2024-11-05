<?php
session_start();
$id = $_REQUEST['id'];
//echo '<script language="javascript">alert("juas");</script>';
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT dn.id, dn.no_empleado, dn.empleado, dn.cargo, dn.fecha_ingreso, dn.fecha_pago, dn.year_pago, dn.dias_aguinaldo, dn.dias_derecho, dn.salario_diario, dn.importe_aguinaldo, dn.importe_fiscal, dn.impuesto_fiscal, dn.deposito, dn.pago_efectivo, (dn.deposito + dn.pago_efectivo ) as pago_total FROM detalle_nomespecial dn INNER JOIN nomina_especial ns ON dn.fecha_pago = ns.fecha_pago where ns.id = $id ORDER BY dn.no_empleado ASC";
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
