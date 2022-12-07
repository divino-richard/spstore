<?php
    # Split path  by forward slash (/)  
    # Turn path into an array
    $exploded = explode('/', $_SERVER["PHP_SELF"]); 
    # Get PHP file name
    $php_file_name = $exploded[sizeof($exploded) - 1];
?>

<div class="topbar">
    <div class="logo">
        <img src="./images/logo.png" alt="logo" />
    </div>

    <nav class="nav_bar">
        <div class="search_bar">
            <input type="text" id="search_input" placeholder="Search Smartphone">
            <div class="search_sugg"></div>
        </div>

        <div class="nav_menu">
            <a 
                class="<?php echo $php_file_name == "index.php" ? "active": ""; ?>"
                href="./">
                HOME
            </a>
            <a 
                class="<?php echo $php_file_name == "my_orders.php" ? "active": ""; ?>"
                href="./my_orders.php">
                MY ORDERS
            </a>
        
            <?php 
                # SHOW LOGOUT LINK/BUTTON IF CUSTOMER IS LOGGED IN 
                # OTHERWISE SHOW LOGIN AND SIGNUP
                if(isset($_SESSION["customer"])){
                    ?>
                    <a 
                        class="<?php echo $php_file_name == "my_account.php" ? "active": ""; ?>"
                        href="./my_account.php">
                        MY ACCOUNT
                    </a>
                    <a href="./logout.php">LOGOUT</a>
                    <?php
                } else {
                    ?>
                    <a 
                        class="<?php echo $php_file_name == "login.php" ? "active": ""; ?>"
                        href="./login.php">
                        LOGIN
                    </a>
                    <a 
                        class="<?php echo $php_file_name == "signup.php" ? "active": ""; ?>"
                        href="./signup.php">
                        SIGN UP
                    </a>
                    <?php
                }
            ?>
        </div>
    </nav>
</div>
