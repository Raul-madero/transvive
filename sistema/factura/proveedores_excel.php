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
            ->setCellValue('A3', 'No.')
            ->setCellValue('B3', 'Nombre Corto')
            ->setCellValue('C3', 'Calle y Número')
            ->setCellValue('D3', 'Colonia')
            ->setCellValue('E3', 'Ciudad')
            ->setCellValue('F3', 'Municipio')
            ->setCellValue('G3', 'Estado')
            ->setCellValue('H3', 'Codigo Postal')
            ->setCellValue('I3', 'Teléfono')
            ->setCellValue('J3', 'Contacto')
            ->setCellValue('K3', 'Correo Electrónico')
            ->setCellValue('L3', 'Teléfono Contacto')
            ->setCellValue('M3', 'Giro de Empresa')
            ->setCellValue('N3', 'Sitio Web')
            ->setCellValue('O3', 'Razón Social')
            ->setCellValue('P3', 'R.F.C.')
            ->setCellValue('Q3', 'Contacto Contabilidad')
            ->setCellValue('R3', 'Correo Electrónico Contabilidad')
            ->setCellValue('S3', 'Crédito')
            ->setCellValue('T3', 'Condiciones de Crédito')
            ->setCellValue('U3', 'Limite de Crédito');


// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
$objPHPExcel->getActiveSheet()->getStyle('S4:S5000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
 
$objPHPExcel->getActiveSheet()->getStyle('A1:U3')->applyFromArray($boldArray);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);


$query_productos = mysqli_query($conection,"SELECT oc.id, oc.no_prov, oc.nombre, oc.nombre_corto, oc.calle, oc.colonia, oc.ciudad, oc.municipio, oc.estado, oc.pais, oc.cod_postal, oc.giro, oc.servicio, oc.telefono, oc.movil, oc.correo, oc.contacto, oc.contacto_conta, oc.email_conta, oc.credito, oc.condiciones_credito, oc.limite_credito, oc.sitio, oc.rfc, if(oc.estatus = 1,'Activo','Cancelado') as Status FROM proveedores oc ");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  
  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$fila, $row['no_prov'])
            ->setCellValue('B'.$fila, $row['nombre_corto'])
            ->setCellValue('C'.$fila, $row['calle'])
            ->setCellValue('D'.$fila, $row['colonia'])
            ->setCellValue('E'.$fila, $row['ciudad'])
            ->setCellValue('F'.$fila, $row['municipio'])
            ->setCellValue('G'.$fila, $row['estado'])
            ->setCellValue('H'.$fila, $row['cod_postal'])
            ->setCellValue('I'.$fila, $row['telefono'])
            ->setCellValue('J'.$fila, $row['contacto'])
            ->setCellValue('K'.$fila, $row['correo'])
            ->setCellValue('L'.$fila, $row['movil'])
            ->setCellValue('M'.$fila, $row['giro'])
            ->setCellValue('N'.$fila, $row['sitio'])
            ->setCellValue('O'.$fila, $row['nombre'])
            ->setCellValue('P'.$fila, $row['rfc'])
            ->setCellValue('Q'.$fila, $row['contacto_conta'])
            ->setCellValue('R'.$fila, $row['email_conta'])
            ->setCellValue('S'.$fila, $row['credito'])
            ->setCellValue('T'.$fila, $row['condiciones_credito'])
            ->setCellValue('U'.$fila, number_format($row['limite_credito'],2));


  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Proveedores');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Proveedores.xlsx"');
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
