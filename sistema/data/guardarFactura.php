<?php
header('Content-Type: application/json; charset=utf-8');
include '../../conexion.php';

// ===== Helpers =====
function as_float($v){ return isset($v) ? (float)$v : 0.0; }
function clean_digits($s){ return (int)preg_replace('/\D+/', '', (string)$s); }
function parse_date_db($s){
    $s = trim((string)$s);
    if ($s === '') return null;
    $fmts = ['Y-m-d','d-m-Y','d/m/Y','m/d/Y'];
    foreach($fmts as $fmt){
        $dt = DateTime::createFromFormat($fmt, $s);
        if ($dt) return $dt->format('Y-m-d');
    }
    $ts = strtotime($s);
    return $ts ? date('Y-m-d', $ts) : null;
}
/** Cierra una vez y anula la referencia para evitar re-cierres */
function safe_close_stmt(?mysqli_stmt &$stmt){
    if ($stmt instanceof mysqli_stmt) {
        @ $stmt->close();
        $stmt = null;
    }
}

try {
    // ====== INPUTS ======
    $no_requisicion = isset($_POST['folio']) ? clean_digits($_POST['folio']) : null;
    $no_orden       = isset($_POST['orden']) ? clean_digits($_POST['orden']) : null;

    $no_factura     = trim($_POST['no_factura'] ?? '');
    $fecha_factura  = parse_date_db($_POST['fecha_factura'] ?? '');
    $fecha_pago     = parse_date_db($_POST['fecha_pago'] ?? '');
    $proveedor      = isset($_POST['proveedor']) ? (int)$_POST['proveedor'] : 0;

    $subtotal       = as_float($_POST['subtotal'] ?? 0);
    $iva            = as_float($_POST['iva'] ?? 0);
    $total          = as_float($_POST['total'] ?? 0);

    // Compatibilidad 1 impuesto
    $impuesto_adicional   = $_POST['impuestoAdicional'] ?? '';
    $valor_imp_adicional  = as_float($_POST['valorImpuestoAdicional'] ?? 0);

    // Múltiples impuestos adicionales (opcionales)
    $total_imp_adic = isset($_POST['total_impuestos_adicionales'])
                        ? as_float($_POST['total_impuestos_adicionales'])
                        : as_float($_POST['totalImpuestosAdicionalesHidden'] ?? 0);
    $imp_adic_json  = $_POST['impuestos_adicionales'] ?? ($_POST['detalleImpuestosAdicionales'] ?? '[]');
    $impuestos_adicionales = json_decode($imp_adic_json, true);
    if (!is_array($impuestos_adicionales)) $impuestos_adicionales = [];

    // Retenciones (opcionales)
    $total_retenciones = as_float($_POST['total_retenciones'] ?? 0);
    $ret_json          = $_POST['retenciones'] ?? '[]';
    $retenciones       = json_decode($ret_json, true);
    if (!is_array($retenciones)) $retenciones = [];

    // Productos (JSON)
    $productos = [];
    if (!empty($_POST['productos'])) {
        $tmp = json_decode($_POST['productos'], true);
        if (is_array($tmp)) $productos = $tmp;
    }

    // ====== VALIDACIONES ======
    if ($no_factura === '' || !$fecha_factura || $proveedor <= 0) {
        echo json_encode(["status"=>"error","message"=>"Faltan datos obligatorios: no_factura, fecha_factura o proveedor."]);
        exit;
    }
    if ($subtotal < 0 || $total < 0) {
        echo json_encode(["status"=>"error","message"=>"Montos inválidos."]);
        exit;
    }

    // ====== DUPLICADOS ======
    $stmt = $conection->prepare("SELECT id FROM facturas WHERE no_factura = ? LIMIT 1");
    $stmt->bind_param("s", $no_factura);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        safe_close_stmt($stmt);
        echo json_encode(["status"=>"error","message"=>"Ya existe una factura con ese número."]);
        exit;
    }
    safe_close_stmt($stmt);

    if ($no_requisicion) {
        $stmt = $conection->prepare("SELECT id FROM facturas WHERE no_requisicion = ? LIMIT 1");
        $stmt->bind_param("i", $no_requisicion);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            safe_close_stmt($stmt);
            echo json_encode(["status"=>"error","message"=>"Ya existe una factura para esta Requisición."]);
            exit;
        }
        safe_close_stmt($stmt);
    }

    if ($no_orden) {
        $stmt = $conection->prepare("SELECT id FROM facturas WHERE no_orden = ? LIMIT 1");
        $stmt->bind_param("i", $no_orden);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            safe_close_stmt($stmt);
            echo json_encode(["status"=>"error","message"=>"Ya existe una factura para esta Orden de Compra."]);
            exit;
        }
        safe_close_stmt($stmt);
    }

    // Resumen para columnas antiguas (si aplica)
    if ($impuesto_adicional === '' && $total_imp_adic > 0 && count($impuestos_adicionales) > 0) {
        $labels = [];
        foreach ($impuestos_adicionales as $i) {
            $n = trim($i['nombre'] ?? '');
            $p = (float)($i['porcentaje'] ?? 0);
            if ($n !== '') $labels[] = $p > 0 ? "$n {$p}%" : $n;
        }
        $impuesto_adicional  = implode(', ', $labels);
        $valor_imp_adicional = $total_imp_adic;
    }

    // ====== TRANSACCIÓN ======
    $conection->begin_transaction();

    // 1) INSERT facturas
    $sql = "INSERT INTO facturas
            (no_factura, no_requisicion, no_orden, fecha, fecha_pago, subtotal, iva, total, impuesto_adicional, valor_imp_adicional, proveedor, estatus)
            VALUES (?,?,?,?,?,?,?,?,?,?,?, 1)";
    $stmt = $conection->prepare($sql);
    $stmt->bind_param(
        "siissdddsdi",
        $no_factura,
        $no_requisicion,
        $no_orden,
        $fecha_factura,
        $fecha_pago,
        $subtotal,
        $iva,
        $total,
        $impuesto_adicional,
        $valor_imp_adicional,
        $proveedor
    );
    if (!$stmt->execute()) {
        throw new Exception("Error al guardar factura: " . $stmt->error);
    }
    safe_close_stmt($stmt);

    // 2) Detalle productos
    if (!empty($productos)) {
        $sqlDet = "INSERT INTO detalle_factura (no_factura, codigo, descripcion, cantidad, precio_unitario, total)
                   VALUES (?, ?, ?, ?, ?, ?)";
        $stmtDet = $conection->prepare($sqlDet);
        foreach ($productos as $p) {
            $codigo   = (string)($p['codigo'] ?? '');
            $desc     = (string)($p['descripcion'] ?? '');
            $cant     = (float)($p['cantidad'] ?? 0);
            $precio_u = (float)($p['precio'] ?? 0);
            $total_p  = (float)($p['total'] ?? ($cant * $precio_u));
            $stmtDet->bind_param("sssddd", $no_factura, $codigo, $desc, $cant, $precio_u, $total_p);
            if (!$stmtDet->execute()) {
                throw new Exception("Error al insertar detalle de productos: " . $stmtDet->error);
            }
        }
        safe_close_stmt($stmtDet);
    }

    // 3) Impuestos adicionales (múltiples)
    if (!empty($impuestos_adicionales)) {
        $sqlImp = "INSERT INTO factura_impuestos (no_factura, nombre, porcentaje, importe)
                   VALUES (?, ?, ?, ?)";
        $stmtImp = $conection->prepare($sqlImp);
        foreach ($impuestos_adicionales as $i) {
            $nombre = trim($i['nombre'] ?? '');
            $porc   = (float)($i['porcentaje'] ?? 0);
            $imp    = (float)($i['importe'] ?? 0);
            if ($nombre === '') continue;
            $stmtImp->bind_param("ssdd", $no_factura, $nombre, $porc, $imp);
            if (!$stmtImp->execute()) {
                throw new Exception("Error al insertar impuestos adicionales: " . $stmtImp->error);
            }
        }
        safe_close_stmt($stmtImp);
    }

    // 4) Retenciones (múltiples)
    if (!empty($retenciones)) {
        $sqlRet = "INSERT INTO factura_retenciones (no_factura, nombre, tipo, valor, base, importe)
                   VALUES (?, ?, ?, ?, ?, ?)";
        $stmtRet = $conection->prepare($sqlRet);
        foreach ($retenciones as $r) {
            $nombre = trim($r['nombre'] ?? '');
            if ($nombre === '') continue;
            $tipo   = (isset($r['tipo']) && $r['tipo'] === 'monto') ? 'monto' : 'porcentaje';
            $valor  = (float)($r['valor'] ?? 0);
            $base   = in_array(($r['base'] ?? 'subtotal'), ['subtotal','iva','subtotal_iva']) ? $r['base'] : 'subtotal';
            $imp    = (float)($r['importe'] ?? 0);
            $stmtRet->bind_param("sssdsd", $no_factura, $nombre, $tipo, $valor, $base, $imp);
            if (!$stmtRet->execute()) {
                throw new Exception("Error al insertar retenciones: " . $stmtRet->error);
            }
        }
        safe_close_stmt($stmtRet);
    }

    // 5) Estatus
    if ($no_requisicion) {
        $stmtU = $conection->prepare("UPDATE requisicion_compra SET estatus = 4 WHERE no_requisicion = ?");
        $stmtU->bind_param("i", $no_requisicion);
        if (!$stmtU->execute()) throw new Exception("No se pudo actualizar estatus de Requisición.");
        safe_close_stmt($stmtU);
    }

    if ($no_orden) {
        $stmtQ = $conection->prepare("SELECT no_requisicion FROM orden_compra WHERE no_orden = ?");
        $stmtQ->bind_param("i", $no_orden);
        $stmtQ->execute();
        $stmtQ->bind_result($req_rel);
        $stmtQ->fetch();
        safe_close_stmt($stmtQ);

        if ($req_rel) {
            $stmtU = $conection->prepare("UPDATE requisicion_compra SET estatus = 7 WHERE no_requisicion = ?");
            $stmtU->bind_param("i", $req_rel);
            if (!$stmtU->execute()) throw new Exception("No se pudo actualizar estatus por OC.");
            safe_close_stmt($stmtU);
        }
    }

    // Commit y salida limpia
    $conection->commit();
    $conection->close();
    echo json_encode(["status"=>"success","message"=>"Factura almacenada correctamente"]);
    exit;

} catch (Throwable $e) {
    if ($conection instanceof mysqli) {
        @ $conection->rollback();
        @ $conection->close();
    }
    http_response_code(500);
    echo json_encode(["status"=>"error","message"=>$e->getMessage()]);
    exit;
}
// Sin finally: ya cerramos todo con seguridad.
