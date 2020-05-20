<?php include 'header.php';?>


<div id= "main">
    <h1>
        Add Technician
    </h1>
    <form action="." method="post"
              id="add_technician_form">
        <input type="hidden" name="action" value="add_product">

         <table id="no_border">
             <tr>
                 <td><label>First Name:</label></td>
                 <td><input type="text" name="firstName"required></td><br>
            </tr>
            <tr>
                <td><label>Last Name:</label></td>
                <td><input type="text" name="lastName"required></td><br>
            </tr>
            <tr>
                <td><label>Email:</label></td>
                <td><input type="text" name="email"required></td><br>
            </tr>
            <tr>
                <td><label>Phone:</label></td>
                <td><input type="text" name="phone"required></td>
            </tr>
            <tr>
                <td><label>Password:</label></td>
                <td><input type="text" name="password"required></td>
            </tr>            
            <label>&nbsp;</label>
            <tr>
                <td>
                    <input type="submit" value="Add Technician">
                    <input type="hidden" name="action" value="add_technician">
                </td>           
            </tr>
        </form>
    </table>
    <p class="last_paragraph">
        <a href="index.php?action=list_technicians" >View Technician List</a>
    </p>
</div>

<?php include 'footer.php'; ?>
