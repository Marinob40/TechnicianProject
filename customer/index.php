<?php
// Start session management and include necessary functions
session_start();
require_once('../model/database.php');
require_once('../model/product_db.php');
require_once('../model/customers_db.php');


// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'register_product';
        

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_customer'])) {
            $action = 'login';
        }
    }   
}


switch($action) {
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $_SESSION['email'] = $email;
        if (is_valid_customer_login($email, $password)) {
            $_SESSION['is_valid_customer'] = true;
            $customers = get_customer_by_email($email);
            include 'account/product_register.php';
            break;
        } else {
            $login_message = 'You must login to view this page.';
            include('../customer/account/account_login.php');           
        }
        break;
    case 'register_product':
        $email = $_SESSION['email'];
        $customers = get_customer_by_email($email);
        include 'account/product_register.php';
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include('account/account_login.php');
        break;
}