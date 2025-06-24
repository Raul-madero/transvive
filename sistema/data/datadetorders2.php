<?php
session_start();
include '../../conexion.php';

global $conection;

if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'fetch_users') {
    echo json_encode(["error" => "Acción no válida o no proporcionada."]);
    exit;
}

$requestData = $_REQUEST;

// Columnas para ordenamiento
$columnsOrder = array(
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
);

$start = isset($requestData['start']) ? intval($requestData['start']) : 0;
$length = isset($requestData['length']) ? intval($requestData['length']) : 10;
$draw = isset($requestData['draw']) ? intval($requestData['draw']) : 1;
$initial_date = mysqli_real_escape_string($conection, $requestData['initial_date'] ?? '');
$final_date = mysqli_real_escape_string($conection, $requestData['final_date'] ?? '');
$gender = mysqli_real_escape_string($conection, $_POST['gender'] ?? '');

// Columnas del SELECT
$selectColumns = "p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, 
                  p.unidad, p.num_unidad, p.personas, p.estatus, 
                  CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) AS name, 
                  us.nombre AS jefeo, p.ruta";

// FROM con JOINs
$table = "registro_viajes p 
          LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto 
          LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario 
          LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso";

$where = "WHERE p.tipo_viaje <> 'Especial'";

// Filtro por fecha
if (!empty($initial_date) && !empty($final_date)) {
    $where .= " AND p.fecha BETWEEN '$initial_date' AND '$final_date'";
} else {
    // $where .= " AND p.fecha >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)";
}

// Filtro por ID (gender)
if (!empty($gender) && is_numeric($gender)) {
    $where .= " AND p.id = '$gender'";
}

// Filtro por búsqueda general
$search = $requestData['search']['value'] ?? '';
if (!empty($search)) {
    $search = mysqli_real_escape_string($conection, $search);
    $where .= " AND (
        p.id LIKE '%$search%' OR
        p.cliente LIKE '%$search%' OR
        p.operador LIKE '%$search%' OR
        p.semana LIKE '%$search%' OR
        sp.nombres LIKE '%$search%' OR
        sp.apellido_paterno LIKE '%$search%' OR
        sp.apellido_materno LIKE '%$search%' OR
        p.fecha LIKE '%$search%' OR
        p.ruta LIKE '%$search%' OR
        us.nombre LIKE '%$search%'
    )";
}

// Ordenamiento
$orderColumn = $columnsOrder[$requestData['order'][0]['column']] ?? 'p.id';
$orderDir = $requestData['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

// Total de registros filtrados
$count_sql = "SELECT COUNT(*) AS total FROM $table $where";
$totalData = $conection->query($count_sql)->fetch_assoc()['total'] ?? 0;

// Consulta final con paginación
$sql = "SELECT $selectColumns FROM $table $where ORDER BY $orderColumn $orderDir LIMIT $start, $length";

$result = $conection->query($sql);
if (!$result) {
    echo json_encode(["error" => $conection->error]);
    exit;
}

// Construir datos
$data = [];
while ($row = $result->fetch_assoc()) {
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
        'pedidono' => $row["id"],
        'nopedido' => '<a href="factura/pedidonw.php?id=' . $row["id"] . '" target="_blank">' . $row["id"] . '</a>',
        'fecha' => (!empty($row["fecha"]) && strtotime($row["fecha"]) !== false)
                    ? date('d/m/Y', strtotime($row["fecha"]))
                    : '',
        'horainicio' => (!empty($row["hora_inicio"]) && strtotime($row["hora_inicio"]) !== false)
                    ? date('H:i', strtotime($row["hora_inicio"]))
                    : '',
        'horafin' => (!empty($row["hora_fin"]) && strtotime($row["hora_fin"]) !== false)
                    ? date('H:i', strtotime($row["hora_fin"]))
                    : '',
        'nosemana' => $row["semana"],
        'razonsocial' => $row["cliente"],
        'rutacte' => $row["ruta"],
        'conductor' => $row["operador"],
        'tipounidad' => $row["unidad"],
        'nounidad' => $row["num_unidad"],
        'supervisor' => $row["name"],
        'jefeopera' => $row["jefeo"],
        'estatusped' => $Estatusnew
    ];
}

// Respuesta JSON para DataTables
header('Content-Type: application/json');
echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalData,
    "records" => $data
], JSON_UNESCAPED_UNICODE);
