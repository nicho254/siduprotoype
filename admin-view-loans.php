<?php
// admin-view-loans.php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "sidu_portal";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all loan applications
$sql = "SELECT * FROM loan_applications ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View All Loan Applications</title>
    <style>
        body {
            font-family: Arial;
            background: #f9f9f9;
            padding: 20px;
        }
        h2 {
            color: #0077cc;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background: #0077cc;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h2>All Loan Applications</h2>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>ID Number</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Loan Amount</th>
            <th>Purpose</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Submitted At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["full_name"] ?></td>
                <td><?= $row["id_number"] ?></td>
                <td><?= $row["phone"] ?></td>
                <td><?= $row["email"] ?></td>
                <td>Ksh <?= number_format($row["loan_amount"]) ?></td>
                <td><?= $row["loan_purpose"] ?></td>
                <td><?= ucfirst($row["loan_status"]) ?></td>
                <td><?= $row["due_date"] ?: "Pending" ?></td>
                <td><?= $row["created_at"] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No loan applications found.</p>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
