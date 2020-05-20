<?php require_once('../util/secure_conn.php'); ?>
<?php include 'header.php'; ?>

<h1>Admin Login</h1>
    <main>

        <form action="." method="post">
            <label>Username:</label>
            <input type="text" name="username" size="30"><br>
            <p>&nbsp;</p>
            <label>Password:</label>
            <input type="password" name="password" size="30"><br>

            <input type="hidden" name="action" value="login">
            <input type="submit" value="Login">
                        
            <p><?php echo $login_message; ?></p>
        </form>
    </main>
<?php include 'footer.php'; ?>


