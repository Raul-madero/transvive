<?php
include "../conexion.php";
session_start();
$conection->set_charset('utf8mb4');
date_default_timezone_set('America/Mexico_City');

if (isset($_FILES["name"]) && is_uploaded_file($_FILES["name"]["tmp_name"])) {
    $file_tmp = $_FILES["name"]["tmp_name"];

    if (($handle = fopen($file_tmp, "r")) !== false) {
        // Saltar encabezado
        fgetcsv($handle, 4096, ",", '"', "\\");

        $linea = 2; // comenzamos a contar desde la 2 (después del encabezado)
        $stmt = $conection->prepare("UPDATE empleados SET correo = ? WHERE noempleado = ?");
        if (!$stmt) {
            $errores[] = ['linea' => '-', 'tipo' => 'SQL', 'detalle' => 'No se pudo preparar el UPDATE: ' . $conection->error, 'datos' => ''];
        } else {
            // Bind por referencia (se actualizarán en cada vuelta)
            $correo = '';
            $noempleado = 0;
            $stmt->bind_param("si", $correo, $noempleado);

            // Leer cada fila del CSV
            while (($row = fgetcsv($handle, 4096, ",", '"', "\\")) !== false) {
                // Validar número de columnas
                if (count($row) < 2) {
                    $error++;
                    $errores[] = [
                        'linea'  => $linea,
                        'tipo'   => 'Formato',
                        'detalle'=> 'Número de columnas insuficientes (' . count($row) . ')',
                        'datos'  => implode(' | ', $row)
                    ];
                    $linea++;
                    continue;
                }

                // Mapear: data[0] = noempleado, data[1] = correo
                $noempleado = is_numeric($row[0]) ? (int)$row[0] : 0;
                $correo     = trim((string)$row[1]);

                // Validaciones básicas
                if ($noempleado <= 0) {
                    $error++;
                    $errores[] = [
                        'linea'  => $linea,
                        'tipo'   => 'Dato',
                        'detalle'=> 'noempleado inválido',
                        'datos'  => implode(' | ', $row)
                    ];
                    $linea++;
                    continue;
                }

                if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    // Si quieres permitir correos no válidos, quita esta validación
                    $error++;
                    $errores[] = [
                        'linea'  => $linea,
                        'tipo'   => 'Dato',
                        'detalle'=> 'correo vacío o inválido',
                        'datos'  => implode(' | ', $row)
                    ];
                    $linea++;
                    continue;
                }

                // Ejecutar UPDATE
                if ($stmt->execute()) {
                    $ok++;
                } else {
                    $error++;
                    $errores[] = [
                        'linea'  => $linea,
                        'tipo'   => 'SQL',
                        'detalle'=> $stmt->error,
                        'datos'  => implode(' | ', $row)
                    ];
                }

                $linea++;
            }

            $stmt->close();
        }

        fclose($handle);
    } else {
        $errores[] = ['linea' => '-', 'tipo' => 'Archivo', 'detalle' => 'No se pudo abrir el archivo', 'datos' => ''];
    }
} else {
    $errores[] = ['linea' => '-', 'tipo' => 'Archivo', 'detalle' => 'No se recibió archivo válido', 'datos' => ''];
}

// (Opcional) Resumen
echo "Actualizados OK: {$ok}<br>Con error: {$error}<br>";
if (!empty($errores)) {
    echo "<pre>" . htmlspecialchars(print_r($errores, true), ENT_QUOTES, 'UTF-8') . "</pre>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de carga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Resultado de la Carga de Importes Fiscales</h2>
        <div class="alert alert-info">
            ✅ <strong><?php echo $ok; ?></strong> registros insertados correctamente.<br>
            ⚠️ <strong><?php echo $error; ?></strong> errores detectados.
        </div>

        <?php if (!empty($errores)): ?>
            <h4 class="mt-4">Detalle de errores:</h4>
            <table class="table table-bordered table-sm table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th># Línea</th>
                        <th>Tipo de Error</th>
                        <th>Detalle</th>
                        <th>Datos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($errores as $e): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($e['linea']); ?></td>
                            <td><?php echo htmlspecialchars($e['tipo']); ?></td>
                            <td><?php echo htmlspecialchars($e['detalle']); ?></td>
                            <td><?php echo htmlspecialchars($e['datos']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="mt-4">
            <a href="./nominas2025.php" class="btn btn-primary">← Volver</a>
        </div>
    </div>
</body>
</html>
