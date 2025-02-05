<?php
session_start();
include('../../conexion.php');

if(!$conection) {
    die (json_encode(['error' => 'No se pudo conectar a la base de datos']));
}

$sql = "SELECT * FROM prospectos WHERE DATE(fecha_seguimiento) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
$query = mysqli_query($conection, $sql);
$data = array();
while($row = mysqli_fetch_assoc($query)) {
    // var_dump($row);
    $unidad = isset($row['unidad']) ? $row['unidad'] : 1;
    $origen = isset($row['origen']) ? $row['origen'] : 1;
    $semaforo = isset($row['semaforo']) ? $row['semaforo'] : 1;


    $sql_tipo_unidad = "SELECT unidad FROM prospectos WHERE id = " . $unidad;
    $query_tipo_unidad = mysqli_query($conection, $sql_tipo_unidad);
    if ($query_tipo_unidad && mysqli_num_rows($query_tipo_unidad) > 0) {
        $row['tipo_unidad'] = mysqli_fetch_assoc($query_tipo_unidad);
    } else {
        $row['tipo_unidad'] = null; // Manejo en caso de error o sin resultados
        if (!$query_tipo_unidad) {
            echo 'Error en la consulta SQL: ' . mysqli_error($conection);
        }
    }

    $sql_origen = "SELECT origen FROM prospectos WHERE id = " . intval($origen);
    $query_origen = mysqli_query($conection, $sql_origen);
    if ($query_origin && mysqli_num_rows($query_origin) > 0) {
        $row['origen'] = mysqli_fetch_assoc($query_origen);
    }else {
        $row['origen'] = null; // Manejo en caso de error o sin resultados
        if (!$query_origen) {
            echo 'Error en la consulta SQL: ' . mysqli_error($conection);
        }
    }

    $sql_semaforo = "SELECT semaforo FROM prospectos WHERE id = " . intval($semaforo);
    $query_semaforo = mysqli_query($conection, $sql_semaforo);

    if ($query_semaforo && mysqli_num_rows($query_semaforo) > 0) {
        $row['semaforo'] = mysqli_fetch_assoc($query_semaforo);
    } else {
        $row['semaforo'] = null; // Manejo en caso de error o sin resultados
        if (!$query_semaforo) {
            echo 'Error en la consulta SQL: ' . mysqli_error($conection);
        }
}


    $data[] = $row;
}
// var_dump($data);
echo json_encode([
    'data' => $data
])
?>