<?php include 'header.php';?>


<div id= "main">
    <h1>
        Add Product
    </h1>
    <form action="../product_manager/index.php" method="post"
              id="add_product_form">
        <input type="hidden" name="action" value="add_product">

         <table id="no_border">
             <tr>
                 <td><label>Code:</label></td>
                 <td><input type="text" name="productCode"required></td><br>
            </tr>
            <tr>
                <td><label>Name:</label></td>
                <td><input type="text" name="name"required></td><br>
            </tr>
            <tr>
                <td><label>Version:</label></td>
                <td><input type="text" name="version"required></td><br>
            </tr>
            <tr>
                <td><label>Release Date:</label></td>
                <td><input type="text" name="releaseDate"required></td>
            <td><p>Use any valid date format</p></td>
            </tr>
            <label>&nbsp;</label>
            <tr>
                <td><input type="submit" value="Add Product"></td>           
            </tr>
        </form>
    </table>
    <p class="last_paragraph">
        <a href="index.php?action=list_products" >View Product List</a>
    </p>
</div>

<?php include 'footer.php'; ?>