<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prisoner Management System - Login</title>

  <!-- Boxicons for icons -->
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
  <style>
  /* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  background: #121212; /* Dark background */
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden; /* Prevents the body from scrolling */
}

/* Login Container */
.login-container {
  width: 400px;
  padding: 40px;
  background: #1f1f1f; /* Dark container background */
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
  text-align: center;
  animation: fadeIn 0.5s ease-in-out;
  z-index: 1; /* Ensure login container is above the modal */
}



.login-header {
  margin-bottom: 20px;
}

.logo {
  width: 80px;
  margin-bottom: 10px;
  filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.2));
}

h1 {
  font-size: 24px;
  color: #f2f2f2;
  margin-bottom: 10px;
}

/* Input Group Styles */
.input-group {
  display: flex;
  align-items: center;
  background: #2d2d2d; /* Dark input background */
  border-radius: 5px;
  padding: 12px;
  margin-bottom: 15px;
  position: relative;
  transition: border-color 0.3s ease;
}

.input-group:hover {
  border: 1px solid #3498db; /* Blue border on hover */
}

.input-group i {
  color: #667eea; /* Blue icon color */
  font-size: 18px;
  margin-right: 10px;
}

.input-group input {
  width: 100%;
  background: transparent;
  border: none;
  color: #f2f2f2;
  outline: none;
  font-size: 14px;
}

.input-group input::placeholder {
  color: #aaa;
}

/* Password Toggle Button */
.password-toggle {
  position: absolute;
  right: 12px;
  color: #aaa;
  cursor: pointer;
  transition: color 0.3s ease;
}

.password-toggle:hover {
  color: #3498db; /* Blue on hover */
}

/* Login Button */
.login-btn {
  width: 100%;
  background: #3498db; /* Blue button */
  color: white;
  padding: 12px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-size: 16px;
  transition: background 0.3s ease;
}

.login-btn:hover {
  background: #2980b9; /* Darker blue on hover */
}

/* Alert Box */
.alert {
  background: #ff4757; /* Red alert background */
  color: white;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 15px;
  text-align: left;
  animation: slideIn 0.5s ease-in-out;
}

.close-btn {
  float: right;
  cursor: pointer;
  font-weight: bold;
  transition: color 0.3s ease;
}

.close-btn:hover {
  color: #ccc;
}

/* Footer Links */
.footer-links {
  margin-top: 15px;
}

.footer-links a {
  color: #bbb;
  font-size: 14px;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-links a:hover {
  color: #3498db; /* Blue on hover */
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5); /* Modal background */
  justify-content: center;
  align-items: center;
  z-index: 999; /* Ensure modal is above everything else */
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
  background: rgba(0, 0, 0, 0.7); /* Dark overlay */
}

.modal-content {
  position: relative;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  width: 400px;
  text-align: center;
  z-index: 2;
}

.modal .button {
  background: #3498db;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.modal .button:hover {
  background: #2980b9;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 20px;
  color: #ccc;
  cursor: pointer;
}

.modal-close:hover {
  color: #fff;
}

  </style>
</head>

<body>
  <!-- Modal Structure -->
  <div class="modal" id="contact-admin-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="box">
        <h2 class="title">Attention</h2>
        <p>Please contact the system admin for assistance with your account.</p>
        <button class="button is-primary" id="close-modal">Close</button>
      </div>
    </div>
    <button class="modal-close is-large" aria-label="close" id="close-modal-btn"></button>
  </div>

  <!-- Login Container -->
  <div class="login-container">
    <div class="login-box">
      <div class="login-header">
        <img src="assets/img/prison-logo.png" alt="Prison Logo" class="logo">
        <h1>Prisoner Management System</h1>
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

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group">
          <i class='bx bx-user'></i>
          <input type="text" name="email" placeholder="Enter Email">
        </div>

        <div class="input-group">
          <i class='bx bx-lock'></i>
          <input type="password" name="password" id="password" placeholder="Enter Password">
          <i class='bx bx-show password-toggle' id="togglePassword"></i>
        </div>

        <button type="submit" class="login-btn">Login</button>
      </form>

      <!-- Footer Links -->
      <div class="footer-links">
        <a href="#" id="forgot-password-link">Forgot Password?</a>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const togglePassword = document.getElementById("togglePassword");
      const passwordInput = document.getElementById("password");

      togglePassword.addEventListener("click", function () {
        // Toggle password visibility
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          togglePassword.classList.replace("bx-show", "bx-hide"); // Change icon
        } else {
          passwordInput.type = "password";
          togglePassword.classList.replace("bx-hide", "bx-show"); // Change icon back
        }
      });

      // Auto-hide alert messages after 3 seconds
      const alertBox = document.getElementById("alert");
      if (alertBox) {
        setTimeout(() => {
          alertBox.style.display = "none";
        }, 3000);
      }

      // Modal show and hide logic
      const modal = document.getElementById("contact-admin-modal");
      const forgotPasswordLink = document.getElementById("forgot-password-link");
      const closeModal = document.getElementById("close-modal");
      const closeModalBtn = document.getElementById("close-modal-btn");

      // Show modal when "Forgot Password?" is clicked
      forgotPasswordLink.addEventListener("click", function(event) {
        event.preventDefault();  // Prevent default action
        modal.style.display = 'flex';  // Show modal
      });

      // Close modal when "Close" button is clicked
      closeModal.addEventListener("click", function() {
        modal.style.display = 'none';  // Hide modal
      });

      // Close modal when clicking outside of modal content
      closeModalBtn.addEventListener("click", function() {
        modal.style.display = 'none';  // Hide modal
      });
    });
  </script>
</body>

</html>
