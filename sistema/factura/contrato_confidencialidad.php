<?php

require('../fpdf/fpdf.php');
header("Content-Type: text/html; charset=utf-8");
include('../../conexion.php');

function formatearFecha($fecha) {
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $fecha = str_replace("/", "-", $fecha);
    return strtoupper(strftime("%d de %B de %Y", strtotime($fecha)));
}

class PDF extends FPDF {
    public $datosEmpleado;

    function WriteHTML($html) {
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                $this->MultiCell(0, 5, $e);
            } else {
                if ($e[0] == '/') $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr) {
        if ($tag == 'B' || $tag == 'I' || $tag == 'U') $this->SetStyle($tag, true);
        if ($tag == 'A') $this->HREF = $attr['HREF'];
        if ($tag == 'BR') $this->Ln(5);
    }

    function CloseTag($tag) {
        if ($tag == 'B' || $tag == 'I' || $tag == 'U') $this->SetStyle($tag, false);
        if ($tag == 'A') $this->HREF = '';
    }

    function SetStyle($tag, $enable) {
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach (['B', 'I', 'U'] as $s) {
            if ($this->$s > 0) $style .= $s;
        }
        $this->SetFont('', $style);
    }

    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'CONTRATO DE CONFIDENCIALIDAD', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
}

$nocotiz = mysqli_real_escape_string($conection, $_REQUEST['id']);
$query = mysqli_query($conection, "SELECT CONCAT(em.apellido_paterno, ' ',em.apellido_materno, ' ', em.nombres) AS empleado,
    em.fecha_contrato, em.sexo, em.estado_civil, em.edad, em.rfc, em.curp, em.numeross, em.domicilio,
    dc.fecha_inicial, dc.fecha_final, em.cargo
    FROM empleados em
    LEFT JOIN detalle_contratos dc ON em.noempleado = dc.no_empleado
    WHERE CONCAT(em.nombres, ' ',em.apellido_paterno, ' ', em.apellido_materno) = '$nocotiz'
    ORDER BY dc.id DESC LIMIT 1");

$cotizacion = mysqli_fetch_assoc($query);

$empleado = $cotizacion['empleado'];
$domicilio = $cotizacion['domicilio'];
$fecha_contrato = $cotizacion['fecha_contrato'];
$fechafinal = $cotizacion['fecha_final'];
$cargo = $cotizacion['cargo'];

$mesMen = formatearFecha($fecha_contrato);
$mesMay = formatearFecha($fechafinal);
$Diaactual = formatearFecha(date("Y-m-d"));

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(true, 20);

$textos = [
    "<div align=\"justify\">QUE CELEBRAN POR UNA PARTE <b>TRANS VIVE S DE RL DE CV,</b> CON DOMICILIO EN: <b>CALLE HIDALGO 30 COLONIA LOS GAVILANES TLAJOMULCO DE ZUNIGA, JALISCO, C.P. 45645</b> Y POR LA OTRA <b>$empleado</b> DE NACIONALIDAD MEXICANA, CON DOMICILIO EN: <b>$domicilio</b> TODO AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLAUSULAS: </div>",
    "<b>I.- </b>Declara el RECEPTOR que el día <b>$mesMen</b> prestará sus servicios para LA EMPRESA, en su carácter de <b>$cargo</b>.",
    "<b>II.- </b>Declara LA EMPRESA que...", // Resto de los textos resumido
    "<b>DECIMA PRIMERA. - </b>Las partes facultan para conocer de la interpretación...",
    "El presente instrumento se firma por las partes en la Ciudad de Tlajomulco de Zúñiga, Jalisco, el día <b>$mesMen</b>."
];

foreach ($textos as $texto) {
    $pdf->WriteHTML(utf8_decode($texto));
    $pdf->Ln(10);
}

$pdf->Ln(30);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(85, 5, '______________________________________', 0, 0, 'C');
$pdf->Cell(85, 5, '______________________________________', 0, 1, 'C');
$pdf->Cell(85, 5, 'ING. RAUL GUTIERREZ DE VELASCO ROMO', 0, 0, 'C');
$pdf->Cell(85, 5, $empleado, 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(85, 5, 'LA EMPRESA', 0, 0, 'C');
$pdf->Cell(85, 5, 'EL RECEPTOR', 0, 1, 'C');

$pdf->Ln(30);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(85, 5, '______________________________________', 0, 0, 'C');
$pdf->Cell(85, 5, '______________________________________', 0, 1, 'C');
$pdf->Cell(85, 5, 'LIC. RUTH ELIZABETH MIRAMONTES DORADO', 0, 0, 'C');
$pdf->Cell(85, 5, 'LIC. BRENDA BERENICE ROMO CORDERO', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(85, 5, 'TESTIGO', 0, 0, 'C');
$pdf->Cell(85, 5, 'TESTIGO', 0, 1, 'C');

$pdf->Output('Contrato_Confidencialidad_' . $empleado . '.pdf', 'I');
?>
