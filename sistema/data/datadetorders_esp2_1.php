<?php
include '../config/db-config.php';
session_start();

global $connection;

if ($_REQUEST['action'] == 'fetch_users') {
    // Configuración inicial
    header('Content-Type: application/json; charset=utf-8');

    $requestData = $_REQUEST;

    // Variables de paginación y filtros
    $start = intval($requestData['start'] ?? 0);
    $length = intval($requestData['length'] ?? 10);
    $initial_date = $requestData['initial_date'] ?? '';
    $final_date = $requestData['final_date'] ?? '';
    $gender = $requestData['gender'] ?? '';

    // Filtros opcionales
    $date_range = (!empty($initial_date) && !empty($final_date)) 
        ? "AND p.fecha BETWEEN '" . $initial_date . "' AND '" . $final_date . "' " 
        : "";
    $gender_filter = (!empty($gender)) 
        ? "AND YEAR(p.fecha) = '$gender' " 
        : "";

    // Definición de columnas
    $columns = 'p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, 
        p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, 
        CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) AS name, 
        us.nombre AS jefeo, p.ruta, p.direccion, p.destino, p.costo_viaje, 
        p.sueldo_vuelta, p.tipo_viaje';
    $table = 'registro_viajes p 
        LEFT JOIN clientes ct ON p.cliente=ct.nombre_corto
        LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario
        LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    $where = "WHERE p.tipo_viaje LIKE '%Especial%' $date_range $gender_filter";

    // Ordenamiento
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
    $order_by = "";
    if (!empty($requestData['order'][0]['column'])) {
        $column_index = intval($requestData['order'][0]['column']);
        $order_dir = $requestData['order'][0]['dir'] ?? 'ASC';
        $order_by = " ORDER BY " . $columns_order[$column_index] . " $order_dir";
    }

    // Consulta principal
    $sql = "SELECT $columns FROM $table $where $order_by LIMIT $start, $length";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        echo json_encode(["error" => true, "message" => mysqli_error($connection)]);
        exit();
    }

    // Total de registros sin filtros
    $sql_total = "SELECT COUNT(*) as total FROM $table WHERE p.tipo_viaje LIKE '%Especial%'";
    $total_result = mysqli_query($connection, $sql_total);
    $totalData = $total_result ? mysqli_fetch_assoc($total_result)['total'] : 0;

    // Procesar resultados
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $estatus_label = match ($row['estatus']) {
            1 => '<span class="label label-primary">Activo</span>',
            2 => '<span class="label label-success">Realizado</span>',
            3 => '<span class="label label-danger">Cancelado</span>',
            4 => '<span class="label label-primary">Iniciado</span>',
            5 => '<span class="label label-info">Terminado</span>',
            default => '<span class="label label-success">CERRADO</span>',
        };

        $data[] = [
            'counter' => ++$start,
            'pedidono' => $row['id'],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row["id"] . '" target="_blank">' . $row["id"] . '</a>',
            'fechaa' => date('d/m/Y', strtotime($row["fecha"])),
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
            'origen' => $row["direccion"],
            'Destino' => $row["destino"],
            'Costo' => $row["costo_viaje"],
            'Valor_vuelta' => $row["sueldo_vuelta"],
            'TipoViaje' => $row["tipo_viaje"],
            'estatusped' => $estatus_label,
        ];
    }

    // Estructura final del JSON
    $json_data = [
        "draw" => intval($requestData['draw'] ?? 1),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalData),
        "records" => $data
    ];

    echo json_encode($json_data);
}
?>
