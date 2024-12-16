<?php
include '../config/db-config.php';
session_start();

global $connection;
if ($_REQUEST['action'] == 'fetch_users'){
    $requestData = $_REQUEST;

    $start = $requestData['start'];
    $length = $requestData['length'];
    $initial_date = $requestData['initial_date'];
    $final_date = $requestData['final_date'];
    $gender = $requestData['gender'];

    if (!empty($initial_date) && !empty($final_date)) {
        $date_range = "AND p.fecha BETWEEN '" . $initial_date . "' AND '" . $final_date . "' ";
    } else {
        $date_range = "";
    }

    if ($gender != "") {
        $gender = " AND YEAR(p.fecha) = '$gender' ";
    }
    
    $columns = ' p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, 
    p.num_unidad, p.personas, p.estatus, 
    CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", sp.apellido_materno) AS name, 
    us.nombre AS jefeo, p.ruta, p.direccion, p.destino, p.costo_viaje, 
    p.sueldo_vuelta, p.tipo_viaje';
    
    $table = ' registro_viajes p 
    LEFT JOIN clientes ct ON p.cliente = ct.nombre_corto
    LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario
    LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso';
    
    $where = " WHERE p.tipo_viaje LIKE '%Especial%' " . $date_range . $gender;

    // Filtrar por búsqueda
    if (!empty($requestData['search']['value'])) {
        $where .= " AND (cliente LIKE '%" . $requestData['search']['value'] . "%' ";
        $where .= " OR p.id LIKE '%" . $requestData['search']['value'] . "%' ";
        $where .= " OR tipo_viaje LIKE '%" . $requestData['search']['value'] . "%' ";
        $where .= " OR direccion LIKE '%" . $requestData['search']['value'] . "%' ";
        $where .= " OR destino LIKE '%" . $requestData['search']['value'] . "%'  )";
    }

    // Obtener el total de registros sin LIMIT (para el conteo total de páginas)
    $sql_total = "SELECT COUNT(*) FROM " . $table . $where;
    $result_total = mysqli_query($connection, $sql_total);
    $row_total = mysqli_fetch_array($result_total);
    $totalData = $row_total[0];
    
    // Consulta con LIMIT y OFFSET para la paginación
    $sql = "SELECT " . $columns . " FROM " . $table . $where;
    
    if (!empty($requestData['order'][0]['column'])) {
        $sql .= " ORDER BY " . $columns_order[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];
    }
    if ($length != "-1") {
        $sql .= " LIMIT " . $start . ", " . $length;
    }
    
    // Ejecutar la consulta con paginación
    $result = mysqli_query($connection, $sql);
    
    $data = array();
    $counter = $start;

    // Procesar los resultados
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
    
        $counter++;
    
        $nestedData['counter'] = $counter;
        $nestedData['pedidono'] = $row["id"];
        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id=' . $row["id"] . '" target="_blank">' . $row["id"] . '</a>';
        
        $time = strtotime($row["fecha"]);
        $time2 = strtotime($row["hora_inicio"]);
        $time3 = strtotime($row["hora_fin"]);
        
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $nestedData['horainicio'] = date('H:i', $time2);
        $nestedData['horafin'] = date('H:i', $time3);
        $nestedData['nosemana'] = $row["semana"];
    
        $nestedData['razonsocial'] = utf8_encode($row["cliente"]);
        $nestedData['rutacte'] = utf8_encode($row["ruta"]);
        
        $time2 = strtotime($row["fechacomp"]);
        $nestedData['fechacomp'] = date('d M, Y', $time2);
    
        $nestedData['conductor'] = utf8_encode($row["operador"]);
        $nestedData['tipounidad'] = utf8_encode($row["unidad"]);
        $nestedData['nounidad'] = utf8_encode($row["numero_unidades"]);
        $nestedData['supervisor'] = utf8_encode($row["name"]);
        $nestedData['jefeopera'] = utf8_encode($row["jefeo"]);
        $nestedData['origen'] = utf8_encode($row["direccion"]);
        $nestedData['Destino'] = utf8_encode($row["destino"]);
        $nestedData['Costo'] = $row["costo_viaje"];
        $nestedData['Valor_vuelta'] = $row["sueldo_vuelta"];
        $nestedData['Datenew'] = $row["fecha"];
        $nestedData['TipoViaje'] = utf8_encode($row["tipo_viaje"]);
        $nestedData['estatusped'] = $Estatusnew;
    
        // Se añade el dato al array
        $data[] = $nestedData;
    }

    // Configuración del encabezado de respuesta JSON
    header('Content-Type: application/json; ');

    // Estructura final del JSON con los datos
    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalData),  // Aquí puedes agregar la variable `$totalFiltered` si la necesitas
        "records" => $data
    );

    // Se devuelve la respuesta en formato JSON
    echo json_encode($json_data);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("JSON encoding error: " . json_last_error_msg());
    }
}
?>
