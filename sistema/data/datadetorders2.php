<?php
session_start();
include '../../conexion.php';

global $conection;

if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'fetch_users') {
    echo json_encode(["error" => "Acción no válida o no proporcionada."]);
    exit;
}

$requestData = $_REQUEST;
$columns = array(
    0 => 'id', 
    1 => 'fecha',
    2 => 'hora_inicio',
    3 => 'hora_fin',
    4 => 'semana',
    5 => 'cliente',
    6 => 'ruta',
    7 => 'operador',
    8 => 'unidad',
    9 => 'num_unidad',
    10 => 'name',
    11 => 'jefeo',
    12 => 'estatus'
);

$start = isset($requestData['start']) ? intval($requestData['start']) : 0;
$length = isset($requestData['length']) ? intval($requestData['length']) : 10;
$draw = isset($requestData['draw']) ? intval($requestData['draw']) : 1;
$initial_date = mysqli_real_escape_string($conection, $requestData['initial_date']);
$final_date = mysqli_real_escape_string($conection, $requestData['final_date']);
$gender = isset($_POST['gender']) ? $_POST['gender'] : null;


// Consultas SQL
$columns = 'p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, 
    CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta ';
$table = ' registro_viajes p 
        LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto 
        LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario 
        LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso ';
$where = " WHERE p.tipo_viaje <> 'Especial' ";

// Filtros
(!empty($initial_date) && !empty($final_date)) 
    ? $where .= " AND p.fecha BETWEEN '$initial_date' AND '$final_date' " 
    : $where .= " AND  p.fecha >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ";

($gender !== null && $gender > 0) 
    ? $where .= " AND p.id = '$gender' " 
    : "";

if( !empty($requestData['search']['value']) ) {
    $where .= " AND ( p.id LIKE '%".$requestData['search']['value']."%' OR p.cliente LIKE '%".$requestData['search']['value']."%' OR p.operador LIKE '%".$requestData['search']['value']."%' OR p.semana LIKE '%".$requestData['search']['value']."%' OR sp.nombres LIKE '%".$requestData['search']['value']."%' OR sp.apellido_paterno LIKE '%" . $requestData['search']['value'] . "%' OR sp.apellido_materno LIKE '%".$requestData['search']['value']."%' OR p.fecha LIKE '%".$requestData['search']['value']."%' )";
};

$orderColumn = $columnsOrder[$requestData['order'][0]['column']] ?? 'p.id';
$orderDir = $requestData['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

// Conteo total
$count_sql = "SELECT COUNT(*) AS total FROM $table $where";
$totalData = $conection->query($count_sql)->fetch_assoc()['total'] ?? 0;

$sql = "SELECT $columns FROM $table $where ORDER BY $orderColumn $orderDir LIMIT $start, $length";
// echo $sql; // Debugging: Ver la consulta SQL generada
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
        'estatusped' => $Estatusnew
    ];
}

// Respuesta JSON
header('Content-Type: application/json');
echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalData,
    "records" => $data
], JSON_UNESCAPED_UNICODE);
?>
