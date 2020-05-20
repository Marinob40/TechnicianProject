<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/customers_db.php');

session_start();



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products';
        $product_code = filter_input(INPUT_GET, 'product_code', 
            FILTER_VALIDATE_INT);
        $products = get_products();
        include 'product_list.php';
        break;
    case 'delete_product';
        $product_code = filter_input(INPUT_POST, 'product_code');
        if ($product_code == NULL || $product_code == FALSE) {
        $error = "Missing or incorrect product id";
        include('../errors/error.php');
        } else { 
            delete_product($product_code);
            $products = get_products();
            include 'product_list.php';
        }
        break;
    case 'add_product';
        $product_code = filter_input(INPUT_POST, 'productCode');
        $name = filter_input(INPUT_POST, 'name');
        $version = filter_input(INPUT_POST, 'version');
        $releaseDateBeforeFormat = filter_input(INPUT_POST, 'releaseDate');
        $formattedReleaseDate = strtotime($releaseDateBeforeFormat);
        $release_date_for_database = date('Y-m-d H:i:s', $formattedReleaseDate);
        $release_date = $release_date_for_database;
        if ($product_code == NULL || $name == NULL || $version == NULL || 
            $release_date == NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');             
        } else {
            add_product($product_code, $name, $version, $release_date);
            $products = get_products();
            include 'product_list.php';
        }
        break;
}