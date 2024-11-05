<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt  LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Mexico_City');

if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . './phpexcel/Classes/PHPExcel.php';
include('../../conexion.php');
    $conection->set_charset('utf8');

    $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

$fin = strrpos($idoentrada, "id2");
$final = $fin - 1;
$fecha_ini = substr($idoentrada, 0,  $fin);
$fin2 = $fin + 4;
$fecha_fin = substr($idoentrada, $fin2, 10);
//Consulta sql encabezado

$date = new DateTime($fecha_ini);
$iniDate = $date->format('d/m/Y');

$date2 = new DateTime($fecha_fin);
$finDate = $date2->format('d/m/Y');

$Datei = $date->format('Y-m-d');
$Datef = $date2->format('Y-m-d');

$conection->set_charset('utf8');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Transvive CRM")
               ->setLastModifiedBy("Transvive CRM")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

$objPHPExcel ->getActiveSheet()
             ->getStyle('A3:Z3')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('8ACEC3'); //i.e,colorcode=D3D3D3 


$objPHPExcel->getActiveSheet()->getStyle('A3:Z3')
    ->getAlignment()->setWrapText(true);                      

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
// Add some data


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Viajes Normales por Fecha')
            ->setCellValue('A3', 'MES')
            ->setCellValue('B3', 'ID')
            ->setCellValue('C3', 'SEMANA')
            ->setCellValue('D3', 'AÑO')
            ->setCellValue('E3', 'FECHA SALIDA')
            ->setCellValue('F3', 'CLIENTE')
            ->setCellValue('G3', 'JEFE OPERACIONES')
            ->setCellValue('H3', 'SUPERVISOR')
            ->setCellValue('I3', 'TIPO UNIDAD')
            ->setCellValue('J3', 'UNIDAD EJECUTA')
            ->setCellValue('K3', 'NO. UNIDAD')
            ->setCellValue('L3', 'NO. PERSONAS')
            ->setCellValue('M3', 'TIPO VUELTA')
            ->setCellValue('N3', 'RUTA')
            ->setCellValue('O3', 'NO. EMPLEADO')
            ->setCellValue('P3', 'OPERADOR')
            ->setCellValue('Q3', 'HORA SALIDA')
            ->setCellValue('R3', 'HORA LLEGADA')
            ->setCellValue('S3', 'HORA LLEGADA REAL')
            ->setCellValue('T3', 'VALOR VUELTA')
            ->setCellValue('U3', 'SUELDO VUELTA')
            ->setCellValue('V3', 'TOTAL VUELTA')
            ->setCellValue('W3', 'TIPO VIAJE')
            ->setCellValue('X3', 'ESTATUS')
            ->setCellValue('Y3', 'OBSERVACIONES')
            ->setCellValue('Z3', 'VALOR NS');          
   

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:Z3')->applyFromArray($boldArray);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);


$query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.direccion, rv.destino, rv.costo_viaje, rv.hora_inicio, rv.hora_fin, rv.hora_llegadareal, rv.hora_finreal, rv.notas, rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.numero_unidades, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.valor_vuelta, rv.sueldo_vuelta, rv.ruta, rv.operador, if (rv.planeado = 1, 'Planeado', 'Registrado') as Tipoviaje, rv.tipo_viaje, us.nombre AS jefeo, CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) as superv, em.noempleado, rv.personas FROM registro_viajes rv LEFT JOIN clientes ct ON rv.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON rv.id_supervisor = sp.idacceso LEFT JOIN empleados em ON rv.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) WHERE rv.tipo_viaje != 'Especial' and rv.fecha BETWEEN '$Datef' and '$Datei' ORDER by rv.fecha, rv.id");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  $newDate = date("d-m-Y", strtotime($row['fecha'])); 
      $total_vuelta = $row['valor_vuelta'] * $row['sueldo_vuelta'];
      if ($row['valor_vuelta'] == 0.5) {
        $valorNs = 0.5;
      }else {
        if ($row['hora_llegadareal'] == "00:00:00") {
          $valorNs = 0;
        }else {
          if ($row['hora_llegadareal'] <= $row['hora_fin']) {
            $valorNs = 1;
          }else {
            $valorNs = 0;
          }
        }
      }

      setlocale(LC_ALL, 'es_MX');
      $fechames = date(strtotime($row['fecha']));
      $anio = date("Y", $fechames);
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
  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$fila, $monthNameSpanish)
            ->setCellValue('B'.$fila, $row['id'])
            ->setCellValue('C'.$fila, strtoupper($row['semana']))
            ->setCellValue('D'.$fila, $anio)
            ->setCellValue('E'.$fila, $newDate)
            ->setCellValue('F'.$fila, strtoupper($row['cliente']))
            ->setCellValue('G'.$fila, strtoupper($row['jefeo']))
            ->setCellValue('H'.$fila, strtoupper($row['superv']))
            ->setCellValue('I'.$fila, $row['unidad'])
            ->setCellValue('J'.$fila, $row['unidad_ejecuta'])
            ->setCellValue('K'.$fila, $row['num_unidad'])
            ->setCellValue('L'.$fila, $row['personas'])
            ->setCellValue('M'.$fila, strtoupper($row['Tipoviaje']))
            ->setCellValue('N'.$fila, strtoupper($row['ruta']))
            ->setCellValue('O'.$fila, $row['noempleado'])
            ->setCellValue('P'.$fila, strtoupper($row['operador']))
            ->setCellValue('Q'.$fila, $row['hora_inicio'])
            ->setCellValue('R'.$fila, $row['hora_fin'])
            ->setCellValue('S'.$fila, $row['hora_llegadareal'])
            ->setCellValue('T'.$fila, number_format($row['valor_vuelta'],2))
            ->setCellValue('U'.$fila, number_format($row['sueldo_vuelta'],2))
            ->setCellValue('V'.$fila, number_format($total_vuelta,2))
            ->setCellValue('W'.$fila, $row['tipo_viaje'])
            ->setCellValue('X'.$fila, $row['Status'])
            ->setCellValue('Y'.$fila, $row['notas'])
            ->setCellValue('Z'.$fila, $valorNs);

            
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Viajes Normales por Fecha');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ViajesNormales fechas.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
