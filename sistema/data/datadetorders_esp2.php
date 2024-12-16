<?php
session_start();
include '../config/db-config.php';

global $connection;

if ($_REQUEST['action'] == 'fetch_users') {

    $requestData = $_REQUEST;
    $start = isset($requestData['start']) ? intval($requestData['start']) : 0;

    // Validación de parámetros
    $initial_date = isset($requestData['initial_date']) ? mysqli_real_escape_string($connection, $requestData['initial_date']) : '';
    $final_date = isset($requestData['final_date']) ? mysqli_real_escape_string($connection, $requestData['final_date']) : '';
    $gender = isset($requestData['gender']) ? mysqli_real_escape_string($connection, $requestData['gender']) : '';

    // Manejo de filtros dinámicos
    $date_range = (!empty($initial_date) && !empty($final_date)) ? " AND p.fecha BETWEEN '$initial_date' AND '$final_date' " : '';
    $gender_filter = (!empty($gender)) ? " AND YEAR(p.fecha) = '$gender' " : '';

    // Configuración de columnas
    $columns = ' p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta, p.direccion, p.destino, p.costo_viaje, p.sueldo_vuelta, p.numero_unidades, p.tipo_viaje';
    $table = ' registro_viajes p LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    $where = " WHERE p.tipo_viaje LIKE '%Especial%' $date_range $gender_filter";

    $columns_order = array(
        0 => 'id',
        1 => 'fecha',
        2 => 'cliente',
        3 => 'direccion',
        4 => 'hora_inicio',
        5 => 'hora_fin',
        6 => 'unidad',
        7 => 'destino',
        8 => 'jefeo',
        9 => 'estatus'
    );

    // Consulta base
    $sql = "SELECT $columns FROM $table $where";

    // Contar total de registros
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die(json_encode(["error" => "Error en la consulta inicial: " . mysqli_error($connection)]));
    }
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    // Búsqueda
    if (!empty($requestData['search']['value'])) {
        $search_value = mysqli_real_escape_string($connection, $requestData['search']['value']);
        $sql .= " AND ( cliente LIKE '%$search_value%' ";
        $sql .= " OR p.id LIKE '%$search_value%' ";
        $sql .= " OR tipo_viaje LIKE '%$search_value%' ";
        $sql .= " OR direccion LIKE '%$search_value%' ";
        $sql .= " OR destino LIKE '%$search_value%' ) ";
    }

    // Contar resultados filtrados
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die(json_encode(["error" => "Error en la consulta de búsqueda: " . mysqli_error($connection)]));
    }
    $totalFiltered = mysqli_num_rows($result);

    // Ordenamiento
    $order_column_index = isset($requestData['order'][0]['column']) ? intval($requestData['order'][0]['column']) : 0;
    $order_dir = isset($requestData['order'][0]['dir']) && in_array($requestData['order'][0]['dir'], ['asc', 'desc']) ? $requestData['order'][0]['dir'] : 'asc';
    $sql .= " ORDER BY " . $columns_order[$order_column_index] . " $order_dir";

    // Paginación
    if ($requestData['length'] != "-1") {
        $sql .= " LIMIT $start, " . intval($requestData['length']);
    }

    // Ejecución final
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die(json_encode(["error" => "Error en la consulta final: " . mysqli_error($connection)]));
    }

    // Formateo de datos
    $data = array();
    $count = $start;
    $estatusLabels = [
        1 => '<span class="label label-primary">Activo</span>',
        2 => '<span class="label label-success">Realizado</span>',
        3 => '<span class="label label-danger">Cancelado</span>',
        4 => '<span class="label label-primary">Iniciado</span>',
        5 => '<span class="label label-info">Terminado</span>',
        'default' => '<span class="label label-success">CERRADO</span>'
    ];

    while ($row = mysqli_fetch_array($result)) {
        $estatusLabel = isset($estatusLabels[$row['estatus']]) ? $estatusLabels[$row['estatus']] : $estatusLabels['default'];

        $data[] = array(
            'counter' => ++$count,
            'pedidono' => $row['id'],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row['id'] . '" target="_blank">' . $row['id'] . '</a>',
            'fechaa' => date('d/m/Y', strtotime($row['fecha'])),
            'horainicio' => date('H:i', strtotime($row['hora_inicio'])),
            'horafin' => date('H:i', strtotime($row['hora_fin'])),
            'nosemana' => $row['semana'],
            'razonsocial' => $row['cliente'],
            'rutacte' => $row['ruta'],
            'conductor' => $row['operador'],
            'tipounidad' => $row['unidad'],
            'nounidad' => $row['numero_unidades'],
            'supervisor' => $row['name'],
            'jefeopera' => $row['jefeo'],
            'origen' => $row['direccion'],
            'Destino' => $row['destino'],
            'Costo' => $row['costo_viaje'],
            'Valor_vuelta' => $row['sueldo_vuelta'],
            'Datenew' => $row['fecha'],
            'TipoViaje' => $row['tipo_viaje'],
            'estatusped' => $estatusLabel
        );
    }

    // Respuesta JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data
    ));
}
?>
