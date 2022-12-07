
<?php 
    session_start();
    require_once "./functions/setters.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/auth.css">
    <title>LOGIN</title>
</head>
<body>
    <!-- TOP BAR HERE -->
    <?php include "./includes/topbar.php"; ?>

    <div class="login_signup_con">
        <form action="" method="POST">
            <h1>CUSTOMER SIGN UP</h1>
            <?php
                if($_SERVER["REQUEST_METHOD"] =="POST"){
                    setCustomer();
                }
            ?>
            <div class="input_container">
                <img src="./images/user.png" alt="">
                <input type="text" name="fname" placeholder="First Name" required>
            </div>

            <div class="input_container">
                <img src="./images/user.png" alt="">
                <input type="text" name="lname" placeholder="Last Name" required>
            </div>

            <div class="input_container">
                <img src="./images/location.png" alt="">
                <input type="text" name="address" placeholder="Address" required>
            </div>

            <div class="input_container">
                <img src="./images/smartphone.png" alt="">
                <input type="number" name="phonenumber" placeholder="Phone Number" required>
            </div>

            <div class="input_container">
                <img src="./images/arroba.png" alt="">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input_container">
                <img src="./images/key.png" alt="">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="input_container">
                <img src="./images/key.png" alt="">
                <input type="password" name="confirm_pass" placeholder="Confirm" required>
            </div>

            <input type="submit" class="submit_btn" value="SIGN UP">
            
            <p style="color:#FFF; margin-top:1rem;">
                Already have an account?
                <a style="color:#FFF;" href="./login.php">Login here</a>
            </p>
        </form>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>