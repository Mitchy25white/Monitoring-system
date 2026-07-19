document.addEventListener('DOMContentLoaded', function() {
    // Menu toggle functionality
    const menuIcon = document.getElementById('menuicn');
    const nav = document.querySelector('.nav');
    
    if (menuIcon) {
        menuIcon.addEventListener('click', () => {
            nav.classList.toggle('navclose');
        });
    }

    // Search functionality
    const searchBtn = document.querySelector('.searchbtn');
    const searchInput = document.querySelector('.searchbar input');
    
    if (searchBtn && searchInput) {
        searchBtn.addEventListener('click', () => {
            const searchTerm = searchInput.value.toLowerCase();
            // Implement search functionality here
            console.log('Searching for:', searchTerm);
            // You can add AJAX call to backend here
        });
    }

    // Real-time guest activity updates
    function updateGuestActivity() {
        const activityList = document.getElementById('activity-list');
        if (activityList) {
            // Simulated real-time updates - replace with actual API calls
            fetch('/api/guest-activity')
                .then(response => response.json())
                .catch(error => {
                    console.error('Error fetching guest activity:', error);
                });
        }
    }

    // Security alerts handling
    function checkSecurityAlerts() {
        const alertList = document.getElementById('alert-list');
        if (alertList) {
            // Simulated security alerts - replace with actual API calls
            fetch('/api/security-alerts')
                .then(response => response.json())
                .catch(error => {
                    console.error('Error fetching security alerts:', error);
                });
        }
    }

    // Dashboard Overview (Option 1)
    document.querySelector('.nav-option.option1')?.addEventListener('click', () => {
        loadDashboardStats();
        loadActivityFeed();
        // Show main dashboard content
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector('.main-dashboard')?.style.display = 'block';
    });

    // Guest Management (Option 2)
    document.querySelector('.nav-option.option2')?.addEventListener('click', () => {
        console.log('Opening guest management');
        fetch('/api/guests')
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching guest data:', error);
            });
        // Show guest management section
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector('.guest-management')?.style.display = 'block';
    });

    // Security Monitoring (Option 3)
    document.querySelector('.nav-option.option3')?.addEventListener('click', () => {
        console.log('Opening security monitoring');
        checkSecurityAlerts();
        // Show security monitoring section
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector('.security-monitoring')?.style.display = 'block';
    });

    // Reports & Analytics (Option 4)
    document.querySelector('.nav-option.option4')?.addEventListener('click', () => {
        console.log('Opening reports & analytics');
        // Fetch analytics data
        fetch('/api/analytics')
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching analytics:', error);
            });
        // Show reports section
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector('.reports-analytics')?.style.display = 'block';
    });

    // Profile Management (Option 5)
    document.querySelector('.nav-option.option5')?.addEventListener('click', () => {
        console.log('Opening profile settings');
        // Fetch user profile data
        fetch('/api/user/profile')
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching profile:', error);
            });
        // Show profile section
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector('.profile-settings')?.style.display = 'block';
    });

    // Settings Management (Option 6)
    document.querySelector('.nav-option.option6')?.addEventListener('click', () => {
        console.log('Opening settings');
        // Fetch system settings
        fetch('/api/settings')
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching settings:', error);
            });
        // Show settings section
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector('.system-settings')?.style.display = 'block';
    });

    // Admin Dashboard specific functions
    function loadDashboardStats() {
        // In a real application, these would be API calls
        fetch('/api/admin/stats')
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching dashboard stats:', error);
            });
    }

    function loadActivityFeed() {
        const activityFeed = document.getElementById('activity-feed');
        if (activityFeed) {
            // Simulated activity data - replace with actual API call
            const activities = [
                { type: 'entry', text: 'New guest entry at Gate 1', time: '2 mins ago' },
                { type: 'alert', text: 'Security alert: Gate 2 maintenance required', time: '15 mins ago' },
                { type: 'system', text: 'System backup completed', time: '1 hour ago' }
            ];

            activities.forEach(activity => {
                const div = document.createElement('div');
                div.className = 'item1';
                div.innerHTML = `
                    <i class='bx ${activity.type === 'entry' ? 'bxs-door-open' : 
                                  activity.type === 'alert' ? 'bxs-error' : 'bxs-cog'}'></i>
                    <h3 class="t-op-nextlvl">${activity.text}</h3>
                    <span class="t-op-nextlvl">${activity.time}</span>
                `;
                activityFeed.appendChild(div);
            });
        }
    }

    // Initialize admin dashboard
    loadDashboardStats();
    loadActivityFeed();

    // Initialize periodic updates
    setInterval(updateGuestActivity, 30000); // Update every 30 seconds
    setInterval(checkSecurityAlerts, 60000); // Check alerts every minute
    setInterval(loadActivityFeed, 300000); // Refresh activity feed every 5 minutes

    // Handle logout
    const logoutBtn = document.querySelector('.nav-option.logout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            if (!confirm('Are you sure you want to logout?')) {
                e.preventDefault();
            }
        });
    }

    // Initialize tooltips if using Bootstrap
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});