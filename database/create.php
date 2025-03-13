<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock_quantity = $_POST['stock_quantity'];

    $sql = "INSERT INTO tblproduct (product_name, price, category, stock_quantity) VALUES ('$product_name', '$price', '$category', '$stock_quantity')";

    if ($conn->query($sql) === TRUE) {
        // Set the status to "created"
        $_SESSION['status'] = "created";

        // Get the total number of records
        $total_records_sql = "SELECT COUNT(*) AS total FROM tblproduct";
        $total_records_result = $conn->query($total_records_sql);
        $total_records = $total_records_result->fetch_assoc()['total'];

        // Calculate the total number of pages
        $records_per_page = 10;
        $total_pages = ceil($total_records / $records_per_page);

        // Redirect to the last page
        header("Location: ../index.php?page=$total_pages");
        exit();
    } else {
        $_SESSION['status'] = "error";
        header("Location: ../index.php");
        exit();
    }
}
?>