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
    <link rel="stylesheet" href="./css/customers.css">
    
    <title>Customers</title>
</head>
<body>
    <?php include "./inc/sidebar.php" ?>

    <div class="container">
        <?php include "./inc/topbar.php" ?>

        <?php $customers = getCustomers();?>

        <div class="customers_container">
            <div class="customers_header">
                <h4>List of Customers</h4>
                <h4>Total Customers: <?php echo $customers->num_rows; ?></h4>
            </div>

            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>

                <?php
                    if($customers->num_rows > 0){
                        while($customer = mysqli_fetch_assoc($customers)){
                            echo '<tr>
                                <td>'.$customer["fname"].' </td>
                                <td>'.$customer["lname"].'</td>
                                <td>'.$customer["email"].'</td>
                                <td>+63'.$customer["phonenumber"] .'</td>
                            </tr>';
                        }
                    }
                ?>
                
            </table>
        </div>
    </div>
</body>
</html>