<?php
include "../conexion.php";
session_start();

// Obtener información del usuario y rol
$User = $_SESSION['user'] ?? null;
$rol = $_SESSION['rol'] ?? null;
$rol_name = $_SESSION['rol_name'] ?? null;

if (!$User || !$rol) {
    die("Acceso denegado. No se encontró la sesión de usuario.");
}

// Redirección según rol
if ($rol != 1) {
    $rolRedirects = [
        "Administrador" => "index.php",
        "Conductor" => "index_conductor.php",
        "Supervisor" => "index_supervisor.php",
        "Recursos Humanos" => "index_rhumanos.php",
        "Operaciones" => "index_operaciones.php",
        "Operador" => "index_operador.php",
        "Mantenimiento" => "index_mantto.php",
        "Jefe Operaciones" => "index_jefeoperaciones.php",
        "Gerencia" => "index_gerencia.php",
        "Almacen" => "index_almacen.php",
        "Calidad" => "index_calidad.php",
        "Monitorista" => "index_monitorista.php",
        "Compras" => "index_compras.php",
        "Ventas" => "index_ventas.php"
    ];
    header('Location: ' . ($rolRedirects[$rol_name] ?? 'sistema/'));
    exit;
}

// Obtener semana actual
$dhoy = date("Y-m-d");
$sqlnsem = "SELECT semana, dia_inicial, dia_final FROM semanas WHERE ? BETWEEN dia_inicial AND dia_final";
$stmt = mysqli_prepare($conection, $sqlnsem);
mysqli_stmt_bind_param($stmt, "s", $dhoy);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($srow = mysqli_fetch_assoc($result)) {
    $name_semana = $srow['semana'];
    $diaini = $srow['dia_inicial'];
    $diafin = $srow['dia_final'];
} else {
    die("No se pudo determinar la semana para la fecha actual.");
}
mysqli_stmt_close($stmt);

// Obtener viajes planeados y registrados
$sqlviajes = "SELECT MONTHNAME(fecha) AS Nmeses, SUM(valor_vuelta) AS Registrados, SUM(IF(planeado=1, valor_vuelta, 0)) AS Planeados FROM registro_viajes WHERE YEAR(fecha) = YEAR(CURDATE()) GROUP BY Nmeses";
$query = mysqli_query($conection, $sqlviajes);
$meses = [];
$viajesPlaneados = [];
$viajesRegistrados = [];
while ($row = mysqli_fetch_assoc($query)) {
    $meses[] = $row['Nmeses'];
    $viajesPlaneados[] = $row['Planeados'];
    $viajesRegistrados[] = $row['Registrados'];
}

// Obtener consumo de combustible
$sqlcombustible = "SELECT MONTHNAME(fecha) AS Nmes, SUM(importe) AS Importe, SUM(litros) AS Litros FROM carga_combustible WHERE YEAR(fecha) = YEAR(CURDATE()) GROUP BY Nmes";
$queryComb = mysqli_query($conection, $sqlcombustible);
$mesesComb = [];
$importeComb = [];
$litrosComb = [];
while ($row = mysqli_fetch_assoc($queryComb)) {
    $mesesComb[] = $row['Nmes'];
    $importeComb[] = $row['Importe'];
    $litrosComb[] = $row['Litros'];
}

mysqli_close($conection);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TRANSVIVE | ERP</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <h3 class="text-center mt-4">Resumen Semanal</h3>
                <p class="text-center"><strong>Semana: <?php echo $name_semana; ?></strong></p>
                
                <div id="graficaViajes"></div>
                <div id="graficaCombustible"></div>
            </div>
        </div>
    </div>

    <script>
        Highcharts.chart('graficaViajes', {
            chart: { type: 'bar' },
            title: { text: 'Viajes Planeados vs Registrados' },
            xAxis: { categories: <?php echo json_encode($meses); ?> },
            yAxis: { title: { text: 'Cantidad de Viajes' } },
            series: [
                { name: 'Planeados', data: <?php echo json_encode($viajesPlaneados); ?> },
                { name: 'Registrados', data: <?php echo json_encode($viajesRegistrados); ?> }
            ]
        });

        Highcharts.chart('graficaCombustible', {
            chart: { type: 'column' },
            title: { text: 'Consumo de Combustible' },
            xAxis: { categories: <?php echo json_encode($mesesComb); ?> },
            yAxis: { title: { text: 'Cantidad' } },
            series: [
                { name: 'Importe', data: <?php echo json_encode($importeComb); ?> },
                { name: 'Litros', data: <?php echo json_encode($litrosComb); ?> }
            ]
        });
    </script>
</body>
</html>
