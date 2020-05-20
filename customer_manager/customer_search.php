<?php include 'header.php';  
?>
 
    <h1>Customer Search</h1>
    
    <label>Last Name:</label>
    <form action="." method="post">
        <input type="hidden" name="action" value="list_customers_by_last_name" />
        <input type="text" name="last_name"/>
        <input type="submit" value="Search"/>
    </form>  
    <form>
    <h1>Add a new customer</h1>
        <input type="hidden" name="action" value="show_add_edit_form">
        <input type="submit" name="submit" value="Add Customer"> 
    </form>
<?php include 'footer.php';  
?>