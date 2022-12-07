<?php

require_once("dbh.php");

function getEmployeeByEmail($email){
    $mysqli = mysqli_connection(); // GETTING THE CNNECTION FROM THE DATABASE HANDLER (dbh.php)
    $result = $mysqli->query("SELECT * FROM employees WHERE email='{$email}' ");
    if($result->num_rows > 0){
        return $row = $result->fetch_assoc();
    }else{
        return 0;
    }
}

function getEmployees(){
    $mysqli = mysqli_connection(); // GETTING THE CNNECTION FROM THE DATABASE HANDLER (dbh.php)
    $result = $mysqli->query("SELECT * FROM employees");
    return $result;
}

function getSuppliers(){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM suppliers");
    return $result;
}

function getSupplierById($supplier_id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM suppliers WHERE supplier_id='$supplier_id' ");
    if($result->num_rows > 0){
        return $row = $result->fetch_assoc();
    }else{
        return 0;
    }
}

function getProducts(){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM products WHERE is_active=1 ");
    return $result;
}

function getProductsByEmployeeId($employee_id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM products WHERE employee_id='$employee_id' && is_active=1 ");
    return $result;
}

function getProductsByNameKey($key){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM products WHERE name LIKE '%$key%' && is_active=1 LIMIT 10");
    return $result;
}

function getProduct($product_id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM products WHERE product_id='{$product_id}' ");
    if($result->num_rows > 0){
        return $row = $result->fetch_assoc();
    }else{
        return 0;
    }
}

function getCustomers(){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM customers");
    return $result;
}

function getCustomerById($id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM customers WHERE customer_id='$id' ");
    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }else{
        return 0;
    }
}

function getCustomerByEmail($email){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM customers WHERE email='$email' ");
    if($result->num_rows > 0){
        return $row = $result->fetch_assoc();
    }else{
        return 0;
    }
}

function getAllOrders(){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM orders");
    return $result;
}

function getOrderById($order_id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM orders WHERE order_id='$order_id' ");
    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }else{
        return 0;
    }
}

function getSellerOrders($seller_id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM orders WHERE seller_id = '$seller_id' ");
    return $result;
}

function getCustomerOrders($customer_id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM orders WHERE customer_id='$customer_id'");
    return $result;
}

function getAllSales(){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM sales");
    return $result;
}

function getSellerSales($seller_id){
    $mysqli = mysqli_connection();
    $result = $mysqli->query("SELECT * FROM sales WHERE seller_id='$seller_id'");
    return $result;
}


