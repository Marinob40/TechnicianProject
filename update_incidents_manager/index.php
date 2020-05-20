<?php
require('../model/database.php');
require('../model/customers_db.php');
require('../model/incidents_db.php');
require('../model/technicians_db.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL && !isset($_SESSION['email'])) {
        $action = 'technician_login';
    }
}

switch ($action) {
    case 'technician_login':
        include 'technician_login.php';
        break;
    case 'view_assigned_open_incidents';
        $email = filter_input(INPUT_POST, 'email');
        if ($email == NULL && !isset($_POST['email'])) {
            $email = $_SESSION['email'];
        }
        $incidents = get_open_and_assigned_incidents_by_tech_email($email);
        $_SESSION['email'] = $email;
        include 'select_incident.php';
        break;
    case 'select_incident';
        $_SESSION['incidentID'] = filter_input(INPUT_POST, 'incident_id');
        $incident_id = filter_input(INPUT_POST, 'incident_id');
        $incidents = get_incident_by_incident_id($incident_id);
        include 'update_incident.php';
        break;
    case 'update_incident';       
        $dateClosedBeforeFormat = filter_input(INPUT_POST, 'date_closed');
        $formattedDateClosed = strtotime($dateClosedBeforeFormat);
        $date_closed_for_database = date('Y-m-d H:i:s', $formattedDateClosed);
        $date_closed = $date_closed_for_database;
        $description = filter_input(INPUT_POST, 'description');
        $incident_id = $_SESSION['incidentID'];
        update_incident_by_incident_id($incident_id, $date_closed, $description);
        include 'incident_updated.php';
        break;
    case 'logout';
        unset($_SESSION['email']);
        unset($_SESSION['incidentID']);
        session_destroy();
        include 'technician_login.php';
        break;
    case 'refresh_view_assigned_open_incidents':
        $email = $_SESSION['email'];
        $incidents = get_open_and_assigned_incidents_by_tech_email($email);       
        header("Location: select_incident.php");        
    default:
        break;
}


