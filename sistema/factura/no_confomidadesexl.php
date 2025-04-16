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
             ->getStyle('A1:AD1')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('C9CBCB'); //i.e,colorcode=D3D3D3 


$objPHPExcel->getActiveSheet()->getStyle('A2:AD200')
    ->getAlignment()->setWrapText(true);    

$objPHPExcel->getActiveSheet()->getStyle('A2:AD200')
->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
                    


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No.')
            ->setCellValue('B1', 'Mes')
            ->setCellValue('C1', 'Anio')
            ->setCellValue('D1', 'Fecha')
            ->setCellValue('E1', 'Cliente')
            ->setCellValue('F1', '8D')
            ->setCellValue('G1', 'Descripcion')
            ->setCellValue('H1', 'Motivo')
            ->setCellValue('I1', 'Responsable')
            ->setCellValue('J1', 'Supervisor')
            ->setCellValue('K1', 'Operador')
            ->setCellValue('L1', 'Unidad')
            ->setCellValue('M1', 'Ruta')
            ->setCellValue('N1', 'Parada')
            ->setCellValue('O1', 'Fecha incidente')
            ->setCellValue('P1', 'Turno')
            ->setCellValue('Q1', 'Procede AC (sí o no)')
            ->setCellValue('R1', '¿Por qué procede o no? (AC)')
            ->setCellValue('S1', 'Analisis y conclusion AC')
            ->setCellValue('T1', 'Accion')
            ->setCellValue('U1', 'Fecha accion')
            ->setCellValue('V1', 'Responsable accion')
            ->setCellValue('W1', 'Fecha cierre')
            ->setCellValue('X1', 'Observaciones')
            ->setCellValue('Y1', 'Incidente ¿interno o externo?')
            ->setCellValue('Z1', 'Estatus')
            ->setCellValue('AA1', 'Cuenta')
            ->setCellValue('AB1', 'Causa')
            ->setCellValue('AC1', '¿Afecta cliente?')
            ->setCellValue('AD1', 'Área responsable');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(35);

$query_productos = mysqli_query($conection,"SELECT id, no_queja, fecha, mes, cliente, f8d, descripcion, motivo, responsable, supervisor, operador, unidad, ruta, parada, fecha_incidente, turno, procede_ac, porque_procede, analisis_conclusionac, accion, fecha_accion, responsable_accion, fecha_cierre, observaciones, tipo_incidente, estatus, cuenta, causa, afecta, area_responsable FROM no_conformidades ORDER by no_queja");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 2;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  $newDate  = date("d-m-Y", strtotime($row['fecha']));
  $newDate2 = date("d-m-Y", strtotime($row['fecha_incidente']));
  $newDate3 = date("d-m-Y", strtotime($row['fecha_accion']));
  $newDate4 = date("d-m-Y", strtotime($row['fecha_cierre']));
  $fechames = date(strtotime($row['fecha']));
     
      $anio = date("Y", $fechames);

  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$fila, $row['no_queja'])
            ->setCellValue('B'.$fila, $row['mes'])
            ->setCellValue('C'.$fila, $anio)
            ->setCellValue('D'.$fila, $newDate)
            ->setCellValue('E'.$fila, $row['cliente'])
            ->setCellValue('F'.$fila, $row['f8d'])
            ->setCellValue('G'.$fila, $row['descripcion'])
            ->setCellValue('H'.$fila, $row['motivo'])
            ->setCellValue('I'.$fila, $row['responsable'])
            ->setCellValue('J'.$fila, $row['supervisor'])
            ->setCellValue('K'.$fila, $row['operador'])
            ->setCellValue('L'.$fila, $row['unidad'])
            ->setCellValue('M'.$fila, $row['ruta'])
            ->setCellValue('N'.$fila, $row['parada'])
            ->setCellValue('O'.$fila, $newDate2)
            ->setCellValue('P'.$fila, $row['turno'])
            ->setCellValue('Q'.$fila, $row['procede_ac'])
            ->setCellValue('R'.$fila, $row['porque_procede'])
            ->setCellValue('S'.$fila, $row['analisis_conclusionac'])
            ->setCellValue('T'.$fila, $row['accion'])
            ->setCellValue('U'.$fila, $newDate3)
            ->setCellValue('V'.$fila, $row['responsable_accion'])
            ->setCellValue('W'.$fila, $newDate4)
            ->setCellValue('X'.$fila, $row['observaciones'])
            ->setCellValue('Y'.$fila, $row['tipo_incidente'])
            ->setCellValue('Z'.$fila, $row['estatus'])
            ->setCellValue('AA'.$fila, $row['cuenta'])
            ->setCellValue('AB'.$fila, $row['causa'])
            ->setCellValue('AC'.$fila, $row['afecta'])
            ->setCellValue('AD'.$fila, $row['area_responsable']);
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('No Conformidades');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="No Conformidades.xlsx"');
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
