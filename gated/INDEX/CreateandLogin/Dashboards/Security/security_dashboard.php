<?php
session_start();

// Debugging: Check session variables
var_dump($_SESSION);
exit();

// Check if user is logged in and is security personnel
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'security') {
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
    <title>Security Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logo">Security Dashboard<i class='bx bxs-shield'></i></div>
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
                        <i class='bx bx-desktop'></i>
                        <h3>Security Dashboard</h3>
                    </div>
                    <div class="nav-option option2">
                        <i class='bx bx-group'></i>
                        <h3>Active Visitors</h3>
                    </div>
                    <div class="nav-option option3">
                        <i class='bx bxs-bell-ring'></i>
                        <h3>Alerts & Notifications</h3>
                    </div>
                    <div class="nav-option option4">
                        <i class='bx bx-history'></i>
                        <h3>Access Logs</h3>
                    </div>
                    <div class="nav-option option5">
                        <i class='bx bx-cctv'></i>
                        <h3>Surveillance</h3>
                    </div>
                    <div class="nav-option option6">
                        <i class='bx bx-file'></i>
                        <h3>Reports</h3>
                    </div>
                    <div class="nav-option logout">
                        <a href="../../logout.php">
                            <i class='bx bx-log-out'></i>
                            <h3>Logout</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <main>
            <div class="report-header">
                <h2>Security Monitoring Dashboard</h2>
                <p id="current-date"></p>
            </div>
            <div class="report-1">
                <div class="report-topic-heading">Security Overview</div>
                <div class="items">
                    <?php
                    require_once "../../connect.php";
                    
                    try {
                        // Get today's guests
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM guest WHERE DATE(visitTime) = CURDATE()");
                        $stmt->execute();
                        $todayGuests = $stmt->fetchColumn();

                        // Get active security personnel
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM security WHERE DATE(dateOnDuty) = CURDATE()");
                        $stmt->execute();
                        $activeSecurityCount = $stmt->fetchColumn();

                        // Recent guests
                        $stmt = $pdo->prepare("SELECT * FROM guest ORDER BY visitTime DESC LIMIT 5");
                        $stmt->execute();
                        $recentGuests = $stmt->fetchAll();

                        echo "<div class='item1'>
                                <div class='t-op'>
                                    <i class='bx bx-group'></i>
                                    <h3>Today's Visitors</h3>
                                </div>
                                <div class='t-op-nextlvl'>
                                    <p>Total: $todayGuests</p>
                                </div>
                            </div>";

                        echo "<div class='item1'>
                                <div class='t-op'>
                                    <i class='bx bxs-shield'></i>
                                    <h3>Active Security</h3>
                                </div>
                                <div class='t-op-nextlvl'>
                                    <p>Personnel on Duty: $activeSecurityCount</p>
                                </div>
                            </div>";

                        foreach($recentGuests as $guest) {
                            echo "<div class='item1'>
                                    <div class='t-op'>
                                        <i class='bx bxs-user'></i>
                                        <h3>Recent Entry</h3>
                                    </div>
                                    <div class='t-op-nextlvl'>
                                        <p>{$guest['firstName']} {$guest['lastName']}</p>
                                        <p>Vehicle: {$guest['vehiclePlate']}</p>
                                        <p>Time: {$guest['visitTime']}</p>
                                    </div>
                                </div>";
                        }
                    } catch(PDOException $e) {
                        error_log("Error fetching security data: " . $e->getMessage());
                        echo "<p>Error loading security information</p>";
                    }
                    ?>
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
