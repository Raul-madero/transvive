<?php
include "../conexion.php";
include "class.upload.php";
session_start();

$usuario     = $_SESSION['idUser'];
$sql = "TRUNCATE tempcarga_combustible";
    $conection->query($sql);

$datos = $conection->query("select folio from carga_combustible order by folio desc limit 1 ");
$d= $datos->fetch_object();
$folioe = $d->folio;
//$tipo_viaje = 'Normal';
//$valor_vuelta = "Completa";
//$fcha = date("Y-m-d");
date_default_timezone_set('America/Mexico_City');
         $fechac = date("Y-m-d");
if(isset($_FILES["name"])){
	$up = new Upload($_FILES["name"]);
	if($up->uploaded){
		$up->Process("./");
		if($up->processed){
if ( $file = fopen( "./" . $up->file_dst_name , "r" ) ) {

$ok = 0;
$error = 0;
$nfolio = 0;
$products_array = array();

    while($x=fgets($file,4096)){
    	
    	$nfolio = $folioe++;

    		$data = explode(",", $x);
    		if(count($data)>=6){
    			$ok++;
    			$fcha = $data[0];
                $nameope = utf8_encode($data[5]); 
                $namesup = utf8_encode($data[16]);
    			$fecha = str_replace('/', '-', $fcha);
                $fecha_mysql = date('Y-m-d', strtotime($fecha));
    			$sql = "insert into carga_combustible (folio,fecha,estacion,nounidad,placas,operador,kmanterior,kmactual_cargar,kmrecorridos,tipo_combustible,litros,precio,importe,rendimiento,rendimiento_estandar,supervisor,fecha_carga,usuario_id) value (\"$nfolio\",\"$fecha_mysql\",\"$data[2]\",\"$data[3]\",\"$data[4]\",\"$nameope\",\"$data[6]\",\"$data[7]\",\"$data[8]\",\"$data[9]\",\"$data[11]\",\"$data[12]\",\"$data[13]\",\"$data[14]\",\"$data[15]\",\"$namesup\",\"$fechac\",\"$usuario\")";
                $conection->query($sql);
    			//$conection->query($sql);
                
                $nfolio = $nfolio + 1;
    		}else{
    			$error++;
    		}
    }
}

    $sql2 = "UPDATE carga_combustible SET nodesemana = (SELECT semanas.semana FROM semanas where carga_combustible.fecha BETWEEN semanas.dia_inicial AND semanas.dia_final) where fecha_carga = '$fechac'";
    $conection->query($sql2);

    $sql3 = "UPDATE folios SET folio = $nfolio + 1 where serie = 'CC'";
    $conection->query($sql3);

   
  
   
    


        fclose($file);
		unlink("./".$up->file_dst_name);
	}
	
}

}
echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './carga_combustible23.php';
</script>
";
?>