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
$usuario = $_SESSION['idUser'];

$sql10 = "TRUNCATE importes_fiscales";
$conection->query($sql10);

if (isset($_FILES["name"]) && !empty($_FILES['name']['name'])) {
    $file_name = $_FILES["name"]['name'];
    $file_tmp = $_FILES['name']['tmp_name'];

    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        // Saltar encabezado
        fgetcsv($handle, 4096, ",", '"', "\\");

        while (($data = fgetcsv($handle, 4096, ",", '"', "\\")) !== FALSE) {
            if (count($data) >= 7) {
                $ok++;
                $noempleado = intval($data[0]) ?? 0;
                $empleado = mysqli_real_escape_string($conection, str_replace(",", "", $data[1]) ?? "");
                $pago_fiscal = floatval(str_replace(',', '', $data[2])) ?? 0;
                $deduccion_fiscal = floatval(str_replace(',', '', $data[3])) ?? 0;
                $neto = floatval(str_replace(',', '', $data[4])) ?? 0;
                $finiquito = mysqli_real_escape_string($conection, $data[5] ?? "");
                $estatus = mysqli_real_escape_string($conection, mb_convert_encoding($data[6], "UTF-8", "ISO-8859-1") ?? "");

                $sql = "INSERT INTO importes_fiscales 
                    (empleado, noempleado, pago_fiscal, deduccion_fiscal, neto, finiquito, estatus, usuario_id)
                    VALUES ('$empleado', $noempleado, $pago_fiscal, $deduccion_fiscal, $neto, '$finiquito', '$estatus', $usuario);";

                if (!$conection->query($sql)) {
                    $error++;
                }
            } else {
                $error++;
            }
        }
        fclose($handle);
    }
} else {
    echo "<script>alert('Error: No se seleccionó archivo.');</script>";
}

echo "<script>
alert('Correcto: $ok registros insertados. Errores: $error');
window.location = './nominas2025.php';
</script>";
?>
