<?php
session_start();
include '../../conexion.php';

global $conection;

if ($_REQUEST['action'] == 'fetch_users') {
    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'] ?? "";
    $final_date = $_REQUEST['final_date'] ?? "";
    $gender = $_REQUEST['gender'] ?? "";

    $date_range = "";
    if (!empty($initial_date) && !empty($final_date)) {
        $date_range = " AND p.fecha BETWEEN '$initial_date' AND '$final_date' ";
    }

    $estatus_filter = "";
    if ($gender != "") {
        $gender_input = strtolower(trim($gender));
        $estatus_variants = [
            'cancelada' => 0,
            'cancelado' => 0,
            'activa' => 1,
            'activo' => 1,
            'autorizada' => 2,
            'autorizado' => 2,
            'procesada' => 3,
            'procesado' => 3,
            'facturado' => 4,
            'pagado' => 5,
        ];
        $gender_value = $estatus_variants[$gender_input] ?? null;
        if ($gender_value !== null) {
            $estatus_filter = " AND p.estatus = $gender_value ";
        }
    }

    $columns = ' p.id, p.no_requisicion, p.fecha, p.fecha_requiere, p.tipo_requisicion, p.area_solicitante, p.cant_autorizada, p.observaciones, p.estatus, o.no_orden, o.fecha AS fecha_orden, f.no_factura, f.fecha AS fecha_factura, pg.fecha AS fecha_pago';
    $table = ' requisicion_compra p LEFT JOIN orden_compra o ON o.no_requisicion = p.no_requisicion LEFT JOIN facturas f ON f.no_requisicion = o.no_requisicion LEFT JOIN pagos_proveedor pg ON pg.no_requisicion = o.no_requisicion';
    $where = " WHERE p.id > 0 $date_range $estatus_filter";

    $columns_order = array(
        0 => 'id',
        1 => 'no_requisicion',
        2 => 'fecha',
        3 => 'fecha_requiere',
        4 => 'tipo_requisicion',
        5 => 'area_solicitante',
        6 => 'estatus'
    );

    $sql = "SELECT $columns FROM $table $where";

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if (!empty($requestData['search']['value'])) {
        $search = $requestData['search']['value'];
        $search_lower = strtolower(trim($search));

        $estatus_mapping = [
            'cancelada' => 0,
            'cancelado' => 0,
            'activa' => 1,
            'activo' => 1,
            'autorizada' => 2,
            'autorizado' => 2,
            'procesada' => 3,
            'procesado' => 3,
            'facturado' => 4,
            'pagado' => 5,
            'recibido' => 6,
            'facturadooc' => 7,
            'porpagar' => 8
        ];

        $estatus_value = $estatus_mapping[$search_lower] ?? null;

        $sql .= " AND (
            LOWER(p.no_requisicion) LIKE '%$search_lower%' OR
            LOWER(p.tipo_requisicion) LIKE '%$search_lower%' OR
            LOWER(p.area_solicitante) LIKE '%$search_lower%' OR
            LOWER(p.observaciones) LIKE '%$search_lower%' OR
            LOWER(o.no_orden) LIKE '%$search_lower%'
        )";

        if ($estatus_value !== null) {
            $sql .= " OR estatus = $estatus_value";
        }
    }

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY " . $columns_order[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    if ($requestData['length'] != "-1") {
        $sql .= " LIMIT " . $requestData['start'] . "," . $requestData['length'];
    }

    $result = mysqli_query($conection, $sql);
    $data = array();
    $count = $start;

    while ($row = mysqli_fetch_array($result)) {
        // var_dump($row);
        switch ($row['estatus']) {
            case 1:
                $Estatusnew = '<span class="badge bg-primary">Activa</span>';
                break;
            case 2:
                $Estatusnew = '<span class="badge bg-secondary">Autorizada</span>';
                break;
            case 3:
                $Estatusnew = '<span class="badge bg-success bg-gradient">Procesada</span>';
                break;
            case 4:
                $Estatusnew = '<span class="badge bg-warning">Facturado</span>';
                break;
            case 5:
                $Estatusnew = '<span class="badge bg-info">Pagado</span>';
                break;
            case 6:
                $Estatusnew = '<span class="badge bg-dark">Recibido</span>';
                break;
            case 7:
                $Estatusnew = '<span class="badge bg-info">Facturado OC</span>';
                break;
            case 8:
                $Estatusnew = '<span class="badge bg-danger">Por Pagar</span>';
                break;
            default:
                $Estatusnew = '<span class="badge bg-danger">Cancelada</span>';
                break;
        }

        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['pedidono'] = $row["id"];
        $nestedData['Folio'] = $row["no_requisicion"];
        $nestedData['estatus'] = $row['estatus'];
        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row["id"] . '" target="_blank">' . $row["id"] . '</a>';
        $nestedData['fechaa'] = date('d/m/Y', strtotime($row["fecha"]));
        $nestedData['fecha_req'] = date('d/m/Y', strtotime($row["fecha_requiere"]));
        $nestedData['tipor'] = $row["tipo_requisicion"];
        $nestedData['arear'] = $row['area_solicitante'];
        $nestedData['monto'] = $row['cant_autorizada'];
        $nestedData['notas'] = $row['observaciones'];
        $nestedData['Datenew'] = $row["fecha"];
        $nestedData['estatusped'] = $Estatusnew;
        $nestedData['no_orden'] = $row['no_orden'] ?? 'N/A';
        $nestedData['fecha_orden'] = $row['fecha_orden']?? 'N/A';
        $nestedData['no_factura'] = $row['no_factura']?? 'N/A';
        $nestedData['fecha_factura'] = $row['fecha_factura']?? 'N/A';
        $nestedData['fecha_pago'] = $row['fecha_pago']?? 'N/A';

        $data[] = $nestedData;
    }

    header('Content-Type: application/json; charset=utf-8');
    $json_data = array(
        "draw"            => intval($requestData['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "records"         => $data
    );

    echo json_encode($json_data);
}
?>