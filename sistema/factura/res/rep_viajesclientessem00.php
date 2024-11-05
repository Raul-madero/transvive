<?php
session_start();
$semana = $_REQUEST['id'];
setlocale(LC_ALL, 'spanish');
//Consulta sql encabezado
include('../../conexion.php');
//include('../../conexion.php');
?>

 <?php
    $query = mysqli_query($conection,"SELECT semana FROM registro_viajes WHERE semana = '$semana'");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);


?>

<page backtop="15mm" backbottom="7mm" backleft="10mm" backright="10mm" footer="date;time;page">
<page_header>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>
    <bookmark title="Lettre" level="0" ></bookmark>
   <table border="0" align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
    
<tr>

  <td rowspan="2" style="width: 31%; height: auto; color: #444444;" ><img style="width: 100%; height: auto;"  align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  
  <td colspan="4" style="width: 35%; font-size: 9pt;" align="center">&nbsp;Reporte de Viajes por Cliente
</td>
  <td align="center" style="width: 8%; font-size: 9pt; vertical-align: middle; "></td>
  <td style="width: 12%; font-size: 9pt; vertical-align: middle;" align="center" ></td>
</tr>


<tr>
  
  <td colspan="4" style="width: 20%; font-size: 9pt;" align="center">&nbsp;<?php echo ' '.$pedido['semana']; ?></td>
  
</tr>
<!--
<tr>
  <td style="width: 12%; font-size: 9pt;" align="left">&nbsp;Pagina:</td>
  <td style="width: 16%; font-size: 9pt;" align="center">&nbsp;&nbsp;&nbsp;&nbsp;[[page_cu]]/[[page_nb]]</td>
</tr>-->


</table>
</page_header>
<br>
<page_footer> 
<br>
<p align="center">
 <span style="font-family:Arial; font-style: italic; align:center;width:200px;text-align:center;">

</span>
</p>
</page_footer>

<?php
$query2 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = '$semana' and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'A' and 'M' group by rv.cliente, rv.ruta order by rv.cliente");
$result2 = mysqli_num_rows($query2);
$pedido01 = mysqli_fetch_assoc($query2);


?>

<?php
$query3 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = '$semana' and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'N' and 'Z' group by rv.cliente, rv.ruta order by rv.cliente");
$result3 = mysqli_num_rows($query3);
$pedido02 = mysqli_fetch_assoc($query3);


?>
<br>

<table align="center" cellspacing="0" style="width: 98%; text-align: center; font-size: 12px">
 <tr>
    <td rowspan="1" colspan="2" style="width: 100%; font-size: 9pt;" align="left">&nbsp;</td>

 </tr>   
    
<tr>
  
  <td style="width: 50%; font-size: 9pt;" align="left">
      <table border="0.5" cellspacing="0" style="width: 100%; text-align: center; font-size: 12px">
        <tr>
        <td style="width: 30%">Item A</td>
        <td style="width: 30%">ITEM B</td>
        <td style="width: 20%">Item C</td>
        <td style="width: 20%">Item D</td>
        </tr>
      </table>  
  </td>


  
  <td style="width: 50%; font-size: 9pt;" align="left">
      <table border="0.5" cellspacing="0" style="width: 100%; text-align: center; font-size: 12px">
        <tr>
        <td style="width: 30%">Item A</td>
        <td style="width: 30%">ITEM B</td>
        <td style="width: 20%">Item C</td>
        <td style="width: 20%">Item D</td>
        </tr>
        <tr>
        <td>Item A</td>
        <td>ITEM B</td>
        <td>Item C</td>
        <td>Item D</td>
        </tr>
      </table> 
  </td>
</tr>



</table>


<div id="tabla">
<table width="450" border="2" cellspacing="0" cellpadding="0">
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>dsfds</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>dfdsf</td>
<td>&nbsp;</td>
</tr>
</table>
</div>


 <!--   
<tr>
  
  <td rowspan="1" colspan="2" style="width: 25%; font-size: 9pt;" align="left">&nbsp;</td>
  <br>
 
  <td border="0.5" style="background: #E8E9E9; width: 12%; font-size: 10pt;" align="left"><b>&nbsp;N° Folio:</b></td>
  <td border="0.5" style="width: 15%; font-size: 10pt;" align="right" ><b style="font-size: 10pt; color: #DA1136"><?php echo ' '.$pedido['folio']; ?>&nbsp;</b></td>
</tr>


<tr>
<td border="0.5" style="background: #E8E9E9; width: 14%; height: 15px; font-size: 9pt;" align="left">&nbsp;Objetivo:</td>
  <td border="0.5"  style="width: 61%; height: 15px; font-size: 9pt;" align="left">&nbsp;<?php echo ' '.$pedido['objetivo']; ?></td>
  <td border="0.5" colspan="1"  style="background: #E8E9E9; width: 12%; height: 15px; font-size: 9pt;" align="left">&nbsp;Fecha:</td>
  <td border="0.5" style="width: 15%; font-size: 9pt;" align="center">&nbsp;<?php echo ' '.$newDate3; ?></td>
</tr>
</table>
<br>

<table  align="center" cellspacing="0" style="width: 98%; text-align: center; font-size: 12px">
    
<tr>  
  <td border="0.5" style="background: #E8E9E9; width: 22%; font-size: 9pt;" align="left">&nbsp;Hora de Inicio:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['hora_inicio']; ?></td>
  <td border="0.5" style="background: #E8E9E9; width: 24%; font-size: 9pt;" align="left">&nbsp;Hora Fin:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['hora_fin']; ?></td>
  <td border="0.5" style="background: #E8E9E9; width: 26%; font-size: 9pt;" align="left">&nbsp;Duracion:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['Horas']; ?></td>
</tr>

<tr>  
  <td border="0.5" style="background: #E8E9E9; width: 22%; font-size: 9pt;" align="left">&nbsp;No. de Compromisos:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['no_compromisos']; ?></td>
  <td border="0.5" style="background: #E8E9E9; width: 24%; font-size: 9pt;" align="left">&nbsp;Compromisos Cumplidos:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['cumplidos']; ?></td>
  <td border="0.5" style="background: #E8E9E9; width: 26%; font-size: 9pt;" align="left">&nbsp;Compromisos No Cumplidos:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['no_cumplidos']; ?></td>
</tr>

<tr>  
  <td border="0.5" style="background: #E8E9E9; width: 22%; font-size: 9pt;" align="left">&nbsp;No Terminados y &nbsp;Posfechados:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['no_terminados']; ?></td>
  <td border="0.5" style="background: #E8E9E9; width: 24%; font-size: 9pt;" align="left">&nbsp;% de Cumplimiento:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['porc_cumplimiento'].'%'; ?></td>
  <td border="0.5" style="background: #E8E9E9; width: 26%; font-size: 9pt;" align="left">&nbsp;% de Retraso:</td>
  <td border="0.5" style="width: 10%; font-size: 9pt;" align="center"><?php echo ' '.$pedido['porc_retrazo'].'%'; ?></td>
</tr>



</table>

<br>
<table cellspacing="0" border=".5" style="width: 100%; border: solid 1px black; background: #fff;">
        <colgroup>
            <col style="width: 5%; text-align: left;">
            <col style="width: 85%; text-align: left;">
            <col style="width: 10%; text-align: left;">
  
        </colgroup>
        
        <tbody>

           <tr>
<td border="0.5"  style="background: #E8E9E9; width: 5%; height: 15px; font-size: 9pt;" align="center">&nbsp;No.</td>
<td border="0.5"  style="background: #E8E9E9; width: 85%; height: 15px; font-size: 9pt;" align="center">&nbsp;Participante</td>
<td border="0.5" style="background: #E8E9E9; width: 10%; height: 15px; font-size: 9pt;" align="center">&nbsp;Asistió</td>
  <br>
</tr>




<tr>  
  <td border="0.5"  style="width: 5%; font-size: 9pt;" align="right">&nbsp;<?php echo ' '.$fila; ?></td>  
  <td border="0.5" style="width: 85%; font-size: 9pt;" align="left">&nbsp;<?php echo ' '.$row['participante']; ?></td>  
  <td border="0.5"  style="width: 10%; font-size: 9pt;" align="center">&nbsp;<?php echo ' '.$row['asistencia']; ?></td>  
</tr>


</tbody>
</table> 

<br>
<table cellspacing="0" border=".5" style="width: 100%; border: solid 1px black; background: #fff;">
        <colgroup>
            <col style="width: 5%; text-align: left;">
            <col style="width: 55%; text-align: left;">
            <col style="width: 25%; text-align: left;">
            <col style="width: 15%; text-align: left;">
        </colgroup>
        
        <tbody>

           <tr>
<td border="0.5"  style="background: #E8E9E9; width: 5%; height: 15px; font-size: 9pt;" align="center">&nbsp;No.</td>
<td border="0.5"  style="background: #E8E9E9; width: 55%; height: 15px; font-size: 9pt;" align="center">&nbsp;Temas a Tratar</td>
<td border="0.5" style="background: #E8E9E9; width: 25%; height: 15px; font-size: 9pt;" align="center">&nbsp;Responsable de Exponer</td>
<td border="0.5" style="background: #E8E9E9; width: 15%; height: 15px; font-size: 9pt;" align="center">&nbsp;Duración</td>
  <br>
</tr>
-->


<!--
<br>



    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <br>
    <table cellspacing="0" style="width:100px; font-family: Arial; font-weight: normal; font-size: 9pt; ">
        <thead>
       
        <tr>
            <th style="text-align: center; width:300px; font-weight: normal;">&nbsp;</th>
            <th style="text-align: center; width:150px; font-weight: normal;">&nbsp;</th>
            <th style="text-align: center; width:200px; font-weight: normal;">&nbsp;</th>
            
        </tr>     
        </thead>
        <tbody>
             <tr>
                <td style="text-align: center;"><?php echo 'Elabora' ?></td>
                <td style="text-align: center;"><?php echo '&nbsp;' ?></td>
                <td style="text-align: center;"><?php echo 'Revisa' ?></td>
                
              </tr>  
              <tr>
                <td style="text-align: center;"><?php echo '' ?></td>
                <td style="text-align: center;"><?php echo '&nbsp;' ?></td>
                <td style="text-align: center;"><?php echo ''; ?></td>
                
              </tr>  
        </tbody>
    </table>
 -->  
     
    
  
</page>