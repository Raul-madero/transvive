<?php

include('../fpdf/fpdf.php');
require '../includes/conversor.php';
include "../../conexion.php";
session_start();


$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 10);
$pvini = $fin +17;
$prove_ini = substr($idoentrada, $pvini, 4);
$pvfin = $fin + 23;
$prove_fin = substr($idoentrada, $pvfin, 4);
$finfin = strrpos($idoentrada, "id3"); 
$final3 = $finfin + 4;
$fecha_ejercicio = substr($idoentrada, $final3, 3);
$finult = strrpos($idoentrada, "id4"); 
$final4 = $finult + 4;
$proveedor_final2 = substr($idoentrada, $final4, 4);
//Consulta sql encabezado
$pvinicial = intval(preg_replace('/[^0-9]+/', '', $prove_ini), 10);
$pvfinal   = intval(preg_replace('/[^0-9]+/', '', $prove_fin), 10);

$Dateini = date("Y-m-d", strtotime($fecha_ini));
$Datefin = date("Y-m-d", strtotime($fecha_fin));
$queryp1 = mysqli_query($conection,"SELECT nombre FROM proveedores WHERE id = $pvinicial");
while ($rowp1 = mysqli_fetch_assoc($queryp1)){
   $name_provini = $rowp1['nombre'];
}

$queryp2 = mysqli_query($conection,"SELECT nombre FROM proveedores WHERE id = $pvfinal");
while ($rowp2 = mysqli_fetch_assoc($queryp2)){
   $name_provfin = $rowp2['nombre'];
}

$querydetele = mysqli_query($conection,"TRUNCATE temp_saldo ");

$queryinsert = mysqli_query($conection,"INSERT INTO temp_saldo (proveedor, name_proveedor, fecha, no_folio, concepto, cargo, abono, saldo) SELECT cp.proveedor, pv.nombre,  cp.fecha, cp.no_compra, if(cp.metodo_pago='PUE Pago de Una Sola Exhibicion','Compra Contado','Compra Credito'), cp.total, if(cp.metodo_pago='PUE Pago de Una Sola Exhibicion',total,0), if(cp.metodo_pago='PUE Pago de Una Sola Exhibicion',0,cp.total) FROM compras cp INNER JOIN proveedores pv ON cp.proveedor = pv.id WHERE pv.nombre between '$name_provini' and '$name_provfin' and cp.estatus = 1 and cp.fecha between '$Dateini' and '$Datefin' ");

$queryinsertwo = mysqli_query($conection,"INSERT INTO temp_saldo (proveedor, name_proveedor, fecha, no_folio, concepto, cargo, abono, saldo) SELECT cp.proveedor, pv.nombre,  cp.fecha, cp.no_compra, 'Saldo Inicial', sum(cp.total), if(cp.metodo_pago='PUE Pago de Una Sola Exhibicion',sum(cp.total),0), if(cp.metodo_pago='PUE Pago de Una Sola Exhibicion',0,sum(cp.total)) FROM compras cp INNER JOIN proveedores pv ON cp.proveedor = pv.id WHERE pv.nombre between '$name_provini' and '$name_provfin' and cp.estatus = 1 and cp.fecha between '2000-01-01' and '$Datefin' group by proveedor ");



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
$pdf->Cell(191,4, 'Estado de Cuenta de Proveedor', 0, 1 , 'C');
$pdf->Cell(191,4, 'Del '. date("d-m-Y", strtotime($fecha_ini)).' Al '.  date("d-m-Y", strtotime($fecha_fin)), 0, 1 , 'C');
//$pdf->Cell(191,4, 'Del '. $name_provini .' Al '. $name_provfin ,0,1, 'C' );

$pdf->SetXY(10, 25);
$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(0, 0, 0); //Letra color blanco

 //Atención!! el parámetro true rellena la celda con el color elegido
 
 $pdf->Cell(22,4, utf8_decode('Fecha'),'T,B', 0 , 'C', false);
 $pdf->Cell(15,4, utf8_decode('Serie'),'T,B', 0 , 'C', false);
 $pdf->Cell(15,4, utf8_decode('Folio'),'T, B', 0 , 'C', false);
 $pdf->Cell(40,4, utf8_decode('Concepto'),'T,B', 0 , 'C', false);
 $pdf->Cell(20,4, utf8_decode('Cargo'),'T,B', 0 , 'C', false);
 $pdf->Cell(20,4, utf8_decode('Abono'),'T,B', 0 , 'C', false);
 $pdf->Cell(30,4, utf8_decode('Saldo Documento'),'T,B', 0 , 'C', false);
 $pdf->Cell(22,4, utf8_decode('Vence'),'T,B', 1 , 'C', false);
 $pdf->SetXY(10,31);
 $pdf->SetFont('Arial','',7);
 $pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
 $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
 $bandera = false; //Para alternar el relleno
 $query2 = mysqli_query($conection,"SELECT fecha, ' ' as serie, proveedor, name_proveedor, no_folio, concepto, cargo, abono, saldo FROM temp_saldo order by name_proveedor,fecha");
$result2 = mysqli_num_rows($query2);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo = mysqli_query($conection,"SELECT proveedor, name_proveedor, no_folio, cargo FROM temp_saldo group by name_proveedor order by name_proveedor ");
$result_articulo = mysqli_num_rows($articulo);
$Saldo_inicial = 0;
$total_registrados = 0;
$total = 0;
$total_cargos = 0;
$total_abonos = 0;
$saldo_final  = 0;
$saldoinicial = 0;

while ($row = mysqli_fetch_assoc($query2)){
    $grupoant=$articulo;
    $articulo=$row['name_proveedor'];
    $newDate = date("d-m-Y", strtotime($row['fecha']));
    
    if($grupoant != $articulo){

       if ($total_registrados == 0) {
         $total_cargos = 0;
         $total_abonos = 0;
         $saldo_final  = 0;
       }else {
         $tot_clientereg = $total_registrados;
         if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['saldo'];
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
        $pdf->Cell(20,4, number_format($total_cargos,2),0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(-) Abonos:','B', 0, 'R'  );
        $pdf->Cell(20,4, number_format($total_abonos,2),'B', 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(=) Saldo Final:','B', 0, 'R'  );
        $pdf->Cell(20,4, number_format($saldo_final,2),'B', 1, 'R'  );
        $pdf->ln(5);
               $total_registrados = 0;
               $total_cargos = 0;
               $total_abonos = 0;
               $saldo_final  = 0;

       }
       
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(15,4, 'Cliente:',0, 0 , 'L' );
      $pdf->Cell(170,4, $row['proveedor'],0, 1 , 'L' );
      $pdf->Cell(15,4, 'Nombre:',0, 0 , 'L' );
      $pdf->Cell(170,4, utf8_decode($articulo),0, 1 , 'L' );
      /*if ($total_registrados == 0) {
         $tot_clientereg = "";
       }else {*/
         //$tot_clientereg = $tot_clientereg + $row['total'];
         if ($row['concepto'] <> "Saldo Inicial") {
         $pdf->SetFont('Arial','',8);
         $pdf->SetFillColor(223, 227, 230);//Fondo gris totales
         $pdf->Cell(22,4, $newDate,0, 0 , 'L' );
         $pdf->Cell(15,4, $row['serie'],0, 0 , 'R' );
         $pdf->Cell(15,4, number_format($row['no_folio'],0),0, 0 , 'R' );
         $pdf->Cell(40,4, utf8_decode($row['concepto']),0, 0 , 'L' );
         $pdf->Cell(20,4, number_format($row['cargo'],2),0, 0 , 'R' );
         $pdf->Cell(20,4, number_format($row['abono'],2),0, 0, 'R' );
         $pdf->Cell(30,4, number_format($row['saldo'],2),0, 0, 'R' );
         $pdf->Cell(22,4, '',0, 1, 'L' );
         
           if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['saldo'];
            $total_registrados = 0;
           }else {
            $total_cargos = $total_cargos + $row['cargo'];
            $total_abonos = $total_abonos + $row['abono'];
            $saldo_final  = ($total_cargos + $row['cargo']) - (($total_cargos + $row['abono']));
            $total_registrados = 1;
           }
         }else {
            $pdf->SetFont('Arial','',8);
         $pdf->SetFillColor(223, 227, 230);//Fondo gris totales
         $pdf->Cell(22,4, '',0, 0 , 'L' );
         $pdf->Cell(15,4, $row['serie'],0, 0 , 'R' );
         $pdf->Cell(15,4, '',0, 0 , 'R' );
         $pdf->Cell(40,4, '',0, 0 , 'L' );
         $pdf->Cell(20,4, '',0, 0 , 'R' );
         $pdf->Cell(20,4, '',0, 0, 'R' );
         $pdf->Cell(30,4, '',0, 0, 'R' );
         $pdf->Cell(22,4, '',0, 1, 'L' );
         $total_registrados = 1;
          if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['saldo'];
         }
         
         }

       }else   {
         if ($row['concepto'] <> "Saldo Inicial") {
         $pdf->SetFont('Arial','',8);
         $pdf->SetFillColor(223, 227, 230);//Fondo gris totales
         $pdf->Cell(22,4, $newDate,0, 0 , 'L' );
         $pdf->Cell(15,4, $row['serie'],0, 0 , 'R' );
         $pdf->Cell(15,4, number_format($row['no_folio'],0),0, 0 , 'R' );
         $pdf->Cell(40,4, utf8_decode($row['concepto']),0, 0 , 'L' );
         $pdf->Cell(20,4, number_format($row['cargo'],2),0, 0 , 'R' );
         $pdf->Cell(20,4, number_format($row['abono'],2),0, 0, 'R' );
         $pdf->Cell(30,4, number_format($row['saldo'],2),0, 0, 'R' );
         $pdf->Cell(22,4, '',0, 1, 'L' );

      $total_cargos = $total_cargos + $row['cargo'];
      $total_abonos = $total_abonos + $row['abono'];
      $saldo_final  = ($total_cargos + $row['cargo']) - (($total_cargos + $row['abono']));
      $total_registrados = 1;
       if ($row['concepto'] == "Saldo Inicial") {
            $saldoinicial = $row['saldo'];
         }
        }
          
       }
       
 
}
 $pdf->ln(5);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, 'Resumen:',0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, 'Saldo Inicial:',0, 0, 'R'  );
        $pdf->Cell(20,4, number_format($saldoinicial,2),0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(+) Cargos:',0, 0, 'R'  );
        $pdf->Cell(20,4, number_format($total_cargos,2),0, 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(-) Abonos:','B', 0, 'R'  );
        $pdf->Cell(20,4, number_format($total_abonos,2),'B', 1, 'R'  );
        $pdf->Cell(52,4, '',0, 0 , 'R' );
        $pdf->Cell(40,4, '(=) Saldo Final:','B', 0, 'R'  );
        $pdf->Cell(20,4, number_format($saldo_final,2),'B', 1, 'R'  );
        $pdf->ln(5);
  


   
    




$pdf->Ln(5);


$pdf->Output();
?>