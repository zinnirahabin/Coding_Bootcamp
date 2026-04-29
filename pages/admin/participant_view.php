<?php
// Get participant ID from URL
$participant_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Dummy data for now - will replace with real database query later
$participant = [
    'id' => $participant_id,
    'username' => 'nrlhsnzt',
    'full_name' => 'Nurul Husna Izzati binti Sollekhan',
    'email' => 'husnaizzati6833@gmail.com',
    'phone' => '0136256470',
    'password' => '********',
];

// Dummy enrolled courses
$enrolled_courses = [
    [
        'course_name' => 'JAVA Programming',
    ],

    [
        'course_name' => 'Web Programming',
    ],
];
?>

<div class="content">
    <div class="view-container">
        <!-- Header with Back Button -->
        <div class="view-header">
            <h2>Participant Details</h2>
            <div class="header-actions">
                <a href="#participant" class="btn-back">Back</a>
                <a href="#edit?id=<?php echo $participant['id']; ?>" class="btn-edit">Edit</a>
                <a href="participant_delete.php?id=<?php echo $participant['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this participant?');">Delete</a>
            </div>
        </div>

        <!-- Participant Information Card -->
        <div class="info-card">
            <h3>Personal Information</h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <label>Username</label>
                    <p><?php echo htmlspecialchars($participant['username']); ?></p>
                </div>
                
                <div class="info-item">
                    <label>Full Name</label>
                    <p><?php echo htmlspecialchars($participant['full_name']); ?></p>
                </div>
                
                <div class="info-item">
                    <label>Email Address</label>
                    <p><?php echo htmlspecialchars($participant['email']); ?></p>
                </div>
                
                <div class="info-item">
                    <label>Phone Number</label>
                    <p><?php echo htmlspecialchars($participant['phone']); ?></p>
                </div>
                
                <div class="info-item">
                    <label>Password</label>
                    <p><?php echo $participant['password']; ?></p>
                </div>
                
                </div>
            </div>
        </div>

        <!-- Enrolled Courses Card -->
        <div class="info-card">
            <h3>Enrolled Courses</h3>
            
            <?php if(empty($enrolled_courses)): ?>
                <p class="no-data">No courses enrolled yet.</p>
            <?php else: ?>
                <div class="courses-list">
                    <?php foreach($enrolled_courses as $course): ?>
                        <div class="course-item" style="margin-bottom: 20px">
                            <div class="course-info">
                                <h4><?php echo htmlspecialchars($course['course_name']); ?></h4>
                            </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>