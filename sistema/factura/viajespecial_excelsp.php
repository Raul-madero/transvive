<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Viajes Especiales.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT id, semana, fecha, cliente, direccion, destino, unidad, unidad_ejecuta, numero_unidades, destino, costo_viaje, hora_inicio, hora_fin, hora_llegadareal, notas, if(estatus = 1,'Activo',if(estatus = 2, 'Realizado', if(estatus= 3,'Cancelado', if(estatus = 4,'Iniciado',if(estatus=5, 'Finalizado', ''))))) as Status, valor_vuelta, sueldo_vuelta FROM registro_viajes where (tipo_viaje = 'Especial' or tipo_viaje = 'Turistico') ORDER by fecha");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE VIAJES ESPECIALES'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>ID</th>  
    <th>Semana</th>
    <th>Mes</th>
    <th>Año</th>
    <th>Fecha de Salida</th>
    <th>Cliente</th>
    <th>Tipo Unidad</th>
    <th>Unidad que Ejecuta</th>
    <th>Hora Salida</th>
    <th>Direccion</th>
    <th>Destino / Ruta</th>
    <th>Hora Regreso</th>
    <th>Hora Real de Llegada</th>
    <th>Observaciones</th>
    <th>Valor Vuelta</th>
    <th>Sueldo Vuelta</th>
    <th>Estatus</th>
  

    </tr>
    </thead>
  <?php
    $tipovuelta = '';
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 
    	if ($row['hora_fin'] != '00:00:00') {
        $tipovuelta = 'Vuelta';
      }else {
        $tipovuelta = '';
      }

      setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row['fecha']));
      $anio = date("Y", $fechames);
      $mes = date("m", $fechames);

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
          <td><?php echo ($row['id']); ?></td>
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo strtoupper($monthNameSpanish); ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo $row['hora_inicio']; ?></td>
          <td><?php echo strtoupper($row['direccion']); ?></td>
          <td><?php echo strtoupper($row['destino']); ?></td>
          <td><?php echo $row['hora_fin']; ?></td>
          <td><?php echo $row['hora_llegadareal']; ?></td>
          <td><?php echo strtoupper($row['notas']); ?></td>
          <td><?php echo number_format($row['valor_vuelta'],2); ?></td>
          <td><?php echo number_format($row['sueldo_vuelta'],2); ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo strtoupper($tipovuelta) ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



