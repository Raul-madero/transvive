<?php
session_start();
include '../../conexion.php';

global $conection;

if ($_REQUEST['action'] == 'fetch_users') {

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'] ?? "";
    $initial_date = $_REQUEST['initial_date'] ?? "";
    $final_date = $_REQUEST['final_date'] ?? "";
    $gender = $_REQUEST['gender'] ?? "";

    // Filtros de fecha y género
    $date_range = !empty($initial_date) && !empty($final_date) ? " AND p.fecha BETWEEN '$initial_date' AND '$final_date' " : "";
    $gender_filter = !empty($gender) ? " AND p.no_orden = $gender " : "";

    // Columnas de la consulta
    $columns = ' p.id, p.no_orden, p.fecha, p.proveedor, p.area_solicitante, p.contacto, p.telefono, p.total, p.observaciones, p.estatus, pv.nombre ';
    $table = ' orden_compra p INNER JOIN proveedores pv ON p.proveedor = pv.id ';
    $where = " WHERE p.id > 0 $date_range $gender_filter ";

    // Orden de columnas
    $columns_order = array(
        'id', 'no_orden', 'fecha', 'proveedor', 'area_solicitante', 'contacto', 'telefono', 'nombre', 'estatus'
    );

    // Construcción de la consulta SQL
    $sql = "SELECT $columns FROM $table $where";

    // Filtrado de búsqueda
    if (!empty($requestData['search']['value'])) {
        $search_value = $requestData['search']['value'];
        $estatus_mapping = [
            'Cancelada' => 0,
            'Activa' => 1,
            'Cerrada' => 2,
            'Iniciada' => 4,
            'Terminada' => 5
        ];

        $estatus_value = array_key_exists($search_value, $estatus_mapping) ? $estatus_mapping[$search_value] : null;
        
        $sql .= " AND (nombre LIKE '%$search_value%' OR p.area_solicitante LIKE '%$search_value% ' OR p.contacto LIKE '%$search_value%' OR p.observaciones LIKE '%$search_value%' OR p.no_orden LIKE '%$search_value%')";
        if ($estatus_value !== null) {
            $sql .= " OR p.estatus = $estatus_value";
        }
    }

    // Obtención de datos totales filtrados
    $result = mysqli_query($conection, $sql);
    $totalFiltered = mysqli_num_rows($result);

    // Ordenar y limitar datos
    $column_index = $requestData['order'][0]['column'];
    $column_order = $columns_order[$column_index];
    $column_dir = $requestData['order'][0]['dir'];
    $length = $requestData['length'];
    $sql .= " ORDER BY $column_order $column_dir LIMIT $start, $length";

    // Ejecución de la consulta final
    $result = mysqli_query($conection, $sql);
    $data = array();

    while ($row = mysqli_fetch_array($result)) {
        // Asignar etiqueta de estado
        $status_labels = [
            0 => '<span class="label-danger">Cancelado</span>',
            1 => '<span class="label label-primary">Activa</span>',
            2 => '<span class="label label-success">Cerrada</span>',
            3 => '<span class="label label-danger">Cancelado</span>',
            4 => '<span class="label label-primary">Iniciado</span>',
            5 => '<span class="label label-info">Terminado</span>',
            6 => '<span class="label label-success">Cancelada</span>'
        ];
        $estatusnew = $status_labels[$row['estatus']] ?? '<span class="label label-default">Desconocido</span>';

        // Formateo de datos para DataTable
        $data[] = [
            'counter' => ++$start,
            'pedidono' => $row['id'],
            'Folio' => $row['no_orden'],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id='.$row['id'].'" target="_blank">'.$row['id'].'</a>',
            'fechaa' => date('d/m/Y', strtotime($row['fecha'])),
            'nameproveedor' => $row['nombre'],
            'arear' => $row['area_solicitante'],
            'contacto' => $row['contacto'],
            'telefono' => $row['telefono'],
            'importe' => $row['total'],
            'notas' => $row['observaciones'],
            'Datenew' => $row['fecha'],
            'estatusped' => $estatusnew
        ];
    }

    // Preparar datos JSON
    $json_data = [
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval(mysqli_num_rows(mysqli_query($conection, "SELECT * FROM $table"))),
        "recordsFiltered" => intval($totalFiltered),
        "records" => $data
    ];

    echo json_encode($json_data);
}
?>