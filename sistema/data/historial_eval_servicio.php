<?php 
include '../../conexion.php';
session_start();

header('Content-Type: application/json');

if (!isset($_POST['proveedor'])) {
    echo json_encode(['error' => 'Proveedor no definido']);
    exit;
}

$proveedor = intval($_POST['proveedor']); // sanitizar

// Consulta para contar evaluaciones
$sql = "SELECT COUNT(ideval) AS evaluaciones FROM evaluaciones_servicios WHERE cveproveedor = ?";
$stmt = mysqli_prepare($conection, $sql);
mysqli_stmt_bind_param($stmt, "i", $proveedor);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if ($data['evaluaciones'] > 0) {
    // Consulta para obtener la última evaluación
    $sql2 = "SELECT * FROM evaluaciones_servicios WHERE cveproveedor = ? ORDER BY fecha_eval DESC LIMIT 1";
    $stmt2 = mysqli_prepare($conection, $sql2);
    mysqli_stmt_bind_param($stmt2, "i", $proveedor);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $ultima_eval = mysqli_fetch_assoc($result2);

    echo json_encode([
        'evaluaciones' => $data['evaluaciones'],
        'ultima_evaluacion' => $ultima_eval
    ]);
} else {
    echo json_encode([
        'evaluaciones' => 0,
        'ultima_evaluacion' => null
    ]);
}

mysqli_close($conection);