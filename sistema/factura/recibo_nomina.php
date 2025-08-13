<?php
require('../fpdf/fpdf.php');
require('../includes/conversor.php');
require('../../conexion.php');
require('../PHPMailer/PHPMailerAutoload.php');

set_time_limit(0);
ini_set('max_execution_time', 0);

header("Content-Type: text/html; charset=utf-8");

// Clase PDF
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

$conection->set_charset('utf8');

$tipo = $_REQUEST['tipo'] ?? 'Semanal';
$semana = $_REQUEST['id2'] ?? '';
$anio = $_REQUEST['id3'] ?? '';
$id = $_REQUEST['id'] ?? '';

// Validaciones iniciales
if (empty($tipo) || empty($anio)) {
    die("Faltan parámetros requeridos");
}

// Configuracion de PHPMAiler
const SMTP_HOST = 'smtp.office365.com';
const SMTP_PORT = 587;
const SMTP_USER = 'auxiliar.rh@transvivegdl.com.mx';
const SMTP_PASSWORD = 'ZkKHfzKheT';
const SMTP_FROM = 'auxiliar.rh@transvivegdl.com.mx';
const SMTP_NAME = 'Nomina Transvive';

function mailerBase() {
    $mail = new PHPMailer();          // v5.x
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;    // smtp.office365.com
    $mail->Port       = SMTP_PORT;    // 587
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'STARTTLS';
    $mail->SMTPAutoTLS = true;
    $mail->AuthType    = 'LOGIN';  
    $mail->Username   = SMTP_USER;    // = FROM en O365
    $mail->Password   = SMTP_PASSWORD;

    // Office 365 suele requerir que From == Username (o alias permitido)
    $mail->setFrom(SMTP_FROM, SMTP_NAME);
    $mail->addReplyTo(SMTP_FROM, SMTP_NAME);

    // TLS 1.2 + performance
    $mail->CharSet       = 'UTF-8';
    $mail->Timeout       = 20;        // seg. por intento
    $mail->SMTPKeepAlive = true;      // 1 sola conexión para todos
    // $mail->SMTPOptions   = array('ssl' => array(
    //     'crypto_method' =>
    //         STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT |
    //         STREAM_CRYPTO_METHOD_TLS_CLIENT
    // ));

    // DEBUG (solo mientras pruebes)
    $mail->SMTPDebug = 3;
    $mail->Debugoutput = function($str,$level){ error_log("SMTP[$level] $str"); };

    return $mail;
}

// **
//  * Genera el PDF de un empleado y lo devuelve como string binario.
//  * $row = fila de historico_nomina del empleado.
//  * $vueltas = resultado de SELECT de vueltas del periodo (mysqli_result).
//  * $numeroSemana, $periodo = textos para el encabezado.
//  */
function pdfReciboSemanalComoString(array $row, mysqli_result $vueltas, int $numeroSemana, string $periodo): string {
    $pdf = new class extends FPDF {
        function Header() {
            $this->Image("../../images/transvive.png", 12, 11, 48, 13, "png", 0);
            $this->SetFont('Arial','',10);
            $this->SetFillColor(231,233,238);
            $this->SetTextColor(6,22,54);
        }
        function Footer() {
            $this->SetY(-10);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');
        }
    };

    $pdf->AddPage('P','Letter');

    // -------- Portada / totales ----------
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
    $pdf->Cell(60,5,'Vueltas Totales: ' . number_format($row['total_vueltas'], 2),0,0);
    $pdf->Cell(60,5,'Deduccion por Adeudo: $' . number_format($row['deducciones'], 2),0,1);

    $pdf->Cell(60,5,'Pago Total Vueltas: $' . number_format($row['sueldo_bruto'], 2),0,0);
    $pdf->Cell(60,5,'Caja Ahorro: $' . number_format($row['caja_ahorro'], 2),0,1);

    $pdf->Cell(60,5,'Sueldo Adicional: $' . number_format($row['sueldo_adicional'], 2),0,0);
    $pdf->Cell(60,5,'Deduccion Fiscal: $' . number_format($row['deduccion_fiscal'], 2),0,1);

    $pdf->Cell(60,5,'Bono Semanal: $' . number_format($row['bono_categoria'], 2),0,1);
    $pdf->Cell(60,5,'Bono Supervisor: $' . number_format($row['bono_supervisor'], 2),0,1);
    $pdf->Cell(60,5,'Bono Alertas: $' . number_format($row['bono_semanal'], 2),0,1);
    $pdf->Cell(60,5,'Vales de Despensa: $' . number_format($row['apoyo_mes'], 2),0,1);
    $pdf->Cell(60,5,'Dias de Vacaciones: ' . number_format($row['dias_vacaciones'], 2),0,1);
    $pdf->Cell(60,5,'Pago Vacaciones: $' . number_format($row['pago_vacaciones'], 2),0,1);
    $pdf->Cell(60,5,'Prima Vacacional: $' . number_format($row['prima_vacacional'], 2),0,1);

    $percepciones = $row['sueldo_bruto'] + $row['sueldo_adicional'] + $row['bono_categoria'] + $row['bono_supervisor'] + $row['bono_semanal'] + $row['apoyo_mes'] + $row['prima_vacacional'] + $row['pago_vacaciones'];
    $deducciones  = $row['deducciones'] + $row['caja_ahorro'] + $row['deduccion_fiscal'];
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
    $pdf->Cell(60,5,utf8_decode('Depósito Fiscal: $' . number_format($row['deposito_fiscal'], 2)),0,0,'L');
    $pdf->Cell(60,5,'Depósito Efectivo: $' . number_format($neto - $row['deposito_fiscal'], 2),0,1,'R');

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
    if ($vueltas->num_rows > 0) {
        while ($v = $vueltas->fetch_assoc()) {
            $pdf->Cell(60,6,utf8_decode($v['cliente']),1);
            $pdf->Cell(60,6,utf8_decode($v['ruta']),1);
            $pdf->Cell(30,6,utf8_decode($v['unidad_ejecuta']),1);
            $pdf->Cell(30,6, ((float)$v['valor_vuelta'] == 1.00 ? 'Completa' : 'Media'),1,1,'R');
        }
    } else {
        $pdf->Cell(180,6,utf8_decode('No se registraron vueltas en este periodo.'),1,1,'C');
    }

    // Devuelve el PDF como string (adjunto)
    return $pdf->Output('S'); // S = return the document as a string
}

/** Obtiene email del empleado por noempleado (ajusta nombres de tabla/campo si difieren) */
function obtenerEmailEmpleado(mysqli $db, $noempleado): ?string {
    // $sql = "SELECT COALESCE(correo) AS email FROM empleados WHERE noempleado = ? LIMIT 1";
    // if ($st = $db->prepare($sql)) {
    //     $st->bind_param('i', $noempleado);
    //     $st->execute();
    //     $res = $st->get_result();
    //     if ($res && $fila = $res->fetch_assoc()) {
    //         // $email = trim((string)$fila['email']);
    //         $email = 'r.madero.ramirez@gmail.com';
    //         return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
    //     }
    // }
    // return null;
    return 'rh@transvivegdl.com.mx';
}

/** Envía el correo con el PDF adjunto */
function enviarRecibo(PHPMailer $m, string $emailDestino, string $nombreEmpleado, string $pdfData, string $nombreAdjunto, string $asunto, string $cuerpoHTML): array {
    $m->clearAddresses();
    $m->clearAttachments();

    $m->addAddress($emailDestino, $nombreEmpleado);
    $m->Subject = $asunto;
    $m->isHTML(true);
    $m->Body = $cuerpoHTML;
    $m->AltBody = strip_tags(str_replace('<br>', "\n", $cuerpoHTML));
    $m->addStringAttachment($pdfData, $nombreAdjunto, 'base64', 'application/pdf');

    if (!$m->send()) {
        return ['ok' => false, 'msg' => $m->ErrorInfo ?: 'Fallo desconocido'];
    }
    return ['ok' => true, 'msg' => 'Enviado'];
}

// ------------------ Flujo principal ------------------
$resultadosEnvio = ['total' => 0, 'enviados' => 0, 'errores' => []];

switch (strtolower($tipo)) {
    case 'semanal': {
        // Semana en número
        $numeroSemana = (int)intval(str_replace('Semana ', '', (string)$semana));
        if ($numeroSemana <= 0) exit('Semana inválida.');

        // Periodo (Lunes a Domingo)
        $fi = new DateTime();
        $fi->setISODate($anio, $numeroSemana, 1);
        $ff = new DateTime();
        $ff->setISODate($anio, $numeroSemana, 7);
        $periodo    = 'Del: ' . $fi->format('d/m/Y') . ' al: ' . $ff->format('d/m/Y');
        $fechaIniDB = $fi->format('Y-m-d');
        $fechaFinDB = $ff->format('Y-m-d');

        // Empleados de la semana
        $stmt = $conection->prepare("SELECT * FROM historico_nomina WHERE semana = ? AND anio = ? ORDER BY noempleado LIMIT 1");
        $stmt->bind_param("ii", $numeroSemana, $anio);
        $stmt->execute();
        $rs = $stmt->get_result();

        if (!$rs || $rs->num_rows === 0) {
            exit('No hay datos para la semana seleccionada.');
        }

        // Preparar consulta de vueltas
        $sqlVueltas = "SELECT cliente, ruta, valor_vuelta, unidad_ejecuta
                       FROM registro_viajes
                       WHERE operador = ? AND fecha BETWEEN ? AND ? AND valor_vuelta > 0
                       ORDER BY fecha ASC";
        $stmtVueltas = $conection->prepare($sqlVueltas);

        $mailer = mailerBase();

        while ($row = $rs->fetch_assoc()) {
            $resultadosEnvio['total']++;

            // Buscar email del empleado
            $email = obtenerEmailEmpleado($conection, $row['noempleado']);
            if (!$email) {
                $resultadosEnvio['errores'][] = [
                    'noempleado' => $row['noempleado'],
                    'nombre'     => $row['nombre'],
                    'error'      => 'Sin email válido'
                ];
                continue;
            }

            // Vueltas del periodo para ese empleado (usa nombre exacto de tu campo en registro_viajes)
            $stmtVueltas->bind_param("sss", $row['nombre'], $fechaIniDB, $fechaFinDB);
            $stmtVueltas->execute();
            $vueltas = $stmtVueltas->get_result();

            // Generar PDF (string)
            $pdfData = pdfReciboSemanalComoString($row, $vueltas, $numeroSemana, $periodo);

            // Enviar
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

            // Evita rate-limit del servidor SMTP si hace falta
            usleep(1000000); // 1000ms (ajusta según necesidad)
        }

        if (method_exists($mailer, 'smtpClose')) {
            $mailer->smtpClose();
        }
        
        echo json_encode($resultadosEnvio, JSON_UNESCAPED_UNICODE);
        break;
    }

    case 'quincenal': {
        // Implementa lógica similar: obtener empleados de la quincena,
        // generar PDF por empleado y enviar (puedes reusar pdfReciboSemanalComoString creando otra función para el formato quincenal).
        exit('Pendiente: implementar envío quincenal análogo.');
    }

    case 'especial': {
        // Implementa lógica similar para especiales (aguinaldo, etc.)
        exit('Pendiente: implementar envío especial análogo.');
    }

    default:
        http_response_code(400);
        exit('Tipo de recibo no válido.');
}