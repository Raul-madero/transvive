<?php
session_start();
include('../../conexion.php');
$conection->set_charset('utf8');

if(isset($_GET['noempleado'])) {
    $noempleado = $_GET['noempleado'];

    $sql = "SELECT a *,
                    e.noempleado,
                    CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) AS nombre,
                    FROM detalle-adeudos a
                    LEFT JOIN empleados e ON a.noempleado = e.noempleado
                    WHERE a.noempleado = ?";
    
    $stmt = $conection->prepare($sql);
    $stmt->bind_params(i, $noempleado);
    $stmt->execute();
    $result = $stmt->get_result();

    $datos = [];

    while($row = $result->fetch_assoc()) {
        $datos[] = [
            'noempleado' => $row['noempleado'],
            'nombres' => $row['nombre'],
            'cantidad' => $row['cantidad'],
            'descuento' => $row['descuento'],
            'estado' => $row['estado'],
            'fecha_inicial' => $row['fecha_inicial'],
            'fecha_final' => $row['fecha_final'],
            'motivo_adeudo' => $row['motivo_adeudo'],
            'semanas_totales' => $row['semanas_totales']
        ];
    }

    echo json_encode(["success" => true, "data" => $datos]);

    $stmt->close();
    $conection->close();
}else {
    echo json_encode(["success" => false, "data" => []]);
}