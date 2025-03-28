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
$this->Cell(15,15,utf8_decode('Título'),1,0,'C','T');
$this->Cell(75,10,$subtitulo1,1,0,'C');
$this->Cell(19,10,utf8_decode('Código'),'T,R',0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,10,'FO-TV-AC-14','T,R',1,'C');
$this->SetFont('Arial','',10);
$this->Cell(65,10,'',0,0,'r');
$this->Cell(15,5,utf8_decode('Área'),1,0,'C','T');
$this->Cell(60,5,utf8_decode('Aseguramiento de Calidad'),1,0,'C');
$this->Cell(19,5,utf8_decode(''),'B,R',0,'C','T');
$this->SetFont('Arial','',8);
$this->Cell(30,5,'','B,R',0,'C');




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
$anio = date("Y");
$pdf=new PDF();
$pdf->AddPage('portrait','letter');
$query = mysqli_query($conection,"SELECT * FROM newencuesta_clientes WHERE YEAR(fecha) = '$anio' AND id = '$idoentrada'") or die(mysqli_error($conection));
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
    $s_vntas    = $entrada['servicio_ventas'];
    $s_superv   = $entrada['servicio_supervisor'];
    $s_jefe     = $entrada['servicio_jefe'];
    $s_quejas   = $entrada['servicio_quejas'];
    $s_info     = $entrada['info_cobranza'];
    $notas_cob  = $entrada['notas_cobranza'];
    $seguimto   = $entrada['llama_seguimiento'];
    $scalidad   = $entrada['significa_calidad'];
    $r_info     = $entrada['recibir_info'];
    $r_lunes    = $entrada['rec_lunes'];
    $r_martes   = $entrada['rec_martes'];
    $r_miercol  = $entrada['rec_miercoles'];
    $r_jueves   = $entrada['rec_jueves'];
    $r_viernes  = $entrada['rec_viernes'];
    $r_sabado   = $entrada['rec_sabado'];

    setlocale(LC_TIME, "spanish");
    $mesEntr = strftime("%d de %B de %Y", strtotime($entrada['fecha']));


    if ($time_forma == 1) {
        $check1 = 4;
        $check2 = "m";
        $check3 = "m";
        $check4 = "m";
        $check5 = "m";
        $check6 = "m";
        $check7 = "m";
        $check8 = "m";
        $check9 = "m";
        $check10 = "m";
    }else {
        if ($time_forma == 2) {
            $check1 = "m";
            $check2 = 4;
            $check3 = "m";
            $check4 = "m";
            $check5 = "m";
            $check6 = "m";
            $check7 = "m";
            $check8 = "m";
            $check9 = "m";
            $check10 = "m";
        }else {
            if ($time_forma == 3) {
                $check1 = "m";
                $check2 = "m";
                $check3 = 4;
                $check4 = "m";
                $check5 = "m";
                $check6 = "m";
                $check7 = "m";
                $check8 = "m";
                $check9 = "m";
                $check10 = "m";
            }else {
                if ($time_forma == 4) {
                    $check1 = "m";
                    $check2 = "m";
                    $check3 = "m";
                    $check4 = 4;
                    $check5 = "m";
                    $check6 = "m";
                    $check7 = "m";
                    $check8 = "m";
                    $check9 = "m";
                    $check10 = "m";
                }else {
                    if ($time_forma == 5) {
                        $check1 = "m";
                        $check2 = "m";
                        $check3 = "m";
                        $check4 = "m";
                        $check5 = 4;
                        $check6 = "m";
                        $check7 = "m";
                        $check8 = "m";
                        $check9 = "m";
                        $check10 = "m";
                    }else {
                        if ($time_forma == 6) {
                            $check1 = "m";
                            $check2 = "m";
                            $check3 = "m";
                            $check4 = "m";
                            $check5 = "m";
                            $check6 = 4;
                            $check7 = "m";
                            $check8 = "m";
                            $check9 = "m";
                            $check10 = "m";
                        }else {
                            if ($time_forma == 7) {
                                $check1 = "m";
                                $check2 = "m";
                                $check3 = "m";
                                $check4 = "m";
                                $check5 = "m";
                                $check6 = "m";
                                $check7 = 4;
                                $check8 = "m";
                                $check9 = "m";
                                $check10 = "m";
                            }else {
                                if ($time_forma == 8) {
                                    $check1 = "m";
                                    $check2 = "m";
                                    $check3 = "m";
                                    $check4 = "m";
                                    $check5 = "m";
                                    $check6 = "m";
                                    $check7 = "m";
                                    $check8 = 4;
                                    $check9 = "m";
                                    $check10 = "m";
                                }else {
                                    if ($time_forma == 9) {
                                        $check1 = "m";
                                        $check2 = "m";
                                        $check3 = "m";
                                        $check4 = "m";
                                        $check5 = "m";
                                        $check6 = "m";
                                        $check7 = "m";
                                        $check8 = "m";
                                        $check9 = 4;
                                        $check10 = "m";
                                    }else {
                                        if ($time_forma == 10) {
                                            $check1 = "m";
                                            $check2 = "m";
                                            $check3 = "m";
                                            $check4 = "m";
                                            $check5 = "m";
                                            $check6 = "m";
                                            $check7 = "m";
                                            $check8 = "m";
                                            $check9 = "m";
                                            $check10 = 4;
                                        }else {
                                            $check1 = "m";
                                            $check2 = "m";
                                            $check3 = "m";
                                            $check4 = "m";
                                            $check5 = "m";
                                            $check6 = "m";
                                            $check7 = "m";
                                            $check8 = "m";
                                            $check9 = "m";
                                            $check10 = "m";
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
        $check2_1 = "m";
        $check3_1 = "m";
        $check4_1 = "m";
        $check5_1 = "m";
        $check6_1 = "m";
        $check7_1 = "m";
        $check8_1 = "m";
        $check9_1 = "m";
        $check10_1 = "m";
    }else {
        if ($time_resp == 2) {
            $check1_1 = "m";
            $check2_1 = 4;
            $check3_1 = "m";
            $check4_1 = "m";
            $check5_1 = "m";
            $check6_1 = "m";
            $check7_1 = "m";
            $check8_1 = "m";
            $check9_1 = "m";
            $check10_1 = "m";
        }else {
            if ($time_resp == 3) {
                $check1_1 = "m";
                $check2_1 = "m";
                $check3_1 = 4;
                $check4_1 = "m";
                $check5_1 = "m";
                $check6_1 = "m";
                $check7_1 = "m";
                $check8_1 = "m";
                $check9_1 = "m";
                $check10_1 = "m";
            }else {
                if ($time_resp == 4) {
                    $check1_1 = "m";
                    $check2_1 = "m";
                    $check3_1 = "m";
                    $check4_1 = 4;
                    $check5_1 = "m";
                    $check6_1 = "m";
                    $check7_1 = "m";
                    $check8_1 = "m";
                    $check9_1 = "m";
                    $check10_1 = "m";
                }else {
                    if ($time_resp == 5) {
                        $check1_1 = "m";
                        $check2_1 = "m";
                        $check3_1 = "m";
                        $check4_1 = "m";
                        $check5_1 = 4;
                        $check6_1 = "m";
                        $check7_1 = "m";
                        $check8_1 = "m";
                        $check9_1 = "m";
                        $check10_1 = "m";
                    }else {
                        if ($time_resp == 6) {
                            $check1_1 = "m";
                            $check2_1 = "m";
                            $check3_1 = "m";
                            $check4_1 = "m";
                            $check5_1 = "m";
                            $check6_1 = 4;
                            $check7_1 = "m";
                            $check8_1 = "m";
                            $check9_1 = "m";
                            $check10_1 = "m";
                        }else {
                            if ($time_resp == 7) {
                                $check1_1 = "m";
                                $check2_1 = "m";
                                $check3_1 = "m";
                                $check4_1 = "m";
                                $check5_1 = "m";
                                $check6_1 = "m";
                                $check7_1 = 4;
                                $check8_1 = "m";
                                $check9_1 = "m";
                                $check10_1 = "m";
                            }else {
                                if ($time_resp == 8) {
                                    $check1_1 = "m";
                                    $check2_1 = "m";
                                    $check3_1 = "m";
                                    $check4_1 = "m";
                                    $check5_1 = "m";
                                    $check6_1 = "m";
                                    $check7_1 = "m";
                                    $check8_1 = 4;
                                    $check9_1 = "m";
                                    $check10_1 = "m";
                                }else {
                                    if ($time_resp == 9) {
                                        $check1_1 = "m";
                                        $check2_1 = "m";
                                        $check3_1 = "m";
                                        $check4_1 = "m";
                                        $check5_1 = "m";
                                        $check6_1 = "m";
                                        $check7_1 = "m";
                                        $check8_1 = "m";
                                        $check9_1 = 4;
                                        $check10_1 = "m";
                                    }else {
                                        if ($time_resp == 10) {
                                            $check1_1 = "m";
                                            $check2_1 = "m";
                                            $check3_1 = "m";
                                            $check4_1 = "m";
                                            $check5_1 = "m";
                                            $check6_1 = "m";
                                            $check7_1 = "m";
                                            $check8_1 = "m";
                                            $check9_1 = "m";
                                            $check10_1 = 4;
                                        }else {
                                            $check1_1 = "m";
                                            $check2_1 = "m";
                                            $check3_1 = "m";
                                            $check4_1 = "m";
                                            $check5_1 = "m";
                                            $check6_1 = "m";
                                            $check7_1 = "m";
                                            $check8_1 = "m";
                                            $check9_1 = "m";
                                            $check10_1 = "m";
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
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = "m";
        break;
    case 2:
        $check1_2 = "m";
        $check2_2 = 4;
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = "m";
        break;
    case 3:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = 4;
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = "m";
        break;
    case 4:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = 4;
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = "m";
        break;
    case 5:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = 4;
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = "m";
        break;  
    case 6:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = 4;
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = "m";
        break;
    case 7:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = 4;
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = "m";
        break;
    case 8:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = 4;
        $check9_2 = "m";
        $check10_2 = "m";
        break; 
    case 9:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = 4;
        $check10_2 = "m";
        break; 
    case 10:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 = 4;
        break;          
    default:
        $check1_2 = "m";
        $check2_2 = "m";
        $check3_2 = "m";
        $check4_2 = "m";
        $check5_2 = "m";
        $check6_2 = "m";
        $check7_2 = "m";
        $check8_2 = "m";
        $check9_2 = "m";
        $check10_2 ="m";
endswitch;

switch ($calidad):
    case 1:
        $check1_3 = 4;
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 = "m";
        break;
    case 2:
        $check1_3 = "m";
        $check2_3 = 4;
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 = "m";
        break;
    case 3:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = 4;
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 = "m";
        break;
    case 4:
        $check1_3 = "mm";
        $check2_3 = "mm";
        $check3_3 = "mm";
        $check4_3 = 4;
        $check5_3 = "mm";
        $check6_3 = "mm";
        $check7_3 = "mm";
        $check8_3 = "mm";
        $check9_3 = "mm";
        $check10_3 = "mm";
        break;
    case 5:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = 4;
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 = "m";
        break;  
    case 6:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = 4;
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 = "m";
        break;
    case 7:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = 4;
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 = "m";
        break;
    case 8:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = 4;
        $check9_3 = "m";
        $check10_3 = "m";
        break; 
    case 9:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = 4;
        $check10_3 = "m";
        break; 
    case 10:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 = 4;
        break;          
    default:
        $check1_3 = "m";
        $check2_3 = "m";
        $check3_3 = "m";
        $check4_3 = "m";
        $check5_3 = "m";
        $check6_3 = "m";
        $check7_3 = "m";
        $check8_3 = "m";
        $check9_3 = "m";
        $check10_3 ="m";
endswitch;

switch ($asesoria):
    case 1:
        $check1_4 = 4;
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = "m";
        break;
    case 2:
        $check1_4 = "m";
        $check2_4 = 4;
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = "m";
        break;
    case 3:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = 4;
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = "m";
        break;
    case 4:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = 4;
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = "m";
        break;
    case 5:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = 4;
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = "m";
        break;  
    case 6:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = 4;
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = "m";
        break;
    case 7:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = 4;
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = "m";
        break;
    case 8:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = 4;
        $check9_4 = "m";
        $check10_4 = "m";
        break; 
    case 9:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = 4;
        $check10_4 = "m";
        break; 
    case 10:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 = 4;
        break;          
    default:
        $check1_4 = "m";
        $check2_4 = "m";
        $check3_4 = "m";
        $check4_4 = "m";
        $check5_4 = "m";
        $check6_4 = "m";
        $check7_4 = "m";
        $check8_4 = "m";
        $check9_4 = "m";
        $check10_4 ="m";
endswitch;

switch ($limpieza):
    case 1:
        $check1_5 = 4;
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = "m";
        break;
    case 2:
        $check1_5 = "m";
        $check2_5 = 4;
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = "m";
        break;
    case 3:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = 4;
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = "m";
        break;
    case 4:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = 4;
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = "m";
        break;
    case 5:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = 4;
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = "m";
        break;  
    case 6:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = 4;
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = "m";
        break;
    case 7:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = 4;
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = "m";
        break;
    case 8:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = 4;
        $check9_5 = "m";
        $check10_5 = "m";
        break; 
    case 9:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = 4;
        $check10_5 = "m";
        break; 
    case 10:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 = 4;
        break;          
    default:
        $check1_5 = "m";
        $check2_5 = "m";
        $check3_5 = "m";
        $check4_5 = "m";
        $check5_5 = "m";
        $check6_5 = "m";
        $check7_5 = "m";
        $check8_5 = "m";
        $check9_5 = "m";
        $check10_5 ="m";
endswitch;

switch ($soperador):
    case 1:
        $check1_6 = 4;
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = "m";
        break;
    case 2:
        $check1_6 = "m";
        $check2_6 = 4;
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = "m";
        break;
    case 3:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = 4;
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = "m";
        break;
    case 4:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = 4;
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = "m";
        break;
    case 5:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = 4;
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = "m";
        break;  
    case 6:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = 4;
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = "m";
        break;
    case 7:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = 4;
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = "m";
        break;
    case 8:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = 4;
        $check9_6 = "m";
        $check10_6 = "m";
        break; 
    case 9:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = 4;
        $check10_6 = "m";
        break; 
    case 10:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 = 4;
        break;          
    default:
        $check1_6 = "m";
        $check2_6 = "m";
        $check3_6 = "m";
        $check4_6 = "m";
        $check5_6 = "m";
        $check6_6 = "m";
        $check7_6 = "m";
        $check8_6 = "m";
        $check9_6 = "m";
        $check10_6 ="m";
endswitch;

switch ($conduce):
    case 1:
        $check1_7 = 4;
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = "m";
        break;
    case 2:
        $check1_7 = "m";
        $check2_7 = 4;
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = "m";
        break;
    case 3:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = 4;
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = "m";
        break;
    case 4:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = 4;
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = "m";
        break;
    case 5:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = 4;
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = "m";
        break;  
    case 6:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = 4;
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = "m";
        break;
    case 7:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = 4;
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = "m";
        break;
    case 8:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = 4;
        $check9_7 = "m";
        $check10_7 = "m";
        break; 
    case 9:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = 4;
        $check10_7 = "m";
        break; 
    case 10:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 = 4;
        break;          
    default:
        $check1_7 = "m";
        $check2_7 = "m";
        $check3_7 = "m";
        $check4_7 = "m";
        $check5_7 = "m";
        $check6_7 = "m";
        $check7_7 = "m";
        $check8_7 = "m";
        $check9_7 = "m";
        $check10_7 ="m";
endswitch;

switch ($atencion):
    case 1:
        $check1_8 = 4;
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = "m";
        break;
    case 2:
        $check1_8 = "m";
        $check2_8 = 4;
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = "m";
        break;
    case 3:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = 4;
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = "m";
        break;
    case 4:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = 4;
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = "m";
        break;
    case 5:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = 4;
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = "m";
        break;  
    case 6:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = 4;
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = "m";
        break;
    case 7:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = 4;
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = "m";
        break;
    case 8:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = 4;
        $check9_8 = "m";
        $check10_8 = "m";
        break; 
    case 9:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = 4;
        $check10_8 = "m";
        break; 
    case 10:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 = 4;
        break;          
    default:
        $check1_8 = "m";
        $check2_8 = "m";
        $check3_8 = "m";
        $check4_8 = "m";
        $check5_8 = "m";
        $check6_8 = "m";
        $check7_8 = "m";
        $check8_8 = "m";
        $check9_8 = "m";
        $check10_8 ="m";
endswitch;

switch ($facturac):
    case 1:
        $check1_9 = 4;
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = "m";
        break;
    case 2:
        $check1_9 = "m";
        $check2_9 = 4;
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = "m";
        break;
    case 3:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = 4;
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = "m";
        break;
    case 4:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = 4;
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = "m";
        break;
    case 5:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = 4;
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = "m";
        break;  
    case 6:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = 4;
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = "m";
        break;
    case 7:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = 4;
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = "m";
        break;
    case 8:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = 4;
        $check9_9 = "m";
        $check10_9 = "m";
        break; 
    case 9:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = 4;
        $check10_9 = "m";
        break; 
    case 10:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 = 4;
        break;          
    default:
        $check1_9 = "m";
        $check2_9 = "m";
        $check3_9 = "m";
        $check4_9 = "m";
        $check5_9 = "m";
        $check6_9 = "m";
        $check7_9 = "m";
        $check8_9 = "m";
        $check9_9 = "m";
        $check10_9 ="m";
endswitch;

switch ($precios):
    case 1:
        $check1_10 = 4;
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = "m";
        break;
    case 2:
        $check1_10 = "m";
        $check2_10 = 4;
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = "m";
        break;
    case 3:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = 4;
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = "m";
        break;
    case 4:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = 4;
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = "m";
        break;
    case 5:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = 4;
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = "m";
        break;  
    case 6:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = 4;
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = "m";
        break;
    case 7:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = 4;
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = "m";
        break;
    case 8:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = 4;
        $check9_10 = "m";
        $check10_10 = "m";
        break; 
    case 9:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = 4;
        $check10_10 = "m";
        break; 
    case 10:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 = 4;
        break;          
    default:
        $check1_10 = "m";
        $check2_10 = "m";
        $check3_10 = "m";
        $check4_10 = "m";
        $check5_10 = "m";
        $check6_10 = "m";
        $check7_10 = "m";
        $check8_10 = "m";
        $check9_10 = "m";
        $check10_10 ="m";
endswitch;

if ($s_vntas == "Excelente") {
        $check1_s1 = 4;
        $check2_s1 = "o";
        $check3_s1 = "o";
        $check4_s1 = "o";
        
    }else {
        if ($s_vntas == "Bueno") {
            $check1_s1 = "o";
            $check2_s1 = 4;
            $check3_s1 = "o";
            $check4_s1 = "o";
            
        }else {
            if ($s_vntas == "Regular") {
                $check1_s1 = "o";
                $check2_s1 = "o";
                $check3_s1 = 4;
                $check4_s1 = "o";
                
            }else {
                if ($s_vntas == "Malo") {
                    $check1_s1 = "o";
                    $check2_s1 = "o";
                    $check3_s1 = "o";
                    $check4_s1 = 4;
                }else {
                        $check1_s1 = "o";
                        $check2_s1 = "o";
                        $check3_s1 = "o";
                        $check4_s1 = "o";
                    }
               }
           }
       }

    if ($s_superv == "Excelente") {
        $check1_s2 = 4;
        $check2_s2 = "o";
        $check3_s2 = "o";
        $check4_s2 = "o";
        
    }else {
        if ($s_superv == "Bueno") {
            $check1_s2 = "o";
            $check2_s2 = 4;
            $check3_s2 = "o";
            $check4_s2 = "o";
            
        }else {
            if ($s_superv == "Regular") {
                $check1_s2 = "o";
                $check2_s2 = "o";
                $check3_s2 = 4;
                $check4_s2 = "o";
                
            }else {
                if ($s_superv == "Malo") {
                    $check1_s2 = "o";
                    $check2_s2 = "o";
                    $check3_s2 = "o";
                    $check4_s2 = 4;
                }else {
                        $check1_s2 = "o";
                        $check2_s2 = "o";
                        $check3_s2 = "o";
                        $check4_s2 = "o";
                    }
               }
           }
       }   


    if ($s_jefe == "Excelente") {
        $check1_s3 = 4;
        $check2_s3 = "o";
        $check3_s3 = "o";
        $check4_s3 = "o";
        
    }else {
        if ($s_jefe == "Bueno") {
            $check1_s3 = "o";
            $check2_s3 = 4;
            $check3_s3 = "o";
            $check4_s3 = "o";
            
        }else {
            if ($s_jefe == "Regular") {
                $check1_s3 = "o";
                $check2_s3 = "o";
                $check3_s3 = 4;
                $check4_s3 = "o";
                
            }else {
                if ($s_jefe == "Malo") {
                    $check1_s3 = "o";
                    $check2_s3 = "o";
                    $check3_s3 = "o";
                    $check4_s3 = 4;
                }else {
                        $check1_s3 = "o";
                        $check2_s3 = "o";
                        $check3_s3 = "o";
                        $check4_s3 = "o";
                    }
               }
           }
       }   

    if ($s_quejas == "Excelente") {
        $check1_s4 = 4;
        $check2_s4 = "o";
        $check3_s4 = "o";
        $check4_s4 = "o";
        
    }else {
        if ($s_quejas == "Bueno") {
            $check1_s4 = "o";
            $check2_s4 = 4;
            $check3_s4 = "o";
            $check4_s4 = "o";
            
        }else {
            if ($s_quejas == "Regular") {
                $check1_s4 = "o";
                $check2_s4 = "o";
                $check3_s4 = 4;
                $check4_s4 = "o";
                
            }else {
                if ($s_quejas == "Malo") {
                    $check1_s4 = "o";
                    $check2_s4 = "o";
                    $check3_s4 = "o";
                    $check4_s4 = 4;
                }else {
                        $check1_s4 = "o";
                        $check2_s4 = "o";
                        $check3_s4 = "o";
                        $check4_s4 = "o";
                    }
               }
           }
       }   

      if ($s_info == "SI") {
        $check1_s5 = 4;
        $check2_s5 = "o";
        
    }else {
        if ($s_info == "NO") {
            $check1_s5 = "o";
            $check2_s5 = 4;
            
        }else {
            
            $check1_s5 = "o";
            $check2_s5 = "o";
        }
        }


if ($seguimto == "Bueno") {
        $check1_s6 = 4;
        $check2_s6 = "o";
        $check3_s6 = "o";
        $check4_s6 = "o";
        $check5_s6 = "o";
        
    }else {
        if ($seguimto == "Amable") {
            $check1_s6 = "o";
            $check2_s6 = 4;
            $check3_s6 = "o";
            $check4_s6 = "o";
            $check5_s6 = "o";
            
        }else {
            if ($seguimto == "Normal") {
                $check1_s6 = "o";
                $check2_s6 = "o";
                $check3_s6 = 4;
                $check4_s6 = "o";
                $check5_s6 = "o";
                
            }else {
                if ($seguimto == "Malo") {
                    $check1_s6 = "o";
                    $check2_s6 = "o";
                    $check3_s6 = "o";
                    $check4_s6 = 4;
                    $check5_s6 = "o";
                }else {
                    if ($seguimto == "Pesimo") {
                        $check1_s6 = "o";
                        $check2_s6 = "o";
                        $check3_s6 = "o";
                        $check4_s6 = "o";
                        $check5_s6 = 4;
                    }else {
                        $check1_s6 = "o";
                        $check2_s6 = "o";
                        $check3_s6 = "o";
                        $check4_s6 = "o";
                        $check5_s6 = "o";
                    }
               }
           }
       }           
       } 


     if ($r_info == "SI") {
        $check1_s7 = 4;
        $check2_s7 = "o";
        
    }else {
        if ($r_info == "NO") {
            $check1_s7 = "o";
            $check2_s7 = 4;
            
        }else {
            
            $check1_s7 = "o";
            $check2_s7 = "o";
        }
        }            

    if ($r_lunes == "Lunes") {
        $check1_s8 = 4;       
    }  else {
        $check1_s8 = "";
    }

    if ($r_martes == "Martes") {
        $check1_s9 = 4;       
    }else {
        $check1_s9 = "";
    }

    if ($r_miercol == "Miercoles") {
        $check1_s10 = 4;     
    } else {
      $check1_s10 = "";  
    } 

    if ($r_jueves == "Jueves") {
        $check1_s11 = 4;     
    } else {
         $check1_s11 = "";
    }

    if ($r_viernes == "Viernes") {
        $check1_s12 = 4;          
    } else {
        $check1_s12 = "";
    } 

    if ($r_sabado == "Sabado") {
        $check1_s13 = 4;      
    } else {
        $check1_s13 = "";
    }        

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
$pdf->Cell(60,5,utf8_decode('1. Fecha:'),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(129,5,utf8_decode($mesEntr),'B',1,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,utf8_decode('2. Nombre de la empresa:'),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(129,5,utf8_decode($cliente),'B',1,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,utf8_decode('3. Nombre y área del responsable:'),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(129,5,utf8_decode($area),'B',1,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(89,5,utf8_decode('4. Menciona el medio de contacto por el cual nos conoció:'),0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(100,5,utf8_decode($medio),'B',1,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(189,5,utf8_decode('5. Por favor, indiquenos la opción que mejor describa su opinión o que usted considere nos represente, de los siguientes aspectos (siendo 10 el de mayor satosfacción):'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Ln(2);
$pdf->SetFillColor(231,233,238);
$pdf->Cell(89,5,utf8_decode(''),0,0,'L','T');
$pdf->Cell(10,5,utf8_decode('10'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('9'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('8'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('7'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('6'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('5'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('4'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('3'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('2'),0,0,'C','T');
$pdf->Cell(10,5,utf8_decode('1'),0,1,'C','T');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Atención general'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10, 0,0,'C');
$pdf->Cell(10,5, $check9, 0,0,'C');
$pdf->Cell(10,5, $check8, 0,0,'C');
$pdf->Cell(10,5, $check7, 0,0,'C');
$pdf->Cell(10,5, $check6, 0,0,'C');
$pdf->Cell(10,5, $check5, 0,0,'C');
$pdf->Cell(10,5, $check4, 0,0,'C');
$pdf->Cell(10,5, $check3, 0,0,'C');
$pdf->Cell(10,5, $check2, 0,0,'C');
$pdf->Cell(10,5, $check1, 0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Tiempo de respuesta'), 0, 0,'L','T');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_1, 0,0,'C','T');
$pdf->Cell(10,5, $check9_1, 0,0,'C','T');
$pdf->Cell(10,5, $check8_1, 0,0,'C','T');
$pdf->Cell(10,5, $check7_1, 0,0,'C','T');
$pdf->Cell(10,5, $check6_1, 0,0,'C','T');
$pdf->Cell(10,5, $check5_1, 0,0,'C','T');
$pdf->Cell(10,5, $check4_1, 0,0,'C','T');
$pdf->Cell(10,5, $check3_1, 0,0,'C','T');
$pdf->Cell(10,5, $check2_1, 0,0,'C','T');
$pdf->Cell(10,5, $check1_1, 0,1,'C','T');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Disponibilidad del servicio'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_2, 0,0,'C');
$pdf->Cell(10,5, $check9_2, 0,0,'C');
$pdf->Cell(10,5, $check8_2, 0,0,'C');
$pdf->Cell(10,5, $check7_2, 0,0,'C');
$pdf->Cell(10,5, $check6_2, 0,0,'C');
$pdf->Cell(10,5, $check5_2, 0,0,'C');
$pdf->Cell(10,5, $check4_2, 0,0,'C');
$pdf->Cell(10,5, $check3_2, 0,0,'C');
$pdf->Cell(10,5, $check2_2, 0,0,'C');
$pdf->Cell(10,5, $check1_2, 0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Calidad de nuestros servicios'), 0, 0,'L','T');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_3, 0,0,'C','T');
$pdf->Cell(10,5, $check9_3, 0,0,'C','T');
$pdf->Cell(10,5, $check8_3, 0,0,'C','T');
$pdf->Cell(10,5, $check7_3, 0,0,'C','T');
$pdf->Cell(10,5, $check6_3, 0,0,'C','T');
$pdf->Cell(10,5, $check5_3, 0,0,'C','T');
$pdf->Cell(10,5, $check4_3, 0,0,'C','T');
$pdf->Cell(10,5, $check3_3, 0,0,'C','T');
$pdf->Cell(10,5, $check2_3, 0,0,'C','T');
$pdf->Cell(10,5, $check1_3, 0,1,'C','T');
$pdf->SetFont('Arial','',7.5);
$pdf->Cell(89, 5, utf8_decode('Asesoria técnica (tipo de unidades, modelos, capacidad de pasajeros)'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_4, 0,0,'C');
$pdf->Cell(10,5, $check9_4, 0,0,'C');
$pdf->Cell(10,5, $check8_4, 0,0,'C');
$pdf->Cell(10,5, $check7_4, 0,0,'C');
$pdf->Cell(10,5, $check6_4, 0,0,'C');
$pdf->Cell(10,5, $check5_4, 0,0,'C');
$pdf->Cell(10,5, $check4_4, 0,0,'C');
$pdf->Cell(10,5, $check3_4, 0,0,'C');
$pdf->Cell(10,5, $check2_4, 0,0,'C');
$pdf->Cell(10,5, $check1_4, 0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Limpieza y condición de unidades'), 0, 0,'L','T');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_5, 0,0,'C','T');
$pdf->Cell(10,5, $check9_5, 0,0,'C','T');
$pdf->Cell(10,5, $check8_5, 0,0,'C','T');
$pdf->Cell(10,5, $check7_5, 0,0,'C','T');
$pdf->Cell(10,5, $check6_5, 0,0,'C','T');
$pdf->Cell(10,5, $check5_5, 0,0,'C','T');
$pdf->Cell(10,5, $check4_5, 0,0,'C','T');
$pdf->Cell(10,5, $check3_5, 0,0,'C','T');
$pdf->Cell(10,5, $check2_5, 0,0,'C','T');
$pdf->Cell(10,5, $check1_5, 0,1,'C','T');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Atención, servicio, limpieza y presentación del operador'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_6, 0,0,'C');
$pdf->Cell(10,5, $check9_6, 0,0,'C');
$pdf->Cell(10,5, $check8_6, 0,0,'C');
$pdf->Cell(10,5, $check7_6, 0,0,'C');
$pdf->Cell(10,5, $check6_6, 0,0,'C');
$pdf->Cell(10,5, $check5_6, 0,0,'C');
$pdf->Cell(10,5, $check4_6, 0,0,'C');
$pdf->Cell(10,5, $check3_6, 0,0,'C');
$pdf->Cell(10,5, $check2_6, 0,0,'C');
$pdf->Cell(10,5, $check1_6, 0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('El operador conduce la unidad adecuadamente'), 0, 0, 'L','T');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_7, 0,0,'C','T');
$pdf->Cell(10,5, $check9_7, 0,0,'C','T');
$pdf->Cell(10,5, $check8_7, 0,0,'C','T');
$pdf->Cell(10,5, $check7_7, 0,0,'C','T');
$pdf->Cell(10,5, $check6_7, 0,0,'C','T');
$pdf->Cell(10,5, $check5_7, 0,0,'C','T');
$pdf->Cell(10,5, $check4_7, 0,0,'C','T');
$pdf->Cell(10,5, $check3_7, 0,0,'C','T');
$pdf->Cell(10,5, $check2_7, 0,0,'C','T');
$pdf->Cell(10,5, $check1_7, 0,1,'C','T');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Atencion y servicio del área de calidad'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_8, 0,0,'C');
$pdf->Cell(10,5, $check9_8, 0,0,'C');
$pdf->Cell(10,5, $check8_8, 0,0,'C');
$pdf->Cell(10,5, $check7_8, 0,0,'C');
$pdf->Cell(10,5, $check6_8, 0,0,'C');
$pdf->Cell(10,5, $check5_8, 0,0,'C');
$pdf->Cell(10,5, $check4_8, 0,0,'C');
$pdf->Cell(10,5, $check3_8, 0,0,'C');
$pdf->Cell(10,5, $check2_8, 0,0,'C');
$pdf->Cell(10,5, $check1_8, 0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Como considera el servico de facturación'), 0, 0,'L','T');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_9, 0,0,'C','T');
$pdf->Cell(10,5, $check9_9, 0,0,'C','T');
$pdf->Cell(10,5, $check8_9, 0,0,'C','T');
$pdf->Cell(10,5, $check7_9, 0,0,'C','T');
$pdf->Cell(10,5, $check6_9, 0,0,'C','T');
$pdf->Cell(10,5, $check5_9, 0,0,'C','T');
$pdf->Cell(10,5, $check4_9, 0,0,'C','T');
$pdf->Cell(10,5, $check3_9, 0,0,'C','T');
$pdf->Cell(10,5, $check2_9, 0,0,'C','T');
$pdf->Cell(10,5, $check1_9, 0,1,'C','T');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Nuestros precios'), 0, 0);
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10,5, $check10_10, 0,0,'C');
$pdf->Cell(10,5, $check9_10, 0,0,'C');
$pdf->Cell(10,5, $check8_10, 0,0,'C');
$pdf->Cell(10,5, $check7_10, 0,0,'C');
$pdf->Cell(10,5, $check6_10, 0,0,'C');
$pdf->Cell(10,5, $check5_10, 0,0,'C');
$pdf->Cell(10,5, $check4_10, 0,0,'C');
$pdf->Cell(10,5, $check3_10, 0,0,'C');
$pdf->Cell(10,5, $check2_10, 0,0,'C');
$pdf->Cell(10,5, $check1_10, 0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('6. Por favor califique el servicio brindado por cada área (Atención, servicio y calidad):'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Ventas (cotización, Contratación, post venta)'), 0, 0,'L');
$pdf->Cell(20, 5, utf8_decode('EXCELENTE'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check1_s1, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('BUENO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check2_s1, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('REGULAR'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check3_s1, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('MALO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check4_s1, 0, 1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Supervisor'), 0, 0,'L');
$pdf->Cell(20, 5, utf8_decode('EXCELENTE'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check1_s2, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('BUENO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check2_s2, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('REGULAR'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check3_s2, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('MALO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check4_s2, 0, 1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Jefe de Operaciones'), 0, 0,'L');
$pdf->Cell(20, 5, utf8_decode('EXCELENTE'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check1_s3, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('BUENO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check2_s3, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('REGULAR'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check3_s3, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('MALO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check4_s3, 0, 1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(89, 5, utf8_decode('Resolución de quejas'), 0, 0,'L');
$pdf->Cell(20, 5, utf8_decode('EXCELENTE'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check1_s4, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('BUENO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check2_s4, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('REGULAR'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check3_s4, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('MALO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check4_s4, 0, 1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Ln(3);
$pdf->Cell(189,5,utf8_decode('7. En seguimiento a la cobranza de nuestros servicio, ¿la información es clara y actualizada?:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(10, 5, utf8_decode('SI'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check1_s5, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(10, 5, utf8_decode('NO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check2_s5, 0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 5, utf8_decode('Comentarios'), 0, 0,'C');
$pdf->Cell(139, 5, utf8_decode($notas_cob), 0, 1,'L','T');
$pdf->SetFont('Arial','B',8);
$pdf->Ln(3);
$pdf->Cell(189,5,utf8_decode('8. La persona que le llama para ver el seguimiento de sus quejas o reclamos es:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(28, 5, utf8_decode('DA BUEN SERVICIO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check1_s6, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(18, 5, utf8_decode('AMABLE'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check2_s6, 0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(18, 5, utf8_decode('NORMAL'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check3_s6, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(35, 5, utf8_decode('MAL HUMOR EMOJADO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check4_s6, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(63, 5, utf8_decode('PESIMO SERVICIO CAMBIEN DE PERSONAL'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check5_s6, 0, 1,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('9. ¿Para usted que significa obtener calidad en el servicio?:'),0,1,'L');
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(189,5,utf8_decode($scalidad),0,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(231,233,238);
$pdf->Ln(3);
$pdf->Cell(189,5,utf8_decode('10. Le gustaria recibir atención mas personalizada de nuestro servicio, si su respuesta es sí, indique el dia en que podemos contactarlo:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(129, 5, utf8_decode(''), 0, 0,'C');
$pdf->Cell(10, 5, utf8_decode('L'), 1, 0,'C');
$pdf->Cell(10, 5, utf8_decode('M'), 1, 0,'C');
$pdf->Cell(10, 5, utf8_decode('M'), 1, 0,'C');
$pdf->Cell(10, 5, utf8_decode('J'), 1, 0,'C');
$pdf->Cell(10, 5, utf8_decode('V'), 1, 0,'C');
$pdf->Cell(10, 5, utf8_decode('S'), 1, 1,'C');
$pdf->Cell(10, 5, utf8_decode('SI'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check1_s7, 0, 0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(10, 5, utf8_decode('NO'), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(5, 5, $check2_s7, 0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(99, 5, utf8_decode(''), 0, 0,'C');
$pdf->SetFont('ZapfDingbats','', 10);
$pdf->Cell(10, 5, $check1_s8, 1, 0,'C');
$pdf->Cell(10, 5, $check1_s9, 1, 0,'C');
$pdf->Cell(10, 5, $check1_s10, 1, 0,'C');
$pdf->Cell(10, 5, $check1_s11, 1, 0,'C');
$pdf->Cell(10, 5, $check1_s12, 1, 0,'C');
$pdf->Cell(10, 5, $check1_s13, 1, 0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(189,5,utf8_decode('11. Sugerencias o comentarios:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(189,5,utf8_decode($notas),0,1,'L');
$pdf->SetFillColor(231,233,238);

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