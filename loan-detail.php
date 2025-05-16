<?php
$conn = new mysqli("localhost", "root", "", "sidu_portal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM loan_applications WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$loan = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Loan Details</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f2faff;
            padding: 20px;
        }
        h2 {
            color: #045eab;
        }
        .info-section {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px #ccc;
            margin-bottom: 20px;
        }
        .info-section h3 {
            color: goldenrod;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .info-section p {
            margin: 4px 0;
        }
        .uploaded img {
            max-width: 200px;
            margin-right: 15px;
        }
        .uploaded a {
            display: inline-block;
            margin-top: 8px;
            color: #045eab;
        }
    </style>
</head>
<body>

<h2>Loan Application Details</h2>

<div class="info-section">
    <h3>Applicant Info</h3>
    <p><strong>Name:</strong> <?= htmlspecialchars($loan['applicant_name']) ?></p>
    <p><strong>ID Number:</strong> <?= $loan['id_number'] ?></p>
    <p><strong>Phone:</strong> <?= $loan['phone'] ?></p>
    <p><strong>Email:</strong> <?= $loan['email'] ?></p>
    <p><strong>Town:</strong> <?= $loan['town'] ?></p>
</div>

<div class="info-section">
    <h3>Loan Details</h3>
    <p><strong>Amount:</strong> <?= $loan['loan_amount'] ?> (<?= $loan['loan_words'] ?>)</p>
    <p><strong>Purpose:</strong> <?= $loan['loan_purpose'] ?></p>
    <p><strong>Interest Rate:</strong> <?= $loan['interest_rate'] ?>%</p>
    <p><strong>Repayment Plan:</strong> <?= $loan['repayment_plan'] ?></p>
    <p><strong>Collateral:</strong> <?= $loan['collateral_description'] ?></p>
</div>

<div class="info-section uploaded">
    <h3>Uploaded Files</h3>
    <?php if ($loan['passport_photo']): ?>
        <div><strong>Passport Photo:</strong><br><img src="<?= $loan['passport_photo'] ?>" alt="Passport"></div>
    <?php endif; ?>
    <?php if ($loan['id_front']): ?>
        <div><strong>ID Front:</strong><br><img src="<?= $loan['id_front'] ?>" alt="ID Front"></div>
    <?php endif; ?>
    <?php if ($loan['id_back']): ?>
        <div><strong>ID Back:</strong><br><img src="<?= $loan['id_back'] ?>" alt="ID Back"></div>
    <?php endif; ?>
    <?php if ($loan['collateral_doc']): ?>
        <div><strong>Collateral Doc:</strong><br><a href="<?= $loan['collateral_doc'] ?>" target="_blank">View PDF</a></div>
    <?php endif; ?>
</div>

</body>
</html>
