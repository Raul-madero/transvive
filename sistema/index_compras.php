<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  if($rol != 16) {
      $rolRedirects = [
        "Administrador" => "index.php",
        "Conductor" => "index_conductor.php",
        "Supervisor" => "index_supervisor.php",
        "Recursos Humanos" => "index_rhumanos.php",
        "Operaciones" => "index_operaciones.php",
        "Operador" => "index_operador.php",
        "Mantenimiento" => "index_mantto.php",
        "Jefe Operaciones" => "index_jefeoperaciones.php",
        "Gerencia" => "index_gerencia.php",
        "Almacen" => "index_almacen.php",
        "Calidad" => "index_calidad.php",
        "Monitorista" => "index_monitorista.php",
        "Compras" => "index_compras.php",
        "Ventas" => "index_ventas.php"
      ];
    
      if (isset($rolRedirects[$_SESSION['rol_name']])) {
        header('location: ' . $rolRedirects[$_SESSION['rol_name']]);
      } else {
        header('location: sistema/');
      }
    }
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqlenc= mysqli_query($conection,"SELECT MONTH(fecha) as Nmes, MONTHNAME(fecha) as Nombremes, YEAR(fecha), SUM(total) as Importec FROM compras WHERE YEAR(fecha) = YEAR(CURDATE()) and estatus <>0 GROUP BY MONTH(fecha)");
  mysqli_close($conection);
  $result_sqlenc = mysqli_num_rows($sqlenc);

    while ($data = mysqli_fetch_array($sqlenc)){
      $datoc0[] = $data ['Nombremes'];
      $datoc1[] = $data['Importec'];
     
    }
   
   

  

  include "../conexion.php";
   $sqlenc23= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes where YEAR(fecha)  = 2023");
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
   $sqlenc24= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes where YEAR(fecha)  = 2024");
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
   $sqlenc25= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes where YEAR(fecha)  = 2025");
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
   $sqlenc26= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes where YEAR(fecha)  = 2026");
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
   $sqlenc27= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes where YEAR(fecha)  = 2027");
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
   $sqlenc28= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes where YEAR(fecha)  = 2028");
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
  $sqlviajes= mysqli_query($conection,"SELECT MONTHNAME(fecha) as Nmeses, YEAR(fecha), SUM(IF(planeado=1, valor_vuelta, 0)) as Planeados, SUM(valor_vuelta) as Registrados,(SUM(valor_vuelta)  - SUM(IF(planeado=1, valor_vuelta, 0))) as Diferencia, 100 - (SUM(IF(planeado=1, valor_vuelta, 0)) / SUM(valor_vuelta)*100) as Porcdiferencia  FROM registro_viajes WHERE YEAR(fecha) = YEAR(CURDATE()) and estatus = 2 GROUP BY MONTH(fecha)");
  mysqli_close($conection);
  while ($drow = mysqli_fetch_array($sqlviajes)){
   //extract $drow;
    $t = $drow ['Nmeses'];
     $r = number_format($drow ['Porcdiferencia'],2);
    
   $values[] = $t;
   $dato2[] = $drow['Planeados'];
   $dato3[] = $drow['Registrados'];
   $dato4[] = $drow['Diferencia'];
   $dato5[] = $r;

}

include "../conexion.php";
  $sqlenc10= mysqli_query($conection,"SELECT cliente, fecha, tiempo_forma, tiempo_respuesta, disponibilidad, calidad, asesoria_tecnica, limpieza_condicion, servicio_operador, conduce_adecuado, atencion_calidad, servicio_facturacion, nuestros_precios FROM encuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) GROUP by cliente");
 // $result10 = mysql_query($sqlenc10);
  mysqli_close($conection);
  while ($nrow = mysqli_fetch_array($sqlenc10)){

   //extract $drow;
     $tt[] = $nrow['cliente'];
    // $r = number_format($drow ['Porcdiferencia'],2);
    $data1[] = $nrow['cliente'];
   $values24[] = $tt;
   $dato24[] = $nrow['tiempo_forma'];
   $dato34[] = $nrow['tiempo_respuesta'];
   $dato44[] = $nrow['disponibilidad'];
  // $dato54[] = $r;

}



 $aniocurso = date("Y"); 

  include "../conexion.php";
   $sqlenc024= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes where YEAR(fecha)  = YEAR(CURDATE())");
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
    $name_semana = $srow ['Nsemana'];
  
}

  include "../conexion.php";
  $sqlvsem= mysqli_query($conection,"SELECT YEAR(fecha), SUM(IF(planeado=1, valor_vuelta, 0)) as Planeados, SUM(valor_vuelta) as Registrados,(SUM(valor_vuelta)  - SUM(IF(planeado=1, valor_vuelta, 0))) as Diferencia, 100 - (SUM(IF(planeado=1, valor_vuelta, 0)) / SUM(valor_vuelta)*100) as Porcdiferencia FROM registro_viajes WHERE semana = '$name_semana' and estatus = 2 ");
  mysqli_close($conection);
  while ($vrow = mysqli_fetch_array($sqlvsem)){
   //extract $drow;
      
   $v_planeados   = $vrow['Planeados'];;
   $v_registrados = $vrow['Registrados'];
   $v_diferencia  = $vrow['Diferencia'];

}

include "../conexion.php";
  $sqlcompra= mysqli_query($conection,"SELECT count(*) as noprov FROM proveedores WHERE estatus = 1 ");
  mysqli_close($conection);
  while ($rowc = mysqli_fetch_array($sqlcompra)){
   //extract $drow;
      
   $noproveedores   = $rowc['noprov'];;
 
}

include "../conexion.php";
  $sqlrefac= mysqli_query($conection,"SELECT count(*) as norefacc FROM refacciones WHERE estatus = 1 ");
  mysqli_close($conection);
  while ($rowr = mysqli_fetch_array($sqlrefac)){
   //extract $drow;
      
   $norefac  = $rowr['norefacc'];;
 
}

include "../conexion.php";
  $sqlviajescanc= mysqli_query($conection,"SELECT count(valor_vuelta) as viajes_cancelados from registro_viajes WHERE  semana = '$name_semana' and estatus = 3 ");
  mysqli_close($conection);
  $result_sqlviajescanc = mysqli_num_rows($sqlviajescanc);

    while ($datacanc = mysqli_fetch_array($sqlviajescanc)){
      $v_cancelados   = number_format($datacanc['viajes_cancelados'],2);
      //$especiales   = $datav['viajes_especiales'];
     
  } 

  $p_planeados    = $v_planeados - $v_cancelados;
  if ($v_planeados == 0) {
    $porc_planeados = 0;
    $p_registrados = 0;
    $porc_registrados = 0;
    $p_diferencia = 0;
    $porc_diferencia = 0;
    $porc_cancelados = 0;
  }else {
  $porc_planeados = number_format(($p_planeados / $v_planeados) * 100,2);

  $p_registrados    = ($v_planeados / $v_registrados) * 100;
  $porc_registrados = number_format(100 - $p_registrados,2);

  $p_diferencia    = ($v_registrados - $v_planeados);
  $porc_diferencia = number_format(($p_diferencia / $v_registrados) * 100,2);

  $porc_cancelados = number_format(($v_cancelados / $v_registrados) * 100,2);
  }
$lasemana = date("n");
  setlocale(LC_TIME, 'es_MX');
$monthNum  = $lasemana;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$NameMes = strftime('%B', $dateObj->getTimestamp());

include "../conexion.php";
  $sqlcomprames= mysqli_query($conection,"SELECT MONTHNAME(fecha) as Nmeses, YEAR(fecha), SUM(total) as totalcompras FROM compras WHERE  MONTHNAME(fecha) =  MONTHNAME(CURDATE()) and estatus = 1 GROUP BY MONTH(fecha) ");
  mysqli_close($conection);
  $result_sqlcomprames = mysqli_num_rows($sqlcomprames);

    while ($datacanc = mysqli_fetch_array($sqlcomprames)){
      $compras_mes   = number_format($datacanc['totalcompras'],2);
      //$especiales   = $datav['viajes_especiales'];
     
  } 

if (isset($compras_mes)) {
        $new_comprasmes = $compras_mes;
}else {
        $new_comprasmes = 0;
        
}

$dhoy2 = date("Y-m-d");
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
  $sqlconsumomes= mysqli_query($conection,"SELECT MONTHNAME(fecha) as Nmeses, YEAR(fecha), SUM(importe) as totalgas FROM carga_combustible WHERE  MONTHNAME(fecha) =  MONTHNAME(CURDATE()) and estatus <> 0 GROUP BY MONTH(fecha)");
  mysqli_close($conection);
  $result_sqlconsumomes = mysqli_num_rows($sqlconsumomes);

    while ($datacanc = mysqli_fetch_array($sqlconsumomes)){
      $consumo_mes   = number_format($datacanc['totalgas'],2);
      //$especiales   = $datav['viajes_especiales'];
     
  } 

  include "../conexion.php";
  $sqlconsumosem= mysqli_query($conection,"SELECT MONTHNAME(fecha) as Nmeses, YEAR(fecha), SUM(importe) as totalgas FROM carga_combustible WHERE fecha >= '$diaini' and fecha <= '$diafin' and estatus <> 0 GROUP BY fecha ");
  mysqli_close($conection);
  $result_sqlconsumosem = mysqli_num_rows($sqlconsumosem);

    while ($datacanc = mysqli_fetch_array($sqlconsumosem)){
      $consumo_semana   = number_format($datacanc['totalgas'],2);
      //$especiales   = $datav['viajes_especiales'];
     
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

      <?php include('includes/navbarcompras.php') ?>
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
                      <strong>CATÁLOGOS<br>&nbsp;</strong>
                    </p>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="description-block border-right">
                      <a href="proveedores.php"><span class="description-percentage text-primary"> <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></span></a> 
                      <h5 class="description-header"><?php echo $noproveedores; ?></h5>
                      <span class="description-text">Proveedores</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-6">
                    <div class="description-block border-right">
                      <a href="proveedores.php"><span class="description-percentage text-info"> <i class="fa fa-wrench fa-2x" aria-hidden="true"></i></span></a> 
                      <h5 class="description-header"><?php echo $norefac; ?></h5>
                      <span class="description-text">Refacciones</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                 
                  <!-- /.col -->
                 
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
                  <div class="col-lg-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-primary"><i class="fas fa-cart-plus fa-2x"></i> &nbsp; </span>
                      <h5 class="description-header"><?php echo $new_comprasmes; ?></h5>
                      <span class="description-text">Compras del Mes</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-lg-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-cart-arrow-down fa-2x"></i> &nbsp;</span>
                      <h5 class="description-header"><?php echo $comprassem; ?></h5>
                      <span class="description-text">Compras Semana</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                
                  <!-- /.col -->
                 
                </div>
                <!-- /.row -->
              </div>
        </div>

      </div>

      <br>

        <div class="row">
          <!--<div class="col-lg-6">
            <div class="card">
              <div class="position-relative mb-4">
                  <figure class="highcharts-figure">
                   
                    <div id="container"></div>
                  </figure>
                </div>
              
            </div>
           
          </div>-->
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
             <div class="position-relative mb-4">
                <figure class="highcharts-figure">
    <div id="container2"></div>
    <p class="highcharts-description">
        
    </p>
</figure>
                </div>
              
            </div>
            <!-- /.card -->

         
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!--
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
                    <span class="text-success">-->
                      <!--<i class="fas fa-arrow-up"></i> -->
                      <!--
                    </span>
                    <span class="text-muted"></span>
                  </p>
                </div>-->
                <!-- /.d-flex -->
                <!--
                <div class="position-relative mb-4">
                  <canvas id="myChart" height="200"></canvas>
                </div>

               
              </div>
            </div>
           
          </div>

          <div class="col-lg-6">
            <div class="card">
              
              <div class="card-body" style="height:510px">
               <p class="text-center">
                      <strong>Resultado de encuestas por concepto</strong>
                    </p>

                    <div class="progress-group">
                      Atención General
                      <span class="float-right"><b><?php echo $respuesta1; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo $respuesta1; ?>"></div>
                      </div>
                    </div>-->
                    <!-- /.progress-group -->
                    <!--
                    <div class="progress-group">
                      Tiempo de Respuesta
                      <span class="float-right"><b><?php echo $respuesta2; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: <?php echo $respuesta2; ?>"></div>
                      </div>
                    </div>-->

                    <!-- /.progress-group -->
                    <!--
                    <div class="progress-group">
                      <span class="progress-text">Diponibilidad del Servicio</span>
                      <span class="float-right"><b><?php echo $respuesta3; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo $respuesta3; ?>"></div>
                      </div>
                    </div>-->

                    <!-- /.progress-group -->
                    <!--
                    <div class="progress-group">
                      Calidad de Nuestros Servicios
                      <span class="float-right"><b><?php echo $respuesta4; ?></b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php echo $respuesta4; ?>"></div>
                      </div>
                    </div>
                    -->
                     <!-- /.progress-group -->
                     <!--
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
        text: 'Compras por Mes',
        align: 'left'
    },

    subtitle: {
        text: 'Año en curso',
        align: 'left'
    },

    xAxis: {
        categories: ['<?php echo join($datoc0, ',') ?>']
         
    },

    yAxis: {
        title: {
            text: 'Compras por mes'
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
        data: [<?php echo join($datoc1, ',') ?>]
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
  Highcharts.chart('container3', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Corn vs wheat estimated production for 2020',
        align: 'left'
    },
    subtitle: {
        text:
            'Source: <a target="_blank" ' +
            'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
        align: 'left'
    },
    xAxis: {
        categories: ['<?php echo join($data1, ',') ?>'],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '1000 metric tons (MT)'
        }
    },
    tooltip: {
        valueSuffix: ' (1000 MT)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Corn',
            data: [406292, 260000, 107000, 68300, 27500, 14500]
        },
        {
            name: 'Wheat',
            data: [51086, 136000, 5500, 141000, 107180, 77000]
        }
    ]
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
