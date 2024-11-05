<?php

include('../fpdf/fpdf.php');
require '../includes/conversor.php';

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta

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

$query = mysqli_query($conection,"SELECT id, noempleado, CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as empleado, fecha_baja, motivo_baja, recontratable, pqrecontrata FROM empleados WHERE estatus = 0");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id         = $entrada['id'];
    $no_empl    = $entrada['noempleado'];
    $empleado   = $entrada['empleado'];
    $fcha_baja  = $entrada['fecha_baja'];
    $mot_baja   = $entrada['motivo_baja'];
    $esrecontra = $entrada['recontratable'];
    $pqesrecont = $entrada['pqrecontrata'];
   

   
    $newDate = date("d-m-Y", strtotime($fcha_baja)); 
    
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
$this->Cell(189,10,'REPORTE DE BAJAS DE EMPLEADOS',0,1,'C');
$this->SetFont('Arial','',9);
//$this->Cell(189,5,'Del:'. ' '. $newDate . ' '. 'Al:'. ' '. $newDate2 ,0,1,'C');


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
$this->Cell(0,10,utf8_decode(''),0,0,'C');
$this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');

}
}
//Impresion 
include('../../conexion.php');


//Consulta sql encabezado
$pdf=new PDF();
$pdf->AddPage('portrait','letter');

 
$query = mysqli_query($conection,"SELECT id, noempleado, CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as empleado, fecha_baja, motivo_baja, recontratable, pqrecontrata FROM empleados WHERE estatus = 0" );
$result = mysqli_num_rows($query);




while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id         = $row['id'];
    $no_empl    = $row['noempleado'];
    $empleado   = $row['empleado'];
    $fcha_baja  = $row['fecha_baja'];
    $mot_baja   = $row['motivo_baja'];
    $esrecontra = $row['recontratable'];
    $pqesrecont = $row['pqrecontrata'];

    $new_Date = date("d-m-Y", strtotime($row['fecha_baja'])); 
    //$newDate2 = date("d-m-Y", strtotime($row['dia_final'])); 

    //$imagen="../img/routers/".$entrada['foto'];
    //$viajestotales = $vespeciales + $vcontratos;
    //$numero = $totgeneral;
    //$resultado = numtoletras($numero);

//ciclo de repeticion celdas
//Consulta para cuerpo tabla


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextcolor(0,0,0);

$pdf->Cell(189,5,utf8_decode('Empleado: '.$no_empl. ' '. $empleado ),0,1,'L', 'T');
$pdf->SetFont('Arial','B',8);
//$pdf->Cell(189,5,utf8_decode($nosemana),0,1,'C');
//$pdf->Ln(5);
//$pdf->SetFont('Arial','B',8);
$pdf->Ln(5);
$pdf->SetFont('Arial','',9);
$pdf->Cell(26,5,utf8_decode('Baja:'),0,0,'L');
$pdf->Cell(20,5,$new_Date,0,0,'C');
$pdf->Cell(153,5,utf8_decode($mot_baja),0,1,'L');
$pdf->Cell(26,5,utf8_decode('Recontratable:'),0,0,'L');
$pdf->Cell(20,5,$esrecontra,0,0,'C');
$pdf->Cell(153,5,utf8_decode($pqesrecont),0,1,'L');
$pdf->Ln(7);





}

//$pdf->Image("$imagen",10,165,189,100,'png');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>