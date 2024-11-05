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
             ->getStyle('A3:I3')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('A1DE99'); //i.e,colorcode=D3D3D3     

$objPHPExcel->getActiveSheet()->getStyle('A3:I3')
    ->getAlignment()->setWrapText(true);                      

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:I1');
// Add some data


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Registro de Alertas')
            ->setCellValue('A3', 'ID')
            ->setCellValue('B3', 'Fecha')
            ->setCellValue('C3', 'Semana')
            ->setCellValue('D3', 'No. Unidad')
            ->setCellValue('E3', 'Operador')
            ->setCellValue('F3', 'No. Alertas')
            ->setCellValue('G3', 'Velocidad')
            ->setCellValue('H3', 'Limite')
            ->setCellValue('I3', 'Estatus');


// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:I3')->applyFromArray($boldArray);


$query_productos = mysqli_query($conection,"SELECT id, fecha, semana, cliente, unidad, operador, noalertas, velocidad, limite, if(estatus = 1,'Activo','Inactivo') as Status FROM alertas");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  $newDate = date("d-m-Y", strtotime($row['fecha']));
  $total = $total + $row['noalertas']; 
  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$fila, $row['id'])
            ->setCellValue('B'.$fila, $newDate)
            ->setCellValue('C'.$fila, $row['semana'])
            ->setCellValue('D'.$fila, $row['unidad'])
            ->setCellValue('E'.$fila, $row['operador'])
            ->setCellValue('F'.$fila, $row['noalertas'])
            ->setCellValue('G'.$fila, $row['velocidad'])
            ->setCellValue('H'.$fila, $row['limite'])
            ->setCellValue('I'.$fila, $row['Status']);
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Alertas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Registro Alertas.xlsx"');
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
