<?php
session_start();
include("../../conexion.php");

// Validar conexión
if (!$conection) {
    die(json_encode(['error' => 'Error de conexión a la base de datos.']));
}

// Función para insertar datos en la tabla nomina_temp_2025
function insertar_nomina($conection, $data) {
    $stmt = mysqli_prepare($conection, "INSERT INTO nomina_temp_2025 (
            semana, anio, noempleado, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto,
            bono_semanal, bono_categoria, bono_supervisor, deducciones, caja_ahorro, supervisor, nomina_fiscal, efectivo, deduccion_fiscal, deposito_fiscal, apoyo_mes, prima_vacacional, dias_vacaciones, pago_vacaciones
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "siissssiddddddddsddddddid", 
        $data['semana'], $data['anio'], $data['noempleado'], $data['nombre'], $data['no_unidad'], $data['tipo_unidad'], 
        $data['cargo'], $data['imss'], $data['sueldo_base'], $data['total_vueltas'], $data['sueldo_bruto'], 
        $data['bono_semanal'], $data['bono_categoria'], $data['bono_supervisor'], $data['deducciones'], $data['caja_ahorro'], $data['supervisor'], 
        $data['pago_fiscal'], $data['efectivo'], $data['deduccion_fiscal'], $data['deposito'], $data['apoyo_mes'], $data['prima_vacacional'], $data['dias_vacaciones'], $data['pago_vacaciones']
    );
    // var_dump($stmt);
    if (!mysqli_stmt_execute($stmt)) {
        die(json_encode(['error' => 'Error al insertar datos en nomina_temp_2025: ' . mysqli_error($conection)]));
    }
}

// Truncar la tabla nomina_temp_2025
$sql = "TRUNCATE nomina_temp_2025";
if (!mysqli_query($conection, $sql)) {
    die(json_encode(['error' => 'Error al truncar la tabla: ' . mysqli_error($conection)])); 
}
// Obtener semana y año
// $semana = "";
// $nombre_semana = "";
// $anio = "";

if(isset($_POST['semana']) && isset($_POST['anio']) && !empty($_POST['semana']) && !empty($_POST['anio'])) {
    $semana = $_POST['semana'];
    $anio = $_POST['anio'];
    $nombre_semana = 'Semana ' . $semana;
    // if(intval($semana) < 10) {
    //     $nombre_semana = "Semana 0" . $semana;
    // }
} else {
    $semana = date('W');
    $anio = date('Y');
    $nombre_semana = 'Semana ' . $semana;
    // if($semana < 10) {
    //     $nombre_semana = "Semana 0" . $semana;
    // }
}


// Calcular fechas para la semana
    $fecha = new DateTime();
    $fecha->setISODate($anio, $semana);
    $fecha_inicio = ($fecha->format('Y-m-d'));
    $fecha_fin = $fecha->modify('+6 days')->format('Y-m-d');
    // echo $nombre_semana;
    // Consultar empleados
    $sql_empleados = "
    SELECT
        e.id,
        e.noempleado,
        e.sueldo_base,
        CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS operador,
        e.cargo,
        IF(e.imss = 'ASEGURADO', 1, 0) AS imss,
        e.estatus,
        e.bono_categoria,
        e.bono_supervisor,
        e.bono_semanal,
        e.caja_ahorro,
        e.supervisor,
        e.apoyo_mes,
        e.salario_diario,
        COALESCE(SUM(al.noalertas), 0) AS noalertas,
        COUNT(inc.valor) AS faltas,
        MAX(CASE WHEN rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) THEN rv.unidad END) AS unidad,
        MAX(CASE WHEN rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) THEN rv.num_unidad END) AS num_unidad,
        CASE WHEN MONTH(e.fecha_contrato) = MONTH($fecha_inicio) AND DAY(e.fecha_contrato) - DAY($fecha_inicio) <= 7 THEN
            'SI'
        ELSE
            'NO'
        END AS prima_vacacional,
        COALESCE(SUM(
            CASE WHEN e.cargo = 'OPERADOR' THEN
                CASE WHEN e.sueldo_base > rv.sueldo_vuelta THEN
                    e.sueldo_base * rv.valor_vuelta
                ELSE
                    CASE WHEN rv.unidad_ejecuta <> e.tipo_unidad THEN
                        rv.valor_vuelta * rv.sueldo_vuelta
                    ELSE
                        CASE WHEN (rv.sueldo_vuelta - e.sueldo_base) <= 1 THEN
                            e.sueldo_base * rv.valor_vuelta
                        ELSE
                            rv.valor_vuelta * rv.sueldo_vuelta
                        END
                    END
                END
            WHEN rv.tipo_viaje LIKE '%ESPECIAL%' THEN
                rv.sueldo_vuelta * rv.valor_vuelta
            WHEN rv.tipo_viaje = 'Especial' THEN
                rv.sueldo_vuelta * rv.valor_vuelta
            ELSE
                0
            END
        ), 0) AS sueldo_bruto,
        COALESCE(SUM(rv.valor_vuelta), 0) AS total_vueltas,
        (
            SELECT 
                DATEDIFF('$fecha_fin', inc.fecha_inicial)
            FROM
                incidencias inc
            WHERE
                inc.empleado = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AND inc.fecha_inicial BETWEEN '$fecha_inicio' AND '$fecha_fin'
            ORDER BY
                inc.fecha_inicial DESC
        ) AS fecha_inicial,
        (
            SELECT
                DATEDIFF(i.fecha_final, '$fecha_inicio')
            FROM
                incidencias i
            WHERE
            i.empleado = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AND i.fecha_final BETWEEN '$fecha_inicio' AND '$fecha_fin'
            ORDER BY
                i.fecha_final DESC
        ) AS fecha_final,
        (
            SELECT 
                COALESCE(
                    SUM(
                        IF(a.cantidad - (TIMESTAMPDIFF(WEEK, a.fecha_inicial, CURDATE()) * a.descuento) < a.descuento,
                        a.cantidad - (TIMESTAMPDIFF(WEEK, a.fecha_inicial, CURDATE()) * a.descuento),
                        a.descuento)
                    ),
                0) 
            FROM adeudos a 
            WHERE a.noempleado = e.noempleado
        ) AS deducciones";

        $sql_fiscal = "SELECT COUNT(*) FROM importes_fiscales";
        $result_fiscal = mysqli_query($conection, $sql_fiscal);
        if(!$result_fiscal){
            die(json_encode(['error' => 'Error al obtener los datos de la nómina: ' . mysqli_error($conection)]));
        }
        $row_fiscal = mysqli_fetch_row($result_fiscal);
        if($row_fiscal[0] > 0){
            $sql_empleados .= ", fi.pago_fiscal,
                                fi.deduccion_fiscal";
        }

        $sql_empleados .= "
            FROM 
                empleados e
            LEFT JOIN 
                alertas al ON al.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AND UPPER(al.semana) = UPPER('$nombre_semana')
            LEFT JOIN 
                incidencias inc ON inc.empleado = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) AND inc.nodesemana = '$nombre_semana'
            LEFT JOIN 
                registro_viajes rv ON rv.operador = CONCAT(e.nombres, ' ', e.apellido_paterno, ' ', e.apellido_materno) 
                                AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'
                                AND rv.valor_vuelta > 0
            LEFT JOIN
                adeudos a ON a.noempleado = e.noempleado";

        if($row_fiscal[0] > 0){
            $sql_empleados .= "
            LEFT JOIN importes_fiscales fi ON fi.empleado = CONCAT(e.apellido_paterno, ' ', e.apellido_materno, ' ', e.nombres) COLLATE utf8mb4_unicode_ci";
        }

        $sql_empleados .= "
            WHERE 
                e.estatus = 1 AND e.tipo_nomina = 'Semanal' 
            GROUP BY 
                e.noempleado, e.id, e.sueldo_base, operador, e.cargo, imss, e.estatus, e.bono_categoria, e.bono_supervisor, 
                e.bono_semanal, e.caja_ahorro, e.supervisor, e.apoyo_mes, deducciones";

        if($row_fiscal[0] > 0){
            $sql_empleados .= ", fi.pago_fiscal, fi.deduccion_fiscal";
        }
        // AND (e.cargo = 'OPERADOR' OR e.cargo = 'SUPERVISOR')
        // echo $sql_empleados;
    $result_empleados = mysqli_query($conection, $sql_empleados);
    if (!$result_empleados) {
        die(json_encode(['error' => 'Error en la consulta de empleados: ' . mysqli_error($conection)]));
    }

// Insertar datos en nomina_temp_2025
while ($row_empleados = mysqli_fetch_assoc($result_empleados)) {
    // var_dump($row_empleados);
    $alertas = intval($row_empleados['noalertas']);
    $bono_semanal = ($alertas < 5) ? floatval($row_empleados['bono_semanal']) : 0;
    $noempleado = intval($row_empleados['noempleado']);
    $nombre = $row_empleados['operador'];
    $no_unidad = $row_empleados['num_unidad'];
    $tipo_unidad = $row_empleados['unidad'];
    $total_vueltas = $row_empleados['total_vueltas'];
    $cargo = $row_empleados['cargo'];
    $imss = intval($row_empleados['imss']);
    $sueldo_bruto = ($row_empleados['cargo'] === 'OPERADOR') ? floatval($row_empleados['sueldo_bruto'] - ($row_empleados['faltas'] * $row_empleados['sueldo_base'])) : ((floatval($row_empleados['sueldo_base'] * 7) - ($row_empleados['faltas'] * $row_empleados['sueldo_base'])));
    $bono_semanal = $row_empleados['bono_semanal'] ?? 0;
    $bono_supervisor = $row_empleados['bono_supervisor'] ?? 0;
    $bono_categoria = $row_empleados['bono_categoria'] ?? 0;
    $deducciones = floatval($row_empleados['deducciones']);
    $caja_ahorro = floatval($row_empleados['caja_ahorro']);
    $supervisor = $row_empleados['supervisor'];
    $sueldo_base = $row_empleados['sueldo_base'];
    $pago_fiscal = $row_empleados['pago_fiscal'] ?? 0;
    $deduccion_fiscal = $row_empleados['deduccion_fiscal'] ?? 0;
    $efectivo = $sueldo_bruto - $pago_fiscal;
    $deposito = $pago_fiscal - $deduccion_fiscal;
    $apoyo_mes = $row_empleados['apoyo_mes'] ?? 0;
    $prima_vacacional =  $row_empleados['prima_vacacional'] === 'SI' ? (($row_empleados['salario_diario'] * 10) * 1.25) : 0;
    $dias_vacaciones = isset($row_empleados['fecha_final']) || isset($row_empleados['fecha_inicial']) ? intval($row_empleados['fecha_inicial']) ?? intval($row_empleados['fecha_final']) : 0;
    $fecha_inicial = $row_empleados['fecha_inicial'] ?? 0;
    $fecha_final = $row_empleados['fecha_final'] ?? 0;
    $pago_vacaciones = ($dias_vacaciones * $row_empleados['salario_diario']) ?? 0;

    // Preparar los datos para la inserción
    $data = [
        'semana' => $semana,
        'anio' => $anio,
        'noempleado' => $noempleado,
        'nombre' => $nombre,
        'no_unidad' => $no_unidad,
        'tipo_unidad' => $tipo_unidad,
        'bono_categoria' => $bono_categoria,
        'bono_supervisor' => $bono_supervisor,
        'bono_semanal' => $bono_semanal,
        'cargo' => $cargo,
        'imss' => $imss,
        'sueldo_base' => $sueldo_base,
        'total_vueltas' => $total_vueltas,
        'sueldo_bruto' => $sueldo_bruto,
        'deducciones' => $deducciones,
        'caja_ahorro' => $caja_ahorro,
        'supervisor' => $supervisor,
        'pago_fiscal' => $pago_fiscal,
        'efectivo' => $efectivo,
        'deduccion_fiscal' => $deduccion_fiscal,
        'deposito' => $deposito,
        'apoyo_mes' => $apoyo_mes,
        'prima_vacacional' => $prima_vacacional,
        'dias_vacaciones' => $dias_vacaciones,
        'pago_vacaciones' => $pago_vacaciones
    ];

    insertar_nomina($conection, $data);
}
// Obtener datos para la paginación
$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$searchValue = $_POST['search']['value'] ?? '';
$orderColumn = $_POST['order'][0]['column'];
$orderDir = $_POST['order'][0]['dir'];

$whereClause = "";
if (!empty($searchValue)) {
    $whereClause .= " WHERE (noempleado LIKE '%$searchValue%' OR nombre LIKE '%$searchValue%')";
}

$columns = array('semana', 'noempleado', 'nombre', 'cargo', 'imss', 'sueldo_base', 'supervisor', 'sueldo_bruto', 'nomina_fiscal', 'bono_semanal', 'bono_categoria', 'bono_supervisor', 'apoyo_mes', 'deposito', 'efectivo', 'deducciones', 'deduccion_fiscal', 'caja_ahorro', 'supervisor', 'neto');

// Recuperar datos finales
$sql_nomina = "SELECT semana, anio, noempleado, nombre, no_unidad, tipo_unidad, cargo, IF(imss = 1, 'SI', 'NO') AS imss, sueldo_base, total_vueltas, sueldo_bruto, nomina_fiscal, bono_semanal, bono_categoria, bono_supervisor, apoyo_mes, deposito_fiscal, efectivo, deducciones, caja_ahorro, supervisor, deduccion_fiscal, deposito_fiscal, prima_vacacional, dias_vacaciones, pago_vacaciones
                FROM nomina_temp_2025 $whereClause 
                GROUP BY  noempleado, anio, semana, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto, nomina_fiscal, bono_semanal, bono_categoria, bono_supervisor, apoyo_mes, deposito_fiscal, efectivo, deducciones, caja_ahorro, supervisor, deduccion_fiscal, deposito_fiscal, prima_vacacional, dias_vacaciones, pago_vacaciones
                ORDER BY $columns[$orderColumn] $orderDir LIMIT $start, $length"; 

$result_nomina = mysqli_query($conection, $sql_nomina);
if (!$result_nomina) {
    die(json_encode(['error' => 'Error al obtener los datos de la nómina: ' . mysqli_error($conection)]));
}
// Obtener el total de registros (sin LIMIT)
$sql_count_nomina = "SELECT COUNT(*) FROM nomina_temp_2025";
$result_count_total = mysqli_query($conection, $sql_count_nomina);
$totalRecords = mysqli_fetch_row($result_count_total)[0];

//Obtrener el total filtrado
$sql_total_filtered = "SELECT COUNT(*) FROM nomina_temp_2025 $whereClause";
$result_count_filtered = mysqli_query($conection, $sql_total_filtered);
$totalFiltered = mysqli_fetch_row($result_count_filtered)[0];

$sql_total_pagar = "SELECT SUM(sueldo_bruto + bono_semanal + bono_categoria + bono_supervisor - deducciones - deduccion_fiscal - caja_ahorro + prima_vacacional + pago_vacaciones + apoyo_mes) AS total_nomina FROM nomina_temp_2025";
$result_total_pagar = mysqli_query($conection, $sql_total_pagar);
$total_nomina = mysqli_fetch_row($result_total_pagar)[0];

// $sql_totales_columnas = "SELECT SUM(sueldo_bruto) AS sueldo_bruto, SUM(bono_semanal) AS bono_semanal, SUM(bono_categoria) AS bono_categoria, SUM(bono_supervisor) AS bono_supervisor, SUM(deducciones) AS deducciones, SUM(nomina_fiscal) AS nomina_fiscal, SUM(deduccion_fiscal) AS deduccion_fiscal, SUM(total_vueltas) AS total_vueltas";
// $query_total_columnas = mysqli_query($conection, $sql_totales_columnas);
// $result_total_columnas = mysqli_fetch_row($query_total_columnas);
// $data_totales = [];
// while($row_total_columnas = mysqli_fetch_assoc($result_total_columnas)) {
//     $data_totales[] = $row_total_columnas;
// }
// Devuelve los resultados de la paginación
$data_output = [];
while ($row = mysqli_fetch_assoc($result_nomina)) {
    $data_output[] = $row;
}
$draw = $_POST['draw'] ?? 1;
echo json_encode([
    'draw' => $draw,
    'totalNomina' => $total_nomina,
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalFiltered,
    'data' => $data_output
    // 'data_totales' => $data_totales
]);


// (  
//     SELECT
//         e.apoyo_mes
//     FROM 
//         empleados e
//     WHERE
//         ($fecha_inicio - fecha_contrato) > 30
//         AND
//         DAYOFWEEK($fecha_inicio) = 2  -- 2 representa el lunes
//         AND
//         DAY($fecha_inicio) BETWEEN 15 AND 22
// ) AS apoyo_mes,
?>