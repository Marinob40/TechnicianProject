<?php

function is_valid_admin_login($username, $password) {
    global $db;
    $username_esc = $db->escape_string($username);
    $query = "SELECT password FROM administrators
              WHERE username = '$username_esc'";
    $result = $db->query($query);
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $passwords = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $password = $result->fetch_assoc();
        $passwords[] = $password;
    }
    $result->free();
    return $passwords;
}


?>
