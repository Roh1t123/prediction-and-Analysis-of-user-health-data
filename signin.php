<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "indra@123";
$database = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check user credentials
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Set session variables
        $_SESSION['username'] = $username;
        // Display success message
        echo "Login successful. Welcome, $username!";
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>
