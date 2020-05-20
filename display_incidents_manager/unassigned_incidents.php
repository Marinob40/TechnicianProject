<?php include 'header.php'; ?>
<div>
    <h1>Unassigned Incidents</h1>
    <a href="index.php?action=view_assigned_incidents">View Assigned Incidents</a>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Incident</th>
        </tr>
        <?php foreach ($incidents as $incident) : ?>
        <tr>
            <td><?php echo $incident['firstName']." ".$incident['lastName']; ?></td>
            <td><?php echo $incident['name']; ?></td>
            <td>
                <p>ID: <?php echo $incident['incidentID']; ?></p>
                <p>Opened: <?php echo $incident['dateOpened']; ?></p>
                <p>Title: <?php echo $incident['title']; ?></p>
                <p>Description: <?php echo $incident['description']; ?></p>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include 'footer.php'; ?>

