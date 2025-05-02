<?php
session_start();
include '../../conexion.php';

date_default_timezone_set('America/Mexico_City');
global $conection;

if ($_REQUEST['action'] == 'fetch_userss') {
    $requestData = $_REQUEST;
    $start = intval($requestData['start'] ?? 0);
    $length = intval($requestData['length'] ?? 10);
    $draw = intval($requestData['draw'] ?? 1);

    $columns = "p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus,
        CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) AS name, us.nombre AS jefeo, p.ruta";

    $table = "registro_viajes p
        LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto
        LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario
        LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso";

    $where = "WHERE p.tipo_viaje <> 'Especial' AND p.fecha >= DATE_SUB(CURDATE(), INTERVAL 2 DAY)";
    if (!empty($requestData['search']['value'])) {
        $search = mysqli_real_escape_string($conection, $requestData['search']['value']);
        $where .= " AND (
            p.id LIKE '%$search%' OR
            p.cliente LIKE '%$search%' OR
            p.operador LIKE '%$search%' OR
            p.semana LIKE '%$search%' OR
            sp.nombres LIKE '%$search%' OR
            p.fecha LIKE '%$search%' OR
            p.ruta LIKE '%$search%'
        )";
    }

    $columns_order = [
        0 => 'p.id',
        1 => 'p.fecha',
        2 => 'p.hora_inicio',
        3 => 'p.hora_fin',
        4 => 'p.semana',
        5 => 'p.cliente',
        6 => 'p.ruta',
        7 => 'p.operador',
        8 => 'p.unidad',
        9 => 'p.num_unidad',
        10 => 'name',
        11 => 'jefeo',
        12 => 'p.estatus'
    ];

    $order_column_index = $requestData['order'][0]['column'] ?? 0;
    $order_column = $columns_order[$order_column_index] ?? 'p.id';
    $order_dir = (isset($requestData['order'][0]['dir']) && strtolower($requestData['order'][0]['dir']) === 'desc') ? 'DESC' : 'ASC';

    $sql = "SELECT $columns FROM $table $where ORDER BY $order_column $order_dir LIMIT $start, $length";
    $result = mysqli_query($conection, $sql);

    if (!$result) {
        echo json_encode([
            'error' => true,
            'message' => 'Error en la consulta: ' . mysqli_error($conection)
        ]);
        exit;
    }

    $data = [];
    $count = $start;
    while ($row = mysqli_fetch_assoc($result)) {
        switch ((int)$row['estatus']) {
            case 1:
                $estatus = '<span class="label label-primary">Activo</span>';
                break;
            case 2:
                $estatus = '<span class="label label-success">Realizado</span>';
                break;
            case 3:
                $estatus = '<span class="label label-danger">Cancelado</span>';
                break;
            case 4:
                $estatus = '<span class="label label-primary">Iniciado</span>';
                break;
            case 5:
                $estatus = '<span class="label label-info">Terminado</span>';
                break;
            case 6:
                $estatus = '<span class="label label-success">CERRADO</span>';
                break;
            default:
                $estatus = '<span class="label label-secondary">Desconocido</span>';
                break;
        }
        

        $data[] = [
            'counter' => ++$count,
            'pedidono' => $row['id'],
            'nopedido' => '<a href="factura/pedidonw.php?id=' . $row['id'] . '" target="_blank">' . $row['id'] . '</a>',
            'fecha' => date('d/m/Y', strtotime($row['fecha'])),
            'horainicio' => date('H:i', strtotime($row['hora_inicio'])),
            'horafin' => date('H:i', strtotime($row['hora_fin'])),
            'nosemana' => $row['semana'],
            'razonsocial' => $row['cliente'],
            'rutacte' => $row['ruta'],
            'conductor' => $row['operador'],
            'tipounidad' => $row['unidad'],
            'nounidad' => $row['num_unidad'],
            'supervisor' => $row['name'],
            'jefeopera' => $row['jefeo'],
            'estatusped' => $estatus
        ];
    }

    echo json_encode([
        "draw" => $draw,
        "recordsTotal" => $count,
        "recordsFiltered" => $count,
        "records" => $data
    ]);
}
?>
