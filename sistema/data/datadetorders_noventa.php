<?php
session_start();
include '../../conexion.php';


global $conection;

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

    $columns = ' p.id, p.fecha, p.servicio_solicitado, p.importe, p.cliente, p.descripcion_servicio, p.estatus ';
    $table = ' noventa p ' ;
    $where = " WHERE p.id > 0 ".$date_range.$gender ;

    $columns_order = array(
        0 => 'id',
        1 => 'fecha',
        2 => 'servicio_solicitado',
        3 => 'importe',
        4 => 'cliente',
        5 => 'descripcion_servicio',
        6 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.="AND ( cliente LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR servicio_solicitado LIKE '%".$requestData['search']['value']."%'  )";
       
        
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
       
        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>';
        $time = strtotime($row["fecha"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $nestedData['servicio'] = $row["servicio_solicitado"];
        $nestedData['importe'] = $row['importe'];
        $nestedData['cliente'] = $row['cliente'];
        $nestedData['notas'] = $row['descripcion_servicio'];
              
        $nestedData['Datenew'] = $row["fecha"];

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