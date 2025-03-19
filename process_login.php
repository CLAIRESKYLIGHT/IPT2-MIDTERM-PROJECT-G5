<?php
session_start(); // Start a session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example: Hardcoded credentials (Replace with database verification)
    $valid_username = "admin";
    $valid_password = "password123";

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['user'] = $username; // Store user session
        header("Location: dashboard.php"); // Redirect to the dashboard
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: index.php"); // Redirect back to index.php
        exit();
    }
}
?>
