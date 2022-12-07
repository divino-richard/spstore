
<?php
    session_start();
    if(!isset($_SESSION["employee"])){
        header("Location: ./login.php");
    }

    # Split path  by forward slash (/) 
    # Turn path into an array
    $exploded = explode('/', $_SERVER["PHP_SELF"]); 
    # Get PHP file name
    $php_file_name = $exploded[sizeof($exploded) - 1];
?>

<div class="sidebar">
    <div class="employee_logo">
        <img 
            <?php
            if($_SESSION["employee"]["position"] === "admin"){
                echo 'src="../images/admin.png"';
            }else if($_SESSION["employee"]["position"] === "seller"){
                echo 'src="../images/seller.png"';
            }
            ?>
        >
        <h1><?php echo ucwords($_SESSION["employee"]["position"]); ?></h1>
        <a 
            href="./my_account.php" 
            style="color:#FFF; padding: 10px 0; text-decoration:none;">
            My Account
        </a>
    </div>

    <ul class="nav_menu">
        <?php
            /**
             * Identify the position of the employee then set
             * their menus according the position
             * */ 
            $position = $_SESSION["employee"]["position"]; 

            if($position == "admin"){
                ?>
                <li>
                    <a 
                        class="<?php echo $php_file_name == "admin_dashboard.php" ? "active": ""; ?>" 
                        href="./admin_dashboard.php">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a 
                        class="<?php echo $php_file_name == "register_employee.php" ? "active": ""; ?>" 
                        href="./register_employee.php">
                        Register Employee
                    </a>
                </li>
                <li>
                    <a 
                        class="<?php echo $php_file_name == "register_supplier.php" ? "active": ""; ?>" 
                        href="./register_supplier.php">
                        Register Supplier
                    </a>
                </li>
                <li>
                    <a 
                        class="<?php echo $php_file_name == "employees.php" ? "active": ""; ?>" 
                        href="./employees.php">
                        Employees
                    </a>
                </li>
                <li>
                    <a 
                        class="<?php echo $php_file_name == "customers.php" ? "active": ""; ?>" 
                        href="./customers.php">
                        Customers
                    </a>
                </li>
                <li>
                    <a 
                        class="<?php echo $php_file_name == "suppliers.php" ? "active": ""; ?>" 
                        href="./suppliers.php">
                        Suppliers
                    </a>
                </li>
                <?php
            }

            if($position == "seller"){
                ?>
                    <li>
                        <a 
                            class="<?php echo $php_file_name == "seller_dashboard.php" ? "active": ""; ?>" 
                            href="./seller_dashboard.php">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a 
                            class="<?php echo $php_file_name == "add_product.php" ? "active": ""; ?>" 
                            href="./add_product.php">
                            Add Product
                        </a>
                    </li>
                <?php
            }

            if($position == "admin" || $position == "seller"){
                ?>
                    <li>
                        <a 
                            class="<?php echo $php_file_name == "products.php" ? "active": ""; ?>" 
                            href="./products.php">
                            Products
                        </a>
                    </li>
                    <li>
                        <a 
                            class="<?php echo $php_file_name == "sales.php" ? "active": ""; ?>" 
                            href="./sales.php">
                            Sales
                        </a>
                    </li>
                    <li>
                        <a 
                            class="<?php echo $php_file_name == "orders.php" ? "active": ""; ?>" 
                            href="./orders.php">
                            Orders
                        </a>
                    </li>
                <?php
            }
        
        ?>
    </ul>
</div>

