<?php include 'header.php';

    $link = mysqli_connect("localhost", "root", "");
    $password = "";
    $usertable = "countries";
    $columnname = "countryName";
    mysqli_select_db($link, "tech_support");
    $query = "SELECT * FROM countries";
    $result = mysqli_query($link, $query);
?>


<div id= "main">
    <?php
    if (isset($email)) {
        $submit_button_text = 'Update Customer';
        $action = 'update_customer_by_id';
    } else {
        $submit_button_text = 'Add Customer';
        $action = 'add_customer';
    }
    ?>
    <h1>
        Add/Update Customer
    </h1>
    <form action="." method="post" id="add_edit_customer_form">
        <?php if (isset($customer_id)) : ?>
            <input type="hidden" name="action" value="update_customer_by_id">
            <input type="hidden" name="customerID" value="<?php echo $customer['0']['customerID']; ?>">
        <?php else: ?>
            <input type="hidden" name="action" value="add_customer">
        <?php endif; ?>
        <fieldset>
            <tr>
                 <td>
                     <input type="hidden" name="customerID" value="<?php echo $customer['0']['customerID']; ?>">                     
                 </td><br>
            </tr> 
             <tr>
                 <td><label>First Name:</label></td>
                 <td><input type="text" name="firstName" value="<?php echo $customer['0']['firstName']; ?>"></td>
                 <?php echo $fields->getField('firstName')->getHTML(); ?><br>
             <br>
            </tr>
            <tr>
                <td><label>Last Name:</label></td>
                <td><input type="text" name="lastName" value="<?php echo $customer['0']['lastName']; ?>"></td>
                <?php echo $fields->getField('lastName')->getHTML(); ?><br>
            <br>
            </tr>
            <tr>
                <td><label>Address:</label></td>
                <td><input type="text" name="address" value="<?php echo $customer['0']['address']; ?>"></td>
                <?php echo $fields->getField('address')->getHTML(); ?><br>
            <br>
            </tr>
            <tr>
                <td><label>City:</label></td>
                <td><input type="text" name="city" value="<?php echo $customer['0']['city']; ?>"></td>
                <?php echo $fields->getField('city')->getHTML(); ?><br>
            <br>
            </tr>
            <tr>
                <td><label>State:</label></td>
                <td><input type="text" name="state" value="<?php echo $customer['0']['state']; ?>"></td>
                <?php echo $fields->getField('state')->getHTML(); ?><br>
            <br>
            </tr> 
            <tr>
                <td><label>Postal Code:</label></td>
                 <td><input type="text" name="postalCode" value="<?php echo $customer['0']['postalCode']; ?>"></td>
                 <?php echo $fields->getField('postalCode')->getHTML(); ?><br>
            <br>
            </tr>
            <tr>
                <td><label>Country</label></td>
                <td>
                    <select name="countryCode">
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            $countryName = $row['countryName']; 
                        }
                        ?>    
                        <option><?php echo $countryName; ?></option>
                    </select>
                </td>   
            <br>
            </tr>
            <tr>
                <td><label>Phone:</label></td>
                 <td><input type="text" name="phone" value="<?php echo $customer['0']['phone']; ?>"></td>
                 <?php echo $fields->getField('phone')->getHTML(); ?><br>
            <br>
            </tr>  
            <tr>
                <td><label>Email:</label></td>
                <td><input type="text" name="email" value="<?php echo $customer['0']['email']; ?>"></td>
                <?php echo $fields->getField('email')->getHTML(); ?><br>
            <br>
            </tr>
            <tr>
                <td><label>Password:</label></td>
                 <td><input type="text" name="password" value="<?php echo $customer['0']['password']; ?>"></td>
                 <?php echo $fields->getField('password')->getHTML(); ?><br>
            <br>
            </tr>
            <label>&nbsp;</label>
            <tr>
                <td>
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input type="submit" name="submit" value="<?php echo $submit_button_text; ?>">
                </td>    
            </tr> 
        </fieldset>    
    </form>   
    <p class="last_paragraph">
        <a href="index.php?action=customer_search">Search Customers</a>
    </p>
</div>

<?php include 'footer.php'; ?>