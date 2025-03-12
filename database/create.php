<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name =$_POST['product_name'];
    $category = $_POST['category'];
    $price= $_POST['price'];
    $stock_quantity = $_POST['stock_quantity']; 
    
    $sql = "INSERT INTO tblproduct (product_name, category, price, stock_quantity) VALUES ('$product_name', '$category', '$price', '$stock_quantity')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "created";
       
    } else {
        $_SESSION['status'] = "Error";
       
    }

    mysqli_close($conn);
    header('Location: ../index.php');
    exit();
}
?>