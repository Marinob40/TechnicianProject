<?php include 'header.php'; ?>
<div>
    <h1>Assigned Incidents</h1>
    <a href="index.php?action=view_unassigned_incidents">View Unassigned Incidents</a>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Technician</th>
            <th>Incident</th>
        </tr>
        
        <?php foreach ($incidents as $incident) : ?>
        <tr>
            <td><?php echo $incident['customerFirstName']." ".$incident['customerLastName']; ?></td>
            <td><?php echo $incident['name']; ?></td>
            <td><?php echo $incident['techFirstName']." ".$incident['techLastName']; ?></td>
            <td>
                <p>ID: <?php echo $incident['incidentID']; ?></p>
                <p>Opened: <?php $date_opened = $incident['dateOpened'];
                                 $fDateOpened = strtotime($date_opened);
                                 $newFDateOpened = date('m-d-Y', $fDateOpened);
                                 echo $newFDateOpened;?></p>
                <?php
                    if ($incident['dateClosed'] == NULL) {
                        $date_closed = 'OPEN';
                    } else {
                        $date_closed = $incident['dateClosed'];
                        $fDateClosed = strtotime($date_closed);
                        $newFDateClosed = date('m-d-Y', $fDateClosed);
                        $date_closed = $newFDateClosed;
                    }
                ?>
                <p>Closed: <?php echo $date_closed;?></p>
                <p>Title: <?php echo $incident['title']; ?></p>
                <p>Description: <?php echo $incident['description']; ?></p>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include 'footer.php'; ?>

