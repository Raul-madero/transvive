<?php
include "../conexion.php";
include "class.upload.php";
session_start();

$usuario = $_SESSION['idUser'];

if (isset($_FILES["name"])) {
    $up = new Upload($_FILES["name"]);
    if ($up->uploaded) {
        $up->Process("./");
        if ($up->processed) {

            $ok = 0;
            $error = 0;

            if ($file = fopen("./" . $up->file_dst_name, "r")) {
                while ($x = fgets($file, 4096)) {
                    $data = explode(",", $x);
                    if (count($data) >= 6) {
                        
                        $semana = trim(str_replace(array("\r", "\n", "\t"), '', $data[5])); // Limpiar la columna 'semana'
                        $sql = "INSERT INTO alertas (semana, unidad, operador, noalertas, velocidad, limite, user_id) 
                                VALUES ('$semana', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$usuario')";
								echo $sql;
								exit;
                        if ($conection->query($sql)) {
							$ok++;
                            
                        } else {
                            // Si la inserción falló, registra el error o muestra un mensaje de error
                            $error++;
                        }
                    } else {
                        $error++;
                    }
                }
            }

            fclose($file);
            unlink("./" . $up->file_dst_name);
        }
    }
}

echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './alertas.php';
</script>";
?>