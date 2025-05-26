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

        $stmt = $conection->prepare("
            INSERT INTO importes_fiscales 
            (empleado, noempleado, pago_fiscal, deduccion_fiscal, neto, finiquito, estatus, usuario_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if (!$stmt) {
            die("Error al preparar la consulta: " . $conection->error);
        }

        $linea = 1;

        while (($data = fgetcsv($handle, 4096, ",", '"', "\\")) !== false) {
            if (count($data) >= 7) {
                $noempleado = intval($data[0]);
                $empleado_raw = str_replace(",", "", $data[1]);
                $empleado = mb_convert_encoding($empleado_raw, "UTF-8", "ISO-8859-1");
                $pago_fiscal = floatval(str_replace(',', '', $data[2]));
                $deduccion_fiscal = floatval(str_replace(',', '', $data[3]));
                $neto = floatval(str_replace(',', '', $data[4]));
                $finiquito = mb_convert_encoding(trim($data[5]), "UTF-8", "ISO-8859-1")?? ""  ;
                $estatus = mb_convert_encoding(trim($data[6]), "UTF-8", "ISO-8859-1");

                $stmt->bind_param("sidddssi", $empleado, $noempleado, $pago_fiscal, $deduccion_fiscal, $neto, $finiquito, $estatus, $usuario);

                if ($stmt->execute()) {
                    $ok++;
                } else {
                    $error++;
                    $errores[] = [
                        'linea' => $linea,
                        'tipo' => 'SQL',
                        'detalle' => $stmt->error,
                        'datos' => implode(' | ', $data)
                    ];
                }
            } else {
                $error++;
                $errores[] = [
                    'linea' => $linea,
                    'tipo' => 'Formato',
                    'detalle' => 'Número de columnas insuficientes (' . count($data) . ')',
                    'datos' => implode(' | ', $data)
                ];
            }

            $linea++;
        }

        fclose($handle);
        $stmt->close();
    } else {
        $errores[] = ['linea' => '-', 'tipo' => 'Archivo', 'detalle' => 'No se pudo abrir el archivo', 'datos' => ''];
    }
} else {
    $errores[] = ['linea' => '-', 'tipo' => 'Archivo', 'detalle' => 'No se seleccionó un archivo válido', 'datos' => ''];
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
