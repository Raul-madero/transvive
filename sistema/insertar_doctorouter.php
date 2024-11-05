<?php
include "../conexion.php";


$id    = $_POST['form_pass_idc'];
$name  = $_POST['form_pass_nombree'];




if ($_FILES['archivo']['name'] != null) {
   $nombre_base  = basename($_FILES['archivo']['name']);
   $nombre_final = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base;
   $ruta = 'archivos_compras/' . $nombre_final;
   $subirarchivo = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
   if ($subirarchivo) {
   	  $insertarSQL = "UPDATE ordenes_servicio SET ruta_router = '$ruta' where folio = $id";
   	  $resultado = mysqli_query($conection, $insertarSQL);
   	  if($resultado){
   	  	
   	  	echo "<script>alert('El Router se Almaceno Correctamente'); location.href = './ordenes_servicio.php'</script>";
   	  }else{
   	  	printf('Errormessage: %s\n', mysqli_error($conection));
   	  }
   }
}else{
	
   	 

   	  	echo "<script>alert('Error al Almacenar Router'); location.href = './ordenes_servicio.php'</script>";
   	 
   
}


?>