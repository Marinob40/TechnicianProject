<?php include 'header.php'; ?>

<h1>Assign Incident</h1>
    <?php foreach ($incidents as $incident) : ?>
        <p>Customer: <?php echo $incident['customerFirstName']." ".$incident['customerLastName']; ?></p>
        <p>Product:    <?php echo $incident['productCode']; ?></p>
    <?php endforeach; ?>
    <?php foreach ($technicians as $technician) : ?>        
        <p>Technician: <?php echo $technician['firstName']." ".$technician['lastName']; ?></p>        
    <?php endforeach; ?>
        <form action="." method="post">
            <input type="submit" value="Assign Incident">
                <input type="hidden" name="action" value="assign_incident">
        </form>
<?php include 'footer.php'; ?>