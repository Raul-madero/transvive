<?php
session_start();
include "../../conexion.php";
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];

if(!$conection) {
    header('Content-Type: application/json; charset: UTF-8');
    die (json_encode(['error' => 'Error en la conexion con la base de datos'], JSON_UNESCAPED_UNICODE)); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);
    // Obtener los datos enviados
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $sueldo = isset($_POST['sueldo']) ? floatval($_POST['sueldo']) : 0;
    $nomina_fiscal = isset($_POST['nomina_fiscal']) ? floatval($_POST['nomina_fiscal']) : 0;
    echo $nomina_fiscal;
    $efectivo = $sueldo - $nomina_fiscal;
    // var_dump($_POST);
    // Validar que el ID sea válido
    if ($id <= 0) {
        header('Content-Type: application/json; charset: UTF-8');
        echo json_encode(['success' => false, 'message' => 'ID inválido'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $stmt = mysqli_prepare($conection, "UPDATE nomina_temp_2025 SET sueldo_bruto = ?, efectivo = ? WHERE id = ?");
    if(!$stmt) {
        header('Content-Type: application/json; charset: UTF-8');
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conn->error], JSON_UNESCAPED_UNICODE);
        $conection->close();
        exit;
    }
    mysqli_stmt_bind_param($stmt, 'ddi', $sueldo, $efectivo, $id );
    // var_dump ($stmt);
    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Content-Type: application/json; charset: UTF-8');
        echo json_encode(['success' => true, 'message' => 'Sueldo actualizado correctamente'], JSON_UNESCAPED_UNICODE);
    } else {
        header('Content-Type: application/json; charset: UTF-8');
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el sueldo: ' . $stmt->error], JSON_UNESCAPED_UNICODE);
    }
    $conection->close();

}else {
    header('Content-Type: application/json; charset: UTF-8');
    echo json_encode(['success' => false, 'message' => 'Método no permitido'], JSON_UNESCAPED_UNICODE);
}
?>