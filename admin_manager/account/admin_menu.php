<?php include 'header.php'; ?>

<div class="main">
    <h2>Admin Menu</h2>
     <ul class="nav">
        <li><a href="../product_manager">Manage Products</a></li>
        <li><a href="../technician_manager">Manage Technicians</a></li>
        <li><a href="../customer_manager">Manage Customers</a></li>
        <li><a href="../incident_manager">Create Incident</a></li>
        <li><a href="../assign_incident_manager">Assign Incident</a></li>
        <li><a href="../display_incidents_manager">Display Incidents</a></li>
    </ul>  
    <h2>Login Status</h2>
    <p>You are logged in as <?php echo $_SESSION['username']; ?></p>
    <form action="." method="post">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
</div>



<?php include 'footer.php'; ?>

