<?php include 'header.php'; ?>

<div class="main">
    <h1>Technician Login</h1>
    <p>You must login before you can update an incident.</p>
    <form action="." method="post">
        <label>Email:</label> 
        <input type="hidden" name="action" value="view_assigned_open_incidents">
        <input type="text" name="email">
        <input type="submit" value="Login">
        <label>&nbsp;</label>
    </form>  
</div>
<?php include 'footer.php'; ?> 


