<?php
// Database configuration
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password (empty)
$dbname = "dbconnect";

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sample data to insert
$studentid = "STU001";
$name = "John Doe";
$course = "Computer Science";

// Prepare and bind statement (prevents SQL injection)
$stmt = $conn->prepare("INSERT INTO tblconnect (studentid, name, course) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $studentid, $name, $course);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
