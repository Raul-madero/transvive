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
        if ($gender == "Activa") {
         $gender = 1;   
        }else {
            if ($gender == "Autorizada") {
              $gender = 2;
            }else {
                if ($gender == "Procesada") {
                    $gender = 3;
                }else {
                    if ($gender == "Cancelada") {
                        $gender = 0;
                    }
                }
            }
        }

        $gender = " AND p.estatus = $gender ";
    }

    $columns = ' p.id, p.date_elabora, p.date_recibe, p.puesto, p.zona, p.no_vacantes, p.supervisor, p.motivo, p.estatus ';
    $table = ' requisicion_personal p ' ;
    $where = " WHERE p.id > 0 ".$date_range.$gender ;

    $columns_order = array(
        0 => 'id',
        1 => 'date_elabora',
        2 => 'date_recibe',
        3 => 'puesto',
        4 => 'zona',
        5 => 'motivo',
        6 => 'supervisor',
        7 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.="AND ( id LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR puesto LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR supervisor LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR motivo LIKE '%".$requestData['search']['value']."%'  )";
             
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
           $Estatusnew = '<span class="label label-success">Autorizada</span>';
        }else{
            if ($row['estatus'] == 3) {
              $Estatusnew = '<span class="label label-danger">Procesada</span>';
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
        $time = strtotime($row["date_elabora"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $time2 = strtotime($row["date_recibe"]);
        $nestedData['fecha_rec'] = date('d/m/Y', $time2);
        $nestedData['puesto'] = $row["puesto"];
        $nestedData['zona'] = $row['zona'];
        $nestedData['supervisor'] = $row['supervisor'];
        $nestedData['vacantes'] = $row['no_vacantes'];      
        $nestedData['Datenew'] = $row["date_elabora"];
        $nestedData['motivo'] = $row['motivo'];

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