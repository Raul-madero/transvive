<?php
include "../../conexion.php";

$banda_id3 = $_POST['banda_id3'] ?? '';

// Asociaciones por tipo de unidad
$tipos = [
    'Camion'        => '%C-%',
    'Camioneta'     => '%T-%',
    'Automovil'     => '%A-%',
    'Sprinter'      => '%S-%',
    'Unidad Externa'=> '%Externa%',
    'JAC'           => '%J-%'
];

// Validamos si el tipo existe en el arreglo
if (array_key_exists($banda_id3, $tipos)) {
    $like = $tipos[$banda_id3];
    $sql = "SELECT * FROM unidades WHERE no_unidad LIKE '$like' ORDER BY id";
    $query = mysqli_query($conection, $sql);
    $filas = mysqli_fetch_all($query, MYSQLI_ASSOC);
    mysqli_close($conection);
    
    // Generar las opciones del <select>
    echo '<option value="">- Seleccione -</option>';
    foreach ($filas as $op) {
        echo '<option value="' . $op['no_unidad'] . '">' . $op['no_unidad'] . '</option>';
    }
}
?>