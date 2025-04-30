<?php

include('../fpdf/fpdf.php');


header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$nooc=$_REQUEST['id'];
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

$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.proveedor, oc.contacto, oc.telefono, oc.correo, oc.forma_pago, oc.metodo_pago, oc.uso_cfdi, oc.area_solicitante, oc.observaciones, pv.nombre, oc.recibe FROM orden_compra oc INNER JOIN proveedores pv ON oc.proveedor = pv.id WHERE oc.no_orden = $nooc");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id         = $entrada['id'];
    $folio      = $entrada['no_orden'];
    $fecha      = $entrada['fecha'];
    $proveedor  = $entrada['proveedor'];
    $contacto   = $entrada['contacto'];
    $telefono   = $entrada['telefono'];
    $correp     = $entrada['correo'];
    $name_prov  = $entrada['nombre'];
    $recibe     = $entrada['recibe'];


    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
   

       $subtitulo1='ORDEN DE COMPRA';

   
   
//Logo

$this->Image("../../images/fondo001.png",10,10,78,93,"png",0,'C');
$this->Image("../../images/fondo002.png",171,216.5,28,53,"png",0,'C');
$this->Image("../../images/transvive_logo.png",12,11,48,13,"png",0,'C');
$this->Image("../../images/fondo01.png",36,110,148,63,"png",0,'C');

//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','',10);
//Encabezado
$this->Cell(50,15,'',1,0,'r');
$this->SetFillColor(231,233,238);
$this->SetTextcolor(6,22,54);
$this->Cell(15,15,'Título',1,0,'C','T');
$this->Cell(75,10,$subtitulo1,1,0,'C');
$this->Cell(19,10,'Código','T,R',0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,10,'FO-TV-CO-02','T,R',1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
$this->Cell(15,5,'Área',1,0,'C','T');
$this->Cell(60,5,'Compras',1,0,'C');
$this->Cell(19,5,'','B,R',0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,5,'','B,R',0,'C');





$this->Ln(5);
//$this->Cell(1,5,'',1,0,'L');
//Encabezado de la tabla
//$this->Cell(190,5,'DETALLE DE LA ENTRADA',1,1,'C');

}



function Footer()
{
    $nooc=$_REQUEST['id'];
    include('../../conexion.php');
$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.proveedor, oc.contacto, oc.telefono, oc.correo, oc.forma_pago, oc.metodo_pago, oc.uso_cfdi, oc.area_solicitante, oc.observaciones, pv.nombre, oc.recibe, rq.fecha as datereq, oc.estatus, oc.motivo_cancela FROM orden_compra oc INNER JOIN proveedores pv ON oc.proveedor = pv.id INNER JOIN requisicion_compra rq ON oc.no_requisicion = rq.no_requisicion WHERE oc.no_orden = $nooc");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id         = $entrada['id'];
    $folio      = $entrada['no_orden'];
    $fecha      = $entrada['fecha'];
    $proveedor  = $entrada['proveedor'];
    $contacto   = $entrada['contacto'];
    $telefono   = $entrada['telefono'];
    $correp     = $entrada['correo'];
    $name_prov  = $entrada['nombre'];
    $recibe     = $entrada['recibe'];
    $notas     = $entrada['observaciones'];
    $solicita  = $entrada['area_solicitante'];
    $motivo  = $entrada['motivo_cancela'];
     $newDate = date("d-m-Y", strtotime($entrada['fecha'])); 
     $newDateReq = date("d-m-Y", strtotime($entrada['datereq'])); 
$this->SetY(-25);
$this->SetTextcolor(0,0,0);
$this->SetFont('Arial','I',8);
/*
$this->Cell(10,5,'',0,0,'L');
$this->Cell(45,5,''),0,0,'C');
$this->Cell(20,5,'',0,0,'L');
$this->Cell(45,5,''),0,0,'C');
$this->Cell(20,5,'',0,0,'L');
$this->Cell(45,5,''),0,1,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Elabora'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Revisa'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Autoriza'),0,1,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Ma. Guadalupe Balcárcel'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Karina López Salazar'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Angelina Durán Garibay'),0,1,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Compras'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Aseguramiento de Calidad'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,'Administración SGC'),0,1,'C');
*/
//$this->Cell(0,10,'Transvive ERP'),0,0,'C');
if ($entrada['estatus'] == 0) {
$this->SetFont('Arial','',7);
$this->cell(189,5,'Motivo cancelación:',1,1, 'L', 'T');
$this->SetFillColor(255,255,255);
$this->cell(189,5,$motivo,1,1, 'L');
$this->SetFillColor(231,233,238);
$this->cell(25,5,'Area Solicitante:',1,0, 'L', 'T');
$this->cell(40,5,$solicita,1,0, 'L');
$this->cell(15,5,'Fecha:',1,0, 'L', 'T');
$this->cell(19,5,$newDateReq,1,0, 'C');
$this->cell(15,5,'Recibe:',1,0, 'L', 'T');
$this->cell(75,5,$recibe,1,0, 'L');
}else {
$this->SetFont('Arial','',7);
$this->cell(189,5,'Observaciones:',1,1, 'L', 'T');
$this->SetFillColor(255,255,255);
$this->cell(189,5,$notas,1,1, 'L');
$this->SetFillColor(231,233,238);
$this->cell(25,5,'Area Solicitante:',1,0, 'L', 'T');
$this->cell(40,5,$solicita,1,0, 'L');
$this->cell(15,5,'Fecha:',1,0, 'L', 'T');
$this->cell(19,5,$newDateReq,1,0, 'C');
$this->cell(15,5,'Recibe:',1,0, 'L', 'T');
$this->cell(75,5,$recibe,1,0, 'L');
//$this->cell(15,5,'Fecha:'),1,0, 'L', 'T');
//$this->cell(20,5,'',1,1, 'L');
//$this->Cell(-15,10,'Página ') . $this->PageNo(),0,0,'C');
}
}
}
//Impresion 
include('../../conexion.php');
$nooc = $_REQUEST['id'];
$pdf=new PDF();
//$pdf = new AlphaPDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.proveedor, oc.contacto, oc.telefono, oc.correo, oc.forma_pago, oc.metodo_pago, oc.uso_cfdi, oc.area_solicitante, oc.observaciones, pv.nombre, oc.recibe, rq.fecha as datereq, oc.estatus FROM orden_compra oc INNER JOIN proveedores pv ON oc.proveedor = pv.id INNER JOIN requisicion_compra rq ON oc.no_requisicion = rq.no_requisicion WHERE oc.no_orden = $nooc");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
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
$pdf->Cell(25,5,'Proveedor',1,0,'L', 'T');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(119,5,$proveedor,1,0,'L');
$pdf->Cell(20,5,'No. Orden:',1,0,'L', 'T');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,5,'OC-'. $folio,1,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(25,5,'Contacto:',1,0,'L', 'T');
$pdf->Cell(119,5,$contacto,1,0,'L');
$pdf->Cell(20,5,'Fecha:',1,0,'L', 'T');
$pdf->Cell(25,5,$newDate,1,1,'C');
$pdf->Cell(25,5,'Teléfono:',1,0,'L', 'T');
$pdf->Cell(55,5,$telefono,1,0,'L');
$pdf->Cell(30,5,'Correo:',1,0,'L', 'T');
$pdf->Cell(79,5,$correo,1,1,'C');
$pdf->Cell(50,5,'Datos de Facturación:',1,0,'C', 'T');
$pdf->Cell(30,5,'Forma de Pago:',1,0,'L', 'T');
$pdf->Cell(64,5,$formapago,1,0,'L');
$pdf->Cell(45,5,'Datos de Entrega:',1,1,'C', 'T');
$pdf->Cell(50,5,'Transvive S. de R.L. de C.V.',1,0,'C');
$pdf->Cell(30,5,'Metodo de Pago:',1,0,'L', 'T');
$pdf->Cell(64,5,$metodopago,1,0,'L');
$pdf->Cell(45,5,'Hidalgo No. 30',1,1,'C');
$pdf->Cell(50,5,'TVI-190503-SA3',1,0,'C');
$pdf->Cell(30,5,'Uso de CFDI:',1,0,'L', 'T');
$pdf->Cell(64,5,$usocfdi,1,0,'L');
$pdf->Cell(45,5,'C.P. 45640 Col. Los Gavilanes',1,1,'C');
$pdf->Cell(144,5,'',1,0,'C');
$pdf->Cell(45,5,'Tlajomulco de Zuñiga, Jal.',1,1,'C');




$pdf->Ln(5);

include('../../conexion.php');
$nooc = $_REQUEST['id'];

// if($nooc <= 1346) {
    $queryr = mysqli_query($conection,"SELECT * FROM detalle_ordencompra WHERE folio = $nooc");
    $resultr = mysqli_num_rows($queryr);
// }else {
//     $queryr = mysqli_query($conection,"SELECT cantidad, codigo, descripcion, marca, precio, importe FROM orden_compra WHERE no_orden = $nooc");
//     $resultr = mysqli_num_rows($queryr);
// }
$pdf->SetFont('Arial','',8);
$pdf->Cell(13,5,'Cantidad',1,0,'C','T');
$pdf->Cell(38,5,'Código',1,0,'C','T');
$pdf->Cell(85,5,'Descripcion',1,0,'C','T');
$pdf->Cell(23,5,'Marca',1,0,'C','T');
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

/*
$pdf->SetY(-50);
$pdf->Ln(5);
$pdf->SetFont('Arial','',7);
$pdf->cell(165,5,'Observaciones:'),1,1, 'L', 'T');
$pdf->SetFillColor(255,255,255);
$pdf->Multicell(165,5,$notas),1,1, 'L');
$pdf->SetFillColor(231,233,238);
$pdf->cell(30,5,'Area Solicitante:'),1,0, 'L', 'T');
$pdf->cell(70,5,$solicita),1,0, 'L');
$pdf->cell(30,5,'Fecha:'),1,0, 'L', 'T');
$pdf->cell(35,5,$newDate,1,1, 'C');
$pdf->cell(30,5,'Recibe:'),1,0, 'L', 'T');
$pdf->cell(70,5,$recibe),1,0, 'L');
$pdf->cell(30,5,'Fecha:'),1,0, 'L', 'T');
$pdf->cell(35,5,'',1,1, 'L');

*/

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>