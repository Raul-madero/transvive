<?php 
include("../../conexion.php");

$orden = trim($_POST['orden']);
$soloDigitos = intval(preg_replace('/\D/', '', $orden));
$orden = $soloDigitos;
$fecha = $_POST['fecha_entrada'];
$almacen = $_POST['almacen_recibe'];
$requisicion = $_POST['req'];
$productos = json_decode($_POST['productos']);
// var_dump($orden);
if ($orden == '' || $fecha == '' || $almacen == '' || empty($productos)) {
    echo json_encode(array('error'=> 'Faltan datos obligatorios'));
    exit;
}

$sql = "SELECT COUNT(id) AS total FROM entradas WHERE no_orden = ?";
$stmt = $conection->prepare($sql);
$stmt->bind_param("i", $orden);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($countEntradas);
$stmt->fetch();
$stmt->close();

if ($countEntradas > 0) {
    echo json_encode(array('error'=> 'La orden ya ha sido recibida anteriormente'));
    exit;
}

$error = 0;
foreach ($productos as $producto) {
    $codigo = $producto->codigo;
    $cantidad = $producto->cantidad;

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

        $query = "INSERT INTO entradas (cantidad, fecha, id_producto, id_almacen, no_requisicion, no_orden) VALUES (?,?,?,?,?,?)";
        $stmt = $conection->prepare($query);
        $stmt->bind_param("issiii", $producto->cantidad, $fecha, $id, $almacen, $requisicion, $orden);
        if ($stmt->execute()) {
            $stmt->close();
        }else {
            echo json_encode(array('error'=> 'Error al agregar entrada'));
            $error++;
            exit;
        }
        
        $query = "SELECT stock_actual FROM productos WHERE codigo_producto =?";
        $stmt = $conection->prepare($query);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stock_actual = $row['stock_actual'];
            $stock_actual += $cantidad;

            $query = "UPDATE productos SET stock_actual =? WHERE codigo_producto =?";
            $stmt = $conection->prepare($query);
            $stmt->bind_param("ds", $stock_actual, $codigo);
            $stmt->execute();
            $stmt->close();
        } else {

            $query = "INSERT INTO productos (codigo_producto, codigo_interno, descripcion, u_medida, marca, rotacion, categoria, modelo, stock_minimo, stock_maximo, costo_unitario, estatus, almacen, stock_actual) VALUES (?,?,?,?,?,?,?,?,?,?,?,1,?,?)";
            $stmt = $conection->prepare($query);
            if (!$stmt) {
                echo json_encode(['error' => 'Error en prepare(): ' . $conection->error]);
                exit;
            }
            $stmt->bind_param("ssssssssdddii", $producto->codigo, $codigo_interno, $descripcion, $u_medida, $marca, $rotacion, $categoria, $modelo, $stock_minimo, $stock_maximo, $producto->costo, $almacen, $cantidad);
            if($stmt->execute()) {
                $stmt->close();
            }else {
                echo json_encode(array('error'=> 'Error al agregar producto' . $conection->error));
                $error++;
                exit;
            }
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