<?php

include('../fpdf/fpdf.php');
require '../includes/conversor.php';

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
//Consulta sql encabezado
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


   
   
//Logo
//*$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','',10);
//Encabezado
//$this->Cell(50,15,'',0,0,'r');
$this->SetFillColor(231,233,238);
$this->SetTextcolor(6,22,54);
//$this->Cell(189,10,$semana,0,1,'C');
$this->SetFont('Arial','B',10);
$this->Cell(189,5,'Concentado de Nomina'. ' '. $fecha_ini,0,1,'C');


//$this->Cell(1,5,'',1,0,'L');
//Encabezado de la tabla
//$this->Cell(190,5,'DETALLE DE LA ENTRADA',1,1,'C');
}



function Footer()
{

$this->SetY(-10);
$this->SetTextcolor(0,0,0);
$this->SetFont('Arial','I',8);

$this->Cell(0,10,utf8_decode(''),0,0,'C');
$this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');

}
}
//Impresion 

$idoentrada=$_REQUEST['id'];
$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
//Variables para consulta
include('../../conexion.php');
//Consulta sql encabezado
//Consulta sql encabezado
$pdf=new PDF();
$pdf->AddPage('portrait','letter');

if ($fecha_ini === "Semanal") {
    $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini2 = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 9);
$finfin = strrpos($idoentrada, "id3"); 
$final3 = $finfin + 4;
$fecha_ejercicio = substr($idoentrada, $final3, 10);
//$pdf->Cell(189,5,'Del :'. ' '. $fecha_ini2 . ' '. 'Al:'. ' '. $fecha_fin. ' year ' . $fecha_ejercicio ,0,1,'C');
 $query = mysqli_query($conection,"SELECT SUM(dn.viajes_especiales) as especiales, SUM(dn.viajes_contrato) as normales, SUM(dn.bono_categoria) as bonocategoria, SUM(dn.bono_supervisor) as bonosupervisor, SUM(dn.bono_semanal) as bonosemanal, SUM(dn.apoyo_mensual) as apoyomes, SUM(dn.sueldo_adicional) as adicional, SUM(dn.total_especiales) as totalespeciales, SUM(dn.vacaciones) as totalvacaciones, SUM(dn.prima_vacacional) as primavac, SUM(dn.total_vueltas) as totalvueltas, SUM(dn.sueldo_bruto) as sueldobruto, SUM(dn.pago_fiscal) as pagofiscal, SUM(dn.deduccion_fiscal) as deduccionfiscal, SUM(dn.descuento_adeudo) as descuentos, SUM(dn.caja) as cajaahorro, SUM(dn.total_nomina) as totalnomina, SUM(dn.total_general) as totalgral FROM detalle_nomina dn INNER JOIN empleados em ON dn.nombre = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) WHERE dn.no_semana = '$fecha_fin' and em.tipo_nomina = '$fecha_ini2' and yearpago = $fecha_ejercicio GROUP BY dn.no_semana" );
$result = mysqli_num_rows($query);

while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $v_especiales     = $row['especiales'];
    $v_contrato       = $row['normales'];
    $bono_categoria   = $row['bonocategoria'];
    $bono_supervisor  = $row['bonosupervisor'];
    $bono_semanal     = $row['bonosemanal'];
    $apoyo_mensual    = $row['apoyomes'];
    $sueldo_adicional = $row['adicional'];
    $total_especiales = $row['totalespeciales'];
    $total_vacaciones = $row['totalvacaciones'];
    $prima_vacacional = $row['primavac'];
    $total_vueltas    = $row['totalvueltas'];
    $sueldo_bruto     = $row['sueldobruto'];
    $pago_fiscal      = $row['pagofiscal'];
    $deduccion_fiscal = $row['deduccionfiscal'];
    $descuento_adeudo = $row['descuentos'];
    $caja_ahorro      = $row['cajaahorro'];
    $total_nomina     = $row['totalnomina'];
    $total_general    = $row['totalgral'];
   

    //$imagen="../img/routers/".$entrada['foto'];
    $viajestotales = $v_especiales + $v_contrato;
    $numero = $total_general;
    $resultado = numtoletras($numero);
    $total_deducciones = $descuento_adeudo + $caja_ahorro ; 
    $total_fiscal = $pago_fiscal - $deduccion_fiscal ;
    $total_efectivo = $sueldo_bruto - ($pago_fiscal + $descuento_adeudo + $caja_ahorro) ; 

//ciclo de repeticion celdas
//Consulta para cuerpo tabla



$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(33,5,'Periodo:',0,0,'L');
$pdf->Cell(33,5,$fecha_fin,0,0,'R');
$pdf->Cell(123,5,'',0,1,'L');
$pdf->Cell(33,5,utf8_decode('Viajes Especiales: '),0,0,'L');
$pdf->Cell(33,5,number_format($v_especiales,2),0,0,'R');
$pdf->Cell(123,5,'',0,1,'L');
$pdf->Cell(33,5,utf8_decode('Viajes Contrato: '),0,0,'L');
$pdf->Cell(33,5,number_format($v_contrato,2),0,0,'R');
$pdf->Cell(123,5,'',0,1,'L');
$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
//$pdf->Cell(189,5,utf8_decode('Precepciones:'),0,1,'C', 'T');
//$pdf->SetFont('Arial','B',8);
//$pdf->Cell(189,5,utf8_decode($fecha_ini),0,1,'C');
$pdf->SetFont('Arial','',9);


$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,5,utf8_decode('Precepciones:'),0,1,'C', 'T');
$pdf->Ln(3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Bono Categoria'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($bono_categoria,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Bono Supervisor'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($bono_supervisor,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Bono Semanal'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($bono_semanal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Apoyo Mensual'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($apoyo_mensual,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Sueldo Adicional'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($sueldo_adicional,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(3);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Especiales'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_especiales,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Contrato'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_vueltas,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Vacaciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_vacaciones,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Prima Vacacional'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($prima_vacacional,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Sueldo Bruto'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($sueldo_bruto,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Pago Fiscal'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($pago_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Precepciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($sueldo_bruto,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Deducciones:'),0,1,'C', 'T');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Descuentos/Adeudos'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($descuento_adeudo,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Caja de Ahorro'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($caja_ahorro,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Deducciones Fiscales'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($deduccion_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Deducciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_deducciones,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Totales:'),0,1,'C', 'T');
$pdf->SetFont('Arial','B',9);
$pdf->Ln(3);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Fiscal'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Efectivo'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_efectivo,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');


$pdf->SetFont('Arial','',7.5);


$pdf->Ln(5);
//$pdf->Cell(100,5,utf8_decode($resultado),0,0,'L');
//$pdf->SetFont('Arial','',8);
//$pdf->Cell(59,5,utf8_decode('__________________________'),0,1,'R');
//$pdf->Cell(143,5,utf8_decode('Firma'),0,1,'R');
//$pdf->Ln(5);  
}

}else {

if ($fecha_ini === "Quincenal") {
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini2 = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin2 = substr($idoentrada, $fin2, 11);
$finfin = strrpos($idoentrada, "id3"); 
$final3 = $finfin + 4;
$fecha_ejercicio2 = substr($idoentrada, $final3, 10);
//$pdf->Cell(189,5,'De:'. ' '. $fecha_ini2 . ' '. 'Al:'. ' '. $fecha_fin2. ' year ' . $fecha_ejercicio2 ,0,1,'C');

$queryq = mysqli_query($conection,"SELECT SUM(dn.sueldo_bruto) as sdo_bruto, SUM(dn.sueldo_total) as sdo_total, SUM(dn.bono) as bonocategoria, SUM(dn.bono_mensual) as bonosupervisor, SUM(dn.apoyo_alimenticio) as apoyomes, SUM(dn.subtotal) as tot_subtotal, SUM(dn.caja_ahorro) as caja, SUM(dn.prestamo_deuda) as adeudos, SUM(dn.vacaciones) as totalvacaciones, SUM(dn.prima_vacacional) as primavac, SUM(dn.sueldo_quincenal) as sdo_quincenal, SUM(dn.sueldo_fiscal) as sdo_fiscal, SUM(dn.impuesto_fiscal) as impuestofiscal, SUM(dn.total_efectivo) as tot_efectivo, SUM(dn.deposito) as tot_deposito FROM detalle_temp_nominaquincena dn  WHERE dn.no_quincena = '$fecha_fin2' and dn.yearpago = $fecha_ejercicio2 GROUP BY dn.no_quincena" );
$resultq = mysqli_num_rows($queryq);
while ($row = mysqli_fetch_assoc($queryq)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $sueldo_bruto     = $row['sdo_bruto'];
    $sueldo_total     = $row['sdo_total'];
    $bono_categoria   = $row['bonocategoria'];
    $bono_supervisor  = $row['bonosupervisor'];
    $apoyo_mensual    = $row['apoyomes'];
    $subtotal         = $row['tot_subtotal'];
    $caja             = $row['caja'];
    $adeudos          = $row['adeudos'];
    $total_vacacional = $row['totalvacaciones'];
    $prima_vacacional = $row['primavac'];
    $sueldo_quincenal = $row['sdo_quincenal'];
    $sueldo_fiscal    = $row['sdo_fiscal'];
    $deduccion_fiscal = $row['impuestofiscal'];
    $total_efectivo   = $row['tot_efectivo'];
    $total_deposito   = $row['tot_deposito'];
    $total_deducciones = $caja + $adeudos + $deduccion_fiscal;

$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(33,5,'Periodo:',0,0,'L');
$pdf->Cell(33,5,$fecha_fin2,0,0,'R');
$pdf->Cell(123,5,'',0,1,'L');
$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
//$pdf->Cell(189,5,utf8_decode('Precepciones:'),0,1,'C', 'T');
//$pdf->SetFont('Arial','B',8);
//$pdf->Cell(189,5,utf8_decode($fecha_ini),0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,5,utf8_decode('Precepciones:'),0,1,'C', 'T');
$pdf->Ln(3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Sueldo Bruto'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($sueldo_bruto,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Bono Categoria'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($bono_categoria,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Bono Supervisor'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($bono_supervisor,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Apoyo Mensual'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($apoyo_mensual,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Vacaciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_vacacional,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Prima Vacacional'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($prima_vacacional,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Precepciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($subtotal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,5,utf8_decode('Deducciones:'),0,1,'C', 'T');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Descuentos/Adeudos'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($adeudos,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Caja de Ahorro'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($caja,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Deducciones Fiscales'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($deduccion_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Deducciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_deducciones,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Totales:'),0,1,'C', 'T');
$pdf->SetFont('Arial','B',9);
$pdf->Ln(3);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Fiscal'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($sueldo_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Deposito'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_deposito,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Efectivo'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_efectivo,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
}


}else {
if ($fecha_ini === "Especial") {
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini3 = substr($idoentrada, 0,  $fin);
$fin3 = $fin + 4;
$fecha_fin3 = substr($idoentrada, $fin3, 10);
$finfin2 = strrpos($idoentrada, "id3"); 
$final4 = $finfin2 + 4;
$fecha_ejercicio3 = substr($idoentrada, $final4, 10);
$pdf->Cell(189,5,'AGUINALDO',0,1,'C');
$querye = mysqli_query($conection,"SELECT fecha_pago, year_pago, SUM(dn.importe_aguinaldo) as imp_aguinaldo, SUM(dn.importe_fiscal) as imp_fiscal, SUM(dn.impuesto_fiscal) as impuestofiscal, SUM(dn.deposito) as tot_deposito, SUM(dn.pago_efectivo) as total_efectivo FROM detalle_temp_nomespecial dn  WHERE dn.fecha_pago = '$fecha_fin3' and dn.year_pago = $fecha_ejercicio3" );
$resulte = mysqli_num_rows($querye);
while ($row = mysqli_fetch_assoc($querye)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $fecha_pago        = $row['fecha_pago'];
    $year_pago         = $row['year_pago'];
    $importe_aguinaldo = $row['imp_aguinaldo'];
    $importe_fiscal    = $row['imp_fiscal'];
    $impuesto_fiscal   = $row['impuestofiscal'];
    $total_deposito    = $row['tot_deposito'];
    $total_efectivo    = $row['total_efectivo'];

    $newDate = date("d-m-Y", strtotime($row['fecha_pago'])); 
    $newDate2 = date("d-m-Y", strtotime($row['year_pago'])); 
    
    //$total_deposito   = $row['tot_deposito'];
    //$total_deducciones = $caja + $adeudos + $deduccion_fiscal;

$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(33,5,'Fecha de Pago:',0,0,'L');
$pdf->Cell(33,5,$fecha_fin3,0,0,'R');
$pdf->Cell(123,5,'',0,1,'L');
$pdf->Cell(33,5,utf8_decode('Año de Pago:'),0,0,'L');
$pdf->Cell(33,5,$year_pago,0,0,'R');
$pdf->Cell(123,5,'',0,1,'L');
$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
//$pdf->Cell(189,5,utf8_decode('Precepciones:'),0,1,'C', 'T');
//$pdf->SetFont('Arial','B',8);
//$pdf->Cell(189,5,utf8_decode($fecha_ini),0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,5,utf8_decode('Precepciones:'),0,1,'C', 'T');
$pdf->Ln(3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Importe Aguinaldo'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($importe_aguinaldo,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Importe Fiscal'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($importe_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Precepciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($importe_aguinaldo,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,5,utf8_decode('Deducciones:'),0,1,'C', 'T');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Impuesto Fiscal'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($impuesto_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Deducciones'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($impuesto_fiscal,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Totales:'),0,1,'C', 'T');
$pdf->SetFont('Arial','B',9);
$pdf->Ln(3);
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Deposito'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_deposito,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
$pdf->Cell(47,5,utf8_decode(''),0,0,'L');
$pdf->Cell(45,5,utf8_decode('Total Efectivo'),0,0,'L');
$pdf->Cell(5,5,utf8_decode(''),0,0,'L');
$pdf->Cell(25,5,number_format($total_efectivo,2),0,0,'R');
$pdf->Cell(67,5,utf8_decode(''),0,1,'L');
}

}

}
}
//$pdf->Image("$imagen",10,165,189,100,'png');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>