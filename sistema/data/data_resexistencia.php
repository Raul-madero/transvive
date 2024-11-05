<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');
$sql = "SELECT 
    iv.codigo, rf.codigo_interno, rf.descripcion, iv.umedida, iv.almacen, 
    SUM(iv.cantidad_disponible) AS Cantidad_Total_Disponible
FROM 
    inventario_peps iv INNER JOIN refacciones rf ON iv.codigo = rf.codigo
GROUP BY 
    codigo
ORDER BY 
    codigo ASC";
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
