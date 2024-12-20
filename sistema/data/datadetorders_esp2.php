<?php
session_start();
include '../../conexion.php';


global $conection;

if($_REQUEST['action'] == 'fetch_users'){

    $requestData = $_REQUEST;
    $start = $requestData['start'];
    $length = $requestData['length'];
    $initial_date = $requestdata['initial_date'];
    $final_date = $requestData['final_date'];
    $gender = $requestData['gender'];
    $draw = $requestData['draw'];

    $columns = ' p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno)AS name, us.nombre AS jefeo, p.ruta, p.direccion, p.destino, p.costo_viaje, p.sueldo_vuelta, p.tipo_viaje';
    $table = ' registro_viajes p LEFT JOIN clientes ct ON p.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    $where = "WHERE p.tipo_viaje LIKE '%Especial%'";

    (!empty($initial_date)) && (!empty($final_date)) ? $where .= " AND p.fecha BETWEEN '$initial_date' AND '$final_date'" : $where .= " AND p.fecha >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
    ($gender !== null && $gender > 0) ? $where .= " AND p.id = '$gender'" : null;

    // $columns_order = array(
    //     0 => 'id',
    //     1 => 'fecha',
    //     2 => 'cliente',
    //     3 => 'direccion',
    //     4 => 'hora_inicio',
    //     5 => 'hora_fin',
    //     6 => 'unidad',
    //     7 => 'destino',
    //     8 => 'jefeo',
    //     9 => 'estatus'
    // );

    if(!empty($requestData['search']['value'])) {
        $where .= " AND (p.id LIKE '%" . $requestData['search']['value'] . "%' OR p.cliente LIKE '%" . $requestData['search']['value'] . "%' OR p.operador LIKE '%" . $requestData['search']['value'] . "%' OR p.semana LIKE '%" . $requestData['search']['value'] . "%' OR sp.nombres LIKE '%" . $requestData['search']['value'] . "%' OR sp.apellido_materno LIKE '%" . $requestdata['search']['value'] . "%' OR sp.apellido_materno LIKE '%" . $requestData['search']['value'] . "%' OR p.fecha LIKE '%" . $requestData['search']['value'] . "%')";
    };

    $count_sql = "SELECT COUNT(*) AS total FROM $table $where";
    $total_data = $conection->query($count_sql)->fetch_assoc()['total'] ?? 0;
    
    $sql = "SELECT $columns FROM $table $where ORDER BY p.fecha DESC LIMIT $start, $length";
    // (!empty($requestData['length'])) ? $sql .= " LIMIT " . $requestData['start'] . ", " . $requestData['length'] : "";

    $result = $conection->query($sql);

    if(!$result) {
        echo json_encode([ "error" => $conection->error ]);
        exit;
    }

    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;
    $data = [];
    while($row = $result->fetch_assoc()) {
        $status_labels = [
            1 => 'label-primary">Activo',
            2 => 'label-success">Realizado',
            3 => 'label-danger">Cancelado',
            4 => 'label-primary">Iniciado',
            5 => 'label-info">Terminado',
            6 => 'label-success">CERRADO'
        ];
        $Estatusnew = '<span class="label ' . ($status_labels[$row['estatus']] ?? 'label-default">Desconocido') . '</span>';

        $data[] = [
            'counter' => ++$start,
            'pedidono' => $row['id'],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>',
            'fecha' => date('d/m/Y', strtotime($row["fecha"])),
            'horainicio' => date('H:i', strtotime($row["hora_inicio"])),
            'horafin' => date('H:i', strtotime($row["hora_fin"])),
            'nosemana' => $row["semana"],
            'razonsocial' => $row["cliente"],
            'rutacte' => $row["ruta"],
            'conductor' => $row["operador"],
            'tipounidad' => $row["unidad"],
            'nounidad' => $row["num_unidad"],
            'supervisor' => $row["name"],
            'jefeopera' => $row["jefeo"],
            'origen' => $row["direccion"],
            'Destino' => $row["destino"],
            'Costo' => $row["costo_viaje"],
            'Valor_vuelta' => $row["sueldo_vuelta"],
            'Datenew' => $row['fecha'],
            'TipoViaje' => $row['tipo_viaje'],
            'estatusped' => $Estatusnew
        ];
    };
        
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "draw" => $draw,
        "recordsTotal" => $totalData,
        "recordsFiltered" => $totalFiltered,
        "records" => $data
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "error" => "Acción no válida o no proporcionada."
    ]);
}

?>