<?php
include "../../conexion.php";

// Validar campos recibidos
$noreq = $_POST['pagar_noreq'] ?? '';
$orden = $_POST['pagar_orden'] ?? '';
$fecha = $_POST['fecha_pago'] ?? '';

if ($noreq === '' && $orden === '') {
    echo "Debe proporcionar un número de requisición o número de orden.";
    exit;
}

// Verifica que se subió un archivo sin errores
if (!isset($_FILES['pagar_file']) || $_FILES['pagar_file']['error'] !== UPLOAD_ERR_OK) {
    echo "Error al subir el archivo.";
    exit;
}

// Validar que la extensión del archivo sea PDF (opcional pero recomendable)
$ext = strtolower(pathinfo($_FILES['pagar_file']['name'], PATHINFO_EXTENSION));
if ($ext !== 'pdf') {
    echo "Solo se permiten archivos PDF.";
    exit;
}

// Construir nombre final del archivo
$nombre_base = basename($_FILES['pagar_file']['name']);
$nombre_final = date('Ymd-His') . '-' . preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $nombre_base); // Limpieza básica
$ruta = '../archivos_compras/'. $nombre_final;

// Mover archivo al servidor
if (move_uploaded_file($_FILES['pagar_file']['tmp_name'], $ruta)) {
    // Guardar en base de datos
    $stmt = mysqli_prepare($conection, "INSERT INTO pagos_proveedor (fecha, ruta, orden_compra) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $fecha, $ruta, $orden);
    
    if (mysqli_stmt_execute($stmt)) {
        $stmt = mysqli_prepare($conection, "UPDATE requisicion_compra SET estatus = 5 WHERE no_requisicion =?");
        mysqli_stmt_bind_param($stmt, "i", $noreq);
        if(mysqli_stmt_execute($stmt)) {
            echo json_encode([
                'success' => true,
                'message' => 'Pago registrado correctamente.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al guardar en base de datos.'
        ]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al mover el archivo al servidor.'
    ]);
}
?>
