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
  $sqlenetot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'January'  ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlenetot)){
   //extract $drow; 
   $numquejas_ene = $drowt['promedio'];
   }

   if (isset($numquejas_ene)) {
      $numquejas = number_format($numquejas_ene,2);
   }else {
      $numquejas = number_format(0,2);
   }

  include "../conexion.php";
  $sqlene= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'January'  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow = mysqli_fetch_array($sqlene)){
    if(is_null($drow["cliente"])){
       $ndato1 = array("cliente","c-1");
       $ndato1n = array(0,1);
       $dato1[]=$ndato1;
       $dato1n[]=$ndato1n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato1[] = $drow['cliente'];
      $dato1n[] = $drow['n_quejas'];
   }
   }

   include "../conexion.php";
  $sqlfebtot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'February'  ");
  mysqli_close($conection);

  while ($drowt2 = mysqli_fetch_array($sqlfebtot)){
   //extract $drow; 
   $numquejas2_feb = $drowt2['promedio'];
   }

   if (isset($numquejas2_feb)) {
      $numquejas2 = number_format($numquejas2_feb,2);
   }else {
      $numquejas2 = number_format(0,2);
   }

  include "../conexion.php";
  $sqlfeb= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'February'  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow2 = mysqli_fetch_array($sqlfeb)){

    if(is_null($drow2["cliente"])){
       $ndato2 = array("cliente","c-1");
       $ndato2n = array(0,1);
       $dato2[]=$ndato2;
       $dato2n[]=$ndato2n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato2[] = $drow2['cliente'];
      $dato2n[] = $drow2['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlmartot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'March'  ");
  mysqli_close($conection);

  while ($drowt3 = mysqli_fetch_array($sqlmartot)){
   //extract $drow; 
   $numquejas3_mar = $drowt3['promedio'];
   }

   if (isset($numquejas3_mar)) {
      $numquejas3 = number_format($numquejas3_mar,2);
   }else {
      $numquejas3 = number_format(0,2);
   }

  include "../conexion.php";
  $sqlmar= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'March'  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow3 = mysqli_fetch_array($sqlmar)){

    if(is_null($drow3["cliente"])){
       $ndato3 = array("cliente","c-1");
       $ndato3n = array(0,1);
       $dato3[]=$ndato3;
       $dato3n[]=$ndato3n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato3[] = $drow3['cliente'];
      $dato3n[] = $drow3['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlabrtot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'April'  ");
  mysqli_close($conection);

  while ($drowt4 = mysqli_fetch_array($sqlabrtot)){
   //extract $drow; 
   $numquejas4_abr = $drowt4['promedio'];
   }

   if (isset($numquejas4_abr)) {
      $numquejas4 = number_format($numquejas4_abr,2);
   }else {
      $numquejas4 = number_format(0,2);
   }

  include "../conexion.php";
  $sqlabr= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'April'  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow4 = mysqli_fetch_array($sqlabr)){

    if(is_null($drow4["cliente"])){
       $ndato4 = array("cliente","c-1");
       $ndato4n = array(0,1);
       $dato4[]=$ndato4;
       $dato4n[]=$ndato4n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato4[] = $drow4['cliente'];
      $dato4n[] = $drow4['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlmaytot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'May'  ");
  mysqli_close($conection);

  while ($drowt5 = mysqli_fetch_array($sqlmaytot)){
   //extract $drow; 
   $numquejas5_may = $drowt5['promedio'];
   }

   if (isset($numquejas5_may)) {
      $numquejas5 = number_format($numquejas5_may,2);
   }else {
      $numquejas5 = number_format(0,2);
   }

  include "../conexion.php";
  $sqlmay= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'May'  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow5 = mysqli_fetch_array($sqlmay)){

    if(is_null($drow5["cliente"])){
       $ndato5 = array("cliente","c-1");
       $ndato5n = array(0,1);
       $dato5[]=$ndato5;
       $dato5n[]=$ndato5n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato5[] = $drow5['cliente'];
      $dato5n[] = $drow5['n_quejas'];
   }

  }

include "../conexion.php";
  $sqljuntot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'June' ");
  mysqli_close($conection);

  while ($drowt6 = mysqli_fetch_array($sqljuntot)){
   //extract $drow; 
   $numquejas6_jun = $drowt6['promedio'];
   }

   if (isset($numquejas6_jun)) {
      $numquejas6 = number_format($numquejas6_jun,2);
   }else {
      $numquejas6 = number_format(0,2);
   }

  include "../conexion.php";
  $sqljun= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'June' GROUP BY cliente");
  mysqli_close($conection);

  while ($drow6 = mysqli_fetch_array($sqljun)){

    if(is_null($drow6["cliente"])){
       $ndato6 = array("cliente","c-1");
       $ndato6n = array(0,1);
       $dato6[]=$ndato6;
       $dato6n[]=$ndato6n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato6[] = $drow6['cliente'];
      $dato6n[] = $drow6['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqljultot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'July' ");
  mysqli_close($conection);

  while ($drowt7 = mysqli_fetch_array($sqljultot)){
   //extract $drow; 
   $numquejas7_jul = $drowt7['promedio'];
   }

   if (isset($numquejas7_jul)) {
      $numquejas7 = number_format($numquejas7_jul,2);
   }else {
      $numquejas7 = 0;
   }

  include "../conexion.php";
  $sqljul= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'July' GROUP BY cliente");
  mysqli_close($conection);

  while ($drow7 = mysqli_fetch_array($sqljul)){

    if(is_null($drow7["cliente"])){
       $ndato7 = array("cliente","c-1");
       $ndato7n = array(0,1);
       $dato7[]=$ndato7;
       $dato7n[]=$ndato7n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato7[] = $drow7['cliente'];
      $dato7n[] = $drow7['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlagotot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'August' ");
  mysqli_close($conection);

  while ($drowt8 = mysqli_fetch_array($sqlagotot)){
   //extract $drow; 
   $numquejas8_ago = $drowt8['promedio'];
   }

   if (isset($numquejas8_ago)) {
      $numquejas8 = number_format($numquejas8_ago,2);
   }else {
      $numquejas8 = 0;
   }

  include "../conexion.php";
  $sqlago= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'August' GROUP BY cliente");
  mysqli_close($conection);

  while ($drow8 = mysqli_fetch_array($sqlago)){

    if(is_null($drow8["cliente"])){
       $ndato8 = array("cliente","c-1");
       $ndato8n = array(0,1);
       $dato8[]=$ndato8;
       $dindexato8n[]=$ndato8n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato8[] = $drow8['cliente'];
      $dato8n[] = $drow8['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlseptot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'September' ");
  mysqli_close($conection);

  while ($drowt9 = mysqli_fetch_array($sqlseptot)){
   //extract $drow; 
   $numquejas9_sep = $drowt9['promedio'];
   }

   if (isset($numquejas9_sep)) {
      $numquejas9 = number_format($numquejas9_sep,2);
   }else {
      $numquejas9 = 0;
   }

  include "../conexion.php";
  $sqlsep= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'September' GROUP BY cliente");
  mysqli_close($conection);

  while ($drow9 = mysqli_fetch_array($sqlsep)){

    if(is_null($drow9["cliente"])){
       $ndato9 = array("cliente","c-1");
       $ndato9n = array(0,1);
       $dato9[]=$ndato9;
       $dato9n[]=$ndato9n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato9[] = $drow9['cliente'];
      $dato9n[] = $drow9['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlocttot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'October' ");
  mysqli_close($conection);

  while ($drowt10 = mysqli_fetch_array($sqlocttot)){
   //extract $drow; 
   $numquejas10_oct = $drowt10['promedio'];
   }

   if (isset($numquejas10_oct)) {
      $numquejas10 = number_format($numquejas10_oct,2);
   }else {
      $numquejas10 = 0;
   }

  include "../conexion.php";
  $sqloct= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'October' GROUP BY cliente");
  mysqli_close($conection);

  while ($drow10 = mysqli_fetch_array($sqloct)){

    if(is_null($drow10["cliente"])){
       $ndato10 = array("cliente","c-1");
       $ndato10n = array(0,1);
       $dato10[]=$ndato10;
       $dato10n[]=$ndato10n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato10[] = $drow10['cliente'];
      $dato10n[] = $drow10['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlnovtot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'November' ");
  mysqli_close($conection);

  while ($drowt11 = mysqli_fetch_array($sqlnovtot)){
   //extract $drow; 
   $numquejas11_nov = $drowt11['promedio'];
   }

   if (isset($numquejas11_nov)) {
      $numquejas11 = number_format($numquejas11_nov,2);
   }else {
      $numquejas11 = 0;
   }

  include "../conexion.php";
  $sqlnov= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'November' GROUP BY cliente");
  mysqli_close($conection);

  while ($drow11 = mysqli_fetch_array($sqlnov)){

    if(is_null($drow11["cliente"])){
       $ndato11 = array("cliente","c-1");
       $ndato11n = array(0,1);
       $dato11[]=$ndato11;
       $dato11n[]=$ndato11n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato11[] = $drow11['cliente'];
      $dato11n[] = $drow11['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqldictot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTHNAME(fecha) = 'December' ");
  mysqli_close($conection);

  while ($drowt12 = mysqli_fetch_array($sqldictot)){
   //extract $drow; 
   $numquejas12_dic = $drowt12['promedio'];
   }

  if (isset($numquejas11_nov)) {
      $numquejas12 = number_format($numquejas12_dic,2);
   }else {
      $numquejas12 = 0;
   } 

  include "../conexion.php";
  $sqldic= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'December' GROUP BY cliente");
  mysqli_close($conection);

  while ($drow12 = mysqli_fetch_array($sqldic)){

    if(is_null($drow12["cliente"])){
       $ndato12 = array("cliente","c-1");
       $ndato12n = array(0,1);
       $dato12[]=$ndato12;
       $dato12n[]=$ndato12n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato12[] = $drow12['cliente'];
      $dato12n[] = $drow12['n_quejas'];
   }

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
        align: 'left',
        text: '% por Mes (Encuestas de Satisfacción al Cliente)'
    },
    subtitle: {
        align: 'left',
        text: 'Año en curso <?php echo ($aniocurso) ?> Total de Encuestas: <?php echo ($totquejas) ?>' 
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: '% por Mes'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.2f} %'
            }
        }
    },

   tooltip: {
        valueDecimals: 2,
        valuePrefix: '',
        valueSuffix: '%'
    },

    series: [
        {
            name: 'Meses',
            colorByPoint: true,
            data: [
                {
                    name: 'Ene',
                    y: <?php echo (number_format($numquejas,2)) ?>,
                    drilldown: 'Enero'
                },
                {
                    name: 'Feb',
                    y: <?php echo ($numquejas2) ?>,
                    drilldown: 'Febrero'
                },
                {
                    name: 'Mar',
                    y: <?php echo ($numquejas3) ?>,
                    drilldown: 'Marzo'
                },
                {
                    name: 'Abr',
                    y: <?php echo ($numquejas4) ?>,
                    drilldown: 'Abril'
                },
                {
                    name: 'May',
                    y: <?php echo ($numquejas5) ?>,
                    drilldown: 'Mayo'
                },
                {
                    name: 'Jun',
                    y: <?php echo ($numquejas6) ?>,
                    drilldown: 'Junio'
                },
                {
                    name: 'Jul',
                    y: <?php echo number_format($numquejas7,2) ?>,
                    drilldown: 'Julio'
                },
                {
                    name: 'Ago',
                    y: <?php echo ($numquejas8) ?>,
                    drilldown: 'Agosto'
                },
                {
                    name: 'Sep',
                    y: <?php echo ($numquejas9) ?>,
                    drilldown: 'Septiembre'
                },
                {
                    name: 'Oct',
                    y: <?php echo ($numquejas10) ?>,
                    drilldown: 'Octubre'
                },
                {
                    name: 'Nov',
                    y: <?php echo ($numquejas11) ?>,
                    drilldown: 'Noviembre'
                },
                {
                    name: 'Dic',
                    y: <?php echo ($numquejas12) ?>,
                    drilldown: 'Diciembre'
                }
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: 'Enero',
                id: 'Enero',
                
                data: [
                       
                     <?php
                      if (!empty($dato1)) {
                     $ind = 0;
                      foreach ($dato1 as $val) {
                         
                      ?>
                      [
                        '<?php echo $val ?>',
                        <?php echo $dato1n[$ind] ?>
                   
                 
                ],
                <?php
                $ind = $ind +1;
                } }  else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>

               ]
                      
            },
            {
                name: 'Febrero',
                id: 'Febrero',
                data: [
                    <?php
                     if (!empty($dato2)) {
                     $ind2 = 0;
                      foreach ($dato2 as $valf) {
                         
                      ?>
                      [
                        '<?php echo $valf ?>',
                        <?php echo $dato2n[$ind2] ?>
                   
                 
                ],
                <?php
                $ind2 = $ind2 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Marzo',
                id: 'Marzo',
                data: [
                    <?php
                     if (!empty($dato3)) {
                     $ind3 = 0;
                      foreach ($dato3 as $valf3) {
                         
                      ?>
                      [
                        '<?php echo $valf3 ?>',
                        <?php echo $dato3n[$ind3] ?>
                   
                 
                ],
                <?php
                $ind3 = $ind3 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Abril',
                id: 'Abril',
                data: [
                    <?php
                     if (!empty($dato4)) {
                     $ind4 = 0;
                      foreach ($dato4 as $valf4) {
                         
                      ?>
                      [
                        '<?php echo $valf4 ?>',
                        <?php echo $dato4n[$ind4] ?>
                   
                 
                ],
                <?php
                $ind4 = $ind4 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Mayo',
                id: 'Mayo',
                data: [
                    <?php
                     if (!empty($dato5)) {
                     $ind5 = 0;
                      foreach ($dato5 as $valf5) {
                         
                      ?>
                      [
                        '<?php echo $valf5 ?>',
                        <?php echo $dato5n[$ind5] ?>
                   
                 
                ],
                <?php
                $ind5 = $ind5 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Junio',
                id: 'Junio',
                data: [
                    <?php
                     if (!empty($dato6)) {
                     $ind6 = 0;
                      foreach ($dato6 as $valf6) {
                         
                      ?>
                      [
                        '<?php echo $valf6 ?>',
                        <?php echo $dato6n[$ind6] ?>
                   
                 
                ],
                <?php
                $ind6 = $ind6 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Julio',
                id: 'Julio',
                data: [
                    <?php
                     if (!empty($dato7)) {
                     $ind7 = 0;
                      foreach ($dato7 as $valf7) {
                         
                      ?>
                      [
                        '<?php echo $valf7 ?>',
                        <?php echo $dato7n[$ind7] ?>
                   
                 
                ],
                <?php
                $ind7 = $ind7 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Agosto',
                id: 'Agosto',
                data: [
                    <?php
                     if (!empty($dato8)) {
                     $ind8 = 0;
                      foreach ($dato8 as $valf8) {
                         
                      ?>
                      [
                        '<?php echo $valf8 ?>',
                        <?php echo $dato8n[$ind8] ?>
                   
                 
                ],
                <?php
                $ind8 = $ind8 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Septiembre',
                id: 'Septiembre',
                data: [
                    <?php
                     if (!empty($dato9)) {
                     $ind9 = 0;
                      foreach ($dato9 as $valf9) {
                         
                      ?>
                      [
                        '<?php echo $valf9 ?>',
                        <?php echo $dato9n[$ind9] ?>
                   
                 
                ],
                <?php
                $ind9 = $ind9 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Octubre',
                id: 'Octubre',
                data: [
                    <?php
                     if (!empty($dato10)) {
                     $ind10 = 0;
                      foreach ($dato10 as $valf10) {
                         
                      ?>
                      [
                        '<?php echo $valf10 ?>',
                        <?php echo $dato10n[$ind10] ?>
                   
                 
                ],
                <?php
                $ind10 = $ind10 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Noviembre',
                id: 'Noviembre',
                data: [
                    <?php
                     if (!empty($dato11)) {
                     $ind11 = 0;
                      foreach ($dato11 as $valf11) {
                         
                      ?>
                      [
                        '<?php echo $valf11 ?>',
                        <?php echo $dato11n[$ind11] ?>
                   
                 
                ],
                <?php
                $ind11 = $ind11 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            }, 
            {
                name: 'Diciembre',
                id: 'Diciembre',
                data: [
                    <?php
                     if (!empty($dato12)) {
                     $ind12 = 0;
                      foreach ($dato12 as $valf12) {
                         
                      ?>
                      [
                        '<?php echo $valf12 ?>',
                        <?php echo $dato12n[$ind12] ?>
                   
                 
                ],
                <?php
                $ind12 = $ind12 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            }
        ]
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
