<?php
if ($_POST['action'] == 'iniciarOrden') {
    $id = intval($_POST['id']);
    // var_dump($_POST['id']);

    if ($id > 0) {
        include '../../conexion.php';
        $query = "UPDATE solicitud_mantenimiento SET estatus = 3 WHERE id = $id";
        $result = mysqli_query($conection, $query);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Orden actualizada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar orden']);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido']);
        exit;
    }
}
