<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Catalogo de Unidades.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT id, no_unidad, socio, descripcion, placas, no_serie, year, tipo_combustible, no_poliza, aseguradora, inicio_poliza, fin_poliza, tarjeta_circulacion, vence_tcirculacion, fecha_entregadoc, rendimiendo_estandar, notas, if(estatus = 1,'Activo','Inactivo') as Status FROM unidades");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE CATALOGO DE UNIDADES'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>ID</th>
    <th>No. Unidad</th>
    <th>Socio</th>
    <th>Descripcion</th>
    <th>Placas</th>
    <th>No. Serie</th>
    <th>Modelo</th>
    <th>Tipo Combustible</th>
    <th>No. Poliza</th>
    <th>Aseguradora</th>
    <th>Inicia Poliza</th>
    <th>Termina Poliza</th>
    <th>Tarjeta Circulacion</th>
    <th>Vence Tarjeta Circulacion</th>
    <th>Fecha Entrega Doc.</th>
    <th>Rendimiento Estandar</th>
    <th>Observaciones</th>
    <th>Estatus</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
   
    if ($row['inicio_poliza'] > '2000-01-01') {
      $newDate  = date("d-m-Y", strtotime($row['inicio_poliza']));
    }else {
      $newDate  = '';
    }

    if ($row['fin_poliza'] > '2000-01-01') {
      $newDate2  = date("d-m-Y", strtotime($row['fin_poliza']));
    }else {
      $newDate2  = '';
    }

     if ($row['vence_tcirculacion'] > '2000-01-01') {
      $newDate3  = date("d-m-Y", strtotime($row['vence_tcirculacion']));
    }else {
      $newDate3  = '';
    }

     if ($row['fecha_entregadoc'] > '2000-01-01') {
      $newDate4  = date("d-m-Y", strtotime($row['fecha_entregadoc']));
    }else {
      $newDate4  = '';
    }
 
      
      
      ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['no_unidad'];?></td>
          <td><?php echo $row['socio']; ?></td>
          <td><?php echo $row['descripcion']; ?></td>
          <td><?php echo $row['placas']; ?></td>
          <td><?php echo $row['no_serie']; ?></td>
          <td><?php echo $row['year']; ?></td>
          <td><?php echo $row['tipo_combustible']; ?></td>
          <td><?php echo $row['no_poliza']; ?></td>
          <td><?php echo $row['aseguradora']; ?></td>
          <td><?php echo $newDate ?></td>
          <td><?php echo $newDate2 ?></td>
          <td><?php echo $row['tarjeta_circulacion']; ?></td>
          <td><?php echo $newDate3 ?></td>
          <td><?php echo $newDate4 ?></td>
          <td><?php echo $row['rendimiendo_estandar']; ?></td>
          <td><?php echo $row['notas']; ?></td>
          <td><?php echo $row['Status']; ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



