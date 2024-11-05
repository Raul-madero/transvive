<?php
include "../conexion.php";
include "class.upload.php";
session_start();

$usuario     = $_SESSION['idUser'];
$sql = "TRUNCATE tempregistro_viajes";
    $conection->query($sql);

/*$datos = $conection->query("select * from folio_entrada where serie = 'EPT' ");
$d= $datos->fetch_object();
$folioe = $d->folio + 1;*/
$tipo_viaje = 'Normal';
$valor_vuelta = "Completa";
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
$products_array = array();

    while($x=fgets($file,4096)){
    	
    	

    		$data = explode(",", $x);
    		if(count($data)>=6){
    			$ok++;
    			$fcha = $data[9];
                $nombre = utf8_encode($data[10]);
    			$fecha = str_replace('/', '-', $fcha);
                $fecha_mysql = date('Y-m-d', strtotime($fecha));
    			$sql = "insert into tempregistro_viajes (fecha,cliente,ruta,operador,unidad,tipo_viaje,num_unidad,valor_vuelta,hora_inicio,hora_fin,id_supervisor,jefe_operaciones,usuario_id,usuario_reg,fecha_carga) value (\"$fecha_mysql\",\"$data[3]\",\"$data[8]\",\"$nombre\",\"$data[6]\",\"$tipo_viaje\",\"$data[7]\",\"$valor_vuelta\",\"$data[1]\",\"$data[2]\",\"$data[11]\",\"$data[5]\",\"$data[11]\",\"$usuario\",\"$fechac\")";
    			$conection->query($sql);
    		}else{
    			$error++;
    		}
    }
}

    $sql2 = "UPDATE tempregistro_viajes SET semana = (SELECT semanas40.semana FROM semanas40 where tempregistro_viajes.fecha BETWEEN semanas40.dia_inicial AND semanas40.dia_final)";
    $conection->query($sql2);

    $sql3 = "UPDATE tempregistro_viajes op
            INNER JOIN
            (
            SELECT cliente, ruta, sueldo_camion as sumu
            FROM rutas WHERE sueldo_camion > 0) i ON op.cliente = i.cliente
            SET op.sueldo_vuelta = i.sumu where op.ruta = i.ruta AND op.unidad = 'Camion'"; 
            $conection->query($sql3);
  
    $sql4 = "UPDATE tempregistro_viajes op
            INNER JOIN
            (
            SELECT cliente, ruta, sueldo_camioneta as sumu
            FROM rutas where sueldo_camioneta > 0) i ON op.cliente = i.cliente
            SET op.sueldo_vuelta = i.sumu where op.ruta = i.ruta AND op.unidad = 'Camioneta'";
            $conection->query($sql4); 
            
    $sql5 = "UPDATE tempregistro_viajes op
            INNER JOIN
            (
            SELECT nombres, apellido_paterno, apellido_materno, sueldo as sumu
            FROM empleados) i ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno)
            SET op.sueldo_vuelta = i.sumu where op.unidad = 'Camion' and op.sueldo_vuelta = 0";
            $conection->query($sql5);
            
    $sql6 = "UPDATE tempregistro_viajes op
            INNER JOIN
            (
            SELECT nombres, apellido_paterno, apellido_materno, sueldo_camioneta as sumu
            FROM empleados) i ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno)
            SET op.sueldo_vuelta = i.sumu where op.unidad = 'Camioneta' and op.sueldo_vuelta = 0";
            $conection->query($sql6); 


	$sql17 = "UPDATE tempregistro_viajes op
            INNER JOIN
            (
            SELECT nombres, apellido_paterno, apellido_materno, sueldo_sprinter as sumu
            FROM empleados) i ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno)
            SET op.sueldo_vuelta = i.sumu where op.unidad = 'Sprinter' and op.sueldo_vuelta = 0"; 	    
    		$conection->query($sql17);	

        fclose($file);
		unlink("./".$up->file_dst_name);
	}
	
}

}
echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './viajes_cargados.php';
</script>
";
?>