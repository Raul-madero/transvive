<?php
include "../conexion.php";
// include "class.upload.php";
session_start();

if (!isset($_SESSION['idUser'])) {
	die("Error: Sesión no iniciada.");
}

$usuario     = $_SESSION['idUser'];

// $sql = "TRUNCATE tempcarga_combustible";
// if(!$conection->query($sql)){
// 	die("Error al limpiar la tabla temporal.");
// }

$datos = $conection->query("select folio from carga_combustible order by folio desc limit 1 ");
$d= $datos->fetch_object();
$folioe = $d->folio;
date_default_timezone_set('America/Mexico_City');
$fechac = date("Y-m-d");



if(isset($_FILES["name"]) && !empty($_FILES["name"]['name'])){
	
	$file_name = $_FILES["name"]['name'];
	$file_tmp = $_FILES["name"]['tmp_name'];

	if(($handle = fopen($file_tmp, "r")) !== FALSE) {
		$ok = 0;
		$error = 0;
		$nfolio = $folioe + 1;
		while (($data = fgetcsv($handle, 409, ",")) !== FALSE) {
			
			if(count($data)>=6){
				$fcha = $data[0];
				$nameope = mysqli_real_escape_string($conection, $data[5]); 
				$namesup = mysqli_real_escape_string($conection, $data[16]);
				// $fecha = str_replace('/', '-', $fcha);
				$fecha_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $fcha)));
				$semana = date('W', strtotime($fecha_mysql));
				$nodesemana = 'Semana ' . $semana;
// 	}
// }

// 	$up = new Upload($_FILES["name"]);

// 	if($up->uploaded){
// 		$up->Process("./");
// 		if($up->processed){
// 			$file_path = "./".$up->file_dst_name;

// 			if ( $file = fopen( $file_path , "r" ) ) {
// 				$ok = 0;
// 				$error = 0;
// 				$nfolio = $folioe + 1;
// 				$products_array = array();

// 				while($x=fgets($file,4096)){
// 					$data = explode(",", $x);
// 					if(count($data)>=6){
// 						$fcha = $data[0];
// 						$nameope = utf8_encode($data[5]); 
// 						$namesup = utf8_encode($data[16]);
// 						$fecha = str_replace('/', '-', $fcha);
// 						$fecha_mysql = date('Y-m-d', strtotime($fecha));

						$sql = "INSERT INTO carga_combustible (folio, fecha, nodesemana, estacion, nounidad, placas, operador, kmanterior, kmactual_cargar, kmrecorridos, tipo_combustible, litros, precio, importe, rendimiento, rendimiento_estandar, supervisor, fecha_carga, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
						// echo $sql;
						$stmt = $conection->prepare($sql);

						if($stmt) {
							
							 // Asignamos valores a las variables de la consulta
							 $nfolio = (int)$nfolio;
							 $kmanterior = (int)$data[6];
							 $kmactual_cargar = (int)$data[7];
							 $kmrecorridos = (int)$data[8];
							 $litros = (float)$data[11];
							 $precio = (float)$data[12];
							 $importe = (float)$data[13];
							 $rendimiento = (float)$data[14];
							 $rendimiento_estandar = (float)$data[15];
							 $usuario = (int)$usuario;
					 
							 // Vinculamos los parámetros
							 $stmt->bind_param(
								 "issssssiiisdddddssi",
								 $nfolio,
								 $fecha_mysql,
								 $nodesemana,
								 $data[2],
								 $data[3],
								 $data[4],
								 $nameope,
								 $kmanterior,
								 $kmactual_cargar,
								 $kmrecorridos,
								 $data[9],
								 $litros,
								 $precio,
								 $importe,
								 $rendimiento,
								 $rendimiento_estandar,
								 $namesup,
								 $fechac,
								 $usuario
							 );
							// echo "<pre>";
							// print_r($stmt);
							// echo "</pre>";
							// exit;
							if($stmt->execute()) {
								$ok++;
								$nfolio++;
							}else {
								$error++;
								echo "<script> alert('Error en la inserción SQL: {$stmt->error}'); </script>"; 
							}
							$stmt->close();
						}else {
							echo "<script> alert('Error en la preparación de la consulta: {$conection->error}'); </script>"; 
						}
					}
				}
				fclose($handle);
				// unlink($file_path);

				// $sql2 = "UPDATE carga_combustible SET nodesemana = (SELECT semanas.semana FROM semanas where carga_combustible.fecha BETWEEN semanas.dia_inicial AND semanas.dia_final) where fecha_carga = '$fechac'";
				// $conection->query($sql2);
				
				$sql3 = "UPDATE folios SET folio = $nfolio + 1 where serie = 'CC'";
				$conection->query($sql3);

				echo "<script>
				alert('Correcto $ok, Error $error !!!');
				window.location = './carga_combustible23.php';
				</script>
				";
			}
	
} else {
	echo "<script> alert('Es necesario proporcionar un archivo.'); 
					window.location = './subir_cargacombustible.php';
	</script>";
}


?>