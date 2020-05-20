<?php
require('../model/database.php');
require('../model/customers_db.php');
require('../model/incidents_db.php');
require('../model/technicians_db.php');


session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'display_unassigned_incidents';
    }
}

switch ($action) {
    case 'display_unassigned_incidents';
        $incidents = get_unassigned_incidents_by_customer();
        include 'select_incident.php';
        break;
    case 'select_incident';
        $incidents = get_first_name_last_name_open_incidents_by_technician();
        $_SESSION['incidentID'] = filter_input(INPUT_POST, 'incident_id');
        include 'select_technician.php';
        break;
    case 'select_technician'; 
        $incident_id = $_SESSION['incidentID'];
        $incidents = get_technician_and_customer_and_product_code_by_incident($incident_id);        
        $_SESSION['techID'] = filter_input(INPUT_POST, 'tech_id');
        $tech_id = $_SESSION['techID'];
        $technicians = get_technician_by_id($tech_id);
        include 'assign_incident.php'; 
        break;
    case 'assign_incident':
        $tech_id = $_SESSION['techID'];
        $incident_id = $_SESSION['incidentID'];
        update_incident_by_tech_id_and_incident_id($tech_id, $incident_id);
        include 'assigned.php';
        break;
    default:
        break;
}
?>