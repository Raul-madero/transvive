<?php
include "../conexion.php";
// include "class.upload.php";
session_start();
$ok = 0;
$error = 0;
$usuario = $_SESSION['idUser'];

$sql10 = "TRUNCATE importes_fiscales";
$conection->query($sql10);

$carga_error = "";
if(isset($_FILES["name"]) && !empty($_FILES['name']['name'])){
	$file_name = $_FILES["name"]['name'];
	$file_tmp = $_FILES['name']['tmp_name'];

	if(($handle = fopen($file_tmp, "r")) !== FALSE) {

		$ok = 0;
		$error = 0;
		fgetcsv($handle, 409, ",");
		mysqli_set_charset($conection, "utf8mb4");
		
		while(($data = fgetcsv($handle, 4096))){
			if(count($data)>=6){
				var_dump($data);
				$ok++;
				$noempleado = intval($data[0]) ?? 0;
				$empleado = str_replace(",", "", $data[1]);
				$pago_fiscal = str_replace(',', '', $data[2]) ?? 0;
				$deduccion_fiscal = str_replace(',', '', $data[3]) ?? 0;
				$neto = str_replace(',', '',$data[4]) ?? 0;
				$finiquito = $data[5] ?? "";
				$estatus = $data[6] ?? "";
				$sql = "INSERT INTO importes_fiscales (empleado, noempleado, pago_fiscal, deduccion_fiscal, neto, finiquito, estatus, usuario_id) VALUES ('" . $empleado . "', " . $noempleado . ", " . $pago_fiscal . ", " . $deduccion_fiscal . ", " . $neto . ", '" . $finiquito . "', '" . $estatus . "', " . $usuario . ");";

				$conection->query($sql);
				if($conection->error()){
					echo "<script>
					alert('Error en la linea $x')
					</script>";
					$error++;
				}

			}else{
				echo "<script>
				alert('Error en la linea $x')
				</script>";
				$error++;
			}
		}
	}
}else {
			echo "<script>
			alert('Error al procesar !!! $up->error')
			</script>";
		}
echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './nominas2025.php';
</script>
";
?>