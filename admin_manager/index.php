<?php
// Start session management and include necessary functions
session_start();
require_once('../model/database.php');
require_once('../model/admin_db.php');

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_admin_menu';
        

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_admin'])) {
            $action = 'login';
        }
    }   
}


// Perform the specified action
switch($action) {
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $_SESSION['username'] = $username;
        if (is_valid_admin_login($username, $password)) {
            $_SESSION['is_valid_admin'] = true;
            include('../admin_manager/account/admin_menu.php');
        } else {
            $login_message = 'You must login to view this page.';
            include('../admin_manager/account/account_login.php');
        }
        break;
    case 'show_admin_menu':
        $_SESSION['username'] = $_SESSION['username'];
        include('../admin_manager/account/admin_menu.php');
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include('../admin_manager/account/account_login.php');
        break;
}