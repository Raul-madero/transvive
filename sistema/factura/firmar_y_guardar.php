<?php
// factura/firmar_y_guardar.php
session_start();

// ==== 1) Decodificar firma ====
$firmaPath = null;
if (!empty($_POST['firma']) && preg_match('/^data:image\/(\w+);base64,/', $_POST['firma'], $m)) {
    $type = strtolower($m[1]);
    $data = substr($_POST['firma'], strpos($_POST['firma'], ',') + 1);
    $bin  = base64_decode($data);
    if ($bin !== false) {
        if (!in_array($type, ['png','jpg','jpeg'])) $type = 'png';
        $firmaPath = sys_get_temp_dir() . '/firma_' . uniqid() . '.' . $type;
        file_put_contents($firmaPath, $bin);
    }
}
if (!$firmaPath || !file_exists($firmaPath)) {
    http_response_code(400);
    exit('No se recibió firma válida.');
}

// ==== 2) Generar el PDF base con tu script FPDF (GUARDAR A DISCO) ====
// Importante: en tu script del contrato, cambia ->Output('I') por ->Output($rutaTmp, 'F')
$id = isset($_POST['id']) ? $_POST['id'] : '';
$rutaTmp = sys_get_temp_dir() . '/contrato_' . preg_replace('/[^a-z0-9_\-]/i','',$id) . '.pdf';

// Incluye tu script de contrato; debe respetar $rutaTmp y guardar ahí.
require __DIR__ . '/contrato_eventual_generar.php'; 
// ^^^ Crea este archivo a partir de tu código actual y al final usa:
// $pdf->Output($rutaTmp, 'F');  // en lugar de 'I'

// Validar que exista
if (!file_exists($rutaTmp)) {
    http_response_code(500);
    exit('No se pudo generar el PDF base.');
}

// ==== 3) Importar y ESTAMPAR la firma con FPDI =====
$LIBS = __DIR__ . '/../libs';
require_once $LIBS . '/TCPDF/tcpdf.php';
require_once $LIBS . '/FPDI/src/autoload.php';

use setasign\Fpdi\TcpdfFpdi;

$pdf = new TcpdfFpdi(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pageCount = $pdf->setSourceFile($rutaTmp);
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $tpl  = $pdf->importPage($pageNo);
    $size = $pdf->getTemplateSize($tpl);
    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
    $pdf->useTemplate($tpl);

    if ($pageNo === $pageCount) {
        // === Coordenadas del recuadro de firma del EMPLEADO ===
        // Tú usas márgenes: SetMargins(20, 2, 20) y Letter (ancho 216 mm)
        // En tu layout, los dos bloques de firma están lado a lado (85 mm c/u).
        // Vamos a colocar la firma del empleado dentro del cuadro derecho.
        $margenIzq = 20;
        $anchoUtil = 216 - 40; // 176 mm
        $colW      = 85;
        $gap       = ($anchoUtil - ($colW*2)); // separación entre columnas
        $xCol2     = $margenIzq + $colW + $gap; // inicio columna 2 (empleado)

        // Altura: toma una referencia vertical:
        // Si en tu script las líneas de firma están ~30 mm debajo del último párrafo,
        // usa un valor fijo desde el borde inferior. Ajusta si lo ves corrido.
        $yFirma = $size['height'] - 60;  // 60 mm desde el borde inferior
        $xFirma = $xCol2 + 10;           // 10 mm de margen interno
        $firmaW = 60;                    // ancho firma; alto proporcional

        $pdf->Image($firmaPath, $xFirma, $yFirma, $firmaW, 0, '', '', '', false, 300);
    }
}

// ==== 4) Guardar/entregar ====
$guardar = !empty($_POST['guardar']);
$destino = __DIR__ . '/uploads/contratos_firmados';
if ($guardar && !is_dir($destino)) { @mkdir($destino, 0775, true); }

$nombreArchivo = 'Contrato_Eventual_firmado_' . date('Ymd_His') . '.pdf';
$rutaFirmado   = $guardar ? ($destino . '/' . $nombreArchivo) : (sys_get_temp_dir() . '/' . $nombreArchivo);

$pdf->Output($rutaFirmado, 'F');

// Limpieza temporal
@unlink($firmaPath);

// Descargar/mostrar al usuario
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="'.$nombreArchivo.'"');
readfile($rutaFirmado);
exit;
