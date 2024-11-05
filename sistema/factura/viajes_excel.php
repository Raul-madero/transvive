<?php

   header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Registro de Viajes.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');
 


$query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.ruta, rv.direccion, rv.destino, rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.destino,if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, sp.nombres as nombre, rv.operador, rv.valor_vuelta, us.nombre as jefeoperaciones FROM registro_viajes rv LEFT JOIN supervisores sp ON rv.id_supervisor =sp.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario where tipo_viaje != 'Especial' ORDER by rv.id");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE VIAJES'; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>ID</th>
    <th>Semana</th>
    <th>Fecha</th>
    <th>Mes</th>
    <th>Año</th>
    <th>Cliente</th>
    <th>Supervisor</th>
    <th>Tipo de Unidad</th>
    <th>Unidad Ejecuta</th>
    <th>no. Unidad</th>
    <th>Ruta</th>
    <th>Operador</th>
    <th>Estatus</th>
    <th>Valor Vuelta</th>
    <th>Jefe de Operaciones</th>
  

    </tr>
    </thead>
  <?php
    $tipovuelta = '';
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 
      $anio = date("Y",  strtotime($row['fecha']));
      $mes = date("m",  strtotime($row['fecha']));
      if ($mes == 1) {
       $names = "ENERO";
     }else {
      if ($mes == 2) {
        $names = "FEBRERO";
      }else {
        if ($mes == 3) {
          $names = "MARZO";
        }else {
          if ($mes == 4) {
            $names = "ABRIL";
          }else {
            if ($mes == 5) {
              $names = "MAYO"; 
            }else {
              if ($mes == 6) {
                $names = "JUNIO";
              }else {
                if ($mes == 7) {
                  $names = "JULIO";
                }else {
                  if ($mes == 8) {
                    $names = "AGOSTO";
                  }else {
                    if ($mes == 9) {
                      $names = "SEPTIEMBRE";
                    }else {
                      if ($mes == 10) {
                        $names = "OCTUBRE";
                      }else {
                        if ($mes == 11) {
                          $names = "NOVIEMBRE";
                        }else {
                          if ($mes == 12) {
                            $names = "DICIEMBRE";
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
     }
    	
      //$importetot = $importetot + $row['importe'];

    	//$litrostot = $litrostot + $row['litros'];
     
      ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $names; ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo $row['num_unidad']; ?></td>
          <td><?php echo strtoupper($row['ruta']); ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo $row['valor_vuelta']; ?></td>
          <td><?php echo $row['jefeoperaciones']; ?></td>
        </tr> 
     
      <?php
    }

    ?>

     



