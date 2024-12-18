<?php
include '../../conexion.php';
global $conection;

if($_REQUEST['action'] == 'fetch_users'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    //$gender = $_REQUEST['gender'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND fecha BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($gender != ''){
        $gender = " AND estatus = '$gender' ";
    }

    $columns = " id, fecha, hora_inicio, hora_fin, semana, cliente, operador, unidad, num_unidad, id_supervisor, if(estatus = 1,Activo),if(estatus = 2, Realizado, if(estatus=3 ,Cancelado,if(estatus=4,Iniciado,if(estatus=5,Terminado,''))))) as Status" ;
    $table = ' registro_viajes ';
    $where = " WHERE id !='' ".$date_range ;

    $columns_order = array(
        0 => 'id',
        1 => 'fecha',
        2 => 'hora_inicio',
        3 => 'hora_fin',
        4 => 'semana',
        5 => 'cliente',
        6 => 'operador',
        7 => 'unidad',
        8 => 'num_unidad',
        9 => 'id_supervidor',
        10 => 'Status'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( id LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR fecha LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR semana LIKE '".$requestData['search']['value']."'";
        $sql.=" OR hora_inicio LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR hora_fin LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR cliente LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR operador LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR unidad LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR num_unidad LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR id_supervisor LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR Status LIKE '%".$requestData['search']['value']."%' )";
    }

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }

    $result = mysqli_query($conection, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while($row = mysqli_fetch_array($result)){
        if ($row['estatus'] == 0){
        $Estatusnew = '<span class="label label-primary">ACTIVA</span>'; 
    }else{
        if ($row['estatus'] == 1){
        $Estatusnew = '<span class="label label-success">AUTORIZADA</span>';
        }else{
        $Estatusnew = '<span class="label label-warning">SUSPENDIDA</span>';   
        }
    }

        $count++;
        $nestedData = array();

        $nestedData['counter']     =  $row["id"];
        $time = strtotime($row["fecha"]);
        $nestedData['fecha'] = date('d/m/Y', $time);
        //*$nestedData['hora_inicio'] =  $row["hora_inicio"];
        //*$nestedData['hora_fin'] =  $row["hora_fin"];
        //*$nestedData['semana'] =  $row["semana"];
        //*$nestedData['cliente']    =  $row["cliente"];
        //*$nestedData['operador']    =  $row["operador"];
        //$nestedData['serie_requiere'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["serie_requiere"]).'" target="_blank">'.($row["serie_requiere"]).'</a>';
        
        //*$nestedData['unidad'] = $row["unidad"];
        //*$nestedData['num_unidad'] = $row["num_unidad"];
        //*$nestedData['id_supervisor'] = $row["id_supervisor"];
    
        //*$nestedData['estatus'] = $row["Status"];

       
        //*$data[] = $nestedData;
    }
    header('Content-Type: application/json; charset=utf-8');
    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>