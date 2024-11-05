<?php
include "../conexion.php";

$nounidad     = $_POST['inputNounidad'];
$socio        = $_POST['inputSocio'];
$descripcion  = $_POST['inputDescribe'];
$nplacas      = $_POST['inputPlacas'];
$nserie       = $_POST['inputNserie'];
$year         = $_POST['inputYear'];
$tipogas      = $_POST['inputTipogas'];
$nopoliza     = $_POST['inputNopoliza'];
$aseguradora  = $_POST['inputAseguradora'];
$iniciapol    = $_POST['inputIniciopol'];
$terminapol   = $_POST['inputFinpol'];
$notarjeta    = $_POST['inputTarjetac'];
$vencetarjeta = $_POST['inputVencetar'];
$entregadoc   = $_POST['inputEntregadoc'];
$parametro    = $_POST['inputParametro'];
$notas        = $_POST['inputNotas'];



$sqlact= mysqli_query($conection,"SELECT no_unidad from unidades where no_unidad = '$nounidad'");
 
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact > 0){

     echo "<script>alert('La Unidad ya Existe'); location.href = './new_unidades.php'</script>"; 
  }else {   

    if ($parametro == NULL) {
      $newparametro = 0;
    }else {
      $newparametro = $parametro;
    }


if ($_FILES['archivo']['name'] != null) {
   $nombre_base  = basename($_FILES['archivo']['name']);
   $nombre_final = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base;
   $ruta = 'archivos_polizas/' . $nombre_final;
   $subirarchivo = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
}else {
  $ruta = "";
}

if ($_FILES['archivo_tarjetac']['name'] != null) {
   $nombre_base2  = basename($_FILES['archivo_tarjetac']['name']);
   $nombre_final2 = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base2;
   $ruta2 = 'archivos_polizas/' . $nombre_final2;
   $subirarchivo2 = move_uploaded_file($_FILES['archivo_tarjetac']['tmp_name'], $ruta2);
}else {
  $ruta2 = "";
}

if ($_FILES['archivo_permisos']['name'] != null) {
   $nombre_base3  = basename($_FILES['archivo_permisos']['name']);
   $nombre_final3 = date('m-d-y'). '-'. date('H-i-s'). '-'. $nombre_base3;
   $ruta3 = 'archivos_polizas/' . $nombre_final3;
   $subirarchivo3 = move_uploaded_file($_FILES['archivo_permisos']['tmp_name'], $ruta3);
}else {
  $ruta3 = "";
}

  /* if ($subirarchivo) {*/
        $insertarSQL = "INSERT INTO unidades(no_unidad, socio, descripcion, placas, no_serie, year, tipo_combustible, no_poliza, aseguradora, inicio_poliza, fin_poliza, tarjeta_circulacion, vence_tcirculacion, fecha_entregadoc, rendimiendo_estandar, notas) VALUES ('$nounidad', '$socio', '$descripcion', '$nplacas', '$nserie', $year, '$tipogas', '$nopoliza', '$aseguradora', '$iniciapol', '$terminapol', '$notarjeta', '$vencetarjeta', '$entregadoc', $newparametro, '$notas')";
        $resultado = mysqli_query($conection, $insertarSQL);
        if($resultado){
         
         echo "<script>alert('La Unidad se Almaceno Correctamente'); location.href = './unidades.php'</script>";
        }else{
         printf('Errormessage: %s\n', mysqli_error($conection));
        }
  /* }*/
/*}else{
   
        $insertarSQL = "INSERT INTO unidades(no_unidad, socio, descripcion, placas, no_serie, year, tipo_combustible, no_poliza, aseguradora, inicio_poliza, fin_poliza, tarjeta_circulacion, vence_tcirculacion, fecha_entregadoc, rendimiendo_estandar, notas) VALUES ('$nounidad', '$socio', '$descripcion', '$nplacas', '$nserie', $year, '$tipogas', '$nopoliza', '$aseguradora', '$iniciapol', '$terminapol', '$notarjeta', '$vencetarjeta', '$entregadoc', $newparametro, '$notas')";
        $resultado = mysqli_query($conection, $insertarSQL);
        if($resultado){

         echo "<script>alert('La Unidad se Almaceno Correctamente'); location.href = './unidades.php'</script>";
        }else{
         printf('Errormessage: %s\n', mysqli_error($conection));
        }
   
}*/

 if ($subirarchivo) {
    $updateSQLr1 = "UPDATE unidades SET archivo = '$ruta' WHERE no_unidad = '$nounidad'";
    $resultado2 = mysqli_query($conection, $updateSQLr1);
  }

  if ($subirarchivo2) {
    $updateSQLr2 = "UPDATE unidades SET archivo_tarjetac = '$ruta2' WHERE no_unidad = '$nounidad'";
    $resultado3 = mysqli_query($conection, $updateSQLr2);
  }

  if ($subirarchivo3) {
    $updateSQLr3 = "UPDATE unidades SET archivo_permiso = '$ruta3' WHERE no_unidad = '$nounidad'";
    $resultado4 = mysqli_query($conection, $updateSQLr3);
  }
mysqli_close($conection);
}
?>