<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Consumo de Combustible Fechas.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');

    $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 10);
//Consulta sql encabezado

$date = new DateTime($fecha_ini);
$iniDate = $date->format('d/m/Y');

$date2 = new DateTime($fecha_fin);
$finDate = $date2->format('d/m/Y');

$Datei = $date->format('Y-m-d');
$Datef = $date2->format('Y-m-d');

    


$query_productos = mysqli_query($conection,"SELECT id, folio, fecha, nodesemana, estacion, nounidad, placas, operador, kmactual_cargar, tipo_combustible, litros, precio, importe, supervisor, kmanterior, kmrecorridos, rendimiento, rendimiento_estandar FROM carga_combustible WHERE fecha BETWEEN '$Datef' and '$Datei' and estatus = 1 ORDER by fecha, id");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      $litrostot = 0;
      $importetot = 0;
  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE CONSUMO POR RANGO DE FECHAS'. ' DE: '. $finDate. ' AL: '. $iniDate ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Folio</th>
    <th>Fecha</th>
    <th>Semana</th>
    <th>No. Unidad</th>
    <th>Placas</th>
    <th>Combustible</th>
    <th>Operador</th>
    <th>Km. Anterior</th>
    <th>Km. Actual</th>
    <th>Km. Recorridos</th>
    <th>Rendimiento</th>
    <th>Parametro</th>
    <th>Litros</th>
    <th>Precio</th>
    <th>Importe</th>
    <th>Estacion</th>
    <th>Supervisor</th>
    

    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 
    	$importetot = $importetot + $row['importe'];
    	$litrostot = $litrostot + $row['litros'];
      ?>
        <tr>
          <td><?php echo $row['folio']; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['nodesemana']; ?></td>
          <td><?php echo $row['nounidad']; ?></td>
          <td><?php echo $row['placas']; ?></td>
          <td><?php echo $row['tipo_combustible']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo number_format($row['kmanterior'],0); ?></td>
          <td><?php echo number_format($row['kmactual_cargar'],0); ?></td>
           <td><?php echo number_format($row['kmrecorridos'],0); ?></td>
          <td><?php echo number_format($row['rendimiento'],1); ?></td>
          <td><?php echo number_format($row['rendimiento_estandar'],2); ?></td>
          <td><?php echo $row['litros']; ?></td>
          <td><?php echo number_format($row['precio'],2); ?></td>
          <td><?php echo number_format($row['importe'],2); ?></td>
          <td><?php echo $row['estacion']; ?></td>
          <td><?php echo $row['supervisor']; ?></td>
           
        
        </tr> 
     
      <?php
    }

    ?>

     <tr>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo number_format($litrostot,2); ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo number_format($importetot,2); ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
        
        </tr> 



