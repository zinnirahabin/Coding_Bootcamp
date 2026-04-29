<?php
session_start();
include "db.php";

// Admin check
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: /training_system/login.php");
    exit();
}

// Get course ID
if (!isset($_GET['id'])) {
    header("Location: admin_course.php");
    exit();
}

$course_id = intval($_GET['id']);

// Fetch course
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    $_SESSION['error'] = "Course not found.";
    header("Location: admin_layout.html#course");
    exit();
}

/* =====================
   UPDATE COURSE
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_course'])) {
    $name = trim($_POST['course_name']);
    $code = trim($_POST['course_code']);
    $max = intval($_POST['max_participant']);
    $desc = trim($_POST['description']);
    $status = $_POST['status'] === 'active' ? 'active' : 'inactive';

    if ($name && $code && $max) {
        $stmt = $conn->prepare("
            UPDATE courses 
            SET course_name = ?, course_code = ?, max_participant = ?, description = ?, status = ?
            WHERE id = ?
        ");
        $stmt->bind_param("ssissi", $name, $code, $max, $desc, $status, $course_id);
        $stmt->execute();

        $_SESSION['message'] = "Course updated successfully.";
        header("Location: admin_layout.html#course");
        exit();
    } else {
        $error = "Please fill in all required fields.";
    }
}

?>

<h2>Edit Course</h2>

<?php if(isset($error)): ?>
    <div class="message error"><?= $error; ?></div>
<?php endif; ?>

<form method="POST">
    <label>Course Name</label>
    <input type="text" name="course_name" value="<?= htmlspecialchars($course['course_name']); ?>" required>

    <label>Course Code</label>
    <input type="text" name="course_code" value="<?= htmlspecialchars($course['course_code']); ?>" required>

    <label>Max Participants</label>
    <input type="number" name="max_participant" min="1" value="<?= $course['max_participant']; ?>" required>

    <label>Description</label>
    <textarea name="description"><?= htmlspecialchars($course['description']); ?></textarea>

    <label>Status</label>
    <select name="status">
        <option value="active" <?= $course['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
        <option value="inactive" <?= $course['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
    </select>

    <button type="submit" name="update_course">Update Course</button>
</form>

<a href="admin_layout.html#course">Back to Course List</a>
