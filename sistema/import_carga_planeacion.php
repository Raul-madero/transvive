<?php
include "../conexion.php";
session_start();

$conection->set_charset('utf8mb4');
date_default_timezone_set('America/Mexico_City');
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 600);
set_time_limit(600);

if (!isset($_SESSION['idUser'])) {
    die("Error: Sesión no iniciada.");
}

$usuario = $_SESSION['idUser'];
$tipo_viaje = 'Normal';
$valor_vuelta = 0.00;
$fechac = date("Y-m-d");

$conection->query("TRUNCATE tempregistro_viajes");

if (isset($_FILES['name']) && $_FILES['name']['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = basename($_FILES['name']['name']);
    $rutaCarpeta = __DIR__ . "/uploads";
    $rutaDestino = "$rutaCarpeta/$nombreArchivo";

    if (!file_exists($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0755, true);
    }

    if (move_uploaded_file($_FILES['name']['tmp_name'], $rutaDestino)) {
        $ok = $error = 0;
        $errores = [];

        if (($file = fopen($rutaDestino, "r")) !== false) {
            $stmt_ruta = $conection->prepare("SELECT ruta FROM rutas WHERE cliente = ? AND ruta = ? LIMIT 1");
            $stmt_emp  = $conection->prepare("SELECT 1 FROM empleados WHERE CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) = ? AND estatus = 1 LIMIT 1");
            $stmt_ins  = $conection->prepare("INSERT INTO tempregistro_viajes (fecha, cliente, ruta, operador, unidad, tipo_viaje, num_unidad, valor_vuelta, hora_inicio, hora_fin, id_supervisor, jefe_operaciones, usuario_id, usuario_reg, fecha_carga) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $linea = 0;
            while (($line = fgets($file)) !== false) {
                $linea++;
                $line = iconv('Windows-1252', 'UTF-8//IGNORE', $line); //Conversion de caracteres
                $data = explode(",", trim($line));
                if (count($data) < 12) {
                    $errores[] = "Línea $linea: Datos incompletos.";
                    $error++;
                    continue;
                }

                $fcha = str_replace('/', '-', $data[9]);
                $fecha_mysql = date('Y-m-d', strtotime($fcha));
                $nombre = $data[10];

                $stmt_ruta->bind_param("ss", $data[3], $data[8]);
                $stmt_ruta->execute();
                $res_ruta = $stmt_ruta->get_result();

                if ($res_ruta->num_rows === 0) {
                    $errores[] = "Línea $linea: Ruta no encontrada (cliente={$data[3]}, ruta={$data[8]}).";
                    $error++;
                    continue;
                }

                $stmt_emp->bind_param("s", $nombre);
                $stmt_emp->execute();
                $res_emp = $stmt_emp->get_result();

                if ($nombre !== "") {
                    if ($res_emp->num_rows === 0) {
                        $errores[] = "Línea $linea: Operador no válido: '$nombre'.";
                        $error++;
                        continue;
                    }
                }

                $stmt_ins->bind_param(
                    "sssssssdsssssis",
                    $fecha_mysql, $data[3], $data[8], $nombre, $data[6], $tipo_viaje,
                    $data[7], $valor_vuelta, $data[1], $data[2], $data[11], $data[5],
                    $data[11], $usuario, $fechac
                );

                if ($stmt_ins->execute()) {
                    $ok++;
                } else {
                    $errores[] = "Línea $linea: Error al insertar en base de datos.";
                    $error++;
                }
            }
            fclose($file);
            unlink($rutaDestino);

            // Actualizaciones de sueldo/semana
            $updates = [
                "UPDATE tempregistro_viajes SET semana = (SELECT s.semana FROM semanas40 s WHERE tempregistro_viajes.fecha BETWEEN s.dia_inicial AND s.dia_final)",
                "UPDATE tempregistro_viajes op
                INNER JOIN rutas i
                    ON op.cliente = i.cliente
                AND op.ruta = i.ruta
                AND op.unidad = 'CAMION'
                SET op.sueldo_vuelta = i.sueldo_camion
                WHERE i.sueldo_camion > 0",
                "UPDATE tempregistro_viajes op
                INNER JOIN rutas i
                    ON op.cliente = i.cliente
                AND op.ruta = i.ruta
                AND op.unidad = 'CAMIONETA' OR op.unidad = 'SPRINTER'
                SET op.sueldo_vuelta = i.sueldo_camioneta
                WHERE i.sueldo_camioneta > 0"
            ];

            foreach ($updates as $sql) {
                $conection->query($sql);
            }

            // Mostrar resumen y errores
            // Mostrar errores en tabla antes de redirigir
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
        <button class='btn btn-success' onclick=\"window.location='viajes_cargados.php'\">Continuar</button>
    </body>
    </html>";
} else {
    // Si no hay errores, redirige automáticamente
    echo "<script>
        alert('Carga completa: $ok registros procesados sin errores.');
        window.location = './viajes_cargados.php';
    </script>";
}

            // $reporteErrores = "\n\nDetalle de errores:\n" . implode("\n", array_slice($errores, 0, 10));
            // if (count($errores) > 10) {
            //     $reporteErrores .= "\n... y más (" . count($errores) . " errores en total)";
            // }
            // $mensajeFinal = "Carga completa: $ok registros exitosos, $error con errores.$reporteErrores";



            // echo "<script>
            //         alert(" . json_encode($mensajeFinal) . ");
            //         window.location = './viajes_cargados.php';
            //     </script>";

        } else {
            echo "<script>alert('No se pudo abrir el archivo.');</script>";
        }
    } else {
        echo "<script>alert('Error al mover el archivo.');</script>";
    }
} else {
    echo "<script>alert('Archivo inválido o no enviado.');</script>";
}
?>
