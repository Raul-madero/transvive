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
             ->getStyle('A3:Z3')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('8ACEC3'); //i.e,colorcode=D3D3D3 


$objPHPExcel->getActiveSheet()->getStyle('A3:Z3')
    ->getAlignment()->setWrapText(true);                      

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
$objPHPExcel->getActiveSheet()->getStyle('O4:O5000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
// Add some data


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomina Semanal')
            ->setCellValue('A3', 'Semana')
            ->setCellValue('B3', 'Año')
            ->setCellValue('C3', 'No. Empleado')
            ->setCellValue('D3', 'Nombre')
            ->setCellValue('E3', 'Cargo')
            ->setCellValue('F3', 'IMSS')
            ->setCellValue('G3', 'Sueldo Base')
            ->setCellValue('H3', 'Total Vueltas')
            ->setCellValue('I3', 'Sueldo Bruto')
            ->setCellValue('J3', 'Sueldo Adicional')
            ->setCellValue('K3', 'Nomina Fiscal')
            ->setCellValue('L3', 'Descuento Adeudo')
            ->setCellValue('M3', 'Bono Semanal')
            ->setCellValue('N3', 'Bono Categoria')
            ->setCellValue('O3', 'Bono supervisor')
            ->setCellValue('P3', 'Apoyo Mensual')
            ->setCellValue('Q3', 'Sueldo Total')
            ->setCellValue('R3', 'Dias Vacaciones')
            ->setCellValue('S3', 'Pago Vacaciones')
            ->setCellValue('T3', 'Prima Vacacional')
            ->setCellValue('U3', 'Deposito')
            ->setCellValue('V3', 'Efectivo')
            ->setCellValue('W3', 'Deduccion Fiscal')
            ->setCellValue('X3', 'Caja Ahorro')
            ->setCellValue('Y3', 'Supervisor')
            ->setCellValue('Z3', 'Neto');



// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:Z3')->applyFromArray($boldArray);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);

$anio = isset($_GET['anio']) ? intval($_GET['anio']) : date('Y');
$semana = isset($_GET['semana']) ? intval($_GET['semana']) : date('W');

// Buscar si existe una nomina para la semana y año actuales en historico_nomina
$sql_verificar_nomina = "SELECT 1 FROM historico_nomina WHERE semana = ? AND anio = ? LIMIT 1";
$stmt = $conection->prepare($sql_verificar_nomina);
$stmt->bind_param('ii', $semana, $anio);
$stmt->execute();
$resultado_verificacion = $stmt->get_result();

if (mysqli_num_rows($resultado_verificacion) > 0) {
    $stmt = mysqli_prepare($conection, "SELECT * FROM historico_nomina WHERE semana = ? AND anio = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $semana, $anio);

} else {
    $stmt = mysqli_prepare($conection, "SELECT * FROM nomina_temp_2025");
}

mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$result_detalle = mysqli_num_rows($resultado);
mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
while ($row=mysqli_fetch_assoc($resultado)) {
 $efectivo = ($row['sueldo_bruto'] - $row['nomina_fiscal']) + $row['bono_semanal'] + $row['bono_supervisor'] + $row['bono_categoria'] + $row['apoyo_mes'] + $row['pago_vacaciones'] + $row['prima_vacacional'] + $row['sueldo_adicional'] - $row['deducciones'] - $row['caja_ahorro'];
  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$fila, $row['semana'])
            ->setCellValue('B'.$fila, $anio)
            ->setCellValue('C'.$fila, $row['noempleado'])
            ->setCellValue('D'.$fila, $row['nombre'])
            ->setCellValue('E'.$fila, $row['cargo'])
            ->setCellValue('F'.$fila, $row['imss'])
            ->setCellValue('G'.$fila, $row['sueldo_base'])
            ->setCellValue('H'.$fila, $row['total_vueltas'])
            ->setCellValue('I'.$fila, $row['sueldo_bruto'])
            ->setCellValue('J'.$fila, $row['sueldo_adicional'])
            ->setCellValue('K'.$fila, $row['nomina_fiscal'])
            ->setCellValue('L'.$fila, $row['deducciones'])
            ->setCellValue('M'.$fila, $row['bono_semanal'])
            ->setCellValue('N'.$fila, $row['bono_categoria'])
            ->setCellValue('O'.$fila, $row['bono_supervisor'])
            ->setCellValue('P'.$fila, $row['apoyo_mes'])
            ->setCellValue('Q'.$fila, $row['sueldo_bruto'] + $row['bono_semanal'] + $row['bono_supervisor'] + $row['bono_categoria'] + $row['prima_vacacional'] + $row['pago_vacaciones'] + $row['sueldo_adicional'] + $row['apoyo_mes'])
            ->setCellValue('R'.$fila, $row['dias_vacaciones'])
            ->setCellValue('S'.$fila, $row['pago_vacaciones'])
            ->setCellValue('T'.$fila, $row['prima_vacacional'])
            ->setCellValue('U'.$fila, $row['deposito_fiscal'])
            ->setCellValue('V'.$fila, $efectivo)
            ->setCellValue('W'.$fila, $row['deduccion_fiscal'])
            ->setCellValue('X'.$fila, $row['caja_ahorro'])
            ->setCellValue('Y'.$fila, $row['supervisor'])
            ->setCellValue('Z'.$fila, $efectivo + $row['deposito_fiscal']);
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Fila de totales
$fila_total = $fila;
$ultima_fila_datos = $fila - 1;

//Columnas que se desea sumar
$columns_to_sum = array_merge(range('H', 'X'), ['Z']);
foreach ($columns_to_sum as $column) {
  $objPHPExcel->getActiveSheet()->setCellValue(
    $column . $fila_total,
    '=SUM(' . $column . '4:' . $column . $ultima_fila_datos . ')'
  );
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Nomina semanal');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Nomina Semanal.xlsx"');
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
