<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "sidu_portal");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate form
if (empty($email) || empty($password)) {
    echo "Please fill in both email and password.";
    exit;
}

// Check if user exists
$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        header("Location: user-dashboard.php"); // Change this to your user dashboard file
        exit;
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No account found with that email.";
}

$stmt->close();
$conn->close();
?>
