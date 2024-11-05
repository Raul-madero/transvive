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
    $query = mysqli_query($conection,"SELECT * FROM empleados WHERE noempleado = $noeval");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

if ($pedido['tipo_contrato'] = "Indefinido") {
  $contrato = "PLANTA";
}else {
  $contrato = "EVENTUAL";
}
$fecha = $pedido['fecha_contrato']; // Formato YYYY-MM-DD
$timestamp = strtotime($fecha);

$day = date("d", $timestamp);
$month = date("m", $timestamp);
$year = date("Y", $timestamp);

$fecha_nace = $pedido['date_nacimiento']; // Formato YYYY-MM-DD
$timestamp_nace = strtotime($fecha_nace);

$day_nace   = date("d", $timestamp_nace);
$month_nace = date("m", $timestamp_nace);
$year_nace  = date("Y", $timestamp_nace);

if ($pedido['fecha_fincontrato'] > "01/01/2000") {

$fecha_fin = $pedido['fecha_fincontrato']; // Formato YYYY-MM-DD
$timestamp_fin = strtotime($fecha_nace);

$day_fin   = date("d", $timestamp_fin);
$month_fin = date("m", $timestamp_fin);
$year_fin  = date("Y", $timestamp_fin);
}else {
  $day_fin ="";
  $month_fin = "";
  $year_fin = "";
}

$nombreCompleto = $pedido['nombres'] . " " . $pedido['apellido_paterno'] . " ". $pedido['apellido_materno'];

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
/*$Dateinicio = date("d-m-Y", strtotime($pedido['date_elabora']));
if ($pedido['date_recibe'] > '2020-01-01') {
    $Datehist2  = date("d-m-Y", strtotime($pedido['date_recibe']));
}else {
$Datehist2  = '';
}*/

//$Datefin = date("d-m-Y", strtotime($pedido['fecha_servicio']));


?>
<page backcolor="#FEFEFE" backimg="../../images/transvive_water2.png" backimgx="center" backimgy="middle" backimgw="60%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="border: solid .5px; width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; border: solid .5px; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Titulo:</td>
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 11pt;" align="center">Alta de Empleado</td>
  <br>
 
  <td rowspan="2" style="border: solid .5px; vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td rowspan="2" style="vertical-align:middle; border: solid .5px; width: 15%; font-size: 9pt;" align="center">FO-TV-RH-03</td>
</tr>



<tr>
  <td style="vertical-align:middle; border: solid .5px; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 10pt;" align="center">Recursos Humanos</td>
</tr>



</table>
<br>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left"></td>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
  <td rowspan="1" colspan="1" style="width: 15%; border-bottom: solid .5px; font-size: 10pt;" align="left"></td>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
  <td rowspan="1" colspan="1" style="width: 15%; border-bottom: solid .5px; font-size: 10pt;" align="left"></td>
  <td rowspan="1" colspan="1" style="width: 10%; border-bottom: solid .5px; font-size: 10pt;" align="left"></td>
  <td rowspan="1" colspan="1" style="width: 15%; border-bottom: solid .5px; font-size: 10pt;" align="left"></td>
</tr>
<br>
<tr>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border-bottom: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="8" colspan="1" style="width: 15%; border: solid .5px; font-size: 10pt;" align="left">
    <?php 
    $rutaImagen = "../uploads/" . $pedido['foto'];
    if (!empty($pedido['foto']) && file_exists($rutaImagen)) {
        // Mostrar la imagen si existe y el nombre del archivo no está vacío
        echo '<img src="' . $rutaImagen . '" alt="Foto empleado" style="width: 100%; height: auto;">';
    } else {
        // Opcionalmente, muestra un mensaje o deja la celda vacía si no hay imagen
        echo '<p style="text-align: center;">Sin foto</p>';;
        // También puedes agregar una imagen predeterminada si lo deseas
        // echo '<img src="ruta_a_imagen_default.jpg" alt="Sin imagen" style="width: 100%; height: auto;">';
    }
    ?>
</td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="3" style="width: 40%; border:solid .5px; background-color: #DCDFDF; font-size: 8pt;" align="center">TIPO DE CONTRATACIÓN</td>
</tr> 
<tr>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; font-size: 8pt; background-color: #DCDFDF;" align="center"> NO. DE EMPLEADO</td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; background-color: #DCDFDF; font-size: 8pt;" align="left"> EMPLEADO</td>
<td rowspan="1" colspan="2" style="width: 25%; border: solid .5px; font-size: 8pt;" align="center"><?php echo $pedido['tipo'];?></td>

</tr> 
<tr>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; font-size: 8pt;" align="center"><?php echo $pedido['noempleado'];?> </td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; background-color: #DCDFDF; font-size: 8pt;" align="left"> TIPO DE CONTRATO</td>
<td rowspan="1" colspan="2" style="width: 25%; border: solid .5px; font-size: 8pt;" align="center"><?php echo $contrato;?></td>
</tr> 

<tr>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; font-size: 8pt;" align="center"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border-bottom: solid .5px; font-size: 8pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-bottom: solid .5px; font-size: 8pt;" align="center">&nbsp;</td>
<td rowspan="1" colspan="1" style="width: 15%; border-bottom: solid .5px; font-size: 8pt;" align="center">&nbsp;</td>
</tr>

<tr>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="3" style="width: 40%; border:solid .5px; background-color: #DCDFDF; font-size: 8pt;" align="center">FECHA DE INGRESO</td>
</tr>  

<tr>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; background-color:#DCDFDF; font-size: 8pt;" align="center">DIA</td>
<td rowspan="1" colspan="1" style="width: 10%; border:solid .5px; background-color:#DCDFDF; font-size: 8pt;" align="center">MES</td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; background-color:#DCDFDF; font-size: 8pt;" align="center">AÑO</td>
</tr>

<tr>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; font-size: 8pt;" align="center"><?php echo $day;?></td>
<td rowspan="1" colspan="1" style="width: 10%; border:solid .5px; font-size: 8pt;" align="center"><?php echo $month;?></td>
<td rowspan="1" colspan="1" style="width: 15%; border:solid .5px; font-size: 8pt;" align="center"><?php echo $year;?></td>
</tr>

<tr>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; border-right: solid .5px; font-size: 10pt;" align="left"></td>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;</td>
<td rowspan="1" colspan="1" style="width: 15%; font-size: 8pt;" align="center"></td>
<td rowspan="1" colspan="1" style="width: 10%; font-size: 8pt;" align="center"></td>
<td rowspan="1" colspan="1" style="width: 15%; font-size: 8pt;" align="center"></td>
</tr>

</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 100%; font-size: 8pt; font-weight: bold;" align="center">1. DATOS PERSONALES</td>  
</tr>
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 50%; font-size: 8pt;" align="center">NOMBRE EMPLEADO</td> 
  <td rowspan="1" colspan="3" style="border: solid .5px; background: #DCDFDF; width: 30%; font-size: 8pt;" align="center">FECHA DE NACIMIENTO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 20%; font-size: 8pt;" align="center">CIUDAD</td> 
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="center"><?php echo $nombreCompleto;?></td> 
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; height: 12px; font-size: 8pt;" align="center"><?php echo $day_nace;?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; height: 12px; font-size: 8pt;" align="center"><?php echo $month_nace;?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 10%; height: 12px; font-size: 8pt;" align="center"><?php echo $year_nace;?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['ciudad_nacimiento']);?></td> 
</tr>
</table>

<table>
  <tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 22%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">ESTADO DE NACIMIENTO</td> 
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 13%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">SEXO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 15%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">ESTADO CIVIL</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 35%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">DOMICILIO ACTUAL (CALLE)</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 15%; background-color: #DCDFDF; font-size: 8pt;" align="center">NO.</td> 
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 22%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['estado_nacimiento']);?></td> 
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 13%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['sexo']);?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 15%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['estado_civil']);?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 35%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['calle']);?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 15%; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['no_calle']);?></td> 
</tr>
</table>
<Table>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 22%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">COLONIA</td> 
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 13%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">C. P.</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 15%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">MUNICIPIO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 25%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">ESTADO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 25%; background-color: #DCDFDF; font-size: 8pt;" align="center">TELEFONOS</td> 
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 22%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['colonia']);?></td> 
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 13%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['cod_postal']);?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 15%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['municipio']);?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 25%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['estado']);?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 25%; font-size: 8pt;" align="center"><?php echo $pedido['telefono'];?></td> 
</tr>
<tr>
  <td rowspan="1" colspan="5" style="border: solid .5px; width: 22%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">NIVEL DE ESTUDIOS</td>   
</tr>
<tr>
  <td rowspan="1" colspan="5" style="border: solid .5px; width: 22%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['estudios']);?></td> 
</tr>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 100%; font-size: 8pt; font-weight: bold;" align="center">2. DATOS DE NÓMINA</td>  
</tr>
</table>
<table>
  <tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 30%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">HORARIO DE TRABAJO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 40%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">CURP</td>   
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 30%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">NO. CLINICA</td>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 30%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['horario_work'];?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 40%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['curp'];?></td>   
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 30%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['noclinica'];?></td>
</tr>
</table>
<table>
  <tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">NUMERO DE SEGURIDAD SOCIAL</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">PUESTO</td>   
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['numeross'];?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['cargo'];?></td>   
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">NUMERO PRESTAMO INFONAVIT</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">REGISTRO FEDERAL DE CONTRIBUYENTES</td>   
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['no_infonavit'];?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['rfc'];?></td>   
</tr>
</table>
<br>
<table>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 100%; font-size: 8pt; font-weight: bold;" align="center">3. DATOS DE REINGRESO Y/O EVENTUAL</td>  
</tr>
</table>
<table>
  <tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">SALARIO DIARIO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">SALARIO INTEGRADO</td>   
  <td rowspan="1" colspan="3" style="border: solid .5px; width: 26%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">FECHA DE ULTIMO CONTRATO</td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 34%; background-color: #DCDFDF; height: 12px; font-size: 8pt;" align="center">REFERENCIA INTERNA (SUPERVISOR)</td>
</tr>
<tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; height: 12px; font-size: 8pt;" align="center"><?php echo number_format($pedido['salario_diario'],2);?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; height: 12px; font-size: 8pt;" align="center"><?php echo number_format($pedido['salario_integrado'],2);?></td>   
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 9%; height: 12px; font-size: 8pt;" align="center"><?php echo $day_fin;?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 8%; height: 12px; font-size: 8pt;" align="center"><?php echo $month_fin;?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 9%; height: 12px; font-size: 8pt;" align="center"><?php echo $year_fin;?></td>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 34%; height: 12px; font-size: 8pt;" align="center"><?php echo $pedido['supervisor'];?></td>
</tr>
</table>
<table>
  <tr>
    <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 100%; font-size: 8pt;" align="center">MOTIVO DE RENUNCIA</td>
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 100%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['motivo_baja']);?></td>   
  </tr>
</table>
<table>
  <tr>
    <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 50%; font-size: 8pt;" align="center">DOCUMENTACIÓN RECIBIDA AL INGRESAR</td>
    <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 5%; height: 12px; font-size: 8pt;" align="center"></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;SOLICITUD DE EMPLEO / CV</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_solicitud']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;COPIA INE / PASAPORTE</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_ine']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;COPIA LICENCIA DE CONDUCIR</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_licencia']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;CURP</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_curp']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;COPIA COMPROBANTE DE DOMICILIO RECIENTE</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_domicilio']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;COPIA COMPROBANTE DE ESTUDIOS</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_estudios']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;COPIA ACTA DE NACIMIENTO</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_actanace']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;NÚMERO DE SEGURO SOCIAL</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_nss']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;RFC</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_rfc']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;AVISO DE RETENCIÓN DE INFONAVIT</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_infonavit']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;CARTA DE RECOMENDACIÓN LABORAL</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_recomendacion']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;ANTIDOPAJE</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_antidopaje']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;CARTA DE ANTECEDENTES NO PENALES</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_penales']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
  <tr>  
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="left">&nbsp;EXÁMEN MEDICO</td> 
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 5%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['doc_medico']);?></td>  
    <td rowspan="1" colspan="1" style="width: 45%; height: 12px; font-size: 8pt;" align="center"></td>   
  </tr>
</table>
<br>
<table>
  <tr>
    <td rowspan="1" colspan="3" style="border: solid .5px; background: #DCDFDF; width: 100%; font-size: 8pt;" align="center">CONTACTO DE EMERGENCIA</td>
  </tr>
  <tr>
    <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 50%; font-size: 8pt;" align="center">NOMBRE</td>
    <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 25%; font-size: 8pt;" align="center">TELEFONO</td>
    <td rowspan="1" colspan="1" style="border: solid .5px; background: #DCDFDF; width: 25%; font-size: 8pt;" align="center">PARENTESCO</td>
  </tr>
  <tr>
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 50%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['nombre_emergencia']);?></td>
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 25%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['telefono_emergencia']);?></td>
    <td rowspan="1" colspan="1" style="border: solid .5px; width: 25%; height: 12px; font-size: 8pt;" align="center"><?php echo strtoupper($pedido['parentesco']);?></td>
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