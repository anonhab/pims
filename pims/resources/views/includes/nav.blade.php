<style>
    /* 🔔 Notification Modal */
    #notification-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        inset: 0;
        /* Alternative to left, top, width, height */
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
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

    /* ✨ Notification Badge */
    #notification-bell {
        position: relative;
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
    }

    #notification-bell:hover {
        transform: scale(1.1);
    }

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

    /* Show the badge when there are notifications */
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
    /* 🔹 Hosseana Prison Management System Title */#system-title {
    font-size: 1.5rem; /* Increased size for better readability */
    font-weight: bold;
    color: #fff; /* White text */
    background: black; /* Smooth gradient */
    padding: 12px 25px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3); /* Stronger shadow for depth */
    display: flex;
    justify-content: center;
    align-items: center;
    width: fit-content;
    margin-left: 30%;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}




</style>

<nav class="navbar columns is-fixed-top" role="navigation" aria-label="main navigation" id="app-header">
    <div class="navbar-brand column is-2 is-paddingless">
        <a class="navbar-item">
            {{ session('rolename') }}
        </a>
    </div>
    
    @if(session('prison'))
    <div id="system-title">{{ session('prison') }}</div>
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
                    <a class="navbar-item">Settings</a>
                    <hr class="navbar-divider">
                    <a href="{{ url('logout') }}" class="navbar-item app-logout">Logout</a>
                </div>
            </div>

        </div>
    </div>
</nav>
<!-- Profile Modal -->
<!-- Profile Modal -->
<div class="modal" id="profileModal">
    <div class="modal-background"></div>
    <div class="modal-content" style="max-width: 800px; width: 80%; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
        <div class="box">
            <h1 class="title has-text-centered">My Profile</h1>

            <div class="columns is-multiline">
                <!-- Left column: Profile details -->
                <div class="column is-half">
                    <p><strong>Name:</strong> {{ session('first_name') }} {{ session('last_name') }}</p>
                    <p><strong>Email:</strong> {{ session('email') }}</p>
                    <p><strong>Phone:</strong> {{ session('phone') }}</p>
                </div>

                <!-- Right column: Role & Address -->
                <div class="column is-half">
                    <p><strong>Role:</strong> {{ session('role_id') }}</p>
                    <p><strong>Address:</strong> {{ session('address') }}</p>
                </div>
            </div>

            <!-- Additional Profile Info Section (optional) -->
            <div class="columns">
                <div class="column is-full">
                     <figure class="image avatar is-32x32">
                        <img src="{{ asset('storage/' . session('user_image')) }}" alt="User Image" class="is-rounded">
                    </figure>
            </div>
            </div>

            <!-- Close Button -->
            <div class="has-text-centered">
                <button class="button is-primary" onclick="closeModal()">Close</button>
            </div>
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
    document.getElementById('view-profile').addEventListener('click', function () {
        document.getElementById('profileModal').classList.add('is-active');
    });

    function closeModal() {
        document.getElementById('profileModal').classList.remove('is-active');
    }
</script>