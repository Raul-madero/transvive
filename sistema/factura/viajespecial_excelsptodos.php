<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Viajes Especiales_.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.direccion, rv.destino, rv.unidad, rv.unidad_ejecuta, rv.numero_unidades, rv.destino, rv.costo_viaje, rv.hora_inicio, rv.hora_fin, rv.hora_llegadareal, rv.notas, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.valor_vuelta, rv.sueldo_vuelta, us.nombre, rv.tipo_viaje as tviaje, rv.yearreg, rv.turno, rv.ruta FROM registro_viajes rv inner join clientes ct on rv.cliente = ct.nombre_corto inner join usuario us ON ct.id_supervisor = us.idusuario  ORDER by rv.fecha");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE VIAJES ESPECIALES (TODOS)'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Semana</th>
    <th>ID</th>
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
    <th>Hora de Llegada Real</th>
    <th>Observaciones</th>
    <th>Valor Vuelta</th>
    <th>Sueldo Vuelta</th>
    <th>Tipo Viaje</th>
    <th>Turno</th>
    <th>Jefe Operaciones</th>
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

      if ($row['tviaje'] == "Especial") {
        $ndestino = $row['destino']; 
        
      }else {
        $ndestino = $row['ruta'];
        
      }

      setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row['fecha']));
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
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo ($row['id']); ?></td>
          <td><?php echo strtoupper($monthNameSpanish); ?></td>
          <td><?php echo $row['yearreg']; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo $row['hora_inicio']; ?></td>
          <td><?php echo strtoupper($row['direccion']); ?></td>
          <td><?php echo strtoupper($ndestino); ?></td>
          <td><?php echo $row['hora_fin']; ?></td>
          <td><?php echo $row['hora_llegadareal']; ?></td>
          <td><?php echo strtoupper($row['notas']); ?></td>
          <td><?php echo number_format($row['valor_vuelta'],2); ?></td>
          <td><?php echo number_format($row['sueldo_vuelta'],2); ?></td>
          <td><?php echo strtoupper($row['tviaje']); ?></td>
          <td><?php echo strtoupper($row['turno']); ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo strtoupper($tipovuelta) ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



