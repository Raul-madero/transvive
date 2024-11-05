<?php

//include('../fpdf/fpdf.php');
require '../includes/conversor.php';

header("Content-Type: text/html; charset=iso-8859-1 ");
//class PDF extends FPDF
//{
//function Header()
//{
//Variables para consulta
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);

//Consulta sql encabezado
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

   
//Logo
//*$this->Image("../../images/transvive.png",12,11,48,13,"png",0,'C');
//$this->Image("temp/test.png",12,31,35,23,"png",0,'C');
//Arial bold 15
//$this->SetFont('Arial','',10);
//Encabezado
//$this->Cell(50,15,'',0,0,'r');
//$this->SetFillColor(231,233,238);
//$this->SetTextcolor(6,22,54);
//$this->Cell(189,10,$semana,0,1,'C');
//$this->SetFont('Arial','',9);
//$this->Cell(189,5,'Periodo:'. ' '. $fecha_ini, 0,1,'C');


//$this->Cell(1,5,'',1,0,'L');
//Encabezado de la tabla
//$this->Cell(190,5,'DETALLE DE LA ENTRADA',1,1,'C');
//}



//function Footer()
//{

//$this->SetY(-10);
//$this->SetTextcolor(0,0,0);
//$this->SetFont('Arial','I',8);
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
//$this->Cell(0,10,utf8_decode(''),0,0,'C');
//$this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');

//}
//}
//Impresion 
$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);

//Consulta sql encabezado
//Consulta sql encabezado
//Variables para consulta

//$nosemana=$_REQUEST['semana'];


//Consulta sql encabezado
//Consulta sql encabezado
//*$pdf=new PDF();
//*$pdf->AddPage('portrait','letter');

if ($fecha_ini === "Semanal") {
    $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin_sem = strrpos($idoentrada, "id2");
$final_sem = $fin_sem - 1;
$periodo = substr($idoentrada, 0,  $fin_sem);
$fin2_sem = $fin_sem + 4;
$fecha_finsem = substr($idoentrada, $fin2_sem, 9);
$finfin_sem = strrpos($idoentrada, "id3"); 
$final3_sem = $finfin_sem + 4;
$fecha_fin2sem = substr($idoentrada, $final3_sem, 10);
$finfin2_sem = strrpos($idoentrada, "id4"); 
$final4_sem = $finfin2_sem + 4;
$fecha_ejerciciosem = substr($idoentrada, $final4_sem, 10);

//$pdf->Cell(189,5,'Periodo:'. ' '. $periodo . ' Inicial '. $fecha_finsem. ' Final '. $fecha_fin2sem. ' Anio '. $fecha_ejerciciosem , 0,1,'C');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= Reporte Acumulado por Periodos.xls");
header("Pragma: no-cache");
header("Expires: 0");
   
include('../../conexion.php');
$conection->set_charset('utf8');

$query_productos = mysqli_query($conection,"SELECT dn.no_empleado, dn.nombre, dn.cargo, dn.imss, dn.estatus, sum(dn.deduccion_fiscal) as Dedfiscal, sum(dn.total_general) as Totgral, sum(dn.caja) as Caja_ahorro, SUM( dn.total_nomina) as Tot_nomina, sum(dn.descuento_adeudo) as Adeudo, SUM(dn.viajes_especiales) as Tot_especiales, sum(dn.viajes_contrato) as Tot_contrato, SUM( dn.sueldo_bruto) as Sdo_bruto, sum(dn.bono_categoria) as Bonocategoria, SUM( dn.bono_supervisor) as Bonosupervisor, sum(dn.descuento_adeudo) as Adeudo, SUM( dn.bono_semanal) as Bonosemanal, SUM(dn.apoyo_mensual) as Apoyomes, SUM(dn.sueldo_adicional) as Sdo_adicional, SUM(dn.total_especiales) as Totalespecial, SUM(dn.total_vueltas) as Totalvueltas, SUM(dn.prima_vacacional) as Primavacacional, SUM(dn.vacaciones) as Totvacaciones, SUM(dn.pago_fiscal) as Pagofiscal FROM detalle_nomina dn WHERE dn.no_semana BETWEEN '$fecha_finsem' and '$fecha_fin2sem' and dn.yearpago = $fecha_ejerciciosem GROUP BY dn.no_empleado ORDER BY dn.no_empleado");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection); 
      //$litrostot = 0;
      //$importetot = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DETALLADO DE NOMINA POR RANGO DE SEMANAS'. ' DE: '. $fecha_finsem. ' A LA: '. $fecha_fin2sem ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>No. Empleado</th>
    <th>Nombre</th>
    <th>Cargo</th>
    <th>IMSS</th>
    <th>Estatus</th>
    <th>Bono Categoria</th>
    <th>Bono Supervisor</th>
    <th>Bono Semanal</th>
    <th>Apoyo Mensual</th>
    <th>Sueldo Adicional</th>
    <th>Viajes Especiales</th>
    <th>Total Especiales</th>
    <th>Viajes Contrato</th>
    <th>Total Contrato</th>
    <th>Prima Vacacional</th>
    <th>Vacaciones</th>
    <th>Caja de Ahorro</th>
    <th>Descuento / Adeudos</th>
    <th>Sueldo Bruto</th>
    <th>Sueldo Fiscal</th>
    <th>Impuesto Fiscal</th>
    <th>Deposito</th>
    <th>Total Efectivo</th>

    </tr>
    </thead>
<?php
 while ($row=mysqli_fetch_assoc($query_productos)) {
        
        //$importetot = $importetot + $row['importe'];
        //$litrostot = $litrostot + $row['litros'];
      ?>
        <tr>
          <td><?php echo $row['no_empleado']; ?></td>
          <td><?php echo utf8_decode($row['nombre']); ?></td>
          <td><?php echo utf8_decode($row['cargo']); ?></td>
          <td><?php echo $row['imss']; ?></td>
          <td><?php echo $row['estatus']; ?></td>
          <td><?php echo number_format($row['Bonocategoria'],2); ?></td>
          <td><?php echo number_format($row['Bonosupervisor'],2); ?></td>
          <td><?php echo number_format($row['Bonosemanal'],2); ?></td>
          <td><?php echo number_format($row['Apoyomes'],2); ?></td>
          <td><?php echo number_format($row['Sdo_adicional'],2); ?></td>
          <td><?php echo number_format($row['Tot_especiales'],2); ?></td>
          <td><?php echo number_format($row['Totalespecial'],2); ?></td>
          <td><?php echo number_format($row['Tot_contrato'],2); ?></td>
          <td><?php echo number_format($row['Totalvueltas'],2); ?></td>
          <td><?php echo number_format($row['Primavacacional'],2); ?></td>
          <td><?php echo number_format($row['Totvacaciones'],2); ?></td>
          <td><?php echo number_format($row['Caja_ahorro'],2); ?></td>
          <td><?php echo number_format($row['Adeudo'],2); ?></td>
          <td><?php echo number_format($row['Sdo_bruto'],2); ?></td>
          <td><?php echo number_format($row['Pagofiscal'],2); ?></td> 
          <td><?php echo number_format($row['Dedfiscal'],2); ?></td>
          <td><?php echo number_format($row['Tot_nomina'],2); ?></td>
          <td><?php echo number_format($row['Totgral'],2); ?></td>
        </tr> 
     
      <?php
    }


}else {
    if ($fecha_ini === "Quincenal") {
    $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin_quin = strrpos($idoentrada, "id2");
$final_quin = $fin_quin - 1;
$periodo = substr($idoentrada, 0,  $fin_quin);
$fin2_quin = $fin_quin + 4;
$fecha_finquin = substr($idoentrada, $fin2_quin, 11);
$finfin_quin = strrpos($idoentrada, "id3"); 
$final3_quin = $finfin_quin + 4;
$fecha_fin2quin = substr($idoentrada, $final3_quin, 11);
$finfin2_quin = strrpos($idoentrada, "id4"); 
$final4_quin = $finfin2_quin + 4;
$fecha_ejercicioquin = substr($idoentrada, $final4_quin, 10);

//$pdf->Cell(189,5,'Periodo:'. ' '. $periodo . ' Inicial '. $fecha_finsem. ' Final '. $fecha_fin2sem. ' Anio '. $fecha_ejerciciosem , 0,1,'C');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= Reporte Acumulado por Periodos.xls");
header("Pragma: no-cache");
header("Expires: 0");
   
include('../../conexion.php');
$conection->set_charset('utf8');

$query_productos = mysqli_query($conection,"SELECT dn.no_empleado, dn.nombre, dn.puesto, dn.estatus, SUM(dn.sueldo_bruto) as Sdo_bruto, SUM(dn.sueldo_total) as Sdo_total, SUM(dn.bono) as Bonosupervisor, SUM(dn.bono_mensual) as Bonocategoria, SUM(dn.apoyo_alimenticio) as Apoyomes, SUM(dn.subtotal) as Totsubtotal, SUM(dn.caja_ahorro) as Caja, SUM(dn.prestamo_deuda)as Adeudo, SUM(dn.vacaciones) as Totvacaciones, SUM(dn.prima_vacacional) as Primavacacional, SUM(dn.sueldo_quincenal) as Sdo_quincenal, SUM(dn.sueldo_fiscal) as Sdo_fiscal, SUM(dn.impuesto_fiscal) as Impuestofiscal, SUM(dn.total_efectivo) as Totefectivo, SUM(dn.deposito) as Totdeposito FROM detalle_temp_nominaquincena dn WHERE dn.no_quincena BETWEEN '$fecha_finquin' and '$fecha_fin2quin' and dn.yearpago = $fecha_ejercicioquin GROUP BY dn.no_empleado ORDER BY dn.no_empleado");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection);    
?>
<?php echo 'REPORTE DETALLADO DE NOMINA POR RANGO DE QUINCENAS'. ' DE: '. $fecha_finquin. ' A LA: '. $fecha_fin2quin ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th>No. Empleado</th>
    <th>Nombre</th>
    <th>Puesto</th>
    <th>Estatus</th>
    <th>Bono Categoria</th>
    <th>Bono Supervisor</th>
    <th>Apoyo Mensual</th>
    <th>Sueldo Bruto</th>
    <th>Prima Vacacional</th>
    <th>Vacaciones</th>
    <th>Caja de Ahorro</th>
    <th>Descuento / Adeudos</th>
    <th>Subtotal</th>
    <th>Sueldo Fiscal</th>
    <th>Impuesto Fiscal</th>
    <th>Deposito</th>
    <th>Total Efectivo</th>

    </tr>
    </thead>
<?php 

 while ($row=mysqli_fetch_assoc($query_productos)) {
        
        //$importetot = $importetot + $row['importe'];
        //$litrostot = $litrostot + $row['litros'];
      ?>
        <tr>
          <td><?php echo $row['no_empleado']; ?></td>
          <td><?php echo utf8_decode($row['nombre']); ?></td>
          <td><?php echo utf8_decode($row['puesto']); ?></td>
          <td><?php echo $row['estatus']; ?></td>
          <td><?php echo number_format($row['Bonocategoria'],2); ?></td>
          <td><?php echo number_format($row['Bonosupervisor'],2); ?></td>
          <td><?php echo number_format($row['Apoyomes'],2); ?></td>
          <td><?php echo number_format($row['Sdo_bruto'],2); ?></td>
          <td><?php echo number_format($row['Primavacacional'],2); ?></td>
          <td><?php echo number_format($row['Totvacaciones'],2); ?></td>
          <td><?php echo number_format($row['Caja'],2); ?></td>
          <td><?php echo number_format($row['Adeudo'],2); ?></td>
          <td><?php echo number_format($row['Totsubtotal'],2); ?></td>
          <td><?php echo number_format($row['Sdo_fiscal'],2); ?></td> 
          <td><?php echo number_format($row['Impuestofiscal'],2); ?></td>
          <td><?php echo number_format($row['Totdeposito'],2); ?></td>
          <td><?php echo number_format($row['Totefectivo'],2); ?></td>
        </tr> 
     
      <?php


}
}
}


//$pdf->Image("$imagen",10,165,189,100,'png');

// Salto de pagina
// $pdf->Ln(5);
// $pdf->AddPage();

// $pdf->Image("$imagen",10,30,189,150,'png');
//$pdf->Output();
?>