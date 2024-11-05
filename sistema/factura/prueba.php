<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 10);
//Consulta sql encabezado




include('../../conexion.php');
$link=conection();

$sql_maxGrupos = "SELECT * from tabla GROUP BY  campo_grupo ";
    
    $result_maxGrupos = mysql_query($sql_maxGrupos);
    $maximo_grupos = mysql_num_rows($result_maxGrupos);

$_pagi_sql="SELECT * from tabla order by grupo";
$_pagi_cuantos=10;
include("paginator.inc.php");
$SqlSumSubTotal=mysql_query($_pagi_sql,$link); 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<title>Reporte</title>
<link href="Styles/OCEF/Style.css" type="text/css" rel="stylesheet">
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td valign="top">
      <table class="Header" cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td class="HeaderLeft"></td> 
          <th>Listado de Verificación de Ordenes</th>
 
          <td class="HeaderRight"></td>
        </tr>
      </table>
 
      <table class="Grid" cellspacing="0" cellpadding="0">
        <tr class="Row">
          <td colspan="4"><strong>Fecha: </strong><strong><?php echo strftime ("%d/%m/%Y"); ?></td>
        </tr>
        <tr class="Caption">
          <th>Id</th> 
          <th>Nombre</th>
          <th>Grupo</th>
          <th>Monto</th>
           </tr>      
        <?php 

?>
        <?php

         while($row=mysql_fetch_assoc($_pagi_result)) {
         $grupoant=$grupo;        
$grupo=$row['grupo'];
$tot+=$row["monto"];
 ?>

<?php
if($grupoant != $grupo){

?>         
<tr class="Row">
<td colspan="4"><strong>Grupo: <?php echo $row["grupo"]; ?></strong></td>
</tr>        
<?php 

}        
?>
<tr class="Row">
          <td>
            <p align="center"><?php echo $row["cod"]; ?></p></td> 
          <td>
            <p align="center"><?php echo $row["nombre"]; ?></p></td> 
          <td>
            <p align="center"><?php echo $row["grupo"]; ?></p></td> 
          <td>
            <p align="center"><?php echo $row["monto"]; ?></p></td> 
        </tr>

        <?
        //echo $nro_factura_ante;
        //$c=0;
        $c=$c+1;
        //while ($c >= 3 ) {
            if ($c == $maximo_grupos) {    
            ?>
       <tr class="SubTotal">      
          <td>&nbsp;</td> 
          <td>&nbsp;</td>   
          <td><strong>Subtotal:</strong></td> 
          <td style="TEXT-ALIGN: right" valign="baseline"><?php 
         // echo number_format($sub,2); ?></td> 
          
        </tr>
        <?
                $c=0;            
        //}    
            }        
        ?>
              
        
        <? 
                } }
         ?>

       <tr class="Total">
          <td colspan="4" align="right">TOTAL GENERAL: <?php  
 echo number_format($tot,2); ?></td> 
        </tr>
        <tr class="Footer">
          <td style="TEXT-ALIGN: right" colspan="4"><?php printf("<p>Página ".$_pagi_navegacion."</p>"); ?></td>
        </tr>
 </table>
       <p style="PAGE-BREAK-AFTER: always"></p>
 
      <table class="Grid" cellspacing="0" cellpadding="0">
       </table>
    </td>
  </tr>
</table>
</body>
</html>