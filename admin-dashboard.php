<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin-login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Sidu International Ltd</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e6f2ff;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #3399ff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        main {
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }
        h2 {
            color: #005580;
        }
        .btn {
            display: inline-block;
            background-color: #FFD700;
            color: #000;
            padding: 12px 20px;
            margin: 10px 5px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        .btn:hover {
            background-color: #e6c200;
        }
        .section {
            margin-bottom: 40px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<header>
    <h1>Sidu International Ltd</h1>
    <p>Admin Dashboard</p>
</header>

<main>
    <div class="section">
        <h2>Welcome, Admin</h2>
        <p>Use the options below to manage loan applications and user repayments.</p>

        <a href="admin-applications.php" class="btn">View Loan Applications</a>
        <a href="view-repayments.php" class="btn">View Loan Repayments</a>
        <!-- Add more buttons below as needed -->
    </div>

    <div class="section">
        <h2>Next Features (Coming Soon)</h2>
        <ul>
            <li>Update Loan Status</li>
            <li>Generate Downloadable PDFs</li>
            <li>Search/Filter Applications</li>
            <li>Manage Registered Users</li>
        </ul>
    </div>
</main>

</body>
</html>
