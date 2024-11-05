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
    $query = mysqli_query($conection,"SELECT * FROM requisicion_personal WHERE id = $noeval");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['date_elabora']));
if ($pedido['date_recibe'] > '2020-01-01') {
    $Datehist2  = date("d-m-Y", strtotime($pedido['date_recibe']));
}else {
$Datehist2  = '';
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
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 11pt;" align="center">Requisición de Personal</td>
  <br>
 
  <td rowspan="2" style="border: solid .5px; vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td rowspan="2" style="vertical-align:middle; border: solid .5px; width: 15%; font-size: 9pt;" align="center">FO-TV-RH-02</td>
</tr>



<tr>
  <td style="vertical-align:middle; border: solid .5px; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 10pt;" align="center">Recursos Humanos</td>
</tr>



</table>
<br>
<br>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Fecha de elaboración:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$Dateinicio; ?></td>
  <td rowspan="1" colspan="1" style="width: 25%; font-size: 10pt;" align="left">Fecha de recepción por Rec. Humanos</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$Datehist2; ?></td>
  <br>
</tr>
<br>
<p>
<tr>
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
  <br>
</tr>
</p>
<p>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Puesto:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['puesto'];?></td>
  <td rowspan="1" colspan="1" style="width: 25%; font-size: 10pt;" align="left">No. de Vacantes</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['no_vacantes'];?></td>
  <br>
</tr>
</p>

<p>
<tr>
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
  <br>
</tr>
</p>
<p>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Zona:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['zona'];?></td>
  <td rowspan="1" colspan="1" style="width: 25%; font-size: 10pt;" align="left">Supervisor asignado</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left">&nbsp; <?php echo $pedido['supervisor'];?></td>
  <br>
</tr>
</p>

</table>

<br>
<br>
<?php
if ($pedido['motivo']== 'NUEVA CREACIÓN') {
    $check_motivo = 4;
}else {  
    $check_motivo = "o";
}
if ($pedido['motivo']== 'AMPLIACIÓN DE PLANTILLA') {
    $check_motivo2 = 4;
}else {  
    $check_motivo2 = "o";
}
if ($pedido['motivo']== 'EVENTUAL') {
    $check_motivo3 = 4;
}else {  
    $check_motivo3 = "o";
}
if ($pedido['motivo']== 'EN SUSTITUCIÓN DE') {
    $check_motivo4 = 4;
    $data_motivo = $pedido['dato_motivo'];
}else {  
    $check_motivo4 = "o";
    $data_motivo = $pedido['dato_motivo'];
}
if ($pedido['motivo']== 'OTROS') {
    $check_motivo5 = 4;
    $data_motivo2 = $pedido['dato_motivo'];
}else {  
    $check_motivo5 = "o";
    $data_motivo2 = "";
}
?>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="width: 100%; font-size: 10pt;" align="left">Motivo de la vacante:</td>
</tr>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="width: 5%; font-family: ZapfDingbats; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$check_motivo; ?></td>
  <td rowspan="1" colspan="2" style="width: 95%; height: 20px; font-size: 10pt;" align="left">&nbsp; Nueva Creación</td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="width: 5%; font-family: ZapfDingbats; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$check_motivo2; ?></td>
  <td rowspan="1" colspan="2" style="width: 95%; height: 20px; font-size: 10pt;" align="left">&nbsp; Ampliación de Plantilla</td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="width: 5%; font-family: ZapfDingbats; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$check_motivo3; ?></td>
  <td rowspan="1" colspan="2" style="width: 95%; height: 20px; font-size: 10pt;" align="left">&nbsp; Eventual</td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="width: 5%; font-family: ZapfDingbats; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$check_motivo4; ?></td>
  <td rowspan="1" colspan="1" style="width: 20%; height: 20px; font-size: 10pt;" align="left">&nbsp; En sustitución de:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 75%; height: 20px; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$data_motivo; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="width: 5%; font-family: ZapfDingbats; font-size: 10pt;" align="left"><?php echo ' &nbsp;'.$check_motivo5; ?></td>
  <td rowspan="1" colspan="1" style="width: 20%; height: 20px; font-size: 10pt;" align="left">&nbsp; Otros:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 75%; height: 20px; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$data_motivo2; ?></td>
  <br>
</tr>
</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; width: 100%; font-size: 10pt;" align="center">DATOS GENERALES DEL PUESTO SOLICITADO</td>
  
  <br>
</tr>
</table>
<br>
<br>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Horario:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['horario']; ?></td>
  <td rowspan="1" colspan="1" style="width: 25%; font-size: 10pt;" align="left">Sueldo de contratación</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['sueldo_contrato']; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="4" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Sueldo de Planta:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['sueldo_planta']; ?></td>
  <td rowspan="1" colspan="1" style="width: 25%; font-size: 10pt;" align="left">Edad</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['edad']; ?></td>
  <br>
</tr>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">Escolaridad:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['escolaridad']; ?></td>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">Experiencia:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['experiencia']; ?></td>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Estado Civil:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp; <?php echo ' &nbsp;'.$pedido['edo_civil']; ?></td>
  
  <br>
</tr>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Conocimientos:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 85%; font-size: 10pt;" align="left">&nbsp; <?php echo $pedido['conocimientos']; ?></td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="2" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
  <br>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">Se cubrió con:</td>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 85%; font-size: 10pt;" align="left">&nbsp; <?php echo $pedido['se_cubrio']; ?></td>
  <br>
</tr>
</table>



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