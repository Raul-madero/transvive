<?php
session_start();
include '../config/db-config.php';

global $connection;

if ($_REQUEST['action'] === 'fetch_users') {
    $requestData = $_REQUEST;
    $start = filter_var($_REQUEST['start'], FILTER_VALIDATE_INT);
    $initial_date = filter_var($_REQUEST['initial_date'], FILTER_SANITIZE_STRING);
    $final_date = filter_var($_REQUEST['final_date'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_VALIDATE_INT);

    $date_range = (!empty($initial_date) && !empty($final_date)) 
        ? " AND p.fecha BETWEEN ? AND ?" 
        : "";

    $gender_filter = ($gender > 0) 
        ? " AND p.id = ?" 
        : "";

    $columns = 'p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta';
    $table = 'registro_viajes p 
              LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto 
              LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario 
              LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    $where = "WHERE p.tipo_viaje <> 'Especial' AND YEAR(p.fecha) = YEAR(CURDATE()) $date_range $gender_filter";

    $sql = "SELECT $columns FROM $table $where";
    $stmt = $connection->prepare($sql);

    if (!empty($initial_date) && !empty($final_date) && $gender > 0) {
        $stmt->bind_param("ssi", $initial_date, $final_date, $gender);
    } elseif (!empty($initial_date) && !empty($final_date)) {
        $stmt->bind_param("ss", $initial_date, $final_date);
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
    header('charset=utf-8');
    $json_data = [
        "draw" => intval($requestData['draw']),
        "recordsTotal" => $result->num_rows,
        "recordsFiltered" => $result->num_rows,
        "records" => $data
    ];

    echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
}
?>
