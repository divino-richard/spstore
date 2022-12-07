<?php
require_once "../functions/update.php";
require_once "../functions/delete.php";
header("Content-Type: text/plain");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["action"])){
        switch(strtoupper($_POST["action"])){
            case "CHANGE DELIVERY STATUS":
                updateDeliveryStatus(trim($_POST["order_id"]), trim($_POST["delivery_status"]));
                break;
            case "MARK ORDER AS PAID":
                markOrderAsPaid(trim($_POST["order_id"]));
                break;
            case "DELETE PRODUCT":
                deleteProduct(trim($_POST["product_id"]));
                break;
        }
    }
}

