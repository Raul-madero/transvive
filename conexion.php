<?php 
	
	$host = 'localhost';
	$user = 'root';
	$password = 'Epasilla$0406';
	$db = 'transvive';

	$conection = @mysqli_connect($host,$user,$password,$db);
	$conection->set_charset('utf8');

	if(!$conection){
		echo "Error en la conexión";
	}

?>