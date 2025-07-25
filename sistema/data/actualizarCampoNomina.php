<?php
include '../../conexion.php';

$id = $_POST['id'];
$campo = $_POST['campo'];
$valor = $_POST['valor'];

$camposPermitidos = ['sueldo_bruto', 'deducciones', 'sueldo_adicional'];
var_dump($_POST);
if (in_array($campo, $camposPermitidos)) {
    $stmt = $conection->prepare("UPDATE nomina_temp_2025 SET $campo = ? WHERE id = ?");
    $stmt->bind_param("di", $valor, $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }
    if($campo === 'deducciones') {
        $stmt = $conection->prepare("UPDATE nomina_temp_2025 SET efectivo = efectivo - ? WHERE id = ?");
        $stmt->bind_param("di", $valor, $id);
        if (!$stmt->execute()) {
            echo json_encode(["success" => false, "error" => $stmt->error]);
        } else {
            echo json_encode(["success" => true]);
        }
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Campo no permitido"]);
}
