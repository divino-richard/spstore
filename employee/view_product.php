<?php
    require_once "../functions/getters.php";

    // Check if id in the url pharameter doesn't is exist then redirect
    if(!isset($_GET["product_id"])){
        header("Location: ./products.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/topbar.css">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/view_product.css">

    <title>Product Details</title>
</head>
<body>

    <?php include "./inc/sidebar.php" ?>

    <div class="container">
        <?php include "./inc/topbar.php" ?>

        <?php
            // Get the list of products
            $product = getProduct($_GET["product_id"]); // Will return a mysqli object
        ?>
        
        <div class="product_con">
            <img src="../product_img/<?php echo $product["image"] ?>" alt="">
            <div class="product_info">
                <h2><?php echo  $product["name"]; ?></h2>
                <p>Brand: <?php echo  $product["brand"]; ?></p>
                <p>Category: <?php echo  $product["category"]; ?></p>
                <p>Description: <?php echo $product["description"]; ?></p>
                <p>
                    Price:₱
                    <b><?php echo number_format($product["price"]); ?></b>
                </p>
                <p>
                    Import price: ₱
                    <b><?php echo number_format($product["import_price"]); ?></b>
                </p>
                <p>Quantity in the stock: <?php echo  $product["qty_in_stock"]; ?></p>
                <?php 
                    echo $product["is_out_of_stock"] ?
                        '<p style="background-color:#a72b2b; padding:5px; color:#FFF;">OUT OF STACK</p>' :
                    '';
                ?>
            </div>
        </div>
    </div>
</body>
</html>