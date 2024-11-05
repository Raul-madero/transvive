<?php
$empleado_id_inicio = isset($_POST['empleado_inicio']) ? $_POST['empleado_inicio'] : 1; // Valor por defecto
$empleado_id_fin = isset($_POST['empleado_fin']) ? $_POST['empleado_fin'] : 10; // Valor por defecto
$year = $_POST['year']; // Recibir el año
$dsn = 'mysql:host=localhost;dbname=transvive;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el resumen de préstamos y pagos para un rango de empleados
    $stmt = $pdo->prepare("
        SELECT 
            e.id,
            e.nombres, e.noempleado, e.apellido_paterno, e.apellido_materno,
            pr.total_prestamos,
            IFNULL(pa.total_pagos, 0) AS total_pagos,
            (pr.total_prestamos - IFNULL(pa.total_pagos, 0)) AS saldo_pendiente
        FROM 
            empleados e
        INNER JOIN 
            (SELECT empleado_no, SUM(monto_total) AS total_prestamos, fecha_prestamo 
             FROM prestamos 
             GROUP BY empleado_no) pr ON e.noempleado = pr.empleado_no
        LEFT JOIN 
            (SELECT no_empleado, SUM(descuento_adeudo) AS total_pagos 
             FROM detalle_nomina 
             GROUP BY no_empleado) pa ON e.noempleado = pa.no_empleado
        WHERE e.noempleado BETWEEN :empleado_id_inicio AND :empleado_id_fin
    AND YEAR(pr.fecha_prestamo) = :year
    GROUP BY pr.empleado_no ;
    ");
   $stmt->execute([
    'empleado_id_inicio' => $empleado_id_inicio,
    'empleado_id_fin' => $empleado_id_fin,
    'year' => $year
]);
    $resumenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar una segunda consulta para obtener el detalle de pagos
    $detalleStmt = $pdo->prepare("
        SELECT no_semana, descuento_adeudo
        FROM detalle_nomina
        WHERE no_empleado = :empleado_id
        ORDER BY no_semana;
    ");

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta - SAP Fiori Style</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 20px;
            color: #34495e;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .summary {
            margin-bottom: 20px;
        }
        .summary p {
            margin: 5px 0;
            font-size: 16px;
        }
        .summary p strong {
            font-weight: 500;
        }
        .payments {
            border-top: 1px solid #ecf0f1;
            padding-top: 20px;
        }
        .payments table {
            width: 100%;
            border-collapse: collapse;
        }
        .payments table th,
        .payments table td {
            padding: 10px;
            border-bottom: 1px solid #ecf0f1;
            text-align: left;
            font-size: 14px;
        }
        .payments table th {
            background-color: #3498db;
            color: white;
        }
        .payments table td {
            background-color: #ecf0f1;
        }
        .total {
            font-weight: 700;
            text-align: right;
            margin-top: 10px;
            color: #e74c3c;
        }
        .employee-section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <?php foreach ($resumenes as $resumen): ?>
        <div class="container employee-section">
            <h2>Estado de Cuenta</h2>

            <div class="summary">
                <p><strong>Empleado:</strong> <?php echo $resumen['nombres']. ' '. $resumen['apellido_paterno'] ; ?></p>
                <p><strong>Total Préstamos:</strong> $<?php echo number_format($resumen['total_prestamos'], 2); ?></p>
                <p><strong>Total Pagos:</strong> $<?php echo number_format($resumen['total_pagos'], 2); ?></p>
                <p><strong>Saldo Pendiente:</strong> $<?php echo number_format($resumen['saldo_pendiente'], 2); ?></p>
            </div>

            <div class="payments">
                <h3>Desglose de Pagos</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Ejecutar la segunda consulta para obtener el detalle de pagos para el empleado actual
                        $detalleStmt->execute(['empleado_id' => $resumen['noempleado']]);
                        $pagos = $detalleStmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($pagos as $pago): ?>
                            <tr>
                                <td><?php echo $pago['no_semana']; ?></td>
                                <td>$<?php echo number_format($pago['descuento_adeudo'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <p class="total">Saldo Pendiente: $<?php echo number_format($resumen['saldo_pendiente'], 2); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
