<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbconnect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_POST) {
    $studentid = $_POST['studentid'];
    $name = $_POST['name'];
    $course = $_POST['course'];
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO tblconnect (studentid, name, course) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $studentid, $name, $course);
    
    if ($stmt->execute()) {
        $message = "Record inserted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Student Record</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #005a87; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 4px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <h2>Insert Student Record</h2>
    
    <?php if (isset($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <form method="POST" action="insertok">
        <div class="form-group">
            <label for="studentid">Student ID:</label>
            <input type="text" id="studentid" name="studentid" required>
        </div>
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="course">Course:</label>
            <input type="text" id="course" name="course" required>
        </div>
        
        <button type="submit">Insert Record</button>
    </form>
</body>
</html>