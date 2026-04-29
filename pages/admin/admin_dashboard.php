<?php
include "db.php";

// Mock data (no database)
$totalStudents = 1204;
$availableCourses = 42;
$fullCourses = 7;
$upcomingCourses = 3;

// Functions for total users
$totalStudents = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];

// Function for available courses
//$availableCourses = $conn->query("SELECT COUNT(*) FROM courses WHERE enrolled_students < quota")->fetch_assoc()['count'];
  
// Function for full capacity courses
//$fullCourses = $conn->query("SELECT COUNT(*) FROM courses WHERE enrolled_students >= quota")->fetch_assoc()['count'];

// Functions for upcoming challenges
//$upcomingCourses = $conn->query("SELECT COUNT(*) FROM courses WHERE date_time > NOW()")->fetch_assoc()['count'];

?>



<!-- Banner Image -->
<div class="banner">
  <div class="overlay"></div>
  <div class="banner-text">
    <h1><b>DASHBOARD OVERVIEW</b></h1>
    <p>Welcome to Coding Bootcamp Admin Panel</p>
  </div>
</div><br><br>

    
    <!-- Main dashboard overview -->
    <div class="content">

      <!-- Statistics cards -->
      <div class="cards">
        <div class="card">
            <h3>Total Students</h3>
            <p class="text-primary"><?= $totalStudents ?></p>
        </div>

        <div class="card">
            <h3>Available Courses</h3>
            <p class="text-warning"><?= $availableCourses ?></p>
        </div>

        <div class="card">
            <h3>Full Capacity Courses</h3>
            <p class="text-success"><?= $fullCourses ?></p>
        </div>

        <div class="card">
            <h3>Upcoming Courses</h3>
            <p class="text-info"><?= $upcomingCourses ?></p>
        </div>
      </div>

    
