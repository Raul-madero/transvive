<?php
session_start();
include '../../conexion.php';
global $conection;

if ($_REQUEST['action'] == 'fetch_users') {
    $requestData = $_REQUEST;
    $start = intval($_REQUEST['start'] ?? 0);
    $initial_date = $_REQUEST['initial_date'] ?? "";
    $final_date = $_REQUEST['final_date'] ?? "";
    $gender = $_REQUEST['gender'] ?? "";

    $date_range = (!empty($initial_date) && !empty($final_date))
        ? " AND fecha BETWEEN '$initial_date' AND '$final_date' " : "";

    if ($gender !== "") {
        $estatus_map = ["Abierto" => 1, "Cerrado" => 2, "Cancelada" => 0];
        $gender = isset($estatus_map[$gender]) ? " AND estatus = " . $estatus_map[$gender] : "";
    }

    $columns = ' id, no_queja, fecha, mes, cliente, f8d, descripcion, motivo, responsable, supervisor, operador, unidad, ruta, parada, fecha_incidente, turno, procede_ac, porque_procede, analisis_conclusionac, accion, fecha_accion, responsable_accion, fecha_cierre, observaciones, tipo_incidente, estatus, cuenta, causa, afecta, area_responsable ';
    $table = ' no_conformidades ';
    $where = " WHERE id > 0 " . $date_range . $gender;

    $columns_order = [
        0 => 'id',
        1 => 'no_queja',
        2 => 'fecha',
        3 => 'cliente',
        4 => 'responsable',
        5 => 'supervisor',
        6 => 'operador',
        7 => 'unidad',
        8 => 'estatus'
    ];

    $sql = "SELECT $columns FROM $table $where";

    if (!empty($requestData['search']['value'])) {
        $search = $conection->real_escape_string($requestData['search']['value']);
        $sql .= " AND (no_queja LIKE '%$search%' OR cliente LIKE '%$search%' OR unidad LIKE '%$search%')";
    }

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $order_column = $columns_order[$requestData['order'][0]['column']] ?? 'id';
    $order_dir = $requestData['order'][0]['dir'] ?? 'DESC';
    $sql .= " ORDER BY $order_column $order_dir";

    if ($requestData['length'] != "-1") {
        $length = intval($requestData['length']);
        $sql .= " LIMIT $start, $length";
    }

    $result = mysqli_query($conection, $sql);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $nestedData = [
            'num_queja'    => $row['no_queja'],
            'name_mes'     => $row['mes'],
            'date'         => $row['fecha'] ? date('d/m/Y', strtotime($row['fecha'])) : '',
            'name_cliente' => $row['cliente'],
            'formato'      => $row['f8d'],
            'describe'     => $row['descripcion'],
            'motivonc'     => $row['motivo'],
            'respnc'       => $row['responsable'],
            'supervnc'     => $row['supervisor'],
            'operador'     => $row['operador'],
            'noeco'        => $row['unidad'],
            'rutanc'       => $row['ruta'],
            'estacion'     => $row['parada'],
            'date_incidente' => $row['fecha_incidente'] ? date('d/m/Y', strtotime($row['fecha_incidente'])) : '',
            'turnoi'       => $row['turno'],
            'procedenc'    => $row['procede_ac'],
            'porquenc'     => $row['porque_procede'],
            'analisisnc'   => $row['analisis_conclusionac'],
            'accionnc'     => $row['accion'],
            'date_accion'  => $row['fecha_accion'] ? date('d/m/Y', strtotime($row['fecha_accion'])) : '',
            'respaccion'   => $row['responsable_accion'],
            'date_cierre'  => $row['fecha_cierre'] ? date('d/m/Y', strtotime($row['fecha_cierre'])) : '',
            'notas'        => $row['observaciones'],
            'tipo'         => $row['tipo_incidente'],
            'estatusped'   => $row['estatus'],
            'causanc'      => $row['causa'],
            'afectacte'    => $row['afecta'],
            'deptoresp'    => $row['area_responsable'],
            'links_buttons' => build_links_buttons($_SESSION['rol'], $row['no_queja'], $row['id'])
        ];
        $data[] = $nestedData;
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "draw"            => intval($requestData['draw']),
        "recordsTotal"    => $totalData,
        "recordsFiltered" => $totalFiltered,
        "records"         => $data
    ]);
}

function build_links_buttons($rol, $no_queja, $id) {
    if ($rol == 14) {
        return '<a class="link_edit" href="edit_noconformidad.php?id=' . $no_queja . '" style="color:#007bff;"><i class="far fa-edit"></i></a> | ' .
               '<a href="factura/form_noconformidad.php?id=' . $no_queja . '" target="_blank"><i class="fa fa-print" style="color:#white;font-size:1.3em;"></i></a> | ' .
               '<a data-toggle="modal" data-target="#modalEditcliente" data-id="' . $id . '" data-name="' . $no_queja . '" href="javascript:void(0)" class="link_delete" style="color:red"><i class="fa fa-ban"></i></a>';
    } elseif ($rol == 8) {
        return '<a href="factura/form_noconformidad.php?id=' . $no_queja . '" target="_blank"><i class="fa fa-print" style="color:#white;font-size:1.3em;"></i></a>';
    } else {
        return '<a class="link_edit" href="edit_noconformidad.php?id=' . $no_queja . '" style="color:#007bff;"><i class="far fa-edit"></i></a> | ' .
               '<a href="factura/form_noconformidad.php?id=' . $no_queja . '" target="_blank"><i class="fa fa-print" style="color:#white;font-size:1.3em;"></i></a>';
    }
}
?>
