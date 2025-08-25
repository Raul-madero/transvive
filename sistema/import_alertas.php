<?php
include "../conexion.php";
session_start();

$ok = 0;
$error = 0;
$usuario = $_SESSION['idUser'];
$currentYear = (int)date('Y');

$existsStmt = $conection->prepare("
    SELECT 1
    FROM tu_tabla
    WHERE semana = ? AND YEAR(fecha) = ? AND operador = ?
    LIMIT 1
");

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
        fgetcsv($handle, 409, ","); // Saltar la primera línea (encabezados)

        $sql = "INSERT INTO alertas (semana, unidad, operador, noalertas, velocidad, limite, user_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conection->prepare($sql);

        while (($data = fgetcsv($handle, 4096)) !== FALSE) {
            if (count($data) >= 6) {
                // 3) (OPCIONAL) Evitar duplicados por semana + año(fecha)
                //    Descomenta si quieres saltar inserciones repetidas
                $stmt->bind_param('sis', $data[0], $currentYear, $data[2]);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    // Ya hay registros para esa semana en el año actual
                    // decide si quieres: continue;  // saltar
                    // o antes borrar/update, según tu lógica
                    continue;
                }
                    
                $stmt->bind_param("sssssii", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $usuario);
                if($stmt->execute()) {
                    $ok++;
                }
            } else {
                $error++;
            }
        }

        $stmt->close();
        fclose($handle);
    }

    echo "<script>
        alert('Correcto $ok, Error $error !!!');
        window.location = './alertas.php';
    </script>";
}
?>