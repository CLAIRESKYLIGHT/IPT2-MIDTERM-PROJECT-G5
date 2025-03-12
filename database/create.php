<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity']; 
    
    $sql = "INSERT INTO tblproduct (product_name, category, price, stock_quantity) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssdi", $product_name, $category, $price, $stock_quantity); 

        if ($stmt->execute()) {
            $_SESSION['status'] = "created";
            $_SESSION['last_inserted_id'] = $stmt->insert_id; // ✅ Get the inserted ID
        } else {
            $_SESSION['status'] = "error";
        }
        
        $stmt->close();
    } else {
        $_SESSION['status'] = "error";
    }

    $conn->close();
    header('Location: ../index.php');
    exit();
}
?>
