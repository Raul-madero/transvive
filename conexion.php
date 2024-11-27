<?php 
require 'vendor/autoload.php';
use Dotenv\Dotenv;

	$conection = mysqli_connect("127.0.0.1", "root", "Epasillas0406", "transvive", 3305);
	// $conection = mysqli_connect($host, $user, $password, $database, $port);
	$conection->set_charset('utf8');

	if(!$conection){
		echo "Error en la conexión"; 
	}
?>