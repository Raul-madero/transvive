<?php
require_once __DIR__ . '/../fpdf/fpdf.php';
require_once __DIR__ . '/../../conexion.php';

// Habilitar excepciones en mysqli y establecer charset
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conection->set_charset('utf8');

class PDF extends FPDF {
    function Header() {
        // Logo
        $logo = __DIR__ . '/../../images/transvive.png';
        if (file_exists($logo)) {
            $this->Image($logo, 12, 11, 48, 13, 'PNG');
        }

        // Títulos
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(231, 233, 238);
        $this->SetTextColor(6, 22, 54);

        $this->Cell(50, 15, '', 1);
        $this->Cell(15, 15, utf8_decode('Título'), 1, 0, 'C', true);
        $this->Cell(75, 10, utf8_decode('REQUISICIÓN'), 1, 0, 'C');
        $this->Cell(19, 10, utf8_decode('Código'), 'TR', 0, 'C', true);

        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 10, 'FO-TV-CO-01', 'TR', 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->Cell(65, 10, '', 0);
        $this->Cell(15, 5, utf8_decode('Área'), 1, 0, 'C', true);
        $this->Cell(60, 5, utf8_decode('Compras'), 1, 0, 'C');
        $this->Cell(19, 5, '', 'BR', 0, 'C');
        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 5, '', 'BR', 0, 'C');
        $this->Ln(5);
    }

    function Footer() {
        // Alias para el total de páginas
        $this->AliasNbPages();
        $this->SetY(-10);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Función para (re)imprimir encabezados de tabla
function imprimirEncabezados(PDF $pdf) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(13, 5, 'Cantidad', 1, 0, 'C');
    $pdf->Cell(90, 5, utf8_decode('Descripción'), 1, 0, 'C');
    $pdf->Cell(46, 5, 'Marca', 1, 0, 'C');
    $pdf->Cell(20, 5, 'E', 1, 0, 'C');
    $pdf->Cell(20, 5, 'OM', 1, 1, 'C');
}

// Validar y obtener ID de requisición
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die('ID de requisición inválido.');
}

// Obtener datos de la requisición
$sql = "SELECT * FROM requisicion_compra WHERE no_requisicion = ?";
$stmt = $conection->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$entrada = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$entrada) {
    die('Requisición no encontrada.');
}

// Inicializar PDF
$pdf = new PDF('P', 'mm');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('Arial', '', 8);

// Formatear fechas
$newDate    = date("d-m-Y", strtotime($entrada['fecha']));
$newDatereq = ($entrada['fecha_requiere'] > '2000-01-01')
                ? date("d-m-Y", strtotime($entrada['fecha_requiere']))
                : '';

// Marca de “Anulado” si aplica
if ($entrada['estatus'] == 0) {
    $anulado = __DIR__ . '/../../images/anulado.png';
    if (file_exists($anulado)) {
        $pdf->Image($anulado, 12, 74, 168, 123, 'PNG');
    }
}

// Encabezado de datos principales
$pdf->Cell(144, 5, '', 0);
$pdf->Cell(20, 5, 'Folio:', 1);
$pdf->Cell(25, 5, 'REQ-' . $entrada['no_requisicion'], 1, 1, 'R');

$pdf->Cell(32, 5, utf8_decode('Fecha de Solicitud:'), 1);
$pdf->Cell(30, 5, $newDate, 1, 0, 'C');
$pdf->Cell(52, 5, utf8_decode('Fecha en que se requiere el material:'), 1);
$pdf->Cell(30, 5, $newDatereq, 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('Tipo:'), 1);
$pdf->Cell(25, 5, utf8_decode($entrada['tipo_requisicion']), 1, 1, 'C');

$pdf->Cell(32, 5, utf8_decode('Área Solicitante:'), 1);
$pdf->Cell(157, 5, utf8_decode($entrada['area_solicitante']), 1, 1, 'C');
$pdf->Ln(5);

// Detalle de la requisición
$sqlDet = "SELECT * FROM detalle_requisicioncompra WHERE folio = ?";
$stmtDet = $conection->prepare($sqlDet);
$stmtDet->bind_param('i', $id);
$stmtDet->execute();
$resultDet = $stmtDet->get_result();
$resultr   = $resultDet->num_rows;

// Imprimir la primera cabecera de detalle
imprimirEncabezados($pdf);

$line_height = 5;
$maxWidth    = 90;

while ($row = $resultDet->fetch_assoc()) {
    $pdf->SetFont('Arial', '', 7);

    // Calcular altura de la fila
    $desc     = utf8_decode($row['descripcion']);
    $strWidth = $pdf->GetStringWidth($desc);
    $lines    = max(1, ceil($strWidth / $maxWidth));
    $cell_h   = $line_height * $lines;

    // Verificar si cabe en la página, si no, agregar página y reimprimir encabezados
    if ($pdf->GetY() + $cell_h > $pdf->GetPageHeight()) {
        $pdf->AddPage();
        imprimirEncabezados($pdf);
    }

    // Guardar posición
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    // Celda Cantidad
    $pdf->Cell(13, $cell_h, number_format($row['cantidad'], 2), 1, 0, 'R');

    // MultiCell Descripción
    $pdf->SetXY($x + 13, $y);
    $pdf->MultiCell($maxWidth, $line_height, $desc, 1);

    // Celdas Marca, E y OM
    $pdf->SetXY($x + 13 + $maxWidth, $y);
    $pdf->Cell(46, $cell_h, utf8_decode($row['marca']), 1, 0, 'L');
    $pdf->Cell(20, $cell_h, utf8_decode($row['dato_e']), 1, 0, 'C');
    $pdf->Cell(20, $cell_h, utf8_decode($row['dato_om']), 1, 1, 'C');
}

$stmtDet->close();

// Filas vacías hasta 32
for ($i = 0; $i < max(0, 32 - $resultr); $i++) {
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(13, 5, '', 1);
    $pdf->Cell(90, 5, '', 1);
    $pdf->Cell(46, 5, '', 1);
    $pdf->Cell(20, 5, '', 1);
    $pdf->Cell(20, 5, '', 1);
    $pdf->Ln();
}

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(103, 5, '', 0);
$pdf->Cell(46, 5, utf8_decode('Monto Aprox. Autorizado:'), 1);
$pdf->Cell(20, 5, number_format($entrada['cant_autorizada'], 2), 1, 0, 'R');
$pdf->Cell(20, 5, '', 1);
$pdf->Ln();

// Observaciones
$pdf->Cell(20, 5, utf8_decode('Observaciones:'), 1);
$pdf->MultiCell(189, 5, utf8_decode($entrada['observaciones']), 1);

// Motivo de cancelación si aplica
if ($entrada['estatus'] == 0) {
    $pdf->Ln(5);
    $pdf->Cell(189, 5, utf8_decode('Motivo Cancelación:'), 1);
    $pdf->MultiCell(189, 5, utf8_decode($entrada['motivo_cancela']), 1);
}

// Firma digital si aplica
if (!empty($entrada['firma_autoriza']) && $entrada['estatus'] != 0) {
    $firma = __DIR__ . '/../../images/firmadig.png';
    if (file_exists($firma)) {
        $pdf->Image($firma, 75, 230, 48, 23, 'PNG');
    }
}

$pdf->Output();
