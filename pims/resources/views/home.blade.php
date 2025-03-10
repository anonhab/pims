<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prison Information Management System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* General Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #1a1a1a;
      color: #fff;
      line-height: 1.6;
    }

    a {
      text-decoration: none;
      color: #007bff;
    }

    a:hover {
      color: #0056b3;
    }

    /* Navbar */
.navbar {
  background-color: #111;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.navbar-brand {
  display: flex;
  align-items: center;
}

.navbar-brand .logo {
  height: 50px;
  margin-right: 10px;
}

.navbar-brand .brand-name {
  font-size: 1.5rem;
  font-weight: bold;
  color: #fff;
}

.navbar-toggler {
  display: none; /* Hidden by default */
  background: none;
  border: none;
  color: #fff;
  font-size: 1.5rem;
  cursor: pointer;
}

.navbar-nav {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
}

.navbar-nav .nav-link {
  color: #fff;
  margin: 0 15px;
  font-size: 1rem;
  transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
  color: #007bff;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
  .navbar-toggler {
    display: block; /* Show toggle button on mobile */
  }

  .navbar-nav {
    display: none; /* Hide nav links by default on mobile */
    flex-direction: column;
    width: 100%;
    background-color: #111;
    position: absolute;
    top: 70px;
    left: 0;
    padding: 1rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
  }

  .navbar-nav.active {
    display: flex; /* Show nav links when active */
  }

  .navbar-nav .nav-link {
    margin: 10px 0;
    text-align: center;
  }
}
    /* Hero Section */
    .hero {
      background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Flag_of_Central_Ethiopia.png/640px-Flag_of_Central_Ethiopia.png');
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
    }

    .hero-overlay {
      position: relative;
      z-index: 1;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 2rem;
      border-radius: 10px;
    }

    .hero h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero p {
      font-size: 1.5rem;
      margin-bottom: 30px;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .hero .btn {
      background-color: #007bff;
      color: #fff;
      padding: 0.75rem 2rem;
      border: none;
      border-radius: 5px;
      font-size: 1.2rem;
      transition: background-color 0.3s ease;
    }

    .hero .btn:hover {
      background-color: #0056b3;
    }

    /* About Section */
    .about {
      padding: 4rem 2rem;
      background-color: #222;
    }

    .about h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      text-align: center;
    }

    .about p {
      font-size: 1.2rem;
      text-align: justify;
      max-width: 800px;
      margin: 0 auto 2rem;
    }

    .stats {
      display: flex;
      justify-content: space-around;
      margin-top: 2rem;
    }

    .stat {
      text-align: center;
    }

    .stat i {
      font-size: 2.5rem;
      margin-bottom: 10px;
    }

    .stat .number {
      font-size: 2rem;
      font-weight: bold;
    }

    .stat .label {
      font-size: 1rem;
      color: #aaa;
    }

    /* Services Section */
    .services {
      padding: 4rem 2rem;
      background-color: #1a1a1a;
    }

    .services h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      text-align: center;
    }

    .service-cards {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }

    .card {
      background-color: #333;
      padding: 2rem;
      border-radius: 10px;
      width: 30%;
      text-align: center;
      margin: 1rem;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
    }

    .card i {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .card h3 {
      font-size: 1.5rem;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 1rem;
      color: #aaa;
    }

    /* Login Section */
    .login {
      padding: 4rem 2rem;
      background-color: #222;
    }

    .login h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      text-align: center;
    }

    .login-form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #333;
      padding: 2rem;
      border-radius: 10px;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-size: 1rem;
    }

    .form-group input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #555;
      border-radius: 5px;
      background-color: #444;
      color: #fff;
      font-size: 1rem;
    }

    .login-form .btn {
      width: 100%;
      padding: 0.75rem;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .login-form .btn:hover {
      background-color: #0056b3;
    }

    /* Contact Section */
    .contact {
      padding: 4rem 2rem;
      background-color: #222;
    }

    .contact h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      text-align: center;
    }

    .contact-info {
      display: flex;
      justify-content: space-around;
      margin-top: 2rem;
    }

    .info {
      text-align: center;
    }

    .info i {
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .info span {
      font-size: 1.2rem;
    }

    /* Footer */
    footer {
      background-color: #111;
      padding: 2rem;
      text-align: center;
    }

    footer p {
      margin: 0;
      font-size: 1rem;
    }

    .social-links {
      margin-top: 1rem;
    }

    .social-links a {
      color: #fff;
      margin: 0 10px;
      font-size: 1.5rem;
      transition: color 0.3s ease;
    }

    .social-links a:hover {
      color: #007bff;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
      .navbar-toggler {
        display: block;
      }

      .navbar-nav {
        display: none;
        flex-direction: column;
        width: 100%;
        background-color: #111;
        position: absolute;
        top: 70px;
        left: 0;
        padding: 1rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
      }

      .navbar-nav.active {
        display: flex;
      }

      .navbar-nav .nav-link {
        margin: 10px 0;
        text-align: center;
      }

      .hero h1 {
        font-size: 2.5rem;
      }

      .hero p {
        font-size: 1.2rem;
      }

      .stats {
        flex-direction: column;
      }

      .service-cards {
        flex-direction: column;
      }

      .card {
        width: 100%;
        margin: 1rem 0;
      }

      .contact-info {
        flex-direction: column;
      }

      .info {
        margin-bottom: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
  <div class="navbar-brand">
    <img src="{{ asset('assets/images/prison-logo.png') }}" alt="Prison Logo" class="logo">
    <span class="brand-name">Central Ethiopia Prison System</span>
    <button class="navbar-toggler" id="navbar-toggler">
      <i class="fas fa-bars"></i>
    </button>
  </div>
  <ul class="navbar-nav" id="navbar-nav">
    <li><a href="#home" class="nav-link" data-component="home">Home</a></li>
    <li><a href="#about" class="nav-link" data-component="about">About</a></li>
    <li><a href="#services" class="nav-link" data-component="services">Services</a></li>
    <li><a href="#contact" class="nav-link" data-component="contact">Contact</a></li>
    <li><a href="#login" class="nav-link" data-component="login">Login</a></li>
  </ul>
</nav>

  <!-- Main Content Container -->
  <div id="main-content">
    <!-- Default Home Component -->
    @include('components.home')
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; 2023 Central Ethiopia Prison System. All rights reserved.</p>
      <div class="social-links">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
      </div>
    </div>
  </footer>

  <!-- JavaScript for Dynamic Content Loading -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
  const navbarToggler = document.getElementById('navbar-toggler');
  const navbarNav = document.getElementById('navbar-nav');

  // Toggle Navbar on Mobile
  navbarToggler.addEventListener('click', function () {
    navbarNav.classList.toggle('active');
  });

  // Close Navbar when a link is clicked (for mobile)
  navbarNav.addEventListener('click', function (e) {
    if (e.target.classList.contains('nav-link')) {
      navbarNav.classList.remove('active');
    }
  });

  // Dynamic Content Loading
  const navLinks = document.querySelectorAll('.nav-link');
  const mainContent = document.getElementById('main-content');

  navLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const component = this.getAttribute('data-component');

      // Fetch the component content
      fetch(`/components/${component}`)
        .then(response => response.text())
        .then(data => {
          mainContent.innerHTML = data;
        })
        .catch(error => console.error('Error loading component:', error));
    });
  });
});
  </script>
</body>
</html>