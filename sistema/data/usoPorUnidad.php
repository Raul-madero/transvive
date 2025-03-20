<?php
session_start();
include('../../conexion.php');

header('Content-Type: application/json'); // ✅ Asegura que siempre se devuelva JSON
ob_start(); // ✅ Inicia el buffer de salida para evitar errores de salida

$semana = $_POST['semana'] ?? "";
$anio = $_POST['anio'] ?? "";

// Consulta SQL
$sql = "SELECT no_unidad FROM unidades";
$result = mysqli_query($conection, $sql);

if (!$result) {
    echo json_encode(["error" => "Error en la consulta: " . mysqli_error($conection)], JSON_UNESCAPED_UNICODE);
    exit;
}

if (mysqli_num_rows($result) == 0) {
    echo json_encode(["error" => "No se encontraron datos"], JSON_UNESCAPED_UNICODE);
    exit;
}

// Arreglo de datos
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $nounidad = $row['no_unidad'];
    $partes = explode('-', $nounidad);
    $tipo = "Desconocido";

    if (isset($partes[0])) {
        switch ($partes[0]) {
            case "A": $tipo = "Automovil"; break;
            case "C": $tipo = "Camion"; break;
            case "T": $tipo = "Camioneta"; break;
            case "S": $tipo = "Sprinter"; break;
        }
    }

    $data[] = [
        "no_unidad" => $nounidad,
        "tipo" => $tipo,
        "semana" => $semana,
        "anio" => $anio
    ];
}

// ✅ Limpiar cualquier salida previa antes de devolver JSON
ob_end_clean();
echo json_encode(["data" => $data], JSON_UNESCAPED_UNICODE);
exit;
?>