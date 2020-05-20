<?php include 'header.php';  
?>
    <table>
        <tr>
            <th>Name</th>
            <th>Email Address</th>
            <th>City</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($customers as $customer) : ?>   
        <tr>
            <td><?php echo $customer['firstName']." ".$customer[ 'lastName']; ?></td>
            <td><?php echo $customer['email']; ?></td>
            <td><?php echo $customer['city']; ?></td>
            <td>
                <form action="." method="post">
                    <input type="hidden" name="action" value="show_add_edit_form">
                    <input type="hidden" name="email" value="<?php echo $customer['email']; ?>">
                    <input type="submit" value="Select">
                    <input type="hidden" name="countryCode"
                           value="<?php echo $customer['countryCode']; ?>">
                </form>                
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php include 'footer.php';  
?>
