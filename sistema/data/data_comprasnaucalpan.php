<?php
session_start();

  include '../config/db-config.php';
 


global $connection;

if($_REQUEST['action'] == 'fetch_users'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    //$gender = $_REQUEST['gender'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND p.fecha BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($gender != ''){
        $gender = " AND estatus = '$gender' ";
    }

    $columns = ' p.id, p.fecha, p.cliente, p.operador, p.ruta, p.semana, p.estatus ';
    $table = ' p.id, p.fecha, p.cliente, p.operador, p.ruta, p.semana, if(p.estatus = 1,"Activo",if(p.estatus = 2, "Realizado", if(p.estatus=3 ,"Cancelado",if(p.estatus=4,"Iniciado",if(p.estatus=5,"Terminado",""))))) as Status ';
    $table = ' registro_viajes p ';
    $where = " WHERE p.tipo_viaje='normal' and p.id !='' ".$date_range ;

    $columns_order = array(
        0 => 'id',
        1 => 'fecha',
        2 => 'cliente',
        3 => 'operador',
        4 => 'ruta',
        5 => 'semana',
        6 => 'estatus'

    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( id LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR cliente LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR operador LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR semana LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR estatus LIKE '".$requestData['search']['value']."'";
        $sql.=" OR ruta LIKE '%".$requestData['search']['value']."%' )";
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }

    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while($row = mysqli_fetch_array($result)){
        if ($row['estatus'] == 1){
        $Estatusnew = '<span class="label label-primary">ACTIVO</span>'; 
    }else{
        if ($row['estatusped'] == 0){
        $Estatusnew = '<span class="label label-danger">CANCELADO</span>';
        }else{
        $Estatusnew = '<span class="label label-success">CERRADO</span>';   
        }
    }
    $gastototal = $gastototal + $row['importetotal'];

        $count++;
        $nestedData = array();

        $nestedData['counter'] = $row["id"];
        $nestedData['pedidono'] =  $row["cliente"];

        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/recibo_gastotol.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>';
        $time = strtotime($row["fecha"]);
        $nestedData['fecha'] = date('d M, Y', $time);

        $nestedData['ruta'] = $row["ruta"];
        $time2 = strtotime($row["fechacomp"]);
        $nestedData['cliente'] = $row["cliente"];
        

        $nestedData['estatus'] = $Estatusnew;
        $nestedData['operador'] = $row["operador"];
        $nestedData['semana'] = $row["semana"];

        $data[] = $nestedData;
    }

    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>