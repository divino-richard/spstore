<?php 
    require_once "../functions/setters.php"; 
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
    <title>REGISTER EMPLOYEE</title>
</head>
<body>

    <?php include "./inc/sidebar.php" ?>

    <div class="container flex_col_center">
        <?php include "./inc/topbar.php" ?>

        <form action="" method="POST">
            <h3>Employee Registration Form</h3>
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    setEmployee();
                }
            ?>
            <input type="text" name="fname" placeholder="First name" required>
            <input type="text" name="lname" placeholder="Last name" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="number" name="phonenumber" placeholder="Phone Number" required>
            <input type="text" name="address" placeholder="Address" required>
            <select name="position" required>
                <option value="">--Select Position--</option>
                <option value="seller">Seller</option>
            </select>
            <input type="submit" class="submit_btn" value="Register">
        </form>
    </div>
</body>
</html>