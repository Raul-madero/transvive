<?php
include "../conexion.php";

// Validar campos recibidos
$noreq = $_POST['form_pass_noreq'] ?? '';
$orden = $_POST['form_pass_orden'] ?? '';
if ($noreq === '' && $orden === '') {
    echo "Debe proporcionar un número de requisición o número de orden.";
    exit;
}

//Verifica que exuiste un archivo adjunto
if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== 0) {
    echo "Error al subir el archivo.";
    exit;
}

$nombre_base = basename($_FILES['archivo']['name']);
$nombre_final = date('Ymd-His') . '-' . $nombre_base;
$ruta = 'archivos_compras/' . $nombre_final;

// Mover archivo
if (move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta)) {
    // Guardar ruta en base de datos
    if ($noreq !== '') {
        $stmt = mysqli_prepare($conection, "UPDATE facturas SET ruta = ? WHERE no_requisicion = ?");
        mysqli_stmt_bind_param($stmt, "ss", $ruta, $noreq);
        if (mysqli_stmt_execute($stmt)) {
            $stmt = mysqli_prepare($conection, "UPDATE requisicion_compra SET estatus = 5 WHERE no_requisicion =?");
            mysqli_stmt_bind_param($stmt, "i", $noreq);
            if(mysqli_stmt_execute($stmt)) {
                echo "OK";
            }
        } else {
            echo "Error en la base de datos: " . mysqli_error($conection);
        }
        mysqli_stmt_close($stmt);
    } else if ($orden!== '') {
        $stmt = mysqli_prepare($conection, "UPDATE facturas SET ruta =? WHERE no_orden =?");
        mysqli_stmt_bind_param($stmt, "ss", $ruta, $orden);
        if (mysqli_stmt_execute($stmt)) {
            echo "OK";
        } else {
            echo "Error en la base de datos: ". mysqli_error($conection);
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Error al mover el archivo al servidor.";
}
