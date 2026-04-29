<?php

/*
session_start();
require_once 'config/database.php';
$db = (new Database())->getConnection();
*/

// Get course and section ID from URL
$course_id = $_GET['course_id'] ?? 0;
$section_number = $_GET['section'] ?? 1;

// Dummy course data - replace with DB query
$course = [
    'id' => $course_id,
    'name' => 'Web Development',
    'section' => $section_number,
    'date' => '12/02/2025',
    'start_time' => '10:00',
    'end_time' => '12:00',
    'max_participants' => 20,
    'total_participants' => 15
];

// Dummy enrolled students
$students = [
    ['id' => 1, 'username' => 'nrlhsnzt', 'full_name' => 'Nurul Husna', 'email' => 'husna@gmail.com'],
    ['id' => 2, 'username' => 'zinnirah', 'full_name' => 'Zinnirah', 'email' => 'zinnirah@gmail.com'],
    ['id' => 3, 'username' => 'ali123', 'full_name' => 'Ali Bin Abu', 'email' => 'ali@gmail.com'],
];
?>

<div class="content">
    <div class="course-view-container">
        <!-- Header with Back -->
        <div class="view-header">
            <h2>Course Details</h2>
            <a href="#course" class="btn-back-course">Back</a>
        </div>

        <!-- Course Edit Form -->
        <div class="edit-course-section">
            <h3>Edit Course Information</h3>
            <form method="POST" action="course_update.php">
                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                <input type="hidden" name="section_number" value="<?php echo $course['section']; ?>">

                <label>Course Name</label>
                <input type="text" name="course_name" value="<?php echo htmlspecialchars($course['name']); ?>" class="form-input" required>

                <label>Section Number</label>
                <input type="number" name="section" value="<?php echo $course['section']; ?>" class="form-input" min="1" required>

                <label>Date</label>
                <input type="date" name="date" value="<?php echo $course['date']; ?>" class="form-input" required>

                <label>Start Time</label>
                <input type="time" name="start_time" value="<?php echo $course['start_time']; ?>" class="form-input" required>

                <label>End Time</label>
                <input type="time" name="end_time" value="<?php echo $course['end_time']; ?>" class="form-input" required>

                <label>Slot Capacity</label>
                <input type="number" name="max_participants" value="<?php echo $course['max_participants']; ?>" class="form-input" min="1" required>

                <button type="submit" class="save-btn">Save Changes</button>
            </form>
        </div><br>

        <!-- Enrolled Students -->
        <div class="enrolled-students-section">
            <h3>Enrolled Students (<?php echo count($students); ?>/<?php echo $course['max_participants']; ?>)</h3>
            <?php if (empty($students)): ?>
                <p>No students enrolled yet.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['username']); ?></td>
                                <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>




