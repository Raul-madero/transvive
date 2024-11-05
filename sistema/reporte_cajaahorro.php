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
    e.nombres, 
    e.noempleado, 
    e.apellido_paterno, 
    e.apellido_materno,
    IFNULL(e.caja_ahorro, 0) AS total_saldo,
    pa.total_pagos,
    pa.numero_movimientos -- Nuevo campo que cuenta el número de movimientos en el campo `caja`
FROM 
    empleados e
LEFT JOIN 
    (SELECT 
        no_empleado, 
        SUM(caja) AS total_pagos, 
        COUNT(CASE WHEN caja <> 0 THEN 1 END) AS numero_movimientos, -- Contar el número de nóminas con movimientos en `caja`
        yearpago
     FROM detalle_nomina 
     GROUP BY no_empleado, yearpago) pa ON e.noempleado = pa.no_empleado
WHERE 
    e.noempleado BETWEEN :empleado_id_inicio AND :empleado_id_fin
    AND pa.yearpago = :year 
    AND pa.total_pagos > 0
GROUP BY 
    e.noempleado; ;
    ");
   $stmt->execute([
    'empleado_id_inicio' => $empleado_id_inicio,
    'empleado_id_fin' => $empleado_id_fin,
    'year' => $year
]);
    $resumenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar una segunda consulta para obtener el detalle de pagos
    $detalleStmt = $pdo->prepare("
        SELECT no_semana, caja
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
    <title>Estado de Cuenta - Caja de Ahorro</title>
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
        .payments table {
    width: 100%;
    border-collapse: collapse;
}

.payments table th,
.payments table td {
    padding: 10px;
    text-align: left;
    font-size: 14px;
}

.payments table th {
    background-color: #3498db;
    color: white;
    border-bottom: 2px solid #ecf0f1; /* Borde inferior para el encabezado */
}

.payments table td {
    background-color: #ecf0f1;
    border-bottom: 1px solid #ecf0f1; /* Borde inferior para las filas */
}

/* Eliminar borde derecho de las celdas Fecha */
.payments table td:nth-child(2n-1) {
    border-right: none;
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
            <h2>Estado de Cuenta Caja de Ahorro</h2>

            <div class="summary">
                <p><strong>Empleado:</strong> <?php echo $resumen['nombres']. ' '. $resumen['apellido_paterno']. ' '. $resumen['apellido_materno'] ; ?></p>
                <p><strong>Descuento Autorizado:</strong> $<?php echo number_format($resumen['total_saldo'], 2); ?></p>
                <p><strong>No. de Nominas:</strong> <?php echo number_format($resumen['numero_movimientos'], 0); ?></p>
                <p><strong>Total Acumullado:</strong> $<?php echo number_format($resumen['total_pagos'], 2); ?></p>
            </div>

            <div class="payments">
              <h3>Desglose de Caja de Ahorro</h3>
             <table>
               <thead>
               <tr>
                 <th>Fecha</th>
                 <th>Monto</th>
                 <th>Fecha</th>
                 <th>Monto</th>
                 <th>Fecha</th>
                 <th>Monto</th>
               </tr>
              </thead>
            <tbody>
            <?php
            // Ejecutar la consulta para obtener el detalle de pagos para el empleado actual
            $detalleStmt->execute(['empleado_id' => $resumen['noempleado']]);
            $pagos = $detalleStmt->fetchAll(PDO::FETCH_ASSOC);

            // Dividir los pagos en 3 columnas
            $columnas = array_chunk($pagos, ceil(count($pagos) / 3));
            
            // Máximo número de filas que necesitaremos
            $maxFilas = max(array_map('count', $columnas));
            
            // Iterar por el número máximo de filas
            for ($i = 0; $i < $maxFilas; $i++) {
                echo '<tr>';
                for ($j = 0; $j < 3; $j++) {
                    if (isset($columnas[$j][$i])) {
                        echo '<td>' . $columnas[$j][$i]['no_semana'] . '</td>';
                        echo '<td>$' . number_format($columnas[$j][$i]['caja'], 2) . '</td>';
                    } else {
                        echo '<td></td><td></td>';
                    }
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

            <p class="total">Total Acumulado: $<?php echo number_format($resumen['total_pagos'], 2); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
