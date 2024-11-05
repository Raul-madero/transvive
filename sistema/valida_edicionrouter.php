<?php
  session_start();
 
include "../conexion.php";  


      $foto        = $_FILES['foto'];
      $nombre_foto = $foto['name'];
      $type        = $foto['type'];
      $url_temp    = $foto['tmp_name'];

      $imgProducto = $_POST['foto01'];


      $folio          = $_POST['ffolio'];
      $cliente        = $_POST['inputCliente'];
      $ruta           = $_POST['inputRuta'];
      $hora1          = $_POST['inputHorallegat1'];
      $hora2          = $_POST['inputHorallegat2'];
      $hora3          = $_POST['inputHorallegat3'];
      $operador       = $_POST['inputOperador'];
      $ligamaps       = $_POST['inputLigamaps']; 
      $supervisor     = $_POST['inputSupervisor'];
     

      $usuario     = $_SESSION['idUser'];

     

       if($nombre_foto != '')
      {
        $destino = 'img/routers/';
        $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
        $imgProducto = $img_nombre.'.jpg';
        $src = $destino.$imgProducto;
      }
     

      $query_update = mysqli_query($conection,"UPDATE routers SET cliente = '$cliente', ruta = '$ruta', horallegada_t1 = '$hora1', horallegada_t2 = '$hora2', horallegada_t3 = '$hora3', foto = '$imgProducto', operador = '$operador', liga_maps = '$ligamaps', supervisor = '$supervisor', edit_id = $usuario WHERE folio = $folio");
           
                    if($query_update){
                      
                         if($nombre_foto != ''){
                          move_uploaded_file($url_temp,$src);
                          

                         } 
                         

                     }else {
                       echo'<script type="text/javascript">
        alert("Error");
        <!--window.location.href="routers.php";-->
        </script>';     
        }

         echo'<script type="text/javascript">
        alert("Router Editado Correctamente");
        window.location.href="routers.php";
        </script>';   

               


 
?>

