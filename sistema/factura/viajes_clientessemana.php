<?php

include('../fpdf/fpdf.php');
require '../includes/conversor.php';
include "../../conexion.php";
session_start();
//$semana = $_REQUEST['id'];

$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin_sem = strrpos($idoentrada, "id3");
$final_sem = $fin_sem - 1;
$periodo = substr($idoentrada, 0,  $fin_sem);
$fin2_sem = $fin_sem + 4;
$fecha_finsem = substr($idoentrada, $fin2_sem, 9);

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
 
} // FIN Class PDF
 
$pdf = new PDF();
 
$pdf->AddPage();
$pdf->SetFont('Courier','',8);
$pdf->SetMargins(10, 10, 10); // Márgenes izquierdo y derecho de 10 mm, superior de 20 mm
$pdf->SetAutoPageBreak(true, 10); // Establecer margen inferior de 20 mm
//======================================
// Primer bloque - 3 rectángulos      =
//======================================
//Rectángulo Azul:
//Elegir color RGB que llevará Rect al tener el parametro 'F'
//Rect(x , y, ancho, alto, 'F') F rellena con el color elegido
//Line(x1, y1, x2, y2) que sale de la esquina superior izquierda
//cada rectángulo
//Elegir la posición de la celda para colocar el texto
//Usamos una celda para poner texto
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(0, 51, 102);//Fondo verde de celda
$pdf->SetTextColor(0, 0, 0); //Letra color blanco
//$pdf->Rect(10, 10, 90, 20, 'F');
//$pdf->Line(10, 10, 15, 15);
$pdf->SetXY(10, 10);
$pdf->Cell(191,4, 'Reporte de Viajes por Cliente', 0, 1 , 'C');
$queryday = mysqli_query($conection,"SELECT dia_inicial FROM semanas40 WHERE semana = '$periodo'  and ejercicio = $fecha_finsem ");
$resultday = mysqli_num_rows($queryday);
while ($row33 = mysqli_fetch_assoc($queryday)){
  setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row33['dia_inicial']));
      $mes = date("m", $fechames);

      switch($mes)
      {   
          case 1:
          $monthNameSpanish = "Enero";
          break;

          case 2:
          $monthNameSpanish = "Febrero";
          break;

          case 3:
          $monthNameSpanish = "Marzo";
          break;

          case 4:
          $monthNameSpanish = "Abril";
          break;

          case 5:
          $monthNameSpanish = "Mayo";
          break;

          case 6:
          $monthNameSpanish = "Junio";
          break;

          case 7:
          $monthNameSpanish = "Julio";
          break;

          case 8:
          $monthNameSpanish = "Agosto";
          break;

          case 9:
          $monthNameSpanish = "Septiembre";
          break;

          case 10:
          $monthNameSpanish = "Octubre";
          break;

          case 11:
          $monthNameSpanish = "Noviembre";
          break;

          case 12:
          $monthNameSpanish = "Diciembre";
          break;

    //...
    }
  }
$query4 = mysqli_query($conection,"SELECT SUM(IF(rv.planeado=1, rv.planeado, 0)) AS viajes_planeados, SUM(rv.valor_vuelta) AS viajes_extras, SUM(rv.valor_vuelta)  - SUM(IF(rv.planeado=1, rv.planeado, 0)) as diferencia FROM registro_viajes rv  WHERE rv.semana = '$periodo'  and rv.yearreg = $fecha_finsem ");
$result3 = mysqli_num_rows($query4);
while ($row3 = mysqli_fetch_assoc($query4)){
$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(255, 255, 255); //Letra color blanco
$pdf->SetXY(10, 15);
$pdf->Cell(30,4, '',0, 0 , 'C');
$pdf->Cell(27,4, utf8_decode('Periodo'),1, 0 , 'C', true);
$pdf->Cell(20,4, utf8_decode('Año'),1, 0 , 'C', true);
$pdf->Cell(20,4, utf8_decode('Mes'),1, 0 , 'C', true);
$pdf->Cell(20,4, utf8_decode('Planeados'),1, 0 , 'C', true);
$pdf->Cell(24,4, utf8_decode('Registrados'),1, 0 , 'C', true);
$pdf->Cell(20,4, utf8_decode('Diferencia'),1, 0 , 'C', true);
$pdf->Cell(30,4, '',0, 1 , 'C');

    $pdf->Cell(30,4, '',0, 0 , 'C');
$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(0, 0, 0); //Letra color blanco
$pdf->Cell(27,4, utf8_decode($periodo),1, 0 , 'C');
$pdf->Cell(20,4, ($fecha_finsem),1, 0 , 'C');
$pdf->Cell(20,4, ($monthNameSpanish),1, 0 , 'C');
$pdf->Cell(20,4, number_format($row3['viajes_planeados'],2),1, 0 , 'C');
$pdf->Cell(24,4, number_format($row3['viajes_extras'],2),1, 0 , 'C');
$pdf->Cell(20,4, number_format($row3['diferencia'],2),1, 0 , 'C');
$pdf->Cell(30,4, '',0, 1 , 'C');
}

$pdf->SetXY(10, 25);
$pdf->SetFillColor(0, 51, 102);//Fondo azul fuerte Subtitulos
$pdf->SetTextColor(240, 255, 240); //Letra color blanco

 //Atención!! el parámetro true rellena la celda con el color elegido
 $pdf->Cell(25,4, utf8_decode('Ruta'),1, 0 , 'C', true);
 $pdf->Cell(12,4, utf8_decode('Plan.'),1, 0 , 'C', true);
 $pdf->Cell(12,4, utf8_decode('Reg.'),1, 0 , 'C', true);
 $pdf->Cell(12,4, utf8_decode('Dif.'),1, 1 , 'C', true);

 $pdf->SetXY(10,31);
 $pdf->SetFont('Arial','',6.5);
 $pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
 $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
 $bandera = false; //Para alternar el relleno
 $query2 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = '$periodo' and yearreg = $fecha_finsem and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'A' and 'K' group by rv.cliente, rv.ruta order by rv.cliente");
$result2 = mysqli_num_rows($query2);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo = mysqli_query($conection,"SELECT cliente from registro_viajes where semana = '$periodo' and substr(cliente, 1, 1) BETWEEN 'A' and 'K' group by cliente order by cliente ");
$result_articulo = mysqli_num_rows($articulo);
$total_planeados = 0;
$total_registrados = 0;
$total_diferencia = 0;
while ($row = mysqli_fetch_assoc($query2)){
    $grupoant=$articulo;
    $articulo=$row['cliente'];
    $diferencia = $row['viajes_extras'] - $row['viajes_planeados'];
    if($grupoant != $articulo){

      if ($total_registrados == 0) {
         $tot_clientereg = "";
       }else {
         $tot_clientereg = $total_registrados;

         $pdf->SetFont('Arial','B',7);
         $pdf->SetFillColor(215, 233, 252);//Fondo verde claro totales
         $pdf->Cell(25,4, (''),0, 0 , 'L' );
         $pdf->Cell(12,4, number_format($total_planeados,2),1, 0 , 'R', 'T' );
         $pdf->Cell(12,4, number_format($tot_clientereg,2),1, 0 , 'R', 'T' );
         $pdf->Cell(12,4, number_format($total_diferencia,2),1, 1 , 'R', 'T' );
       }

     $pdf->SetFont('Arial','B',7);
     $pdf->SetFillColor(139, 172, 201);//Fondo azul claro Clientes
     $pdf->Cell(61,4, $row['cliente'],1, 1 , 'L','T' );

     $total_planeados = 0;
     $total_registrados = 0;
     $total_diferencia = 0;
   
    }


//for ($index = 0; $index < 13; $index++) {
  $pdf->SetFont('Arial','',6.5);
  $pdf->Cell(25,4, utf8_decode($row['ruta']),1, 0 , 'L', $bandera );
  $pdf->Cell(12,4, number_format($row['viajes_planeados'],2),1, 0 , 'R', $bandera );
  $pdf->Cell(12,4, number_format($row['viajes_extras'],2),1, 0 , 'R', $bandera );
  $pdf->Cell(12,4, number_format($diferencia,2),1, 1 , 'R', $bandera );
    
  $total_planeados = $total_planeados + $row['viajes_planeados'];
  $total_registrados = $total_registrados + $row['viajes_extras'];
  $total_diferencia = $total_registrados - $total_planeados;
  //$bandera = !$bandera;//Alterna el valor de la bandera
}
  $pdf->SetFillColor(215, 233, 252);//Fondo verde claro totales
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(25,4, (''),0, 0 , 'L' );
  $pdf->Cell(12,4, number_format($total_planeados,2),1, 0 , 'R', 'T' );
  $pdf->Cell(12,4, number_format($total_registrados,2),1, 0 , 'R', 'T' );
  $pdf->Cell(12,4, number_format($total_diferencia,2),1, 1 , 'R', 'T' );


$pdf->Ln(5);

 
//Amarillo


$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(0, 51, 102);//Fondo azul fuerte Subtitulos
$pdf->SetTextColor(240, 255, 240); //Letra color blanco
$pdf->SetXY(75, 25);
$pdf->Cell(25,4, utf8_decode('Ruta'),1, 0 , 'C', true);
$pdf->Cell(12,4, utf8_decode('Plan.'),1, 0 , 'C', true);
$pdf->Cell(12,4, utf8_decode('Reg.'),1, 0 , 'C', true);
$pdf->Cell(12,4, utf8_decode('Dif.'),1, 1 , 'C', true);

$pdf->SetXY(75,31);
$pdf->SetFont('Arial','',6.5);
$pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
$bandera2 = false; //Para alternar el relleno
$query3 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = '$periodo' and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'L' and 'P' group by rv.cliente, rv.ruta order by rv.cliente");
$result3 = mysqli_num_rows($query3);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo2 = mysqli_query($conection,"SELECT cliente from registro_viajes where semana = '$periodo' and substr(cliente, 1, 1) BETWEEN 'L' and 'P' group by cliente order by cliente ");
$result_articulo2 = mysqli_num_rows($articulo2);
$total_planeados2 = 0;
$total_registrados2 = 0;
$total_diferencia2 = 0;
 
while ($row2 = mysqli_fetch_assoc($query3)){
  $grupoant2 = $articulo2;
  $articulo2 = $row2['cliente'];
  $diferencia2 = $row2['viajes_extras'] - $row2['viajes_planeados'];
  if($grupoant2 != $articulo2){
    if ($total_registrados2 == 0) {
     $tot_clientereg2 = "";
    }else {
     $tot_clientereg2 = $total_registrados2;

     $pdf->SetFont('Arial','B',7);
     $pdf->SetFillColor(215, 233, 252);//Fondo verde claro totales
     $pdf->Cell(25,4, (''),0, 0 , 'L' );
     $pdf->Cell(12,4, number_format($total_planeados2,2),1, 0 , 'R', 'T' );
     $pdf->Cell(12,4, number_format($tot_clientereg2,2),1, 0 , 'R', 'T' );
     $pdf->Cell(12,4, number_format($total_diferencia2,2),1, 1 , 'R', 'T' );
     $pdf->SetX(75);
    }
     $pdf->SetFont('Arial','B',6.5);
     $pdf->SetFillColor(139, 172, 201);//Fondo azul claro Clientes
     $pdf->Cell(61,4, $row2['cliente'],1, 1 , 'L', 'T');
     $total_planeados2 = 0;
     $total_registrados2 = 0;
     $total_diferencia2 = 0;
     $pdf->SetX(75);
  } 

$pdf->SetFont('Arial','',6.5);
$pdf->Cell(25,4, utf8_decode($row2['ruta']),1, 0 , 'L', $bandera2 );
$pdf->Cell(12,4, number_format($row2['viajes_planeados'],2),1, 0 , 'R', $bandera2 );
$pdf->Cell(12,4, number_format($row2['viajes_extras'],2),1, 0 , 'R', $bandera2 );
$pdf->Cell(12,4, number_format($diferencia2,2),1, 1 , 'R', $bandera2 );
    
$total_planeados2 = $total_planeados2 + $row2['viajes_planeados'];
$total_registrados2 = $total_registrados2 + $row2['viajes_extras'];
$total_diferencia2 = $total_registrados2 - $total_planeados2;  
$pdf->SetX(75);
//$bandera2 = !$bandera2;//Alterna el valor de la bandera
} 

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(215, 233, 252);//Fondo verde claro totales
$pdf->Cell(25,4, (''),0, 0 , 'L' );
$pdf->Cell(12,4, number_format($total_planeados2,2),1, 0 , 'R', 'T' );
$pdf->Cell(12,4, number_format($total_registrados2,2),1, 0 , 'R', 'T' );
$pdf->Cell(12,4, number_format($total_diferencia2,2),1, 1 , 'R', 'T' );


$pdf->Ln(5);


//Verde


$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(0, 51, 102);//Fondo azul fuerte Subtitulos
$pdf->SetTextColor(240, 255, 240); //Letra color blanco
$pdf->SetXY(140, 25);
$pdf->Cell(25,4, utf8_decode('Ruta'),1, 0 , 'C', true);
$pdf->Cell(12,4, utf8_decode('Plan.'),1, 0 , 'C', true);
$pdf->Cell(12,4, utf8_decode('Reg.'),1, 0 , 'C', true);
$pdf->Cell(12,4, utf8_decode('Dif.'),1, 1 , 'C', true);

$pdf->SetXY(140,31);
$pdf->SetFont('Arial','',6.5);
$pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
$bandera2 = false; //Para alternar el relleno
$query3 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = '$periodo' and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'S' and 'Z' group by rv.cliente, rv.ruta order by rv.cliente");
$result3 = mysqli_num_rows($query3);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo2 = mysqli_query($conection,"SELECT cliente from registro_viajes where semana = '$periodo' and substr(cliente, 1, 1) BETWEEN 'S' and 'Z' group by cliente order by cliente ");
$result_articulo2 = mysqli_num_rows($articulo2);
$total_planeados2 = 0;
$total_registrados2 = 0;
$total_diferencia2 = 0;
 
while ($row2 = mysqli_fetch_assoc($query3)){
  $grupoant2 = $articulo2;
  $articulo2 = $row2['cliente'];
  $diferencia2 = $row2['viajes_extras'] - $row2['viajes_planeados'];
  if($grupoant2 != $articulo2){
    if ($total_registrados2 == 0) {
     $tot_clientereg2 = "";
    }else {
     $tot_clientereg2 = $total_registrados2;

     $pdf->SetFont('Arial','B',7);
     $pdf->SetFillColor(215, 233, 252);//Fondo verde claro totales
     $pdf->Cell(25,4, (''),0, 0 , 'L' );
     $pdf->Cell(12,4, number_format($total_planeados2,2),1, 0 , 'R', 'T' );
     $pdf->Cell(12,4, number_format($tot_clientereg2,2),1, 0 , 'R', 'T' );
     $pdf->Cell(12,4, number_format($total_diferencia2,2),1, 1 , 'R', 'T' );
     $pdf->SetX(140);
    }
     $pdf->SetFont('Arial','B',6.5);
     $pdf->SetFillColor(139, 172, 201);//Fondo azul claro Clientes
     $pdf->Cell(61,4, $row2['cliente'],1, 1 , 'L', 'T');
     $total_planeados2 = 0;
     $total_registrados2 = 0;
     $total_diferencia2 = 0;
     $pdf->SetX(140);
  } 

$pdf->SetFont('Arial','',6.5);
$pdf->Cell(25,4, utf8_decode($row2['ruta']),1, 0 , 'L', $bandera2 );
$pdf->Cell(12,4, number_format($row2['viajes_planeados'],2),1, 0 , 'R', $bandera2 );
$pdf->Cell(12,4, number_format($row2['viajes_extras'],2),1, 0 , 'R', $bandera2 );
$pdf->Cell(12,4, number_format($diferencia2,2),1, 1 , 'R', $bandera2 );
    
$total_planeados2 = $total_planeados2 + $row2['viajes_planeados'];
$total_registrados2 = $total_registrados2 + $row2['viajes_extras'];
$total_diferencia2 = $total_registrados2 - $total_planeados2;  
$pdf->SetX(140);
//$bandera2 = !$bandera2;//Alterna el valor de la bandera
} 

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(215, 233, 252);//Fondo verde claro totales
$pdf->Cell(25,4, (''),0, 0 , 'L' );
$pdf->Cell(12,4, number_format($total_planeados2,2),1, 0 , 'R', 'T' );
$pdf->Cell(12,4, number_format($total_registrados2,2),1, 0 , 'R', 'T' );
$pdf->Cell(12,4, number_format($total_diferencia2,2),1, 1 , 'R', 'T' );


$pdf->Ln(5);


$pdf->Output();
?>