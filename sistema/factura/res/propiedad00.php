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
    $query = mysqli_query($conection,"SELECT p.id, p.fecha_entrega, p.empresa, p.representa_empresa, p.direccion, p.telefonos, p.correo, p.bien_entregado, p.caracteristicas, p.utilizarse_en, p.identificacion, p.verificacion, p.proteccion, p.salvaguardar, p.nombre1, p.puesto1, p.telefono_correo1, p.nombre2, p.puesto2, p.telefono_correo2, p.empresa_recibe, p.empresa_entrega FROM propeidades p WHERE p.id = $idpropiedad");
$result = mysqli_num_rows($query);
$pedido = mysqli_fetch_assoc($query);

//$mesDesc = strftime("%d de %B de %Y", strtotime($pedido['fecha']));
$Dateinicio = date("d-m-Y", strtotime($pedido['fecha_entrega']));



if ($pedido['fecha_entrega'] > '2000-01-01') {
        $newDateinicio = $Dateinicio;
}else {
        $newDateinicio = '';
}


?>
<page backcolor="#FEFEFE" backimg="../../images/transvive_water2.png" backimgx="center" backimgy="middle" backimgw="60%" style="font-size: 12pt">

    <bookmark title="Lettre" level="0" ></bookmark>
  <table border="0.5" align="center" cellspacing="0" style="width: 100%; text-align: center; ">
    
<tr>
  
  <td rowspan="4" style="width: 25%; color: #444444;" ><img style="width: 60%; height: 5%;" align="center" src="../../images/transvive.png" alt="Logo"></td>
  <br>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Titulo:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 11pt;" align="center">Propiedad del cliente o Proveedor</td>
  <br>
 
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Codigo:</td>
  <td style="vertical-align:middle; width: 15%; font-size: 9pt;" align="center">FO-TV-VT-10</td>
</tr>



<tr>
  <td style="vertical-align:middle; width: 10%; font-size: 9pt; align:left; background: #DCDFDF">&nbsp;Area:</td>
  <td style="vertical-align:middle; width: 40%; font-size: 10pt;" align="center">VENTAS</td>
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
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Empresa Resguarda:</td>
  <br>
  <td style="border: solid .5px; width: 48%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['empresa']; ?></td>
 
  <td style="background: #DCDFDF; border: solid .5px; width: 16%; font-size: 10pt;" align="left"; >&nbsp;Fecha:</td>
  <td style="border: solid .5px; width: 16%; font-size: 10pt;" align="center" ><?php echo ' '.$newDateinicio; ?></td>
</tr>
</p>



</table>

<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 40%; font-size: 10pt;" align="left">&nbsp;Representante de la empresa que recibe el bien:</td>
  <br>
  <td style="border: solid .5px; width: 60%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['representa_empresa']; ?></td>
 
 
</tr>
</p>



</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Dirección:</td>
  <br>
  <td style="border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['direccion']; ?></td>
 
 
</tr>
</p>
</table>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">

 
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Telefonos:</td>
  <br>
  <td style="border: solid .5px; width: 30%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['telefonos']; ?></td>
<br>
<td style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="left">&nbsp;Correo:</td>
  <br>
  <td style="border: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['correo']; ?></td>
 
 
</tr>
</p>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
 <p>   
<tr>
  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Bien de la Empresa entregado:</td>
  <br>
  <td style="border: solid .5px; width: 30%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['bien_entregado']; ?></td>
<br>
<td style="background: #DCDFDF; border: solid .5px; width: 15%; font-size: 10pt;" align="left">&nbsp;Caracteristicas:</td>
  <br>
  <td style="border: solid .5px; width: 35%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['caracteristicas']; ?></td>
</tr>
</p>
 <p>   
<tr>  
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Para utilizarse en:</td>
  <br>
  <td colspan="3" style="border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['utilizarse_en']; ?></td>

</tr>
</p>
<p>   
<tr>  
 <td style="vertical-align:middle; background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Método de Identificación del bien entregado:</td>
  <br>
  <td colspan="3" style="vertical-align:middle; border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['identificacion']; ?></td>

</tr>
</p>
<p>   
<tr>  
 <td style="vertical-align:middle; background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Método de verificación del bien entregado:</td>
  <br>
  <td colspan="3" style="vertical-align:middle; border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['verificacion']; ?></td>
</tr>
</p>
<p>   
<tr>  
 <td style="vertical-align:middle; background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Método de protección del bien entregado:</td>
  <br>
  <td colspan="3" style="vertical-align:middle; border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['proteccion']; ?></td>

</tr>
</p>
<p>   
<tr>  
 <td style="vertical-align:middle; background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Método de Salvaguardar el bien entregado:</td>
  <br>
  <td colspan="3" style="vertical-align:middle; border: solid .5px; width: 80%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['salvaguardar']; ?></td>

</tr>
</p>
</table>
<br>
<table  align="center" cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">   
<tr> 
 <td colspan="4" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center">&nbsp;<b>Acciones de Contingencia</b></td> 
</tr>
 <p>   
<tr> 
 <td colspan="4" style="background: #DCDFDF; border: solid .5px; width: 100%; font-size: 10pt;" align="center"><?php echo '&nbsp; Yo <b>'.$pedido['representa_empresa']. '</b> como representante de <b>'.$pedido['empresa']. '</b> me comprometo que en caso de extravío, deterioro o algún otro modo que se considere inadecuado para uso del bien DEBERE informar a la brevedad posible a:' ; ?></td>
</tr>
</p>

<p>   
<tr> 
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Nombre:</td>
  <br>
  
<br>

  <td colspan="3" style="border: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['nombre1']; ?></td>
</tr>
</p>

 <p>   
<tr> 
 <td style="vertical-align:middle; background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Puesto:</td>
  <br>
  <td style="vertical-align:middle; border: solid .5px; width: 30%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['puesto1']; ?></td>
<br>
<td style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="left">&nbsp;Teléfono y Correo:</td>
  <br>
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['telefono_correo1']; ?></td>
</tr>
</p>

<p>   
<tr> 
 <td style="background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Nombre:</td>
  <br>
  
<br>

  <td colspan="3" style="border: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['nombre2']; ?></td>
</tr>
</p>

 <p>   
<tr> 
 <td style="vertical-align:middle; background: #DCDFDF; border: solid .5px; width: 20%; font-size: 10pt;" align="left">&nbsp;Puesto:</td>
  <br>
  <td style="vertical-align:middle; border: solid .5px; width: 30%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['puesto2']; ?></td>
<br>
<td style="background: #DCDFDF; border: solid .5px; width: 10%; font-size: 10pt;" align="left">&nbsp;Teléfono y Correo:</td>
  <br>
  <td style="vertical-align:middle; border: solid .5px; width: 40%; font-size: 10pt;" align="left"><?php echo '&nbsp;'.$pedido['telefono_correo2']; ?></td>
</tr>
</p>

</table>

<page_footer> 
          
    <br>
   <table cellspacing="0" style="width:100%; font-family: Arial; font-weight: normal; font-size: 10pt; ">
        <thead>
       
        <tr>
            <th style="border: solid .5px; text-align: center; width:50%; font-weight: normal; background: #DCDFDF">&nbsp;Empresa que recibe:</th>
            <th style="border: solid .5px; text-align: center; width:50%; font-weight: normal; background: #DCDFDF">&nbsp;Empresa que entrega:</th>
            
        </tr>     
        </thead>
        <tbody>
             
                <tr>
                <td style="border-left: solid .5px; text-align: center; font-weight: bold;"><?php echo '&nbsp;'; ?></td>
                <td style="border-left: solid .5px; border-right: solid .5px; text-align: center; font-weight: bold;"><?php echo '&nbsp;'; ?></td>
                
              </tr> 
                <tr>
                <td style="border-left: solid .5px; text-align: center; font-weight: bold;"><?php echo '&nbsp;'; ?></td>
                <td style="border-left: solid .5px; border-right: solid .5px; text-align: center; font-weight: bold;"><?php echo '&nbsp;'; ?></td>
                
              </tr> 
              <tr>
                <td style="border-left: solid .5px; text-align: center; font-weight: bold;"><?php echo '&nbsp;'; ?></td>
                <td style="border-left: solid .5px; border-right: solid .5px; text-align: center; font-weight: bold;"><?php echo '&nbsp;'; ?></td>
                
              </tr> 
              <tr>
                <td style="border-left: solid .5px; border-bottom: solid .5px; text-align: center; font-weight: bold;"><?php echo $pedido['empresa_recibe']; ?></td>
                <td style="border-left: solid .5px; border-bottom: solid .5px; border-right: solid .5px; text-align: center; font-weight: bold;"><?php echo $pedido['empresa_entrega']; ?></td>
                
              </tr> 

              <tr>
                <td style="border: solid .5px; text-align: center; background: #DCDFDF">Nombre y firma</td>
                <td style="border: solid .5px; text-align: center; background: #DCDFDF">Nombre y firma</td>
                
              </tr>   
        </tbody>
    </table>
 
    </page_footer> 
    <br>

  
</page>