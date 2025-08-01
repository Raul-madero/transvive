<?php
session_start();
include('../../conexion.php');

if(!$conection) {
    die(json_encode(['status' => 'error', 'message' => 'Error de la conexión a la base de datos']));
}

if(!isset($_POST['semana']) || !isset($_POST['anio']) || empty($_POST['semana']) || empty($_POST['anio'])) {
    die(json_encode(['status' => 'error', 'message' => 'Parámetros incompletos']));
}

$semana = $_POST['semana'];
$anio = $_POST['anio'];

// Obtener datos para la paginación
$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$searchValue = $_POST['search']['value'] ?? '';
$orderColumn = $_POST['order'][0]['column'];
$orderDir = $_POST['order'][0]['dir'];

$whereClause = "WHERE semana = $semana AND anio = $anio";
if (!empty($searchValue)) {
    $whereClause .= " AND (noempleado LIKE '%$searchValue%' OR nombre LIKE '%$searchValue%')";
}

$columns = array('semana', 'anio', 'noempleado', 'nombre', 'cargo', 'imss', 'sueldo_base', 'supervisor', 'sueldo_bruto', 'nomina_fiscal', 'bono_semanal', 'bono_categoria', 'bono_supervisor', 'apoyo_mes', 'deposito', 'efectivo', 'deducciones', 'deduccion_fiscal', 'caja_ahorro', 'supervisor', 'neto');

// Recuperar datos finales
$sql_nomina = "SELECT id, semana, anio, noempleado, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto, nomina_fiscal, bono_semanal, bono_categoria, bono_supervisor, apoyo_mes, deposito_fiscal, efectivo, deducciones, caja_ahorro, supervisor, deduccion_fiscal, deposito_fiscal, prima_vacacional, dias_vacaciones, pago_vacaciones, neto, sueldo_adicional
                FROM historico_nomina $whereClause 
                GROUP BY  id, noempleado, anio, semana, nombre, no_unidad, tipo_unidad, cargo, imss, sueldo_base, total_vueltas, sueldo_bruto, nomina_fiscal, bono_semanal, bono_categoria, bono_supervisor, apoyo_mes, deposito_fiscal, efectivo, deducciones, caja_ahorro, supervisor, deduccion_fiscal, deposito_fiscal, prima_vacacional, dias_vacaciones, pago_vacaciones, neto, sueldo_adicional
                ORDER BY $columns[$orderColumn] $orderDir LIMIT $start, $length"; 

$result_nomina = mysqli_query($conection, $sql_nomina);
if (!$result_nomina) {
    die(json_encode(['error' => 'Error al obtener los datos de la nómina: ' . mysqli_error($conection)]));
}
// Obtener el total de registros (sin LIMIT)
$sql_count_nomina = "SELECT COUNT(*) FROM historico_nomina";
$result_count_total = mysqli_query($conection, $sql_count_nomina);
$totalRecords = mysqli_fetch_row($result_count_total)[0];

//Obtrener el total filtrado
$sql_total_filtered = "SELECT COUNT(*) FROM historico_nomina $whereClause";
$result_count_filtered = mysqli_query($conection, $sql_total_filtered);
$totalFiltered = mysqli_fetch_row($result_count_filtered)[0];

// $sql_total_pagar = "SELECT 
// SUM(
//     CASE 
//         WHEN cargo = 'OPERADOR' THEN 
//             sueldo_bruto + bono_semanal + bono_categoria + bono_supervisor - deducciones - deduccion_fiscal - caja_ahorro + prima_vacacional + pago_vacaciones + apoyo_mes
//         ELSE 
//             deposito_fiscal + prima_vacacional + pago_vacaciones - deducciones - caja_ahorro
//     END
// ) AS total_nomina
// FROM historico_nomina
// WHERE semana = $semana AND anio = $anio";
// $result_total_pagar = mysqli_query($conection, $sql_total_pagar);
// $total_nomina = mysqli_fetch_row($result_total_pagar)[0];
$data_output = [];
while ($row = mysqli_fetch_assoc($result_nomina)) {
    $data_output[] = $row;
}
$draw = $_POST['draw'] ?? 1;

$total_nomina = $conection->query("SELECT SUM((sueldo_bruto - nomina_fiscal) + bono_semanal + bono_supervisor + bono_categoria + apoyo_mes + pago_vacaciones + prima_vacacional +sueldo_adicional - deducciones - caja_ahorro + deposito_fiscal) AS total_nomina FROM historico_nomina WHERE semana = $semana AND anio = $anio")->fetch_assoc();
$total_fiscal = $conection->query("SELECT SUM(nomina_fiscal) AS total_fiscal FROM historico_nomina WHERE semana = $semana AND anio = $anio")->fetch_assoc();
$total_adeudo = $conection->query("SELECT SUM(deducciones) AS total_deducciones FROM historico_nomina WHERE semana = $semana AND anio = $anio")->fetch_assoc();
$total_caja_ahorro = $conection->query("SELECT SUM(caja_ahorro) AS total_caja FROM historico_nomina WHERE semana = $semana AND anio = $anio")->fetch_assoc();
$total_vueltas = $conection->query("SELECT COALESCE(SUM(total_vueltas), 0) AS total_total_vueltas FROM historico_nomina WHERE semana = $semana AND anio = $anio")->fetch_assoc();

echo json_encode([
    'draw' => $draw,
    'totales' => $total_nomina,
    'total_fiscal' => $total_fiscal,
    'total_adeudo' => $total_adeudo,
    'total_caja_ahorro' => $total_caja_ahorro,
    'total_vueltas' => $total_vueltas,
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalFiltered,
    'data' => $data_output
    // 'data_totales' => $data_totales
]);