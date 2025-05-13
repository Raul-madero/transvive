<?php
session_start();
$idpropiedad = $_REQUEST['id'];
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
    $query = mysqli_query($conection,"SELECT p.id, p.no_queja, p.fecha, p.mes, p.cliente, p.f8d, p.descripcion, p.motivo, p.responsable, p.supervisor, p.operador, p.unidad, p.ruta, p.parada, p.fecha_incidente, p.turno, p.procede_ac, p.porque_procede, p.analisis_conclusionac, p.accion, p.fecha_accion, p.responsable_accion, p.fecha_cierre, p.observaciones, p.tipo_incidente, p.estatus, p.cuenta, p.causa, p.afecta, p.area_responsable FROM no_conformidades p WHERE p.no_queja = $idpropiedad");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['fecha']));

if ($pedido['fecha'] > '2000-01-01') {
        $newDateinicio = $Dateinicio;
}else {
        $newDateinicio = '';
}

$Dateincidente = date("d-m-Y", strtotime($pedido['fecha_incidente']));

if ($pedido['fecha_incidente'] > '2000-01-01') {
        $newDateincidente = $Dateincidente;
}else {
        $newDateincidente = '';
}

$Dateaccion = date("d-m-Y", strtotime($pedido['fecha_accion']));

if ($pedido['fecha_accion'] > '2000-01-01') {
        $newDateaccion = $Dateaccion;
}else {
        $newDateaccion = '';
}

$Datecierre = date("d-m-Y", strtotime($pedido['fecha_cierre']));

if ($pedido['fecha_cierre'] > '2000-01-01') {
        $newDatecierre = $Datecierre;
}else {
        $newDatecierre = '';
}


?>
<page backcolor="#FEFEFE" backimg="../../images/transvive_water2.png" backimgx="center" backimgy="middle" backimgw="60%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Titulo:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 9pt;" align="center">QUEJA Y/O NO CONFORMIDAD Y ANÁLISIS</td>
  <br>
 
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td style="vertical-align:middle; width: 15%; font-size: 9pt;" align="center">FO-TV-VT-11</td>
</tr>



<tr>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 9pt;" align="center">ASEGURIMIENTO DE CALIDAD</td>
</tr>



</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <!--<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;<?php echo 'Guadalajara, Jal. a '.$mesDesc ?></td>
  <br>
 
  
</tr>-->   
 
 <p>   
<tr>
  
 <td style="width: 20%; font-size: 10pt;" align="left">&nbsp;</td>
  <br>
  <td style="width: 55%; font-size: 10pt;" align="left">&nbsp;</td>
 
  <td style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="left"; >&nbsp;Folio:</td>
  <td style="border: solid .5px; width: 15%; font-size: 10pt;" align="center" ><?php echo ' '.$idpropiedad; ?></td>
</tr>

<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Mes:</td>
  <br>
  <td style="border: solid .5px; width: 55%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['mes']; ?></td>
 
  <td style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="left"; >&nbsp;Fecha:</td>
  <td style="border: solid .5px; width: 15%; font-size: 10pt;" align="center" ><?php echo ' '.$newDateinicio; ?></td>
</tr>
</p>
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Cliente:</td>
  <br>
  <td style="border: solid .5px; width: 55%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['cliente']; ?></td>
 
  <td style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="left"; >&nbsp;8D:</td>
  <td style="border: solid .5px; width: 15%; font-size: 10pt;" align="center" ><?php echo ' '.$pedido['f8d']; ?></td>
</tr>


</table>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Descripción:</td>
  <br>
  <td style="border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo $pedido['descripcion']; ?></td>
 
 
</tr>
</p>
<p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Motivo:</td>
  <br>
  <td style="border: solid .5px; width: 80%; font-size: 9pt;" align="left"><?php echo '&nbsp;'.$pedido['motivo']; ?></td>
</tr>
</p>
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Responsable:</td>
  <br>
  <td style="border: solid .5px; width: 33%; font-size: 9pt;" align="left"><?php echo '&nbsp;'.$pedido['responsable']; ?></td>
  <td style="background: #DCDFDF; border: solid .5px; width: 12%; font-size: 10pt;" align="left">&nbsp;Supervisor:</td>
  <br>
  <td style="border: solid .5px; width: 35%; font-size: 9pt;" align="left"><?php echo '&nbsp;'.$pedido['supervisor']; ?></td>
</tr>
</p>
<p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Operador:</td>
  <br>
  <td style="border: solid .5px; width: 33%; font-size: 9pt;" align="left"><?php echo '&nbsp;'.$pedido['operador']; ?></td>
  <td style="background: #DCDFDF; border: solid .5px; width: 12%; font-size: 10pt;" align="left">&nbsp;Unidad:</td>
  <br>
  <td style="border: solid .5px; width: 35%; font-size: 9pt;" align="center"><?php echo '&nbsp;'.$pedido['unidad']; ?></td>
</tr>
</p>
<p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Ruta:</td>
  <br>
  <td style="border: solid .5px; width: 33%; font-size: 9pt;" align="left"><?php echo '&nbsp;'.$pedido['ruta']; ?></td>
  <td style="background: #DCDFDF; border: solid .5px; width: 12%; font-size: 10pt;" align="left">&nbsp;Parada:</td>
  <br>
  <td style="border: solid .5px; width: 35%; font-size: 9pt;" align="left"><?php echo '&nbsp;'.$pedido['parada']; ?></td>
</tr>
</p>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;Fecha del incidente:</td>
  <br>
  <td style="border: solid .5px; width: 15%; font-size: 9pt;" align="center"><?php echo '&nbsp;'.$newDateincidente; ?></td>
  <td style="background: #DCDFDF; border: solid .5px; width: 12%; font-size: 10pt;" align="left">&nbsp;Turno:</td>
  <br>
  <td style="border: solid .5px; width: 15%; font-size: 9pt;" align="center"><?php echo '&nbsp;'.$pedido['turno']; ?></td>
   <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Procede AC (sí o no):</td>
  <br>
  <td style="border: solid .5px; width: 13%; font-size: 9pt;" align="center"><?php echo '&nbsp;'.$pedido['procede_ac']; ?></td>
</tr>
</p>
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;¿Por qué procede o no? (AC):</td>
  <br>
  <td style="border: solid .5px; width: 75%; font-size: 10pt;" align="left"><?php echo $pedido['porque_procede']; ?></td>
 
 
</tr>
</p>
<p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;Análisis y conclusión AC:</td>
  <br>
  <td style="border: solid .5px; width: 75%; font-size: 9pt;" align="left"><?php echo $pedido['analisis_conclusionac']; ?></td>
</tr>
</p>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;Acción:</td>
  <br>
  <td style="border: solid .5px; width: 45%; font-size: 9pt;" align="left"><?php echo '&nbsp;'. $pedido['accion']; ?></td>
 <td style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 10pt;" align="left">&nbsp;Fecha Acción:</td>
  <br>
  <td style="border: solid .5px; width: 15%; font-size: 9pt;" align="center"><?php echo $newDateaccion; ?></td> 
</tr>
</p>
<p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width:25%; font-size: 10pt;" align="left">&nbsp;Responsable de la Acción:</td>
  <br>
  <td style="border: solid .5px; width: 45%; font-size: 9pt;" align="left"><?php echo '&nbsp;'. $pedido['responsable_accion']; ?></td>
 <td style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 10pt;" align="left">&nbsp;Fecha de cierre:</td>
  <br>
  <td style="border: solid .5px; width: 15%; font-size: 9pt;" align="center"><?php echo $newDatecierre; ?></td> 
</tr>
</p>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Observaciones:</td>
  <br>
  <td style="border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo $pedido['observaciones']; ?></td>
 
 
</tr>
</p>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;Incidente ¿interno o externo?:</td>
  <br>
  <td style="border: solid .5px; width: 35%; font-size: 9pt;" align="center"><?php echo '&nbsp;'. $pedido['tipo_incidente']; ?></td>
 <td style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 10pt;" align="left">&nbsp;Estatus:</td>
  <br>
  <td style="border: solid .5px; width: 25%; font-size: 9pt;" align="center"><?php echo '&nbsp;'. $pedido['estatus']; ?></td> 
</tr>
</p>
</table>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;Causa:</td>
  <br>
  <td style="border: solid .5px; width: 35%; font-size: 9pt;" align="left"><?php echo '&nbsp;'. $pedido['causa']; ?></td>
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;¿Afecta al cliente?:</td>
  <br>
  <td style="border: solid .5px; width: 15%; font-size: 9pt;" align="center"><?php echo '&nbsp;'. $pedido['afecta']; ?></td> 
</tr>
</p>

</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp;Área responsable:</td>
  <br>
  <td style="border: solid .5px; width: 75%; font-size: 10pt;" align="center"><?php echo $pedido['area_responsable']; ?></td>
 
 
</tr>
</p>
</table>



<page_footer> 
          
    <br>
   <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
  
       
        <tr>
          <td style="width: 100%; font-size: 9pt;" align="center"> [[page_cu]]/[[page_nb]]</td>
            
        </tr>     
       
    </table>
 
    </page_footer> 
    <br>

  
</page>