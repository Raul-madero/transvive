<?php
session_start();
include('../../conexion.php');

if(!$conection) {
    die(json_encode(['error' => 'Error de conexión a la base de datos']));
}

var_dump($_POST);

$nombre = mysqli_real_escape_string($conection, $_POST['namecte']);
$telefono = mysqli_real_escape_string($conection, $_POST['phone']);
$encargado = mysqli_real_escape_string($conection, $_POST['contactorh']);
$correo = mysqli_real_escape_string($conection, $_POST['correorh']);
$fecha_contacto = $_POST['datecontact'];
$fecha_obj = DateTime::createFromFormat('d/m/Y', $fecha_input); // Cambia el formato según lo recibido

if ($fecha_obj) {
    $fecha_mysql = $fecha_obj->format('Y-m-d');
}
$fecha_seguimiento = $_POST['dateSeguimiento'];
$fecha_obj_seguimiento = DateTime::createFromFormat('d/m/Y', $fecha_input); // Cambia el formato según lo recibido

if ($fecha_obj_seguimiento) {
    $fecha_mysql_seguimiento = $fecha_obj_seguimiento->format('Y-m-d');
}
$comentarios = mysqli_real_escape_string($conection, $_POST['comentarios']);
$domicilio = mysqli_real_escape_string($conection, $_POST['domicilio']);
$colonia = mysqli_real_escape_string($conection, $_POST['colonia']);
$telefono_empresa = mysqli_real_escape_string($conection, $_POST['telefono_empresa']);
$cp = mysqli_real_escape_string($conection, $_POST['cp']);
$estado = mysqli_real_escape_string($conection, $_POST['estado']);
$municipio = mysqli_real_escape_string($conection, $_POST['municipio']);
$giro = mysqli_real_escape_string($conection, $_POST['giro']);
$empleados = $_POST['empleados'];
$transporte = $_POST['transporte'];
$turnos = $_POST['turnos'];
$unidad = $_POST['unidad'];
$origen = $_POST['origen'];
$razon_social = mysqli_real_escape_string($conection, $_POST['razonSocial']);
$estatus = 1;
$semaforo = 1;

$stmt = mysqli_prepare($conection, "INSERT INTO prospectos (nombre_comercial, razon_social, correo, telefono, encargado, domicilio, comentarios, fecha_contacto, fecha_seguimiento, estatus, origen, cp, municipio, estado, giro_comercial, no_empleados, transporte, turnos, tipo_unidad, telefono_empresa, semaforo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die(json_encode(['error' => 'Error en preparación: ' . mysqli_error($conection)]));
}

mysqli_stmt_bind_param($stmt, 'sssssssssiissssiiiisi', $nombre, $razon_social, $correo, $telefono, $encargado, $domicilio, $comentarios, $fecha_mysql, $fecha_mysql_seguimiento, $estatus, $origen, $cp, $municipio, $estado, $giro, $empleados, $transporte, $turnos, $unidad, $telefono_empresa, $semaforo);
$result = mysqli_stmt_execute($stmt);
if (!$result) {
    die(json_encode(['error' => 'Error en ejecución: ' . mysqli_stmt_error($stmt)]));
}

mysqli_stmt_close($stmt);
mysqli_close($conection);

echo json_encode(['success' => 'Registro exitoso']);
?>
