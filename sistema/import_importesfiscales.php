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
// var_dump($_FILES);
if(isset($_FILES["name"]) && !empty($_FILES['name']['name'])){
	$file_name = $_FILES["name"]['name'];
	$file_tmp = $_FILES['name']['tmp_name'];

	if(($handle = fopen($file_tmp, "r")) !== FALSE) {

	
	// $up = new Upload($_FILES["name"]);
	// echo "<script>
	// alert('Correcto se subio !!! $up->file_name');
	// </script>";
	// if($up->uploaded){
	// 	$up->Process("./");
	// 	if($up->processed){
	// 		echo '<script>
	// 		alert("Correcto se proceso !!!");
	// 		</script>
	// 		<br>';
			// if ( $file = fopen( "./" . $up->file_dst_name , "r" ) ) {
				$ok = 0;
				$error = 0;
				fgetcsv($handle, 409, ",");
				// $products_array = array();
				mysqli_set_charset($conection, "utf8mb4");
				
				while(($data = fgetcsv($handle, 409, ",")) !== FALSE){
					if(count($data)>=6){
						$ok++;
						$noempleado = intval($data[0]);
						$empleado = mb_convert_encoding($data[1], "utf-8", "ISO-8859-1");
						$pago_fiscal = floatval($data[2]);
						$deduccion_fiscal = floatval($data[3]);
						$neto = floatval($data[4]);
						$finiquito = mb_convert_encoding($data[5], "utf-8", "ISO-8859-1");
						$estatus = mb_convert_encoding($data[6], "utf-8", "ISO-8859-1");
						//$fecha = str_replace('/', '-', $fcha);
						//$fecha_mysql = date('Y-m-d', strtotime($fecha));
						$sql = "INSERT INTO importes_fiscales (noempleado, empleado, pago_fiscal, deduccion_fiscal, neto, finiquito, estatus, usuario_id) 
						VALUES ($noempleado, '$empleado', $pago_fiscal, $deduccion_fiscal, $neto, '$finiquito', '$estatus', $usuario)";

						$conection->query($sql);

					}else{
						echo "<script>
						alert('Error en la linea $x')
						</script>";
						$error++;
					}
				}
			}

		// 	$sql3 = "UPDATE empleados op
		// 	INNER JOIN
		// 	(
		// 	SELECT empleado, pago_fiscal, deduccion_fiscal 
		// 	FROM importes_fiscales) i ON CONCAT(op.apellido_paterno, ' ', op.apellido_materno, ' ', op.nombres) = i.empleado SET op.efectivo= i.pago_fiscal, op.descuento_fiscal = i.deduccion_fiscal" ; 
		// 	$conection->query($sql3);
			
			
			// fclose($file);
			// unlink("./".$up->file_dst_name);
		}else {
			echo "<script>
			alert('Error al procesar !!! $up->error')
			</script>";
		}
	// }
	// else{
	// 	echo "<script> alert('Es necesario proporcionar un archivo.'); 
	// 				window.location = './carga_importesfiscal.php';
	// </script>";
	// }



echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './nominas2025.php';
</script>
";
?>