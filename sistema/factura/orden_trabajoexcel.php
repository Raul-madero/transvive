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
$objPHPExcel->getProperties()->setCreator("Transvive CRM")
               ->setLastModifiedBy("Transvive CRM")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

$objPHPExcel ->getActiveSheet()
             ->getStyle('A3:U3')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('8ACEC3'); //i.e,colorcode=D3D3D3 


$objPHPExcel->getActiveSheet()->getStyle('A3:U3')
    ->getAlignment()->setWrapText(true);                      

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:U1');
// Add some data


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Ordenes de Trabajo Mantenimiento')
            ->setCellValue('A3', 'ID')
            ->setCellValue('B3', 'No. Orden')
            ->setCellValue('C3', 'Fecha')
            ->setCellValue('D3', 'Mes')
            ->setCellValue('E3', 'Año')
            ->setCellValue('F3', 'Usuario')
            ->setCellValue('G3', 'Solicita')
            ->setCellValue('H3', 'Unidad')
            ->setCellValue('I3', 'Tipo de Trabajo')
            ->setCellValue('J3', 'Tipo de Mantenimiento')
            ->setCellValue('K3', 'Programado')
            ->setCellValue('L3', 'Trabajo Solicitado')
            ->setCellValue('M3', 'Concepto')
            ->setCellValue('N3', 'Trabajo Realizado')
            ->setCellValue('O3', 'Costo/Descuento')
            ->setCellValue('P3', 'Fecha Inicial')
            ->setCellValue('Q3', 'Fecha Termino')
            ->setCellValue('R3', 'Observaciones')
            ->setCellValue('S3', 'Causas del Servicio')
            ->setCellValue('T3', 'Aprobado')
            ->setCellValue('U3', 'Estatus');


// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:U3')->applyFromArray($boldArray);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(12);


$query_productos = mysqli_query($conection,"SELECT id, no_orden, fecha, usuario, solicita, unidad, tipo_trabajo, tipo_mantenimiento, programado, trabajo_solicitado, notas_genera, trabajo_hecho, costo_descuento, fecha_inicial, fecha_termino, notas, causas_servicio, aprobado, if(estatus = 1,'Activo',if(estatus = 2,'Cerrada',if(estatus = 3, 'En Proceso', 'Cancelada'))) as Status FROM solicitud_mantenimiento");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  $newDate  = date("d-m-Y", strtotime($row['fecha']));
  $newDate2 = date("d-m-Y", strtotime($row['fecha_inicial']));
  $newDate3 = date("d-m-Y", strtotime($row['fecha_termino']));
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
            ->setCellValue('F'.$fila, $row['usuario'])
            ->setCellValue('G'.$fila, $row['solicita'])
            ->setCellValue('H'.$fila, $row['unidad'])
            ->setCellValue('I'.$fila, $row['tipo_trabajo'])
            ->setCellValue('J'.$fila, $row['tipo_mantenimiento'])
            ->setCellValue('K'.$fila, $row['programado'])
            ->setCellValue('L'.$fila, $row['trabajo_solicitado'])
            ->setCellValue('M'.$fila, $row['notas_genera'])
            ->setCellValue('N'.$fila, $row['trabajo_hecho'])
            ->setCellValue('O'.$fila, $row['costo_descuento'])
            ->setCellValue('P'.$fila, $newDate2)
            ->setCellValue('Q'.$fila, $newDate3)
            ->setCellValue('R'.$fila, $row['notas'])
            ->setCellValue('S'.$fila, $row['causas_servicio'])
            ->setCellValue('T'.$fila, $row['aprobado'])
            ->setCellValue('U'.$fila, $row['Status']);
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Ordenes de Trabajo');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Ordenes de Trabajo.xlsx"');
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
