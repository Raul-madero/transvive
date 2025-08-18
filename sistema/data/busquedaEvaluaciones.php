<?php
include '../../conexion.php';
session_start();

$action = $_POST['action'];
$proveedor = $_POST['proveedor'];

if($action === 'busquedaEvaluacionProductos') {
    $sql = "SELECT * FROM evaluaciones_productos WHERE cveproveedor = ? ORDER BY fecha_eval DESC LIMIT 3";
    $stmt = $conection->prepare($sql);
    $stmt->bind_param('i', $proveedor);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $filas = $result->num_rows;
        while($data = $result->fetch_assoc()) {
            
        }
    }


    
        // while($stmt->fetch()) {
        //     $row = $stmt->get_current_row();
        //     var_dump($row);
        //     echo json_encode($row);
        // }
    
}