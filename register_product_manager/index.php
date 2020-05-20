
<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/customers_db.php');

session_start();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL && empty($_SESSION['user'])) {
        $action = 'login';
    } if (isset($_SESSION['user']) && $action = 'logout_customer') {
        $action = 'logout_customer';
    } if (isset($_SESSION['user'])) {
        $action = 'view_logged_in_customer';
    }
}


switch ($action) {
    case 'login';
        include 'product_register_login.php';;
        break;
    case 'view_customer';
        $email = filter_input(INPUT_POST, 'email');
        $customers = get_customer_by_email($email);
        $_SESSION['user'] = get_customer_by_email($email);;
        include 'product_register.php';       
        break;
    case 'view_logged_in_customer';
        $user = $_SESSION['user'];
        $email = $user[0][9];
        $customers = get_customer_by_email($email);
        include 'product_register.php'; 
        break;
    case 'logout_customer';
        $_SESSION = array();
        session_destroy();
        include 'product_register_login.php';
}
