<div class="report-container">
    <div class="report-header">
        <h1>Settings</h1>
    </div>
    <div class="items">
        <div class="item1">
            <h3>Change Password</h3>
            <form method="POST" action="update_password.php">
                <input type="password" name="current_password" placeholder="Current Password">
                <input type="password" name="new_password" placeholder="New Password">
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <button type="submit" class="view">Update Password</button>
            </form>
        </div>
        <div class="item1">
            <h3>Notification Preferences</h3>
            <form method="POST" action="update_preferences.php">
                <input type="checkbox" name="email_alerts"> Email Alerts
                <input type="checkbox" name="sms_alerts"> SMS Alerts
                <button type="submit" class="view">Save Preferences</button>
            </form>
        </div>
    </div>
</div>
