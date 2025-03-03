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

function calcularBonoSemanalContrato($fecha_contrato) {
    $fecha_actual = new DateTime(); // Fecha actual
    $fecha_contrato_dt = new DateTime($fecha_contrato);

    // Calcular la diferencia
    $diferencia = $fecha_contrato_dt->diff($fecha_actual);

    if($diferencia->days > 7) {
        return TRUE;
    }else{
        return FALSE;
    }
}

function calcularApoyoMesContrato($fecha_contrato) {
    $fecha_actual = new DateTime(); // Fecha actual
    $fecha_contrato_dt = new DateTime($fecha_contrato);

    // Calcular la diferencia
    $diferencia = $fecha_contrato_dt->diff($fecha_actual);

    if($diferencia->days > 45) {
        return TRUE;
    }else{
        return FALSE;
    }
}

function calcularDiasVacaciones($anios) {
    if ($anios <= 0) return 0;
    if ($anios == 1) return 12;
    if ($anios == 2) return 14;
    if ($anios == 3) return 16;
    if ($anios == 4) return 18;
    if ($anios == 5) return 20;
    if ($anios >= 6 && $anios <= 10) return 22;
    if ($anios >= 11 && $anios <= 15) return 24;
    if ($anios >= 16 && $anios <= 20) return 26;
    if ($anios >= 21 && $anios <= 25) return 28;
    if ($anios >= 26 && $anios <= 30) return 30;
    
    return 32; // Para 31 años o más
}


// Función para insertar datos en la tabla nomina_temp_2025
function insertar_nomina($conection, $data) {
    // var_dump($data);
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
            al.noalertas,

            -- Contar faltas injustificadas
            COUNT(DISTINCT CASE WHEN inc.tipo_incidencia = 'Falta Injustificada' THEN inc.id END) AS faltas,

            -- Contar solo los días de vacaciones dentro del periodo de pago
            COALESCE(SUM(CASE 
                WHEN inc.tipo_incidencia = 'Vacaciones' THEN 
                    DATEDIFF(LEAST(inc.fecha_final, '$fecha_fin'), GREATEST(inc.fecha_inicial, '$fecha_inicio')) + 1
                ELSE 0
            END), 0) AS dias_vacaciones_pagar,

            IF (
                STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(e.fecha_contrato), '-', DAY(e.fecha_contrato)), '%Y-%m-%d')
                BETWEEN '$fecha_inicio' AND '$fecha_fin',
                'SI',
                'NO'
            ) AS prima_vacacional,
            COALESCE(SUM(rv.valor_vuelta), 0) AS total_vueltas,

            -- Cálculo de sueldo bruto
            SUM(CASE 
                WHEN e.cargo = 'OPERADOR' THEN
                    CASE 
                        WHEN rv.tipo_viaje NOT IN ('Normal') THEN rv.sueldo_vuelta * rv.valor_vuelta
                        WHEN rv.sueldo_vuelta <> e.sueldo_base THEN rv.sueldo_vuelta * rv.valor_vuelta
                        ELSE e.sueldo_base * rv.valor_vuelta
                    END
                ELSE e.sueldo_base * 7
            END) AS sueldo_bruto,

            -- Datos de adeudos
            (
                SELECT a.descuento FROM adeudos a WHERE a.noempleado = e.noempleado AND a.estado = 1
            ) AS descuento,
            (
                SELECT a.cantidad FROM adeudos a WHERE a.noempleado = e.noempleado AND a.estado = 1
            ) AS cantidad,
            (
                SELECT a.total_abonado FROM adeudos a WHERE a.noempleado = e.noempleado AND a.estado = 1
            ) AS total_abonado";

    $sql_fiscal = "SELECT COUNT(*) FROM importes_fiscales";
    $result_fiscal = mysqli_query($conection, $sql_fiscal);
    if (!$result_fiscal) {
        die(json_encode(['error' => 'Error al obtener los datos de la nómina: ' . mysqli_error($conection)]));
    }
    $row_fiscal = mysqli_fetch_row($result_fiscal);
    if ($row_fiscal[0] > 0) {
        $sql_empleados .= ", fi.pago_fiscal, fi.deduccion_fiscal, fi.neto";
    }

    $sql_empleados .= "
        FROM empleados e
        LEFT JOIN alertas al ON al.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) COLLATE utf8mb4_general_ci
            AND DATE(al.fecha) BETWEEN '$fecha_fin' AND '$fecha_limite_alertas'
        LEFT JOIN incidencias inc ON inc.empleado = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
            AND (
                (inc.fecha_inicial BETWEEN '$fecha_inicio' AND '$fecha_fin') 
                OR (inc.fecha_final BETWEEN '$fecha_inicio' AND '$fecha_fin') 
                OR (inc.fecha_inicial < '$fecha_inicio' AND inc.fecha_final > '$fecha_fin')
            )
        LEFT JOIN registro_viajes rv ON rv.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
            AND DATE(rv.fecha) BETWEEN '$fecha_inicio' AND '$fecha_fin'
            AND rv.valor_vuelta > 0";

    if ($row_fiscal[0] > 0) {
        $sql_empleados .= "
        LEFT JOIN importes_fiscales fi ON fi.empleado = CONCAT_WS(' ', e.apellido_paterno, e.apellido_materno, e.nombres)";
    }

    $sql_empleados .= "
        WHERE 
            (e.estatus = 1 OR DATEDIFF(e.fecha_baja, '$fecha_inicio') >= 6)
            AND e.tipo_nomina = 'Semanal'
        GROUP BY 
            e.noempleado, e.id, e.sueldo_base, operador, e.cargo, imss, e.estatus, 
            e.bono_categoria, e.bono_supervisor, e.bono_semanal, e.caja_ahorro, 
            e.supervisor, e.apoyo_mes, al.noalertas";

    if ($row_fiscal[0] > 0) {
        $sql_empleados .= ", fi.pago_fiscal, fi.deduccion_fiscal, fi.neto";
    }

    echo $sql_empleados;
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
            var_dump($row_empleados);
            $alertas = intval($row_empleados['noalertas']);
            $bono_semanal_contrato = calcularBonoSemanalContrato($row_empleados['fecha_contrato']);
            $gana_bono = ($alertas <= 4 && $bono_semanal_contrato);
            $gana_apoyo_mes = calcularApoyoMesContrato($row_empleados['fecha_contrato']);
            $noempleado = intval($row_empleados['noempleado']);
            $nombre = $row_empleados['operador'];
            $no_unidad = $row_empleados['num_unidad'] ?? "";
            $tipo_unidad = $row_empleados['unidad'] ?? "";
            $total_vueltas = $row_empleados['total_vueltas'];
            $cargo = $row_empleados['cargo'];
            $imss = intval($row_empleados['imss']);
            $deducciones = (floatval($row_empleados['cantidad']) - floatval($row_empleados['total_abonado'])) > floatval($row_empleados['descuento']) 
                ? floatval($row_empleados['descuento']) 
                : (floatval($row_empleados['cantidad']) - floatval($row_empleados['total_abonado']) > 0 
                ? floatval($row_empleados['cantidad']) - floatval($row_empleados['total_abonado']) 
                : 0);
            $caja_ahorro = floatval($row_empleados['caja_ahorro']);
            $supervisor = $row_empleados['supervisor'];
            $sueldo_base = $row_empleados['sueldo_base'];
            if($row_empleados['cargo'] == 'OPERADOR') {
                $sueldo_bruto = floatval($row_empleados['sueldo_bruto'] - ($row_empleados['faltas'] * $row_empleados['sueldo_base']));
            }elseif ($imss != 1) {
                $sueldo_bruto = ($sueldo_base * 7) - ($row_empleados['sueldo_base'] * $row_empleados['faltas']);
            }else {
                $sueldo_bruto = 0;
            }
            $pago_fiscal = $row_empleados['pago_fiscal'] ?? 0;
            $deduccion_fiscal = $row_empleados['deduccion_fiscal'] ?? 0;
            $deposito = $pago_fiscal - $deduccion_fiscal;
            $apoyo_mes = (dia15EntreFechas($fecha_inicio, $fecha_fin) && $gana_apoyo_mes) ? floatval($row_empleados['apoyo_mes']) : 0;
            $anios_trabajados = calcularAniosTrabajados($row_empleados['fecha_contrato']);
            $dias_correspondientes_vacaciones = calcularDiasVacaciones($anios_trabajados);
            $prima_vacacional = $row_empleados['prima_vacacional'] == 'SI' ? (($row_empleados['salario_diario'] * $dias_correspondientes_vacaciones) * .25) : 0;
            $dias_vacaciones = isset($row_empleados['fecha_final']) || isset($row_empleados['fecha_inicial']) ? (intval($row_empleados['fecha_inicial']) + 1) ?? (intval($row_empleados['fecha_final']) + 1) : 0;
            $pago_vacaciones = ($dias_vacaciones * $row_empleados['salario_diario']) ?? 0;
            $bono_categoria = dia15EntreFechas($fecha_inicio, $fecha_fin) ? floatval($row_empleados['bono_categoria']) : 0;
            $bono_semanal = ($gana_bono && $dias_vacaciones === 0 && $bono_semanal_contrato && $total_vueltas > 10) ? floatval($row_empleados['bono_semanal']) : 0;
            
            $efectivo = (($sueldo_bruto > 0) ? ($sueldo_bruto - $pago_fiscal) : 0) + $bono_semanal + $bono_supervisor + $bono_categoria + $apoyo_mes + $pago_vacaciones + $prima_vacacional - $deducciones - $caja_ahorro;
            
            $neto = $deposito + $efectivo;

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
    }else {
        while ($row_empleados = mysqli_fetch_assoc($result_empleados)) {
            $pago_fiscal = $row_empleados['pago_fiscal'] ?? 0;
            $deduccion_fiscal = $row_empleados['deduccion_fiscal'] ?? 0;
            $neto = $row_empleados['neto'] ?? 0;
            $actualizar_nomina = "UPDATE nomina_temp_2025 SET nomina_fiscal = " . $pago_fiscal . ", deduccion_fiscal = " . $deduccion_fiscal . ", deposito_fiscal = " . $neto . " WHERE nombre = '" . $row_empleados['operador'] . "'";
            $result_actualizar_nomina = mysqli_query($conection, $actualizar_nomina);
            if (!$result_actualizar_nomina) {
                die(json_encode(['error' => 'Error al actualizar los datos de la nómina: ' . mysqli_error($conection)]));
            }
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
    
    $sql_total_pagar = "SELECT SUM(
    -- sueldo_bruto + bono_semanal + bono_categoria + bono_supervisor - deducciones - nomina_fiscal - caja_ahorro + prima_vacacional + pago_vacaciones + apoyo_mes
    neto
    ) AS total_nomina, SUM(efectivo) AS total_efectivo, SUM(sueldo_bruto) AS total_sueldo, SUM(nomina_fiscal) AS total_fiscal, SUM(deducciones) AS total_deducciones, SUM(bono_semanal) AS total_bono, SUM(deposito_fiscal) AS total_deposito, SUM(caja_ahorro) AS total_caja FROM nomina_temp_2025";
    $result_total_pagar = mysqli_query($conection, $sql_total_pagar);
    $total_nomina = mysqli_fetch_assoc($result_total_pagar);
    $data_output = [];
    while ($row = mysqli_fetch_assoc($result_nomina)) {
        $data_output[] = $row;
    }
    $draw = $_POST['draw'] ?? 1;
    echo json_encode([
        'draw' => $draw,
        'totales' => $total_nomina,
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalFiltered,
        'data' => $data_output
        // 'data_totales' => $data_totales
    ]);
} else {
    json_encode([]);
}
?>