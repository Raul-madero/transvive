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

$fin = strrpos($idoentrada, "id3");
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

$fin = strrpos($idoentrada, "id3");
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

$idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin_sem = strrpos($idoentrada, "id3");
$final_sem = $fin_sem - 1;
$periodo = substr($idoentrada, 0,  $fin_sem);
$fin2_sem = $fin_sem + 4;
$fecha_finsem = substr($idoentrada, $fin2_sem, 9);

//$pdf->Cell(189,5,'Periodo:'. ' '. $periodo . ' Inicial '. $fecha_finsem. ' Final '. $fecha_fin2sem. ' Anio '. $fecha_ejerciciosem , 0,1,'C');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= Reporte Viajes Planeados vs Registrados.xls");
header("Pragma: no-cache");
header("Expires: 0");
   
include('../../conexion.php');
$conection->set_charset('utf8');

$query_productos = mysqli_query($conection,"SELECT dn.operador, em.cargo, em.noempleado, SUM(IF(dn.planeado=1, dn.planeado, 0)) AS Planeados, SUM(dn.valor_vuelta) AS Registrados FROM registro_viajes dn INNER JOIN semanas40 sm ON dn.semana = sm.semana INNER JOIN empleados em ON dn.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) WHERE dn.semana = '$periodo' AND YEAR(sm.dia_inicial) = $fecha_finsem GROUP BY dn.operador ORDER BY em.noempleado");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection); 
      $total_planeados = 0;
      $total_registrados = 0;
      $total_diferencias = 0;

  
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<?php echo 'REPORTE DE VIAJES PLANEADOS VS REGISTADOS'. ' DE: '. $periodo. ' DEL : '. $fecha_finsem ; ?>
<table border="1">
    <thead style='background-color:#292929;'>
    <tr>
    <th bgcolor="#8BEA6F">No. Emp.</th>
    <th bgcolor="#8BEA6F">Empleado</th>
    <th bgcolor="#8BEA6F">Cargo</th>
    <th bgcolor="#8BEA6F">Planeados</th>
    <th bgcolor="#8BEA6F">Registrados</th>
    <th bgcolor="#8BEA6F">Diferencia</th>

    </tr>
    </thead>
<?php
 while ($row=mysqli_fetch_assoc($query_productos)) {
        
        $Diferencias = $row['Registrados'] - $row['Planeados'];
        $total_planeados = $total_planeados + $row['Planeados'];
        $total_registrados = $total_registrados + $row['Registrados'];
        $total_diferencias = $total_registrados - $total_planeados;
      ?>
        <tr>
          <td><?php echo ($row['noempleado']); ?></td>
          <td><?php echo ($row['operador']); ?></td>
          <td><?php echo ($row['cargo']); ?></td>
          <td><?php echo number_format($row['Planeados'],2); ?></td>
          <td><?php echo number_format($row['Registrados'],2); ?></td>
          <td><?php echo number_format($Diferencias,2); ?></td>
          
        </tr> 
     
      <?php
    }
    ?>
       <tr>
          <td colspan="3" align="right" style="color: black; font-weight: bold;"><?php echo ('TOTALES: '); ?></td>
          <td style="color: black; font-weight: bold;"><?php echo number_format($total_planeados,2); ?></td>
          <td style="color: black; font-weight: bold;"><?php echo number_format($total_registrados,2); ?></td>
          <td style="color: black; font-weight: bold;"><?php echo number_format($total_diferencias,2); ?></td>
          
        </tr> 



