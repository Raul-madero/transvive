<?php 
	
	$host = 'dpg-csr5lf1u0jms73cis3s0-a.oregon-postgres.render.com';
	$user = 'rmadero';
	$password = 'M6WeJ17g7uV3EsuLM1Ifjnt11HHf5i6y';
	$db = 'transvive_piv3';

	$conection = mysqli_connect($host,$user,$password,$db);
	$conection->set_charset('utf8');

	if(!$conection){
		echo "Error en la conexión";
	}
?>