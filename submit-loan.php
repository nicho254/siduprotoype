<?php
// DB connection
$host = "localhost";
$user = "root";
$password = "";
$database = "sidu_portal";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate required POST fields
$required_fields = [
    "full_name", "id_number", "nationality", "phone", "email",
    "town", "location", "loan_amount", "loan_purpose", "repayment_period"
];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        die("Please fill all required fields: " . $field);
    }
}

// Collect values
$full_name = $_POST["full_name"];
$id_number = $_POST["id_number"];
$nationality = $_POST["nationality"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$town = $_POST["town"];
$location = $_POST["location"];
$landmark = $_POST["landmark"] ?? '';
$ownership = $_POST["ownership"] ?? '';
$business_name = $_POST["business_name"] ?? '';
$years_operation = $_POST["years_operation"] ?? '';
$loan_amount = $_POST["loan_amount"];
$loan_purpose = $_POST["loan_purpose"];
$repayment_period = $_POST["repayment_period"];
$repayment_plan = $_POST["repayment_plan"] ?? '';
$collateral = $_POST["collateral"] ?? '';

// Insert query
$sql = "INSERT INTO loan_applications (
    full_name, id_number, nationality, phone, email,
    town, location, landmark, ownership, business_name,
    years_operation, loan_amount, loan_purpose, repayment_period,
    repayment_plan, collateral, created_at
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssssssssss",
    $full_name, $id_number, $nationality, $phone, $email,
    $town, $location, $landmark, $ownership, $business_name,
    $years_operation, $loan_amount, $loan_purpose, $repayment_period,
    $repayment_plan, $collateral
);

if ($stmt->execute()) {
    header("Location: loan-success.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
