<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Secure Login | Prison Information Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        :root {
            --pims-primary: #1a2a3a; /* Dark blue-gray */
            --pims-secondary: #2c3e50; /* Darker blue-gray */
            --pims-accent: #e74c3c; /* Vibrant red */
            --pims-light: #ecf0f1; /* Light gray */
            --pims-dark: #0d1520; /* Very dark blue-gray */
            --pims-text: #ffffff; /* White text */
            --pims-text-light: #bdc3c7; /* Light gray text */
            --pims-success: #27ae60; /* Green */
            --pims-danger: #e74c3c; /* Red */
            --pims-border-radius: 5px;
            --pims-card-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--pims-primary);
            color: var(--pims-text);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: 
                linear-gradient(rgba(26, 42, 58, 0.9), rgba(26, 42, 58, 0.9)),
                url('https://static.euronews.com/articles/stories/06/19/90/88/1200x675_cmsv2_8b08e5b6-7918-576b-8bf5-f889c58c4e01-6199088.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        /* Security Elements */
        .security-grid {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: 0;
        }

        .security-scan {
            position: absolute;
            width: 100%;
            height: 2px;
            background: rgba(39, 174, 96, 0.3);
            box-shadow: 0 0 10px rgba(39, 174, 96, 0.5);
            animation: scan 5s linear infinite;
            z-index: 1;
        }

        @keyframes scan {
            0% { top: 0%; }
            100% { top: 100%; }
        }

        /* Login Container */
        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 420px;
            padding: 0 20px;
        }

        .login-box {
            background: rgba(13, 21, 32, 0.9);
            border-radius: var(--pims-border-radius);
            padding: 40px;
            box-shadow: var(--pims-card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transform-style: preserve-3d;
            transform: perspective(1000px);
            transition: all 0.5s ease;
        }

        .login-box:hover:not(.locked) {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            transform: perspective(1000px) translateY(-5px);
        }

        .login-box.locked {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            border-radius: 50%;
            border: 2px solid var(--pims-accent);
            padding: 5px;
            background: var(--pims-light);
        }

        .login-header h1 {
            font-size: 1.5rem;
            color: var(--pims-text);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .login-header p {
            font-size: 0.8rem;
            color: var(--pims-text-light);
            opacity: 0.8;
        }

        /* Alert Box */
        .alert {
            background: var(--background-color, var(--pims-danger));
            color: var(--pims-text);
            padding: 15px;
            border-radius: var(--pims-border-radius);
            margin-bottom: 20px;
            position: relative;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); }
            to { transform: translateY(0); opacity: 1; }
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close-btn:hover {
            color: var(--pims-dark);
        }

        .alert ul {
            list-style: none;
            margin-left: 5px;
        }

        .alert li {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        /* Input Groups */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i:not(.password-toggle) {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--pims-text-light);
            font-size: 1.2rem;
        }

        .input-group input {
            width: 100%;
            padding: 15px 45px 15px 45px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--pims-border-radius);
            color: var(--pims-text);
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 2px rgba(231, 46, 60, 0.2);
            background: rgba(255, 255, 255, 0.15);
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .input-group input:disabled {
            background: rgba(255, 255, 255, 0.05);
            cursor: not-allowed;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: var(--pims-text-light);
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s, transform 0.3s;
        }

        .password-toggle:hover {
            color: var(--pims-accent);
            transform: translateY(-50%) scale(1.1);
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 15px;
            background: var(--pims-accent);
            color: var(--pims-text);
            border: none;
            border-radius: var(--pims-border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .login-btn:hover:not(:disabled) {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .login-btn:disabled {
            background: rgba(255, 255, 255, 0.2);
            cursor: not-allowed;
        }

        /* Footer Links */
        .footer-links {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .footer-links a {
            color: var(--pims-text-light);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--pims-accent);
            text-decoration: underline;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-background {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .modal-content {
            position: relative;
            width: 90%;
            max-width: 400px;
            animation: modalSlideIn 0.3s;
        }

        @keyframes modalSlideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal .box {
            background: var(--pims-dark);
            color: var(--pims-text);
            padding: 30px;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
        }

        .modal .title {
            color: var(--pims-text);
            margin-bottom: 15px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal .button {
            margin-top: 15px;
            background: var(--pims-accent);
            color: var(--pims-text);
            border: none;
            padding: 10px 20px;
            border-radius: var(--pims-border-radius);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
            font-weight: 500;
        }

        .modal .button:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: var(--pims-text);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .modal-close:hover {
            color: var(--pims-accent);
        }

        /* Contact Info Styles */
        .contact-info {
            font-size: 0.95rem;
            color: var(--pims-text-light);
            line-height: 1.6;
        }

        .contact-info a {
            color: var(--pims-accent);
            text-decoration: none;
            transition: color 0.3s;
        }

        .contact-info a:hover {
            color: #c0392b;
            text-decoration: underline;
        }

        /* Validation Styles */
        .help.is-danger {
            color: var(--pims-danger);
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        /* Security Badge */
        .security-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            color: var(--pims-success);
        }

        .security-badge i {
            margin-right: 5px;
        }

        /* Success Alert */
        .alert-success {
            background: var(--pims-success);
            color: var(--pims-text);
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-box {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 1.3rem;
            }

            .input-group input {
                padding: 12px 40px 12px 40px;
            }

            .modal-content {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <!-- Security Grid Background -->
    <div class="security-grid"></div>
    <div class="security-scan"></div>

    <!-- Credential Assistance Modal -->
    <div class="modal" id="credentialAssistanceModal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <h2 class="title"><i class='bx bx-help-circle'></i> Credential Assistance</h2>
                <p class="contact-info">
                    For password reset or forgotten password, please contact the center at 
                    <a href="tel:+251988882828">+251988882828</a> or email 
                    <a href="mailto:pims@gmail.com">pims@gmail.com</a>.
                </p>
                <button class="button" onclick="closeModal('credentialAssistanceModal')">Close</button>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" onclick="closeModal('credentialAssistanceModal')"></button>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-box" id="loginBox">
            <div class="login-header">
                <img src="assets/img/logo.png" alt="Prison Logo" class="logo">
                <h1>Prison Information Management System</h1>
                <p>Central Ethiopia Regional Administration</p>
            </div>
            @if ($errors->any())
                <div id="alert" class="alert">
                    <span class="close-btn" onclick="this.parentElement.style.display='none';">×</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div id="alert-success" class="alert alert-success">
                    <span class="close-btn" onclick="this.parentElement.style.display='none';">×</span>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('lockout'))
                <div id="lockout-alert" class="alert" style="--background-color: var(--pims-danger);">
                    <span class="close-btn" onclick="this.parentElement.style.display='none';">×</span>
                    <p>{{ session('lockout') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="input-group">
                    <i class='bx bx-user'></i>
                    <input type="text" name="email" id="emailInput" placeholder="Authorized Email" required>
                    <p class="help is-danger" id="emailError" style="display: none;">Valid email required</p>
                </div>

                <div class="input-group">
                    <i class='bx bx-lock'></i>
                    <input type="password" name="password" id="password" placeholder="Secure Password" required>
                    <i class='bx bx-show password-toggle' id="togglePassword"></i>
                </div>

                <button type="submit" class="login-btn" id="loginButton">Authenticate</button>
            </form>

            <!-- Footer Links -->
            <div class="footer-links">
                <a href="#" id="forgot-password-link">Request Credential Assistance</a>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Lockout handling
            const loginForm = document.getElementById("loginForm");
            const loginBox = document.getElementById("loginBox");
            const emailInput = document.getElementById("emailInput");
            const passwordInput = document.getElementById("password");
            const loginButton = document.getElementById("loginButton");
            const emailError = document.getElementById("emailError");
            let failedAttempts = parseInt(localStorage.getItem("failedAttempts") || "0");
            let isLockedOut = localStorage.getItem("isLockedOut") === "true";
            let lockoutStartTime = parseInt(localStorage.getItem("lockoutStartTime") || "0");
            const lockoutDuration = 60 * 1000; 

            function isLockoutActive() {
                const currentTime = Date.now();
                return isLockedOut && (currentTime - lockoutStartTime) < lockoutDuration;
            }

            function resetLockout() {
                isLockedOut = false;
                failedAttempts = 0;
                localStorage.setItem("isLockedOut", "false");
                localStorage.setItem("failedAttempts", "0");
                localStorage.removeItem("lockoutStartTime");
                loginBox.classList.remove("locked");
                emailInput.disabled = false;
                passwordInput.disabled = false;
                loginButton.disabled = false;
                const lockoutAlert = document.getElementById("lockout-alert");
                if (lockoutAlert) {
                    lockoutAlert.remove();
                }
            }

            function updateLockoutState() {
                if (isLockoutActive()) {
                    loginBox.classList.add("locked");
                    emailInput.disabled = true;
                    passwordInput.disabled = true;
                    loginButton.disabled = true;
                    if (!document.getElementById("lockout-alert")) {
                        const lockoutAlert = document.createElement("div");
                        lockoutAlert.id = "lockout-alert";
                        lockoutAlert.className = "alert";
                        lockoutAlert.style.setProperty("--background-color", "var(--pims-danger)");
                        lockoutAlert.innerHTML = `
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">×</span>
                            <p>Account locked for 1 minute due to too many failed attempts. Please try again later or contact the system administrator.</p>
                        `;
                        loginBox.insertBefore(lockoutAlert, loginForm);
                    }
                } else if (isLockedOut) {
                    // Lockout has expired
                    resetLockout();
                }
            }

            // Check for errors to increment failed attempts
            @if ($errors->any())
                failedAttempts++;
                localStorage.setItem("failedAttempts", failedAttempts);
                if (failedAttempts >= 4) {
                    isLockedOut = true;
                    lockoutStartTime = Date.now();
                    localStorage.setItem("isLockedOut", "true");
                    localStorage.setItem("lockoutStartTime", lockoutStartTime);
                }
            @endif

            // Check lockout status on load
            updateLockoutState();

            // Periodically check if lockout has expired
            const lockoutCheckInterval = setInterval(() => {
                if (isLockedOut && !isLockoutActive()) {
                    resetLockout();
                    clearInterval(lockoutCheckInterval);
                }
            }, 1000);

            // Email validation
            function validateEmail() {
                const email = emailInput.value;
                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                const isValid = emailRegex.test(email);
                emailError.style.display = isValid || email === "" ? "none" : "block";
                return isValid;
            }

            emailInput.addEventListener("input", () => {
                validateEmail();
                loginButton.disabled = !validateEmail() || isLockoutActive();
            });

            loginForm.addEventListener("submit", (e) => {
                if (!validateEmail()) {
                    e.preventDefault();
                    emailError.style.display = "block";
                }
            });

            // Password toggle for login form
            const togglePassword = document.getElementById("togglePassword");
            togglePassword.addEventListener("click", function () {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    togglePassword.classList.replace("bx-show", "bx-hide");
                } else {
                    passwordInput.type = "password";
                    togglePassword.classList.replace("bx-hide", "bx-show");
                }
            });

            // Auto-hide alert messages after 5 seconds
            const alertBox = document.getElementById("alert");
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 5000);
            }

            // Modal show and hide logic
            const modal = document.getElementById("credentialAssistanceModal");
            const forgotPasswordLink = document.getElementById("forgot-password-link");

            forgotPasswordLink.addEventListener("click", function(event) {
                event.preventDefault();
                modal.style.display = 'flex';
            });

            // Close modal function
            window.closeModal = function(id) {
                const modal = document.getElementById(id);
                if (modal) {
                    modal.style.display = 'none';
                }
            };

            modal.addEventListener("click", function(e) {
                if (e.target === modal || e.target.classList.contains('modal-background')) {
                    closeModal('credentialAssistanceModal');
                }
            });

            // Security scan animation reset
            setInterval(() => {
                document.querySelector('.security-scan').style.animation = 'none';
                setTimeout(() => {
                    document.querySelector('.security-scan').style.animation = 'scan 5s linear infinite';
                }, 10);
            }, 5000);
        });
    </script>
</body>
</html>