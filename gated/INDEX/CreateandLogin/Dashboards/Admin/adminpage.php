<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gated Community</title>
    <link rel="stylesheet" href="../dashboard.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">Admin Dashboard<i class='bx bxs-shield-alt-2'></i></div>
            <div class="menu" id="menuicn"><i class='bx bx-menu'></i></div>
        </div>
        <div class="searchbar">
            <input type="text" placeholder="Search...">
            <div class="searchbtn"><i class='bx bx-search-alt'></i></div>
        </div>
        <div class="message">
            <div class="circle"></div>
            <i class='bx bxs-bell'></i>
            <div class="dp">
                <img src="../assets/admin-avatar.png" alt="admin">
            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <i class='bx bxs-dashboard'></i>
                        <h3>Dashboard</h3>
                    </div>
                    <div class="nav-option option2">
                        <i class='bx bxs-user-plus'></i>
                        <a href="Resident.html"><h3>Resident Management</h3></a>
                    </div>
                    <div class="nav-option option3">
                        <i class='bx bxs-shield'></i>
                        <a href="security.html"><h3>Security Management</h3></a>
                    </div>
            
                    <div class="nav-option option4">
                        <i class='bx bxs-cog'></i>
                        <h3>Settings</h3>
                    </div>
                    <div class="nav-option option5">
                        <i class='bx bxs-report'></i>
                        <h3>Reports</h3>
                    </div>
                    <div class="nav-option logout">
                    <i class='bx bxs-log-out'></i>
                        <a href="../../logout.php"><h3>Logout</h3>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="main">
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Dashboard Overview</h1>
                    <button class="view">View All</button>
                </div>

                <div class="report-body">
                    <?php
                    require_once "../../connect.php";
                    
                    // Get counts from database
                    try {
                        $stats = [
                            'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
                            'guests' => $pdo->query("SELECT COUNT(*) FROM guest")->fetchColumn(),
                            'residents' => $pdo->query("SELECT COUNT(*) FROM resident")->fetchColumn(),
                            'security' => $pdo->query("SELECT COUNT(*) FROM security")->fetchColumn()
                        ];
                    } catch(PDOException $e) {
                        error_log("Error fetching stats: " . $e->getMessage());
                        $stats = ['users' => 0, 'guests' => 0, 'residents' => 0, 'security' => 0];
                    }
                    ?>
                    
                    <div class="items">
                        <div class="item1">
                            <i class='bx bxs-user'></i>
                            <h3 class="t-op-nextlvl">Total Users</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['users']; ?></span>
                        </div>

                        <div class="item1">
                            <i class='bx bxs-group'></i>
                            <h3 class="t-op-nextlvl">Active Guests</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['guests']; ?></span>
                        </div>

                        <div class="item1">
                            <i class='bx bxs-home'></i>
                            <h3 class="t-op-nextlvl">Residents</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['residents']; ?></span>
                        </div>

                        <div class="item1">
                            <i class='bx bxs-shield'></i>
                            <h3 class="t-op-nextlvl">Security Personnel</h3>
                            <span class="t-op-nextlvl"><?php echo $stats['security']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashboard.js"></script>
</body>
</html>
