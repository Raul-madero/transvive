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
       
        $gender = " AND p.ideval = $gender ";
    }

    $columns = ' p.ideval, p.fecha_eval, p.tipo_evaluacion, p.cveproveedor, pv.nombre, p.producto, p.resultado, p.calificacion_total, p.estatus ';
    $table = ' evaluaciones_metrologia p inner join proveedores pv ON p.cveproveedor = pv.no_prov' ;
    $where = " WHERE p.ideval > 0 and p.estatus = 1".$date_range.$gender ;

    $columns_order = array(
        0 => 'ideval',
        1 => 'fecha_eval',
        2 => 'tipo_evaluacion',
        3 => 'cveproveedor',
        4 => 'producto',
        5 => 'resultado',
        6 => 'nombre',
        7 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.="AND ( cveproveedor LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR nombre LIKE '%".$requestData['search']['value']."%'  )";
       
        
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
        $nestedData['pedidono'] =  $row["ideval"];
       
        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["ideval"]).'" target="_blank">'.($row["ideval"]).'</a>';
        $time = strtotime($row["fecha_eval"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $nestedData['folio'] = $row["ideval"];
        $nestedData['empresa'] = $row['cveproveedor'];
        $nestedData['atiende'] = $row['nombre'];
        $nestedData['fechainicio'] = $row['resultado'];
        $nestedData['producto'] = $row['producto'];
              
        $nestedData['Datenew'] = $row["fecha_eval"];

        $nestedData['estatusped'] = $row["calificacion_total"];

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