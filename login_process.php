<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: login.php");
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    echo "Invalid username or password";
    exit();
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    echo "Invalid username or password";
    exit();
}

$_SESSION['user_id']   = $user['user_id'];
$_SESSION['username']  = $user['username'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['email']     = $user['email'];
$_SESSION['user_type'] = $user['user_type'];

if ($user['user_type'] == 'admin') {
    header("Location: pages/admin/admin_layout.html");
}
elseif ($user['user_type'] == 'instructor') {
    header("Location: pages/instructor/instructor_dashboard.php");
}
else {
    header("Location: pages/student/student_dashboard.php");
}
exit();
?>
