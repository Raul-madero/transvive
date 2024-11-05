<?php
session_start();
$nooservicio = $_REQUEST['id'];
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
    $query = mysqli_query($conection,"SELECT p.id, p.folio, p.fecha, p.nocliente, p.cliente, p.domicilio, p.tipo_servicio, p.fecha_servicio, p.contacto, p.correo_contacto, p.telefono, p.cambios_especificos, p.requisicion_legal, p.genera, p.recibe, p.estatus, ct.nombre FROM ordenes_servicio p INNER JOIN clientes ct ON p.nocliente = ct.no_cliente WHERE folio = $nooservicio");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['fecha']));
$Datefin = date("d-m-Y", strtotime($pedido['fecha_servicio']));


if ($pedido['fecha'] > '2000-01-01') {
        $newDateinicio = $Dateinicio;
}else {
        $newDateinicio = '';
}

if ($pedido['fecha_servicio'] > '2000-01-01') {
        $newDatefin = $Datefin;
}else {
        $newDatefin = '';
}

?>
<page backcolor="#FEFEFE" backimg="../../images/transvive_water2.png" backimgx="center" backimgy="middle" backimgw="60%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Título:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 11pt;" align="center">ORDENES DE SERVICIO</td>
  <br>
 
  <td rowspan="2" style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Código:</td>
  <td rowspan="2" style="vertical-align:middle; width: 15%; font-size: 9pt;" align="center">FO-TV-VT-03</td>
</tr>



<tr>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Área:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 10pt;" align="center">VENTAS</td>
</tr>



</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <!--<tr>
  
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="right">&nbsp;<?php echo 'Guadalajara, Jal.  '.$mesDesc ?></td>
  <br>
 
  
</tr>-->   
 <p>   
<tr>
  
  <td rowspan="1" colspan="2" style="width: 68%; font-size: 9pt;" align="left">&nbsp;</td>
  <br>
 
  <td style="width: 16%; font-size: 10pt;" align="left"><b>&nbsp;N° de Orden:</b></td>
  <td style="width: 16%; font-size: 10pt;" align="right" ><b style="font-size: 12pt; color: #DA1136"><?php echo ' '.$pedido['folio']; ?>&nbsp;</b></td>
</tr>
</p>

 <p>   
<tr>
  
  <td rowspan="1" colspan="2" style="width: 68%; font-size: 9pt;" align="left">&nbsp;</td>
  <br>
 
  <td style="width: 16%; font-size: 10pt;" align="left">&nbsp;Fecha:</td>
  <td style="width: 16%; font-size: 10pt;" align="center" ><?php echo ' '.$newDateinicio; ?></td>
</tr>
</p>

<p>   
<tr>
  
  <td rowspan="1" style="border: solid .5px; vertical-align:middle; width: 18%; font-size: 10pt;" align="left">&nbsp; Nombre del Cliente:</td>
  <br>
  <td rowspan="1" style="border: solid .5px; width: 50%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['nombre']; ?></td>
 
  <td style="border: solid .5px; width: 16%; font-size: 10pt;" align="left">&nbsp;No. Cliente:</td>
  <td style="border: solid .5px; width: 16%; font-size: 10pt;" align="center" >&nbsp; <?php echo ' '.$pedido['nocliente']; ?></td>
</tr>
</p>

<p>   
<tr>
  
  <td rowspan="1" style="border: solid .5px; vertical-align:middle; width: 18%; font-size: 10pt;" align="left">&nbsp; Domicilio:</td>
  <br>
  <td rowspan="1" colspan="3" style="border: solid .5px; width: 82%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['domicilio']; ?></td>
</tr>
</p>

<p>   
<tr>
  
  <td rowspan="1" style="border: solid .5px; vertical-align:middle; width: 18%; font-size: 10pt;" align="left">&nbsp;Tipo de Servicio:</td>
  <br>
  <td rowspan="1" style="border: solid .5px; vertical-align:middle; width: 40%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['tipo_servicio']; ?></td>
 
  <td style="border: solid .5px; width: 16%; font-size: 10pt;" align="left">&nbsp;Fecha de Inico de Servicio:</td>
  <td style="border: solid .5px; vertical-align:middle; width: 16%; font-size: 10pt;" align="center" >&nbsp; <?php echo ' '.$newDatefin; ?></td>
</tr>
</p>


</table>

<br>

<page_footer> 
          
    <br>
   <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
        <thead>
       
        <tr>
            <th style="border: solid .5px; text-align: center; width:50%; font-weight: normal; background: #DCDFDF">&nbsp;Genera:</th>
            <th style="border: solid .5px; text-align: center; width:50%; font-weight: normal; background: #DCDFDF">&nbsp;Recibe:</th>
            
        </tr>     
        </thead>
        <tbody>
             <tr>
                <td style="border: solid .5px; text-align: center; font-weight: bold;"><?php echo $pedido['genera']; ?></td>
                <td style="border: solid .5px; text-align: center; font-weight: bold;"><?php echo $pedido['recibe']; ?></td>
                
              </tr>  
        </tbody>
    </table>
 
    </page_footer> 
    <br>
    <table cellspacing="0" style="width: 100%; ">
        <colgroup>
            <col style="width: 25%; text-align: center">
            <col style="width: 15%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 15%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 15%; text-align: center">
            
        </colgroup>
        <thead>
             <tr style="background: #DCDFDF">
              <th colspan="7" style="border: solid 1px black; font-size: 10pt;"><b>DATOS DEL SERVICIO</b></th>
              
                
                
            </tr>

            <tr style="background: #DCDFDF">
              <th style="vertical-align:middle; border: solid .5px; font-size: 10pt;">Rutas</th>
              <th style="border: solid .5px; font-size: 10pt;">Hora Llegada o Entrada</th>
              <th style="border: solid .5px; font-size: 10pt;">Hora de Salida</th>
              <th style="vertical-align:middle; border: solid .5px; font-size: 10pt;">Turnos</th>
              <th style="border: solid .5px; font-size: 10pt;">Tipo de Unidad</th>
              <th style="border: solid .5px; font-size: 10pt;">Tipo de Vuelta</th>
              <th style="vertical-align:middle; border: solid .5px; font-size: 10pt;">Días a Trabajar</th>
                
                
            </tr>
        </thead>
        <tbody>
<?php
   $query_productos = mysqli_query($conection,"SELECT dt.id, dt.folio, dt.rutas, dt.hora_inicio, dt.hora_salida, dt.turnos, dt.tipo_unidad, dt.tipo_vuelta, dt.dias_trabajar, dt.imagen FROM detalle_ordenservicio dt WHERE dt.folio = $nooservicio ");
      $result_detalle = mysqli_num_rows($query_productos);

      if ($result_detalle >= 10) {
         $filas = $result_detalle;
      }else {
         $filas = 10 - $result_detalle;
      }
      for ($i = 1; $i < $filas; $i++) {

     
      while ($row = mysqli_fetch_assoc($query_productos)){

        if ($row['imagen']== '') {
      
?>
            <tr>
                <td style="border: solid .5px; text-align: left; font-size: 10pt; font-family:'Arial'"><?php echo $row['rutas']; ?>&nbsp;</td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['hora_inicio']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['hora_salida']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['turnos']; ?> </td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['tipo_unidad']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['tipo_vuelta']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['dias_trabajar']; ?></td>
                
            </tr>
        <?php  
        }else {
        ?>    
          <tr>
                <td style="border: solid .5px; text-align: left; font-size: 10pt; font-family:'Arial'"><?php echo $row['rutas']; ?>&nbsp;</td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['hora_inicio']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['hora_salida']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['turnos']; ?> </td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['tipo_unidad']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['tipo_vuelta']; ?></td>
                <td style="border: solid .5px; text-align: center; font-size: 10pt;"><?php echo $row['dias_trabajar']; ?></td>
                
            </tr>  
            <tr>
                <td colspan="7" style="border: solid .5px; text-align: center;"><img style="width: 60%;" src="<?php echo '../'.$row['imagen']; ?>"></td>
                
            </tr> 
            
<?php
    } }

?>

            <tr>
                <td style="text-align: left; font-size: 10pt; font-family:'Arial'"><?php echo ''; ?>&nbsp;</td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?> </td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
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
    <br>
  
    <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
       
       
        <tr>
            <td colspan="1" style="border: solid .5px; text-align: left; width:15%; font-weight: normal;">&nbsp;Contacto RH:</td>
            <td colspan="3" style="border: solid .5px; text-align: left; width:85%; font-weight: normal;">&nbsp;<?php echo $pedido['contacto']; ?></td> 
        </tr>   
        <p>
        <tr>
            <td colspan="1" style="border: solid .5px; text-align: left; width:15%; font-weight: normal;">&nbsp;Correo:</td>
            <td colspan="1" style="border: solid .5px; text-align: left; width:35%; font-weight: normal;">&nbsp;<?php echo $pedido['correo_contacto']; ?></td>
            <td colspan="1" style="border: solid .5px; text-align: left; width:15%; font-weight: normal;">&nbsp;Teléfono:</td>
            <td colspan="1" style="border: solid .5px; text-align: left; width:35%; font-weight: normal;">&nbsp;<?php echo $pedido['telefono']; ?></td> 
        </tr>   
        </p>
        <p>
        <tr>
            <td colspan="4" style="border: solid .5px; text-align: left; width:100%; font-weight: normal;"><b>&nbsp;CAMBIOS EN LA ESPECIFICACION TECNICA DEL SERVICIOS SOLICITADOS / OBSERVACIONES:</b></td>
             
        </tr> 
        </p>
         <p>
        <tr>
            <td colspan="4" style="border: solid .5px; text-align: left; width:100%; font-weight: normal;">&nbsp;<?php echo $pedido['cambios_especificos']; ?></td>
             
        </tr> 
        </p>

        <p>
        <tr>
            <td colspan="4" style="border: solid .5px; text-align: left; width:100%; font-weight: normal;"><b>&nbsp;Requisitos legales y reglamentarios aplicables:</b></td>
             
        </tr> 
        </p>
         <p>
        <tr>
            <td colspan="4" style="border: solid .5px; text-align: left; width:100%; font-weight: normal;">&nbsp;<?php echo $pedido['requisicion_legal']; ?></td>
             
        </tr> 
        </p>
        
    </table>
    <p style="font-size: 10pt;">
    <b>Nota:</b> Agregar siempre anexo de hojas de ruta con horarios, paradas, referencias y mapa.</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <br>
    
  
</page>