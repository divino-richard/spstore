<?php
require_once "dbh.php";
require_once "setters.php";
require_once "getters.php";
require_once "utils.php";

function updateDeliveryStatus($order_id, $delivery_status){
    $conn = mysqli_connection(); // Call database connection
    $sql = "UPDATE orders SET delivery_status='$delivery_status' WHERE order_id='$order_id'";
    
    if($conn->query($sql) === TRUE){
        header("Content-type: text/json");
        $response = array(
            'msg' => "Delivery Status Updated Successfully",
            'delivery_status' => $delivery_status
        );
        echo json_encode($response);
    } else {
        echo "Error: " . $order_sql . "<br>" . $conn->error;
    }
}

function markOrderAsPaid($order_id){
    $conn = mysqli_connection(); // Call database connection
    $order_sql = "UPDATE orders SET is_paid=1 WHERE order_id='$order_id'";
    $order = getOrderById($order_id);

    if($conn->query($order_sql) === TRUE){
        // Add to the sales
        if(setSales($order_id, $order["seller_id"], $order["quantity"], $order["order_amount"])){
            header("Content-type: text/json");

            $response = array(
                'msg' => "Order Payment Updated Successfully",
                'is_paid' => TRUE
            );
            echo json_encode($response);
        }
    } else {
        echo "Error: " . $order_sql . "<br>" . $conn->error;
    }
}

function updateProduct($product_id){
    $conn = mysqli_connection();
    
    # GRAB THE PREVIOUS IMAGE
    $prev_image = getProduct($product_id)["image"];

    if($_FILES["image"]["error"] == 0){
        # RENAME THE IMAGE
        $exploded_name = explode(".", $_FILES["image"]["name"]);
        $extention = end($exploded_name);
        $new_image_name = uniqid("product_", true) . "." . $extention;

        # DELETE THE PREVIOUS IMAGE IN product_img FOLDER
        if(unlink($_SERVER['DOCUMENT_ROOT'] . "/spstore/product_img/" . $prev_image)){
            # MOVE THE NEW IMAGE TO product_img FOLDER AND CHECK IF IT IS SUCCESSFULL
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/spstore/product_img/" . $new_image_name)){
                $image = $new_image_name;
            }
        }
    }else{
        $image = $prev_image;
    }

    $product_sql = "UPDATE products SET 
        image           ='$image',
        name            ='{$_POST["name"]}',
        brand           ='{$_POST["brand"]}',
        import_price    ='{$_POST["import_price"]}',
        price           ='{$_POST["price"]}',
        category        ='{$_POST["category"]}',
        description     ='{$_POST["description"]}'
        WHERE product_id='$product_id' 
    ";

    if($conn->query($product_sql) === TRUE){
        header("Location: ./view_product.php?product_id=$product_id");
    } else {
        echo "Error: " . $product_sql . "<br>" . $conn->error;
    }
}

function updateEmployeePass($employee_id){
    $conn = mysqli_connection();

    if($_POST["new_password"] !== $_POST["confirm_password"] ){
        echo showMessage("Passwords not the same", "ERROR");
        return;
    }

    $employee_sql = "UPDATE employees SET password='{$_POST["new_password"]}' WHERE employee_id='$employee_id' ";

    if($conn->query($employee_sql) === TRUE){
        echo showMessage("Passwords Updated Successfully", "SUCCESS");
    }else{
        echo "Error: " . $employee_sql . "<br>" . $conn->error;
    }
}

function updateCustomerPass($customer_id){
    $conn = mysqli_connection();

    if($_POST["new_password"] !== $_POST["confirm_password"] ){
        echo showMessage("Passwords not the same", "ERROR");
        return;
    }

    # ENCRYPT THE PASSWORD
    $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

    $customer_sql = "UPDATE customers SET password='$new_password' WHERE customer_id='$customer_id' ";

    if($conn->query($customer_sql) === TRUE){
        header("Location: ./logout.php");
    }else{
        echo "Error: " . $customer_sql . "<br>" . $conn->error;
    }
}


