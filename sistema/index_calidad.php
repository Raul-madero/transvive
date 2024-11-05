<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqlenc= mysqli_query($conection,"SELECT MONTH(fecha) as Nmes, YEAR(fecha), SUM(importe) as Importec, sum(litros) as Litros FROM carga_combustible WHERE YEAR(fecha) = YEAR(CURDATE()) GROUP BY MONTH(fecha)");
  mysqli_close($conection);
  $result_sqlenc = mysqli_num_rows($sqlenc);

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
  

  include "../conexion.php";
   $sqlenc23= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM newencuesta_clientes where YEAR(fecha)  = 2023");
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
    $resp1_28 = number_format($dataenc['Timeforma'],1); 
    $resp2_28 = number_format($dataenc['Timerespuesta'],1); 
    $resp3_28 = number_format($dataenc['Disponibilidad'],1); 
    $resp4_28 = number_format($dataenc['Calidad'],1); 
    $resp5_28 = number_format($dataenc['Asesoriatecnica'],1); 
    $resp6_28 = number_format($dataenc['Limpieza'],1);
    $resp7_28 = number_format($dataenc['Servicio'],1);
    $resp8_28 = number_format($dataenc['Conduce'],1);
    $resp9_28 = number_format($dataenc['Atencion'],1);
    $resp10_28 = number_format($dataenc['Facturacion'],1);
    $resp11_28 = number_format($dataenc['Precios'],1);
    $resp12_28 = number_format($dataenc['Numeroreg'],0);
     
  }

  include "../conexion.php";
  $sqlviajes= mysqli_query($conection,"SELECT MONTHNAME(fecha) as Nmeses, YEAR(fecha), SUM(IF(planeado=1, valor_vuelta, 0)) as Planeados, SUM(valor_vuelta) as Registrados,(SUM(valor_vuelta)  - SUM(IF(planeado=1, valor_vuelta, 0))) as Diferencia  FROM registro_viajes WHERE YEAR(fecha) = YEAR(CURDATE()) and estatus = 2 GROUP BY MONTH(fecha)");
  mysqli_close($conection);
  while ($drow = mysqli_fetch_array($sqlviajes)){
   //extract $drow;
    $t = $drow ['Nmeses'];
    

    $values[] = $t;
   $dato2[] = $drow['Planeados'];
   $dato3[] = $drow['Registrados'];
   $dato4[] = $drow['Diferencia'];

}

include "../conexion.php";
  $sqlviajes= mysqli_query($conection,"TRUNCATE rep_viajescte");
  mysqli_close($conection);

include "../conexion.php";
  $sqlviajes= mysqli_query($conection,"INSERT INTO rep_viajescte (cliente, enero) SELECT cliente, sum(valor_vuelta) FROM registro_viajes WHERE estatus = 2 and  MONTH(fecha) = 1 GROUP BY  cliente");
  mysqli_close($conection);

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
  <link rel="stylesheet" href="./local/apis.css">

  <script type="text/javascript" src="./local/jquery.min.js"></script>
  <!--<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>-->
  <script src="./local/highcharts.js"></script>
  <script src="./local/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js"></script>

  <link rel="stylesheet" href="./alertifyjs/css/alertify.min.css">
  <link rel="stylesheet" href="./alertifyjs/css/themes/default.min.css">
  <script src="./alertifyjs/alertify.min.js"></script>

  <style>
     .highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 1000px;
    margin: 1em auto;
}

    #container {
    min-width: 310px;
    max-width: 800px;
    height: 475px;

  
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

      <?php include('includes/navbarcalidad.php') ?>
      <?php include('includes/navc.php') ?>

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
          <div class="col-lg-12">
            <div class="card">
              <div class="position-relative mb-4">
                   <figure class="highcharts-figure">
                    <div class='buttons'>
                         <button id='2023'>
                                     2023
                         </button>
                         <button id='2024' class="active">
                                     2024
                         </button>
                         <button id='2025'>
                                     2025
                         </button>
                         <button id='2026'>
                                     2026
                         </button>
                         <button id='2027'>
                                     2027
                         </button>
                         <button id='2028'>
                                     2028
                         </button>
                         </div>
    <div id="container"></div>
  </figure>
                </div>
              
            </div>
           
          </div>
          <!-- /.col-md-6 -->
        
          <!-- /.col-md-6 -->
        </div>
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


 <?php

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
    <!--
     <script>
   
     alert('\t Contratos vencidos y/o prontos a vencer. \t \n\t \u00A0 \n\t Cliente: <?php echo $namecliente; ?> \n\t Fecha de vencimiento: <?php echo $newDate3; ?> ')

    </script>
    -->
    <?php 
    }  

    }else {
     ?>  
  
 
     <script>

     //* alert('\t No Hay contratos por vencer o vencidos')

    </script>
<?php 
    }

?>



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
  
    const dataPrev = {
    2023: [
        ['precio', 0],
        ['facturacion', 0],
        ['atencion', 0],
        ['conduce_adecuado', 0],
        ['servicio', 0],
        ['limpieza', 0],
        ['asesoria_tecnica', 0],
        ['calidad', 0],
        ['disponibilidad', 0],
        ['timpo_respuesta', 0],
        ['tiempo_forma', 0]
    ],
    2024: [
        ['precio', <?php echo $resp11_23; ?>],
        ['facturacion', <?php echo $resp10_23; ?>],
        ['atencion', <?php echo $resp9_23; ?>],
        ['conduce_adecuado', <?php echo $resp8_23; ?>],
        ['servicio', <?php echo $resp7_23; ?>],
        ['limpieza', <?php echo $resp6_23; ?>],
        ['asesoria_tecnica', <?php echo $resp5_23; ?>],
        ['calidad', <?php echo $resp4_23; ?>],
        ['disponibilidad', <?php echo $resp3_23; ?>],
        ['tiempo_respuesta', <?php echo $resp2_23; ?>],
        ['tiempo_forma', <?php echo $resp1_23; ?>]
    ],
    2025: [
        ['precio', <?php echo $resp11_24; ?>],
        ['facturacion', <?php echo $resp10_24; ?>],
        ['atencion', <?php echo $resp9_24; ?>],
        ['conduce_adecuado', <?php echo $resp8_24; ?>],
        ['servicio', <?php echo $resp7_24; ?>],
        ['limpieza', <?php echo $resp6_24; ?>],
        ['asesoria_tecnica', <?php echo $resp5_24; ?>],
        ['calidad', <?php echo $resp4_24; ?>],
        ['disponibilidad', <?php echo $resp3_24; ?>],
        ['tiempo_respuesta', <?php echo $resp2_24; ?>],
        ['tiempo_forma', <?php echo $resp1_24; ?>]
    ],
    2026: [
        ['precio', <?php echo $resp11_25; ?>],
        ['facturacion', <?php echo $resp10_25; ?>],
        ['atencion', <?php echo $resp9_25; ?>],
        ['conduce_adecuado', <?php echo $resp8_25; ?>],
        ['servicio', <?php echo $resp7_25; ?>],
        ['limpieza', <?php echo $resp6_25; ?>],
        ['asesoria_tecnica', <?php echo $resp5_25; ?>],
        ['calidad', <?php echo $resp4_25; ?>],
        ['disponibilidad', <?php echo $resp3_25; ?>],
        ['tiempo_respuesta', <?php echo $resp2_25; ?>],
        ['tiempo_forma', <?php echo $resp1_25; ?>]
    ],
    2027: [
        ['precio', <?php echo $resp11_26; ?>],
        ['facturacion', <?php echo $resp10_26; ?>],
        ['atencion', <?php echo $resp9_26; ?>],
        ['conduce_adecuado', <?php echo $resp8_26; ?>],
        ['servicio', <?php echo $resp7_26; ?>],
        ['limpieza', <?php echo $resp6_26; ?>],
        ['asesoria_tecnica', <?php echo $resp5_26; ?>],
        ['calidad', <?php echo $resp4_26; ?>],
        ['disponibilidad', <?php echo $resp3_26; ?>],
        ['tiempo_respuesta', <?php echo $resp2_26; ?>],
        ['tiempo_forma', <?php echo $resp1_26; ?>]
    ],
    2028: [
        ['precio', <?php echo $resp11_27; ?>],
        ['facturacion', <?php echo $resp10_27; ?>],
        ['atencion', <?php echo $resp9_27; ?>],
        ['conduce_adecuado', <?php echo $resp8_27; ?>],
        ['servicio', <?php echo $resp7_27; ?>],
        ['limpieza', <?php echo $resp6_27; ?>],
        ['asesoria_tecnica', <?php echo $resp5_27; ?>],
        ['calidad', <?php echo $resp4_27; ?>],
        ['disponibilidad', <?php echo $resp3_27; ?>],
        ['tiempo_respuesta', <?php echo $resp2_27; ?>],
        ['tiempo_forma', <?php echo $resp1_27; ?>]
    ]
};

const data = {
    2023: [
        ['precio', <?php echo $resp11_23; ?>],
        ['facturacion', <?php echo $resp10_23; ?>],
        ['atencion', <?php echo $resp9_23; ?>],
        ['conduce_adecuado', <?php echo $resp8_23; ?>],
        ['servicio', <?php echo $resp7_23; ?>],
        ['limpieza', <?php echo $resp6_23; ?>],
        ['asesoria_tecnica', <?php echo $resp5_23; ?>],
        ['calidad', <?php echo $resp4_23; ?>],
        ['disponibilidad', <?php echo $resp3_23; ?>],
        ['tiempo_respuesta', <?php echo $resp2_23; ?>],
        ['tiempo_forma', <?php echo $resp1_23; ?>]
    ],
    2024: [
        ['precio', <?php echo $resp11_24; ?>],
        ['facturacion', <?php echo $resp10_24; ?>],
        ['atencion', <?php echo $resp9_24; ?>],
        ['conduce_adecuado', <?php echo $resp8_24; ?>],
        ['servicio', <?php echo $resp7_24; ?>],
        ['limpieza', <?php echo $resp6_24; ?>],
        ['asesoria_tecnica', <?php echo $resp5_24; ?>],
        ['calidad', <?php echo $resp4_24; ?>],
        ['disponibilidad', <?php echo $resp3_24; ?>],
        ['tiempo_respuesta', <?php echo $resp2_24; ?>],
        ['tiempo_forma', <?php echo $resp1_24; ?>]
    ],
    2025: [
        ['precio', <?php echo $resp11_25; ?>],
        ['facturacion', <?php echo $resp10_25; ?>],
        ['atencion', <?php echo $resp9_25; ?>],
        ['conduce_adecuado', <?php echo $resp8_25; ?>],
        ['servicio', <?php echo $resp7_25; ?>],
        ['limpieza', <?php echo $resp6_25; ?>],
        ['asesoria_tecnica', <?php echo $resp5_25; ?>],
        ['calidad', <?php echo $resp4_25; ?>],
        ['disponibilidad', <?php echo $resp3_25; ?>],
        ['tiempo_respuesta', <?php echo $resp2_25; ?>],
        ['tiempo_forma', <?php echo $resp1_25; ?>]
    ],
    2026: [
        ['precio', <?php echo $resp11_26; ?>],
        ['facturacion', <?php echo $resp10_26; ?>],
        ['atencion', <?php echo $resp9_26; ?>],
        ['conduce_adecuado', <?php echo $resp8_26; ?>],
        ['servicio', <?php echo $resp7_26; ?>],
        ['limpieza', <?php echo $resp6_26; ?>],
        ['asesoria_tecnica', <?php echo $resp5_26; ?>],
        ['calidad', <?php echo $resp4_26; ?>],
        ['disponibilidad', <?php echo $resp3_26; ?>],
        ['tiempo_respuesta', <?php echo $resp2_26; ?>],
        ['tiempo_forma', <?php echo $resp1_26; ?>]
    ],
    2027: [
        ['precio', <?php echo $resp11_27; ?>],
        ['facturacion', <?php echo $resp10_27; ?>],
        ['atencion', <?php echo $resp9_27; ?>],
        ['conduce_adecuado', <?php echo $resp8_27; ?>],
        ['servicio', <?php echo $resp7_27; ?>],
        ['limpieza', <?php echo $resp6_27; ?>],
        ['asesoria_tecnica', <?php echo $resp5_27; ?>],
        ['calidad', <?php echo $resp4_27; ?>],
        ['disponibilidad', <?php echo $resp3_27; ?>],
        ['tiempo_respuesta', <?php echo $resp2_27; ?>],
        ['tiempo_forma', <?php echo $resp1_27; ?>]
    ],
    2028: [
        ['precio', <?php echo $resp11_28; ?>],
        ['facturacion', <?php echo $resp10_28; ?>],
        ['atencion', <?php echo $resp9_28; ?>],
        ['conduce_adecuado', <?php echo $resp8_28; ?>],
        ['servicio', <?php echo $resp7_28; ?>],
        ['limpieza', <?php echo $resp6_28; ?>],
        ['asesoria_tecnica', <?php echo $resp5_28; ?>],
        ['calidad', <?php echo $resp4_28; ?>],
        ['disponibilidad', <?php echo $resp3_28; ?>],
        ['tiempo_respuesta', <?php echo $resp2_28; ?>],
        ['tiempo_forma', <?php echo $resp1_28; ?>]
    ]
};

const countries = {
    precio: {
        name: 'Precio',
        color: '#544FC5'
    },
    facturacion: {
        name: 'Facturación',
        color: '#00A6A6'
    },
    atencion: {
        name: 'Atención',
        color: '#6B8ABC'
    },
    conduce_adecuado: {
        name: 'Conduce adecuado',
        color: '#2CAFFE'
    },
    servicio: {
        name: 'Servicio',
        color: '#544FC5'
    },
    limpieza: {
        name: 'Limpieza',
        color: '#2CAFFE'
    },
    asesoria_tecnica: {
        name: 'Asesoría técnica',
        color: '#FE6A35'
    },
    calidad: {
        name: 'Calidad',
        color: '#6B8ABC'
    },
    disponibilidad: {
        name: 'Disponibilidad',
        color: '#1C74BD'
    },
    tiempo_respuesta: {
        name: 'Tiempo repuesta',
        color: '#00A6A6'
    },
    tiempo_forma: {
        name: 'Tiempo Forma',
        color: '#D568FB'
    }
};

// Add upper case country code
for (const [key, value] of Object.entries(countries)) {
    value.ucCode = key.toUpperCase();
}


const getData = data => data.map(point => ({
    name: point[0],
    y: point[1],
    color: countries[point[0]].color
}));

const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    // Custom option for templates
    countries,
    title: {
        text: 'Resultado de Encuesta de Satisfacción ',
        align: 'left'
    },
    subtitle: {
        text: ' ' +
            '' +
            '',
        align: 'left'
    },
    plotOptions: {
        series: {
            grouping: false,
            borderWidth: 0
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        shared: true,
        headerFormat: '<span style="font-size: 15px">' +
            '{series.chart.options.countries.(point.key).name}' +
            '</span><br/>',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> ' +
            '{series.name}: <b>{point.y} %</b><br/>'
    },
    xAxis: {
        type: 'category',
        accessibility: {
            description: 'Countries'
        },
        max: 10,
        labels: {
            useHTML: true,
            animate: true,
            format: '{chart.options.countries.(value).ucCode}<br>' +
                '<span class="f32">' +
                '<span style="display:inline-block;height:32px;vertical-align:text-top;" ' +
                'class="flag {value}"></span></span>',
            style: {
                textAlign: 'center'
            }
        }
    },
    yAxis: [{
        title: {
            text: '% Calificación'
        },
        showFirstLabel: false
    }],
    series: [{
        color: 'rgba(158, 159, 163, 0.5)',
        pointPlacement: -0.2,
        linkedTo: 'main',
        data: dataPrev[2024].slice(),
        name: '2023'
    }, {
        name: '2024',
        id: 'main',
        dataSorting: {
            enabled: true,
            matchByName: true
        },
        dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize: '16px'
            }
        }],
        data: getData(data[2024]).slice()
    }],
    exporting: {
        allowHTML: true
    }
});

const locations = [
    {
        city: 'Tokyo',
        year: 2023
    }, {
        city: 'Rio',
        year: 2024
    }, {
        city: 'London',
        year: 2025
    }, {
        city: 'Beijing',
        year: 2026
    }, {
        city: 'Athens',
        year: 2027
    }, {
        city: 'Sydney',
        year: 2028
    }
];


locations.forEach(location => {
    const btn = document.getElementById(location.year);
    var btnyear = (location.year);
    

    btn.addEventListener('click', () => {
        
    if (btnyear == 2023) {
        var nencuesta = '<?php echo $resp12_23;?>';
    }else {
        if (btnyear == 2024) {
            var nencuesta = '<?php echo $resp12_24;?>';
        }else {
        var nencuesta = '';
    }
    }


        document.querySelectorAll('.buttons button.active')
            .forEach(active => {
                active.className = '';
            });
        btn.className = 'active';

        chart.update({
            title: {
                text: 'Resultado de Encuesta de Satisfacción ' + location.year + '' +
                    ''
            },
            subtitle: {
                text: 'Numero de Encuestas: ' +
                     '<span class="f32">' +
                     nencuesta + '</span>'
                    
            },
            series: [{
                name: location.year - 1,
                data: dataPrev[location.year].slice()
            }, {
                name: location.year,
                data: getData(data[location.year]).slice()
            }]
        }, true, false, {
            duration: 800
        });
    });
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

    yAxis: {
        title: {
            text: 'Consumo por mes'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 1 to 12'
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
            pointStart: 1
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
    document.addEventListener("DOMContentLoaded", function(){
      // Invocamos cada 5 segundos ;)
      const milisegundos = 5 *1000;
      setInterval(function(){
      // No esperamos la respuesta de la petición porque no nos importa
         fetch("./refrescar.php");
      },milisegundos);
    });
</script>
<script src="js/sweetalert.min.js"></script>
</body>
</html>
