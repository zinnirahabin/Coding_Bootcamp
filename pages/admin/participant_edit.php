<?php
$participant_id = $_GET['id'] ?? 0;

// Dummy data (replace later with DB)
$participant = [
    'id' => $participant_id,
    'username' => 'nrlhsnzt',
    'full_name' => 'Nurul Husna Izzati binti Sollekhan',
    'email' => 'husnaizzati6833@gmail.com',
    'phone' => '0136256470',
];

$enrolled_courses = [
    [
        'course_id' => 1,
        'course_name' => 'JAVA Programming'
    ],
    [
        'course_id' => 2,
        'course_name' => 'Web Programming'
    ],
];

$all_courses = [
    ['id' => 1, 'name' => 'JAVA Programming'],
    ['id' => 2, 'name' => 'Web Programming'],
    ['id' => 3, 'name' => 'Python Programming'],
    ['id' => 4, 'name' => 'Swift Programming'],
    ['id' => 5, 'name' => 'C++ Programming'],
    ['id' => 6, 'name' => 'Dart Programming'],
];

$enrolled_ids = array_column($enrolled_courses, 'course_id');

?>


<div class="content">
    <div class="edit-container">
        <div class="edit-header">
            <h2>Edit Participant</h2>
            <a href="#view?id=<?php echo $participant['id']; ?>" class="btn-back-edit">
                Back
            </a>
        </div>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $participant['id']; ?>">

            <label>Username</label>
            <input type="text" name="username"
                   value="<?php echo htmlspecialchars($participant['username']); ?>" readonly>

            <label>Full Name</label>
            <input type="text" name="full_name"
                   value="<?php echo htmlspecialchars($participant['full_name']); ?>" required>

            <label>Email</label>
            <input type="email" name="email"
                   value="<?php echo htmlspecialchars($participant['email']); ?>" required>

            <label>Phone</label>
            <input type="text" name="phone"
                   value="<?php echo htmlspecialchars($participant['phone']); ?>">

            <div class="info-item">
                <label>Enrolled Courses</label>

                <div class="course-checkbox-list">
                    <?php foreach ($all_courses as $course): ?>
                        <label class="course-checkbox">
                            <input type="checkbox"
                                name="courses[]"
                                value="<?php echo $course['id']; ?>"
                                <?php echo in_array($course['id'], $enrolled_ids) ? 'checked' : ''; ?>>
                            <?php echo htmlspecialchars($course['name']); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>


            <button type="submit" class="save-btn">Save Changes</button>
            <a href="#participant" class="cancel-btn">Cancel</a>
        </form>
    </div>
</div>
