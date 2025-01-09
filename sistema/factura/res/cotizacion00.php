<?php
session_start();
$cotizacionno = $_REQUEST['id'];
setlocale(LC_ALL, 'spanish');
//Consulta sql encabezado
include('../../conexion.php');

?>
<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
#uno,#dos{
border: solid 1px black;
}
td .p {
  border: red 5px solid;
}
-->
</style>
 <?php
    $query = mysqli_query($conection,"SELECT p.id, p.no_cotizacion, p.fecha, p.atencionde, p.empresa, p.direccion, p.dias_credito, p.fecha_inicio, p.fecha_fin, p.comienza_servicio, p.observaciones FROM cotizaciones p WHERE no_cotizacion = $cotizacionno");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

$mes = ucfirst(strftime("%B"));
$dia = strftime("%d");
$anio = strftime("%Y");

$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['fecha_inicio']));
$Datefin = date("d-m-Y", strtotime($pedido['fecha_fin']));

/*
if ($pedido['fecha_inicio'] > '2000-01-01') {
        $newDateinicio = $Dateinicio;
}else {
        $newDateinicio = '';
}

if ($pedido['fecha_fin'] > '2000-01-01') {
        $newDatefin = $Datefin;
}else {
        $newDatefin = '';
}
*/
?>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm" backcolor="#FEFEFE" backimg="../../images/membreteletter.jpg" backimgx="center" backimgy="middle" backimgw="100%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
 
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <!--<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;<?php echo 'Guadalajara, Jal. a '. $dia . ' de ' . $mes . ' de ' . $anio ?></td>
  <br>
 
  
</tr>-->   
   
 <p>   
    <tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;<?php echo 'Guadalajara, Jal. a '. $dia . ' de ' . $mes . ' de ' . $anio ?></td>
  <br>
 
  
</tr> 

<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;</td>
  <br>
 
  
</tr> 
<tr>
  
  <td rowspan="1" colspan="2" style="width: 60%; font-size: 9pt;" align="left">&nbsp;</td>
  <br>
 
  
  <td style="border: 0; border: 0.5px solid #000; vertical-align:middle; width: 23%; font-size: 10pt; align:left; background: #DCDFDF">&nbsp;N° de Cotización:</td>
  <td style="border: 0; border: 0.5px solid #000; width: 17%; font-size: 10pt;" align="center" ><b style="font-size: 12pt; color: #DA1136"><?php echo ' '.$pedido['no_cotizacion']; ?>&nbsp;</b></td>
</tr>
</p>



<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right"><img style="width:20%" src="../../images/transvive_logo.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <br>
 
  
</tr>



</table>

<br>
<br>


<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <tr>
  
 <td rowspan="1" style="width: 40%; font-size: 10pt;" align="right">&nbsp;</td>
  <br>
  <br>
 
  <td style="width: 10%; font-size: 10pt;" align="left"><b>&nbsp;Atención:</b></td>
  <td style="width: 50%; font-size: 10pt;" align="left"><b><?php echo $pedido['atencionde']; ?>&nbsp;</b></td>
</tr>  
 <p>   
<tr>
    <p>   
<tr>
  
 <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="right">&nbsp;</td>
  
</tr>
</p>
  
 <td rowspan="1" style="width: 40%; font-size: 10pt;" align="right">&nbsp;</td>
  <br>
  <br>
 
  <td style="width: 10%; font-size: 10pt;" align="left"></td>
  <td style="width: 50%; font-size: 10pt; font-size: 11pt;" align="left"><?php echo ' '.$pedido['empresa']; ?>&nbsp;</td>
</tr>
</p>



<tr>
  
 <td rowspan="1" style="width: 40%; font-size: 10pt;" align="right">&nbsp;</td>
  <br>
  <br>
 
  <td style="width: 10%; font-size: 10pt;" align="left"></td>
  <td style="width: 50%; font-size: 9pt;" align="left"><?php echo ' '.$pedido['direccion']; ?>&nbsp;</td>
</tr>  

</table>
<br>
<br>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <tr>
  
  <td rowspan="1" style="width: 100%; font-size: 11pt;" align="left">Por medio de la  presente reciba  un cordial  saludo, a continuación nos  permitimos someter a su consideración la siguiente cotización:</td>
  <br>
 
  
</tr>   

 

</table>
    
     <br>


     <page_footer> 
          

    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <tr>
  
  <td rowspan="1" style="width: 100%; font-size: 7pt;" align="left">&nbsp;AVENIDA HIDALGO #30 FRACC. GAVILANES, TLAJOMULCO DE ZUÑIGA JALISCO C.P. 45645 TEL. (33)33301620. <b>www.transvivegdl.com.mx</b></td>
  <br>
 
  
</tr>  
<tr>
  
  <td rowspan="1" style="width: 100%; font-size: 7pt;" align="left">&nbsp;</td>
  <br>
 
  
</tr> 
<tr>
  
  <td rowspan="1" style="width: 100%; font-size: 7pt;" align="left">&nbsp;</td>
  <br>
 
  
</tr> 



</table>
 
    </page_footer> 
  
    <table cellspacing="0" style="width: 100%; padding: 0; margin: 0; font-size: 10pt;">
        <colgroup>
            <col style="width: 30%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 15%; text-align: center">
            <col style="width: 30%; text-align: center">
            <col style="width: 15%; text-align: center">
            
        </colgroup>
        <thead>
            <tr style="background: #DCDFDF">
              <th style="border-bottom: solid 1px black; font-size: 10pt;">Ruta</th>
              <th style="border-bottom: solid 1px black; font-size: 10pt;">Unidad</th>
              <th style="border-bottom: solid 1px black; font-size: 10pt;">Capacidad</th>
              <th style="border-bottom: solid 1px black; font-size: 10pt;">Días/Hr.</th>
              <th style="border-bottom: solid 1px black; font-size: 10pt;">Precio x Servicio</th>
                
                
            </tr>
        </thead>
        <tbody>
<?php
   $query_productos = mysqli_query($conection,"SELECT dt.id, dt.folio, dt.ruta, dt.unidad, dt.capacidad, dt.dias_horas, dt.precio_servicio FROM detalle_cotizacionventa dt WHERE dt.folio = $cotizacionno ");
      $result_detalle = mysqli_num_rows($query_productos);

    if ($cotizacionno == 1472) {
        // code...
    
      if ($result_detalle >= 10) {
         $filas = $result_detalle;
      }else {
         $filas = 10 - $result_detalle;
      }
    }else {
      if ($result_detalle >= 15) {
         $filas = $result_detalle;
      }else {
         $filas = 15 - $result_detalle;
      }
    }
      // $filas = $result_detalle;
      for ($i = 1; $i < $filas; $i++) {

      while ($row = mysqli_fetch_assoc($query_productos)){
      
?>
            <tr>
                <td style="text-align: left; font-size: 9pt; "><?php echo $row['ruta']; ?>&nbsp;</td>
                <td style="text-align: center; font-size: 9pt;"><?php echo $row['unidad']; ?></td>
                <td style="text-align: center; font-size: 9pt;"><?php echo $row['capacidad']; ?> </td>
                <td style="text-align: center; font-size: 9pt;"><?php echo $row['dias_horas']; ?></td>
                <td style="text-align: right; font-size: 9pt;"><?php echo '$ '.number_format($row['precio_servicio'],2); ?></td>
                
            </tr>
<?php
    }

?>
             <tr>
                <td style="text-align: left; font-size: 10pt; font-family:'Arial'"><?php echo ''; ?>&nbsp;</td>
               
                <td style="text-align: right; font-size: 10pt;"><?php echo ''; ?></td>
                
            </tr>
    <?php
   
    }

?>

            <!--<tr style="background: #E7E7E7;">
                <th colspan="5" style="border-top: solid 1px black; text-align: right; font-size: 12pt;">Cantidad Total:&nbsp; </th>
                <th style="border-top: solid 1px black; text-align: right; font-size: 12pt;"><?php echo number_format($cant_totalkg, 0); ?>&nbsp;</th>
                <th colspan="7" style="border-top: solid 1px black; text-align: right;"></th>
                <th style="border-top: solid 1px black; text-align: right;">&nbsp;</th>
            </tr>-->
        </tbody>
    </table>
    <br>
    
    <p style="font-size: 10pt;">
    Observaciones: <?php echo $pedido['observaciones']; ?></p>
    <br>
  
    <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 9pt; ">
       
       
        <tr>
            <td style="text-align: left; width:100%; font-weight: normal;">&nbsp;<b>Condiciones del Servicio:</b></td>
           
            
        </tr>   
        <p>
         <tr>
            <td style="text-align: left; width:100%; font-weight: normal;">&nbsp;<?php echo 'Pago: '. '<span style="font-weight: bold; text-decoration: underline;">'. '&nbsp;&nbsp;'.$pedido['dias_credito'].'&nbsp;&nbsp; '.'</span>' ?></td> 
        </tr> 
        </p>  

         <p>
         <tr>
            <td style="text-align: left; width:100%; font-weight: normal;">&nbsp;<?php echo 'I.V.A.: A estos precios se les aumentará el 16 %.' ?></td>
        </tr> 
        </p>  

         <p>
         <tr>
            <td style="text-align: left; width:100%; font-weight: normal;">&nbsp;<?php echo 'Vigencia: Del  '. '<span style="font-weight: bold; text-decoration: underline;">'. '&nbsp;&nbsp;'.$pedido['fecha_inicio'].'&nbsp;&nbsp; '.'</span>'.' Hasta ' .'<span style="font-weight: bold; text-decoration: underline;">'. '&nbsp;&nbsp;'.$pedido['fecha_fin'].'&nbsp;&nbsp; '.'</span>' ?></td> 
        </tr> 
        </p>  

        <p>
         <tr>
            <td style="text-align: left; width:100%; font-weight: normal;">&nbsp;<?php echo 'Comienzo del Servicio:  '. '<span style="font-weight: bold; text-decoration: underline;">'. '&nbsp;&nbsp;'.$pedido['comienza_servicio'].'&nbsp;&nbsp; '.'</span>' ?></td> 
        </tr> 
        </p> 

        <p>
            <tr>
            <td style="text-align: left; width:100%; font-weight: normal;">&nbsp;<b>Nota: </b> En caso de tener algún requisito legal o reglamentario, favor de comunicarlo para su consideración.
            </td>
        </tr>  
        </p> 
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>
            <tr>
            <td style="text-align: left;  font-size: 10px; width:100%; font-weight: normal;">&nbsp;
            </td>
        </tr>  
        </p> 

         <p>
            <tr>
            <td style="text-align: left; font-size: 11pt; width:100%; font-weight: normal;">Esperando ser el mejor proveedor para su empresa, nos despedimos quedando a sus órdenes para cualquier duda o acalarción.
            </td>
        </tr>  
        </p> 

        
       

    </table>
    <br>
    <br>
    <br>
    <br>
     <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
        <thead>
       
        <tr>
            <th style="text-align: center; width:40%; font-weight: normal;">&nbsp;______________________________</th>
            <th style="text-align: center; width:20%; font-weight: normal;">&nbsp;</th>
            <th style="text-align: center; width:40%; font-weight: normal;">&nbsp;______________________________</th>
            
        </tr>     
        </thead>
        <tbody>
             <tr>
                <td style="text-align: center; font-weight: bold;"><?php echo 'ITZURI ARRIAGA PAZ' ?></td>
                <td style="text-align: center;"><?php echo '' ?></td>
                <td style="text-align: center; font-weight: bold;"><?php echo $pedido['atencionde']; ?></td>
                
              </tr>  
               <tr>
                <td style="text-align: center; font-weight: bold;"><?php echo 'Atentamente' ?></td>
                <td style="text-align: center;"><?php echo '' ?></td>
                <td style="text-align: center; font-weight: bold;"><?php echo 'Cliente'; ?></td>
                
              </tr>  
        </tbody>
    </table>

<?php
            $query_imagenes = mysqli_query($conection,"SELECT dt.id, dt.folio, dt.ruta, dt.unidad, dt.capacidad, dt.dias_horas, dt.precio_servicio, dt.imagen FROM detalle_cotizacionventa dt WHERE dt.imagen IS NOT NULL AND dt.imagen != '' and dt.folio = $cotizacionno ");
            $result_detalleimg = mysqli_num_rows($query_imagenes);

             if ($result_detalleimg == 0){
             ?>   
                <br>
             <?php   
             }else {   
?>                 

<div style="page-break-before: always;">

</div>
<br>
<br>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <!--<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;<?php echo 'Guadalajara, Jal. a '.$mesDesc ?></td>
  <br>
 
  
</tr>-->   
   
 <p>   
    <tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;<?php echo 'Guadalajara, Jal. a '.$mesDesc ?></td>
  <br>
 
  
</tr> 

<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;</td>
  <br>
 
  
</tr> 
<tr>
  
  <td rowspan="1" colspan="2" style="width: 60%; font-size: 9pt;" align="left">&nbsp;</td>
  <br>
 
  
  <td style="border: 0; border: 0.5px solid #000; vertical-align:middle; width: 23%; font-size: 10pt; align:left; background: #DCDFDF">&nbsp;N° de Cotización:</td>
  <td style="border: 0; border: 0.5px solid #000; width: 17%; font-size: 10pt;" align="center" ><b style="font-size: 12pt; color: #DA1136"><?php echo ' '.$pedido['no_cotizacion']; ?>&nbsp;</b></td>
</tr>
</p>



<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right"><img style="width:20%" src="../../images/transvive_logo.png" alt="Logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <br>
 
  
</tr>



</table>
<br>
<br>
<br>


<table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
<thead>
       
        <tr>
            <th style="text-align: center; width:20%; font-weight: bold;">&nbsp;Ruta</th>
            <th style="text-align: center; width:70%; font-weight: bold;">&nbsp;Imagen</th>
            <th style="text-align: center; width:10%; font-weight: bold;">&nbsp;</th>
           
            
        </tr>     
        </thead>
        <br>
<tbody>

            <?php
           
               while ($rowi = mysqli_fetch_assoc($query_imagenes)){
             ?>
            <tr>
                <td style="text-align: left; font-size: 9pt; "><?php echo $rowi['ruta']; ?>&nbsp;</td>
                <td style="text-align: center;"><img style="width: 450px; height: 250px;" src="<?php echo '../'.$rowi['imagen']; ?>"></td>
                <td style="text-align: left; font-size: 9pt; ">&nbsp;</td>
                
            </tr>
            <?php
              }
            ?>
        </tbody>
</table>
<?php 
}
?>
  
</page>