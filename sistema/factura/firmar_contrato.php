<?php
require __DIR__.'/vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;   // FPDI puente para TCPDF

$rutaPdf = $rutaTmp; // el PDF que generaste con FPDF
$rutaPdfFirmado = sys_get_temp_dir() . '/contrato_eventual_firmado.pdf';

// Rutas a tu cert/clave en PEM
$cert = __DIR__ . '/cert.pem';
$key  = __DIR__ . '/key_encrypted.pem';
$keyPass = getenv('PDF_KEY_PASS'); // define esta var de entorno

class PDFSigner extends FPDI {}

$pdf = new PDFSigner(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Importar páginas del PDF original
$pageCount = $pdf->setSourceFile($rutaPdf);
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $tpl = $pdf->importPage($pageNo);
    $size = $pdf->getTemplateSize($tpl);
    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
    $pdf->useTemplate($tpl);

    // En la última página, coloca el recuadro visible de la firma (opcional, solo apariencia)
    if ($pageNo === $pageCount) {
        // Rectángulo/etiqueta “Firma electrónica”
        $pdf->SetFont('helvetica', '', 9);
        $x = 20; $y = $size['height'] - 60; $w = 80; $h = 25; // ajusta coordenadas
        $pdf->Rect($x, $y, $w, $h);
        $pdf->Text($x+2, $y+2, 'Firma electrónica avanzada');
        // Apariencia visible donde quedará la firma
        $pdf->addEmptySignatureAppearance($x, $y, $w, $h);
    }
}

// Información de la firma (se incrusta en el PDF)
$info = [
  'Name'        => 'TRANSVIVE, S. de R.L. de C.V.',
  'Location'    => 'Tlajomulco de Zúñiga, Jalisco',
  'Reason'      => 'Firma de contrato individual de trabajo',
  'ContactInfo' => 'compras@transvivegdl.com.mx'
];

// Cargar cert/clave y firmar
$pdf->setSignature($cert, $key, $keyPass, '', 2, $info);

// (Opcional) inserta una imagen/logo en el recuadro de firma visible
$pdf->Image(__DIR__.'/firma-sello.png', 22, $size['height'] - 58, 15, 0, '', '', '', false, 300);

// Guardar firmado
$pdf->Output($rutaPdfFirmado, 'F');

// Entregar al navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="Contrato Eventual (firmado).pdf"');
readfile($rutaPdfFirmado);
