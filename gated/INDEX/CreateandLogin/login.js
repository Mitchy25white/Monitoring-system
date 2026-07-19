document.getElementById('showPassword').addEventListener('change', function() {
    const passwordInput = document.getElementById('password');
    if (this.checked) {
        passwordInput.type = 'text'; // Show password
    } else {
        passwordInput.type = 'password'; // Hide password
    }
});
function createAccount(event) {
    event.preventDefault();
    
    const form = event.target.form;
    const formData = new FormData(form);
    
    // Check if passwords match
    const password = formData.get('password');
    const confirmPassword = formData.get('confirm_password');
    
    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    // Validate password strength
    if (password.length < 5) {
        alert("Password must be at least 5 characters long!");
        return;
    }

    fetch('signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        if (data.trim() === "success") {
            alert("Account created successfully!");
            window.location.href = 'dashboard.html';
        } else {
            alert(data || 'Registration failed. Please try again.'); 
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Registration failed. Please try again.');
    });
}

// Login function moved to indexlogin.js to avoid duplication


