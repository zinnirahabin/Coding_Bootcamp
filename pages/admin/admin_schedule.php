<div class="content">
      <h2>Full Schedule</h2>
        <div class="timetable">
            <div class="header-row">
                <div class="time-slot"></div>
                    <div>Monday</div>
                    <div>Tuesday</div>
                    <div>Wednesday</div>
                    <div>Thursday</div>
                    <div>Friday</div>
                    <div>Saturday</div>
                    <div>Sunday</div>
                </div>
                
                <div class="time-row">
                    <div class="time-slot">08:00 - 10:00</div>
                    <div class="class">-</div>
                    <div class="class">C++ Fundamentals (Sec 1)</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                </div>
                

                <div class="time-row">
                    <div class="time-slot">10:00 - 12:00</div>
                    <div class="class">Web Development (Sec 1)</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">Python Data (Sec 2)</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                </div>

                <div class="time-row">
                    <div class="time-slot">13:00 - 15:00</div>
                    <div class="class">Web Development (Sec 1)</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                </div>

                <div class="time-row">
                    <div class="time-slot">15:00 - 17:00</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">C++ Fundamentals (Sec 2)</div>
                    <div class="class">-</div>
                </div>

                <div class="time-row">
                    <div class="time-slot">17:00 - 19:00</div>
                    <div class="class">-</div>
                    <div class="class">Web Development (Sec 2)</div>
                    <div class="class">Java Programming (Sec 1)</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                </div>

                <div class="time-row">
                    <div class="time-slot">19:00 - 21:00</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">-</div>
                    <div class="class">Python Data (Sec 2)</div>
                </div>
        </div>

  </div>


<?php
/*
session_start();
require_once 'database.php';
require_once 'Course.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize Course object
$courseObj = new Course($db);

// Fetch all course sections with course name and day
$scheduleData = $courseObj->getScheduleData(); // Make sure this method returns array like below:


// Define time slots
$timeSlots = [
    '08:00 - 10:00' => ['start' => '08:00', 'end' => '10:00'],
    '10:00 - 12:00' => ['start' => '10:00', 'end' => '12:00'],
    '13:00 - 15:00' => ['start' => '13:00', 'end' => '15:00'],
    '15:00 - 17:00' => ['start' => '15:00', 'end' => '17:00'],
    '17:00 - 19:00' => ['start' => '17:00', 'end' => '19:00'],
    '19:00 - 21:00' => ['start' => '19:00', 'end' => '21:00']
];

// Define days
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// Prepare empty schedule
$schedule = [];
foreach ($timeSlots as $slot => $times) {
    foreach ($days as $day) {
        $schedule[$slot][$day] = '-';
    }
}

// Fill schedule with courses
foreach ($scheduleData as $c) {
    $courseTime = $c['start_time'] . ' - ' . $c['end_time'];
    $day = $c['day_of_week'];
    $display = $c['name'] . ' (Sec ' . $c['section'] . ')';

    foreach ($timeSlots as $slot => $times) {
        if ($courseTime === $slot) {
            $schedule[$slot][$day] = $display;
            break;
        }
    }
}
*/
?>