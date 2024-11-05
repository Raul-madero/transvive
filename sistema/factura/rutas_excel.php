<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Catalogo de Rutas.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT * FROM rutas ORDER by cliente");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE CATALOGO DE RUTAS'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Cliente</th>
    <th>Ruta</th>
    <th>No. Eco.</th>
    <th>Operador</th>
    <th>Horario 1</th>
    <th>Horario 2</th>
    <th>Horario 3</th>
    <th>Horario Mixto 1</th>
    <th>Horario Mixto 2</th>
    <th>Días</th>
    <th>Estatus</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
      
      
     if ($row['estatus'] == 1) {
        
          $Status = "ALTA";
        
      } else {
        $Status = 'BAJA';
      }
      
      ?>
        <tr>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo $row['ruta'];?></td>
          <td><?php echo $row['no_eco']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo $row['horario1']; ?></td>
          <td><?php echo $row['horario2']; ?></td>
          <td><?php echo $row['horario3']; ?></td>
          <td><?php echo $row['hmixto1']; ?></td>
          <td><?php echo $row['hmixto2']; ?></td>
          <td><?php echo $row['dias']; ?></td>
          <td><?php echo $Status ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



