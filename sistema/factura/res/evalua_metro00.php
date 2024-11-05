<?php
session_start();
$noeval = $_REQUEST['id'];
setlocale(LC_ALL, 'spanish');
//Consulta sql encabezado
include('../../conexion.php');

?>
<style>

       table {
            width: 100%;
            border-collapse: collapse; /* Colapsa los bordes para que se vean como una sola línea */
        }

        .full-border {
            border: .5px solid #000; /* Borde de 2px en todos los lados */
            padding: 2px;
            text-align: left; /* Alineación a la izquierda */
        }

</style>
 <?php
    $query = mysqli_query($conection,"SELECT ep.ideval, ep.fecha_eval, ep.tipo_evaluacion, ep.cveproveedor, pv.nombre, ep.producto, rf.descripcion, ep.consulta, ep.documentacion, ep.credito, ep.precios_competitivos, ep.codigo_equipo, ep.fecha_proxima, ep.nombre_tecnico, ep.proteccion, ep.entrega_informe, ep.fecha_hist1, ep.historia1, ep.fecha_hist2, ep.historia2, ep.fecha_hist3, ep.historia3, ep.calificacion_calidad, ep.calificacion_compras, ep.calificacion_total, ep.resultado, ep.acciones FROM evaluaciones_metrologia ep inner join proveedores pv ON ep.cveproveedor = pv.no_prov inner join refacciones rf ON ep.producto = rf.codigo  WHERE ep.ideval = $noeval");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['fecha_eval']));
if ($pedido['fecha_hist1'] > '2020-01-01') {
    $Datehist1  = date("d-m-Y", strtotime($pedido['fecha_hist1']));
}else {
$Datehist1  = '';
}
if ($pedido['fecha_hist2'] > '2020-01-01') {
    $Datehist2  = date("d-m-Y", strtotime($pedido['fecha_hist2']));
}else {
$Datehist2  = '';
}
if ($pedido['fecha_hist3'] > '2020-01-01') {
    $Datehist3  = date("d-m-Y", strtotime($pedido['fecha_hist3']));
}else {
$Datehist3  = '';
}

if ($pedido['historia1'] > 0) {
    $chist_1  = $pedido['historia1'];
}else {
    $chist_1  = '';
}

if ($pedido['historia2'] > 0) {
    $chist_2  = $pedido['historia2'];
}else {
    $chist_2  = '';
}

if ($pedido['historia3'] > 0) {
    $chist_3  = $pedido['historia3'];
}else {
    $chist_3  = '';
}
//$Datefin = date("d-m-Y", strtotime($pedido['fecha_servicio']));


?>
<page backcolor="#FEFEFE" backimg="../../images/transvive_water2.png" backimgx="center" backimgy="middle" backimgw="60%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="border: solid .5px; width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; border: solid .5px; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Titulo:</td>
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 11pt;" align="center">Evaluación de Proveedores</td>
  <br>
 
  <td rowspan="2" style="border: solid .5px; vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td rowspan="2" style="vertical-align:middle; border: solid .5px; width: 15%; font-size: 9pt;" align="center">FO-TV-CO-04</td>
</tr>



<tr>
  <td style="vertical-align:middle; border: solid .5px; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 10pt;" align="center">COMPRAS</td>
</tr>



</table>
<br>
<br>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; Tipo de Valoración:</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 45%; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$pedido['tipo_evaluacion']; ?></td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 12%; font-size: 10pt;" align="left">&nbsp; Fecha:</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 18%; font-size: 10pt;" align="center"><?php echo ' '.$Dateinicio; ?></td>
  <br>
</tr>
<p>
<tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; Nombre del Proveedor:</td>
  <td rowspan="1" colspan="3" style="border: solid .5px; width: 75%; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$pedido['nombre']; ?></td>
  
  <br>
</tr>
</p>

</table>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 35%; font-size: 10pt;" align="left">&nbsp; Producto(s) y/o servicios  Suministrado(s):</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 65%; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$pedido['descripcion']; ?></td>
  
  <br>
</tr>

</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 5%; font-size: 10pt;" align="center">&nbsp; No.</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="center">&nbsp; Área</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 35%; font-size: 10pt;" align="center">&nbsp; Criterios</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="center">&nbsp; Parámetro</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="center">&nbsp; Calif.</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 30%; font-size: 10pt;" align="center">&nbsp; Para Consultar dudas con:</td>
  <br>
</tr>
  
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 1</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">COMPRAS</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 35%; font-size: 9pt;" align="left">PRECIO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 70</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['precios_competitivos']; ?></td>
  <td rowspan="3" colspan="1" style="border: solid .5px; width: 30%; font-size: 9pt;" align="center">&nbsp; <?php echo ' &nbsp;'.$pedido['consulta']; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 2</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">COMPRAS</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 35%; font-size: 9pt;" align="left">DOCUMENTACIÓN (CARTA TRAZABILIDAD, CERTIFICADO LABORATORIO APROBADO)</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 20</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['documentacion']; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 3</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">COMPRAS</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 35%; font-size: 9pt;" align="left">CRÉDITO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 10</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['credito']; ?></td>
  <br>
</tr>

</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 5%; font-size: 10pt;" align="center">&nbsp; No.</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="center">&nbsp; Área</td>
  <td rowspan="1" colspan="2" style="background: #DCDFDF; border: solid .5px; width: 35%; font-size: 10pt;" align="center">&nbsp; Criterios</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="center">&nbsp; Parámetro</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="center">&nbsp; Calif.</td>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 30%; font-size: 10pt;" align="center">&nbsp; Para Consultar dudas con:</td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 1</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">CALIDAD</td>
   <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 9pt;" align="left">IDENTIFICACIÓN</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 9pt;" align="left">CÓDIGO EQUIPO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 10</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['codigo_equipo']; ?></td>
  <td rowspan="6" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['consulta']; ?></td>

  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 2</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">CALIDAD</td>
   <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 9pt;" align="left">IDENTIFICACIÓN</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 9pt;" align="left">FECHA DE PRÓXIMA CALIBRACIÓN</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 20</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['fecha_proxima']; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 3</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">CALIDAD</td>
 <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 9pt;" align="left">IDENTIFICACIÓN</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 9pt;" align="left">NOMBRE DEL TÉCNICO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 10</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['nombre_tecnico']; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 3</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">CALIDAD</td>
 <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 9pt;" align="left">IDENTIFICACIÓN</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 9pt;" align="left">PROTECCIÓN CONTRA DESAJUSTES</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 30</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['proteccion']; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; font-size: 9pt;" align="center">&nbsp; 3</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">CALIDAD</td>
 <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 9pt;" align="left">INFORME DE CALIBRACIÓN</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 9pt;" align="left">ENTREGA DE INFORME DE CALIBRACION CON EQUIPO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center">&nbsp; 1 - 30</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['entrega_informe']; ?></td>
  <br>
</tr>
</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td td class="full-border" rowspan="1" colspan="5" style="border-bottom: .5px; border-left: 0px; border-top: 0px; border-right: 0px;  width: 70%; font-size: 10pt;" align="center"></td>
  <td td class="full-border" rowspan="1" colspan="1" style=" border-left: 0px; border-top: 0px; border-bottom: 0px; width: 5%; font-size: 10pt;" align="center">&nbsp;</td>
  <td td class="full-border" rowspan="1" colspan="2" style="background: #DCDFDF; width: 25%; font-size: 10pt;" align="center">&nbsp; CALIFICACIÓN</td> 
  <br>
</tr>
<tr>
  <td td class="full-border" rowspan="1" colspan="2" style="border-top: 1px; background: #DCDFDF; width: 40%; font-size: 10pt;" align="center">Historial de desempeño</td>
  <td td class="full-border" rowspan="1" colspan="1" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$Datehist1; ?></td>
  <td td class="full-border" rowspan="1" colspan="1" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$Datehist2; ?></td>
  <td td class="full-border" rowspan="1" colspan="1" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$Datehist3; ?></td>
  <td td class="full-border" rowspan="1" colspan="1" style=" border-left: 0px; border-top: 0px; border-bottom: 0px; width: 5%; font-size: 10pt;" align="center">&nbsp;</td>
  <td td class="full-border" rowspan="1" colspan="1" style=" width: 15%; font-size: 9pt;" align="left">Compras</td>
  <td td class="full-border" rowspan="1" colspan="1" style=" width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['calificacion_compras']; ?> </td>
  <br>
</tr>
<tr>
  <td td class="full-border" rowspan="1" colspan="2" style="border-top: 1px; background: #DCDFDF; width: 40%; font-size: 10pt;" align="center">Calificación</td>
  <td td class="full-border" rowspan="1" colspan="1" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$chist_1; ?></td>
  <td td class="full-border" rowspan="1" colspan="1" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$chist_2; ?></td>
  <td td class="full-border" rowspan="1" colspan="1" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$chist_3; ?></td>
  <td td class="full-border" rowspan="1" colspan="1" style=" border-left: 0px; border-top: 0px; border-bottom: 0px; width: 5%; font-size: 10pt;" align="center">&nbsp;</td>
  <td td class="full-border" rowspan="1" colspan="1" style=" width: 15%; font-size: 9pt;" align="left">Calidad</td>
  <td td class="full-border" rowspan="1" colspan="1" style=" width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['calificacion_calidad']; ?> </td>
  <br>
</tr>
<tr>
  <td td class="full-border" rowspan="1" colspan="5" style="border-bottom: .5px; border-left: 0px; border-top: 0px; border-right: 0px; width: 70%; font-size: 9pt;" align="center"></td>
  <td td class="full-border" rowspan="1" colspan="1" style=" border-left: 0px; border-top: 0px; border-bottom: 0px; width: 5%; font-size: 9pt;" align="center">&nbsp;</td>
  <td td class="full-border" rowspan="1" colspan="1" style="width: 15%; font-size: 9pt;" align="left">Total</td> 
  <td td class="full-border" rowspan="1" colspan="1" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.number_format($pedido['calificacion_total'],0); ?> </td>
  <br>
</tr>
<tr>
  <td td class="full-border" rowspan="1" colspan="2" style="border-top: 1px; background: #DCDFDF; width: 40%; font-size: 10pt;" align="center">Estatus:</td>
  <td td class="full-border" rowspan="1" colspan="3" style="width: 30%; font-size: 9pt;" align="center"><?php echo ' &nbsp;'.$pedido['resultado']; ?></td>
  <td td class="full-border" rowspan="1" colspan="1" style=" border-left: 0px; border-top: 0px; border-bottom: 0px; width: 5%; font-size: 10pt;" align="center">&nbsp;</td>
  <td td class="full-border" rowspan="1" colspan="1" style=" width: 15%; font-size: 9pt;" align="left">Mínima aprobatoria</td>
  <td td class="full-border" rowspan="1" colspan="1" style=" width: 10%; font-size: 9pt;" align="center">80 </td>
  <br>
</tr>
</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">&nbsp; Acciones a seguir:</td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 100%; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$pedido['acciones']; ?></td>
  <br>
</tr>
</table>

<br>


<page_footer> 
          
    <br>
  
          <p style="width: 100%; font-size: 9pt;" align="center"> <!-- [[page_cu]]/[[page_nb]]-->Transvive ERP Bussines</p>
            
     
 
    </page_footer> 
    <br>
    
  
    
    

    <!-- pagina 2 -->
   <!--
   <div style="page-break-after:always;"></div>
   -->
 


  
</page>