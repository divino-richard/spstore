<?php 
    session_start();
    require_once "./functions/getters.php"; 
    require_once "./functions/setters.php"; 
    require_once "./functions/utils.php"; 
    
    if(!isset($_GET["product_id"])){
        header("Location: ./index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/view_product.css">
    <title>Place Order</title>
</head>
<body>
    <!-- INCLUDE THE HEADER FILE  -->
    <?php include_once "./includes/topbar.php" ?>

    <div class="product_con">
        <?php
            $product = getProduct($_GET["product_id"]);
        ?>

        <img src="./product_img/<?php echo $product["image"]; ?>" alt="">
        <section class="product_details">
            <h2><?php echo $product["name"]; ?></h2>
            <p>Brand: <?php echo $product["brand"]; ?></p>
            <p>Category: <?php echo ucwords($product["category"]); ?></p>
            <p>Description: <?php echo $product["description"]; ?></p>
            <p>Price: ₱ <b><?php echo number_format($product["price"], 2); ?></b></p>
            <a class="order_btn" href="./place_order.php?product_id=<?php echo $product["product_id"]; ?>"> Order Now </a>
        </section>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>
