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
    <link rel="stylesheet" href="./css/products.css">

    <title>Phones</title>
</head>
<body>

    <?php include "./inc/sidebar.php" ?>

    <div class="container">
        <?php include "./inc/topbar.php" ?>

        <?php
            if($_SESSION["employee"]["position"] == "admin"){
                # Get all products
                $products = getProducts(); # Will return a mysqli 
            }else if($_SESSION["employee"]["position"] == "seller"){
                # Get seller's products
                $products = getProductsByEmployeeId($_SESSION["employee"]["employee_id"]);
            }
        ?>
        
        <div class="table_container">
            <div class="table_top_info">
                <h4>List of Smart Phone</h4>
                <h4>Total Items: <?php echo $products->num_rows; ?></h4>
            </div>
            <table>
                <tr>
                    <th>Item</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>

                <?php
                    if($products->num_rows > 0){
                        while($product = $products->fetch_assoc()){
                            ?>
                            <tr>
                                <td>
                                    <img class="table_image" src="../product_img/<?php echo $product["image"]; ?>" alt=""> 
                                    <p><?php echo $product["name"];?></p>
                                </td>
                                <td><?php echo $product["brand"]; ?></td>
                                <td><?php echo $product["category"]; ?></td>
                                <td>
                                    <a href="./view_product.php?product_id=<?php echo $product["product_id"]; ?>" class="view_btn">View</a>
                                    <?php
                                    if($_SESSION["employee"]["position"] == "seller"){
                                        echo '
                                            <a href="./update_product.php?product_id='.$product["product_id"].'" class="update_btn">Update</a>
                                            <button class="delete_btn" onclick="confirmDelete(` '.$product["product_id"].' `);">Delete</button>
                                        ';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
                
            </table>
        </div>
    </div>

    <!-- MODAL CONTAINER -->
    <div id="modal_container">
        <div class="confirm_con">
            <p>Note: Once confirm product will be deleted</p>
            <button id="confirm_btn">Confirm Delete</button>
        </div>
    </div>

    <script>
        const modalContainer = document.getElementById("modal_container");
        let productToDelete;

        function confirmDelete(id){
            modalContainer.style.visibility = "visible";
            productToDelete = id;
        }

        modalContainer.addEventListener("click", function(event){
            if(event.target !== modalContainer) return;
            modalContainer.style.visibility = "hidden";
        })

        document.getElementById("confirm_btn").addEventListener("click", () => {
            let xhr = new  XMLHttpRequest();
            xhr.open("POST", "./ajax_handler.php", true);
            xhr.addEventListener("readystatechange", function(){
                if(this.readyState === 4 && this.status ===200){
                    modalContainer.style.visibility = "hidden";
                    location.reload();
                }
            });
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            // Send the ajax request
            xhr.send(`action=Delete Product&product_id=${productToDelete}`);
        });
    </script>

</body>
</html>