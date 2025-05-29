<?php
require '../fpdf/fpdf.php';
require '../includes/conversor.php';
include('../../conexion.php');

header("Content-Type: text/html; charset=iso-8859-1");

function formatear_fecha($fecha) {
    $meses = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo',
        4 => 'abril', 5 => 'mayo', 6 => 'junio',
        7 => 'julio', 8 => 'agosto', 9 => 'septiembre',
        10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    ];

    $dia = strtoupper(date('j', strtotime($fecha)));
    $mes = strtoupper($meses[intval(date('n', strtotime($fecha)))]);
    $anio = date('Y', strtotime($fecha));

    return "$dia de $mes de $anio";
}


function obtenerDatosEmpleado($con, $nombreCompleto) {
    $sql = "SELECT 
                CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) AS empleado,
                em.fecha_contrato, em.fecha_reingreso, em.sexo, em.estado_civil, em.edad,
                em.rfc, em.curp, em.numeross, em.domicilio,
                em.cargo, em.salarioxdia
            FROM empleados em
            WHERE CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) = ?
            LIMIT 1";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $nombreCompleto);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

class PDF extends FPDF {
    var $B, $I, $U, $HREF;

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
                    foreach ($a2 as $v)
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
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
        foreach (['B', 'I', 'U'] as $s) if ($this->$s > 0) $style .= $s;
        $this->SetFont('', $style);
    }

    function Footer() {
        $this->SetY(-20);
        $this->SetFont('Arial', '', 8);
        $this->Cell(180, 5, $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
}

function generarContratoEmpleado($nombreEmpleado) {
    global $conection;

    $data = obtenerDatosEmpleado($conection, $nombreEmpleado);
    if (!$data) die("Empleado no encontrado.");

    $fecha_contrato = ($data['fecha_reingreso'] && $data['fecha_reingreso'] > '1900-01-01') ? $data['fecha_reingreso'] : $data['fecha_contrato'];
    $fecha_final = (new DateTime($fecha_contrato))->modify('+30 days')->format('Y-m-d');

    $mesMen    = formatear_fecha($fecha_contrato);
    $mesMay    = formatear_fecha($fecha_final);
    $Diaactual = formatear_fecha(date('Y-m-d'));

    $salario_letra = numtoletras($data['salarioxdia']);

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'Letter');
    $pdf->SetMargins(20, 2, 20);
    $pdf->SetAutoPageBreak(true, 20);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(180, 5, 'CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO', 0, 1, 'C');
    $pdf->Ln(5);

    $intro = "<div align='justify'>CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO POR 30 DIAS A PARTIR DEL <b>$mesMen</b> AL <b>$mesMay</b>, ENTRE LA EMPRESA <b>TRANSVIVE, S DE RL DE CV</b> Y <b>{$data['empleado']}</b>, QUIEN EN LO SUCESIVO SE LE DENOMINARÁ \"EL TRABAJADOR\".</div>";
    $pdf->SetFont('Arial', '', 9);
    $pdf->WriteHTML($intro);

    // Aquí se insertarán los textos del contrato original uno por uno
    $clausulas = include('clausulas_eventual.php');

$valores = [
    '{cargo}' => $cargo,
    '{sexo}' => $sexo,
    '{edad}' => $edad,
    '{rfc}' => $rfc,
    '{curp}' => $curp,
    '{nss}' => $nss,
    '{domicilio}' => $domicilio,
    '{estadocivil}' => $estadocivil,
    '{salarioxdia}' => $salarioxdia,
    '{salario_letra}' => $salario_letra,
    '{Diaactual}' => $Diaactual
];

foreach ($clausulas as $bloque) {
    $bloque_con_datos = strtr($bloque, $valores); // Reemplaza los marcadores
    $pdf->Ln(10);
    $pdf->WriteHTML($bloque_con_datos);
}


    // Firma
    $pdf->Ln(30);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(85, 5, 'EMPRESA', 0, 0, 'C');
    $pdf->Cell(85, 5, 'EMPLEADO', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->Cell(85, 5, '_______________________________', 0, 0, 'C');
    $pdf->Cell(85, 5, '_______________________________', 0, 1, 'C');
    $pdf->Cell(85, 5, 'RAUL GUTIERREZ DE VELASCO ROMO', 0, 0, 'C');
    $pdf->Cell(85, 5, $data['empleado'], 0, 1, 'C');

    $pdf->Output('I', 'Contrato_Eventual_30_Dias.pdf');
}

if (isset($_GET['id'])) {
    generarContratoEmpleado($_GET['id']);
} else {
    die("Falta el parámetro 'id'");
}
?>
