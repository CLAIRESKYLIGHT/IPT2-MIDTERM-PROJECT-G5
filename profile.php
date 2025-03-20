<?php
session_start();

// Simulate an admin login (as SQL is not used)
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
    <title>Admin Profile - Group 5</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <style>
        /* Light blue gradient background */
        body {
            background: linear-gradient(135deg, #b3e0ff, #80bfff);
            font-family: 'Poppins', sans-serif;
        }

        /* Center container */
        .container {
            max-width: 900px;
            margin: auto;
        }

        /* Glassmorphism style */
        .card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            color: #333;
        }

        /* Header styling */
        .header {
            background: rgba(0, 123, 255, 0.8);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 15px 15px 0 0;
        }

        /* Button styling */
        .btn-primary {
            background: #007bff;
            border: none;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-danger {
            background: #dc3545;
            border: none;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn-danger:hover {
            background: #a71d2a;
        }

        /* Group member box */
        .group-member {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 15px;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .group-member:hover {
            transform: scale(1.05);
        }

        /* Footer text */
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: white;
        }

    </style>
</head>
<body>

<div class="container mt-5">
    <!-- Admin Card -->
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

    <!-- Group Members -->
    <h3 class="mt-4 text-center text-white">Group Members</h3>
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

    <div class="footer">
        <p>Designed by Group 5 | Midterm Project</p>
    </div>
</div>

</body>
</html>
