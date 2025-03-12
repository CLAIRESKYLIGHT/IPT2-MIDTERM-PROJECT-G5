<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id']; // Get the product ID
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];

    // Corrected SQL query
    $sql = "UPDATE tblproduct 
            SET product_name = ?, category = ?, price = ?, stock_quantity = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Corrected bind_param (added missing id parameter)
        $stmt->bind_param('ssdii', $product_name, $category, $price, $stock_quantity, $id);
        
        if ($stmt->execute()) {
            $_SESSION['status'] = 'updated'; 
        } else {
            $_SESSION['status'] = 'error'; 
            error_log("Update Error: " . $stmt->error); 
        }
        $stmt->close();
    } else {
        $_SESSION['status'] = 'error'; 
        error_log("Prepare Error: " . $conn->error); 
    }

    header('Location: ../index.php');
    exit();
}
?>
