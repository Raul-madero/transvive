<?php
include('../../conexion.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($id > 0) {
        $stmt = $conection->prepare("DELETE FROM prospectos WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al eliminar el prospecto.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'ID inválido.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}

$conection->close();
?>