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

$fin = strrpos($idoentrada, "*");
$final = $fin - 1;
$cliente = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 8;
$nosemana = substr($idoentrada, $fin2, 9);
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

$query = mysqli_query($conection,"SELECT id, semana, cliente, unidad, numero_unidades, hora_inicio, direccion, hora_fin, destino, notas, notas_operador, costo_viaje, estatus FROM registro_viajes WHERE cliente= '$cliente' and semana = '$nosemana'");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id         = $entrada['id'];
    $semana     = $entrada['semana'];
    $no_empl    = $entrada['cliente'];
    $empleado   = $entrada['unidad'];
    $cargo      = $entrada['numero_unidades'];
    $tot_espc   = $entrada['hora_inicio'];
    $tot_normal = $entrada['direccion'];
    $fcha_ini   = $entrada['hora_fin'];
    $fcha_fin   = $entrada['destino'];

   
    //$newDate = date("d-m-Y", strtotime($fcha_ini)); 
    //$newDate2 = date("d-m-Y", strtotime($fcha_fin)); 
    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
   

  

   
   
//Logo
$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','',10);
//Encabezado
$this->Cell(189,15,'Reporte de Viajes por Cliente',0,1,'C');
$this->SetFillColor(231,233,238);
$this->SetTextcolor(6,22,54);
//$this->Cell(189,10,'Semana:'. ' '. $semana,0,1,'C');
//$this->SetFont('Arial','',9);
//$this->Cell(189,5,'Del:'. ' '. $cliente . ' '. 'Al:'. ' '. $nosemana ,0,1,'C');

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
$fin = strrpos($idoentrada, "*");
$final = $fin - 1;
$cliente = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 8;
$nosemana = substr($idoentrada, $fin2, 9);
$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT id, semana, cliente, unidad, numero_unidades, hora_inicio, direccion, hora_fin, destino, notas, notas_operador, costo_viaje, estatus FROM registro_viajes WHERE cliente= '$cliente' and semana = '$nosemana' and estatus = 2" );
$result = mysqli_num_rows($query);


while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id         = $row['id'];
    $semana     = $row['semana'];
    $cliente    = $row['cliente'];
    $unidad     = $row['unidad'];
    $numerounid = $row['numero_unidades'];
    $hora_ini   = $row['hora_inicio'];
    $direccion  = $row['direccion'];
    $hora_fin   = $row['hora_fin'];
    $destino    = $row['destino'];
    $notas      = $row['notas'];
    $notas_opd  = $row['notas_operador'];
    $costo      = $row['costo_viaje'];

    //$imagen="../img/routers/".$entrada['foto'];
    //$viajestotales = $vespeciales + $vcontratos;

//ciclo de repeticion celdas
//Consulta para cuerpo tabla

$pdf->Ln(1);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('Detalle del Viaje:'),0,1,'C', 'T');
$pdf->Ln(1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(66,5,utf8_decode('Cliente:'. ' '. $cliente),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(189,5,utf8_decode('Origen Viaje:'. ' '. $direccion),0,1,'L');
$pdf->Cell(189,5,utf8_decode('Destino:'. ' '. $destino),0,1,'L');
$pdf->Ln(10);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Sueldo Bruto'),0,0,'L');
$pdf->Cell(50,5,number_format(10,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deducciones Fiscales:'),0,0,'L');
$pdf->Cell(50,5,number_format(10,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total General'),0,0,'L');
$pdf->Cell(50,5,number_format(10,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Caja de Ahorro:'),0,0,'L');
$pdf->Cell(50,5,number_format(10,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Nomina'),0,0,'L');
$pdf->Cell(50,5,number_format(10,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deudas Generales:'),0,0,'L');
$pdf->Cell(50,5,number_format(10,2),0,1,'R');

$pdf->Ln(20);
$pdf->Cell(159,5,utf8_decode('__________________________'),0,1,'R');
$pdf->Cell(143,5,utf8_decode('Firma'),0,1,'R');
$pdf->Ln(35);

}

//$pdf->Image("$imagen",10,165,189,100,'png');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>