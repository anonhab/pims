<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Prison Information Management System (PIMS)</title>
  <meta content="Prison Information Management System for efficient inmate tracking and facility management." name="description">
  <meta content="prison management, inmate tracking, facility management, PIMS" name="keywords">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>/* General Styles */
body {
  font-family: 'Open Sans', sans-serif;
  color: #e0e0e0;
  background-color: #121212;
  line-height: 1.6;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  color: #ffffff;
}

a {
  color: #3498db;
  text-decoration: none;
}

a:hover {
  color: #2980b9;
}

/* Header */
.header {
  background-color: #1f1f1f;
  padding: 15px 0;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.header .logo {
  font-size: 24px;
  font-weight: 700;
  color: #ffffff;
}

.header .logo img {
  height: 40px;
  margin-right: 10px;
}

.header .navmenu ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.header .navmenu ul li {
  display: inline-block;
  margin-left: 20px;
}

.header .navmenu ul li a {
  color: #e0e0e0;
  font-weight: 500;
  padding: 8px 12px;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.header .navmenu ul li a:hover,
.header .navmenu ul li a.active {
  background-color: #3498db;
  color: #ffffff;
}

.header .btn-getstarted {
  background-color: #3498db;
  color: #ffffff;
  padding: 8px 20px;
  border-radius: 4px;
  font-weight: 500;
  transition: background-color 0.3s ease;
}

.header .btn-getstarted:hover {
  background-color: #2980b9;
}

/* Hero Section */
.hero {
  background-color: #1f1f1f;
  color: #ffffff;
  padding: 100px 0;
}

.hero h1 {
  font-size: 48px;
  font-weight: 700;
  margin-bottom: 20px;
}

.hero p {
  font-size: 18px;
  margin-bottom: 30px;
  color: #e0e0e0;
}

.hero .btn-get-started {
  background-color: #3498db;
  color: #ffffff;
  padding: 12px 30px;
  border-radius: 4px;
  font-weight: 500;
  transition: background-color 0.3s ease;
}

.hero .btn-get-started:hover {
  background-color: #2980b9;
}

.hero img {
  max-width: 100%;
  height: auto;
}

/* About Section */
.about {
  padding: 80px 0;
  background-color: #1f1f1f;
}

.about h2 {
  font-size: 36px;
  margin-bottom: 30px;
  color: #ffffff;
}

.about p {
  font-size: 16px;
  line-height: 1.8;
  color: #e0e0e0;
}

.about ul {
  list-style: none;
  padding: 0;
}

.about ul li {
  margin-bottom: 15px;
  font-size: 16px;
  color: #e0e0e0;
}

.about ul li i {
  color: #3498db;
  margin-right: 10px;
}

/* Features Section */
.features {
  background-color: #121212;
  padding: 80px 0;
}

.features h2 {
  font-size: 36px;
  margin-bottom: 30px;
  color: #ffffff;
}

.features .feature-item {
  text-align: center;
  padding: 20px;
  background-color: #1f1f1f;
  border-radius: 8px;
  transition: transform 0.3s ease;
}

.features .feature-item:hover {
  transform: translateY(-10px);
}

.features .feature-item i {
  font-size: 48px;
  color: #3498db;
  margin-bottom: 20px;
}

.features .feature-item h3 {
  font-size: 24px;
  margin-bottom: 15px;
  color: #ffffff;
}

.features .feature-item p {
  font-size: 16px;
  color: #e0e0e0;
}

/* Contact Section */
.contact {
  padding: 80px 0;
  background-color: #1f1f1f;
}

.contact h2 {
  font-size: 36px;
  margin-bottom: 30px;
  color: #ffffff;
}

.contact .info-wrap {
  background-color: #121212;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.contact .info-item {
  margin-bottom: 20px;
}

.contact .info-item i {
  font-size: 24px;
  color: #3498db;
  margin-right: 15px;
}

.contact .php-email-form {
  background-color: #121212;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.contact .php-email-form input,
.contact .php-email-form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #333;
  border-radius: 4px;
  background-color: #1f1f1f;
  color: #e0e0e0;
}

.contact .php-email-form button {
  background-color: #3498db;
  color: #ffffff;
  padding: 12px 30px;
  border: none;
  border-radius: 4px;
  font-weight: 500;
  transition: background-color 0.3s ease;
}

.contact .php-email-form button:hover {
  background-color: #2980b9;
}

/* Footer */
.footer {
  background-color: #1f1f1f;
  color: #e0e0e0;
  padding: 40px 0;
}

.footer .footer-about {
  margin-bottom: 30px;
}

.footer .footer-about .sitename {
  font-size: 24px;
  font-weight: 700;
  color: #ffffff;
}

.footer .footer-contact p {
  margin-bottom: 10px;
}

.footer .copyright {
  margin-top: 30px;
  font-size: 14px;
  color: #e0e0e0;
}

.footer .credits {
  font-size: 14px;
  color: #e0e0e0;
}

.footer .credits a {
  color: #3498db;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .hero h1 {
    font-size: 36px;
  }

  .hero p {
    font-size: 16px;
  }

  .header .navmenu ul li {
    margin-left: 10px;
  }

  .header .btn-getstarted {
    padding: 8px 15px;
  }
}</style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="#" class="logo d-flex align-items-center me-auto">
         <img src="assets/img/hero-img.png" alt="">
        <h1 class="sitename">PIMS</h1>
      </a>
      @if(session('success'))
      <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
      </div>

      <script>
        setTimeout(function() {
          const alert = document.getElementById('success-alert');
          if (alert) {
            alert.style.transition = 'opacity 1s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.style.display = 'none', 1000);
          }
        }, 3000); // 3000 milliseconds = 3 seconds
      </script>
      @endif
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{url('login')}}">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Efficient Prison Management</h1>
            <p>Streamline inmate tracking, facility management, and reporting with our advanced Prison Information Management System.</p>
            <div class="d-flex">
              <a href="{{url('login')}}" class="btn-get-started">Sign in</a>
            </div>
          </div>
          <div class="col-lg-6 order-1 ">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
              Welcome to the Prison Information Management System (PIMS), designed to enhance the efficiency and security of correctional facilities.
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> <span>Comprehensive inmate tracking and management.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Real-time reporting and analytics.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Secure and user-friendly interface.</span></li>
            </ul>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p>
              Our system is built to meet the unique needs of correctional facilities, ensuring compliance, security, and operational efficiency.
            </p>
          </div>
        </div>
      </div>
    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Explore the powerful features of our Prison Information Management System.</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-item">
              <i class="bi bi-people"></i>
              <h3>Inmate Management</h3>
              <p>Track inmate details, movements, and activities in real-time.</p>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-item">
              <i class="bi bi-clipboard-data"></i>
              <h3>Reporting & Analytics</h3>
              <p>Generate detailed reports and gain insights into facility operations.</p>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-item">
              <i class="bi bi-shield-lock"></i>
              <h3>Security & Compliance</h3>
              <p>Ensure compliance with regulations and maintain high security standards.</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Features Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Get in Touch</h2>
        <p>We're here to help. Reach out with any questions or concerns.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>Bahir Dar, Amhara Region, Ethiopia</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p>+251943392332</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>info@pims.com</p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>

          <div class="col-lg-7">
            <form action="#" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              @csrf
              <div class="row gy-4">
                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Your Name</label>
                  <input type="text" name="name" id="name-field" class="form-control" required="">
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Message</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">PIMS</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Bahir Dar</p>
            <p>Amhara Region, Ethiopia</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+251943392332</span></p>
            <p><strong>Email:</strong> <span>info@pims.com</span></p>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">PIMS</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Developed by <a href="#">habtamu</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>