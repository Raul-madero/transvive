<?php 

$host = "transvive-db-1";
$password = "Epasillas0406";
$user = "root";
$database = "transvive";
$port = 3306;



	$conection = mysqli_connect($host, $user, 	$password, $database, $port);
	// $conection = mysqli_connect($host, $user, $password, $database, $port);
	$conection->set_charset('utf8');

	if(!$conection){
		die("Error de conexion " . mysqli_connect_error()); 
	}
?>