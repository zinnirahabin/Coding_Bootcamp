<?php
session_start();
if ($_SESSION['user_type'] != 'instructor') {
    header("Location: ../login.php");
}
?>

<h1>Instructor Dashboard</h1>

<p>Welcome, <?php echo $_SESSION['username']; ?></p>

<ul>
    <li>Manage Courses</li>
    <li>Upload Materials</li>
    <li>View Students</li>
</ul>

<a href="/training_system/logout.php">Logout</a>

