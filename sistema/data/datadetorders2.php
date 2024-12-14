<?php
session_start();
include '../config/db-config.php';

global $connection;

if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'fetch_users') {
    echo json_encode(["error" => "Acción no válida o no proporcionada."]);
    exit;
}

$requestData = $_REQUEST;
error_log(print_r($_REQUEST['initial_date'], true));

$start = isset($requestData['start']) ? intval($requestData['start']) : 0;
$length = isset($requestData['length']) ? intval($requestData['length']) : 10;
$draw = isset($requestData['draw']) ? intval($requestData['draw']) : 1;
$initial_date = filter_var($requestData['initial_date'], FILTER_SANITIZE_STRING);
$final_date = filter_var($requestData['final_date'], FILTER_SANITIZE_STRING);
$gender = isset($_POST['gender']) ? intval($_POST['gender']) : null;

// Filtros
$date_range = (!empty($initial_date) && !empty($final_date)) 
    ? " AND p.fecha BETWEEN '$initial_date' AND '$final_date'" 
    : "";
$gender_filter = ($gender !== null && $gender > 0) 
    ? " AND p.id = '$gender'" 
    : "";

// Consultas SQL
$columns = 'p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, 
    CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta';
$table = 'registro_viajes p 
          LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto 
          LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario 
          LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
$where = "WHERE p.tipo_viaje <> 'Especial' AND YEAR(p.fecha) = YEAR(CURDATE()) $date_range $gender_filter";

// Conteo total
$count_sql = "SELECT COUNT(*) AS total FROM $table $where";
$totalData = $connection->query($count_sql)->fetch_assoc()['total'] ?? 0;

// Datos con paginación
try {
    $stmt = $pdo->prepare("SELECT $columns FROM $table $where ORDER BY p.fecha DESC LIMIT :start, :length");
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':length', $length, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch(PDOException $e) {
    // Handle exceptions (e.g., log the error, display an error message)
    echo "Error: " . $e->getMessage();
}

if (!$result) {
    echo json_encode(["error" => $connection->error]);
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
