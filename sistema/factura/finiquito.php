<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$idfiniquito=$_REQUEST['id'];
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

$query = mysqli_query($conection,"SELECT id, no_empleado, empleado, fecha, fecha_ingreso, fecha_baja, antiguedad, dias_trabajados, diasultima_semana, salario_diario, vacaciones, proproporcional_vacaciones, prima_vacacional, dias_aguinaldo, proporcinal_aguinaldo, importe_ultimasemana, importe_agunaldo, importe_viajes, importe_vacaciones, importe_primavac, otras_compensaciones, importe_total, importe_deudas, neto_pagar FROM finiquitos WHERE id= $idfiniquito");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id             = $entrada['id'];
    $no_empl        = $entrada['no_empleado'];
    $empleado       = $entrada['empleado'];
    $fecha          = $entrada['fecha'];
    $fcha_ingreso   = $entrada['fecha_ingreso'];
    $fcha_baja      = $entrada['fecha_baja'];
    $antiguedad     = $entrada['antiguedad'];
    $dias_trab      = $entrada['dias_trabajados'];
    $dias_ultsem    = $entrada['diasultima_semana'];
    $salario_diario = $entrada['salario_diario'];
    $vacaciones     = $entrada['vacaciones'];
    $prop_vacacion  = $entrada['proproporcional_vacaciones'];
    $prima_vacacion = $entrada['prima_vacacional'];
    $dias_aguinaldo = $entrada['dias_aguinaldo'];
    $prop_aguinaldo = $entrada['proporcinal_aguinaldo'];
    $imp_semana     = $entrada['importe_ultimasemana'];
    $imp_aguinaldo  = $entrada['importe_agunaldo'];
    $imp_viajes     = $entrada['importe_viajes'];
    $imp_vacaciones = $entrada['importe_vacaciones'];
    $imp_primavac   = $entrada['importe_primavac'];
    $otras_compens  = $entrada['otras_compensaciones'];
    $imp_total      = $entrada['importe_total'];
    $imp_deudas     = $entrada['importe_deudas'];
    $imp_neto       = $entrada['neto_pagar'];
    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;  
   
//Logo
$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','B',14);
//Encabezado
//$this->Cell(50,15,'',0,0,'r');
$this->SetFillColor(231,233,238);
$this->SetTextcolor(6,22,54);
$this->Cell(189,10,'TRANSVIVE, S DE RL DE CV',0,1,'C');


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
$idfiniquito=$_REQUEST['id'];
$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT id, no_empleado, empleado, fecha, fecha_ingreso, fecha_baja, antiguedad, dias_trabajados, diasultima_semana, salario_diario, vacaciones, proproporcional_vacaciones, prima_vacacional, dias_aguinaldo, proporcinal_aguinaldo, importe_ultimasemana, importe_agunaldo, importe_viajes, importe_vacaciones, importe_primavac, otras_compensaciones, importe_total, importe_deudas, neto_pagar FROM finiquitos WHERE id= $idfiniquito" );
$result = mysqli_num_rows($query);


while ($row = mysqli_fetch_assoc($query)){

//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id             = $row['id'];
    $no_empl        = $row['no_empleado'];
    $empleado       = $row['empleado'];
    $fecha          = $row['fecha'];
    $fcha_ingreso   = $row['fecha_ingreso'];
    $fcha_baja      = $row['fecha_baja'];
    $antiguedad     = $row['antiguedad'];
    $dias_trab      = $row['dias_trabajados'];
    $dias_ultsem    = $row['diasultima_semana'];
    $salario_diario = $row['salario_diario'];
    $vacaciones     = $row['vacaciones'];
    $prop_vacacion  = $row['proproporcional_vacaciones'];
    $prima_vacacion = $row['prima_vacacional'];
    $dias_aguinaldo = $row['dias_aguinaldo'];
    $prop_aguinaldo = $row['proporcinal_aguinaldo'];
    $imp_semana     = $row['importe_ultimasemana'];
    $imp_aguinaldo  = $row['importe_agunaldo'];
    $imp_viajes     = $row['importe_viajes'];
    $imp_vacaciones = $row['importe_vacaciones'];
    $imp_primavac   = $row['importe_primavac'];
    $otras_compens  = $row['otras_compensaciones'];
    $imp_total      = $row['importe_total'];
    $imp_deudas     = $row['importe_deudas'];
    $imp_neto       = $row['neto_pagar'];

    $newDate = date("d-m-Y", strtotime($fcha_ingreso)); 
    $newDate2 = date("d-m-Y", strtotime($fcha_baja)); 

    //$imagen="../img/routers/".$entrada['foto'];
   

//ciclo de repeticion celdas
//Consulta para cuerpo tabla

$pdf->Ln(5);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('FINIQUITO:'),0,1,'C', 'T');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,5,utf8_decode($no_empl. ' '. $empleado),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln(8);
//$pdf->Cell(90,5,utf8_decode('Concepto'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Fecha de Ingreso:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,$newDate,0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Fecha de Baja:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,$newDate2,0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Antiguedad:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,$antiguedad,0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Días Trabajados:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,$dias_trab,0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->ln(5);
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Días Trabajados (Ultima Semana):'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,$dias_ultsem,0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(90,5,utf8_decode('Salario Semanal:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,'0.00',0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Salario Diario:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($salario_diario,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->ln(2);
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Vacaciones:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,$vacaciones,0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Días Proporcionales Vacaciones:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($prop_vacacion,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('% Prima Vacacional:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($prima_vacacion,0),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->ln(2);
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Aguinaldo:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format(15,0),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Días Proporcionales Aguinaldo:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($prop_aguinaldo,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');
$pdf->ln(5);

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode(''),0,0,'R');
$pdf->Cell(50,5,utf8_decode('Concepto: '),0,0,'C','T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Importe:'),0,0,'C','T');
$pdf->Cell(50,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Ultima Semana:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_semana,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Aguinaldo:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_aguinaldo,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Viajes:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_viajes,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Vacaciones:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_vacaciones,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Prima Vacacional:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_primavac,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Otras Compensaciones:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($otras_compens,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode(''),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,'__________________',0,0,'C');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Subtotal:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_total,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->SetFont('Arial','B',8);
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Adeudos:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_deudas,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode(''),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,'__________________',0,0,'C');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');

$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
//$pdf->Cell(90,5,utf8_decode('Importe'),0,1,'C', 'T');
$pdf->Cell(90,5,utf8_decode('Total:'),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(20,5,number_format($imp_neto,2),0,0,'R');
$pdf->Cell(70,5,utf8_decode(''),0,1,'C');



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