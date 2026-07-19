<?php
session_start();
// Check if user is logged in and is a resident
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'resident') {
    header("Location: ../../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link rel="stylesheet" href="resident.js">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logo">Gated Monitoring<i class='bx bxs-cctv'></i></div>
        <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        <div class="searchbar">
            <input type="text" placeholder="Search">
            <div class="searchbtn"><i class='bx bx-search-alt'></i></div>
        </div>
        <div class="message">
            <div class="circle"></div>
            <div class="dp"></div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <div class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <i class='bx bx-laptop'></i>
                        <h3>Resident Dashboard</h3>
                    </div>
                    <div class="nav-option option3">
                        <i class='bx bxs-alarm-exclamation'></i>
                        <h3>Security Alerts</h3>
                    </div>
                    <div class="nav-option option4">
                        <i class='bx bxs-plus-square'></i>
                        <a href="Guest.html">
                            <h3>Input Guest Information</h3>
                        </a>
                    </div>
                    <div class="nav-option option5">
                        <i class='bx bxs-user-circle'></i>
                        <h3>Profile</h3>
                    </div>
                    <div class="nav-option option6">
                        <i class='bx bx-cog'></i>
                        <h3>Settings</h3>
                    </div>
                    <div class="nav-option logout">
                            <i class='bx bx-log-out'></i>
                            <a href="../../logout.php">
                            <h3>Logout</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <main>
            <div class="report-header">
                <h2>Monitoring Report</h2>
                <p id="current-date"></p>
            </div>
            <div class="report-1">
                <div class="report-topic-heading">Analysis</div>
                <div class="items">
                   ```php
<?php
require_once "../../connect.php";

try {
    // Get resident's guests
    ?>
    
    <div class="item1">
        <div class="t-op"> 
            <i class='bx bxs-alarm-exclamation'></i>
            <h3>Security Alerts</h3>
        </div>
        <div class="t-op-nextlvl">
            <ul id="alert-list">
                <?php
                // Fetch security alerts from database
                $stmt = $pdo->prepare("SELECT * FROM security_alerts ORDER BY alert_time DESC LIMIT 10");
                $stmt->execute();
                $securityAlerts = $stmt->fetchAll();

                if (count($securityAlerts) > 0) {
                    foreach ($securityAlerts as $alert) {
                        echo "<li>Alert: " . $alert['alert_message'] . " at " . $alert['alert_time'] . "</li>";
                    }
                } else {
                    echo "<li>No security alerts found.</li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
```
</div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        document.getElementById('current-date').textContent = 'Date: ' + new Date().toLocaleDateString();
    </script>
    <script src="../dashboard.js"></script>
</body>
</html>
