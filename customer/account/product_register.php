<?php 
include 'header.php';

$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "tech_support");

?>

        <h1>Register Product</h1> 
        <p>
            <?php foreach ($customers as $customer) : ?>
            Customer:&nbsp;<label><?php echo $customer['firstName']." ".$customer['lastName']; ?></label> 
            <?php endforeach; ?>
        </p>
        <p>
           
        <form method="post" action="account/product_registered.php">    
           <p>  
               <label>Product:</label>
               <select name="product">   
                <?php 
                $res = mysqli_query($link, "SELECT * FROM products");
                while($row = mysqli_fetch_array($res))
                {
                ?>              
                <option><?php echo $row["name"]; ?></option>

                <?php 
                }

                ?>
               </select>
           </p>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="submit" name="register product" value="Register Product" />
        </form>
        <p>You are logged in as <?php echo $_SESSION['email']; ?></p>
        <form action="." method="post">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Logout">           
        </form>
        </p>
        
<?php include 'footer.php'; ?>    
