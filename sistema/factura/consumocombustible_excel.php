<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Consumo de Combustible.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT id, folio, fecha, nodesemana, estacion, nounidad, placas, operador, kmactual_cargar, tipo_combustible, litros, precio, importe, supervisor, if(estatus = 1,'Activo','Cancelado') as Status, kmanterior, kmrecorridos, rendimiento, rendimiento_estandar FROM carga_combustible where estatus = 1 ORDER by fecha, id");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE CARGA DE COMBUSTIBLE'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Folio</th>
    <th>Fecha</th>
    <th>Semana</th>
    <th>Mes</th>
    <th>Año</th>
    <th>Estación</th>
    <th>No. Unidad</th>
    <th>Placas</th>
    <th>Operador</th>
    <th>Km. Anterior</th>
    <th>Km. Actual</th>
    <th>Km. Recorridos</th>
    <th>Rendimiento</th>
    <th>Parametro</th>
    <th>Tipo Combustible</th>
    <th>Litros</th>
    <th>Precio</th>
    <th>Importe</th>
    <th>Supervisor</th>
    <th>Estatus</th>
  

    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row['fecha']));
      $newDate = date("d-m-Y", strtotime($row['fecha'])); 
      $mes = date("m", $fechames);
      $anio = date("Y", $fechames);

      switch($mes)
      {   
          case 1:
          $monthNameSpanish = "Enero";
          break;

          case 2:
          $monthNameSpanish = "Febrero";
          break;

          case 3:
          $monthNameSpanish = "Marzo";
          break;

          case 4:
          $monthNameSpanish = "Abril";
          break;

          case 5:
          $monthNameSpanish = "Mayo";
          break;

          case 6:
          $monthNameSpanish = "Junio";
          break;

          case 7:
          $monthNameSpanish = "Julio";
          break;

          case 8:
          $monthNameSpanish = "Agosto";
          break;

          case 9:
          $monthNameSpanish = "Septiembre";
          break;

          case 10:
          $monthNameSpanish = "Octubre";
          break;

          case 11:
          $monthNameSpanish = "Noviembre";
          break;

          case 12:
          $monthNameSpanish = "Diciembre";
          break;

    //...
    }



    	//$importetot = $importetot + $row['importe'];
    	//$litrostot = $litrostot + $row['litros'];
     
      ?>
        <tr>
          <td><?php echo $row['folio']; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['nodesemana']; ?></td>
          <td><?php echo $monthNameSpanish; ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $row['estacion']; ?></td>
          <td><?php echo $row['nounidad']; ?></td>
          <td><?php echo $row['placas']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo number_format($row['kmanterior'],0); ?></td>
          <td><?php echo number_format($row['kmactual_cargar'],0); ?></td>
          <td><?php echo number_format($row['kmrecorridos'],0); ?></td>
          <td><?php echo number_format($row['rendimiento'],1); ?></td>
          <td><?php echo number_format($row['rendimiento_estandar'],2); ?></td>
          <td><?php echo $row['tipo_combustible']; ?></td>
          <td><?php echo number_format($row['litros'],2); ?></td>
          <td><?php echo number_format($row['precio'],2); ?></td>
          <td><?php echo number_format($row['importe'],2); ?></td>
          <td><?php echo $row['supervisor']; ?></td>
          <td><?php echo $row['Status']; ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



