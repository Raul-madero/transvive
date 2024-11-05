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

$query = mysqli_query($conection,"SELECT oc.id, oc.no_compra, oc.no_orden, oc.fecha, oc.proveedor, oc.contacto, oc.telefono, oc.correo, oc.forma_pago, oc.metodo_pago, oc.uso_cfdi, oc.area_solicitante, oc.observaciones, pv.nombre FROM compras oc INNER JOIN proveedores pv ON oc.proveedor = pv.id WHERE oc.no_compra = $nooc");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id          = $entrada['id'];
    $foliocompra = $entrada['no_compra'];
    $folionoord  = $entrada['no_orden'];
    $fecha       = $entrada['fecha'];
    $proveedor   = $entrada['proveedor'];
    $contacto    = $entrada['contacto'];
    $telefono    = $entrada['telefono'];
    $correp      = $entrada['correo'];
    $name_prov   = $entrada['nombre'];

    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
   

       $subtitulo1=utf8_decode('COMPRA');

   
   
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
$this->Cell(15,15,utf8_decode('Título'),1,0,'C','T');
$this->Cell(75,10,$subtitulo1,1,0,'C');
$this->Cell(19,10,utf8_decode('Código'),'T,R',0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,10,'FO-TV-CO-03','T,R',1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
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



function Footer()
{

$nooc2=$_REQUEST['id'];
    include('../../conexion.php');
$query5 = mysqli_query($conection,"SELECT oc.id, oc.no_compra, oc.no_orden, oc.fecha, oc.proveedor, oc.contacto, oc.telefono, oc.correo, oc.forma_pago, oc.metodo_pago, oc.uso_cfdi, oc.area_solicitante, oc.observaciones, pv.nombre, oc.nofactura_prov, rq.fecha as fechareq  FROM compras oc INNER JOIN proveedores pv ON oc.proveedor = pv.id LEFT JOIN orden_compra po ON oc.no_orden = po.no_orden LEFT JOIN requisicion_compra rq ON po.no_requisicion = rq.no_requisicion WHERE oc.no_compra = $nooc2");
$result5 = mysqli_num_rows($query5);
$entrada5 = mysqli_fetch_assoc($query5);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    
    $newDate5 = date("d-m-Y", strtotime($entrada5['fecha'])); 
    if ($entrada5['fechareq'] > "2020-01-01") {
        $newDate52 = date("d-m-Y", strtotime($entrada5['fechareq']));
    }else {
       $newDate52 = ""; 
    }   
$this->SetY(-25);
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
$this->SetFont('Arial','',7);
$this->cell(189,5,utf8_decode('Observaciones:'),1,1, 'L', 'T');
$this->SetFillColor(255,255,255);
$this->cell(189,5,utf8_decode($entrada5['observaciones']),1,1, 'L');
$this->SetFillColor(231,233,238);
$this->cell(25,5,utf8_decode('Area Solicitante:'),1,0, 'L', 'T');
$this->cell(40,5,utf8_decode($entrada5['area_solicitante']),1,0, 'L');
$this->cell(15,5,utf8_decode('Fecha:'),1,0, 'L', 'T');
$this->cell(19,5,$newDate52,1,0, 'C');
$this->cell(15,5,utf8_decode('Recibe:'),1,0, 'L', 'T');
$this->cell(40,5,utf8_decode($entrada5['area_solicitante']),1,0, 'L');
$this->cell(15,5,utf8_decode('Fecha:'),1,0, 'L', 'T');
$this->cell(20,5,$newDate5,1,1, 'L');
//$this->Cell(0,10,utf8_decode('Transvive ERP'),0,0,'C');
//$this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');

}
}
//Impresion 
include('../../conexion.php');
$nooc = $_REQUEST['id'];
$pdf=new PDF();
//$pdf = new AlphaPDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT oc.id, oc.no_compra, oc.no_orden, oc.fecha, oc.proveedor, oc.contacto, oc.telefono, oc.correo, oc.forma_pago, oc.metodo_pago, oc.uso_cfdi, oc.area_solicitante, oc.observaciones, pv.nombre, oc.nofactura_prov, rq.fecha as fechareq  FROM compras oc INNER JOIN proveedores pv ON oc.proveedor = pv.id LEFT JOIN orden_compra po ON oc.no_orden = po.no_orden LEFT JOIN requisicion_compra rq ON po.no_requisicion = rq.no_requisicion WHERE oc.no_compra = $nooc");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id         = $entrada['id'];
    $folio_comp = $entrada['no_compra'];
    $folio_oc   = $entrada['no_orden'];
    $fecha      = $entrada['fecha'];
    $id_prov    = $entrada['proveedor'];
    $contacto   = $entrada['contacto'];
    $telefono   = $entrada['telefono'];
    $correo     = $entrada['correo'];
    $formapago  = $entrada['forma_pago'];
    $metodopago = $entrada['metodo_pago'];
    $usocfdi    = $entrada['uso_cfdi'];
    $solicita   = $entrada['area_solicitante'];
    $nofactprov = $entrada['nofactura_prov'];
    $notas      = $entrada['observaciones'];
    $proveedor  = $entrada['nombre'];

  //  $imagen="../img/routers/".$entrada['foto'];
    
    $newDate = date("d-m-Y", strtotime($entrada['fecha'])); 
   
   
//ciclo de repeticion celdas
//Consulta para cuerpo tabla

$pdf->Ln(5);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(25,5,utf8_decode('Proveedor'),1,0,'L', 'T');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(119,5,utf8_decode($proveedor),1,0,'L');
$pdf->Cell(20,5,'No. Compra:',1,0,'L', 'T');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,5,$folio_comp,1,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(25,5,utf8_decode('Contacto:'),1,0,'L', 'T');
$pdf->Cell(119,5,utf8_decode($contacto),1,0,'L');
$pdf->Cell(20,5,utf8_decode('Fecha:'),1,0,'L', 'T');
$pdf->Cell(25,5,$newDate,1,1,'C');
$pdf->Cell(25,5,utf8_decode('Teléfono:'),1,0,'L', 'T');
$pdf->Cell(40,5,$telefono,1,0,'L');
$pdf->Cell(15,5,utf8_decode('Correo:'),1,0,'L', 'T');
$pdf->Cell(64,5,$correo,1,0,'C');
$pdf->Cell(20,5,'O. Compra:',1,0,'L', 'T');
$pdf->Cell(25,5,$folio_oc,1,1,'C');
$pdf->Cell(50,5,utf8_decode('Datos de Facturación:'),1,0,'C', 'T');
$pdf->Cell(30,5,utf8_decode('Forma de Pago:'),1,0,'L', 'T');
$pdf->Cell(64,5,utf8_decode($formapago),1,0,'L');
$pdf->Cell(45,5,utf8_decode('Datos de Entrega:'),1,1,'C', 'T');
$pdf->Cell(50,5,utf8_decode('Transvive S. de R.L. de C.V.'),1,0,'C');
$pdf->Cell(30,5,utf8_decode('Metodo de Pago:'),1,0,'L', 'T');
$pdf->Cell(64,5,utf8_decode($metodopago),1,0,'L');
$pdf->Cell(45,5,utf8_decode('Hidalgo No. 30'),1,1,'C');
$pdf->Cell(50,5,utf8_decode('TVI-190503-SA3'),1,0,'C');
$pdf->Cell(30,5,utf8_decode('Uso de CFDI:'),1,0,'L', 'T');
$pdf->Cell(64,5,utf8_decode($usocfdi),1,0,'L');
$pdf->Cell(45,5,utf8_decode('C.P. 45640 Col. Los Gavilanes'),1,1,'C');
$pdf->Cell(64,5,utf8_decode('No. de Factura del Proveedor:'),1,0,'L', 'T');
$pdf->Cell(80,5,utf8_decode($nofactprov),1,0,'C');
$pdf->Cell(45,5,utf8_decode('Tlajomulco de Zuñiga, Jal.'),1,1,'C');




$pdf->Ln(5);

include('../../conexion.php');
$nocom = $_REQUEST['id'];

$queryr = mysqli_query($conection,"SELECT * FROM detalle_compra WHERE folio = $nocom");
$resultr = mysqli_num_rows($queryr);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('Cant.'),1,0,'C','T');
$pdf->Cell(20,5,utf8_decode('Código'),1,0,'C','T');
$pdf->Cell(81,5,utf8_decode('Descripcion'),1,0,'C','T');
$pdf->Cell(12,5,utf8_decode('Almacen'),1,0,'C','T');
$pdf->Cell(36,5,utf8_decode('Marca'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Precio'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Importe'),1,1,'C','T');

$subtotal    = 0;
$totsubtotal = 0;
$impuestos   = 0;
$isr         = 0;
$ieps        = 0; 
$totiva      = 0;
$totisr      = 0;
$totieps     = 0;
$total       = 0;

if ($resultr >= 33) {
         $filas = $resultr;
      }else {
         $filas = 33 - $resultr;
      }
for ($i = 1; $i < $filas; $i++) {

while ($row = mysqli_fetch_assoc($queryr)){
$subtotal = $row['cantidad'] * $row['precio']; 
$totsubtotal = $totsubtotal + $subtotal;
$impuesto = (($row['cantidad'] * $row['precio']) * $row['impuesto'])/100;   
$isr      = (($row['cantidad'] * $row['precio']) * ($row['impuesto_isr'] /100));   
$ieps     = $row['cantidad'] * $row['impuesto_ieps'];
$totiva   = $totiva + $impuesto;
$totisr   = $totisr + $isr;
$totieps  = $totieps + $ieps;

$pdf->SetFont('Arial','',6.8);
$pdf->Cell(10,5,number_format($row['cantidad'],2),1,0,'R');
$pdf->Cell(20,5,utf8_decode($row['codigo']),1,0,'L');
$pdf->Cell(81,5,utf8_decode($row['descripcion']),1,0,'L');
$pdf->Cell(12,5,utf8_decode($row['almacen']),1,0,'L');
$pdf->Cell(36,5,utf8_decode($row['marca']),1,0,'L');
$pdf->Cell(15,5,number_format($row['precio'],2),1,0,'R');
$pdf->Cell(15,5,number_format($subtotal,2),1,1,'R');
}
$pdf->SetFont('Arial','',6.8);
$pdf->Cell(10,5,utf8_decode(''),1,0,'R');
$pdf->Cell(20,5,utf8_decode(''),1,0,'L');
$pdf->Cell(81,5,utf8_decode(''),1,0,'L');
$pdf->Cell(12,5,utf8_decode(''),1,0,'L');
$pdf->Cell(36,5,utf8_decode(''),1,0,'L');
$pdf->Cell(15,5,utf8_decode(''),1,0,'R');
$pdf->Cell(15,5,utf8_decode(''),1,1,'R');
}


if ($totisr > 0) {
$total = ($totsubtotal + $totiva) - $totisr;
$pdf->SetFont('Arial','B',7);
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('Subtotal:'),1,0,'R');
$pdf->Cell(15,5,number_format($totsubtotal,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('(+) IVA:'),1,0,'R');
$pdf->Cell(15,5,number_format($totiva,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('(-) ISR:'),1,0,'R');
$pdf->Cell(15,5,number_format($totisr,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('Total:'),1,0,'R');
$pdf->Cell(15,5,number_format($total,2),1,1,'R');
    
}else {
if ($totieps > 0) {
$total = ($totsubtotal + $totieps) + $totiva;
$pdf->SetFont('Arial','B',7);
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('Subtotal:'),1,0,'R');
$pdf->Cell(15,5,number_format($totsubtotal,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('(+) IEPS:'),1,0,'R');
$pdf->Cell(15,5,number_format($totieps,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('(+) IVA:'),1,0,'R');
$pdf->Cell(15,5,number_format($totiva,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('Total:'),1,0,'R');
$pdf->Cell(15,5,number_format($total,2),1,1,'R');   
}else {
$total = ($totsubtotal + $totiva);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('Subtotal:'),1,0,'R');
$pdf->Cell(15,5,number_format($totsubtotal,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('IVA:'),1,0,'R');
$pdf->Cell(15,5,number_format($totiva,2),1,1,'R');
$pdf->Cell(159,5,'',0,0,'R');
$pdf->Cell(15,5,utf8_decode('Total:'),1,0,'R');
$pdf->Cell(15,5,number_format($total,2),1,1,'R');
}
}
/*
$pdf->SetY(-50);
$pdf->Ln(5);
$pdf->SetFont('Arial','',7);
$pdf->cell(165,5,utf8_decode('Observaciones:'),1,1, 'L', 'T');
$pdf->SetFillColor(255,255,255);
$pdf->Multicell(165,5,utf8_decode($notas),1,1, 'L');
$pdf->SetFillColor(231,233,238);
$pdf->cell(30,5,utf8_decode('Area Solicitante:'),1,0, 'L', 'T');
$pdf->cell(70,5,utf8_decode($solicita),1,0, 'L');
$pdf->cell(30,5,utf8_decode('Fecha:'),1,0, 'L', 'T');
$pdf->cell(35,5,$newDate,1,1, 'C');
$pdf->cell(30,5,utf8_decode('Recibe:'),1,0, 'L', 'T');
$pdf->cell(70,5,utf8_decode(''),1,0, 'L');
$pdf->cell(30,5,utf8_decode('Fecha:'),1,0, 'L', 'T');
$pdf->cell(35,5,'',1,1, 'L');
*/


// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>