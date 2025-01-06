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

$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.hora, oc.usuario, oc.solicitada, oc.unidad, oc.tipo_trabajo, oc.kilometraje, oc.filtro_aceite, oc.filtro_aire, oc.filtro_combustible, oc.cambio_aceite, oc.cambio_bujias, oc.revision_balatas, oc.engrasado, oc.anticongelante, oc.liquido_freno, oc.aceite_hidraulico, oc.rotacion_llantas, oc.banda_accesorios, oc.muelles, oc.amortiguadores, oc.luces, oc.baterias, oc.inyectores, oc.masas_delanteras, oc.fecha_inicio, oc.fecha_culminacion, oc.observaciones, oc.estatus FROM mantenimiento_preventivo oc where oc.no_orden = $noor");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $id            = $entrada['id'];
    $folio         = $entrada['no_orden'];
    $fecha         = $entrada['fecha'];
    $hora          = $entrada['hora'];
    $usuario       = $entrada['usuario'];
    $solicita      = $entrada['solicitada'];
    $unidad        = $entrada['unidad'];
    $t_trabajo     = $entrada['tipo_trabajo'];
    $kilometraje   = $entrada['kilometraje'];
    $filtro_aceite = $entrada['filtro_aceite'];
    $filtro_aire   = $entrada['filtro_aire'];
    $filtro_gas    = $entrada['filtro_combustible'];
    $cambio_aceite = $entrada['cambio_aceite'];
    $cambio_bujias = $entrada['cambio_bujias'];
    $rev_abaltas   = $entrada['revision_balatas'];
    $engrasado     = $entrada['engrasado'];
    $anticogelante = $entrada['anticongelante'];
    $liq_frenos    = $entrada['liquido_freno'];
    $ac_hidraulico = $entrada['aceite_hidraulico'];
    $rota_llantas  = $entrada['rotacion_llantas'];
    $banda_accesor = $entrada['banda_accesorios'];
    $muelles       = $entrada['muelles'];
    $amortiguador  = $entrada['amortiguadores'];
    $luces         = $entrada['luces'];
    $baterias      = $entrada['baterias'];
    $inyectores    = $entrada['inyectores'];
    $masas_frente  = $entrada['masas_delanteras'];
    $date_inicio   = $entrada['fecha_inicio'];
    $date_fin      = $entrada['fecha_culminacion'];
    $observaciones = $entrada['observaciones'];
    $estatus       = $entrada['estatus'];
    
    
    //$contenido = 'Certificado '.$certificado.' Almacen '.$almacen;
   

       $subtitulo1=mb_convert_encoding('Orden de Trabajo de Mantenimiento Preventivo', 'ISO-8859-1', 'UTF-8');

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
$this->Cell(80,10,$subtitulo1,1,0,'C');
$this->Cell(19,10,'Codigo',1,0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(25,10,'FO-TV-MT-07',1,1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
$this->Cell(15,5,'Area',1,0,'C','T');
$this->Cell(65,5,mb_convert_encoding('Mantenimiento', 'ISO-8859-1', 'UTF-8'),1,0,'C');
$this->Cell(19,5,mb_convert_encoding(''),1,0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(25,5,'',1,0,'C');





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
$this->Cell(45,5,mb_convert_encoding(''),0,0,'C');
$this->Cell(20,5,'',0,0,'L');
$this->Cell(45,5,mb_convert_encoding(''),0,0,'C');
$this->Cell(20,5,'',0,0,'L');
$this->Cell(45,5,mb_convert_encoding(''),0,1,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Elabora'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Revisa'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Autoriza'),0,1,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Ma. Guadalupe Balcárcel'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Karina López Salazar'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Angelina Durán Garibay'),0,1,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Compras'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Aseguramiento de Calidad'),0,0,'C');
$this->Cell(10,5,'',0,0,'L');
$this->Cell(52,5,mb_convert_encoding('Administración SGC'),0,1,'C');
*/
$this->Cell(0,10,mb_convert_encoding('Transvive ERP', 'ISO-8859-1', 'UTF-8'),0,0,'C');
$this->Cell(-15,10,mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8') . $this->PageNo(),0,0,'C');

}
}
//Impresion 
include('../../conexion.php');
$noor = $_REQUEST['id'];
$pdf=new PDF();
//$pdf = new AlphaPDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT oc.id, oc.no_orden, oc.fecha, oc.hora, oc.usuario, oc.solicitada, oc.unidad, oc.tipo_trabajo, oc.kilometraje, oc.filtro_aceite, oc.filtro_aire, oc.filtro_combustible, oc.cambio_aceite, oc.cambio_bujias, oc.revision_balatas, oc.engrasado, oc.anticongelante, oc.liquido_freno, oc.aceite_hidraulico, oc.rotacion_llantas, oc.banda_accesorios, oc.muelles, oc.amortiguadores, oc.luces, oc.baterias, oc.inyectores, oc.masas_delanteras, oc.fecha_inicio, oc.fecha_culminacion, oc.observaciones, oc.estatus, oc.km_bujias, oc.delantera_izquierda, oc.delantera_derecha, oc.trasera_izquierda, oc.trasera_derecha FROM mantenimiento_preventivo oc where oc.no_orden = $noor");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id            = $entrada['id'];
    $folio         = $entrada['no_orden'];
    $fecha         = $entrada['fecha'];
    $hora          = $entrada['hora'];
    $usuario       = $entrada['usuario'];
    $solicita      = $entrada['solicitada'];
    $unidad        = $entrada['unidad'];
    $t_trabajo     = $entrada['tipo_trabajo'];
    $kilometraje   = $entrada['kilometraje'];
    $km_bujias     = $entrada['km_bujias'];
    

   
    $masas_frente  = $entrada['masas_delanteras'];
    $date_inicio   = $entrada['fecha_inicio'];
    $date_fin      = $entrada['fecha_culminacion'];
    $observaciones = $entrada['observaciones'];
    $delantera_izq = $entrada['delantera_izquierda'];
    $delantera_der = $entrada['delantera_derecha'];
    $trasera_izq   = $entrada['trasera_izquierda'];
    $trasera_der   = $entrada['trasera_derecha'];
    $estatus       = $entrada['estatus'];

    $corto = substr($entrada['unidad'], 0, 1);

  //  $imagen="../img/routers/".$entrada['foto'];

    if ($entrada['fecha'] > '2000-01-01') {
        $newDate = date("d-M-Y", strtotime($entrada['fecha'])); 
    }else {
    $newDate = ""; 
    }
    
    if ($entrada['fecha_inicio'] > '2000-01-01') {
        $newDate2 = date("d-m-Y", strtotime($entrada['fecha_inicio'])); 
    }else {
    $newDate2 = ""; 
    }

    if ($entrada['fecha_culminacion'] > '2000-01-01') {
        $newDate3 = date("d-m-Y", strtotime($entrada['fecha_culminacion'])); 
    }else {
    $newDate3 = ""; 
    }

    if ($entrada['hora'] == '00:00:00') {
          $newHora = "00:00";      
    }else {
    
       $newHora = date("h:i", strtotime($entrada['hora']));
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

    if($entrada['filtro_aceite'] == 'SI') {
       $check1 = "l";
    }else {
       $check1 = "m";
    }

    if($entrada['filtro_aire'] == 'SI') {
       $check2 = "l";
    }else {
       $check2 = "m";
    }

    if($entrada['filtro_combustible'] == 'SI') {
       $check3 = "l";
    }else {
       $check3 = "m";
    }

    if($entrada['cambio_aceite'] == 'SI') {
       $check4 = "l";
    }else {
       $check4 = "m";
    }

    if($entrada['cambio_bujias'] == 'SI') {
       $check5 = "l";
    }else {
       $check5 = "m";
    }

    if($entrada['revision_balatas'] == 'SI') {
       $check6 = "l";
    }else {
       $check6 = "m";
    }

    if($entrada['engrasado'] == 'SI') {
       $check7 = "l";
    }else {
       $check7 = "m";
    }

    if($entrada['anticongelante'] == 'SI') {
       $check8 = "l";
    }else {
       $check8 = "m";
    }

    if($entrada['liquido_freno'] == 'SI') {
       $check9 = "l";
    }else {
       $check9 = "m";
    }

    if($entrada['aceite_hidraulico'] == 'SI') {
       $check10 = "l";
    }else {
       $check10 = "m";
    }

    if($entrada['rotacion_llantas'] == 'SI') {
       $check11 = "l";
    }else {
       $check11 = "m";
    }

    if($entrada['banda_accesorios'] == 'SI') {
       $check12 = "l";
    }else {
       $check12 = "m";
    }

    if($entrada['muelles'] == 'SI') {
       $check13 = "l";
    }else {
       $check13 = "m";
    }

    if($entrada['amortiguadores'] == 'SI') {
       $check14 = "l";
    }else {
       $check14 = "m";
    }

    if($entrada['luces'] == 'SI') {
       $check15 = "l";
    }else {
       $check15 = "m";
    }

    if($entrada['baterias'] == 'SI') {
       $check16 = "l";
    }else {
       $check16 = "m";
    }

    if($entrada['inyectores'] == 'SI') {
       $check17 = "l";
    }else {
       $check17 = "m";
    }

    if($entrada['masas_delanteras'] == 'SI') {
       $check18 = "l";
    }else {
       $check18 = "m";
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
$pdf->Cell(20,5,mb_convert_encoding('No. Orden', 'ISO-8859-1', 'UTF-8'),1,0,'C', 'T');
$pdf->Cell(35,5,mb_convert_encoding('Fecha de Solicitud', 'ISO-8859-1', 'UTF-8'),1,0,'C', 'T');
$pdf->Cell(50,5,'Usuario',1,0,'C', 'T');
$pdf->Cell(55,5,'Solicitado por',1,0,'C','T');
$pdf->Cell(29,5,'Unidad',1,1,'C','T');
$pdf->SetFont('Arial','',7);
$pdf->Cell(20,5,$folio,1,0,'C');
$pdf->Cell(35,5,$newDate,1,0,'C');
$pdf->Cell(50,5,$usuario,1,0,'C');
$pdf->Cell(55,5,$solicita,1,0,'C');
$pdf->Cell(29,5,$unidad,1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(130,5,'Tipo de Trabaja a Ejecutar',1,0,'C', 'T');
$pdf->Cell(30,5,'Kilometraje',1,0,'C', 'T');
$pdf->Cell(29,5,'Estatus',1,1,'C', 'T');
$pdf->SetFont('Arial','',7);
$pdf->Cell(130,5,mb_convert_encoding($t_trabajo, 'ISO-8859-1', 'UTF-8'),1,0,'C');
$pdf->Cell(30,5,$kilometraje,1,0,'C');
$pdf->Cell(29,5,mb_convert_encoding($Status, 'ISO-8859-1', 'UTF-8'),1,1,'C');
$pdf->Ln(5);
$pdf->Cell(189,5,mb_convert_encoding('CHECKLIST', 'ISO-8859-1', 'UTF-8'),1,1,'C', 'T');
$pdf->Ln(2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,mb_convert_encoding('***Campo llenado por Coordinador y/o Tecnico en mantenimiento', 'ISO-8859-1', 'UTF-8'),0,1,'L', 'T');
if ($corto == "C") {
$pdf->Cell(90,5,mb_convert_encoding('Revisión Camiones', 'ISO-8859-1', 'UTF-8'),0,0,'C');   
}else {
$pdf->Cell(90,5,mb_convert_encoding('Revisión Camionetas y Autos', 'ISO-8859-1', 'UTF-8'),0,0,'C');     
}
$pdf->Cell(90,5,mb_convert_encoding('Rotación de Llantas', 'ISO-8859-1', 'UTF-8'),0,1,'C');
$pdf->Ln(5);

$pdf->Image("../img/autollantas.jpg",120,80,58,83,"jpg",0,'C');
$pdf->Cell(80,5,mb_convert_encoding('Cambio de filtro de aceite', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check1,0,0,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'),0,0,'R');/* ROTACION IZQ */
$pdf->Cell(10,5,mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'),0,0,'R');
$pdf->Cell(40,5,mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'),0,1,'L');/* ROTACION DER */
$pdf->Cell(80,5,mb_convert_encoding('Cambio de filtro de aire', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check2,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Cambio de filtro de combustible', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check3,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Cambio de aceite', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check4,0,1,'R');
$pdf->SetFont('Arial','',8);
if ($corto <> "C") {
$pdf->Cell(80,5,mb_convert_encoding('Cambio de bujias (anotar km)', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check5,0,0,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,$km_bujias,0,1,'L');

}
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de balatas', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check6,0,1,'R');
$pdf->SetFont('Arial','',8);
if ($corto == "C") {
$pdf->Cell(80,5,mb_convert_encoding('Engrasado', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check7,0,1,'R');
}
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Nivel de anti congelante', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check8,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de líquido de frenos', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check9,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de aceite hidraúlico', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check10,0,1,'R');
$pdf->SetFont('Arial','',8);
if ($corto <> "C") {
$pdf->Cell(80,5,mb_convert_encoding('Rotación de llantas', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check11,0,1,'R');
}
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisar banda de accesorios', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check12,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de muelles', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check13,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de amortiguadores', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check14,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de luces', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check15,0,1,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de batería', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check16,0,1,'R');
$pdf->SetFont('Arial','',8);
if ($corto <> "C") {
$pdf->Cell(80,5,mb_convert_encoding('Limpieza de inyectores', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check17,0,1,'R');
}
$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,mb_convert_encoding('Revisión de masas delanteras', 'ISO-8859-1', 'UTF-8'),0,0,'L');
$pdf->SetFont('ZapfDingbats','', 8);
$pdf->Cell(10,5,$check18,0,0,'R');
$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,mb_convert_encoding(''),0,0,'R'); /* ROTACION TRAS IZ1 */
$pdf->Cell(10,5,mb_convert_encoding(''),0,0,'R');
$pdf->Cell(40,5,mb_convert_encoding(''),0,1,'L'); /* ROTACION TRAS DER */ 
$pdf->Ln(5);
include('../../conexion.php');
$noor = $_REQUEST['id'];

$queryr = mysqli_query($conection,"SELECT * FROM detalle_manttoprev WHERE folio = $noor");
$resultr = mysqli_num_rows($queryr);
$pdf->SetFillColor(231,233,238);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,mb_convert_encoding('Refacciones y Materiales', 'ISO-8859-1', 'UTF-8'),1,1,'C','T');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20,5,mb_convert_encoding('Cantidad', 'ISO-8859-1', 'UTF-8'),1,0,'C','T');
$pdf->Cell(169,5,mb_convert_encoding('Descripcion', 'ISO-8859-1', 'UTF-8'),1,1,'C','T');


$subtotal    = 0;
$totsubtotal = 0;
$impuestos   = 0;
$totiva      = 0;
$total       = 0;

if ($resultr >= 10) {
   $filas = $resultr;
}else {
   $filas = 9 - $resultr;
}

for ($i = 1; $i <= $filas; $i++) {

while ($row = mysqli_fetch_assoc($queryr)){
    $subtotal = $row['cantidad'] * $row['costo'];
    $impuesto = ($row['cantidad'] * $row['costo'])*1.16;
    $totsubtotal = $totsubtotal + $subtotal;
    $total = $total + $impuesto; 

$pdf->SetFont('Arial','',7);
$pdf->Cell(20,5,number_format($row['cantidad'],2),1,0,'R');
$pdf->Cell(169,5,mb_convert_encoding($row['descripcion']),1,1,'L');
//$pdf->Cell(20,5,number_format($row['costo'],2),1,1,'R');
}

$pdf->SetFont('Arial','',7);
$pdf->Cell(20,5,'',1,0,'R');
$pdf->Cell(169,5,mb_convert_encoding(''),1,1,'L');
//$pdf->Cell(20,5,'',1,1,'R');

}
/*$pdf->SetFont('Arial','',7);
$pdf->Cell(20,5,'',1,0,'R');
$pdf->Cell(28,5,mb_convert_encoding('Subtotal:'),1,0,'R', 'T');
$pdf->Cell(28,5,number_format($totsubtotal,2),1,0,'R');
$pdf->Cell(28,5,mb_convert_encoding('IVA:'),1,0,'R', 'T');
$pdf->Cell(28,5,number_format($total - $totsubtotal,2),1,0,'R');
$pdf->Cell(28,5,mb_convert_encoding('Total:'),1,0,'R', 'T');
$pdf->Cell(29,5,number_format($total,2),1,1,'R');
*/

$pdf->Ln(5);
$pdf->SetFont('Arial','',8);

$pdf->cell(90,5,mb_convert_encoding('Fecha de inicio de mantenimiento', 'ISO-8859-1', 'UTF-8'),1,0, 'C', 'T');
$pdf->cell(9,5,mb_convert_encoding(''),0,0, 'C');
$pdf->cell(90,5,mb_convert_encoding('Fecha de culminación de mantenimiento', 'ISO-8859-1', 'UTF-8'),1,1, 'C', 'T');
$pdf->cell(90,5,$newDate2,1,0, 'C');
$pdf->cell(9,5,mb_convert_encoding(''),0,0, 'C');
$pdf->cell(90,5,$newDate3,1,1, 'C');
$pdf->Ln(5);
$pdf->cell(189,5,mb_convert_encoding('Observaciones', 'ISO-8859-1', 'UTF-8'),1,1, 'L', 'T');
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',7);
$pdf->Multicell(189,5,mb_convert_encoding($observaciones, 'ISO-8859-1', 'UTF-8'),1,1, 'L');
$pdf->Ln(5);
$pdf->SetFillColor(231,233,238);
$pdf->SetFont('Arial','',8);




// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>