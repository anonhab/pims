<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS Central Ethiopia</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global Styles */
        :root {
            --primary-color: #ff5555;
            --secondary-color: #2c3e50;
            --accent-color: #34495e;
            --light-color: #f5f6fa;
            --dark-color: #1a252f;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-color);
            overflow-x: hidden;
        }

        .container {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        h1, h2, h3, h4 {
            color: var(--dark-color);
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        p {
            color: var(--text-light);
            margin-bottom: 1.2rem;
        }

        .btn {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.4s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #e04343;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 85, 85, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        .section {
            padding: 100px 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 900;
            position: relative;
            padding-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--primary-color);
        }

        /* Header Styles */
        header {
            background-color: var(--dark-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: background 0.3s ease;
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
            height: 100px;
            width: 150px;
            margin-right: 15px;
        }

        .logo-text h1 {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 0;
            font-weight: 900;
        }

        .logo-text span {
            font-size: 1rem;
            color: var(--text-light);
            display: block;
            font-weight: 300;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 40px;
        }

        nav ul li a {
            color: var(--light-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            transition: color 0.3s ease;
            position: relative;
        }

        nav ul li a:hover {
            color: var(--primary-color);
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary-color);
            transition: width 0.4s ease;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: var(--light-color);
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(26, 37, 47, 0.95), rgba(255, 85, 85, 0.7)), url('https://images.unsplash.com/photo-1518733057094-95b53143d2a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: left;
            padding-top: 100px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 85, 85, 0.1), transparent);
            animation: pulse 10s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.5; }
        }

        .hero-content {
            max-width: 700px;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            color: white;
            margin-bottom: 1.5rem;
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.1;
            animation: fadeInUp 1s ease-out;
        }

        .hero p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            animation: fadeInUp 1.2s ease-out;
        }

        .hero-btns {
            display: flex;
            gap: 20px;
            animation: fadeInUp 1.4s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Gallery Section */
        .gallery {
            background: var(--dark-color);
            color: white;
            padding: 100px 0;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            height: 300px;
            cursor: pointer;
            transition: transform 0.5s ease;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover::after {
            opacity: 1;
        }

        .gallery-item span {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            font-weight: 500;
            font-size: 1.2rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .gallery-item:hover span {
            opacity: 1;
            transform: translateY(0);
        }

        /* Features Section */
        .features {
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            text-align: center;
            border: 1px solid rgba(255, 85, 85, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(255, 85, 85, 0.2);
            border-color: var(--primary-color);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary-color);
            font-size: 2rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            background: var(--primary-color);
            color: white;
        }

        .feature-card h3 {
            font-size: 1.6rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        /* About Section */
        .about {
            background: var(--light-color);
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .about-text {
            flex: 1;
        }

        .about-image {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease;
        }

        .about-image:hover {
            transform: scale(1.05);
        }

        .about-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Stats Section */
        .stats {
            background: var(--secondary-color);
            color: white;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
        }

        .stat-item h3 {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-weight: 900;
        }

        .stat-item p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.2rem;
        }

        /* Contact Section */
        .contact {
            background: white;
        }

        .contact-info {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .contact-info h3 {
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 700;
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            gap: 20px;
        }

        .contact-info-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
        }

        .contact-info-item div {
            text-align: left;
        }

        .contact-info-item h4 {
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 20px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-col h3 {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .footer-col p {
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-links li {
            margin-bottom: 12px;
            list-style: none;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 85, 85, 0.2);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: scale(1.1);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
        }

        /* Visitor Registration Modal */
        #visitorRegisterModal .modal-dialog {
            max-width: 800px;
        }

        #visitorRegisterModal .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        #visitorRegisterModal .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-bottom: none;
            padding: 25px 35px;
        }

        #visitorRegisterModal .modal-title {
            font-weight: 700;
            font-size: 1.8rem;
        }

        #visitorRegisterModal .btn-close {
            filter: invert(1);
            opacity: 0.9;
        }

        #visitorRegisterModal .modal-body {
            padding: 40px;
            background: white;
        }

        #visitorRegisterModal .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        #visitorRegisterModal .form-control {
            padding: 14px 18px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s;
        }

        #visitorRegisterModal .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.3rem rgba(255, 85, 85, 0.25);
        }

        #visitorRegisterModal .modal-footer {
            border-top: none;
            padding: 25px 35px;
            background: var(--light-color);
        }

        #visitorRegisterModal .btn-register {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 14px 30px;
            font-weight: 600;
            transition: all 0.4s;
            width: 100%;
            border-radius: 8px;
        }

        #visitorRegisterModal .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 85, 85, 0.3);
        }

        #visitorRegisterModal .btn-cancel {
            background: var(--light-color);
            border: 1px solid #e0e0e0;
            color: var(--text-color);
            padding: 14px 30px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            border-radius: 8px;
        }

        #visitorRegisterModal .btn-cancel:hover {
            background: #e9ecef;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .about-content {
                flex-direction: column;
                gap: 40px;
            }

            .about-image {
                order: -1;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
                background: var(--dark-color);
                transition: left 0.4s ease;
                padding: 40px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            }

            nav.active {
                left: 0;
            }

            nav ul {
                flex-direction: column;
            }

            nav ul li {
                margin: 20px 0;
            }

            nav ul li a {
                font-size: 1.2rem;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .hero-btns {
                flex-direction: column;
                gap: 15px;
            }

            .section {
                padding: 80px 0;
            }

            .section-title h2 {
                font-size: 2.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            #visitorRegisterModal .modal-dialog {
                margin: 1.5rem auto;
            }

            .gallery-item {
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            #visitorRegisterModal .modal-body {
                padding: 25px;
            }

            .gallery-item {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
    <a href="/">
        <img src="{{ asset('assets/img/logo.png') }}" alt="PIMS Logo" class="logo-image">
    </a>
</div>

            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>

            <nav id="mainNav">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#visitorRegisterModal">Register as Visitor</a></li>
                    <li><a href="/login" class="btn">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
    </br></br></br>

    <!-- Visitor Registration Modal -->
    <div class="modal fade" id="visitorRegisterModal" tabindex="-1" aria-labelledby="visitorRegisterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visitorRegisterModalLabel">Visitor Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('visitor.register.submit') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control" required placeholder="Enter your first name">
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" required placeholder="Enter your last name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" name="phone_number" class="form-control" required placeholder="Enter your phone number">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required placeholder="Enter your email address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="mb-3">
                                <label for="relationship" class="form-label">Relationship to Inmate <span class="text-danger">*</span></label>
                                <select name="relationship" class="form-control" required>
                                    <option value="">Select relationship</option>
                                    <option value="Family">Family</option>
                                    <option value="Friend">Friend</option>
                                    <option value="Lawyer">Lawyer</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="2" required placeholder="Enter your full address"></textarea>
                        </div>

                        <div class="form-row">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required placeholder="Create a password">
                                <small class="text-muted">Minimum 8 characters</small>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm your password">
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label" for="termsCheck">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-register">Register as Visitor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<section class="hero" id="home" style="background: linear-gradient(135deg, rgba(26, 37, 47, 0.95), rgba(255, 85, 85, 0.7)), url('{{ asset('assets/img/Federal_Police_Ethiopia.jpg') }}') no-repeat center center/cover;">
    <div class="container">
        <div class="hero-content">
            <h1>Secure Prison Management for Central Ethiopia</h1>
            <p>Empowering correctional facilities with a robust, secure, and efficient Prison Information Management System.</p>
            
        </div>
    </div>
</section>

<section class="section gallery" id="gallery">
    <div class="container">
        <div class="section-title">
            <h2>Our Facilities</h2>
        </div>
        <div class="gallery-grid">
    <div class="gallery-item">
        <img src="{{ asset('assets/img/HighSecurityWing.jpg') }}" alt="High-Security Wing">
        <span>High-Security Wing</span>
    </div>
    <div class="gallery-item">
        <img src="{{ asset('assets/img/ControlRoom.jfif') }}" alt="Control Room">
        <span>Control Room</span>
    </div>
    <div class="gallery-item">
        <img src="{{ asset('assets/img/VisitorArea.jfif') }}" alt="Visitor Area">
        <span>Visitor Area</span>
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
                    <p>Securely manage inmate records, including personal details, offenses, and incarceration history with real-time updates.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3>Case Tracking</h3>
                    <p>Track legal cases, court dates, and judgments with automated notifications for seamless administration.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Visitor Management</h3>
                    <p>Streamline visitor scheduling and security checks with integrated verification protocols.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Medical Records</h3>
                    <p>Maintain comprehensive health records and schedule medical appointments securely.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Reporting & Analytics</h3>
                    <p>Access detailed reports and analytics to monitor prison operations and trends.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Security Management</h3>
                    <p>Monitor incidents, staff assignments, and access controls with advanced security features.</p>
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
                    <p>The Prison Information Management System (PIMS) is a cutting-edge platform designed for Central Ethiopia’s correctional facilities, ensuring secure and efficient management of prison operations.</p>
                    <p>Developed with input from regional justice experts, PIMS integrates advanced technology to address the unique challenges of inmate management, security, and rehabilitation while adhering to strict data privacy standards.</p>
                    <p>Our mission is to transform correctional administration, enhancing public safety and operational efficiency across Central Ethiopia’s prison system.</p>
                    <a href="#contact" class="btn">Contact Us</a>
                </div>
                <div class="about-image">
                    <img src="{{ asset('assets/img/Flag_of_Central_Ethiopia.png') }}"alt="Prison Management System">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>30+</h3>
                    <p>Released Prisoners</p>
                </div>
                <div class="stat-item">
                    <h3>15,000+</h3>
                    <p>Records Managed</p>
                </div>
                <div class="stat-item">
                    <h3>99.99%</h3>
                    <p>System Uptime</p>
                </div>
                <div class="stat-item">
                    <h3>75+</h3>
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
            <div class="contact-info">
                <h3>Get in Touch</h3>
                <p>Contact our team for inquiries about the Prison Information Management System.</p>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h4>Location</h4>
                        <p>Central Ethiopia Regional Administration, Hossana, Ethiopia</p>
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
                        <p>+251911121322</p>
                    </div>
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
    <a href="/">
        <img src="{{ asset('assets/img/logo.png') }}" alt="PIMS Logo" class="logo-image" style="height: 200px;">
    </a>
</div>
                    <p>Modernizing correctional facility management with secure, innovative technology solutions for Central Ethiopia.</p>
                </div>
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="/login">Login</a></li>
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
                <p>© 2025 Prison Information Management System - Central Ethiopia. All Rights Reserved.</p>
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

        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const target = document.querySelector(targetId);
        if (target) {
            // Calculate the position to scroll to
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
            const headerHeight = document.querySelector('header').offsetHeight;
            const offsetPosition = targetPosition - headerHeight;

            // Smooth scroll to the target
            window.scrollTo({
                top: offsetPosition,
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
                header.style.background = 'rgba(26, 37, 47, 0.95)';
                header.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.3)';
            } else {
                header.style.background = 'var(--dark-color)';
                header.style.boxShadow = 'none';
            }
        });

        // Form validation for visitor registration
        const visitorForm = document.querySelector('#visitorRegisterModal form');
        if (visitorForm) {
            visitorForm.addEventListener('submit', function(e) {
                const password = this.querySelector('input[name="password"]');
                const confirmPassword = this.querySelector('input[name="password_confirmation"]');
                
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    confirmPassword.focus();
                }
                
                if (password.value.length < 8) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long!');
                    password.focus();
                }
            });
        }

        // Gallery animation on scroll
        const galleryItems = document.querySelectorAll('.gallery-item');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.2 });

        galleryItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(50px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    </script>
</body>
</html>