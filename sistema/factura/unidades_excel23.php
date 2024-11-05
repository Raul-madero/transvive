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
             ->getStyle('A3:R3')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('A1DE99'); //i.e,colorcode=D3D3D3     

$objPHPExcel->getActiveSheet()->getStyle('A3:R3')
    ->getAlignment()->setWrapText(true);                      

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:R1');
// Add some data


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Listado de Unidades')
            ->setCellValue('A3', 'ID')
            ->setCellValue('B3', 'No. Unidad')
            ->setCellValue('C3', 'Socio')
            ->setCellValue('D3', 'Descripcion')
            ->setCellValue('E3', 'Placas')
            ->setCellValue('F3', 'No. Serie')
            ->setCellValue('G3', 'Modelo')
            ->setCellValue('H3', 'Tipo Combustible')
            ->setCellValue('I3', 'No. Poliza')
            ->setCellValue('J3', 'Aseguradora')
            ->setCellValue('K3', 'Inicia Poliza')
            ->setCellValue('L3', 'Termina Poliza')
            ->setCellValue('M3', 'Tarjeta de Circulacion')
            ->setCellValue('N3', 'Vence Tarjeta Circulacion')
            ->setCellValue('O3', 'Fecha Entrega Doc.')
            ->setCellValue('P3', 'Rendimiento')
            ->setCellValue('Q3', 'Observaciones')
            ->setCellValue('R3', 'Estatus');


// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:R3')->applyFromArray($boldArray);


$query_productos = mysqli_query($conection,"SELECT id, no_unidad, socio, descripcion, placas, no_serie, year, tipo_combustible, no_poliza, aseguradora, inicio_poliza, fin_poliza, tarjeta_circulacion, vence_tcirculacion, fecha_entregadoc, rendimiendo_estandar, notas, if(estatus = 1,'Activo','Inactivo') as Status FROM unidades");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  $newDate  = date("d-m-Y", strtotime($row['inicio_poliza']));
  $newDate2 = date("d-m-Y", strtotime($row['fin_poliza']));
  $newDate3 = date("d-m-Y", strtotime($row['vence_tcirculacion']));
  $newDate4 = date("d-m-Y", strtotime($row['fecha_entregadoc']));
  //$total = $total + $row['noalertas']; 
  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$fila, $row['id'])
            ->setCellValue('B'.$fila, $row['no_unidad'])
            ->setCellValue('C'.$fila, $row['socio'])
            ->setCellValue('D'.$fila, $row['descripcion'])
            ->setCellValue('E'.$fila, $row['placas'])
            ->setCellValue('F'.$fila, $row['no_serie'])
            ->setCellValue('G'.$fila, $row['year'])
            ->setCellValue('H'.$fila, $row['tipo_combustible'])
            ->setCellValue('I'.$fila, $row['no_poliza'])
            ->setCellValue('J'.$fila, $row['aseguradora'])
            ->setCellValue('K'.$fila, $newDate)
            ->setCellValue('L'.$fila, $newDate2)
            ->setCellValue('M'.$fila, $row['tarjeta_circulacion'])
            ->setCellValue('N'.$fila, $newDate3)
            ->setCellValue('O'.$fila, $newDate4)
            ->setCellValue('P'.$fila, $row['rendimiendo_estandar'])
            ->setCellValue('Q'.$fila, $row['notas'])
            ->setCellValue('I'.$fila, $row['Status']);
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Unidades');


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
