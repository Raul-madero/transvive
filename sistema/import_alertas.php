<?php
include "../conexion.php";
session_start();

$ok = 0;
$error = 0;
$usuario = $_SESSION['idUser'];

if(isset($_FILES["name"]) && !empty($_FILES['name']['name'])) {
	$file_name = $_FILES["name"]['name'];
	$file_tmp = $_FILES['name']['tmp_name'];

	if ( ($handle = fopen( $file_tmp, "r" )) !== FALSE ) {

		$ok = 0;
		$error = 0;
		fgetcsv($handle, 409, ",");
		mysqli_set_charset($conection, "utf8mb4");
		$data = fgetcsv( $handle, 4096);
		while($data){
			if(count($data)>=6){
				$ok++;
				$sql = "insert into alertas (semana,unidad,operador,noalertas,velocidad,limite,user_id) value (\"$data[5]\",\"$data[0]\",\"$data[1]\",\"$data[2]\",\"$data[3]\",\"$data[4]\",\"$usuario\")";
				echo $data;
				exit;
				$conection->query($sql);
			}else{
				echo "<script>
					alert('Error en la linea $x')
					</script>";
				$error++;
			}
		}
	}

    $sql3 = "UPDATE alertas SET semana = REPLACE(REPLACE(REPLACE(semana,CHAR(9),''),CHAR(10),''),CHAR(13),'')";
         
    $conection->query($sql3);


        fclose($file);
		unlink("./".$up->file_dst_name);
}
	
echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './alertas.php';
</script>
";
?>