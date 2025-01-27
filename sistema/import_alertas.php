<?php
include "../conexion.php";
session_start();

$ok = 0;
$error = 0;
$usuario = $_SESSION['idUser'];

var_dump($_FILES);
exit;

if(isset($_FILES["name"]) && !empty($_FILES['name']['name'])) {
	$file_name = $_FILES["name"]['name'];
	$file_tmp = $_FILES['name']['tmp_name'];

	if ( $handle = fopen( $file_tmp, "r" ) !== FALSE ) {

		$ok = 0;
		$error = 0;
		fgetcsv($handle, 409, ",");
		mysqli_set_charset($conection, "utf8mb4");

		while($data = fgets( $handle, 4096)){
			if(count($data)>=6){
				$ok++;
				$sql = "insert into alertas (semana,unidad,operador,noalertas,velocidad,limite,user_id) value (\"$data[5]\",\"$data[0]\",\"$data[1]\",\"$data[2]\",\"$data[3]\",\"$data[4]\",\"$usuario\")";
				$conection->query($sql);
			}else{
				echo "<script>
					alert('Error en la linea $x')
					</script>";
				$error++;
			}
		}
	}   
}
	
echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './alertas.php';
</script>
";
?>