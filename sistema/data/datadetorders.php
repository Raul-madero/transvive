<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
 $operador = $_SESSION['nombre'];
include('../../conexion.php');
$conection->set_charset('utf8');


global $conection;

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

    $columns = ' p.id, p.fecha, p.semana, p.cliente, p.ruta, p.estatus, p.tipo_viaje ';
    $table = ' registro_viajes p';
    $where = " WHERE p.id!='' ".$date_range ;

    $columns_order = array(
        0 => 'id',
        1 => 'fecha',
        2 => 'semana',
        3 => 'cliente',
        4 => 'ruta',
        5 => 'estatus',
        6 => 'tipo_viaje'
    );

    $sql = "SELECT ".$columns." FROM ".$table . " ORDER BY p.fecha DESC";
    //.$where
    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( id LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR fecha LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR semana LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR cliente LIKE '".$requestData['search']['value']."'";
        $sql.=" OR ruta LIKE '%".$requestData['search']['value']."%'";
        $sql.=" OR tipo_viaje LIKE '%".$requestData['search']['value']."%' )";
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
        $Estatusnew = '<span class="label label-primary">ACTIVO</span>'; 
    }else{
        if ($row['estatus'] == 0){
        $Estatusnew = '<span class="label label-danger">CANCELADO</span>';
        }else{
        $Estatusnew = '<span class="label label-success">CERRADO</span>';   
        }
    }

        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['nopedido'] =  $row["id"];
        $time = strtotime($row["fecha"]);
        $nestedData['fecha'] = date('d M, Y', $time);

        $nestedData['semana'] = $row["semana"];
        
        $nestedData['cliente'] = $row["cliente"];
        $nestedData['ruta'] = $row["ruta"];
        $nestedData['viaje'] = $row["tipo_viaje"];

        $nestedData['estatus'] = $Estatusnew;

        $data[] = $nestedData;
    }
    header('Content-Type: application/json charset=utf-8')
    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>