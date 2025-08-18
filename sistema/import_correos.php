<?php
include "../conexion.php";
session_start();
$conection->set_charset('utf8mb4');
date_default_timezone_set('America/Mexico_City');

if (!isset($_SESSION['idUser'])) {
    die("Error: Sesión no iniciada.");
}

$ok = 0;
$error = 0;
$errores = []; // <-- Aquí guardamos los errores
$usuario = $_SESSION['idUser'];

$conection->query("TRUNCATE importes_fiscales");

if (isset($_FILES["name"]) && is_uploaded_file($_FILES["name"]["tmp_name"])) {
    $file_tmp = $_FILES["name"]["tmp_name"];

    if (($handle = fopen($file_tmp, "r")) !== false) {
        fgetcsv($handle, 4096, ",", '"', "\\"); // Saltar encabezado

            if (count($handle) >= 2) {
                $noempleado = intval($handle[0]);
                $correo = $handle[1];

                $actualizarCorreo = "UPDATE empleados SET correo = ? WHERE noempleado = ?";
                $stmt = $conection->prepare($actualizarCorreo);

                $stmt->bind_param("si", $noempleado, $correo);

                if ($stmt->execute()) {
                    $ok++;
                } else {
                    $error++;
                    $errores[] = [
                        'linea' => $linea,
                        'tipo' => 'SQL',
                        'detalle' => $stmt->error,
                        'datos' => implode(' | ', $handle)
                    ];
                }
            } else {
                $error++;
                $errores[] = [
                    'linea' => $linea,
                    'tipo' => 'Formato',
                    'detalle' => 'Número de columnas insuficientes (' . count($handle) . ')',
                    'datos' => implode(' | ', $handle)
                ];
            }

            $linea++;
        }

        fclose($handle);
        $stmt->close();
    } else {
        $errores[] = ['linea' => '-', 'tipo' => 'Archivo', 'detalle' => 'No se pudo abrir el archivo', 'datos' => ''];
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
