<?php
session_start();
include '../config/db-config.php';

 date_default_timezone_set('America/Mexico_City');
// $fcha2 = date("Y-m-d");
// $fcha1 = date("Y-m-d",strtotime ( '-1 day' , strtotime ( $fcha2 ) ) );
global $connection;

if($_REQUEST['action'] == 'fetch_userss'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];
    // $initial_date = $fecha1;
    // $final_date = $fecha2;
  
    $gender = $_REQUEST['buscarid'];

    // if(!empty($initial_date) && !empty($final_date)){
    //     $date_range = " AND p.fecha BETWEEN '".$initial_date."' AND '".$final_date."' ";
    // }else{
    //     $date_range = " ";
    // }

    if($gender != ""){
        $gender =  " AND p.id = '$gender' ";
    }

    $columns = ' p.id, p.fecha, p.hora_inicio, p.hora_fin, p.semana, p.cliente, p.operador, p.unidad, p.num_unidad, p.personas, p.estatus, CONCAT(sp.nombres, " ", sp.apellido_paterno, " ", apellido_materno) as name, us.nombre AS jefeo, p.ruta ';
    $table = ' registro_viajes p LEFT JOIN clientes ct ON p.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON p.id_supervisor = sp.idacceso' ;
    $where = " WHERE p.tipo_viaje <> 'Especial' ".$gender;
    //p.fecha >= '".$fcha1."' and p.fecha <='".$fcha2."' and 

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

    $sql = "SELECT ".$columns." FROM ".$table. " ORDER BY p.fecha DESC".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( p.id LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR cliente LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR operador LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR semana LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR nombres LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR p.fecha LIKE '%".$requestData['search']['value']."%' )";
       
        
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
        $Estatusnew = '<span class="label label-primary">Activo</span>'; 
    }else{
        if ($row['estatus'] == 2){
           $Estatusnew = '<span class="label label-success">Realizado</span>';
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
                  $Estatusnew = '<span class="label label-success">CERRADO</span>';
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
        $time2 = strtotime($row["hora_inicio"]);
        $time3 = strtotime($row["hora_fin"]);
        $nestedData['fecha'] = date('d/m/Y', $time);
        $nestedData['horainicio'] = date('H:i', $time2);
        $nestedData['horafin'] = date('H:i', $time3);
        $nestedData['nosemana'] = $row["semana"];

        $nestedData['razonsocial'] = $row["cliente"];
        $nestedData['rutacte'] = $row["ruta"];
        $time2 = strtotime($row["fechacomp"]);
        $nestedData['fechacomp'] = date('d M, Y', $time);
        
        $nestedData['conductor'] = $row["operador"];
        $nestedData['tipounidad'] = $row["unidad"];
        $nestedData['nounidad'] = $row["num_unidad"];
        $nestedData['supervisor'] = $row["name"];
        $nestedData['jefeopera'] = $row["jefeo"];

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