<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
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
   

       $subtitulo1=utf8_decode('ENTRADA DE ALMACEN');

   
   
//Logo
$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','',10);
//Encabezado
$this->Cell(50,15,'',1,0,'r');
$this->SetFillColor(231,233,238);
$this->SetTextcolor(6,22,54);
$this->Cell(15,15,'Titulo',1,0,'C','T');
$this->Cell(75,10,$subtitulo1,1,0,'C');
$this->Cell(19,10,'Codigo',1,0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,10,'FO-TV-00-01',1,1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
$this->Cell(15,5,'Area',1,0,'C','T');
$this->Cell(60,5,utf8_decode('Almacén'),1,0,'C');
$this->Cell(19,5,utf8_decode(''),1,0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,5,'',1,0,'C');




$this->Ln(5);
//$this->Cell(1,5,'',1,0,'L');
//Encabezado de la tabla
//$this->Cell(190,5,'DETALLE DE LA ENTRADA',1,1,'C');
}



function Footer()
{

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
$this->Cell(0,10,utf8_decode('Transvive ERP'),0,0,'C');
$this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');

}
}
//Impresion 
include('../../conexion.php');
$noea=$_REQUEST['id'];
$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query00 = mysqli_query($conection,"SELECT serie, folio FROM entrada_almacen WHERE id = $noea");
$result00 = mysqli_num_rows($query00);
$entrada00 = mysqli_fetch_assoc($query00);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $serie      = $entrada00['serie'];
    $folio      = $entrada00['folio'];
  

$query = mysqli_query($conection,"SELECT * FROM entrada_almacen WHERE serie = '$serie' and folio = $folio");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id         = $entrada['id'];
    $fecha      = $entrada['fecha'];
    $notas      = $entrada['observaciones'];
    $cant_total = $entrada['cantidad_total'];

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
$pdf->Cell(144,5,utf8_decode(''),0,0,'L');
$pdf->Cell(20,5,'Serie / Folio:',1,0,'L', 'T');
$pdf->Cell(25,5,$serie. ' '. $folio,1,1,'C');
$pdf->Cell(144,5,utf8_decode(''),0,0,'L');
$pdf->Cell(20,5,'Fecha:',1,0,'L', 'T');
$pdf->Cell(25,5,$newDate,1,1,'C');



$pdf->Ln(5);

include('../../conexion.php');
$noreq=$_REQUEST['id'];

$queryr = mysqli_query($conection,"SELECT * FROM detalle_entradaalm WHERE serie = '$serie' and folio = $folio");
$resultr = mysqli_num_rows($queryr);
$pdf->SetFont('Arial','',8);
$pdf->Cell(25,5,utf8_decode('Codigo'),1,0,'C','T');
$pdf->Cell(80,5,utf8_decode('Descripcion'),1,0,'C','T');
$pdf->Cell(13,5,utf8_decode('Almacen'),1,0,'C','T');
$pdf->Cell(26,5,utf8_decode('Marca'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Cant.'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Costo'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Importe'),1,1,'C','T');
$total = 0;

while ($row = mysqli_fetch_assoc($queryr)){
$pdf->SetFont('Arial','',7);
$total = $total + $row['importe'];
$pdf->Cell(25,5,utf8_decode($row['codigo']),1,0,'L');
$pdf->Cell(80,5,utf8_decode($row['descripcion']),1,0,'L');
$pdf->Cell(13,5,utf8_decode($row['almacen']),1,0,'C');
$pdf->Cell(26,5,utf8_decode($row['marca']),1,0,'L');
$pdf->Cell(15,5,number_format($row['cantidad'],2),1,0,'R');
$pdf->Cell(15,5,number_format($row['precio'],2),1,0,'R');
$pdf->Cell(15,5,number_format($row['importe'],2),1,1,'R');   
}

$pdf->Ln(5);
$pdf->SetFont('Arial','',7);
$pdf->Cell(118,5,utf8_decode(''),0,0,'L');
$pdf->Cell(26,5,utf8_decode('Totales:'),1,0, 'L', 'T');
$pdf->Cell(15,5,number_format($cant_total,2),1,0,'R');
$pdf->Cell(15,5,utf8_decode(''),1,0,'L');
$pdf->Cell(15,5,number_format($total,2),1,1,'R');
$pdf->Ln(5);
$pdf->cell(189,5,utf8_decode('Observaciones:'),1,1, 'L', 'T');
$pdf->SetFillColor(255,255,255);
$pdf->Multicell(189,5,utf8_decode($notas),1,1, 'L');

$pdf->Ln(10);
$pdf->Cell(60,5,utf8_decode('Nombre y Firma del Usuario'),0,0,'C');
$pdf->Cell(3,5,utf8_decode(''),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Nombre y Firma de Autorizacion'),0,0,'C');
$pdf->Cell(3,5,utf8_decode(''),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Nombre y Firma de Compras'),0,0,'C');
$pdf->Cell(3,5,utf8_decode(''),0,0,'L');
$pdf->Ln(10);
$pdf->Cell(60,5,utf8_decode('__________________________________'),0,0,'C');
$pdf->Cell(3,5,utf8_decode(''),0,0,'L');
$pdf->Cell(60,5,utf8_decode('__________________________________'),0,0,'C');
$pdf->Cell(3,5,utf8_decode(''),0,0,'L');
$pdf->Cell(60,5,utf8_decode('__________________________________'),0,0,'C');
$pdf->Cell(3,5,utf8_decode(''),0,0,'L');
// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>