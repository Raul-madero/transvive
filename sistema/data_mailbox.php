<?php
require_once 'common.php';
$mailbox = open_imap_connection();
$email_count = imap_num_msg($mailbox); // Get total number of emails

// Datatable initialization
$start = $_GET['start'];
$length = $_GET['length'];
$search_value = $_GET['search']['value'];

// Get emails based on search value, total number of emails, and start and length of emails to display
$emails = search_emails($mailbox, $search_value, $start, $length, $email_count);

close_imap_connection($mailbox);
?>