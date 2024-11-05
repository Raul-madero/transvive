<?php
if (isset($_POST)) {
    date_default_timezone_set('America/Mexico_City');
    $fecha   = date("Ymd_His");
    $usuario = 'root';
    $passwd  = '';
    $bd      = 'transvive';

    // Ruta hacia la carpeta "Downloads" del usuario
    $userProfile = getenv('USERPROFILE');
    $downloadsFolder = $userProfile . '\\Downloads';
    $salida_sql = $downloadsFolder . '\\' . $bd . '_' . $fecha . '.sql'; 

    // Comando mysqldump con más opciones
    $executa = "c:\\xampp\\mysql\\bin\\mysqldump.exe -u $usuario --password=$passwd --opt --events --routines --triggers --default-character-set=utf8 --single-transaction --quick --lock-tables=false $bd > $salida_sql";

    system($executa, $resultado);

    if ($resultado === 0) {
        // Enviar respuesta JSON para éxito
        echo json_encode([
            'status' => 'success',
            'message' => "El respaldo se ha guardado correctamente en la carpeta: $salida_sql"
        ]);
    } else {
        // Enviar respuesta JSON para error
        echo json_encode([
            'status' => 'error',
            'message' => "Hubo un error al realizar el respaldo. Código de error: $resultado"
        ]);
    }
    exit();
}
?>
