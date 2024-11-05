<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

//$fin = strrpos($idoentrada, "id2");
//$final = $fin - 1;
//$fecha_ini = substr($idoentrada, 0,  $fin);
//$fin2 = $fin + 4;
//$fecha_fin = substr($idoentrada, $fin2, 10);
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


    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
   

  

   
   
//Logo
//*$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','',10);
//Encabezado
//$this->Cell(50,15,'',0,0,'r');
$this->SetFillColor(231,233,238);
$this->SetTextcolor(6,22,54);
$this->Cell(240,10,'Reporte de Rendimiento por Unidad',0,1,'C');
$this->SetFont('Arial','',9);
$this->Cell(240,5,'Unidad:'. ' '. $idoentrada,0,1,'C');

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
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 10);
//Consulta sql encabezado


$pdf=new PDF();
$pdf->AddPage('landscape','letter');
$query = mysqli_query($conection, "SELECT fecha, nounidad, placas, kmactual_cargar, tipo_combustible, litros, precio, operador, supervisor  FROM carga_combustible WHERE nounidad = '$idoentrada' order by  fecha" );
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);

$kmetraje  = $entrada['kmactual_cargar'];
$litrosant = $entrada['litros'];

   

    //$imagen="../img/routers/".$entrada['foto'];
    // $viajestotales = $vespeciales + $vcontratos;

//ciclo de repeticion celdas
//Consulta para cuerpo tabla


$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('Kilometraje Inicial: '.number_format($kmetraje) ),0,0,'L');
$pdf->Ln(10);


$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,5,utf8_decode('Fecha'),1,0,'C', 'T');
$pdf->Cell(15,5,utf8_decode('No.Eco.'),1,0,'C', 'T');
$pdf->Cell(60,5,utf8_decode('Operador'),1,0,'C', 'T');
$pdf->Cell(15,5,utf8_decode('Placas'),1,0,'C', 'T');
$pdf->Cell(15,5,utf8_decode('Km'),1,0,'C', 'T');
$pdf->Cell(20,5,utf8_decode('Combustible'),1,0,'C', 'T');
$pdf->Cell(12,5,utf8_decode('Litros'),1,0,'C', 'T');
$pdf->Cell(12,5,utf8_decode('Precio'),1,0,'C', 'T');
$pdf->Cell(22,5,utf8_decode('KM Recorridos'),1,0,'C', 'T');
$pdf->Cell(18,5,utf8_decode('Rendimiento'),1,0,'C', 'T');
$pdf->Cell(45,5,utf8_decode('Supervisor'),1,1,'C', 'T');
$pdf->SetFont('Arial','',8);
$totimporte = $kmetraje;
$litrosantes  = $litrosant;
$litrostot    = 0;
$kmrecorre    = 0;


while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $fecha       = $row['fecha'];
    $unidad      = $row['nounidad'];
    $operador    = $row['operador'];
    $placas      = $row['placas'];
    $kmactual    = $row['kmactual_cargar'];
    $combustible = $row['tipo_combustible'];
    $litros      = $row['litros'];
    $precio      = $row['precio'];
    $supervisor  = $row['supervisor'];

    $newDate = date("d-m-Y", strtotime($fecha)); 
    $kmrecorre  = $kmactual - $totimporte;
    $litrostot  = $kmrecorre / $litros;
    

$pdf->Cell(20,5,($newDate),1,0,'C');
$pdf->Cell(15,5,utf8_decode($unidad),1,0,'L');
$pdf->Cell(60,5,utf8_decode($operador),1,0,'L');
$pdf->Cell(15,5,($placas),1,0,'L');
$pdf->Cell(15,5,number_format($kmactual),1,0,'R');
$pdf->Cell(20,5,utf8_decode($combustible),1,0,'C');
$pdf->Cell(12,5,number_format($litros,2),1,0,'R');
$pdf->Cell(12,5,number_format($precio,2),1,0,'R');
$pdf->Cell(22,5,number_format($kmrecorre,2),1,0,'R');
$pdf->Cell(18,5,number_format($litrostot,2),1,0,'R');
$pdf->Cell(45,5,utf8_decode($supervisor),1,1,'L');
$kmrecorre = 0;
$litrostot = 0;
$totimporte  = $row['kmactual_cargar']; 
$litrosantes = $row['litros'];
}

//$pdf->Image("$imagen",10,165,189,100,'png');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>