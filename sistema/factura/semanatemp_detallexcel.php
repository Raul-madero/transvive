<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= Detalle Viajes Semanal.xls");
header("Pragma: no-cache");
header("Expires: 0");
   
include('../../conexion.php');
$conection->set_charset('utf8');
 
$semana=$_REQUEST['id'];


$query_productos = mysqli_query($conection,"SELECT dn.id, dn.fecha, dn.fecha_inicio, dn.fechafinal, dn.semana, dn.cliente, dn.ruta, dn.operador, dn.unidad, dn.unidad_ejecuta, dn.tipo_viaje, dn.num_unidad, dn.valor_vuelta, dn.sueldo_vuelta, dn.id_supervisor, us.nombre as Supev, if(dn.estatus = 1,'Activo',if(dn.estatus = 2, 'Realizado', if(dn.estatus=3 ,'Cancelado',if(dn.estatus=4,'Iniciado',if(dn.estatus=5,'Terminado',''))))) as Status, em.cargo, if(em.estatus = 1, 'ALTA', 'BAJA') as altabaja, dn.destino FROM registro_viajes dn LEFT JOIN usuario us ON dn.id_supervisor = us.idusuario LEFT JOIN empleados em ON dn.operador = CONCAT (em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) where dn.semana = '$semana' and dn.estatus = 2 ORDER by dn.operador");
$result_detalle = mysqli_num_rows($query_productos);
  mysqli_close($conection); 

      $sumavuelta = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DETALLADO DE VIAJES SEMANAL '. $semana. ' Temporal' ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>ID</th>
    <th>Fecha</th>
    <th>Semana</th>
    <th>Cliente</th>
    <th>Ruta</th>
    <th>Operador</th>
    <th>Puesto</th>
    <th>Estatus Empleado</th>
    <th>Tipo Viaje</th>
    <th>Unidad</th>
    <th>Unidad Ejecuta</th>
    <th>Valor Vuelta</th>
    <th>Sueldo Vuelta</th>
    <th>Total Vuelta</th>
    <th>Supervisor</th>
    <th>Status</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 
    	$importetot = $row['valor_vuelta'] * $row['sueldo_vuelta'];
    	$sumavuelta = $sumavuelta + $row['valor_vuelta'];
      if ($row['tipo_viaje'] == "Especial") {
        $nruta = $row['destino'];
      }else {
        $nruta = $row['ruta'];
      }
     
      ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['semana']; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo $nruta ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo $row['cargo']; ?></td>
          <td><?php echo $row['altabaja']; ?></td>
          <td><?php echo $row['tipo_viaje']; ?></td>
          <td><?php echo $row['unidad']; ?></td>
          <td><?php echo $row['unidad_ejecuta']; ?></td>
          <td><?php echo number_format($row['valor_vuelta'],2); ?></td>
          <td><?php echo number_format($row['sueldo_vuelta'],2); ?></td>
          <td><?php echo number_format($importetot,2); ?></td>
          <td><?php echo $row['Supev']; ?></td>
          <td><?php echo $row['Status']; ?></td>
         
        
        </tr> 
     
      <?php
    }
    ?>
    <tr>
      <td colspan="10" align="right" style="font-weight: bold;">Total:</td>
      <td style="font-weight: bold;"><?php echo number_format($sumavuelta,2); ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
     



