<?php

include('../fpdf/fpdf.php');
require '../includes/conversor.php';

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
    function Header()
    {
        //Variables para consulta
        $idoentrada = $_REQUEST['id'];
        $nosemana = $_REQUEST['id2'];
        $numero_semana = intval(str_replace('Semana ', '', $nosemana));
        $anio = intval($_REQUEST['id3']);
        // var_dump($_REQUEST, $numero_semana, $idoentrada);
        
        //Determinamos la fecha correspondiente al inicio de la semana
        $fecha_inicio = new DateTime();
        $fecha_inicio->setISODate($anio, $numero_semana, 1);
        
        //Determinamos la fecha final de la semana
        $fecha_fin = new DateTime();
        $fecha_fin->setISODate($anio, $numero_semana, 7);
        
        // $fin = strrpos($idoentrada, "id2");
        // $final = $fin - 1;
        // $fecha_ini = substr($idoentrada, 0,  $fin);
        // $fecha_ejercicio = substr($idoentrada, $final3, 10);
        // $fin2 = $fin + 4;
        // $fecha_fin = substr($idoentrada, $fin2, 9);
        // $finfin = strrpos($idoentrada, "id3"); 
        // $final3 = $finfin + 4;
        //Consulta sql encabezado
        //Consulta sql encabezado
        
        include('../../conexion.php');
        //Agregamos la libreria para genera códigos QR
        //require "phpqrcode/qrlib.php";    
    
        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';
    
        //Si no existe la carpeta la creamos
        if (!file_exists($dir)){
            mkdir($dir);
        }
    
        //Declaramos la ruta y nombre del archivo a generar
        $filename = $dir.'test.png';

        //Parametros de Condiguración


        $conection->set_charset('utf8');

        
       $stmt = $conection->prepare("SELECT * FROM historico_nomina WHERE semana = ? AND anio = ?");
       $stmt->bind_param("ii", $numero_semana, $anio);
       if (!$stmt->execute()) {
        echo $stmt->error;
       }else{
        $resultado = $stmt->get_result();
        // var_dump($numero_filas);
       }
       if($resultado && $resultado->num_rows > 0){
        $entrada = $resultado->fetch_assoc();
       }else{
        $entrada = null;
       }
        //$encabezado = mysql_fetch_array($query1, $conexion);
        //Variables para encabezado
        // var_dump( $entrada);
        $id         = $entrada['id'];
        $semana     = $entrada['semana'];
        $no_empl    = $entrada['noempleado'];
        $empleado   = $entrada['nombre'];
        $cargo      = $entrada['cargo'];
        $tot_vueltas   = $entrada['total_vueltas'];
        $fcha_ini   = $fecha_inicio->format('d-m-Y');
        $fcha_final   = $fecha_fin->format('d-m-Y');
        //Logo
        $this->Image("../../images/transvive.png",12,11,48,13,"png",0);
        //$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
        //Arial bold 15
        $this->SetFont('Arial','',10);
        //Encabezado
        //$this->Cell(50,15,'',0,0,'r');
        $this->SetFillColor(231,233,238);
        $this->SetTextcolor(6,22,54);
        //$this->Cell(189,10,$semana,0,1,'C');
        $this->SetFont('Arial','',9);
        //$this->Cell(189,5,'Del:'. ' '. $fecha_ini . ' '. 'Al:'. ' '. $fecha_fin. ' year ' . $fecha_ejercicio ,0,1,'C');


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
//Variables para consulta
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

// $fin = strrpos($idoentrada, "id2");
// $final = $fin - 1;
// $fecha_ini = substr($idoentrada, 0,  $fin);
// $fin2 = $fin + 4;
// $fecha_fin = substr($idoentrada, $fin2, 9);
// $finfin = strrpos($idoentrada, "id3"); 
// $final3 = $finfin + 4;
// $fecha_ejercicio = substr($idoentrada, $final3, 10);
//Consulta sql encabezado
//Consulta sql encabezado
$pdf=new PDF();
$pdf->AddPage('portrait','letter');

if ($idoentrada = "Semanal") {
    $nosemana = $_REQUEST['id2'];
    $numero_semana = intval(str_replace('Semana ', '', $nosemana));
    $anio = intval($_REQUEST['id3']);

    $query = mysqli_query($conection,"SELECT * FROM historico_nomina WHERE semana =  $numero_semana and anio = $anio order by noempleado" );
    $result = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);

    var_dump($data);


while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id          = $row['id'];
    $nosemana    = $row['semana'];
    $noempleado  = $row['noempleado'];
    $nombre      = $row['nombre'];
    $cargo       = $row['cargo'];
    $imss        = intval($row['imss']) == 1 ? 'ASEGURADO' : 'NO ASEGURADO';
    $total_vueltas = $row['total_vueltas'];
    $sueldo_vueltas = $row['sueldo_bruto'];
    $dedfiscal   = $row['deduccion_fiscal'];
    $totgeneral  = $row['sueldo_bruto'] + $row['bono_semanal'] + $row['bono_supervisor'] + $row['bono_categoria'] + $row['sueldo_adicional'] + $row['apoyo_mes'];
    $cajaahorro  = $row['caja_ahorro'];
    $totnomina   = $row['total_nomina'];
    $dedgeneral  = $row['descuento_adeudo'];
    $bonocategoria  = $row['bono_categoria'];
    $bonosupervisor = $row['bono_supervisor'];
    $adeudo = $row['descuento_adeudo'];
    $bonosemanal = $row['bono_semanal'];
    $apoyomensual = $row['apoyo_mensual'];
    $sdoadicional = $row['sueldo_adicional'];
    $totespeciales = $row['total_especiales'];
    $totcontrato = $row['total_vueltas'];
    $primavac = $row['prima_vacacional'];
    $vacaciones = $row['vacaciones'];
    $pagofiscal = $row['pago_fiscal'];

    $newDate = date("d-m-Y", strtotime($row['dia_inicial'])); 
    $newDate2 = date("d-m-Y", strtotime($row['dia_final'])); 

    //$imagen="../img/routers/".$entrada['foto'];
    $viajestotales = $vespeciales + $vcontratos;
    $numero = $totgeneral;
    $resultado = numtoletras($numero);

//ciclo de repeticion celdas
//Consulta para cuerpo tabla


if ($imss == 'ASEGURADO') {
    // code...

$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('Recibo de Pago:'),0,1,'C', 'T');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode($nosemana),0,1,'C');
//$pdf->Ln(5);
//$pdf->SetFont('Arial','B',8);
$pdf->Cell(66,5,utf8_decode($noempleado. ' '. $nombre),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(66,5,utf8_decode('Periodo de Pago'),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(66,5,utf8_decode('No. Vueltas:'. ' '. $viajestotales),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Del:'),0,0,'R');
$pdf->Cell(36,5,$newDate,0,1,'C');
$pdf->Cell(66,5,'',0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Al:'),0,0,'R');
$pdf->Cell(36,5,$newDate2,0,1,'C');
$pdf->Ln(1);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Bono Categoria'),0,0,'L');
$pdf->Cell(50,5,number_format($bonocategoria,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deducciones Adeudos:'),0,0,'L');
$pdf->Cell(50,5,number_format($adeudo,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Bono Supervisor'),0,0,'L');
$pdf->Cell(50,5,number_format($bonosupervisor,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Caja de Ahorro:'),0,0,'L');
$pdf->Cell(50,5,number_format($cajaahorro,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Bono Semanal'),0,0,'L');
$pdf->Cell(50,5,number_format($bonosemanal,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Apoyo Mensual'),0,0,'L');
$pdf->Cell(50,5,number_format($apoyomensual,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Sueldo Adicional'),0,0,'L');
$pdf->Cell(50,5,number_format($sdoadicional,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Especiales'),0,0,'L');
$pdf->Cell(50,5,number_format($totespeciales,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Contrato'),0,0,'L');
$pdf->Cell(50,5,number_format($totcontrato,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Prima Vacacional'),0,0,'L');
$pdf->Cell(50,5,number_format($primavac,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Vacaciones'),0,0,'L');
$pdf->Cell(50,5,number_format($vacaciones,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Sueldo Bruto'),0,0,'L');
$pdf->Cell(50,5,number_format($sueldobruto,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Pago Fiscal'),0,0,'L');
$pdf->Cell(50,5,number_format($pagofiscal,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Impuesto Fiscal'),0,0,'L');
$pdf->Cell(50,5,number_format($dedfiscal,2),0,1,'R');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,utf8_decode('Total Nomina'),0,0,'L');
$pdf->Cell(50,5,number_format($totnomina,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Total General'),0,0,'L');
$pdf->Cell(50,5,number_format($totgeneral,2),0,1,'R');

$pdf->SetFont('Arial','',7.5);
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Recibi la cantidad que señala este recibo de pago, estando conforme con las Precepciones y deducciones descritas. Por lo que no se me adeuda cantidad alguna.'),0,1,'L');

$pdf->Ln(5);
$pdf->Cell(100,5,utf8_decode($resultado),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(59,5,utf8_decode('__________________________'),0,1,'R');
$pdf->Cell(143,5,utf8_decode('Firma'),0,1,'R');
$pdf->Ln(10);  

}else {
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('Recibo de Pago:'),0,1,'C', 'T');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode($nosemana),0,1,'C');
//$pdf->Ln(5);
//$pdf->SetFont('Arial','B',8);
$pdf->Cell(66,5,utf8_decode($noempleado. ' '. $nombre),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(66,5,utf8_decode('Periodo de Pago'),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(66,5,utf8_decode('No. Vueltas:'. ' '. $viajestotales),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Del:'),0,0,'R');
$pdf->Cell(36,5,$newDate,0,1,'C');
$pdf->Cell(66,5,'',0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Al:'),0,0,'R');
$pdf->Cell(36,5,$newDate2,0,1,'C');
$pdf->Ln(1);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Bono Categoria'),0,0,'L');
$pdf->Cell(50,5,number_format($bonocategoria,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deducciones Adeudos:'),0,0,'L');
$pdf->Cell(50,5,number_format($adeudo,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Bono Supervisor'),0,0,'L');
$pdf->Cell(50,5,number_format($bonosupervisor,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Caja de Ahorro:'),0,0,'L');
$pdf->Cell(50,5,number_format($cajaahorro,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Bono Semanal'),0,0,'L');
$pdf->Cell(50,5,number_format($bonosemanal,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Apoyo Mensual'),0,0,'L');
$pdf->Cell(50,5,number_format($apoyomensual,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Sueldo Adicional'),0,0,'L');
$pdf->Cell(50,5,number_format($sdoadicional,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Especiales'),0,0,'L');
$pdf->Cell(50,5,number_format($totespeciales,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Contrato'),0,0,'L');
$pdf->Cell(50,5,number_format($totcontrato,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Prima Vacacional'),0,0,'L');
$pdf->Cell(50,5,number_format($primavac,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Vacaciones'),0,0,'L');
$pdf->Cell(50,5,number_format($vacaciones,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Sueldo Bruto'),0,0,'L');
$pdf->Cell(50,5,number_format($sueldobruto,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Total General'),0,0,'L');
$pdf->Cell(50,5,number_format($totgeneral,2),0,1,'R');

$pdf->SetFont('Arial','',7.5);
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Recibi la cantidad que señala este recibo de pago, estando conforme con las Precepciones y deducciones descritas. Por lo que no se me adeuda cantidad alguna.'),0,1,'L');

$pdf->Ln(5);
$pdf->Cell(100,5,utf8_decode($resultado),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(59,5,utf8_decode('__________________________'),0,1,'R');
$pdf->Cell(143,5,utf8_decode('Firma'),0,1,'R');
$pdf->Ln(10);  
}
}
}
if ($fecha_ini = "Quincenal") {
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin2 = substr($idoentrada, $fin2, 11);
$finfin = strrpos($idoentrada, "id3"); 
$final3 = $finfin + 4;
$fecha_ejercicio2 = substr($idoentrada, $final3, 10);
//$pdf->Cell(189,5,'Del:'. ' '. $fecha_ini . ' '. 'Al:'. ' '. $fecha_fin2. ' year ' . $fecha_ejercicio2 ,0,1,'C');

$query = mysqli_query($conection,"SELECT dn.id, dn.no_quincena, dn.yearpago, dn.no_empleado, dn.nombre, dn.puesto, dn.estatus, dn.sueldo_bruto, dn.sueldo_diario, dn.dias_laborados, dn.sueldo_total, dn.bono, dn.bono_mensual, dn.apoyo_alimenticio, dn.subtotal, dn.caja_ahorro, dn.prestamo_deuda, dn.vacaciones, dn.prima_vacacional, dn.dias_vacaciones, dn.sueldo_quincenal, dn.sueldo_fiscal, dn.impuesto_fiscal, dn.total_efectivo, dn.deposito, sm.dia_inicial, sm.dia_final FROM detalle_temp_nominaquincena dn INNER JOIN quincenas sm ON dn.no_quincena = sm.quincena WHERE dn.no_quincena= '$fecha_fin2' and dn.yearpago = $fecha_ejercicio2 order by dn.no_empleado" );
$result = mysqli_num_rows($query);




while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id              = $row['id'];
    $noquincena      = $row['no_quincena'];
    $aniopago        = $row['yearpago'];
    $noempleado      = $row['no_empleado'];
    $nombre          = $row['nombre'];
    $puesto          = $row['puesto'];
    $estatus         = $row['estatus'];
    $sueldobruto     = $row['sueldo_bruto'];
    $sueldodiario    = $row['sueldo_diario'];
    $diaslaborados   = $row['dias_laborados'];
    $sueldototal     = $row['sueldo_total'];
    $bonosupervisor  = $row['bono'];
    $bonocategoria   = $row['bono_mensual'];
    $apoyomes        = $row['apoyo_alimenticio'];
    $subtotal        = $row['subtotal'];
    $caja_ahorro     = $row['caja_ahorro'];
    $adeudos         = $row['prestamo_deuda'];
    $vacaciones      = $row['vacaciones'];
    $prima_vacacional = $row['prima_vacacional'];
    $dias_vacaciones = $row['dias_vacaciones'];
    $sueldoquincenal = $row['sueldo_quincenal'];
    $sueldofiscal    = $row['sueldo_fiscal'];
    $impuestofiscal  = $row['impuesto_fiscal'];
    $totalefectivo   = $row['total_efectivo'];
    $deposito        = $row['deposito'];
;

    $newDate = date("d-m-Y", strtotime($row['dia_inicial'])); 
    $newDate2 = date("d-m-Y", strtotime($row['dia_final'])); 

    //$imagen="../img/routers/".$entrada['foto'];
    $subtotaldeduce = $caja_ahorro + $adeudos;
    $sueldoapagar = $sueldoquincenal - $impuestofiscal;
    $numero = $sueldoapagar;
    $resultado = numtoletras($numero);

$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('Recibo de Pago:'),0,1,'C', 'T');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode($noquincena),0,1,'C');
//$pdf->Ln(5);
//$pdf->SetFont('Arial','B',8);
$pdf->Cell(66,5,utf8_decode($noempleado. ' '. $nombre),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(66,5,utf8_decode('Periodo de Pago'),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(66,5,utf8_decode('Dias Trabajados:'. ' '. $diaslaborados),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Del:'),0,0,'R');
$pdf->Cell(36,5,$newDate,0,1,'C');
$pdf->Cell(66,5,'Sueldo Diario:'. ' '. $sueldodiario,0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Al:'),0,0,'R');
$pdf->Cell(36,5,$newDate2,0,1,'C');
$pdf->Ln(1);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Sueldo Bruto'),0,0,'L');
$pdf->Cell(50,5,number_format($sueldobruto,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deducciones Adeudos:'),0,0,'L');
$pdf->Cell(50,5,number_format($adeudos,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Bono Categoria'),0,0,'L');
$pdf->Cell(50,5,number_format($bonocategoria,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Caja de Ahorro:'),0,0,'L');
$pdf->Cell(50,5,number_format($caja_ahorro,2),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Bono Supervisor'),0,0,'L');
$pdf->Cell(50,5,number_format($bonosupervisor,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Apoyo Alimenticio'),0,0,'L');
$pdf->Cell(50,5,number_format($apoyomes,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Vacaciones'),0,0,'L');
$pdf->Cell(50,5,number_format($vacaciones,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Prima Vacacional'),0,0,'L');
$pdf->Cell(50,5,number_format($prima_vacacional,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Subtotal'),0,0,'L');
$pdf->Cell(50,5,number_format($subtotal,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Subtotal'),0,0,'L');
$pdf->Cell(50,5,number_format($subtotaldeduce,2),0,1,'R');
$pdf->Ln(1);
$pdf->Cell(40,5,utf8_decode('Sueldo Fiscal'),0,0,'L');
$pdf->Cell(50,5,number_format($sueldofiscal,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Impuesto Fiscal'),0,0,'L');
$pdf->Cell(50,5,number_format($impuestofiscal,2),0,1,'R');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,utf8_decode('Sueldo Quincenal'),0,0,'L');
$pdf->Cell(50,5,number_format($sueldoapagar,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Deposito'),0,0,'L');
$pdf->Cell(50,5,number_format($deposito,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Efectivo'),0,0,'L');
$pdf->Cell(50,5,number_format($totalefectivo,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');

$pdf->Ln(5);
$pdf->SetFont('Arial','',7.5);
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Recibi la cantidad que señala este recibo de pago, estando conforme con las Precepciones y deducciones descritas. Por lo que no se me adeuda cantidad alguna.'),0,1,'L');

$pdf->Ln(5);
$pdf->Cell(100,5,utf8_decode($resultado),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(59,5,utf8_decode('__________________________'),0,1,'R');
$pdf->Cell(143,5,utf8_decode('Firma'),0,1,'R');
$pdf->Ln(10);
}
}
if ($fecha_ini = "Especial") {
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin3 = substr($idoentrada, $fin2, 10);
$finfin = strrpos($idoentrada, "id3"); 
$final3 = $finfin + 4;
$fecha_ejercicio3 = substr($idoentrada, $final3, 10);
//$pdf->Cell(189,5,'Del:'. ' '. $fecha_ini . ' '. 'Al:'. ' '. $fecha_fin3. ' year ' . $fecha_ejercicio3 ,0,1,'C');

$query = mysqli_query($conection,"SELECT dn.id, dn.no_empleado, dn.empleado, dn.cargo, dn.fecha_ingreso, dn.fecha_pago, dn.year_pago, dn.dias_aguinaldo, dn.dias_derecho, dn.salario_diario, dn.importe_aguinaldo, dn.importe_fiscal, dn.impuesto_fiscal, dn.deposito, dn.pago_efectivo FROM detalle_temp_nomespecial dn WHERE dn.fecha_pago= '$fecha_fin3' and dn.year_pago = $fecha_ejercicio3 order by dn.no_empleado" );
$result = mysqli_num_rows($query);




while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id              = $row['id'];
    $noempleado      = $row['no_empleado'];
    $empleado        = $row['empleado'];
    $cargo           = $row['cargo'];
    $fcha_ingreso    = $row['fecha_ingreso'];
    $fcha_pago       = $row['fecha_pago'];
    $year_pago       = $row['year_pago'];
    $dias_aguinaldo  = $row['dias_aguinaldo'];
    $dias_derecho    = $row['dias_derecho'];
    $salario_diario  = $row['salario_diario'];
    $imp_aguinaldo   = $row['importe_aguinaldo'];
    $imp_fiscal      = $row['importe_fiscal'];
    $impuesto_fiscal = $row['impuesto_fiscal'];
    $deposito        = $row['deposito'];
    $efectivo        = $row['pago_efectivo'];
    
;

    $newDate = date("d-m-Y", strtotime($row['fecha_ingreso'])); 
    $newDate2 = date("d-m-Y", strtotime($row['fecha_pago'])); 

    //$imagen="../img/routers/".$entrada['foto'];
    //$subtotaldeduce = $caja_ahorro + $adeudos;
    //$sueldoapagar = $sueldoquincenal - $impuestofiscal;
    $numero = $imp_aguinaldo - $impuesto_fiscal;
    $resultado = numtoletras($numero);

$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('Recibo de Pago:'),0,1,'C', 'T');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('Aguinaldo '. $year_pago ),0,1,'C');
//$pdf->Ln(5);
//$pdf->SetFont('Arial','B',8);
$pdf->Cell(66,5,utf8_decode($noempleado. ' '. $empleado),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(66,5,utf8_decode('Periodo de Pago'),0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(26,5,utf8_decode('Fecha de Ingreso:'),0,0,'L');
$pdf->Cell(40,5,$newDate,0,0,'R');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Fecha de Pago:'),0,0,'R');
$pdf->Cell(36,5,$newDate2,0,1,'C');
$pdf->Cell(26,5,utf8_decode('Días de Aguinaldo:'),0,0,'L');
$pdf->Cell(40,5,number_format($dias_aguinaldo,2),0,0,'R');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode(''),0,0,'R');
$pdf->Cell(36,5,'',0,1,'C');
$pdf->Cell(26,5,utf8_decode('Días Proporcionales:'),0,0,'L');
$pdf->Cell(40,5,number_format($dias_derecho,2),0,0,'R');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode(''),0,0,'R');
$pdf->Cell(36,5,'',0,1,'C');
$pdf->Cell(26,5,utf8_decode('Sueldo Diario:'),0,0,'L');
$pdf->Cell(40,5,number_format($salario_diario,2),0,0,'R');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode(''),0,0,'R');
$pdf->Cell(36,5,'',0,1,'C');
$pdf->Ln(1);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Importe Aguinaldo'),0,0,'L');
$pdf->Cell(50,5,number_format($imp_aguinaldo,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,(''),0,1,'R');
$pdf->Cell(40,5,utf8_decode('Importe Fiscal'),0,0,'L');
$pdf->Cell(50,5,number_format($imp_fiscal,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Impuesto Fiscal'),0,0,'L');
$pdf->Cell(50,5,number_format($impuesto_fiscal,2),0,1,'R');
$pdf->Ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,utf8_decode('Deposito'),0,0,'L');
$pdf->Cell(50,5,number_format($deposito,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Efectivo'),0,0,'L');
$pdf->Cell(50,5,number_format($efectivo,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');

$pdf->Ln(5);
$pdf->SetFont('Arial','',7.5);
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Recibi la cantidad que señala este recibo de pago, estando conforme con las Precepciones y deducciones descritas. Por lo que no se me adeuda cantidad alguna.'),0,1,'L');

$pdf->Ln(5);
$pdf->Cell(100,5,utf8_decode($resultado),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(59,5,utf8_decode('__________________________'),0,1,'R');
$pdf->Cell(143,5,utf8_decode('Firma'),0,1,'R');
$pdf->Ln(40);
}
}
//$pdf->Image("$imagen",10,165,189,100,'png');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>