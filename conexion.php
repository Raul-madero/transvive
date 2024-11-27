<?php 

$conection = mysqli_connect("dpg-csr5lf1u0jms73cis3s0-a.oregon-postgres.render.com", "rmadero", "M6WeJ17g7uV3EsuLM1Ifjnt11HHf5i6y", "transvive_piv3", 5432) or
mysqli_connect("127.0.0.1", "root", "Epasillas0406", "transvive", 3305);
	$conection->set_charset('utf8');

	if(!$conection){
		echo "Error en la conexión"; 
	}
?>