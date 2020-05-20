<?php

function get_customers() {
    global $db;
    $query = 'SELECT * FROM customers
              ORDER BY lastName';
    $result = $db->query($query);
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $customers = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $customer = $result->fetch_assoc();
        $customers[] = $customer;
    }
    $result->free();
    return $customers;
}

function get_customers_by_last_name($last_name) {
    global $db;
    $last_name_esc = $db->escape_string($last_name);
    $query = "SELECT * FROM customers
              WHERE lastName = '$last_name_esc'";
    $result = $db->query($query);
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $customer = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $customer = $result->fetch_assoc();
        $customers[] = $customer;
    }
    $result->free();
    return $customers;
}

function get_customer_by_email($email) {
    global $db;
    $email_esc = $db->escape_string($email);
    $query = "SELECT * FROM customers
              WHERE email = '$email_esc'";
    $result = $db->query($query);
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $customer = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $customer = $result->fetch_assoc();
        $customers[] = $customer;
    }
    $result->free();
    return $customers;

}

function update_customer_by_id($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password) {
    global $db;  
    $query = 'UPDATE customers
              SET customerID = ?,
                  firstName = ?,
                  lastName = ?,
                  address = ?,
                  city = ?,
                  state = ?,
                  postalCode = ?,
                  countryCode = ?,
                  phone = ?,
                  email = ?,
                  password = ?';
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("issssssssss", $customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
    $statement->execute();    
    $statement->close();
}

function add_customer($first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password) {
    global $db;
    $query = 'INSERT INTO customers
                 (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password)
              VALUES
                 (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("ssssssssss", $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
    $statement->execute();    
    $statement->close(); ;
}

function is_valid_customer_login($email, $password) {
    global $db;
    $email_esc = $db->escape_string($email);
    $query = "SELECT password FROM customers
              WHERE email = '$email_esc'";
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

    
    
