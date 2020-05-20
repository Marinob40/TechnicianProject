<?php include 'header.php'; ?>

<div class="main">
    <?php if (count($incidents) == 0) : ?>
        <p>There are no open incidents for this technician.</p>
        <a href="index.php?action=view_assigned_open_incidents">Refresh List of Incidents</a>
        <?php foreach ($incidents as $incident) : ?>
            <p>You are logged in as <?php echo $incident['email']; ?></p>
        <?php endforeach; ?>
    <?php else: ?>
    <h1>Select Incident</h1>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Date Opened</th>
            <th>Title</th>
            <th>Description</th>
            <th></th>
        </tr>
        <?php foreach ($incidents as $incident) : ?>
        <tr>
            <td><?php echo $incident['customerFirstName']." ".$incident['customerLastName']; ?></td>
            <td><?php echo $incident['productCode']; ?></td>
            <td><?php echo $incident['dateOpened']; ?></td>
            <td><?php echo $incident['title']; ?></td>
            <td><?php echo $incident['description']; ?></td>
            <td>
                <form action='.' method="post">
                    <input type="submit" value="Select">
                    <input type="hidden" name='action' value='select_incident'>
                    <input type="hidden" name='incident_id' value="<?php echo $incident['incidentID']; ?>">
                </form>
            </td>
        </tr>  
        <?php endforeach; ?>
    </table>
    <p>You are logged in as <?php echo $_SESSION['email']; ?></p>
    <form>
        <input type="submit" value="Logout">
        <input type="hidden" name='action' value='logout'>
    </form>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?> 

