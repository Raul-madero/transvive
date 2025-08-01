<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Requisiciones.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query = mysqli_query($conection,"SELECT 
        r.no_requisicion, 
        r.fecha, 
        r.fecha_requiere, 
        r.tipo_requisicion, 
        r.area_solicitante, 
        r.cant_autorizada,
        r.observaciones, 
        o.no_orden, 
        o.fecha AS fecha_orden,
        f.no_factura,
        f.fecha AS fecha_factura,
        e.fecha AS fecha_entrega,
        r.estatus,
        CASE r.estatus
            WHEN 0 THEN 'Cancelada'
            WHEN 1 THEN 'Activa'
            WHEN 2 THEN 'Autorizada'
            WHEN 3 THEN 'Procesada'
            WHEN 4 THEN 'Facturada'
            ELSE 'Terminada'
        END AS estatus_texto
    FROM requisicion_compra r
    LEFT JOIN orden_compra o ON r.no_requisicion = o.no_requisicion
    LEFT JOIN facturas f ON f.no_requisicion = o.no_requisicion
    LEFT JOIN entradas e ON e.no_requisicion = o.no_requisicion
    ORDER BY r.fecha DESC;
    ");
      $result = mysqli_num_rows($query);
       mysqli_close($conection); 
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<!-- <?php echo 'REQUISICIONES'; ?> -->
<table border="1">
    <thead style='background-color:#292929;'>
        <tr>
            <th>No. Requisicion</th>
            <th>Fecha de Elaboracion</th>
            <th>Fecha en que requiere</th>
            <th>Orden de compra</th>
            <th>Fecha Orden de compra</th>
            <th>No. Factura</th>
            <th>Fecha Factura</th>
            <th>Fecha Entrega</th>
            <th>Tipo requisicion</th>
            <th>Observaciones</th>
            <th>Area Requiere</th>
            <th>Monto</th>
            <th>Estatus</th>
        </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query)) {
      
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 
      $fecha_requiere = date("d-m-Y", strtotime($row['fecha_requiere'])); 
      $fecha_orden = $row['fecha_orden'] ? date("d-m-Y", strtotime($row['fecha_orden'])) : ""; 
      $fecha_factura = $row['fecha_factura']? date("d-m-Y", strtotime($row['fecha_factura'])) : ""; 
      $fecha_entrega = $row['fecha_entrada']? date("d-m-Y", strtotime($row['fecha_entrada'])) : ""; 
      ?>
        <tr>
          <td><?php echo "REQ-" . $row['no_requisicion']; ?></td>
          <td><?php echo $newDate?></td>
          <td><?php echo $fecha_requiere; ?></td>
          <td><?php echo !empty($row['no_orden']) ?  "OC-" . $row['no_orden'] : ""; ?></td>
          <td><?php echo $fecha_orden ?? ""; ?></td>
          <td><?php echo !empty($row['no_factura']) ?? ""; ?></td>
          <td><?php echo $fecha_factura ?? ""; ?></td>
          <td><?php echo $fecha_entrega ?? ""; ?></td>
          <td><?php echo $row['tipo_requisicion']; ?></td>
          <td><?php echo $row['observaciones']; ?></td>
          <td><?php echo $row['area_solicitante']; ?></td>
          <td><?php echo "$" . number_format($row['cant_autorizada'], 2); ?></td>
          <td><?php echo strtoupper($row['estatus_texto']); ?></td>
        </tr> 
     
      <?php
    }

    ?>

     



