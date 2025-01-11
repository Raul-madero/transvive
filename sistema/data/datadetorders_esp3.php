<?php
session_start();
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
$idUser = $_SESSION['idUser'];

include '../../conexion.php';

if ($_REQUEST['action'] == 'fetch_users') {
    global $conection;

    // Validar y limpiar entradas
    $requestData = $_REQUEST;
    $start = intval($requestData['start']);
    $length = intval($requestData['length']);
    $searchValue = isset($requestData['search']['value']) ? mysqli_real_escape_string($conection, $requestData['search']['value']) : '';
    $initial_date = !empty($requestData['initial_date']) ? mysqli_real_escape_string($conection, $requestData['initial_date']) : null;
    $final_date = !empty($requestData['final_date']) ? mysqli_real_escape_string($conection, $requestData['final_date']) : null;
    $gender = isset($requestData['gender']) ? mysqli_real_escape_string($conection, $requestData['gender']) : '';

    // Condiciones dinámicas
    $conditions = [
        "p.tipo_viaje LIKE '%Especial%'",
        "p.id_supervisor = $idUser"
    ];

    if ($initial_date && $final_date) {
        $conditions[] = "p.fecha BETWEEN '$initial_date' AND '$final_date'";
    }

    if ($gender !== '') {
        $conditions[] = "p.id = '$gender'";
    }

    // Filtrar por búsqueda
    if (!empty($searchValue)) {
        $searchConditions = [
            "cliente LIKE '%$searchValue%'",
            "p.id LIKE '%$searchValue%'",
            "tipo_viaje LIKE '%$searchValue%'",
            "direccion LIKE '%$searchValue%'",
            "destino LIKE '%$searchValue%'"
        ];
        $conditions[] = '(' . implode(' OR ', $searchConditions) . ')';
    }

    // Construir consulta
    $where = "WHERE " . implode(' AND ', $conditions);

    $columns = "
        p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, 
        p.num_unidad, p.personas, p.estatus, 
        CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) AS name, 
        us.nombre AS jefeo, p.ruta, p.direccion, p.destino, p.costo_viaje, 
        p.sueldo_vuelta, tipo_viaje
    ";

    $table = "
        registro_viajes p
        LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto
        LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario
        LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso
    ";

    $orderColumnIndex = intval($requestData['order'][0]['column']);
    $orderDirection = $requestData['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';
    $columnsOrder = ['id', 'fecha', 'cliente', 'direccion', 'hora_inicio', 'hora_fin', 'unidad', 'destino', 'jefeo', 'estatus'];
    $orderBy = $columnsOrder[$orderColumnIndex] ?? 'id';

    $sql = "SELECT $columns FROM $table $where";
    $totalResult = mysqli_query($conection, $sql);
    $totalFiltered = mysqli_num_rows($totalResult);

    $sql .= " ORDER BY $orderBy $orderDirection LIMIT $start, $length";
    $result = mysqli_query($conection, $sql);

    // Procesar datos
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $statusMap = [
            1 => '<span class="label label-primary">Activo</span>',
            2 => '<span class="label label-success">Realizado</span>',
            3 => '<span class="label label-danger">Cancelado</span>',
            4 => '<span class="label label-primary">Iniciado</span>',
            5 => '<span class="label label-info">Terminado</span>',
            'default' => '<span class="label label-success">CERRADO</span>'
        ];

        $Estatusnew = $statusMap[$row['estatus']] ?? $statusMap['default'];

        $data[] = [
            'counter' => ++$start,
            'pedidono' => $row['id'],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row['id'] . '" target="_blank">' . $row['id'] . '</a>',
            'fechaa' => date('d/m/Y', strtotime($row['fecha'])),
            'horainicio' => date('H:i', strtotime($row['hora_inicio'])),
            'horafin' => date('H:i', strtotime($row['hora_fin'])),
            'nosemana' => $row['semana'],
            'razonsocial' => $row['cliente'],
            'rutacte' => $row['ruta'],
            'operador' => $row['operador'],
            'unidad' => $row['unidad'],
            'numunidad' => $row['num_unidad'],
            'personas' => $row['personas'],
            'supervisor' => $row['name'],
            'jefeopera' => $row['jefeo'],
            'origen' => $row['direccion'],
            'Destino' => $row['destino'],
            'Costo' => $row['costo_viaje'],
            'Valor_vuelta' => $row['sueldo_vuelta'],
            'TipoViaje' => $row['tipo_viaje'],
            'estatusped' => $Estatusnew
        ];
    }

    // Respuesta JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalFiltered),
        "recordsFiltered" => intval($totalFiltered),
        "records" => $data
    ]);
}
?>
