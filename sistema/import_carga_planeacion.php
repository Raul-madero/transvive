<?php
include "../conexion.php";
include "class.upload.php";
session_start();

// Validar sesión activa
if (!isset($_SESSION['idUser'])) {
    die("Error: Sesión no iniciada.");
}

$usuario = $_SESSION['idUser'];

// Limpiar tabla temporal
$sql = "TRUNCATE tempregistro_viajes";
if (!$conection->query($sql)) {
    die("Error al limpiar la tabla temporal.");
}
$tipo_viaje = 'Normal';
$valor_vuelta = 0.00;
date_default_timezone_set('America/Mexico_City');
$fechac = date("Y-m-d");

// Verificar si se ha cargado un archivo
if (isset($_FILES['name']) && $_FILES['name']['error'] === UPLOAD_ERR_OK) {
    $up = new Upload($_FILES['name']);

    if ($up->uploaded) {
        $up->Process("./");
    

        if ($up->processed) {
            $file_path = "./" . $up->file_dst_name;

            if ($file = fopen($file_path, "r")) {
                $ok = 0;
                $error = 0;

                // Leer archivo línea por línea
                while ($line = fgets($file, 4096)) {
                    $data = explode(",", trim($line)); // Eliminar saltos de línea
                    

                    if (count($data) >= 12) {
                        // Procesar los datos
                        $fcha = str_replace('/', '-', $data[9]);
                        $fecha_mysql = date('Y-m-d', strtotime($fcha));
                        $nombre = utf8_encode($data[10]);

                        // Insertar en la base de datos
                        $sql_insert = "INSERT INTO tempregistro_viajes 
                        (fecha, cliente, ruta, operador, unidad, tipo_viaje, num_unidad, valor_vuelta, hora_inicio, hora_fin, id_supervisor, jefe_operaciones, usuario_id, usuario_reg, fecha_carga) 
                        VALUES 
                        ('$fecha_mysql', '$data[3]', '$data[8]', '$nombre', '$data[6]', '$tipo_viaje', '$data[7]', '$valor_vuelta', '$data[1]', '$data[2]', '$data[11]', '$data[5]', '$data[11]', '$usuario', '$fechac')";

                        if ($conection->error) {
                            $error++;
                        }else {
                            $ok++;
                        }
                        
                        if (!$conection->query($sql_insert)) {
                            echo "<script> alert('Error en la inserción SQL: {$conection->error}'); </script>";
                        }
                    }
                }

                fclose($file);
                unlink($file_path);

                // Actualizaciones en la tabla
                $updates = [
                    "UPDATE tempregistro_viajes SET semana = (SELECT semanas40.semana FROM semanas40 WHERE tempregistro_viajes.fecha BETWEEN semanas40.dia_inicial AND semanas40.dia_final)",
                    "UPDATE tempregistro_viajes op 
                     INNER JOIN (SELECT cliente, ruta, sueldo_camion AS sumu FROM rutas WHERE sueldo_camion > 0) i 
                     ON op.cliente = i.cliente 
                     SET op.sueldo_vuelta = i.sumu WHERE op.ruta = i.ruta AND op.unidad = 'Camion'",
                    "UPDATE tempregistro_viajes op 
                     INNER JOIN (SELECT cliente, ruta, sueldo_camioneta AS sumu FROM rutas WHERE sueldo_camioneta > 0) i 
                     ON op.cliente = i.cliente 
                     SET op.sueldo_vuelta = i.sumu WHERE op.ruta = i.ruta AND op.unidad = 'Camioneta'",
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
                        echo "<script> alert('Error en actualización SQL: {$conection->error}'); </script>";
                    }
                }

                echo "<script>
                alert('Correcto: $ok registros procesados, $error errores.');
                window.location = './viajes_cargados.php';
                </script>";
            } else {
                echo "<script> alert('Error al abrir el archivo.'); </script>";
            }
        }
    }
} else {
    echo "<script> alert('No se cargó ningún archivo.'); </script>";
}

?>
