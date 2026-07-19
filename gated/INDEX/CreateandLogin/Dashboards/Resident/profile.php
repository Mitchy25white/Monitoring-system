<div class="report-container">
    <div class="report-header">
        <h1>Resident Profile</h1>
    </div>
    <div class="items">
        <div class="item1">
            <i class='bx bxs-user'></i>
            <span class="t-op">Name: <?php echo $_SESSION['name']; ?></span>
        </div>
        <div class="item1">
            <i class='bx bxs-home'></i>
            <span class="t-op">Court No: <?php echo $_SESSION['courtNo']; ?></span>
        </div>
        <div class="item1">
            <i class='bx bxs-phone'></i>
            <span class="t-op">Contact: <?php echo $_SESSION['contact']; ?></span>
        </div>
    </div>
</div>
