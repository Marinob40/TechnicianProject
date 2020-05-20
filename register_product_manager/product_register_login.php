<?php include 'header.php'; ?>
    
<div class="main">

    <h1>Customer Login</h1>
    
    <form action="." method="post"> 
        <p>You must login before you can register a product.</p>
            <p>
                <label>Email:</label>                
                <input type="hidden" name="action" value="view_customer">
                <input type="text" name="email" />
                <input type="submit" value="Login" name="login" id="btn" />
            </p>
    </form>
</div>
    
<?php include 'footer.php'; ?>    
