<?php 
// $host = "160.153.173.207";
$host = "localhost";
$user = "rmadero";
$password = "8_86y2Myk";
$database = "transvive";
$port = 3306;

ini_set("mysql.connect_timeout", 5000);
ini_set("default_socket_timeout",5000);



	//$conection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
	$conection = mysqli_connect($host, $user, $password, $database, $port);
	$conection->set_charset('utf8');

	if(!$conection){
		die("Error de conexion " . mysqli_connect_error()); 
	}
?>