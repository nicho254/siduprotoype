<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.php");
    exit();
}

$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM loan_applications ORDER BY id DESC";

if ($search) {
    $search = "%$search%";
    $stmt = $conn->prepare("SELECT * FROM loan_applications WHERE full_name LIKE ? OR id_number LIKE ? OR phone_number LIKE ? OR status LIKE ? ORDER BY id DESC");
    $stmt->bind_param("ssss", $search, $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Applications - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef7ff;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #005580;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .view-link {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        .view-link:hover {
            text-decoration: underline;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 300px;
        }
        button {
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>All Loan Applications</h2>

<form method="get" action="admin-applications.php">
    <input type="text" name="search" placeholder="Search by Name, ID, Phone" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit">Search</button>
</form>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Applicant</th>
            <th>ID Number</th>
            <th>Phone</th>
            <th>Loan Amount</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['full_name']) ?></td>
                <td><?= htmlspecialchars($row['id_number']) ?></td>
                <td><?= htmlspecialchars($row['phone_number']) ?></td>
                <td>Ksh <?= number_format($row['loan_amount']) ?></td>
                <td><a class="view-link" href="loan-details.php?id=<?= $row['id'] ?>">View Details</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No loan applications found.</p>
<?php endif; ?>

</body>
</html>
