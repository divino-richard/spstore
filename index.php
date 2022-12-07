<?php 
    session_start();
    require_once "./functions/getters.php"; 
    require_once "./functions/utils.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Home</title>
</head>
<body>
    <!--  TOP BAR HERE  -->
    <?php include_once "./includes/topbar.php" ?>

    <div class="banner_container">
        <img src="./images/banner.png" alt="">
        <div class="banner_text">
            <span>Hi There!</span>
            <h1>Welcome to SP Store</h1>
            <h2>SP Store is about to sell you a smartphone that plays to the next level.</h2>
            <button class="smartphone_btn" onclick="scrollIntoProduct();">Smartphones</button>
        </div>
    </div>
    <img style="width:100%;" src="./wave.svg" alt="">

    <section class="product_section">
        <h1>Products</h1>
        <div class="products_container">
            <?php
                // Get all the available products
                $products = getProducts(); // Will return a mysqli object
                if($products->num_rows > 0){
                    while($product = mysqli_fetch_assoc($products)){
                        echo '
                        <div class="product">
                            <a href="./view_product.php?product_id='.$product["product_id"].' ">
                                <img class="product_image" src="./product_img/'.$product["image"].' " alt="product">
                            </a>
                            <div class="product_details">
                                <span>'.$product["name"].'</span><br>
                                <span class="product_price">₱ '.number_format($product["price"]).'</span>
                            </div>
                            <a class="buy_btn" href="./view_product.php?product_id='.$product["product_id"].'"> Buy Now </a>
                        </div>
                        ';
                    }
                }else{
                    echo showMessage("No Items For Now", "INFO");
                }
            ?>
        </div>
    </section>

    <script src="./js/script.js"></script>
</body>
</html>
