<?php 
    session_start();
    require_once "./functions/getters.php"; 
    require_once "./functions/utils.php"; 

    if(!isset($_SESSION["customer"])){
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/my_orders.css">
    <title>Home</title>
</head>
<body>
    <?php include "./includes/topbar.php"; ?>

    <div class="my_orders_con">
        <h2>My Orders</h2>
        <?php
            $my_orders = getCustomerOrders($_SESSION["customer"]["customer_id"]);
            if($my_orders->num_rows > 0){

                while($order = $my_orders->fetch_assoc()){
                    $product = getProduct($order["product_id"]);

                    $pay_status = $order["is_paid"] ? "Paid" : "Not Paid";

                    echo '
                    <a href="./view_order.php?order_id='.$order["order_id"].'" class="order_item">
                        <img src="./product_img/'.$product["image"].'" alt="">
                        <p>'.$product["name"].'</p>
                        <p>₱ '.number_format($order["order_amount"]).'</p>
                        <p>'.$pay_status.'</p>
                        <p>'.$order["order_date"].'</p>
                    </a>
                    ';
                }
            }else{
                echo "You have no order yet";
            }
        ?>
    </div>

</body>
</html>
