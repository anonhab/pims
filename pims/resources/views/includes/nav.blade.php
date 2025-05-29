<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="route-notifications" content="{{ route('notifications.fetch') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

/* Main Navigation - Redesigned */
.pims-nav-container {
    background-color: var(--pims-primary);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    border-bottom: 2px solid var(--pims-accent);
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
    gap: 15px;
}

.pims-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.pims-logo:hover {
    transform: translateX(-3px);
}

.pims-logo-icon {
    font-size: 2rem;
    color: var(--pims-accent);
    margin-right: 12px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.pims-logo-text {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--pims-text);
    letter-spacing: 1px;
}

.pims-logo-text small {
    font-size: 0.8rem;
    color: var(--pims-text-light);
    display: block;
    font-weight: 300;
    letter-spacing: 0.5px;
}

.pims-system-title {
    margin-left: 25px;
    font-size: 1rem;
    color: var(--pims-text-light);
    border-left: 1px solid rgba(255, 255, 255, 0.2);
    padding-left: 20px;
    height: 40px;
    display: flex;
    align-items: center;
}

.pims-system-title strong {
    color: var(--pims-text);
    font-weight: 500;
    margin-right: 5px;
}

.pims-nav-menu {
    display: flex;
    align-items: center;
    gap: 25px;
}

/* Notification Bell - Redesigned */
.pims-notification-bell {
    background: none;
    border: none;
    font-size: 1.3rem;
    color: var(--pims-text-light);
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
    padding: 8px;
    border-radius: 50%;
}

.pims-notification-bell:hover {
    color: var(--pims-text);
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.pims-notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    background-color: var(--pims-danger);
    color: var(--pims-text);
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 0.7rem;
    display: none; /* Initially hidden */
    align-items: center;
    justify-content: center;
    font-weight: bold;
    border: 2px solid var(--pims-primary);
}

/* User Profile - Redesigned */
.pims-user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    position: relative;
    padding: 5px 10px;
    border-radius: 30px;
    transition: all 0.3s ease;
}

.pims-user-profile:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.pims-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid var(--pims-accent);
    object-fit: cover;
    transition: transform 0.3s ease;
}

.pims-user-profile:hover .pims-user-avatar {
    transform: scale(1.05);
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
    font-size: 0.7rem;
    color: var(--pims-text-light);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Dropdown Menu - Redesigned */
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
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.pims-dropdown-menu[aria-hidden="false"] {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.pims-dropdown-header {
    padding: 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    gap: 15px;
    background-color: rgba(0, 0, 0, 0.1);
}

.pims-dropdown-header img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid var(--pims-accent);
}

.pims-dropdown-body {
    padding: 10px 0;
}

.pims-dropdown-item {
    padding: 12px 20px;
    color: var(--pims-text-light);
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    text-decoration: none;
    position: relative;
}

.pims-dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--pims-text);
    padding-left: 25px;
}

.pims-dropdown-item i {
    width: 20px;
    text-align: center;
    color: var(--pims-accent);
}

.pims-dropdown-item::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 1px;
    background-color: var(--pims-accent);
    transition: width 0.3s ease;
}

.pims-dropdown-item:hover::after {
    width: 100%;
}

/* Modal Styles - Redesigned */
.pims-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2000;
}

.pims-modal[aria-hidden="false"] {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.7);
    animation: pims-fadeIn 0.3s;
}

.pims-modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    cursor: pointer;
}

.pims-modal-content {
    background-color: var(--pims-light);
    border-radius: var(--pims-border-radius);
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: var(--pims-card-shadow);
    border-top: 4px solid var(--pims-accent);
    position: relative;
    animation: pims-scaleIn 0.3s ease-out;
}

@keyframes pims-fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes pims-scaleIn {
    0% { transform: scale(0.95); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}

.pims-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
    background-color: var(--pims-primary);
    color: white;
    border-radius: var(--pims-border-radius) var(--pims-border-radius) 0 0;
}

.pims-modal-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    color: var(--pims-text);
    display: flex;
    align-items: center;
    gap: 10px;
}

.pims-modal-header i {
    color: var(--pims-accent);
}

.pims-modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--pims-text-light);
    cursor: pointer;
    transition: all 0.3s ease;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.pims-modal-close:hover {
    color: var(--pims-text);
    background-color: rgba(255, 255, 255, 0.1);
}

.pims-modal-body {
    padding: 20px;
}

/* Profile Modal Content - Redesigned */
.pims-profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.pims-profile-avatar-container {
    position: relative;
    margin-right: 25px;
}

.pims-profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--pims-accent);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
}

.pims-profile-info h3 {
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: var(--pims-dark);
}

.pims-profile-info p {
    font-size: 1rem;
    color: #666;
    margin: 5px 0;
}

.pims-profile-details {
    margin-top: 20px;
}

.pims-detail-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f5f5f5;
}

.pims-detail-label {
    font-weight: 600;
    color: var(--pims-dark);
    width: 40%;
}

.pims-detail-value {
    color: #555;
    width: 60%;
    text-align: right;
}

/* Change Password Form - Redesigned */
.field {
    margin-bottom: 20px;
}

.label {
    color: var(--pims-dark);
    font-weight: 600;
    margin-bottom: 8px;
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
    transition: all 0.3s ease;
}

.input:focus {
    outline: none;
    border-color: var(--pims-accent);
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
}

.help.is-danger {
    color: var(--pims-danger);
    font-size: 0.85rem;
    margin-top: 5px;
    display: block;
}

.button {
    padding: 12px 25px;
    border: none;
    border-radius: var(--pims-border-radius);
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.button.is-primary {
    background-color: var(--pims-success);
    color: var(--pims-text);
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
}

.button.is-primary:hover {
    background-color: #219653;
    transform: translateY(-2px);
    box-shadow: 0 5px 8px rgba(0, 0, 0, 0.15);
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
    padding: 14px 30px;
    font-size: 1.1rem;
}

/* Notification Modal - Redesigned */
.unique-modal {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    transition: opacity 0.3s ease;
}

.unique-modal[aria-hidden="false"] {
    display: flex;
}

.unique-modal-background {
    position: absolute;
    inset: 0;
    cursor: pointer;
}

.unique-modal-content {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    padding: 0;
    max-width: 500px;
    width: 90%;
    z-index: 1;
    animation: fadeIn 0.3s ease-out;
    border-top: 4px solid var(--pims-accent);
}

.unique-box {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.unique-notification-header {
    padding: 20px;
    background-color: var(--pims-primary);
    color: white;
    border-radius: 8px 8px 0 0;
}

.unique-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0;
    color: var(--pims-text);
}

.unique-divider {
    border: none;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    margin: 10px 0;
}

.unique-notification-list {
    max-height: 300px;
    overflow-y: auto;
    padding: 15px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.unique-notification-item {
    background: #f9f9f9;
    border-radius: 6px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    border-left: 3px solid #ddd;
}

.unique-notification-item.unread {
    background: #e6f0ff;
    border-left: 3px solid var(--pims-accent);
}

.unique-notification-item.read {
    color: #666;
}

.unique-notification-item h4 {
    margin: 0 0 5px 0;
    color: var(--pims-dark);
    font-size: 1rem;
}

.unique-notification-item p {
    margin: 0 0 5px 0;
    font-size: 0.9rem;
}

.unique-notification-item small {
    font-size: 0.8rem;
    color: #888;
}

.unique-notification-actions {
    padding: 15px;
    background-color: #f5f5f5;
    border-radius: 0 0 8px 8px;
}

.unique-button-group {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.unique-button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.unique-button.primary {
    background-color: var(--pims-accent);
    color: #fff;
}

.unique-button.primary:hover {
    background-color: #c0392b;
}

.unique-button.light {
    background-color: #e0e0e0;
    color: #333;
}

.unique-button.light:hover {
    background-color: #d0d0d0;
}

.fullwidth {
    width: 100%;
}

.unique-error-message {
    color: var(--pims-danger);
    font-size: 0.9rem;
    padding: 0 15px 15px;
    margin: 0;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .pims-navbar {
        padding: 0 15px;
    }
    
    .pims-system-title {
        display: none;
    }
    
    .pims-logo-text {
        font-size: 1.5rem;
    }
    
    .pims-user-name {
        display: none;
    }
    
    .pims-user-role {
        display: none;
    }
}


@media (max-width: 480px) {
    .pims-modal-content {
        width: 95%;
    }
    
    .pims-profile-header {
        flex-direction: column;
        text-align: center;
    }
    
    .pims-profile-avatar-container {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .pims-detail-item {
        flex-direction: column;
    }
    
    .pims-detail-label,
    .pims-detail-value {
        width: 100%;
        text-align: left;
    }
}
/* Styling for toast notifications */
.toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 20px;
            color: white;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            font-size: 14px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateY(20px);
            max-width: 300px;
            word-wrap: break-word;
        }
        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
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
                            <small>Prison Information Management</small>
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
                <button class="pims-notification-bell" id="open-notifications" aria-label="Open notifications">
                    <i class="fas fa-bell"></i>
                    <span class="pims-notification-badge" id="notification-badge">0</span>
                </button>

                <div class="pims-user-profile" id="pimsUserProfile" tabindex="0" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('storage/' . session('user_image')) }}" alt="User avatar" class="pims-user-avatar">
                    <div class="pims-user-info">
                        <span class="pims-user-name">{{ session('first_name') }}</span>
                        <span class="pims-user-role">{{ session('rolename') }}</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>

                    <div class="pims-dropdown-menu" id="pimsDropdownMenu" aria-hidden="true">
                        <div class="pims-dropdown-header">
                            <img src="{{ asset('storage/' . session('user_image')) }}" alt="User avatar">
                        </div>
                        <div class="pims-dropdown-body">
                            <a href="#" class="pims-dropdown-item" id="pimsViewProfile"><i class="fas fa-user"></i> My Profile</a>
                            <a href="#" class="pims-dropdown-item" id="pimsChangePassword"><i class="fas fa-key"></i> Change Password</a>
                            <a href="{{ url('logout') }}" class="pims-dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Modal -->
    <div class="pims-modal pims-profile-modal" id="pimsProfileModal" aria-hidden="true" inert>
        <div class="pims-modal-background" role="button" aria-label="Close modal" tabindex="0"></div>
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h2><i class="fas fa-user-shield"></i> User Profile</h2>
                <button class="pims-modal-close" aria-label="Close profile modal">×</button>
            </div>
            <div class="pims-modal-body">
                <div class="pims-profile-header">
                    <div class="pims-profile-avatar-container">
                        @if(session('user_image'))
                        <img src="{{ asset('storage/' . session('user_image')) }}" alt="User avatar" class="pims-profile-avatar">
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
                    @foreach (['username', 'first_name', 'last_name', 'email', 'phone', 'gender', 'address', 'rolename', 'prison', 'law_firm', 'license_number', 'cases_handled', 'date_of_birth', 'contact_info'] as $key)
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
                        <div class="pims-detail-value">{{ session('user_id') ?: session('lawyer_id') }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="pims-modal pims-password-modal" id="pimsPasswordModal" aria-hidden="true" inert>
        <div class="pims-modal-background" role="button" aria-label="Close modal" tabindex="0"></div>
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h2><i class="fas fa-lock"></i> Change Password</h2>
                <button class="pims-modal-close" aria-label="Close password modal">×</button>
            </div>
            <div class="pims-modal-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="field">
                        <label class="label">Current Password</label>
                        <div class="control">
                            <input type="password" class="input" name="current_password" placeholder="Enter current password" required>
                        </div>
                        @error('current_password')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">New Password</label>
                        <div class="control">
                            <input type="password" class="input" name="new_password" placeholder="Enter new password" required>
                        </div>
                        @error('new_password')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Confirm New Password</label>
                        <div class="control">
                            <input type="password" class="input" name="new_password_confirmation" placeholder="Confirm new password" required>
                        </div>
                    </div>
                    <div class="has-text-centered">
                        <button type="submit" class="button is-primary is-large">Update Password</button>
                        <button type="button" class="button is-light is-large" onclick="pimsCloseModal('pimsPasswordModal')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification Modal -->
    <div id="unique-notification-modal" class="unique-modal" role="dialog" aria-labelledby="unique-notification-title" aria-hidden="true" inert>
        <div class="unique-modal-background" role="button" aria-label="Close modal" tabindex="0"></div>
        <div class="unique-modal-content">
            <div class="unique-box">
                <div class="unique-notification-header">
                    <h3 class="unique-title" id="unique-notification-title">Notifications</h3>
                    <hr class="unique-divider" aria-hidden="true">
                </div>
                <div id="unique-notification-error" class="unique-error-message"></div>
                <div id="unique-notification-list" class="unique-notification-list" role="list" aria-live="polite"></div>
                <div class="unique-notification-actions">
                    <button class="unique-button primary fullwidth" id="unique-mark-all-as-read" aria-label="Mark all notifications as read" disabled>Mark All as Read</button>
                    <div class="unique-button-group">
                        <button class="unique-button light" id="unique-close-modal" aria-label="Close notifications modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- JavaScript -->
    <script>
document.addEventListener('DOMContentLoaded', () => {
    // Helper to select elements safely
    const $ = (id) => document.getElementById(id);

    // Elements
    const elements = {
        notification: {
            modal: $('unique-notification-modal'),
            list: $('unique-notification-list'),
            error: $('unique-notification-error'),
            badge: $('notification-badge'),
            markAll: $('unique-mark-all-as-read'),
            closeBtn: $('unique-close-modal'),
            background: $('unique-notification-modal')?.querySelector('.unique-modal-background'),
            openBtn: $('open-notifications')
        },
        profile: {
            modal: $('pimsProfileModal'),
            background: $('pimsProfileModal')?.querySelector('.pims-modal-background'),
            closeBtn: $('pimsProfileModal')?.querySelector('.pims-modal-close')
        },
        password: {
            modal: $('pimsPasswordModal'),
            background: $('pimsPasswordModal')?.querySelector('.pims-modal-background'),
            closeBtn: $('pimsPasswordModal')?.querySelector('.pims-modal-close')
        },
        userMenu: {
            user: $('pimsUserProfile'),
            dropdown: $('pimsDropdownMenu'),
            viewBtn: $('pimsViewProfile'),
            passwordBtn: $('pimsChangePassword')
        }
    };

    // Validate elements
    for (const [groupName, group] of Object.entries(elements)) {
        for (const [key, el] of Object.entries(group)) {
            if (!el) console.warn(`Missing ${groupName} element: ${key}`);
        }
    }

    // Toast Notification
    function showToast(message, color = '#333') {
        const toast = Object.assign(document.createElement('div'), {
            textContent: message,
            style: `
                position: fixed; bottom: 20px; right: 20px; padding: 12px 20px;
                background: ${color}; color: white; border-radius: 6px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2); font-size: 14px;
                opacity: 0; transition: opacity 0.3s; z-index: 9999;
            `
        });
        document.body.appendChild(toast);
        requestAnimationFrame(() => toast.style.opacity = '1');
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    const showError = (msg) => showToast(msg, '#dc3545');
    const showSuccess = (msg) => showToast(msg, '#28a745');

    // Modal Functions
    function openModal(modal, focusEl) {
        modal.removeAttribute('inert');
        modal.setAttribute('aria-hidden', 'false');
        trapFocus(modal);
        focusEl?.focus();
    }

    function closeModal(modal, fallback = document.body) {
        modal.setAttribute('inert', '');
        modal.setAttribute('aria-hidden', 'true');
        fallback.focus();
    }

    function trapFocus(modal) {
        const focusable = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        const first = focusable[0], last = focusable[focusable.length - 1];
        const trap = (e) => {
            if (e.key !== 'Tab') return;
            if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
        };
        modal.addEventListener('keydown', trap);
        modal.addEventListener('close', () => modal.removeEventListener('keydown', trap), { once: true });
    }

    // Notification Logic
    let isFetching = false;
    let pollInterval = null;

    async function fetchNotifications(showBadge = true) {
        const routeNotifications = document.querySelector('meta[name="route-notifications"]')?.content;
        if (!routeNotifications) return showError('Missing notifications route.');

        if (isFetching) return;
        isFetching = true;

        try {
            const res = await fetch(routeNotifications, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                },
                credentials: 'same-origin'
            });

            const data = await res.json();
            const list = elements.notification.list;
            const badge = elements.notification.badge;
            const markAll = elements.notification.markAll;

            list.innerHTML = '';
            let unread = 0;

            if (!res.ok || data.error) {
                list.innerHTML = `<p class="unique-empty">${data.error || 'Failed to load notifications.'}</p>`;
                badge.style.display = 'none';
                markAll.disabled = true;
                showError(data.error || 'Error fetching notifications');
                return;
            }

            if (data.length === 0) {
                list.innerHTML = '<p class="unique-empty">No notifications.</p>';
                badge.style.display = 'none';
                markAll.disabled = true;
                return;
            }

            for (const note of data) {
                const item = document.createElement('div');
                item.className = `unique-notification-item ${note.is_read ? 'read' : 'unread'}`;
                item.innerHTML = `
                    <h4>${note.title || 'Notification'}</h4>
                    <p>${note.message}</p>
                    <small>${new Date(note.created_at).toLocaleString()}</small>
                `;
                list.appendChild(item);
                if (!note.is_read) unread++;
            }

            if (showBadge) {
                badge.textContent = unread;
                badge.style.display = unread > 0 ? 'inline-block' : 'none';
            }
            markAll.disabled = unread === 0;

        } catch (err) {
            console.error(err);
            showError('Unable to fetch notifications.');
        } finally {
            isFetching = false;
        }
    }

    async function markAllAsRead() {
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        if (!token) return showError('Missing CSRF token.');

        try {
            const res = await fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({})
            });

            const data = await res.json();
            if (!res.ok) throw new Error(data.error || 'Error marking as read.');

            await fetchNotifications(true);
            showSuccess('All notifications marked as read.');
        } catch (err) {
            showError(err.message || 'Failed to mark as read.');
        }
    }

    function startPolling() {
        if (pollInterval) clearInterval(pollInterval);
        pollInterval = setInterval(() => fetchNotifications(true), 1000);
    }

    function stopPolling() {
        if (pollInterval) {
            clearInterval(pollInterval);
            pollInterval = null;
        }
    }

    // Initial notification count load immediately
    fetchNotifications(true);

    // Event Listeners
    elements.notification.openBtn?.addEventListener('click', () => {
        openModal(elements.notification.modal, elements.notification.closeBtn);
        fetchNotifications(true);
        startPolling();
    });

    elements.notification.closeBtn?.addEventListener('click', () => {
        closeModal(elements.notification.modal, elements.notification.openBtn);
        stopPolling();
    });

    elements.notification.background?.addEventListener('click', () => {
        closeModal(elements.notification.modal, elements.notification.openBtn);
        stopPolling();
    });

    elements.notification.markAll?.addEventListener('click', markAllAsRead);

    // Profile Modal Events
    elements.profile.closeBtn?.addEventListener('click', () => closeModal(elements.profile.modal));
    elements.profile.background?.addEventListener('click', () => closeModal(elements.profile.modal));

    // Password Modal Events
    elements.password.closeBtn?.addEventListener('click', () => closeModal(elements.password.modal));
    elements.password.background?.addEventListener('click', () => closeModal(elements.password.modal));

    // User Dropdown Events
    elements.userMenu.viewBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(elements.profile.modal, elements.profile.closeBtn);
    });

    elements.userMenu.passwordBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(elements.password.modal, elements.password.modal.querySelector('input[name="current_password"]'));
    });

    // Dropdown toggle
    elements.userMenu.user?.addEventListener('click', () => {
        const expanded = elements.userMenu.user.getAttribute('aria-expanded') === 'true';
        elements.userMenu.user.setAttribute('aria-expanded', !expanded);
        elements.userMenu.dropdown.setAttribute('aria-hidden', expanded);
    });

    // Expose for global use
    window.pimsCloseModal = (id) => {
        const modal = $(id);
        if (modal) closeModal(modal);
    };
    startPolling();
});
    </script>
    

@php
    $alertTypes = [
        'success' => '#28a745', // Green
        'error'   => '#dc3545', // Red
        'warning' => '#ffc107', // Yellow
        'info'    => '#17a2b8'  // Blue
    ];
@endphp

<!-- Hidden div to pass session data -->
<div id="sessionData" style="display: none;"
     data-alerts='@json(collect($alertTypes)->mapWithKeys(function ($color, $type) {
         return [$type => session($type)];
     })->filter()->all())'>
</div>

<!-- Toast Container -->
<div id="toastContainer" aria-live="polite" aria-atomic="true" role="alert" ></div>

<style>
    #toastContainer {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 12px;
        max-width: 380px;
        pointer-events: none; /* Allow clicks to pass through except on toasts */
    }

    .toast {
        padding: 16px 24px;
        border-radius: 8px;
        color: #fff;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        font-size: 15px;
        min-width: 280px;
        max-width: 100%;
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.4s ease, transform 0.4s ease;
        pointer-events: auto; /* Enable clicking on toast */
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        user-select: none;
    }

    .toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    .toast button.close-btn {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 18px;
        line-height: 1;
        cursor: pointer;
        padding: 0;
        margin-left: 16px;
        opacity: 0.7;
        transition: opacity 0.2s ease;
    }

    .toast button.close-btn:hover {
        opacity: 1;
    }
</style>

<script>
    function showToast(message, bgColor) {
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.style.backgroundColor = bgColor;

        const messageSpan = document.createElement('span');
        messageSpan.textContent = message;

        const closeBtn = document.createElement('button');
        closeBtn.className = 'close-btn';
        closeBtn.setAttribute('aria-label', 'Close notification');
        closeBtn.innerHTML = '&times;';
        closeBtn.onclick = () => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        };

        toast.appendChild(messageSpan);
        toast.appendChild(closeBtn);

        const container = document.getElementById('toastContainer');
        container.appendChild(toast);

        // Animate toast in
        requestAnimationFrame(() => toast.classList.add('show'));

        // Auto-dismiss after 4 seconds if not manually closed
        setTimeout(() => {
            if (document.body.contains(toast)) {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const sessionDataElement = document.getElementById('sessionData');
        if (sessionDataElement) {
            try {
                const sessionData = JSON.parse(sessionDataElement.dataset.alerts);
                const colors = @json($alertTypes);
                Object.entries(sessionData).forEach(([type, message], index) => {
                    if (message) {
                        const bgColor = colors[type] || '#6c757d';
                        setTimeout(() => showToast(message, bgColor), index * 600);
                    }
                });
            } catch (e) {
                console.error('Failed to parse toast session data:', e);
            }
        }
    });

    
</script>


</body>
</html>