<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    exit("Unauthorized");
}

$student_id = intval($_GET['id']);

// Student info
$studentSql = "SELECT full_name, email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($studentSql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Enrolled courses
$courseSql = "
    SELECT c.course_name, c.course_code, e.status
    FROM enrollments e
    JOIN courses c ON e.course_id = c.id
    WHERE e.student_id = ?
";
$stmt = $conn->prepare($courseSql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$courses = $stmt->get_result();
$stmt->close();
?>

<h3>Student Details</h3>

<p><b>Name:</b> <?= $student['full_name']; ?></p>
<p><b>Email:</b> <?= $student['email']; ?></p>

<h4>Enrolled Courses</h4>

<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Course</th>
            <th>Code</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; while ($c = $courses->fetch_assoc()): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $c['course_name']; ?></td>
            <td><?= $c['course_code']; ?></td>
            <td><?= ucfirst($c['status']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
