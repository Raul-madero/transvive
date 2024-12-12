<?php
session_start();
include '../../conexion.php';

global $connection;

if($_REQUEST['action'] == 'fetch_users') {

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $gender = $_POST['gender'];

    // Rango de fechas
    $date_range = (!empty($initial_date) && !empty($final_date)) ? " AND p.fecha BETWEEN '$initial_date' AND '$final_date' " : "";

    // Filtro de género
    $gender_filter = ($gender > 0) ? " AND p.id = '$gender' " : "";

    $columns = 'p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta';
    $table = 'registro_viajes p 
              LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto 
              LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario 
              LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    $where = "WHERE p.tipo_viaje <> 'Especial' AND YEAR(p.fecha) = YEAR(CURDATE()) $date_range $gender_filter";

    $columns_order = array(
        0 => 'id',
        1 => 'fecha',
        2 => 'hora_inicio',
        3 => 'hora_fin',
        4 => 'semana',
        5 => 'cliente',
        6 => 'ruta',
        7 => 'operador',
        8 => 'unidad',
        9 => 'num_unidad',
        10 => 'name',
        11 => 'jefeo',
        12 => 'estatus'
    );

    // Construcción de la consulta SQL
    $sql = "SELECT $columns FROM $table $where";

    // Filtrar datos
    if (!empty($requestData['search']['value'])) {
        $sql .= " AND (p.id = '".$requestData['search']['value']."' 
                 OR cliente LIKE '%".$requestData['search']['value']."%' 
                 OR operador LIKE '%".$requestData['search']['value']."%' 
                 OR semana LIKE '%".$requestData['search']['value']."%' 
                 OR nombres LIKE '%".$requestData['search']['value']."%')";
    }

    // Obtener datos filtrados
    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    // Ordenar y limitar datos
    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']] ." ". $requestData['order'][0]['dir'];
    if ($requestData['length'] != "-1") {
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }

    // Obtener datos finales
    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;

    while ($row = mysqli_fetch_array($result)) {
        $Estatusnew = '<span class="label ' . ($row['estatus'] == 1 ? 'label-primary">Activo' :
                          ($row['estatus'] == 2 ? 'label-success">Realizado' : 
                          ($row['estatus'] == 3 ? 'label-danger">Cancelado' :
                          ($row['estatus'] == 4 ? 'label-primary">Iniciado' :
                          ($row['estatus'] == 5 ? 'label-info">Terminado' : 'label-success">CERRADO'))))) . '</span>';

        $nestedData = array(
            'counter' => ++$counter,
            'pedidono' => $row["id"],
            'nopedido' => '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>',
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
        );

        $data[] = $nestedData;
    }

    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "records" => $data
    );

    echo json_encode($json_data);
}
?>
