<?php include 'header.php'; ?>

    <h1>Update Incident</h1
        <div>
            <form action="." method="post">
            <?php foreach ($incidents as $incident) : ?>
                <p>Incident ID: <?php echo $incident['incidentID']; ?></p>
                <p>Product Code: <?php echo $incident['productCode']; ?></p>
                <p>Date Opened: <?php $date_opened = $incident['dateOpened'];
                                      $formattedDateOpened = strtotime($date_opened);
                                      $newFormattedDateClosed = date('m-d-Y', $formattedDateOpened);
                                      echo $newFormattedDateClosed?></p>
                <p>Date Closed: <input type="text" name="date_closed" value="<?php echo $incident['dateClosed']; ?>"</p>
                <p>Title: <?php echo $incident['title']; ?></p>
                <p>Description: <textarea name="description" rows="4" cols="50"><?php echo $incident['description']; ?></textarea></p>
                <input type="submit" value="Update Incident">
                <input type="hidden" name='action' value='update_incident'>
            <?php endforeach; ?>
            </form>
                <p>You are logged in as <?php echo $_SESSION['email']; ?></p>
            <form>
                <input type="submit" value="Logout">
                <input type="hidden" name='action' value='logout'>
            </form>                                 
        </div>
<?php include 'footer.php'; ?>