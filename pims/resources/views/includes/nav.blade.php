<!DOCTYPE html>
<html lang="en">
<nav class="navbar columns is-fixed-top" role="navigation" aria-label="main navigation" id="app-header">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS | {{ session('prison') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Unique CSS Variables */
        :root {
            --pims-primary: #1a2a3a;
            --pims-secondary: #2c3e50;
            --pims-accent: #e74c3c;
            --pims-light: #ecf0f1;
            --pims-dark: #0d1520;
            --pims-text: #ffffff;
            --pims-text-light: #bdc3c7;
            --pims-success: #27ae60;
            --pims-warning: #f39c12;
            --pims-danger: #e74c3c;
            --pims-security-red: #c0392b;
        }

        /* Reset for PIMS only */
        .pims-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Security Header Bar */
        .pims-security-bar {
            background-color: var(--pims-dark);
            color: var(--pims-text-light);
            padding: 5px 0;
            font-size: 0.8rem;
            border-bottom: 1px solid var(--pims-security-red);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 20px;
        }

        .pims-security-info {
            display: flex;
            gap: 20px;
        }

        .pims-security-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pims-security-info i {
            color: var(--pims-success);
        }

        .pims-last-login {
            color: var(--pims-text-light);
        }

        /* Main Navigation */
        .pims-nav-container {
            background-color: var(--pims-primary);
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(231, 76, 60, 0.3);
        }

        .pims-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            height: 70px;
        }

        .pims-navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pims-logo {
            display: flex;
            align-items: center;
        }

        .pims-logo-icon {
            font-size: 1.8rem;
            color: var(--pims-accent);
            margin-right: 10px;
        }

        .pims-logo-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
        }

        .pims-logo-text small {
            font-size: 0.8rem;
            color: var(--pims-text-light);
            display: block;
            line-height: 1;
        }

        .pims-system-title {
            margin-left: 30px;
            font-size: 1.1rem;
            color: var(--pims-text-light);
            border-left: 1px solid rgba(255, 255, 255, 0.1);
            padding-left: 20px;
        }

        .pims-system-title strong {
            color: white;
            font-weight: 500;
        }

        .pims-nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Notification Bell */
        .pims-notification-bell {
            position: relative;
            cursor: pointer;
            color: var(--pims-text-light);
            transition: all 0.3s;
            font-size: 1.2rem;
        }

        .pims-notification-bell:hover {
            color: white;
        }

        .pims-notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--pims-danger);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* User Profile */
        .pims-user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
        }

        .pims-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--pims-accent);
            object-fit: cover;
        }

        .pims-user-info {
            display: flex;
            flex-direction: column;
        }

        .pims-user-name {
            font-weight: 500;
            color: white;
            font-size: 0.9rem;
        }

        .pims-user-role {
            font-size: 0.8rem;
            color: var(--pims-text-light);
        }

        /* Dropdown Menu */
        .pims-dropdown-menu {
            position: absolute;
            top: 60px;
            right: 0;
            background-color: var(--pims-secondary);
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 250px;
            z-index: 1001;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: none;
        }

        .pims-dropdown-menu.pims-active {
            display: block;
            animation: pims-fadeIn 0.3s;
        }

        @keyframes pims-fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pims-dropdown-header {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pims-dropdown-body {
            padding: 10px 0;
        }

        .pims-dropdown-item {
            padding: 10px 15px;
            color: var(--pims-text-light);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .pims-dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 20px;
        }

        .pims-dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .pims-dropdown-divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.1);
            margin: 5px 0;
        }

        /* Modals */
        .pims-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .pims-modal.pims-active {
            display: flex;
            animation: pims-fadeIn 0.3s;
        }

        .pims-modal-content {
            background-color: var(--pims-secondary);
            border-radius: 5px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--pims-accent);
            position: relative;
        }

        .pims-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: var(--pims-text-light);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .pims-modal-close:hover {
            color: white;
        }

        .pims-modal-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .pims-modal-header h2 {
            color: white;
            font-size: 1.5rem;
            text-align: center;
        }

        .pims-modal-body {
            padding: 20px;
        }

        /* Profile Modal */
        .pims-profile-modal .pims-profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .pims-profile-modal .pims-profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid var(--pims-accent);
            object-fit: cover;
        }

        /* Password Modal */
        .pims-password-modal .pims-field {
            margin-bottom: 20px;
        }

        .pims-password-modal .pims-label {
            color: white;
            margin-bottom: 5px;
            display: block;
        }

        .pims-password-modal .pims-input {
            width: 100%;
            padding: 12px 15px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            color: white;
            font-size: 1rem;
        }

        /* Notification Modal */
        .pims-notification-modal .pims-notification-item {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }

        /* Security Elements */
        .pims-security-scan {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--pims-accent), transparent);
            box-shadow: 0 0 10px var(--pims-accent);
            animation: pims-scan 5s linear infinite;
            z-index: 1001;
            pointer-events: none;
        }

        @keyframes pims-scan {
            0% {
                top: 0;
            }

            100% {
                top: 100%;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .pims-security-info {
                display: none;
            }

            .pims-system-title {
                display: none;
            }

            .pims-logo-text small {
                display: none;
            }
        }
    </style>
</head>


<body class="pims-reset">
    <!-- Security Header Bar -->
    <div class="pims-security-bar">
        <div class="pims-security-info">
            <span><i class="fas fa-shield-alt"></i> SECURITY LEVEL: MAXIMUM</span>
            <span><i class="fas fa-lock"></i> ENCRYPTION: AES-256</span>
            <span><i class="fas fa-eye"></i> ACTIVITY MONITORED</span>
        </div>
        <div class="pims-last-login">
            Last login: {{ date('Y-m-d H:i:s') }} from {{ request()->ip() }}
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="pims-nav-container">
        <div class="pims-navbar">
            <div class="pims-navbar-brand">
                <div class="pims-logo">
                    <i class="fas fa-user-lock pims-logo-icon"></i>
                    <div class="pims-logo-text">
                        PIMS
                        <small>Prison Information Management</small>
                    </div>
                </div>
                @if(session('prison'))
                <div class="pims-system-title">
                    <strong>{{ session('rolename') }}</strong> | {{ session('prison') }}
                </div>
                @endif
            </div>

            <div class="pims-nav-menu">
                <!-- Notification Bell -->
                <div class="pims-notification-bell" id="pimsNotificationBell">
                    <i class="fas fa-bell"></i>
                    <span class="pims-notification-badge">3</span>
                </div>

                <!-- User Profile -->
                <div class="pims-user-profile" id="pimsUserProfile">
                    <img src="{{ asset('storage/' . session('user_image')) }}" alt="User" class="pims-user-avatar">
                    <div class="pims-user-info">
                        <span class="pims-user-name">{{ session('first_name') }}</span>
                        <span class="pims-user-role">{{ session('rolename') }}</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>

                    <!-- Dropdown Menu -->
                    <div class="pims-dropdown-menu" id="pimsDropdownMenu">
                        <div class="pims-dropdown-header">
                            <img src="{{ asset('storage/' . session('user_image')) }}" alt="User">

                        </div>
                        <div class="pims-dropdown-body">
                            <a href="#" class="pims-dropdown-item" id="pimsViewProfile">
                                <i class="fas fa-user"></i> My Profile
                            </a>
                            <a href="#" class="pims-dropdown-item" id="pimsChangePassword">
                                <i class="fas fa-key"></i> Change Password
                            </a>
                            <div class="pims-dropdown-divider"></div>
                            <a href="{{ url('logout') }}" class="pims-dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Popup -->
    @if (session('success'))
    <div id="pimsSuccessPopup" class="pims-modal pims-active">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h2><i class="fas fa-check-circle" style="color: var(--pims-success);"></i> Success</h2>
                <button class="pims-modal-close" onclick="pimsCloseSuccessPopup()">&times;</button>
            </div>
            <div class="pims-modal-body">
                <p>{{ session('success') }}</p>
                <div style="text-align: center; margin-top: 20px;">
                    <button class="pims-button pims-primary" onclick="pimsCloseSuccessPopup()">OK</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Profile Modal -->
    <div class="pims-modal pims-profile-modal" id="pimsProfileModal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h2><i class="fas fa-user-shield"></i> User Profile</h2>
                <button class="pims-modal-close" onclick="pimsCloseModal('pimsProfileModal')">&times;</button>
            </div>
            <div class="pims-modal-body">
                <div class="pims-profile-header">
                    <img src="{{ asset('storage/' . session('user_image')) }}" alt="User" class="pims-profile-avatar">
                    <div class="pims-profile-info">
                        <h3>{{ session('first_name') }} {{ session('last_name') }}</h3>
                        <p>{{ session('rolename') }} @ {{ session('prison') }}</p>

                    </div>
                </div>
                <div class="pims-profile-details">
                    <div class="pims-detail-item">

                        <div class="pims-detail-label">Username</div>
                        <div class="pims-detail-value">{{ session('username') }}</div>
                        <div class="profile-item"><strong>Full Name:</strong> {{ session('first_name') }} {{ session('last_name') }}</div>
                        <div class="profile-item"><strong>Email:</strong> {{ session('email') }}</div>
                        <div class="profile-item"><strong>Phone:</strong> {{ session('phone') }}</div>
                        <div class="profile-item"><strong>Gender:</strong> {{ session('gender') }}</div>
                        <div class="profile-item"><strong>Address:</strong> {{ session('address') }}</div>
                        <div class="profile-item"><strong>Role:</strong> {{ session('rolename') }}</div>
                        <div class="profile-item"><strong>Prison:</strong> {{ session('prison') }}</div>
                        <div class="profile-item"><strong>Prison ID:</strong> {{ session('prison_id') }}</div>
                        <div class="profile-item"><strong>User ID:</strong> {{ session('user_id') }}</div>
                    </div>
                    <!-- Other profile details here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="pims-modal pims-password-modal" id="pimsPasswordModal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h2><i class="fas fa-lock"></i> Change Password</h2>
                <button class="pims-modal-close" onclick="pimsCloseModal('pimsPasswordModal')">&times;</button>
            </div>
            <div class="pims-modal-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- 🔒 Current Password -->
                    <div class="field">
                        <label class="label">Current Password</label>
                        <div class="control">
                            <input type="password" class="input" name="current_password" placeholder="Enter current password" required>
                        </div>
                        @error('current_password')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 🔑 New Password -->
                    <div class="field">
                        <label class="label">New Password</label>
                        <div class="control">
                            <input type="password" class="input" name="new_password" placeholder="Enter new password" required>
                        </div>
                        @error('new_password')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 🔄 Confirm Password -->
                    <div class="field">
                        <label class="label">Confirm New Password</label>
                        <div class="control">
                            <input type="password" class="input" name="new_password_confirmation" placeholder="Confirm new password" required>
                        </div>
                    </div>

                    <!-- ✅ Submit & Cancel Buttons -->
                    <div class="has-text-centered">
                        <button type="submit" class="button is-primary is-large">Update Password</button>
                        <button type="button" class="button is-light is-large" onclick="closePasswordModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification Modal -->
    <div class="pims-modal pims-notification-modal" id="pimsNotificationModal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h2><i class="fas fa-bell"></i> Notifications</h2>
                <button class="pims-modal-close" onclick="pimsCloseModal('pimsNotificationModal')">&times;</button>
            </div>
            <div class="pims-modal-body">
                <div class="pims-notification-item pims-unread">
                    <p>New inmate transfer request requires your approval</p>
                    <div class="pims-notification-time">2 minutes ago</div>
                </div>
                <!-- Other notifications here -->
            </div>
        </div>
    </div>

    <script>
        // Toggle Dropdown Menu
        document.getElementById('pimsUserProfile').addEventListener('click', function() {
            document.getElementById('pimsDropdownMenu').classList.toggle('pims-active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('#pimsUserProfile')) {
                document.getElementById('pimsDropdownMenu').classList.remove('pims-active');
            }
        });

        // Open Profile Modal
        document.getElementById('pimsViewProfile').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('pimsProfileModal').classList.add('pims-active');
            document.getElementById('pimsDropdownMenu').classList.remove('pims-active');
        });

        // Open Password Modal
        document.getElementById('pimsChangePassword').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('pimsPasswordModal').classList.add('pims-active');
            document.getElementById('pimsDropdownMenu').classList.remove('pims-active');
        });

        // Open Notification Modal
        document.getElementById('pimsNotificationBell').addEventListener('click', function() {
            document.getElementById('pimsNotificationModal').classList.add('pims-active');
        });

        // Close Modals
        function pimsCloseModal(modalId) {
            document.getElementById(modalId).classList.remove('pims-active');
        }

        function pimsCloseSuccessPopup() {
            document.getElementById('pimsSuccessPopup').classList.remove('pims-active');
        }

        // Security scan animation
        setInterval(() => {
            const scan = document.querySelector('.pims-security-scan');
            scan.style.animation = 'none';
            setTimeout(() => {
                scan.style.animation = 'pims-scan 5s linear infinite';
            }, 10);
        }, 5000);

        // Simulate security monitoring
        setInterval(() => {
            const securityInfo = document.querySelector('.pims-security-info');
            const messages = [
                "<i class='fas fa-shield-alt'></i> SYSTEM INTEGRITY: VERIFIED",
                "<i class='fas fa-user-secret'></i> UNAUTHORIZED ACCESS ATTEMPTS: 0",
                "<i class='fas fa-clock'></i> SESSION ACTIVE: " + Math.floor(Math.random() * 60) + " MIN"
            ];
            securityInfo.children[0].innerHTML = messages[Math.floor(Math.random() * messages.length)];
        }, 5000);
    </script>
    <!-- Modal Toggle JavaScript -->
    <script>
        document.getElementById('view-profile').addEventListener('click', function() {
            document.getElementById('profileModal').classList.add('is-active');
        });

        function closeModal() {
            document.getElementById('profileModal').classList.remove('is-active');
        }
    </script>

    <script>
        // Open Change Password Modal
        document.getElementById('change-password').addEventListener('click', function() {
            document.getElementById('passwordModal').classList.add('is-active');
        });

        // Close Modal
        function closePasswordModal() {
            document.getElementById('passwordModal').classList.remove('is-active');
        }
    </script>
</body>
</nav>

</html>