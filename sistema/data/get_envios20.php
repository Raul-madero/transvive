<?php
include "../../conexion.php"; // conexión a la base de datos

$banda_id20 = $_POST['banda_id20'] ?? '';
if (empty($banda_id20)) {
    echo '<option value="">- No se recibió la ruta -</option>';
    exit;
}

// Usamos consulta preparada
$sql = "SELECT DISTINCT horario
        FROM (
            SELECT horario1 AS horario, ruta FROM rutas
            UNION
            SELECT horario2, ruta FROM rutas
            UNION
            SELECT horario3, ruta FROM rutas
            UNION
            SELECT hmixto1, ruta FROM rutas
            UNION
            SELECT hmixto2, ruta FROM rutas
        ) T
        WHERE ruta = ? AND horario > '00:00:00'";

$stmt = mysqli_prepare($conection, $sql);
mysqli_stmt_bind_param($stmt, "s", $banda_id20);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$filas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_stmt_close($stmt);
mysqli_close($conection);
?>

<option value="">- Seleccione -</option>
<?php foreach ($filas as $op): ?>
<option value="<?= htmlspecialchars($op['horario']) ?>"><?= htmlspecialchars($op['horario']) ?></option>
<?php endforeach; ?>
