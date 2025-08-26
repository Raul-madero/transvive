<?php
session_start();
include '../../conexion.php';

$conection->set_charset('utf8mb4');

// ---- Utilidades de error seguras (PHP 7 friendly) ----
function dt_json_error($draw, $msg) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "draw"            => intval($draw),
        "recordsTotal"    => 0,
        "recordsFiltered" => 0,
        "records"         => [],
        "error"           => $msg
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function q($conn, $sql) {
    $res = mysqli_query($conn, $sql);
    if ($res === false) {
        // Adjunta un fragmento del SQL para depurar (no todo si es largo)
        $snippet = substr($sql, 0, 300) . (strlen($sql) > 300 ? '…' : '');
        dt_json_error(isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 0,
            "SQL error: " . mysqli_error($conn) . " | SQL: " . $snippet);
    }
    return $res;
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'fetch_users') {
    $requestData = $_REQUEST;

    $draw   = isset($requestData['draw']) ? intval($requestData['draw']) : 0;
    $start  = isset($requestData['start']) ? intval($requestData['start']) : 0;
    $length = isset($requestData['length']) ? intval($requestData['length']) : 10;

    $initial_date = isset($requestData['initial_date']) ? trim($requestData['initial_date']) : "";
    $final_date   = isset($requestData['final_date']) ? trim($requestData['final_date']) : "";
    $gender       = isset($requestData['gender']) ? trim($requestData['gender']) : "";

    // Convertir dd-mm-YYYY a YYYY-mm-dd
    if ($initial_date !== "" && $final_date !== "") {
        $d1 = DateTime::createFromFormat('d-m-Y', $initial_date);
        $d2 = DateTime::createFromFormat('d-m-Y', $final_date);
        if ($d1 && $d2) {
            $initial_date = $d1->format('Y-m-d');
            $final_date   = $d2->format('Y-m-d');
        } else {
            $initial_date = "";
            $final_date   = "";
        }
    }

    $rol = isset($_SESSION['rol']) ? intval($_SESSION['rol']) : 0;

    // --- Filtros ---
    $where = " WHERE p.id > 0 ";

    if ($initial_date !== "" && $final_date !== "") {
        // Fechas sobre p.fecha
        $initial_date_sql = mysqli_real_escape_string($conection, $initial_date);
        $final_date_sql   = mysqli_real_escape_string($conection, $final_date);
        $where .= " AND p.fecha BETWEEN '{$initial_date_sql}' AND '{$final_date_sql}' ";
    }

    if ($gender !== "") {
        $gender_input = strtolower(trim($gender));
        $estatus_variants = [
            'cancelada' => 0, 'cancelado' => 0,
            'activa' => 1, 'activo' => 1,
            'autorizada' => 2, 'autorizado' => 2,
            'procesada' => 3, 'procesado' => 3,
            'facturado' => 4, 'pagado' => 5,
        ];
        $gender_value = isset($estatus_variants[$gender_input]) ? $estatus_variants[$gender_input] : null;
        if ($gender_value !== null) {
            $where .= " AND p.estatus = " . intval($gender_value) . " ";
        }
    }

    // Filtro por rol (paréntesis correctos en el OR del rol 7)
    switch ($rol) {
        case 1:  break;
        case 2:
        case 4:
        case 6:
        case 8:
        case 13:
            $where .= " AND p.area_solicitante = 'Servicio' ";
            break;
        case 5:
            $where .= " AND p.area_solicitante = 'Recursos Humanos' ";
            break;
        case 7:
            $where .= " AND (p.area_solicitante = 'Mantenimiento' OR p.area_solicitante = 'Taller' OR p.area_solicitante = 'Laminado') ";
            break;
        case 14:
            $where .= " AND p.area_solicitante = 'Calidad' ";
            break;
        case 15:
            $where .= " AND p.area_solicitante = 'Monitorista' ";
            break;
        case 16:
            $where .= " AND p.area_solicitante <> 'Administracion' ";
            break;
        case 17:
            $where .= " AND p.area_solicitante = 'Ventas' ";
            break;
        default:
            // sin filtro adicional
            break;
    }

    // Buscador general (escapado)
    if (!empty($requestData['search']['value'])) {
        $search = strtolower(trim($requestData['search']['value']));
        $search_esc = mysqli_real_escape_string($conection, $search);

        $estatus_mapping = [
            'cancelada' => 0, 'cancelado' => 0,
            'activa' => 1, 'activo' => 1,
            'autorizada' => 2, 'autorizado' => 2,
            'procesada' => 3, 'procesado' => 3,
            'facturado' => 4, 'pagado' => 5,
            'recibido' => 6, 'facturadooc' => 7,
            'porpagar' => 8
        ];
        $estatus_value = isset($estatus_mapping[$search]) ? intval($estatus_mapping[$search]) : null;

        // Evita LOWER() en numérico: castea no_orden a CHAR
        $where .= " AND ( 
            LOWER(p.no_requisicion) LIKE '%{$search_esc}%' OR
            LOWER(p.tipo_requisicion) LIKE '%{$search_esc}%' OR
            LOWER(p.area_solicitante) LIKE '%{$search_esc}%' OR
            LOWER(p.observaciones) LIKE '%{$search_esc}%' OR
            LOWER(CAST(o.no_orden AS CHAR)) LIKE '%{$search_esc}%' OR
            LOWER(f.no_factura) LIKE '%{$search_esc}%'
        ";
        if ($estatus_value !== null) {
            $where .= " OR p.estatus = {$estatus_value} ";
        }
        $where .= ") ";
    }

    // Columnas seleccionadas
    $columns_select = "
        p.id,
        p.no_requisicion,
        p.fecha,
        p.fecha_requiere,
        p.tipo_requisicion,
        p.area_solicitante,
        p.cant_autorizada,
        p.observaciones,
        p.estatus,
        o.no_orden,
        o.fecha AS fecha_orden,
        o.total,
        f.no_factura,
        f.fecha AS fecha_factura,
        pg.fecha AS fecha_pago,
        e.fecha AS fecha_entrega
    ";

    $from_joins = "
        requisicion_compra p
        LEFT JOIN orden_compra o ON o.no_requisicion = p.no_requisicion
        LEFT JOIN facturas f ON f.no_requisicion = o.no_requisicion
        LEFT JOIN pagos_proveedor pg ON pg.no_requisicion = o.no_requisicion
        LEFT JOIN entradas e ON e.no_orden = o.no_orden
    ";

    // Ordenación defensiva
    $columns_order = [
        0 => 'p.id',
        1 => 'p.no_requisicion',
        2 => 'p.fecha',
        3 => 'p.fecha_requiere',
        4 => 'p.tipo_requisicion',
        5 => 'p.area_solicitante',
        6 => 'p.estatus'
    ];
    $order_col_idx = isset($requestData['order'][0]['column']) ? intval($requestData['order'][0]['column']) : 0;
    $order_col = isset($columns_order[$order_col_idx]) ? $columns_order[$order_col_idx] : 'p.id';
    $order_dir = (isset($requestData['order'][0]['dir']) && strtolower($requestData['order'][0]['dir']) === 'asc') ? 'ASC' : 'DESC';
    $limit_sql = ($length != -1) ? " LIMIT " . intval($start) . ", " . intval($length) . " " : "";

    // --- Totales ---
    $sql_total = "SELECT COUNT(p.id) AS c FROM requisicion_compra p";
    $res_total = q($conection, $sql_total);
    $row_total = mysqli_fetch_assoc($res_total);
    $recordsTotal = isset($row_total['c']) ? intval($row_total['c']) : 0;

    // --- Total filtrado ---
    $sql_filtered = "SELECT COUNT(*) AS c FROM {$from_joins} {$where}";
    $res_filtered = q($conection, $sql_filtered);
    $row_filtered = mysqli_fetch_assoc($res_filtered);
    $recordsFiltered = isset($row_filtered['c']) ? intval($row_filtered['c']) : 0;

    // --- Datos paginados ---
    $sql_data = "SELECT {$columns_select} FROM {$from_joins} {$where} ORDER BY {$order_col} {$order_dir} {$limit_sql}";
    $res_data = q($conection, $sql_data);

    $data = [];
    $count = $start;

    while ($row = mysqli_fetch_assoc($res_data)) {
        $estatusMap = [
            0 => '<span class="badge bg-danger">Cancelada</span>',
            1 => '<span class="badge bg-primary">Activa</span>',
            2 => '<span class="badge bg-secondary">Autorizada</span>',
            3 => '<span class="badge bg-success bg-gradient">Procesada</span>',
            4 => '<span class="badge bg-warning">Facturado</span>',
            5 => '<span class="badge bg-info">Pagado</span>',
            6 => '<span class="badge bg-dark">Recibido</span>',
            7 => '<span class="badge bg-gradient-info">Facturado OC</span>',
            8 => '<span class="badge bg-gradient-danger">Por Pagar</span>',
            9 => '<span class="badge bg-gradient-warning">Pre Autorizada</span>'
        ];

        $count++;

        $noOrdenRaw  = (isset($row['no_orden']) && $row['no_orden'] !== '') ? (string)$row['no_orden'] : null;
        $noOrdenShow = ($noOrdenRaw !== null) ? $noOrdenRaw : 'N/A';

        $folioRaw = isset($row['no_requisicion']) ? (string)$row['no_requisicion'] : '';

        $fechaOrdenShow   = isset($row['fecha_orden'])   ? $row['fecha_orden']   : 'N/A';
        $fechaEntregaShow = isset($row['fecha_entrega']) ? $row['fecha_entrega'] : 'N/A';
        $noFacturaShow    = isset($row['no_factura'])    ? $row['no_factura']    : 'N/A';
        $fechaFacturaShow = isset($row['fecha_factura']) ? $row['fecha_factura'] : 'N/A';
        $fechaPagoShow    = isset($row['fecha_pago'])    ? $row['fecha_pago']    : 'N/A';
        $totalShow        = isset($row['total']) ? floatval($row['total']) : floatval($row['cant_autorizada']);

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
            'monto'         => $totalShow,
            'notas'         => $row['observaciones'],
            'Datenew'       => $row["fecha"],
            'estatusped'    => isset($estatusMap[$row["estatus"]]) ? $estatusMap[$row["estatus"]] : '<span class="badge bg-secondary">Desconocido</span>',

            'no_orden'      => $noOrdenShow,
            'fecha_orden'   => $fechaOrdenShow,
            'no_factura'    => $noFacturaShow,
            'fecha_factura' => $fechaFacturaShow,
            'fecha_pago'    => $fechaPagoShow,
            'fecha_entrega' => $fechaEntregaShow,

            'Foliofull'     => [
                'no_orden' => $noOrdenShow,
                'Folio'    => $folioRaw
            ],
        ];

        $data[] = $nestedData;
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "draw"            => $draw,
        "recordsTotal"    => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "records"         => $data
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}
