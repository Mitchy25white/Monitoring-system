function redirectToCreateAccount() {
    // Redirect to the create account page
    window.location.href = 'createaccount.html'; // Change this to your actual create account URL
}

function login() {
    const loginForm = document.getElementById('loginForm');
    const username = document.querySelector('input[name="username"]').value.trim();
    const password = document.querySelector('input[name="password"]').value;
    
    // Clear previous error messages
    const errorDiv = document.getElementById('loginError') || createErrorDiv();
    errorDiv.textContent = '';
    
    // Basic validation
    if (username.length < 3) {
        errorDiv.textContent = 'Username must be at least 3 characters long';
        return;
    }
    
    if (password.length < 8) {
        errorDiv.textContent = 'Password must be at least 8 characters long';
        return;
    }
    
    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    // Show loading state
    const submitBtn = loginForm.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'Logging in...';

    fetch('/CreateandLogin/login.html', {
        method: 'POST',
        body: formData,
        credentials: 'include' // This ensures cookies/session are sent
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            errorDiv.style.color = 'green';
            errorDiv.textContent = 'Login successful! Redirecting...';
            window.location.href = data.redirect;
        } else {
            errorDiv.textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorDiv.textContent = 'Login failed. Please try again.';
    })
    .finally(() => {
        // Restore button state
        submitBtn.disabled = false;
        submitBtn.textContent = originalBtnText;
    });
}

function createErrorDiv() {
    const errorDiv = document.createElement('div');
    errorDiv.id = 'loginError';
    errorDiv.style.color = 'red';
    errorDiv.style.marginTop = '10px';
    errorDiv.style.textAlign = 'center';
    
    const form = document.getElementById('loginForm');
    form.querySelector('button[type="submit"]').insertAdjacentElement('beforebegin', errorDiv);
    
    return errorDiv;
}
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginError = document.getElementById('loginError');

    // Show/hide password functionality
    const passwordInput = document.querySelector('input[type="password"]');
    const showPasswordCheckbox = document.getElementById('showPassword');
    
    showPasswordCheckbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
    });

    // Handle form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('login_handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                loginError.textContent = data.message;
                loginError.style.display = 'block';
            }
        })
        .catch(error => {
            loginError.textContent = 'An error occurred. Please try again.';
            loginError.style.display = 'block';
        });
    });
});

