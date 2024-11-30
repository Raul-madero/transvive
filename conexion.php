<?php 

// $host = "dpg-csr5lf1u0jms73cis3s0-a.oregon-postgres.render.com";
// $password = "M6WeJ17g7uV3EsuLM1Ifjnt11HHf5i6y";
// $user = "rmadero";
// $database = "transvive_piv3";
// $port = 5432;

$host = "mysql-transvive-transvive.g.aivencloud.com";
$password = "AVNS_HDRST7NXsI9UJ0fG5B3";
$user = "avnadmin";
$database = "defaultdb";
$port = 12088;
ini_set("mysql.connect_timeout", 5000);
ini_set("default_socket_timeout",5000);



	//$conection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
	$conection = mysqli_connect($host, $user, $password, $database, $port);
	$conection->set_charset('utf8');

	if(!$conection){
		die("Error de conexion " . mysqli_connect_error()); 
	}
?>