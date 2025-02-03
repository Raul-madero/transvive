<?php
session_start();
include('../../conexion.php');

header('Content-Type: application/json');

// Verificar conexión
if (!$conection) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Verificar campos obligatorios
$required_fields = ['namecte', 'phone', 'contactorh', 'datecontact', 'dateSeguimiento', 'domicilio', 'colonia', 'telefono_empresa', 'cp', 'estado', 'municipio', 'razonSocial'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => 'Faltan campos obligatorios: ' . $field]);
        exit;
    }
}

// Función para convertir fechas de DD-MM-YYYY a YYYY-MM-DD
function convertirFecha($fecha) {
    $date = DateTime::createFromFormat('d-m-Y', $fecha);
    return $date ? $date->format('Y-m-d') : null;
}

// Sanitizar y obtener los datos del POST
$nombre = trim($_POST['namecte']);
$telefono = trim($_POST['phone']);
$encargado = trim($_POST['contactorh']);
$correo = filter_var(trim($_POST['correorh']), FILTER_VALIDATE_EMAIL) ? trim($_POST['correorh']) : null;
// Convertir las fechas antes de insertar
$fecha_contacto = convertirFecha($_POST['datecontact']);
$fecha_seguimiento = convertirFecha($_POST['dateSeguimiento']);
$comentarios = trim($_POST['comentarios']);
$domicilio = trim($_POST['domicilio']);
$colonia = trim($_POST['colonia']);
$telefono_empresa = trim($_POST['telefono_empresa']);
$cp = trim($_POST['cp']);
$estado = trim($_POST['estado']);
$municipio = trim($_POST['municipio']);
$giro = trim($_POST['giro']);
$empleados = is_numeric($_POST['empleados']) ? (int)$_POST['empleados'] : 0;
$transporte = is_numeric($_POST['transporte']) ? (int)$_POST['transporte'] : 0;
$turnos = is_numeric($_POST['turnos']) ? (int)$_POST['turnos'] : 0;
$unidad = is_numeric($_POST['unidad']) ? (int)$_POST['unidad'] : 0;
$origen = is_numeric($_POST['origen']) ? (int)$_POST['origen'] : 0;
$razon_social = trim($_POST['razonSocial']);
$estatus = 1;
$semaforo = 1;

// Preparar la consulta
$stmt = mysqli_prepare($conection, "
    INSERT INTO prospectos (
        nombre_comercial, razon_social, correo, telefono, encargado, 
        domicilio, comentarios, fecha_contacto, fecha_seguimiento, 
        estatus, origen, cp, municipio, estado, giro_comercial, 
        no_empleados, transporte, turnos, tipo_unidad, telefono_empresa, semaforo
    ) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$response = [];

if (!$stmt) {
    $response = [
        'success' => false,
        'message' => 'Error en preparación: ' . mysqli_error($conection)
    ];
} else {
    mysqli_stmt_bind_param($stmt, 'sssssssssiissssiiiisi', 
        $nombre, $razon_social, $correo, $telefono, $encargado, 
        $domicilio, $comentarios, $fecha_contacto, $fecha_seguimiento, 
        $estatus, $origen, $cp, $municipio, $estado, $giro, 
        $empleados, $transporte, $turnos, $unidad, $telefono_empresa, $semaforo
    );

    if (mysqli_stmt_execute($stmt)) {
        $last_id = mysqli_insert_id($conection); // Obtener el ID del registro insertado
        $response = [
            'success' => true,
            'message' => 'Registro exitoso',
            'id' => $last_id
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Error en ejecución: ' . mysqli_stmt_error($stmt)
        ];
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conection);
echo json_encode($response);
?>
