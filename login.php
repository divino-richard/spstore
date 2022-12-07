
<?php 
    session_start();
    require_once "./functions/getters.php"; 
    require_once "./functions/utils.php"; 
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
            <h1>CUSTOMER LOGIN</h1>
            
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    // Grab the required input fields
                    $input_email = $_POST["email"];
                    $input_pass = $_POST["password"]; 

                    if(!empty($input_email) && !empty($input_pass)){
                        // Get the customer account by the input email
                        $customer = getCustomerByEmail($input_email);

                        /** 
                         * If the customer was found then compare the pasword if thesame
                         * 
                         *      - If passwords are thesame then save
                         *          the the customer account to the session variable
                         *          and then redirect to the home page
                         * 
                         *      - If not thesame then show an error message 
                         * 
                         * If the customer was not found then show an error message
                         * */ 
                        if($customer){
                            if(password_verify($input_pass, $customer["password"])){
                                $_SESSION["customer"] = $customer;
                                
                                header("Location: ./");
                            }else{

                                echo showMessage("Incorrect password","ERROR");
                            }

                        }else{
                            echo showMessage("Account does not exist", "ERROR");
                        }
                    }else{

                        echo showMessage("Email and password are required", "ERROR");
                    }
                }
            ?>

            <div class="input_container">
                <img src="./images/arroba.png" alt="">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input_container">
                <img src="./images/key.png" alt="">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <input type="submit" class="submit_btn" value="LOGIN">

            <p style="color:#FFF; margin:1rem 0;">
                Does not have an account? 
                <a style="color:#FFF;" href="./signup.php">Sign up here</a>
            </p>
            <a style="color:#FFF;" href="">Forgot Password</a>
        </form>
    </div>
</body>
</html>