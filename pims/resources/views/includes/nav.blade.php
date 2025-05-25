<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* Reset and Base Styles */
        .pims-reset {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            background-color: var(--pims-light);
            color: var(--pims-dark);
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
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--pims-text-light);
            cursor: pointer;
            position: relative;
            transition: color 0.3s;
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

        .pims-dropdown-menu[aria-hidden="false"] {
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

        /* Modal Base Styles */
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

        .pims-modal-background:focus {
            outline: 2px solid var(--pims-accent);
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
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
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

        /* === Notification Modal Styles === */

        .unique-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
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
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 1.5rem;
            max-width: 500px;
            width: 90%;
            z-index: 1;
            animation: fadeIn 0.3s ease-out;
        }

        .unique-box {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Header */
        .unique-notification-header {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .unique-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .unique-divider {
            border: none;
            border-top: 1px solid #ddd;
        }

        /* Notification List */
        .unique-notification-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 0.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .unique-notification-item {
            background: #f9f9f9;
            border-radius: 6px;
            padding: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: background 0.2s;
        }

        .unique-notification-item.unread {
            background: #e6f0ff;
            font-weight: 500;
        }

        .unique-notification-item.read {
            color: #666;
        }

        /* Actions */
        .unique-notification-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .unique-button-group {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        /* Buttons */
        .unique-button {
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .unique-button.primary {
            background-color: #007bff;
            color: #fff;
        }

        .unique-button.primary:disabled {
            background-color: #99caff;
            cursor: not-allowed;
        }

        .unique-button.light {
            background-color: #f0f0f0;
            color: #333;
        }

        .unique-button:hover {
            filter: brightness(0.95);
        }

        .fullwidth {
            width: 100%;
        }

        /* Error message */
        .unique-error-message {
            color: #d9534f;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 500px) {
            .unique-modal-content {
                width: 95%;
                padding: 1rem;
            }
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
                    <span class="pims-notification-badge" id="notification-badge" style="display: none;">0</span>
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
            // DOM Elements
            const notificationModal = document.getElementById('unique-notification-modal');
            const notificationList = document.getElementById('unique-notification-list');
            const errorMessage = document.getElementById('unique-notification-error');
            const markAllButton = document.getElementById('unique-mark-all-as-read');
            const closeNotificationButton = document.getElementById('unique-close-modal');
            const notificationBackground = notificationModal?.querySelector('.unique-modal-background');
            const openNotificationButton = document.getElementById('open-notifications');
            const notificationBadge = document.getElementById('notification-badge');

            const profileModal = document.getElementById('pimsProfileModal');
            const profileBackground = profileModal?.querySelector('.pims-modal-background');
            const closeProfileButton = profileModal?.querySelector('.pims-modal-close');

            const passwordModal = document.getElementById('pimsPasswordModal');
            const passwordBackground = passwordModal?.querySelector('.pims-modal-background');
            const closePasswordButton = passwordModal?.querySelector('.pims-modal-close');

            const userProfile = document.getElementById('pimsUserProfile');
            const dropdownMenu = document.getElementById('pimsDropdownMenu');
            const viewProfileButton = document.getElementById('pimsViewProfile');
            const changePasswordButton = document.getElementById('pimsChangePassword');

            // Validate Elements
            if (!notificationModal || !notificationList || !markAllButton || !closeNotificationButton || !notificationBackground || !openNotificationButton || !notificationBadge || !errorMessage) {
                console.error('Missing notification elements:', {
                    notificationModal,
                    notificationList,
                    markAllButton,
                    closeNotificationButton,
                    notificationBackground,
                    openNotificationButton,
                    notificationBadge,
                    errorMessage
                });
                return;
            }
            if (!profileModal || !profileBackground || !closeProfileButton || !passwordModal || !passwordBackground || !closePasswordButton) {
                console.error('Missing modal elements:', {
                    profileModal,
                    profileBackground,
                    closeProfileButton,
                    passwordModal,
                    passwordBackground,
                    closePasswordButton
                });
                return;
            }
            if (!userProfile || !dropdownMenu || !viewProfileButton || !changePasswordButton) {
                console.error('Missing dropdown elements:', {
                    userProfile,
                    dropdownMenu,
                    viewProfileButton,
                    changePasswordButton
                });
                return;
            }

            // Notification State
            let isFetching = false;
            let hasUnread = false;
            let pollInterval = null;

            // Show Error Message
            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.style.display = 'block';
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                    errorMessage.textContent = '';
                }, 5000);
            }

            // Fetch Notifications
            async function fetchNotifications() {
                if (isFetching || !notificationList) {
                    console.warn('Fetch skipped: already fetching or list missing');
                    return;
                }
                isFetching = true;

                try {
                    const response = await fetch('notifications', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        credentials: 'same-origin' // 🔥 This enables session cookies to be sent
                    });
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    const notifications = await response.json();
                    notificationList.innerHTML = '';
                    hasUnread = false;

                    if (notifications.error) {
                        notificationList.innerHTML = `<p class="unique-empty">${notifications.error}</p>`;
                        markAllButton.disabled = true;
                        notificationBadge.style.display = 'none';
                        showError(notifications.error);
                        return;
                    }

                    if (notifications.length === 0) {
                        notificationList.innerHTML = '<p class="unique-empty">No notifications.</p>';
                        markAllButton.disabled = true;
                        notificationBadge.style.display = 'none';
                        return;
                    }

                    let unreadCount = 0;
                    notifications.forEach(notification => {
                        const div = document.createElement('div');
                        div.className = `unique-notification-item ${notification.is_read ? 'read' : 'unread'}`;
                        div.setAttribute('role', 'listitem');
                        div.innerHTML = `
                        <h4>${notification.title || 'Notification'}</h4>
                        <p>${notification.message}</p>
                        <small>${new Date(notification.created_at).toLocaleString('en-US', {
                            dateStyle: 'medium',
                            timeStyle: 'short'
                        })}</small>
                    `;
                        notificationList.appendChild(div);
                        if (!notification.is_read) {
                            hasUnread = true;
                            unreadCount++;
                        }
                    });

                    markAllButton.disabled = !hasUnread;
                    notificationBadge.textContent = unreadCount;
                    notificationBadge.style.display = unreadCount > 0 ? 'inline-block' : 'none';
                } catch (error) {
                    console.error('Fetch notifications error:', error.message);
                    notificationList.innerHTML = `<p class="unique-empty">Failed to load notifications: ${error.message}</p>`;
                    markAllButton.disabled = true;
                    notificationBadge.style.display = 'none';
                    showError('Failed to load notifications');
                } finally {
                    isFetching = false;
                }
            }

            // Mark All as Read
            async function markAllAsRead() {
                console.log('Mark All as Read clicked');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
                if (!csrfToken) {
                    console.error('CSRF token missing');
                    showError('Session error, please refresh the page');
                    return;
                }

                try {
                    markAllButton.disabled = true; // Disable button during request
                    console.log('Sending mark-all-read request with CSRF token:', csrfToken);
                    const response = await fetch('notifications/mark-all-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    console.log('Response status:', response.status);
                    const result = await response.json();
                    console.log('Response data:', result);

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${result.error || response.statusText}`);
                    }

                    if (result.success) {
                        console.log('Notifications marked as read, updated count:', result.updated);
                        await fetchNotifications(); // Refresh notifications
                    } else {
                        throw new Error(result.error || 'Unknown error');
                    }
                } catch (error) {
                    console.error('Mark all as read error:', error.message);
                    showError(error.message || 'Failed to mark notifications as read');
                    markAllButton.disabled = !hasUnread; // Re-enable if there are still unread
                }
            }

            // Modal Control
            function openModal(modal, focusElement) {
                modal.setAttribute('aria-hidden', 'false');
                modal.removeAttribute('inert');
                trapFocus(modal);
                focusElement?.focus();
            }

            function closeModal(modal, focusElement) {
                const focusTarget = focusElement || document.querySelector('body > button, body > a') || document.body;
                focusTarget.focus();
                modal.setAttribute('aria-hidden', 'true');
                modal.setAttribute('inert', '');
            }

            // Focus Trap
            function trapFocus(modal) {
                const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                if (focusableElements.length === 0) return;

                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];

                const handleKeydown = (event) => {
                    if (event.key !== 'Tab') return;
                    if (event.shiftKey && document.activeElement === firstElement) {
                        event.preventDefault();
                        lastElement.focus();
                    } else if (!event.shiftKey && document.activeElement === lastElement) {
                        event.preventDefault();
                        firstElement.focus();
                    }
                };

                modal.addEventListener('keydown', handleKeydown);
                modal.addEventListener('close', () => modal.removeEventListener('keydown', handleKeydown), {
                    once: true
                });
            }

            // Notification Modal Handlers
            function openNotificationModal() {
                openModal(notificationModal, closeNotificationButton);
                fetchNotifications();
                startPolling();
            }

            function closeNotificationModal() {
                closeModal(notificationModal, openNotificationButton);
                stopPolling();
                markAllButton.disabled = true;
                errorMessage.style.display = 'none';
            }

            // Polling Control
            function startPolling() {
                if (pollInterval) return;
                pollInterval = setInterval(() => {
                    if (notificationModal.getAttribute('aria-hidden') === 'false' && !isFetching) {
                        fetchNotifications();
                    }
                }, 5000);
                fetchNotifications();
            }

            function stopPolling() {
                if (pollInterval) {
                    clearInterval(pollInterval);
                    pollInterval = null;
                }
            }

            // Modal Close Function
            window.pimsCloseModal = function(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) closeModal(modal);
            };

            // Dropdown Handling
            function toggleDropdown() {
                const isExpanded = userProfile.getAttribute('aria-expanded') === 'true';
                userProfile.setAttribute('aria-expanded', !isExpanded);
                dropdownMenu.setAttribute('aria-hidden', isExpanded);
            }

            function closeDropdown() {
                userProfile.setAttribute('aria-expanded', 'false');
                dropdownMenu.setAttribute('aria-hidden', 'true');
            }

            // Event Listeners
            openNotificationButton.addEventListener('click', openNotificationModal);
            closeNotificationButton.addEventListener('click', closeNotificationModal);
            notificationBackground.addEventListener('click', closeNotificationModal);
            notificationBackground.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    closeNotificationModal();
                }
            });
            markAllButton.addEventListener('click', markAllAsRead);

            closeProfileButton.addEventListener('click', () => closeModal(profileModal));
            profileBackground.addEventListener('click', () => closeModal(profileModal));
            profileBackground.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    closeModal(profileModal);
                }
            });

            closePasswordButton.addEventListener('click', () => closeModal(passwordModal));
            passwordBackground.addEventListener('click', () => closeModal(passwordModal));
            passwordBackground.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    closeModal(passwordModal);
                }
            });

            viewProfileButton.addEventListener('click', (event) => {
                event.preventDefault();
                openModal(profileModal, closeProfileButton);
                closeDropdown();
            });

            changePasswordButton.addEventListener('click', (event) => {
                event.preventDefault();
                openModal(passwordModal, passwordModal.querySelector('input[name="current_password"]'));
                closeDropdown();
            });

            userProfile.addEventListener('click', toggleDropdown);
            userProfile.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    toggleDropdown();
                }
            });

            document.addEventListener('click', (event) => {
                if (!userProfile.contains(event.target)) {
                    closeDropdown();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeDropdown();
                    closeModal(notificationModal);
                    closeModal(profileModal);
                    closeModal(passwordModal);
                }
            });

            // Initialize
            fetchNotifications();
        });
    </script>
</body>

</html>