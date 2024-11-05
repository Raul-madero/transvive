<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Catalogo de Empleados.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT * FROM empleados ORDER by noempleado");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE CATALOGO DE EMPLEADOS'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>No. Empleado</th>
    <th>Nombre(s)</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    <th>Sexo</th>
    <th>Fecha de Nacimiento</th>
    <th>Edad</th>
    <th>Estado Civil</th>
    <th>Domicilio</th>
    <th>Nivel de Estudios</th>
    <th>Cargo</th>
    <th>Supervisor</th>
    <th>Telefono</th>
    <th>Contacto de Emergencia</th>
    <th>R.F.C.</th>
    <th>CURP</th>
    <th>Tipo de Licencia</th>
    <th>No. de Licencia</th>
    <th>Fecha de Vencimiento:</th>
    <th>Tipo de Contrato</th>
    <th>Inicio Contrato</th>
    <th>Vencimiento de Contrato</th>
    <th>Alta IMSS</th>
    <th>Fecha Alta IMSS</th>
    <th>N.S.S.</th>
    <th>Salario Diario</th>
    <th>Sueldo Base</th>
    <th>Sueldo Camión</th>
    <th>Sueldo Camioneta</th>
    <th>Sueldo Automovil</th>
    <th>Sueldo Sprinter</th>
    <th>Prestamo</th>
    <th>Descuento</th>
    <th>Bono Categoria</th>
    <th>Bono Supervisor</th>
    <th>Bono Semanal</th>
    <th>Apoyo Mensual</th>
    <th>Sueldo Adicional</th>
    <th>Caja de Ahorro</th>
    <th>Dias Vacaciones</th>
    <th>Sueldo Fiscal</th>
    <th>Descuento Fiscal</th>
    <th>Tipo de Nomina</th>    
    <th>Observaciones</th>
    <th>Estatus</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
      if ($row['date_nacimiento'] > '1600-01-01') {
        $newDate = date("d-m-Y", strtotime($row['date_nacimiento']));
      }else {
        $newDate = '';
      }
      if ($row['fecha_vencimiento'] > '2000-01-01') {
        $newDate2 = date("d-m-Y", strtotime($row['fecha_vencimiento']));
      }else {
        $newDate2 = '';
      }
      if ($row['fecha_contrato'] > '2000-01-01') {
        $newDate3 = date("d-m-Y", strtotime($row['fecha_contrato']));
      }else {
        $newDate3 = '';
      }
      if ($row['fecha_fincontrato'] > '2000-01-01') {
        $newDate4 = date("d-m-Y", strtotime($row['fecha_fincontrato']));
      }else {
        $newDate4 = '';
      }
      if ($row['fecha_altaimss'] > '2000-01-01') {
        $newDate5 = date("d-m-Y", strtotime($row['fecha_altaimss']));
      }else {
        $newDate5 = '';
      }
      
     if ($row['estatus'] == 1) {
        if ($row['fecha_reingreso'] > '2000-01-01') {
          $Status = 'REINGRESO';
        }else {
          $Status = "ALTA";
        }
      } else {
        $Status = 'BAJA';
      }
      
      ?>
        <tr>
          <td><?php echo $row['noempleado']; ?></td>
          <td><?php echo $row['nombres'];?></td>
          <td><?php echo $row['apellido_paterno']; ?></td>
          <td><?php echo $row['apellido_materno']; ?></td>
          <td><?php echo $row['sexo']; ?></td>
          <td><?php echo $newDate ?></td>
          <td><?php echo $row['edad']; ?></td>
          <td><?php echo $row['estado_civil']; ?></td>
          <td><?php echo $row['domicilio']; ?></td>
          <td><?php echo $row['estudios']; ?></td>
          <td><?php echo $row['cargo']; ?></td>
          <td><?php echo $row['supervisor']; ?></td>
          <td><?php echo $row['telefono']; ?></td>
          <td><?php echo $row['contacto_emergencia']; ?></td>
          <td><?php echo $row['rfc']; ?></td>
          <td><?php echo $row['curp']; ?></td>
          <td><?php echo $row['tipo_licencia']; ?></td>
          <td><?php echo $row['no_licencia']; ?></td>
          <td><?php echo $newDate2 ?></td>
          <td><?php echo $row['tipo_contrato']; ?></td>
          <td><?php echo $newDate3 ?></td>
          <td><?php echo $newDate4 ?></td>
          <td><?php echo $row['imss']; ?></td>
          <td><?php echo $newDate5 ?></td>
          <td><?php echo $row['numeross']; ?></td>
          <td><?php echo $row['salario_diario']; ?></td>
          <td><?php echo $row['sueldo_base']; ?></td>
          <td><?php echo $row['sueldo']; ?></td>
          <td><?php echo $row['sueldo_camioneta']; ?></td>
          <td><?php echo $row['sueldo_coche']; ?></td>
          <td><?php echo $row['sueldo_sprinter']; ?></td>
          <td><?php echo $row['saldo_adeudo']; ?></td>
          <td><?php echo $row['descuento']; ?></td>
          <td><?php echo $row['bono_categoria']; ?></td>
          <td><?php echo $row['bono_supervisor']; ?></td>
          <td><?php echo $row['bono_semanal']; ?></td>
          <td><?php echo $row['apoyo_mes']; ?></td>
          <td><?php echo $row['sueldo_adicional']; ?></td>
          <td><?php echo $row['caja_ahorro']; ?></td>
          <td><?php echo $row['vacaciones']; ?></td>
          <td><?php echo $row['efectivo']; ?></td>
          <td><?php echo $row['descuento_fiscal']; ?></td>
          <td><?php echo $row['tipo_nomina']; ?></td>
          <td><?php echo $row['comentarios']; ?></td>
          <td><?php echo $Status ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



