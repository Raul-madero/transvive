<?php
session_start();
include '../../conexion.php';

if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'fetch_users') {
    echo json_encode(["error" => "Acción no válida o no proporcionada."]);
    exit;
}
$requestData = $_REQUEST;
$columns = array(
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

$start = isset($requestData['start']) ? intval($requestData['start']) : 0;
$length = isset($requestData['length']) ? intval($requestData['length']) : 10;
$initial_date = isset($requestData['initial_date']) ? $requestData['initial_date'] : null;
$final_date = isset($requestData['final_date']) ? $requestData['final_date'] : null;
$year = isset($requestData['gender']) ? $requestData['gender'] : null; // Cambiado a 'year'
$draw = isset($requestData['draw']) ? intval($requestData['draw']) : 1;

$columns = ' p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno)AS name, us.nombre AS jefeo, p.ruta, p.direccion, p.destino, p.costo_viaje, p.sueldo_vuelta, p.tipo_viaje';
$table = ' registro_viajes p LEFT JOIN clientes ct ON p.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
$where = "WHERE p.tipo_viaje LIKE '%Especial%'";

(!empty($initial_date) && !empty($final_date)) 
    ? $where .= " AND p.fecha BETWEEN '$initial_date' AND '$final_date'" : $where .= " AND p.fecha >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";


// Validar que $year sea un número entero positivo
(is_numeric($year) && $year > 0 && $year == intval($year)) ?
    $where .= " AND YEAR(p.fecha) = '$year'" : "";


if (!empty($requestData['search']['value'])) {
    $searchValue = $requestData['search']['value'];
    $where .= " AND (p.id LIKE '%$searchValue%'
                OR p.cliente LIKE '%$searchValue%' 
                OR p.operador LIKE '%$searchValue%' 
                OR p.semana LIKE '%$searchValue%' 
                OR sp.nombres LIKE '%$searchValue%' 
                OR sp.apellido_paterno LIKE '%$searchValue%' 
                OR sp.apellido_materno LIKE '%$searchValue%' 
                OR p.fecha LIKE '%$searchValue%')";
}
$orderColumn = $_POST['order_column'];
$orderDir = $_POST['order_dir'];

$allowed_columns = array("p.id", "p.fecha", "p.cliente", "p.direccion", "p.unidad", "p.destino", "us.nombre", "p.estatus"); // Agrega aquí todas las columnas permitidas
if (!in_array($order_column, $allowed_columns)) {
  $order_column = "fecha"; // Columna por defecto si la recibida no es válida
}

$count_sql = "SELECT COUNT(*) AS total FROM $table $where";
$totalData = $conection->query($count_sql)->fetch_assoc()['total'] ?? 0;

$sql = "SELECT $columns FROM $table $where ORDER BY `$orderColumn` $orderDir LIMIT $start, $length";
// Imprimir la consulta SQL para depuración
// echo $sql; 

$result = $conection->query($sql);

if (!$result) {
    echo json_encode(["error" => $conection->error]);
    exit;
}

    $totalFiltered = $totalData;
    $data = [];
    while($row = $result->fetch_assoc()) {
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
            'id' => $row['id'],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>',
            'fecha' => date('d/m/Y', strtotime($row["fecha"])),
            'horainicio' => date('H:i', strtotime($row["hora_inicio"])),
            'horafin' => date('H:i', strtotime($row["hora_fin"])),
            'nosemana' => $row["semana"],
            'cliente' => $row["cliente"],
            'rutacte' => $row["ruta"],
            'conductor' => $row["operador"],
            'tipounidad' => $row["unidad"],
            'nounidad' => $row["num_unidad"],
            'supervisor' => $row["name"],
            'jefeopera' => $row["jefeo"],
            'direccion' => $row["direccion"],
            'Destino' => $row["destino"],
            'Costo' => $row["costo_viaje"],
            'Valor_vuelta' => $row["sueldo_vuelta"],
            'Datenew' => $row['fecha'],
            'TipoViaje' => $row['tipo_viaje'],
            'estatusped' => $Estatusnew
        ];
    };
        // echo $sql;
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "draw" => $draw,
        "recordsTotal" => $totalData,
        "recordsFiltered" => $totalFiltered,
        "records" => $data
    ], JSON_UNESCAPED_UNICODE);


?>