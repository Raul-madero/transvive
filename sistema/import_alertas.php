<?php
include "../conexion.php";
session_start();

$ok = 0;
$error = 0;
$usuario = $_SESSION['idUser'];
$currentYear = (int)date('Y');
$currentDate = date('Y-m-d');

// helper para parsear fechas en varios formatos comunes
function parseFechaFlexible($str) {
    $str = trim($str);
    if ($str === '') return null;

    $formatos = ['Y-m-d','d/m/Y','d-m-Y','Y/m/d','m/d/Y','m-d-Y'];
    foreach ($formatos as $fmt) {
        $dt = DateTime::createFromFormat($fmt, $str);
        // validar coincidencia exacta del formato
        if ($dt && $dt->format($fmt) === $str) {
            return $dt;
        }
    }
    return null;
}

if (isset($_FILES["name"]) && !empty($_FILES['name']['name'])) {
    $file_name = $_FILES["name"]['name'];
    $file_tmp = $_FILES['name']['tmp_name'];

        if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        mysqli_set_charset($conection, "utf8mb4"); 
        fgetcsv($handle, 4096, ","); // Saltar la primera línea (encabezados)
        $data = fgetcsv($handle, 4096); // Leer la primera línea de datos

        if ($data !== FALSE && count($data) >= 1) {
            $semana = $data[0];
            $existsStmt = $conection->prepare("SELECT 1 FROM alertas WHERE semana = ? AND YEAR(fecha) = ? LIMIT 1");
            $existsStmt->bind_param("si", $semana, $currentYear);
            $existsStmt->execute();
            $result = $existsStmt->get_result();
            if ($result->num_rows > 0) {
                // Ya existen registros para esa semana y año
                echo "<script>
                    alert('Ya existen alertas cargadas para la semana " . htmlspecialchars($semana) . " del año $currentYear');
                    window.location = './alertas.php';
                </script>";
                fclose($handle);
                exit;
            }
            $existsStmt->close();

            // Si no existen, proceder a insertar todos los registros
            $sql = "INSERT INTO alertas (fecha, semana, unidad, operador, noalertas, velocidad, limite, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conection->prepare($sql);
            while ($data !== FALSE) {
                if (count($data) >= 6) {
                    $stmt->bind_param("ssssssii", $currentDate, $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $usuario);
                    if ($stmt->execute()) {
                        $ok++;
                    }
                } else {
                    $error++;
                }
                $data = fgetcsv($handle, 4096);
            }
            $stmt->close();
            fclose($handle);
        } else {
            fclose($handle);
            echo "<script>
                alert('El archivo no contiene datos válidos.');
                window.location = './alertas.php';
            </script>";
            exit;
        }
    }

    echo "<script>
        alert('Correcto $ok, Error $error !!!');
        window.location = './alertas.php';
    </script>";
}
?>