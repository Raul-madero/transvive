<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Obtener el nombre del archivo desde la URL
    $filepath = __DIR__ . '/' . $file; // Obtener la ruta completa del archivo

    // Asegurarse de que el archivo existe
    if (file_exists($filepath)) {
        // Forzar la descarga del archivo SQL
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);

        // Redirigir a index.php después de la descarga
        echo "<script>
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        // Mostrar alerta si el archivo no existe y redirigir a index.php
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'El archivo de respaldo no se encuentra.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    }
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'No se ha proporcionado un archivo válido.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index.php';
        });
    </script>";
}
