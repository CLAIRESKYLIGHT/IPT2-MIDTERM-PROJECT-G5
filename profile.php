<?php
session_start();

// Simulate an admin login (since we're not using SQL)
$_SESSION['username'] = "admin5";

// Check if the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['username'] !== "admin5") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 800px;
        }

        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card p {
            margin: 5px 0;
        }

        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-danger {
            background: #dc3545;
            border: none;
            transition: 0.3s;
        }

        .btn-danger:hover {
            background: #a71d2a;
        }

        .group-member {
            border: 2px solid #007bff;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="header">
            <h2>Group 5 - Admin Profile</h2>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> Group 5</p>
            <p><strong>Email:</strong> admin5@mail.com</p>
            <p><strong>Username:</strong> admin</p>
            <p><strong>Project:</strong> Midterm</p>
            <a href="logout.php" class="btn btn-danger w-100">Logout</a>
        </div>
    </div>

    <h3 class="mt-4 text-center">Group Members</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="group-member">
                <p><strong>Name:</strong> BIO, ANGELA CLAIRE G.</p>
                <p><strong>Email:</strong> bioangela3@gmail.com</p>
                <p><strong>Username:</strong> CLAIRESKYLIGHT</p>
                <p><strong>Role:</strong> Main Host</p>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="group-member">
                <p><strong>Name:</strong> FEREIRA, MAXENE</p>
                <p><strong>Email:</strong> maxeneduavepereira325@gmail.com</p>
                <p><strong>Username:</strong> geumaxh</p>
                <p><strong>Role:</strong> Editor/Designer</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="group-member">
                <p><strong>Name:</strong> HALLIG, EUGENE</p>
                <p><strong>Email:</strong> eugenehallig35@gmail.com</p>
                <p><strong>Username:</strong> EugeneHallig27</p>
                <p><strong>Role:</strong> Editor</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="group-member">
                <p><strong>Name:</strong> TOLOSA, BIANCA MAE</p>
                <p><strong>Email:</strong> fortetolosabiancamae@gmail.com</p>
                <p><strong>Username:</strong> BI4NC4-M43</p>
                <p><strong>Role:</strong> Group Member</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
