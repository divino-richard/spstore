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
    <title>Suppilers</title>
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

        <?php $suppliers = getSuppliers(); ?>
        
        <div class="table_container">
            <div class="table_top_info">
                <h4>List of Suppliers</h4>
                <h4>Total Suppliers: <?php echo $suppliers->num_rows; ?></h4>
            </div>
            <table>
                <tr>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                </tr>

                <?php
                    if($suppliers->num_rows > 0){
                        while($supplier = $suppliers->fetch_assoc()){
                            echo '
                                <tr>
                                    <td>'.$supplier["company_name"].' </td>
                                    <td>'.$supplier["address"] .'</td>
                                    <td>+63'.$supplier["phonenumber"] .'</td>
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