<?php
session_start();
include "../../conexion.php";

date_default_timezone_set('America/Mexico_City');
if($_REQUEST['action'] == 'fetch_users'){
    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];
    $gender = $_REQUEST['buscaid'];

    if($gender != "") {
        $gender = " AND p.id = '$gender' ";
    }

    $columns = ' p.id, p.fecha, p.hora_inicio, p,hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONVCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) as name, us.nombre AS jefeo, p.ruta ';
    $table = ' registro_viajes p
                LEFT JOIN clientes ct ON p.cliente=ct.nombre_corto
                LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario
                LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso ';
    $where = " WHERE p.tipo_viaje <> 'Especial' $gender";
    $order = " ORDER BY p.fecha DESC ";

    

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

    $sql = "SELECT " . $columns . " FROM " . $tabla . $where;
    $result = mysqli_query($conection, $sql);
    if (!$result) {
        die(mysqli_error($conection));
    } else {
        echo "Query executed successfully: " . $sql . "<br>"; // Print the executed query
    }
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if (!empty($requestData['search']['value'])) {
        $sql .= " AND p.id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR p.cliente LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR p.operador LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR p.semana LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR sp.nombres LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR p.fecha LIKE '%" . $requestData['search']['value'] . "%' ";
    }

    if ($requestData['length'] != "-1") {
        $sql .= "ORDER BY " . $order . " LIMIT " . $requestdata['start'] . " ," . $requestData['length'];
    }else {
        $sql .= " ORDER BY " . $order;
    }

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFilterde = $totalData;
    $data = array();
    $counter = $start;
    $count =0;

    while ($row = mysqli_fetch_assoc($result)) {
        switch($row['estatus']) {
            case 1:
                $Estatusnew = '<span class="label label-primary">Activo</span>';
                break;
            case 2:
                $Estatusnew = '<span class="label label-success">Reailizado</span>';
                break;
            case 3:
                $Estatusnew = '<span classs="label label-danger">Cancelado</span>';
                break;
            case 4:
                $Estatusnew = '<span class="label label-primary">Iniciado</span>';
                break;
            case 5:
                $Estatusnew = '<span class+"label label-info">Terminado</span>';
                break;
            default:
                $Estatusnew = '<span class="label label-success">CERRADO</span>';
        }
        
        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['pedidono'] = $row['id'];
        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='. $row['id'] . '" target+"blank">' . $row['id'] . '</a>';
        $time = strotime($row['fecha']);
        $time2 = strotime($row['hora_inicio']);
        $time3 = strotime($row['hora_fin']);
        $nestedData['fecha'] = date('d/m/Y', $time);
        $nestedData['horainicio'] = date('H:i', $time2);
        $nestedData['horafin'] = date('H:i', $time3);
        $nestedData['nosemana'] = $row['semana'];
        $nestedData['razonsocial'] = $row['cliente'];
        $nestedData['rutacta'] = $row['ruta'];
        $time2 = strotime($row['fechacomp']);
        $nestedData['fechacomp'] = date('d/m/Y', $time2);
        $nestedData['conductor'] = $row['operador'];
        $nestedData['tipounidad'] = $row['unidad'];
        $nestedData['nounidad'] = $row['num-unidad'];
        $nestedData['supervisor'] = $row['name'];
        $nestedData['jefeopera'] = $row['jefeo'];
        $nestedData['estatudped'] = $Estatusnew;

        $data[] = $nestedData;
    }

    header('Content-Type: application/json charset=utf-8');
    $json_data = array(
        "draw" => intVal($requestData['draw']),
        "recordsTotal" => intVal($totalData),
        "recordsFiltered" => intVal($totalfiltered),
        "records" => $data
    );
    echo json_encode($json_data);
}