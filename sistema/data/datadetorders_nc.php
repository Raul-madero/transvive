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
        $date_range = " AND fecha BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($gender != ""){
        if ($gender == "Abierto") {
         $gender = 1;   
        }else {
            if ($gender == "Cerrado") {
              $gender = 2;
            }else {
                if ($gender == "Cancelada") {
                    $gender = 0;
                }
            }
        }

        $gender = " AND estatus = $gender ";
    }

    $columns = ' id, no_queja, fecha, mes, cliente, f8d, descripcion, motivo, responsable, supervisor, operador, unidad, ruta, parada, fecha_incidente, turno, procede_ac, porque_procede, analisis_conclusionac, accion, fecha_accion, responsable_accion, fecha_cierre, observaciones, tipo_incidente, estatus, cuenta, causa, afecta, area_responsable ';
    $table = ' no_conformidades ' ;
    $where = " WHERE id > 0 ".$date_range.$gender ;

    $columns_order = array(
        0 => 'id',
        1 => 'no_queja',
        2 => 'fecha',
        3 => 'cliente',
        4 => 'responsable',
        5 => 'supervisor',
        6 => 'operador',
        7 => 'unidad',
        8 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.=" AND ( no_queja LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR cliente LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR unidad LIKE '%".$requestData['search']['value']."%'  )";
       
        
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
         
        

        $count++;
        $nestedData = array();
        $time = strtotime($row["fecha"]);
        $time2 = strtotime($row["fecha_incidente"]);
        $time3 = strtotime($row["fecha_accion"]);
        $time4 = strtotime($row["fecha_cierre"]);
       

        $nestedData['counter'] = $count;
        $nestedData['pedidono'] =  $row["id"];
        $nestedData['num_queja'] =  $row["no_queja"];
        $nestedData['name_mes'] =  $row["mes"];  
        $nestedData['date'] = date('d/m/Y', $time);
        $nestedData['name_cliente'] =  $row["cliente"];
        $nestedData['formato'] = $row["f8d"];
        $nestedData['describe'] = $row["descripcion"];
        $nestedData['motivonc'] = $row["motivo"];
        $nestedData['respnc'] = $row["responsable"];
        $nestedData['supervnc'] = $row["supervisor"];
        $nestedData['operador'] = $row["operador"];
        $nestedData['noeco'] = $row["unidad"];
        $nestedData['rutanc'] = $row["ruta"];
        $nestedData['estacion'] = $row["parada"];
        $nestedData['date_incidente'] = date('d/m/Y', $time2);
        $nestedData['turnoi'] = $row['turno'];
        $nestedData['procedenc'] = $row['procede_ac'];
        $nestedData['porquenc'] = $row['porque_procede'];
        $nestedData['analisisnc'] = $row['analisis_conclusionac'];
        $nestedData['accionnc'] = $row['accion'];
        $nestedData['date_accion'] = date('d/m/Y', $time3);
        $nestedData['respaccion'] = $row['responsable_accion'];
        $nestedData['date_cierre'] = date('d/m/Y', $time4);
        $nestedData['notas'] = $row["observaciones"];
        $nestedData['tipo'] = $row["tipo_incidente"];
        $nestedData['estatusped'] = $row["estatus"];
        //$nestedData['nocuenta'] = $row["cuenta"];
        $nestedData['causanc'] = $row["causa"];
        $nestedData['afectacte'] = $row["afecta"];
        $nestedData['deptoresp'] = $row["area_responsable"];

        $data[] = $nestedData;
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