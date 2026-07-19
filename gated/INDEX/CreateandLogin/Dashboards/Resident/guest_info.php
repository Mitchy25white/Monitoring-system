<div class="report-container">
    <div class="report-header">
        <h1>Add Guest Information</h1>
    </div>
    <form method="POST" action="add_guest.php">
        <div class="items">
            <div class="item1">
                <input type="text" name="firstName" placeholder="First Name" required>
            </div>
            <div class="item1">
                <input type="text" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="item1">
                <input type="datetime-local" name="visitTime" required>
            </div>
            <div class="item1">
                <textarea name="purpose" placeholder="Purpose of Visit" required></textarea>
            </div>
            <button type="submit" class="view">Add Guest</button>
        </div>
    </form>
</div>
