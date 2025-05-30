<?php 

$host = "mysql-transvive-transvive.g.aivencloud.com";
$password = "AVNS_HDRST7NXsI9UJ0fG5B3";
$user = "avnadmin";
$database = "transvive";
$port = 12088;

ini_set("mysql.connect_timeout", 5000);
ini_set("default_socket_timeout",5000);

$conection = mysqli_connect($host, $user, $password, $database, $port);
$conection->set_charset('utf8');

if(!$conection){
	die("Error de conexion " . mysqli_connect_error()); 
}
?>
