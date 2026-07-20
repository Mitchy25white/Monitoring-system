<?php
// Check if a session is already active
if (session_status() == PHP_SESSION_NONE) {
   
    
// Set session settings after starting the session
ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookies
ini_set('session.use_only_cookies', 1); // Prevent session ID from being passed in URL
ini_set('session.cookie_secure', 1); // Use secure cookies if using HTTPS

session_start();
}

// Database connection parameters
$host = 'localhost'; // or your database host
$dbname = 'estatesecurity'; // replace with your database name
$username = 'root'; // replace with your database username
$password = ''; // replace with your database password

// Database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the error message for debugging (optional)
    error_log("Database connection error: " . $e->getMessage());
    // Display a user-friendly message
    die("Sorry, there was a problem connecting to the database. Please try again later.");
}
?>
