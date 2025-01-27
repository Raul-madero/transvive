<?php
include "../conexion.php";
include "class.upload.php";
session_start();

$usuario     = $_SESSION['idUser'];

/*$datos = $conection->query("select * from folio_entrada where serie = 'EPT' ");
$d= $datos->fetch_object();
$folioe = $d->folio + 1;*/
//$tipo_viaje = 'Normal';
//$valor_vuelta = "Completa";
//$fcha = date("Y-m-d");


if(isset($_FILES["name"])){
	$up = new Upload($_FILES["name"]);
	if($up->uploaded){
		$up->Process("./");
		if($up->processed){
if ( $file = fopen( "./" . $up->file_dst_name , "r" ) ) {

$ok = 0;
$error = 0;
$products_array = array();

    while($x=fgets($file,4096)){
    	
    	

    		$data = explode(",", $x);
    		if(count($data)>=6){
    			$ok++;
				var_dump($data);
    			//$fcha = $data[8];
    			//$fecha = str_replace('/', '-', $fcha);
                //$fecha_mysql = date('Y-m-d', strtotime($fecha));
    			$sql = "insert into alertas (semana,unidad,operador,noalertas,velocidad,limite,user_id) value (\"$data[5]\",\"$data[0]\",\"$data[1]\",\"$data[2]\",\"$data[3]\",\"$data[4]\",\"$usuario\")";
    			$conection->query($sql);
    		}else{
    			$error++;
    		}
    }
}

    $sql3 = "UPDATE alertas SET semana = REPLACE(REPLACE(REPLACE(semana,CHAR(9),''),CHAR(10),''),CHAR(13),'')";
         
    $conection->query($sql3);


        fclose($file);
		unlink("./".$up->file_dst_name);
	}
	
}

}
echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './alertas.php';
</script>
";
?>