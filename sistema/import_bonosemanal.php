<?php
include '../conexion.php';
session_start();

$conection->set_charset('utf8mb4');
date_default_timezone_set('America/Mexico_City');
if (!isset($_SESSION['idUser'])) {
    die("Error: Sesión no iniciada.");
}

$usuario = $_SESSION['idUser'];
// Vaciar el contenido de los bonos de categoria
$conection->query("UPDATE empleados SET bono_categoria = 0");

// Verificar si se ha enviado un archivo
if (isset($_FILES['name']) && $_FILES['name']['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = basename($_FILES['name']['name']);
    $rutaCarpeta = __DIR__ . "/uploads";
    $rutaDestino = "$rutaCarpeta/$nombreArchivo";

    // Crear carpeta si no existe
    if (!file_exists($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0755, true);
    }

    // Mover el archivo subido a la carpeta de destino
    if (move_uploaded_file($_FILES['name']['tmp_name'], $rutaDestino)) {
        $ok = $error = 0;
        $errores = [];

        // Abrir el archivo CSV
        if (($file = fopen($rutaDestino, "r")) !== false) {
            $stmt_emp = $conection->prepare("SELECT 1 FROM empleados WHERE noempleado = ? AND estatus = 1 LIMIT 1");
            $stmt_ins = $conection->prepare("UPDATE empleados SET bono_categoria = 600 WHERE noempleado = ?");

            fgets($file); // Saltar la primera línea (cabecera)

            while (($line = fgets($file)) !== false) {
                $line = iconv('Windows-1252', 'UTF-8//IGNORE', $line); // Conversión de caracteres
                $data = explode(",", trim($line));
                // var_dump($data);
                // exit;
                
                if (count($data) < 1) {
                    $errores[] = "Datos incompletos en la línea: " . htmlspecialchars($line);
                    $error++;
                    continue;
                }

                $empleado = intval($data[0]);
                
                // Verificar si el empleado existe
                $stmt_emp->bind_param("i", $empleado);
                $stmt_emp->execute();
                if ($stmt_emp->get_result()->num_rows === 0) {
                    $errores[] = "Empleado no encontrado: " . htmlspecialchars($empleado);
                    $error++;
                    continue;
                }

                // Insertar el bono semanal
                $stmt_ins->bind_param("i", $empleado);
                if ($stmt_ins->execute()) {
                    $ok++;
                } else {
                    $errores[] = "Error al insertar bono para el empleado: " . htmlspecialchars($empleado);
                    $error++;
                }
            }
            fclose($file);
        } else {
            $errores[] = "Error al abrir el archivo CSV.";
            $error++;
        }

        // Eliminar el archivo subido
        unlink($rutaDestino);
    } else {
        $errores[] = "Error al mover el archivo subido.";
        $error++;
    }
} else {
    $errores[] = "No se ha enviado un archivo válido.";
    $error++;
}

if (count($errores) > 0) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Reporte de Errores</title>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <style>
            body { padding: 20px; }
            table { font-size: 14px; }
        </style>
    </head>
    <body>
        <h3>Resumen de carga</h3>
        <p><strong>Registros correctos:</strong> $ok</p>
        <p><strong>Errores:</strong> $error</p>
        <div class='table-responsive'>
            <table class='table table-bordered table-sm'>
                <thead class='thead-dark'>
                    <tr><th>#</th><th>Detalle del error</th></tr>
                </thead>
                <tbody>";
    foreach ($errores as $i => $err) {
        echo "<tr><td>" . ($i + 1) . "</td><td>" . htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . "</td></tr>";
    }
    echo "    </tbody>
            </table>
        </div>
        <button class='btn btn-success' onclick=\"window.location='empleados.php'\">Continuar</button>
    </body>
    </html>";
} else {
    // Si no hay errores, redirige automáticamente
    echo "<script>
        alert('Carga completa: $ok registros procesados sin errores.');
        window.location = './empleados.php';
    </script>";
}

// Mostrar resultados
// if ($ok > 0) {
//     echo "Se han importado correctamente $ok bonos semanales.";
// }
// if ($error > 0) {
//     echo "Se han encontrado $error errores durante la importación:";
//     foreach ($errores as $error) {
//         echo "<br>- " . htmlspecialchars($error);
//     }
// }
