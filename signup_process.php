<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: signup.php");
    exit();
}

$username  = trim($_POST['username']);
$password  = $_POST['password'];
$confirm   = $_POST['confirm_password'];
$full_name = trim($_POST['full_name']);
$email     = trim($_POST['email']);
$phone     = trim($_POST['phone']);
$user_type = $_POST['user_type']; // student / instructor / admin

if ($password != $confirm) {
    echo "Passwords do not match";
    exit();
}

if (strlen($password) < 6) {
    echo "Password must be at least 6 characters";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
    exit();
}

$checkUser = "SELECT user_id FROM users WHERE username='$username'";
$result = $conn->query($checkUser);

if ($result->num_rows > 0) {
    echo "Username already exists";
    exit();
}

$checkEmail = "SELECT user_id FROM users WHERE email='$email'";
$result = $conn->query($checkEmail);

if ($result->num_rows > 0) {
    echo "Email already registered";
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users 
(username, password, full_name, email, phone, user_type)
VALUES
('$username', '$hashed_password', '$full_name', '$email', '$phone', '$user_type')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
} else {
    echo "Error: " . $conn->error;
}
?>
