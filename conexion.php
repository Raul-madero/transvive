<?php 

$host = "dpg-csr5lf1u0jms73cis3s0-a";
$password = "M6WeJ17g7uV3EsuLM1Ifjnt11HHf5i6y";
$user = "rmadero";
$database = "transvive_piv3";
$port = 5432;



	$conection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
	// $conection = mysqli_connect($host, $user, $password, $database, $port);
	$conection->set_charset('utf8');

	if(!$conection){
		die("Error de conexion " . mysqli_connect_error()); 
	}
?>