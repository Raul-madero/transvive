<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Viajes_por_Periodo.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../../conexion.php');
$conection->set_charset('utf8mb4');

// -------- Entradas ----------
$idoentrada  = $_REQUEST['id'] ?? '';
$fecha_desde = $_REQUEST['fIni'] ?? '';
$fecha_hasta = $_REQUEST['fFin'] ?? '';

// Parseo defensivo de $idoentrada (esperando algo como "...id2=...id3=...")
$fecha_ini = '';         // semana (texto o número, según tu sistema)
$mes_raw   = '';         // podría venir como "08" o "8" o "2025-08-01"
$anio_raw  = '';         // "2025" o "2025-08-28" (normalizamos a 4 dígitos)

// Busca "id2" y "id3"
$pos_id2 = strrpos($idoentrada, "id2");
$pos_id3 = strrpos($idoentrada, "id3");

if ($pos_id2 !== false) {
    // después de "id2=" tomar hasta 10 chars por compatibilidad, luego limpiamos
    $mes_raw = substr($idoentrada, $pos_id2 + 4, 10);
}
if ($pos_id3 !== false) {
    $anio_raw = substr($idoentrada, $pos_id3 + 4, 10);
}
// semana viene antes de id2 (según tu lógica actual)
if ($pos_id2 !== false) {
    $fecha_ini = trim(substr($idoentrada, 0, $pos_id2)); // tu "semana"
}

// Normalizaciones
$anio = (int)preg_replace('/[^0-9]/', '', substr($anio_raw, 0, 4)); // tomar primeros 4 dígitos
$mes  = (int)preg_replace('/[^0-9]/', '', $mes_raw);                 // 1..12 si venía “08” o “8”
$semana = trim($fecha_ini);

// -------- Selección de consulta ----------
$titulo = '';
$result_detalle = 0;
$query_productos = null;

// Columns (idénticas en ambos caminos)
$columns = "
    rv.id, rv.semana, rv.fecha, rv.cliente, rv.direccion, rv.destino, rv.costo_viaje,
    rv.hora_inicio, rv.hora_fin, rv.hora_llegadareal, rv.hora_finreal, rv.notas,
    rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.numero_unidades,
    IF(rv.estatus = 1,'Activo',
        IF(rv.estatus = 2, 'Realizado',
            IF(rv.estatus= 3,'Cancelado',
                IF(rv.estatus = 4,'Iniciado',
                    IF(rv.estatus=5, 'Finalizado', '')
                )
            )
        )
    ) AS Status,
    rv.valor_vuelta, rv.sueldo_vuelta, rv.ruta, rv.operador,
    IF (rv.planeado = 1, 'Planeado', 'Registrado') AS Tipoviaje,
    rv.tipo_viaje,
    us.nombre AS jefeo,
    CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) AS superv,
    em.noempleado, rv.personas, rv.personas_fin,
    ru.sueldo_camion     AS sueldo_ruta_camion,
    ru.sueldo_camioneta  AS sueldo_ruta_camioneta,
    ru.sueldo_sprinter   AS sueldo_ruta_sprinter,
    ru.sueldo_semid      AS sueldo_semi,
    em.sueldo_camion, em.sueldo_camioneta, em.sueldo_sprinter
";

$from = "
    FROM registro_viajes rv
    LEFT JOIN clientes ct   ON rv.cliente = ct.nombre_corto
    LEFT JOIN usuario  us   ON ct.id_supervisor = us.idusuario
    LEFT JOIN supervisores sp ON rv.id_supervisor = sp.idacceso
    LEFT JOIN empleados em  ON rv.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno)
    LEFT JOIN rutas     ru  ON rv.cliente = ru.cliente AND rv.ruta = ru.ruta
";

$order = " ORDER BY rv.fecha, rv.id";

// ---- Camino 1: Semana + Año (si hay semana)
if ($semana !== '') {
    // Si no vino un año válido, intenta tomar YEAR(CURDATE())
    if ($anio <= 0) {
        $anio = (int)date('Y');
    }

    $titulo = "REPORTE DE VIAJES DE: " . htmlspecialchars($semana, ENT_QUOTES, 'UTF-8');

    $sql = "SELECT $columns $from WHERE rv.semana = ? AND YEAR(rv.fecha) = ? $order";
    $stmt = $conection->prepare($sql);
    if (!$stmt) {
        die("Error en prepare: " . $conection->error);
    }
    $stmt->bind_param('si', $semana, $anio);
    $stmt->execute();
    $query_productos = $stmt->get_result();
    $result_detalle = $query_productos ? $query_productos->num_rows : 0;

// ---- Camino 2: Por rango de fechas (fIni/fFin) o por mes del ejercicio
} else {
    // Si hay rango explícito, úsalo; si no, calcula por mes del ejercicio.
    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        // Validación mínima de formato YYYY-MM-DD
        $fini = preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_desde) ? $fecha_desde : date('Y-m-d', strtotime($fecha_desde));
        $ffin = preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_hasta) ? $fecha_hasta : date('Y-m-d', strtotime($fecha_hasta));
        $titulo = "REPORTE DE VIAJES DEL $fini AL $ffin";

    } else {
        // Por mes del ejercicio
        if ($anio <= 0) {
            $anio = (int)date('Y');
        }
        if ($mes < 1 || $mes > 12) {
            // Si no tenemos mes válido, cae al mes actual
            $mes = (int)date('n');
        }

        $nombresMes = [
            1=>"Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",
            7=>"Julio",8=>"Agosto",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre"
        ];
        $monthNameSpanish = $nombresMes[$mes];

        // Limites del mes
        $fini = sprintf('%04d-%02d-01', $anio, $mes);
        // fin de mes: +1 mes -1 día
        $ffin = date('Y-m-d', strtotime("$fini +1 month -1 day"));

        $titulo = "REPORTE DE VIAJES POR MES DE: $monthNameSpanish $anio";
    }

    $sql = "SELECT $columns $from WHERE rv.fecha BETWEEN ? AND ? $order";
    $stmt = $conection->prepare($sql);
    if (!$stmt) {
        die("Error en prepare: " . $conection->error);
    }
    $stmt->bind_param('ss', $fini, $ffin);
    $stmt->execute();
    $query_productos = $stmt->get_result();
    $result_detalle = $query_productos ? $query_productos->num_rows : 0;
}


  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo $titulo ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>Mes</th>
    <th>ID</th>  
    <th>Semana</th>  
    <th>Año</th>
    <th>Fecha de Salida</th>
    <th>Cliente</th>
    <th>Jefe Operaciones</th>
    <th>Supervisor</th>
    <th>Tipo Unidad</th>
    <th>Unidad Ejecuta</th>
    <th>No. de Unidad</th>
    <th>No. de Personas</th>
    <th>No. de Personas Salida</th>
    <th>Tipo Vuelta</th>
    <th>Ruta</th>
    <th>No. Empleado</th>
    <th>Operador</th>
    <th>Hora Salida</th>
    <th>Hora Llegada</th>
    <th>Hora Llegada Real</th>
    <th>Valor Vuelta</th>
    <th>Sueldo Vuelta</th>
    <th>Total Vuelta</th>
    <th>Tipo de Viaje</th>
    <th>Estatus</th>
    <th>Observaciones</th>
    <th>Valor NS</th>

    </tr>
    </thead>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
    	$newDate = date("d-m-Y", strtotime($row['fecha'])); 
      if ($row['valor_vuelta'] == 0) {
        $valorNs = 0;
      }else {
        if ($row['valor_vuelta'] == 0.5) {
          if ($row['hora_llegadareal'] <= $row['hora_fin']) {
            $valorNs = 0.5;
          }else {
            $valorNs = 0;
          }
        }else {
          if ($row['hora_llegadareal'] == "00:00:00") {
            $valorNs = 0;
          }else {
            if ($row['hora_llegadareal'] <= $row['hora_fin']) {
              $valorNs = 1;
            }else {
              $valorNs = 0;
            }
          }
        }
      }
      
      setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row['fecha']));
      $anio = date("Y", $fechames);
      $mes = date("m", $fechames);
      
      $sueldo_vuelta = null;

      if (in_array($row['tipo_viaje'], ['Normal', 'Extra', 'Semidomiciliadas'])) {
          switch ($row['unidad_ejecuta']) {
              case 'Camion':
                  if (!empty($row['sueldo_ruta_camion']) && $row['sueldo_ruta_camion'] != 0) {
                      $sueldo_vuelta = max($row['sueldo_camion'], $row['sueldo_ruta_camion']);
                  }else {
                      $sueldo_vuelta = $row['sueldo_camion'];
                  }
                  break;
              case 'Camioneta':
                  if (!empty($row['sueldo_ruta_camioneta']) && $row['sueldo_ruta_camioneta'] != 0) {
                      $sueldo_vuelta = max($row['sueldo_camioneta'], $row['sueldo_ruta_camioneta']);
                  }else {
                      $sueldo_vuelta = $row['sueldo_camioneta'];
                  }
                  break;
              case 'Unidad Externa':
                  if (!empty($row['sueldo_ruta_camioneta']) && $row['sueldo_ruta_camioneta'] != 0) {
                      $sueldo_vuelta = max($row['sueldo_camioneta'], $row['sueldo_ruta_camioneta']);
                  }else {
                      $sueldo_vuelta = $row['sueldo_camioneta'];
                  }
                  break;
              case 'JAC':
                  if (!empty($row['sueldo_ruta_camioneta']) && $row['sueldo_ruta_camioneta'] != 0) {
                      $sueldo_vuelta = max($row['sueldo_camioneta'], $row['sueldo_ruta_camioneta']);
                  }else {
                      $sueldo_vuelta = $row['sueldo_camioneta'];
                  }
                  break;
              case 'Sprinter':
                  if (!empty($row['sueldo_ruta_sprinter']) && $row['sueldo_ruta_sprinter'] != 0) {
                      $sueldo_vuelta = max($row['sueldo_sprinter'], $row['sueldo_ruta_sprinter']);
                  }else {
                      $sueldo_vuelta = $row['sueldo_sprinter'];
                  }
                  break;
              case 'Automovil':
                if (!empty($row['sueldo_ruta_camioneta']) && $row['sueldo_ruta_camioneta'] != 0) {
                      $sueldo_vuelta = max($row['sueldo_camioneta'], $row['sueldo_ruta_camioneta']);
                  }else {
                      $sueldo_vuelta = $row['sueldo_camioneta'];
                  }
                  break;
          }
      } else {
          $sueldo_vuelta = $row['sueldo_vuelta'];
      }


$total_vuelta = $row['valor_vuelta'] * $sueldo_vuelta;
              
      switch($mes)
      {   
          case 1:
          $monthNameSpanish = "Enero";
          break;

          case 2:
          $monthNameSpanish = "Febrero";
          break;

          case 3:
          $monthNameSpanish = "Marzo";
          break;

          case 4:
          $monthNameSpanish = "Abril";
          break;

          case 5:
          $monthNameSpanish = "Mayo";
          break;

          case 6:
          $monthNameSpanish = "Junio";
          break;

          case 7:
          $monthNameSpanish = "Julio";
          break;

          case 8:
          $monthNameSpanish = "Agosto";
          break;

          case 9:
          $monthNameSpanish = "Septiembre";
          break;

          case 10:
          $monthNameSpanish = "Octubre";
          break;

          case 11:
          $monthNameSpanish = "Noviembre";
          break;

          case 12:
          $monthNameSpanish = "Diciembre";
          break;

    //...
    }
      ?>
        <tr>
          <td><?php echo strtoupper($monthNameSpanish); ?></td>
          <td><?php echo strtoupper($row['id']); ?></td>
          <td><?php echo strtoupper($row['semana']); ?></td>
          <td><?php echo $anio; ?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $row['cliente']; ?></td>
          <td><?php echo strtoupper($row['jefeo']); ?></td>
          <td><?php echo strtoupper($row['superv']); ?></td>
          <td><?php echo strtoupper($row['unidad']); ?></td>
          <td><?php echo strtoupper($row['unidad_ejecuta']); ?></td>
          <td><?php echo strtoupper($row['num_unidad']); ?></td>
          <td><?php echo strtoupper($row['personas']); ?></td>
          <td><?php echo strtoupper($row['personas_fin']); ?></td>
          <td><?php echo strtoupper($row['Tipoviaje']); ?></td>
          <td><?php echo strtoupper($row['ruta']); ?></td>
          <td><?php echo $row['noempleado']; ?></td>
          <td><?php echo $row['operador']; ?></td>
          <td><?php echo $row['hora_inicio']; ?></td>
          <td><?php echo $row['hora_fin']; ?></td>
          <td><?php echo $row['hora_llegadareal']; ?></td>
          <td><?php echo number_format($row['valor_vuelta'],2); ?></td>

          <td><?php echo number_format($sueldo_vuelta,2); ?></td>
          <td><?php echo number_format($total_vuelta,2); ?></td>
          <td><?php echo strtoupper($row['tipo_viaje']); ?></td>
          <td><?php echo strtoupper($row['Status']); ?></td>
          <td><?php echo strtoupper($row['notas']); ?></td>
          <td><?php echo strtoupper($valorNs); ?></td>
        </tr> 
     
      <?php
    }

    ?>



