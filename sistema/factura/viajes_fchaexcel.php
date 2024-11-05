<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Viajes por Fechas.xls");
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

    


$query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.direccion, rv.destino, rv.costo_viaje, rv.hora_inicio, rv.hora_fin, rv.hora_llegadareal, rv.hora_finreal, rv.notas, rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.numero_unidades, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.valor_vuelta, rv.sueldo_vuelta, rv.ruta, rv.operador, if (rv.planeado = 1, 'Planeado', 'Registrado') as Tipoviaje, rv.tipo_viaje, us.nombre AS jefeo, CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) as superv, em.noempleado, rv.personas FROM registro_viajes rv LEFT JOIN clientes ct ON rv.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON rv.id_supervisor = sp.idacceso LEFT JOIN empleados em ON rv.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) WHERE rv.tipo_viaje != 'Especial' and rv.fecha BETWEEN '$Datef' and '$Datei' ORDER by rv.fecha, rv.id");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection); 
  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE VIAJES POR RANGO DE FECHAS'. ' DE: '. $finDate. ' AL: '. $iniDate ; ?>
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
      $total_vuelta = $row['valor_vuelta'] * $row['sueldo_vuelta'];
      if ($row['valor_vuelta'] == 0.5) {
        $valorNs = 0.5;
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
      ?>
        <tr>
          <td><?php echo strtoupper($monthNameSpanish); ?></td>
          <td><?php echo ($row['id']); ?></td>
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo strtoupper($row['cliente']); ?></td>
          <td><?php echo strtoupper($row['jefeo']); ?></td>
          <td><?php echo strtoupper($row['superv']); ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo strtoupper($row['num_unidad']); ?></td>
          <td><?php echo strtoupper($row['personas']); ?></td>
          <td><?php echo strtoupper($row['Tipoviaje']); ?></td>
          <td><?php echo strtoupper($row['ruta']); ?></td>
          <td><?php echo $row['noempleado']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo $row['hora_inicio']; ?></td>
          <td><?php echo $row['hora_fin']; ?></td>
          <td><?php echo $row['hora_llegadareal']; ?></td>
          <td><?php echo number_format($row['valor_vuelta'],2); ?></td>
          <td><?php echo number_format($row['sueldo_vuelta'],2); ?></td>
          <td><?php echo number_format($total_vuelta,2); ?></td>
          <td><?php echo strtoupper($row['tipo_viaje']); ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo strtoupper($row['notas']); ?></td>
          <td><?php echo strtoupper($valorNs); ?></td>

          
        </tr> 
     
      <?php
    }

    ?>



