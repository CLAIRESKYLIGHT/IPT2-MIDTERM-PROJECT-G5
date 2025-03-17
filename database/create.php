<?php
session_start();
include ('database.php'); // Ensure this file correctly establishes $conn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock_quantity = $_POST['stock_quantity'];

    // Prepare an SQL statement
    $sql = "INSERT INTO tblproduct (product_name, price, category, stock_quantity) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters (assuming `price` and `stock_quantity` are numeric)
        $stmt->bind_param("sdsi", $product_name, $price, $category, $stock_quantity);

        if ($stmt->execute()) {
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
        }
        $stmt->close();
    } else {
        $_SESSION['status'] = "error";
    }

    // Redirect in case of failure
    header("Location: ../index.php");
    exit();
}
?>
