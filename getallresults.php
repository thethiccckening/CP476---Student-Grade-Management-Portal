<?php
include 'dbconnection.php';

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
