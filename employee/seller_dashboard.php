<?php
    require_once "../functions/getters.php";
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
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>SELLER DASHBOARD</title>
</head>
<body>
    <?php include "./inc/sidebar.php" ?>

    <div class="container">
        <?php include "./inc/topbar.php" ?>
        
        <div class="dashboard_con">
            <section>
                <?php
                    $seller_id = $_SESSION["employee"]["employee_id"];
                    $sales = getSellerSales($seller_id);
                    $orders = getSellerOrders($seller_id);
                    $current_day = date("Y-m-W-d");
                    $current_week = date("Y-m-W");
                    $current_month = date("Y-m");
                    $current_year = date("Y");

                    $sales_today = $sales_this_week = $sales_this_month = $sales_this_year = 0;
                    $orders_today = $orders_this_week = $orders_this_month = $orders_this_year = 0;
                    $profit_today = $profit_this_week = $profit_this_month = $profit_this_year = 0;

                    if($sales->num_rows > 0){
                        while($sales_row = $sales->fetch_assoc()){
                            $sales_date = date_create($sales_row["sales_date"]);
                            $day_sold=date_format($sales_date,"Y-m-W-d");
                            $week_sold=date_format($sales_date,"Y-m-W");
                            $month_sold=date_format($sales_date,"Y-m");
                            $year_sold=date_format($sales_date,"Y");

                            # GET THE ESPENSE FOR THIS SALES ITEM
                            $order_based_on_sales = getOrderById($sales_row["order_id"]);
                            $import_price = getProduct($order_based_on_sales["product_id"]) ["import_price"];
                            $expenses = ($import_price * $sales_row["quantity"]) + $order_based_on_sales["shipping_fee"];
                            
                            if($day_sold === $current_day){
                                $sales_today += $sales_row["total_amount"];
                                $profit_today += $sales_row["total_amount"] - $expenses; 
                            }
                            if($week_sold === $current_week){
                                $sales_this_week += $sales_row["total_amount"];
                                $profit_this_week += $sales_row["total_amount"] - $expenses; 
                            }
                            if($month_sold === $current_month){
                                $sales_this_month += $sales_row["total_amount"];
                                $profit_this_month += $sales_row["total_amount"] - $expenses; 
                            }
                            if($year_sold === $current_year){
                                $sales_this_year += $sales_row["total_amount"];
                                $profit_this_year += $sales_row["total_amount"] - $expenses; 
                            }
                        }
                    } 

                    if($orders->num_rows > 0){
                        while($order = $orders->fetch_assoc()){
                            $order_date = date_create($order["order_date"]);
                            $day_ordered = date_format($order_date,"Y-m-W-d");
                            $week_ordered = date_format($order_date,"Y-m-W");
                            $month_ordered = date_format($order_date,"Y-m");
                            $year_ordered = date_format($order_date,"Y");

                            if($day_ordered === $current_day){
                                $orders_today += $order["quantity"];
                            }
                            if($week_ordered === $current_week){
                                $orders_this_week += $order["quantity"];
                            }
                            if($month_ordered === $current_month){
                                $orders_this_month += $order["quantity"];
                            }
                            if($year_ordered === $current_year){
                                $orders_this_year += $order["quantity"];
                            }
                        }
                    }
                ?>
                <p>SALES</p>
                <div class="boxes_container">
                    <div class="sales_box">
                        <span>Today</span>
                        <p>₱ <b><?php echo number_format($sales_today); ?></b></p>
                    </div>
                    <div class="sales_box">
                        <span>This Week</span>
                        <p>₱ <b><?php echo number_format($sales_this_week); ?></b></p>
                    </div class="sales_box">
                    <div class="sales_box">
                        <span>This Month</span>
                        <p>₱ <b><?php echo number_format($sales_this_month); ?></b></p>
                    </div>
                    <div class="sales_box">
                        <span>This Year</span>
                        <p>₱ <b><?php echo number_format($sales_this_year); ?></b></p>
                    </div>
                </div>
            </section>

            <section>
                <p>ORDER</p>
                <div class="boxes_container">
                    <div class="order_box">
                        <span>Today</span>
                        <p><b><?php echo number_format($orders_today); ?></b></p>
                    </div>
                    <div class="order_box">
                        <span>This Week</span>
                        <p><b><?php echo number_format($orders_this_week); ?></b></p>
                    </div>
                    <div class="order_box">
                        <span>This Month</span>
                        <p><b><?php echo number_format($orders_this_month); ?></b></p>
                    </div>
                    <div class="order_box">
                        <span>This Year</span>
                        <p><b><?php echo number_format($orders_this_year); ?></b></p>
                    </div>
                </div>
            </section>

            <section>
                <p>PROFIT</p>
                <div class="boxes_container">
                    <div class="profit_box">
                        <span>Today</span>
                        <p>₱<b><?php echo number_format($profit_today); ?></b></p>
                    </div>
                    <div class="profit_box">
                        <span>This Week</span>
                        <p>₱<b><?php echo number_format($profit_this_week); ?></b></p>
                    </div>
                    <div class="profit_box">
                        <span>This Month</span>
                        <p>₱<b><?php echo number_format($profit_this_month); ?></b></p>
                    </div>
                    <div class="profit_box">
                        <span>This Year</span>
                        <p>₱<b><?php echo number_format($profit_this_year); ?></b></p>
                    </div>
                </div>
            </section>

        </div>
    </div>
</body>
</html>