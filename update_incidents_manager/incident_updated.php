<?php include 'header.php'; ?>
<div>
    <h1>Update Incident</h1>
    <p>This incident was updated.</p>
    <a href="index.php?action=view_assigned_open_incidents">Select Another Incident</a>
    <p>You are logged in as <?php echo $_SESSION['email']; ?></p>
    <form>
        <input type="submit" value="Logout">
        <input type="hidden" name='action' value='logout'>
    </form>
</div>
<?php include 'footer.php'; ?>

