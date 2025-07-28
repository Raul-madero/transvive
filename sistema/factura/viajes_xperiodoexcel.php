<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Viajes por Periodo.xls");
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
$finfin = strrpos($idoentrada, "id3"); 
$final3 = $finfin + 4;
$fecha_ejercicio = substr($idoentrada, $final3, 10);
//Consulta sql encabezado


if ($fecha_ini != '') {
  $nosemana = $fecha_ini;
  $query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.direccion, rv.destino, rv.costo_viaje, rv.hora_inicio, rv.hora_fin, rv.hora_llegadareal, rv.hora_finreal, rv.notas, rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.numero_unidades, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.valor_vuelta, rv.sueldo_vuelta, rv.ruta, rv.operador, if (rv.planeado = 1, 'Planeado', 'Registrado') as Tipoviaje, rv.tipo_viaje, us.nombre AS jefeo, CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) as superv, em.noempleado, rv.personas, rv.personas_fin, ru.sueldo_camion AS sueldo_ruta_camion, ru.sueldo_camioneta AS sueldo_ruta_camioneta, ru.sueldo_sprinter AS sueldo_ruta_sprinter, em.sueldo_camion, em.sueldo_camioneta, em.sueldo_sprinter  FROM registro_viajes rv LEFT JOIN clientes ct ON rv.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON rv.id_supervisor = sp.idacceso LEFT JOIN empleados em ON rv.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) LEFT JOIN rutas ru ON rv.cliente = ru.cliente AND rv.ruta = ru.ruta WHERE rv.semana = '$nosemana' and YEAR(rv.fecha) = $fecha_ejercicio ORDER by rv.fecha, rv.id");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection);

$titulo = "REPORTE DE VIAJES DE: $nosemana "; 
}else {
  $mes = $fecha_fin;
  setlocale(LC_ALL, 'es_MX');

      switch($mes)
      {   
          case 1:
          $monthNameSpanish = "Enero";
          $fini = $fecha_ejercicio . '-01-01';
          $ffin = $fecha_ejercicio . '-01-31';
          break;

          case 2:
          $monthNameSpanish = "Febrero";
          $fini = $fecha_ejercicio . '-02-01';
          $ffin = $fecha_ejercicio . '-02-29';
          break;
          
          case 3:
          $monthNameSpanish = "Marzo";
          $fini = $fecha_ejercicio . '-03-01';
          $ffin = $fecha_ejercicio . '-03-31';
          break;

          case 4:
          $monthNameSpanish = "Abril";
          $fini = $fecha_ejercicio . '-04-01';
          $ffin = $fecha_ejercicio . '-04-30';
          break;
          

          case 5:
          $monthNameSpanish = "Mayo";
          $fini = $fecha_ejercicio . '-05-01';
          $ffin = $fecha_ejercicio . '-05-31';
          break;

          case 6:
          $monthNameSpanish = "Junio";
          $fini = $fecha_ejercicio . '-06-01';
          $ffin = $fecha_ejercicio . '-06-30';
          break;

          case 7:
          $monthNameSpanish = "Julio";
          $fini = $fecha_ejercicio . '-07-01';
          $ffin = $fecha_ejercicio . '-07-31';
          break;

          case 8:
          $monthNameSpanish = "Agosto";
          $fini = $fecha_ejercicio . '-08-01';
          $ffin = $fecha_ejercicio . '-08-31';
          break;

          case 9:
          $monthNameSpanish = "Septiembre";
          $fini = $fecha_ejercicio . '-09-01';
          $ffin = $fecha_ejercicio . '-09-30';
          break;

          case 10:
          $fini = $fecha_ejercicio . '-10-01';
          $ffin = $fecha_ejercicio . '-10-31';
          $monthNameSpanish = "Octubre";
          break;

          case 11:
          $monthNameSpanish = "Noviembre";
          $fini = $fecha_ejercicio . '-11-01';
          $ffin = $fecha_ejercicio . '-11-30';
          break;

          case 12:
          $monthNameSpanish = "Diciembre";
          $fini = $fecha_ejercicio . '-12-01';
          $ffin = $fecha_ejercicio . '-12-31';
          break;
        }
    $titulo = "REPORTE DE VIAJES POR MES DE: $monthNameSpanish" ;    

  $query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.direccion, rv.destino, rv.costo_viaje, rv.hora_inicio, rv.hora_fin, rv.hora_llegadareal, rv.hora_finreal, rv.notas, rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.numero_unidades, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.valor_vuelta, rv.sueldo_vuelta, rv.ruta, rv.operador, if (rv.planeado = 1, 'Planeado', 'Registrado') as Tipoviaje, rv.tipo_viaje, us.nombre AS jefeo, CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) as superv, em.noempleado, rv.personas, rv.personas_fin, ru.sueldo_camion AS sueldo_ruta_camion, ru.sueldo_camioneta AS sueldo_ruta_camioneta, ru.sueldo_sprinter AS sueldo_ruta_sprinter, ru.sueldo_semid AS sueldo_semi, em.sueldo_camion, em.sueldo_camioneta, em.sueldo_sprinter  FROM registro_viajes rv LEFT JOIN clientes ct ON rv.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON rv.id_supervisor = sp.idacceso LEFT JOIN empleados em ON rv.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) LEFT JOIN rutas ru ON rv.cliente = ru.cliente AND rv.ruta = ru.ruta WHERE rv.fecha BETWEEN '$fini' and '$ffin' ORDER by rv.fecha, rv.id");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection); 
}


  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo $titulo ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Mes</th>
    <th>ID</th>  
    <th>Semana</th>  
    <th>Año</th>
    <th>Fecha de Salida</th>
    <th>Cliente</th>
    <th>Jefe Operaciones</th>
    <th>Supervisor</th>
    <th>Tipo Unidad</th>
    <th>Unidad Ejecuta</th>
    <th>No. de Unidad</th>
    <th>No. de Personas</th>
    <th>No. de Personas Salida</th>
    <th>Tipo Vuelta</th>
    <th>Ruta</th>
    <th>No. Empleado</th>
    <th>Operador</th>
    <th>Hora Salida</th>
    <th>Hora Llegada</th>
    <th>Hora Llegada Real</th>
    <th>Valor Vuelta</th>
    <th>Sueldo Vuelta</th>
    <th>Total Vuelta</th>
    <th>Tipo de Viaje</th>
    <th>Estatus</th>
    <th>Observaciones</th>
    <th>Valor NS</th>

    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 
      if ($row['valor_vuelta'] == 0) {
        $valorNs = 0;
      }else {
        if ($row['valor_vuelta'] == 0.5) {
          if ($row['hora_llegadareal'] <= $row['hora_fin']) {
            $valorNs = 0.5;
          }else {
            $valorNs = 0;
          }
        }else {
          if ($row['hora_llegadareal'] == "00:00:00") {
            $valorNs = 0;
          }else {
            if ($row['hora_llegadareal'] <= $row['hora_fin']) {
              $valorNs = 1;
            }else {
              $valorNs = 0;
            }
          }
        }
      }
      
      setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row['fecha']));
      $anio = date("Y", $fechames);
      $mes = date("m", $fechames);
      
      $sueldo_vuelta = null;
  
  if ($row['tipo_viaje'] === 'Semidomiciliadas') {
    if (!empty($row['sueldo_semi']) && $row['sueldo_semi'] != 0) {
      $sueldo_vuelta = max($row['sueldo_semi'], $row['valor_vuelta']);
    }
  } else {
    $unidad = $row['unidad_ejecuta'];
    
    switch ($unidad) {
      case 'Camion':
        $sueldo_base = $row['sueldo_camion'] ?? 0;
        $sueldo_ruta = $row['sueldo_ruta_camion'] ?? 0;
        break;

      case 'Sprinter':
        $sueldo_base = $row['sueldo_sprinter'] ?? 0;
        $sueldo_ruta = $row['sueldo_ruta_sprinter'] ?? 0;
        break;

      case 'Camioneta':
      case 'Unidad Externa':
      case 'JAC':
      case 'Automovil':
        $sueldo_base = $row['sueldo_camioneta'] ?? 0;
        $sueldo_ruta = $row['sueldo_ruta_camioneta'] ?? 0;
        break;

      default:
        $sueldo_base = 0;
        $sueldo_ruta = 0;
    }

    $sueldo_vuelta = (!empty($sueldo_ruta) && $sueldo_ruta != 0)
      ? max($sueldo_base, $sueldo_ruta)
      : $sueldo_base;
  }


$total_vuelta = $row['valor_vuelta'] * $sueldo_vuelta;
              
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
      ?>
        <tr>
          <td><?php echo strtoupper($monthNameSpanish); ?></td>
          <td><?php echo strtoupper($row['id']); ?></td>
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo strtoupper($row['jefeo']); ?></td>
          <td><?php echo strtoupper($row['superv']); ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo strtoupper($row['num_unidad']); ?></td>
          <td><?php echo strtoupper($row['personas']); ?></td>
          <td><?php echo strtoupper($row['personas_fin']); ?></td>
          <td><?php echo strtoupper($row['Tipoviaje']); ?></td>
          <td><?php echo strtoupper($row['ruta']); ?></td>
          <td><?php echo $row['noempleado']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo $row['hora_inicio']; ?></td>
          <td><?php echo $row['hora_fin']; ?></td>
          <td><?php echo $row['hora_llegadareal']; ?></td>
          <td><?php echo number_format($row['valor_vuelta'],2); ?></td>
          <td><?php echo number_format($sueldo_vuelta,2); ?></td>
          <td><?php echo number_format($total_vuelta,2); ?></td>
          <td><?php echo strtoupper($row['tipo_viaje']); ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo strtoupper($row['notas']); ?></td>
          <td><?php echo strtoupper($valorNs); ?></td>
        </tr> 
     
      <?php
    }

    ?>



