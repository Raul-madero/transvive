<?php
include('../fpdf/fpdf.php');
include "../../conexion.php";
session_start();

$semana = $_REQUEST['id'];


class PDF extends FPDF {
    function BasicTable($header, $data, $x = 0, $y = 0) {

        $this->SetXY($x , $y);
        $this->SetFillColor(44, 189, 13);
        
        // Header
        foreach($header as $col)
            $this->Cell(22.3 ,4,$col,1,0,'C','T');
        $this->Ln();
        
        // Data
        $i = 5;
        $this->SetXY($x , $y + $i);
        foreach($data as $row){
            foreach($row as $col){
                //$this->SetXY($x , $y + $i);
                $this->Cell(22.3 ,4,$col,1,0,'C');
                
            }
            $i= $i + 4 ;  // incremento el valor de la columna
            $this->SetXY($x , $y + $i);     
          //$this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->SetFont('Arial', '', 7);
$pdf->AddPage();



//TABLA 1
$query2 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = '$semana' and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'A' and 'M' group by rv.cliente, rv.ruta order by rv.cliente");
$result2 = mysqli_num_rows($query2);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo = mysqli_query($conection,"SELECT cliente from registro_viajes where semana = '$semana' and substr(cliente, 1, 1) BETWEEN 'A' and 'M' group by cliente order by cliente ");
$result_articulo = mysqli_num_rows($articulo);
$total_planeados = 0;
$total_registrados = 0;
$total_diferencia = 0;

$header = array('Ruta', 'Planeados', 'Registrados', 'Diferencia');
$data = [];
while ($row = mysqli_fetch_assoc($query2)){
    $grupoant=$articulo;
    $articulo=$row['cliente'];
    $diferencia = $row['viajes_extras'] - $row['viajes_planeados'];
    if($grupoant != $articulo){

      if ($total_registrados == 0) {
         $tot_clientereg = "";
       }else {
         $tot_clientereg = $total_registrados;

     array_push($data, array('', number_format($total_planeados,2), number_format($tot_clientereg,2), number_format($total_diferencia,2)));
       }


     array_push($data, array($row['cliente']));
     $total_planeados = 0;
     $total_registrados = 0;
     $total_diferencia = 0;
   
    }


//for ($index = 0; $index < 13; $index++) {
    array_push($data, array($row['ruta'], number_format($row['viajes_planeados'],2), number_format($row['viajes_extras'],2), number_format($diferencia,2)));
    $total_planeados = $total_planeados + $row['viajes_planeados'];
    $total_registrados = $total_registrados + $row['viajes_extras'];
    $total_diferencia = $total_registrados - $total_planeados;
}
array_push($data, array('', number_format($total_planeados,2), number_format($total_registrados,2), number_format($total_diferencia,2)));
$pdf->BasicTable($header, $data, 10, 10);
$pdf->Ln(5);



//TABLA 2
$query3 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = '$semana' and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'N' and 'Z' group by rv.cliente, rv.ruta order by rv.cliente");
$result3 = mysqli_num_rows($query3);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo2 = mysqli_query($conection,"SELECT cliente from registro_viajes where semana = '$semana' and substr(cliente, 1, 1) BETWEEN 'N' and 'Z' group by cliente order by cliente ");
$result_articulo2 = mysqli_num_rows($articulo2);
$total_planeados2 = 0;
$total_registrados2 = 0;
$total_diferencia2 = 0;

$header = array('Ruta', 'Planeados', 'Registrados', 'Diferencia');
$data1 = [];
while ($row2 = mysqli_fetch_assoc($query3)){
    $grupoant2=$articulo2;
    $articulo2=$row2['cliente'];
    $diferencia2 = $row2['viajes_extras'] - $row2['viajes_planeados'];
    if($grupoant2 != $articulo2){

      if ($total_registrados2 == 0) {
         $tot_clientereg2 = "";
       }else {
      $tot_clientereg2 = $total_registrados2;

     array_push($data1, array('', number_format($total_planeados2,2), number_format($tot_clientereg2,2), number_format($total_diferencia2,2)));
}


array_push($data1, array($row2['cliente']));
$total_planeados2 = 0;
$total_registrados2 = 0;
$total_diferencia2 = 0;
   
    }


//for ($index = 0; $index < 13; $index++) {
    array_push($data1, array($row2['ruta'], number_format($row2['viajes_planeados'],2), number_format($row2['viajes_extras'],2), number_format($diferencia2,2)));
    $total_planeados2 = $total_planeados2 + $row2['viajes_planeados'];
    $total_registrados2 = $total_registrados2 + $row2['viajes_extras'];
    $total_diferencia2 = $total_registrados2 - $total_planeados2;
}
array_push($data1, array('', number_format($total_planeados2,2), number_format($total_registrados2,2), number_format($total_diferencia2,2)));
$pdf->BasicTable($header, $data1, 100, 10);
//pdf->Ln(5);


$pdf->Ln(5);

//TABLA 3
$query4 = mysqli_query($conection,"SELECT SUM(IF(planeado=1, valor_vuelta, 0)) AS viajes_planeados, SUM(valor_vuelta) AS viajes_extras, SUM(valor_vuelta)  - SUM(IF(planeado=1, valor_vuelta, 0)) as diferencia FROM registro_viajes  WHERE semana = '$semana' and estatus = 2 ");
$result3 = mysqli_num_rows($query4);
$header = array('Semana', 'Planeados', 'Registrados', 'Diferencia');
$data = [];
while ($row3 = mysqli_fetch_assoc($query4)){
//for ($index = 0; $index < 2; $index++) {
    array_push($data, array($semana, number_format($row3['viajes_planeados'],2), number_format($row3['viajes_extras'],2), number_format($row3['diferencia'],2)));
}

$pdf->BasicTable($header, $data, 10, 260);

/*
//TABLA 4
$header = array('Semana:');
$data = [];
for ($index = 0; $index < 1; $index++) {
    array_push($data, array($semana));
}

$pdf->BasicTable($header, $data, 100, 260);

*/

$pdf->Output();