<?php
session_start();
include "db.php";

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'])) {
    $course_id = intval($_POST['course_id']);
    $student_id = $_SESSION['user_id'];

    // Check if already enrolled
    $check = $conn->query("SELECT * FROM enrollments WHERE student_id=$student_id AND course_id=$course_id AND status='enrolled'");
    if ($check->num_rows > 0) {
        $_SESSION['message'] = "You are already enrolled in this course.";
        header("Location: student_dashboard.php#registerCategory");
        exit();
    }

    // Check seats available
    $course = $conn->query("SELECT max_participant, (SELECT COUNT(*) FROM enrollments WHERE course_id=$course_id AND status='enrolled') as enrolled_count FROM courses WHERE id=$course_id")->fetch_assoc();
    if ($course['enrolled_count'] >= $course['max_participant']) {
        $_SESSION['message'] = "Sorry, this course is full.";
        header("Location: student_dashboard.php#registerCategory");
        exit();
    }

    // Insert enrollment
    $conn->query("INSERT INTO enrollments (student_id, course_id) VALUES ($student_id, $course_id)");
    $_SESSION['message'] = "Successfully enrolled!";
    header("Location: student_dashboard.php#myEnrollments");
    exit();
}
?>
