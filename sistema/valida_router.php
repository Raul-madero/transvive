<?php
  session_start();
 
include "../conexion.php";  


      $foto        = $_FILES['foto'];
      $nombre_foto = $foto['name'];
      $type        = $foto['type'];
      $url_temp    = $foto['tmp_name'];

      $imgProducto = 'user.png';


      $folio          = $_POST['ffolio'];
      $cliente        = $_POST['inputCliente'];
      $ruta           = $_POST['inputRuta'];
      $hora1          = $_POST['inputHorallegat1'];
      $hora2          = $_POST['inputHorallegat2'];
      $hora3          = $_POST['inputHorallegat3'];
      $ligamaps       = $_POST['inputLigamaps'];
      $operador       = $_POST['inputOperador'];
      $supervisor     = $_POST['inputSupervisor'];
     

      $usuario     = $_SESSION['idUser'];

     

       if($nombre_foto != '')
      {
        $destino = 'img/routers/';
        $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
        $imgProducto = $img_nombre.'.jpg';
        $src = $destino.$imgProducto;
      }

     

      $query_insert = mysqli_query($conection,"INSERT INTO routers (folio, cliente, ruta, horallegada_t1, horallegada_t2, horallegada_t3, foto, liga_maps, operador, supervisor, usuario_id) VALUES ($folio, '$cliente', '$ruta', '$hora1', '$hora2', '$hora3', '$imgProducto', '$ligamaps', '$operador',  '$supervisor', $usuario)");
           
                    if($query_insert){
                      
                         if($nombre_foto != ''){
                          move_uploaded_file($url_temp,$src);
                          $query_insert2 = mysqli_query($conection,"INSERT INTO detalle_routers (folio, horario_t1, horario_t2, horario_t3, parada, referencia, no_paradas) SELECT $folio, horario_t1, horario_t2, horario_t3, parada, referencia, no_paradas from detalle_temp_routers where folio = $folio");

                         } 
                         

                     }else {
                       echo'<script type="text/javascript">
        alert("Error");
        <!--window.location.href="FO-PG-RH-04.php";-->
        </script>';     
        }

         echo'<script type="text/javascript">
        alert("Router Registrado Correctamente");
        window.location.href="routers.php";
        </script>';   

               


 
?>

