<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Registro de Viajes Todos.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.ruta, rv.direccion, rv.destino, rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.destino,if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) as nombre, rv.operador, rv.valor_vuelta, us.nombre as jefeoperaciones, rv.tipo_viaje as tviaje, em.noempleado, rv.notas FROM registro_viajes rv LEFT JOIN supervisores sp ON rv.id_supervisor =sp.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario LEFT join empleados em ON rv.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) ORDER by rv.id ");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE VIAJES'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>ID</th>
    <th>Semana</th>
    <th>Fecha</th>
    <th>Mes</th>
    <th>Año</th>
    <th>Cliente</th>
    <th>Supervisor</th>
    <th>Tipo de Unidad</th>
    <th>Unidad que Ejecuta</th>
    <th>no. Unidad</th>
    <th>Ruta</th>
    <th>No. Empleado</th>
    <th>Operador</th>
    <th>Estatus</th>
    <th>Valor Vuelta</th>
    <th>Tipo de Viaje</th>
    <th>Jefe de Operaciones</th>
    <th>Observaciones</th>
  

    </tr>
    </thead>
  <?php
    $tipovuelta = '';
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 

      if ($row['tviaje'] == "Especial") {
        $ndestino = $row['destino']; 
        
      }else {
        $ndestino = $row['ruta'];
        
      }

      setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row['fecha']));
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
          <td><?php echo $row['id']; ?></td>
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo strtoupper($monthNameSpanish); ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo $row['num_unidad']; ?></td>
          <td><?php echo $ndestino; ?></td>
          <td><?php echo $row['noempleado']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo $row['valor_vuelta']; ?></td>
          <td><?php echo strtoupper($row['tviaje']); ?></td>
          <td><?php echo $row['jefeoperaciones']; ?></td>
          <td><?php echo strtoupper($row['notas']); ?></td>
        </tr> 
     
      <?php
    }

    ?>

     



