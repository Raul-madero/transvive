<?php
session_start();
include '../../conexion.php';

global $conection;

if ($_REQUEST['action'] === 'fetch_users') {
    $requestData = $_REQUEST;
    $start = intval($_REQUEST['start']);
    $length = intval($_REQUEST['length']);
    $searchValue = $requestData['search']['value'] ?? '';

    $initialDate = $_REQUEST['initial_date'] ?? '';
    $finalDate = $_REQUEST['final_date'] ?? '';
    $gender = $_REQUEST['gender'] ?? '';

    echo "<pre>";
    print_r($gender);
    echo "</pre>";

    $dateRangeQuery = (!empty($initialDate) && !empty($finalDate)) ? " AND p.fecha BETWEEN ? AND ? " : '';

    $statusMapping = [
        'Activa' => 1,
        'Cerrada' => 2,
        'Cancelada' => 0,
    ];
    $genderQuery = isset($statusMapping[$gender]) ? " AND p.estatus = ? " : '';

    $columns = [
        'p.id', 'p.no_orden', 'p.fecha', 'p.usuario', 'p.solicita', 'p.unidad',
        'p.tipo_trabajo', 'p.tipo_mantenimiento', 'p.trabajo_solicitado', 'p.estatus'
    ];
    $columnsOrder = ['id', 'no_orden', 'fecha', 'usuario', 'solicita', 'unidad', 'tipo_trabajo', 'tipo_mantenimiento', 'trabajo_solicitado', 'estatus'];

    $orderColumn = $columnsOrder[$requestData['order'][0]['column']] ?? 'id';
    $orderDir = $requestData['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

    $query = "SELECT " . implode(',', $columns) . " FROM solicitud_mantenimiento p WHERE p.id > 0";

    $params = [];
    $paramTypes = '';

    if ($dateRangeQuery) {
        $query .= $dateRangeQuery;
        $params[] = $initialDate;
        $params[] = $finalDate;
        $paramTypes .= 'ss';
    }

    if ($genderQuery) {
        $query .= $genderQuery;
        $params[] = $statusMapping[$gender];
        $paramTypes .= 'i';
    }

    if (!empty($searchValue)) {
        $query .= " AND (p.no_orden LIKE ? OR p.tipo_mantenimiento LIKE ? OR p.unidad LIKE ? )";
        $params[] = "%$searchValue%";
        $params[] = "%$searchValue%";
        $params[] = "%$searchValue%";
        $paramTypes .= 'sss';
    }

    $stmt = $conection->prepare($query);

    if ($stmt) {
        if (!empty($paramTypes)) {
            $stmt->bind_param($paramTypes, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $totalData = $result->num_rows;

        $query .= " ORDER BY $orderColumn $orderDir LIMIT ?, ?";
        $params[] = $start;
        $params[] = $length;
        $paramTypes .= 'ii';

        $stmt = $conection->prepare($query);
        $stmt->bind_param($paramTypes, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        $count = $start;

        while ($row = $result->fetch_assoc()) {
            $estatusLabels = [
                1 => '<span class="label label-primary">Activa</span>',
                2 => '<span class="label label-success">Cerrada</span>',
                3 => '<span class="label label-danger">Cancelado</span>',
                4 => '<span class="label label-primary">Iniciado</span>',
                5 => '<span class="label label-info">Terminado</span>',
                0 => '<span class="label label-success">Cancelada</span>'
            ];

            $estatusNew = $estatusLabels[$row['estatus']] ?? '';

            $data[] = [
                'counter' => ++$count,
                'pedidono' => $row['id'],
                'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row['id'] . '" target="_blank">' . $row['id'] . '</a>',
                'fechaa' => date('d/m/Y', strtotime($row['fecha'])),
                'noorden' => $row['no_orden'],
                'usuario' => $row['usuario'],
                'solicita' => $row['solicita'],
                'unidad' => $row['unidad'],
                'tipojob' => $row['tipo_trabajo'],
                'tipomantto' => $row['tipo_mantenimiento'],
                'trabsolicitado' => $row['trabajo_solicitado'],
                'Datenew' => $row['fecha'],
                'estatusped' => $estatusNew
            ];
        }
        header('Content-Type: application/json; charset=uitf-8');
        $json_data = [
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'records' => $data
        ];
        var_dump($json_data);
        echo json_encode($json_data);
    } else {
        echo json_encode(['error' => 'Error en la consulta SQL']);
    }
}
?>