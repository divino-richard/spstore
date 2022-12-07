
<?php
    require_once "../functions/update.php";
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
    <link rel="stylesheet" href="./css/my_account.css">    
    </style>
    <title>My Account</title>
</head>
<body>
    <?php include_once "./inc/sidebar.php" ?>

    <div class="container">
        <?php include_once "./inc/topbar.php" ?>

        <div class="account_con">
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    updateEmployeePass($_SESSION["employee"]["employee_id"]);
                } 

                if(!isset($_SESSION["employee"])){
                    header("Location: ./login.php");
                    exit();
                }
                $employee = $_SESSION["employee"];
            ?>

            <ul>
                <li>First name: <?php echo $employee["fname"];?> </li>
                <li>Last name: <?php echo $employee["lname"];?> </li>
                <li>Address: <?php echo $employee["address"];?> </li>
                <li>E-mail: <?php echo $employee["email"];?> </li>
                <li>Phone number: +63<?php echo $employee["phonenumber"];?> </li>
                <li>Position: <?php echo $employee["position"];?> </li>
            </ul>

            <button id="change_pass_btn">Change Password</button>

        </div>
    </div>

    <div id="modal_container">
        <form action="" method="POST" class="change_pass_form">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" class="submit_btn" value="Submit">
        </form>
    </div>

    <script>
        const modalContainer = document.getElementById("modal_container");
        const changePassBtn = document.getElementById("change_pass_btn");

        modalContainer.addEventListener("click", function(event){
            if(event.target !== modalContainer) return;
            modalContainer.style.visibility = "hidden";
        })

        changePassBtn.addEventListener("click", () => {
            modalContainer.style.visibility = "visible";
        })
    </script>
</body>
</html>
