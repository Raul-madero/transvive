<?php

include('../fpdf/fpdf.php');
//require('../fpdf/WriteHTML.php');
//require('../fpdf/cells_bold.php');
header("Content-Type: text/html; charset=iso-8859-1 ");
class PDF extends FPDF
{
var $B;
var $I;
var $U;
var $HREF;



function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function Header()
{
//Variables para consulta
$nocotiz=$_REQUEST['id'];
//Consulta sql encabezado
include('../../conexion.php');
$query = mysqli_query($conection,"SELECT CONCAT(nombres, ' ',apellido_paterno, ' ', apellido_materno) as empleado, fecha_contrato, sexo, estado_civil, edad, rfc, curp, numeross, domicilio from empleados where CONCAT(nombres, ' ',apellido_paterno, ' ', apellido_materno) = '$nocotiz'");
$result = mysqli_num_rows($query);
$cotizacion = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $empleado       = $cotizacion['empleado'];
    $fecha_contrato = $cotizacion['fecha_contrato'];
    $sexo           = $cotizacion['sexo'];
    $estadocivil    = $cotizacion['estado_civil'];
    $edad           = $cotizacion['edad'];
    $rfc            = $cotizacion['rfc'];
    $curp           = $cotizacion['curp'];
    $nss            = $cotizacion['numeross'];
    $domicilio      = $cotizacion['domicilio'];
   
    $texto1='CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO';

   
   
    $subtitulo1=utf8_decode('Orgaizacion Auxiliar del Crédito');

    
    $newDate = date("d-m-Y", strtotime($fecha_contrato));

//Logo
//$this->Image("img/logo.png",12,11,40,19,"png",0,'C');
//Arial bold 15
$this->SetFont('Arial','B',12);
//Encabezado
$this->Cell(40,20,'',0,0,'r');
$this->SetTextcolor(6,22,54);
$this->Cell(120,10,'',0,0,'C');
$this->Ln(10);

}



function Footer()
{
    $nocotiz=$_REQUEST['id'];
    include('../../conexion.php');
    $query_footer = mysqli_query($conection,"SELECT CONCAT(nombres, ' ',apellido_paterno, ' ', apellido_materno) as empleado, fecha_contrato, sexo, estado_civil, edad, rfc, curp, numeross, domicilio from empleados where CONCAT(nombres, ' ',apellido_paterno, ' ', apellido_materno) = '$nocotiz'");
    $result_footer = mysqli_num_rows($query_footer);
    $footer = mysqli_fetch_assoc($query_footer);
//Variables para consulta
//$id_salidas = $_GET['id_item'];
//Consulta sql pie de pagina
//$query1 = mysql_query("SELECT * FROM salida_ingreso WHERE id_salida_ingreso = '$id_salidas'");
//Variables para pie de pagina
 //   $entrega = $encabezado['entrega'];
 //   $recibe = $encabezado['recibe'];
//Posición
$this->SetY(-20);
//Fuente
$this->SetFont('Arial','',8);
//Número de página
$this->Cell(90,5,'',0,0,'C');
$this->Cell(11,5,'',0,1,'C');
$this->Cell(180,5,''.$this->PageNo().'/{nb}',0,0,'R');

}
}
//Impresion 
include('../../conexion.php');
$nocotiz=$_REQUEST['id'];
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('portrait','letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 2 , 20);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,20);
$query = mysqli_query($conection,"SELECT CONCAT(em.apellido_paterno, ' ',em.apellido_materno, ' ', em.nombres) as empleado, em.fecha_contrato, em.sexo, em.estado_civil, em.edad, em.rfc, em.curp, em.numeross, em.domicilio, dc.fecha_inicial, dc.fecha_final, em.cargo, em.fecha_reingreso from empleados em left join detalle_contratos dc ON em.noempleado = dc.no_empleado where CONCAT(em.nombres, ' ',em.apellido_paterno, ' ', em.apellido_materno) = '$nocotiz' ORDER by dc.id DESC LIMIT 1");
$result = mysqli_num_rows($query);
$cotizacion = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
    
    $empleado       = $cotizacion['empleado'];
    $fecha_contrato = $cotizacion['fecha_contrato'];
    $sexo           = $cotizacion['sexo'];
    $estadocivil    = $cotizacion['estado_civil'];
    $edad           = $cotizacion['edad'];
    $rfc            = $cotizacion['rfc'];
    $curp           = $cotizacion['curp'];
    $nss            = $cotizacion['numeross'];
    $domicilio      = $cotizacion['domicilio'];
    $fechainicial   = $cotizacion['fecha_inicial'];
    $fechafinal     = $cotizacion['fecha_final'];
    $cargo          = $cotizacion['cargo'];
    $fecha_reingreso = $cotizacion['fecha_reingreso'];

    if($fecha_reingreso != '0000-00-00') {
        setlocale(LC_TIME, "spanish");
        $newDate2 = date("d-m-Y", strtotime($fecha_reingreso));
        $fechalet2 = $fecha_reingreso;
        $fechalet2 = str_replace("/", "-", $fecha_reingreso);         
        $newDate2 = date("d-m-Y", strtotime($fechalet2));
    //$mesDesc = strftime("%B de %Y", strtotime($newDate));                
        $mesDesc2 = strftime("%d de %B de %Y", strtotime($newDate2));
        $mesMen = strtoupper($mesDesc2);

        $newDate3 = date("d-m-Y", strtotime($fechafinal));
        $fechalet3 = $fechafinal;
        $fechalet3 = str_replace("/", "-", $fechafinal);         
        $newDate3 = date("d-m-Y", strtotime($fechalet3));
    //$mesDesc = strftime("%B de %Y", strtotime($newDate));                
        $mesDesc3 = strftime("%d de %B de %Y", strtotime($newDate3));
        $mesMay = strtoupper($mesDesc3);

        $fcha = date("Y-m-d");
        $newDate4 = date("d-m-Y", strtotime($fcha));
        $fechalet4 = $fcha;
        $fechalet4 = str_replace("/", "-", $fcha);         
        $newDate4 = date("d-m-Y", strtotime($fechalet4));
    //$mesDesc = strftime("%B de %Y", strtotime($newDate));                
        $mesDesc4 = strftime("%d de %B de %Y", strtotime($newDate4));
        $Diaactual = strtoupper($mesDesc4);
    }else {
        setlocale(LC_TIME, "spanish");
    $newDate2 = date("d-m-Y", strtotime($fecha_contrato));
    $fechalet2 = $fecha_contrato;
    $fechalet2 = str_replace("/", "-", $fecha_contrato);         
    $newDate2 = date("d-m-Y", strtotime($fechalet2));
//$mesDesc = strftime("%B de %Y", strtotime($newDate));                
    $mesDesc2 = strftime("%d de %B de %Y", strtotime($newDate2));
    $mesMen = strtoupper($mesDesc2);

    $newDate3 = date("d-m-Y", strtotime($fechafinal));
    $fechalet3 = $fechafinal;
    $fechalet3 = str_replace("/", "-", $fechafinal);         
    $newDate3 = date("d-m-Y", strtotime($fechalet3));
//$mesDesc = strftime("%B de %Y", strtotime($newDate));                
    $mesDesc3 = strftime("%d de %B de %Y", strtotime($newDate3));
    $mesMay = strtoupper($mesDesc3);

    $fcha = date("Y-m-d");
    $newDate4 = date("d-m-Y", strtotime($fcha));
    $fechalet4 = $fcha;
    $fechalet4 = str_replace("/", "-", $fcha);         
    $newDate4 = date("d-m-Y", strtotime($fechalet4));
//$mesDesc = strftime("%B de %Y", strtotime($newDate));                
    $mesDesc4 = strftime("%d de %B de %Y", strtotime($newDate4));
    $Diaactual = strtoupper($mesDesc4);
    }

    $textoinicial=utf8_decode('<br />
<div align="justify">QUE CELEBRAN POR UNA PARTE <b>TRANS VIVE S DE RL DE CV,</b> CON DOMICILIO EN: <b>CALLE HIDALGO 30 COLONIA LOS GAVILANES TLAJOMULCO DE ZUNIGA, JALISCO, C.P. 45645</b> Y POR LA OTRA <b>' .$empleado. '</b> DE NACIONALIDAD MEXICANA, CON DOMICILIO EN: <b>' .$domicilio. '</b> TODO AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLAUSULAS: </div>');
    $texto1 = utf8_decode('<b>I.- </b>Declara el RECEPTOR que el día <b>' .$mesMen. '</b> prestará sus servicios para LA EMPRESA, en su carácter de <b>'.$cargo.'.</b>');
    $texto2 = utf8_decode('<b>II.- </b>Declara LA EMPRESA que como parte de los elementos que le son suministrados al RECEPTOR para el desempeño de sus servicios; se incluyen informaciones sobre TODO la información personal de los colaboradores, sueldos y prestaciones, sistemas de calidad, procedimientos de trabajo, e información de todos los procesos para BRINDAR EL SERVICIO DE TRANSPORTE DE PERSONAL EMPRESARIAL Y EJECUTIVO y perfeccionar<b> TRANS VIVE S DE RL DE CV</b> Y SUS SERVICIOS, cuyos derechos de explotación le corresponden a LA EMPRESA, así como informaciones confidenciales de aplicación comercial, industrial y de desarrollo tecnológico en relación con los anteriores.');
    $texto3 = utf8_decode('<b>III.- </b>Declara LA EMPRESA que las informaciones sobre el Sistemas de Calidad, procedimientos de trabajo, e información de todos los procesos que se mencionan en la cláusula anterior, deben considerarse como confidenciales por representar un gran valor para LA EMPRESA ya que le permiten obtener o mantener una ventaja competitiva frente a terceros en su actividad industrial y comercial.');
    $texto4 = utf8_decode('<b>IV.- </b>Declaran ambas partes que celebran el presente instrumento como un medio suficiente para preservar la confidencialidad y la no explotación industrial o comercial por parte del RECEPTOR sin el consentimiento de LA EMPRESA, de todo aquello que, directa o indirectamente, involucre la utilización de informaciones sobre la información personal de los colaboradores, sueldos y prestaciones, sistemas de calidad, procedimientos de trabajo, e información de todos los procesos para BRINDAR EL SERVICIO DE TRANSPORTE DE PERSONAL EMPRESARIAL Y EJECUTIVO, así como informaciones confidenciales de aplicación comercial, industrial y de desarrollo tecnológico en relación con los anteriores, que LA EMPRESA le haya proporcionado o le venga proporcionando, de tiempo en tiempo, al RECEPTOR.<br>VISTAS las declaraciones que anteceden, ambas partes están de acuerdo con el contenido de las siguientes clausulas:');
    $texto5 = utf8_decode('<b>PRIMERA.-  </b>EL RECEPTOR reconoce y acepta que LA EMPRESA le ha venido proporcionando en el tiempo que ha prestado sus servicios para dicha empresa y le sigue proporcionando, periódicamente, informaciones sobre la información personal de los colaboradores, sueldos y prestaciones, sistemas de calidad, procedimientos de trabajo, e información de todos los procesos para BRINDAR EL SERVICIO DE TRANSPORTE DE PERSONAL EMPRESARIAL Y EJECUTIVO, cuyos derechos de explotación le corresponden a LA EMPRESA, así como informaciones confidenciales de aplicación comercial, industrial y de desarrollo tecnológico en relación con los anteriores, que le permiten a LA EMPRESA obtener o mantener una ventaja competitiva frente a terceros en su actividad industrial y comercial (en adelante la INFORMACIÓN CONFIDENCIAL)');
    $texto6 = utf8_decode('<b>SEGUNDA. - </b>EL RECEPTOR reconoce y acepta que la INFORMACIÓN CONFIDENCIAL, fue creada, desarrollada o adquirida por LA EMPRESA a quien le pertenecen todos los derechos o cuenta con las autorizaciones para su explotación industrial o comercial. Así mismo, el RECEPTOR reconoce y queda prevenido que la INFORMACIÓN CONFIDENCIAL, tienen el carácter de Secreto Industrial en los términos de los artículos del Título Tercero de la Ley de la Propiedad Industrial.');
    $texto7 = utf8_decode('<b>TERCERA. -  </b>EL RECEPTOR reconoce y acepta que la INFORMACIÓN CONFIDENCIAL, está relacionada con los rubros que, de manera enunciativa, más no limitativa, se mencionan a continuación:');
    $texto8 = utf8_decode('<b>CUARTA. - </b>EL RECEPTOR se obliga a no divulgar a terceros por cualquier medio, incluso de forma verbal, ni a darle aplicación o desarrollo por su cuenta a la INFORMACION CONFIDENCIAL, sin la previa autorización de LA EMPRESA que conste por escrito.');
    $texto9 = utf8_decode('<b>QUINTA.-  </b>EL RECEPTOR, se obliga a que bajo ninguna circunstancia, razón o motivo podrá copiar o reproducir por cualquier medio, los documentos, medios electrónicos o magnéticos, discos ópticos, microfilmes, Películas y otros medios similares que tengan relación directa o indirecta con la INFORMACIÓN CONFIDENCIAL.');
    $texto10 = utf8_decode('<b>SEXTA.- </b>EL RECEPTOR no podrá reproducir por escrito o por cualquier otro medio ni divulgar a terceros las informaciones verbales que haya recibido de LA EMPRESA por conducto de sus Directivos o Gerentes o Supervisores Jerárquicos cuando se le haya hecho notar que dichas informaciones verbales tienen el carácter de confidencial o reservado.');
    $texto11 = utf8_decode('<b>SEPTIMA. - </b>EL RECEPTOR se obliga a no realizar investigaciones o actos de ingeniería o diseño de reserva para desarrollar Envases, Tapas y Accesorios de Plástico o procedimientos similares o idénticos a los que utiliza LA EMPRESA dando aplicación a la INFORMACIÓN CONFIDENCIAL o de cualquier forma a darles a los mismos un uso aplicación o instrumentación distinta sin la previa autorización de LA EMPRESA');
    $texto12 = utf8_decode('<b>OCTAVA. -  </b>El presente acuerdo de voluntades estará vigente por tiempo indefinido durante e incluso después del tiempo en que el RECEPTOR preste sus servicios para LA EMPRESA y hasta en tanto la INFORMACIÓN CONFIDENCIAL no sea divulgada por LA EMPRESA al público en general.');
    $texto13 = utf8_decode('<b>NOVENA- </b>EL RECEPTOR está de acuerdo en que la violación a cualquiera de sus obligaciones contenidas en el presente contrato causa un grave daño y afectación a los derechos e intereses de LA EMPRESA Por lo tanto el RECEPTOR se obliga en caso de incumplimiento a cualquiera de sus obligaciones contenidas en el presente instrumento a pagar a LA EMPRESA a manera de pena convencional la cantidad de $ 500,000.00 PESOS MEXICANOS Y/O 250 SALARIOS MINIMOS ANUALES VIGENTES.');
    $texto14 = utf8_decode('<b>DECIMA. - </b>La nulidad o invalidez de alguna de las cláusulas en el presente contrato declarada por autoridad competente no hace suponer la nulidad o invalidez de las demás las cuales permanecerán en plena vigencia y surtiendo todos sus efectos al presentarse dicha eventualidad.');
    $texto15 = utf8_decode('<b>DECIMA PRIMERA. - </b>Las partes facultan para conocer de la interpretación o cumplimiento del presente contrato a los Tribunales de la Ciudad de Guadalajara, Jalisco. Renunciando al domicilio que por razón de su domicilio presente o futuro pudiera corresponderles.');
    $texto16 = utf8_decode('El presente instrumento se firma por las partes en la Ciudad de Tlajomulco de Zúñiga, Jalisco, el día <b>'. $mesMen . '.</b>');
    

$pdf->SetY(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(180,5,'CONTRATO DE CONFIDENCIALIDAD',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(7,5,'',0,1,'C');
$pdf->WriteHTML('<div text-align="justify">'.$textoinicial.'</div>');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'D E C L A R A C I O N E S',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Ln(10);
$pdf->WriteHTML($texto1);
$pdf->Ln(10);
$pdf->WriteHTML($texto2);
$pdf->Ln(10);
$pdf->WriteHTML($texto3);
$pdf->Ln(10);
$pdf->WriteHTML($texto4);
$pdf->Ln(15);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'C L A U S U L A S',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Ln(10);
$pdf->WriteHTML($texto5);
$pdf->Ln(10);


$pdf->SetFont('Arial','B',9);
$pdf->AddPage('portrait','letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 2 , 20);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,5);
$pdf->Ln(5);
$pdf->SetFont('Arial','',9);
$pdf->WriteHTML($texto6);
$pdf->Ln(8);
$pdf->WriteHTML($texto7);
$pdf->Ln(8);
$pdf->Cell(10,5,'',0,0,'L');
$pdf->Cell(170,5,'a) SERVICIOS',0,1,'L');
$pdf->Cell(10,5,'',0,0,'L');
$pdf->Cell(170,5,'b) CLIENTES',0,1,'L');
$pdf->Cell(10,5,'',0,0,'L');
$pdf->Cell(170,5,'c) PROVEEDORES',0,1,'L');
$pdf->Cell(10,5,'',0,0,'L');
$pdf->Cell(170,5,'d) COLABORADORES',0,1,'L');
$pdf->Cell(10,5,'',0,0,'L');
$pdf->Cell(170,5,utf8_decode('e) SITUACIÓN FINANCIERA'),0,1,'L');
$pdf->Cell(10,5,'',0,0,'L');
$pdf->Cell(170,5,'f) RUTAS',0,1,'L');
$pdf->Ln(10);
$pdf->WriteHTML($texto8);
$pdf->Ln(10);
$pdf->WriteHTML($texto9);
$pdf->Ln(10);
$pdf->WriteHTML($texto10);
$pdf->Ln(10);
$pdf->WriteHTML($texto11);
$pdf->Ln(10);
$pdf->WriteHTML($texto12);
$pdf->Ln(10);
$pdf->WriteHTML($texto13);
$pdf->Ln(10);
$pdf->WriteHTML($texto14);
$pdf->Ln(10);
$pdf->AddPage('portrait','letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 2 , 20);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,20);
$pdf->Ln(5);
$pdf->WriteHTML($texto15);
$pdf->Ln(10);
$pdf->WriteHTML($texto16);
$pdf->Ln(30);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(85,5,'______________________________________',0,0,'C');
$pdf->Cell(85,5,'______________________________________',0,1,'C');
$pdf->Cell(85,5,'ING. RAUL GUTIERREZ DE VELASCO ROMO',0,0,'C');
$pdf->Cell(85,5,$empleado,0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(85,5,'LA EMPRESA',0,0,'C');
$pdf->Cell(85,5,'EL RECEPTOR',0,1,'C');
$pdf->Ln(30);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(85,5,'______________________________________',0,0,'C');
$pdf->Cell(85,5,'______________________________________',0,1,'C');
$pdf->Cell(85,5,'LIC. RUTH ELIZABETH MIRAMONTES DORADO',0,0,'C');
$pdf->Cell(85,5,'LIC. BRENDA BERENICE ROMO CORDERO',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(85,5,'TESTIGO',0,0,'C');
$pdf->Cell(85,5,'TESTIGO',0,1,'C');
$pdf->Output('Contrato Confidencialidad.pdf', 'I');
?>