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
             ->getStyle('A1:AC1')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('C9CBCB'); //i.e,colorcode=D3D3D3 


$objPHPExcel->getActiveSheet()->getStyle('A2:AC200')
    ->getAlignment()->setWrapText(true);    

$objPHPExcel->getActiveSheet()->getStyle('A2:AC200')
->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
                    


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No.')
            ->setCellValue('B1', 'Mes')
            ->setCellValue('C1', 'Fecha')
            ->setCellValue('D1', 'Cliente')
            ->setCellValue('E1', '8D')
            ->setCellValue('F1', 'Descripción')
            ->setCellValue('G1', 'Motivo')
            ->setCellValue('H1', 'Responsable')
            ->setCellValue('I1', 'Supervisor')
            ->setCellValue('J1', 'Operador')
            ->setCellValue('K1', 'Unidad')
            ->setCellValue('L1', 'Ruta')
            ->setCellValue('M1', 'Parada')
            ->setCellValue('N1', 'Fecha incidente')
            ->setCellValue('O1', 'Turno')
            ->setCellValue('P1', 'Procede AC (sí o no)')
            ->setCellValue('Q1', '¿Por qué procede o no? (AC)')
            ->setCellValue('R1', 'Análisis y conclusión AC')
            ->setCellValue('S1', 'Acción')
            ->setCellValue('T1', 'Fecha acción')
            ->setCellValue('U1', 'Responsable acción')
            ->setCellValue('V1', 'Fecha cierre')
            ->setCellValue('W1', 'Observaciones')
            ->setCellValue('X1', 'Incidente ¿interno o externo?')
            ->setCellValue('Y1', 'Estatus')
            ->setCellValue('Z1', 'Cuenta')
            ->setCellValue('AA1', 'Causa')
            ->setCellValue('AB1', '¿Afecta cliente?')
            ->setCellValue('AC1', 'Área responsable');

// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(35);

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
            ->setCellValue('C'.$fila, $newDate)
            ->setCellValue('D'.$fila, $row['cliente'])
            ->setCellValue('E'.$fila, $row['f8d'])
            ->setCellValue('F'.$fila, $row['descripcion'])
            ->setCellValue('G'.$fila, $row['motivo'])
            ->setCellValue('H'.$fila, $row['responsable'])
            ->setCellValue('I'.$fila, $row['supervisor'])
            ->setCellValue('J'.$fila, $row['operador'])
            ->setCellValue('K'.$fila, $row['unidad'])
            ->setCellValue('L'.$fila, $row['ruta'])
            ->setCellValue('M'.$fila, $row['parada'])
            ->setCellValue('N'.$fila, $newDate2)
            ->setCellValue('O'.$fila, $row['turno'])
            ->setCellValue('P'.$fila, $row['procede_ac'])
            ->setCellValue('Q'.$fila, $row['porque_procede'])
            ->setCellValue('R'.$fila, $row['analisis_conclusionac'])
            ->setCellValue('S'.$fila, $row['accion'])
            ->setCellValue('T'.$fila, $newDate3)
            ->setCellValue('U'.$fila, $row['responsable_accion'])
            ->setCellValue('V'.$fila, $newDate4)
            ->setCellValue('W'.$fila, $row['observaciones'])
            ->setCellValue('X'.$fila, $row['tipo_incidente'])
            ->setCellValue('Y'.$fila, $row['estatus'])
            ->setCellValue('Z'.$fila, $row['cuenta'])
            ->setCellValue('AA'.$fila, $row['causa'])
            ->setCellValue('AB'.$fila, $row['afecta'])
            ->setCellValue('AC'.$fila, $row['area_responsable']);
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
