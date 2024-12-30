<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Viajes Epeciales por Periodo.xls");
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
  $query_productos = mysqli_query($conection,"SELECT id, semana, fecha, cliente, direccion, destino, costo_viaje, hora_inicio, hora_fin, hora_llegadareal, notas, unidad, unidad_ejecuta, num_unidad, numero_unidades, if(estatus = 1,'Activo',if(estatus = 2, 'Realizado', if(estatus= 3,'Cancelado', if(estatus = 4,'Iniciado',if(estatus=5, 'Finalizado', ''))))) as Status, valor_vuelta, sueldo_vuelta FROM registro_viajes WHERE tipo_viaje like '%Especial%' and semana = '$nosemana' and YEAR(fecha) = $fecha_ejercicio OR semana = 'Semana 01' AND MONTH(fecha) = 12 AND YEAR(fecha) = ($fecha_ejercicio - 1) ORDER by fecha, id");
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
          $ffin = $fecha_ejercicio . '2023-12-31';
          break;
        }
    $titulo = "REPORTE DE VIAJES POR MES DE: $monthNameSpanish" ;    

  $query_productos = mysqli_query($conection,"SELECT id, semana, fecha, cliente, direccion, destino, costo_viaje, hora_inicio, hora_fin, hora_llegadareal, notas, unidad, unidad_ejecuta, num_unidad, numero_unidades, if(estatus = 1,'Activo',if(estatus = 2, 'Realizado', if(estatus= 3,'Cancelado', if(estatus = 4,'Iniciado',if(estatus=5, 'Finalizado', ''))))) as Status, valor_vuelta, sueldo_vuelta FROM registro_viajes WHERE tipo_viaje like '%Especial%' and fecha BETWEEN '$fini' and '$ffin' ORDER by fecha, id");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection); 
}


  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
REPORTE DE VIAJES ESPECIALES POR PERIODO
<br>
<?php echo $titulo ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Semana</th>
    <th>Mes</th>
    <th>ID</th>
    <th>Año</th>
    <th>Fecha de Salida</th>
    <th>Cliente</th>
    <th>Tipo Unidad</th>
    <th>Unidad Ejecuta</th>
    <th>No. de Unidad</th>
    <th>Hora Salida</th>
    <th>Direccion</th>
    <th>Destino / Ruta</th>
    <th>Hora Regreso</th>
    <th>Hora Real de Llegada</th>
    <th>Observaciones</th>
    <th>Costo viaje</th>
    <th>Valor Vuelta</th>
    <th>Sueldo Vuelta</th>
    <th>Estatus</th>

    </tr>
    </thead>
  <?php
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
      ?>
        <tr>
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo strtoupper($monthNameSpanish); ?></td>
          <td><?php echo ($row['id']); ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo strtoupper($row['num_unidad']); ?></td>
          <td><?php echo $row['hora_inicio']; ?></td>
          <td><?php echo strtoupper($row['direccion']); ?></td>
          <td><?php echo strtoupper($row['destino']); ?></td>
          <td><?php echo $row['hora_fin']; ?></td>
          <td><?php echo $row['hora_llegadareal']; ?></td>
          <td><?php echo strtoupper($row['notas']); ?></td>
          <td><?php echo number_format($row['costo_viaje'],2); ?></td>
          <td><?php echo number_format($row['valor_vuelta'],2); ?></td>
          <td><?php echo number_format($row['sueldo_vuelta'],2); ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo strtoupper($tipovuelta) ?></td>
        </tr> 
     
      <?php
    }

    ?>



