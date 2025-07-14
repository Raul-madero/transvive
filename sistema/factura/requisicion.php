<?php
require('../fpdf/fpdf.php');
require('../../conexion.php');

class PDF extends FPDF {
    function Header(){
        $this->Image("../../images/transvive.png", 12, 11, 48, 13, "png", 0);
        $this->SetFont('Arial','',10);
        $this->Cell(50,15,'',1,0,'r');
        $this->SetFillColor(231,233,238);
        $this->SetTextColor(6,22,54);
        $this->Cell(15,15,'Título',1,0,'C','T');
        $this->Cell(75,10,'REQUISICIÓN',1,0,'C');
        $this->Cell(19,10,'Código','T,R',0,'C','T');
        $this->SetFont('Arial','',8);
        $this->Cell(30,10,'FO-TV-CO-01','T,R',1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(65,10,'',0,0,'R');
        $this->Cell(15,5,'Área',1,0,'C','T');
        $this->Cell(60,5,'Compras',1,0,'C');
        $this->Cell(19,5,'','B,R',0,'C','T');
        $this->SetFont('Arial','',8);
        $this->Cell(30,5,'','B,R',0,'C');
        $this->Ln(5);
    }

    function Footer(){
        $this->SetY(-10);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Página ' . $this->PageNo(),0,0,'C');
    }

    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if($nb > 0 && $s[$nb - 1] == "\n") $nb--;
        $sep = -1; $i = 0; $j = 0; $l = 0; $nl = 1;
        while($i < $nb) {
            $c = $s[$i];
            if($c == "\n") {$i++; $sep = -1; $j = $i; $l = 0; $nl++; continue;}
            if($c == ' ') $sep = $i;
            $l += $cw[$c];
            if($l > $wmax) {
                if($sep == -1) {$i == $j ? $i++ : 0;}
                else $i = $sep + 1;
                $sep = -1; $j = $i; $l = 0; $nl++;
            } else $i++;
        }
        return $nl;
    }
}

// ------- INICIO DOCUMENTO ---------
$noreq = intval($_REQUEST['id']);
$conection->set_charset('utf8');

$query = mysqli_query($conection, "SELECT * FROM requisicion_compra WHERE no_requisicion = $noreq");
$entrada = mysqli_fetch_assoc($query);

if (!$entrada) {
    die('Requisición no encontrada.');
}

$pdf = new PDF();
$pdf->AddPage('portrait','letter');

$newDate = date("d-m-Y", strtotime($entrada['fecha']));
$newDatereq = ($entrada['fecha_requiere'] > '2000-01-01') ? date("d-m-Y", strtotime($entrada['fecha_requiere'])) : '';

if ($entrada['estatus'] == 0) {
    $pdf->Image("img/anulado.png", 12, 74, 168, 123, "png", 0, 'C');
}

$pdf->SetFont('Arial','',8);
$pdf->Cell(144,5,'',0,0,'L');
$pdf->Cell(20,5,'Folio:',1,0,'L');
$pdf->Cell(25,5,'REQ-'.$entrada['no_requisicion'],1,1,'R');
$pdf->Cell(32,5,'Fecha de Solicitud:',1,0,'L');
$pdf->Cell(30,5,$newDate,1,0,'C');
$pdf->Cell(52,5,'Fecha en que se requiere el material:',1,0,'L');
$pdf->Cell(30,5,$newDatereq,1,0,'C');
$pdf->Cell(20,5,'Tipo:',1,0,'L');
$pdf->Cell(25,5,$entrada['tipo_requisicion'],1,1,'C');
$pdf->Cell(32,5,'Area Solicitante:',1,0,'L');
$pdf->Cell(157,5,$entrada['area_solicitante'],1,1,'C');
$pdf->Ln(5);

$queryr = mysqli_query($conection,"SELECT * FROM detalle_requisicioncompra WHERE folio = $noreq");
$resultr = mysqli_num_rows($queryr);

$pdf->SetFont('Arial','',8);
$pdf->Cell(13,5,'Cantidad',1,0,'C','T');
$pdf->Cell(90,5,'Descripcion',1,0,'C','T');
$pdf->Cell(46,5,'Marca',1,0,'C','T');
$pdf->Cell(20,5,'E',1,0,'C','T');
$pdf->Cell(20,5,'OM',1,1,'C','T');

while ($row = mysqli_fetch_assoc($queryr)) {
    $pdf->SetFont('Arial','',6.8);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $w_cant = 13; $w_desc = 90; $w_marca = 46; $w_datoe = 20; $w_datoom = 20; $line_height = 5;
    $desc = $row['descripcion'];
    $desc_lines = min(3, $pdf->NbLines($w_desc, $desc));
    $cell_height = $line_height * $desc_lines;
    $pdf->Cell($w_cant, $cell_height, number_format($row['cantidad'],2), 1, 0, 'R');
    $pdf->SetXY($x + $w_cant, $y);
    $pdf->MultiCell($w_desc, $line_height, $desc, 1, 'L');
    $pdf->SetXY($x + $w_cant + $w_desc, $y);
    $pdf->Cell($w_marca, $cell_height, $row['marca'], 1, 0, 'L');
    $pdf->Cell($w_datoe, $cell_height, $row['dato_e'], 1, 0, 'C');
    $pdf->Cell($w_datoom, $cell_height, $row['dato_om'], 1, 1, 'C');
}

for ($i = 0; $i < max(0, 32 - $resultr); $i++) {
    $pdf->SetFont('Arial','',6.8);
    $pdf->Cell(13,5,'',1,0,'R');
    $pdf->Cell(90,5,'',1,0,'L');
    $pdf->Cell(46,5,'',1,0,'L');
    $pdf->Cell(20,5,'',1,0,'C');
    $pdf->Cell(20,5,'',1,1,'C');
}

$pdf->Ln(10);
$pdf->SetFont('Arial','',7);
$pdf->Cell(103,5,'',0,0,'L');
$pdf->Cell(46,5,'Monto Aprox. Autorizado:',1,0,'L');
$pdf->Cell(20,5,number_format($entrada['cant_autorizada'],2),1,0,'R');
$pdf->Cell(20,5,'',1,1,'L');
$pdf->Cell(189,5,'Observaciones:',1,1,'L');
$pdf->Multicell(189,5,$entrada['observaciones'],1,'L');

if ($entrada['estatus'] == 0){
    $pdf->Ln(5);
    $pdf->Cell(189,5,'Motivo Cancelación:',1,1,'L');
    $pdf->Multicell(189,5,$entrada['motivo_cancela'],1,'L');
}

if (!empty($entrada['firma_autoriza']) && $entrada['estatus'] != 0){
    $pdf->Image("../../images/firmadig.png",75,230,48,23,"png",0,'C');
}

$pdf->Output();
