<?php
session_start();
 $User=$_SESSION['user'];
 $rol=$_SESSION['rol'];
 $idUser = $_SESSION['idUser'];
include '../../conexion.php';



$request = $_POST['request'];

// Datatable data
if($request == 1){
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value



    ## Search 
    $searchQuery = " ";
    if($searchValue != ''){
        $searchQuery .= " and (cliente like '%".$searchValue."%' or 
            ruta like '%".$searchValue."%' or 
            unidad like'%".$searchValue."%' ) ";
    }


   

    ## Total number of records without filtering
    $sel = mysqli_query($conection,"select count(*) as allcount from registro_viajes WHERE tipo_viaje = 'Especial' and estatus = 1");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = mysqli_query($conection,"select count(*) as allcount from registro_viajes WHERE tipo_viaje = 'Especial' and estatus = 1".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from registro_viajes WHERE tipo_viaje LIKE '%Especial%' and estatus = 1".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($conection, $empQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {
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
    $time = strtotime($row["fecha"]);
        $data[] = array(
                "id"=>$row['id'],
                "fecha"=>date('d/m/Y', $time),
                "cliente"=>$row['cliente'],
                "direccion"=>$row['direccion'],
                "hora_inicio"=>$row['hora_inicio'],
                "hora_fin"=>$row['hora_fin'],
                "unidad"=>$row['unidad'],
                "destino"=>$row['destino'],
                "estatus"=>$Estatusnew,
                "action"=>"<input type='checkbox' class='delete_check' id='delcheck_".$row['id']."' onclick='checkcheckbox();' value='".$row['id']."'>"
            );
    }

    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );

    echo json_encode($response);
    exit;
}

// Delete record
if($request == 2){
    $deleteids_arr = $_POST['deleteids_arr'];

    foreach($deleteids_arr as $deleteid){
        mysqli_query($conection,"UPDATE registro_viajes SET motivo_cancela = 'Cancelación por el Cliente (Problemas de Pago)',valor_vuelta = 0, estatus = 3, usuario_cancel = $idUser WHERE id=".$deleteid);
    }

    echo 1;
    exit;
}

