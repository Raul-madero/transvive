<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF {
    function Header(){
        //Variables para consulta
        $noreq=$_REQUEST['id'];
        //Consulta sql encabezado
        include('../../conexion.php');

        //Agregamos la libreria para genera códigos QR
        //require "phpqrcode/qrlib.php";    
    
        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';
    
        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);
            //Declaramos la ruta y nombre del archivo a generar
            $filename = $dir.'test.png';
 
            //Parametros de Condiguración
            $conection->set_charset('utf8');

            $query = mysqli_query($conection,"SELECT * FROM requisicion_compra WHERE no_requisicion = $noreq");
            $result = mysqli_num_rows($query);
            $entrada = mysqli_fetch_assoc($query);
            //$encabezado = mysql_fetch_array($query1, $conexion);
            //Variables para encabezado
    
            $id         = $entrada['id'];
            $folio      = $entrada['no_requisicion'];
            $fecha      = $entrada['fecha'];
            $fecha_req  = $entrada['fecha_requiere'];
            $tipo       = $entrada['tipo_requisicion'];
            $notas      = $entrada['observaciones'];
            $area       = $entrada['area_solicitante'];
            $cant_auto  = $entrada['cant_autorizada'];

    
            //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
            $subtitulo1=utf8_decode('REQUISICIÓN');
            //Logo
            $this->Image("../../images/transvive.png",12,11,48,13,"png",0);
            //$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
            //Arial bold 15
            $this->SetFont('Arial','',10);
            //Encabezado
            $this->Cell(50,15,'',1,0,'r');
            $this->SetFillColor(231,233,238);
            $this->SetTextcolor(6,22,54);
            $this->Cell(15,15,utf8_decode('Título'),1,0,'C','T');
            $this->Cell(75,10,$subtitulo1,1,0,'C');
            $this->Cell(19,10,utf8_decode('Código'),'T,R',0,'C','T');
            $this->SetFont('Arial','',8);
            $this->Cell(30,10,'FO-TV-CO-01','T,R',1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(65,10,'',0,0,'R');
            $this->Cell(15,5,utf8_decode('Área'),1,0,'C','T');
            $this->Cell(60,5,utf8_decode('Compras'),1,0,'C');
            $this->Cell(19,5,utf8_decode(''),'B,R',0,'C','T');
            $this->SetFont('Arial','',8);
            $this->Cell(30,5,'','B,R',0,'C');
            $this->Ln(5);
            //$this->Cell(1,5,'',1,0,'L');
            //Encabezado de la tabla
            //$this->Cell(190,5,'DETALLE DE LA ENTRADA',1,1,'C');
    }
    function Footer(){

        $this->SetY(-10);
        $this->SetTextcolor(0,0,0);
        $this->SetFont('Arial','I',8);
        /*
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(45,5,utf8_decode(''),0,0,'C');
        $this->Cell(20,5,'',0,0,'L');
        $this->Cell(45,5,utf8_decode(''),0,0,'C');
        $this->Cell(20,5,'',0,0,'L');
        $this->Cell(45,5,utf8_decode(''),0,1,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Elabora'),0,0,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Revisa'),0,0,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Autoriza'),0,1,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Ma. Guadalupe Balcárcel'),0,0,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Karina López Salazar'),0,0,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Angelina Durán Garibay'),0,1,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Compras'),0,0,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Aseguramiento de Calidad'),0,0,'C');
        $this->Cell(10,5,'',0,0,'L');
        $this->Cell(52,5,utf8_decode('Administración SGC'),0,1,'C');
        */
        $this->Cell(0,10,utf8_decode(''),0,0,'C');
        $this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');
    }
    // ✅ Función para calcular líneas necesarias según el ancho
    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i < $nb) {
            $c = $s[$i];
            if($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if($l > $wmax) {
                if($sep == -1) {
                    if($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}
//Impresion 
include('../../conexion.php');
$noreq=$_REQUEST['id'];
$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT * FROM requisicion_compra WHERE no_requisicion = $noreq");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
$id         = $entrada['id'];
$folio      = $entrada['no_requisicion'];
$fecha      = $entrada['fecha'];
$fecha_req  = $entrada['fecha_requiere'];
$tipo       = $entrada['tipo_requisicion'];
$notas      = $entrada['observaciones'];
$area       = $entrada['area_solicitante'];
$cant_auto  = $entrada['cant_autorizada'];
$firma_auto = $entrada['firma_autoriza'];

//  $imagen="../img/routers/".$entrada['foto'];

$newDate = date("d-m-Y", strtotime($entrada['fecha'])); 
if ($fecha_req > '2000-01-01') {
    $newDatereq = date("d-m-Y", strtotime($entrada['fecha_requiere']));
}else {
    $newDatereq = '';
} 
//ciclo de repeticion celdas
//Consulta para cuerpo tabla
$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);
if ($entrada['estatus'] == 0) {
    $pdf->Image("img/anulado.png",12,74,168,123,"png",0,'C');
}
$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(144,5,utf8_decode(''),0,0,'L');
$pdf->Cell(20,5,'Folio:',1,0,'L', 'T');
$pdf->Cell(25,5,'REQ-' . $folio,1,1,'R');
$pdf->Cell(32,5,utf8_decode('Fecha de Solicitud:'),1,0,'L', 'T');
$pdf->Cell(30,5,$newDate,1,0,'C');
$pdf->Cell(52,5,utf8_decode('Fecha en que se requiere el material:'),1,0,'L', 'T');
$pdf->Cell(30,5,$newDatereq,1,0,'C');
$pdf->Cell(20,5,utf8_decode('Tipo:'),1,0,'L', 'T');
$pdf->Cell(25,5,$tipo,1,1,'C');
$pdf->Cell(32,5,utf8_decode('Area Solicitante:'),1,0,'L', 'T');
$pdf->Cell(157,5,utf8_decode($area),1,1,'C');
$pdf->Ln(5);

include('../../conexion.php');
$noreq=$_REQUEST['id'];
$queryr = mysqli_query($conection,"SELECT * FROM detalle_requisicioncompra WHERE folio = $noreq");
$resultr = mysqli_num_rows($queryr);
$pdf->SetFont('Arial','',8);
$pdf->Cell(13,5,utf8_decode('Cantidad'),1,0,'C','T');
$pdf->Cell(90,5,utf8_decode('Descripcion'),1,0,'C','T');
$pdf->Cell(46,5,utf8_decode('Marca'),1,0,'C','T');
$pdf->Cell(20,5,utf8_decode('E'),1,0,'C','T');
$pdf->Cell(20,5,utf8_decode('OM'),1,1,'C','T');

if ($resultr >= 32) {
    $filas = $resultr;
}else {
    $filas = 32 - $resultr;
}
for ($i = 1; $i < $filas; $i++) {

    while ($row = mysqli_fetch_assoc($queryr)) {
        $pdf->SetFont('Arial','',6.8);
    
        // Posiciones iniciales
        $x = $pdf->GetX();
        $y = $pdf->GetY();
    
        // Anchos de columna
        $w_cant = 13;
        $w_desc = 90;
        $w_marca = 46;
        $w_datoe = 20;
        $w_datoom = 20;
        $line_height = 5;
    
        // Texto de descripción
        $desc = utf8_decode($row['descripcion']);
        $desc_lines = min(3, $pdf->NbLines($w_desc, $desc));
        $cell_height = $line_height * $desc_lines;
    
        // Cantidad
        $pdf->Cell($w_cant, $cell_height, number_format($row['cantidad'],2), 1, 0, 'R');
    
        // Descripción (MultiCell)
        $pdf->SetXY($x + $w_cant, $y);
        $pdf->MultiCell($w_desc, $line_height, $desc, 1, 'L');
    
        // Resto de columnas
        $pdf->SetXY($x + $w_cant + $w_desc, $y);
        $pdf->Cell($w_marca, $cell_height, utf8_decode($row['marca']), 1, 0, 'L');
        $pdf->Cell($w_datoe, $cell_height, utf8_decode($row['dato_e']), 1, 0, 'C');
        $pdf->Cell($w_datoom, $cell_height, utf8_decode($row['dato_om']), 1, 1, 'C');
    }
    
        
    $pdf->SetFont('Arial','',6.8);
    $pdf->Cell(13,5,utf8_decode(''),1,0,'R');
    $pdf->Cell(90,5,utf8_decode(''),1,0,'L');
    $pdf->Cell(46,5,utf8_decode(''),1,0,'L');
    $pdf->Cell(20,5,utf8_decode(''),1,0,'C');
    $pdf->Cell(20,5,utf8_decode(''),1,1,'C');    
}

$pdf->Ln(10);
$pdf->SetFont('Arial','',7);
$pdf->Cell(103,5,utf8_decode(''),0,0,'L');
$pdf->Cell(46,5,utf8_decode('Monto Aprox. Autorizado:'),1,0, 'L', 'T');
$pdf->Cell(20,5,number_format($cant_auto,2),1,0,'R');
$pdf->Cell(20,5,utf8_decode(''),1,1,'L');
$pdf->cell(189,5,utf8_decode('Observaciones:'),1,1, 'L', 'T');
$pdf->SetFillColor(255,255,255);
$pdf->Multicell(189,5,utf8_decode($notas),1,1, 'L');
if ($entrada['estatus'] == 0){
    $pdf->Ln(5);
    $pdf->SetFillColor(231,233,238);
    $pdf->cell(189,5,utf8_decode('Motivo Cancelación:'),1,1, 'L', 'T');
    $pdf->SetFillColor(255,255,255);
    $pdf->Multicell(189,5,utf8_decode($entrada['motivo_cancela']),1,1, 'L');
}

if(!empty($firma_auto)){
    if ($entrada['estatus'] == 0){
        $pdf->Ln(5);
    }else {    
        $pdf->Image("../../images/firmadig.png",75,230,48,23,"png",0,'C');
        $pdf->Ln(10);
        $pdf->Cell(60,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(3,5,utf8_decode(''),0,0,'L');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,5,utf8_decode('RAUL'),0,0,'L');
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(30,5,utf8_decode('Digitally signed'),0,0,'L');

        $pdf->Cell(3,5,utf8_decode(''),0,0,'L');
        $pdf->Cell(60,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(3,5,utf8_decode(''),0,0,'L');
        $pdf->Ln(7);
        $pdf->Cell(60,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(3,5,utf8_decode(''),0,0,'L');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,5,utf8_decode('GUTIERREZ'),0,0,'L');
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(30,5,utf8_decode('by Raúl Gutiérrez'),0,0,'L');

        $pdf->Cell(3,5,utf8_decode(''),0,0,'L');
        $pdf->Cell(60,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(3,5,utf8_decode(''),0,0,'L');
        // Salto de pagina
        // $pdf->Ln(5);
        // $pdf->AddPage();
    }
}
    // $pdf->Image("$imagen",10,30,189,150,'png');
    $pdf->Output();
?>