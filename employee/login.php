
<?php 
    session_start();
    require_once "../functions/getters.php"; 
    require_once "../functions/utils.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title> EMPLOYEE LOGIN</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h1>EMPLOYEE LOGIN</h1>
            
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    // Grab the required input fields
                    $input_email = $_POST["email"];
                    $input_pass = $_POST["password"]; 

                    if(!empty($input_email) && !empty($input_pass)){
                        // Get the admin account by the input email
                        $employee = getEmployeeByEmail($input_email);

                        /** 
                         * If the employee was found then compare the pasword if thesame
                         * 
                         *      - If passwords are thesame then save
                         *          the the employee account to the session variable
                         *          and then redirect to its designated page
                         * 
                         *      - If not thesame then show an error message 
                         * 
                         * If the employee was not found then show an error message
                         * */ 
                        if($employee){
                            if($employee["password"] == $input_pass){
                                $_SESSION["employee"] = $employee;
                                header("Location: ./");
                            }else{

                                echo showMessage("Incorrect password","ERROR");
                            }

                        }else{

                            echo showMessage("Account is not an admin", "ERROR");
                        }
                    }else{

                        echo showMessage("Email and password are required", "ERROR");
                    }
                }
            ?>

            <div class="input_container">
                <img src="../images/arroba.png" alt="">
                <input type="email" name="email" placeholder="email" required>
            </div>

            <div class="input_container">
                <img src="../images/key.png" alt="">
                <input type="password" name="password" placeholder="password" required>
            </div>

            <input type="submit" class="submit_btn" value="LOGIN">
        </form>
    </div>
</body>
</html>