<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Information Management System | Central Ethiopia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global Styles */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --text-color: #333;
            --text-light: #7f8c8d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f9f9f9;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        h1,
        h2,
        h3,
        h4 {
            color: var(--dark-color);
            font-weight: 600;
        }

        p {
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            background: var(--secondary-color);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-accent {
            background: var(--accent-color);
        }

        .btn-accent:hover {
            background: #c0392b;
        }

        .section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-title h2 {
            font-size: 2.5rem;
            display: inline-block;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }

        /* Header Styles */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .logo-text h1 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 0;
        }

        .logo-text span {
            font-size: 0.9rem;
            color: var(--text-light);
            display: block;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        nav ul li a:hover {
            color: var(--secondary-color);
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: width 0.3s ease;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-color);
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.8)), url('https://static.euronews.com/articles/stories/06/19/90/88/1200x675_cmsv2_8b08e5b6-7918-576b-8bf5-f889c58c4e01-6199088.jpg') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: left;
            padding-top: 80px;
        }

        .hero-content {
            max-width: 600px;
        }

        .hero h1 {
            font-size: 3rem;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .hero-btns {
            display: flex;
            gap: 15px;
        }

        /* Features Section */
        .features {
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--secondary-color);
            font-size: 1.8rem;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        /* About Section */
        .about {
            background: var(--light-color);
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .about-text {
            flex: 1;
        }

        .about-image {
            flex: 1;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .about-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Stats Section */
        .stats {
            background: var(--primary-color);
            color: white;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }

        .stat-item h3 {
            font-size: 3rem;
            color: white;
            margin-bottom: 10px;
        }

        .stat-item p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        /* Contact Section */
        .contact {
            background: white;
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .contact-info {
            margin-bottom: 30px;
        }

        .contact-info h3 {
            margin-bottom: 20px;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .contact-info-icon {
            width: 40px;
            height: 40px;
            background: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--secondary-color);
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }

        .contact-form textarea {
            height: 150px;
            resize: vertical;
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 50px 0 20px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            color: white;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .footer-col p {
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-links li {
            margin-bottom: 10px;
            list-style: none;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .about-content {
                flex-direction: column;
            }

            .about-image {
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                padding: 15px 0;
            }

            nav {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: white;
                transition: left 0.3s ease;
                padding: 30px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            }

            nav.active {
                left: 0;
            }

            nav ul {
                flex-direction: column;
            }

            nav ul li {
                margin: 15px 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-btns {
                flex-direction: column;
            }

            .section {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-text">
                    <h1>PIMS</h1>
                    <span>Prison Information Management System</span>
                </div>
            </div>

            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>

            <nav id="mainNav">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#visitorRegisterModal">Register as Visitor</a></li>

                    <li><a href="/login" class="btn btn-accent">Login</a></li>
                </ul>
            </nav>

        </div>
    </header>
<!-- Visitor Registration Modal -->
<div class="modal fade" id="visitorRegisterModal" tabindex="-1" aria-labelledby="visitorRegisterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('visitor.register.submit') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="visitorRegisterModalLabel">Visitor Registration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="phone_number" class="form-label">Phone Number</label>
          <input type="text" name="phone_number" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="relationship" class="form-label">Relationship</label>
          <input type="text" name="relationship" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="identification_number" class="form-label">ID Number</label>
          <input type="text" name="identification_number" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-accent">Register</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Modern Prison Management for Central Ethiopia</h1>
                <p>Streamlining correctional facility operations with our comprehensive Prison Information Management System. Secure, efficient, and designed for the unique needs of Central Ethiopia's prison system.</p>
                <div class="hero-btns">
                    <a href="#features" class="btn">Explore Features</a>
                    <a href="#contact" class="btn btn-accent">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>System Features</h2>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <h3>Inmate Management</h3>
                    <p>Comprehensive tracking of inmate records, including personal details, offenses, and incarceration history.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3>Case Tracking</h3>
                    <p>Monitor legal cases, court dates, and judgments for each inmate with automated reminders.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Visitor Management</h3>
                    <p>Efficient scheduling and tracking of inmate visits with proper security protocols.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Medical Records</h3>
                    <p>Maintain complete health records and schedule medical appointments for inmates.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Reporting & Analytics</h3>
                    <p>Generate detailed reports and gain insights into prison operations and population trends.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Security Management</h3>
                    <p>Monitor security incidents, staff assignments, and facility access control.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section about" id="about">
        <div class="container">
            <div class="section-title">
                <h2>About PIMS</h2>
            </div>

            <div class="about-content">
                <div class="about-text">
                    <p>The Prison Information Management System (PIMS) is a state-of-the-art solution designed specifically for the correctional facilities in Central Ethiopia. Our system addresses the unique challenges faced by prison administrators in managing inmate populations, security protocols, and rehabilitation programs.</p>

                    <p>Developed in collaboration with correctional experts, PIMS provides a secure, centralized platform that enhances operational efficiency while maintaining the highest standards of data security and privacy compliance.</p>

                    <p>Our mission is to modernize prison management through technology, improving outcomes for both staff and inmates while ensuring public safety across the Central Ethiopia region.</p>

                    <a href="#" class="btn">Learn More</a>
                </div>

                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1581093196270-1a1d1b6b9540?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Prison Management System">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>25+</h3>
                    <p>Prisons Connected</p>
                </div>

                <div class="stat-item">
                    <h3>10,000+</h3>
                    <p>Records Managed</p>
                </div>

                <div class="stat-item">
                    <h3>99.9%</h3>
                    <p>System Uptime</p>
                </div>

                <div class="stat-item">
                    <h3>50+</h3>
                    <p>Trained Staff</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Contact Us</h2>
            </div>

            <div class="contact-container">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p>Have questions about our Prison Information Management System? Contact our team for more information.</p>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4>Location</h4>
                            <p>Central Ethiopia Regional Administration, Wolkite, Ethiopia</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4>Email</h4>
                            <p>info@pims-ethiopia.gov.et</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4>Phone</h4>
                            <p>+251 11 123 4567</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form>
                        <input type="text" placeholder="Your Name" required>
                        <input type="email" placeholder="Your Email" required>
                        <input type="text" placeholder="Subject">
                        <textarea placeholder="Your Message" required></textarea>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <div class="logo">
                        <div class="logo-text">
                            <h1 style="color: white;">PIMS</h1>
                            <span style="color: rgba(255, 255, 255, 0.7);">Prison Information Management System</span>
                        </div>
                    </div>
                    <p>Modernizing correctional facility management across Central Ethiopia through innovative technology solutions.</p>
                </div>

                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="/login">Login</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Inmate Management</a></li>
                        <li><a href="#">Visitor Tracking</a></li>
                        <li><a href="#">Case Management</a></li>
                        <li><a href="#">Reporting Tools</a></li>
                        <li><a href="#">System Training</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Connect With Us</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2023 Prison Information Management System - Central Ethiopia. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mainNav = document.getElementById('mainNav');

        mobileMenuBtn.addEventListener('click', () => {
            mainNav.classList.toggle('active');
            mobileMenuBtn.innerHTML = mainNav.classList.contains('active') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                if (this.getAttribute('href') === '#') return;

                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    if (mainNav.classList.contains('active')) {
                        mainNav.classList.remove('active');
                        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>
</body>

</html>