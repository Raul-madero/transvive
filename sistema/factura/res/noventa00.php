<?php
session_start();
//Variables para consulta
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 10);
//Consulta sql encabezado

$date = new DateTime($fecha_ini);
$iniDate = $date->format('Y/m/d');

$date2 = new DateTime($fecha_fin);
$finDate = $date2->format('Y/m/d');

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
    $query = mysqli_query($conection,"SELECT p.id, p.fecha, p.servicio_solicitado, p.descripcion_servicio, p.importe, p.cliente, p.observaciones, p.elaboro FROM noventa p WHERE p.fecha BETWEEN '$fecha_ini' and '$fecha_fin' order by p.fecha ");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['fecha']));
//$Datefin = date("d-m-Y", strtotime($pedido['fecha_servicio']));



?>
<page orientation="landscape" format="letter" backcolor="#FEFEFE" backimg="../../images/transvive_water2.png" backimgx="center" backimgy="middle" backimgw="60%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Titulo:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 11pt;" align="center">FORMATO DE NO VENTA</td>
  <br>
 
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td style="vertical-align:middle; width: 15%; font-size: 9pt;" align="center">FO-TV-VT-07</td>
</tr>



<tr>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 10pt;" align="center">VENTAS</td>
</tr>



</table>
<br>


<br>

<table cellspacing="0" style="width: 100%; ">
        <colgroup>
            <col style="width: 8%; text-align: center">
            <col style="width: 20%; text-align: center">
            <col style="width: 20%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 15%; text-align: center">
            <col style="width: 14%; text-align: center">
            <col style="width: 13%; text-align: center">
            
        </colgroup>
        <thead>
             

            <tr style="background: #DCDFDF">
              <th style="border: solid .5px; font-size: 10pt;">Fecha</th>
              <th style="border: solid .5px; font-size: 10pt;">Servicio Solocotado</th>
              <th style="border: solid .5px; font-size: 10pt;">Descripción</th>
              <th style="border: solid .5px; font-size: 10pt;">Importe</th>
              <th style="border: solid .5px; font-size: 10pt;">Cliente</th>
              <th style="border: solid .5px; font-size: 10pt;">Observación</th>
              <th style="border: solid .5px; font-size: 10pt;">Elaboró</th>
                
                
            </tr>
        </thead>
        <tbody>
<?php
   $query_productos = mysqli_query($conection,"SELECT p.id, p.fecha, p.servicio_solicitado, p.descripcion_servicio, p.importe, p.cliente, p.observaciones, p.elaboro FROM noventa p WHERE p.fecha BETWEEN '$fecha_ini' and '$fecha_fin' order by p.fecha ");
      $result_detalle = mysqli_num_rows($query_productos);



      if ($result_detalle >= 10) {
         $filas = $result_detalle;
      }else {
         $filas = 10 - $result_detalle;
      }
      for ($i = 1; $i < $filas; $i++) {

     
      while ($row = mysqli_fetch_assoc($query_productos)){
      $Dateinicio = date("d-m-Y", strtotime($pedido['fecha']));
      
?>
            <tr>
                <td style="vertical-align:middle; border: solid .5px; text-align: center; font-size: 10pt; font-family:'Arial'"><?php echo $Dateinicio; ?>&nbsp;</td>
                <td style="vertical-align:middle; border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['servicio_solicitado']; ?></td>
                <td style="border: solid .5px; text-align: left; font-size: 10pt;"><?php echo $row['descripcion_servicio']; ?> </td>
                <td style="vertical-align:middle; border: solid .5px; text-align: center; font-size: 10pt;"><?php echo number_format($row['importe'],2); ?></td>
                <td style="vertical-align:middle; border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['cliente']; ?></td>
                <td style="border: solid .5px; text-align: left; font-size: 10pt;"><?php echo $row['observaciones']; ?></td>
                <td style="vertical-align:middle; border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['elaboro']; ?></td>
                
            </tr>
<?php
    }

?>

            <tr>
                <td style="border: solid .5px; text-align: left; font-size: 10pt; font-family:'Arial'"><?php echo ''; ?>&nbsp;</td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo ''; ?> </td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid .5px; text-align: right; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid .5px; text-align: right; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid .5px; text-align: right; font-size: 10pt;"><?php echo ''; ?></td>
                
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

<page_footer> 
          
    <br>
   <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
  
       
        <tr>
          <td style="width: 100%; font-size: 9pt;" align="center"> [[page_cu]]/[[page_nb]]</td>
            
        </tr>     
       
    </table>
 
    </page_footer> 
    <br>
    <br>
    <br>
  

    
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <br>
    
  
</page>