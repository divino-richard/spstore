<?php
require_once("dbh.php");

function deleteProduct($product_id){
    $mysqli = mysqli_connection(); // GETTING THE CNNECTION FROM THE DATABASE HANDLER (dbh.php)
    $sql = "UPDATE products SET is_active='0' WHERE product_id='$product_id' ";
    if($mysqli->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}