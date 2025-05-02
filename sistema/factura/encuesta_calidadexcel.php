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
require_once dirname(__FILE__) . '/phpexcel/Classes/PHPExcel.php';
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
             ->getStyle('A3:AB3')
             ->getFill()
             ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
             ->getStartColor()
             ->setRGB('A0BFFC'); //i.e,colorcode=D3D3D3 


$objPHPExcel->getActiveSheet()->getStyle('A3:AB300')
    ->getAlignment()->setWrapText(true);                      

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:AB1');
// Add some data


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Encuesta de Satisfacción de Clientes')
            ->setCellValue('A3', 'Fecha')
            ->setCellValue('B3', 'Mes')
            ->setCellValue('C3', 'Año')
            ->setCellValue('D3', 'Cliente')
            ->setCellValue('E3', 'Nombre / Area')
            ->setCellValue('F3', 'Medio')
            ->setCellValue('G3', 'Tiempo Forma')
            ->setCellValue('H3', 'Teimpo Respuesta')
            ->setCellValue('I3', 'Disponibilidad')
            ->setCellValue('J3', 'Calidad')
            ->setCellValue('K3', 'Asesoría Técnica')
            ->setCellValue('L3', 'Limpieza, Condición')
            ->setCellValue('M3', 'Servicio Operador')
            ->setCellValue('N3', 'Conduce Adecuado')
            ->setCellValue('O3', 'Atención Calidad')
            ->setCellValue('P3', 'Servicio Facturación')
            ->setCellValue('Q3', 'Nuetros Precios')
            ->setCellValue('R3', 'Servicio de Ventas')
            ->setCellValue('S3', 'Servicio de Supervisor')
            ->setCellValue('T3', 'Servicio de Jefe')
            ->setCellValue('U3', 'Servicio de Quejas')
            ->setCellValue('V3', 'Cobranza (Info clara)')
            ->setCellValue('W3', 'Observaciones Cobranza')
            ->setCellValue('X3', 'Seguimiento a Quejas')
            ->setCellValue('Y3', '¿Obtener Calidad en el Servicio?')
            ->setCellValue('Z3', 'Recibir información')
            ->setCellValue('AA3', 'Días recibe info')
            ->setCellValue('AB3', 'Sugerencias y/o Comentarios');


// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
 
$objPHPExcel->getActiveSheet()->getStyle('A1:AB3')->applyFromArray($boldArray);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(80);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(80);


$query_productos = mysqli_query($conection,"SELECT id, fecha, cliente, nombre_area, medio, tiempo_forma, tiempo_respuesta, disponibilidad, calidad, asesoria_tecnica, limpieza_condicion, servicio_operador, conduce_adecuado, atencion_calidad, servicio_facturacion, nuestros_precios, servicio_ventas, servicio_supervisor, servicio_jefe, servicio_quejas, info_cobranza, notas_cobranza, llama_seguimiento, significa_calidad, recibir_info, CONCAT(rec_lunes, ' ', rec_martes, ' ', rec_miercoles, ' ', rec_jueves, ' ', rec_viernes, ' ', rec_sabado) as recdias, comentarios  FROM newencuesta_clientes");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection);             

// Miscellaneous glyphs, UTF-8
$fila = 4;
$total = 0;
 while ($row=mysqli_fetch_assoc($query_productos)) {
  $newDate  = date("d-m-Y", strtotime($row['fecha']));
  //$newDate2 = date("d-m-Y", strtotime($row['fecha_inicial']));
  //$newDate3 = date("d-m-Y", strtotime($row['fecha_termino']));
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
            ->setCellValue('A'.$fila, $newDate)
            ->setCellValue('B'.$fila, $monthNameSpanish)
            ->setCellValue('C'.$fila, $anio)
            ->setCellValue('D'.$fila, $row['cliente'])
            ->setCellValue('E'.$fila, $row['nombre_area'])
            ->setCellValue('F'.$fila, $row['medio'])
            ->setCellValue('G'.$fila, $row['tiempo_forma'])
            ->setCellValue('H'.$fila, $row['tiempo_respuesta'])
            ->setCellValue('I'.$fila, $row['disponibilidad'])
            ->setCellValue('J'.$fila, $row['calidad'])
            ->setCellValue('K'.$fila, $row['asesoria_tecnica'])
            ->setCellValue('L'.$fila, $row['limpieza_condicion'])
            ->setCellValue('M'.$fila, $row['servicio_operador'])
            ->setCellValue('N'.$fila, $row['conduce_adecuado'])
            ->setCellValue('O'.$fila, $row['atencion_calidad'])
            ->setCellValue('P'.$fila, $row['servicio_facturacion'])
            ->setCellValue('Q'.$fila, $row['nuestros_precios'])
            ->setCellValue('R'.$fila, $row['servicio_ventas'])
            ->setCellValue('S'.$fila, $row['servicio_supervisor'])
            ->setCellValue('T'.$fila, $row['servicio_jefe'])
            ->setCellValue('U'.$fila, $row['servicio_quejas'])
            ->setCellValue('V'.$fila, $row['info_cobranza'])
            ->setCellValue('W'.$fila, $row['notas_cobranza'])
            ->setCellValue('X'.$fila, $row['llama_seguimiento'])
            ->setCellValue('Y'.$fila, $row['significa_calidad'])
            ->setCellValue('Z'.$fila, $row['recibir_info'])
            ->setCellValue('AA'.$fila, $row['recdias'])
            ->setCellValue('AB'.$fila, $row['comentarios']);
  //formato de numeros
  //$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);          
$fila++;   

}
// imprimir el total
//$objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('F'.$fila, $total);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Encueta de Calidad');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Encuesta de Calidad.xlsx"');
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
