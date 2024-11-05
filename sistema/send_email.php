<?php
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.office365.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'rog_diaz@hotmail.com';
$mail->Password = 'CHE_ito73';
$mail->isHTML(true);

// Establece los detalles del mensaje
$to = $_POST['to'];
$subject = $_POST['subject'];
$body = $_POST['compose-textarea'];
$attachment = '';
$filename = '';
if (isset($_FILES['attachment'])) {
    $attachment = $_FILES['attachment']['tmp_name'];
    $filename = $_FILES['attachment']['name'];
}
$mail->SetFrom('rog_diaz@hotmail.com');
$mail->AddAddress($to);
$mail->Subject = $subject;
$mail->Body = $body;
if (!empty($attachment)) {
    $mail->AddAttachment($attachment, $filename);
}

// Envía el correo electrónico
if(!$mail->Send()) {
    echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;
} else {
    echo 'Correo electrónico enviado con éxito a ' . $to;
    echo'<script type="text/javascript">
    alert("Correo electrónico enviado con éxito");
    window.location.href="compose.php";
    </script>';  
}
?>