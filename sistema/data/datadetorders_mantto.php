<?php
session_start();
require_once '../../conexion.php';

if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'fetch_users') {
    http_response_code(400);
    echo json_encode(['error' => 'Acción inválida']);
    exit;
}

$draw      = intval($_REQUEST['draw'] ?? 0);
$start     = intval($_REQUEST['start'] ?? 0);
$length    = intval($_REQUEST['length'] ?? 10);
$searchRaw = trim($_REQUEST['search']['value'] ?? '');

$initialDate = trim($_REQUEST['initial_date'] ?? '');
$finalDate   = trim($_REQUEST['final_date'] ?? '');
$gender      = trim($_REQUEST['gender'] ?? '');

$statusMap = [
    'Activa'    => 1,
    'Cerrada'   => 2,
    'Cancelada' => 0,
];

$whereClauses = ['p.id > 0'];
$bindParams   = [];
$bindTypes    = '';

if ($initialDate !== '' && $finalDate !== '') {
    $whereClauses[] = 'p.fecha BETWEEN ? AND ?';
    $bindParams[]  = $initialDate;
    $bindParams[]  = $finalDate;
    $bindTypes    .= 'ss';
}

if ($searchRaw !== '') {
    $like = "%{$searchRaw}%";
    $whereClauses[] = '(
        p.no_orden LIKE ? OR
        p.tipo_mantenimiento LIKE ? OR
        p.unidad LIKE ? OR
        p.usuario LIKE ? OR
        p.solicita LIKE ?
    )';
    for ($i = 0; $i < 5; $i++) {
        $bindParams[] = $like;
        $bindTypes   .= 's';
    }
}

// Guarda los filtros sin estatus para contar tipo de mantenimiento correctamente
$whereClausesForType = $whereClauses;
$whereSQLForType = 'WHERE ' . implode(' AND ', $whereClausesForType);
$bindParamsForType = $bindParams;
$bindTypesForType = $bindTypes;

// Filtro de estatus para la tabla principal
if (isset($statusMap[$gender])) {
    $whereClauses[] = 'p.estatus = ?';
    $bindParams[]  = $statusMap[$gender];
    $bindTypes    .= 'i';
}
$whereSQL = 'WHERE ' . implode(' AND ', $whereClauses);

// Conteo total filtrado
$stmt = $conection->prepare("SELECT COUNT(*) AS cnt FROM solicitud_mantenimiento p {$whereSQL}");
if ($bindTypes) {
    $stmt->bind_param($bindTypes, ...$bindParams);
}
$stmt->execute();
$recordsFiltered = intval($stmt->get_result()->fetch_assoc()['cnt'] ?? 0);
$stmt->close();

// Carga de datos paginados
$columnsOrder = [
    0 => 'p.id',
    1 => 'p.no_orden',
    2 => 'p.fecha',
    3 => 'p.usuario',
    4 => 'p.solicita',
    5 => 'p.unidad',
    6 => 'p.tipo_trabajo',
    7 => 'p.tipo_mantenimiento',
    8 => 'p.trabajo_solicitado',
    9 => 'p.estatus',
];
$orderIdx = intval($_REQUEST['order'][0]['column'] ?? 0);
$orderDir = ($_REQUEST['order'][0]['dir'] ?? 'asc') === 'desc' ? 'DESC' : 'ASC';
$orderCol = $columnsOrder[$orderIdx] ?? 'p.id';

$sqlData = <<<SQL
SELECT p.id, p.no_orden, p.fecha, p.usuario, p.solicita,
       p.unidad, p.tipo_trabajo, p.tipo_mantenimiento,
       p.trabajo_solicitado, p.estatus
FROM solicitud_mantenimiento p
{$whereSQL}
ORDER BY {$orderCol} {$orderDir}
LIMIT ?, ?
SQL;
$stmt = $conection->prepare($sqlData);
$paramTypes = $bindTypes . 'ii';
$params     = array_merge($bindParams, [$start, $length]);
$stmt->bind_param($paramTypes, ...$params);
$stmt->execute();
$dataResult = $stmt->get_result();

$data    = [];
$counter = $start;
$labelMap = [
    1 => '<span class="badge bg-primary">Activa</span>',
    2 => '<span class="badge bg-success">Cerrada</span>',
    3 => '<span class="badge bg-warning">En Proceso</span>',
    4 => '<span class="badge bg-info">Iniciado</span>',
    5 => '<span class="badge bg-secondary">Terminado</span>',
    0 => '<span class="badge bg-danger">Cancelada</span>',
];
while ($row = $dataResult->fetch_assoc()) {
    $data[] = [
        'counter'        => ++$counter,
        'pedidono'       => $row['id'],
        'nopedido'       => '<a href="factura/pedidonw.php?id=' . $row['id'] . '" target="_blank">' . $row['id'] . '</a>',
        'fechaa'         => date('d/m/Y', strtotime($row['fecha'])),
        'noorden'        => htmlspecialchars($row['no_orden'] ?? ''),
        'usuario'        => htmlspecialchars($row['usuario'] ?? ''),
        'solicita'       => htmlspecialchars($row['solicita'] ?? ''),
        'unidad'         => htmlspecialchars($row['unidad'] ?? ''),
        'tipojob'        => htmlspecialchars($row['tipo_trabajo'] ?? ''),
        'tipomantto'     => htmlspecialchars($row['tipo_mantenimiento'] ?? ''),
        'trabsolicitado' => htmlspecialchars($row['trabajo_solicitado'] ?? ''),
        'Datenew'        => $row['fecha'],
        'estatusped'     => $labelMap[$row['estatus']] ?? '',
    ];
}
$stmt->close();

// Conteos por estatus global
$statusCounts = ['Activa' => 0, 'Cerrada' => 0, 'Cancelada' => 0];
foreach ($statusMap as $key => $val) {
    $stmt = $conection->prepare(
        "SELECT COUNT(*) AS cnt FROM solicitud_mantenimiento p {$whereSQL} AND p.estatus = ?"
    );
    $stmt->bind_param($bindTypes . 'i', ...array_merge($bindParams, [$val]));
    $stmt->execute();
    $statusCounts[$key] = intval($stmt->get_result()->fetch_assoc()['cnt'] ?? 0);
    $stmt->close();
}

// Conteos por tipo y estatus de mantenimiento (sin estatus filtrado)
$maintStats = [];
$sqlCombo = <<<SQL
SELECT p.tipo_mantenimiento AS tipo, p.estatus, COUNT(*) AS cnt
FROM solicitud_mantenimiento p
{$whereSQLForType}
AND p.tipo_mantenimiento IS NOT NULL AND p.tipo_mantenimiento <> ''
GROUP BY p.tipo_mantenimiento, p.estatus
SQL;
$stmt = $conection->prepare($sqlCombo);
if ($bindTypesForType) {
    $stmt->bind_param($bindTypesForType, ...$bindParamsForType);
}
$stmt->execute();
$resCombo = $stmt->get_result();
while ($r = $resCombo->fetch_assoc()) {
    $tipo    = $r['tipo'];
    if ($tipo === "NO APLICA") {
        $tipo = 'NOAPLICA';
    }
    $estatus = $r['estatus'];
    if (!isset($maintStats[$tipo])) {
        $maintStats[$tipo] = ['Activa'=>0, 'Cerrada'=>0, 'Cancelada'=>0];
    }
    switch ($estatus) {
        case 1: $maintStats[$tipo]['Activa']   = intval($r['cnt']); break;
        case 2: $maintStats[$tipo]['Cerrada']  = intval($r['cnt']); break;
        case 0: $maintStats[$tipo]['Cancelada']= intval($r['cnt']); break;
    }
}
$stmt->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'draw'                      => $draw,
    'recordsTotal'              => $recordsFiltered,
    'recordsFiltered'           => $recordsFiltered,
    'records'                   => $data,
    'activas'                   => $statusCounts['Activa'],
    'cerradas'                  => $statusCounts['Cerrada'],
    'canceladas'                => $statusCounts['Cancelada'],
    'tipoMantenimientoEstatus'  => $maintStats,
]);
exit;
?>