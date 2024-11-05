<?php
include "../conexion.php";


$id    = $_POST['txt_idimg'];
$response = array('success' => false);

if ($_FILES['txt_imagen']['name'] != null) {
   $nombre_base  = basename($_FILES['txt_imagen']['name']);
   $nombre_final = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base;
   $ruta = 'imagenes_cotizacion/' . $nombre_final;
   $subirarchivo = move_uploaded_file($_FILES['txt_imagen']['tmp_name'], $ruta);
   if ($subirarchivo) {
      $insertarSQL = "UPDATE detalle_cotizacionventa SET imagen = '$ruta' where id = $id";
      $resultado = mysqli_query($conection, $insertarSQL);
      if($resultado){
        
         $response['success'] = true;

      }else{
        printf('Errormessage: %s\n', mysqli_error($conection));
      }
   }
}else{
    
     

        echo 'success:' . ($response['success'] ? 'true' : 'false');
     
   
}

echo 'success:' . ($response['success'] ? 'true' : 'false');
?>