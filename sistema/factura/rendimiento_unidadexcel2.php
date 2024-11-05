<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Rendimiento por Unidad.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');

    $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

    


$query_productos = mysqli_query($conection,"SELECT fecha, nounidad, placas, kmactual_cargar, tipo_combustible, litros, precio, operador, supervisor  FROM carga_combustible WHERE nounidad = '$idoentrada' order by  fecha");
$result_detalle = mysqli_num_rows($query_productos);
$entrada = mysqli_fetch_assoc($query_productos);


$kmetraje  = $entrada['kmactual_cargar'];
$litrosant = $entrada['litros'];
$totimporte = $kmetraje;  
$litrosantes  = $litrosant;
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE RENDIMIENTO POR UNIDAD '. $idoentrada ; ?>
<table>
  <thead>
    <tr>
      <th>Kilometraje Inicial: <?php echo $kmetraje; ?> </th>
    </tr>
  </thead>
</table>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Fecha</th>
    <th>Operador</th>
    <th>Placas</th>
    <th>Km. Al cargar</th>
    <th>Combustible</th>
    <th>Litros</th>
    <th>Precio</th>
    <th>Km. Recorridos</th>
    <th>Rendimiento</th>
    <th>Supervisor</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
      $newDate = date("d-m-Y", strtotime($row['fecha'])); 
      $kmrecorre  = $row['kmactual_cargar'] - $totimporte;
      $litrostot  = $kmrecorre / $litrosantes

      ?>
        <tr>
          <td><?php echo $newDate ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo $row['placas']; ?></td>
          <td><?php echo $row['kmactual_cargar']; ?></td>
          <td><?php echo $row['tipo_combustible']; ?></td>
          <td><?php echo number_format($row['litros'],2); ?></td>
          <td><?php echo number_format($row['precio'],2); ?></td>
          <td><?php echo number_format($kmrecorre,0) ?></td>
          <td><?php echo number_format($litrostot,2); ?></td>
          <td><?php echo $row['supervisor']; ?></td>
          
        </tr> 
     
      <?php
      $kmrecorre = 0;
      $litrostot = 0;
      $totimporte  = $row['kmactual_cargar']; 
      $litrosantes = $row['litros'];
    }

    ?>



