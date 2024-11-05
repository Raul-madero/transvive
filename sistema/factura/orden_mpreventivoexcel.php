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

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Transvive ERP")
               ->setLastModifiedBy("Transvive ERP")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

$objPHPExcel ->getActiveSheet()
             ->getStyle('A3:O3')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('8ACEC3'); //i.e,colorcode=D3D3D3 


$objPHPExcel->getActiveSheet()->getStyle('A3:O3')
    ->getAlignment()->setWrapText(true);                      

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:O1');
// Add some data


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Ordenes de Trabajo Mantenimiento Preventivo')
            ->setCellValue('A3', 'ID')
            ->setCellValue('B3', 'No. Orden')
            ->setCellValue('C3', 'Fecha')
            ->setCellValue('D3', 'Mes')
            ->setCellValue('E3', 'Año')
            ->setCellValue('F3', 'Hora')
            ->setCellValue('G3', 'Usuario')
            ->setCellValue('H3', 'Solicita')
            ->setCellValue('I3', 'Unidad')
            ->setCellValue('J3', 'Tipo de Trabajo')
            ->setCellValue('K3', 'Kilometraje')
            ->setCellValue('L3', 'Fecha Inicio')
            ->setCellValue('M3', 'Fecha Culminacion')
            ->setCellValue('N3', 'Observaciones')
            ->setCellValue('O3', 'Estatus');


// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:O3')->applyFromArray($boldArray);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);



$query_productos = mysqli_query($conection,"SELECT id, no_orden, fecha, hora, usuario, solicitada, unidad, tipo_trabajo, kilometraje, fecha_inicio, fecha_culminacion, observaciones, if(estatus = 1,'Activo',if(estatus = 2,'Cerrada', 'Cancelada')) as Status FROM mantenimiento_preventivo");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  if ($row['fecha'] > "2000-01-01") {
    $newDate  = date("d-m-Y", strtotime($row['fecha']));
  }else {
    $newDate  = "";
  }

  if ($row['hora'] > "00:01:01") {
    $newTime  = date("h:m", strtotime($row['hora']));
  }else {
    $newTime  = "00:00";
  }

  
 if ($row['fecha_inicio'] > "2000-01-01") {
     $newDate2 = date("d-m-Y", strtotime($row['fecha_inicio']));
 }else {
     $newDate2 = "";
 }

 if ($row['fecha_culminacion'] > "2000-01-01") {
   $newDate3 = date("d-m-Y", strtotime($row['fecha_culminacion']));
 }else {
   $newDate3 = "";
 }

 $fechames = date(strtotime($row['fecha']));
      $mes = date("m", $fechames);
      $anio = date("Y", $fechames);

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
            ->setCellValue('A'.$fila, $row['id'])
            ->setCellValue('B'.$fila, $row['no_orden'])
            ->setCellValue('C'.$fila, $newDate)
            ->setCellValue('D'.$fila, $monthNameSpanish)
            ->setCellValue('E'.$fila, $anio)
            ->setCellValue('F'.$fila, $newTime)
            ->setCellValue('G'.$fila, $row['usuario'])
            ->setCellValue('H'.$fila, $row['solicitada'])
            ->setCellValue('I'.$fila, $row['unidad'])
            ->setCellValue('J'.$fila, $row['tipo_trabajo'])
            ->setCellValue('K'.$fila, $row['kilometraje'])
            ->setCellValue('L'.$fila, $newDate2)
            ->setCellValue('M'.$fila, $newDate3)
            ->setCellValue('N'.$fila, $row['observaciones'])
            ->setCellValue('O'.$fila, $row['Status']);
            
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Ordenes de Trabajo MP');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Ordenes de Trabajo MP.xlsx"');
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
