<section id="home" class="hero">
  <div class="hero-overlay">
    <div class="hero-content">
      <h1 class="hero-title">Prison Information Management System</h1>
      <p class="hero-subtitle">Revolutionizing Correctional Facility Management in Central Ethiopia</p>
      <p class="hero-description">
        The Prison Information Management System (PIMS) is a state-of-the-art solution designed to streamline the management of correctional facilities across the Central Ethiopia Region. Our system ensures efficient tracking of inmate data, enhances security measures, and supports rehabilitation programs to foster a safer and more just society.
      </p>
      <div class="hero-cta">
        <a href="#learn-more" class="btn btn-primary" id="learn-more-btn">Learn More</a>
        <a href="#login" class="btn btn-secondary" id="login-btn">Login to System</a>
      </div>
      <div class="hero-stats">
        <div class="stat">
          <span class="stat-number">15,000+</span>
          <span class="stat-label">Inmates Managed</span>
        </div>
        <div class="stat">
          <span class="stat-number">100+</span>
          <span class="stat-label">Facilities Secured</span>
        </div>
        <div class="stat">
          <span class="stat-number">95%</span>
          <span class="stat-label">Efficiency Improvement</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Learn More Pop-up -->
<div id="learn-more-popup" class="learn-more-popup">
  <div class="popup-content">
    <span class="close-btn">&times;</span>
    <h2>Why Choose PIMS?</h2>
    <p>
      Our system is designed to address the unique challenges faced by correctional facilities in Central Ethiopia. With advanced features like real-time inmate tracking, automated reporting, and secure data management, PIMS ensures that your facility operates efficiently and securely.
    </p>
    <ul>
      <li><strong>Real-Time Monitoring:</strong> Track inmate movements and activities in real-time.</li>
      <li><strong>Automated Reporting:</strong> Generate reports with just a few clicks.</li>
      <li><strong>Secure Data Management:</strong> Protect sensitive information with state-of-the-art encryption.</li>
    </ul>
  </div>
</div>
<style>
/* Hero Stats Section */
.hero-stats {
  display: flex;
  justify-content: center;
  gap: 2rem;
  margin-top: 2rem;
  animation: fadeIn 3s ease-in-out;
}

.hero-stats .stat {
  text-align: center;
  background: rgba(255, 255, 255, 0.1); /* Semi-transparent background */
  padding: 1.5rem;
  border-radius: 10px;
  transition: transform 0.3s ease, background 0.3s ease;
  width: 200px; /* Fixed width for consistency */
}

.hero-stats .stat:hover {
  transform: translateY(-5px); /* Lift effect on hover */
  background: rgba(255, 255, 255, 0.2); /* Slightly brighter background on hover */
}

.hero-stats .stat-number {
  font-size: 2.5rem;
  font-weight: bold;
  display: block;
  color: #fff;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Text shadow for better readability */
}

.hero-stats .stat-label {
  font-size: 1rem;
  color: #ccc;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Text shadow for better readability */
  margin-top: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-stats {
    flex-direction: column; /* Stack stats vertically on smaller screens */
    gap: 1rem;
  }

  .hero-stats .stat {
    width: 100%; /* Full width on smaller screens */
    padding: 1rem;
  }

  .hero-stats .stat-number {
    font-size: 2rem; /* Smaller font size for mobile */
  }

  .hero-stats .stat-label {
    font-size: 0.9rem; /* Smaller font size for mobile */
  }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const learnMoreBtn = document.getElementById('learn-more-btn');
  const learnMorePopup = document.getElementById('learn-more-popup');
  const closeBtn = document.querySelector('.close-btn');

  // Show Pop-up on Learn More Button Click
  learnMoreBtn.addEventListener('click', function (e) {
    e.preventDefault();
    learnMorePopup.classList.add('active');
  });

  // Close Pop-up on X Button Click
  closeBtn.addEventListener('click', function () {
    learnMorePopup.classList.remove('active');
  });

  // Close Pop-up on Outside Click
  learnMorePopup.addEventListener('click', function (e) {
    if (e.target === learnMorePopup) {
      learnMorePopup.classList.remove('active');
    }
  });

  // Handle Login Button Click
  const loginBtn = document.getElementById('login-btn');
  const mainContent = document.getElementById('main-content');

  loginBtn.addEventListener('click', function (e) {
    e.preventDefault();
    fetch('/components/login')
      .then(response => response.text())
      .then(data => {
        mainContent.innerHTML = data;
      })
      .catch(error => console.error('Error loading login component:', error));
  });
});
</script>