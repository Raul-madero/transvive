<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$fecha_inicial=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];


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
   

    $newDate = date("d-m-Y", strtotime($fecha_inicial));  

   
   
//Logo
//*$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','',10);
//Encabezado
//$this->Cell(50,15,'',0,0,'r');
$this->SetFillColor(231,233,238);
$this->SetTextcolor(6,22,54);
$this->Cell(189,10,utf8_decode('Reporte de Viajes de Cliente por Día'),0,1,'C');
$this->SetFont('Arial','',9);
$this->Cell(189,5,'Del'. ' '. $newDate,0,1,'C');

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
$fecha_inicial=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

 


$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection, "SELECT rv.cliente, SUM(IF(rv.tipo_viaje NOT LIKE '%Especial%', rv.valor_vuelta, 0)) AS viajes_normales, SUM(IF(rv.tipo_viaje LIKE '%Especial%', rv.valor_vuelta, 0)) AS viajes_especiales, ur.nombres as nombresup, us.nombre FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.fecha = '$fecha_inicial' group by rv.cliente order by rv.cliente" );
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);


    //$imagen="../img/routers/".$entrada['foto'];
    // $viajestotales = $vespeciales + $vcontratos;

//ciclo de repeticion celdas
//Consulta para cuerpo tabla


$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(0, 51, 102);//Fondo verde de celda
$pdf->SetTextColor(0, 0, 0); //Letra color blanco
//$pdf->Cell(189,5,utf8_decode('Kilometraje Inicial: '.number_format($kmetraje) ),0,0,'L');



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextcolor(255,255,255);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,5,utf8_decode('Cliente'),1,0,'C', 'T');
$pdf->Cell(20,5,utf8_decode('Normales'),1,0,'C', 'T');
$pdf->Cell(20,5,utf8_decode('Especiales'),1,0,'C', 'T');
$pdf->Cell(20,5,utf8_decode('Total'),1,0,'C', 'T');
$pdf->Cell(40,5,utf8_decode('Supervisor'),1,0,'C', 'T');
$pdf->Cell(50,5,utf8_decode('Jefe Operaciones'),1,1,'C', 'T');

$pdf->SetFont('Arial','',8);

$total_cliente    = 0;
$total_normales = 0;
$total_especiales = 0;
$total_general = 0;


while ($row = mysqli_fetch_assoc($query)){
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $cliente       = $row['cliente'];
    $normales      = $row['viajes_normales'];
    $especiales    = $row['viajes_especiales'];
    $nombre        = $row['nombresup'];
    $jefe          = $row['nombre'];

    $total_normales = $total_normales + $row['viajes_normales'];
    $total_especiales = $total_especiales + $row['viajes_especiales'];

    $total_cliente = $normales + $especiales;
    $total_general = $total_general + $total_cliente;
    
$pdf->SetFont('Arial','B',6.5);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(40,5,utf8_decode($cliente),1,0,'L');
$pdf->Cell(20,5,number_format($normales,2),1,0,'R');
$pdf->Cell(20,5,number_format($especiales,2),1,0,'R');
$pdf->Cell(20,5,number_format($total_cliente,2),1,0,'R');
$pdf->Cell(40,5,utf8_decode($nombre),1,0,'L');
$pdf->Cell(50,5,utf8_decode($jefe),1,1,'L');


}
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,utf8_decode('Totales '),1,0,'R');
$pdf->Cell(20,5,number_format($total_normales,2),1,0,'R');
$pdf->Cell(20,5,number_format($total_especiales,2),1,0,'R');
$pdf->Cell(20,5,number_format($total_general,2),1,0,'R');
$pdf->Cell(40,5,utf8_decode(''),1,0,'L');
$pdf->Cell(50,5,utf8_decode(''),1,1,'L');


//$pdf->Image("$imagen",10,165,189,100,'png');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>