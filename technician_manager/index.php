<?php
//require('../model/database.php');
require('../technician_manager/technician.php');
require('../model/database_oo.php');
require('../model/technicians_db.php');
require('../model/TechnicianDB.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_technicians';
    }
}

if ($action == 'list_technicians') {
    $technicians = TechnicianDB::getTechnicians();
    include 'technician_list.php';
} else if ($action == 'delete_technician') {
    $tech_id = filter_input(INPUT_POST, 'tech_id');
    if ($tech_id == NULL || $tech_id == FALSE) {
        $error = "Missing or incorrect first name";
        include('../errors/error.php');
    } else { 
        TechnicianDB::deleteTechnician($tech_id);
        $technicians = TechnicianDB::getTechnicians();
        include 'technician_list.php';        
    }
} else if($action == 'add_technician') {
    $first_name = filter_input(INPUT_POST, 'firstName');
    $last_name = filter_input(INPUT_POST, 'lastName');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');    
    if ($first_name == NULL || $last_name == NULL || $phone == NULL || 
            $email == NULL || $password == NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');             
    } else {
        $technician = new Technician($first_name, $last_name, $email, $phone, $password);
        TechnicianDB::addTechnician($technician);
        $technicians = TechnicianDB::getTechnicians();
        include 'technician_list.php';
    }
      
}

?>
