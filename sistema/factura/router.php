<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$idoentrada=$_REQUEST['id'];
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

$query = mysqli_query($conection,"SELECT * FROM routers WHERE folio= $idoentrada");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id         = $entrada['id'];
    $folio      = $entrada['folio'];
    $cliente    = $entrada['cliente'];
    $ruta       = $entrada['ruta'];
    $hora1      = $entrada['horallegada_t1'];
    $hora2      = $entrada['horallegada_t2'];
    $hora3      = $entrada['horallegada_t3'];
    $operador   = $entrada['operador'];
    $supervisor = $entrada['supervisor'];

    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
   

       $subtitulo1=utf8_decode('Router');

   
   
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
$this->Cell(30,10,'FO-TV-SE-02',1,1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
$this->Cell(15,5,'Area',1,0,'C','T');
$this->Cell(60,5,utf8_decode('Servicios'),1,0,'C');
$this->Cell(19,5,utf8_decode('Versión'),1,0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,5,'1.0',1,0,'C');




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
$this->Cell(0,10,utf8_decode('Transvive CRM'),0,0,'C');
$this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');

}
}
//Impresion 
include('../../conexion.php');
$idoentrada=$_REQUEST['id'];
$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT * FROM routers WHERE folio= $idoentrada");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id         = $entrada['id'];
    $folio      = $entrada['folio'];
    $cliente    = $entrada['cliente'];
    $ruta       = $entrada['ruta'];
    $hora1      = $entrada['horallegada_t1'];
    $hora2      = $entrada['horallegada_t2'];
    $hora3      = $entrada['horallegada_t3'];
    $operador   = $entrada['operador'];
    $supervisor = $entrada['supervisor'];

    $imagen="../img/routers/".$entrada['foto'];
    

//ciclo de repeticion celdas
//Consulta para cuerpo tabla

$pdf->Ln(5);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(45,5,utf8_decode('Empresa:'),1,0,'L', 'T');
$pdf->Cell(144,5,$cliente,1,1,'C');
$pdf->Cell(66,5,utf8_decode('Hora de llegada a la Empresa:'),1,0,'L', 'T');
$pdf->Cell(41,5,utf8_decode('Turno 1'),1,0,'C', 'T');
$pdf->Cell(41,5,utf8_decode('Turno 2'),1,0,'C', 'T');
$pdf->Cell(41,5,utf8_decode('Turno 3'),1,1,'C', 'T');
$pdf->Cell(66,5,utf8_decode(''),1,0,'L');
$pdf->Cell(41,5,utf8_decode($hora1),1,0,'C');
$pdf->Cell(41,5,utf8_decode($hora2),1,0,'C');
$pdf->Cell(41,5,utf8_decode($hora3),1,1,'C');
$pdf->Cell(45,5,utf8_decode('Ruta:'),1,0,'L', 'T');
$pdf->Cell(144,5,utf8_decode($ruta),1,1,'C');

$pdf->Ln(5);

include('../../conexion.php');
$idoentrada=$_REQUEST['id'];

$queryr = mysqli_query($conection,"SELECT * FROM detalle_routers WHERE folio= $idoentrada");
$resultr = mysqli_num_rows($queryr);

$pdf->Cell(15,5,utf8_decode('Horario'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('horario'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Horario'),1,0,'C','T');
$pdf->Cell(60,5,utf8_decode(''),1,0,'C','T');
$pdf->Cell(70,5,utf8_decode(''),1,0,'C','T');
$pdf->Cell(14,5,utf8_decode('No. de'),1,1,'C','T');
$pdf->Cell(15,5,utf8_decode('Turno 1'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Tueno 2'),1,0,'C','T');
$pdf->Cell(15,5,utf8_decode('Turno 3'),1,0,'C','T');
$pdf->Cell(60,5,utf8_decode('Parada'),1,0,'C','T');
$pdf->Cell(70,5,utf8_decode('Referencia'),1,0,'C','T');
$pdf->Cell(14,5,utf8_decode('Paradas'),1,1,'C','T');

while ($row = mysqli_fetch_assoc($queryr)){
$pdf->Cell(15,5,utf8_decode($row['horario_t1']),1,0,'C');
$pdf->Cell(15,5,utf8_decode($row['horario_t2']),1,0,'C');
$pdf->Cell(15,5,utf8_decode($row['horario_t3']),1,0,'C');
$pdf->Cell(60,5,utf8_decode($row['parada']),1,0,'L');
$pdf->Cell(70,5,utf8_decode($row['referencia']),1,0,'L');
$pdf->Cell(14,5,utf8_decode($row['no_paradas']),1,1,'C');    
}

$pdf->Ln(5);
$pdf->Cell(20,5,utf8_decode('Operador:'),1,0,'L', 'T');
$pdf->Cell(109,5,utf8_decode($operador),1,0,'L');
$pdf->Cell(20,5,utf8_decode('Teléfono:'),1,0,'C', 'T');
$pdf->Cell(40,5,utf8_decode(''),1,1,'C');
$pdf->Cell(20,5,utf8_decode('Supervisor:'),1,0,'L', 'T');
$pdf->Cell(109,5,utf8_decode($supervisor),1,0,'L');
$pdf->Cell(20,5,utf8_decode('Teléfono:'),1,0,'C', 'T');
$pdf->Cell(40,5,utf8_decode(''),1,1,'C');
$pdf->Ln(5);
$pdf->Image("$imagen",10,165,189,100,'jpg');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>