<?php
require('../fpdf/fpdf.php');
require('../../conexion.php');

class PDF extends FPDF {
    function Header(){
        $this->Image("../../images/transvive.png", 12, 11, 48, 13, "png", 0);
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(231, 233, 238);
        $this->SetTextColor(6, 22, 54);
        $this->Cell(50, 15, '', 1);
        $this->Cell(15, 15, utf8_decode('Título'), 1, 0, 'C', true);
        $this->Cell(75, 10, utf8_decode('REQUISICIÓN'), 1, 0, 'C');
        $this->Cell(19, 10, utf8_decode('Código'), 'T,R', 0, 'C', true);
        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 10, 'FO-TV-CO-01', 'T,R', 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(65, 10, '', 0);
        $this->Cell(15, 5, utf8_decode('Área'), 1, 0, 'C', true);
        $this->Cell(60, 5, utf8_decode('Compras'), 1, 0, 'C');
        $this->Cell(19, 5, '', 'B,R', 0, 'C');
        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 5, '', 'B,R', 0, 'C');
        $this->Ln(5);
    }

    function Footer(){
        $this->SetY(-10);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }

    function encabezadoTabla(){
        $this->SetFont('Arial', '', 8);
        $this->Cell(13, 5, 'Cantidad', 1, 0, 'C');
        $this->Cell(90, 5, utf8_decode('Descripción'), 1, 0, 'C');
        $this->Cell(46, 5, 'Marca', 1, 0, 'C');
        $this->Cell(20, 5, 'E', 1, 0, 'C');
        $this->Cell(20, 5, 'OM', 1, 1, 'C');
    }
}

// -------------------------------------------------------------------------------------
// INICIO DEL PDF
$noreq = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
if ($noreq <= 0) {
    die('ID de requisición inválido o no enviado.');
}
$conection->set_charset('utf8');

$query = mysqli_query($conection, "SELECT * FROM requisicion_compra WHERE no_requisicion = $noreq");
$entrada = mysqli_fetch_assoc($query);

if (!$entrada) {
    die('Requisición no encontrada.');
}

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('Arial', '', 8);

$newDate = date("d-m-Y", strtotime($entrada['fecha']));
$newDatereq = ($entrada['fecha_requiere'] > '2000-01-01') ? date("d-m-Y", strtotime($entrada['fecha_requiere'])) : '';

if ($entrada['estatus'] == 0) {
    $pdf->Image("img/anulado.png", 12, 74, 168, 123, "png", 0, 'C');
}

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

$queryr = mysqli_query($conection, "SELECT * FROM detalle_requisicioncompra WHERE folio = $noreq");
$resultr = mysqli_num_rows($queryr);

$pdf->encabezadoTabla();

while ($row = mysqli_fetch_assoc($queryr)) {
    $pdf->SetFont('Arial', '', 7);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $line_height = 5;

    $desc = utf8_decode($row['descripcion']);
    $desc_lines = $pdf->GetStringWidth($desc) > 90 ? 2 : 1;
    $cell_height = $line_height * $desc_lines;

    $pdf->Cell(13, $cell_height, number_format($row['cantidad'], 2), 1, 0, 'R');

    $pdf->SetXY($x + 13, $y);
    $pdf->MultiCell(90, $line_height, $desc, 1, 'L');
    $yAfterDesc = $pdf->GetY();
    $pdf->SetXY($x + 13 + 90, $y);

    $pdf->Cell(46, $cell_height, utf8_decode($row['marca']), 1, 0, 'L');
    $pdf->Cell(20, $cell_height, utf8_decode($row['dato_e']), 1, 0, 'C');
    $pdf->Cell(20, $cell_height, utf8_decode($row['dato_om']), 1, 1, 'C');

    // Si estamos por salir de la página, agrega nueva y encabezado tabla
    if ($pdf->GetY() > 240) {
        $pdf->AddPage();
        $pdf->encabezadoTabla();
    }

    $pdf->SetY(max($yAfterDesc, $pdf->GetY()));
}

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
$pdf->Cell(189, 5, 'Observaciones:', 1);
$pdf->MultiCell(189, 5, utf8_decode($entrada['observaciones']), 1, 'L');

if ($entrada['estatus'] == 0) {
    $pdf->Ln(5);
    $pdf->Cell(189, 5, 'Motivo Cancelación:', 1);
    $pdf->MultiCell(189, 5, utf8_decode($entrada['motivo_cancela']), 1, 'L');
}

if (!empty($entrada['firma_autoriza']) && $entrada['estatus'] != 0) {
    $pdf->Image("../../images/firmadig.png", 75, 230, 48, 23, "png", 0);
}

$pdf->Output();
?>
