<?php 
include("../../conexion.php");

$orden = $_POST['orden'];
$fecha = $_POST['fecha_entrada'];
$almacen = $_POST['almacen_recibe'];
$requisicion = $_POST['req'];
$productos = json_decode($_POST['productos']);

if ($orden == '' || $fecha == '' || $almacen == '' || empty($productos)) {
    echo json_encode(array('error'=> 'Faltan datos obligatorios'));
    exit;
}

$error = 0;
foreach ($productos as $producto) {
    $codigo = $producto->codigo;

    $query = "SELECT * FROM refacciones WHERE codigo = ?";
    $stmt = $conection->prepare($query);
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $codigo_interno = $row['codigo_interno'];
        $descripcion = $row['descripcion'];
        $u_medida = $row['umedida'];
        $marca = $row['marca'];
        $rotacion = $row['rotacion'];
        $categoria = $row['categoria'];
        $modelo = $row['modelo'];
        $stock_minimo = $row['stock_minimo'];
        $stocK_maximo = $row['stock_maximo'];


        $query = "INSERT INTO entradas (cantidad, fecha, id_producto, id_almacen) VALUES (?,?,?,?)";
        $stmt = $conection->prepare($query);
        $stmt->bind_param("issi", $producto->cantidad, $fecha, $id, $almacen);
        if ($stmt->execute()) {
            $stmt->close();
        }else {
            echo json_encode(array('error'=> 'Error al agregar entrada'));
            $error++;
            exit;
        }

        $query = "INSERT INTO productos (codigo_producto, codigo_interno, descripcion, u_medida, marca, rotacion, categoria, modelo, stock_minimo, stock_maximo, costo_unitario, estatus, almacen) VALUES (?,?,?,?,?,?,?,?,?,?,?,1,?)";
        $stmt = $conection->prepare($query);
        if (!$stmt) {
            echo json_encode(['error' => 'Error en prepare(): ' . $conection->error]);
            exit;
        }
        $stmt->bind_param("ssssssssdddi", $producto->codigo, $codigo_interno, $descripcion, $u_medida, $marca, $rotacion, $categoria, $modelo, $stock_minimo, $stock_maximo, $producto->costo, $almacen);
        if($stmt->execute()) {
            $stmt->close();
        }else {
            echo json_encode(array('error'=> 'Error al agregar producto' . $conection->error));
            $error++;
            exit;
        }
    }

}

if ($error > 0) {
    echo json_encode(array('error'=> 'Hubo errores durante la carga de productos'));
} else {
    $query = "UPDATE requisicion_compra SET estatus = 6 WHERE no_requisicion =?";
    $stmt = $conection->prepare($query);
    $stmt->bind_param("i", $requisicion);
    $stmt->execute();
    echo json_encode(array('success'=> true, 'mensaje' => 'Entrada y producto agregados correctamente'));
}