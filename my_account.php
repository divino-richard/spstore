<?php 
    session_start();
    require_once "./functions/getters.php"; 
    require_once "./functions/update.php"; 
    require_once "./functions/utils.php"; 
    
    if(!isset($_SESSION["customer"])){
        header("Location: ./login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/my_account.css">
    <title>My Account</title>
</head>
<body>
    <!-- INCLUDE THE HEADER FILE  -->
    <?php include_once "./includes/topbar.php" ?>

    <div class="account_con">
        <?php
            $customer = $_SESSION["customer"];

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                updateCustomerPass($_SESSION["customer"]["customer_id"]);
            }
        ?>

        <ul>
            <li>First name: <?php echo $customer["fname"];?> </li>
            <li>Last name: <?php echo $customer["lname"];?> </li>
            <li>Address: <?php echo $customer["address"];?> </li>
            <li>E-mail: <?php echo $customer["email"];?> </li>
            <li>Phone number: +63<?php echo $customer["phonenumber"];?> </li>
        </ul>

        <button id="change_pass_btn">Change Password</button>
    </div>

    <div id="modal_container">
        <form action="" method="POST">
            <input type="text" name="new_password" placeholder="New Password" required>
            <input type="text" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" class="submit" value="Submit">
        </form>
    </div>

    <script>
        const modalContainer = document.getElementById("modal_container");
        
        document.getElementById("change_pass_btn").addEventListener("click", () => {
            modalContainer.style.display = "flex";
        });

        modalContainer.addEventListener("click", (event) => {
            if(event.target !== modalContainer) return;
            modalContainer.style.display = "none";
        })
    </script>
</body>
</html>
