<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Rendimiento por Unidad.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');

   // $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

    


$query_productos = mysqli_query($conection,"SELECT fecha, nodesemana, nounidad, placas, kmactual_cargar, tipo_combustible, litros, precio, operador, supervisor, kmanterior, kmrecorridos, rendimiento, rendimiento_estandar  FROM carga_combustible order by nounidad, fecha");
$result_detalle = mysqli_num_rows($query_productos);
$entrada = mysqli_fetch_assoc($query_productos);
$articulo = mysqli_query($conection,"SELECT nounidad from carga_combustible group by nounidad order by nounidad ");
$result_articulo = mysqli_num_rows($articulo);

$kmetraje  = $entrada['kmactual_cargar'];
$litrosant = $entrada['litros'];
$articuloant = $entrada['nounidad'];
$totimporte = $kmetraje;  
$litrosantes  = $litrosant;
?>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE RENDIMIENTO POR UNIDAD ' ; ?>
<!--
<table>
  <thead>
    <tr>
      <th>Kilometraje Inicial: <?php echo $kmetraje; ?> </th>
    </tr>
  </thead>
</table>
-->

<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Fecha</th>
    <th>Semana</th>
    <th>Operador</th>
    <th>Placas</th>
    <th>Km. Anterior</th>
    <th>Km. Al cargar</th>
    <th>Km. Recorridos</th>
    <th>Combustible</th>
    <th>Litros</th>
    <th>Precio</th>
    <th>Rendimiento</th>
    <th>Parametro</th>
    <th>Supervisor</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    $grupoant=$articulo;
    $articulo=$row['nounidad'];
      if($grupoant != $articulo){

?> 
        
<tr class="Row">
<td colspan="11"><strong>Unidad: <?php echo $row["nounidad"]; ?></strong></td>
</tr>        
<?php 

}        
?>
<?php
      $newDate = date("d-m-Y", strtotime($row['fecha'])); 
      $kmrecorre  = $row['kmactual_cargar'] - $totimporte;
      $litrostot  = $kmrecorre / $litrosantes;

      ?>
        <tr>
          <td><?php echo $newDate ?></td>
          <td><?php echo $row['nodesemana']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo $row['placas']; ?></td>
          <td><?php echo number_format($row['kmanterior'],0); ?></td>
          <td><?php echo number_format($row['kmactual_cargar'],0); ?></td>
          <td><?php echo number_format($row['kmrecorridos'],0); ?></td>
          <td><?php echo $row['tipo_combustible']; ?></td>
          <td><?php echo number_format($row['litros'],2); ?></td>
          <td><?php echo number_format($row['precio'],2); ?></td>
          <td><?php echo number_format($row['rendimiento'],2); ?></td>
          <td><?php echo number_format($row['rendimiento_estandar'],2); ?></td>
          <td><?php echo $row['supervisor']; ?></td>
          
        </tr> 
     
      <?php
      $kmrecorre = 0;
      $litrostot = 0;
      $totimporte  = $row['kmactual_cargar']; 
      $litrosantes = $row['litros'];
      $articuloant = $row['nounidad'];
    }

    ?>



