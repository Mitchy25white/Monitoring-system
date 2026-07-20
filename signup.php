<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = trim($_POST["role"]);

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        echo "All fields are required";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters long";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            echo "Username already exists. Please choose another one.";
            exit();
        }

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            echo "Email already registered. Please use another email.";
            exit();
        }

        // Insert new user
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$username, $email, $hashed_password, $role])) {
            // Return success with redirect URL
            echo json_encode([
                'success' => true,
                'message' => 'Account created successfully!',
                'redirect' => 'login.html'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Registration failed'
            ]);
        }
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>