<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login | Prison Information Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #1a252f;
            --text-color: #333;
            --text-light: #7f8c8d;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--primary-color);
            color: var(--light-color);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: 
                linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)),
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
            background: rgba(46, 204, 113, 0.3);
            box-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
            animation: scan 5s linear infinite;
            z-index: 1;
        }

        @keyframes scan {
            0% { top: 0%; }
            100% { top: 100%; }
        }

        /* Loader */
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s, visibility 0.5s;
        }

        #loader.loaded {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            border-top-color: var(--secondary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
            background: rgba(26, 37, 47, 0.9);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transform-style: preserve-3d;
            transform: perspective(1000px);
            transition: all 0.5s ease;
        }

        .login-box:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            transform: perspective(1000px) translateY(-5px);
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
            border: 2px solid var(--secondary-color);
            padding: 5px;
            background: white;
        }

        .login-header h1 {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .login-header p {
            font-size: 0.8rem;
            color: var(--text-light);
            opacity: 0.8;
        }

        /* Alert Box */
        .alert {
            background: var(--danger-color);
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            position: relative;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
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
            color: var(--dark-color);
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

        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.2rem;
        }

        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            color: white;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
            background: rgba(255, 255, 255, 0.15);
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: var(--secondary-color);
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 15px;
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .login-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Footer Links */
        .footer-links {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--secondary-color);
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
            background: var(--dark-color);
            color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .modal .title {
            color: white;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .modal .button {
            margin-top: 15px;
            background: var(--secondary-color);
            color: white;
            border: none;
        }

        .modal .button:hover {
            background: #2980b9;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
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
            color: var(--success-color);
        }

        .security-badge i {
            margin-right: 5px;
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
                padding: 12px 12px 12px 40px;
            }
        }
    </style>
</head>

<body>
    <!-- Security Grid Background -->
    <div class="security-grid"></div>
    <div class="security-scan"></div>

    <!-- Loader -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <!-- Modal Structure -->
    <div class="modal" id="contact-admin-modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <h2 class="title">Security Notice</h2>
                <p>For account assistance, please contact your system administrator directly. Unauthorized access attempts are logged and monitored.</p>
                <button class="button is-primary" id="close-modal">Acknowledged</button>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" id="close-modal-btn"></button>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <img src="assets/img/prison-logo.png" alt="Prison Logo" class="logo">
                <h1>Prison Information Management System</h1>
                <p>Central Ethiopia Regional Administration</p>
            </div>
            @if ($errors->any())
    <div id="alert" class="alert">
        <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div id="alert-success" class="alert alert-success">
        <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        <p>{{ session('success') }}</p>
    </div>
@endif


            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <i class='bx bx-user'></i>
                    <input type="text" name="email" placeholder="Authorized Email" required>
                </div>

                <div class="input-group">
                    <i class='bx bx-lock'></i>
                    <input type="password" name="password" id="password" placeholder="Secure Password" required>
                    <i class='bx bx-show password-toggle' id="togglePassword"></i>
                </div>

                <button type="submit" class="login-btn">Authenticate</button>
            </form>

            <!-- Footer Links -->
            <div class="footer-links">
                <a href="#" id="forgot-password-link">Request Credential Assistance</a>
            </div>
        </div>
    </div>



    <script>
        // Loader timeout
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loader').classList.add('loaded');
            }, 1000);
        });

        document.addEventListener("DOMContentLoaded", function () {
            // Password toggle
            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("password");

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
            const modal = document.getElementById("contact-admin-modal");
            const forgotPasswordLink = document.getElementById("forgot-password-link");
            const closeModal = document.getElementById("close-modal");
            const closeModalBtn = document.getElementById("close-modal-btn");

            // Show modal when "Forgot Password?" is clicked
            forgotPasswordLink.addEventListener("click", function(event) {
                event.preventDefault();
                modal.style.display = 'flex';
            });

            // Close modal when "Close" button is clicked
            closeModal.addEventListener("click", function() {
                modal.style.display = 'none';
            });

            // Close modal when clicking outside of modal content
            closeModalBtn.addEventListener("click", function() {
                modal.style.display = 'none';
            });

            // Close modal when clicking on background
            modal.addEventListener("click", function(e) {
                if (e.target === modal || e.target.classList.contains('modal-background')) {
                    modal.style.display = 'none';
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