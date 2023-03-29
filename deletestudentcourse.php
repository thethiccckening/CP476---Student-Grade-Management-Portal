<?php
include 'dbconnection.php';
//check for POST connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   
	$student_id = $_GET['student-id'];
	$course_code = $_GET['course-code'];


    //validate and sanitize
	$student_id = filter_var($student_id, FILTER_VALIDATE_INT);
	$student_id = filter_var($student_id, FILTER_SANITIZE_NUMBER_INT);

	$coursepattern = "/^[a-zA-Z]{2}\d{3}$/";
	$options = array("options" => array("regexp" => $coursepattern));
	$course_code = filter_var($course_code, FILTER_VALIDATE_REGEXP, $options);

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

