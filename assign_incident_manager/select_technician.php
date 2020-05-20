<?php include 'header.php'; ?>

<h1>Select Technician</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Open Incidents</th>
        <th></th>
    </tr>
    <?php foreach ($incidents as $incident) : ?>
    <tr>
        <td><?php echo $incident['firstName']." ".$incident['lastName']; ?></td>
        <td><?php echo $incident['openIncidents']; ?></td>
        <td>
            <form action="." method="post">
                <input type="submit" value="Select">
                <input type="hidden" name="action" value="select_technician">
                <input type="hidden" name="tech_id"
                           value="<?php echo $incident['techID']; ?>">                   
            </form>                
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>