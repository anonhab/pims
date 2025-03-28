<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Information Management System (PIMS)</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Header -->
    @include('includes.head')

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Prison Information Management in Central Ethiopia</h1>
                <p>Efficient, Secure, and Scalable Solutions for Modern Correctional Facilities</p>
                <a href="#features" class="btn">Explore Features</a>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section id="introduction" class="introduction">
        <div class="container">
            
            <div class="intro-content">
                <div class="intro-text">
                    <p>
                        The Prison Information Management System (PIMS) is designed to meet the growing needs of correctional facilities in the Central Ethiopia Region, including the Gurage, Silte, Kambata Tambaro, Halaba, Hadiya zones, and the Yem Special Woreda. These areas have experienced an increase in criminal activity, resulting in a higher number of inmates in various prisons. Currently, the region's prison system faces challenges in managing and tracking inmate data, rehabilitation programs, and security measures effectively due to outdated and partially manual methods.
                    </p>
                    <p>
                        The PIMS aims to solve these problems by providing a platform that improves the management of inmate information, strengthens security measures, and simplifies administrative tasks within prison facilities. The system will enable more efficient prisoner registration, tracking of rehabilitation programs, handling of transfer requests, visitor management, and report generation to support better decision-making.
                    </p>
                </div>
                <div class="intro-image">
                    <!-- Replace the src attribute with your image link -->
                    <img src="data:image/png;base64,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" alt="Prison Management System">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2>Features</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <i class="fas fa-user-cog"></i>
                    <h3>Account Management</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-lock"></i>
                    <h3>Prisoner Records</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clipboard-check"></i>
                    <h3>Request Evaluation</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-check"></i>
                    <h3>Prisoner Release</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-eye"></i>
                    <h3>Prisoner Information</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-bar"></i>
                    <h3>Report Generation</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bed"></i>
                    <h3>Room Allocation</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Medical Appointments</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-envelope"></i>
                    <h3>Request Submission</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-database"></i>
                    <h3>Backup & Recovery</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-sign-in-alt"></i>
                    <h3>Login System</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Training Programs</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-briefcase"></i>
                    <h3>Job Assignments</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-certificate"></i>
                    <h3>Certifications</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-check-circle"></i>
                    <h3>Request Execution</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Visitor Requests</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-plus"></i>
                    <h3>Visitor Registration</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Visitor Management</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-eye"></i>
                    <h3>Prisoner Monitoring</h3>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-tie"></i>
                    <h3>Lawyer Profiles</h3>
                </div>
            </div>
        </div>
    </section>
    @include('components.about')
    @include('components.services')
    @include('components.contact')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Prison Information Management System. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Hamburger Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const navbar = document.querySelector('.navbar');
        hamburger.addEventListener('click', () => {
            navbar.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
    </script>
    @include('includes.footer_js')
</body>
</html>
<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f4f4f4;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Header */
.main-header {
    background: #333;
    color: #fff;
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.logo {
    display: flex;
    align-items: center;
    font-size: 1.5rem;
    font-weight: 600;
}

.logo img {
    width: 50px;
    margin-right: 10px;
}

.navbar ul {
    list-style: none;
    display: flex;
    gap: 1.5rem;
}

.navbar a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.navbar a:hover {
    color: #00ff00;
}

.hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
}

.hamburger .bar {
    width: 25px;
    height: 3px;
    background: #fff;
    transition: all 0.3s ease;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, #333, #555);
    color: #fff;
    padding: 100px 0;
    text-align: center;
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.hero .btn {
    background: #00ff00;
    color: #333;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    transition: background 0.3s ease;
}

.hero .btn:hover {
    background: #00cc00;
}

/* Introduction Section */
.introduction {
    padding: 80px 0;
    background: #fff;
}

.introduction h2 {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 2.5rem;
}

.intro-content {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.intro-text {
    flex: 1;
}

.intro-text p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
}

.intro-image {
    flex: 1;
}

.intro-image img {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Features Section */
.features {
    padding: 80px 0;
    background: #f4f4f4;
}

.features h2 {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 2.5rem;
}

.feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
}

.feature-card i {
    font-size: 2rem;
    color: #00ff00;
    margin-bottom: 1rem;
}

.feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.feature-card p {
    font-size: 1rem;
    color: #666;
}

/* Footer */
.footer {
    background: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

.footer .social-links {
    margin-top: 1rem;
}

.footer .social-links a {
    color: #fff;
    margin: 0 10px;
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.footer .social-links a:hover {
    color: #00ff00;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hamburger {
        display: flex;
    }

    .navbar {
        display: none;
        flex-direction: column;
        background: #333;
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        padding: 1rem;
    }

    .navbar.active {
        display: flex;
    }

    .intro-content {
        flex-direction: column;
    }
}
</style>