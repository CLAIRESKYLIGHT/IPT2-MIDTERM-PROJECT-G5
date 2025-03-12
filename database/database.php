<?php
    $servername = "localhost";
    $db_name = "ipt2-project.db";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "";
    }
?>