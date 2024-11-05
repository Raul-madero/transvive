<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Reporte de Bajas.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT id, noempleado, CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as empleado, fecha_baja, motivo_baja, recontratable, pqrecontrata FROM empleados WHERE estatus = 0 order by noempleado");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE BAJAS'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>ID</th>
    <th>No. Empleado</th>
    <th>Empleado</th>
    <th>Fecha Baja</th>
    <th>Motivo Baja</th>
    <th>Recontratable</th>
    <th>Motivo Recontratable</th>

    </tr>
    </thead>
  <?php
    $tipovuelta = '';
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha_baja'])); 
    	
      //$importetot = $importetot + $row['importe'];

    	//$litrostot = $litrostot + $row['litros'];
     
      ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['noempleado']; ?></td>
          <td><?php echo $row['empleado']; ?></td>
          <td><?php echo $newDate; ?></td>       
          <td><?php echo $row['motivo_baja']; ?></td>
          <td><?php echo $row['recontratable']; ?></td>
          <td><?php echo $row['pqrecontrata']; ?></td>
         
        </tr> 
     
      <?php
    }

    ?>

     



