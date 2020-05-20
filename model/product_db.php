<?php
function get_products() {
    global $db;
    $query = 'SELECT * FROM products
              ORDER BY productCode';
    $result = $db->query($query); 
    if ($result == FALSE) {
        display_db_error($db->error);
    }
    $products = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $product = $result->fetch_assoc();
        $products[] = $product;
    }
    $result->free();
    return $products;
}

function delete_product($product_code) {
    global $db;
    $query = "DELETE FROM products
              WHERE productCode = ?";
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("s", $product_code);
    $statement->execute();
    $statement->close();
}

function add_product($product_code, $name, $version, $release_date) {
    global $db;
    $query = 'INSERT INTO products
                 (productCode, name, version, releaseDate)
              VALUES
                 (?, ?, ?, ?)';
    $statement = $db->prepare($query);
    if ($statement == FALSE) {
        display_db_error($db->error);
    }
    $statement->bind_param("ssss", $product_code, $name, $version, $release_date);
    $statement->execute();    
    $statement->close(); ;
}

?>