<?php
session_start();
include '../../conexion.php';

if($_REQUEST['action'] == 'fetch_users'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'] ?? "";
    $final_date = $_REQUEST['final_date'] ?? "";
    $gender = $_REQUEST['gender'] ?? "";

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND p.fecha BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($gender != ""){
       
        $gender = " AND p.id = $gender ";
    }

    $columns = ' p.id, p.folio, p.fecha, p.nodesemana, p.estacion, p.nounidad, p.placas, p.operador, p.kmrecorridos, p.litros, p.rendimiento, p.supervisor, p.estatus ';
    $table = ' carga_combustible p ' ;
    $where = " WHERE p.id > 0 and p.estatus = 1 ".$date_range.$gender ;

    $columns_order = array(
        0 => 'fecha',
        1 => 'folio',
        2 => 'id',
        3 => 'nodesemana',
        4 => 'estacion',
        5 => 'nounidad',
        6 => 'placas',
        7 => 'operdor',
        8 => 'kmrecorridos',
        9 => 'litros',
        10 => 'rendimiento',
        11 => 'supervisor',
        12 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.="AND ( nodesemana LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR nounidad LIKE '%".$requestData['search']['value']."%'  ";
        $sql.=" OR operador LIKE '%".$requestData['search']['value']."%'  ";
        $sql.=" OR placas LIKE '%".$requestData['search']['value']."%' )";
       
        
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
        $nestedData['Folio'] = $row["id"];

        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>';
        $time = strtotime($row["fecha"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $nestedData['nosemana'] = $row["nodesemana"];
        $nestedData['estacion'] = $row['estacion'];
        $nestedData['unidad'] = $row["nounidad"];

        $nestedData['placas'] = $row["placas"];
        $nestedData['operador'] = $row["operador"];
        $nestedData['kmrecord'] = $row["kmrecorridos"]; 
        $nestedData['litros'] = $row["litros"]; 
        $nestedData['rinde'] = $row["rendimiento"]; 
        $nestedData['supervisor'] = $row["supervisor"];       
        $nestedData['Datenew'] = $row["fecha"];

        $nestedData['estatusped'] = $Estatusnew;

        $data[] = $nestedData;
    }
    header('Content-Type: application/json charset=utf-8');
    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>