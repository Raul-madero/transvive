<?php
session_start();
include '../config/db-config.php';

global $connection;

if ($_REQUEST['action'] === 'fetch_users') {
    $requestData = $_REQUEST;
    $start = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 0;
    $length = isset($_REQUEST['length']) ? intval($_REQUEST['length']) : 10;
    $draw = isset($_REQUEST['draw']) ? intval($_REQUEST['draw']) : 1;
    $initial_date = filter_var($_REQUEST['initial_date'], FILTER_SANITIZE_STRING);
    $final_date = filter_var($_REQUEST['final_date'], FILTER_SANITIZE_STRING);
    $gender = isset($_POST['gender']) ? intval($_POST['gender']) : null;

    $date_range = (!empty($initial_date) && !empty($final_date)) 
        ? " AND p.fecha BETWEEN ? AND ?" 
        : "";

    $gender_filter = ($gender !== null && $gender > 0) 
        ? " AND p.id = ?" 
        : "";

    $columns = 'p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta';
    $table = 'registro_viajes p 
              LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto 
              LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario 
              LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    $where = "WHERE p.tipo_viaje <> 'Especial' AND YEAR(p.fecha) = YEAR(CURDATE()) $date_range $gender_filter";

    // Preparar consulta principal para conteo total
    $count_sql = "SELECT COUNT(*) AS total FROM $table $where";
    $stmt_count = $connection->prepare($count_sql);

    if ($stmt_count === false) {
        echo json_encode(["error" => "Error al preparar la consulta de conteo."]);
        exit;
    }

    // Asociar parámetros si es necesario
    if (!empty($initial_date) && !empty($final_date) && $gender !== null) {
        $stmt_count->bind_param("ssi", $initial_date, $final_date, $gender);
    } elseif (!empty($initial_date) && !empty($final_date)) {
        $stmt_count->bind_param("ss", $initial_date, $final_date);
    }

    $stmt_count->execute();
    $count_result = $stmt_count->get_result();
    $totalData = $count_result->fetch_assoc()['total'] ?? 0;

    // Preparar consulta de datos con paginación
    $sql = "SELECT $columns FROM $table $where LIMIT ?, ?";
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        echo json_encode(["error" => "Error al preparar la consulta de datos."]);
        exit;
    }

    if (!empty($initial_date) && !empty($final_date) && $gender !== null) {
        $stmt->bind_param("ssiii", $initial_date, $final_date, $gender, $start, $length);
    } elseif (!empty($initial_date) && !empty($final_date)) {
        $stmt->bind_param("ssii", $initial_date, $final_date, $start, $length);
    } else {
        $stmt->bind_param("ii", $start, $length);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $Estatusnew = '<span class="label ' . ($row['estatus'] == 1 ? 'label-primary">Activo' :
                          ($row['estatus'] == 2 ? 'label-success">Realizado' : 
                          ($row['estatus'] == 3 ? 'label-danger">Cancelado' :
                          ($row['estatus'] == 4 ? 'label-primary">Iniciado' :
                          ($row['estatus'] == 5 ? 'label-info">Terminado' : 'label-success">CERRADO'))))) . '</span>';

        $data[] = [
            'counter' => ++$start,
            'pedidono' => $row["id"],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . ($row["id"]) . '" target="_blank">' . ($row["id"]) . '</a>',
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

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    echo json_encode([
        "draw" => $draw,
        "recordsTotal" => $totalData,
        "recordsFiltered" => $totalData,
        "records" => $data
    ], JSON_UNESCAPED_UNICODE);
}
?>
