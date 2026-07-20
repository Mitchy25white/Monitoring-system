<?php
session_start();
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    
    // Validate input
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields']);
        exit();
    }
    
    if (strlen($username) < 3 || strlen($username) > 50) {
        echo json_encode(['success' => false, 'message' => 'Username must be between 3 and 50 characters']);
        exit();
    }

    if (strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters']);
        exit();
    }
    
    try {
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_activity'] = time();
            
          
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            // Redirect based on role
            $dashboard_url = match($user['role']) {
                'admin' => '../CreateandLogin/Dashboards/Admin/adminpage.php',
                'resident' => '../CreateandLogin/Dashboards/Resident/Resident_dashboard.php',
                'security' => '../CreateandLogin/Dashboards/Security/Security_dashboard.php',
               default => '../CreateandLogin/login.html'
            };
            
            echo json_encode(['success' => true, 'redirect' => $dashboard_url]);
        } else {
            // Use generic message for security
            echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        }
    } catch(PDOException $e) {
        error_log("Login failed: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again.']);
    }
} else {
    header("Location: login.html");
    exit();
}
