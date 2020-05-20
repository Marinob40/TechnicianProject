<?php
require('../model/database.php');
require('../model/customers_db.php');
require('../model/incidents_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        include 'customer_get.php';
    }
}
    
    
if ($action == 'list_customer_by_email') {
    $email = filter_input(INPUT_POST, 'email');
    $customers = get_customer_and_products_by_email($email);
    include 'incident_create.php';
} elseif ($action == 'add_incident') {
    $customer_id = filter_input(INPUT_POST, 'customer_id');
    $product_code = filter_input(INPUT_POST, 'products');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    add_incident($customer_id, $product_code, $title, $description);
    include 'incident_created.php';
}
?>

