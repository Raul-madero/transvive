<?php
require('../fpdf/fpdf.php');
require('../includes/conversor.php');
require('../../conexion.php');

header("Content-Type: text/html; charset=iso-8859-1");

// Clase PDF
class PDF extends FPDF {
    function Header() {
        $this->Image("../../images/transvive.png", 12, 11, 48, 13, "png", 0);
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(231, 233, 238);
        $this->SetTextColor(6, 22, 54);
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

// Inicializar PDF
$pdf = new PDF();
$pdf->AddPage('P', 'Letter');

$conection->set_charset('utf8');

$tipo = $_REQUEST['tipo'] ?? 'Semanal';
$semana = $_REQUEST['id2'] ?? '';
$anio = $_REQUEST['id3'] ?? '';
$id = $_REQUEST['id'] ?? '';

// Validaciones iniciales
if (empty($tipo) || empty($anio)) {
    die("Faltan parámetros requeridos");
}

// Ejecutar según tipo
switch (strtolower($tipo)) {
    case 'semanal':
        generarReciboSemanal($pdf, $conection, $semana, $anio);
        break;
    case 'quincenal':
        generarReciboQuincenal($pdf, $conection, $id);
        break;
    case 'especial':
        generarReciboEspecial($pdf, $conection, $id);
        break;
    default:
        die("Tipo de recibo no válido");
}

$pdf->Output();


function generarReciboSemanal($pdf, $conection, $semanaTexto, $anio) {
    $numeroSemana = intval(str_replace('Semana ', '', $semanaTexto));

    $stmt = $conection->prepare("SELECT * FROM historico_nomina WHERE semana = ? AND anio = ? ORDER BY noempleado");
    $stmt->bind_param("ii", $numeroSemana, $anio);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $pdf->Cell(189, 10, 'No hay datos para la semana seleccionada.', 0, 1, 'C');
        return;
    }

    $fechaInicio = new DateTime();
    $fechaInicio->setISODate($anio, $numeroSemana, 1);
    $fechaFin = new DateTime();
    $fechaFin->setISODate($anio, $numeroSemana, 7);
    $periodo = 'Del: ' . $fechaInicio->format('d/m/Y') . ' al: ' . $fechaFin->format('d/m/Y');

    while ($row = $result->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 8);
        $pdf->Ln(12);
        $pdf->Cell(189, 5, utf8_decode("Recibo de Pago - Semana $numeroSemana"), 0, 1, 'C');
        $pdf->Cell(189, 5, utf8_decode("Empleado: {$row['noempleado']} - {$row['nombre']}"), 0, 1, 'L');
        $pdf->Cell(189, 5, utf8_decode($periodo), 0, 1, 'L');
        $pdf->Ln(2);

        // Tabla
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(231, 233, 238);
        $pdf->Cell(60, 5, 'Percepciones', 1, 0, 'C');
        $pdf->Cell(60, 5, 'Deducciones', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(60, 5, 'Vueltas Totales: ' . number_format($row['total_vueltas'], 2), 0, 0);
        $pdf->Cell(60, 5, 'Deduccion por Adeudo: $' . number_format($row['deducciones'], 2), 0, 1);

        $pdf->Cell(60, 5, 'Pago Total Vueltas: $' . number_format($row['sueldo_bruto'], 2), 0, 0);
        $pdf->Cell(60, 5, 'Caja Ahorro: $' . number_format($row['caja_ahorro'], 2), 0, 1);

        $pdf->Cell(60, 5, 'Sueldo Adicional: $' . number_format($row['sueldo_adicional'], 2), 0, 0);
        $pdf->Cell(60, 5, 'Deduccion Fiscal: $' . number_format($row['deduccion_fiscal'], 2), 0, 1);

        $pdf->Cell(60, 5, 'Bono Semanal: $' . number_format($row['bono_categoria'], 2), 0, 0);
        $pdf->Ln(5);
        $pdf->Cell(60, 5, 'Bono Supervisor: $' . number_format($row['bono_supervisor'], 2), 0, 0);
        $pdf->Ln(5);
        $pdf->Cell(60, 5, 'Bono Alertas: $' . number_format($row['bono_semanal'], 2), 0, 0);
        $pdf->Ln(5);
        $pdf->Cell(60, 5, 'Vales de Despensa: $' . number_format($row['apoyo_mes'], 2), 0, 0);
        $pdf->Ln(5);
        $pdf->Cell(60, 5, 'Dias de Vacaciones: ' . number_format($row['dias_vacaciones'], 2), 0, 0);
        $pdf->Ln(5);
        $pdf->Cell(60, 5, 'Pago Vacaciones: $' . number_format($row['pago_vacaciones'], 2), 0, 0);
        $pdf->Ln(5);
        $pdf->Cell(60, 5, 'Prima Vacacional: $' . number_format($row['prima_vacacional'], 2), 0, 0);

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode('Total Percepciones: $' . number_format($row['sueldo_bruto'] + $row['sueldo_adicional'] + $row['bono_categoria'] + $row['bono_supervisor'] + $row['bono_semanal'] + $row['apoyo_mes'] + $row['prima_vacacional'] + $row['pago_vacaciones'], 2)), 0, 0, 'L');
        $pdf->Cell(60, 5,'Total Deducciones: $' . number_format($row['deducciones'] + $row['caja_ahorro'] + $row['deduccion_fiscal'], 2), 0, 1, 'R');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 5,'Total Neto: $' . number_format(($row['sueldo_bruto'] - $row['nomina_fiscal']) + $row['bono_semanal'] + $row['bono_supervisor'] + $row['bono_categoria'] + $row['sueldo_adicional'] + $row['apoyo_mes'] + $row['prima_vacacional'] + $row['pago_vacaciones'] - ($row['deducciones'] + $row['caja_ahorro']), 2), 0, 1);

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode('Deposito Fiscal: $' . number_format($row['deposito_fiscal'], 2)), 0, 0, 'L');
        $pdf->Cell(60, 5,'Deposito Efectivo: $' . number_format($row['sueldo_bruto'] + $row['bono_semanal'] + $row['bono_supervisor'] + $row['bono_categoria'] + $row['sueldo_adicional'] + $row['apoyo_mes'] + $row['prima_vacacional'] + $row['pago_vacaciones'] - ($row['deducciones'] + $row['caja_ahorro']) - $row['deposito_fiscal'], 2), 0, 1, 'R');

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(189, 5, utf8_decode('Recibí conforme.'), 0, 1, 'L');
        $pdf->Cell(189, 10, '_________________________', 0, 1, 'R');
        $pdf->Cell(189, 5, 'Firma', 0, 1, 'R');
        $pdf->Ln(5);
        $pdf->AddPage();
    }
}


function generarReciboQuincenal($pdf, $conection, $idCompleto) {
    // Aquí separas fechas y año desde $idCompleto si así los manejas
    // o mejor usa `$_REQUEST['quincena']`, `$_REQUEST['anio']`, etc.

    // Simulación
    $stmt = $conection->query("SELECT * FROM historico_nomina WHERE tipo_recibo = 'Quincenal' ORDER BY no_empleado");
    while ($row = $stmt->fetch_assoc()) {
        $pdf->Cell(189, 5, 'Recibo Quincenal de: ' . $row['nombre'], 0, 1, 'L');
        $pdf->Cell(60, 5, 'Sueldo Bruto: $' . number_format($row['sueldo_bruto'], 2), 0, 1);
        $pdf->Cell(60, 5, 'Deducciones: $' . number_format($row['deducciones'], 2), 0, 1);
        $pdf->Ln(5);
    }
}


function generarReciboEspecial($pdf, $conection, $idCompleto) {
    // Lógica similar: parseas fechas o valores del ID y generas recibos

    $stmt = $conection->query("SELECT * FROM historico_nomina WHERE tipo_recibo = 'Especial' ORDER BY no_empleado");
    while ($row = $stmt->fetch_assoc()) {
        $pdf->Cell(189, 5, 'Recibo Especial - Aguinaldo: ' . $row['year_pago'], 0, 1, 'C');
        $pdf->Cell(189, 5, 'Empleado: ' . $row['empleado'], 0, 1, 'L');
        $pdf->Cell(60, 5, 'Importe Aguinaldo: $' . number_format($row['importe_aguinaldo'], 2), 0, 1);
        $pdf->Cell(60, 5, 'Impuesto: $' . number_format($row['impuesto_fiscal'], 2), 0, 1);
        $pdf->Ln(5);
    }
}

?>



<!-- <?php

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
        
        //Determinamos la fecha correspondiente al inicio de la semana
        $fecha_inicio = new DateTime();
        $fecha_inicio->setISODate($anio, $numero_semana, 1);
        
        //Determinamos la fecha final de la semana
        $fecha_fin = new DateTime();
        $fecha_fin->setISODate($anio, $numero_semana, 7);
        
        
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

    // var_dump($data);


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
    // $totnomina   = $row['total_nomina'];
    $dedgeneral  = $row['deducciones'];
    $bonocategoria  = $row['bono_categoria'];
    $bonosupervisor = $row['bono_supervisor'];
    $bonosemanal = $row['bono_semanal'];
    // $apoyomensual = $row['apoyo_mensual'];
    $sdoadicional = $row['sueldo_adicional'];
    $primavac = $row['prima_vacacional'];
    $vacaciones = $row['dias_vacaciones'];
    $pagofiscal = $row['deposito_fiscal'];

    // $newDate = date("d-m-Y", strtotime($row['dia_inicial'])); 
    // $newDate2 = date("d-m-Y", strtotime($row['dia_final'])); 

    //$imagen="../img/routers/".$entrada['foto'];
    // $viajestotales = $vespeciales + $vcontratos;
    // $numero = $totgeneral;
    // $resultado = numtoletras($numero);

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
$pdf->Cell(66,5,utf8_decode('No. Vueltas:'. ' '. $total_vueltas),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Del:'),0,0,'R');
// $pdf->Cell(36,5,$newDate,0,1,'C');
$pdf->Cell(66,5,'',0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Al:'),0,0,'R');
// $pdf->Cell(36,5,$newDate2,0,1,'C');
$pdf->Ln(1);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Bono Categoria'),0,0,'L');
$pdf->Cell(50,5,number_format($bonocategoria,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deducciones Adeudos:'),0,0,'L');
// $pdf->Cell(50,5,number_format($adeudo,2),0,1,'R');
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
// $pdf->Cell(50,5,number_format($apoyomensual,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Sueldo Adicional'),0,0,'L');
$pdf->Cell(50,5,number_format($sdoadicional,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Especiales'),0,0,'L');
// $pdf->Cell(50,5,number_format($totespeciales,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Contrato'),0,0,'L');
// $pdf->Cell(50,5,number_format($totcontrato,2),0,0,'R');
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
// $pdf->Cell(50,5,number_format($sueldobruto,2),0,0,'R');
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
// $pdf->Cell(50,5,number_format($totnomina,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Total General'),0,0,'L');
$pdf->Cell(50,5,number_format($totgeneral,2),0,1,'R');

$pdf->SetFont('Arial','',7.5);
$pdf->Ln(5);
$pdf->Cell(189,5,utf8_decode('Recibi la cantidad que señala este recibo de pago, estando conforme con las Precepciones y deducciones descritas. Por lo que no se me adeuda cantidad alguna.'),0,1,'L');

$pdf->Ln(5);
// $pdf->Cell(100,5,utf8_decode($resultado),0,0,'L');
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
// $pdf->Cell(66,5,utf8_decode('No. Vueltas:'. ' '. $viajestotales),0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Del:'),0,0,'R');
// $pdf->Cell(36,5,$newDate,0,1,'C');
$pdf->Cell(66,5,'',0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Al:'),0,0,'R');
// $pdf->Cell(36,5,$newDate2,0,1,'C');
$pdf->Ln(1);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Bono Categoria'),0,0,'L');
$pdf->Cell(50,5,number_format($bonocategoria,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deducciones Adeudos:'),0,0,'L');
// $pdf->Cell(50,5,number_format($adeudo,2),0,1,'R');
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
// $pdf->Cell(50,5,number_format($apoyomensual,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Sueldo Adicional'),0,0,'L');
$pdf->Cell(50,5,number_format($sdoadicional,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Especiales'),0,0,'L');
// $pdf->Cell(50,5,number_format($totespeciales,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode(''),0,0,'L');
$pdf->Cell(50,5,'',0,1,'R');
$pdf->Cell(40,5,utf8_decode('Total Contrato'),0,0,'L');
// $pdf->Cell(50,5,number_format($totcontrato,2),0,0,'R');
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
// $pdf->Cell(50,5,number_format($sueldobruto,2),0,0,'R');
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
// $pdf->Cell(100,5,utf8_decode($resultado),0,0,'L');
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

$query = mysqli_query($conection,"SELECT * FROM historico_nomina WHERE semana =  $numero_semana and anio = $anio order by noempleado" );
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
    // $apoyomes        = $row['apoyo_alimenticio'];
    $subtotal        = $row['subtotal'];
    $caja_ahorro     = $row['caja_ahorro'];
    // $adeudos         = $row['prestamo_deuda'];
    $vacaciones      = $row['vacaciones'];
    $prima_vacacional = $row['prima_vacacional'];
    $dias_vacaciones = $row['dias_vacaciones'];
    $sueldoquincenal = $row['sueldo_quincenal'];
    $sueldofiscal    = $row['sueldo_fiscal'];
    $impuestofiscal  = $row['impuesto_fiscal'];
    $totalefectivo   = $row['total_efectivo'];
    $deposito        = $row['deposito'];
;

    // $newDate = date("d-m-Y", strtotime($row['dia_inicial'])); 
    // $newDate2 = date("d-m-Y", strtotime($row['dia_final'])); 

    //$imagen="../img/routers/".$entrada['foto'];
    // $subtotaldeduce = $caja_ahorro + $adeudos;
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
// $pdf->Cell(36,5,$newDate,0,1,'C');
$pdf->Cell(66,5,'Sueldo Diario:'. ' '. $sueldodiario,0,0,'L');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Al:'),0,0,'R');
// $pdf->Cell(36,5,$newDate2,0,1,'C');
$pdf->Ln(1);
$pdf->Cell(90,5,utf8_decode('Precepciones'),0,0,'C', 'T');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(90,5,utf8_decode('Deducciones '),0,1,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Sueldo Bruto'),0,0,'L');
// $pdf->Cell(50,5,number_format($sueldobruto,2),0,0,'R');
$pdf->Cell(9,5,utf8_decode(''),0,0,'C');
$pdf->Cell(40,5,utf8_decode('Deducciones Adeudos:'),0,0,'L');
// $pdf->Cell(50,5,number_format($adeudos,2),0,1,'R');
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
// $pdf->Cell(50,5,number_format($apoyomes,2),0,0,'R');
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

$query = mysqli_query($conection,"SELECT * FROM historico_nomina WHERE semana =  $numero_semana and anio = $anio order by noempleado" );
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

    // $newDate = date("d-m-Y", strtotime($row['fecha_ingreso'])); 
    // $newDate2 = date("d-m-Y", strtotime($row['fecha_pago'])); 

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
// $pdf->Cell(40,5,$newDate,0,0,'R');
$pdf->Cell(49,5,utf8_decode(''),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Fecha de Pago:'),0,0,'R');
// $pdf->Cell(36,5,$newDate2,0,1,'C');
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
?> -->