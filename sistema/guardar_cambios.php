<?php
  include "../conexion.php";

$id = $_POST['id'];
$field = $_POST['field'];
$value = $_POST['value'];



// Actualizar campo en la base de datos
$query_update = "UPDATE empleados SET sueldo_base = $value WHERE id = $id";
mysqli_query($conection, $query_update);

// Cerrar conexión a la base de datos
mysqli_close($conection);

echo 'Cambios guardados correctamente';
?>