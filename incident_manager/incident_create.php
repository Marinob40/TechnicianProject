<?php include 'header.php'; 

$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "tech_support");

?>

<h1>Create Incident</h1>
<div>
    <form method="post" action=".">
        <?php foreach ($customers as $customer) : ?>
        <p>
            Customer:&nbsp;<label><?php echo $customer['firstName']." ".$customer['lastName']; ?></label> 
            <input type="hidden" name="customer_id" value="<?php echo $customer['customerID']; ?>"
        </p>
        <?php endforeach; ?>
        <p>
            <label>Product</label>
            <select name="products">
            <?php 
               $customer_id = $customer['customerID'];
               $res = mysqli_query($link, "SELECT * FROM registrations WHERE customerID = $customer_id");
               while($row = mysqli_fetch_array($res))
               {
               ?>              
               <option><?php echo $row['productCode']; ?></option>
               
               <?php 
               }
               ?>
            </select>
        </p>
        <p>
            <label>Title:</label>
            <input type="text" name="title">
        </p>
        <p>
            <label>Description:</label>
            <textarea name="description"></textarea>
        </p>
        <p>
            <label>&nbsp;</label>
            <input type="hidden" name="action" value="add_incident">
            <input type="submit" name="submit" value="Create Incident" />    
        </p>
    </form>    
</div>
<?php include 'footer.php'; ?> 
