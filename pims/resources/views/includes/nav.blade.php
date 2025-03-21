<style>
    /* 🔔 Notification Modal */
    /* 🔔 Notification Modal */
    #notification-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }

    /* Show modal smoothly */
    #notification-modal.is-active {
        opacity: 1;
        visibility: visible;
    }

    /* 📦 Modal Box */
    .modal-content {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        width: 90%;
        max-width: 420px;
        text-align: center;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease-in-out;
        position: relative;
    }

    /* 🔲 Modal Background Click to Close */
    .modal-background {
        position: absolute;
        width: 100%;
        height: 100%;
        background: transparent;
    }

    /* 🔔 Notification Bell & Badge */
    #notification-bell {
        position: relative;
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
    }

    #notification-bell:hover {
        transform: scale(1.1);
    }

    /* 🔴 Notification Count (Badge) */
    #notification-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff3860;
        /* Bright red */
        color: white;
        font-size: 12px;
        font-weight: bold;
        width: 20px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        border-radius: 50%;
        display: none;
        /* Hidden by default */
        box-shadow: 0 0 8px rgba(255, 56, 96, 0.5);
    }

    /* Show badge when notifications exist */
    #notification-count.active {
        display: inline-block;
    }

    /* 🎨 Button Styles */
    button {
        margin: 8px;
        padding: 12px 18px;
        font-size: 1rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
    }

    button:hover {
        transform: scale(1.05);
    }

    /* 🎯 Primary Button */
    button.is-primary {
        background: #007bff;
        color: white;
    }

    button.is-primary:hover {
        background: #0056b3;
    }

    /* ⚪ Light Button */
    button.is-light {
        background: #f1f1f1;
        color: #333;
    }

    button.is-light:hover {
        background: #d6d6d6;
    }

    /* 🔹 System Title - Centered & Responsive */
    #system-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff;
        background: #475569;
        padding: 12px 25px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        display: inline-block;
        max-width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* 🖼 Profile Modal Enhancements */
    #profileModal .box {
        padding: 20px;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    #profileModal img.is-rounded {
        border: 2px solid #007bff;
        box-shadow: 0px 3px 10px rgba(0, 123, 255, 0.3);
    }

    /* ✨ Smooth Fade-in Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* 📦 Profile Modal Box */
    /* 📦 Larger Profile Modal Box */
    .profile-box {
        max-width: 700px;
        /* Increased width */
        width: 90%;
        padding: 30px;
        /* More padding */
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        animation: fadeIn 0.3s ease-in-out;
        position: relative;
    }

    /* 🖼 Larger Profile Image */
    .profile-image img {
        border: 4px solid #007bff;
        border-radius: 50%;
        box-shadow: 0px 5px 12px rgba(0, 123, 255, 0.3);
        transition: transform 0.3s ease-in-out;
        width: 100%;
        max-width: 150px;
        /* Increased size */
        height: auto;
    }

    /* 📸 Profile Image Hover Effect */
    .profile-image img:hover {
        transform: scale(1.08);
    }

    /* 👤 Larger Username */
    .username {
        font-size: 1.4rem;
        /* Increased size */
        font-weight: bold;
        color: #007bff;
        margin-top: 12px;
    }

    /* 📄 Larger Profile Details */
    .profile-details {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* 🏷 Profile Items */
    .profile-item {
        padding: 8px 0;
        border-bottom: 1px solid #ddd;
    }

    /* 🖌 Last Item - Remove Bottom Border */
    .profile-item:last-child {
        border-bottom: none;
    }

    /* 🔄 Modal Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* 📲 Responsive Fixes */
    @media screen and (max-width: 768px) {
        .profile-box {
            max-width: 95%;
        }

        .profile-image {
            margin-bottom: 15px;
        }

        .profile-details {
            text-align: center;
        }
    }
    /* 📦 Password Modal */
.password-box {
    max-width: 500px;
    width: 90%;
    padding: 25px;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    animation: fadeIn 0.3s ease-in-out;
    position: relative;
}

/* 🔑 Input Fields */
.input {
    border: 2px solid #ddd;
    border-radius: 5px;
    padding: 10px;
}

/* 📢 Modal Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

/* 📲 Responsive */
@media screen and (max-width: 768px) {
    .password-box {
        max-width: 90%;
    }
}
</style>
@if (session('success'))
    <div id="success-popup" class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-content">
            <article class="message is-success">
                <div class="message-header">
                    <p>Success</p>
                    <button class="delete" aria-label="delete" onclick="closeSuccessPopup()"></button>
                </div>
                <div class="message-body">
                    {{ session('success') }}
                </div>
            </article>
        </div>
    </div>
@endif

<script>
    function closeSuccessPopup() {
        document.getElementById('success-popup').classList.remove('is-active');
    }
</script>

<nav class="navbar columns is-fixed-top" role="navigation" aria-label="main navigation" id="app-header">
    <div class="navbar-brand column is-2 is-paddingless">
        <a class="navbar-item">
            PIMS
        </a>
    </div>

    @if(session('prison'))
    <div id="system-title">
        {{ session('rolename') }} For {{ session('prison') }}
    </div>
    @endif

    <div id="navMenu" class="navbar-menu column is-hidden-touch">

        <div class="navbar-end">
            <!-- 🔔 Notification Bell -->
            <div class="navbar-item dropdown">
                <div class="dropdown-trigger">
                    <a class="button is-white" id="notification-bell">
                        <span class="icon">
                            <i class="fa fa-lg fa-bell"></i>
                        </span>
                        <span id="notification-count" class="badge is-danger" style="display: none;">0</span>
                    </a>
                </div>
                <div class="dropdown-menu" id="notification-dropdown" role="menu">
                    <div class="dropdown-content">
                        <div class="dropdown-item">Loading...</div>
                    </div>
                </div>
            </div>

            <!-- User Profile Dropdown -->
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <figure class="image avatar is-32x32">
                        <img src="{{ asset('storage/' . session('user_image')) }}" alt="User Image" class="is-rounded">
                    </figure>
                    &nbsp; Hi, {{ session('first_name') }}
                </a>
                <div class="navbar-dropdown">
                    <a href="#" class="navbar-item" id="view-profile">My Profile</a>
                    <a href="#" class="navbar-item" id="change-password">Change Password</a> <!-- Added ID for modal trigger -->
                    <hr class="navbar-divider">
                    <a href="{{ url('logout') }}" class="navbar-item app-logout">Logout</a>
                </div>
            </div>

        </div>
    </div>
</nav>

<!-- Change Password Modal -->
<div class="modal" id="passwordModal">
    <div class="modal-background" onclick="closePasswordModal()"></div>

    <div class="modal-content box">
        <h1 class="title has-text-centered">Change Password</h1>

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

    <!-- Modal Close Button -->
    <button class="modal-close is-large" aria-label="close" onclick="closePasswordModal()"></button>
</div>

<!-- 📦 Profile Modal -->
<div class="modal" id="profileModal">
    <div class="modal-background" onclick="closeModal()"></div>

    <div class="modal-content profile-box">
        <h1 class="title has-text-centered">My Profile</h1>

        <div class="columns is-multiline">
            <!-- Left Column: Profile Image -->
            <div class="column is-5 has-text-centered">
                <figure class="image is-150x150 profile-image">
                    <img src="{{ session('user_image') ? asset('storage/' . session('user_image')) : asset('default-avatar.png') }}"
                        alt="User Image">
                </figure>
                <p class="username">{{ session('username') }}</p>
            </div>

            <!-- Right Column: Profile Details -->
            <div class="column is-7 profile-details">
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
        </div>

        <!-- Close Button -->
        <div class="has-text-centered">
            <button class="button is-primary is-large" onclick="closeModal()">Close</button>
        </div>
    </div>

    <!-- Modal Close Button -->
    <button class="modal-close is-large" aria-label="close" onclick="closeModal()"></button>
</div>

<!-- 🔥 Enhanced Notification Modal -->
<div id="notification-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            <div class="notification-header">
                <h3 class="title is-5 has-text-centered">New Notification</h3>
                <hr class="is-marginless">
            </div>
            <p id="modal-message" class="has-text-centered"></p>
            <br>
            <div class="notification-actions">
                <button class="button is-primary is-fullwidth" id="mark-as-read">Mark as Read</button>
                <div class="buttons is-centered">
                    <button class="button is-light" id="close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
    document.getElementById('change-password').addEventListener('click', function () {
        document.getElementById('passwordModal').classList.add('is-active');
    });

    // Close Modal
    function closePasswordModal() {
        document.getElementById('passwordModal').classList.remove('is-active');
    }
</script>