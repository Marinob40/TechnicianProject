<?php include 'header.php'; ?>
    
<div class="main">
    <h1>Get Customer</h1>
    <p>You must enter the customer's email address to select the customer.</p>
    <form action="." method="post">
        <label>Email:</label> 
        <input type="hidden" name="action" value="list_customer_by_email">
        <input type="text" name="email">
        <input type="submit" value="Get Customer">
        <label>&nbsp;</label>
    </form>  
</div>

<?php include 'footer.php'; ?>  