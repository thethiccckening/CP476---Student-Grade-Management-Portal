<?php
include 'dbconnection.php';
//check for POST connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = "";
    // Get the JSON data from the POST request and decode it.
    $postdata = file_get_contents('php://input');
    $data = json_decode($postdata, true);
    $student_data = $data['data'];
    foreach ($student_data as $row) { 

        $id = $row['Student_ID']; 
        $course = $row['Course_Code'];
        $test1 = $row['Test_1'];
        $test2 = $row['Test_2'];
        $test3 = $row['Test_3'];
        $final = $row['Final_exam'];

        //validate and sanitize
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $coursepattern = "/^[a-zA-Z]{2}\d{3}$/";
        $options = array("options" => array("regexp" => $coursepattern));
        $course = filter_var($course, FILTER_VALIDATE_REGEXP, $options);

        //prepare sql queryl
        $sql = "UPDATE Courses SET Test_1 = ?, Test_2 = ?, Test_3 = ?, Final_exam = ? WHERE Student_ID = ? AND Course_Code = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ddddis", $test1, $test2, $test3, $final, $id, $course);

        // Execute the query and check for success
        if ($stmt->execute()) {
            $response = ['status' => 'success'];
        } else {
            $response = ['error' => 'Failed to update the record'];
        }

        //update final grade table based updated test grades. 
        $final_grade= $test1 * 0.2 + $test2 * 0.2 + $test3* 0.2 + $final * 0.4;

        $sql = "UPDATE FinalGrades SET Final_grade = ? WHERE Student_ID = ? AND Course_Code = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("dis",  $final_grade, $id, $course); 
        $stmt->execute();
        // Execute the query and check for success
        if ($stmt->execute()) {
            $response = ['status' => 'success'];
        } else {
            $response = ['error' => 'Failed to update the record'];
        }
        
    }
    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

}
// Close the database connection
$connection->close();
?>

