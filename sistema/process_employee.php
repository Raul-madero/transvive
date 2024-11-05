<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conectar a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'transvive';  // Cambia el nombre de la base de datos
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el número de empleado u otro identificador único para actualizar
    $employeeNumber  = $_POST['employeeNumber'];  // número de empleado
    $employeeTipo    = $_POST['employeeEmpleado']; 
    $employeeCity    = $_POST['employeeCiudad'];
    $employeeEdonac  = $_POST['employeeEdonace'];
    $employeeCalle   = $_POST['employeeCalle'];
    $employeeNocalle = $_POST['employeeCalleno'];
    $employeeColonia = $_POST['employeeColonia'];
    $employeeCpostal = $_POST['employeeCpostal'];
    $employeeMpio    = $_POST['employeeMpio'];
    $employeEstado   = $_POST['employeEstado2'];
    $employeeHorario = $_POST['employeeHorario'];
    $employeeClinica = $_POST['employeeClinica'];
    $employeeNoinfvi = $_POST['employeeNoinfonavit'];
    $employeeSinteg  = $_POST['employeeSalarioint'];
    $employeeContact = $_POST['employeeContacto'];
    $employeePhonect = $_POST['employeePhonect'];
    $employeeParient = $_POST['employeePariente'];
    $docSolicitud    = $_POST['docSolicitud'];
    $docIne          = $_POST['docIne'];  
    $docLicencia     = $_POST['docLicencia'];
    $docCurp         = $_POST['docCurp'];
    $docHogar        = $_POST['docHogar'];
    $docEstudios     = $_POST['docEstudios'];
    $docActanace     = $_POST['docActanace'];
    $docNss          = $_POST['docNss'];  
    $docRfc          = $_POST['docRfc'];
    $docInfonavit    = $_POST['docInfonavit'];
    $docRecomenda    = $_POST['docRecomenda'];
    $docAntidopaje   = $_POST['docAntidopaje'];
    $docPenales      = $_POST['docPenales'];
    $docMedico       = $_POST['docMedico'];

$query = "SELECT documentos FROM empleados WHERE noempleado = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employeeNumber); // Aquí usas el número de empleado
$stmt->execute();
$stmt->bind_result($nombreDocumentoActual); // Asigna el resultado a la variable
$stmt->fetch();
$stmt->close(); // Cierra la consulta
 
    // Ruta de la carpeta de uploads
$uploadFileDir = './uploads/';

// Verificar si se ha subido un archivo
if (isset($_FILES['employeeDocument']) && $_FILES['employeeDocument']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath1 = $_FILES['employeeDocument']['tmp_name'];
    $fileName1 = $_FILES['employeeDocument']['name'];
    $fileSize1 = $_FILES['employeeDocument']['size'];
    $fileType1 = $_FILES['employeeDocument']['type'];

    // Verificar que el archivo subido sea un PDF
    $allowedMimeTypes = ['application/pdf'];

    // Ruta completa del archivo destino
    $dest_path1 = $uploadFileDir . $fileName1;

    
        if ($fileName1 !== $nombreDocumentoActual) { // $nombreDocumentoActual viene de la base de datos
            // Si el archivo ha cambiado, mover el archivo subido a la carpeta de destino
            if (move_uploaded_file($fileTmpPath1, $dest_path1)) {
                // Si el archivo se sube correctamente, actualizar la variable $docto con el nuevo nombre
                $docto = $fileName1;
            } else {
                echo 'Error al subir el archivo.';
                exit; // Evitar que continúe el proceso si hay un error
            }
        } else {
            // Si el archivo no cambió, mantener el archivo actual
            $docto = $nombreDocumentoActual;  // No se sube un nuevo archivo
        }
   
} else {
    // No se ha subido un archivo, mantener el documento actual
    $docto = $nombreDocumentoActual;
}



     // Verificar si se ha subido una imagen
    if (isset($_FILES['employeePhoto']) && $_FILES['employeePhoto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['employeePhoto']['tmp_name'];
        $fileName = $_FILES['employeePhoto']['name'];
        $fileSize = $_FILES['employeePhoto']['size'];
        $fileType = $_FILES['employeePhoto']['type'];

        // Establecer la carpeta de destino donde se guardará la imagen
        $uploadFileDir = './uploads/';  // Asegúrate de que esta carpeta existe y tiene permisos de escritura
        $dest_path = $uploadFileDir . $fileName;

        // Mover el archivo a la carpeta 'uploads'
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Si la imagen se sube correctamente, almacenar la ruta en la base de datos
            $foto = $fileName;  // Solo almacenamos el nombre del archivo, no la ruta completa
            
            // Preparar la consulta SQL para actualizar la foto y los demás campos
            $query = "UPDATE empleados SET foto = ?, tipo = ?, ciudad_nacimiento = ?, estado_nacimiento = ?, calle = ?, no_calle = ?, colonia = ?, cod_postal = ?, municipio = ?, estado = ?, horario_work = ?, noclinica = ?, no_infonavit = ?, salario_integrado = ?, nombre_emergencia = ?, telefono_emergencia = ?, parentesco = ?, doc_solicitud = ?, doc_ine = ?, doc_licencia = ?, doc_curp = ?, doc_domicilio = ?, doc_estudios = ?, doc_actanace = ?, doc_nss = ?, doc_rfc = ?, doc_infonavit = ?, doc_recomendacion = ?, doc_antidopaje = ?, doc_penales = ?, doc_medico = ?, documentos = ? WHERE noempleado = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssssssssdssssssssssssssssssi", $foto, $employeeTipo, $employeeCity, $employeeEdonac, $employeeCalle, $employeeNocalle, $employeeColonia, $employeeCpostal, $employeeMpio, $employeEstado, $employeeHorario,$employeeClinica, $employeeNoinfvi, $employeeSinteg, $employeeContact, $employeePhonect, $employeeParient, $docSolicitud, $docIne, $docLicencia, $docCurp, $docHogar, $docEstudios, $docActanace, $docNss, $docRfc, $docInfonavit, $docRecomenda, $docAntidopaje, $docPenales, $docMedico, $docto, $employeeNumber);
        } else {
            // Mensaje de error al subir el archivo
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al subir el archivo.',
                    });
                });
            </script>";
            exit; // Termina el script en caso de error
        }
    } else {
        // Si no se sube una nueva imagen, actualizar solo el tipo de empleado
        $query = "UPDATE empleados SET tipo = ?, ciudad_nacimiento = ?, estado_nacimiento = ?, calle = ?, no_calle = ?, colonia = ?, cod_postal = ?, municipio = ?, estado = ?, horario_work = ?, noclinica = ?, no_infonavit = ?, salario_integrado = ?, nombre_emergencia = ?, telefono_emergencia = ?, parentesco = ?, doc_solicitud = ?, doc_ine = ?, doc_licencia = ?, doc_curp = ?, doc_domicilio = ?, doc_estudios = ?, doc_actanace = ?, doc_nss = ?, doc_rfc = ?, doc_infonavit = ?, doc_recomendacion = ?, doc_antidopaje = ?, doc_penales = ?, doc_medico = ?, documentos = ? WHERE noempleado = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssssssdssssssssssssssssssi", $employeeTipo, $employeeCity, $employeeEdonac, $employeeCalle, $employeeNocalle, $employeeColonia, $employeeCpostal, $employeeMpio, $employeEstado, $employeeHorario,$employeeClinica, $employeeNoinfvi, $employeeSinteg, $employeeContact, $employeePhonect, $employeeParient, $docSolicitud, $docIne, $docLicencia, $docCurp, $docHogar, $docEstudios, $docActanace, $docNss, $docRfc, $docInfonavit, $docRecomenda, $docAntidopaje, $docPenales, $docMedico, $docto, $employeeNumber);
    }

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Mensaje de éxito con SweetAlert y redirección
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualización exitosa!',
                    text: 'Los datos del empleado han sido actualizados correctamente.',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'empleados.php';  // Redirige a la página que desees
                    }
                });
            });
        </script>";
    } else {
        // Mensaje de error con SweetAlert
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar los datos: " . $conn->error . "',
                });
            });
        </script>";
    }

    $stmt->close();
}

$conn->close();
?>
