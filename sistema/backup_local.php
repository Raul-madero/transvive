<?php
if (isset($_POST['backup'])) {
    date_default_timezone_set('America/Mexico_City');
    $fecha   = date("Ymd_His");
    $usuario = 'root';  // Usuario de la base de datos 
    $passwd  = '';      // Contraseña bd
    $bd      = 'transvive';  // Nombre de la Base de Datos
    $salida_sql = $bd . '_' . $fecha . '.sql'; 

    // Comando para generar el respaldo de la base de datos
    $executa = "c:\\xampp\\mysql\\bin\\mysqldump.exe -u $usuario --password=$passwd --opt --events --routines --triggers --default-character-set=utf8 $bd > $salida_sql";  

    // Ejecutar el comando
    system($executa, $resultado); 

    if ($resultado === 0) {
        // Redirigir a download.php donde se manejará el alert y la descarga
        header("Location: download.php?file=" . urlencode($salida_sql));
        exit();
    } else {
        // En caso de error, mostrar alerta de error
        echo "<script>
            alert('Hubo un error al generar el respaldo. Código de error: $resultado');
            window.location.href = 'index.php';
        </script>";
        exit();
    }
}
?>
