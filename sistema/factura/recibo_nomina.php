<?php
require('../fpdf/fpdf.php');
require('../includes/conversor.php');
require('../../conexion.php');           // debe exponer $conection (mysqli)
require('../PHPMailer/PHPMailerAutoload.php');

set_time_limit(0);
ini_set('max_execution_time', 0);
date_default_timezone_set('America/Mexico_City');

header("Content-Type: application/json; charset=utf-8");

// -------------------- Clase PDF (encabezado/pie) --------------------
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

$conection->set_charset('utf8mb4');

// -------------------- Parámetros de entrada --------------------
$tipo   = isset($_REQUEST['tipo']) ? (string)$_REQUEST['tipo'] : 'Semanal';
$semana = isset($_REQUEST['id2'])  ? (string)$_REQUEST['id2']  : '';
$anio   = isset($_REQUEST['id3'])  ? (int)$_REQUEST['id3']     : 0;
$id     = isset($_REQUEST['id'])   ? (string)$_REQUEST['id']   : '';

if (empty($tipo) || $anio <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan parámetros requeridos (tipo/anio)'], JSON_UNESCAPED_UNICODE);
    exit;
}

// -------------------- Config SMTP --------------------
define('SMTP_HOST', 'smtp.office365.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'auxiliar.rh@transvivegdl.com.mx');        // From en O365
define('SMTP_FROM', 'auxiliar.rh@transvivegdl.com.mx');        // Debe ser el mismo usuario o alias permitido
define('SMTP_NAME', 'Nomina Transvive');
// Usa variable de entorno si está disponible; si no, reemplaza el placeholder:
define('SMTP_PASSWORD', getenv('SMTP_PASSWORD') ?: 'PON_AQUI_TU_PASSWORD');

// Correo que recibirá el paquete consolidado (o pásalo como $_REQUEST['resumen_to'])
define('RESUMEN_TO', 'rh@transvivegdl.com.mx');

function mailerBase() {
    $mail = new PHPMailer();          // PHPMailer v5.x
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->Port       = SMTP_PORT;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';        // PHPMailer 5 => 'tls'
    $mail->SMTPAutoTLS = true;
    // $mail->AuthType    = 'LOGIN';  // Opcional, LOGIN es el default

    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASSWORD;

    $mail->setFrom(SMTP_FROM, SMTP_NAME);
    $mail->addReplyTo(SMTP_FROM, SMTP_NAME);

    $mail->CharSet       = 'UTF-8';
    $mail->Timeout       = 20;
    $mail->SMTPKeepAlive = true;

    // Producción: sin debug para no romper JSON
    $mail->SMTPDebug  = 0;

    return $mail;
}

// -------------------- Helpers de PDF --------------------
/**
 * Dibuja un recibo (2 páginas) en la instancia de FPDF que se le pase.
 * $vueltasRows: arreglo asociativo con las vueltas del periodo.
 */
function dibujarReciboEnPDF(FPDF $pdf, array $row, array $vueltasRows, int $numeroSemana, string $periodo): void {
    // -------- Portada / totales ----------
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

    // -------- Detalle de vueltas ----------
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

/** Devuelve el PDF individual como string (para adjuntar al mail del empleado). */
function pdfReciboSemanalComoString(array $row, array $vueltasRows, int $numeroSemana, string $periodo): string {
    $pdf = new PDF();
    dibujarReciboEnPDF($pdf, $row, $vueltasRows, $numeroSemana, $periodo);
    return $pdf->Output('S');
}

// -------------------- Helpers de datos/correo --------------------
/** Obtiene email del empleado por noempleado; retorna null si no es válido. */
function obtenerEmailEmpleado(mysqli $db, $noempleado): ?string {
    $sql = "SELECT COALESCE(correo, '') AS email FROM empleados WHERE noempleado = ? LIMIT 1";
    if ($st = $db->prepare($sql)) {
        $st->bind_param('i', $noempleado);
        $st->execute();
        $res = $st->get_result();
        if ($res && $fila = $res->fetch_assoc()) {
            $email = trim((string)$fila['email']);
            return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
        }
    }
    return null;
}

/** Envía un correo con un adjunto PDF (string). Retorna ['ok'=>bool, 'msg'=>string]. */
function enviarRecibo(PHPMailer $m, string $emailDestino, string $nombreDestino, string $pdfData, string $nombreAdjunto, string $asunto, string $cuerpoHTML): array {
    $m->clearAddresses();
    $m->clearAttachments();

    $m->addAddress($emailDestino, $nombreDestino);
    $m->Subject = $asunto;
    $m->isHTML(true);
    $m->Body = $cuerpoHTML;
    $m->AltBody = strip_tags(preg_replace('/<br\s*\/?>/i', "\n", $cuerpoHTML));
    $m->addStringAttachment($pdfData, $nombreAdjunto, 'base64', 'application/pdf');

    if (!$m->send()) {
        return ['ok' => false, 'msg' => $m->ErrorInfo ?: 'Fallo desconocido'];
    }
    return ['ok' => true, 'msg' => 'Enviado'];
}

// -------------------- Ejecución principal --------------------
$resultadosEnvio = [
    'total'           => 0,
    'enviados'        => 0,
    'errores'         => [],
    'resumen_enviado' => false,
];

switch (strtolower($tipo)) {
    case 'semanal': {
        // Semana como número
        $numeroSemana = (int)intval(str_replace('Semana ', '', (string)$semana));
        if ($numeroSemana <= 0) {
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

        // Empleados de la semana
        $stmt = $conection->prepare("SELECT * FROM historico_nomina WHERE semana = ? AND anio = ? ORDER BY noempleado");
        if (!$stmt) {
            echo json_encode(['error' => 'Error preparando consulta de nómina: ' . $conection->error], JSON_UNESCAPED_UNICODE);
            exit;
        }
        $stmt->bind_param("ii", $numeroSemana, $anio);
        $stmt->execute();
        $rs = $stmt->get_result();

        if (!$rs || $rs->num_rows === 0) {
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
            echo json_encode(['error' => 'Error preparando consulta de vueltas: ' . $conection->error], JSON_UNESCAPED_UNICODE);
            exit;
        }

        // Mailer una sola conexión SMTP
        $mailer = mailerBase();

        // PDF consolidado con TODOS los recibos
        $pdfAll = new PDF();

        while ($row = $rs->fetch_assoc()) {
            $resultadosEnvio['total']++;

            // Email del empleado
            $email = obtenerEmailEmpleado($conection, $row['noempleado']);
            if (!$email) {
                $resultadosEnvio['errores'][] = [
                    'noempleado' => $row['noempleado'],
                    'nombre'     => $row['nombre'],
                    'error'      => 'Sin email válido'
                ];
                continue;
            }

            // Vueltas del periodo -> lo convertimos en arreglo para reusar 2 veces
            // OJO: si en tu tabla registro_viajes el campo operador NO es el nombre,
            // cámbialo por el que corresponda (por ejemplo, noempleado).
            $stmtVueltas->bind_param("sss", $row['nombre'], $fechaIniDB, $fechaFinDB);
            $stmtVueltas->execute();
            $resV = $stmtVueltas->get_result();
            $vueltasRows = $resV ? $resV->fetch_all(MYSQLI_ASSOC) : [];

            // 1) Agregar al PDF CONSOLIDADO
            dibujarReciboEnPDF($pdfAll, $row, $vueltasRows, $numeroSemana, $periodo);

            // 2) Generar PDF individual y enviar al empleado
            $pdfData = pdfReciboSemanalComoString($row, $vueltasRows, $numeroSemana, $periodo);

            $asunto = "Recibo de Nómina - Semana {$numeroSemana} ({$periodo})";
            $cuerpo = "<p>Hola <strong>{$row['nombre']}</strong>,</p>
                       <p>Adjunto encontrarás tu recibo de nómina correspondiente a la <strong>Semana {$numeroSemana}</strong> ({$periodo}).</p>
                       <p>Saludos.</p>";

            $nombreAdj = "Recibo_Semana_{$numeroSemana}_{$row['noempleado']}.pdf";
            $r = enviarRecibo($mailer, $email, $row['nombre'], $pdfData, $nombreAdj, $asunto, $cuerpo);

            if ($r['ok']) {
                $resultadosEnvio['enviados']++;
            } else {
                $resultadosEnvio['errores'][] = [
                    'noempleado' => $row['noempleado'],
                    'nombre'     => $row['nombre'],
                    'error'      => $r['msg']
                ];
            }

            // Pausa breve para evitar límites de tasa SMTP si es necesario
            usleep(300000); // 300 ms
        }

        // Enviar PDF consolidado a RH/Contabilidad
        $pdfAllData = $pdfAll->Output('S');
        $asuntoAll  = "Paquete de Recibos - Semana {$numeroSemana} ({$periodo})";
        $cuerpoAll  = "<p>Se adjunta el <strong>paquete consolidado</strong> con todos los recibos de la Semana {$numeroSemana} ({$periodo}).</p>";
        $nombreAll  = "Recibos_Semana_{$numeroSemana}_Consolidado.pdf";

        $correoResumen = isset($_REQUEST['resumen_to']) && filter_var($_REQUEST['resumen_to'], FILTER_VALIDATE_EMAIL)
            ? $_REQUEST['resumen_to']
            : RESUMEN_TO;

        $rAll = enviarRecibo($mailer, (string)$correoResumen, 'Recursos Humanos', $pdfAllData, $nombreAll, $asuntoAll, $cuerpoAll);
        $resultadosEnvio['resumen_enviado'] = $rAll['ok'] ? true : ('ERROR: ' . $rAll['msg']);

        if (method_exists($mailer, 'smtpClose')) {
            $mailer->smtpClose();
        }

        echo json_encode($resultadosEnvio, JSON_UNESCAPED_UNICODE);
        break;
    }

    case 'quincenal': {
        echo json_encode(['error' => 'Pendiente: implementar envío quincenal análogo.'], JSON_UNESCAPED_UNICODE);
        break;
    }

    case 'especial': {
        echo json_encode(['error' => 'Pendiente: implementar envío especial análogo.'], JSON_UNESCAPED_UNICODE);
        break;
    }

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Tipo de recibo no válido.'], JSON_UNESCAPED_UNICODE);
}