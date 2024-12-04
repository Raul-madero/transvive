<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqlenc= mysqli_query($conection,"SELECT MONTH(fecha) as Nmes, YEAR(fecha), SUM(importe) as Importec, sum(litros) as Litros FROM carga_combustible WHERE YEAR(fecha) = YEAR('2024') and estatus <> 0 GROUP BY MONTH(fecha)");
  mysqli_close($conection);
  $sqlenc && $result_sqlenc = mysqli_num_rows($sqlenc);

  if($result_sqlenc == 0){
    $importemes1 = 0;
    $importemes2 = 0;
    $importemes3 = 0;
    $importemes4 = 0;
    $importemes5 = 0;
    $importemes6 = 0;
    $importemes7 = 0;
    $importemes8 = 0;
    $importemes9 = 0;
    $importemes10 = 0;
    $importemes11 = 0;
    $importemes12 = 0;

  }else{

    while ($data = mysqli_fetch_array($sqlenc)){
       $mes = $data['Nmes'];
        switch($mes)
      {   
          case 1:
          $importemes1 = $data['Importec']; 
          $litros1 = $data['Litros']; 
          break;

          case 2:
          $importemes2 = $data['Importec']; 
          $litros2 = $data['Litros']; 
          break;

          case 3:
          $importemes3 = $data['Importec']; 
          $litros3 = $data['Litros']; 
          break;

          case 4:
          $importemes4 = $data['Importec']; 
          $litros4 = $data['Litros'];
          break;

          case 5:
          $importemes5 = $data['Importec']; 
          $litros5 = $data['Litros'];
          break;

          case 6:
          $importemes6 = $data['Importec']; 
          $litros6 = $data['Litros'];
          break;

          case 7:
          $importemes7 = $data['Importec']; 
          $litros7 = $data['Litros'];
          break;

          case 8:
          $importemes8 = $data['Importec']; 
          $litros8 = $data['Litros'];
          break;

          case 9:
          $importemes9 = $data['Importec']; 
          $litros9 = $data['Litros'];
          break;

          case 10:
          $importemes10 = $data['Importec']; 
          $litros10 = $data['Litros'];
          break;

          case 11:
          $importemes11 = $data['Importec']; 
          $litros11 = $data['Litros'];
          break;

          case 12:
          $importemes12 = $data['Importec']; 
          $litros12 = $data['Litros'];
          break;

    //...
    }
   
    }

    if (isset($importemes1)) {
        $nimportemes1 = $importemes1;
        $nlitros1 = $litros1;
    }else {
        $nimportemes1 = 0;
        $nlitros1 = 0;
    }

    if (isset($importemes2)) {
        $nimportemes2 = $importemes2;
        $nlitros2 = $litros2;
    }else {
        $nimportemes2 = 0;
        $nlitros2 = 0;
    }

    if (isset($importemes3)) {
        $nimportemes3 = $importemes3;
        $nlitros3 = $litros3;
    }else {
        $nimportemes3 = 0;
        $nlitros3 = 0;
    }

    if (isset($importemes4)) {
        $nimportemes4 = $importemes4;
        $nlitros4 = $litros4;
    }else {
        $nimportemes4 = 0;
        $nlitros4 = 0;
    }

    if (isset($importemes5)) {
        $nimportemes5 = $importemes5;
        $nlitros5 = $litros5;
    }else {
        $nimportemes5 = 0;
        $nlitros5 = 0;
    }

    if (isset($importemes6)) {
        $nimportemes6 = $importemes6;
        $nlitros6 = $litros6;
    }else {
        $nimportemes6 = 0;
        $nlitros6 = 0;
    }

    if (isset($importemes7)) {
        $nimportemes7 = $importemes7;
        $nlitros7 = $litros7;
    }else {
        $nimportemes7 = 0;
        $nlitros7 = 0;
    }

    if (isset($importemes8)) {
        $nimportemes8 = $importemes8;
        $nlitros8 = $litros8;
    }else {
        $nimportemes8 = 0;
        $nlitros8 = 0;
    }

    if (isset($importemes9)) {
        $nimportemes9 = $importemes9;
        $nlitros9 = $litros9;
    }else {
        $nimportemes9 = 0;
        $nlitros9 = 0;
    }

    if (isset($importemes10)) {
        $nimportemes10 = $importemes10;
        $nlitros10 = $litros10;
    }else {
        $nimportemes10 = 0;
        $nlitros10 = 0;
    }

    if (isset($importemes11)) {
        $nimportemes11 = $importemes11;
        $nlitros11 = $litros11;
    }else {
        $nimportemes11 = 0;
        $nlitros11 = 0;
    }

    if (isset($importemes12)) {
        $nimportemes12 = $importemes12;
        $nlitros12 = $litros12;
    }else {
        $nimportemes12 = 0;
        $nlitros12 = 0;
    }

  }
  include '../conexion.php'; //Conexion a la base de datos
  $sqlenc= mysqli_query($conection,"SELECT 
                                                    MONTH(fecha) as Nmes, 
                                                    YEAR(fecha) as anio, 
                                                    SUM(total) as totalcompra 
                                                  FROM 
                                                    compras
                                                  WHERE YEAR(fecha) = YEAR(CURDATE()) and estatus <> 0 
                                                  GROUP BY anio, Nmes
                                                  ORDER BY anio, Nmes");
//Validar consulta
  if(!$sqlenc){
    die("Error en la consulta");
  }
  $datos_compras = [];
  while ($data = mysqli_fetch_array($sqlenc)){
    $datos_compras[] = $data;
  }

  mysqli_close($conection);
  $result_sqlenc = mysqli_num_rows($sqlenc);
  if($result_sqlenc == 0){
    $importemesc1 = 0;
    $importemesc2 = 0;
    $importemesc3 = 0;
    $importemesc4 = 0;
    $importemesc5 = 0;
    $importemesc6 = 0;
    $importemesc7 = 0;
    $importemesc8 = 0;
    $importemesc9 = 0;
    $importemesc10 = 0;
    $importemesc11 = 0;
    $importemesc12 = 0;

  }else{

    while ($data = mysqli_fetch_array($sqlenc)){
       $mes = $data['Nmes'];
        switch($mes)
      {   
          case 1:
          $importemesc1 = $data['totalcompra']; 
          break;

          case 2:
          $importemesc2 = $data['totalcompra'];  
          break;

          case 3:
          $importemesc3 = $data['totalcompra']; 
          break;

          case 4:
          $importemesc4 = $data['totalcompra']; 
          break;

          case 5:
          $importemesc5 = $data['totalcompra']; 
          break;

          case 6:
          $importemesc6 = $data['totalcompra']; 
          break;

          case 7:
          $importemesc7 = $data['totalcompra'];
          break;

          case 8:
          $importemesc8 = $data['totalcompra'];
          break;

          case 9:
          $importemesc9 = $data['totalcompra']; 
          break;

          case 10:
          $importemesc10 = $data['totalcompra']; 
          break;

          case 11:
          $importemesc11 = $data['totalcompra']; 
          break;

          case 12:
          $importemesc12 = $data['totalcompra']; 
          break;

    //...
    }
    if (isset($importemesc1)) {
        $comprames1 = $importemesc1;
    }else {
        $comprames1 = 0;
    }

    if (isset($importemesc2)) {
        $comprames2 = $importemesc2;
    }else {
        $comprames2 = 0;
    }

    if (isset($importemesc3)) {
        $comprames3 = $importemesc3;
    }else {
        $comprames3 = 0;
    }

    if (isset($importemesc4)) {
        $comprames4 = $importemesc4;
    }else {
        $comprames4 = 0;
    }

    if (isset($importemesc5)) {
        $comprames5 = $importemesc5;
    }else {
        $comprames5 = 0;
    }

    if (isset($importemesc6)) {
        $comprames6 = $importemesc6;
    }else {
        $comprames6 = 0;
    }

    if (isset($importemesc7)) {
        $comprames7 = $importemesc7;
    }else {
        $comprames7 = 0;
    }

    if (isset($importemesc8)) {
        $comprames8 = $importemesc8;
    }else {
        $comprames8 = 0;
    }

    if (isset($importemesc9)) {
        $comprames9 = $importemesc9;
    }else {
        $comprames9 = 0;
    }

    if (isset($importemesc10)) {
        $comprames10 = $importemesc10;
    }else {
        $comprames10 = 0;
    }

    if (isset($importemesc11)) {
        $comprames11 = $importemesc11;
    }else {
        $comprames11 = 0;
    }

    if (isset($importemesc12)) {
        $comprames12 = $importemesc12;
    }else {
        $comprames12 = 0;
    }

   
    }
  }


  include "../conexion.php";
  $sqlenc= mysqli_query($conection,"SELECT 
                                                    MONTH(fecha) as Nmes, 
                                                    YEAR(fecha) as anio, 
                                                    SUM(total) as totalocompra 
                                                  FROM 
                                                    orden_compra 
                                                  WHERE YEAR(fecha) = YEAR(CURDATE()) and estatus <> 0 
                                                  GROUP BY anio, Nmes
                                                  ORDER BY anio, Nmes");
  mysqli_close($conection);
  $result_sqlenc = mysqli_num_rows($sqlenc);

  if($result_sqlenc == 0){
    $importemesoc1 = 0;
    $importemesoc2 = 0;
    $importemesoc3 = 0;
    $importemesoc4 = 0;
    $importemesoc5 = 0;
    $importemesoc6 = 0;
    $importemesoc7 = 0;
    $importemesoc8 = 0;
    $importemesoc9 = 0;
    $importemesoc10 = 0;
    $importemesoc11 = 0;
    $importemesoc12 = 0;

  }else{

    while ($data = mysqli_fetch_array($sqlenc)){
       $mes = $data['Nmes'];
        switch($mes)
      {   
          case 1:
          $importemesoc1 = $data['totalocompra']; 
          break;

          case 2:
          $importemesoc2 = $data['totalocompra'];  
          break;

          case 3:
          $importemesoc3 = $data['totalocompra']; 
          break;

          case 4:
          $importemesoc4 = $data['totalocompra']; 
          break;

          case 5:
          $importemesoc5 = $data['totalocompra']; 
          break;

          case 6:
          $importemesoc6 = $data['totalocompra']; 
          break;

          case 7:
          $importemesoc7 = $data['totalocompra'];
          break;

          case 8:
          $importemesoc8 = $data['totalocompra'];
          break;

          case 9:
          $importemesoc9 = $data['totalocompra']; 
          break;

          case 10:
          $importemesco10 = $data['totalocompra']; 
          break;

          case 11:
          $importemesoc11 = $data['totalocompra']; 
          break;

          case 12:
          $importemesoc12 = $data['totalocompra']; 
          break;

    //...
    }
    if (isset($importemesoc1)) {
        $ocomprames1 = $importemesoc1;
    }else {
        $ocomprames1 = 0;
    }

    if (isset($importemesoc2)) {
        $ocomprames2 = $importemesoc2;
    }else {
        $ocomprames2 = 0;
    }

    if (isset($importemesoc3)) {
        $ocomprames3 = $importemesoc3;
    }else {
        $ocomprames3 = 0;
    }

    if (isset($importemesoc4)) {
        $ocomprames4 = $importemesoc4;
    }else {
        $ocomprames4 = 0;
    }

    if (isset($importemesoc5)) {
        $ocomprames5 = $importemesoc5;
    }else {
        $ocomprames5 = 0;
    }

    if (isset($importemesoc6)) {
        $ocomprames6 = $importemesoc6;
    }else {
        $ocomprames6 = 0;
    }

    if (isset($importemesoc7)) {
        $ocomprames7 = $importemesoc7;
    }else {
        $ocomprames7 = 0;
    }

    if (isset($importemesoc8)) {
        $ocomprames8 = $importemesoc8;
    }else {
        $ocomprames8 = 0;
    }

    if (isset($importemesoc9)) {
        $ocomprames9 = $importemesoc9;
    }else {
        $ocomprames9 = 0;
    }

    if (isset($importemesoc10)) {
        $ocomprames10 = $importemesoc10;
    }else {
        $ocomprames10 = 0;
    }

    if (isset($importemesoc11)) {
        $ocomprames11 = $importemesoc11;
    }else {
        $ocomprames11 = 0;
    }

    if (isset($importemesoc12)) {
        $ocomprames12 = $importemesoc12;
    }else {
        $ocomprames12 = 0;
    }

   
    }
  }

  include "../conexion.php";
   $sqlprom= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE())");
  mysqli_close($conection);
  while ($rowprom = mysqli_fetch_array($sqlprom)){
   //extract $drow;
    $promedio = $rowprom ['promedio'];
}


  include "../conexion.php";
   $sqlenc23= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = 2024");
  mysqli_close($conection);
  $result_sqlenc23 = mysqli_num_rows($sqlenc23);

  if($result_sqlenc23 == 0){
    $resp1_23 = 0;
    $resp2_23 = 0;
    $resp3_23 = 0;
    $resp4_23 = 0;
    $resp5_23 = 0;
    $resp6_23 = 0;
    $resp7_23 = 0;
    $resp8_23 = 0;
    $resp9_23 = 0;
    $resp10_23 = 0;
    $resp11_23 = 0;
    $resp12_23 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc23);
    $resp1_23 = number_format($dataenc['Timeforma'],1); 
    $resp2_23 = number_format($dataenc['Timerespuesta'],1); 
    $resp3_23 = number_format($dataenc['Disponibilidad'],1); 
    $resp4_23 = number_format($dataenc['Calidad'],1); 
    $resp5_23 = number_format($dataenc['Asesoriatecnica'],1); 
    $resp6_23 = number_format($dataenc['Limpieza'],1);
    $resp7_23 = number_format($dataenc['Servicio'],1);
    $resp8_23 = number_format($dataenc['Conduce'],1);
    $resp9_23 = number_format($dataenc['Atencion'],1);
    $resp10_23 = number_format($dataenc['Facturacion'],1);
    $resp11_23 = number_format($dataenc['Precios'],1);
    $resp12_23 = number_format($dataenc['Numeroreg'],0);
     
  }

  
  include "../conexion.php";
   $sqlenc24= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = 2024");
  mysqli_close($conection);
  $result_sqlenc24 = mysqli_num_rows($sqlenc24);

  if($result_sqlenc24 == 0){
    $resp1_24 = 0;
    $resp2_24 = 0;
    $resp3_24 = 0;
    $resp4_24 = 0;
    $resp5_24 = 0;
    $resp6_24 = 0;
    $resp7_24 = 0;
    $resp8_24 = 0;
    $resp9_24 = 0;
    $resp10_24 = 0;
    $resp11_24 = 0;
    $resp12_24 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc24);
    $resp1_24 = number_format($dataenc['Timeforma'],1); 
    $resp2_24 = number_format($dataenc['Timerespuesta'],1); 
    $resp3_24 = number_format($dataenc['Disponibilidad'],1); 
    $resp4_24 = number_format($dataenc['Calidad'],1); 
    $resp5_24 = number_format($dataenc['Asesoriatecnica'],1); 
    $resp6_24 = number_format($dataenc['Limpieza'],1);
    $resp7_24 = number_format($dataenc['Servicio'],1);
    $resp8_24 = number_format($dataenc['Conduce'],1);
    $resp9_24 = number_format($dataenc['Atencion'],1);
    $resp10_24 = number_format($dataenc['Facturacion'],1);
    $resp11_24 = number_format($dataenc['Precios'],1);
    $resp12_24 = number_format($dataenc['Numeroreg'],0);
     
  }

  include "../conexion.php";
   $sqlenc25= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = 2025");
  mysqli_close($conection);
  $result_sqlenc25 = mysqli_num_rows($sqlenc25);

  if($result_sqlenc25 == 0){
    $resp1_25 = 0;
    $resp2_25 = 0;
    $resp3_25 = 0;
    $resp4_25 = 0;
    $resp5_25 = 0;
    $resp6_25 = 0;
    $resp7_25 = 0;
    $resp8_25 = 0;
    $resp9_25 = 0;
    $resp10_25 = 0;
    $resp11_25 = 0;
    $resp12_25 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc25);
    $resp1_25 = number_format($dataenc['Timeforma'],1); 
    $resp2_25 = number_format($dataenc['Timerespuesta'],1); 
    $resp3_25 = number_format($dataenc['Disponibilidad'],1); 
    $resp4_25 = number_format($dataenc['Calidad'],1); 
    $resp5_25 = number_format($dataenc['Asesoriatecnica'],1); 
    $resp6_25 = number_format($dataenc['Limpieza'],1);
    $resp7_25 = number_format($dataenc['Servicio'],1);
    $resp8_25 = number_format($dataenc['Conduce'],1);
    $resp9_25 = number_format($dataenc['Atencion'],1);
    $resp10_25 = number_format($dataenc['Facturacion'],1);
    $resp11_25 = number_format($dataenc['Precios'],1);
    $resp12_25 = number_format($dataenc['Numeroreg'],0);
     
  }

  include "../conexion.php";
   $sqlenc26= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = 2026");
  mysqli_close($conection);
  $result_sqlenc26 = mysqli_num_rows($sqlenc26);

  if($result_sqlenc26 == 0){
    $resp1_26 = 0;
    $resp2_26 = 0;
    $resp3_26 = 0;
    $resp4_26 = 0;
    $resp5_26 = 0;
    $resp6_26 = 0;
    $resp7_26 = 0;
    $resp8_26 = 0;
    $resp9_26 = 0;
    $resp10_26 = 0;
    $resp11_26 = 0;
    $resp12_26 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc26);
    $resp1_26 = number_format($dataenc['Timeforma'],1); 
    $resp2_26 = number_format($dataenc['Timerespuesta'],1); 
    $resp3_26 = number_format($dataenc['Disponibilidad'],1); 
    $resp4_26 = number_format($dataenc['Calidad'],1); 
    $resp5_26 = number_format($dataenc['Asesoriatecnica'],1); 
    $resp6_26 = number_format($dataenc['Limpieza'],1);
    $resp7_26 = number_format($dataenc['Servicio'],1);
    $resp8_26 = number_format($dataenc['Conduce'],1);
    $resp9_26 = number_format($dataenc['Atencion'],1);
    $resp10_26 = number_format($dataenc['Facturacion'],1);
    $resp11_26 = number_format($dataenc['Precios'],1);
    $resp12_26 = number_format($dataenc['Numeroreg'],0);
     
  }

  include "../conexion.php";
   $sqlenc27= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = 2027");
  mysqli_close($conection);
  $result_sqlenc27 = mysqli_num_rows($sqlenc27);

  if($result_sqlenc27 == 0){
    $resp1_27 = 0;
    $resp2_27 = 0;
    $resp3_27 = 0;
    $resp4_27 = 0;
    $resp5_27 = 0;
    $resp6_27 = 0;
    $resp7_27 = 0;
    $resp8_27 = 0;
    $resp9_27 = 0;
    $resp10_27 = 0;
    $resp11_27 = 0;
    $resp12_27 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc27);
    $resp1_27 = number_format($dataenc['Timeforma'],1); 
    $resp2_27 = number_format($dataenc['Timerespuesta'],1); 
    $resp3_27 = number_format($dataenc['Disponibilidad'],1); 
    $resp4_27 = number_format($dataenc['Calidad'],1); 
    $resp5_27 = number_format($dataenc['Asesoriatecnica'],1); 
    $resp6_27 = number_format($dataenc['Limpieza'],1);
    $resp7_27 = number_format($dataenc['Servicio'],1);
    $resp8_27 = number_format($dataenc['Conduce'],1);
    $resp9_27 = number_format($dataenc['Atencion'],1);
    $resp10_27 = number_format($dataenc['Facturacion'],1);
    $resp11_27 = number_format($dataenc['Precios'],1);
    $resp12_27 = number_format($dataenc['Numeroreg'],0);
     
  }

  include "../conexion.php";
   $sqlenc28= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = 2028");
  mysqli_close($conection);
  $result_sqlenc28 = mysqli_num_rows($sqlenc28);

  if($result_sqlenc28 == 0){
    $resp1_28 = 0;
    $resp2_28 = 0;
    $resp3_28 = 0;
    $resp4_28 = 0;
    $resp5_28 = 0;
    $resp6_28 = 0;
    $resp7_28 = 0;
    $resp8_28 = 0;
    $resp9_28 = 0;
    $resp10_28 = 0;
    $resp11_28 = 0;
    $resp12_28 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc28);
    $resp1_28 = number_format($dataenc['Timeforma'],2); 
    $resp2_28 = number_format($dataenc['Timerespuesta'],2); 
    $resp3_28 = number_format($dataenc['Disponibilidad'],2); 
    $resp4_28 = number_format($dataenc['Calidad'],2); 
    $resp5_28 = number_format($dataenc['Asesoriatecnica'],2); 
    $resp6_28 = number_format($dataenc['Limpieza'],2);
    $resp7_28 = number_format($dataenc['Servicio'],2);
    $resp8_28 = number_format($dataenc['Conduce'],2);
    $resp9_28 = number_format($dataenc['Atencion'],2);
    $resp10_28 = number_format($dataenc['Facturacion'],2);
    $resp11_28 = number_format($dataenc['Precios'],2);
    $resp12_28 = number_format($dataenc['Numeroreg'],0);

     
  }

  include "../conexion.php";
  $sqlviajes= mysqli_query($conection,"SELECT 
                                                        MONTHNAME(fecha) AS Nmeses, 
                                                        YEAR(fecha) AS anio, 
                                                        SUM(IF(planeado=1, valor_vuelta, 0)) AS Planeados, 
                                                        SUM(valor_vuelta) AS Registrados, 
                                                        (SUM(valor_vuelta) - SUM(IF(planeado=1, valor_vuelta, 0))) AS Diferencia, 
                                                        CASE 
                                                            WHEN SUM(valor_vuelta) = 0 THEN 0
                                                            ELSE 100 - (SUM(IF(planeado=1, valor_vuelta, 0)) / SUM(valor_vuelta) * 100)
                                                        END AS Porcdiferencia
                                                    FROM 
                                                        registro_viajes
                                                    WHERE 
                                                        YEAR(fecha) = YEAR(CURDATE()) 
                                                        AND estatus = 2
                                                    GROUP BY 
                                                        anio, Nmeses
                                                    ");
  if (!$sqlviajes) {
    die("Error en la consulta: " . mysqli_error($conection));
  };

  $values = [];
  $dato2 = [];
  $dato3 = [];
  $dato4 = [];
  $dato5 = [];

  while ($drow = mysqli_fetch_assoc($sqlviajes)){
    $values[] = $drow['Nmeses'];
    $dato2[] = $drow['Planeados'];
    $dato3[] = $drow['Registrados'];
    $dato4[] = $drow['Diferencia'];
    $dato5[] = number_format($drow['Porcdiferencia'], 2); 
  };

  mysqli_close($conection);

include "../conexion.php";
$sqlenc10 = mysqli_query(
                $conection,
                "SELECT 
                    cliente, 
                    fecha, 
                    tiempo_forma, 
                    tiempo_respuesta, 
                    disponibilidad, 
                    calidad, 
                    asesoria_tecnica, 
                    limpieza_condicion, 
                    servicio_operador, 
                    conduce_adecuado, 
                    atencion_calidad, 
                    servicio_facturacion, 
                    nuestros_precios 
                FROM 
                    newencuesta_clientes 
                WHERE 
                    YEAR(fecha) = YEAR(CURDATE())"
              );
 // $result10 = mysql_query($sqlenc10);
 if (!$sqlenc10) {
    die("Error en la consulta: " . mysqli_error($conection));
  };

  $tt = [];
  $data1 = [];
  $values24 = [];
  $dato24 = [];
  $dato34 = [];
  $dato44 = [];

  while ($nrow = mysqli_fetch_assoc($sqlenc10)) {
    $tt[] = $nrow['cliente'];
    $data1[] = $nrow['cliente'];
    $values24[] = $nrow['cliente'];
    $dato24[] = $nrow['tiempo_forma'];
    $dato34[] = $nrow['tiempo_respuesta'];
    $dato44[] = $nrow['disponibilidad'];
}
  mysqli_close($conection);

 $aniocurso = date("Y"); 

  include "../conexion.php";
   $sqlenc024= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE())");
  mysqli_close($conection);
  $result_sqlenc024 = mysqli_num_rows($sqlenc024);

  if($result_sqlenc024 == 0){
    $respact1 = 0;
    $respact2 = 0;
    $respact3 = 0;
    $respact4 = 0;
    $respact5 = 0;
    $respact6 = 0;
    $respact7 = 0;
    $respact8 = 0;
    $respact9 = 0;
    $respact10 = 0;
    $respact11 = 0;
    $respact12 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc024);
    $respact1  = (number_format($dataenc['Timeforma'],2)*100)/10; 
    $respact2  = (number_format($dataenc['Timerespuesta'],2)*100)/10; 
    $respact3  = (number_format($dataenc['Disponibilidad'],2)*100)/10; 
    $respact4  = (number_format($dataenc['Calidad'],2)*100)/10; 
    $respact5  = (number_format($dataenc['Asesoriatecnica'],2)*100)/10; 
    $respact6  = (number_format($dataenc['Limpieza'],2)*100)/10;
    $respact7  = (number_format($dataenc['Servicio'],2)*100)/10;
    $respact8  = (number_format($dataenc['Conduce'],2)*100)/10;
    $respact9  = (number_format($dataenc['Atencion'],2)*100)/10;
    $respact10 = (number_format($dataenc['Facturacion'],2)*100)/10;
    $respact11 = (number_format($dataenc['Precios'],2)*100)/10;
    $respact12 = number_format($dataenc['Numeroreg'],0);

    $respuesta1  = $respact1.'%';
    $respuesta2  = $respact2.'%';
    $respuesta3  = $respact3.'%';
    $respuesta4  = $respact4.'%';
    $respuesta5  = $respact5.'%';
    $respuesta6  = $respact6.'%';
    $respuesta7  = $respact7.'%';
    $respuesta8  = $respact8.'%';
    $respuesta9  = $respact9.'%';
    $respuesta10 = $respact10.'%';
    $respuesta11 = $respact11.'%';
   
  }

  $dhoy = date("Y-m-d");

  include "../conexion.php";
  $sqlnsem= mysqli_query($conection,"SELECT semana as Nsemana FROM semanas WHERE '$dhoy' BETWEEN dia_inicial  and dia_final");
  mysqli_close($conection);
  while ($srow = mysqli_fetch_array($sqlnsem)){
   //extract $drow;
    // $name_semana = $srow ['Nsemana'];
    $name_semana = 'Semana 44';
}

  include "../conexion.php";
  $sqlvsem= mysqli_query($conection,"SELECT 
														YEAR(fecha) as anio, 
														SUM(IF(planeado=1, valor_vuelta, 0)) as Planeados, 
														SUM(valor_vuelta) as Registrados,(SUM(valor_vuelta)  - SUM(IF(planeado=1, valor_vuelta, 0))) as Diferencia, 
														100 - (SUM(IF(planeado=1, valor_vuelta, 0)) / SUM(valor_vuelta)*100) as Porcdiferencia 
													FROM registro_viajes
													WHERE semana = '$name_semana' and estatus = 2
													GROUP BY anio");

  if (!$sqlvsem) {
	die("Error en la consulta: " . mysqli_error($conection));
  };

  if ($vrow = mysqli_fetch_assoc($sqlvsem)) {
    $v_planeados   = $vrow['Planeados'];
    $v_registrados = $vrow['Registrados'];
    $v_diferencia  = $vrow['Diferencia'];
    $v_porcdif     = $vrow['Porcdiferencia']; // Porcentaje de diferencia (ya redondeado)
} else {
    // En caso de no haber resultados
    echo "No se encontraron registros para la semana: $name_semana.";
}
  mysqli_close($conection);


    include "../conexion.php";
    $sqlvplan= mysqli_query($conection,"SELECT 
														YEAR(fecha), 
														SUM(IF(planeado=1, 1, 0)) as Vplaneados, 
														SUM(IF(planeado=1, 1, 0)) - SUM(valor_vuelta) as Vdiferencia 
													FROM registro_viajes
													WHERE semana = '$name_semana' 
													GROUP BY YEAR(fecha)");
	if (!$sqlvplan) {
		die("Error en la consulta: " . mysqli_error($conection));
	};

	if ($prow = mysqli_fetch_assoc($sqlvplan)) {
		$vjs_planeados    = $prow['Vplaneados'];  // Total de viajes planeados
		$total_vuelta     = $prow['TotalVueltaPlaneados']; // Suma total de "valor_vuelta"
		$planeados_reg    = $prow['TotalPlaneadosRegistrados']; // Total de "valor_vuelta" para viajes planeados
		$vjs_diferencia   = $prow['Vdiferencia']; // Diferencia total calculada
		$nv_planeados = 0;
	}else {
		echo "No se encontraron registros para la semana: $name_semana.";
	};

    mysqli_close($conection);


if (isset($v_registrados)) {
   $nv_registrados = $v_registrados;
}else {
    $nv_registrados = 0.001;
}

if (isset($nv_diferencia)) {
   $nv_diferencia = $v_diferencia;
}else {
    $nv_diferencia = 0;
}

include "../conexion.php";
  $sqlviajescanc= mysqli_query($conection,"SELECT count(valor_vuelta) as viajes_cancelados from registro_viajes WHERE  semana = '$name_semana' and estatus = 3 ");
  mysqli_close($conection);
  $result_sqlviajescanc = mysqli_num_rows($sqlviajescanc);

    while ($datacanc = mysqli_fetch_array($sqlviajescanc)){
      $v_cancelados   = number_format($datacanc['viajes_cancelados'],2);
      //$especiales   = $datav['viajes_especiales'];
     
  } 

  $p_planeados    = $vjs_planeados - $v_cancelados;
  if ($p_planeados == 0) {
     $porc_planeados  = 0;
  }else {
     $porc_planeados = number_format(($p_planeados / $vjs_planeados) * 100,2);
  }

  if ($vjs_planeados == 0) {
      $porc_registrados = 0;
  }else {
      $p_registrados    = ($nv_registrados/$vjs_planeados) * 100;
      $porc_registrados = number_format(100 - $p_registrados,2);
  }

  if ($vjs_planeados == 0) {
      $porc_diferencia = 0;
      $porc_cancelados = 0;
  }else {
      $p_diferencia    = ($v_registrados - $vjs_planeados);
      $porc_diferencia = number_format(($nv_registrados /$p_diferencia) * 100,2);
      $porc_cancelados = number_format(($v_cancelados / $vjs_planeados) * 100,2);
  }    

$lasemana = date("n");
$monthNum  = $lasemana;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
setlocale(LC_TIME, 'es_MX');
// // $NameMes = strftime('%B', $dateObj->getTimestamp());
$NameMes = $dateObj->format('F');

include "../conexion.php";
$sqlcomprames= mysqli_query($conection,"SELECT 
														MONTH(fecha) as Nmeses, 
														YEAR(fecha), 
														SUM(total) as totalcompras 
													FROM compras 
													WHERE  MONTH(fecha) =  MONTH(CURDATE()) 
													and estatus = 1 
													GROUP BY Nmeses, YEAR(fecha)");

if (!$sqlcomprames) {
	die("Error en la consulta: " . mysqli_error($conection));
};

$comprasmes = number_format(0.00,2);
if ($datanc = mysqli_fetch_assoc($sqlcomprames)) {
	$comprasmes = number_format($datanc['totalcompras'],2);
};
mysqli_close($conection);
if (isset($compras_mes)) {
	$comprasmes = $compras_mes;
}else {
	$comprasmes = number_format(0.00,2);
}

$dhoy2 = '2024-10-30';
include "../conexion.php";
  $sqlndsem= mysqli_query($conection,"SELECT semana as Nsemana, dia_inicial, dia_final FROM semanas WHERE '$dhoy2' BETWEEN dia_inicial  and dia_final");
  mysqli_close($conection);
  while ($crow = mysqli_fetch_array($sqlndsem)){
   //extract $drow;
    $diaini = $crow ['dia_inicial'];
    $diafin = $crow ['dia_final'];
  
}

include "../conexion.php";
  $sqlcomprasem= mysqli_query($conection,"SELECT MONTHNAME(fecha) as Nmeses, YEAR(fecha), SUM(total) as totalcompras FROM compras WHERE  fecha >= '$diaini' and fecha <= '$diafin' and estatus = 1 GROUP BY fecha ");
  mysqli_close($conection);
  $result_sqlcomprasem = mysqli_num_rows($sqlcomprasem);

    while ($datacanc = mysqli_fetch_array($sqlcomprasem)){
      $compras_semana   = number_format($datacanc['totalcompras'],2);
      //$especiales   = $datav['viajes_especiales'];
     
  } 

  if (isset($compras_semana)) {
        $comprassem = $compras_semana;
    }else {
        $comprassem = number_format(0.00,2);
    }

include "../conexion.php";
$sqlconsumomes= mysqli_query($conection,"SELECT 
												MONTHNAME(fecha) as Nmeses, 
												YEAR(fecha) as anio, 
												SUM(importe) as totalgas 
											FROM 
												carga_combustible 
											WHERE  
												MONTHNAME(fecha) = MONTHNAME(CURDATE()) 
												AND YEAR(fecha) = YEAR(CURDATE())  -- Asegura que es el año actual
												AND estatus <> 0
												GROUP BY Nmeses, anio");

if (!$sqlconsumomes) {
die("Error en la consulta: " . mysqli_error($conection));
};

$consumo_mes = number_format(0.00,2);

if ($datanc = mysqli_fetch_assoc($sqlconsumomes)) {
$consumo_mes = number_format($datanc['totalgas'],2);
};
												
  mysqli_close($conection);

  include "../conexion.php";
  $sqlconsumosem= mysqli_query($conection,"SELECT MONTHNAME(fecha) as Nmeses, YEAR(fecha), SUM(importe) as totalgas FROM carga_combustible WHERE fecha >= '$diaini' and fecha <= '$diafin' and estatus <> 0 GROUP BY fecha ");
  mysqli_close($conection);
  $result_sqlconsumosem = mysqli_num_rows($sqlconsumosem);

    while ($datacanc = mysqli_fetch_array($sqlconsumosem)){
      $consumo_semana   = number_format($datacanc['totalgas'],2);
      //$especiales   = $datav['viajes_especiales'];
     
  } 

  if (isset($consumo_semana)) {
      $consumosemana = $consumo_semana;
  }else {
      $consumosemana = 0;
  }

   include "../conexion.php";
     $sqlserv= mysqli_query($conection,"SELECT sum(if(servicio_ventas = 'Excelente',3, if(servicio_ventas = 'Bueno', 2, if(servicio_ventas = 'Regular', 1, if(servicio_ventas = 'Malo',0,0)))))/count(servicio_ventas) as sventas, sum(if(servicio_supervisor = 'Excelente',3, if(servicio_supervisor = 'Bueno', 2, if(servicio_supervisor = 'Regular', 1, if(servicio_supervisor = 'Malo',0,0)))))/count(servicio_supervisor) as ssuperv, sum(if(servicio_jefe = 'Excelente',3, if(servicio_jefe = 'Bueno', 2, if(servicio_jefe = 'Regular', 1, if(servicio_jefe = 'Malo',0,0)))))/count(servicio_jefe) as sjefe, sum(if(servicio_quejas = 'Excelente',3, if(servicio_quejas = 'Bueno', 2, if(servicio_quejas = 'Regular', 1, if(servicio_quejas = 'Malo',0,0)))))/count(servicio_quejas) as squejas FROM newencuesta_clientes where YEAR(fecha) = YEAR(CURDATE())");
    mysqli_close($conection);
    while ($rowsv = mysqli_fetch_array($sqlserv)){
    //extract $drow;
    
     $datosv[] = $rowsv['sventas'];
     $datoss[] = $rowsv['ssuperv'];
     $datosj[] = $rowsv['sjefe'];
     $datosq[] = $rowsv['squejas'];

    }


 include "../conexion.php";
     $sqlservct= mysqli_query($conection,"SELECT cliente, sum(if(servicio_ventas = 'Excelente',3, if(servicio_ventas = 'Bueno', 2, if(servicio_ventas = 'Regular', 1, if(servicio_ventas = 'Malo',0,0)))))/count(servicio_ventas) as sventas, sum(if(servicio_supervisor = 'Excelente',3, if(servicio_supervisor = 'Bueno', 2, if(servicio_supervisor = 'Regular', 1, if(servicio_supervisor = 'Malo',0,0)))))/count(servicio_supervisor) as ssuperv, sum(if(servicio_jefe = 'Excelente',3, if(servicio_jefe = 'Bueno', 2, if(servicio_jefe = 'Regular', 1, if(servicio_jefe = 'Malo',0,0)))))/count(servicio_jefe) as sjefe, sum(if(servicio_quejas = 'Excelente',3, if(servicio_quejas = 'Bueno', 2, if(servicio_quejas = 'Regular', 1, if(servicio_quejas = 'Malo',0,0)))))/count(servicio_quejas) as squejas FROM newencuesta_clientes where YEAR(fecha) = YEAR(CURDATE()) group by cliente");
    mysqli_close($conection);
    while ($rowsvc = mysqli_fetch_array($sqlservct)){
    //extract $drow;
    
     $datoscte[] = $rowsvc['cliente'];
     $datosvct[] = $rowsvc['sventas'];
     $datossct[] = $rowsvc['ssuperv'];
     $datosjct[] = $rowsvc['sjefe'];
     $datosqct[] = $rowsvc['squejas'];

    }


?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRANSVIVE | ERP</title>
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="local/apis.css">

  <script type="text/javascript" src="./local/jquery.min.js"></script>
  <!--<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>-->
  <script src="local/highcharts.js"></script>
  <script src="local/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js"></script>

  <link rel="stylesheet" href="alertifyjs/css/alertify.min.css">
  <link rel="stylesheet" href="alertifyjs/css/themes/default.min.css">
  <script src="alertifyjs/alertify.min.js"></script>

  <style>
    #container {
    min-width: 310px;
    max-width: 800px;
    height: 465px;

  
}

      .buttons {
    min-width: 310px;
    text-align: center;
    margin: 1rem 0;
    font-size: 0;
}

.buttons button {
    cursor: pointer;
    border: 1px solid silver;
    border-right-width: 0;
    background-color: #f8f8f8;
    font-size: 1rem;
    padding: 0.5rem;
    transition-duration: 0.3s;
    margin: 0;
}

.buttons button:first-child {
    border-top-left-radius: 0.3em;
    border-bottom-left-radius: 0.3em;
}

.buttons button:last-child {
    border-top-right-radius: 0.3em;
    border-bottom-right-radius: 0.3em;
    border-right-width: 1px;
}

.buttons button:hover {
    color: white;
    background-color: rgb(158 159 163);
    outline: none;
}

.buttons button.active {
    background-color: #0051b4;
    color: white;
}

/* container 2 */
#container2,
.highcharts-data-table table {
    min-width: 350px;
    max-width: 800px;
    margin: 1em auto;
}

#container2 {
    height: 450px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

#container3 {
    height: 400px;
}

/* container 4d */
#container4d,
.highcharts-data-table table {
    min-width: 350px;
    max-width: 800px;
    margin: 1em auto;
}

#container4d {
    height: 450px;
}

/* container 5d */
#container5d,
.highcharts-data-table table {
    min-width: 350px;
    max-width: 800px;
    margin: 1em auto;
}

#container5d {
    height: 450px;
}

/* container 6d */
#container6d,
.highcharts-data-table table {
    min-width: 350px;
    max-width: 800px;
    margin: 1em auto;
}

#container6d {
    height: 450px;
}


.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

  </style>


</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php include('includes/navbar.php') ?>
      <?php include('includes/nav.php') ?> 

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
 
    <!-- /.content-header -->
  <br>
    <!-- Main content -->
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-6">

                <!-- ./card-body -->
              <div class="card-footer">
                <p class="text-center">
                      <strong>Ordenes de Servicio Semana en Curso <br><?php echo $name_semana; ?></strong>
                    </p>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="description-block border-right">
                      <span class="description-percentage text-primary"><i class="fas fa-caret-left"></i> <?php echo $porc_planeados; ?> %</span>
                      <h5 class="description-header"><?php echo $vjs_planeados; ?></h5>
                      <span class="description-text">Viajes Planeados</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-3">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?php echo $porc_registrados; ?> %</span>
                      <h5 class="description-header"><?php echo number_format($nv_registrados,2); ?></h5>
                      <span class="description-text">Viajes Registrados</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-3">
                    <div class="description-block border-right">
                      <span class="description-percentage text-info"><i class="fas fa-caret-up"></i> <?php echo $porc_diferencia; ?> %</span>
                      <h5 class="description-header"><?php echo $vjs_diferencia; ?></h5>
                      <span class="description-text">Diferencia</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-3">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> <?php echo $porc_cancelados; ?> %</span>
                      <h5 class="description-header"><?php echo $v_cancelados; ?></h5>
                      <span class="description-text">Viajes Cancelados</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
        </div>  

        <div class="col-lg-6">

                <!-- ./card-body -->
              <div class="card-footer">
                <p class="text-center">
                      <strong>Acumulados Mes / Semama<br><?php echo $NameMes; ?> / <?php echo $name_semana; ?></strong>
                    </p>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="description-block border-right">
                      <span class="description-percentage text-primary"><i class="fas fa-cart-plus"></i> &nbsp; </span>
                      <h5 class="description-header"><?php echo $comprasmes; ?></h5>
                      <span class="description-text">Compras del Mes</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-3">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-cart-arrow-down"></i> &nbsp;</span>
                      <h5 class="description-header"><?php echo $comprassem; ?></h5>
                      <span class="description-text">Compras Semana</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-3">
                    <div class="description-block border-right">
                      <span class="description-percentage text-primary"><i class="fas fa-gas-pump"></i> &nbsp; </span>
                      <h5 class="description-header"><?php echo $nconsumo_mes; ?></h5>
                      <span class="description-text">Consumo Mes</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-3">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-gas-pump"></i> &nbsp; </span>
                      <h5 class="description-header"><?php echo $consumosemana; ?></h5>
                      <span class="description-text">Consumo Semana</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
        </div>

      </div>

      <br>

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="position-relative mb-4">
                  <figure class="highcharts-figure">
                   
                    <div id="container"></div>
                  </figure>
                </div>
              
            </div>
           
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
             <div class="position-relative mb-4">
                <figure class="highcharts-figure">
    <div id="container4d"></div>
    <p class="highcharts-description">
        
    </p>
</figure>
                </div>
              
            </div>
            <!-- /.card -->

         
          </div>
          <!-- /.col-md-6 -->
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Encuestas de Calidad</span>
                    <span>Año: <?php echo $aniocurso; ?></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <!--<i class="fas fa-arrow-up"></i> -->
                    </span>
                    <span class="text-muted"></span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="myChart" height="220"></canvas>
                </div>

               
              </div>
            </div>
           
          </div>

          <div class="col-lg-6">
            <div class="card">
              
              <div class="card-body" style="height:550px">
               <p class="text-center">
                     <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Resultado de Encuesta por Concepto</span>
                    <span><b>Promedio General: <?php echo number_format($promedio,2). '%'; ?></b></span>
                  </p>
                    </p>

                    <div class="progress-group">
                      Atención General
                      <span class="float-right"><b><?php echo $respuesta1; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo $respuesta1; ?>"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Tiempo de Respuesta
                      <span class="float-right"><b><?php echo $respuesta2; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: <?php echo $respuesta2; ?>"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Diponibilidad del Servicio</span>
                      <span class="float-right"><b><?php echo $respuesta3; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $respuesta3; ?>"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Calidad de Nuestros Servicios
                      <span class="float-right"><b><?php echo $respuesta4; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php echo $respuesta4; ?>"></div>
                      </div>
                    </div>

                     <!-- /.progress-group -->
                    <div class="progress-group">
                      Asesoria técnica (tipo de unidades, modelos, capacidad de pasajeros) 
                      <span class="float-right"><b><?php echo $respuesta5; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo $respuesta5; ?>"></div>
                      </div>
                    </div>


                    <div class="progress-group">
                      Limpieza y Condición de Unidades
                      <span class="float-right"><b><?php echo $respuesta6; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: <?php echo $respuesta6; ?>"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      Atención, servicio, limpieza y presentación del operador
                      <span class="float-right"><b><?php echo $respuesta7; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $respuesta7; ?>"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      El operador conduce la unidad adecuadamente
                      <span class="float-right"><b><?php echo $respuesta8; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php echo $respuesta8; ?>"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      Atencion y servicio del área de calidad 
                      <span class="float-right"><b><?php echo $respuesta9; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo $respuesta9; ?>"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      Como considera el servico de facturación
                      <span class="float-right"><b><?php echo $respuesta10; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: <?php echo $respuesta10; ?>"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      Nuestros precios
                      <span class="float-right"><b><?php echo $respuesta11; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $respuesta11; ?>"></div>
                      </div>
                    </div>
              </div>
            </div>
           
          </div>


        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="position-relative mb-4">
                  <figure class="highcharts-figure">
                   
                    <div id="container5d"></div>
                  </figure>
                </div>
              
            </div>
           
          </div>
          <!-- /.col-md-6 -->
         <div class="col-lg-6">
            <div class="card">
              <div class="position-relative mb-4">
                  <figure class="highcharts-figure">
                   
                    <div id="container6d"></div>
                  </figure>
                </div>
              
            </div>
           
          </div>

          </div>
          <!-- /.col-md-6 -->
        </div>



        <!--
         <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="position-relative mb-4">
                  <figure class="highcharts-figure">
                   
                    <div id="container4d"></div>
                  </figure>
                </div>
              
            </div>
          </div>
        </div> -->
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>

   

</div>
  
    <!-- /.content -->

    

  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include('includes/footer.php') ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<!-- DataTables JS library -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables JBootstrap -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- <script src="../dist/js/pages/dashboard3.js"></script>-->
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

<script src="js/sweetalert2.all.min.js"></script>  
<!--<script src="../dist/js/pages/dashboard3.js"></script> -->
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script> 


 <!-- <?php

  include "../conexion.php";  
     
// Consulta para obtener la fecha de vencimiento
$sqldate = "SELECT nombre as cliente, fecha_iniciacontrato, fecha_fincontrato FROM clientes WHERE DATE(fecha_fincontrato) < DATE_SUB(NOW(),INTERVAL 30 DAY) and fecha_fincontrato > '2020-01-01' and estatus = 1";
$resultado = mysqli_query($conection, $sqldate);

// Verificación del resultado de la consulta
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
   
    $namecliente = $fila ['cliente'];  
    //$fcha = date("d-m-Y",  $fila['fecha_vencimiento'] );
    $newDate3 = date("d/m/Y", strtotime($fila['fecha_fincontrato']));
       
  ?>  
   
     <script>

     alert('\t Contratos vencidos y/o prontos a vencer. \t \n\t \u00A0 \n\t Cliente: <?php echo $namecliente; ?> \n\t Fecha de vencimiento: <?php echo $newDate3; ?> ')

    </script>
  
    <?php 
    }  

    }else {
     ?>  
  
 
     <script>

     //* alert('\t No Hay contratos por vencer o vencidos')

    </script>
<?php 
    }

?> -->



<script>
  
 var densityCanvas = document.getElementById("densityChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var densityData = {
  label: 'Calificación',
  data: [<?php echo $resp_1; ?>, <?php echo $resp_2; ?>, <?php echo $resp_3; ?>, <?php echo $resp_4; ?>, <?php echo $resp_5; ?>, <?php echo $resp_6; ?>],
   backgroundColor: 'rgba(253, 197, 100, 0.6)',
  borderColor: 'rgba(253, 197, 100, 1)',
};

var barChart = new Chart(densityCanvas, {
  type: 'bar',
  data: {
    labels: ["Servicio Ventas", "Servicio Transporte", "Servicio Operador", "Servicio Supervisor", "Servicio Operaciones", "Atención y Resolución"],
    datasets: [densityData]
  }
});
</script>

<script>


   Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Registro de Viajes Planeados vs Registrados',
        align: 'left'
    },
    subtitle: {
        text: 'Año en curso',
        align: 'left'
    },
    xAxis: {
        categories: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        //categories:  [<?php echo join($dato2, ',') ?>],
        title: {
            text: null
        },
        gridLineWidth: 1,
        lineWidth: 0
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (viajes)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        },
        gridLineWidth: 0
    },
    tooltip: {
        valueSuffix: ' viajes'
    },
    plotOptions: {
        bar: {
            borderRadius: '50%',
            dataLabels: {
                enabled: true
            },
            groupPadding: 0.1
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -10,
        y: 310,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
 
    

    series: [{
        name: 'Planeados',
        data: [<?php echo join($dato2, ',') ?>],
    }, {
        name: 'Registrados',
        data: [<?php echo join($dato3, ',') ?>],
    }, {
        name: 'Diferencia %',
        data: [<?php echo join($dato5, ',') ?>],
    }]
  
});


</script> 

<!-- Container 2  -->  

<script>
Highcharts.chart('container2', {

    title: {
        text: 'Consumo de Combustible',
        align: 'left'
    },

    subtitle: {
        text: 'Año en curso',
        align: 'left'
    },

    xAxis: {
        categories: [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ]
    },

    yAxis: {
        title: {
            text: 'Consumo por mes'
        }
    },

   

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 0
        }
    },

    series: [{
        name: 'Importe',
        data: [<?php echo $nimportemes1; ?>, <?php echo $nimportemes2; ?>, <?php echo $nimportemes3; ?>, <?php echo $nimportemes4; ?>, <?php echo $nimportemes5; ?>, <?php echo $nimportemes6; ?>, <?php echo $nimportemes7; ?>, <?php echo $nimportemes8; ?>, <?php echo $nimportemes9; ?>, <?php echo $nimportemes10; ?>, <?php echo $nimportemes11; ?>, <?php echo $nimportemes12; ?>]
    }, {
        name: 'Litros',
        data: [<?php echo $nlitros1; ?>, <?php echo $nlitros2; ?>, <?php echo $nlitros3; ?>, <?php echo $nlitros4; ?>, <?php echo $nlitros5; ?>, <?php echo $nlitros6; ?>, <?php echo $nlitros7; ?>, <?php echo $nlitros8; ?>, <?php echo $nlitros9; ?>, <?php echo $nlitros10; ?>, <?php echo $nlitros11; ?>, <?php echo $nlitros12; ?>]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});


</script>



<script>
  
  var ctx = document.getElementById('myChart')
        var myChart = new Chart(ctx, {
            type:'bar',
            data:{
                datasets: [{
                    label: 'Tiempo forma',
                    backgroundColor: ['#63d69f','#63d69f','#63d69f','#63d69f','#63d69f','#63d69f','#63d69f','#63d69f'],
                    borderColor: ['black'],
                    borderWidth:0
                },{
                    label: 'Tiempo respuesta',
                    backgroundColor: ['#438c6c','#438c6c','#438c6c','#438c6c','#438c6c','#438c6c','#438c6c','#438c6c'],
                    borderColor: ['black'],
                    borderWidth:0
                },{
                    label: 'Disponibilidad',
                    backgroundColor: ['#509c7f','#509c7f','#509c7f','#509c7f','#509c7f','#509c7f','#509c7f','#509c7f'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Calidad',
                    backgroundColor: ['#1f794e','#1f794e','#1f794e','#1f794e','#1f794e','#1f794e','#1f794e','#1f794e'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Asesoria tecnica',
                    backgroundColor: ['#34444c','#34444c','#34444c','#34444c','#34444c','#34444c','#34444c','#34444c'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Limpieza Condicion',
                    backgroundColor: ['#90CAF9','#90CAF9','#90CAF9','#90CAF9','#90CAF9','#90CAF9','#90CAF9','#90CAF9'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Servicio Operador',
                    backgroundColor: ['#64B5F6','#64B5F6','#64B5F6','#64B5F6','#64B5F6','#64B5F6','#64B5F6','#64B5F6'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Conduce adecuado',
                    backgroundColor: ['#42A5F5','#42A5F5','#42A5F5','#42A5F5','#42A5F5','#42A5F5','#42A5F5','#42A5F5'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Atencion Calidad',
                    backgroundColor: ['#2196F3','#2196F3','#2196F3','#2196F3','#2196F3','#2196F3','#2196F3','#2196F3'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Servicio facturacion',
                    backgroundColor: ['#0D47A1','#0D47A1','#0D47A1','#0D47A1','#0D47A1','#0D47A1','#0D47A1','#0D47A1'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                },{
                    label: 'Nuestros precios',
                    backgroundColor: ['#9C74F7','#9C74F7','#9C74F7','#9C74F7','#9C74F7','#9C74F7','#9C74F7','#9C74F7'],
                    borderColor: ['black'],
                    borderWidth:0
                    
                }]
            },
            options:{
                scales: {
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true
                }
            }]
        }
            }
        })

        let url = 'includes/articulos.php'
        fetch(url)
            .then( response => response.json() )
            .then( datos => mostrar(datos) )
            .catch( error => console.log(error) )


        const mostrar = (articulos) =>{
            articulos.forEach(element => {
                myChart.data['labels'].push(element.cliente)
                {
                  myChart.data['datasets'][0].data.push(element.tiempo_forma);
               
                  myChart.data['datasets'][1].data.push(element.tiempo_respuesta);

                  myChart.data['datasets'][2].data.push(element.disponibilidad);

                  myChart.data['datasets'][3].data.push(element.calidad);

                  myChart.data['datasets'][4].data.push(element.asesoria_tecnica);

                  myChart.data['datasets'][5].data.push(element.limpieza_condicion);

                  myChart.data['datasets'][6].data.push(element.servicio_operador);

                  myChart.data['datasets'][7].data.push(element.conduce_adecuado);

                  myChart.data['datasets'][8].data.push(element.atencion_calidad);

                  myChart.data['datasets'][9].data.push(element.servicio_facturacion);

                  myChart.data['datasets'][10].data.push(element.nuestros_precios);

                }
                                   
                
                myChart.update()
            });
            console.log(myChart.data)
        }    

</script>

<script>
    
    Highcharts.chart('container4d', {

    title: {
        text: 'Compras / Consumo de Combustible por Mes ',
        align: 'left'
    },

    subtitle: {
        text: 'Año en curso',
        align: 'left'
    },

    yAxis: {
        title: {
            text: 'Importe / Consumo'
        }
    },

    xAxis: {
        categories: [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ]
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 0
        }
    },

    series: [{
        name: 'Importe Compras',
        data: [<?php echo $comprames1; ?>, <?php echo $comprames2; ?>, <?php echo $comprames3; ?>, <?php echo $comprames4; ?>, <?php echo $comprames5; ?>, <?php echo $comprames6; ?>, <?php echo $comprames7; ?>, <?php echo $comprames8; ?>, <?php echo $comprames9; ?>, <?php echo $comprames10; ?>, <?php echo $comprames11; ?>, <?php echo $comprames12; ?>]
    }, {
        name: 'Importe O. de Compra',
        data: [<?php echo $ocomprames1; ?>, <?php echo $ocomprames2; ?>, <?php echo $ocomprames3; ?>, <?php echo $ocomprames4; ?>, <?php echo $ocomprames5; ?>, <?php echo $ocomprames6; ?>, <?php echo $ocomprames7; ?>, <?php echo $ocomprames8; ?>, <?php echo $ocomprames9; ?>, <?php echo $ocomprames10; ?>, <?php echo $ocomprames11; ?>, <?php echo $ocomprames12; ?>]
    },{
        name: 'Importe Combustible',
        data: [<?php echo $nimportemes1; ?>, <?php echo $nimportemes2; ?>, <?php echo $nimportemes3; ?>, <?php echo $nimportemes4; ?>, <?php echo $nimportemes5; ?>, <?php echo $nimportemes6; ?>, <?php echo $nimportemes7; ?>, <?php echo $nimportemes8; ?>, <?php echo $nimportemes9; ?>, <?php echo $nimportemes10; ?>, <?php echo $nimportemes11; ?>, <?php echo $nimportemes12; ?>]
    },{
        name: 'Litros Combustible',
        data: [<?php echo $nlitros1; ?>, <?php echo $nlitros2; ?>, <?php echo $nlitros3; ?>, <?php echo $nlitros4; ?>, <?php echo $nlitros5; ?>, <?php echo $nlitros6; ?>, <?php echo $nlitros7; ?>, <?php echo $nlitros8; ?>, <?php echo $nlitros9; ?>, <?php echo $nlitros10; ?>, <?php echo $nlitros11; ?>, <?php echo $nlitros12; ?>]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>


<script>
    
    Highcharts.chart('container5d', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Calificación de Clientes a Servicios',
        align: 'left'
    },
    subtitle: {
        text:
            'Calificacion: 3 Excelente - 2 Bueno - 1 Regular - 0 Malo ',
        align: 'left'
    },
    xAxis: {
        categories: ['Calificacion Servicios', 'China', 'Brazil', 'EU'],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Puntos'
        }
    },
    tooltip: {
        valueDecimals: 2,
        valueSuffix: ' Puntos'
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },
    series: [
        {
            name: 'Servicio Ventas',
            data: [<?php echo join($datosv, ',') ?>]
        },
        {
            name: 'Servicio Supervisor',
            data: [<?php echo join($datoss, ',') ?>]
        }, 
        {
            name: 'Servicio Jefe Operaciones',
            data: [<?php echo join($datosj, ',') ?>]
        }, 
        {
            name: 'Servicio Quejas',
            data: [<?php echo join($datosq, ',') ?>]
        }
    ]
});
</script>
<script>
    Highcharts.chart('container6d', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Calificación de Clientes a Servicios',
        align: 'left'
    },
    subtitle: {
        text:
            'Calificacion: 3 Excelente - 2 Bueno - 1 Regular - 0 Malo ',
        align: 'left'
    },
    xAxis: {
        categories: ['<?php echo join($datoscte, "','") ?>'],

        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Puntos'
        }
    },
    tooltip: {
        valueDecimals: 2,
        valueSuffix: ' Puntos'
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },
    series: [
        {
            name: 'Servicio Ventas',
            data: [<?php echo join($datosvct, ',') ?>]
        },
        {
            name: 'Servicio Supervisor',
            data: [<?php echo join($datossct, ',') ?>]
        }, 
        {
            name: 'Servicio Jefe Operaciones',
            data: [<?php echo join($datosjct, ',') ?>]
        }, 
        {
            name: 'Servicio Quejas',
            data: [<?php echo join($datosqct, ',') ?>]
        }
    ]
});
</script>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function(){
      // Invocamos cada 5 segundos ;)
      const milisegundos = 5 *1000;
      setInterval(function(){
      // No esperamos la respuesta de la petición porque no nos importa
         fetch("./refrescar.php");
      },milisegundos);
    });
</script> -->
<script src="js/sweetalert.min.js"></script>
</body>
</html>
