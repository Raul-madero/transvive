<?php
include "../conexion.php";
include "class.upload.php";
session_start();
$ok = 0;
$error = 0;
$usuario = $_SESSION['idUser'];

$sql10 = "TRUNCATE importes_fiscales";
$conection->query($sql10);

$carga_error = "";
/*$datos = $conection->query("select * from folio_entrada where serie = 'EPT' ");
$d= $datos->fetch_object();
$folioe = $d->folio + 1;*/
//$tipo_viaje = 'Normal';
//$valor_vuelta = "Completa";
//$fcha = date("Y-m-d");


if(isset($_FILES["name"])){
	$up = new Upload($_FILES["name"]);
	echo "<script>
	alert('Correcto se subio !!! $up->file_name');
	</script>";
	if($up->uploaded){
		$up->Process("./");
		if($up->processed){
			echo '<script>
			alert("Correcto se proceso !!!");
			</script>
			<br>';
			if ( $file = fopen( "./" . $up->file_dst_name , "r" ) ) {
				$x = fgets($file, 4096);
				$ok = 0;
				$error = 0;
				$products_array = array();
				echo "<script>
				alert('Abierto $x')
				</script>";
				
				while($x=fgets($file,4096)){
					$data = explode(",", $x);
					if(count($data)>=6){
						$ok++;
						$noempleado = intval($data[0]);
						$empleado = $data[1];
						$pago_fiscal = floatval($data[2]);
						$deduccion_fiscal = floatval($data[3]);
						$neto = floatval($data[4]);
						$finiquito = floatval($data[5]);
						$estatus = $data[6];
						$usuario_id = $usuario;

						$sql = "INSERT INTO importes_fiscales (noempleado, empleado, pago_fiscal, deduccion_fiscal, neto, finiquito, estatus, usuario_id) 
						VALUES ($noempleado, '$empleado', $pago_fiscal, $deduccion_fiscal, $neto, $finiquito, '$estatus', $usuario_id)";
						if ($conection->query($sql)) {
							echo "<script>
							alert('Inserción exitosa')
							</script>";
						} else {
							echo "Error en la consulta: " . $conection->error . "<br>";
						}
					}else{
						echo "<script>
						alert('Error en la linea $x')
						</script>";
						$error++;
					}
				}
			}

			// $sql3 = "UPDATE empleados op
			// INNER JOIN
			// (
			// SELECT empleado, pago_fiscal, deduccion_fiscal 
			// FROM importes_fiscales) i ON CONCAT(op.apellido_paterno, ' ', op.apellido_materno, ' ', op.nombres) = i.empleado SET op.efectivo= i.pago_fiscal, op.descuento_fiscal = i.deduccion_fiscal" ; 
			// $conection->query($sql3);
			
			
			fclose($file);
			unlink("./".$up->file_dst_name);
		}else {
			echo "<script>
			alert('Error al procesar !!! $up->error')
			</script>";
		}
	}
	else{
		$carga_error = $up->error;
	}
}
	




echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './empleados.php';
</script>
";
?>