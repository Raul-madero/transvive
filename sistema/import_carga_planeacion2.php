<?php
set_time_limit(600); // permite hasta 5 minutos de ejecución
include "../conexion.php";
session_start();

date_default_timezone_set('America/Mexico_City');

// Función para registrar errores en archivo
function log_error($mensaje)
{
    file_put_contents("log_errores.txt", "[" . date("Y-m-d H:i:s") . "] " . $mensaje . PHP_EOL, FILE_APPEND);
}

// Validar sesión activa
if (!isset($_SESSION['idUser'])) {
    die("Error: Sesión no iniciada.");
}

$usuario = $_SESSION['idUser'];
$tipo_viaje = 'Normal';
$valor_vuelta = 0.00;
$fechac = date("Y-m-d");

// Limpiar tabla temporal
if (!$conection->query("TRUNCATE tempregistro_viajes")) {
    log_error("Error al limpiar tabla temporal: " . $conection->error);
    die("Error al limpiar la tabla temporal.");
}

// Validar archivo cargado
if (!isset($_FILES['name']) || $_FILES['name']['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($_FILES['name']['tmp_name'])) {
    echo "<script>alert('No se cargó ningún archivo válido.');</script>";
    exit;
}

// Validar extensión y MIME
$allowed_extensions = ['csv', 'txt'];
$uploaded_name = $_FILES['name']['name'];
$uploaded_tmp = $_FILES['name']['tmp_name'];
$extension = strtolower(pathinfo($uploaded_name, PATHINFO_EXTENSION));

if (!in_array($extension, $allowed_extensions)) {
    echo "<script>alert('Formato no permitido. Solo CSV o TXT.');</script>";
    exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $uploaded_tmp);
finfo_close($finfo);

$allowed_mimes = ['text/plain', 'text/csv', 'application/vnd.ms-excel'];
if (!in_array($mime_type, $allowed_mimes)) {
    echo "<script>alert('Tipo de archivo no válido ($mime_type)');</script>";
    exit;
}

// Guardar archivo en carpeta local
$target_path = './uploads/';
if (!file_exists($target_path)) {
    mkdir($target_path, 0777, true);
}
$new_filename = uniqid("viajes_") . '.' . $extension;
$file_path = $target_path . $new_filename;

if (!move_uploaded_file($uploaded_tmp, $file_path)) {
    echo "<script>alert('Error al mover el archivo al servidor.');</script>";
    exit;
}

// Procesar archivo
$ok = 0;
$error = 0;
$duplicados = 0;

if (($file = fopen($file_path, "r")) !== false) {
    while (($line = fgets($file)) !== false) {
        $data = array_map('trim', explode(",", $line));

        if (count($data) < 12) {
            $error++;
            continue;
        }

        // Validar fecha
        $fcha = str_replace('/', '-', $data[10]);
        $fecha = date_create_from_format('d-m-Y', $fcha);
        $semana = $fecha->format('W');

        if (!$fecha) {
            log_error("Fecha inválida: {$fecha}");
            $error++;
            continue;
        }
        $fecha_mysql = $fecha->format('Y-m-d');
        $nombre = $data[11];

        // Verificar duplicados
        $verificar_sql = $conection->prepare("SELECT COUNT(*) FROM tempregistro_viajes WHERE fecha = ? AND cliente = ? AND operador = ? AND ruta = ? AND hora_inicio = ?");
        $verificar_sql->bind_param("sssss", $fecha_mysql, $data[3], $nombre, $data[8], $data[1]);
        $verificar_sql->execute();
        $verificar_sql->bind_result($count);
        $verificar_sql->fetch();
        $verificar_sql->close();

        if ($count > 0) {
            $duplicados++;
            continue;
        }

        // Insertar registro
        $stmt = $conection->prepare("INSERT INTO tempregistro_viajes (
            fecha, semana, cliente, ruta, operador, unidad, tipo_viaje, num_unidad,
            valor_vuelta, hora_inicio, hora_fin, id_supervisor, jefe_operaciones,
            usuario_id, usuario_reg, fecha_carga
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param(
                "ssssssssdsssiiis",
                $fecha_mysql,
                $semana,
                $data[3],
                $data[8],
                $nombre,
                $data[6],
                $tipo_viaje,
                $data[7],
                $valor_vuelta,
                $data[1],
                $data[2],
                $data[12],
                $data[5],
                $data[12],
                $usuario,
                $fechac
            );

            if ($stmt->execute()) {
                $ok++;
            } else {
                log_error("Error al insertar: " . $stmt->error);
                $error++;
            }
            $stmt->close();
        } else {
            log_error("Error al preparar statement: " . $conection->error);
            $error++;
        }
    }

    fclose($file);
    unlink($file_path); // Eliminar archivo tras procesar

    // Actualizaciones SQL
    $updates = [
        "UPDATE tempregistro_viajes SET semana = (
            SELECT semanas40.semana FROM semanas40 
            WHERE tempregistro_viajes.fecha BETWEEN semanas40.dia_inicial AND semanas40.dia_final
        )",
        "UPDATE tempregistro_viajes op
         INNER JOIN (SELECT cliente, ruta, sueldo_camion AS sumu FROM rutas WHERE sueldo_camion > 0) i
         ON op.cliente = i.cliente
         SET op.sueldo_vuelta = i.sumu
         WHERE op.ruta = i.ruta AND op.unidad = 'Camion'",
        "UPDATE tempregistro_viajes op
         INNER JOIN (SELECT cliente, ruta, sueldo_camioneta AS sumu FROM rutas WHERE sueldo_camioneta > 0) i
         ON op.cliente = i.cliente
         SET op.sueldo_vuelta = i.sumu
         WHERE op.ruta = i.ruta AND op.unidad = 'Camioneta'"
    ];

    foreach ($updates as $sql) {
        if (!$conection->query($sql)) {
            log_error("Error en actualización: " . $conection->error);
        }
    }

    // Mostrar resumen en HTML
    echo "
    <html>
    <head><meta charset='utf-8'><title>Resultado de la carga</title></head>
    <body style='font-family: Arial; padding: 20px;'>
        <h2>✅ Carga finalizada</h2>
        <ul>
            <li><strong>Registros exitosos:</strong> $ok</li>
            <li><strong>Errores:</strong> $error</li>
            <li><strong>Duplicados omitidos:</strong> $duplicados</li>
        </ul>
        <p><a href='./viajes_cargados.php'>🔙 Ver registros cargados</a></p>
    </body>
    </html>";
} else {
    log_error("No se pudo abrir el archivo: $file_path");
    echo "<script>alert('Error al abrir el archivo para lectura.');</script>";
}
