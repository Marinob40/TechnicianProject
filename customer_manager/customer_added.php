<?php include 'header.php'; 

$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];

?>
    

<div class="main">
    <p><?php echo $first_name . " ". $last_name; ?> has been added successfully.</p>  
</div>

<?php include 'footer.php'; ?> 