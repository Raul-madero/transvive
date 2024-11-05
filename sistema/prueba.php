<?php

include('./fpdf/fpdf.php');
require './includes/conversor.php';
include "../conexion.php";
session_start();

$periodo = "SEMANA 42";
$fecha_finsem = 2024;
header("Content-Type: text/html; charset=iso-8859-1 ");

class PDF extends FPDF
{
} // FIN Class PDF

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Courier', '', 8);

//======================================
// Título del Reporte
//======================================
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(2,157,116); // Fondo verde de celda
$pdf->SetTextColor(0, 0, 0); // Letra color negro
$pdf->SetXY(10, 10);
$pdf->Cell(191,4, 'Reporte de Viajes por Cliente', 0, 1 , 'C');

// Obtener mes de inicio de semana
$queryday = mysqli_query($conection,"SELECT dia_inicial FROM semanas40 WHERE semana = 'Semana 42'  and ejercicio = 2024 ");
while ($row33 = mysqli_fetch_assoc($queryday)){
  setlocale(LC_ALL, 'es_MX');
  $fechames = date(strtotime($row33['dia_inicial']));
  $mes = date("m", $fechames);

  switch($mes)
  {   
    case 1: $monthNameSpanish = "Enero"; break;
    case 2: $monthNameSpanish = "Febrero"; break;
    case 3: $monthNameSpanish = "Marzo"; break;
    case 4: $monthNameSpanish = "Abril"; break;
    case 5: $monthNameSpanish = "Mayo"; break;
    case 6: $monthNameSpanish = "Junio"; break;
    case 7: $monthNameSpanish = "Julio"; break;
    case 8: $monthNameSpanish = "Agosto"; break;
    case 9: $monthNameSpanish = "Septiembre"; break;
    case 10: $monthNameSpanish = "Octubre"; break;
    case 11: $monthNameSpanish = "Noviembre"; break;
    case 12: $monthNameSpanish = "Diciembre"; break;
  }
}

//==============================
// Encabezado de la tabla superior
//==============================
$query4 = mysqli_query($conection,"SELECT SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM(rv.valor_vuelta) AS viajes_extras, SUM(rv.valor_vuelta) - SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) as diferencia FROM registro_viajes rv WHERE rv.semana = 'Semana 42' and estatus = 2 and rv.yearreg = 2024");
while ($row3 = mysqli_fetch_assoc($query4)){
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(255, 255, 255); // Letra color blanco
    $pdf->SetXY(10, 15);
    $pdf->Cell(30,4, '',0, 0 , 'C');
    $pdf->Cell(27,4, utf8_decode('Periodo'),1, 0 , 'C', true);
    $pdf->Cell(20,4, utf8_decode('Año'),1, 0 , 'C', true);
    $pdf->Cell(20,4, utf8_decode('Mes'),1, 0 , 'C', true);
    $pdf->Cell(20,4, utf8_decode('Planeados'),1, 0 , 'C', true);
    $pdf->Cell(24,4, utf8_decode('Registrados'),1, 0 , 'C', true);
    $pdf->Cell(20,4, utf8_decode('Diferencia'),1, 0 , 'C', true);
    $pdf->Cell(30,4, '',0, 1 , 'C');
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(30,4, '',0, 0 , 'C');
    $pdf->Cell(27,4, utf8_decode($periodo),1, 0 , 'C');
    $pdf->Cell(20,4, ($fecha_finsem),1, 0 , 'C');
    $pdf->Cell(20,4, ($monthNameSpanish),1, 0 , 'C');
    $pdf->Cell(20,4, number_format($row3['viajes_planeados'],2),1, 0 , 'C');
    $pdf->Cell(24,4, number_format($row3['viajes_extras'],2),1, 0 , 'C');
    $pdf->Cell(20,4, number_format($row3['diferencia'],2),1, 0 , 'C');
    $pdf->Cell(30,4, '',0, 1 , 'C');
}

//=============================
// Encabezado para las tablas de clientes
//=============================
$pdf->SetXY(10, 25);
$pdf->SetFillColor(2,157,116); // Fondo verde de celda
$pdf->SetTextColor(240, 255, 240); // Letra color blanco
$pdf->Cell(27,4, utf8_decode('Ruta'),1, 0 , 'C', true);
$pdf->Cell(20,4, utf8_decode('Planeados'),1, 0 , 'C', true);
$pdf->Cell(24,4, utf8_decode('Registrados'),1, 0 , 'C', true);
$pdf->Cell(20,4, utf8_decode('Diferencia'),1, 1 , 'C', true);

// Consulta para obtener clientes y rutas
$query2 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM(rv.valor_vuelta) AS viajes_extras FROM registro_viajes rv WHERE rv.semana = '$periodo' and yearreg = $fecha_finsem and rv.estatus = 2 GROUP BY rv.cliente, rv.ruta ORDER BY rv.cliente");

$current_cliente = "";
$bandera = false; // Alternar color de las filas

$subtotal_planeados = 0;
$subtotal_extras = 0;
$total_planeados = 0;
$total_extras = 0;

while ($row = mysqli_fetch_assoc($query2)) {
    $diferencia = $row['viajes_extras'] - $row['viajes_planeados'];

    // Verificar si cambiamos de cliente
    if ($current_cliente != $row['cliente']) {
        if ($current_cliente != "") {
            // Imprimir subtotales del cliente anterior
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(27,4, 'Subtotal:',1, 0 , 'R');
            $pdf->Cell(20,4, number_format($subtotal_planeados,2),1, 0 , 'R');
            $pdf->Cell(24,4, number_format($subtotal_extras,2),1, 0 , 'R');
            $pdf->Cell(20,4, number_format($subtotal_extras - $subtotal_planeados,2),1, 1 , 'R');

            // Reiniciar subtotales
            $subtotal_planeados = 0;
            $subtotal_extras = 0;
        }

        // Imprimir el nombre del nuevo cliente
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(191,5, utf8_decode($row['cliente']), 0, 1, 'L');
        $current_cliente = $row['cliente'];
    }

    // Imprimir detalles de la ruta del cliente actual
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(27,4, $row['ruta'],1, 0 , 'L', $bandera);
    $pdf->Cell(20,4, number_format($row['viajes_planeados'],2),1, 0 , 'R', $bandera);
    $pdf->Cell(24,4, number_format($row['viajes_extras'],2),1, 0 , 'R', $bandera);
    $pdf->Cell(20,4, number_format($diferencia,2),1, 1 , 'R', $bandera);

    // Sumar a subtotales del cliente
    $subtotal_planeados += $row['viajes_planeados'];
    $subtotal_extras += $row['viajes_extras'];

    // Sumar a totales generales
    $total_planeados += $row['viajes_planeados'];
    $total_extras += $row['viajes_extras'];

    $bandera = !$bandera;
}

// Imprimir subtotales del último cliente
$pdf->SetFont('Arial','B',8);
$pdf->Cell(27,4, 'Subtotal:',1, 0 , 'R');
$pdf->Cell(20,4, number_format($subtotal_planeados,2),1, 0 , 'R');
$pdf->Cell(24,4, number_format($subtotal_extras,2),1, 0 , 'R');
$pdf->Cell(20,4, number_format($subtotal_extras - $subtotal_planeados,2),1, 1 , 'R');

// Imprimir totales generales
$pdf->SetFont('Arial','B',8);
$pdf->Cell(27,4, 'Totales:',1, 0 , 'R');
$pdf->Cell(20,4, number_format($total_planeados,2),1, 0 , 'R');
$pdf->Cell(24,4, number_format($total_extras,2),1, 0 , 'R');
$pdf->Cell(20,4, number_format($total_extras - $total_planeados,2),1, 1 , 'R');

$pdf->Output();
?>
