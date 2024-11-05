<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Lista de Supervisores.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT id, CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name, telefono, idacceso, if(estatus=1,'ACTIVA', 'INACTIVA') as Status FROM supervisores where estatus = 1 ORDER by nombres");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE SUPERVISORES'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Id Planeacion</th>
    <th>Nombre</th>
    <th>Telefono</th>
    <th>Estatus</th>
  

    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    
    	//$litrostot = $litrostot + $row['litros'];
     
      ?>
        <tr>
          <td><?php echo $row['idacceso']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['telefono']; ?></td>
          <td><?php echo $row['Status']; ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



