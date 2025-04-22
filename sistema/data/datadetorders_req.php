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
            'iniciado' => 4,
            'terminado' => 5,
        ];
        $gender_value = $estatus_variants[$gender_input] ?? null;
        if ($gender_value !== null) {
            $estatus_filter = " AND p.estatus = $gender_value ";
        }
    }

    $columns = ' p.id, p.no_requisicion, p.fecha, p.fecha_requiere, p.tipo_requisicion, p.area_solicitante, p.cant_autorizada, p.observaciones, p.estatus ';
    $table = ' requisicion_compra p ';
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
            'iniciado' => 4,
            'terminado' => 5,
        ];

        $estatus_value = $estatus_mapping[$search_lower] ?? null;

        $sql .= " AND (
            LOWER(no_requisicion) LIKE '%$search_lower%' OR
            LOWER(tipo_requisicion) LIKE '%$search_lower%' OR
            LOWER(area_solicitante) LIKE '%$search_lower%' OR
            LOWER(observaciones) LIKE '%$search_lower%'
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
        switch ($row['estatus']) {
            case 1:
                $Estatusnew = '<span class="label label-primary">Activa</span>';
                break;
            case 2:
                $Estatusnew = '<span class="label label-success">Autorizada</span>';
                break;
            case 3:
                $Estatusnew = '<span class="label label-danger">Procesada</span>';
                break;
            case 4:
                $Estatusnew = '<span class="label label-primary">Iniciado</span>';
                break;
            case 5:
                $Estatusnew = '<span class="label label-info">Terminado</span>';
                break;
            default:
                $Estatusnew = '<span class="label label-success">Cancelada</span>';
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