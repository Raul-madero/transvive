<?php 
$host = getenv('BD_HOST');
$user = getenv('BD_USER');
$password = getenv('BD_PASSWORD');
$database = getenv('BD_NAME');
$port = intval(getenv('BD_PORT'));

	$conection = mysqli_connect("localhost", "root", "Epasillas0406", "transvive", 3305);
	// $conection = mysqli_connect($host, $user, $password, $database, $port);
	$conection->set_charset('utf8');

	if(!$conection){
		echo "Error en la conexión"; 
	}
?>