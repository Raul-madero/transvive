<?php

include('../fpdf/fpdf.php');
require '../includes/conversor.php';
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
$query = mysqli_query($conection,"SELECT CONCAT(em.nombres, ' ',em.apellido_paterno, ' ', em.apellido_materno) as empleado, em.fecha_contrato, em.sexo, em.estado_civil, em.edad, em.rfc, em.curp, em.numeross, em.domicilio, dc.fecha_inicial, dc.fecha_final, em.cargo, em.salarioxdia from empleados em left join detalle_contratos dc ON em.noempleado = dc.no_empleado where CONCAT(em.nombres, ' ',em.apellido_paterno, ' ', em.apellido_materno) = '$nocotiz' ORDER by dc.id DESC LIMIT 1");
$result = mysqli_num_rows($query);
$cotizacion = mysqli_fetch_assoc($query);
//$encabezado = mysql_fetch_array($query1, $conexion);
//Variables para encabezado
$meses = [
    '01' => 'enero',
    '02' => 'febrero',
    '03' => 'marzo',
    '04' => 'abril',
    '05' => 'mayo',
    '06' => 'junio',
    '07' => 'julio',
    '08' => 'agosto',
    '09' => 'septiembre',
    '10' => 'octubre',
    '11' => 'noviembre',
    '12' => 'diciembre',
];
    $empleado       = $cotizacion['empleado'];
    $fecha_contrato = $cotizacion['fecha_contrato'];
    $fecha = new DateTime($fecha_contrato);
    $dia = $fecha->format('d');
    $mes = $meses[$fecha->format('m')];
    $anio = $fecha->format('Y');
    
    $fecha_formateada = ("$dia de $mes de $anio");
    $fecha_mayusculas = mb_strtoupper($fecha_formateada, 'UTF-8');
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
    $salarioxdia    = $cotizacion['salarioxdia'];
    $salario_letra  =  numtoletras($salarioxdia);
    setlocale(LC_TIME, "spanish");
    $newDate2 = date("d-m-Y", strtotime($fechainicial));
    $fechalet2 = $fechainicial;
    $fechalet2 = str_replace("/", "-", $fechainicial);         
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

    $textoinicial=utf8_decode('<br />
<div align="justify">CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO POR 30 DIAS A PARTIR DEL. <b>' . $fecha_mayusculas . ' AL ' . $mesMay .', </b> EN TERMINOS DE LO NORMADO POR EL ARTICULO 35 DE LA LEY FEDERAL DEL TRABAJO, QUE CELEBRAN POR UNA PARTE LA EMPRESA DENOMINADA <b>TRANSVIVE, S DE RL DE CV</b> REPRESENTADA EN ESTE ACTO POR SU APODERADO, EL C. <b>RAUL GUTIERREZ DE VELASCO ROMO,</b> A QUIEN EN LO SUCESIVO Y PARA EFECTO DEL PRESENTE CONTRATO SE LE DENOMINARÁ "LA EMPRESA", Y POR LA OTRA, Y POR SU PROPIO DERECHO, EL (LA) C. <b>' .$empleado. '</b> EN LO SUCESIVO SE LE DENOMINARÁ COMO "EL TRABAJADOR", DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLAUSULAS.</div>');
    $texto1 = utf8_decode('<b>I.</b> Declara <b> "LA EMPRESA". </b>');
    $texto2 = utf8_decode('<b>a).- </b>Que es una sociedad debidamente constituida bajo la legislación mexicana vigente en el número de póliza 2,343 a cargo del Corredor Público número 2 de la Ciudad de Naucalpan, Estado de México el  Licenciado Roberto F. Ramírez Narezo, y que se encuentra debidamente registrada ante el Registro Público de Comercio.');
    $texto3 = utf8_decode('<b>b).- </b>Que cuenta con domicilio ubicado en <b>Calle. Hidalgo 30 Col. Los Gavilanes, Tlajomulco de Zúñiga, Jal.</b> Con registro federal de contribuyentes <b>TVI-190503-SA3</b>');
    $texto4 = utf8_decode('<b>c).- </b>Declara su representante que cuenta con la capacidad suficiente para contratarse y obligarse en los términos del presente instrumento, además  declara sus facultades no han sido revocadas y se encuentran vigentes, según lo dispone la escritura pública 40,781 pasada ante la fe del notario público numero102 de la Ciudad de Naucalpan, el Licenciado Horacio Aguilar Álvarez De Alba, y que se encuentra debidamente registrada ante el Registro Público del Comercio.');
    $texto5 = utf8_decode('<b>d).- OBJETO DE LA EMPRESA: </b>Contratación de personal técnico o profesional para la prestación de servicios administrativos, ejecutivos o de cualquier naturaleza para la industria, oficinas, domésticos o actividades comerciales y artísticas por cuenta propia o ajena.');
    $texto6 = utf8_decode('<b>e).- </b>Que desea contratar a una persona que cuente con los conocimientos, habilidad y experiencia necesarios para desempeñar el puesto de: <b>'. $cargo . ',</b> y a que se refiere la primera cláusula.');
    $texto7 = utf8_decode('<b>II.- </b>Declara <b>"EL TRABAJADOR".</b>');
    $texto8 = utf8_decode('<b>a)- </b>Ser de nacionalidad mexicana, sexo <b>'. $sexo .' ,</b> estado civil: <b>'. $estadocivil . '</b> de <b>'. $edad. ' </b>años, RFC: <b>'. $rfc. ', </b>CURP: <b>'. $curp . ',</b> número de Seguro social: <b>'. $nss. '</b> con domicilio en: <b>' .$domicilio . ' </b>y tener todos los conocimientos, habilidad y experiencia necesarios para prestar a "LA EMPRESA" los servicios mencionados en el párrafo.');
    $texto9 = utf8_decode('<b>b) </b>De la Declaración I anterior. <br><br>En consideración a las declaraciones que anteceden, las partes manifiestan que es su deseo celebrar el presente contrato el cual se celebra sin actuación de dolo, mala fe, engaño por ninguna de las partes por lo que se reconocen la personalidad con la que comparecen y están de acuerdo en obligarse en virtud de las siguientes:');
    $texto10 = utf8_decode('"EL TRABAJADOR" prestará personalmente a "LA EMPRESA", los servicios descritos en la Declaración I en el puesto cuyos servicios consistirán primordialmente en todas las actividades inherentes al referido cargo, mismos que le prestará a "LA EMPRESA" o EMPRESAS a las que se le asigne y a cualquier otro tercero que le ordene "LA EMPRESA" de manera enunciativa mas no limitativa.');
    $texto11 = utf8_decode('Lo anterior lo hará bajo la dirección y dependencia de la propia EMPRESA durante la relación de trabajo. Asimismo, dada la naturaleza de los servicios que presta "LA EMPRESA" a otras compañías, "EL TRABAJADOR" realizará todas y cada una de las actividades que le sean ordenadas para el cumplimiento de los compromisos que "LA EMPRESA" tenga o llegue a adquirir con tercero o terceros, reconociendo expresamente "EL TRABAJADOR" que dicha situación de ninguna manera lo vinculará laboralmente con las compañías a las cuales preste servicios "LA EMPRESA", ya que no estará sujeto a la subordinación de las mismas, ni recibirá remuneración alguna de ellas.');
    $texto12 = utf8_decode('Desde luego lo establecido anteriormente en esta cláusula es a propósito de las condiciones que imperan al momento de la celebración de este contrato, pero conscientes ambas partes de que pueden variar las políticas de comercialización, las tecnologías en las que "LA EMPRESA" se apoye para llevar acabo su objeto y en general cualquier adelanto científico, administrativo o de cualquier otra índole que implique aplicar nuevos sistemas de trabajo, se obliga "EL TRABAJADOR" a capacitarse para estar actualizado y adoptar los cambios antes referidos.');
    $texto13 = utf8_decode('El presente contrato de trabajo se celebra por el tiempo determinado empezando a surtir efectos a partir de esta fecha de firma del presente documento de acuerdo con el artículo 35 de la Ley Federal del Trabajo.');
    $texto14 = utf8_decode('"EL TRABAJADOR" se compromete a prestar sus servicios en las instalaciones de "LA EMPRESA" ubicadas en Calle. Hidalgo 30  Col. Los Gavilanes , Tlajomulco de Zúñiga, Jalisco, por requerirlo así la actividad de "LA EMPRESA" dada la naturaleza de esta o en cualquier otro domicilio que se le asigne, sin que con esto se tenga como modificadas las condiciones de trabajo del presente contrato.');
    $texto15 = utf8_decode('"LA EMPRESA" celebra el presente contrato fundada en la declaración II inciso a) de "EL TRABAJADOR" en el sentido de que tiene los conocimientos, la habilidad y la experiencia necesarios para desempeñar adecuadamente las actividades inherentes al cargo para el que se le contrata; En tal virtud de lo anterior, si "LA EMPRESA" determina dentro de un plazo de 30 (treinta) días contados a partir de la fecha de firma de este contrato, que "EL TRABAJADOR" carece de los conocimientos, la habilidad o la experiencia que afirma tener, se rescindirá la relación de trabajo de inmediato, sin responsabilidad para "LA EMPRESA", lo anterior con fundamento a lo estipulado en el artículo 46 y 47 de la multicitada ley.');
    $texto16 = utf8_decode('"LA EMPRESA le cubrirá "EL TRABAJADOR", por todos los servicios que proporcionará de conformidad con este contrato, un salario DIARIO de <b>'. $salarioxdia. ' ('. $salario_letra. ' )</b> BRUTOS. El acumulado de dicho salario diario se conviene a pagarse los lunes de cada semana, e incluirá el pago de los días de descanso, semanales y obligatorios, así como el séptimo día. El salario convenido se cubrirá proporcionalmente por los días efectivamente laborados, Asimismo desde este momento "EL TRABAJADOR" acepta que le sea depositado su salario mediante transferencia electrónica a una cuenta bancaria a su nombre, ello de conformidad con el artículo 101 párrafo 2° de la Ley Federal del Trabajo.');
    $texto17 = utf8_decode('La duración de la jornada semanal de trabajo será de 48 horas, teniendo 01 días de descanso obligatorio por cada 06 seis días laborables, durante la misma "EL TRABAJADOR" interrumpirá su jornada diaria de trabajo durante el plazo de una hora para tomar alimentos fuera de las instalaciones del centro de trabajo, hora que será acorde al turno laboral que le corresponda.<br><br>Dada la naturaleza de las labores que desarrollará "EL TRABAJADOR", éste se compromete a poner especial atención a los controles de asistencia, así como de entradas y salidas a efecto de que queden debidamente asentados dichos registros. En tal virtud, "EL TRABAJADOR" no laborará tiempo extraordinario, ni en días de descanso semanal u obligatorio, si no es mediante orden que le dé "LA EMPRESA", por escrito, a través de su jefe inmediato superior.');
     $texto18 = utf8_decode('Las partes convienen en que el día de descanso semanal será el domingo de cada semana, sin perjuicio de que "LA EMPRESA" modifique dichos días de descanso semanal cuando las necesidades del servicio así lo requieran, cubriendo desde luego la correspondiente prima dominical.');
     $texto19 = utf8_decode('"LA EMPRESA" le pagará a "EL TRABAJADOR" un aguinaldo de acuerdo con las políticas establecidas en "LA EMPRESA" y a falta de estas en términos de lo dispuesto por el Artículo 87 de la Ley Federal del Trabajo.');
     $texto20 = utf8_decode('"EL TRABAJADOR" disfrutará anualmente de los días de vacaciones que señala el Art. 76 de la Ley Federal del Trabajo, en la fecha en que se determine de común acuerdo con "LA EMPRESA", en atención a las necesidades del servicio de ésta, en los términos y condiciones que establece la Ley Federal del Trabajo, así como la correspondiente prima vacacional del 25% (VEINTICINCO POR CIENTO) de los salarios correspondientes a vacaciones.');
     $texto21 = utf8_decode('Serán días de descanso obligatorio los que señala el Art. 74 de la Ley Federal del Trabajo.');
     $texto22 = utf8_decode('"EL TRABAJADOR", durante su relación de trabajo, no prestará servicios ni fungirá como accionista, socio o inversionista de otra u otras personas, sean estas físicas o morales, que realicen actividades iguales o similares a "LA EMPRESA" contratante, así como las que realiza "LA EMPRESA" o EMPRESAS a las que haya sido asignado "EL TRABAJADOR" a desempeñar las actividades a que se refiere este contrato o que impliquen competencia para "LA EMPRESA", en cualquier sentido.');
     $texto23 = utf8_decode('Queda prohibido a "EL TRABAJADOR" disponer para su beneficio particular todos los utensilios, equipo, herramientas, muebles o enseres que utilice en la relación de trabajo con el patrón, ya que únicamente podrá disponer de las mismas para la prestación del servicio contratado.');
     $texto24 = utf8_decode('"EL TRABAJADOR" manifiesta saber y reconoce que su trabajo implica acceso, conocimiento y manejo de información y antecedentes estratégicos de "LA EMPRESA", así como de sociedades e instituciones con las que aquella está Asociado o mantiene contratos comerciales y/o realice negocios conjuntos, teniendo estos la calidad de confidenciales respecto a su utilización.  Por lo expuesto "EL TRABAJADOR" se obliga explícitamente por este acto a abstenerse absolutamente de hacer uso de la información y antecedentes estratégicos aludidos en otras finalidades que no sean aquellas propias. La obligación de confidencialidad, seguridad y secreto implica para "EL TRABAJADOR", sin que la presente enumeración sea limitativa:<br><br><b>   1)  </b>No divulgar, directa ni indirectamente, o a través de terceros, por ningún medio (óptico, magnético, papel, red de computadores o cualquier otro), información estratégica ni personal de ninguna persona que haya dado información persona ya sea nombre, identificaciones, domicilio, numero telefónicos, ocupación, números de cuentas bancarias, correos electrónicos, etc. En caso de duda sobre el carácter de confidencialidad de la información, "EL TRABAJADOR" tendrá la obligación previa de consultar a su respectiva superior jerárquica.<br><br><b>   2)  </b>No participar, por si o por terceros, en la violación de aquellos derechos de propiedad intelectual a los cuales acceda y utilice debido al desempeño de su trabajo.<br><br><b>   3) </b> Abstenerse de sustraer y/o incurrir en usos no autorizados de software o información de usuarios y de terceros que tengan relación comercial y/o de colaboración con "LA EMPRESA".');
     $texto25 = utf8_decode('"EL TRABAJADOR" reconoce que son propiedad exclusiva de "LA EMPRESA" o del tercero o terceros a los que "LA EMPRESA" le presta servicios, todos los documentos e información que se le proporcionen con motivo de la relación de trabajo, así como los que el propio "TRABAJADOR" prepare o formule en relación o conexión con sus servicios, por lo que se obliga a conservarlos en buen estado y a entregarlos a "LA EMPRESA" o a los terceros a los que ésta le presta servicios en el momento en que lo requieran o bien al terminar la relación laboral, por el motivo que fuere.<br><br>Para tal efecto, expresamente acepta "EL TRABAJADOR" que pertenecen a "LA EMPRESA" o al tercero o terceros a los que "LA EMPRESA" presta servicios, en todo tiempo, los datos proyectos, estudios manuales, plantaciones, publicaciones, dibujos, diseños, sistemas y programas de computadora y en general, todos los documentos e información escrita, verbal o electrónica a que tenga acceso, que se le proporciones en virtud de su cargo o que él mismo elabore.');
     $texto26 = utf8_decode('Conforme a lo dispuesto por la fracción X del Artículo 134 de la Ley Federal del Trabajo, "EL TRABAJADOR" se someterá a los exámenes médicos que ordene "LA EMPRESA", en la inteligencia de que el facultativo que los practique será designado y retribuido por la misma.');
     $texto27 = utf8_decode('Para todo lo dispuesto con riesgos de trabajo y enfermedades o accidentes no profesionales se estará a lo dispuesto por la Ley del Seguro Social y sus Reglamentos, para lo cual "LA EMPRESA" inscribirá oportunamente a "EL TRABAJADOR" ante el Instituto Mexicano del Seguro Social, cubriendo cada una de las partes las cuotas que le corresponden de conformidad a la citad ley.<br>Por lo anterior se acuerda por las partes que las faltas de asistencia al trabajo debidas a riesgos profesionales y no profesionales solamente podrán ser justificadas por "EL TRABAJADOR" con las constancias de incapacidad que legalmente expide el instituto Mexicano del Seguro Social y no serán aceptadas, ni servirán para justificar ninguna falta de asistencia, constancias expedidas por otra institución de salud o médicos.');
     $texto28 = utf8_decode('El trabajador se obliga a dar aviso de inmediato a "LA EMPRESA" de las causas por las cuales falta a su trabajo, y deberá dentro de las veinticuatro horas de su expedición entregar a "LA EMPRESA" las constancias de incapacidad del Instituto Mexicano del Seguro Social para que el mismo tenga conocimiento de las causas y tiempo que estará ausente "EL TRABAJADOR" y pueda hacer los ajustes que el caso requiera.');
     $texto29 = utf8_decode('"LA EMPRESA" proporcionara capacitación y adiestramiento a "EL TRABAJADOR", conforme a los planes y programas establecidos, así como los que se establezcan de acuerdo con las disposiciones de la Ley Federal del Trabajo.');
     $texto30 = utf8_decode('Sin perjuicio de cualquier disposición legal, este contrato se rescindirá o terminará sin responsabilidad para "LA EMPRESA"<br><br><b>  a)   </b>Por incurrir "EL TRABAJADOR" en algún hecho sancionado señaladas por los artículos 47, 134, y 135 de la Ley Federal del Trabajo.<br><b>  b)   </b>Por las causas que señalan los artículos 53 y 434 de la Ley Federal del Trabajo.');
     $texto31 = utf8_decode('Queda estrictamente prohibido  el entablar una relación de carácter afectivo, amoroso o de cualquier otra índole que no sea meramente laboral y relacionado a las áreas donde se desempeña "EL TRABAJADOR", bien sea entre el personal de "LA EMPRESA" o con el personal de los clientes a los cuales "LA EMPRESA" les presta servicios, en el entendido de que el violentar esta disposición será causal de despido y por tanto de terminación de la relación laboral como lo establece el artículo 47 fracción VIII de la Ley Federal del Trabajo.');
     $texto32 = utf8_decode('Ambas partes convienen que, en lo no previsto por el presente contrato, se sujetaran a lo establecido por la Ley Federal del Trabajo, la Ley del Seguro Social y sus reglamentos.');
     $texto33 = utf8_decode('Leído íntegramente el presente contrato y con conocimiento de su valor y fuerza legal, "EL TRABAJADOR" y el representante de "LA EMPRESA" la firman y ratifican de conformidad en la Ciudad de Tlajomulco de Zúñiga, Jalisco a '. $Diaactual. '.');

$pdf->SetY(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(180,5,'CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(7,5,'',0,1,'C');
$pdf->WriteHTML('<div text-align="justify">'.$textoinicial.'</div>');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECLARACIONES',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Ln(10);
$pdf->WriteHTML($texto1);
$pdf->Ln(10);
$pdf->WriteHTML($texto2);
$pdf->Ln(10);
$pdf->WriteHTML($texto3);
$pdf->Ln(10);
$pdf->WriteHTML($texto4);
$pdf->Ln(10);
$pdf->WriteHTML($texto5);
$pdf->Ln(10);
$pdf->WriteHTML($texto6);
$pdf->Ln(10);
$pdf->WriteHTML($texto7);
$pdf->Ln(10);
$pdf->WriteHTML($texto8);
$pdf->Ln(10);
$pdf->WriteHTML($texto9);

$pdf->SetFont('Arial','B',9);
$pdf->AddPage('portrait','letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 2 , 20);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,5);
$pdf->Cell(180,5,'CLAUSULAS',0,1,'C');
$pdf->Ln(10);
$pdf->Cell(180,5,'PRIMERA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->WriteHTML($texto10);
$pdf->Ln(8);
$pdf->WriteHTML($texto11);
$pdf->Ln(8);
$pdf->WriteHTML($texto12);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'SEGUNDA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->WriteHTML($texto13);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'TERCERA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->WriteHTML($texto14);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'CUARTA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->WriteHTML($texto15);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'QUINTA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->WriteHTML($texto16);
$pdf->Ln(10);
$pdf->AddPage('portrait','letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 2 , 20);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,20);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'SEXTA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto17);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'SEPTIMA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto18);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'OCTAVA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto19);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'NOVENA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto20);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto21);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA PRIMERA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto22);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA SEGUNDA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto23);
$pdf->Ln(10);
$pdf->AddPage('portrait','letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 2 , 20);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,20);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA TERCERA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto24);
$pdf->Ln(10);
$pdf->WriteHTML($texto25);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA CUARTA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto26);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA QUINTA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto27);
$pdf->Ln(10);
$pdf->AddPage('portrait','letter');
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(20, 2 , 20);

#Establecemos el margen inferior:
$pdf->SetAutoPageBreak(true,20);

$pdf->Ln(4);
$pdf->WriteHTML($texto28);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA SEXTA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto29);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA SEPTIMA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto30);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA OCTAVA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto31);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'DECIMA NOVENA.-',0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln(4);
$pdf->WriteHTML($texto32);
$pdf->Ln(10);
$pdf->SetFont('Arial','',9);
$pdf->Ln(10);
$pdf->WriteHTML($texto33);
$pdf->Ln(30);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(85,5,'E M P R E S A',0,0,'C');
$pdf->Cell(85,5,'E M P L E A D O',0,1,'C');
$pdf->Ln(10);
$pdf->Cell(85,5,'____________________________________',0,0,'C');
$pdf->Cell(85,5,'____________________________________',0,1,'C');
$pdf->Cell(85,5,'RAUL GUTIERREZ DE VELASCO ROMO',0,0,'C');
$pdf->Cell(85,5,$empleado,0,1,'C');
$pdf->Output('Contrato Eventual.pdf', 'I');
?>