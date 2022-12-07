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

    <title>ADD NEW PRODUCT</title>
</head>
<body>
    <?php include "./inc/sidebar.php" ?>
    
    <div class="container">
        <?php include "./inc/topbar.php" ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Add Product</h3>

            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    setProduct(); //Insert the product into the database
                }
            ?>

            <div class="form_section">
                <div class="fields_group">
                    <img src="../images/placeholder.png" onclick="preview_image()" id="image_viewer">
                    <input type="file" name="image" id="p_image" accept="image/*">
                </div>
               
                <div class="fields_group">
                    <input type="number" name="import_price" placeholder="(₱) Import Price" required>
                    <input type="number" name="price" placeholder="(₱) Price" required>
                    <input type="number" name="qty_in_stock" placeholder="Quantity in stock" required>
                </div>
            </div>
            
            <div class="form_section">
                <div class="fields_group">
                    <input type="text" name="name" placeholder="Name" required>

                    <select name="brand" required>
                        <option value="">--Select Brand--</option>
                        <option value="samsung">Samsung</option>
                        <option value="apple">Apple</option>
                        <option value="lenovo">Lenovo</option>
                        <option value="huawei">Huawei</option>
                        <option value="realme">Realme</option>
                        <option value="vivo">Vivo</option>
                        <option value="oppo">Oppo</option>
                        <option value="xiaomi">Xiaomi</option>
                    </select>

                    <select name="category" required>
                        <option value="">--Select Category--</option>
                        <option value="ios">IOS</option>
                        <option value="android">Adroid</option>
                    </select>
                </div>

                <div class="fields_group">
                    <select name="supplier_id" required>
                        <option value="">--Select Supplier--</option>
                        <?php
                            $suppliers = getSuppliers();
                            if($suppliers->num_rows > 0){
                                while($supplier = $suppliers->fetch_assoc()){
                                    // Set the value of this select element to the id of the supplier
                                    echo '
                                        <option value="'.$supplier["supplier_id"].'">
                                            '.$supplier["company_name"].'
                                        </option>
                                    ';
                                }
                            }

                        ?>
                    </select>  
                    <textarea name="description" placeholder="Product description" required></textarea>
                </div>
            </div>

            <input type="submit" class="submit_btn" value="ADD PRODUCT">
        </form>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>