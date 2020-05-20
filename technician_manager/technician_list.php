<?php include 'header.php'; ?>

    <head>
        <title>SportsPro Technical Support</title>
        <link rel="stylesheet" type="text/css" href="/tech_support/main.css">
    </head
    
<div class="main">
    <h1>Technician List</h1>

    <section>
        <table>
            <tr>           
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th> 
                <th>Password</th>                 
                 <th>&nbsp;</th>           
            </tr>
            <?php foreach ($technicians as $technician) : ?>
            <tr>             
                <td><?php echo $technician->getFullName(); ?></td>
                <td><?php echo $technician->getEmail(); ?></td>
                <td><?php echo $technician->getPhone(); ?></td>
                <td><?php echo $technician->getPassword(); ?></td>
                
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="delete_technician">
                    <input type="hidden" name="tech_id"
                           value="<?php echo $technician->getID(); ?>">                    
                    <input type="hidden" name="first_name"
                           value="<?php echo $technician->getFirstName(); ?>">
                    <input type="hidden" name="last_name"
                           value="<?php echo $technician->getLastName(); ?>">
                    <input type="hidden" name="email"
                           value="<?php echo $technician->getEmail(); ?>">    
                    <input type="hidden" name="phone"
                           value="<?php echo $technician->getPhone(); ?>">
                    <input type="hidden" name="password"
                           value="<?php echo $technician->getPassword(); ?>">                   
                    <input type="submit" value="Delete">
                </form></td>                
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="technician_add.php">Add Technician</a></p>
    </section>
</div>
<?php include 'footer.php'; ?>