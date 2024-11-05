<?php

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
$idoentrada=1;
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
   

       $subtitulo1=utf8_decode('Encuesta de Satisfacción');

   
   
//Logo
$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
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
$this->Cell(30,10,'FO-TV-VT-06',1,1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
$this->Cell(15,5,'Area',1,0,'C','T');
$this->Cell(60,5,utf8_decode('Ventas'),1,0,'C');
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
$idoentrada=1;
$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT * FROM encuesta_clientes");
$result = mysqli_num_rows($query);
$x = 1;
while ($x <= $result) {
while ($entrada = mysqli_fetch_assoc($query)) {
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    $id         = $entrada['id'];
    $fcha       = $entrada['fecha'];
    $cliente    = $entrada['cliente'];
    $area       = $entrada['nombre_area'];
    $medio      = $entrada['medio'];
    $time_forma = $entrada['tiempo_forma'];
    $time_resp  = $entrada['tiempo_respuesta'];
    $disponible = $entrada['disponibilidad'];
    $calidad    = $entrada['calidad'];
    $asesoria   = $entrada['asesoria_tecnica'];
    $limpieza   = $entrada['limpieza_condicion'];
    $soperador  = $entrada['servicio_operador'];
    $conduce    = $entrada['conduce_adecuado'];
    $atencion   = $entrada['atencion_calidad'];
    $facturac   = $entrada['servicio_facturacion'];
    $precios    = $entrada['nuestros_precios'];
    $notas      = $entrada['comentarios'];
    setlocale(LC_TIME, "spanish");
    $mesEntr = strftime("%d de %B de %Y", strtotime($entrada['fecha']));


    if ($time_forma == 1) {
        $check1 = 4;
        $check2 = "";
        $check3 = "";
        $check4 = "";
        $check5 = "";
        $check6 = "";
        $check7 = "";
        $check8 = "";
        $check9 = "";
        $check10 = "";
    }else {
        if ($time_forma == 2) {
            $check1 = "";
            $check2 = 4;
            $check3 = "";
            $check4 = "";
            $check5 = "";
            $check6 = "";
            $check7 = "";
            $check8 = "";
            $check9 = "";
            $check10 = "";
        }else {
            if ($time_forma == 3) {
                $check1 = "";
                $check2 = "";
                $check3 = 4;
                $check4 = "";
                $check5 = "";
                $check6 = "";
                $check7 = "";
                $check8 = "";
                $check9 = "";
                $check10 = "";
            }else {
                if ($time_forma == 4) {
                    $check1 = "";
                    $check2 = "";
                    $check3 = "";
                    $check4 = 4;
                    $check5 = "";
                    $check6 = "";
                    $check7 = "";
                    $check8 = "";
                    $check9 = "";
                    $check10 = "";
                }else {
                    if ($time_forma == 5) {
                        $check1 = "";
                        $check2 = "";
                        $check3 = "";
                        $check4 = "";
                        $check5 = 4;
                        $check6 = "";
                        $check7 = "";
                        $check8 = "";
                        $check9 = "";
                        $check10 = "";
                    }else {
                        if ($time_forma == 6) {
                            $check1 = "";
                            $check2 = "";
                            $check3 = "";
                            $check4 = "";
                            $check5 = "";
                            $check6 = 4;
                            $check7 = "";
                            $check8 = "";
                            $check9 = "";
                            $check10 = "";
                        }else {
                            if ($time_forma == 7) {
                                $check1 = "";
                                $check2 = "";
                                $check3 = "";
                                $check4 = "";
                                $check5 = "";
                                $check6 = "";
                                $check7 = 4;
                                $check8 = "";
                                $check9 = "";
                                $check10 = "";
                            }else {
                                if ($time_forma == 8) {
                                    $check1 = "";
                                    $check2 = "";
                                    $check3 = "";
                                    $check4 = "";
                                    $check5 = "";
                                    $check6 = "";
                                    $check7 = "";
                                    $check8 = 4;
                                    $check9 = "";
                                    $check10 = "";
                                }else {
                                    if ($time_forma == 9) {
                                        $check1 = "";
                                        $check2 = "";
                                        $check3 = "";
                                        $check4 = "";
                                        $check5 = "";
                                        $check6 = "";
                                        $check7 = "";
                                        $check8 = "";
                                        $check9 = 4;
                                        $check10 = "";
                                    }else {
                                        if ($time_forma == 10) {
                                            $check1 = "";
                                            $check2 = "";
                                            $check3 = "";
                                            $check4 = "";
                                            $check5 = "";
                                            $check6 = "";
                                            $check7 = "";
                                            $check8 = "";
                                            $check9 = "";
                                            $check10 = 4;
                                        }else {
                                            $check1 = "";
                                            $check2 = "";
                                            $check3 = "";
                                            $check4 = "";
                                            $check5 = "";
                                            $check6 = "";
                                            $check7 = "";
                                            $check8 = "";
                                            $check9 = "";
                                            $check10 = "";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    if ($time_resp == 1) {
        $check1_1 = 4;
        $check2_1 = "";
        $check3_1 = "";
        $check4_1 = "";
        $check5_1 = "";
        $check6_1 = "";
        $check7_1 = "";
        $check8_1 = "";
        $check9_1 = "";
        $check10_1 = "";
    }else {
        if ($time_resp == 2) {
            $check1_1 = "";
            $check2_1 = 4;
            $check3_1 = "";
            $check4_1 = "";
            $check5_1 = "";
            $check6_1 = "";
            $check7_1 = "";
            $check8_1 = "";
            $check9_1 = "";
            $check10_1 = "";
        }else {
            if ($time_resp == 3) {
                $check1_1 = "";
                $check2_1 = "";
                $check3_1 = 4;
                $check4_1 = "";
                $check5_1 = "";
                $check6_1 = "";
                $check7_1 = "";
                $check8_1 = "";
                $check9_1 = "";
                $check10_1 = "";
            }else {
                if ($time_resp == 4) {
                    $check1_1 = "";
                    $check2_1 = "";
                    $check3_1 = "";
                    $check4_1 = 4;
                    $check5_1 = "";
                    $check6_1 = "";
                    $check7_1 = "";
                    $check8_1 = "";
                    $check9_1 = "";
                    $check10_1 = "";
                }else {
                    if ($time_resp == 5) {
                        $check1_1 = "";
                        $check2_1 = "";
                        $check3_1 = "";
                        $check4_1 = "";
                        $check5_1 = 4;
                        $check6_1 = "";
                        $check7_1 = "";
                        $check8_1 = "";
                        $check9_1 = "";
                        $check10_1 = "";
                    }else {
                        if ($time_resp == 6) {
                            $check1_1 = "";
                            $check2_1 = "";
                            $check3_1 = "";
                            $check4_1 = "";
                            $check5_1 = "";
                            $check6_1 = 4;
                            $check7_1 = "";
                            $check8_1 = "";
                            $check9_1 = "";
                            $check10_1 = "";
                        }else {
                            if ($time_resp == 7) {
                                $check1_1 = "";
                                $check2_1 = "";
                                $check3_1 = "";
                                $check4_1 = "";
                                $check5_1 = "";
                                $check6_1 = "";
                                $check7_1 = 4;
                                $check8_1 = "";
                                $check9_1 = "";
                                $check10_1 = "";
                            }else {
                                if ($time_resp == 8) {
                                    $check1_1 = "";
                                    $check2_1 = "";
                                    $check3_1 = "";
                                    $check4_1 = "";
                                    $check5_1 = "";
                                    $check6_1 = "";
                                    $check7_1 = "";
                                    $check8_1 = 4;
                                    $check9_1 = "";
                                    $check10_1 = "";
                                }else {
                                    if ($time_resp == 9) {
                                        $check1_1 = "";
                                        $check2_1 = "";
                                        $check3_1 = "";
                                        $check4_1 = "";
                                        $check5_1 = "";
                                        $check6_1 = "";
                                        $check7_1 = "";
                                        $check8_1 = "";
                                        $check9_1 = 4;
                                        $check10_1 = "";
                                    }else {
                                        if ($time_resp == 10) {
                                            $check1_1 = "";
                                            $check2_1 = "";
                                            $check3_1 = "";
                                            $check4_1 = "";
                                            $check5_1 = "";
                                            $check6_1 = "";
                                            $check7_1 = "";
                                            $check8_1 = "";
                                            $check9_1 = "";
                                            $check10_1 = 4;
                                        }else {
                                            $check1_1 = "";
                                            $check2_1 = "";
                                            $check3_1 = "";
                                            $check4_1 = "";
                                            $check5_1 = "";
                                            $check6_1 = "";
                                            $check7_1 = "";
                                            $check8_1 = "";
                                            $check9_1 = "";
                                            $check10_1 = "";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    switch ($disponible):
    case 1:
        $check1_2 = 4;
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 2:
        $check1_2 = "";
        $check2_2 = 4;
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 3:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = 4;
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 4:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = 4;
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 5:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = 4;
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;  
    case 6:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = 4;
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 7:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = 4;
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = "";
        break;
    case 8:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = 4;
        $check9_2 = "";
        $check10_2 = "";
        break; 
    case 9:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = 4;
        $check10_2 = "";
        break; 
    case 10:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 = 4;
        break;          
    default:
        $check1_2 = "";
        $check2_2 = "";
        $check3_2 = "";
        $check4_2 = "";
        $check5_2 = "";
        $check6_2 = "";
        $check7_2 = "";
        $check8_2 = "";
        $check9_2 = "";
        $check10_2 ="";
endswitch;

switch ($calidad):
    case 1:
        $check1_3 = 4;
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 2:
        $check1_3 = "";
        $check2_3 = 4;
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 3:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = 4;
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 4:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = 4;
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 5:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = 4;
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;  
    case 6:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = 4;
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 7:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = 4;
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = "";
        break;
    case 8:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = 4;
        $check9_3 = "";
        $check10_3 = "";
        break; 
    case 9:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = 4;
        $check10_3 = "";
        break; 
    case 10:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 = 4;
        break;          
    default:
        $check1_3 = "";
        $check2_3 = "";
        $check3_3 = "";
        $check4_3 = "";
        $check5_3 = "";
        $check6_3 = "";
        $check7_3 = "";
        $check8_3 = "";
        $check9_3 = "";
        $check10_3 ="";
endswitch;

switch ($asesoria):
    case 1:
        $check1_4 = 4;
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 2:
        $check1_4 = "";
        $check2_4 = 4;
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 3:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = 4;
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 4:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = 4;
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 5:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = 4;
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;  
    case 6:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = 4;
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 7:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = 4;
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = "";
        break;
    case 8:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = 4;
        $check9_4 = "";
        $check10_4 = "";
        break; 
    case 9:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = 4;
        $check10_4 = "";
        break; 
    case 10:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 = 4;
        break;          
    default:
        $check1_4 = "";
        $check2_4 = "";
        $check3_4 = "";
        $check4_4 = "";
        $check5_4 = "";
        $check6_4 = "";
        $check7_4 = "";
        $check8_4 = "";
        $check9_4 = "";
        $check10_4 ="";
endswitch;

switch ($limpieza):
    case 1:
        $check1_5 = 4;
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 2:
        $check1_5 = "";
        $check2_5 = 4;
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 3:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = 4;
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 4:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = 4;
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 5:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = 4;
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;  
    case 6:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = 4;
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 7:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = 4;
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = "";
        break;
    case 8:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = 4;
        $check9_5 = "";
        $check10_5 = "";
        break; 
    case 9:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = 4;
        $check10_5 = "";
        break; 
    case 10:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 = 4;
        break;          
    default:
        $check1_5 = "";
        $check2_5 = "";
        $check3_5 = "";
        $check4_5 = "";
        $check5_5 = "";
        $check6_5 = "";
        $check7_5 = "";
        $check8_5 = "";
        $check9_5 = "";
        $check10_5 ="";
endswitch;

switch ($soperador):
    case 1:
        $check1_6 = 4;
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 2:
        $check1_6 = "";
        $check2_6 = 4;
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 3:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = 4;
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 4:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = 4;
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 5:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = 4;
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;  
    case 6:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = 4;
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 7:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = 4;
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = "";
        break;
    case 8:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = 4;
        $check9_6 = "";
        $check10_6 = "";
        break; 
    case 9:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = 4;
        $check10_6 = "";
        break; 
    case 10:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 = 4;
        break;          
    default:
        $check1_6 = "";
        $check2_6 = "";
        $check3_6 = "";
        $check4_6 = "";
        $check5_6 = "";
        $check6_6 = "";
        $check7_6 = "";
        $check8_6 = "";
        $check9_6 = "";
        $check10_6 ="";
endswitch;

switch ($conduce):
    case 1:
        $check1_7 = 4;
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = "";
        break;
    case 2:
        $check1_7 = "";
        $check2_7 = 4;
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = "";
        break;
    case 3:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = 4;
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = "";
        break;
    case 4:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = 4;
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = "";
        break;
    case 5:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = 4;
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = "";
        break;  
    case 6:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = 4;
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = "";
        break;
    case 7:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = 4;
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = "";
        break;
    case 8:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = 4;
        $check9_7 = "";
        $check10_7 = "";
        break; 
    case 9:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = 4;
        $check10_7 = "";
        break; 
    case 10:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 = 4;
        break;          
    default:
        $check1_7 = "";
        $check2_7 = "";
        $check3_7 = "";
        $check4_7 = "";
        $check5_7 = "";
        $check6_7 = "";
        $check7_7 = "";
        $check8_7 = "";
        $check9_7 = "";
        $check10_7 ="";
endswitch;

switch ($atencion):
    case 1:
        $check1_8 = 4;
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = "";
        break;
    case 2:
        $check1_8 = "";
        $check2_8 = 4;
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = "";
        break;
    case 3:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = 4;
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = "";
        break;
    case 4:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = 4;
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = "";
        break;
    case 5:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = 4;
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = "";
        break;  
    case 6:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = 4;
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = "";
        break;
    case 7:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = 4;
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = "";
        break;
    case 8:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = 4;
        $check9_8 = "";
        $check10_8 = "";
        break; 
    case 9:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = 4;
        $check10_8 = "";
        break; 
    case 10:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 = 4;
        break;          
    default:
        $check1_8 = "";
        $check2_8 = "";
        $check3_8 = "";
        $check4_8 = "";
        $check5_8 = "";
        $check6_8 = "";
        $check7_8 = "";
        $check8_8 = "";
        $check9_8 = "";
        $check10_8 ="";
endswitch;

switch ($facturac):
    case 1:
        $check1_9 = 4;
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = "";
        break;
    case 2:
        $check1_9 = "";
        $check2_9 = 4;
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = "";
        break;
    case 3:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = 4;
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = "";
        break;
    case 4:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = 4;
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = "";
        break;
    case 5:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = 4;
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = "";
        break;  
    case 6:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = 4;
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = "";
        break;
    case 7:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = 4;
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = "";
        break;
    case 8:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = 4;
        $check9_9 = "";
        $check10_9 = "";
        break; 
    case 9:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = 4;
        $check10_9 = "";
        break; 
    case 10:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 = 4;
        break;          
    default:
        $check1_9 = "";
        $check2_9 = "";
        $check3_9 = "";
        $check4_9 = "";
        $check5_9 = "";
        $check6_9 = "";
        $check7_9 = "";
        $check8_9 = "";
        $check9_9 = "";
        $check10_9 ="";
endswitch;

switch ($precios):
    case 1:
        $check1_10 = 4;
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = "";
        break;
    case 2:
        $check1_10 = "";
        $check2_10 = 4;
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = "";
        break;
    case 3:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = 4;
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = "";
        break;
    case 4:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = 4;
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = "";
        break;
    case 5:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = 4;
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = "";
        break;  
    case 6:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = 4;
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = "";
        break;
    case 7:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = 4;
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = "";
        break;
    case 8:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = 4;
        $check9_10 = "";
        $check10_10 = "";
        break; 
    case 9:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = 4;
        $check10_10 = "";
        break; 
    case 10:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 = 4;
        break;          
    default:
        $check1_10 = "";
        $check2_10 = "";
        $check3_10 = "";
        $check4_10 = "";
        $check5_10 = "";
        $check6_10 = "";
        $check7_10 = "";
        $check8_10 = "";
        $check9_10 = "";
        $check10_10 ="";
endswitch;



   // $imagen="../img/routers/".$entrada['foto'];
    

//ciclo de repeticion celdas
//Consulta para cuerpo tabla

$pdf->Ln(8);


$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->SetTextcolor(0,0,0);



$pdf->SetTextcolor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextcolor(0,0,0);
$pdf->Cell(189,5,utf8_decode('1. Fecha:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(189,5,utf8_decode($mesEntr),1,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('2. Nombre de la empresa:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(189,5,utf8_decode($cliente),1,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('3. Nombre y área del responsable:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(189,5,utf8_decode($area),1,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('4. Menciona el medio de contacto por el cual nos conoció:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(189,5,utf8_decode($medio),1,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(189,5,utf8_decode('5. Por favor, indiquenos la opción que mejor describa su opinión o que usted considere nos represente, de los siguientes aspectos (siendo 10 el de mayor satosfacción):'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Ln(5);
$pdf->Cell(120,5,utf8_decode(''),0,0,'L');
$pdf->Cell(69,5,utf8_decode('10     9     8     7     6     5     4     3     2     1'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Atención general'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10.'       '.$check9.'     '.$check8.'     '.$check7.'      '.$check6.'     '.$check5.'      '.$check4.'     '.$check3.'      '.$check2.'      '.$check1, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Tiempo de respuesta'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_1.'       '.$check9_1.'     '.$check8_1.'     '.$check7_1.'      '.$check6_1.'     '.$check5_1.'      '.$check4_1.'     '.$check3_1.'      '.$check2_1.'      '.$check1_1, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Disponibilidad del servicio'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_2.'       '.$check9_2.'     '.$check8_2.'     '.$check7_2.'      '.$check6_2.'     '.$check5_2.'      '.$check4_2.'     '.$check3_2.'      '.$check2_2.'      '.$check1_2, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Calidad de nuestros servicios'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_3.'       '.$check9_3.'     '.$check8_3.'      '.$check7_3.'      '.$check6_3.'     '.$check5_3.'      '.$check4_3.'     '.$check3_3.'      '.$check2_3.'      '.$check1_3, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Asesoria técnica (tipo de unidades, modelos, capacidad de pasajeros)'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_4.'       '.$check9_4.'     '.$check8_4.'     '.$check7_4.'      '.$check6_4.'     '.$check5_4.'      '.$check4_4.'     '.$check3_4.'      '.$check2_4.'      '.$check1_4, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Limpieza y condición de unidades'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_5.'       '.$check9_5.'     '.$check8_5.'     '.$check7_5.'      '.$check6_5.'     '.$check5_5.'      '.$check4_5.'     '.$check3_5.'      '.$check2_5.'      '.$check1_5, 0, 1);

$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Atención, servicio, limpieza y presentación del operador'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_6.'       '.$check9_6.'     '.$check8_6.'      '.$check7_6.'      '.$check6_6.'     '.$check5_6.'      '.$check4_6.'     '.$check3_6.'      '.$check2_6.'      '.$check1_6, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('El operador conduce la unidad adecuadamente'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_7.'       '.$check9_7.'     '.$check8_7.'     '.$check7_7.'      '.$check6_7.'     '.$check5_7.'      '.$check4_7.'     '.$check3_7.'      '.$check2_7.'      '.$check1_7, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Atencion y servicio del área de calidad'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_8.'       '.$check9_8.'     '.$check8_8.'      '.$check7_8.'      '.$check6_8.'     '.$check5_8.'      '.$check4_8.'     '.$check3_8.'      '.$check2_8.'      '.$check1_8, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Como considera el servico de facturación'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_9.'       '.$check9_9.'     '.$check8_9.'     '.$check7_9.'      '.$check6_9.'     '.$check5_9.'      '.$check4_9.'     '.$check3_9.'      '.$check2_9.'      '.$check1_9, 0, 1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(120, 5, utf8_decode('Nuestros precios'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(69, 5, $check10_10.'       '.$check9_10.'     '.$check8_10.'     '.$check7_10.'      '.$check6_10.'     '.$check5_10.'      '.$check4_10.'     '.$check3_10.'      '.$check2_10.'      '.$check1_10, 0, 1);

$pdf->SetFont('Arial','',8);

$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('6. Sugerencias o comentarios:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(189,5,utf8_decode($notas),0,1,'L');


//Salto de pagina
$x = $x +1;
if ($x <= $result) {
   $pdf->Ln(5);
$pdf->AddPage('portrait','letter');
}
//$pdf->Ln(5);
//$pdf->AddPage();
//$pdf->Image("$imagen",10,165,189,100,'png');
}
}
// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
$pdf->Output();
?>