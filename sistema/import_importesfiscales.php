<?php
include "../conexion.php";
include "class.upload.php";
session_start();

$usuario     = $_SESSION['idUser'];

$sql10 = "TRUNCATE importes_fiscales";
$conection->query($sql10);

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
    			//$fecha = str_replace('/', '-', $fcha);
                //$fecha_mysql = date('Y-m-d', strtotime($fecha));
    			$sql = "insert into importes_fiscales (noempleado,empleado,pago_fiscal,deduccion_fiscal,neto,finiquito,estatus,usuario_id) value (\"$data[0]\",\"$data[1]\",\"$data[2]\",\"$data[3]\",\"$data[4]\",\"$data[5]\",\"$data[6]\",\"$usuario\")";
    			$conection->query($sql);
    		}else{
    			$error++;
    		}
    }
}

 $sql3 = "UPDATE empleados op
            INNER JOIN
            (
            SELECT empleado, pago_fiscal, deduccion_fiscal 
            FROM importes_fiscales) i ON CONCAT(op.apellido_paterno, ' ', op.apellido_materno, ' ', op.nombres) = i.empleado SET op.efectivo= i.pago_fiscal, op.descuento_fiscal = i.deduccion_fiscal" ; 
            $conection->query($sql3);


        fclose($file);
		unlink("./".$up->file_dst_name);
	}
	
}

}
echo "<script>
alert('Correcto $ok, Error $error !!!');
window.location = './empleados.php';
</script>
";
?>