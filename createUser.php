<?php

// Database connection details
$host = "65.24.35.108:3360"; // Host address with port
$username = "WebApp";        // Database username
$password = "BPAteam123";    // Database password
$database = "schoolTeams";   // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else (!$conn->connect_error) {
    echo "connection succeeded";

// Check if form data has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user data from form
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    // Sanitize input (important!)
    $newUsername = mysqli_real_escape_string($conn, $newUsername);
    $newPassword = mysqli_real_escape_string($conn, $newPassword);

    // Create user query
    $sql = "CREATE USER '$newUsername'@'%' IDENTIFIED BY '$newPassword'";

    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully!";
    } else {
        echo "Error creating user: " . $conn->error;
    }
}

// Close connection
$conn->close();

?>

