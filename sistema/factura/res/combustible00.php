<?php
session_start();
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 10);
//Consulta sql encabezado

$date = new DateTime($fecha_ini);
$iniDate = $date->format('d/m/Y');

$date2 = new DateTime($fecha_fin);
$finDate = $date2->format('d/m/Y');

$Datei = $date->format('Y-m-d');
$Datef = $date2->format('Y-m-d');

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
    $query = mysqli_query($conection,"SELECT id, fecha, estacion, nounidad, placas, operador, kmactual_cargar, tipo_combustible, litros, precio, importe FROM carga_combustible WHERE fecha BETWEEN '$Datei' and '$Datef' and estatus = 1 ORDER by fecha, id");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);


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
<page  style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>

  <table  align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="width: 25%; color: #444444;" ><img style="width: 80%; height: 5%;" align="center" src="../../images/transvive_logo.png" alt="Logo"></td>
  <br>
  
  <td style="vertical-align:middle; width: 75%; font-size: 11pt;" align="center">Reporte de Carga de Combustible por Fecha</td>
  <br>
 
 
 
</tr>







</table>

<br>
<br>


    
     <br>


     <page_footer> 
          

    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <tr>
  
  <td rowspan="1" style="width: 100%; font-size: 7pt;" align="left">&nbsp;</td>
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
  
    <table cellspacing="0" style="width: 100%; ">
        <colgroup>
            <col style="width: 10%; text-align: center">
            <col style="width: 24%; text-align: center">
            <col style="width: 8%; text-align: center">
            <col style="width: 8%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 14%; text-align: center">
            <col style="width: 8%; text-align: center">
            <col style="width: 8%; text-align: center">
            <col style="width: 10%; text-align: center">

            
        </colgroup>
        <thead>
            <tr style="background: #DCDFDF">
              <th style="border: solid 0.5px black; font-size: 10pt;">Fecha</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">Estacion</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">No. Eco.</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">Placas</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">KM</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">Combustible</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">Litros</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">Precio</th>
              <th style="border: solid 0.5px black; font-size: 10pt;">Importe</th>


                
                
            </tr>
        </thead>
        <tbody>
<?php
   $query_productos = mysqli_query($conection,"SELECT id, fecha, estacion, nounidad, placas, operador, kmactual_cargar, tipo_combustible, litros, precio, importe FROM carga_combustible WHERE fecha BETWEEN '$Datei' and '$Datef' and estatus = 1 ORDER by fecha, id");
      $result_detalle = mysqli_num_rows($query_productos);

      $totlitros = 0;
      $totprecio = 0;
      $totimporte = 0;

     
      while ($row = mysqli_fetch_assoc($query_productos)){
        $Newdate = date("d/m/Y", strtotime($row['fecha']));
        $totlitros = $totlitros + $row['litros'];
        $totimporte = $totimporte + $row['importe'];
      
?>
            <tr>
                <td style="border: solid 0.5px black; text-align: center; font-size: 9pt; font-family:'Arial'"><?php echo $Newdate; ?>&nbsp;</td>
                <td style="border: solid 0.5px black; text-align: left; font-size: 9pt;"><?php echo $row['estacion']; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 9pt;"><?php echo $row['nounidad']; ?> </td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 9pt;"><?php echo $row['placas']; ?></td>
                <td style="border: solid 0.5px black; text-align: right; font-size: 9pt;"><?php echo number_format($row['kmactual_cargar'],2); ?>&nbsp;</td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 9pt;"><?php echo $row['tipo_combustible']; ?></td>
                <td style="border: solid 0.5px black; text-align: right; font-size: 9pt;"><?php echo number_format($row['litros'],0); ?>&nbsp;</td>
                <td style="border: solid 0.5px black; text-align: right; font-size: 9pt;"><?php echo number_format($row['precio'],2); ?>&nbsp;</td>
                <td style="border: solid 0.5px black; text-align: right; font-size: 9pt;"><?php echo number_format($row['importe'],2); ?>&nbsp;</td>
                
            </tr>

    <?php
   
    }

?>        
         
            <tr style="background: #E7E7E7;">
                <th colspan="6" style="border: solid 0.5px black; text-align: right; font-size: 9pt;">Cantidad Total:&nbsp; </th>
                <th style="border: solid 0.5px black; text-align: right; font-size: 9pt;"><?php echo number_format($totlitros, 0); ?>&nbsp;</th>
                <th  style="border: solid 0.5px black; text-align: right;"></th>
                <th style="border: solid 0.5px black; text-align: right; font-size: 9pt;"><?php echo number_format($totimporte, 2); ?>&nbsp;</th>
            </tr>
            
            
        </tbody>
    </table>
    <br>
    
   
  
</page>