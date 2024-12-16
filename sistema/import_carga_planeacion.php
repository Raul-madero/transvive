<?php
include "../conexion.php";
include "class.upload.php";
session_start();

$usuario = $_SESSION['idUser'] ?? null;

// Validar sesión
if (!$usuario) {
    echo "<script>
            alert('Sesión no válida.');
            window.location = './login.php';
          </script>";
    exit;
}

$sql = "TRUNCATE tempregistro_viajes";
if (!$conection->query($sql)) {
    die("Error al limpiar la tabla: " . $conection->error);
}

$tipo_viaje = 'Normal';
$valor_vuelta = "Completa";
date_default_timezone_set('America/Mexico_City');
$fechac = date("Y-m-d");

// Verificar si el archivo fue cargado
if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $up = new Upload($_FILES["file"]);
    if ($up->uploaded) {
        $up->Process("./");
        if ($up->processed) {
            $file_path = "./" . $up->file_dst_name;
            if ($file = fopen($file_path, "r")) {
                $ok = 0;
                $error = 0;

                while ($line = fgets($file, 4096)) {
                    $data = explode(",", $line);

                    // Validar estructura mínima
                    if (count($data) >= 12) {
                        $ok++;
                        
                        $fecha_original = str_replace('/', '-', $data[9]);
                        $fecha_mysql = date('Y-m-d', strtotime($fecha_original));
                        $nombre = utf8_encode(trim($data[10])); // Evitar espacios en blanco

                        $query = $conection->prepare(
                            "INSERT INTO tempregistro_viajes 
                            (fecha, cliente, ruta, operador, unidad, tipo_viaje, num_unidad, valor_vuelta, hora_inicio, hora_fin, id_supervisor, jefe_operaciones, usuario_id, usuario_reg, fecha_carga) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                        );

                        $query->bind_param(
                            "sssssssssssssss",
                            $fecha_mysql,
                            $data[3], // cliente
                            $data[8], // ruta
                            $nombre,  // operador
                            $data[6], // unidad
                            $tipo_viaje,
                            $data[7], // num_unidad
                            $valor_vuelta,
                            $data[1], // hora_inicio
                            $data[2], // hora_fin
                            $data[11], // id_supervisor
                            $data[5],  // jefe_operaciones
                            $data[11], // usuario_id
                            $usuario,
                            $fechac
                        );

                        if (!$query->execute()) {
                            $error++;
                        }
                    } else {
                        $error++;
                    }
                }

                fclose($file);
                unlink($file_path); // Eliminar archivo
            }
        }
    }
}

// Actualizar los datos procesados en la base de datos
$updates = [
    "UPDATE tempregistro_viajes SET semana = (SELECT semanas40.semana FROM semanas40 WHERE tempregistro_viajes.fecha BETWEEN semanas40.dia_inicial AND semanas40.dia_final)",
    "UPDATE tempregistro_viajes op
     INNER JOIN (SELECT cliente, ruta, sueldo_camion AS sumu FROM rutas WHERE sueldo_camion > 0) i 
     ON op.cliente = i.cliente AND op.ruta = i.ruta
     SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Camion'",
    "UPDATE tempregistro_viajes op
     INNER JOIN (SELECT cliente, ruta, sueldo_camioneta AS sumu FROM rutas WHERE sueldo_camioneta > 0) i 
     ON op.cliente = i.cliente AND op.ruta = i.ruta
     SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Camioneta'",
    "UPDATE tempregistro_viajes op
     INNER JOIN (SELECT nombres, apellido_paterno, apellido_materno, sueldo AS sumu FROM empleados) i 
     ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno)
     SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Camion' AND op.sueldo_vuelta = 0",
    "UPDATE tempregistro_viajes op
     INNER JOIN (SELECT nombres, apellido_paterno, apellido_materno, sueldo_camioneta AS sumu FROM empleados) i 
     ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno)
     SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Camioneta' AND op.sueldo_vuelta = 0",
    "UPDATE tempregistro_viajes op
     INNER JOIN (SELECT nombres, apellido_paterno, apellido_materno, sueldo_sprinter AS sumu FROM empleados) i 
     ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno)
     SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Sprinter' AND op.sueldo_vuelta = 0"
];

foreach ($updates as $sql) {
    if (!$conection->query($sql)) {
        echo "Error ejecutando consulta: " . $conection->error;
    }
}

// Notificación final
echo "<script>
        alert('Registros procesados: Correctos $ok, Errores $error.');
        window.location = './viajes_cargados.php';
      </script>";
?>
