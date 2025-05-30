<?php
include '../../conexion.php';

if (isset($_REQUEST['folio']) && is_numeric($_REQUEST['folio']) && $_REQUEST['folio'] > 0) {
    $folio = isset($_REQUEST['folio']) ? intval($_REQUEST['folio']) : 0;
    $query = mysqli_query($conection, "SELECT codigo, cantidad, descripcion, precio FROM detalle_requisicioncompra WHERE folio = $folio");
    
    $productos = array();
    
    while ($row = mysqli_fetch_assoc($query)) {
        $productos[] = $row;
    }
    
    echo json_encode($productos);
}

if(isset($_REQUEST['orden_prod']) && is_numeric($_REQUEST['orden_prod']) && $_REQUEST['orden_prod'] > 0){
    $orden_prod = isset($_REQUEST['orden_prod'])? intval($_REQUEST['orden_prod']) : 0;
    $query = mysqli_query($conection, "SELECT codigo, cantidad, descripcion, precio FROM detalle_ordencompra WHERE folio = $orden_prod");
    
    $productos = array();
    
    while ($row = mysqli_fetch_assoc($query)) {
        $productos[] = $row;
    }
    
    echo json_encode($productos);
}

mysqli_close($conection);
