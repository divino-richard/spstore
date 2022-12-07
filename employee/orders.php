<?php
    require_once "../functions/getters.php";
    require_once "../functions/utils.php";
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
    <link rel="stylesheet" href="./css/orders.css">
    <title>Orders</title>
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

            /**
             * Check if the employee is an admin then get all the ordres
             * Otherwise get the orders according to the employee id
             */
            if($_SESSION["employee"]["position"] == "admin"){
                // Get the list of orders
                $orders = getAllOrders(); // Will return a mysqli object

            }else if($_SESSION["employee"]["position"] == "seller"){
                // GET SELLER'S ORDERS
                $orders = getSellerOrders($_SESSION["employee"]["employee_id"]);
            }
        ?>

        <div class="table_container">
            <div class="table_top_info">
                <h4>List of Orders</h4>
                <h4>Total Orders: <?php echo $orders->num_rows; ?></h4>
            </div>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Actions</th>
                </tr>

                <?php
                if($orders->num_rows > 0){
                    while($order = $orders->fetch_assoc()){
                        //Get Product Info
                        $product = getProduct($order["product_id"]);

                        $payment_status = $order["is_paid"] ? 
                            '<span style="color:green;">Paid</span>' :
                            '<span style="color:red;" class="unpaid_text">Unpaid</span>'
                        ;

                        ?>
                        <tr>
                            <td>
                                <img class="table_image" src="../product_img/<?php echo $product["image"]; ?>" alt="">
                                <p><?php echo $product["name"]; ?></p>
                            </td>
                            <td>₱ <?php echo number_format($order["order_amount"]);?></td>
                            <td id="payment_status_<?php echo $order['order_id']; // Concatenate with order id to make sure it is unique ?>">
                                <?php 
                                    echo $payment_status;

                                    if(!$order["is_paid"]){
                                        echo '
                                            <button 
                                                class="mark_as_paid_btn" 
                                                onClick="markOrderAsPaid(`'.$order["order_id"].'`)";
                                            >
                                                Mark as paid
                                            </button>
                                        ';
                                    }
                                ?>
                            </td>
                            <td>
                                <span id="delivery_status_<?php echo $order['order_id']; // Concatenate with order id to make sure it is unique ?>">
                                    <?php echo $order["delivery_status"];?>
                                </span>
                            </td>
                            <td>
                                <button class="change_delivery_stat_btn" onClick='changeDeliveryStatus(`<?php echo $order["order_id"]; ?>`)'; >
                                    Change delivery status
                                </button>
                                <a class="view_btn" href="./view_order.php?order_id=<?php echo $order["order_id"]; ?>">View</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <!-- MODAL CONTAINER -->
    <div id="modal_container">
        <section>
            <select name="" id="selected_delivery_status" size="5">
                <option value="On Process">On Process</option>
                <option value="Packed">Packed</option>
                <option value="Shipped">Shipped</option>
                <option value="Delivered">Delivered</option>
            </select>
            <div class="mark_as_paid_confirm_con">
                <p>Note: Once confirm you cannot change it again</p>
                <button id="confirm_btn">Confirm</button>
            </div>
        </section>
    </div>

    <script>
        const modalContainer = document.getElementById("modal_container")
        const selectDeliveryStatus = document.getElementById("selected_delivery_status")
        const markAsPaidConfirmCon = document.querySelector(".mark_as_paid_confirm_con");

        const xhr = new XMLHttpRequest();
        let orderId = '';

        modalContainer.addEventListener("click", () => {
            modalContainer.style.visibility = "hidden"
            selectDeliveryStatus.style.display ="none"
            markAsPaidConfirmCon.style.display ="none"
        })

        function changeDeliveryStatus(order_id){
            modalContainer.style.visibility = "visible"
            selectDeliveryStatus.style.display = "block"
            orderId = order_id   
        }
        selectDeliveryStatus.addEventListener("change", (event) => {
            xhr.open("POST", "./ajax_handler.php", true);
            xhr.addEventListener("readystatechange", function(){
                if(this.readyState === 4){
                    let response = JSON.parse(this.responseText)
                    if(response.msg === "Delivery Status Updated Successfully"){
                        // Render the new delivery status
                        document.getElementById(`delivery_status_${orderId}`).innerText = response.delivery_status
                    }
                }
            });

            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(`action=Change Delivery Status&delivery_status=${event.target.value}&order_id=${orderId}`);
        })

        function markOrderAsPaid(order_id){
            markAsPaidConfirmCon.style.display = "block";
            modalContainer.style.visibility = "visible";
            orderId = order_id   
        }
        document.getElementById("confirm_btn").addEventListener("click", () => {
            xhr.open("POST", "./ajax_handler.php", true);
            xhr.addEventListener("readystatechange", function(){
                if(this.readyState === 4){
                    let response = JSON.parse(this.responseText)
                    if(response.msg === "Order Payment Updated Successfully"){
                        // Change the mark into paid
                        document.getElementById(`payment_status_${orderId}`).innerHTML = '<span style="color:green;">Paid</span>';
                    }
                }
            });

            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            // Send the ajax request
            xhr.send(`action=Mark Order As Paid&order_id=${orderId}`);
        })
    </script>
</body>
</html>