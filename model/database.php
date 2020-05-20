<?php

@ $db = new mysqli('localhost', 'root', '', 'tech_support');

$error_message = $db->connect_error;
if ($error_message != null) {
    include '../errors/db_error_connect.php';
    exit;
}
        
function display_db_error($error_message) {
    global $app_path;
    include '../errors/database_error.php';
    exit;
}
?>