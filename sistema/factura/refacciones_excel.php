<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Catalogo de Refacciones.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT id, codigo, codigo_interno, descripcion, marca, umedida, rotacion, categoria, modelo, costo, stock_maximo, stock_minimo, impuesto, impuesto_isr, impuesto_ieps, if(estatus = 1,'Activo','Inactivo') as Status FROM refacciones");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE CATALOGO DE REFACCIONES'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th Style="background-color: #0A6ED1; color: white;">CODIGO</th>
    <th Style="background-color: #0A6ED1; color: white;">CODIGO INTERNO</th>
    <th Style="background-color: #0A6ED1; color: white;">DESCRIPCION</th>
    <th Style="background-color: #0A6ED1; color: white;">MARCA</th>
    <th Style="background-color: #0A6ED1; color: white;">U. MEDIDA</th>
    <th Style="background-color: #0A6ED1; color: white;">ROTACION</th>
    <th Style="background-color: #0A6ED1; color: white;">CATEGORIA</th>
    <th Style="background-color: #0A6ED1; color: white;">MODELO</th>
    <th Style="background-color: #0A6ED1; color: white;">COSTO</th>
    <th Style="background-color: #0A6ED1; color: white;">STOCK MAXIMO</th>
    <th Style="background-color: #0A6ED1; color: white;">STOCK MINIMO</th>
    <th Style="background-color: #0A6ED1; color: white;">IVA</th>
    <th Style="background-color: #0A6ED1; color: white;">ISR</th>
    <th Style="background-color: #0A6ED1; color: white;">IEPS</th>
    <th Style="background-color: #0A6ED1; color: white;">ESTATUS</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
  
      
      
      ?>
        <tr>
          <td><?php echo $row['codigo']; ?></td>
          <td><?php echo $row['codigo_interno'];?></td>
          <td><?php echo $row['descripcion']; ?></td>
          <td><?php echo $row['marca']; ?></td>
          <td><?php echo $row['umedida']; ?></td>
          <td><?php echo $row['rotacion']; ?></td>
          <td><?php echo $row['categoria']; ?></td>
          <td><?php echo $row['modelo']; ?></td>
          <td><?php echo number_format($row['costo'],2); ?></td>
          <td><?php echo $row['stock_maximo']; ?></td>
          <td><?php echo $row['stock_minimo']; ?></td>
          <td><?php echo $row['impuesto']; ?></td>
          <td><?php echo $row['impuesto_isr']; ?></td>
          <td><?php echo $row['impuesto_ieps']; ?></td>
          <td><?php echo $row['Status']; ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



