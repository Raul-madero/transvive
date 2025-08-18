<?php
session_start();
include("../../conexion.php");

ini_set('max_execution_time', 300);
set_time_limit(300);

if (!$conection) {
    die(json_encode(['error' => 'Error de conexión a la base de datos.']));
}

// === Funciones auxiliares ===
function calcularAniosTrabajados($fecha_contrato) {
    if (empty($fecha_contrato)) return 0;
    try {
        return (new DateTime($fecha_contrato))->diff(new DateTime())->y;
    } catch (Exception $e) {
        return 0;
    }
}

function esFechaValidaContrato($fecha) {
    if (empty($fecha)) return false;

    $f = DateTime::createFromFormat('Y-m-d', $fecha);
    return $f && $f->format('Y-m-d') === $fecha && $f >= new DateTime('1900-01-01');
}

function calcularBonoSemanalContrato($fecha_contrato) {
    if (empty($fecha_contrato)) return false;
    try {
        $fechaInicio = new DateTime($fecha_contrato);
        return $fechaInicio->diff(new DateTime())->days >= 7;
    } catch (Exception $e) {
        return false;
    }
}

function calcularApoyoMesContrato($fecha_contrato) {
    if (empty($fecha_contrato)) return false;
    try {
        // Fecha de contrato
        $fechaContrato = new DateTime($fecha_contrato);

        // Obtener el día 15 del mes actual
        $hoy = new DateTime();
        $hoy->setDate($hoy->format('Y'), $hoy->format('m'), 15);

        // Verificar si la fecha de contrato es >= a 30 días del 15 del mes actual
        return $fechaContrato->diff($hoy)->days >= 30;
    } catch (Exception $e) {
        return false;
    }
}
function calcularDiasVacaciones($anios) {
    if ($anios <= 0) return 0;
    if ($anios === 1) return 12;
    if ($anios === 2) return 14;
    if ($anios === 3) return 16;
    if ($anios === 4) return 18;
    if ($anios === 5) return 20;
    if ($anios >= 6 && $anios <= 10) return 22;
    if ($anios >= 11 && $anios <= 15) return 24;
    if ($anios >= 16 && $anios <= 20) return 26;
    if ($anios >= 21 && $anios <= 25) return 28;
    if ($anios >= 26 && $anios <= 30) return 30;
    return 32;
}


function dia15EntreFechas($fecha_inicio, $fecha_fin) {
    $inicio = strtotime($fecha_inicio);
    $fin = strtotime($fecha_fin);
    $dia15 = strtotime('15 ' . date('F Y', $inicio));
    $dia15_next = strtotime('15 ' . date('F Y', strtotime('+1 month', $inicio)));
    return ($dia15 >= $inicio && $dia15 <= $fin) || ($dia15_next >= $inicio && $dia15_next <= $fin);
}

function insertar_nomina($conection, $data) {
     // Verificar si el cargo es 'OPERADOR' y el total_vueltas es 0
    if ($data['cargo'] === 'OPERADOR' && $data['dias_vacaciones'] == 0 && $data['total_vueltas'] == 0) {
        // Si las condiciones se cumplen, no se hace la inserción
        return; // o puedes usar exit() si quieres detener la ejecución completamente
    }
    
    $stmt = mysqli_prepare($conection, "INSERT INTO nomina_temp_2025 (
        semana, anio, noempleado, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto,
        bono_semanal, bono_categoria, bono_supervisor, deducciones, caja_ahorro, supervisor, nomina_fiscal, efectivo,
        deduccion_fiscal, deposito_fiscal, apoyo_mes, prima_vacacional, dias_vacaciones, pago_vacaciones, neto
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "siissssiddddddddsddddddidd",
        $data['semana'], $data['anio'], $data['noempleado'], $data['nombre'], $data['no_unidad'], $data['tipo_unidad'], 
        $data['cargo'], $data['imss'], $data['sueldo_base'], $data['total_vueltas'], $data['sueldo_bruto'],
        $data['bono_semanal'], $data['bono_categoria'], $data['bono_supervisor'], $data['deducciones'], $data['caja_ahorro'], $data['supervisor'], 
        $data['pago_fiscal'], $data['efectivo'], $data['deduccion_fiscal'], $data['deposito'], $data['apoyo_mes'], $data['prima_vacacional'], 
        $data['dias_vacaciones'], $data['pago_vacaciones'], $data['neto']
    );

    if (!mysqli_stmt_execute($stmt)) {
        die(json_encode(['error' => 'Error al insertar datos: ' . mysqli_error($conection)]));
    }
}

if (isset($_POST['semana'], $_POST['anio']) && !empty($_POST['semana']) && !empty($_POST['anio'])) {
    $semana = intval($_POST['semana']);
    $anio = intval($_POST['anio']);

    // Calcular rango de fechas ISO de la semana
    $fecha = new DateTime();
    $fecha->setISODate($anio, $semana);
    $fecha_inicio = $fecha->format('Y-m-d');
    $fecha_fin = $fecha->modify('+6 days')->format('Y-m-d');
    $fecha_limite_alertas = date('Y-m-d', strtotime('next wednesday', strtotime($fecha_fin)));

    // Verificar si ya existen registros para esta semana y año
    $stmt_check = $conection->prepare("SELECT COUNT(*) as total FROM nomina_temp_2025 WHERE semana = ? AND anio = ?");
    $stmt_check->bind_param("ii", $semana, $anio);
    $stmt_check->execute();
    $total_check = $stmt_check->get_result()->fetch_assoc()['total'] ?? 0;

    // Si no hay registros, limpiar registros viejos y generar nuevos
    if ($total_check == 0) {
        $stmt_delete = $conection->prepare("DELETE FROM nomina_temp_2025 WHERE semana != ? OR anio != ?");
        $stmt_delete->bind_param("ii", $semana, $anio);
        $stmt_delete->execute();
    }

    // --- CONSULTA PRINCIPAL (empleados + viajes + incidencias + adeudos + fiscales) ---
    $sql_empleados = file_get_contents(__DIR__ . '/queries/empleados_nomina.sql'); // Opción: mover a archivo externo legible
    $sql_empleados = str_replace(['{fecha_inicio}', '{fecha_fin}', '{fecha_limite_alertas}'], [$fecha_inicio, $fecha_fin, $fecha_limite_alertas], $sql_empleados);
    $result_empleados = $conection->query($sql_empleados);

    if (!$result_empleados) {
        die(json_encode(['error' => 'Error en consulta empleados: ' . $conection->error]));
    }
    while ($empleado = $result_empleados->fetch_assoc()) {
        // var_dump($empleado); // Para depuración
        $noempleado = $empleado['noempleado'];
        $sueldo_base = floatval($empleado['sueldo_base']);
        $operador = $empleado['operador'];
        $cargo = $empleado['cargo'];
        $imss = $empleado['imss'];
        $bono_categoria = $empleado['bono_categoria'];
        $bono_supervisor = $empleado['bono_supervisor'];
        $bono_semanal = 100;
        $fecha_contrato = null;

        if (esFechaValidaContrato($empleado['fecha_reingreso'])) {
            $fecha_contrato = $empleado['fecha_reingreso'];
        } elseif (esFechaValidaContrato($empleado['fecha_contrato'])) {
            $fecha_contrato = $empleado['fecha_contrato'];
        } else {
            // Opcional: manejar si ninguna fecha es válida
            $fecha_contrato = null; // o lanzar error/log
        }

        $caja_ahorro = $empleado['caja_ahorro'];
        $supervisor = $empleado['supervisor'];
        $apoyo_mes = $empleado['apoyo_mes'];
        $salario_diario = $empleado['salario_diario'];
        $alertas = intval($empleado['noalertas']);
        $faltas = intval($empleado['faltas']);
        $dias_vacaciones_pagar =$empleado['dias_vacaciones_pagar'] ? intval($empleado['dias_vacaciones_pagar']) : 0;
        $sueldo_vueltas = floatval($empleado['sueldo_vueltas']);
        $prima_vacacional = $empleado['prima_vacacional'];
        $total_vueltas = floatval($empleado['total_vueltas']);
        $sueldo_bruto = $dias_vacaciones_pagar >= 6 ? 0 : floatval($empleado['sueldo_bruto']);
        $descuento = floatval($empleado['descuento']);
        $cantidad = floatval($empleado['cantidad']);
        $total_abonado = floatval($empleado['total_abonado']);
        $pago_fiscal = 0;
        if($imss == 1 && is_null($empleado['pago_fiscal'])) {
            $pago_fiscal = 2240;
        }else {
            $pago_fiscal = floatval($empleado['pago_fiscal']);
        }
        $deduccion_fiscal = floatval($empleado['deduccion_fiscal']);
        $neto = floatval($empleado['neto']);

        //Calcular los anios trabajados, días de vacaciones y otros bonos
        $anios_trabajados = calcularAniosTrabajados($fecha_contrato);
        $dias_vacaciones = calcularDiasVacaciones($anios_trabajados);
        $prima = ($prima_vacacional == 'SI') ? ($salario_diario * $dias_vacaciones * 0.25) : 0;
        $vacaciones = floatval($salario_diario) * intval($dias_vacaciones_pagar);

        //Calculo de vales de despensa
        $bono_apoyo = (dia15EntreFechas($fecha_inicio, $fecha_fin) && calcularApoyoMesContrato($fecha_contrato)) ? floatval($apoyo_mes) : 0;
        $bono_semanal = (
            intval($alertas) <= 4 && 
            calcularBonoSemanalContrato($fecha_contrato) && 
            $dias_vacaciones_pagar <= 2 && 
            $total_vueltas > 0 && 
            intval($faltas)  == 0
            ) ? floatval($bono_semanal) : 0;
        // $bono_categoria = 0;

        //Calculo de deducciones
        $deduccion = max(0, floatval($cantidad) - floatval($total_abonado));
        $deduccion = ($deduccion > floatval($descuento)) ? floatval($descuento) : $deduccion;
        
        //Descontar faltas del sueldo bruto
        $bruto = (($cargo == 'OPERADOR') ?  floatval($sueldo_bruto - ($faltas * $sueldo_base)) :  ($sueldo_base * 7) + $sueldo_vueltas - ($sueldo_base * $faltas));
        $fiscal = floatval($pago_fiscal ?? 0);
        $ded_fiscal = floatval($deduccion_fiscal ?? 0);
        $deposito = $fiscal - $ded_fiscal;
        $efectivo = (($bruto > 0) ? ($bruto - $fiscal) : (($vacaciones > 0) ? ($vacaciones - $fiscal) : 0)) + $bono_semanal + $bono_supervisor + $bono_categoria + $bono_apoyo + $prima + $vacaciones - $deduccion - floatval($caja_ahorro);
        $neto = $deposito + $efectivo;

        // Arreglo para inserción
        $datos = [
            'semana' => $semana,
            'anio' => $anio,
            'noempleado' => $empleado['noempleado'],
            'nombre' => $empleado['operador'],
            'no_unidad' => $empleado['num_unidad'] ?? '',
            'tipo_unidad' => $empleado['unidad'] ?? '',
            'bono_categoria' => $bono_categoria,
            'bono_supervisor' => $bono_supervisor,
            'bono_semanal' => $bono_semanal,
            'cargo' => $empleado['cargo'],
            'imss' => $empleado['imss'],
            'sueldo_base' => $sueldo_base,
            'total_vueltas' => $total_vueltas,
            'sueldo_bruto' => $bruto,
            'deducciones' => $deduccion,
            'caja_ahorro' => $empleado['caja_ahorro'],
            'supervisor' => $empleado['supervisor'],
            'pago_fiscal' => $fiscal,
            'efectivo' => $efectivo,
            'deduccion_fiscal' => $ded_fiscal,
            'deposito' => $deposito,
            'apoyo_mes' => $bono_apoyo,
            'prima_vacacional' => $prima,
            'dias_vacaciones' => $empleado['dias_vacaciones_pagar'],
            'pago_vacaciones' => $vacaciones,
            'neto' => $neto
        ]; 
        // var_dump($datos); // Para depuración

        if ($total_check == 0) {
            insertar_nomina($conection, $datos);
        } else {
            $conection->query("UPDATE nomina_temp_2025 SET nomina_fiscal = $fiscal, deduccion_fiscal = $ded_fiscal, deposito_fiscal = $deposito WHERE nombre = '{$empleado['operador']}'");
        }
    }

    // PAGINACIÓN
    $start = $_POST['start'] ?? 0;
    $length = $_POST['length'] ?? 10;
    $search = $_POST['search']['value'] ?? '';
    $colIndex = $_POST['order'][0]['column'] ?? 0;
    $orderDir = $_POST['order'][0]['dir'] ?? 'asc';
    $columns = ['semana', 'anio', 'noempleado', 'nombre', 'cargo', 'imss', 'sueldo_base', 'supervisor', 'sueldo_bruto', 'nomina_fiscal', 'neto'];

    $where = !empty($search) ? "WHERE nombre LIKE '%$search%' OR noempleado LIKE '%$search%'" : "";

    $sql_nomina = "SELECT * FROM nomina_temp_2025 $where ORDER BY {$columns[$colIndex]} $orderDir LIMIT $start, $length";
    $result_nomina = $conection->query($sql_nomina);
    $data_output = [];
    while ($row = $result_nomina->fetch_assoc()) {
        $data_output[] = $row;
    }
    // var_dump($data_output);
    $totalRecords = $conection->query("SELECT COUNT(*) FROM nomina_temp_2025")->fetch_row()[0];
    $filtered = $conection->query("SELECT COUNT(*) FROM nomina_temp_2025 $where")->fetch_row()[0];
    $total_nomina = $conection->query("SELECT SUM(sueldo_bruto + bono_semanal + bono_supervisor + bono_categoria + apoyo_mes + pago_vacaciones + prima_vacacional + sueldo_adicional - deducciones - caja_ahorro) AS total_nomina FROM nomina_temp_2025")->fetch_assoc();
    $total_fiscal = $conection->query("SELECT SUM(nomina_fiscal) AS total_fiscal FROM nomina_temp_2025")->fetch_assoc();
    $total_adeudo = $conection->query("SELECT SUM(deducciones) AS total_deducciones FROM nomina_temp_2025")->fetch_assoc();
    $total_caja_ahorro = $conection->query("SELECT SUM(caja_ahorro) AS total_caja FROM nomina_temp_2025")->fetch_assoc();
    $total_efectivo = $conection->query("SELECT SUM((sueldo_bruto - nomina_fiscal) + bono_semanal + bono_supervisor + bono_categoria + apoyo_mes + pago_vacaciones + prima_vacacional + sueldo_adicional - deducciones - caja_ahorro) AS total_efectivo FROM nomina_temp_2025")->fetch_assoc();
    $total_vueltas = $conection->query("SELECT COALESCE(SUM(total_vueltas), 0) AS total_total_vueltas FROM nomina_temp_2025")->fetch_assoc();

    echo json_encode([
        'draw' => intval($_POST['draw'] ?? 1),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $filtered,
        'totales' => $total_nomina,
        'data' => $data_output,
        'total_fiscal' => $total_fiscal,
        'total_adeudo' => $total_adeudo,
        'total_efectivo' => $total_efectivo,
        'total_caja_ahorro' => $total_caja_ahorro,
        'total_vueltas' => $total_vueltas
    ]);
} else {
    echo json_encode(['error' => 'Semana y año requeridos']);
}
?>