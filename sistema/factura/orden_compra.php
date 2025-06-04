<?php

require_once('../fpdf/fpdf.php');
require_once('../../conexion.php');

header("Content-Type: text/html; charset=utf-8");

class PDF extends FPDF
{
    private $con;
    private $id;

    public function __construct($id, $con)
    {
        parent::__construct();
        $this->id = $id;
        $this->con = $con;
    }

    function Header()
    {
        $id = intval($this->id);
        $this->con->set_charset('utf8');

        $query = $this->con->prepare("SELECT oc.*, pv.nombre FROM orden_compra oc INNER JOIN proveedores pv ON oc.proveedor = pv.id WHERE oc.no_orden = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $entrada = $query->get_result()->fetch_assoc();

        $subtitulo1 = 'ORDEN DE COMPRA';

        $this->Image("../../images/fondo001.png", 10, 10, 78, 93, "png");
        $this->Image("../../images/fondo002.png", 171, 216.5, 28, 53, "png");
        $this->Image("../../images/transvive_logo.png", 12, 11, 48, 13, "png");
        $this->Image("../../images/fondo01.png", 36, 110, 148, 63, "png");

        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 15, '', 1);
        $this->SetFillColor(231, 233, 238);
        $this->SetTextColor(6, 22, 54);
        $this->Cell(15, 15, mb_convert_encoding('Título', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(75, 10, $subtitulo1, 1, 0, 'C');
        $this->Cell(19, 10, mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'), 'T,R', 0, 'C', true);
        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 10, 'FO-TV-CO-02', 'T,R', 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(65, 10, '', 0);
        $this->Cell(15, 5, mb_convert_encoding('Área', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(60, 5, 'Compras', 1, 0, 'C');
        $this->Cell(19, 5, '', 'B,R', 0, 'C', true);
        $this->SetFont('Arial', '', 8);
        $this->Cell(30, 5, '', 'B,R', 0, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $id = intval($this->id);

        $query = $this->con->prepare("SELECT oc.*, rq.fecha as datereq, pv.nombre FROM orden_compra oc INNER JOIN proveedores pv ON oc.proveedor = pv.id INNER JOIN requisicion_compra rq ON oc.no_requisicion = rq.no_requisicion WHERE oc.no_orden = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $entrada = $query->get_result()->fetch_assoc();

        $newDateReq = date("d-m-Y", strtotime($entrada['datereq']));

        $this->SetY(-25);
        $this->SetTextColor(0);
        $this->SetFont('Arial', 'I', 8);

        if ($entrada['estatus'] == 0) {
            $this->SetFont('Arial', '', 7);
            $this->Cell(189, 5, mb_convert_encoding('Motivo cancelación:', 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', true);
            $this->SetFillColor(255);
            $this->Cell(189, 5, mb_convert_encoding($entrada['motivo_cancela'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L');
        } else {
            $this->SetFont('Arial', '', 7);
            $this->Cell(189, 5, mb_convert_encoding('Observaciones:', 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', true);
            $this->SetFillColor(255);
            $this->Cell(189, 5, mb_convert_encoding($entrada['observaciones'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L');
        }

        $this->SetFillColor(231, 233, 238);
        $this->Cell(25, 5, mb_convert_encoding('Área Solicitante:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', true);
        $this->Cell(40, 5, mb_convert_encoding($entrada['area_solicitante'], 'ISO-8859-1', 'UTF-8'), 1);
        $this->Cell(15, 5, 'Fecha:', 1, 0, 'L', true);
        $this->Cell(19, 5, $newDateReq, 1, 0, 'C');
        $this->Cell(15, 5, 'Recibe:', 1, 0, 'L', true);
        $this->Cell(75, 5, mb_convert_encoding($entrada['recibe'], 'ISO-8859-1', 'UTF-8'), 1);
    }
}

$nooc = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
if (!$nooc) {
    die("ID de orden no válido");
}

$pdf = new PDF($nooc, $conection);
$pdf->AddPage('portrait', 'letter');

$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.proveedor, oc.contacto, oc.telefono, oc.correo, oc.forma_pago, oc.metodo_pago, oc.uso_cfdi, oc.area_solicitante, oc.observaciones, pv.nombre, oc.recibe, rq.fecha as datereq, oc.estatus FROM orden_compra oc INNER JOIN proveedores pv ON oc.proveedor = pv.id INNER JOIN requisicion_compra rq ON oc.no_requisicion = rq.no_requisicion WHERE oc.no_requisicion = $nooc");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//Variables para encabezado
$id         = $entrada['id'];
$folio      = $entrada['no_orden'];
$fecha      = $entrada['fecha'];
$id_prov    = $entrada['proveedor'];
$contacto   = $entrada['contacto'];
$telefono   = $entrada['telefono'];
$correo     = $entrada['correo'];
$formapago  = $entrada['forma_pago'];
$metodopago = $entrada['metodo_pago'];
$usocfdi    = $entrada['uso_cfdi'];
$solicita   = $entrada['area_solicitante'];
$notas      = $entrada['observaciones'];
$proveedor  = $entrada['nombre'];
$recibe     = $entrada['recibe'];

//  $imagen="../img/routers/".$entrada['foto'];

$newDate = date("d-m-Y", strtotime($entrada['fecha'])); 

$pdf->Ln(5);

$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);

if ($entrada['estatus'] == 0) {
    $pdf->Image("img/anulado.png",12,74,168,123,"png",0);
}

$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(25,5,'Proveedor',1,0,'L', 'T');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(119,5,mb_convert_encoding($proveedor, 'ISO-8859-1', 'UTF-8'),1,0,'L');
$pdf->Cell(20,5,'No. Orden:',1,0,'L', 'T');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,5,'OC-'. $folio,1,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(25,5,'Contacto:',1,0,'L', 'T');
$pdf->Cell(119,5,mb_convert_encoding($contacto, 'ISO-8859-1', 'UTF-8'),1,0,'L');
$pdf->Cell(20,5,'Fecha:',1,0,'L', 'T');
$pdf->Cell(25,5,$newDate,1,1,'C');
$pdf->Cell(25,5,mb_convert_encoding('Teléfono:', 'ISO-8859-1', 'UTF-8'),1,0,'L', 'T');
$pdf->Cell(55,5,$telefono,1,0,'L');
$pdf->Cell(30,5,'Correo:',1,0,'L', 'T');
$pdf->Cell(79,5,mb_convert_encoding($correo, 'ISO-8859-1', 'UTF-8'),1,1,'C');
$pdf->Cell(50,5,mb_convert_encoding('Datos de Facturación:', 'ISO-8859-1', 'UTF-8'),1,0,'C', 'T');
$pdf->Cell(30,5,'Forma de Pago:',1,0,'L', 'T');
$pdf->Cell(64,5,mb_convert_encoding($formapago, 'ISO-8859-1', 'UTF-8'),1,0,'L');
$pdf->Cell(45,5,'Datos de Entrega:',1,1,'C', 'T');
$pdf->Cell(50,5,'Transvive S. de R.L. de C.V.',1,0,'C');
$pdf->Cell(30,5,'Metodo de Pago:',1,0,'L', 'T');
$pdf->Cell(64,5,mb_convert_encoding($metodopago, 'ISO-8859-1', 'UTF-8'),1,0,'L');
$pdf->Cell(45,5,'Hidalgo No. 30',1,1,'C');
$pdf->Cell(50,5,'TVI-190503-SA3',1,0,'C');
$pdf->Cell(30,5,'Uso de CFDI:',1,0,'L', 'T');
$pdf->Cell(64,5,mb_convert_encoding($usocfdi, 'ISO-8859-1', 'UTF-8'),1,0,'L');
$pdf->Cell(45,5,'C.P. 45640 Col. Los Gavilanes',1,1,'C');
$pdf->Cell(144,5,'',1,0,'C');
$pdf->Cell(45,5,mb_convert_encoding('Tlajomulco de Zuñiga, Jal.', 'ISO-8859-1', 'UTF-8'),1,1,'C');

$pdf->Ln(5);

$nooc = $_REQUEST['id'];

$queryr = mysqli_query($conection,"SELECT * FROM detalle_ordencompra WHERE folio = $folio");
$resultr = mysqli_num_rows($queryr);

$pdf->SetFont('Arial','',8);
$pdf->Cell(13,5,'Cantidad',1,0,'C','T');
$pdf->Cell(38,5,mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'),1,0,'C','T');
$pdf->Cell(85,5,mb_convert_encoding('Descripcion', 'ISO-8859-1', 'UTF-8'),1,0,'C','T');
$pdf->Cell(23,5,mb_convert_encoding('Marca', 'ISO-8859-1', 'UTF-8'),1,0,'C','T');
$pdf->Cell(15,5,'Precio',1,0,'C','T');
$pdf->Cell(15,5,'Importe',1,1,'C','T');

$subtotal    = 0;
$totsubtotal = 0;
$impuestos   = 0;
$totiva      = 0;
$totalisr    = 0;
$totalieps   = 0;
$total       = 0;

if ($resultr >= 33) {
    $filas = $resultr;
}else {
    $filas = 33 - $resultr;
}

for ($i = 1; $i < $filas; $i++) {
    while ($row = mysqli_fetch_assoc($queryr)){
        $subtotal = ($row['cantidad']) * $row['precio']; 
        $totsubtotal = $totsubtotal + $subtotal;
        $impuesto = (($row['cantidad'] * $row['precio']) * $row['impuesto'])/100;   
        $isr      = (($row['cantidad'] * $row['precio']) * ($row['impuesto_isr'] /100));
        $totiva = $totiva + $impuesto;
        $totalisr = $totalisr + $isr;
        $ieps     = $row['cantidad'] * $row['impuesto_ieps'];
        $totalieps = $totalieps + $ieps;

        $pdf->SetFont('Arial','',6.8);

        // Prepara los textos
        $descripcion = $row['descripcion'];
        $marca = $row['marca'];

        // Configura anchos y altura base
        $height_line = 5;
        $widths = [
            'cantidad' => 13,
            'codigo' => 38,
            'descripcion' => 85,
            'marca' => 23,
            'precio' => 15,
            'importe' => 15
        ];

        // Calcular número de líneas que ocuparán descripción y marca
        $nb_lines_desc = $pdf->GetStringWidth($descripcion) / $widths['descripcion'];
        $nb_lines_marca = $pdf->GetStringWidth($marca) / $widths['marca'];

        // Obtener número máximo de líneas necesarias
        $max_lines = ceil(max($nb_lines_desc, $nb_lines_marca));
        $line_height = max($height_line * $max_lines, $height_line);

        // Guardar posición actual
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        // Cantidad
        $pdf->Cell($widths['cantidad'], $line_height, number_format($row['cantidad'],2), 1, 0, 'R');
        // Código
        $pdf->Cell($widths['codigo'], $line_height, $row['codigo'], 1, 0, 'L');

        // Descripción
        $pdf->SetXY($x + $widths['cantidad'] + $widths['codigo'], $y);
        $pdf->MultiCell($widths['descripcion'], $height_line, $descripcion, 1, 'L');

        // Marca (necesitamos nueva posición porque MultiCell bajó el cursor)
        $x2 = $x + $widths['cantidad'] + $widths['codigo'] + $widths['descripcion'];
        $pdf->SetXY($x2, $y);
        $pdf->MultiCell($widths['marca'], $height_line, $marca, 1, 'L');

        // Después de marca, posicionamos para imprimir Precio e Importe
        // Nos movemos al punto más a la derecha (después de marca), misma línea
        $max_x = $x + array_sum($widths) - $widths['precio'] - $widths['importe'];
        $pdf->SetXY($max_x, $y);
        $pdf->Cell($widths['precio'], $line_height, number_format($row['precio'],2), 1, 0, 'R');
        $pdf->Cell($widths['importe'], $line_height, number_format($row['importe'],2), 1, 1, 'R');
    }

    $pdf->SetFont('Arial','',6.8);
    $pdf->Cell(13,5,'',1,0,'R');
    $pdf->Cell(38,5,'',1,0,'L');
    $pdf->Cell(85,5,'',1,0,'L');
    $pdf->Cell(23,5,'',1,0,'L');
    $pdf->Cell(15,5,'',1,0,'R');
    $pdf->Cell(15,5,'',1,1,'R');
}


if ($totalisr > 0) {
    $total = ($totsubtotal + $totiva) - $totalisr ;
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(159,5,'',0,0,'R');
    $pdf->Cell(15,5,'Subtotal:',1,0,'R');
    $pdf->Cell(15,5,number_format($totsubtotal,2),1,1,'R');
    $pdf->Cell(159,5,'',0,0,'R');
    $pdf->Cell(15,5,'(+) IVA:',1,0,'R');
    $pdf->Cell(15,5,number_format($totiva,2),1,1,'R');
    $pdf->Cell(159,5,'',0,0,'R');
    $pdf->Cell(15,5,'(-) Retencion:',1,0,'R');
    $pdf->Cell(15,5,number_format($totalisr,2),1,1,'R');
    $pdf->Cell(159,5,'',0,0,'R');
    $pdf->Cell(15,5,'Total:',1,0,'R');
    $pdf->Cell(15,5,number_format($total,2),1,1,'R');    
}else {
    if ($totalieps > 0) {
        $total = ($totsubtotal + $totalieps) + $totiva;
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(159,5,'',0,0,'R');
        $pdf->Cell(15,5,'Subtotal:',1,0,'R');
        $pdf->Cell(15,5,number_format($totsubtotal,2),1,1,'R');
        $pdf->Cell(159,5,'',0,0,'R');
        $pdf->Cell(15,5,'(+) IEPS:',1,0,'R');
        $pdf->Cell(15,5,number_format($totalieps,2),1,1,'R');
        $pdf->Cell(159,5,'',0,0,'R');
        $pdf->Cell(15,5,'(+) IVA:',1,0,'R');
        $pdf->Cell(15,5,number_format($totiva,2),1,1,'R');
        $pdf->Cell(159,5,'',0,0,'R');
        $pdf->Cell(15,5,'Total:',1,0,'R');
        $pdf->Cell(15,5,number_format($total,2),1,1,'R');
    }else {
        $total = $totsubtotal + $totiva;
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(159,5,'',0,0,'R');
        $pdf->Cell(15,5,'Subtotal:',1,0,'R');
        $pdf->Cell(15,5,number_format($totsubtotal,2),1,1,'R');
        $pdf->Cell(159,5,'',0,0,'R');
        $pdf->Cell(15,5,'IVA:',1,0,'R');
        $pdf->Cell(15,5,number_format($totiva,2),1,1,'R');
        $pdf->Cell(159,5,'',0,0,'R');
        $pdf->Cell(15,5,'Total:',1,0,'R');
        $pdf->Cell(15,5,number_format($total,2),1,1,'R');
    }
}

$pdf->Output();
?>