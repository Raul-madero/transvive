<?php
session_start();
include '../config/db-config.php';


global $connection;

if($_REQUEST['action'] == 'fetch_users'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $gender = $_REQUEST['gender'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND p.fecha BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($gender != ""){
       
        $gender = " AND p.folio = $gender ";
    }

    $columns = ' p.id, p.folio, p.fecha, p.nocliente, p.cliente, p.tipo_servicio, p.fecha_servicio, p.ruta_router, p.estatus ';
    $table = ' ordenes_servicio p ' ;
    $where = " WHERE p.id > 0 ".$date_range.$gender ;

    $columns_order = array(
        0 => 'id',
        1 => 'folio',
        2 => 'fecha',
        3 => 'nocliente',
        4 => 'cliente',
        5 => 'tipo_servicio',
        6 => 'fecha_servicio',
        7 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.="AND ( nocliente LIKE '%".$requestData['search']['value']."%' )";
       // $sql.=" OR area_solicitante LIKE '%".$requestData['search']['value']."%'  )";
       
        
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
        $Estatusnew = '<span class="label label-primary">Activa</span>'; 
    }else{
        if ($row['estatus'] == 2){
           $Estatusnew = '<span class="label label-success">Cerrada</span>';
        }else{
            if ($row['estatus'] == 3) {
              $Estatusnew = '<span class="label label-danger">Cancelado</span>';
            }else {
                if ($row['estatus'] == 4) {
                 $Estatusnew = '<span class="label label-primary">Iniciado</span>';
                }else {
                 if ($row['estatus'] == 5) {
                  $Estatusnew = '<span class="label label-info">Terminado</span>';
                 }else {
                  $Estatusnew = '<span class="label label-success">Cancelada</span>';
                 } 
                }     
        }
    }
    }

        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['pedidono'] =  $row["id"];
        $nestedData['Folio'] = $row["folio"];

        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>';
        $time = strtotime($row["fecha"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $time2 = strtotime($row["fecha_servicio"]);
        $nestedData['fechaservicio'] = date('d/m/Y', $time2);
        $nestedData['nocliente'] = $row["nocliente"];
        $nestedData['cliente'] = $row['cliente'];
        $nestedData['tiposervicio'] = $row['tipo_servicio'];
              
        $nestedData['Datenew'] = $row["fecha"];
        $nestedData['rutar'] = $row["ruta_router"];

        $nestedData['estatusped'] = $Estatusnew;

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