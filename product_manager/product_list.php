<?php include 'header.php'; ?>

    
<div class="main">
    <h1>Product List</h1>

    <section>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th> 
                 <th>&nbsp;</th>           
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['version']; ?></td>
                <td><?php $releaseDate = $product['releaseDate']; 
                          $formattedReleaseDate = strtotime($releaseDate);
                          $newFormattedReleaseDate = date('m-d-Y', $formattedReleaseDate);
                          echo $newFormattedReleaseDate;?></td>
                
                <td><form action="." method="post">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" name="product_code"
                           value="<?php echo $product['productCode']; ?>">
                    <input type="hidden" name="product_name"
                           value="<?php echo $product['name']; ?>">    
                    <input type="hidden" name="product_version"
                           value="<?php echo $product['version']; ?>"> 
                    <input type="hidden" name="product_release_date"
                           value="<?php echo $product['releaseDate']; ?>">                      
                    <input type="submit" value="Delete">
                </form></td>                
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="product_add.php">Add Product</a></p>
    </section>
</div>
<?php include 'footer.php'; ?>