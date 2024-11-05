<?php
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

   
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

 // Crea un nuevo archivo Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados de la hoja
$sheet->setCellValue('A1', 'Columna 1');
$sheet->setCellValue('B1', 'Columna 2');
$sheet->setCellValue('C1', 'Columna 3');

   


$query_productos = mysqli_query($conection,"SELECT rv.id, rv.semana, rv.fecha, rv.cliente, rv.direccion, rv.destino, rv.costo_viaje, rv.hora_inicio, rv.hora_fin, rv.hora_llegadareal, rv.hora_finreal, rv.notas, rv.unidad, rv.unidad_ejecuta, rv.num_unidad, rv.numero_unidades, if(rv.estatus = 1,'Activo',if(rv.estatus = 2, 'Realizado', if(rv.estatus= 3,'Cancelado', if(rv.estatus = 4,'Iniciado',if(rv.estatus=5, 'Finalizado', ''))))) as Status, rv.valor_vuelta, rv.sueldo_vuelta, rv.ruta, rv.operador, if (rv.planeado = 1, 'Planeado', 'Registrado') as Tipoviaje, rv.tipo_viaje, us.nombre AS jefeo, CONCAT(sp.nombres, ' ', sp.apellido_paterno, ' ', sp.apellido_materno) as superv, em.noempleado, rv.personas FROM registro_viajes rv LEFT JOIN clientes ct ON rv.cliente=ct.nombre_corto LEFT JOIN usuario us ON ct.id_supervisor = us.idusuario LEFT JOIN supervisores sp ON rv.id_supervisor = sp.idacceso LEFT JOIN empleados em ON rv.operador = CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) WHERE rv.tipo_viaje != 'Especial' and rv.fecha BETWEEN '$Datef' and '$Datei' ORDER by rv.fecha, rv.id");
$result_detalle = mysqli_num_rows($query_productos);
mysqli_close($conection); 
  
// Iterar sobre los resultados de la consulta
if ($result->num_rows > 0) {
    $rowNumber = 2; // Fila donde empezarán los datos
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $row['id']);
        $sheet->setCellValue('B' . $rowNumber, $row['fecha']);
        $sheet->setCellValue('C' . $rowNumber, $row['cliente']);
        $rowNumber++;
    }
}

// Generar y descargar el archivo
$writer = new Xlsx($spreadsheet);
$filename = "reporte_" . date('Y-m-d_H-i-s') . ".xlsx";

// Enviar encabezados HTTP para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
$conn->close();
exit;


    ?>



