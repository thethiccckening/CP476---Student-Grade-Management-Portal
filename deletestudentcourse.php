<?php
include 'dbconnection.php';
//check for POST connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   
	$student_id = $_GET['student-id'];
	$course_code = $_GET['course-code'];

    $response = "";

    //delete from courses tables
    $sql = "DELETE FROM Courses WHERE Student_ID = ? AND Course_Code = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("is", $student_id, $course_code);

    // Execute the query and check for success
    if ($stmt->execute()) {
        $response = ['status' => 'success'];
    } else {
        $response = ['error' => 'Failed to delete the record'];
    }

    //delete from final grades
    $sql = "DELETE FROM FinalGrades  WHERE Student_ID = ? AND Course_Code = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("is", $student_id, $course_code);

    // Execute the query and check for success
    if ($stmt->execute()) {
        $response = ['status' => 'success'];
    } else {
        $response = ['error' => 'Failed to delete the record'];
    }

}
echo json_encode($response);

// Close the database connection
$connection->close();
?>

