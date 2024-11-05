<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= Nomina Quincenal Temporal.xls");
header("Pragma: no-cache");
header("Expires: 0");
   
include('../../conexion.php');
$conection->set_charset('utf8');
 
$semana=$_REQUEST['id'];


$query_productos = mysqli_query($conection,"SELECT dn.id, dn.no_quincena, dn.no_empleado, dn.nombre, dn.puesto, dn.estatus, dn.sueldo_bruto, dn.sueldo_diario, dn.dias_laborados, dn.sueldo_total, dn.bono, dn.bono_mensual, dn.apoyo_alimenticio, dn.subtotal, dn.caja_ahorro, dn.prestamo_deuda, dn.vacaciones, dn.prima_vacacional, dn.dias_vacaciones, dn.prima_vacacionalfiscal, dn.sueldo_quincenal, dn.sueldo_fiscal, dn.impuesto_fiscal, dn.total_efectivo, dn.deposito FROM detalle_temp_nominaquincena dn where dn.no_quincena = '$semana' ORDER by dn.no_empleado");
$result_detalle = mysqli_num_rows($query_productos);
  mysqli_close($conection); 

      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE NOMINA QUINCENAL '. $semana. ' Temporal' ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>No. Empleado</th>
    <th>Nombres</th>
    <th>Puesto</th>
    <th>Sueldo Bruto</th>
    <th>Sueldo Diario</th>
    <th>Días Laborados</th>
    <th>Sueldo Total</th>
    <th>Bono</th>
    <th>Bono Mensual</th>
    <th>Apoyo Alimenticio</th>
    <th>Subtotal</th>
    <th>Caja</th>
    <th>Prestamo/Deuda</th>
    <th>Vacaciones</th>
    <th>Prima Vac. Fiscal</th>
    <th>Prima Vac. No Fiscal</th>
    <th>Sueldo Quincenal</th>
    <th>Fiscal</th>
    <th>Impuestos</th>
    <th>Deposito</th>
    <th>Total Fiscal</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	//$newDate = date("d-m-Y", strtotime($row['fecha'])); 
    	//$importetot = $importetot + $row['importe'];
    	//$litrostot = $litrostot + $row['litros'];
      setlocale(LC_ALL, 'es_MX');

     
      ?>
        <tr>
          <td><?php echo $row['no_empleado']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['puesto']; ?></td>
          <td><?php echo '$ '.round($row['sueldo_bruto'],0); ?></td>
          <td><?php echo number_format($row['sueldo_diario'],2); ?></td>
          <td><?php echo number_format($row['dias_laborados'],2); ?></td>
          <td><?php echo number_format($row['sueldo_total'],2); ?></td>
          <td><?php echo $row['bono']; ?></td>
          <td><?php echo $row['bono_mensual']; ?></td>
          <td><?php echo $row['apoyo_alimenticio']; ?></td>
          <td><?php echo number_format($row['subtotal'],2); ?></td>
          <td><?php echo $row['caja_ahorro']; ?></td>
          <td><?php echo $row['prestamo_deuda']; ?></td>
          <td><?php echo $row['vacaciones']; ?></td>
          <td><?php echo $row['prima_vacacionalfiscal']; ?></td>
          <td><?php echo number_format($row['prima_vacacional'],2); ?></td>
          <td><?php echo number_format($row['sueldo_quincenal'],2); ?></td>
          <td><?php echo number_format($row['sueldo_fiscal'],2); ?></td>
          <td><?php echo number_format($row['impuesto_fiscal'],2); ?></td>
          <td><?php echo number_format($row['deposito'],2); ?></td>
          <td><?php echo number_format($row['total_efectivo'],2); ?></td>

        
        </tr> 
     
      <?php
    }

    ?>

     



