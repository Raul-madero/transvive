<?php
session_start();
include('../../conexion.php');

$conection->set_charset('utf8');

if (isset($_GET['noempleado'])) {
    $noempleado = $_GET['noempleado'];

    $sql = "SELECT a.*, 
                   e.noempleado,
                   CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) AS nombre,
                   m.motivo_adeudo AS motivo_adeudo_nombre
            FROM detalle_adeudos a
            LEFT JOIN empleados e ON a.noempleado = e.noempleado
            LEFT JOIN motivo_adeudo m ON a.motivo_adeudo = m.id
            WHERE a.noempleado = ?";

    // Preparar la consulta y verificar si es válida
    if ($stmt = $conection->prepare($sql)) {
        $stmt->bind_param("i", $noempleado);
        $stmt->execute();
        $result = $stmt->get_result();

        $datos = [];

        while ($row = $result->fetch_assoc()) {
            $datos[] = [
                'noempleado' => $row['noempleado'],
                'nombres' => $row['nombre'],
                'cantidad' => $row['cantidad'],
                'descuento' => $row['descuento'],
                'estado' => $row['estado'],
                'fecha_inicial' => $row['fecha_inicial'],
                'fecha_final' => $row['fecha_final'],
                'motivo_adeudo' => $row['motivo_adeudo_nombre'],
                'semanas_totales' => $row['semanas_totales'],
                'comentarios' => $row['comentarios']
            ];
        }

        echo json_encode(["success" => true, "data" => $datos]);

        $stmt->close();
    } else {
        // Mostrar el error si `prepare()` falla
        echo json_encode(["success" => false, "message" => "Error en la consulta SQL: " . $conection->error]);
    }

    $conection->close();
} else {
    echo json_encode(["success" => false, "message" => "No se recibió un número de empleado válido."]);
}
?>