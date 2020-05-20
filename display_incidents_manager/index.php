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
        $action = 'view_unassigned_incidents';
    }
}

switch ($action) {
    case 'view_unassigned_incidents':
        $incidents = get_unassigned_incidents();
        include 'unassigned_incidents.php';
        break;
    case 'view_assigned_incidents':
        $incidents = get_assigned_incidents();
        include 'assigned_incidents.php';
    default:
        break;
}

?>