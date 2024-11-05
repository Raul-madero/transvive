<?php
session_start();
$cotizacionno = 1;
setlocale(LC_ALL, 'spanish');
//Consulta sql encabezado
include('../../conexion.php');

?>
<style>
<!--

.sinBorde td {border: 0; border-bottom:1px solid #000}
-->
</style>
 <?php
    $query = mysqli_query($conection,"SELECT p.id, p.fecha, p.empresa, p.contacto, p.area, p.servicio_ventas, p.servicio_transporte, p.servicio_operador, p.servicio_supervisor, p.servicio_operaciones, p.atencion_resolucion, p.comentarios FROM encuesta_clientescalidad p ");
$result = mysqli_num_rows($query);
//$pedido = mysqli_fetch_assoc($query);



//$Dateinicio = date("d-m-Y", strtotime($pedido['fecha_inicio']));
//$Datefin = date("d-m-Y", strtotime($pedido['fecha_fin']));


?>

  <?php 
    while ($entrada = mysqli_fetch_assoc($query)) {
        $mesDesc = strftime("%d de %B de %Y", strtotime($entrada['fecha']));
    switch ($entrada['servicio_ventas']):
    case 1:
        $check1_1 = 4;
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
        break;
    case 2:
        $check1_1 = "";
        $check2_1 = 4;
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
        break;
    case 3:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = 4;
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
        break;
    case 4:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = 4;
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
        break;
    case 5:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = 4;
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
        break;  
    case 6:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = 4;
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
        break;
    case 7:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = 4;
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
        break;
    case 8:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = 4;
        $check9_1 = "";
        $check10_1 = "";
        break; 
    case 9:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = 4;
        $check10_1 = "";
        break; 
    case 10:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = 4;
        break;          
    default:
        $check1_1 = "";
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 ="";
endswitch;    

    switch ($entrada['servicio_transporte']):
    case 1:
        $check1_2 = 4;
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 2:
        $check1_2 = "";
        $check2_2 = 4;
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 3:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = 4;
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 4:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = 4;
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 5:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = 4;
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;  
    case 6:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = 4;
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 7:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = 4;
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 8:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = 4;
        $check9_2 = "";
        $check10_2 = "";
        break; 
    case 9:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = 4;
        $check10_2 = "";
        break; 
    case 10:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = 4;
        break;          
    default:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 ="";
endswitch;  

switch ($entrada['servicio_operador']):
    case 1:
        $check1_3 = 4;
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 2:
        $check1_3 = "";
        $check2_3 = 4;
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 3:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = 4;
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 4:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = 4;
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 5:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = 4;
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;  
    case 6:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = 4;
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 7:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = 4;
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 8:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = 4;
        $check9_3 = "";
        $check10_3 = "";
        break; 
    case 9:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = 4;
        $check10_3 = "";
        break; 
    case 10:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = 4;
        break;          
    default:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 ="";
endswitch;

switch ($entrada['servicio_supervisor']):
    case 1:
        $check1_4 = 4;
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 2:
        $check1_4 = "";
        $check2_4 = 4;
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 3:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = 4;
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 4:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = 4;
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 5:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = 4;
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;  
    case 6:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = 4;
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 7:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = 4;
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 8:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = 4;
        $check9_4 = "";
        $check10_4 = "";
        break; 
    case 9:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = 4;
        $check10_4 = "";
        break; 
    case 10:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = 4;
        break;          
    default:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 ="";
endswitch;

switch ($entrada['servicio_operaciones']):
    case 1:
        $check1_5 = 4;
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 2:
        $check1_5 = "";
        $check2_5 = 4;
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 3:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = 4;
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 4:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = 4;
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 5:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = 4;
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;  
    case 6:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = 4;
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 7:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = 4;
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 8:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = 4;
        $check9_5 = "";
        $check10_5 = "";
        break; 
    case 9:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = 4;
        $check10_5 = "";
        break; 
    case 10:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = 4;
        break;          
    default:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 ="";
endswitch;

switch ($entrada['atencion_resolucion']):
    case 1:
        $check1_6 = 4;
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 2:
        $check1_6 = "";
        $check2_6 = 4;
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 3:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = 4;
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 4:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = 4;
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 5:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = 4;
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;  
    case 6:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = 4;
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 7:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = 4;
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 8:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = 4;
        $check9_6 = "";
        $check10_6 = "";
        break; 
    case 9:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = 4;
        $check10_6 = "";
        break; 
    case 10:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = 4;
        break;          
    default:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 ="";
endswitch;


    ?>
<page backcolor="#FEFEFE" style="font-size: 12pt">

  

    <bookmark title="Encuesta Calidad" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Titulo:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 11pt;" align="center">Encuesta de calidad a clientes</td>
  <br>
 
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td style="vertical-align:middle; width: 15%; font-size: 9pt;" align="center">FO-TV-AC-14</td>
</tr>



<tr>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 10pt;" align="center">Aseguramiento de Calidad</td>
</tr>



</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>

  <td style="width: 3%; font-size: 9pt;" align="left">&nbsp;</td>  
  <td style="border: medium transparent; width: 18%; font-size: 9pt;" align="left"><b>&nbsp;Fecha de Aplicación:</b></td>
  <td style="border: 0; border-bottom:1px solid #000; width: 26%; font-size: 9pt;" align="center" ><?php echo ' '.$mesDesc; ?>&nbsp;</td>
  <td style="width: 4%; font-size: 9pt;" align="left">&nbsp;</td>
  <td style="width: 10%; font-size: 9pt;" align="left"><b>&nbsp;Empresa:</b></td>
  <td style="border: 0; border-bottom:1px solid #000; width: 35%; font-size: 9pt;" align="center" ><?php echo ' '.$entrada['empresa']; ?>&nbsp;</td> 
  <td style="width: 3%; font-size: 9pt;" align="left">&nbsp;</td>
</tr>
</p>
</table>

<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>

  <td style="width: 3%; font-size: 9pt;" align="left">&nbsp;</td>  
  <td style="border: medium transparent; width: 18%; font-size: 9pt;" align="left"><b>&nbsp;Contacto:</b></td>
  <td style="border: 0; border-bottom:1px solid #000; width: 26%; font-size: 9pt;" align="center" ><?php echo ' '.$entrada['contacto']; ?>&nbsp;</td>
  <td style="width: 4%; font-size: 9pt;" align="left">&nbsp;</td>
  <td style="width: 10%; font-size: 9pt;" align="left"><b>&nbsp;Area:</b></td>
  <td style="border: 0; border-bottom:1px solid #000; width: 35%; font-size: 9pt;" align="center" ><?php echo ' '.$entrada['area']; ?>&nbsp;</td> 
  <td style="width: 3%; font-size: 9pt;" align="left">&nbsp;</td>
</tr>
</p>
</table>

<br>
<br>


<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <tr>
  
  <td rowspan="1" style="width: 100%; font-size: 10pt;" align="left"><b>&nbsp;Del 1 al 10, ¿qué tan satisfecho se encuentra con los siguiente?</b></td>
  <br>

</tr>   
</table>
    
     <br>


     <page_footer> 
          
    <br>
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 <tr>
  
  <td>
    [[page_cu]]
  </td>
  <br>
 
  
</tr>   

</table>
 
    </page_footer> 
    <br>
    <table cellspacing="0" style="width: 100%; ">
        <colgroup>
            <col style="width: 38%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 4%; text-align: center">
            <col style="width: 12%; text-align: center">
            
        </colgroup>
        <thead>
         <tr>
            <th style="border: solid 0px black; font-size: 10pt;"></th>
            <th style="border: solid 0px black; font-size: 10pt;">Muy Satisfecho</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">10</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">9</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">8</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">7</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">6</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">5</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">4</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">3</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">2</th>
            <th style="border: solid 0.5px black; font-size: 10pt;">1</th>
            <th style="border: solid 0px black; font-size: 10pt;">Muy Insatisfecho</th>
                
                
            </tr>
        </thead>
        <tbody>

            
            <tr>
                <td style="border: solid 0.5px black; text-align: left; font-size: 10pt; font-family:'Arial'"><b>1)</b> Servicio brindado por parte del área de Ventas (cotización, contratación, post venta)&nbsp;</td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check10_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check9_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check8_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check7_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check6_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check5_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check4_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check3_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check2_1; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check1_1; ?></td>
                <td style="text-align: center; font-size: 10pt;"></td>
            </tr>

            <tr>
                <td style="border: solid 0.5px black; text-align: left; font-size: 10pt; font-family:'Arial'"><b>2)</b> Servicio de transporte (unidades, rutas, limpieza, calidad)&nbsp;</td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check10_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check9_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check8_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check7_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check6_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check5_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check4_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check3_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check2_2; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check1_2; ?></td>
                <td style="text-align: center; font-size: 10pt;"></td> 
            </tr>

            <tr>
                <td style="border: solid 0.5px black; text-align: left; font-size: 10pt; font-family:'Arial'"><b>3)</b> Servicio, atención y calidad de los Operadores&nbsp;</td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check10_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check9_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check8_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check7_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check6_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check5_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check4_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check3_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check2_3; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check1_3; ?></td>
                <td style="text-align: center; font-size: 10pt;"></td> 
            </tr>

            <tr>
                <td style="border: solid 0.5px black; text-align: left; font-size: 10pt; font-family:'Arial'"><b>4)</b> Servicio, atención y calidad del Supervisor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check10_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check9_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check8_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check7_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check6_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check5_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check4_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check3_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check2_4; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check1_4; ?></td>
                <td style="text-align: center; font-size: 10pt;"></td> 
            </tr>

            <tr>
                <td style="border: solid 0.5px black; text-align: left; font-size: 10pt; font-family:'Arial'"><b>5)</b> Servicio, atención y calidad del Jefe de Operaciones&nbsp;</td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check10_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check9_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check8_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check7_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check6_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check5_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check4_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check3_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check2_5; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check1_5; ?></td>
                <td style="text-align: center; font-size: 10pt;"></td> 
            </tr>

            <tr>
                <td style="border: solid 0.5px black; text-align: left; font-size: 10pt; font-family:'Arial'"><b>6)</b> Atención y resolución de quejas &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="text-align: center; font-size: 10pt;"><?php echo ''; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check10_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check9_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check8_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check7_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check6_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check5_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check4_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check3_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check2_6; ?></td>
                <td style="border: solid 0.5px black; text-align: center; font-size: 10pt; font-family:ZapfDingbats"><?php echo $check1_6; ?></td>
                <td style="text-align: center; font-size: 10pt;"></td> 
            </tr>

    
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
    <br>
    <br>
    <p style="font-size: 10pt;">
    Observaciones: <?php echo $entrada['comentarios']; ?></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
  
    
    <br>
    <br>
    <br>
    <br>
    <!--
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
                <td style="text-align: center; font-weight: bold;"><?php echo 'Atentamente' ?></td>
                <td style="text-align: center;"><?php echo '' ?></td>
                <td style="text-align: center; font-weight: bold;"><?php echo 'empresa'; ?></td>
                
              </tr>  
        </tbody>
    </table>
-->
</page>
  <?php
    }
  ?>  