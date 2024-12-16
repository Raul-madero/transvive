<?php
include '../config/db-config.php';
session_start();

global $connection;
if ($_REQUEST['action'] == 'fetch_users'){
    $requestData = $_REQUEST;

    $start = $requestData['start'];
    $initial_date = $requestData['initial_date'];
    $final_date = $requestData['final_date'];
    $gender = $requestData['gender'];

    if (!empty($initial_date) && !empty($final_date)) {
        $date_range = "AND p.fecha BETWEEN '" . $initial_date . "' AND '" . $final_date . "' ";
    }else {
        $date_range = "";
    }

    if ($gender != "") {
        $gender = " AND YEAR(p.fecha) = '$gender' ";
    }
    $columns = ' p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, 
    p.num_unidad, p.personas, p.estatus, 
    CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno)
    AS name, 
    us.nombre AS jefeo, p.ruta, p.direccion, p.destino, p.costo_viaje, 
    p.sueldo_vuelta, p.tipo_viaje';
    $table = ' registro_viajes p 
    LEFT JOIN clientes ct ON p.cliente=ct.nombre_corto
    LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario
    LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso' ;
    $where = " WHERE p.tipo_viaje LIKE '%Especial%' ".$date_range.$gender;

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

    $sql = "SELECT " . $columns . " FROM " . $table . $where;
    echo $sql;
    echo "Número de filas: " . mysqli_num_rows($result);
    while($row = mysqli_fetch_assoc($result)) {
    echo $row;
    }
    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    echo $totalData;
    $totalFiltered = $totalData;
    $data = array();
    $counter = $start;

    if (!empty($requestData['search']['value'])) {
        $sql .= " AND (cliente LIKE '%" .$requestData['search']['value'] . "%' ";
        $sql .= " OR p.id LIKE '%" .$requestData['search']['value'] . "%' ";
        $sql .= " OR tipo_viaje LIKE '%" .$requestData['search']['value'] . "%' ";
        $sql .= " OR direccion LIKE '%" .$requestData['search']['value'] . "%' ";
        $sql .= " OR destino LIKE '%" .$requestData['search']['value'] . "%'  )";

        if (!empty($requestData['order'][0]['column'])) {
            $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']] ." ".$requestData['order'][0]['dir'];
        }
        if ($requestData['length'] != "-1") {
            $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'];
        }
        $result = mysqli_query($connection, $sql);
        $totalData = mysqli_num_rows($result);
        $totalFiltered = $totalData;
    }

    $data = array();
    $counter = $start;
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['estatus']) {
            case 1:
                $Estatusnew = '<span class="label label-primary">Activo</span>';
                break;
            case 2:
                $Estatusnew = '<span class="label label-success">Realizado</span>';
                break;
            case 3:
                $Estatusnew = '<span class="label label-danger">Cancelado</span>';
                break;
            case 4:
                $Estatusnew = '<span class="label label-primary">Iniciado</span>';
                break;
            case 5:
                $Estatusnew = '<span class="label label-info">Terminado</span>';
                break;
            default:
                $Estatusnew = '<span class="label label-success">CERRADO</span>';
        }

        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['pedidono'] = $row["id"];

        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row["id"] . '" target="_blank">' . $row["id"] . '</a>';
        $time = strtotime($row["fecha"]);
        $time2 = strtotime($row["hora_inicio"]);
        $time3 = strtotime($row["hora_fin"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $nestedData['horainicio'] = date('H:i', $time2);
        $nestedData['horafin'] = date('H:i', $time3);
        $nestedData['nosemana'] = $row["semana"];

        $nestedData['razonsocial'] = $row["cliente"];
        $nestedData['rutacte'] = $row["ruta"];
        $time2 = strtotime($row["fechacomp"]);
        $nestedData['fechacomp'] = date('d M, Y', $time);

        $nesteData['conductor'] = $row["operador"];
        $nestedData['tipounidad'] = $row["unidad"];
        $nestedData['nounidad'] = $row["numero_unidades"];
        $nestedData['supervisor'] = $row["name"];
        $nestedData['jefeopera'] = $row["jefeo"];
        $nestedData['origen'] = $row["direccion"];
        $nestedData['Destino'] = $row["destino"];
        $nestedData['Costo'] = $row["costo_viaje"];
        $nestedData['Valor_vuelta'] = $row["sueldo_vuelta"];
        $nestedData['Datenew'] = $row["fecha"];
        $nestedData['TipoViaje'] = $row["tipo_viaje"];

        $nestedData['estatusped'] = $Estatusnew;

    }
    $data[] = $nestedData;

    echo $data;

    header('Content-Type: application/json; charset=utf-8');
    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "records" => $data
    );

    echo json_encode($json_data);
}
?>'