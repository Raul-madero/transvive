<?php
session_start();
include '../../conexion.php';
global $conection;
// var_dump($_SESSION);

if ($_REQUEST['action'] == 'fetch_users') {
    $requestData = $_REQUEST;
    $start = intval($requestData['start']);
    $initial_date = $requestData['initial_date'] ?? "";
    $final_date   = $requestData['final_date'] ?? "";

    // Convertir fechas al formato MySQL si están presentes
    if (!empty($initial_date) && !empty($final_date)) {
        $initial_date_obj = DateTime::createFromFormat('d-m-Y', $initial_date);
        $final_date_obj   = DateTime::createFromFormat('d-m-Y', $final_date);

        if ($initial_date_obj && $final_date_obj) {
            $initial_date = $initial_date_obj->format('Y-m-d');
            $final_date   = $final_date_obj->format('Y-m-d');
        } else {
            // Si alguna fecha no es válida, eliminar el filtro
            $initial_date = "";
            $final_date = "";
        }
    }
    $rol      = $_SESSION['rol']?? "";
    $gender       = $requestData['gender'] ?? "";
    // echo($initial_date . $final_date);
    // Filtro por fechas
    $date_range = "";
    if (!empty($initial_date) && !empty($final_date)) {
        $date_range = " AND p.fecha BETWEEN '$initial_date' AND '$final_date' ";
    }

    // Filtro por estatus (gender)
    $estatus_filter = "";
    if ($gender !== "") {
        $gender_input = strtolower(trim($gender));
        $estatus_variants = [
            'cancelada' => 0, 'cancelado' => 0,
            'activa' => 1, 'activo' => 1,
            'autorizada' => 2, 'autorizado' => 2,
            'procesada' => 3, 'procesado' => 3,
            'facturado' => 4, 'pagado' => 5,
        ];
        $gender_value = $estatus_variants[$gender_input] ?? null;
        if ($gender_value !== null) {
            $estatus_filter = " AND p.estatus = $gender_value";
        }
    }


    $columns = ' p.id, p.no_requisicion, p.fecha, p.fecha_requiere, p.tipo_requisicion, p.area_solicitante, p.cant_autorizada, p.observaciones, p.estatus, o.no_orden, o.fecha AS fecha_orden, f.no_factura, f.fecha AS fecha_factura, pg.fecha AS fecha_pago';
    $table = ' requisicion_compra p LEFT JOIN orden_compra o ON o.no_requisicion = p.no_requisicion LEFT JOIN facturas f ON f.no_requisicion = o.no_requisicion LEFT JOIN pagos_proveedor pg ON pg.no_requisicion = o.no_requisicion';

    // Construcción dinámica del WHERE
    $where = " WHERE p.id > 0 $date_range $estatus_filter";

    switch ($rol) {
        case 1:
            break;
        case 2:
            $where .= " AND p.area_solicitante = 'Servicio' ";
            break;
        case 4:
            $where .= " AND p.area_solicitante = 'Servicio' ";
            break;
        case 5:
            $where .= " AND p.area_solicitante = 'Recursos Humanos' ";
            break;
        case 6:
            $where .= " AND p.area_solicitante = 'Servicio' ";
            break;
        case 7:
            $where .= " AND p.area_solicitante = 'Mantenimiento' ";
            break;
        case 8:
            $where .= " AND p.area_solicitante = 'Servicio' ";
            break;
        // case 9:
        //     $where .= " AND p.area_solicitante = 'Servicio' ";
        //     break;
        case 13:
            $where.= " AND p.area_solicitante = 'Servicio' ";
            break;
        case 14:
            $where.= " AND p.area_solicitante = 'Calidad' ";
            break;
        case 15:
            $where.= " AND p.area_solicitante = 'Monitorista' ";
            break;
        case 16:
            $where.= " AND p.area_solicitante <> 'Administracion' ";
            break;
        case 17:
            $where.= " AND p.area_solicitante = 'Ventas' ";
            break;
        default:
            break;
    }

    // Buscador general
    if (!empty($requestData['search']['value'])) {
        $search = strtolower(trim($requestData['search']['value']));
        $estatus_mapping = [
            'cancelada' => 0, 'cancelado' => 0,
            'activa' => 1, 'activo' => 1,
            'autorizada' => 2, 'autorizado' => 2,
            'procesada' => 3, 'procesado' => 3,
            'facturado' => 4, 'pagado' => 5,
            'recibido' => 6, 'facturadooc' => 7,
            'porpagar' => 8
        ];
        $estatus_value = $estatus_mapping[$search] ?? null;

        $search_condition = "(
            LOWER(p.no_requisicion) LIKE '%$search%' OR
            LOWER(p.tipo_requisicion) LIKE '%$search%' OR
            LOWER(p.area_solicitante) LIKE '%$search%' OR
            LOWER(p.observaciones) LIKE '%$search%' OR
            LOWER(o.no_orden) LIKE '%$search%' OR
            f.no_factura LIKE '%$search%'
        )";

        if ($estatus_value !== null) {
            $search_condition .= " OR p.estatus = $estatus_value";
        }

        $where .= " AND ($search_condition)";
    }

    // Columnas ordenables
    $columns_order = [
        0 => 'p.id',
        1 => 'p.no_requisicion',
        2 => 'p.fecha',
        3 => 'p.fecha_requiere',
        4 => 'p.tipo_requisicion',
        5 => 'p.area_solicitante',
        6 => 'p.estatus'
    ];

    $sql_base = "SELECT $columns FROM $table $where";

    // Total filtrado
    $result = mysqli_query($conection, $sql_base);
    $totalFiltered = mysqli_num_rows($result);

    // Orden y paginación
    $order_col = $columns_order[$requestData['order'][0]['column']] ?? 'p.id';
    $order_dir = $requestData['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';
    $limit = ($requestData['length'] != "-1") ? "LIMIT {$requestData['start']}, {$requestData['length']}" : "";

    $sql_final = "$sql_base ORDER BY $order_col $order_dir $limit";
    // echo($sql_final);
    $result = mysqli_query($conection, $sql_final);

    // Total sin filtros
    $totalResult = mysqli_query($conection, "SELECT COUNT(p.id) FROM requisicion_compra p");
    $totalData = mysqli_fetch_row($totalResult)[0];

    $data = [];
    $count = $start;

    while ($row = mysqli_fetch_assoc($result)) {
        $estatusMap = [
            0 => '<span class="badge bg-danger">Cancelada</span>',
            1 => '<span class="badge bg-primary">Activa</span>',
            2 => '<span class="badge bg-secondary">Autorizada</span>',
            3 => '<span class="badge bg-success bg-gradient">Procesada</span>',
            4 => '<span class="badge bg-warning">Facturado</span>',
            5 => '<span class="badge bg-info">Pagado</span>',
            6 => '<span class="badge bg-dark">Recibido</span>',
            7 => '<span class="badge bg-info">Facturado OC</span>',
            8 => '<span class="badge bg-danger">Por Pagar</span>',
        ];

        $count++;

        $nestedData = [
            'counter'       => $count,
            'pedidono'      => $row["id"],
            'Folio'         => $row["no_requisicion"],
            'estatus'       => $row["estatus"],
            'nopedido'      => '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row["id"] . '" target="_blank">' . $row["id"] . '</a>',
            'fechaa'        => date('d/m/Y', strtotime($row["fecha"])),
            'fecha_req'     => date('d/m/Y', strtotime($row["fecha_requiere"])),
            'tipor'         => $row["tipo_requisicion"],
            'arear'         => $row['area_solicitante'],
            'monto'         => $row['cant_autorizada'],
            'notas'         => $row['observaciones'],
            'Datenew'       => $row["fecha"],
            'estatusped'    => $estatusMap[$row["estatus"]] ?? '<span class="badge bg-secondary">Desconocido</span>',
            'no_orden'      => $row['no_orden'] ?? 'N/A',
            'fecha_orden'   => $row['fecha_orden'] ?? 'N/A',
            'no_factura'    => $row['no_factura']?? 'N/A',
            'fecha_factura' => $row['fecha_factura']?? 'N/A',
            'fecha_pago'    => $row['fecha_pago']?? 'N/A'
        ];


        $data[] = $nestedData;
    }
    // var_dump($data);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "draw"            => intval($requestData['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "records"         => $data
    ]);
}
?>
