<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');

// Corregir la consulta SQL para incluir la condición de los JOINs
$sql = "SELECT a.*, 
                e.noempleado, 
                e.nombres, 
                e.apellido_paterno,
                e.apellido_materno
        FROM adeudos a
        LEFT JOIN empleados e ON a.noempleado = e.noempleado";
// Ejecutar la consulta
$resultset = mysqli_query($conection, $sql) or die("database error:". mysqli_error($conection));

// Recoger los resultados en un array
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
    $data[] = $rows;
}

// Estructura de la respuesta para DataTables
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
);

// Retornar la respuesta como JSON
echo json_encode($results);
?>
