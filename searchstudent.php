<?php
// Your database connection code here
// Replace these values with your own MySQL server information
$host = "localhost";
$user = "root";
$password = "sekou";
$database = "CP476_Student_Management"; // this needs to already exit. 
// Connect to the database
$connection = new mysqli($host, $user, $password, $database);

// Check which form was submitted
#$form_name = $_GET['form_name'];
$action = $_GET['action'];


if ($action === 'search_student_info') {
	// Handle form 1 submission
	  
	// Get the data from form 1
	$student_id = $_GET['student-id'];

	// Your SQL query and display code for form 1 here
	$sql = "SELECT * FROM students WHERE Student_ID = ?";
	$stmt = $connection->prepare($sql);
	$stmt->bind_param("i", $student_id); 
	$stmt->execute();
	$result = $stmt->get_result();
	$data = [];
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}

	header('Content-Type: application/json');

	if ($result->num_rows > 0){
		echo json_encode($data);
	} else {
		$error_message = ' No results found with Student ID: '.$student_id ;
		echo json_encode(['error' => $error_message]);
	} 

} elseif ($action === 'search_student_course') {
  	// Handle form 2 submission

  	// Get the data from form 2
	$student_id = $_GET['student-id'];
	$course_code = $_GET['course-code'];

	// SQL query to search for course code and student code
	if ( $student_id == "") {
		$sql = "SELECT * FROM courses WHERE Course_Code = ?";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("s", $course_code); 
	} else if ($course_code == ""){
		$sql = "SELECT * FROM courses WHERE Student_ID = ?";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("i", $student_id); 
	} else {
		$sql = "SELECT * FROM courses WHERE Student_ID = ? AND Course_Code = ?";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("is", $student_id, $course_code); 
	}

	$stmt->execute();
	$result = $stmt->get_result();
	$data = [];
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}

	header('Content-Type: application/json');

	if ($result->num_rows > 0){
		echo json_encode($data);
	} else {
		$error_message = ' No results found with Student ID: '.$student_id .' and Course Code: '.$course_code;
		echo json_encode(['error' => $error_message]);
	} 

} elseif ($action === 'search_student_final') { 
	// Handle form 2 submission

  	// Get the data from form 2
	  $student_id = $_GET['student-id'];
	  $course_code = $_GET['course-code'];


	  // SQL query to search for course code and student code
	if ( $student_id == "") {
		$sql = "SELECT * FROM FinalGrades WHERE Course_Code = ?";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("s", $course_code); 
	} else if ($course_code == ""){
		$sql = "SELECT * FROM FinalGrades WHERE Student_ID = ?";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("i", $student_id); 
	} else {
		$sql = "SELECT * FROM FinalGrades WHERE Student_ID = ? AND Course_Code = ?";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param("is", $student_id, $course_code); 
	}
  
	  // SQL query to search for course code and student code
	  $stmt->execute();
	  $result = $stmt->get_result();
	  $data = [];
	  while ($row = $result->fetch_assoc()) {
		  $data[] = $row;
	  }
  
	  header('Content-Type: application/json');
  
	  if ($result->num_rows > 0){
		  echo json_encode($data);
	  } else {
		  $error_message = ' No results found with Student ID: '.$student_id .' and Course Code: '.$course_code;
		  echo json_encode(['error' => $error_message]);
	  } 
}
else {
  echo "Invalid form submission";
}

// Close the database connection
$connection->close();
?>
