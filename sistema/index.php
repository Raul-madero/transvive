<?php
include "../conexion.php";
session_start();

// Obtener información del usuario y rol
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
// if($rol != 1) {
// 	$rolRedirects = [
		
// 		"Conductor" => "sistema/index_conductor.php",
// 		"Supervisor" => "sistema/index_supervisor.php",
// 		"Recursos Humanos" => "sistema/index_rhumanos.php",
// 		"Operaciones" => "sistema/index_operaciones.php",
// 		"Operador" => "sistema/index_operador.php",
// 		"Mantenimiento" => "sistema/index_mantto.php",
// 		"Jefe Operaciones" => "sistema/index_jefeoperaciones.php",
// 		"Gerencia" => "sistema/index_gerencia.php",
// 		"Almacen" => "sistema/index_almacen.php",
// 		"Calidad" => "sistema/index_calidad.php",
// 		"Monitorista" => "sistema/index_monitorista.php",
// 		"Compras" => "sistema/index_compras.php",
// 		"Ventas" => "sistema/index_ventas.php"
// 	];

// 	if (isset($rolRedirects[$_SESSION['rol_name']])) {
// 		header('location: ' . $rolRedirects[$_SESSION['rol_name']]);
// 	} else {
// 		header('location: sistema/');
// 	}
// }
$sql = "SELECT * FROM rol WHERE idrol = $rol";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query);
$namerol = $filas['rol'];
$dhoy = date("Y-m-d");
$mes_actual = date("m");
$name_semana = '';
$diaini = '';
$diafin = '';


$sqlnsem = mysqli_query($conection, "SELECT semana as Nsemana, dia_inicial as Dini, dia_final as Dfin FROM semanas WHERE '$dhoy' BETWEEN dia_inicial AND dia_final");
if (!$sqlnsem) {
    die("Error en la consulta de la semana: " . mysqli_error($conection));
}

// Verificar si se obtuvo la semana
if ($srow = mysqli_fetch_array($sqlnsem)) {
    $name_semana = $srow['Nsemana'];
	$diaini = $srow['Dini'];
	$diafin = $srow['Dfin'];
} else {
    // En caso de no encontrar la semana correspondiente
    echo "No se pudo determinar la semana para la fecha actual.";
    mysqli_close($conection);
    exit;
}

include "../conexion.php";

// Consulta SQL viajes
$sqlviajes = mysqli_query($conection, "
    SELECT COUNT(CASE WHEN estatus = 3 AND semana = '$name_semana' THEN valor_vuelta END) as Cancelados, MONTHNAME(fecha) AS Nmeses, YEAR(fecha) AS anio, SUM(IF(planeado=1, valor_vuelta, 0)) AS Planeados, SUM(valor_vuelta) AS Registrados, (SUM(valor_vuelta) - SUM(IF(planeado=1, valor_vuelta, 0))) AS Diferencia, 100 - (SUM(IF(planeado=1, valor_vuelta, 0)) / SUM(valor_vuelta) * 100) AS Porcdiferencia FROM registro_viajes WHERE (estatus = 3 AND semana = '$name_semana') OR (YEAR(fecha) = YEAR(CURDATE()) AND estatus = 2) GROUP BY anio, Nmeses;
");

// Verificación de la consulta SQL
if (!$sqlviajes) {
    die("Error en la consulta: " . mysqli_error($conection));
};

// Inicialización del array de resultados
$viajesData = [];

while ($drow = mysqli_fetch_assoc($sqlviajes)) {
    $viajesData[] = [
        'Nmeses' => $drow['Nmeses'],
        'Planeados' => $drow['Planeados'],
        'Registrados' => $drow['Registrados'],
        'Diferencia' => $drow['Diferencia'],
        'Porcdiferencia' => number_format($drow['Porcdiferencia'], 2),
		'Cancelados' => $drow['Cancelados']
    ];
};

$datos_mes_actual = $viajesData[9];

//Calcular Porcentajes
 $p_planeados = $datos_mes_actual['Planeados'] - $datos_mes_actual['Cancelados']; 
 $porc_planeados = ($datos_mes_actual['Planeados'] == 0) ? 0 : number_format(($p_planeados / $datos_mes_actual['Planeados']) * 100, 2); 
 $porc_registrados = ($datos_mes_actual['Planeados'] == 0) ? 0 : number_format(100 - (($datos_mes_actual['Registrados'] / $datos_mes_actual['Planeados']) * 100), 2); 
 $porc_diferencia = 0; 
 $porc_cancelados = 0; 
 if ($datos_mes_actual['Planeados'] > 0) { 
	$p_diferencia = $datos_mes_actual['Planeados'] - $datos_mes_actual['Registrados'];
	$porc_diferencia = number_format(($datos_mes_actual['Registrados'] / $p_diferencia) * 100, 2); 
	$porc_cancelados = number_format(($datos_mes_actual['Cancelados'] / $datos_mes_actual['Planeados']) * 100, 2); 
};

// Consulta para obtener los datos de los viajes planeados y la diferencia para la semana
$sqlviajes_semana = mysqli_query($conection, "
SELECT 
    YEAR(fecha) as anio,
    SUM(IF(planeado = 1, 1, 0)) as ViajesPlaneadosSemana,
    SUM(valor_vuelta) as TotalVueltasSemana,
    SUM(IF(planeado = 1, valor_vuelta, 0)) as TotalVueltasPlaneadasSemana,
    SUM(IF(planeado = 1, valor_vuelta, 0)) - SUM(valor_vuelta) as DiferenciaSemanal,
    COUNT(CASE WHEN estatus = 3 THEN valor_vuelta END) as CanceladosSemana
FROM registro_viajes
WHERE semana = '$name_semana'
GROUP BY YEAR(fecha)
");


if (!$sqlviajes_semana) {
    die("Error en la consulta: " . mysqli_error($conection));
};

// Comprobar si se encontraron registros
if ($prow = mysqli_fetch_assoc($sqlviajes_semana)) {
    // Asignar los valores obtenidos
    $viajes_planeados_semana = $prow['ViajesPlaneadosSemana'];  // Total de viajes planeados
    $total_vueltas_semana = $prow['TotalVueltasSemana']; // Suma total de "valor_vuelta"
    $vueltas_planeadas_semana = $prow['TotalVueltasPlaneadasSemana']; // Total de "valor_vuelta" para viajes planeados
    $diferencia_semana = $prow['DiferenciaSemanal']; // Diferencia total calculada
	$cancelados_semana = $prow['CanceladosSemana']; // Total de viajes cancelados
} else {
    // Si no se encuentran registros, asignamos valores por defecto
    $viajes_planeados_semana = 0;
    $total_vueltas_semana = 0;
    $vueltas_planeadas_semana = 0;
    $diferencia_semana = 0;
	$cancelados_semana = 0;
    echo "No se encontraron registros para la semana: $name_semana.";
};

//Calculo porcentajes semanales
$p_planeados_semanales = $viajes_planeados_semana - $cancelados_semana;
$porc_planeados_semana = ($viajes_planeados_semana == 0) ? 0 : number_format(($p_planeados_semanales / $viajes_planeados_semana) * 100, 2);
$porc_registrados_semana = ($viajes_planeados_semana == 0) ? 0 : number_format(($vueltas_planeadas_semana / $viajes_planeados_semana) * 100, 2);
$porc_diferencia_semana = 0;
$porc_cancelados_semana = 0;
if($viajes_planeados_semana > 0) {
	$p_diferencia_semana = $viajes_planeados_semana - $vueltas_planeadas_semana;
	$porc_diferencia_semana = number_format(($vueltas_planeadas_semana / $p_diferencia_semana) * 100, 2);
	$porc_cancelados_semana = number_format(($cancelados_semana / $viajes_planeados_semana) * 100, 2);
};

$sqlcomprames = mysqli_query($conection, "
	SELECT 
		MONTHNAME(fecha) as Nmeses, 
		YEAR(fecha) as anio, 
		SUM(CASE 
			WHEN fecha >= '$diaini' AND fecha <= '$diafin' THEN total 
			ELSE 0 
		END) as totalcompras_semana,
		SUM(CASE 
			WHEN MONTH(fecha) = MONTH(CURDATE()) THEN total 
			ELSE 0 
		END) as totalcompras_mes
	FROM compras
	WHERE estatus = 1
	GROUP BY anio, Nmeses
");

if (!$sqlcomprames) {
    die("Error en la consulta: " . mysqli_error($conection));
};

// Si hay resultados, asignamos el valor formateado
$comprasmes = 0.00;
$compras_semana = 0.00;
if ($datanc = mysqli_fetch_assoc($sqlcomprames)) {
    $comprasmes = number_format($datanc['totalcompras'], 2);
	$compras_semana = number_format($datanc['totalcompras_semana'], 2);
};

mysqli_close($conection);

include "../conexion.php";

// Obtener el mes actual en formato textual
$lasemana = date("n");
$monthNum = $lasemana;
$dateObj = DateTime::createFromFormat('!m', $monthNum);
setlocale(LC_TIME, 'es_MX');
$NameMes = $dateObj->format('F');  // Mes en español
// Consultar importes y litros agrupados por mes
$sqlenc = mysqli_query($conection, "
    SELECT MONTH(fecha) AS Nmes, SUM(importe) AS Importec, SUM(litros) AS Litros 
    FROM carga_combustible 
    WHERE YEAR(fecha) = 2024 AND estatus <> 0 
    GROUP BY MONTH(fecha)
");

mysqli_close($conection);

$importes = array_fill(1, 12, 0); // Inicializar arreglo de importes con 12 elementos (meses) en 0
$litros = array_fill(1, 12, 0);   // Inicializar arreglo de litros con 12 elementos (meses) en 0

if ($sqlenc && mysqli_num_rows($sqlenc) > 0) {
    while ($data = mysqli_fetch_assoc($sqlenc)) {
        $mes = (int)$data['Nmes'];
        $importes[$mes] = $data['Importec'];
        $litros[$mes] = $data['Litros'];
    }
};

$mes_consulta = (int)date('m');
$importes_mes_actual = $importes[$mes_consulta];
$litros_mes_actual = $litros[$mes_consulta];

// Ejemplo: cómo acceder a los valores para el mes 1
$nimportemes1 = $importes[1];
$nlitros1 = $litros[1];

// Puedes iterar o acceder fácilmente a cualquier mes con $importes y $litros

// Consultar las compras agrupadas por mes y año
include '../conexion.php'; // Conexión a la base de datos

// Consultar las compras agrupadas por mes y año
$sqlenc = mysqli_query($conection, "
    SELECT 
        MONTH(fecha) AS Nmes, 
        YEAR(fecha) AS anio, 
        SUM(total) AS totalcompra 
    FROM compras 
    WHERE YEAR(fecha) = YEAR(CURDATE()) AND estatus <> 0 
    GROUP BY anio, Nmes
    ORDER BY anio, Nmes
");

// Validar consulta
if (!$sqlenc) {
    die("Error en la consulta");
};

// Inicializar los arreglos para los importes por mes
$compras_por_mes = array_fill(1, 12, 0); // Inicializa un arreglo de 12 meses con valor 0

// Almacenar los resultados en el arreglo correspondiente
while ($data = mysqli_fetch_array($sqlenc)) {
    $mes = $data['Nmes'];
    $compras_por_mes[$mes] = $data['totalcompra']; // Asigna el valor de compra al mes correspondiente
};

mysqli_close($conection);

// Asignación final para cada mes, asegurando que el valor esté inicializado a 0 si no se encontró en la consulta
$comprames1 = $compras_por_mes[1];
$comprames2 = $compras_por_mes[2];
$comprames3 = $compras_por_mes[3];
$comprames4 = $compras_por_mes[4];
$comprames5 = $compras_por_mes[5];
$comprames6 = $compras_por_mes[6];
$comprames7 = $compras_por_mes[7];
$comprames8 = $compras_por_mes[8];
$comprames9 = $compras_por_mes[9];
$comprames10 = $compras_por_mes[10];
$comprames11 = $compras_por_mes[11];
$comprames12 = $compras_por_mes[12];

include "../conexion.php"; // Conexión a la base de datos

// Consultar las compras agrupadas por mes y año
$sqlenc = mysqli_query($conection, "
    SELECT 
        MONTH(fecha) AS Nmes, 
        YEAR(fecha) AS anio, 
        SUM(total) AS totalocompra 
    FROM orden_compra 
    WHERE YEAR(fecha) = YEAR(CURDATE()) AND estatus <> 0 
    GROUP BY anio, Nmes
    ORDER BY anio, Nmes
");

// Validar la consulta
if (!$sqlenc) {
    die("Error en la consulta");
};

// Inicializar un arreglo con los valores de compra por mes
$compras_por_mes = array_fill(1, 12, 0); // Inicializa un arreglo con 12 elementos, todos en 0

// Almacenar los resultados en el arreglo correspondiente
while ($data = mysqli_fetch_array($sqlenc)) {
    $mes = $data['Nmes'];
    $compras_por_mes[$mes] = $data['totalocompra']; // Asigna el valor de compra al mes correspondiente
};

mysqli_close($conection);

// Asignación final para cada mes
$ocomprames1 = $compras_por_mes[1];
$ocomprames2 = $compras_por_mes[2];
$ocomprames3 = $compras_por_mes[3];
$ocomprames4 = $compras_por_mes[4];
$ocomprames5 = $compras_por_mes[5];
$ocomprames6 = $compras_por_mes[6];
$ocomprames7 = $compras_por_mes[7];
$ocomprames8 = $compras_por_mes[8];
$ocomprames9 = $compras_por_mes[9];
$ocomprames10 = $compras_por_mes[10];
$ocomprames11 = $compras_por_mes[11];
$ocomprames12 = $compras_por_mes[12];

include "../conexion.php";

$sqlprom = mysqli_query($conection, "
    SELECT 
        (
            (SUM(tiempo_forma) + SUM(tiempo_respuesta) + SUM(disponibilidad) + 
            SUM(calidad) + SUM(asesoria_tecnica) + SUM(limpieza_condicion) + 
            SUM(servicio_operador) + SUM(conduce_adecuado) + 
            SUM(atencion_calidad) + SUM(servicio_facturacion) + 
            SUM(nuestros_precios)) 
            / 
            (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + 
            COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + 
            COUNT(servicio_operador) + COUNT(conduce_adecuado) + 
            COUNT(atencion_calidad) + COUNT(servicio_facturacion) + 
            COUNT(nuestros_precios)) 
        ) as promedio 
    FROM newencuesta_clientes 
    WHERE YEAR(fecha) = YEAR(CURDATE())
");

// Validar la consulta
if (!$sqlprom) {
    die("Error en la consulta SQL");
};

// Obtener el resultado
$rowprom = mysqli_fetch_array($sqlprom);
$promedio = $rowprom['promedio'] ?? 0; // Asignar 0 si no se obtiene resultado

// Cerrar la conexión
mysqli_close($conection);

include "../conexion.php";

// Consulta SQL optimizada: realizamos los cálculos directamente en la consulta y obtenemos todos los resultados en un solo paso
$sqlenc23 = mysqli_query($conection, "
    SELECT 
        SUM(tiempo_forma)/COUNT(tiempo_forma) AS Timeforma, 
        SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) AS Timerespuesta, 
        SUM(disponibilidad)/COUNT(disponibilidad) AS Disponibilidad, 
        SUM(calidad)/COUNT(calidad) AS Calidad, 
        SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) AS Asesoriatecnica, 
        SUM(limpieza_condicion)/COUNT(limpieza_condicion) AS Limpieza, 
        SUM(servicio_operador)/COUNT(servicio_operador) AS Servicio, 
        SUM(conduce_adecuado)/COUNT(conduce_adecuado) AS Conduce, 
        SUM(atencion_calidad)/COUNT(atencion_calidad) AS Atencion, 
        SUM(servicio_facturacion)/COUNT(servicio_facturacion) AS Facturacion, 
        SUM(nuestros_precios)/COUNT(nuestros_precios) AS Precios, 
        COUNT(*) AS Numeroreg 
    FROM newencuesta_clientes 
    WHERE YEAR(fecha) = 2024
");

// Verificar si la consulta se ejecutó correctamente
if (!$sqlenc23) {
    die("Error en la consulta SQL");
};

// Verificar si se obtuvo un resultado
$dataenc = mysqli_fetch_array($sqlenc23);

// Cerrar la conexión
mysqli_close($conection);

// Asignar los resultados a las variables
if ($dataenc) {
    // Formateamos los resultados y los almacenamos en un array
    $respuestas = [
        'Timeforma' => number_format($dataenc['Timeforma'], 1),
        'Timerespuesta' => number_format($dataenc['Timerespuesta'], 1),
        'Disponibilidad' => number_format($dataenc['Disponibilidad'], 1),
        'Calidad' => number_format($dataenc['Calidad'], 1),
        'Asesoriatecnica' => number_format($dataenc['Asesoriatecnica'], 1),
        'Limpieza' => number_format($dataenc['Limpieza'], 1),
        'Servicio' => number_format($dataenc['Servicio'], 1),
        'Conduce' => number_format($dataenc['Conduce'], 1),
        'Atencion' => number_format($dataenc['Atencion'], 1),
        'Facturacion' => number_format($dataenc['Facturacion'], 1),
        'Precios' => number_format($dataenc['Precios'], 1),
        'Numeroreg' => number_format($dataenc['Numeroreg'], 0),
    ];
} else {
    // Si no hay resultados, asignar valores por defecto
    $respuestas = [
        'Timeforma' => 0,
        'Timerespuesta' => 0,
        'Disponibilidad' => 0,
        'Calidad' => 0,
        'Asesoriatecnica' => 0,
        'Limpieza' => 0,
        'Servicio' => 0,
        'Conduce' => 0,
        'Atencion' => 0,
        'Facturacion' => 0,
        'Precios' => 0,
        'Numeroreg' => 0,
    ];
};

// Acceder a las variables ya formateadas
$resp1_23 = $respuestas['Timeforma'];
$resp2_23 = $respuestas['Timerespuesta'];
$resp3_23 = $respuestas['Disponibilidad'];
$resp4_23 = $respuestas['Calidad'];
$resp5_23 = $respuestas['Asesoriatecnica'];
$resp6_23 = $respuestas['Limpieza'];
$resp7_23 = $respuestas['Servicio'];
$resp8_23 = $respuestas['Conduce'];
$resp9_23 = $respuestas['Atencion'];
$resp10_23 = $respuestas['Facturacion'];
$resp11_23 = $respuestas['Precios'];
$resp12_23 = $respuestas['Numeroreg'];

include "../conexion.php";

// Consulta SQL optimizada: se realiza todo el cálculo en un solo paso
$sqlenc24 = mysqli_query($conection, "
    SELECT 
        SUM(tiempo_forma)/COUNT(tiempo_forma) AS Timeforma, 
        SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) AS Timerespuesta, 
        SUM(disponibilidad)/COUNT(disponibilidad) AS Disponibilidad, 
        SUM(calidad)/COUNT(calidad) AS Calidad, 
        SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) AS Asesoriatecnica, 
        SUM(limpieza_condicion)/COUNT(limpieza_condicion) AS Limpieza, 
        SUM(servicio_operador)/COUNT(servicio_operador) AS Servicio, 
        SUM(conduce_adecuado)/COUNT(conduce_adecuado) AS Conduce, 
        SUM(atencion_calidad)/COUNT(atencion_calidad) AS Atencion, 
        SUM(servicio_facturacion)/COUNT(servicio_facturacion) AS Facturacion, 
        SUM(nuestros_precios)/COUNT(nuestros_precios) AS Precios, 
        COUNT(*) AS Numeroreg 
    FROM newencuesta_clientes 
    WHERE YEAR(fecha) = 2024
");

// Verificar si la consulta se ejecutó correctamente
if (!$sqlenc24) {
    die("Error en la consulta SQL");
};

// Verificar si se obtuvo un resultado
$dataenc = mysqli_fetch_array($sqlenc24);

// Cerrar la conexión
mysqli_close($conection);

// Asignar los resultados a un array
$respuestas = [
    'Timeforma' => number_format($dataenc['Timeforma'] ?? 0, 1),
    'Timerespuesta' => number_format($dataenc['Timerespuesta'] ?? 0, 1),
    'Disponibilidad' => number_format($dataenc['Disponibilidad'] ?? 0, 1),
    'Calidad' => number_format($dataenc['Calidad'] ?? 0, 1),
    'Asesoriatecnica' => number_format($dataenc['Asesoriatecnica'] ?? 0, 1),
    'Limpieza' => number_format($dataenc['Limpieza'] ?? 0, 1),
    'Servicio' => number_format($dataenc['Servicio'] ?? 0, 1),
    'Conduce' => number_format($dataenc['Conduce'] ?? 0, 1),
    'Atencion' => number_format($dataenc['Atencion'] ?? 0, 1),
    'Facturacion' => number_format($dataenc['Facturacion'] ?? 0, 1),
    'Precios' => number_format($dataenc['Precios'] ?? 0, 1),
    'Numeroreg' => number_format($dataenc['Numeroreg'] ?? 0, 0),
];

// Acceder a las variables ya formateadas
$resp1_24 = $respuestas['Timeforma'];
$resp2_24 = $respuestas['Timerespuesta'];
$resp3_24 = $respuestas['Disponibilidad'];
$resp4_24 = $respuestas['Calidad'];
$resp5_24 = $respuestas['Asesoriatecnica'];
$resp6_24 = $respuestas['Limpieza'];
$resp7_24 = $respuestas['Servicio'];
$resp8_24 = $respuestas['Conduce'];
$resp9_24 = $respuestas['Atencion'];
$resp10_24 = $respuestas['Facturacion'];
$resp11_24 = $respuestas['Precios'];
$resp12_24 = $respuestas['Numeroreg'];

include "../conexion.php";

// Consulta SQL optimizada: se realiza todo el cálculo en un solo paso
$sqlenc25 = mysqli_query($conection, "
    SELECT 
        SUM(tiempo_forma)/COUNT(tiempo_forma) AS Timeforma, 
        SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) AS Timerespuesta, 
        SUM(disponibilidad)/COUNT(disponibilidad) AS Disponibilidad, 
        SUM(calidad)/COUNT(calidad) AS Calidad, 
        SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) AS Asesoriatecnica, 
        SUM(limpieza_condicion)/COUNT(limpieza_condicion) AS Limpieza, 
        SUM(servicio_operador)/COUNT(servicio_operador) AS Servicio, 
        SUM(conduce_adecuado)/COUNT(conduce_adecuado) AS Conduce, 
        SUM(atencion_calidad)/COUNT(atencion_calidad) AS Atencion, 
        SUM(servicio_facturacion)/COUNT(servicio_facturacion) AS Facturacion, 
        SUM(nuestros_precios)/COUNT(nuestros_precios) AS Precios, 
        COUNT(*) AS Numeroreg 
    FROM newencuesta_clientes 
    WHERE YEAR(fecha) = 2025
");

// Verificar si la consulta se ejecutó correctamente
if (!$sqlenc25) {
    die("Error en la consulta SQL");
};

// Verificar si se obtuvo un resultado
$dataenc = mysqli_fetch_array($sqlenc25);

// Cerrar la conexión
mysqli_close($conection);

// Asignar los resultados a un array
$respuestas = [
    'Timeforma' => number_format($dataenc['Timeforma'] ?? 0, 1),
    'Timerespuesta' => number_format($dataenc['Timerespuesta'] ?? 0, 1),
    'Disponibilidad' => number_format($dataenc['Disponibilidad'] ?? 0, 1),
    'Calidad' => number_format($dataenc['Calidad'] ?? 0, 1),
    'Asesoriatecnica' => number_format($dataenc['Asesoriatecnica'] ?? 0, 1),
    'Limpieza' => number_format($dataenc['Limpieza'] ?? 0, 1),
    'Servicio' => number_format($dataenc['Servicio'] ?? 0, 1),
    'Conduce' => number_format($dataenc['Conduce'] ?? 0, 1),
    'Atencion' => number_format($dataenc['Atencion'] ?? 0, 1),
    'Facturacion' => number_format($dataenc['Facturacion'] ?? 0, 1),
    'Precios' => number_format($dataenc['Precios'] ?? 0, 1),
    'Numeroreg' => number_format($dataenc['Numeroreg'] ?? 0, 0),
];

// Acceder a las variables ya formateadas
$resp1_25 = $respuestas['Timeforma'];
$resp2_25 = $respuestas['Timerespuesta'];
$resp3_25 = $respuestas['Disponibilidad'];
$resp4_25 = $respuestas['Calidad'];
$resp5_25 = $respuestas['Asesoriatecnica'];
$resp6_25 = $respuestas['Limpieza'];
$resp7_25 = $respuestas['Servicio'];
$resp8_25 = $respuestas['Conduce'];
$resp9_25 = $respuestas['Atencion'];
$resp10_25 = $respuestas['Facturacion'];
$resp11_25 = $respuestas['Precios'];
$resp12_25 = $respuestas['Numeroreg'];





include "../conexion.php";

// Consulta SQL
$sqlenc10 = mysqli_query(
    $conection,
    "SELECT 
        cliente, 
        fecha, 
        tiempo_forma, 
        tiempo_respuesta, 
        disponibilidad, 
        calidad, 
        asesoria_tecnica, 
        limpieza_condicion, 
        servicio_operador, 
        conduce_adecuado, 
        atencion_calidad, 
        servicio_facturacion, 
        nuestros_precios 
    FROM 
        newencuesta_clientes 
    WHERE 
        YEAR(fecha) = YEAR(CURDATE())"
);

// Verificación de la consulta SQL
if (!$sqlenc10) {
    die("Error en la consulta: " . mysqli_error($conection));
};

// Inicialización de array multidimensional para almacenar los datos
$encuestasData = [];

while ($nrow = mysqli_fetch_assoc($sqlenc10)) {
    $encuestasData[] = [
        'cliente' => $nrow['cliente'],
        'tiempo_forma' => $nrow['tiempo_forma'],
        'tiempo_respuesta' => $nrow['tiempo_respuesta'],
        'disponibilidad' => $nrow['disponibilidad'],
        'calidad' => $nrow['calidad'],
        'asesoria_tecnica' => $nrow['asesoria_tecnica'],
        'limpieza_condicion' => $nrow['limpieza_condicion'],
        'servicio_operador' => $nrow['servicio_operador'],
        'conduce_adecuado' => $nrow['conduce_adecuado'],
        'atencion_calidad' => $nrow['atencion_calidad'],
        'servicio_facturacion' => $nrow['servicio_facturacion'],
        'nuestros_precios' => $nrow['nuestros_precios']
    ];
};

// Cerrar la conexión a la base de datos
mysqli_close($conection);

// Si necesitas acceder a los datos posteriormente:
// foreach ($encuestasData as $encuesta) {
//     echo "Cliente: " . $encuesta['cliente'] . "<br>";
//     echo "Tiempo forma: " . $encuesta['tiempo_forma'] . "<br>";
//     echo "Tiempo respuesta: " . $encuesta['tiempo_respuesta'] . "<br>";
//     echo "Disponibilidad: " . $encuesta['disponibilidad'] . "<br>";
//     echo "Calidad: " . $encuesta['calidad'] . "<br>";
//     echo "Asesoría técnica: " . $encuesta['asesoria_tecnica'] . "<br>";
//     echo "Limpieza condición: " . $encuesta['limpieza_condicion'] . "<br>";
//     echo "Servicio operador: " . $encuesta['servicio_operador'] . "<br>";
//     echo "Conduce adecuado: " . $encuesta['conduce_adecuado'] . "<br>";
//     echo "Atención calidad: " . $encuesta['atencion_calidad'] . "<br>";
//     echo "Servicio facturación: " . $encuesta['servicio_facturacion'] . "<br>";
//     echo "Nuestros precios: " . $encuesta['nuestros_precios'] . "<br><br>";
// }



$aniocurso = date("Y");

include "../conexion.php";

// Realizar la consulta a la base de datos
$sqlenc024 = mysqli_query($conection, "SELECT 
    SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma,
    SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta,
    SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad,
    SUM(calidad)/COUNT(calidad) as Calidad,
    SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica,
    SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza,
    SUM(servicio_operador)/COUNT(servicio_operador) as Servicio,
    SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce,
    SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion,
    SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion,
    SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios,
    count(*) as Numeroreg 
FROM newencuesta_clientes 
WHERE YEAR(fecha) = YEAR(CURDATE())");

mysqli_close($conection);

// Inicializar las variables de respuesta
$respuestas = [
    'Timeforma' => 0,
    'Timerespuesta' => 0,
    'Disponibilidad' => 0,
    'Calidad' => 0,
    'Asesoriatecnica' => 0,
    'Limpieza' => 0,
    'Servicio' => 0,
    'Conduce' => 0,
    'Atencion' => 0,
    'Facturacion' => 0,
    'Precios' => 0,
    'Numeroreg' => 0
];

// Verificar si la consulta devolvió resultados
$result_sqlenc024 = mysqli_num_rows($sqlenc024);
if ($result_sqlenc024 > 0) {
    $dataenc = mysqli_fetch_array($sqlenc024);

    // Calcular el porcentaje y almacenar en el array de respuestas
    foreach ($respuestas as $key => $value) {
        if ($key != 'Numeroreg') {
            // Para las métricas que no son 'Numeroreg', calculamos el porcentaje
            $respuestas[$key] = (number_format($dataenc[$key], 2) * 100) / 10 . '%';
        } else {
            // 'Numeroreg' no es un porcentaje, solo formateamos el número
            $respuestas[$key] = number_format($dataenc[$key], 0);
        };
    };
};

// Para comprobar, imprime las respuestas
// foreach ($respuestas as $key => $value) {
//     echo $key . ': ' . $value . '<br>';
// }



include "../conexion.php";

// Consulta para obtener la semana actual
$sqlnsem = mysqli_query($conection, "SELECT semana as Nsemana FROM semanas WHERE '$dhoy' BETWEEN dia_inicial AND dia_final");

if (!$sqlnsem) {
    die("Error en la consulta de la semana: " . mysqli_error($conection));
};

// Verificar si se obtuvo la semana
if ($srow = mysqli_fetch_array($sqlnsem)) {
    $name_semana = $srow['Nsemana'];
} else {
    // En caso de no encontrar la semana correspondiente
    echo "No se pudo determinar la semana para la fecha actual.";
    mysqli_close($conection);
    exit;
};

// Consulta para obtener los registros de viajes de la semana
$sqlvsem = mysqli_query($conection, "SELECT 
    YEAR(fecha) as anio, 
    SUM(IF(planeado = 1, valor_vuelta, 0)) as Planeados, 
    SUM(valor_vuelta) as Registrados,
    (SUM(valor_vuelta) - SUM(IF(planeado = 1, valor_vuelta, 0))) as Diferencia, 
    100 - (SUM(IF(planeado = 1, valor_vuelta, 0)) / SUM(valor_vuelta) * 100) as Porcdiferencia 
FROM registro_viajes
WHERE semana = '$name_semana' AND estatus = 2
GROUP BY anio");

if (!$sqlvsem) {
    die("Error en la consulta de los viajes: " . mysqli_error($conection));
};

if ($vrow = mysqli_fetch_assoc($sqlvsem)) {
    // Asignar los valores de los resultados de la consulta
    $v_planeados   = $vrow['Planeados'];
    $v_registrados = $vrow['Registrados'];
    $v_diferencia  = $vrow['Diferencia'];
    $v_porcdif     = $vrow['Porcdiferencia']; // Porcentaje de diferencia (ya redondeado)
} else {
    // Si no hay registros para la semana seleccionada
    echo "No se encontraron registros para la semana: $name_semana.";
};

mysqli_close($conection);


// Validación para asegurar que las variables estén definidas
$nv_registrados = isset($v_registrados) ? $v_registrados : 0.001;
$nv_diferencia = isset($v_diferencia) ? $v_diferencia : 0;

include "../conexion.php";

// Obtener viajes cancelados
$sqlviajescanc = mysqli_query($conection, "SELECT count(valor_vuelta) as viajes_cancelados FROM registro_viajes WHERE semana = '$name_semana' and estatus = 3 ");
mysqli_close($conection);

if ($datacanc = mysqli_fetch_array($sqlviajescanc)) {
    $v_cancelados = $datacanc['viajes_cancelados'];
};

// Cálculos de porcentajes
// $p_planeados = $vjs_planeados - $v_cancelados;
// $porc_planeados = ($vjs_planeados == 0) ? 0 : number_format(($p_planeados / $vjs_planeados) * 100, 2);

// $porc_registrados = ($vjs_planeados == 0) ? 0 : number_format(100 - (($nv_registrados / $vjs_planeados) * 100), 2);

// $porc_diferencia = 0;
// $porc_cancelados = 0;
// if ($vjs_planeados > 0) {
//     $p_diferencia = $vjs_planeados - $nv_registrados;
//     $porc_diferencia = number_format(($nv_registrados / $p_diferencia) * 100, 2);
//     $porc_cancelados = number_format(($v_cancelados / $vjs_planeados) * 100, 2);
// }

// Obtener el mes actual en formato textual
$lasemana = date("n");
$monthNum = $lasemana;
$dateObj = DateTime::createFromFormat('!m', $monthNum);
setlocale(LC_TIME, 'es_MX');
$NameMes = $dateObj->format('F');  // Mes en español

include "../conexion.php";

// Consulta para obtener las compras del mes actual


mysqli_close($conection);

// Si ya tienes un valor asignado a $compras_mes, lo asignas a $comprasmes
if (isset($compras_mes)) {
    $comprasmes = $compras_mes;
};

include "../conexion.php";

// Consulta para obtener las compras de la semana entre $diaini y $diafin


mysqli_close($conection);


include "../conexion.php";

// Consulta para obtener el consumo de combustible del mes actual
$sqlconsumomes = mysqli_query($conection, "SELECT 
    MONTH(fecha) as Nmeses, 
    YEAR(fecha) as anio, 
    SUM(importe) as totalgas 
FROM carga_combustible 
WHERE MONTH(fecha) = MONTH(CURDATE()) 
  AND YEAR(fecha) = YEAR(CURDATE())  -- Asegura que es el año actual
  AND estatus <> 0
GROUP BY Nmeses, anio");

if (!$sqlconsumomes) {
    die("Error en la consulta: " . mysqli_error($conection));
};

// Asignamos un valor por defecto en caso de no encontrar resultados
$consumo_mes = number_format(0.00, 2);

if ($datanc = mysqli_fetch_assoc($sqlconsumomes)) {
    $consumo_mes = number_format($datanc['totalgas'], 2); // Asignamos el valor del consumo
};

mysqli_close($conection);

include "../conexion.php";

// Consulta para obtener el consumo de combustible durante un rango de fechas específico
$sqlconsumosem = mysqli_query($conection, "SELECT 
    MONTHNAME(fecha) as Nmeses, 
    YEAR(fecha), 
    SUM(importe) as totalgas 
FROM carga_combustible 
WHERE fecha >= '$diaini' 
  AND fecha <= '$diafin' 
  AND estatus <> 0
GROUP BY fecha");

mysqli_close($conection);

// Verificamos si hay registros y calculamos el total
$consumo_semana = 0;  // Inicializamos con 0 en caso de no haber resultados

while ($datacanc = mysqli_fetch_array($sqlconsumosem)) {
    $consumo_semana = number_format($datacanc['totalgas'], 2);  // Asignamos el total de combustible
}

// Si no se encontró consumo, lo dejamos en 0
$consumosemana = $consumo_semana ?: 0;  // Si $consumo_semana es nulo o 0, asigna 0

include "../conexion.php";

// Realizamos la consulta SQL para obtener los promedios de los servicios
$sqlserv = mysqli_query($conection, "SELECT 
    SUM(IF(servicio_ventas = 'Excelente', 3, IF(servicio_ventas = 'Bueno', 2, IF(servicio_ventas = 'Regular', 1, IF(servicio_ventas = 'Malo', 0, 0)))))/COUNT(servicio_ventas) AS sventas,
    SUM(IF(servicio_supervisor = 'Excelente', 3, IF(servicio_supervisor = 'Bueno', 2, IF(servicio_supervisor = 'Regular', 1, IF(servicio_supervisor = 'Malo', 0, 0)))))/COUNT(servicio_supervisor) AS ssuperv,
    SUM(IF(servicio_jefe = 'Excelente', 3, IF(servicio_jefe = 'Bueno', 2, IF(servicio_jefe = 'Regular', 1, IF(servicio_jefe = 'Malo', 0, 0)))))/COUNT(servicio_jefe) AS sjefe,
    SUM(IF(servicio_quejas = 'Excelente', 3, IF(servicio_quejas = 'Bueno', 2, IF(servicio_quejas = 'Regular', 1, IF(servicio_quejas = 'Malo', 0, 0)))))/COUNT(servicio_quejas) AS squejas
FROM newencuesta_clientes
WHERE YEAR(fecha) = YEAR(CURDATE())");

// Cerrar la conexión después de la consulta
mysqli_close($conection);

// Verificar si hay resultados antes de almacenarlos
if ($rowsv = mysqli_fetch_array($sqlserv)) {
    $datosv[] = $rowsv['sventas'];
    $datoss[] = $rowsv['ssuperv'];
    $datosj[] = $rowsv['sjefe'];
    $datosq[] = $rowsv['squejas'];
} else {
    // En caso de que no se encuentren resultados, asignamos valores por defecto
    $datosv[] = 0;
    $datoss[] = 0;
    $datosj[] = 0;
    $datosq[] = 0;
};

include "../conexion.php";

// Realizamos la consulta SQL para obtener los promedios de los servicios por cliente
$sqlservct = mysqli_query($conection, "SELECT 
    cliente, 
    SUM(IF(servicio_ventas = 'Excelente', 3, IF(servicio_ventas = 'Bueno', 2, IF(servicio_ventas = 'Regular', 1, IF(servicio_ventas = 'Malo', 0, 0)))))/COUNT(servicio_ventas) AS sventas,
    SUM(IF(servicio_supervisor = 'Excelente', 3, IF(servicio_supervisor = 'Bueno', 2, IF(servicio_supervisor = 'Regular', 1, IF(servicio_supervisor = 'Malo', 0, 0)))))/COUNT(servicio_supervisor) AS ssuperv,
    SUM(IF(servicio_jefe = 'Excelente', 3, IF(servicio_jefe = 'Bueno', 2, IF(servicio_jefe = 'Regular', 1, IF(servicio_jefe = 'Malo', 0, 0)))))/COUNT(servicio_jefe) AS sjefe,
    SUM(IF(servicio_quejas = 'Excelente', 3, IF(servicio_quejas = 'Bueno', 2, IF(servicio_quejas = 'Regular', 1, IF(servicio_quejas = 'Malo', 0, 0)))))/COUNT(servicio_quejas) AS squejas
FROM newencuesta_clientes
WHERE YEAR(fecha) = YEAR(CURDATE())
GROUP BY cliente");

// Cerrar la conexión después de la consulta
mysqli_close($conection);

// Verificar si hay resultados antes de almacenarlos
if ($sqlservct && mysqli_num_rows($sqlservct) > 0) {
    while ($rowsvc = mysqli_fetch_array($sqlservct)) {
        $datoscte[] = $rowsvc['cliente'];
        $datosvct[] = $rowsvc['sventas'];
        $datossct[] = $rowsvc['ssuperv'];
        $datosjct[] = $rowsvc['sjefe'];
        $datosqct[] = $rowsvc['squejas'];
    };
} else {
    // Si no hay resultados, se asignan valores por defecto
    $datoscte = [];
    $datosvct = [];
    $datossct = [];
    $datosjct = [];
    $datosqct = [];
};

?>



<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TRANSVIVE | ERP</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/adminlte.min.css">
	<!-- Ekko Lightbox -->
	<link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->

	<!-- DataTables -->
	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="local/apis.css">

	<script type="text/javascript" src="./local/jquery.min.js"></script>
	<!--<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>-->
	<script src="local/highcharts.js"></script>
	<script src="local/Chart.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js"></script>

	<link rel="stylesheet" href="alertifyjs/css/alertify.min.css">
	<link rel="stylesheet" href="alertifyjs/css/themes/default.min.css">
	<script src="alertifyjs/alertify.min.js"></script>

	<style>
		#container {
			min-width: 310px;
			max-width: 800px;
			height: 465px;


		}

		.buttons {
			min-width: 310px;
			text-align: center;
			margin: 1rem 0;
			font-size: 0;
		}

		.buttons button {
			cursor: pointer;
			border: 1px solid silver;
			border-right-width: 0;
			background-color: #f8f8f8;
			font-size: 1rem;
			padding: 0.5rem;
			transition-duration: 0.3s;
			margin: 0;
		}

		.buttons button:first-child {
			border-top-left-radius: 0.3em;
			border-bottom-left-radius: 0.3em;
		}

		.buttons button:last-child {
			border-top-right-radius: 0.3em;
			border-bottom-right-radius: 0.3em;
			border-right-width: 1px;
		}

		.buttons button:hover {
			color: white;
			background-color: rgb(158 159 163);
			outline: none;
		}

		.buttons button.active {
			background-color: #0051b4;
			color: white;
		}

		/* container 2 */
		#container2,
		.highcharts-data-table table {
			min-width: 350px;
			max-width: 800px;
			margin: 1em auto;
		}

		#container2 {
			height: 450px;
		}

		.highcharts-data-table table {
			font-family: Verdana, sans-serif;
			border-collapse: collapse;
			border: 1px solid #ebebeb;
			margin: 10px auto;
			text-align: center;
			width: 100%;
			max-width: 500px;
		}

		.highcharts-data-table caption {
			padding: 1em 0;
			font-size: 1.2em;
			color: #555;
		}

		.highcharts-data-table th {
			font-weight: 600;
			padding: 0.5em;
		}

		.highcharts-data-table td,
		.highcharts-data-table th,
		.highcharts-data-table caption {
			padding: 0.5em;
		}

		.highcharts-data-table thead tr,
		.highcharts-data-table tr:nth-child(even) {
			background: #f8f8f8;
		}

		.highcharts-data-table tr:hover {
			background: #f1f7ff;
		}

		#container3 {
			height: 400px;
		}

		/* container 4d */
		#container4d,
		.highcharts-data-table table {
			min-width: 350px;
			max-width: 800px;
			margin: 1em auto;
		}

		#container4d {
			height: 450px;
		}

		/* container 5d */
		#container5d,
		.highcharts-data-table table {
			min-width: 350px;
			max-width: 800px;
			margin: 1em auto;
		}

		#container5d {
			height: 450px;
		}

		/* container 6d */
		#container6d,
		.highcharts-data-table table {
			min-width: 350px;
			max-width: 800px;
			margin: 1em auto;
		}

		#container6d {
			height: 450px;
		}


		.highcharts-data-table table {
			font-family: Verdana, sans-serif;
			border-collapse: collapse;
			border: 1px solid #ebebeb;
			margin: 10px auto;
			text-align: center;
			width: 100%;
			max-width: 500px;
		}

		.highcharts-data-table caption {
			padding: 1em 0;
			font-size: 1.2em;
			color: #555;
		}

		.highcharts-data-table th {
			font-weight: 600;
			padding: 0.5em;
		}

		.highcharts-data-table td,
		.highcharts-data-table th,
		.highcharts-data-table caption {
			padding: 0.5em;
		}

		.highcharts-data-table thead tr,
		.highcharts-data-table tr:nth-child(even) {
			background: #f8f8f8;
		}

		.highcharts-data-table tr:hover {
			background: #f1f7ff;
		}
	</style>


</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
			<div class="container">
				<a href="salir.php" class="navbar-brand">
					<span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
				</a>

				<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<?php include('includes/navbar.php') ?>
				<?php include('includes/nav.php') ?>

			</div>
		</nav>
		<!-- /.navbar -->

		<!-- Content Wrapper. Contains page content -->

		<!-- /.content-header -->
		<br>
		<!-- Main content -->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-lg-6">

							<!-- ./card-body -->
							<div class="card-footer">
								<p class="text-center">
									<strong>Ordenes de Servicio Semana en Curso <br><?php echo $name_semana; ?></strong>
								</p>
								<div class="row">
									<div class="col-lg-3">
										<div class="description-block border-right">
											<span class="description-percentage text-primary"><i class="fas fa-caret-left"></i><?php echo $porc_planeados_semana . " %" ?></span>
											<h5 class="description-header"><?php echo $viajes_planeados_semana; ?></h5>
											<span class="description-text">Viajes Planeados</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-lg-3">
										<div class="description-block border-right">
											<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?php echo $porc_registrados_semana; ?> %</span>
											<h5 class="description-header"><?php echo $total_vueltas_semana; ?></h5>
											<span class="description-text">Viajes Registrados</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-lg-3">
										<div class="description-block border-right">
											<span class="description-percentage text-info"><i class="fas fa-caret-up"></i> <?php echo $porc_diferencia_semana; ?> %</span>
											<h5 class="description-header"><?php echo $diferencia_semana; ?></h5>
											<span class="description-text">Diferencia</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-lg-3">
										<div class="description-block">
											<span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> <?php echo $porc_cancelados_semana; ?> %</span>
											<h5 class="description-header"><?php echo $cancelados_semana; ?></h5>
											<span class="description-text">Viajes Cancelados</span>
										</div>
										<!-- /.description-block -->
									</div>
								</div>
								<!-- /.row -->
							</div>
						</div>

						<div class="col-lg-6">

							<!-- ./card-body -->
							<div class="card-footer">
								<p class="text-center">
									<strong>Acumulados Mes / Semama<br><?php echo $NameMes; ?> / <?php echo $name_semana; ?></strong>
								</p>
								<div class="row">
									<div class="col-lg-3">
										<div class="description-block border-right">
											<span class="description-percentage text-primary"><i class="fas fa-cart-plus"></i> &nbsp; </span>
											<h5 class="description-header"><?php echo $comprasmes; ?></h5>
											<span class="description-text">Compras del Mes</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-lg-3">
										<div class="description-block border-right">
											<span class="description-percentage text-success"><i class="fas fa-cart-arrow-down"></i> &nbsp;</span>
											<h5 class="description-header"><?php echo $compras_semana; ?></h5>
											<span class="description-text">Compras Semana</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-lg-3">
										<div class="description-block border-right">
											<span class="description-percentage text-primary"><i class="fas fa-gas-pump"></i> &nbsp; </span>
											<h5 class="description-header"><?php echo $litros_mes_actual; ?></h5>
											<span class="description-text">Consumo Mes</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-lg-3">
										<div class="description-block">
											<span class="description-percentage text-danger"><i class="fas fa-gas-pump"></i> &nbsp; </span>
											<h5 class="description-header"><?php echo $consumosemana; ?></h5>
											<span class="description-text">Consumo Semana</span>
										</div>
										<!-- /.description-block -->
									</div>
								</div>
								<!-- /.row -->
							</div>
						</div>

					</div>

					<br>

					<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="position-relative mb-4">
									<figure class="highcharts-figure">

										<div id="container"></div>
									</figure>
								</div>

							</div>

						</div>
						<!-- /.col-md-6 -->
						<div class="col-lg-6">
							<div class="card">
								<div class="position-relative mb-4">
									<figure class="highcharts-figure">
										<div id="container4d"></div>
										<p class="highcharts-description">

										</p>
									</figure>
								</div>

							</div>
							<!-- /.card -->


						</div>
						<!-- /.col-md-6 -->
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="card">

								<div class="card-body">
									<div class="d-flex">
										<p class="d-flex flex-column">
											<span class="text-bold text-lg">Encuestas de Calidad</span>
											<span>Año: <?php echo $aniocurso; ?></span>
										</p>
										<p class="ml-auto d-flex flex-column text-right">
											<span class="text-success">
												<!--<i class="fas fa-arrow-up"></i> -->
											</span>
											<span class="text-muted"></span>
										</p>
									</div>
									<!-- /.d-flex -->

									<div class="position-relative mb-4">
										<canvas id="myChart" height="220"></canvas>
									</div>


								</div>
							</div>

						</div>

						<div class="col-lg-6">
							<div class="card">

								<div class="card-body" style="height:550px">
									<p class="text-center">
									<p class="d-flex flex-column">
										<span class="text-bold text-lg">Resultado de Encuesta por Concepto</span>
										<span><b>Promedio General: <?php echo number_format($promedio, 2) . '%'; ?></b></span>
									</p>
									</p>

									<div class="progress-group">
										Atención General
										<span class="float-right"><b><?php echo $respuesta1; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-primary" style="width: <?php echo $respuesta1; ?>"></div>
										</div>
									</div>
									<!-- /.progress-group -->

									<div class="progress-group">
										Tiempo de Respuesta
										<span class="float-right"><b><?php echo $respuesta2; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-info" style="width: <?php echo $respuesta2; ?>"></div>
										</div>
									</div>

									<!-- /.progress-group -->
									<div class="progress-group">
										<span class="progress-text">Diponibilidad del Servicio</span>
										<span class="float-right"><b><?php echo $respuesta3; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-success" style="width: <?php echo $respuesta3; ?>"></div>
										</div>
									</div>

									<!-- /.progress-group -->
									<div class="progress-group">
										Calidad de Nuestros Servicios
										<span class="float-right"><b><?php echo $respuesta4; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-warning" style="width: <?php echo $respuesta4; ?>"></div>
										</div>
									</div>

									<!-- /.progress-group -->
									<div class="progress-group">
										Asesoria técnica (tipo de unidades, modelos, capacidad de pasajeros)
										<span class="float-right"><b><?php echo $respuesta5; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-primary" style="width: <?php echo $respuesta5; ?>"></div>
										</div>
									</div>


									<div class="progress-group">
										Limpieza y Condición de Unidades
										<span class="float-right"><b><?php echo $respuesta6; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-info" style="width: <?php echo $respuesta6; ?>"></div>
										</div>
									</div>

									<div class="progress-group">
										Atención, servicio, limpieza y presentación del operador
										<span class="float-right"><b><?php echo $respuesta7; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-success" style="width: <?php echo $respuesta7; ?>"></div>
										</div>
									</div>

									<div class="progress-group">
										El operador conduce la unidad adecuadamente
										<span class="float-right"><b><?php echo $respuesta8; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-warning" style="width: <?php echo $respuesta8; ?>"></div>
										</div>
									</div>

									<div class="progress-group">
										Atencion y servicio del área de calidad
										<span class="float-right"><b><?php echo $respuesta9; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-primary" style="width: <?php echo $respuesta9; ?>"></div>
										</div>
									</div>

									<div class="progress-group">
										Como considera el servico de facturación
										<span class="float-right"><b><?php echo $respuesta10; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-info" style="width: <?php echo $respuesta10; ?>"></div>
										</div>
									</div>

									<div class="progress-group">
										Nuestros precios
										<span class="float-right"><b><?php echo $respuesta11; ?></b></span>
										<div class="progress progress-sm">
											<div class="progress-bar bg-success" style="width: <?php echo $respuesta11; ?>"></div>
										</div>
									</div>
								</div>
							</div>

						</div>


					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="position-relative mb-4">
									<figure class="highcharts-figure">

										<div id="container5d"></div>
									</figure>
								</div>

							</div>

						</div>
						<!-- /.col-md-6 -->
						<div class="col-lg-6">
							<div class="card">
								<div class="position-relative mb-4">
									<figure class="highcharts-figure">

										<div id="container6d"></div>
									</figure>
								</div>

							</div>

						</div>

					</div>
					<!-- /.col-md-6 -->
				</div>



				<!--
         <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="position-relative mb-4">
                  <figure class="highcharts-figure">
                   
                    <div id="container4d"></div>
                  </figure>
                </div>
              
            </div>
          </div>
        </div> -->
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</div>



	</div>

	<!-- /.content -->



	<!-- /.content-wrapper -->

	<!-- Control Sidebar -->

	<!-- /.control-sidebar -->

	<!-- Main Footer -->
	<?php include('includes/footer.php') ?>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="../plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../dist/js/adminlte.min.js"></script>
	<!-- Select2 -->
	<script src="../plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
	<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
	<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
	<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

	<!-- DataTables JS library -->
	<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<!-- DataTables JBootstrap -->
	<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
	<script src="../plugins/chart.js/Chart.min.js"></script>
	<!-- <script src="../dist/js/pages/dashboard3.js"></script>-->
	<!-- AdminLTE App -->
	<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

	<script src="js/sweetalert2.all.min.js"></script>
	<!--<script src="../dist/js/pages/dashboard3.js"></script> -->
	<!-- Page specific script -->
	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})

			//Datemask dd/mm/yyyy
			$('#datemask').inputmask('dd/mm/yyyy', {
				'placeholder': 'dd/mm/yyyy'
			})
			//Datemask2 mm/dd/yyyy
			$('#datemask2').inputmask('mm/dd/yyyy', {
				'placeholder': 'mm/dd/yyyy'
			})
			//Money Euro
			$('[data-mask]').inputmask()

			//Date picker
			$('#reservationdate').datetimepicker({
				format: 'L'
			});

			//Date and time picker
			$('#reservationdatetime').datetimepicker({
				icons: {
					time: 'far fa-clock'
				}
			});

			//Date range picker
			$('#reservation').daterangepicker()
			//Date range picker with time picker
			$('#reservationtime').daterangepicker({
				timePicker: true,
				timePickerIncrement: 30,
				locale: {
					format: 'MM/DD/YYYY hh:mm A'
				}
			})
			//Date range as a button
			$('#daterange-btn').daterangepicker({
					ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					startDate: moment().subtract(29, 'days'),
					endDate: moment()
				},
				function(start, end) {
					$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
				}
			)

			//Timepicker
			$('#timepicker').datetimepicker({
				format: 'LT'
			})

			//Bootstrap Duallistbox
			$('.duallistbox').bootstrapDualListbox()

			//Colorpicker
			$('.my-colorpicker1').colorpicker()
			//color picker with addon
			$('.my-colorpicker2').colorpicker()

			$('.my-colorpicker2').on('colorpickerChange', function(event) {
				$('.my-colorpicker2 .fa-square').css('color', event.color.toString());
			})

			$("input[data-bootstrap-switch]").each(function() {
				$(this).bootstrapSwitch('state', $(this).prop('checked'));
			})

		})
		// BS-Stepper Init
		document.addEventListener('DOMContentLoaded', function() {
			window.stepper = new Stepper(document.querySelector('.bs-stepper'))
		})

		// DropzoneJS Demo Code Start
		Dropzone.autoDiscover = false

		// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
		var previewNode = document.querySelector("#template")
		previewNode.id = ""
		var previewTemplate = previewNode.parentNode.innerHTML
		previewNode.parentNode.removeChild(previewNode)

		var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
			url: "/target-url", // Set the url
			thumbnailWidth: 80,
			thumbnailHeight: 80,
			parallelUploads: 20,
			previewTemplate: previewTemplate,
			autoQueue: false, // Make sure the files aren't queued until manually added
			previewsContainer: "#previews", // Define the container to display the previews
			clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
		})

		myDropzone.on("addedfile", function(file) {
			// Hookup the start button
			file.previewElement.querySelector(".start").onclick = function() {
				myDropzone.enqueueFile(file)
			}
		})

		// Update the total progress bar
		myDropzone.on("totaluploadprogress", function(progress) {
			document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
		})

		myDropzone.on("sending", function(file) {
			// Show the total progress bar when upload starts
			document.querySelector("#total-progress").style.opacity = "1"
			// And disable the start button
			file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
		})

		// Hide the total progress bar when nothing's uploading anymore
		myDropzone.on("queuecomplete", function(progress) {
			document.querySelector("#total-progress").style.opacity = "0"
		})

		// Setup the buttons for all transfers
		// The "add files" button doesn't need to be setup because the config
		// `clickable` has already been specified.
		document.querySelector("#actions .start").onclick = function() {
			myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
		}
		document.querySelector("#actions .cancel").onclick = function() {
			myDropzone.removeAllFiles(true)
		}
		// DropzoneJS Demo Code End
	</script>


	<!-- <?php

			include "../conexion.php";

			// Consulta para obtener la fecha de vencimiento
			$sqldate = "SELECT nombre as cliente, fecha_iniciacontrato, fecha_fincontrato FROM clientes WHERE DATE(fecha_fincontrato) < DATE_SUB(NOW(),INTERVAL 30 DAY) and fecha_fincontrato > '2020-01-01' and estatus = 1";
			$resultado = mysqli_query($conection, $sqldate);

			// Verificación del resultado de la consulta
			if (mysqli_num_rows($resultado) > 0) {
				while ($fila = mysqli_fetch_assoc($resultado)) {

					$namecliente = $fila['cliente'];
					//$fcha = date("d-m-Y",  $fila['fecha_vencimiento'] );
					$newDate3 = date("d/m/Y", strtotime($fila['fecha_fincontrato']));

			?>  
   
     <script>

     alert('\t Contratos vencidos y/o prontos a vencer. \t \n\t \u00A0 \n\t Cliente: <?php echo $namecliente; ?> \n\t Fecha de vencimiento: <?php echo $newDate3; ?> ')

    </script>
  
    <?php
				}
			} else {
	?>  
  
 
     <script>

     //* alert('\t No Hay contratos por vencer o vencidos')

    </script>
<?php
			}

?> -->



	<script>
		var densityCanvas = document.getElementById("densityChart");

		Chart.defaults.global.defaultFontFamily = "Lato";
		Chart.defaults.global.defaultFontSize = 18;

		var densityData = {
			label: 'Calificación',
			data: [<?php echo $resp_1; ?>, <?php echo $resp_2; ?>, <?php echo $resp_3; ?>, <?php echo $resp_4; ?>, <?php echo $resp_5; ?>, <?php echo $resp_6; ?>],
			backgroundColor: 'rgba(253, 197, 100, 0.6)',
			borderColor: 'rgba(253, 197, 100, 1)',
		};

		var barChart = new Chart(densityCanvas, {
			type: 'bar',
			data: {
				labels: ["Servicio Ventas", "Servicio Transporte", "Servicio Operador", "Servicio Supervisor", "Servicio Operaciones", "Atención y Resolución"],
				datasets: [densityData]
			}
		});
	</script>

	<script>
		Highcharts.chart('container', {
			chart: {
				type: 'bar'
			},
			title: {
				text: 'Registro de Viajes Planeados vs Registrados',
				align: 'left'
			},
			subtitle: {
				text: 'Año en curso',
				align: 'left'
			},
			xAxis: {
				categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				//categories:  [<?php echo join($dato2, ',') ?>],
				title: {
					text: null
				},
				gridLineWidth: 1,
				lineWidth: 0
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Population (viajes)',
					align: 'high'
				},
				labels: {
					overflow: 'justify'
				},
				gridLineWidth: 0
			},
			tooltip: {
				valueSuffix: ' viajes'
			},
			plotOptions: {
				bar: {
					borderRadius: '50%',
					dataLabels: {
						enabled: true
					},
					groupPadding: 0.1
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				x: -10,
				y: 310,
				floating: true,
				borderWidth: 1,
				backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
				shadow: true
			},
			credits: {
				enabled: false
			},



			series: [{
				name: 'Planeados',
				data: [<?php echo join($dato2, ',') ?>],
			}, {
				name: 'Registrados',
				data: [<?php echo join($dato3, ',') ?>],
			}, {
				name: 'Diferencia %',
				data: [<?php echo join($dato5, ',') ?>],
			}]

		});
	</script>

	<!-- Container 2  -->

	<script>
		Highcharts.chart('container2', {

			title: {
				text: 'Consumo de Combustible',
				align: 'left'
			},

			subtitle: {
				text: 'Año en curso',
				align: 'left'
			},

			xAxis: {
				categories: [
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
				]
			},

			yAxis: {
				title: {
					text: 'Consumo por mes'
				}
			},



			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					},
					pointStart: 0
				}
			},

			series: [{
				name: 'Importe',
				data: [<?php echo $nimportemes1; ?>, <?php echo $nimportemes2; ?>, <?php echo $nimportemes3; ?>, <?php echo $nimportemes4; ?>, <?php echo $nimportemes5; ?>, <?php echo $nimportemes6; ?>, <?php echo $nimportemes7; ?>, <?php echo $nimportemes8; ?>, <?php echo $nimportemes9; ?>, <?php echo $nimportemes10; ?>, <?php echo $nimportemes11; ?>, <?php echo $nimportemes12; ?>]
			}, {
				name: 'Litros',
				data: [<?php echo $nlitros1; ?>, <?php echo $nlitros2; ?>, <?php echo $nlitros3; ?>, <?php echo $nlitros4; ?>, <?php echo $nlitros5; ?>, <?php echo $nlitros6; ?>, <?php echo $nlitros7; ?>, <?php echo $nlitros8; ?>, <?php echo $nlitros9; ?>, <?php echo $nlitros10; ?>, <?php echo $nlitros11; ?>, <?php echo $nlitros12; ?>]
			}],

			responsive: {
				rules: [{
					condition: {
						maxWidth: 500
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});
	</script>



	<script> 
	var ctx = document.getElementById('myChart').getContext('2d'); 
	var myChart = new Chart(ctx, { 
		type: 'bar', data: { labels: [], datasets: [{ 
			label: 'Tiempo forma', backgroundColor: '#63d69f', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Tiempo respuesta', backgroundColor: '#438c6c', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Disponibilidad', backgroundColor: '#509c7f', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Calidad', backgroundColor: '#1f794e', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Asesoria tecnica', backgroundColor: '#34444c', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Limpieza Condicion', backgroundColor: '#90CAF9', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Servicio Operador', backgroundColor: '#64B5F6', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Conduce adecuado', backgroundColor: '#42A5F5', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Atencion Calidad', backgroundColor: '#2196F3', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Servicio facturacion', backgroundColor: '#0D47A1', borderColor: 'black', borderWidth: 0, data: [] 
		}, { 
			label: 'Nuestros precios', backgroundColor: '#9C74F7', borderColor: 'black', borderWidth: 0, data: [] 
		}] }, 
		options: { scales: { yAxes: [{ display: true, ticks: { beginAtZero: true } }] } } }); 

		let url = 'includes/articulos.php'; 
		fetch(url) .then(response => response.json()) 
			.then(datos => mostrar(datos)) 
			.catch(error => console.log(error)); 
			
		const mostrar = (articulos) => { 
			articulos.forEach(element => { 
				myChart.data.labels.push(element.cliente); myChart.data.datasets[0].data.push(element.tiempo_forma);
				myChart.data.datasets[1].data.push(element.tiempo_respuesta); 
				myChart.data.datasets[2].data.push(element.disponibilidad); 
				myChart.data.datasets[3].data.push(element.calidad); myChart.data.datasets[4].data.push(element.asesoria_tecnica); 
				myChart.data.datasets[5].data.push(element.limpieza_condicion); 
				myChart.data.datasets[6].data.push(element.servicio_operador); 
				myChart.data.datasets[7].data.push(element.conduce_adecuado);
			})
		};

	</script>

	<script>
		Highcharts.chart('container4d', {

			title: {
				text: 'Compras / Consumo de Combustible por Mes ',
				align: 'left'
			},

			subtitle: {
				text: 'Año en curso',
				align: 'left'
			},

			yAxis: {
				title: {
					text: 'Importe / Consumo'
				}
			},

			xAxis: {
				categories: [
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
				]
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					},
					pointStart: 0
				}
			},

			series: [{
				name: 'Importe Compras',
				data: [<?php echo $comprames1; ?>, <?php echo $comprames2; ?>, <?php echo $comprames3; ?>, <?php echo $comprames4; ?>, <?php echo $comprames5; ?>, <?php echo $comprames6; ?>, <?php echo $comprames7; ?>, <?php echo $comprames8; ?>, <?php echo $comprames9; ?>, <?php echo $comprames10; ?>, <?php echo $comprames11; ?>, <?php echo $comprames12; ?>]
			}, {
				name: 'Importe O. de Compra',
				data: [<?php echo $ocomprames1; ?>, <?php echo $ocomprames2; ?>, <?php echo $ocomprames3; ?>, <?php echo $ocomprames4; ?>, <?php echo $ocomprames5; ?>, <?php echo $ocomprames6; ?>, <?php echo $ocomprames7; ?>, <?php echo $ocomprames8; ?>, <?php echo $ocomprames9; ?>, <?php echo $ocomprames10; ?>, <?php echo $ocomprames11; ?>, <?php echo $ocomprames12; ?>]
			}, {
				name: 'Importe Combustible',
				data: [<?php echo $nimportemes1; ?>, <?php echo $nimportemes2; ?>, <?php echo $nimportemes3; ?>, <?php echo $nimportemes4; ?>, <?php echo $nimportemes5; ?>, <?php echo $nimportemes6; ?>, <?php echo $nimportemes7; ?>, <?php echo $nimportemes8; ?>, <?php echo $nimportemes9; ?>, <?php echo $nimportemes10; ?>, <?php echo $nimportemes11; ?>, <?php echo $nimportemes12; ?>]
			}, {
				name: 'Litros Combustible',
				data: [<?php echo $nlitros1; ?>, <?php echo $nlitros2; ?>, <?php echo $nlitros3; ?>, <?php echo $nlitros4; ?>, <?php echo $nlitros5; ?>, <?php echo $nlitros6; ?>, <?php echo $nlitros7; ?>, <?php echo $nlitros8; ?>, <?php echo $nlitros9; ?>, <?php echo $nlitros10; ?>, <?php echo $nlitros11; ?>, <?php echo $nlitros12; ?>]
			}],

			responsive: {
				rules: [{
					condition: {
						maxWidth: 500
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});
	</script>


	<script>
		Highcharts.chart('container5d', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Calificación de Clientes a Servicios',
				align: 'left'
			},
			subtitle: {
				text: 'Calificacion: 3 Excelente - 2 Bueno - 1 Regular - 0 Malo ',
				align: 'left'
			},
			xAxis: {
				categories: ['Calificacion Servicios', 'China', 'Brazil', 'EU'],
				crosshair: true,
				accessibility: {
					description: 'Countries'
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Puntos'
				}
			},
			tooltip: {
				valueDecimals: 2,
				valueSuffix: ' Puntos'
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y:.0f}'
					}
				}
			},
			series: [{
					name: 'Servicio Ventas',
					data: [<?php echo join($datosv, ',') ?>]
				},
				{
					name: 'Servicio Supervisor',
					data: [<?php echo join($datoss, ',') ?>]
				},
				{
					name: 'Servicio Jefe Operaciones',
					data: [<?php echo join($datosj, ',') ?>]
				},
				{
					name: 'Servicio Quejas',
					data: [<?php echo join($datosq, ',') ?>]
				}
			]
		});
	</script>
	<script>
		Highcharts.chart('container6d', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Calificación de Clientes a Servicios',
				align: 'left'
			},
			subtitle: {
				text: 'Calificacion: 3 Excelente - 2 Bueno - 1 Regular - 0 Malo ',
				align: 'left'
			},
			xAxis: {
				categories: ['<?php echo join($datoscte, "','") ?>'],

				crosshair: true,
				accessibility: {
					description: 'Countries'
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Puntos'
				}
			},
			tooltip: {
				valueDecimals: 2,
				valueSuffix: ' Puntos'
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y:.0f}'
					}
				}
			},
			series: [{
					name: 'Servicio Ventas',
					data: [<?php echo join($datosvct, ',') ?>]
				},
				{
					name: 'Servicio Supervisor',
					data: [<?php echo join($datossct, ',') ?>]
				},
				{
					name: 'Servicio Jefe Operaciones',
					data: [<?php echo join($datosjct, ',') ?>]
				},
				{
					name: 'Servicio Quejas',
					data: [<?php echo join($datosqct, ',') ?>]
				}
			]
		});
	</script>
	<script>
    document.addEventListener("DOMContentLoaded", function(){
      // Invocamos cada 5 segundos ;)
      const milisegundos = 5 *1000;
      setInterval(function(){
      // No esperamos la respuesta de la petición porque no nos importa
         fetch("./refrescar.php");
      },milisegundos);
    });
</script>
	<script src="js/sweetalert.min.js"></script>
</body>

</html>