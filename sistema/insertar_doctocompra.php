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
   	  $insertarSQL = "UPDATE compras SET comprobante = '$ruta' where no_compra = $id";
   	  $resultado = mysqli_query($conection, $insertarSQL);
   	  if($resultado){
   	  	
   	  	echo "<script>alert('El Comprobante se Almaceno Correctamente'); location.href = './compras23.php'</script>";
   	  }else{
   	  	printf('Errormessage: %s\n', mysqli_error($conection));
   	  }
   }
}else{
	
   	 

   	  	echo "<script>alert('Error al Almacenar Comprobante'); location.href = './compras23.php'</script>";
   	 
   
}


?>