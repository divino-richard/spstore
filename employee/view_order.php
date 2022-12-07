<?php
    require_once "../functions/getters.php";

    // Check if id in the url pharameter doesn't is exist then redirect
    if(!isset($_GET["order_id"])){
        header("Location: ./orders.php");
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
    <link rel="stylesheet" href="./css/view_order.css">
    <title>Order Details</title>
</head>
<body>

    <?php include "./inc/sidebar.php" ?>

    <div class="container">
        <?php include "./inc/topbar.php" ?>

        <?php
            if(!isset($_SESSION["employee"])){
                header("Location: ./login.php");
                exit();
            }
            
            // Get the order data
            $order = getOrderById($_GET["order_id"]);
            // Get the list of products
            $product = getProduct($order["product_id"]);
            // Get the list of products
            $customer = getCustomerById($order["customer_id"]);
            // Get the list of products
            $seller = getCustomerById($order["customer_id"]);
        ?>
        
        <div class="order_con">
            <img src="../product_img/<?php echo $product["image"] ?>" alt="">

            <div class="order_info">
                <section>
                    <h2><?php echo  $product["name"]; ?></h2>
                    <p>Brand: <?php echo  $product["brand"]; ?></p>
                    <p>Category: <?php echo  $product["category"]; ?></p>
                    <p>Description: <?php echo $product["description"]; ?></p>
                    <p>
                        Price: 
                        <b>₱ <?php echo number_format($product["price"]); ?></b>
                    </p>
                    <p>
                        Import price: 
                        <b>₱ <?php echo number_format($product["import_price"]); ?></b>
                    </p>
                    <p>Quantity in the stock: <?php echo  $product["qty_in_stock"]; ?></p>
                    <?php 
                        echo $product["is_out_of_stock"] ?
                            '<p style="background-color:#a72b2b; padding:5px; color:#FFF;">OUT OF STACK</p>' :
                        '';
                    ?>
                    
                    <!-- TODO stack info -->
                </section>
                <section>
                    <h3>Order Details</h3>
                    <p>Payment method: <?php echo $order["payment_method"]; ?></p>
                    <p>Quntity: <?php echo $order["quantity"];?></p>
                    <p>
                        Order amount: 
                        <b>₱ <?php echo number_format($order["order_amount"]); ?></b>
                    </b>
                    <p>
                        Shipping fee: 
                        <b>₱ <?php echo number_format($order["shipping_fee"]); ?></b>
                    </p>
                    <p>Delivery status: <?php echo $order["delivery_status"]; ?></p>
                    <p>Payment status: <?php echo $order["is_paid"] ? "Paid" : "Unpaid"; ?></p>
                    <p>Order date: <?php echo date_format(date_create($order["order_date"]),"M j, Y "); ?></p>
                </section>
                <section>
                    <h3>Customer Information</h3>
                    <p>Name: <?php echo $customer["fname"].' '.$customer["lname"]; ?></p>
                    <p>E-mail: <?php echo $customer["email"]; ?></p>
                    <p>Address: <?php echo $customer["address"]; ?></p>
                    <p>Phone number: +63<?php echo $customer["phonenumber"]; ?></p>
                </section>

                <?php
                # ONLY SHOW THE SELLER INFO IF THE POSITION WHO VIEW THE ORDER IS AN ADMIN
                if($_SESSION["employee"]["position"] === "admin"){
                    ?>
                    <section>
                        <h3>Seller Information</h3>
                        <p>Name: <?php echo $seller["fname"].' '.$seller["lname"]; ?></p>
                        <p>E-mail: <?php echo $seller["email"]; ?></p>
                        <p>Address: <?php echo $seller["address"]; ?></p>
                        <p>Phone number: +63<?php echo $seller["phonenumber"]; ?></p>
                    </section>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>