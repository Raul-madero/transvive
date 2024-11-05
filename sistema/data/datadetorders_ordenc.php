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
       
        $gender = " AND p.no_orden = $gender ";
    }

    $columns = ' p.id, p.no_orden, p.fecha, p.proveedor, p.area_solicitante, p.contacto, p.telefono, p.total, p.observaciones, p.estatus, pv.nombre ';
    $table = ' orden_compra p INNER JOIN proveedores pv ON p.proveedor = pv.id ' ;
    $where = " WHERE p.id > 0 ".$date_range.$gender ;

    $columns_order = array(
        0 => 'id',
        1 => 'no_orden',
        2 => 'fecha',
        3 => 'proveedor',
        4 => 'area_solicitante',
        5 => 'contacto',
        6 => 'telefono',
        7 => 'nombre',
        8 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.="AND ( nombre LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR area_solicitante LIKE '%".$requestData['search']['value']."%'  )";
       
        
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
        $nestedData['Folio'] = $row["no_orden"];

        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>';
        $time = strtotime($row["fecha"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $nestedData['nameproveedor'] = $row["nombre"];
        $nestedData['arear'] = $row['area_solicitante'];
        $nestedData['contacto'] = $row['contacto'];
        $nestedData['telefono'] = $row['telefono'];
        $nestedData['importe'] = $row['total'];
        $nestedData['notas'] = $row['observaciones'];      
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