<?php
session_start();
include '../../conexion.php';

if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'fetch_users') {
    echo json_encode(['error' => 'Acción no válida.']);
    exit;
}

$requestData = $_REQUEST;
$start = (int)($requestData['start'] ?? 0);
$length = (int)($requestData['length'] ?? 10);
$orderColumnIndex = (int)($requestData['order'][0]['column'] ?? 0);
$orderDir = $requestData['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

$initial_date = $requestData['initial_date'] ?? '';
$final_date = $requestData['final_date'] ?? '';
$gender = $requestData['gender'] ?? '';

$whereClauses = ["p.id > 0"];

if (!empty($initial_date) && !empty($final_date)) {
    $whereClauses[] = "p.fecha BETWEEN '$initial_date' AND '$final_date'";
}

$estatusMap = ['Activa' => 1, 'Cerrada' => 2, 'Cancelada' => 0];
if (!empty($gender) && isset($estatusMap[$gender])) {
    $whereClauses[] = "p.estatus = {$estatusMap[$gender]}";
}

$whereSqlBase = ' WHERE ' . implode(' AND ', $whereClauses);
$columnsOrder = [
    0 => 'p.id',
    1 => 'p.no_orden',
    2 => 'p.fecha',
    3 => 'p.hora',
    4 => 'p.solicitada',
    5 => 'p.unidad',
    6 => 'p.tipo_trabajo',
    7 => 'p.kilometraje',
    8 => 'p.estatus'
];

$sql = "SELECT p.id FROM mantenimiento_preventivo p $whereSqlBase";
$totalResult = mysqli_query($conection, $sql);
$totalData = mysqli_num_rows($totalResult);
$totalFiltered = $totalData;

$searchValue = $conection->real_escape_string($requestData['search']['value'] ?? '');
$whereSqlSearch = $whereSqlBase;

if (!empty($searchValue)) {
    $whereSqlSearch .= " AND (p.no_orden LIKE '%$searchValue%' 
                             OR p.solicitada LIKE '%$searchValue%' 
                             OR p.unidad LIKE '%$searchValue%')";
}

$sql = "SELECT p.id FROM mantenimiento_preventivo p $whereSqlSearch";
$filterResult = mysqli_query($conection, $sql);
$totalFiltered = mysqli_num_rows($filterResult);

$sql = "
    SELECT p.id, p.no_orden, p.fecha, p.hora, p.solicitada, p.unidad, p.tipo_trabajo, p.kilometraje, p.estatus 
    FROM mantenimiento_preventivo p
    $whereSqlSearch
    ORDER BY {$columnsOrder[$orderColumnIndex]} $orderDir
    LIMIT $start, $length
";

$result = mysqli_query($conection, $sql);
$data = [];
$count = $start;

while ($row = mysqli_fetch_assoc($result)) {
    $estatusLabels = [
        1 => '<span class="label label-primary">Activa</span>',
        2 => '<span class="label label-success">Cerrada</span>',
        3 => '<span class="label label-danger">Cancelado</span>',
        4 => '<span class="label label-primary">Iniciado</span>',
        5 => '<span class="label label-info">Terminado</span>',
        0 => '<span class="label label-success">Cancelada</span>'
    ];
    $estatusHtml = $estatusLabels[$row['estatus']] ?? '<span class="label label-default">Desconocido</span>';

    $count++;
    $nestedData = [
        'counter'     => $count,
        'pedidono'    => $row["id"],
        'nopedido'    => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row["id"] . '" target="_blank">' . $row["id"] . '</a>',
        'fechaa'      => date('d/m/Y', strtotime($row["fecha"])),
        'horaa'       => date('H:i', strtotime($row["hora"])),
        'noorden'     => $row["no_orden"],
        'usuario'     => $row['usuario'] ?? '',
        'solicita'    => $row["solicitada"],
        'unidad'      => $row["unidad"],
        'tipojob'     => $row["tipo_trabajo"],
        'kilometraje' => $row["kilometraje"],
        'Datenew'     => $row["fecha"],
        'estatusped'  => $estatusHtml
    ];

    $data[] = $nestedData;
}

// ---------- Conteo por estatus aplicando filtros existentes + búsqueda ----------
$whereForCounts = array_filter($whereClauses, function ($clause) {
    return stripos($clause, 'estatus') === false;
});

$whereBaseCounts = ' WHERE ' . implode(' AND ', $whereForCounts);

if (!empty($searchValue)) {
    $whereBaseCounts .= " AND (p.no_orden LIKE '%$searchValue%' 
                             OR p.solicitada LIKE '%$searchValue%' 
                             OR p.unidad LIKE '%$searchValue%')";
}

function getCountByStatus($conection, $whereBaseCounts, $estatus)
{
    $sql = "SELECT COUNT(*) as total FROM mantenimiento_preventivo p $whereBaseCounts AND p.estatus = $estatus";
    $result = mysqli_query($conection, $sql);
    $row = mysqli_fetch_assoc($result);
    return (int)($row['total'] ?? 0);
}

$count_activa = getCountByStatus($conection, $whereBaseCounts, 1);
$count_cerrada = getCountByStatus($conection, $whereBaseCounts, 2);
$count_cancelada = getCountByStatus($conection, $whereBaseCounts, 0);

$json_data = [
    "draw"            => (int)($requestData['draw'] ?? 0),
    "recordsTotal"    => $totalData,
    "recordsFiltered" => $totalFiltered,
    "estatus_counts"  => [
        "activa"    => $count_activa,
        "cerrada"   => $count_cerrada,
        "cancelada" => $count_cancelada
    ],
    "records"         => $data
];

echo json_encode($json_data);
?>
