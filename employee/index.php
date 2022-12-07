<?php
session_start();
                                
if(!isset($_SESSION["employee"])){
    header("Location: ./login.php");
    exit();
}

switch($_SESSION["employee"]["position"]){
    case "admin":
        header("Location: ./admin_dashboard.php");
        break;

    case "seller":
        header("Location: ./seller_dashboard.php");
        break;
}

