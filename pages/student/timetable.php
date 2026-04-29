<?php
session_start();

/* ======================
   DATABASE CONNECTION
   ====================== */
$conn = mysqli_connect("localhost", "root", "", "learning_system");
if (!$conn) {
    die("Database connection failed");
}

/* ======================
   TEMP USER (REMOVE LATER)
   ====================== */
$_SESSION['username'] = $_SESSION['username'] ?? "student123";

/* ======================
   FETCH USER TIMETABLE
   ====================== */
$sql = "
SELECT 
  c.name AS subject,
  s.day,
  s.time
FROM enrollments e
JOIN sections s ON e.section_id = s.id
JOIN categories c ON s.category_id = c.id
WHERE e.username = '".$_SESSION['username']."'
";

$result = mysqli_query($conn, $sql);

/* ======================
   STORE DATA
   ====================== */
$timetable = [];

while ($row = mysqli_fetch_assoc($result)) {
    $timetable[] = $row;
}

/* ======================
   TIME SLOTS (STATIC)
   ====================== */
$timeSlots = [
  "8 AM - 10 AM",
  "9 AM - 11 AM",
  "10 AM - 12 PM",
  "1 PM - 3 PM",
  "2 PM - 4 PM",
  "3 PM - 5 PM"
];

$days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Timetable</title>

  <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>

<body class="p-4">

<h1>Class Timetable</h1>

<div class="table-responsive mt-4">
<table class="table table-bordered table-sm">

<thead>
<tr>
  <th>Time</th>
  <?php foreach ($days as $d) { ?>
    <th><?= $d ?></th>
  <?php } ?>
</tr>
</thead>

<tbody>

<?php foreach ($timeSlots as $time) { ?>
<tr>
  <td><strong><?= $time ?></strong></td>

  <?php foreach ($days as $day) { ?>
    <td>
      <?php
      foreach ($timetable as $t) {
        if ($t['day'] == $day && $t['time'] == $time) {
          echo $t['subject'];
        }
      }
      ?>
    </td>
  <?php } ?>

</tr>
<?php } ?>

</tbody>

</table>
</div>

</body>
</html>
