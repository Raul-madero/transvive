<?php
session_start();
$nooservicio = $_REQUEST['id'];
setlocale(LC_ALL, 'spanish');
//Consulta sql encabezado
include('../../conexion.php');

?>
<style type="text/css">
<!--

-->

  H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }
</style>

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
    $query = mysqli_query($conection,"SELECT * FROM solicitud_credito WHERE id = $nooservicio");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['fecha_recepcion']));
//$Datefin = date("d-m-Y", strtotime($pedido['fecha_servicio']));


if ($pedido['fecha_recepcion'] > '2000-01-01') {
        $newDateinicio = $Dateinicio;
}else {
        $newDateinicio = '';
}

if ($pedido['cedulafiscal'] == 'SI' ) {
    $cedulafiscal = "X";
}else {
    $cedulafiscal = "&nbsp;";
}

if ($pedido['poder_notarial'] == 'SI' ) {
    $poder_notarial = "X";
}else {
    $poder_notarial = "&nbsp;";
}

if ($pedido['domicilio_fiscal'] == 'SI' ) {
    $domicilio_fiscal = "X";
}else {
    $domicilio_fiscal = "&nbsp;";
}

if ($pedido['cedula_moral'] == 'SI' ) {
    $cedulamoral = "X";
}else {
    $cedulamoral = "&nbsp;";
}

if ($pedido['autorizacion_firmada'] == 'SI' ) {
    $autorizacion_fisica = "X";
}else {
    $autorizacion_fisica = "&nbsp;";
}

if ($pedido['identificacion_moral'] == 'SI' ) {
    $identificacion_moral = "X";
}else {
    $identificacion_moral = "&nbsp;";
}

if ($pedido['identificacion_fisica'] == 'SI' ) {
    $identificacion_fisica = "X";
}else {
    $identificacion_fisica = "&nbsp;";
}

if ($pedido['domiciliofiscal_moral'] == 'SI' ) {
    $domicilio_moral = "X";
}else {
    $domicilio_moral= "&nbsp;";
}

if ($pedido['autorizacion_moral'] == 'SI' ) {
    $autorizacion_moral = "X";
}else {
    $autorizacion_moral= "&nbsp;";
}


?>
<page backcolor="#FEFEFE" backimg="../../images/transvive_water2.png" backimgx="center" backimgy="middle" backimgw="60%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Titulo:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 11pt;" align="center">Solicitud de Crédito</td>
  <br>
 
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td style="vertical-align:middle; width: 15%; font-size: 9pt;" align="center">FO-TV-VT-04</td>
</tr>



<tr>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 10pt;" align="center">VENTAS</td>
</tr>



</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="6" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">DATOS GENERALES</td>
  <br>
</tr>
  
<p>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Cliente</td>
  <br>
  <td rowspan="1" colspan="3" style="border-bottom: solid .5px; width: 50%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['cliente']; ?></td>
  <br>
  
  <td rowspan="1" colspan="1" style="width: 18%; font-size: 10pt;" align="left">&nbsp;Fecha de Recepción</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 17%; font-size: 10pt;" align="center"><?php echo ' '.$newDateinicio; ?></td>
</tr>
</p>

<p>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Monto Solicitado</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 15%; font-size: 10pt;" align="center"><?php echo ' '.number_format($pedido['monto_solicitado'],2); ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Plazo Solicitado</td>
  <br>
    <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['plazo']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 18%; font-size: 10pt;" align="left">&nbsp;Regimen Fiscal</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 17%; font-size: 10pt;" align="center">&nbsp;<?php echo ' '.$pedido['regimen']; ?></td>
</tr>
</p>

</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="6" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">DATOS DE LA EMPRESA</td>
  <br>
</tr>
  
<p>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Razón Social</td>
  <br>
  <td rowspan="1" colspan="5" style="border-bottom: solid .5px; width: 85%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['razon_social']; ?></td>  
</tr>
</p>

<p>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Domicilio Fiscal</td>
  <br>
  <td rowspan="1" colspan="5" style="border-bottom: solid .5px; width: 85%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['calle_fiscal']; ?></td>  
</tr>
</p>
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
    <p>
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Entre las Calles</td>
  <br>
  <td rowspan="1" colspan="3" style="border-bottom: solid .5px; width: 50%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['entrecalles']; ?></td>
  <br>
 
 
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Teléfono</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['telefono']; ?></td>
</tr>
</p>

</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
    <tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Colonia</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 15%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['colonia']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Ciudad</td>
  <br>
    <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['ciudad']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Municipio</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['municipio']; ?></td>
</tr>

 <tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Sector</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 15%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['sector']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Estado</td>
  <br>
    <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['estado']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;C. P.</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['cpfiscal']; ?></td>
</tr>

<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Fax</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 15%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['fax']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;E-mail</td>
  <br>
    <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 8pt;" align="left"><?php echo ' '.$pedido['correo']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Giro</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['giro']; ?></td>
</tr>
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="width: 20%; font-size: 10pt;" align="left">&nbsp;Antiguedad en el Ramo</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['antiguedad']; ?></td>

 </tr>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="4" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">DATOS PERSONALES DEL REPRESENTANTE LEGAL</td>
</tr>
<br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Nombre</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['nombre_rep']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;R. F. C.</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['rfc_rep']; ?></td>
 </tr>

 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Domicilio</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['calle_rep']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Entre las Calles</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['entrecalles_rep']; ?></td>
 </tr>
 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Colonia</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['colonia_rep']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Ciudad</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['ciudad_rep']; ?></td>
 </tr>
 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Estado</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['estado_rep']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Nacionalidad</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['nacionalidad_rep']; ?></td>
 </tr>
 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;E-mail</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['correo_rep']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Teléfonos</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['telefono_rep']; ?></td>
 </tr>

</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="5" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">REFERENCIAS BANCARIAS</td>
</tr>
<br>

    <tr>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="center">&nbsp;Banco</td>
  <br>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="center">&nbsp;Sucursal</td>
  <br>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 18%; font-size: 10pt;" align="center">&nbsp;No. de Cuenta</td>
  <br>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="center">&nbsp;Teléfonos</td>
  <br>
  <td rowspan="1" colspan="1" style="background: #DCDFDF; border: solid .5px; width: 22%; font-size: 10pt;" align="center">&nbsp;Nombre del Ejecutivo</td>
 </tr>

 <tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['banco1']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['sucursal1']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 18%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['nocuenta1']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['telefonobanco1']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 22%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['ejecutivo1']; ?></td>
 </tr>

 <tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['banco2']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['sucursal2']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 18%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['nocuenta2']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['telefonobanco2']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 22%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['ejecutivo2']; ?></td>
 </tr>

 <tr>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['banco3']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['sucursal3']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 18%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['nocuenta3']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 20%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['telefonobanco3']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="border: solid .5px; width: 22%; font-size: 10pt;" align="center"><?php echo ' '.$pedido['ejecutivo3']; ?></td>
 </tr>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="4" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">REFERENCIAS COMERCIALES</td>
</tr>
<br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Proveedor</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['proveedor1']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Proveedor</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['proveedor2']; ?></td>
 </tr>

 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Teléfonos</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['telefono_prov1']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Teléfonos</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['telefono_prov2']; ?></td>
 </tr>
 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Contacto</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['contacto_prov1']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Contacto</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['contacto_prov2']; ?></td>
 </tr>
 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Proveedor</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['proveedor3']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Proveedor</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['proveedor4']; ?></td>
 </tr>
 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Teléfonos</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['telefono_prov3']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Teléfonos</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['telefono_prov4']; ?></td>
 </tr>
 <br>
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Contacto</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['contacto_prov3']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Contacto</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['contacto_prov4']; ?></td>
 </tr>

</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" colspan="6" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">DATOS DE AVAL</td>
  <br>
</tr>
  
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
    <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Nombre</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['nombre_aval']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;R. F. C.</td>
  <br>
    <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 20%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['rfc_aval']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;C. P.</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['cpaval']; ?></td>
</tr>

 <tr>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Sector</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['sector_aval']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Ciudad</td>
  <br>
    <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 20%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['ciudad_aval']; ?></td>
  <br>
  <td rowspan="1" colspan="1" style="width: 10%; font-size: 10pt;" align="left">&nbsp;Estado</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 25%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['estado_aval']; ?></td>
</tr>

 
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
<tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Domicilio</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['calle_aval']; ?></td>
 <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Nacionalidad</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 30%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['nacionalidad_aval']; ?></td>
 </tr>
 <tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Colonia</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['colonia_aval']; ?></td>
 <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Estado Civil</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 30%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['edocivil_aval']; ?></td>
 </tr>
 <tr>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Entre las Calles</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['entrecalles_aval']; ?></td>
 <br>
  <td rowspan="1" colspan="1" style="width: 15%; font-size: 10pt;" align="left">&nbsp;Teléfonos</td>
  <br>
  <td rowspan="1" colspan="1" style="border-bottom: solid .5px; width: 30%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['telefono_aval']; ?></td>
 </tr>
</table>
<br>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

<tr>
  <td rowspan="1" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">OBSERVACIONES</td>
  <br>
</tr>
<tr>
  <td rowspan="1" style="border: solid .5px; width: 100%; height: 120px; font-size: 10pt;" align="left"><?php echo ' '.$pedido['observaciones']; ?></td>
  <br>
</tr>
  
</table>
<br>


<page_footer> 
          
    <br>
   <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
  
       
        <tr>
          <td style="width: 100%; font-size: 9pt;" align="center"> [[page_cu]]/[[page_nb]]</td>
            
        </tr>     
       
    </table>
 
    </page_footer> 
    <br>
    
  
    
    

    <!-- pagina 2 -->
   <div style="page-break-after:always;"></div>
 
 
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" style="width: 100%; height: 30px; font-size: 10pt;" align="center"></td>
     </tr>
     <br>
    </table>
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" style="width: 100%; height: 40px; font-size: 10pt;" align="center">DOCUMENTACIÓN</td>
     </tr>
     <br>
    </table>
    <br>
    <br>
    <br>
    <br>

    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <th rowspan="1" colspan="1" style="width: 50%; height: 30px; font-size: 10pt;" align="left">ADJUNTAR DOCUMENTOS PARA PERSONA FISICA</th>
       <br>
       <th rowspan="1" colspan="1" style="width: 50%; height: 30px; font-size: 10pt;" align="left">ADJUNTAR DOCUMENTOS PARA PERSONA MORAL</th>
     </tr>
     </table>
     <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Copia de la cédula de contribuyentes de la SHCP</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$cedulafiscal. ' )'; ?></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Copia del poder notarial del Representante Legal</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$poder_notarial. ' )'; ?></td>
     </tr>

     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Copia de comprobante de domicilio fiscal</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$domicilio_fiscal. ' )'; ?></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Copia de la cédula de contribuyentes de la SHCP</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$cedulamoral. ' )'; ?></td>
     </tr>

     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Autorización firmada para solicitar reporte de crédito (Buró de crédito)</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$autorizacion_fisica. ' )'; ?></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Copia de la identificación del Representante Legal</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$identificacion_moral. ' )'; ?></td>
     </tr>

     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Copia de identificación del dueño</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$identificacion_fisica. ' )'; ?></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Copia de comprobante de domicilio fiscal</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$domicilio_moral. ' )'; ?></td>
     </tr>

     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 10pt;" align="center"></td>
       <br>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"></td>
       <br>
       <td rowspan="1" colspan="1" style="width: 40%; height: 30px; font-size: 10pt;" align="left">Autorización firmada para solicitar reporte de crédito (buró de crédito)</td>
       <br>
       <td rowspan="1" colspan="1" style="width: 10%; height: 30px; font-size: 12pt;" align="left"><?php echo ' ( '.$autorizacion_moral. ' )'; ?></td>
     </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" style="width: 100%; height: 40px; font-size: 10pt;" align="left">Bajo protesta de conducirme con verdad, certifico que los datos asentados en la presente solicitud son reales por lo que autorizo a la Empresa Investigadora verificar a su entera satisfacción.                                        
</td>
     </tr>
     <br>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" style="width: 100%; font-size: 10pt;" align="center">_______________________________</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" style="width: 100%; height: 40px; font-size: 10pt;" align="center">Firma del Cliente</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" style="width: 100%; height: 40px; font-size: 10pt;" align="center"></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" style="width: 100%; height: 40px; font-size: 10pt;" align="center"></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" style="width: 100%; height: 40px; font-size: 10pt;" align="left">Guadalajara Jalisco a ______ de ______________________ del 20____</td>
     </tr>
    </table>

<!-- pagina 3 -->
   <div style="page-break-after:always;"></div>
 
 
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" style="width: 100%; height: 30px; font-size: 10pt;" align="center"></td>
     </tr>
     <br>
    </table>
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" style="width: 100%; height: 40px; font-size: 10pt;" align="center"><b>Obtención de Información de las Referencias.</b></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" style="width: 100%; font-size: 10pt;" align="left"><?php echo ' Por medio de la presente solicito a Usted Referencias Comerciales de su cliente: '.'<span style="font-weight: bold; text-decoration: underline;">'.$pedido['cliente_referencia'].'</span>'; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" style="width: 100%; font-size: 10pt;" align="left">Quien ha manifestado que tiene trato comercial con ustedes, y esta interesado en adquirir nuestros servicios con nosotros a crédito.</td>
     </tr>
     <br>
    </table>    
    <br>
    <br>
    <br>
    <table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">1.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">¿Desde cuando es su cliente?:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['tiempo_clienteref']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">2.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Días de Crédito:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['diascredito_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">3.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Monto de su Crédito:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['monto_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">4.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Forma de Pago:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['formapago_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">5.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Por Medio del Cuál Banco:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['banco_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">6.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">¿Ha tenido Cheques Devueltos por falta de fondos?:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['cheques_sinfondos']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">7.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">¿Ha tenido Cheques Devueltos por cualquier otra situación Financiera?:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['chdevueltos_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">8.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Monto de Compras Mensuales:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['montomensual_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">9.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">¿Que Productos o Servicios le proporciona?:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['productos_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">10.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">¿En este momento tiene algún saldo pendiente con ustedes?:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['saldopendiente_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">11.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">¿Por qué Cantidad?:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['cantidad_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">12.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Días de Atraso en Pagos:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['diasatraso_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">13.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Domicilio del Cliente:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['domicilio_referencia']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">14.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">En términos Generales ¿Cómo considera a su cliente?:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['considera_ref']; ?></td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="3" style="width: 100%; font-size: 10pt;" align="left">&nbsp;</td>
     </tr>
     <br>
     <tr>
       <td rowspan="1" colspan="1" style="width: 4%; font-size: 10pt;" align="left">15.- </td>
       <br>
       <td rowspan="1" colspan="1" style="width: 36%; font-size: 10pt;" align="left">Nombre y Puesto  de quien Proporciona los Datos:</td>
       <br>
       <td rowspan="1" colspan="1" style="border-bottom: solid .5; width: 60%; font-size: 10pt;" align="left"><?php echo ' '.$pedido['nombre_proporciona']; ?></td>
     </tr>
  
   
    </table>  
  
</page>