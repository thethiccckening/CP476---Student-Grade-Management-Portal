<?php
// Your database connection code here
// Replace these values with your own MySQL server information
$host = "localhost";
$user = "root";
$password = "sekou";
$database = "CP476_Student_Management"; // this needs to already exit. 
// Connect to the database
$connection = new mysqli($host, $user, $password, $database);
// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
