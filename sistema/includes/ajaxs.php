<?php
require 'PHPMailer/PHPMailerAutoload.php';

$hostname = '{mail.jcanoingenieria.com:993/imap/ssl}INBOX';
$username = 'rdiaz@jcanoingenieria.com';
$password = 'CHE_ito73';

// Conecta al servidor de correo con IMAP
$inbox = imap_open($hostname,$username,$password) or die('No se pudo conectar al servidor de correo: ' .
imap_last_error());

// Obtén información del correo electrónico
$emails = imap_search($inbox,'ALL');

$data = array();

foreach ($mailbox as $mail) {
    $row = array();

    $row[] = $mail["id"];
    $row[] = $mail["from"];
    $row[] = $mail["subject"];
    $row[] = $mail["date"];
    $row[] = "<a href='#' class='btn btn-sm btn-primary'>Leer</a>";

    $data[] = $row;
}

// Envío de los datos al mármol Datatables
$output = array(
    "recordsTotal" => count($mailbox),
    "recordsFiltered" => count($mailbox),
    "data" => $data
);

echo json_encode($output);
?>