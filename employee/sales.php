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
    <title>Sales</title>
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
             * Check if the employee is an admin then get all the sales
             * Otherwise get the sales according to the employee id
             */
            if($_SESSION["employee"]["position"] == "admin"){
                // Get the list of sales
                $sales = getAllSales(); // Will return a mysqli object

            }else if($_SESSION["employee"]["position"] == "seller"){
                // GET ALL SELLER'S SALES
                $sales = getSellerSales($_SESSION["employee"]["employee_id"]);
            }
        ?>

        <div class="table_container">
            <div class="table_top_info">
                <h4>List of Sales</h4>
                <h4>Total Sales Items: <?php echo $sales->num_rows; ?></h4>
            </div>
            <table>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Sales Date</th>
                </tr>
                <?php
                    if($sales->num_rows > 0){
                        while($sales_item = $sales->fetch_assoc()){
                            //Get order info
                            $order = getOrderById($sales_item["order_id"]);

                            //Get Product Info
                            $product = getProduct($order["product_id"]);
                            echo '<tr>
                                <td><img class="table_image" src="../product_img/'.$product["image"].'" alt=""></td>
                                <td>'.$product["name"].'</td>
                                <td>₱ '.number_format($sales_item["total_amount"]).'</td>
                                <td>'.date_format(date_create($sales_item["sales_date"]),"M j, Y ").'</td>
                            </tr>';
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>