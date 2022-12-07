<?php 
    session_start();
    require_once "./functions/getters.php"; 
    require_once "./functions/setters.php"; 
    require_once "./functions/utils.php"; 
    
    if(!isset($_GET["product_id"])){
        header("Location: ./index.php");
        exit();
    }

    if(!isset($_SESSION["customer"])){
        header("Location: ./login.php");
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
    <link rel="stylesheet" href="./css/place_order.css">
    <title>Place Order</title>
</head>
<body>
    <!-- INCLUDE THE HEADER FILE  -->
    <?php include_once "./includes/topbar.php" ?>

    <div class="order_con">
        <?php
            $product = getProduct($_GET["product_id"]);
            $shipping_fee = 120;
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                // Process the order and send it to the database
                setOrder($product["product_id"], $product["employee_id"]);
            }
        ?>

        <img src="./product_img/<?php echo $product["image"]; ?>" alt="">
        <section class="product_details">
            <h2><?php echo $product["name"]; ?></h2>
            <p>Price: ₱ <b><?php echo number_format($product["price"], 2); ?></b></p>
            
            <form class="order_form" action="" method="POST">
                <input type="number" name="quantity" onkeyup="automateAmount(this, <?php echo $product['price']; ?>)" placeholder="Quantity" min="1" required>
                <input type="hidden" name="shipping_fee" value="<?php echo $shipping_fee; ?>" id="shipping_fee" required>
                <input type="hidden" name="order_amount" id="order_amount" min="1" required>

                <div class="subtotal">
                    <p>Subtotal: ₱ <b id="subtotal"></b></p>
                    <p>Shipping Fee: ₱ <b><?php echo number_format($shipping_fee); ?></b></p>
                    <p>Order Amount: ₱ <b id="order_amount_viewer"></b></p>
                </div>

                <select class="payment_select" name="payment_method" required>
                    <option value="">-- Select Payment Method --</option>
                    <option value="cod">Cash On Delivery</option>
                    <option value="online_payment">Online Payment</option>
                </select>
                
                <input type="submit" class="place_oreder_btn" value="Place Order">
            </form>
        </section>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>
