<?php
require_once 'config.php';

// Abre la conexión IMAP
function open_imap_connection() {
    global $config;
    $imap_server = $config['imap_server'];
    $imap_port = $config['imap_port'];
    $imap_security = $config['imap_security'];
    $username = $config['username'];
    $password = $config['password'];
    $mailbox = imap_open("{" . $imap_server . ":" . $imap_port . "/imap/" . $imap_security . "}", $username, $password)
or die(imap_last_error());
    return $mailbox;
}

// Cierra la conexión IMAP
function close_imap_connection($mailbox) {
    imap_close($mailbox);
}

// Obtiene los detalles de un correo electrónico
function get_message_details($mailbox, $message_id) {
    $message_details = array();
    $message = imap_fetch_overview($mailbox, $message_id);
    $message_body = imap_fetchbody($mailbox, $message_id, 1);
    $message_details['subject'] = $message[0]->subject;
    $message_details['from_name'] = imap_utf8($message[0]->from);
    $message_details['from_address'] = imap_utf8($message[0]->from);
    $message_details['to_address'] = imap_utf8($message[0]->to);
    $message_details['date'] = $message[0]->date;
    $message_details['message_id'] = $message[0]->message_id;
    $message_details['body'] = $message_body;
    return $message_details;
}

// Función para buscar correos electrónicos en base a determinados criterios.
function search_emails($mailbox, $criteria) {
    $messages = imap_search($mailbox, $criteria);
    $message_details = array();
    if ($messages) {
        foreach ($messages as $message_id) {
            $message_details[] = get_message_details($mailbox, $message_id);
        }
    }
    return $message_details;
}
?>