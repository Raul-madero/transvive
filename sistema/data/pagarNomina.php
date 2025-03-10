<?php
session_start();
include("../../conexion.php");

if (!$conection) {
    die(json_encode(['status' => 'error', 'message' => 'Error de la conexión a la base de datos'])); 
}

// Obtener la semana y el año desde la tabla nomina_temp_2025 (suponiendo que todos los registros tienen los mismos valores)
$sql_obtener_semana_anio = "SELECT semana, anio FROM nomina_temp_2025 LIMIT 1";
$resultado_semana_anio = mysqli_query($conection, $sql_obtener_semana_anio);

if (mysqli_num_rows($resultado_semana_anio) > 0) {
    $fila = mysqli_fetch_assoc($resultado_semana_anio);
    $semana_actual = $fila['semana'];
    $anio_actual = $fila['anio'];
} else {
    die(json_encode(['status' => 'error', 'message' => 'No se encontraron registros en la tabla nomina_temp_2025.']));
}

// Verificar si ya existe un registro para la misma semana y año en historico_nomina
$sql_verificar_existencia = "SELECT 1 FROM historico_nomina WHERE semana = $semana_actual AND anio = $anio_actual LIMIT 1";
$resultado_verificacion = mysqli_query($conection, $sql_verificar_existencia);

if (mysqli_num_rows($resultado_verificacion) > 0) {
    die(json_encode(['status' => 'error', 'message' => 'Ya se ha registrado la nómina para esta semana y año.']));
}

// Insertar datos de nomina_temp_2025 a historico_nomina
$sql_insertar_historico = "INSERT INTO historico_nomina SELECT * FROM nomina_temp_2025";
$resultado_insertar_historico = mysqli_query($conection, $sql_insertar_historico);
if (!$resultado_insertar_historico) {
    die(json_encode(['status' => 'error', 'message' => 'Error al insertar los datos en historico_nomina: ' . mysqli_error($conection)]));
}

// Actualizar adeudos sumando las deducciones
$sql_insertar_adeudo = "UPDATE adeudos a
    JOIN nomina_temp_2025 n ON a.noempleado = n.noempleado
    SET a.total_abonado = IFNULL(a.total_abonado, 0) + n.deducciones
    WHERE n.deducciones IS NOT NULL";
$resultado_insertar_adeudo = mysqli_query($conection, $sql_insertar_adeudo);
if (!$resultado_insertar_adeudo) {
    die(json_encode(['status' => 'error', 'message' => 'Error al actualizar adeudos: ' . mysqli_error($conection)]));
}

// Limpiar la tabla nomina_temp_2025 después de la inserción
$sql_truncate_nomina_temp = "TRUNCATE TABLE nomina_temp_2025";
$resultado_truncate = mysqli_query($conection, $sql_truncate_nomina_temp);
if (!$resultado_truncate) {
    die(json_encode(['status' => 'error', 'message' => 'Error al vaciar la tabla nomina_temp_2025: ' . mysqli_error($conection)]));
}

//Limpiar la tabla importes fiscales
$sql_truncate_nomina_temp = "TRUNCATE TABLE importes_fiscales";
$resultado_truncate = mysqli_query($conection, $sql_truncate_nomina_temp);
if (!$resultado_truncate) {
    die(json_encode(['status' => 'error', 'message' => 'Error al vaciar la tabla importes fiscales: ' . mysqli_error($conection)]));
}

echo json_encode(['status' => 'success', 'message' => 'Operación completada correctamente']);
?>