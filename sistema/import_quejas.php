<?php
include "../conexion.php";
session_start();

$ok = 0;
$error = 0;
$usuario = $_SESSION['idUser'];

if (isset($_FILES["name"]) && !empty($_FILES['name']['name'])) {
    $file_name = $_FILES["name"]['name'];
    $file_tmp = $_FILES['name']['tmp_name'];

    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        mysqli_set_charset($conection, "utf8mb4"); 
        fgetcsv($handle, 409, ","); // Saltar la primera línea (encabezados)

        $sql = "INSERT INTO no_conformidades (no_queja, fecha, mes, cliente, f8d, descripcion, motivo, responsable, supervisor, operador, unidad, ruta, parada, fecha_incidente, turno, procede_ac, porque_procede, analisis_conclusionac, accion, fecha_accion, responsable_accion, fecha_cierre, observaciones, tipo_incidente, estatus, cuenta, causa, afecta, area_responsable, usuario_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conection->prepare($sql);

        while (($data = fgetcsv($handle, 4096)) !== FALSE) {
            if (count($data) >= 6) {
                $ok++;
                $semana = trim(str_replace(array("\r", "\n", "\t"), '', $data[5])); 
                $stmt->bind_param("sssssii", $semana, $data[0], $data[1], $data[2], $data[3], $data[4], $usuario);
                $stmt->execute();
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