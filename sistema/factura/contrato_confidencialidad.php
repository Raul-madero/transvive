<?php
include('../fpdf/fpdf.php');
header("Content-Type: text/html; charset=iso-8859-1");

// Conexión segura
include('../../conexion.php');

// Obtener datos del empleado
$idEmpleado = $_REQUEST['id'];
$stmt = $conection->prepare("
    SELECT 
        CONCAT(em.apellido_paterno, ' ', em.apellido_materno, ' ', em.nombres) AS empleado,
        em.fecha_contrato, em.sexo, em.estado_civil, em.edad,
        em.rfc, em.curp, em.numeross, em.domicilio,
        em.cargo, em.fecha_reingreso,
        dc.fecha_inicial, dc.fecha_final
    FROM empleados em
    LEFT JOIN detalle_contratos dc ON em.noempleado = dc.no_empleado
    WHERE CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) = ?
    ORDER BY dc.id DESC LIMIT 1
");
$stmt->bind_param("s", $idEmpleado);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Empleado no encontrado.");
}

// Normalizar fechas
function formatear_fecha($fecha) {
    setlocale(LC_TIME, "es_ES.UTF-8");
    return strtoupper(strftime("%d de %B de %Y", strtotime(str_replace("/", "-", $fecha))));
}

$empleado       = $data['empleado'];
$domicilio      = $data['domicilio'];
$cargo          = $data['cargo'];
$fecha_contrato = ($data['fecha_reingreso'] && $data['fecha_reingreso'] > '1900-01-01') 
                    ? $data['fecha_reingreso'] 
                    : $data['fecha_contrato'];
$mesMen         = formatear_fecha($fecha_contrato);
$mesMay         = formatear_fecha($data['fecha_final']);
$Diaactual      = formatear_fecha(date("Y-m-d"));

// Plantilla de texto
function generar_textos($empleado, $domicilio, $cargo, $mesMen) {
    return [
        utf8_decode("QUE CELEBRAN POR UNA PARTE <b>TRANS VIVE S DE RL DE CV</b>, CON DOMICILIO EN: <b>CALLE HIDALGO 30 COLONIA LOS GAVILANES TLAJOMULCO DE ZUÑIGA, JALISCO, C.P. 45645</b>, Y POR LA OTRA <b>$empleado</b> DE NACIONALIDAD MEXICANA, CON DOMICILIO EN: <b>$domicilio</b>, TODO AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:"),
        utf8_decode("<b>I.-</b> Declara el RECEPTOR que el día <b>$mesMen</b> prestará sus servicios para LA EMPRESA, en su carácter de <b>$cargo</b>."),
        utf8_decode("<b>II.-</b> Declara LA EMPRESA que proporciona al RECEPTOR información sobre datos personales, sueldos, sistemas de calidad, procedimientos y procesos de transporte, cuya explotación corresponde exclusivamente a LA EMPRESA."),
        utf8_decode("<b>III.-</b> Declara LA EMPRESA que dicha información representa un valor competitivo y debe considerarse confidencial."),
        utf8_decode("<b>IV.-</b> Ambas partes acuerdan que este documento es suficiente para proteger la confidencialidad y limitar la explotación no autorizada por parte del RECEPTOR de dicha información."),
        utf8_decode("<b>PRIMERA.-</b> EL RECEPTOR reconoce que ha recibido y continuará recibiendo información confidencial de LA EMPRESA, incluyendo datos personales, sistemas, procedimientos y procesos clave."),
        utf8_decode("<b>SEGUNDA.-</b> EL RECEPTOR reconoce que la información confidencial pertenece a LA EMPRESA y tiene carácter de Secreto Industrial conforme a la Ley de Propiedad Industrial."),
        utf8_decode("<b>TERCERA.-</b> La información incluye, sin limitarse a:"),
        utf8_decode("<b>CUARTA.-</b> EL RECEPTOR se compromete a no divulgar ni aplicar por su cuenta dicha información sin autorización escrita de LA EMPRESA."),
        utf8_decode("<b>QUINTA.-</b> EL RECEPTOR no podrá copiar o reproducir documentos o medios relacionados con la información confidencial por ningún motivo."),
        utf8_decode("<b>SEXTA.-</b> Tampoco podrá divulgar verbalmente la información recibida de directivos o supervisores cuando ésta haya sido clasificada como confidencial."),
        utf8_decode("<b>SÉPTIMA.-</b> EL RECEPTOR no realizará ingeniería inversa ni desarrollará productos similares con base en la información proporcionada."),
        utf8_decode("<b>OCTAVA.-</b> Este acuerdo estará vigente indefinidamente, incluso después de terminada la relación laboral, salvo que la información se haga pública por LA EMPRESA."),
        utf8_decode("<b>NOVENA.-</b> Cualquier incumplimiento implicará una pena convencional de $500,000.00 M.N. y/o 250 salarios mínimos anuales vigentes."),
        utf8_decode("<b>DÉCIMA.-</b> La nulidad de alguna cláusula no invalida las demás disposiciones del contrato."),
        utf8_decode("<b>DÉCIMA PRIMERA.-</b> Las partes acuerdan someterse a la jurisdicción de los Tribunales de Guadalajara, Jalisco, renunciando a cualquier otro fuero."),
        utf8_decode("Este contrato se firma en Tlajomulco de Zúñiga, Jalisco, el día <b>$mesMen</b>.")
    ];
}


// Clase personalizada
class PDF extends FPDF {
    function WriteHTML($html) {
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                $this->Write(5, $e);
            } else {
                if ($e[0] == '/') $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = [];
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
        if (in_array($tag, ['B', 'I', 'U'])) $this->SetStyle($tag, true);
        if ($tag == 'BR') $this->Ln(5);
    }

    function CloseTag($tag) {
        if (in_array($tag, ['B', 'I', 'U'])) $this->SetStyle($tag, false);
    }

    function SetStyle($tag, $enable) {
        $this->$tag = ($this->$tag ?? 0) + ($enable ? 1 : -1);
        $style = '';
        foreach (['B', 'I', 'U'] as $s)
            if ($this->$s > 0) $style .= $s;
        $this->SetFont('', $style);
    }

    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(6, 22, 54);
        $this->Cell(40, 20, '', 0, 0, 'R');
        $this->Cell(120, 10, '', 0, 0, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-20);
        $this->SetFont('Arial', '', 8);
        $this->Cell(180, 5, $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Letter');
$pdf->SetMargins(20, 2, 20);
$pdf->SetAutoPageBreak(true, 20);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180, 5, 'CONTRATO DE CONFIDENCIALIDAD', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(5);

foreach (generar_textos($empleado, $domicilio, $cargo, $mesMen) as $texto) {
    $pdf->WriteHTML("<div align='justify'>$texto</div>");
    $pdf->Ln(10);
    if ($i === 7) { // después del texto 7 (índice 7)
        $viñetas = ['a) SERVICIOS', 'b) CLIENTES', 'c) PROVEEDORES', 'd) COLABORADORES', 'e) SITUACIÓN FINANCIERA', 'f) RUTAS'];
        foreach ($viñetas as $item) {
            $pdf->Cell(10, 5, '', 0, 0);
            $pdf->Cell(170, 5, utf8_decode($item), 0, 1);
        }
        $pdf->Ln(5);
    }
}

// Firma
$pdf->Ln(30);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(85, 5, '______________________________________', 0, 0, 'C');
$pdf->Cell(85, 5, '______________________________________', 0, 1, 'C');
$pdf->Cell(85, 5, 'ING. RAUL GUTIERREZ DE VELASCO ROMO', 0, 0, 'C');
$pdf->Cell(85, 5, $empleado, 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(85, 5, 'LA EMPRESA', 0, 0, 'C');
$pdf->Cell(85, 5, 'EL RECEPTOR', 0, 1, 'C');

$pdf->Output('I', 'Contrato_Confidencialidad.pdf');
?>
