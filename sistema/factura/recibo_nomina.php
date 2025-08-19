<?php
require('../fpdf/fpdf.php');
require('../includes/conversor.php');
require('../../conexion.php');           // Debe exponer $conection (mysqli)
// require('../PHPMailer/PHPMailerAutoload.php'); // <-- NO es necesario si solo mostramos

set_time_limit(0);
ini_set('max_execution_time', 0);
date_default_timezone_set('America/Mexico_City');

$conection->set_charset('utf8mb4');

// -------------------------------------------------------------------
// Parámetros
// -------------------------------------------------------------------
$tipoRaw  = isset($_REQUEST['id'])  ? (string)$_REQUEST['id']  : 'Semanal';
$semana   = isset($_REQUEST['id2']) ? (string)$_REQUEST['id2'] : '';
$anio     = isset($_REQUEST['id3']) ? (int)$_REQUEST['id3']    : 0;
// mostrar=1 => solo visualizar consolidado, SIN enviar correos
$mostrar  = isset($_REQUEST['mostrar']) ? filter_var($_REQUEST['mostrar'], FILTER_VALIDATE_BOOLEAN) : false;

// Mapea id a tipo si fuera necesario (ajústalo a tu lógica real)
$tipo = $tipoRaw ?: 'Semanal';

if ($anio <= 0) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Faltan parámetros requeridos (anio)'], JSON_UNESCAPED_UNICODE);
    exit;
}

// -------------------------------------------------------------------
// Clase PDF (encabezado/pie)
// -------------------------------------------------------------------
class PDF extends FPDF {
    function Header() {
        $this->Image("../../images/transvive.png", 12, 11, 48, 13, "png", 0);
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(231, 233, 238);
        $this->SetTextColor(6, 22, 54);
    }
    function Footer() {
        $this->SetY(-10);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

// -------------------------------------------------------------------
// Helpers PDF
// -------------------------------------------------------------------
function dibujarReciboEnPDF(FPDF $pdf, array $row, array $vueltasRows, int $numeroSemana, string $periodo): void {
    // Página 1: totales
    $pdf->AddPage('P','Letter');
    $pdf->SetFont('Arial','',8);
    $pdf->Ln(12);
    $pdf->Cell(189,5,utf8_decode("Recibo de Pago - Semana $numeroSemana"),0,1,'C');
    $pdf->Cell(189,5,utf8_decode("Empleado: {$row['noempleado']} - {$row['nombre']}"),0,1,'L');
    $pdf->Cell(189,5,utf8_decode($periodo),0,1,'L');
    $pdf->Ln(2);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetFillColor(231,233,238);
    $pdf->Cell(60,5,'Percepciones',1,0,'C');
    $pdf->Cell(60,5,'Deducciones',1,1,'C');

    $pdf->SetFont('Arial','',8);
    $pdf->Cell(60,5,'Vueltas Totales: ' . number_format((float)$row['total_vueltas'], 2),0,0);
    $pdf->Cell(60,5,'Deduccion por Adeudo: $' . number_format((float)$row['deducciones'], 2),0,1);

    $pdf->Cell(60,5,'Pago Total Vueltas: $' . number_format((float)$row['sueldo_bruto'], 2),0,0);
    $pdf->Cell(60,5,'Caja Ahorro: $' . number_format((float)$row['caja_ahorro'], 2),0,1);

    $pdf->Cell(60,5,'Sueldo Adicional: $' . number_format((float)$row['sueldo_adicional'], 2),0,0);
    $pdf->Cell(60,5,'Deduccion Fiscal: $' . number_format((float)$row['deduccion_fiscal'], 2),0,1);

    $pdf->Cell(60,5,'Bono Semanal: $' . number_format((float)$row['bono_categoria'], 2),0,1);
    $pdf->Cell(60,5,'Bono Supervisor: $' . number_format((float)$row['bono_supervisor'], 2),0,1);
    $pdf->Cell(60,5,'Bono Alertas: $' . number_format((float)$row['bono_semanal'], 2),0,1);
    $pdf->Cell(60,5,'Vales de Despensa: $' . number_format((float)$row['apoyo_mes'], 2),0,1);
    $pdf->Cell(60,5,'Dias de Vacaciones: ' . number_format((float)$row['dias_vacaciones'], 2),0,1);
    $pdf->Cell(60,5,'Pago Vacaciones: $' . number_format((float)$row['pago_vacaciones'], 2),0,1);
    $pdf->Cell(60,5,'Prima Vacacional: $' . number_format((float)$row['prima_vacacional'], 2),0,1);

    $percepciones = (float)$row['sueldo_bruto'] + (float)$row['sueldo_adicional'] + (float)$row['bono_categoria'] + (float)$row['bono_supervisor'] + (float)$row['bono_semanal'] + (float)$row['apoyo_mes'] + (float)$row['prima_vacacional'] + (float)$row['pago_vacaciones'];
    $deducciones  = (float)$row['deducciones'] + (float)$row['caja_ahorro'] + (float)$row['deduccion_fiscal'];
    $neto         = $percepciones - $deducciones;

    $pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,5,utf8_decode('Total Percepciones: $' . number_format($percepciones, 2)),0,0,'L');
    $pdf->Cell(60,5,'Total Deducciones: $' . number_format($deducciones, 2),0,1,'R');

    $pdf->Ln(4);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,5,'Total Neto: $' . number_format($neto, 2),0,1);

    $pdf->Ln(4);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,5,utf8_decode('Depósito Fiscal: $' . number_format((float)$row['deposito_fiscal'], 2)),0,0,'L');
    $pdf->Cell(60,5,'Depósito Efectivo: $' . number_format($neto - (float)$row['deposito_fiscal'], 2),0,1,'R');

    $pdf->Ln(5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(189,5,utf8_decode('Recibí conforme.'),0,1,'L');
    $pdf->Cell(189,10,'_________________________',0,1,'R');
    $pdf->Cell(189,5,'Firma',0,1,'R');

    // Página 2: vueltas
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $pdf->Ln(12);
    $pdf->Cell(189,5,utf8_decode("Recibo de Pago - Semana $numeroSemana"),0,1,'C');
    $pdf->Cell(189,5,utf8_decode("Empleado: {$row['noempleado']} - {$row['nombre']}"),0,1,'L');
    $pdf->Cell(189,5,utf8_decode($periodo),0,1,'L');
    $pdf->Ln(2);

    $pdf->SetFont('Arial','B',9);
    $pdf->SetFillColor(200,200,200);
    $pdf->Cell(60,6,utf8_decode('Cliente'),1,0,'C',true);
    $pdf->Cell(60,6,utf8_decode('Ruta'),1,0,'C',true);
    $pdf->Cell(30,6,utf8_decode('Unidad'),1,0,'C',true);
    $pdf->Cell(30,6,utf8_decode('Valor'),1,1,'C',true);

    $pdf->SetFont('Arial','',8);
    if (!empty($vueltasRows)) {
        foreach ($vueltasRows as $v) {
            $pdf->Cell(60,6,utf8_decode($v['cliente']),1);
            $pdf->Cell(60,6,utf8_decode($v['ruta']),1);
            $pdf->Cell(30,6,utf8_decode($v['unidad_ejecuta']),1);
            $pdf->Cell(30,6, ((float)$v['valor_vuelta'] == 1.00 ? 'Completa' : 'Media'),1,1,'R');
        }
    } else {
        $pdf->Cell(180,6,utf8_decode('No se registraron vueltas en este periodo.'),1,1,'C');
    }
}

// -------------------------------------------------------------------
// Flujo principal (SOLO PREVIEW CUANDO mostrar=1)
// -------------------------------------------------------------------
switch (strtolower($tipo)) {
    case 'semanal': {
        $numeroSemana = (int)intval(str_replace('Semana ', '', (string)$semana));
        if ($numeroSemana <= 0) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => 'Semana inválida.'], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // Periodo Lunes-Domingo
        $fi = new DateTime();
        $fi->setISODate($anio, $numeroSemana, 1);
        $ff = new DateTime();
        $ff->setISODate($anio, $numeroSemana, 7);
        $periodo    = 'Del: ' . $fi->format('d/m/Y') . ' al: ' . $ff->format('d/m/Y');
        $fechaIniDB = $fi->format('Y-m-d');
        $fechaFinDB = $ff->format('Y-m-d');

        // Traer empleados
        $stmt = $conection->prepare("SELECT * FROM historico_nomina WHERE semana = ? AND anio = ? ORDER BY noempleado");
        if (!$stmt) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => 'Error preparando consulta de nómina: ' . $conection->error], JSON_UNESCAPED_UNICODE);
            exit;
        }
        $stmt->bind_param("ii", $numeroSemana, $anio);
        $stmt->execute();
        $rs = $stmt->get_result();
        if (!$rs || $rs->num_rows === 0) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => 'No hay datos para la semana seleccionada.'], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // Consulta de vueltas
        $sqlVueltas = "SELECT cliente, ruta, valor_vuelta, unidad_ejecuta
                       FROM registro_viajes
                       WHERE operador = ? AND fecha BETWEEN ? AND ? AND valor_vuelta > 0
                       ORDER BY fecha ASC";
        $stmtVueltas = $conection->prepare($sqlVueltas);
        if (!$stmtVueltas) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => 'Error preparando consulta de vueltas: ' . $conection->error], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // ====== MODO MOSTRAR (NO ENVÍA CORREOS) ======
        if ($mostrar) {
            $pdfAll = new PDF();

            while ($row = $rs->fetch_assoc()) {
                // Si tu tabla registro_viajes relaciona por noempleado, cambia aquí operador = ?
                $stmtVueltas->bind_param("sss", $row['nombre'], $fechaIniDB, $fechaFinDB);
                $stmtVueltas->execute();
                $resV = $stmtVueltas->get_result();
                $vueltasRows = $resV ? $resV->fetch_all(MYSQLI_ASSOC) : [];

                // Agrega 2 páginas por empleado al consolidado
                dibujarReciboEnPDF($pdfAll, $row, $vueltasRows, $numeroSemana, $periodo);
            }

            // Mostrar en pantalla
            $nombreAll = "Recibos_Semana_{$numeroSemana}_Consolidado.pdf";
            $pdfAllData = $pdfAll->Output('S');
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="'.$nombreAll.'"');
            echo $pdfAllData;
            exit;
        }

        // ====== MODO ENVIAR (aquí podrías pegar tu lógica de envío si lo deseas) ======
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => true, 'msg' => 'Aquí va la rama de envío (no ejecutada porque mostrar!=1).'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    default:
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'Tipo no implementado en este preview.'], JSON_UNESCAPED_UNICODE);
        exit;
}
