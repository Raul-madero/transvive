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
        if ($gender == "Activa") {
         $gender = " AND p.estatus = 1 ";
        }else {
            if ($gender == "Cancelada") {
              
              $gender = " AND p.estatus = 0 ";
            }
        }

      
    }

    $columns = ' p.id, p.fecha, p.no_compra, p.no_orden,p.no_requisicion, p.proveedor, p.area_solicitante, p.forma_pago, p.metodo_pago, p.subtotal, p.impuesto, p.total, p.estatus, pv.nombre, p.comprobante, p.comprobante_pago ';
    $table = ' compras p inner join proveedores pv ON p.proveedor = pv.id ' ;
    $where = " WHERE p.id > 0 ".$date_range.$gender ;

    $columns_order = array(
        0 => 'id',
        1 => 'fecha',
        2 => 'no_compra',
        3 => 'no_orden',
        4 => 'nombre',
        5 => 'area_solicitante',
        6 => 'subtotal',
        7 => 'impuesto',
        8 => 'total',
        9 => 'estatus'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($conection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
        $sql.="AND ( nombre LIKE '%".$requestData['search']['value']."%' ";
        $sql.=" OR area_solicitante LIKE '%".$requestData['search']['value']."%'  )";
       
        
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
                  $Estatusnew = '<span class="label label-success">Cancelada</span>';
                 } 
                }     
        }
    }
    }

    if (empty($row['comprobante'])) {
        $tfactura = "NO";
    }else {
        $tfactura = "SI";
    }

    if (empty($row['comprobante_pago'])) {
        $tfacpago = "NO";
    }else {
        $tfacpago = "SI";
    }



        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['pedidono'] =  $row["id"];

        $nestedData['nopedido'] = '<a style="text-decoration:none" href="factura/pedidonw.php?id='.($row["id"]).'" target="_blank">'.($row["id"]).'</a>';
        $time = strtotime($row["fecha"]);
        $nestedData['fechaa'] = date('d/m/Y', $time);
        $nestedData['nocompra'] = $row["no_compra"];
        $nestedData['noorden'] = $row['no_orden'];
        $nestedData['norequi'] = $row['no_requisicion'];
        $nestedData['razonsoc'] = $row["nombre"];

        $nestedData['area'] = $row["area_solicitante"];
        $nestedData['subtotal'] = $row["subtotal"];
      
        $nestedData['impuesto'] = $row["impuesto"];
        $nestedData['importetotal'] = $row["total"];
        $nestedData['comprobante'] = $tfactura;
        $nestedData['compropago'] = $tfacpago;
       
        $nestedData['Datenew'] = $row["fecha"];
        $nestedData['codprov'] = $row["proveedor"];

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