<?php

function get_customer_and_products_by_email($email) {
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

function add_incident ($customer_id, $product_code, $title, $description) {
    global $db;
    $query = 'INSERT INTO incidents
                (customerID, productCode, title, description)
              VALUES
                (?, ?, ?, ?)';
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("isss", $customer_id, $product_code, $title, $description);
    $statement->execute();    
    $statement->close();    
}

function get_unassigned_incidents_by_customer() {
    global $db;
    $query = 'SELECT customers.firstName, customers.lastName, '
            . 'incidents.incidentID, incidents.productCode, incidents.dateOpened, '
            . 'incidents.title, incidents.description '
            . 'FROM customers '
            . 'INNER JOIN incidents '
            . 'ON customers.customerID = incidents.customerID '
            . 'WHERE incidents.techID IS NULL';
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $incidents = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $incident = $result->fetch_assoc();
        $incidents[] = $incident;
    }
    $result->free();
    return $incidents;
    
}

function get_first_name_last_name_open_incidents_by_technician() {
    global $db;
    $query = 'SELECT techID, firstName, lastName, '
            . '(SELECT COUNT(*) FROM incidents '
            . 'WHERE technicians.techID = incidents.techID '
            . 'AND dateClosed IS NULL) '
            . 'AS openIncidents FROM technicians';
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $incidents = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $incident = $result->fetch_assoc();
        $incidents[] = $incident;
    }
    $result->free();
    return $incidents;
    
}

function get_technician_and_customer_and_product_code_by_incident($incident_id) {
    global $db;
    $query = "SELECT c.firstName AS customerFirstName, c.lastName AS customerLastName, i.productCode, t.firstName AS techFirstName, t.lastName AS techLastName FROM customers c LEFT JOIN incidents i ON c.customerID = i.customerID LEFT JOIN technicians t ON t.techID = i.techID WHERE i.incidentID = '$incident_id' ";
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $incidents = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $incident = $result->fetch_assoc();
        $incidents[] = $incident;
    }
    $result->free();
    return $incidents;    
}

function update_incident_by_tech_id_and_incident_id($tech_id, $incident_id) {
    global $db;  
    $query = "UPDATE incidents
                SET techID = ?                  
                WHERE incidentID = ?";
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("ii", $tech_id, $incident_id);
    $statement->execute();    
    $statement->close();
}

function get_incident_by_incident_id($incident_id) {
    global $db;
    $incident_id_esc = $db->escape_string($incident_id);
    $query = "SELECT incidentID, productCode, dateOpened, dateClosed, title, description from incidents WHERE incidentID = '$incident_id_esc' ";
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $incidents = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $incident = $result->fetch_assoc();
        $incidents[] = $incident;
    }
    $result->free();
    return $incidents;
}

function update_incident_by_incident_id($incident_id, $date_closed, $description) {
    global $db;
    $incident_id_esc = $db->escape_string($incident_id);
    $query = "Update incidents SET dateClosed = ?, description = ? WHERE incidentID = '$incident_id_esc'";
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("ss", $date_closed, $description);
    $statement->execute();    
    $statement->close();
}

function get_unassigned_incidents() {
    global $db;
    $query = 'SELECT c.firstName, c.lastName, p.name, i.incidentID, i.dateOpened, i.title, i.description
                FROM customers c 
                LEFT JOIN incidents i  
                ON c.customerID = i.customerID
                LEFT JOIN products p  
                ON p.productCode = i.productCode
                WHERE i.techID IS NULL
                AND i.incidentID IS NOT NULL;';
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $incidents = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $incident = $result->fetch_assoc();
        $incidents[] = $incident;
    }
    $result->free();
    return $incidents;
}

function get_assigned_incidents() {
    global $db;
    $query = 'SELECT c.firstName AS customerFirstName, c.lastName AS customerLastName, p.name, i.incidentID, i.dateOpened, i.dateClosed, i.title, i.description, t.firstName AS techFirstName, t.lastName AS techLastName
                FROM customers c 
                LEFT JOIN incidents i  
                ON c.customerID = i.customerID
                LEFT JOIN products p  
                ON p.productCode = i.productCode
                LEFT JOIN technicians t 
                ON i.techID = t.techID
                WHERE i.techID IS NOT NULL
                AND i.incidentID IS NOT NULL;';
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $incidents = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $incident = $result->fetch_assoc();
        $incidents[] = $incident;
    }
    $result->free();
    return $incidents;
}

?>
