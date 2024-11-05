<?php

include('../fpdf/fpdf.php');
require '../includes/conversor.php';
include "../../conexion.php";
session_start();

 $fecha_ini  = $_POST['fechaini'];
 $fecha_fin  = $_POST['fechafin'];;
 $produc_ini  = $_REQUEST['productoini'];
 $produc_fin  = $_REQUEST['productofin'];
 $fecha_saldo = date("Y-m-d",strtotime($fecha_ini."- 1 days"));

 $queryp1 = mysqli_query($conection,"SELECT descripcion FROM refacciones WHERE codigo = '$produc_ini'");
while ($rowp1 = mysqli_fetch_assoc($queryp1)){
   $name_prodini = $rowp1['descripcion'];
}
 
$queryp2 = mysqli_query($conection,"SELECT descripcion FROM refacciones WHERE codigo = '$produc_fin'");
while ($rowp2 = mysqli_fetch_assoc($queryp2)){
   $name_prodfin = $rowp2['descripcion'];
}


$querydetele = mysqli_query($conection,"TRUNCATE temp_kardex ");

$queryinsert_comp = mysqli_query($conection,"INSERT INTO temp_kardex (fecha, articulo, serie, folio, concepto, entrada, salida) SELECT cp.fecha, th.codigo, '', th.folio, 'COMPRA', cantidad, 0  FROM detalle_compra th inner join compras cp ON th.folio = cp.no_compra WHERE th.descripcion BETWEEN '$name_prodini' and '$name_prodfin' and cp.fecha  BETWEEN '$fecha_ini' and '$fecha_fin' ORDER by cp.fecha ");

$queryinsert_ent = mysqli_query($conection,"INSERT INTO temp_kardex (fecha, articulo, serie, folio, concepto, entrada, salida) SELECT cp.fecha, th.codigo, '', th.folio, 'ENTRADA', cantidad, 0  FROM detalle_entradaalm th inner join entrada_almacen cp ON th.folio = cp.folio WHERE th.descripcion BETWEEN '$name_prodini' and '$name_prodfin' and cp.fecha  BETWEEN '$fecha_ini' and '$fecha_fin' ORDER by cp.fecha ");

$queryinsert_sal = mysqli_query($conection,"INSERT INTO temp_kardex (fecha, articulo, serie, folio, concepto, entrada, salida)
SELECT 
    '$fecha_saldo',  -- Fecha del saldo inicial
    dc.codigo,     -- Código del producto (artículo)
    '',            -- Serie (en blanco)
    0,             -- Folio (0)
    'Saldo Inicial', -- Concepto
    COALESCE(SUM(CASE WHEN co.fecha < '$fecha_ini' THEN dc.cantidad ELSE 0 END), 0) +  -- Suma de entradas de compras
    COALESCE(SUM(CASE WHEN ea.fecha < '$fecha_ini' THEN da.cantidad ELSE 0 END), 0),  -- Suma de entradas de almacén
    COALESCE(SUM(CASE WHEN sa.fecha < '$fecha_ini' THEN ds.cantidad ELSE 0 END), 0)   -- Suma de salidas
FROM 
    detalle_compra dc
LEFT JOIN 
    compras co ON dc.folio = co.no_compra
LEFT JOIN 
    detalle_entradaalm da ON dc.codigo = da.codigo
LEFT JOIN 
    entrada_almacen ea ON da.folio = ea.folio
LEFT JOIN 
    detalle_salidaalm ds ON dc.codigo = ds.codigo
LEFT JOIN 
    salida_almacen sa ON ds.folio = sa.folio
WHERE 
    (dc.descripcion BETWEEN '$name_prodini' AND '$name_prodfin' or
     da.descripcion BETWEEN '$name_prodini' AND '$name_prodfin') -- Rango de productos
GROUP BY 
    dc.codigo;
");


$queryinsertwo = mysqli_query($conection,"ANTICONGELANTE CUB 19 LTS ");



header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
 
} // FIN Class PDF
 
$pdf = new PDF();
 
$pdf->AddPage();
$pdf->SetFont('Courier','',8);
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
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(0, 0, 0); //Letra color blanco
//$pdf->Rect(10, 10, 90, 20, 'F');
//$pdf->Line(10, 10, 15, 15);
$pdf->SetXY(10, 10);
$pdf->Cell(191,4, 'Transvive S.A. de C.V.', 0, 1 , 'C');
$pdf->Cell(191,4, 'Kardex por Producto', 0, 1 , 'C');
$pdf->Cell(191,4, 'Del '. date("d-m-Y", strtotime($fecha_ini)).' Al '.  date("d-m-Y", strtotime($fecha_fin)), 0, 1 , 'C');
//$pdf->Cell(191,4, 'Del '. $produc_ini.' Al '.  $produc_fin, 0, 1 , 'C');
//$pdf->Cell(191,4, 'Del '. $name_provini .' Al '. $name_provfin ,0,1, 'C' );

$pdf->SetXY(10, 25);
$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(0, 0, 0); //Letra color blanco

 //Atención!! el parámetro true rellena la celda con el color elegido
 
 $pdf->Cell(22,4, utf8_decode('Fecha'),'T,B', 0 , 'C', false);
 $pdf->Cell(15,4, utf8_decode('Serie'),'T,B', 0 , 'C', false);
 $pdf->Cell(15,4, utf8_decode('Folio'),'T, B', 0 , 'C', false);
 $pdf->Cell(50,4, utf8_decode('Concepto'),'T,B', 0 , 'C', false);
 $pdf->Cell(25,4, utf8_decode('Entradas'),'T,B', 0 , 'C', false);
 $pdf->Cell(25,4, utf8_decode('Salidas'),'T,B', 0 , 'C', false);
 $pdf->Cell(30,4, utf8_decode('Existencia'),'T,B', 0 , 'C', false);
 //$pdf->Cell(22,4, utf8_decode('Vence'),'T,B', 1 , 'C', false);
 $pdf->SetXY(10,31);
 $pdf->SetFont('Arial','',7);
 $pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
 $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
 
 $bandera = false; //Para alternar el relleno
 $query2 = mysqli_query($conection,"SELECT tk.fecha, tk.articulo, rf.descripcion, tk.serie, tk.folio, tk.concepto, tk.entrada, tk.salida FROM temp_kardex tk INNER JOIN refacciones rf ON tk.articulo = rf.codigo order by tk.articulo, tk.fecha");
$result2 = mysqli_num_rows($query2);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo = mysqli_query($conection,"SELECT articulo, folio FROM temp_kardex group by articulo order by articulo ");
$result_articulo = mysqli_num_rows($articulo);
$Saldo_inicial = 0;
$total_registrados = 0;
$total = 0;
$total_entradas = 0;
$total_salidas = 0;
$saldo_final  = 0;
$saldoinicial = 0;

while ($row = mysqli_fetch_assoc($query2)){
    $grupoant=$articulo;
    $articulo=$row['articulo'];
    $newDate = date("d-m-Y", strtotime($row['fecha']));
    
    if($grupoant != $articulo){

       if ($total_registrados == 0) {
         $total_entradas = 0;
         $total_salidas = 0;
         $saldo_final  = 0;
       }else {
         $tot_clientereg = $total_registrados;
         if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['entrada'] - $row['salida'];
         }
         
         
         $pdf->SetFont('Arial','B',8);
         $pdf->SetFillColor(223, 227, 230);//Fondo gris totales
         $pdf->Cell(27,4, (''),0, 0 , 'L' );
         $pdf->ln(5);
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, 'Resumen:',0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, 'Saldo Inicial:',0, 0, 'R'  );
        $pdf->Cell(20,4, number_format($saldoinicial,2),0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(+) Cargos:',0, 0, 'R'  );
        $pdf->Cell(20,4, number_format($total_entradas,2),0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(-) Abonos:','B', 0, 'R'  );
        $pdf->Cell(20,4, number_format($total_salidas,2),'B', 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(=) Saldo Final:','B', 0, 'R'  );
        $pdf->Cell(20,4, number_format($saldo_final,2),'B', 1, 'R'  );
        $pdf->ln(5);
               $total_registrados = 0;
               $total_entradas = 0;
               $total_salidas = 0;
               $saldo_final  = 0;

       }
       
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(15,4, 'Articulo:',0, 0 , 'L' );
      $pdf->Cell(170,4, $row['articulo'],0, 1 , 'L' );
      $pdf->Cell(15,4, 'Nombre:',0, 0 , 'L' );
      $pdf->Cell(170,4, utf8_decode($row['descripcion']),0, 1 , 'L' );
      /*if ($total_registrados == 0) {
         $tot_clientereg = "";
       }else {*/
         //$tot_clientereg = $tot_clientereg + $row['total'];
         if ($row['concepto'] <> "Saldo Inicial") {
         $pdf->SetFont('Arial','',8);
         $pdf->SetFillColor(223, 227, 230);//Fondo gris totales
         $pdf->Cell(22,4, $newDate,0, 0 , 'L' );
         $pdf->Cell(15,4, $row['serie'],0, 0 , 'R' );
         $pdf->Cell(15,4, number_format($row['folio'],0),0, 0 , 'R' );
         $pdf->Cell(50,4, utf8_decode($row['concepto']),0, 0 , 'L' );
         $pdf->Cell(25,4, number_format($row['entrada'],2),0, 0 , 'R' );
         $pdf->Cell(25,4, number_format($row['salida'],2),0, 0, 'R' );
         $pdf->Cell(30,4, number_format($row['entrada']-$row['salida'],2),0, 1, 'R' );
         //$pdf->Cell(22,4, '',0, 1, 'L' );
         
           if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['entrada']-$row['salida'];
            $total_registrados = 0;
           }else {
            $total_entradas = $total_entradas + $row['entrada'];
            $total_salidas = $total_salidas + $row['salida'];
            $saldo_final  = ($saldoinicial + $total_entradas) - $total_salidas ;
            $total_registrados = 1;
           }
         }else {
            $pdf->SetFont('Arial','',8);
         $pdf->SetFillColor(223, 227, 230);//Fondo gris totales
         $pdf->Cell(22,4, '',0, 0 , 'L' );
         $pdf->Cell(15,4, $row['serie'],0, 0 , 'R' );
         $pdf->Cell(15,4, '',0, 0 , 'R' );
         $pdf->Cell(50,4, '',0, 0 , 'L' );
         $pdf->Cell(25,4, '',0, 0 , 'R' );
         $pdf->Cell(25,4, '',0, 0, 'R' );
         $pdf->Cell(30,4, '',0, 1, 'R' );
         //$pdf->Cell(22,4, '',0, 1, 'L' );
         $total_registrados = 1;
          if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['entrada']-$row['salida'];
         }
         
         }

       }else   {
         if ($row['concepto'] <> "Saldo Inicial") {
         $pdf->SetFont('Arial','',8);
         $pdf->SetFillColor(223, 227, 230);//Fondo gris totales
         $pdf->Cell(22,4, $newDate,0, 0 , 'L' );
         $pdf->Cell(15,4, $row['serie'],0, 0 , 'R' );
         $pdf->Cell(15,4, number_format($row['folio'],0),0, 0 , 'R' );
         $pdf->Cell(50,4, utf8_decode($row['concepto']),0, 0 , 'L' );
         $pdf->Cell(25,4, number_format($row['entrada'],2),0, 0 , 'R' );
         $pdf->Cell(25,4, number_format($row['salida'],2),0, 0, 'R' );
         $pdf->Cell(30,4, number_format($row['entrada']-$row['salida'],2),0, 1, 'R' );
         //$pdf->Cell(22,4, '',0, 1, 'L' );

      $total_entradas = $total_entradas + $row['entrada'];
      $total_salidas = $total_salidas + $row['salida'];
      
      $total_registrados = 1;
       if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['entrada']-$row['salida'];
         }else {
            $saldo_final = 0;
         }
        }
      $saldo_final  = ($saldoinicial + $total_entradas) - $total_salidas ;    
       }
       
 $saldo_final  = ($saldoinicial + $total_entradas) - $total_salidas ;  
}
 $pdf->ln(5);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(50,4, 'Resumen:',0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(50,4, 'Saldo Inicial:',0, 0, 'R'  );
        $pdf->Cell(25,4, number_format($saldoinicial,2),0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(50,4, '(+) Entradas:',0, 0, 'R'  );
        $pdf->Cell(25,4, number_format($total_entradas,2),0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(50,4, '(-) Salidas:','B', 0, 'R'  );
        $pdf->Cell(25,4, number_format($total_salidas,2),'B', 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(50,4, '(=) Saldo Final:','B', 0, 'R'  );
        $pdf->Cell(25,4, number_format($saldo_final,2),'B', 1, 'R'  );
        $pdf->ln(5);
  






$pdf->Ln(5);


$pdf->Output();
?>