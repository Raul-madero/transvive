<?php 
	// $conection = mysqli_connect("localhost", "root", "", "prueba");
	$conection = mysqli_connect(getenv('BD_HOST'), getenv('BD_USER'),getenv('BD_PASSWORD'), getenv('BD_NAME'), intval(getenv('BD_PORT')));
	$conection->set_charset('utf8');

	if(!$conection){
		echo "Error en la conexión"; 
	}
?>