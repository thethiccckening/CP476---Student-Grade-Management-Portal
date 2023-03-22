<?php
// Database connection code here
$host = "localhost";
$user = "root";
$password = "sekou";
$database = "CP476_Student_Management"; // this needs to already exit. 

// Connect to the database
$connection = new mysqli($host, $user, $password, $database);



$action = $_GET['action'];

if ($action == 'students') {
    $query = "SELECT * FROM Students";
} elseif ($action == 'courses') {
    $query = "SELECT * FROM Courses";
} elseif ($action == 'grades') {
    $query = "SELECT * FROM FinalGrades";
}

$result = $connection->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

$connection->close();
?>
