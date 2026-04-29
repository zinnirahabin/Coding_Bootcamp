<?php
session_start();
include "../../db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: /training_system/login.php");
    exit();
}

$sql = "
    SELECT 
        u.user_id,
        u.full_name,
        u.email,
        COUNT(e.id) AS total_courses
    FROM users u
    LEFT JOIN enrollments e ON u.user_id = e.student_id
    WHERE u.user_type = 'student'
    GROUP BY u.user_id
    ORDER BY u.full_name
";

$result = $conn->query($sql);
?>

<h2>Participants</h2>

<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Enrolled Courses</th>
            <th>Details</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $row['full_name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['total_courses']; ?></td>
            
            <td>
                <a href="participant_detail.php?id=<?= $row['user_id']; ?>" class="btn btn-sm">
                    View
                </a>

            </td>
            <td>
                <a href="delete_participant.php?id=<?= $row['user_id']; ?>"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this participant? This action cannot be undone.');">
                    Delete
                </a>
            </td>

            
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
