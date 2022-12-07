<?php
    if(!isset($_SESSION["employee"])){
        header("Location: ./login.php");
    }

    $exploded = explode('/', $_SERVER["PHP_SELF"]);
    $file_name = $exploded[sizeof($exploded) - 1];
    $page_name = explode('.', $file_name)[0];
?>

<div class="topbar_con">
    <div class="topbar">
        <h4>
            <?php 
                # Replace underscore to a white space if exist
                # Turn the first character of the word/s to uppercase
                echo ucwords(str_replace('_', ' ', $page_name)); 
            ?>
        </h4>
        <h3>Welcome <?php echo ucwords($_SESSION["employee"]["position"]); ?></h3>
        <a href="./logout.php">Logout</a>
    </div>
</div>

