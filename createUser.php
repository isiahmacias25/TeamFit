<?php
// Database connection details
$host = "65.24.35.108:3306";
$dbname = "shcoolTeams";
$username = "WebApp";
$password = "BPAteam123";

try {
    // Establish a connection to the MySQL database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form data was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["username"];
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

        // Prepare the SQL statement to insert the new user
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $user);
        $stmt->bindParam(":password", $pass);

        // Execute the query
        if ($stmt->execute()) {
            echo "Account created successfully!";
        } else {
            echo "Error creating account.";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
