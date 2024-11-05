<?php
include "../conexion.php";


$id    = $_POST['form_pass_idp'];
$name  = $_POST['form_pass_nombrep'];




if ($_FILES['archivop']['name'] != null) {
   $nombre_base  = basename($_FILES['archivop']['name']);
   $nombre_final = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base;
   $ruta = 'archivos_pagocompra/' . $nombre_final;
   $subirarchivo = move_uploaded_file($_FILES['archivop']['tmp_name'], $ruta);
   if ($subirarchivo) {
   	  $insertarSQL = "UPDATE compras SET comprobante_pago = '$ruta' where no_compra = $id";
   	  $resultado = mysqli_query($conection, $insertarSQL);
   	  if($resultado){
   	  	
   	  	echo "<script>alert('El Pago se Almaceno Correctamente'); location.href = './compras23.php'</script>";
   	  }else{
   	  	printf('Errormessage: %s\n', mysqli_error($conection));
   	  }
   }
}else{
	
   	 

   	  	echo "<script>alert('Error al Almacenar Pago'); location.href = './compras23.php'</script>";
   	 
   
}


?>