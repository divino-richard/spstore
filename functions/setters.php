<?php
require_once "dbh.php";
require_once "utils.php";
require_once "getters.php";

function setEmployee(){
    $employee_id = uniqid();
    /**
     * Create a default password for the employee
     * Later on, the employee will update her password
     */
    $password = uniqid(); 

    $conn = mysqli_connection(); // Call a database connection
    $sql = "INSERT INTO 
        employees(
            employee_id,
            fname,
            lname,
            email,
            password,
            position,
            address,
            phonenumber
        )
        VALUES(
            '$employee_id',
            '{$_POST["fname"]}',
            '{$_POST["lname"]}',
            '{$_POST["email"]}',
            '$password',
            '{$_POST["position"]}',
            '{$_POST["address"]}',
            '{$_POST["phonenumber"]}'
        )
    ";

    if($conn->query($sql) === TRUE){
        echo showMessage("Employee Registered Successfully", "SUCCESS");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

#####################################################################
function setSupplier(){
    $conn = mysqli_connection(); // Call a database connection

    $supplier_id = uniqid();
    $supplier_sql = "INSERT INTO suppliers(
        supplier_id,
        company_name,
        address,
        phonenumber
    ) VALUES(
        '$supplier_id',
        '{$_POST["company_name"]}',
        '{$_POST["address"]}',
        {$_POST["phonenumber"]}
    )";

    if($conn->query($supplier_sql) === TRUE){
        echo showMessage("Supplier Registered Successfully", "SUCCESS");
    } else {
        echo "Error: " . $supplier_sql . "<br>" . $conn->error;
    }
}

#####################################################################
function setProduct(){
    if($_FILES["image"]["error"] == UPLOAD_ERR_OK){
        # RENAME THE IMAGE
        $exploded_name = explode(".", $_FILES["image"]["name"]);
        $extention = end($exploded_name);

        $new_image_name = uniqid("product_", true) . "." . $extention;
        
        # MOVE THE IMAGE TO product_img FOLDER AND CHECK IF IT IS SUCCESSFULL
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/storemb/product_img/" . $new_image_name)){
            $conn = mysqli_connection();

            $product_id = uniqid();
            $shipping_pay = 125; // Standard shipping pay for now
            $is_out_of_stock = 0;
            $is_active = 1;

            $product_sql = "INSERT INTO products(
                product_id,
                employee_id,
                supplier_id,
                image,
                name,
                brand,
                import_price,
                price,
                category,
                description,
                qty_in_stock,
                is_out_of_stock,
                is_active
            ) VALUES(
                '$product_id',
                '{$_SESSION["employee"]["employee_id"]}',
                '{$_POST["supplier_id"]}',
                '$new_image_name',
                '{$_POST["name"]}',
                '{$_POST["brand"]}',
                {$_POST["import_price"]},
                {$_POST["price"]},
                '{$_POST["category"]}',
                '{$_POST["description"]}',
                {$_POST["qty_in_stock"]},
                $is_out_of_stock,
                $is_active = 1
            )";

            $suplier_product_sql = "INSERT INTO supplier_product(
                product_id, supplier_id
            ) VALUES(
                '$product_id', ' {$_POST["supplier_id"]}'
            )";

            if( $conn->query($product_sql) === TRUE &&
                $conn->query($suplier_product_sql) === TRUE){

                echo showMessage("Product added successfully", "SUCCESS");

            } else {
                echo "Error: " . $supplier_sql . "<br>" . $conn->error;
                echo "Error: " . $product_sql . "<br>" . $conn->error;
                echo "Error: " . $suplier_product_sql . "<br>" . $conn->error;
            }

        }else{
            echo showMessage("Something wrong in the upload", "ERROR");
        }

    }else if($_FILES["image"]["error"] == UPLOAD_ERR_NO_FILE){
        echo showMessage("Product image is required", "ERROR");

    }else{
        throw new UploadException($_FILES['file']['error']);
    }
}

#####################################################################
function setCustomer(){
    $conn = mysqli_connection();
    $customer_id = uniqid();
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    // Check passwords if thesame
    if($_POST["password"] == $_POST["confirm_pass"]){
        $sql = "INSERT INTO 
            customers(
                customer_id,
                fname,
                lname,
                email,
                password,
                address,
                phonenumber
            )
            VALUES(
                '$customer_id',
                '{$_POST["fname"]}',
                '{$_POST["lname"]}',
                '{$_POST["email"]}',
                '$password',
                '{$_POST["address"]}',
                '{$_POST["phonenumber"]}'
            )
        ";

        if($conn->query($sql) === TRUE){
            header("Location: ./login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        echo showMessage("Passwords are not thesame", "ERROR");
    }
}

#####################################################################
function setOrder($product_id, $seller_id){
    $conn = mysqli_connection();

    $order_id = uniqid();

    $delivery_status = "On Process"; // Initial status
    $is_paid = $_POST["payment_method"] == "online_payment" ? 1 : 0;

    $order_sql = "INSERT INTO orders(
        order_id,
        product_id,
        customer_id,
        seller_id,
        payment_method,
        quantity,
        order_amount,
        shipping_fee,
        delivery_status,
        is_paid
    ) VALUES(
        '$order_id',
        '$product_id',
        '{$_SESSION["customer"]["customer_id"]}',
        '$seller_id',
        '{$_POST["payment_method"]}',
        {$_POST["quantity"]},
        {$_POST["order_amount"]},
        {$_POST["shipping_fee"]},
        '$delivery_status',
        $is_paid
    )";

    if($conn->query($order_sql) === TRUE){
        // Insert sales if it is paid
        if($is_paid){
            if(setSales($order_id, $seller_id, $_POST["quantity"], $_POST["order_amount"])){
                header("Location: ./my_orders.php");
                exit();
            }
        }else{
            header("Location: ./my_orders.php");
            exit();
        }
    } else {
        echo "Error: " . $order_sql . "<br>" . $conn->error;
    }
}

#####################################################################
function setSales($order_id, $seller_id, $quantity, $total_amount){
    $conn = mysqli_connection();
    $sales_id = uniqid();

    $sales_sql = "INSERT INTO sales(
        sales_id,
        order_id,
        seller_id,
        quantity,
        total_amount
    ) VALUES(
        '$sales_id',
        '$order_id',
        '$seller_id',
        $quantity,
        $total_amount
    )";

    if($conn->query($sales_sql) === TRUE){
        return TRUE;
    } else {
        echo "Error: " . $order_sql . "<br>" . $conn->error;
        return FALSE;
    }
}

