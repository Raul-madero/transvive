<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];


 

  $sqltot= mysqli_query($conection,"SELECT count(*) as tot_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) ");
  mysqli_close($conection);

  while ($rowt = mysqli_fetch_array($sqltot)){
   //extract $drow;
     $totquejas = $rowt['tot_quejas'];
  }


  include "../conexion.php";
  $sqlaniotot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'January' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlaniotot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1ene = $drowt['prom1'];   
     }else {
        $prom1ene = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2ene = $drowt['prom2'];   
     }else {
        $prom2ene = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3ene = $drowt['prom3'];   
     }else {
        $prom3ene = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4ene = $drowt['prom4'];   
     }else {
        $prom4ene = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5ene = $drowt['prom5'];   
     }else {
        $prom5ene = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6ene = $drowt['prom6'];   
     }else {
        $prom6ene = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7ene = $drowt['prom7'];   
     }else {
        $prom7ene = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8ene = $drowt['prom8'];   
     }else {
        $prom8ene = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9ene = $drowt['prom9'];   
     }else {
        $prom9ene = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10ene = $drowt['prom10'];   
     }else {
        $prom10ene = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11ene = $drowt['prom11'];   
     }else {
        $prom11ene = 0;
     }

   /*aqu*/

   }

   include "../conexion.php";
  $sqlfebtot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'February' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlfebtot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1feb = $drowt['prom1'];   
     }else {
        $prom1feb = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2feb = $drowt['prom2'];   
     }else {
        $prom2feb = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3feb = $drowt['prom3'];   
     }else {
        $prom3feb = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4feb = $drowt['prom4'];   
     }else {
        $prom4feb = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5feb = $drowt['prom5'];   
     }else {
        $prom5feb = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6feb = $drowt['prom6'];   
     }else {
        $prom6feb = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7feb = $drowt['prom7'];   
     }else {
        $prom7feb = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8feb = $drowt['prom8'];   
     }else {
        $prom8feb = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9feb = $drowt['prom9'];   
     }else {
        $prom9feb = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10feb = $drowt['prom10'];   
     }else {
        $prom10feb = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11feb = $drowt['prom11'];   
     }else {
        $prom11feb = 0;
     }
   /*aqu*/

   }


   include "../conexion.php";
  $sqlmartot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'March' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlmartot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1mar = $drowt['prom1'];   
     }else {
        $prom1mar = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2mar = $drowt['prom2'];   
     }else {
        $prom2mar = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3mar = $drowt['prom3'];   
     }else {
        $prom3mar = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4mar = $drowt['prom4'];   
     }else {
        $prom4mar = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5mar = $drowt['prom5'];   
     }else {
        $prom5mar = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6mar = $drowt['prom6'];   
     }else {
        $prom6mar = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7mar = $drowt['prom7'];   
     }else {
        $prom7mar = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8mar = $drowt['prom8'];   
     }else {
        $prom8mar = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9mar = $drowt['prom9'];   
     }else {
        $prom9mar = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10mar = $drowt['prom10'];   
     }else {
        $prom10mar = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11mar = $drowt['prom11'];   
     }else {
        $prom11mar = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqlabrtot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'April' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlabrtot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1abr = $drowt['prom1'];   
     }else {
        $prom1abr = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2abr = $drowt['prom2'];   
     }else {
        $prom2abr = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3abr = $drowt['prom3'];   
     }else {
        $prom3abr = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4abr = $drowt['prom4'];   
     }else {
        $prom4abr = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5abr = $drowt['prom5'];   
     }else {
        $prom5abr = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6abr = $drowt['prom6'];   
     }else {
        $prom6abr = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7abr = $drowt['prom7'];   
     }else {
        $prom7abr = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8abr = $drowt['prom8'];   
     }else {
        $prom8abr = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9abr = $drowt['prom9'];   
     }else {
        $prom9abr = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10abr = $drowt['prom10'];   
     }else {
        $prom10abr = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11abr = $drowt['prom11'];   
     }else {
        $prom11abr = 0;
     }
   /*aqu*/

   }


   include "../conexion.php";
  $sqlmaytot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'May' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlmaytot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1may = $drowt['prom1'];   
     }else {
        $prom1may = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2may = $drowt['prom2'];   
     }else {
        $prom2may = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3may = $drowt['prom3'];   
     }else {
        $prom3may = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4may = $drowt['prom4'];   
     }else {
        $prom4may = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5may = $drowt['prom5'];   
     }else {
        $prom5may = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6may = $drowt['prom6'];   
     }else {
        $prom6may = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7may = $drowt['prom7'];   
     }else {
        $prom7may = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8may = $drowt['prom8'];   
     }else {
        $prom8may = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9may = $drowt['prom9'];   
     }else {
        $prom9may = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10may = $drowt['prom10'];   
     }else {
        $prom10may = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11may = $drowt['prom11'];   
     }else {
        $prom11may = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqljuntot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'June' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqljuntot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1jun = $drowt['prom1'];   
     }else {
        $prom1jun = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2jun = $drowt['prom2'];   
     }else {
        $prom2jun = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3jun = $drowt['prom3'];   
     }else {
        $prom3jun = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4jun = $drowt['prom4'];   
     }else {
        $prom4jun = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5jun = $drowt['prom5'];   
     }else {
        $prom5jun = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6jun = $drowt['prom6'];   
     }else {
        $prom6jun = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7jun = $drowt['prom7'];   
     }else {
        $prom7jun = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8jun = $drowt['prom8'];   
     }else {
        $prom8jun = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9jun = $drowt['prom9'];   
     }else {
        $prom9jun = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10jun = $drowt['prom10'];   
     }else {
        $prom10jun = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11jun = $drowt['prom11'];   
     }else {
        $prom11jun = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqljultot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'July' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqljultot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1jul = $drowt['prom1'];   
     }else {
        $prom1jul = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2jul = $drowt['prom2'];   
     }else {
        $prom2jul = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3jul = $drowt['prom3'];   
     }else {
        $prom3jul = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4jul = $drowt['prom4'];   
     }else {
        $prom4jul = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5jul = $drowt['prom5'];   
     }else {
        $prom5jul = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6jul = $drowt['prom6'];   
     }else {
        $prom6jul = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7jul = $drowt['prom7'];   
     }else {
        $prom7jul = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8jul = $drowt['prom8'];   
     }else {
        $prom8jul = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9jul = $drowt['prom9'];   
     }else {
        $prom9jul = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10jul = $drowt['prom10'];   
     }else {
        $prom10jul = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11jul = $drowt['prom11'];   
     }else {
        $prom11jul = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqlagotot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'August' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlagotot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1ago = $drowt['prom1'];   
     }else {
        $prom1ago = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2ago = $drowt['prom2'];   
     }else {
        $prom2ago = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3ago = $drowt['prom3'];   
     }else {
        $prom3ago = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4ago = $drowt['prom4'];   
     }else {
        $prom4ago = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5ago = $drowt['prom5'];   
     }else {
        $prom5ago = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6ago = $drowt['prom6'];   
     }else {
        $prom6ago = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7ago = $drowt['prom7'];   
     }else {
        $prom7ago = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8ago = $drowt['prom8'];   
     }else {
        $prom8ago = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9ago = $drowt['prom9'];   
     }else {
        $prom9ago = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10ago = $drowt['prom10'];   
     }else {
        $prom10ago = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11ago = $drowt['prom11'];   
     }else {
        $prom11ago = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqlagotot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'August' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlagotot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1ago = $drowt['prom1'];   
     }else {
        $prom1ago = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2ago = $drowt['prom2'];   
     }else {
        $prom2ago = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3ago = $drowt['prom3'];   
     }else {
        $prom3ago = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4ago = $drowt['prom4'];   
     }else {
        $prom4ago = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5ago = $drowt['prom5'];   
     }else {
        $prom5ago = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6ago = $drowt['prom6'];   
     }else {
        $prom6ago = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7ago = $drowt['prom7'];   
     }else {
        $prom7ago = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8ago = $drowt['prom8'];   
     }else {
        $prom8ago = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9ago = $drowt['prom9'];   
     }else {
        $prom9ago = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10ago = $drowt['prom10'];   
     }else {
        $prom10ago = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11ago = $drowt['prom11'];   
     }else {
        $prom11ago = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqlseptot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'September' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlseptot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1sep = $drowt['prom1'];   
     }else {
        $prom1sep = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2sep = $drowt['prom2'];   
     }else {
        $prom2sep = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3sep = $drowt['prom3'];   
     }else {
        $prom3sep = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4sep = $drowt['prom4'];   
     }else {
        $prom4sep = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5sep = $drowt['prom5'];   
     }else {
        $prom5sep = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6sep = $drowt['prom6'];   
     }else {
        $prom6sep = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7sep = $drowt['prom7'];   
     }else {
        $prom7sep = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8sep = $drowt['prom8'];   
     }else {
        $prom8sep = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9sep = $drowt['prom9'];   
     }else {
        $prom9sep = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10sep = $drowt['prom10'];   
     }else {
        $prom10sep = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11sep = $drowt['prom11'];   
     }else {
        $prom11sep = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqlocttot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'October' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlocttot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1oct = $drowt['prom1'];   
     }else {
        $prom1oct = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2oct = $drowt['prom2'];   
     }else {
        $prom2oct = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3oct = $drowt['prom3'];   
     }else {
        $prom3oct = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4oct = $drowt['prom4'];   
     }else {
        $prom4oct = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5oct = $drowt['prom5'];   
     }else {
        $prom5oct = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6oct = $drowt['prom6'];   
     }else {
        $prom6oct = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7oct = $drowt['prom7'];   
     }else {
        $prom7oct = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8oct = $drowt['prom8'];   
     }else {
        $prom8oct = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9oct = $drowt['prom9'];   
     }else {
        $prom9oct = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10oct = $drowt['prom10'];   
     }else {
        $prom10oct = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11oct = $drowt['prom11'];   
     }else {
        $prom11oct = 0;
     }
   /*aqu*/

   }


   include "../conexion.php";
  $sqlnovtot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'November' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlnovtot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1nov = $drowt['prom1'];   
     }else {
        $prom1nov = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2nov = $drowt['prom2'];   
     }else {
        $prom2nov = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3nov = $drowt['prom3'];   
     }else {
        $prom3nov = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4nov = $drowt['prom4'];   
     }else {
        $prom4nov = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5nov = $drowt['prom5'];   
     }else {
        $prom5nov = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6nov = $drowt['prom6'];   
     }else {
        $prom6nov = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7nov = $drowt['prom7'];   
     }else {
        $prom7nov = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8nov = $drowt['prom8'];   
     }else {
        $prom8nov = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9nov = $drowt['prom9'];   
     }else {
        $prom9nov = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10nov = $drowt['prom10'];   
     }else {
        $prom10nov = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11nov = $drowt['prom11'];   
     }else {
        $prom11nov = 0;
     }
   /*aqu*/

   }

   include "../conexion.php";
  $sqldictot= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as prom1, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as prom2, SUM(disponibilidad)/COUNT(disponibilidad) as prom3, SUM(calidad)/COUNT(calidad) as prom4, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as prom5, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as prom6, SUM(servicio_operador)/COUNT(servicio_operador) as prom7, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as prom8, SUM(atencion_calidad)/COUNT(atencion_calidad) as prom9, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as prom10, SUM(nuestros_precios)/COUNT(nuestros_precios) as prom11 FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'December' ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqldictot)){
   //extract $drow; 
     if (isset($drowt['prom1'])) {
        $prom1dic = $drowt['prom1'];   
     }else {
        $prom1dic = 0;
     }

     if (isset($drowt['prom2'])) {
        $prom2dic = $drowt['prom2'];   
     }else {
        $prom2dic = 0;
     }

     if (isset($drowt['prom3'])) {
        $prom3dic = $drowt['prom3'];   
     }else {
        $prom3dic = 0;
     }

     if (isset($drowt['prom4'])) {
        $prom4dic = $drowt['prom4'];   
     }else {
        $prom4dic = 0;
     }

     if (isset($drowt['prom5'])) {
        $prom5dic = $drowt['prom5'];   
     }else {
        $prom5dic = 0;
     }

     if (isset($drowt['prom6'])) {
        $prom6dic = $drowt['prom6'];   
     }else {
        $prom6dic = 0;
     }

     if (isset($drowt['prom7'])) {
        $prom7dic = $drowt['prom7'];   
     }else {
        $prom7dic = 0;
     }

     if (isset($drowt['prom8'])) {
        $prom8dic = $drowt['prom8'];   
     }else {
        $prom8dic = 0;
     }

     if (isset($drowt['prom9'])) {
        $prom9dic = $drowt['prom9'];   
     }else {
        $prom9dic = 0;
     }

     if (isset($drowt['prom10'])) {
        $prom10dic = $drowt['prom10'];   
     }else {
        $prom10dic = 0;
     }

     if (isset($drowt['prom11'])) {
        $prom11dic = $drowt['prom11'];   
     }else {
        $prom11dic = 0;
     }
   /*aqu*/

   }

  

 $aniocurso = date("Y");

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
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
    height: 400px;
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
        <?php
      
              if ($_SESSION['rol'] == 14) {
                include('includes/navbarcalidad.php');
                include('includes/navc.php');
              }else {
                if ($_SESSION['rol'] == 9) {
                   include('includes/navbargrcia.php');
                   include('includes/nav.php');
                }else {
                   include('includes/navbar.php');
                   include('includes/nav.php'); 
                }   
              }  
           
    
     ?>
    

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
            <div class="card-header p-2">
              <div class="position-relative mb-4">
                   <figure class="highcharts-figure">
                       <div id="container"></div>
                       <p class="highcharts-description">
                           
                       </p>
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
  // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart


  Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafica de Encuesta por Concepto Mensual '+ <?php echo $aniocurso; ?>,
        align: 'left'
    },
    subtitle: {
        text:
            ' ' +
            '',
        align: 'left'
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        crosshair: true,
        accessibility: {
            description: 'Mes:'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Promedio Mensual'
        }
    },
    tooltip: {
        valueSuffix: ' %'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Tiempo forma',
            data: [<?php echo $prom1ene; ?>, <?php echo $prom1feb; ?>, <?php echo $prom1mar; ?>, <?php echo $prom1abr; ?>, <?php echo $prom1may; ?>, <?php echo $prom1jun; ?>, <?php echo $prom1jul; ?>, <?php echo $prom1ago; ?>, <?php echo $prom1sep; ?>, <?php echo $prom1oct; ?>, <?php echo $prom1nov; ?>, <?php echo $prom1dic; ?>]
        },
        {
            name: 'Tiempo respuesta',
            data: [<?php echo $prom2ene; ?>, <?php echo $prom2feb; ?>, <?php echo $prom2mar; ?>, <?php echo $prom2abr; ?>, <?php echo $prom2may; ?>, <?php echo $prom2jun; ?>, <?php echo $prom2jul; ?>, <?php echo $prom2ago; ?>, <?php echo $prom2sep; ?>, <?php echo $prom2oct; ?>, <?php echo $prom2nov; ?>, <?php echo $prom2dic; ?>]
        },
        {
            name: 'Disponibilidad',
            data: [<?php echo $prom3ene; ?>, <?php echo $prom3feb; ?>, <?php echo $prom3mar; ?>, <?php echo $prom3abr; ?>, <?php echo $prom3may; ?>, <?php echo $prom3jun; ?>, <?php echo $prom3jul; ?>, <?php echo $prom3ago; ?>, <?php echo $prom3sep; ?>, <?php echo $prom3oct; ?>, <?php echo $prom3nov; ?>, <?php echo $prom3dic; ?>]
        },
        {
            name: 'Calidad',
            data: [<?php echo $prom4ene; ?>, <?php echo $prom4feb; ?>, <?php echo $prom4mar; ?>, <?php echo $prom4abr; ?>, <?php echo $prom4may; ?>, <?php echo $prom4jun; ?>, <?php echo $prom4jul; ?>, <?php echo $prom4ago; ?>, <?php echo $prom4sep; ?>, <?php echo $prom4oct; ?>, <?php echo $prom4nov; ?>, <?php echo $prom4dic; ?>]
        }, 
        {
            name: 'Asesoria tecnica',
            data: [<?php echo $prom5ene; ?>, <?php echo $prom5feb; ?>, <?php echo $prom5mar; ?>, <?php echo $prom5abr; ?>, <?php echo $prom5may; ?>, <?php echo $prom5jun; ?>, <?php echo $prom5jul; ?>, <?php echo $prom5ago; ?>, <?php echo $prom5sep; ?>, <?php echo $prom5oct; ?>, <?php echo $prom5nov; ?>, <?php echo $prom5dic; ?>]
        }, 
        {
            name: 'Limpieza condicion',
            data: [<?php echo $prom6ene; ?>, <?php echo $prom6feb; ?>, <?php echo $prom6mar; ?>, <?php echo $prom6abr; ?>, <?php echo $prom6may; ?>, <?php echo $prom6jun; ?>, <?php echo $prom6jul; ?>, <?php echo $prom6ago; ?>, <?php echo $prom6sep; ?>, <?php echo $prom6oct; ?>, <?php echo $prom6nov; ?>, <?php echo $prom6dic; ?>]
        }, 
        {
            name: 'Servicio operador',
            data: [<?php echo $prom7ene; ?>, <?php echo $prom7feb; ?>, <?php echo $prom7mar; ?>, <?php echo $prom7abr; ?>, <?php echo $prom7may; ?>, <?php echo $prom7jun; ?>, <?php echo $prom7jul; ?>, <?php echo $prom7ago; ?>, <?php echo $prom7sep; ?>, <?php echo $prom7oct; ?>, <?php echo $prom7nov; ?>, <?php echo $prom7dic; ?>]
        }, 
        {
            name: 'Conduce adecuado',
            data: [<?php echo $prom8ene; ?>, <?php echo $prom8feb; ?>, <?php echo $prom8mar; ?>, <?php echo $prom8abr; ?>, <?php echo $prom8may; ?>, <?php echo $prom8jun; ?>, <?php echo $prom8jul; ?>, <?php echo $prom8ago; ?>, <?php echo $prom8sep; ?>, <?php echo $prom8oct; ?>, <?php echo $prom8nov; ?>, <?php echo $prom8dic; ?>]
        }, 
        {
            name: 'Atencíon calidad',
            data: [<?php echo $prom9ene; ?>, <?php echo $prom9feb; ?>, <?php echo $prom9mar; ?>, <?php echo $prom9abr; ?>, <?php echo $prom9may; ?>, <?php echo $prom9jun; ?>, <?php echo $prom9jul; ?>, <?php echo $prom9ago; ?>, <?php echo $prom9sep; ?>, <?php echo $prom9oct; ?>, <?php echo $prom9nov; ?>, <?php echo $prom9dic; ?>]
        }, 
        {
            name: 'Servicio facturacion',
            data: [<?php echo $prom10ene; ?>, <?php echo $prom10feb; ?>, <?php echo $prom10mar; ?>, <?php echo $prom10abr; ?>, <?php echo $prom10may; ?>, <?php echo $prom10jun; ?>, <?php echo $prom10jul; ?>, <?php echo $prom10ago; ?>, <?php echo $prom10sep; ?>, <?php echo $prom10oct; ?>, <?php echo $prom10nov; ?>, <?php echo $prom10dic; ?>]
        }, 
        {
            name: 'Nuestros precios',
            data: [<?php echo $prom11ene; ?>, <?php echo $prom11feb; ?>, <?php echo $prom11mar; ?>, <?php echo $prom11abr; ?>, <?php echo $prom11may; ?>, <?php echo $prom11jun; ?>, <?php echo $prom11jul; ?>, <?php echo $prom11ago; ?>, <?php echo $prom11sep; ?>, <?php echo $prom11oct; ?>, <?php echo $prom11nov; ?>, <?php echo $prom11dic; ?>]
        }
    ]
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
