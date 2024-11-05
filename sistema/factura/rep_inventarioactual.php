<?php

if (isset($_POST['crear'])) {

include('../fpdf/fpdf.php');

header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
function Header()
{
//Variables para consulta
 $where="";
    $date_ini   = $_POST['inputDateini'];
    $date_fin   = $_POST['inputDateini'];;
    $prod_ini   = $_REQUEST['inputProdini'];
    $prod_fin   = $_REQUEST['inputProdfin'];
    $almacn_ini = $_POST['inputAlmacenini'];
    $almacn_fin = $_POST['inputAlmacenfin'];
   
//Consulta sql encabezado
include('../../conexion.php');
//require_once('barcode.php');
//Agregamos la libreria para genera códigos QR
//    require_once "factura/phpqrcode/qrlib.php";    
    
    //Declaramos una carpeta temporal para guardar la imagenes generadas
    $dir = 'temp/';
    
    //Si no existe la carpeta la creamos
    if (!file_exists($dir))
        mkdir($dir);
    
        //Declaramos la ruta y nombre del archivo a generar
    $filename = $dir.'test.png';
 
        //Parametros de Condiguración
    
    


//$query = mysqli_query($conection,"SELECT * FROM inv_rollostc WHERE diseno = '$disenoini'");
//$result = mysqli_num_rows($query);
//$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    //$nogasto     = $entrada['codbarras'];
    
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, "spanish");
    //$fechalet = $fechag;
    //$fechalet = str_replace("/", "-", $fechag);         
    //$newDate = date("d-m-Y", strtotime($fechalet));
    //$mesDesc = strftime("%B de %Y", strtotime($newDate));                
    //$mesDesc = strftime($direccbodega." a %A %d de %B de %Y", strtotime($newDate));
   
    $DateTime1 = date("d-m-Y");

    $hora = date('H:i:s');

    $tamaño = 10; //Tamaño de Pixel
    $level = 'L'; //Precisión Baja
    $framSize = 3; //Tamaño en blanco
    //$contenido = "http://codigosdeprogramacion.com"; //Texto
    
        //Enviamos los parametros a la Función para generar código QR 
    //QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 

    $subtitulo1=utf8_decode('FAB, IMPORT EXPORT DE HILOS TEXTILES');

   
   
//Logo
$this->Image("../../images/transvive_logo.png",14,13,28,24,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','B',12);
//Encabezado
$this->Cell(40,25,'',0,0,'r');
$this->SetTextcolor(6,22,54);
$this->Cell(170,25,'Comercializadora Qualy S.A. de C.V.',0,0,'C');
$this->SetFont('Arial','',8);
$this->Cell(70,5,''.$date_ini.' - '.$date_fin,0,1,'C');
$this->Cell(150,5,'',0,0,'C');
$this->Cell(40,5,utf8_decode(''),0,1,'C');
$this->Cell(150,5,'',0,0,'C');
$this->Cell(40,5,'',0,1,'C');
$this->Cell(40,5,'',0,0,'C');
$this->SetFont('Arial','',10);
$this->Cell(170,5,'Reporte Estatus de Tela Cruda',0,0,'C');

$this->Ln(18);


}



function Footer()
{
    
    //$mesDesc = strftime("%B de %Y", strtotime($newDate));                
    //$mesDesc = strftime($direccbodega." a %A %d de %B de %Y", strtotime($newDate));
  

//Variables para pie de pagina
 //   $entrega = $encabezado['entrega'];
 //   $recibe = $encabezado['recibe'];
//Posición
$this->SetY(-15);
//Fuente
$this->SetFont('Arial','',7);


$this->Cell(191,5,'TEXTIL-ERP Software para la Industria Textil',0,0,'R');

$this->Ln(5);

$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');

}
}
//Impresion 
include('../../conexion.php');
    $where="";
    $date_ini   = $_POST['inputDateini'];
    $date_fin   = $_POST['inputDateini'];;
    $prod_ini   = $_REQUEST['inputProdini'];
    $prod_fin   = $_REQUEST['inputProdfin'];
    $almacn_ini = $_POST['inputAlmacenini'];
    $almacn_fin = $_POST['inputAlmacenfin'];
$pdf=new PDF();
$pdf->AddPage('L','letter');
/*$query = mysqli_query($conection,"SELECT * FROM inv_rollostc WHERE diseno = '$disenoini'");
$result = mysqli_num_rows($query);
$entrada = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $nogasto     = $entrada['diseno'];
    $kilos       = $entrada['kilos'];
 */   
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, "spanish");
   
if(empty($date_ini) || empty($date_fin) )
  {    
    if(empty($prod_ini) || empty($prod_fin) )
      {
       if(empty($almacn_ini) || empty($almacn_fin) )
          {
            $where = "where 1";  
          }else {
             $where = "where ir.almacen >= '$almacn_ini' AND ir.almacen <= '$almacn_fin'";
          }     
      }else {
          if(empty($almacn_ini) || empty($almacn_fin ))
              {
                $where = "where ir.articulo >= '$prod_ini' AND ir.articulo <= '$prod_fin'";
              }else {
              $where = "where ir.articulo >= '$prod_ini' AND ir.articulo <= '$prod_fin' AND ir.almacen >= '$almacn_ini' AND ir.almacen <= '$almacn_fin' ";
              } 
         }     
   
    }else {
          if(empty($prod_ini) || (empty($prod_fin)) )
              {
                if(empty($almacn_ini) || (empty($almacn_fin)) )
                {
                   $where = "where ir.fecha_reg between '$date_ini' AND '$date_fin'"; 
                }else {
                   $where = "where ir.almacen >= '$almacn_ini' AND ir.almacen <= '$almacn_fin' AND ir.fecha_reg between '$date_ini' AND '$date_fin' ";
                }
              }else {
                if(empty($almacn_ini) || (empty($almacn_fin)) )
                {
                   $where = "where ir.articulo >= '$prod_ini' AND ir.articulo <= '$prod_fin' AND ir.fecha_reg between '$date_ini' AND '$date_fin'";
                   $where = "where ir.almacen >= '$almacn_ini' AND ir.almacen <= '$almacn_fin' AND ir.articulo >= '$prod_ini' AND ir.articulo <= '$prod_fin' AND ir.fecha_reg between '$date_ini' AND <= '$date_fin'";
                }else {
                }  
              } 

            }
       
      

//Encabezado de la tabla

$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(231,233,238);
$pdf->Cell(15,5,utf8_decode('DISEÑO'),1,0,'C','T');
$pdf->Cell(15,5,'CALIDAD',1,0,'C','T');
$pdf->Cell(20,5,'FEC/ENT',1,0,'C','T');
$pdf->Cell(15,5,'MAQUINA',1,0,'C','T');
$pdf->Cell(15,5,'ROLLO',1,0,'C','T');
$pdf->Cell(15,5,'AFINIDAD',1,0,'C','T');
$pdf->Cell(10,5,'KILOS',1,0,'C','T');
$pdf->Cell(5,5,'ST',1,0,'C','T');
$pdf->Cell(15,5,'NO.ENVIO',1,0,'C','T');
$pdf->Cell(20,5,'FEC/SAL',1,0,'C','T');
$pdf->Cell(20,5,'FEC/REC',1,0,'C','T');
$pdf->Cell(20,5,'REMISION',1,0,'C','T');
$pdf->Cell(25,5,'NO.ETIQUETA',1,0,'C','T');
$pdf->Cell(25,5,'ORDEN TRABAJO',1,0,'C','T');

$query_productos = mysqli_query($conection,"SELECT ir.articulo, ir.almacen, ir.unidad_med, ir.cantidad, ir.fecha_reg FROM tr_hist ir INNER JOIN refacciones rf ON ir.articulo = rf.codigo $where ORDER BY ir.correlativo ");
$result_detalle = mysqli_num_rows($query_productos);
$linea = 0;
$cantidadtot = 0;
/*
$sql = "SELECT ir.articulo, ir.almacen, ir.unidad_med, ir.cantidad, ir.fecha_reg ";
$sql .= "FROM tr_hist ir INNER JOIN refacciones rf ON ir.articulo = rf.codigo ";
$sql .= "$where ";
//$sql .= "AND PERFIL='$PERFIL'";
echo $sql;
*/            
//Establecer la información local en castellano de España
//setlocale(LC_TIME,"es_ES");
setlocale(LC_TIME, "spanish");
//$fechahoy= strftime("Mexico D.F. a %A %d de %B del %Y");

while ($row = mysqli_fetch_assoc($query_productos)){
//celdas de la tabla
    //$cantidadtot = $cantidadtot + $row['cantidad'];
  $linea=$linea + 1;
$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(231,233,238);
$pdf->Cell(15,5,$prod_ini,1,0,'C');
$pdf->Cell(15,5,$row['almacen'],1,0,'C');
$pdf->Cell(20,5,'',1,0,'L');
$pdf->Cell(15,5,$row['articulo'],1,0,'R');
$pdf->Cell(15,5,$row['almacen'],1,0,'R');
$pdf->Cell(15,5,$row['unidad_med'],1,0,'C');
$pdf->Cell(10,5,number_format($row['cantidad'],2),1,0,'R');
$pdf->Cell(5,5,'',1,0,'C');
$pdf->Cell(15,5,$where,1,0,'C');
$pdf->Cell(20,5,'',1,0,'L');
$pdf->Cell(20,5,'',1,0,'L');
$pdf->Cell(20,5,'',1,0,'L');
$pdf->Cell(25,5,$row['articulo'],1,0,'R');
$pdf->Cell(25,5,$row['almacen'],1,0,'R');

}
$pdf->Ln(5);
$pdf->Cell(185,5,$where,1,0,'l');

//$pdf->Cell(150,5,$razonsocial,0,0,'L');

//$pdf->Ln(5);

//ciclo de repeticion celdas
//Consulta para cuerpo tabla






//$pdf->Image($certificado.'.png',160,30,35,10,'PNG');
$pdf->Output();
}

if (isset($_POST['borrar'])) {
 header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Acumulado Ordenes de Trabajo.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
   
    include('../../conexion.php');
    $conection->set_charset('utf8');

    

    $where="";
    $disenoini   = $_POST['disenoini'];
    $disenofin   = $_POST['disenofin'];;
    $etiquetaini = $_REQUEST['etiquetaini'];
    $etiquetafin = $_REQUEST['etiquetafin'];
    $fechaini    = $_POST['fechaini'];
    $fechafin    = $_POST['fechafin'];
    $maquinaini  = $_POST['maquinaini'];
    $maquinafin  = $_POST['maquinafin'];
    $rolloini    = $_POST['rolloini'];
    $rollofin    = $_POST['rollofin'];
    $calidadini  = $_POST['calidadini'];
    $calidadfin  = $_POST['calidadfin'];
    $statusini   = $_POST['statusini'];
    $statusfin   = $_POST['statusfin'];

   

    if(empty($disenoini) || (empty($disenofin)) )
      {
        if(empty($etiquetaini) || (empty($etiquetafin)) )
        {
          if(empty($maquinaini) || (empty($maquinafin)) )
            {
              if(empty($rolloini) || (empty($rollofin)) ) 
              {
                if(empty($calidadini) || (empty($calidadfin)) )
                {
                  $where = "where 1";  
                }else {
                  $where = "where ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
                }     
              }else {
                 if(empty($calidadini) || (empty($calidadfin)) )
                 {
                   $where = "where ir.norollo >= $rolloini AND ir.norollo <= $rollofin";
                 }else {
                   $where = "where ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin ";
                 } 
              }
            }else {
              if(empty($rolloini) || (empty($rollofin)) )
              {
                if(empty($calidadini) || (empty($calidadfin)) )
                {
                   $where = "where ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin"; 
                }else {
                   $where = "where ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin ";
                }
              }else {
                if(empty($calidadini) || (empty($calidadfin)) )
                {
                   $where = "where ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin";
                }else {
                   $where = "where ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
                }  
              } 

            }
          
        }else {
          if(empty($maquinaini) || (empty($maquinafin)) )
          {
            if(empty($rolloini) || (empty($rollofin)) ) 
            {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin";
              }else {
                $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }
            }else {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin";
              }else {
                $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }
            }
          }else {
            if(empty($rolloini) || (empty($rollofin)) ) 
            {
               if(empty($calidadini) || (empty($calidadfin)) )
               {
                  $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin";
               }else {
                  $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
               } 
            }else {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin";
              }else {
                $where = "where ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetafin AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }

            }
          }

        } 
      }else {
        if(empty($etiquetaini) || (empty($etiquetafin)) )
        {
          if(empty($maquinaini) || (empty($maquinafin)) )
          {
            if(empty($rolloini) || (empty($rollofin)) ) 
            {
              if(empty($calidadini) || (empty($calidadfin)) )
               {
                 $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin'"; 
               }else {
                 $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin"; 
               } 
            }else {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                 $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin"; 
              }else {
                 $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }
            }
          }else {
            if(empty($rolloini) || (empty($rollofin)) ) 
            {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin";
              }else {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }
            }else{
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin";
              }else {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }
            }
          }
        }else {
          if(empty($maquinaini) || (empty($maquinafin)) )
          {
            if(empty($rolloini) || (empty($rollofin)) )
            {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetaini";
              }else{
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetaini AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin ";
              }
            }else {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetaini AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin ";
              }else {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.codbarras >= $etiquetaini AND ir.codbarras <= $etiquetaini AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }
            }
          }else {
            if(empty($rolloini) || (empty($rollofin)) )
            {
              if(empty($calidadini) || (empty($calidadfin)) )
              {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin ";
              }else {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin";
              }
            }else {
               if(empty($calidadini) || (empty($calidadfin)) )
               {
                $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin";
               }else {
                 $where = "where ir.diseno >= '$disenoini' AND ir.diseno <= '$disenofin' AND ir.maquina >= $maquinaini AND ir.maquina <= $maquinafin AND ir.norollo >= $rolloini AND ir.norollo <= $rollofin AND ir.calidad >= $calidadini AND ir.calidad <= $calidadfin"; 
               }
            }
          }
        }
      }



$query_productos = mysqli_query($conection,"SELECT ir.codbarras, ir.calidad, ir.diseno, ir.kilos, ir.norollo, ir.maquina, ir.afinidad, ir.envio, dt.noorden FROM inv_rollostc ir LEFT JOIN detalle_ordenprod_telafin dt ON ir.codbarras = dt.etiqueta $where ORDER BY ir.correlativo ");
      $result_detalle = mysqli_num_rows($query_productos);
       mysqli_close($conection); 
      $linea = 0;
      $cantidadtot = 0;

  }
?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<table border="1">
  <tr>
    <th>Diseño</th>
    <th>Calidad</th>
    <th>FEC/ENT</th>
    <th>Maquina</th>
    <th>Rollo</th>
    <th>Afinidad</th>
    <th>Kilos</th>
    <th>ST</th>
    <th>No.Envio</th>
    <th>FEC/SAL</th>
    <th>FEC/REC</th>
    <th>Remision</th>
    <th>No.Etiqueta</th>
    <th>Orden Trabajo</th>


  </tr>
  <?php
    while ($row=mysqli_fetch_assoc($query_productos)) {
      ?>
        <tr>
          <td><?php echo $row['diseno']; ?></td>
          <td><?php echo $row['calidad']; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo $row['maquina']; ?></td>
          <td><?php echo $row['norollo']; ?></td>
          <td><?php echo $row['afinidad']; ?></td>
          <td><?php echo $row['kilos']; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo $row['envio']; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo ''; ?></td>
          <td><?php echo $row['codbarras']; ?></td>
          <td><?php echo $row['noorden']; ?></td>
        
        </tr> 
     
      <?php
    }
?>

<?php
  

if (isset($_POST['cerrar'])) {
  echo'<script type="text/javascript">
  location.href = "./index.php.php";
</script>';
}

?>