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
    <title>EMPLOYEES</title>
</head>
<body>

    <?php 
        include "./inc/sidebar.php";

        if($_SESSION["employee"]["position"] !== "admin"){
            header("Location: ./logout.php");
        }
    ?>
    

    <div class="container">
        <?php include "./inc/topbar.php" ?>

        <?php $employees = getEmployees(); //Get the employees from the database ?>
        
        <div class="table_container">
            <div class="table_top_info">
                <h4>List of Employees</h4>
                <h4>Total Employees: <?php echo $employees->num_rows; ?></h4>
            </div>
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Position</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>

                <?php
                    if($employees->num_rows > 0){
                        while($employee = $employees->fetch_assoc()){
                            echo '
                                <tr>
                                    <td>'.$employee["fname"].' '.$employee["lname"].' </td>
                                    <td>'.$employee["position"] .'</td>
                                    <td>'.$employee["address"] .'</td>
                                    <td>'.$employee["phonenumber"] .'</td>
                                    <td>'.$employee["email"] .'</td>
                                    <td>'.$employee["password"] .'</td>
                                </tr>
                            ';
                        }
                    }
                ?>
                
            </table>
        </div>
    </div>

</body>
</html>