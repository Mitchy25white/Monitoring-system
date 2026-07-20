<?php
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $query = "INSERT INTO guests (firstName, lastName, telephone, national_ID, vehiclePlate, purpose, courtNo, houseNo) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        
        $stmt->execute([
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['telephone'],
            $_POST['national_ID'],
            $_POST['vehiclePlate'],
            $_POST['purpose'],
            $_POST['courtNo'],
            $_POST['houseNo']
        ]);
        
        echo json_encode(['success' => true, 'message' => 'New guest registered successfully']);
    } catch(PDOException $e) {
        error_log("Guest registration failed: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again.']);
    }
} else {
    header("Location: index.html");
    exit();
}
?>