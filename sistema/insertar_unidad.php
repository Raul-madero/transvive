<?php
include "../conexion.php";

// Función para subir archivos
function subirArchivo($file, $directorio = 'archivos_polizas/')
{
    if (!empty($file['name'])) {
        $nombre_base = basename($file['name']);
        $nombre_final = date('Y-m-d_H-i-s') . '_' . $nombre_base;
        $ruta = $directorio . $nombre_final;

        if (move_uploaded_file($file['tmp_name'], $ruta)) {
            return $ruta;
        }
    }
    return null;
}

// Escapar entradas para evitar inyección SQL
$nounidad     = mysqli_real_escape_string($conection, $_POST['inputNounidad'] ?? "");
$socio        = mysqli_real_escape_string($conection, $_POST['inputSocio'] ?? "");
$descripcion  = mysqli_real_escape_string($conection, $_POST['inputDescribe'] ?? "");
$nplacas      = mysqli_real_escape_string($conection, $_POST['inputPlacas'] ?? "");
$nserie       = mysqli_real_escape_string($conection, $_POST['inputNserie'] ?? "");
$year         = !empty($_POST['inputYear']) ? intval($_POST['inputYear']) : NULL;
$tipogas      = mysqli_real_escape_string($conection, $_POST['inputTipogas'] ?? "");
$nopoliza     = mysqli_real_escape_string($conection, $_POST['inputNopoliza'] ?? "");
$aseguradora  = mysqli_real_escape_string($conection, $_POST['inputAseguradora'] ?? "");
$iniciapol    = !empty($_POST['inputIniciopol']) ? $_POST['inputIniciopol'] : NULL;
$terminapol   = !empty($_POST['inputFinpol']) ? $_POST['inputFinpol'] : NULL;
$notarjeta    = mysqli_real_escape_string($conection, $_POST['inputTarjetac'] ?? "");
$vencetarjeta = !empty($_POST['inputVencetar']) ? $_POST['inputVencetar'] : NULL;
$entregadoc   = !empty($_POST['inputEntregadoc']) ? $_POST['inputEntregadoc'] : NULL;
$parametro    = !empty($_POST['inputParametro']) ? intval($_POST['inputParametro']) : 0;
$notas        = mysqli_real_escape_string($conection, $_POST['inputNotas'] ?? "");

$iniciapol = $iniciapol ?: NULL;
$terminapol = $terminapol ?: NULL;
$vencetarjeta = $vencetarjeta ?: NULL;
$entregadoc = $entregadoc ?: NULL;

// Validar si la unidad ya existe
$stmt = $conection->prepare("SELECT no_unidad FROM unidades WHERE no_unidad = ?");
$stmt->bind_param("s", $nounidad);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('La Unidad ya Existe'); location.href = './new_unidades.php';</script>";
    exit();
}
$stmt->close();

// Subir archivos
$ruta_poliza = subirArchivo($_FILES['archivo']);
$ruta_tarjeta = subirArchivo($_FILES['archivo_tarjetac']);
$ruta_permisos = subirArchivo($_FILES['archivo_permisos']);

// Insertar datos en la base de datos
$sql = "INSERT INTO unidades (
            no_unidad, socio, descripcion, placas, no_serie, year, tipo_combustible, 
            no_poliza, aseguradora, inicio_poliza, fin_poliza, tarjeta_circulacion, 
            vence_tcirculacion, fecha_entregadoc, rendimiendo_estandar, notas
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conection->prepare($sql);
$stmt->bind_param(
    "ssssisssssssssis",
    $nounidad, $socio, $descripcion, $nplacas, $nserie, $year, $tipogas, 
    $nopoliza, $aseguradora, $iniciapol, $terminapol, $notarjeta, 
    $vencetarjeta, $entregadoc, $parametro, $notas
);

if ($stmt->execute()) {
    // Actualizar archivos si se subieron
    if ($ruta_poliza) {
        $stmt = $conection->prepare("UPDATE unidades SET archivo = ? WHERE no_unidad = ?");
        $stmt->bind_param("ss", $ruta_poliza, $nounidad);
        $stmt->execute();
    }
    if ($ruta_tarjeta) {
        $stmt = $conection->prepare("UPDATE unidades SET archivo_tarjetac = ? WHERE no_unidad = ?");
        $stmt->bind_param("ss", $ruta_tarjeta, $nounidad);
        $stmt->execute();
    }
    if ($ruta_permisos) {
        $stmt = $conection->prepare("UPDATE unidades SET archivo_permiso = ? WHERE no_unidad = ?");
        $stmt->bind_param("ss", $ruta_permisos, $nounidad);
        $stmt->execute();
    }

    echo "<script>alert('La Unidad se Almaceno Correctamente'); location.href = './unidades.php';</script>";
} else {
    printf("Error: %s\n", $conection->error);
}

$stmt->close();
$conection->close();
?>