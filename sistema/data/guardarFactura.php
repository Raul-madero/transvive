<?php
include '../../conexion.php';

//Asignar los campos a variables para su insercion a la base d edatos
$no_requisicion = isset($_POST['folio']) ? intval($_POST['folio']) : NULL;
$no_orden = isset($_POST['no_orden']) ? intval($_POST['no_orden']) : NULL;
$no_factura = $_POST['no_factura'];
$fecha_factura = $_POST['fecha_factura'];
$fecha_pago = $_POST['fecha_pago'];
$proveedor = $_POST['proveedor'];
$subtotal = floatval($_POST['subtotal']);
$iva = floatval($_POST['iva']);
$total = floatval($_POST['total']);
$impuesto_adicional = $_POST['impuestoAdicional'] ?? "";
$valor_imp_adicional = floatval($_POST['valorImpuestoAdicional'])?? 0;

//Validar que todos los campos obligatorios estén llenos
if(empty($no_factura) || empty($fecha_factura) || empty($proveedor) || empty($subtotal) || empty($iva) || empty($total)) {
    echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios"]);
    exit;
}

//Verificar si la requisicion no esta facturada anteriormente
$check = $conection->prepare("SELECT id FROM facturas WHERE no_requisicion = ?");
$check->bind_param("i", $no_requisicion);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Ya existe una factura para esta requisición."]);
    $check->close();
    $conection->close();
    exit;
}
$check->close();

// Validar y guardar los productos en detalle_factura
if (!empty($_POST['productos'])) {
    $productos = json_decode($_POST['productos'], true);

    foreach ($productos as $p) {
        $codigo = $p['codigo'];
        $descripcion = $p['descripcion'];
        $cantidad = floatval($p['cantidad']);
        $precio_unitario = floatval($p['precio']);
        $total = floatval($p['total']);

        $insertDetalle = $conection->prepare("INSERT INTO detalle_factura (no_factura, codigo, descripcion, cantidad, precio_unitario, total) VALUES (?, ?, ?, ?, ?, ?)");
        $insertDetalle->bind_param("issidd", $no_factura, $codigo, $descripcion, $cantidad, $precio_unitario, $total);
        if(!$insertDetalle->execute()) {
            echo json_encode(["status" => "error", "message" => "No se pudieron insertar los productos en detalle_factura."]);
            exit;
        };
        $insertDetalle->close();
    }
}


//Consulta para cambiar el estatus de la requisicion a facturada
$stmt_req = $conection->prepare("UPDATE requisicion_compra SET estatus = 4 WHERE no_requisicion =?");
$stmt_req->bind_param("i", $no_requisicion);
if(!$stmt_req->execute()) {
    echo json_encode(["status" => "error", "message" => "No se pudo actualizar el estatus de la requisición a facturada."]);
    exit;
}

//Convertir fechas a un formato para base de datos
$fecha_factura = date('Y-m-d', strtotime($fecha_factura));
$fecha_pago = date('Y-m-d', strtotime($fecha_pago));

//Insercion a la base de datos con consultas preparadas
$sql = "INSERT INTO facturas (no_factura, no_requisicion, no_orden, fecha, fecha_pago, subtotal, iva, total, impuesto_adicional, valor_imp_adicional, proveedor, estatus) VALUES (?,?,?,?,?,?,?,?,?,?,?, 1)";

$stmt = $conection->prepare($sql);

$stmt->bind_param("siissdddsdi", $no_factura, $no_requisicion, $no_orden, $fecha_factura, $fecha_pago, $subtotal, $iva, $total, $impuesto_adicional, $valor_imp_adicional, $proveedor);

//Verificar insercion y enviar mensaje de éxito o error
if($stmt->execute()){
    echo json_encode(["status" => "success", "message" => "Factura almacenada correctamente"]);
    $stmt->close();
    $conection->close();
    exit;  } else {
    echo json_encode(["status" => "error", "message" => "Error al almacenar la factura: ". $stmt->error]);
}

//Cerrar la conexión con la base de datos
$stmt->close();
$conection->close();