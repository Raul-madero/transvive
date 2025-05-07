<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Catalogo de Clientes.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 
    if(!$conection){
        die("Connection failed: " . mysqli_connect_error());
    }


$query_productos = mysqli_query($conection,"SELECT ct.id, ct.no_cliente, ct.nombre, ct.nombre_corto, ct.correo, ct.telefono, ct.movil, ct.rfc, ct.sitio, ct.contacto, ct.contacto_conta, ct.email_conta, ct.email_contacto, ct.calle, ct.colonia, ct.estado, ct.ciudad, ct.municipio, ct.pais, ct.cod_postal, ct.giro, ct.tipo_contrato, ct.id_supervisor, ct.forma_pago, ct.metodo_pago, ct.uso_cfdi, ct.credito, ct.condiciones_credito, if(ct.estatus = 1,'Activo','Inactivo') as Status, us.nombre as supervisor FROM clientes ct left join usuario us ON ct.id_supervisor = us.idusuario ORDER by ct.no_cliente");
  
        if(!$query_productos){
          die("Connection failed: " . mysqli_connect_error());
        }
        
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE CLIENTES'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>No. Cliente</th>
    <th>Razon Social</th>
    <th>Nombre Comercial</th>
    <th>Calle y Numero</th>
    <th>Colonia</th>
    <th>Ciudad</th>
    <th>Municipio</th>
    <th>Estado</th>
    <th>Codigo Postal</th>
    <th>Numero de Teléfono</th>
    <th>Contacto RH(Compras)</th>
    <th>Correo Electronico RH(Compras)</th>
    <th>Numero de Telefono Contacto</th>
    <th>Giro de la Empresa</th>
    <th>Sitio WEB</th>
    <th>Tipo de Contrato</th>
    <th>Jefe de Operaciones</th>
    <th>Razón Social</th>
    <th>R.F.C.:</th>
    <th>Forma de Pago</th>
    <th>Metodo de Pago</th>
    <th>Uso de CFDI</th>
    <th>Contacto Contabilidad</th>
    <th>Correo Eléctonico Contabilidad</th>
    <th>Crédito</th>
    <th>Condiciones de Crédito</th>
    <th>Estatus</th>
    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
     
      ?>
        <tr>
          <td><?php echo $row['no_cliente']; ?></td>
          <td><?php echo $row['nombre'];?></td>
          <td><?php echo $row['nombre_corto'];?></td>
          <td><?php echo $row['calle']; ?></td>
          <td><?php echo $row['colonia']; ?></td>
          <td><?php echo $row['ciudad']; ?></td>
          <td><?php echo $row['municipio']; ?></td>
          <td><?php echo $row['estado']; ?></td>
          <td><?php echo $row['cod_postal']; ?></td>
          <td><?php echo $row['telefono']; ?></td>
          <td><?php echo $row['contacto']; ?></td>
          <td><?php echo $row['correo']; ?></td>
          <td><?php echo $row['movil']; ?></td>
          <td><?php echo $row['giro']; ?></td>
          <td><?php echo $row['sitio']; ?></td>
          <td><?php echo $row['tipo_contrato']; ?></td>
          <td><?php echo $row['supervisor']; ?></td>
          <td><?php echo $row['nombre_corto']; ?></td>
          <td><?php echo $row['rfc']; ?></td>
          <td><?php echo $row['forma_pago']; ?></td>
          <td><?php echo $row['metodo_pago']; ?></td>
          <td><?php echo $row['uso_cfdi']; ?></td>
          <td><?php echo $row['contacto_conta']; ?></td>
          <td><?php echo $row['email_conta']; ?></td>
          <td><?php echo $row['credito']; ?></td>
          <td><?php echo $row['condiciones_credito']; ?></td>
          <td><?php echo $row['Status']; ?></td>
        
        </tr> 
     
      <?php
    }

    ?>

     



