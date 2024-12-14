<?php
session_start();
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
$idUser = $_SESSION['idUser'];

include '../config/db-config.php';

date_default_timezone_set('America/Mexico_City');
$fcha2 = date("Y-m-d");
$fcha1 = date("Y-m-d", strtotime('-1 day', strtotime($fcha2)));

global $connection;

if ($_REQUEST['action'] == 'fetch_users') {
    $requestData = $_REQUEST;
    $start = isset($requestData['start']) ? (int)$requestData['start'] : 0;

    $initial_date = $fcha1;
    $final_date = $fcha2;
    $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';

    $columns = 'id, fecha, hora_inicio, hora_fin, semana, cliente, operador, unidad, num_unidad, estatus';
    $table = 'registro_viajes';
    $where = "WHERE tipo_viaje <> 'Especial' AND usuario_id = ? AND (estatus = 1 OR estatus = 4 OR estatus = 5)";

    // Aplica rango de fechas
    if (!empty($initial_date) && !empty($final_date)) {
        $where .= " AND fecha BETWEEN ? AND ?";
    }

    // Filtra por género (estatus)
    if (!empty($gender)) {
        $where .= " AND estatus = ?";
    }

    // Orden dinámico
    $columns_order = [
        0 => 'id',
        1 => 'fecha',
        2 => 'hora_inicio',
        3 => 'hora_fin',
        4 => 'semana',
        5 => 'cliente',
        6 => 'operador',
        7 => 'unidad',
        8 => 'num_unidad',
        9 => 'estatus',
    ];
    $order_column = $columns_order[$requestData['order'][0]['column']];
    $order_dir = $requestData['order'][0]['dir'];

    // Prepara consulta principal
    $sql = "SELECT $columns FROM $table $where ORDER BY $order_column $order_dir LIMIT ?, ?";
    $stmt = $connection->prepare($sql);

    // Bind de parámetros según filtros
    if (!empty($initial_date) && !empty($final_date) && !empty($gender)) {
        $stmt->bind_param('isssi', $idUser, $initial_date, $final_date, $gender, $start, $requestData['length']);
    } elseif (!empty($initial_date) && !empty($final_date)) {
        $stmt->bind_param('issi', $idUser, $initial_date, $final_date, $start, $requestData['length']);
    } else {
        $stmt->bind_param('ii', $idUser, $start, $requestData['length']);
    }

    // Ejecuta consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Procesa resultados
    $data = [];
    $count = $start;
    while ($row = $result->fetch_assoc()) {
        $estatus = match ($row['estatus']) {
            1 => '<span class="label label-primary">Activo</span>',
            2 => '<span class="label label-success">Realizado</span>',
            3 => '<span class="label label-danger">Cancelado</span>',
            4 => '<span class="label label-primary">Iniciado</span>',
            5 => '<span class="label label-info">Terminado</span>',
            default => '<span class="label label-success">CERRADO</span>',
        };

        $data[] = [
            'counter' => ++$count,
            'pedidono' => $row['id'],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row['id'] . '" target="_blank">' . $row['id'] . '</a>',
            'fecha' => date('d/m/Y', strtotime($row['fecha'])),
            'horainicio' => date('H:i', strtotime($row['hora_inicio'])),
            'horafin' => date('H:i', strtotime($row['hora_fin'])),
            'nosemana' => $row['semana'],
            'razonsocial' => $row['cliente'],
            'conductor' => $row['operador'],
            'tipounidad' => $row['unidad'],
            'nounidad' => $row['num_unidad'],
            'estatusped' => $estatus,
        ];
    }

    // Retorna JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'draw' => intval($requestData['draw']),
        'recordsTotal' => $result->num_rows,
        'recordsFiltered' => $result->num_rows,
        'records' => $data,
    ]);
}
?>
