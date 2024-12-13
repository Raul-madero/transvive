<?php
session_start();
include '../config/db-config.php';

global $connection;

if ($_REQUEST['action'] === 'fetch_users') {
    $requestData = $_REQUEST;
    $start = filter_var($_REQUEST['start'], FILTER_VALIDATE_INT) ?: 0;
    $length = filter_var($_REQUEST['length'], FILTER_VALIDATE_INT) ?: 10;
    $initial_date = filter_var($_REQUEST['initial_date'], FILTER_SANITIZE_STRING);
    $final_date = filter_var($_REQUEST['final_date'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_VALIDATE_INT);

    $date_range = (!empty($initial_date) && !empty($final_date)) ? " AND p.fecha BETWEEN ? AND ?" : "";
    $gender_filter = ($gender > 0) ? " AND p.id = ?" : "";

    $columns = 'p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta';
    $table = 'registro_viajes p 
              LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto 
              LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario 
              LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    $where = "WHERE p.tipo_viaje <> 'Especial' AND YEAR(p.fecha) = YEAR(CURDATE()) $date_range $gender_filter";

    $sql = "SELECT $columns FROM $table $where LIMIT $length";
    $stmt = $connection->prepare($sql);

    $params = [];
    if (!empty($initial_date) && !empty($final_date)) {
        $params[] = $initial_date;
        $params[] = $final_date;
    }
    if ($gender > 0) {
        $params[] = $gender;
    }
    $params[] = $start;
    $params[] = $length;

    $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    function getStatusLabel($estatus) {
        $labels = [
            1 => '<span class="label label-primary">Activo</span>',
            2 => '<span class="label label-success">Realizado</span>',
            3 => '<span class="label label-danger">Cancelado</span>',
            4 => '<span class="label label-primary">Iniciado</span>',
            5 => '<span class="label label-info">Terminado</span>',
            6 => '<span class="label label-success">CERRADO</span>'
        ];
        return $labels[$estatus] ?? '<span class="label label-default">Desconocido</span>';
    }
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $Estatusnew = getStatusLabel($row['estatus']);
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
    
    header('Content-Type: application/json; charset=utf-8');
    $json_data = [
        "draw" => intval($requestData['draw']),
        "recordsTotal" => $result->num_rows,
        "recordsFiltered" => $result->num_rows,
        "records" => $data
    ];

    echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
}
?>
