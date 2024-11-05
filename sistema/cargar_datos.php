<?php
$conexion = mysqli_connect("localhost", "root", "", "transvive");

$consulta = "SELECT id, noempleado, concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name FROM empleados";
$resultado = mysqli_query($conexion, $consulta);
$datos = array();
while($fila = mysqli_fetch_assoc($resultado)){
    $datos[] = $fila;
}
echo json_encode($datos);
mysqli_close($conexion);
?>