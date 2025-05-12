<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS | {{ session('prison') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
/* CSS Variables */
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
    --pims-border-radius: 5px;
    --pims-card-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Reset and Base Styles */
.pims-reset {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    background-color: var(--pims-light);
    color: var(--pims-dark);
}

/* Security Header Bar */
.pims-security-bar {
    background-color: var(--pims-dark);
    color: var(--pims-text-light);
    padding: 5px 20px;
    font-size: 0.8rem;
    border-bottom: 1px solid var(--pims-security-red);
    display: flex;
    justify-content: space-between;
    align-items: center;
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

/* Security Scan Animation */
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
    0% { top: 0; }
    100% { top: 100%; }
}

/* Main Navigation */
.pims-nav-container {
    background-color: var(--pims-primary);
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
    max-width: 1200px;
    margin: 0 auto;
}

.pims-navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

.pims-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.pims-logo-icon {
    font-size: 1.8rem;
    color: var(--pims-accent);
    margin-right: 10px;
}

.pims-logo-text {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--pims-text);
}

.pims-logo-text small {
    font-size: 0.8rem;
    color: var(--pims-text-light);
    display: block;
}

.pims-system-title {
    margin-left: 30px;
    font-size: 1.1rem;
    color: var(--pims-text-light);
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    padding-left: 20px;
}

.pims-system-title strong {
    color: var(--pims-text);
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
    color: var(--pims-text);
}

.pims-notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: var(--pims-danger);
    color: var(--pims-text);
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
    color: var(--pims-text);
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
    border-radius: var(--pims-border-radius);
    box-shadow: var(--pims-card-shadow);
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
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.pims-dropdown-header {
    padding: 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    gap: 10px;
}

.pims-dropdown-header img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
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
    text-decoration: none;
}

.pims-dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--pims-text);
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

/* Notifications */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: var(--pims-border-radius);
    box-shadow: var(--pims-card-shadow);
    z-index: 9999;
    display: flex;
    align-items: center;
    transform: translateX(150%);
    transition: transform 0.4s ease;
    max-width: 350px;
}

.notification.active {
    transform: translateX(0);
}

.notification.success {
    background-color: var(--pims-success);
    color: var(--pims-text);
}

.notification.error {
    background-color: var(--pims-danger);
    color: var(--pims-text);
}

.notification-icon {
    margin-right: 10px;
    font-size: 1.2rem;
}

.notification-message {
    flex: 1;
}

.notification-close {
    margin-left: 15px;
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    opacity: 0.8;
    transition: opacity 0.2s ease;
}

.notification-close:hover {
    opacity: 1;
}

/* Modal Base Styles */
.pims-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 2000;
}

.pims-modal.pims-active {
    display: flex;
    animation: pims-fadeIn 0.3s;
}

.pims-modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: -1;
}

.pims-modal-content {
    background-color: var(--pims-light);
    border-radius: var(--pims-border-radius);
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: var(--pims-card-shadow);
    border: 1px solid var(--pims-accent);
    position: relative;
    animation: scaleIn 0.3s ease-out;
}

@keyframes scaleIn {
    0% { transform: scale(0.8); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}

.pims-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 2px solid #f2f2f2;
}

.pims-modal-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    color: var(--pims-dark);
    display: flex;
    align-items: center;
    gap: 10px;
}

.pims-modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--pims-dark);
    cursor: pointer;
}

.pims-modal-close:hover {
    color: var(--pims-accent);
}

.pims-modal-body {
    padding: 20px;
}

/* Profile Modal */
.pims-profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.pims-profile-avatar-container {
    position: relative;
    margin-right: 20px;
}

.pims-profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #f2f2f2;
}

.pims-profile-info h3 {
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0;
    color: var(--pims-dark);
}

.pims-profile-info p {
    font-size: 1rem;
    color: #777;
    margin: 5px 0;
}

.pims-profile-details {
    margin-top: 20px;
}

.pims-detail-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f2f2f2;
}

.pims-detail-label {
    font-weight: 600;
    color: var(--pims-dark);
    width: 40%;
}

.pims-detail-value {
    color: #777;
    width: 60%;
}

/* Change Password Modal */
.field {
    margin-bottom: 20px;
}

.label {
    color: var(--pims-dark);
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

.control {
    position: relative;
}

.input {
    width: 100%;
    padding: 12px 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: var(--pims-border-radius);
    color: var(--pims-dark);
    font-size: 1rem;
}

.input:focus {
    outline: none;
    border-color: var(--pims-accent);
    box-shadow: 0 0 5px rgba(231, 76, 60, 0.3);
}

.help.is-danger {
    color: var(--pims-danger);
    font-size: 0.85rem;
}

.button {
    padding: 10px 20px;
    border: none;
    border-radius: var(--pims-border-radius);
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button.is-primary {
    background-color: var(--pims-success);
    color: var(--pims-text);
}

.button.is-primary:hover {
    background-color: #219653;
}

.button.is-light {
    background-color: #f4f6f9;
    color: var(--pims-dark);
}

.button.is-light:hover {
    background-color: #e2e8f0;
}

.has-text-centered {
    text-align: center;
}

.button.is-large {
    padding: 12px 30px;
    font-size: 1.1rem;
}

/* Notification Modal */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 2000;
}

.modal.is-active {
    display: flex;
}

.modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    max-width: 500px;
    margin: 5% auto;
}

.box {
    background-color: var(--pims-light);
    border-radius: var(--pims-border-radius);
    padding: 20px;
    box-shadow: var(--pims-card-shadow);
}

.notification-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    color: var(--pims-dark);
}

.notification-header hr {
    border: none;
    border-top: 1px solid #f2f2f2;
}

.notification-list {
    max-height: 300px;
    overflow-y: auto;
}

.notification-actions {
    margin-top: 20px;
}

.button.is-fullwidth {
    width: 100%;
}

.button.is-light {
    background-color: #f4f6f9;
    color: var(--pims-dark);
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

    .pims-navbar {
        flex-direction: column;
        align-items: flex-start;
        height: auto;
        padding: 10px 20px;
    }

    .pims-nav-menu {
        width: 100%;
        justify-content: flex-end;
    }

    .pims-modal-content {
        width: 95%;
        margin: 10px;
    }

    .pims-profile-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .pims-profile-avatar-container {
        margin-right: 0;
        margin-bottom: 10px;
    }

    .pims-detail-item {
        flex-direction: column;
        gap: 5px;
    }

    .pims-detail-label,
    .pims-detail-value {
        width: 100%;
    }
}    </style>
</head>

<body class="pims-reset">
    <!-- Main Navigation -->
    <div class="pims-nav-container">
        <div class="pims-navbar">
            <div class="pims-navbar-brand">
                <div class="pims-logo">
                    <i class="fas fa-user-lock pims-logo-icon"></i>
                    <a href="{{ url('/') }}">
                    <div class="pims-logo-text">
                        PIMS
                        <small>Prison Information Management </small>
                    </div>
                    </a>
                </div>
                @if(session('prison_id'))
                <div class="pims-system-title">
                    <strong>{{ session('rolename') }}</strong> | {{ session('prison') }}
                </div>
                @endif
            </div>

            <div class="pims-nav-menu">
                <!-- Notification Bell -->
                <div class="pims-notification-bell" id="pimsNotificationBell">
                    <i class="fas fa-bell"></i>
                    <span class="pims-notification-badge" style="display: none;">0</span>
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

    <!-- Success Notification -->
    @if (session('success'))
    <div id="pimsSuccessPopup" class="notification success active">
        <i class="notification-icon fas fa-check-circle"></i>
        <span class="notification-message">{{ session('success') }}</span>
        <button class="notification-close" onclick="pimsCloseSuccessPopup()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Error Notification -->
    @if (session('error'))
    <div id="pimsErrorPopup" class="notification error active">
        <i class="notification-icon fas fa-exclamation-circle"></i>
        <span class="notification-message">{{ session('error') }}</span>
        <button class="notification-close" onclick="pimsCloseErrorPopup()">
            <i class="fas fa-times"></i>
        </button>
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
                <div class="pims-profile-avatar-container">
                    @if(session('user_image'))
                        <img src="{{ asset('storage/' . session('user_image')) }}" alt="User Avatar" class="pims-profile-avatar">
                    @endif
                    
                </div>
                <div class="pims-profile-info">
                    @if(session('first_name') || session('last_name'))
                        <h3>{{ session('first_name') }} {{ session('last_name') }}</h3>
                    @endif
                    @if(session('rolename') || session('prison'))
                        <p>{{ session('rolename') }} @ {{ session('prison') }}</p>
                    @endif
                </div>
            </div>
            <div class="pims-profile-details">
                @foreach (['username', 'first_name', 'last_name', 'email', 'phone', 'gender', 'address', 'rolename', 'prison', 'prison_id', 'law_firm', 'license_number', 'cases_handled', 'date_of_birth', 'contact_info'] as $key)
                    @if(session($key))
                        <div class="pims-detail-item">
                            <div class="pims-detail-label">{{ ucwords(str_replace('_', ' ', $key)) }}:</div>
                            <div class="pims-detail-value">{{ session($key) }}</div>
                        </div>
                    @endif
                @endforeach
                @if(session('user_id') || session('lawyer_id'))
                    <div class="pims-detail-item">
                        <div class="pims-detail-label">User ID:</div>
                        <div class="pims-detail-value">{{ session('user_id') }}{{ session('lawyer_id') }}</div>
                    </div>
                @endif
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

    <!-- 🔥 Enhanced Notification Modal -->
    <div id="notification-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <div class="notification-header">
                    <h3 class="title is-5 has-text-centered">Notifications</h3>
                    <hr class="is-marginless">
                </div>
                <div id="notification-list" class="notification-list">
                    <!-- Notifications will be dynamically inserted here -->
                </div>
                <br>
                <div class="notification-actions">
                    <button class="button is-primary is-fullwidth" id="mark-all-as-read">Mark All as Read</button>
                    <div class="buttons is-centered">
                        <button class="button is-light" id="close-modal">Close</button>
                    </div>
                </div>
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
            document.getElementById('pimsSuccessPopup').classList.remove('active');
        }

        function pimsCloseErrorPopup() {
            document.getElementById('pimsErrorPopup').classList.remove('active');
        }

        // Auto-close notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successPopup = document.getElementById('pimsSuccessPopup');
            const errorPopup = document.getElementById('pimsErrorPopup');
            
            if (successPopup) {
                setTimeout(() => {
                    successPopup.classList.remove('active');
                }, 5000);
            }
            
            if (errorPopup) {
                setTimeout(() => {
                    errorPopup.classList.remove('active');
                }, 5000);
            }
        });

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

</html>
