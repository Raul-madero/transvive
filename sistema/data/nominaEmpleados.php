<?php
session_start();
include("../../conexion.php");

// Validar conexión
if (!$conection) {
    die(json_encode(['error' => 'Error de conexión a la base de datos.']));
}
// Funciones 
// Funcion para calcular los anios que ha trabajado un empleado
function calcularAniosTrabajados($fecha_contrato) {
    // Convertir la fecha de contrato a un objeto DateTime
    $fechaInicio = new DateTime($fecha_contrato);

    // Obtener la fecha actual
    $fechaActual = new DateTime();

    // Calcular la diferencia entre las fechas
    $diferencia = $fechaInicio->diff($fechaActual);

    // Retornar solo la cantidad de años
    return $diferencia->y;
}

function calcularDiasVacaciones($anios) {
    $dias_correspondientes = 0;
    switch ($anios) {
        case 0:
            $dias_correspondientes = 0;
            break;
        case 1:
            $dias_correspondientes = 12;
            break;
        case 2:
            $dias_correspondientes = 14;
            break;
        case 3:
            $dias_correspondientes = 16;
            break;
        case 4:
            $dias_correspondientes = 18;
            break;
        case 5:
            $dias_correspondientes = 20;
            break;
        case 6:
            $dias_correspondientes = 22;
            break;
        case 7:
            $dias_correspondientes = 22;
            break;
        case 8:
            $dias_correspondientes = 22;
            break;
        case 9:
            $dias_correspondientes = 22;
            break;
        case 10:
            $dias_correspondientes = 22;
            break;
        case 11:
            $dias_correspondientes = 24;
            break;
        case 12:
            $dias_correspondientes = 24;
            break;
        case 13:
            $dias_correspondientes = 24;
            break;
        case 14:
            $dias_correspondientes = 24;
            break;
        case 15:
            $dias_correspondientes = 24;
            break;
        case 16:
            $dias_correspondientes = 26;
            break;
        case 17:
            $dias_correspondientes = 26;
            break;
        case 18:
            $dias_correspondientes = 26;
            break;
        case 19:
            $dias_correspondientes = 26;
            break;
        case 20:
            $dias_correspondientes = 26;
            break;
        case 21:
            $dias_correspondientes = 28;
            break;
        case 22:
            $dias_correspondientes = 28;
            break;
        case 23:
            $dias_correspondientes = 28;
            break;
        case 24:
            $dias_correspondientes = 28;
            break;
        case 25:
            $dias_correspondientes = 28;
            break;
        case 26:
            $dias_correspondientes = 30;
            break;
        case 27:
            $dias_correspondientes = 30;
            break;
        case 28:
            $dias_correspondientes = 30;
            break;
        case 29:
            $dias_correspondientes = 30;
            break;
        case 30:
            $dias_correspondientes = 30;
            break;
        case 31:
            $dias_correspondientes = 32;
            break;
        default:
            $dias_correspondientes = 32;
            break;
    }
    return $dias_correspondientes;
}


// Función para insertar datos en la tabla nomina_temp_2025
function insertar_nomina($conection, $data) {
    $stmt = mysqli_prepare($conection, "INSERT INTO nomina_temp_2025 (
            semana, anio, noempleado, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto,
            bono_semanal, bono_categoria, bono_supervisor, deducciones, caja_ahorro, supervisor, nomina_fiscal, efectivo, deduccion_fiscal, deposito_fiscal, apoyo_mes, prima_vacacional, dias_vacaciones, pago_vacaciones, neto
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "siissssiddddddddsddddddidd", 
        $data['semana'], $data['anio'], $data['noempleado'], $data['nombre'], $data['no_unidad'], $data['tipo_unidad'], 
        $data['cargo'], $data['imss'], $data['sueldo_base'], $data['total_vueltas'], $data['sueldo_bruto'], 
        $data['bono_semanal'], $data['bono_categoria'], $data['bono_supervisor'], $data['deducciones'], $data['caja_ahorro'], $data['supervisor'], 
        $data['pago_fiscal'], $data['efectivo'], $data['deduccion_fiscal'], $data['deposito'], $data['apoyo_mes'], $data['prima_vacacional'], $data['dias_vacaciones'], $data['pago_vacaciones'], $data['neto']
    );
    // var_dump($stmt);
    if (!mysqli_stmt_execute($stmt)) {
        die(json_encode(['error' => 'Error al insertar datos en nomina_temp_2025: ' . mysqli_error($conection)]));
    }
}

// Funcion para calcular si el dia 15 del mes esta en la semana actual
function dia15EntreFechas($fecha_inicio, $fecha_fin) {
    // Convertimos las fechas a timestamps
    $timestamp_inicio = strtotime($fecha_inicio);
    $timestamp_fin = strtotime($fecha_fin);

    // Obtenemos el día 15 del mes correspondiente a la fecha de inicio
    $timestamp_dia15 = strtotime('15 ' . date('F Y', $timestamp_inicio));

    // Verificamos si el día 15 está entre las fechas de inicio y fin
    if ($timestamp_dia15 >= $timestamp_inicio && $timestamp_dia15 <= $timestamp_fin) {
        return true;
    }

    // En caso de que el rango de fechas cruce al siguiente mes, también verificamos el día 15 del mes siguiente
    $timestamp_dia15_siguiente = strtotime('15 ' . date('F Y', strtotime('+1 month', $timestamp_inicio)));

    if ($timestamp_dia15_siguiente >= $timestamp_inicio && $timestamp_dia15_siguiente <= $timestamp_fin) {
        return true;
    }

    return false;
}

if(isset($_POST['semana']) && isset($_POST['anio']) && !empty($_POST['semana']) && !empty($_POST['anio'])) {
    // Variables recibidas por POST
    $semana = $_POST['semana'];
    $anio = $_POST['anio'];

    // Nombre de la semana (por ejemplo: "Semana 5")
    $nombre_semana = 'Semana ' . $semana;

    // Calcular la fecha de inicio de la semana ISO
    $fecha = new DateTime();
    $fecha->setISODate($anio, $semana);
    $fecha_inicio = $fecha->format('Y-m-d'); // Fecha de inicio de la semana (lunes)

    // Calcular la fecha de fin (sumando 6 días para llegar al domingo)
    $fecha_fin = $fecha->modify('+6 days')->format('Y-m-d'); // Fecha de fin de la semana (domingo)

    $fecha_limite_alertas = date('Y-m-d', strtotime('next wednesday', strtotime($fecha_fin)));

    // Consultar empleados
    $sql_empleados = "
        SELECT
            e.id,
            e.noempleado,
            e.sueldo_base,
            CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) AS operador,
            e.cargo,
            IF(e.imss = 'ASEGURADO', 1, 0) AS imss,
            e.estatus,
            e.bono_categoria,
            e.bono_supervisor,
            e.bono_semanal,
            e.fecha_contrato,
            e.caja_ahorro,
            e.supervisor,
            e.apoyo_mes,
            e.salario_diario,
            COALESCE(COUNT(DISTINCT al.id), 0) AS noalertas,
            COUNT(DISTINCT inc.id) AS faltas,
            MAX(rv.unidad) AS unidad,
            MAX(rv.num_unidad) AS num_unidad,
            IF (
                STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(e.fecha_contrato), '-', DAY(e.fecha_contrato)), '%Y-%m-%d') 
                BETWEEN '$fecha_inicio' AND '$fecha_fin',
                'SI',
                'NO'
            ) AS prima_vacacional,
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
            MAX(DATEDIFF('$fecha_fin', inc.fecha_inicial)) AS dias_inicial,
            MAX(DATEDIFF(inc.fecha_final, '$fecha_inicio')) AS dias_final,
            (
                SELECT 
                    COALESCE(
                        SUM(
                            a.descuento
                        ),
                    0) 
                FROM adeudos a 
                WHERE a.noempleado = e.noempleado AND a.estado = 1
            ) AS deducciones";

    $sql_fiscal = "SELECT COUNT(*) FROM importes_fiscales";
    $result_fiscal = mysqli_query($conection, $sql_fiscal);
    if (!$result_fiscal) {
        die(json_encode(['error' => 'Error al obtener los datos de la nómina: ' . mysqli_error($conection)]));
    }
    $row_fiscal = mysqli_fetch_row($result_fiscal);
    if ($row_fiscal[0] > 0) {
        $sql_empleados .= ", fi.pago_fiscal, fi.deduccion_fiscal";
    }

    $sql_empleados .= "
        FROM 
            empleados e
        LEFT JOIN 
            alertas al ON al.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
            AND al.fecha BETWEEN '$fecha_inicio' AND '$fecha_limite_alertas' 
        LEFT JOIN 
            incidencias inc ON inc.empleado = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) AND inc.nodesemana = '$nombre_semana'
        LEFT JOIN 
            registro_viajes rv ON rv.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) 
                            AND rv.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'
                            AND rv.valor_vuelta > 0";

    if ($row_fiscal[0] > 0) {
        $sql_empleados .= "
        LEFT JOIN importes_fiscales fi ON fi.empleado = CONCAT_WS(' ', e.apellido_paterno, e.apellido_materno, e.nombres) COLLATE utf8mb4_unicode_ci";
    }

    $sql_empleados .= "
        WHERE 
            e.estatus = 1 
            AND e.tipo_nomina = 'Semanal' 
        GROUP BY 
        e.noempleado, e.id, e.sueldo_base, operador, e.cargo, imss, e.estatus, e.bono_categoria, e.bono_supervisor, 
        e.bono_semanal, e.caja_ahorro, e.supervisor, e.apoyo_mes";

    if ($row_fiscal[0] > 0) {
        $sql_empleados .= ", fi.pago_fiscal, fi.deduccion_fiscal, deducciones";
    }

        // AND (e.cargo = 'OPERADOR' OR e.cargo = 'SUPERVISOR')
        // echo $sql_empleados;
    $result_empleados = mysqli_query($conection, $sql_empleados);
    if (!$result_empleados) {
        die(json_encode(['error' => 'Error en la consulta de empleados: ' . mysqli_error($conection)]));
    }
    
    $sql_check = "SELECT COUNT(*) as total FROM nomina_temp_2025 WHERE semana = ? AND anio = ?";
    $stmt_check = mysqli_prepare($conection, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $semana, $anio);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $row_check = mysqli_fetch_assoc($result_check);
    
    if ($row_check['total'] == 0) {
        // Eliminar los datos que no coincidan con la semana o el año proporcionados
        $sql_delete = "DELETE FROM nomina_temp_2025 WHERE semana != ? OR anio != ?";
        $stmt_delete = mysqli_prepare($conection, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "ii", $semana, $anio);
        if (!mysqli_stmt_execute($stmt_delete)) {
            die(json_encode(['error' => 'Error al eliminar los datos antiguos: ' . mysqli_error($conection)]));
        }
        // Solo insertar registros si no existen datos para la semana y el año
        while ($row_empleados = mysqli_fetch_assoc($result_empleados)) {
            // var_dump($row_empleados);
            $alertas = intval($row_empleados['noalertas']);
            $gana_bono = $alertas < 5 ? true : false;
            $bono_semanal = $gana_bono ? floatval($row_empleados['bono_semanal']) : 0;
            $noempleado = intval($row_empleados['noempleado']);
            $nombre = $row_empleados['operador'];
            $no_unidad = $row_empleados['num_unidad'];
            $tipo_unidad = $row_empleados['unidad'];
            $total_vueltas = $row_empleados['total_vueltas'];
            $cargo = $row_empleados['cargo'];
            $imss = intval($row_empleados['imss']);
            $sueldo_bruto = ($row_empleados['cargo'] === 'OPERADOR') ? floatval($row_empleados['sueldo_bruto'] - ($row_empleados['faltas'] * $row_empleados['sueldo_base'])) : 0;
            $deducciones = floatval($row_empleados['deducciones']);
            $caja_ahorro = floatval($row_empleados['caja_ahorro']);
            $supervisor = $row_empleados['supervisor'];
            $sueldo_base = $row_empleados['sueldo_base'];
            $pago_fiscal = $row_empleados['pago_fiscal'] ?? 0;
            $deduccion_fiscal = $row_empleados['deduccion_fiscal'] ?? 0;
            $efectivo = $sueldo_bruto - $pago_fiscal;
            $deposito = $pago_fiscal - $deduccion_fiscal;
            $apoyo_mes = dia15EntreFechas($fecha_inicio, $fecha_fin) ? floatval($row_empleados['apoyo_mes']) : 0;
            $anios_trabajados = calcularAniosTrabajados($row_empleados['fecha_contrato']);
            $dias_correspondientes_vacaciones = calcularDiasVacaciones($anios_trabajados);
            $prima_vacacional = $row_empleados['prima_vacacional'] == 'SI' ? (($row_empleados['salario_diario'] * $dias_correspondientes_vacaciones) * .25) : 0;
            $dias_vacaciones = isset($row_empleados['fecha_final']) || isset($row_empleados['fecha_inicial']) ? (intval($row_empleados['fecha_inicial']) + 1) ?? (intval($row_empleados['fecha_final']) + 1) : 0;
            $pago_vacaciones = ($dias_vacaciones * $row_empleados['salario_diario']) ?? 0;
            $bono_categoria = dia15EntreFechas($fecha_inicio, $fecha_fin) ? floatval($row_empleados['bono_categoria']) : 0;
            $neto = ($cargo == 'OPERADOR') ? ($sueldo_bruto + $bono_categoria + $bono_semanal + $row_empleados['bono_supervisor'] + $pago_vacaciones + $prima_vacacional - $pago_fiscal - $deducciones - $caja_ahorro + $apoyo_mes) : ($bono_categoria + $bono_semanal + $row_empleados['bono_supervisor'] + $pago_vacaciones + $prima_vacacional + $pago_fiscal - $deducciones - $caja_ahorro + $apoyo_mes - $deduccion_fiscal);
    
            // Preparar los datos para la inserción
            $data = [
                'semana' => $semana,
                'anio' => $anio,
                'noempleado' => $noempleado,
                'nombre' => $nombre,
                'no_unidad' => $no_unidad,
                'tipo_unidad' => $tipo_unidad,
                'bono_categoria' => $bono_categoria,
                'bono_supervisor' => $row_empleados['bono_supervisor'],
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
                'pago_vacaciones' => $pago_vacaciones,
                'neto' => $neto
            ];
    
            insertar_nomina($conection, $data);
        }
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
    
    $columns = array('semana', 'anio', 'noempleado', 'nombre', 'cargo', 'imss', 'sueldo_base', 'supervisor', 'sueldo_bruto', 'nomina_fiscal', 'bono_semanal', 'bono_categoria', 'bono_supervisor', 'apoyo_mes', 'deposito', 'efectivo', 'deducciones', 'deduccion_fiscal', 'caja_ahorro', 'supervisor', 'neto');
    
    // Recuperar datos finales
    $sql_nomina = "SELECT id, semana, anio, noempleado, nombre, no_unidad, tipo_unidad, cargo, IF(imss = 1, 'SI', 'NO') AS imss, sueldo_base, total_vueltas, sueldo_bruto, nomina_fiscal, bono_semanal, bono_categoria, bono_supervisor, apoyo_mes, deposito_fiscal, efectivo, deducciones, caja_ahorro, supervisor, deduccion_fiscal, deposito_fiscal, prima_vacacional, dias_vacaciones, pago_vacaciones, neto
                    FROM nomina_temp_2025 $whereClause 
                    GROUP BY  id, noempleado, anio, semana, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto, nomina_fiscal, bono_semanal, bono_categoria, bono_supervisor, apoyo_mes, deposito_fiscal, efectivo, deducciones, caja_ahorro, supervisor, deduccion_fiscal, deposito_fiscal, prima_vacacional, dias_vacaciones, pago_vacaciones, neto
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
} else {
    json_encode([]);
}
?>