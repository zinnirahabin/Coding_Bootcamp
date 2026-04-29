<?php
session_start();
include "db.php";

// Admin check
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: /training_system/login.php");
    exit();
}

// Validate ID
if (!isset($_GET['id'])) {
    header("Location: admin_participant.php");
    exit();
}

$student_id = (int) $_GET['id'];

// 1️⃣ Delete enrollments first
$conn->query("DELETE FROM enrollments WHERE student_id = $student_id");

// 2️⃣ Delete user
$conn->query("DELETE FROM users WHERE user_id = $student_id");

// Redirect back
header("Location: admin_layout.html#Participant");
exit();
