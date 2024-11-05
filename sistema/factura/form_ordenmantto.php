<?php

include('../fpdf/fpdf.php');


header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$noor=$_REQUEST['id'];
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

$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.usuario, oc.solicita, oc.unidad, oc.tipo_trabajo, oc.km_neumatico, oc.tipo_mantenimiento, oc.programado, oc.trabajo_solicitado, oc.notas_genera, oc.trabajo_hecho, oc.costo_descuento, oc.fecha_inicial, oc.fecha_termino, oc.notas, oc.causas_servicio, oc.aprobado, oc.estatus FROM solicitud_mantenimiento oc  where oc.no_orden = $noor");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id         = $entrada['id'];
    $folio      = $entrada['no_orden'];
    $fecha      = $entrada['fecha'];
    $usuario    = $entrada['usuario'];
    $solicita   = $entrada['solicita'];
    $unidad     = $entrada['unidad'];
    $t_trabajo  = $entrada['tipo_trabajo'];
    $km_neumat  = $entrada['km_neumatico'];
    $t_mantto   = $entrada['tipo_mantenimiento'];
    $programado = $entrada['programado'];
    $trab_sol   = $entrada['trabajo_solicitado'];
    $notas_gen  = $entrada['notas_genera'];
    $trab_hecho = $entrada['trabajo_hecho'];
    $costo_desc = $entrada['costo_descuento'];
    $date_ini   = $entrada['fecha_inicial'];
    $date_fin   = $entrada['fecha_termino'];
    $notas      = $entrada['notas'];
    $causa      = $entrada['causas_servicio'];
    $aprobado   = $entrada['aprobado'];

    
    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
   

       $subtitulo1=utf8_decode('ORDEN DE TRABAJO MANTENIMIENTO');

//Logo

//$this->Image("../../images/fondo001.png",10,10,78,93,"png",0,'C');
//$this->Image("../../images/fondo002.png",162,210,38,53,"png",0,'C');
$this->Image("../../images/transvive_logo.png",12,11,48,13,"png",0,'C');
//$this->Image("../../images/fondo1.png",12,11,48,13,"png",0,'C');

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
$this->Cell(30,10,'FO-TV-MT-02',1,1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
$this->Cell(15,5,'Area',1,0,'C','T');
$this->Cell(60,5,utf8_decode('SERVICIO'),1,0,'C');
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
$noor = $_REQUEST['id'];
$pdf=new PDF();
//$pdf = new AlphaPDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.usuario, oc.solicita, oc.unidad, oc.tipo_trabajo, oc.km_neumatico, oc.tipo_mantenimiento, oc.programado, oc.trabajo_solicitado, oc.notas_genera, oc.trabajo_hecho, oc.costo_descuento, oc.fecha_inicial, oc.fecha_termino, oc.notas, oc.causas_servicio, oc.aprobado, oc.estatus FROM solicitud_mantenimiento oc  where oc.no_orden = $noor");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id         = $entrada['id'];
    $folio      = $entrada['no_orden'];
    $fecha      = $entrada['fecha'];
    $usuario    = $entrada['usuario'];
    $solicita   = $entrada['solicita'];
    $unidad     = $entrada['unidad'];
    $t_trabajo  = $entrada['tipo_trabajo'];
    $km_neumat  = $entrada['km_neumatico'];
    $t_mantto   = $entrada['tipo_mantenimiento'];
    $programado = $entrada['programado'];
    $trab_sol   = $entrada['trabajo_solicitado'];
    $notas_gen  = $entrada['notas_genera'];
    $trab_hecho = $entrada['trabajo_hecho'];
    $costo_desc = $entrada['costo_descuento'];
    $date_ini   = $entrada['fecha_inicial'];
    $date_fin   = $entrada['fecha_termino'];
    $notas      = $entrada['notas'];
    $causa      = $entrada['causas_servicio'];
    $aprobado   = $entrada['aprobado'];

  //  $imagen="../img/routers/".$entrada['foto'];
    
    $newDate = date("d-m-Y", strtotime($entrada['fecha'])); 
    if ($entrada['fecha_inicial'] > '2000-01-01') {
        $newDate2 = date("d-m-Y", strtotime($entrada['fecha_inicial'])); 
    }else {
    $newDate2 = ""; 
    }
    if ($entrada['fecha_termino'] > '2000-01-01') {
        $newDate3 = date("d-m-Y", strtotime($entrada['fecha_termino'])); 
    }else {
    $newDate3 = ""; 
    }

    if ($entrada['estatus'] == 1 ) {
        $Status = "Abierta";
    }else {
        if ($entrada['estatus'] == 2) {
            $Status = "Cerrada";
        }else {
            $Status = "Cancelada";
        }
    }
//ciclo de repeticion celdas
//Consulta para cuerpo tabla

$pdf->Ln(5);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(20,5,utf8_decode('No. Orden'),1,0,'C', 'T');
$pdf->Cell(30,5,utf8_decode('Fecha Solicitud'),1,0,'C', 'T');
$pdf->Cell(55,5,'Usuario',1,0,'C', 'T');
$pdf->Cell(55,5,'Solicitado por',1,0,'C','T');
$pdf->Cell(29,5,'Unidad',1,1,'C','T');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20,5,$folio,1,0,'C');
$pdf->Cell(30,5,$newDate,1,0,'C');
$pdf->Cell(55,5,$usuario,1,0,'C');
$pdf->Cell(55,5,$solicita,1,0,'C');
$pdf->Cell(29,5,$unidad,1,1,'C');
$pdf->SetFont('Arial','',8);
if ($t_trabajo === "NEUMATICO") {
$pdf->Cell(45,5,'Tipo de Trabajo a Ejecutar',1,0,'C', 'T');
$pdf->Cell(40,5,'Kilometraje',1,0,'C', 'T');
$pdf->Cell(45,5,utf8_decode('Tipo de Mantenimiento'),1,0,'C', 'T');
$pdf->Cell(30,5,'Programado',1,0,'C', 'T');
$pdf->Cell(29,5,'Estatus',1,1,'C', 'T');
$pdf->SetFont('Arial','',7);
$pdf->Cell(45,5,utf8_decode($t_trabajo),1,0,'C');
$pdf->Cell(40,5,utf8_decode($km_neumat),1,0,'C');
$pdf->Cell(45,5,utf8_decode($t_mantto),1,0,'C');
$pdf->Cell(30,5,utf8_decode($programado),1,0,'C');
$pdf->Cell(29,5,utf8_decode($Status),1,1,'C');
}else {
$pdf->Cell(65,5,'Tipo de Trabajo a Ejecutar',1,0,'C', 'T');
$pdf->Cell(65,5,utf8_decode('Tipo de Mantenimiento'),1,0,'C', 'T');
$pdf->Cell(30,5,'Programado',1,0,'C', 'T');
$pdf->Cell(29,5,'Estatus',1,1,'C', 'T');
$pdf->SetFont('Arial','',7);
$pdf->Cell(65,5,utf8_decode($t_trabajo),1,0,'C');
$pdf->Cell(65,5,utf8_decode($t_mantto),1,0,'C');
$pdf->Cell(30,5,utf8_decode($programado),1,0,'C');
$pdf->Cell(29,5,utf8_decode($Status),1,1,'C');
}
$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(189,5,utf8_decode('Trabajo Solicitado'),1,1,'C', 'T');
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(189,5,utf8_decode($trab_sol),1,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->Cell(189,5,utf8_decode('Trabajo Ejecutado'),1,1,'C', 'T');
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(189,5,utf8_decode($trab_hecho),1,1,'L');


$pdf->Ln(5);

include('../../conexion.php');
$noor = $_REQUEST['id'];

$queryr = mysqli_query($conection,"SELECT * FROM detalle_mantto WHERE folio = $noor");
$resultr = mysqli_num_rows($queryr);
$pdf->SetFillColor(231,233,238);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('Refacciones y Materiales'),1,1,'C','T');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20,5,utf8_decode('Cantidad'),1,0,'C','T');
$pdf->Cell(169,5,utf8_decode('Descripcion'),1,1,'C','T');


$subtotal    = 0;
$totsubtotal = 0;
$impuestos   = 0;
$totiva      = 0;
$total       = 0;

while ($row = mysqli_fetch_assoc($queryr)){

$pdf->SetFont('Arial','',7);
$pdf->Cell(20,5,number_format($row['cantidad'],2),1,0,'R');
$pdf->Cell(169,5,utf8_decode($row['descripcion']),1,1,'L');
}


$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->cell(189,5,utf8_decode('Costos para descontar al Operador'),1,1, 'C', 'T');
$pdf->cell(20,5,utf8_decode(''),1,0, 'L');
$pdf->cell(169,5,utf8_decode($costo_desc),1,1, 'C');
$pdf->Ln(5);
$pdf->cell(90,5,utf8_decode('Fecha de inicio de mantenimiento'),1,0, 'C', 'T');
$pdf->cell(9,5,utf8_decode(''),0,0, 'C');
$pdf->cell(90,5,utf8_decode('Fecha de culminación de mantenimiento'),1,1, 'C', 'T');
$pdf->cell(90,5,$newDate2,1,0, 'C');
$pdf->cell(9,5,utf8_decode(''),0,0, 'C');
$pdf->cell(90,5,$newDate3,1,1, 'C');
$pdf->Ln(5);
$pdf->cell(189,5,utf8_decode('Observaciones'),1,1, 'L', 'T');
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',7);
$pdf->Multicell(189,5,utf8_decode($notas),1,1, 'L');
$pdf->Ln(5);
$pdf->SetFillColor(231,233,238);
$pdf->SetFont('Arial','',8);
$pdf->cell(189,5,utf8_decode('Causas del servicio (Llenar en caso de ser correctivo)'),1,1, 'C', 'T');
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',7);
$pdf->Multicell(189,5,utf8_decode($causa),1,1, 'L');



// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>