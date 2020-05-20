<?php
function get_technicians() {
    global $db;
    $query = 'SELECT * FROM technicians
              ORDER BY techID';
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $technicians = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $technician = $result->fetch_assoc();
        $technicians[] = $technician;
    }
    $result->free();
    return $technicians;
}

function delete_technician($tech_id) {
    global $db;
    $query = 'DELETE FROM technicians
              WHERE techID = :tech_id';
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("i", $tech_id);
    $statement->execute();
    $statement->close();
}

function add_technician($first_name, $last_name, $phone, $email, $password) {
    global $db;
    $query = 'INSERT INTO technicians
                 (firstName, lastName, phone, email, password)
              VALUES
                 (?, ?, ?, ?, ?)';
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("sssss", $first_name, $last_name, $phone, $email, $password);
    $statement->execute();    
    $statement->close(); ;
}

function get_technician_by_id($tech_id) {
    global $db;
    $query = "SELECT firstName, lastName FROM technicians WHERE techID = '$tech_id'";
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $technicians = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $techician = $result->fetch_assoc();
        $technicians[] = $techician;
    }
    $result->free();
    return $technicians;
    
}  

function get_open_and_assigned_incidents_by_tech_email($email) {
    global $db;
    $query = "SELECT c.firstName AS customerFirstName, c.lastName AS customerLastName, i.incidentID, i.techID, i.productCode, i.dateOpened, i.title, i.description, t.firstName, t.Lastname, t.email FROM customers c JOIN incidents i ON c.customerID = i.customerID JOIN technicians t ON i.techID = t.techID WHERE t.email = '$email' and i.dateClosed IS NULL";
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $technicians = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $techician = $result->fetch_assoc();
        $technicians[] = $techician;
    }
    $result->free();
    return $technicians;
}

function is_valid_tech_login($email, $password) {
    global $db;
    $email_esc = $db->escape_string($email);
    $query = "SELECT password FROM technicians
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