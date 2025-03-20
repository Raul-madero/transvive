<?php
session_start();
include('../../conexion.php');
// if(!isset($_POST['semana']) && !isset($_POST['anio'])) {
//     die(json_encode(array('error'=> 'No se encontraron datos'), JSON_UNESCAPED_UNICODE));
// }

$semana = $_POST['semana'] ?? "";
$anio = $_POST['anio'] ?? "";

$sql = "SELECT no_unidad FROM unidades";
$result = mysqli_query($conection, $sql);
if(mysqli_num_rows($result) == 0) {
    die(json_encode(array("error"=> "No se encontraron datos"), JSON_UNESCAPED_UNICODE));
}

$data = [];
while($row = mysqli_fetch_assoc($result)) {
    $nounidad = $row['no_unidad'];
    $partes = explode('-', $nounidad);
    $tipo = "";
    switch ($partes[0]) {
        case "A":
            $tipo = "Automovil";
            break;
        case "C":
            $tipo = "Camion";
            break;
        case "T":
            $tipo = "Camioneta";
            break;
        case "S":
            $tipo = "Sprinter";
            break;
        default:
            $tipo = "Desconocido";
            break;
        }
    $data[] = [
        "no_unidad" => $nounidad,
        "tipo" => $tipo,
        "semana" => $semana,
        "anio" => $anio
    ];
}

if(count($data) == 0) {
    die(json_encode(array("error"=> "No se encontraron datos"), JSON_UNESCAPED_UNICODE));
}

header('Content-Type: application/json');
ob_clean();
echo json_encode(["data" => $data], JSON_UNESCAPED_UNICODE);
?>
// ✅ Respuesta en JSON