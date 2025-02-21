<?php
include('../conexion.php');

$foto        = $_FILES['archivo'];
$nombre_foto = $foto['name'];
$foto2        = $_FILES['archivo_tarjetac'];
$nombre_foto2 = $foto2['name'];
$foto3        = $_FILES['archivo_permisos'];
$nombre_foto3 = $foto3['name'];
//$type        = $foto['type'];
//$url_temp    = $foto['tmp_name'];

//$imgProducto = 'user.png';

// Función para sanitizar cadenas
function sanitizeString($conn, $input) {
  return mysqli_real_escape_string($conn, trim($input));
}

// Función para validar fechas en formato 'Y-m-d'
function validateDate($date) {
  $d = DateTime::createFromFormat('Y-m-d', $date);
  return $d && $d->format('Y-m-d') === $date;
}

// Sanitización y validación
$Id           = filter_input(INPUT_POST, 'inputId', FILTER_VALIDATE_INT) ?: 0;
$nounidad     = sanitizeString($mysqli, $_POST['inputNounidad'] ?? '');
$socio        = sanitizeString($mysqli, $_POST['inputSocio'] ?? '');
$descripcion  = sanitizeString($mysqli, $_POST['inputDescribe'] ?? '');
$nplacas      = sanitizeString($mysqli, $_POST['inputPlacas'] ?? '');
$nserie       = sanitizeString($mysqli, $_POST['inputNserie'] ?? '');
$year         = filter_input(INPUT_POST, 'inputYear', FILTER_VALIDATE_INT) ?: 0;
$tipogas      = sanitizeString($mysqli, $_POST['inputTipogas'] ?? '');
$nopoliza     = sanitizeString($mysqli, $_POST['inputNopoliza'] ?? '');
$aseguradora  = sanitizeString($mysqli, $_POST['inputAseguradora'] ?? '');

// Validar fechas o asignar NULL si no son válidas
$iniciapol    = validateDate($_POST['inputIniciopol'] ?? '') ? $_POST['inputIniciopol'] : NULL;
$terminapol   = validateDate($_POST['inputFinpol'] ?? '') ? $_POST['inputFinpol'] : NULL;
$vencetarjeta = validateDate($_POST['inputVencetar'] ?? '') ? $_POST['inputVencetar'] : NULL;
$entregadoc   = validateDate($_POST['inputEntregadoc'] ?? '') ? $_POST['inputEntregadoc'] : date('Y-m-d');

$notarjeta    = sanitizeString($mysqli, $_POST['inputTarjetac'] ?? '');
$parametro    = sanitizeString($mysqli, $_POST['inputRestandar'] ?? '');
$notas        = sanitizeString($mysqli, $_POST['inputNotas'] ?? '');

$sqlact= mysqli_query($conection,"SELECT no_unidad from unidades where no_unidad = '$nounidad' and id != $Id");
 
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact > 0){
   

    echo "<script>alert('La Unidad ya Existe'); location.href = './unidades.php'</script>"; 
 
   }else {
    

    if ($parametro == NULL) {
      $newparametro = 0;
    }else {
      $newparametro = $parametro;
    }




if ($nombre_foto != null) {
   $nombre_base  = basename($_FILES['archivo']['name']);
   $nombre_final = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base;
   $ruta = 'archivos_polizas/' . $nombre_final;
   $subirarchivo = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
}else {
  $ruta = "";
}

if ($nombre_foto2 != null) {
   $nombre_base2  = basename($_FILES['archivo_tarjetac']['name']);
   $nombre_final2 = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base2;
   $ruta2 = 'archivos_polizas/' . $nombre_final2;
   $subirarchivo2 = move_uploaded_file($_FILES['archivo_tarjetac']['tmp_name'], $ruta2);
}else {
  $ruta2 = "";
}

if ($nombre_foto3 != null) {
   $nombre_base3  = basename($_FILES['archivo_permisos']['name']);
   $nombre_final3 = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base3;
   $ruta3 = 'archivos_polizas/' . $nombre_final3;
   $subirarchivo3 = move_uploaded_file($_FILES['archivo_permisos']['tmp_name'], $ruta3);
}else {
  $ruta3 = "";
}



   
        $updateSQL = "UPDATE unidades SET no_unidad = '$nounidad',  socio = '$socio', descripcion = '$descripcion', placas = '$nplacas', no_serie = '$nserie', year = $year, tipo_combustible = '$tipogas', no_poliza = '$nopoliza', aseguradora = '$aseguradora', inicio_poliza = '$iniciapol', fin_poliza = '$terminapol', tarjeta_circulacion = '$notarjeta', vence_tcirculacion = '$vencetarjeta', fecha_entregadoc = '$entregadoc', rendimiendo_estandar = $parametro, notas = '$notas' WHERE id = $Id";
        $resultado = mysqli_query($conection, $updateSQL);
        if($resultado){

         echo "<script>alert('La Unidad se Edito Correctamente'); location.href = './unidades.php' </script>";
        }else{
         printf('Errormessage: %s\n', mysqli_error($conection));
        }
  

  if ($subirarchivo) {
    $updateSQLr1 = "UPDATE unidades SET archivo = '$ruta' WHERE id = $Id";
    $resultado2 = mysqli_query($conection, $updateSQLr1);
  }

  if ($subirarchivo2) {
    $updateSQLr2 = "UPDATE unidades SET archivo_tarjetac = '$ruta2' WHERE id = $Id";
    $resultado3 = mysqli_query($conection, $updateSQLr2);
  }

  if ($subirarchivo3) {
    $updateSQLr3 = "UPDATE unidades SET archivo_permiso = '$ruta3' WHERE id = $Id";
    $resultado4 = mysqli_query($conection, $updateSQLr3);
  }
/*}else{
   
        $updateSQL1 = "UPDATE unidades SET no_unidad = '$nounidad',  socio = '$socio', descripcion = '$descripcion', placas = '$nplacas', no_serie = '$nserie', year = $year, tipo_combustible = '$tipogas', no_poliza = '$nopoliza', aseguradora = '$aseguradora', inicio_poliza = '$iniciapol', fin_poliza = '$terminapol', tarjeta_circulacion = '$notarjeta', vence_tcirculacion = '$vencetarjeta', fecha_entregadoc = '$entregadoc', rendimiendo_estandar = $parametro,  notas = '$notas' WHERE id = $Id";
        $resultado = mysqli_query($conection, $updateSQL1);
        if($resultado){
         echo "<script>alert('La Unidad se Edito Correctamente'); location.href = './unidades.php'</script>";
        }else{
         printf('Errormessage: %s\n', mysqli_error($conection));
        }
   
}*/
mysqli_close($conection);
}

?>