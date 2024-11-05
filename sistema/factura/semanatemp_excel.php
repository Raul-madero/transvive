<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= Nomina Semanal Temporal.xls");
header("Pragma: no-cache");
header("Expires: 0");
   
include('../../conexion.php');
$conection->set_charset('utf8');
 
$semana=$_REQUEST['id'];


$query_productos = mysqli_query($conection,"SELECT dn.id, dn.no_empleado, dn.no_semana, dn.unidad, dn.nounidad, dn.nombre, dn.cargo, dn.imss, dn.estatus, dn.noalertas, dn.sueldo_base,  dn.viajes_especiales, dn.viajes_contrato, dn.bono_categoria, dn.bono_supervisor, dn.bono_semanal, dn.apoyo_mensual, dn.total_especiales, dn.sueldo_adicional, dn.prima_vacacional, dn.dias_vacaciones, dn.vacaciones, dn.total_vueltas, dn.sueldo_bruto, dn.pago_fiscal, dn.deduccion_fiscal, dn.descuento_adeudo, dn.caja, dn.total_nomina, dn.total_general, us.nombre as Supev FROM detalle_temp_nomina dn LEFT JOIN usuario us ON dn.supervisor = us.idusuario where dn.no_semana = '$semana' ORDER by dn.no_empleado");
$result_detalle = mysqli_num_rows($query_productos);
  mysqli_close($conection); 

      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE NOMINA SEMANAL '. $semana. ' Temporal' ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>No. Empleado</th>
    <th>Semana</th>
    <th>Unidad</th>
    <th>No. Unidad</th>
    <th>Empleado</th>
    <th>Cargo</th>
    <th>IMSS</th>
    <th>Estatus</th>
    <th>No. Alertas</th>
    <th>Sueldo Base</th>
    <th>Viajes Especiales</th>
    <th>Viajes Contrato</th>
    <th>Bono Categoria</th>
    <th>Bono Supervisor</th>
    <th>Bono Semanal</th>
    <th>Apoyo Mensual</th>
    <th>Total Especiales</th>
    <th>Sueldo Adicional</th>
    <th>Prima Vacacional</th>
    <th>Dias de Vacaciones</th>
    <th>Vacaciones</th>
    <th>Total Vueltas</th>
    <th>Sueldo Bruto</th>
    <th>Pago Fiscal</th>
    <th>Deducción Fiscal</th>
    <th>Descuento Adeudo</th>
    <th>Caja</th>
    <th>Total Nomina</th>
    <th>Total General</th>
    <th>Supervisor</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	//$newDate = date("d-m-Y", strtotime($row['fecha'])); 
    	//$importetot = $importetot + $row['importe'];
    	//$litrostot = $litrostot + $row['litros'];
     
      ?>
        <tr>
          <td><?php echo $row['no_empleado']; ?></td>
          <td><?php echo $row['no_semana']; ?></td>
          <td><?php echo $row['unidad']; ?></td>
          <td><?php echo $row['nounidad']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['cargo']; ?></td>
          <td><?php echo $row['imss']; ?></td>
          <td><?php echo $row['estatus']; ?></td>
          <td><?php echo $row['noalertas']; ?></td>
          <td><?php echo $row['sueldo_base']; ?></td>
          <td><?php echo $row['viajes_especiales']; ?></td>
          <td><?php echo $row['viajes_contrato']; ?></td>
          <td><?php echo $row['bono_categoria']; ?></td>
          <td><?php echo $row['bono_supervisor']; ?></td>
          <td><?php echo $row['bono_semanal']; ?></td>
          <td><?php echo $row['apoyo_mensual']; ?></td>
          <td><?php echo number_format($row['total_especiales'],2); ?></td>
          <td><?php echo $row['sueldo_adicional']; ?></td>
          <td><?php echo $row['prima_vacacional']; ?></td>
          <td><?php echo number_format($row['dias_vacaciones'],0); ?></td>
          <td><?php echo number_format($row['vacaciones'],2); ?></td>
          <td><?php echo number_format($row['total_vueltas'],2); ?></td>
          <td><?php echo number_format($row['sueldo_bruto'],2); ?></td>
          <td><?php echo number_format($row['pago_fiscal'],2); ?></td>
          <td><?php echo number_format($row['deduccion_fiscal'],2); ?></td>
          <td><?php echo number_format($row['descuento_adeudo'],2); ?></td>
          <td><?php echo $row['caja']; ?></td>
          <td><?php echo number_format($row['total_nomina'],2); ?></td>
          <td><?php echo number_format($row['total_general'],2); ?></td>
          <td><?php echo $row['Supev']; ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



