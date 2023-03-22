<?php
// Replace these values with your own MySQL server information
$host = "localhost";
$user = "root";
$password = "sekou";
$database = "CP476_Student_Management"; // this needs to already exit. 

// Connect to the database
$connection = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


//for a brand new setup 
$sql = "DROP TABLE IF EXISTS FinalGrades;
        DROP TABLE IF EXISTS Courses;
        DROP TABLE IF EXISTS Students;";

// Execute multi-query to delete tables
if ($connection->multi_query($sql)) {
    echo "Tables deleted successfully\n";
    // Clear the results to prepare for the next query
    while ($connection->next_result()) {
        $result = $connection->use_result();
        if ($result instanceof mysqli_result) {
            $result->free();
        }
    }
} else {
    echo "Error deleting tables: " . $connection->error;
}


// Create Students table
$sql = "CREATE TABLE Students (
  Student_ID INT PRIMARY KEY,
  Student_Name VARCHAR(255) NOT NULL
)";

if ($connection->query($sql) === TRUE) {
    echo "Students table created successfully\n";
} else {
    echo "Error creating Students table: " . $connection->error;
}


// Create Courses table
$sql = "CREATE TABLE Courses (
  Student_ID INT,
  Course_Code VARCHAR(10),
  Test_1 DECIMAL(3, 1),
  Test_2 DECIMAL(3, 1),
  Test_3 DECIMAL(3, 1),
  Final_exam DECIMAL(3, 1),
  PRIMARY KEY (Student_ID, Course_Code),
  FOREIGN KEY (Student_ID) REFERENCES Students(Student_ID)
)";

if ($connection->query($sql) === TRUE) {
    echo "Courses table created successfully\n";
} else {
    echo "Error creating Courses table: " . $connection->error;
}


// Create FinalGrades table
$sql = "CREATE TABLE FinalGrades (
  Student_ID INT,
  Course_Code VARCHAR(10),
  Student_Name VARCHAR(255),
  Final_grade DECIMAL(3, 1),
  PRIMARY KEY (Student_ID, Course_Code),
  FOREIGN KEY (Student_ID) REFERENCES Students(Student_ID)
)";

if ($connection->query($sql) === TRUE) {
    echo "FinalGrades table created successfully\n";
} else {
    echo "Error creating FinalGrades table: " . $connection->error;
}


// Read the student data of the namefile.txt provided by the teacher
$lines = file("NameFile.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// Insert each line into the Courses table
foreach ($lines as $line) {
    list($student_id, $name) = explode(", ", $line);

    $sql = "INSERT INTO Students (Student_ID, Student_name) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("is", $student_id, $name);
    $stmt->execute();
}



// Read the contents of the coursefile.txt
$lines = file("CourseFile.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// Insert the data into the Course table
foreach ($lines as $line) {
    list($student_id, $course_code, $test_1, $test_2, $test_3, $final_exam) = explode(", ", $line);

    $sql = "INSERT INTO Courses (Student_ID, Course_Code, Test_1, Test_2, Test_3, Final_exam) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("isdddd", $student_id, $course_code, $test_1, $test_2, $test_3, $final_exam);
    $stmt->execute();
}



//insert into Final Grades table using course tables. 
$sql = "INSERT INTO FinalGrades (Student_ID, Course_Code, Student_Name, Final_grade)
        SELECT c.Student_ID, c.Course_Code, s.Student_Name, 
               (c.Test_1 * 0.2 + c.Test_2 * 0.2 + c.Test_3 * 0.2 + c.Final_exam * 0.4) as Final_grade
        FROM Courses c
        JOIN Students s ON c.Student_ID = s.Student_ID";
		
if ($connection->query($sql) === TRUE) {
    echo "Final Grades calculated and inserted successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}



// Close the prepared statement and database connection
$stmt->close();
$connection->close();
?>