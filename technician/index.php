<?php
// Start session management and include necessary functions
session_start();
require_once('../model/database.php');
require_once('../model/admin_db.php');
require_once '../model/technicians_db.php';
require_once '../model/customers_db.php';
require_once '../model/incidents_db.php';


// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'display_incidents';
        

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_technician'])) {
            $action = 'login';
        }
    }   
}


switch($action) {
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $_SESSION['email'] = $email;
        if (is_valid_tech_login($email, $password)) {
            $_SESSION['is_valid_technician'] = true;
            $incidents = get_open_and_assigned_incidents_by_tech_email($email);
            include 'account/select_incident.php';
            break;
        } else {
            $login_message = 'You must login to view this page.';
            include('../technician/account/account_login.php');
        }
        break;
    case 'display_incidents':
        $email = $_SESSION['email'];
        $incidents = get_open_and_assigned_incidents_by_tech_email($email);
        include 'account/select_incident.php';
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include('account/account_login.php');
        break;
}