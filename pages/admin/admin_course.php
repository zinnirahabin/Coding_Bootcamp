<?php
session_start();
include "db.php";

/* ======================
   ADMIN CHECK
====================== */
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: /training_system/login.php");
    exit();
}

/* ======================
   HANDLE ADD COURSE
====================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_course'])) {

    $course_name     = trim($_POST['course_name']);
    $course_code     = trim($_POST['course_code']);
    $max_participant = (int)$_POST['max_participant'];
    $description     = trim($_POST['description']);
    $duration        = trim($_POST['duration']);
    $status          = $_POST['status'];
    $instructor_id   = 2; // sementara

    if ($course_name && $course_code && $max_participant > 0 && $duration) {

        $stmt = $conn->prepare(
            "INSERT INTO courses
            (course_name, course_code, max_participant, description, instructor_id, duration, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        if ($stmt) {
            $stmt->bind_param(
                "ssissss",
                $course_name,
                $course_code,
                $max_participant,
                $description,
                $instructor_id,
                $duration,
                $status
            );

            if ($stmt->execute()) {
                $_SESSION['success'] = "Course added successfully";
            } else {
                $_SESSION['error'] = "Insert failed: " . $stmt->error;
            }
        } else {
            $_SESSION['error'] = "Prepare failed: " . $conn->error;
        }
    } else {
        $_SESSION['error'] = "Please fill in all required fields.";
    }

    header("Location: admin_course.php");
    exit();
}

/* ======================
   HANDLE SEARCH
====================== */
$search = $_GET['search'] ?? '';
$search_sql = "";

if ($search) {
    $search_sql = "WHERE course_name LIKE ?";
}

/* ======================
   FETCH COURSES
====================== */
$sql = "SELECT * FROM courses $search_sql ORDER BY course_name";
$stmt = $conn->prepare($sql);

if ($search) {
    $like = "%$search%";
    $stmt->bind_param("s", $like);
}

$stmt->execute();
$result  = $stmt->get_result();
$courses = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Management</title>

<style>
body {
    font-family: Arial, sans-serif;
    padding: 20px;
}
table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 25px;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
}
th {
    background: #f2f2f2;
}
.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
}
.alert-error {
    background: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
}
</style>
</head>

<body>

<h2>Course Management</h2>

<!-- SUCCESS MESSAGE -->
<?php if (isset($_SESSION['success'])): ?>
<div class="alert-success"><?= $_SESSION['success']; ?></div>
<?php unset($_SESSION['success']); endif; ?>

<!-- ERROR MESSAGE -->
<?php if (isset($_SESSION['error'])): ?>
<div class="alert-error"><?= $_SESSION['error']; ?></div>
<?php unset($_SESSION['error']); endif; ?>

<!-- SEARCH -->
<form method="GET" style="margin-bottom:15px;">
    <input type="text" name="search" placeholder="Search courses..."
           value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>

<!-- COURSE TABLE -->
<table>
<tr>
    <th>No</th>
    <th>Course Name</th>
    <th>Course Code</th>
    <th>Max Participants</th>
    <th>Status</th>
    <th>Duration</th>
    <th>Action</th>
</tr>

<?php if (count($courses) > 0): ?>
<?php foreach ($courses as $i => $c): ?>
<tr>
    <td><?= $i + 1 ?></td>
    <td><?= htmlspecialchars($c['course_name']) ?></td>
    <td><?= htmlspecialchars($c['course_code']) ?></td>
    <td><?= $c['max_participant'] ?></td>
    <td><?= ucfirst($c['status']) ?></td>
    <td><?= $c['duration'] ?></td>
    <td>
        <a href="admin_course_edit.php?id=<?= $c['id']; ?>">Edit</a>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="7">No courses found</td>
</tr>
<?php endif; ?>
</table>

<!-- ADD COURSE -->
<h3>Add New Course</h3>

<form method="POST" action="admin_course.php">

    <input type="hidden" name="add_course" value="1">

    <label>Course Name</label><br>
    <input type="text" name="course_name" required><br><br>

    <label>Course Code</label><br>
    <input type="text" name="course_code" required><br><br>

    <label>Max Participants</label><br>
    <input type="number" name="max_participant" min="1" required><br><br>

    <label>Description</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Duration</label><br>
    <input type="text" name="duration" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select><br><br>

    <button type="submit">Add Course</button>
</form>

</body>
</html>
