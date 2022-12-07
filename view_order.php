<?php 
    session_start();
    require_once "./functions/getters.php"; 
    require_once "./functions/utils.php"; 

    if(!isset($_SESSION["customer"])){
        header("Location: ./login.php");
    }
    if(!isset($_GET["order_id"])){
        header("Location: ./my_orders.php");
    }

    $order = getOrderById($_GET["order_id"]);
    $product = getProduct($order["product_id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/view_order.css">
    <title>View Order</title>
</head>
<body>
    <?php include "./includes/topbar.php"; ?>

    <div class="view_order_con">
        <img src="./product_img/<?php echo $product["image"]; ?>" alt="">

        <section class="order_info">
            <h2><?php echo $product["name"]; ?></h2>
            <p>Price: <b>₱ <?php echo $product["price"]; ?></b> </p>
            <p>Quantity: <?php echo $order["quantity"]; ?></p>
            <p>Order Amount: <b>₱ <?php echo number_format($order["order_amount"]); ?></b> </p>
            <p>Shipping Fee: <b>₱ <?php echo $order["shipping_fee"]; ?></b> </p>
            <p>Payment Method: <?php echo strtoupper($order["payment_method"]); ?></p>
            <p>Payment Status: 
                <?php echo $order["is_paid"] ? 
                    "<span style='color:green;'>Paid<span>" 
                : 
                    "<span style='color:red;'>Unpaid<span>";
                ?>
            </p>

            <h3>Delivery Status: </h3>
            <div class="order_tracker">
                <div class="circle
                    <?php 
                        if( $order["delivery_status"] == "On Process" || 
                            $order["delivery_status"] == "Packed" ||
                            $order["delivery_status"] == "Shipped" ||
                            $order["delivery_status"] == "Delivered"
                        ){
                            echo "active_tracker";
                        }
                    ?>
                ">
                    <span>On Process</span>
                </div>
                <div class="line 
                    <?php 
                        if( $order["delivery_status"] == "Packed" ||
                            $order["delivery_status"] == "Shipped" ||
                            $order["delivery_status"] == "Delivered"
                        ){
                            echo "active_tracker";
                        }
                    ?>
                "></div>
                <div class="circle
                    <?php 
                        if( $order["delivery_status"] == "Packed" ||
                            $order["delivery_status"] == "Shipped" ||
                            $order["delivery_status"] == "Delivered"
                        ){
                            echo "active_tracker";
                        }
                    ?>
                ">
                    <span>Packed</span>
                </div>
                <div class="line
                    <?php 
                        if( $order["delivery_status"] == "Shipped" ||
                            $order["delivery_status"] == "Delivered"
                        ){
                            echo "active_tracker";
                        }
                    ?>
                "></div>
                <div class="circle
                    <?php 
                        if( $order["delivery_status"] == "Shipped" ||
                            $order["delivery_status"] == "Delivered"
                        ){
                            echo "active_tracker";
                        }
                    ?>
                ">
                    <span>Shipped</span>
                </div>
                <div class="line
                    <?php 
                        if( $order["delivery_status"] == "Delivered"){
                            echo "active_tracker";
                        }
                    ?>
                "></div>
                <div class="circle
                    <?php 
                        if( $order["delivery_status"] == "Delivered"){
                            echo "active_tracker";
                        }
                    ?>
                ">
                    <span>Delivered</span>
                </div>
            </div>
        </section>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>
