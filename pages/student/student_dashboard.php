<?php
// Start session
session_start();

// Include database connection
include "db.php";

// ======================
// Check if user is logged in
// ======================
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ======================
// FETCH ANNOUNCEMENTS
// ======================
$announcements = [];
$a_sql = "SELECT title, date_posted, description FROM announcements ORDER BY date_posted DESC LIMIT 10";
$a_res = $conn->query($a_sql);
if ($a_res) {
    while ($row = $a_res->fetch_assoc()) {
        $announcements[] = $row;
    }
}

// ======================
// FETCH CATEGORIES
// ======================
$categories = [];
$c_sql = "SELECT * FROM categories ORDER BY name";
$c_res = $conn->query($c_sql);
if ($c_res) {
    while ($row = $c_res->fetch_assoc()) {
        $categories[] = $row;
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id= intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $_SESSION['message'] = "Course deleted successfully.";
    header("Location: student_dashboard.php");
    exit();
}

//Courses
$courses = [];
$c_sql = "SELECT c.*, (SELECT COUNT(*) FROM enrollments e where e.course_id = c.id AND e.status='enrolled') 
AS enrolled_count FROM courses c WHERE c.status='active' ORDER BY c.course_name";
$c_res = $conn->query($c_sql);

if($c_res) {
  while ($row = $c_res->fetch_assoc()) {
    $courses[] = $row;
  }
}

$enrollments = [];
$e_sql = "SELECT e.*, c.course_name, c.course_code
          FROM enrollments e
          JOIN courses c ON e.course_id = c.id
          WHERE e.student_id = {$_SESSION['user_id']}
          ORDER BY e.enrollment_date DESC";

$e_res = $conn->query($e_sql);
if ($e_res) {
    while ($row = $e_res->fetch_assoc()) {
        $enrollments[] = $row;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coding Bootcamp Dashboard</title>
  <link rel="stylesheet" href="/training_system/assets/css/dashboard.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark sticky-top p-2 shadow">
  <a class="navbar-brand px-3">Coding Bootcamp</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="/training_system/logout.php">Logout</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">

    <!-- SIDEBAR -->
    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-logo text-center my-4">
        <img src="/training_system/assets/img/uniten_logo.png" alt="UNITEN Logo" class="img-fluid" style="max-width:120px;">
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active sidebar-link" href="#dashboard">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="#registerCategory">Register Subjects</a></li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="#myEnrollments">My Enrollments</a></li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="#profile">My Profile</a></li>
      </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">

      <!-- DASHBOARD -->
      <div class="section-block" id="dashboard">
        <h1 class="h2 mb-4">Welcome, <?= $_SESSION['full_name']; ?>!</h1>

        <div class="row mb-4">
          <div class="col-md-4">
            <div class="card p-3">
              <h6>Total Subjects</h6>
              <h3><?= count( $courses); ?></h3>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card p-3">
              <h6>Subjects Selected</h6>
              <h3><?= count( $enrollments); ?></h3>
            </div>
          </div>
        </div>

        <!-- ANNOUNCEMENTS -->
        <div class="announcement-small mt-4">
          <h5 class="mb-2"><i class="bi bi-bell-fill announcement-icon"></i> Announcements</h5>
          <ul id="announcementListSmall" class="announcement-list-small">
            <?php foreach ($announcements as $a): ?>
              <li>
                <strong><?= $a['title']; ?></strong> (<?= $a['date_posted']; ?>)
                <p><?= $a['description']; ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <!-- register -->
      <div class="section-block" id="registerCategory">
        <h2 class="mb-3">Register Your Subjects</h2>
        <div class="table-responsive mb-3">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>No.</th>
                <th>Course Name</th>
                <th>Code</th>
                <th>Description</th>
                <th>Enrolled</th>
                <th>Seats Left</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($courses as $i => $course): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $course['course_name'] ?></td>
                <td><?= $course['course_code'] ?></td>
                <td><?= $course['description'] ?></td>
                <td><?= $course['enrolled_count'] ?></td>
                <td><?= max(0, $course['max_participant'] - $course['enrolled_count']) ?></td>
                <td>
                  <?php if ($course['enrolled_count'] < $course['max_participant']): ?>
                    <form action="enroll_process.php" method="POST" style="display:inline;">
                      <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-success">Enroll</button>
                    </form>
                  <?php else: ?>
                    <button class="btn btn-sm btn-secondary" disabled>Full</button>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- myEnrollments -->
      <div class="section-block" id="myEnrollments">
        <h2 class="mb-3">My Enrollments</h2>
        <div class="table-responsive mb-3">
          <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>No.</th>
              <th>Course</th>
              <th>Code</th>
              <th>Status</th>
              <th>Enrollment Date</th>
              <th>Delete</th>
            </tr>
          </thead>
        <tbody>
          <?php foreach ($enrollments as $i => $enroll): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= $enroll['course_name'] ?></td>
              <td><?= $enroll['course_code'] ?></td>
              <td><?= ucfirst($enroll['status']) ?></td>
              <td><?= $enroll['enrollment_date'] ?></td>
              <td>
                <a href="student_dashboard.php?delete_id=<?= $enroll['id']; ?>"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Are you sure?')">
   Delete
</a>
 




            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
        </div>
      </div>

      <!-- PROFILE -->
      <div class="section-block" id="profile">
        <h2 class="mb-3">My Profile</h2>
        <form class="card p-3 mb-5">
          <div class="mb-2">
            <label>Username</label>
            <input type="text" class="form-control" value="<?= $_SESSION['username']; ?>" disabled>
          </div>
          <div class="mb-2">
            <label>Full Name</label>
            <input type="text" class="form-control" value="<?= $_SESSION['full_name']; ?>">
          </div>
          <div class="mb-2">
            <label>Email</label>
            <input type="email" class="form-control" value="<?= $_SESSION['email']; ?>">
          </div>
          <button class="btn btn-primary mt-2" type="submit">Update Profile</button>
        </form>
      </div>

    </main>
  </div>
</div>

</body>
</html>
