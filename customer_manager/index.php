<?php
require('../model/database.php');
require('../model/customers_db.php');

require_once('../model/fields.php');
require_once('../model/validate.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('firstName');
$fields->addField('lastName');
$fields->addField('address');
$fields->addField('city');
$fields->addField('state');
$fields->addField('postalCode');
$fields->addField('phone');
$fields->addField('email');
$fields->addField('password');




$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'customer_search';
    }
}

if ($action == 'customer_search') {
    include 'customer_search.php';   
}elseif ($action == 'list_customers_by_last_name') {
    $last_name = filter_input(INPUT_POST, 'last_name');
    $customers = get_customers_by_last_name($last_name);    
    include 'customers_by_last_name.php';
} elseif ($action == 'list_customer_by_email') {
    $email = filter_input(INPUT_GET, 'email');
    $country_code = filter_input(INPUT_POST, 'countryCode');
    if ($email === null) {
            $email = filter_input(INPUT_POST, 'email');
        }
    $customer = get_customer_by_email($email);
    include 'customers_by_last_name.php';
    
} elseif ($action == 'show_add_edit_form') {
    $email = filter_input(INPUT_GET, 'email');
    $country_code = filter_input(INPUT_POST, 'countryCode');
    if ($email === null) {
            $customer = NULL;
            include 'customer_add_edit.php';
    } else {
        $customer = get_customer_by_email($email);
        include 'customer_add_edit.php';   
    }
} elseif ($action == 'update_customer_by_id') {
    $customer_id = filter_input(INPUT_POST, 'customerID');
    $first_name = trim(filter_input(INPUT_POST, 'firstName'));    
    $last_name = trim(filter_input(INPUT_POST, 'lastName')); 
    $address = trim(filter_input(INPUT_POST, 'address')); 
    $city = trim(filter_input(INPUT_POST, 'city')); 
    $state = trim(filter_input(INPUT_POST, 'state')); 
    $postal_code = trim(filter_input(INPUT_POST, 'postalCode')); 
    $country_code = filter_input(INPUT_POST, 'countryCode');     
    $phone = trim(filter_input(INPUT_POST, 'phone')); 
    $email = trim(filter_input(INPUT_POST, 'email')); 
    $password = trim(filter_input(INPUT_POST, 'password'));
    
    $validate->text('firstName', $first_name);
    $validate->text('lastName', $last_name);
    $validate->text('address', $address);
    $validate->text('city', $city);
    $validate->text('state', $state);
    $validate->text('email', $email);
    $validate->email('email', $email);
    $validate->postalCode('postalCode', $postal_code);
    $validate->password('password', $password);
    $validate->phone('phone', $phone);
    
    if ($fields->hasErrors()) {
        $customer = update_customer_by_id($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
        $customer = get_customer_by_email($email);
        include 'customer_view_update.php';
    } else {
        update_customer_by_id($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
        include 'customer_updated.php';
    }
     
    
}elseif ($action == 'add_customer') {
    $first_name = trim(filter_input(INPUT_POST, 'firstName'));    
    $last_name = trim(filter_input(INPUT_POST, 'lastName')); 
    $address = trim(filter_input(INPUT_POST, 'address')); 
    $city = trim(filter_input(INPUT_POST, 'city')); 
    $state = trim(filter_input(INPUT_POST, 'state')); 
    $postal_code = trim(filter_input(INPUT_POST, 'postalCode')); 
    $country_code = filter_input(INPUT_POST, 'countryCode');     
    $phone = trim(filter_input(INPUT_POST, 'phone')); 
    $email = trim(filter_input(INPUT_POST, 'email')); 
    $password = trim(filter_input(INPUT_POST, 'password'));
    add_customer($first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
    include 'customer_added.php';
}
