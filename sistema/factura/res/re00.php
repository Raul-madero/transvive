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


    <table style ="float: left;
  width: 50%;
  padding: 5px;">
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Points</th>
      </tr>
      <tr>
        <td>Jill</td>
        <td>Smith</td>
        <td>50</td>
      </tr>
      <tr>
        <td>Eve</td>
        <td>Jackson</td>
        <td>94</td>
      </tr>
      <tr>
        <td>Adam</td>
        <td>Johnson</td>
        <td>67</td>
      </tr>
    </table>

    <table>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Points</th>
      </tr>
      <tr>
        <td>Jill</td>
        <td>Smith</td>
        <td>50</td>
      </tr>
      <tr>
        <td>Eve</td>
        <td>Jackson</td>
        <td>94</td>
      </tr>
      <tr>
        <td>Adam</td>
        <td>Johnson</td>
        <td>67</td>
      </tr>
    </table>

</page>