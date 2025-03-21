<section id="services" class="services">
  <div class="container">
    <h2>Our Services</h2>
    <div class="service-grid">
      <!-- Service 1 -->
      <div class="service-item">
        <div class="service-image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTL-JaZA2JRovvSmB5t5ghS4t2kIRFHLqEXsQ&s" alt="Inmate Data Management">
        </div>
        <div class="service-content">
          <h3>Inmate Data Management</h3>
          <p>Efficiently track and manage inmate records, including personal details, case history, and rehabilitation progress.</p>
          <a href="#" class="btn learn-more" data-details="Inmate Data Management involves...">Learn More</a>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="service-item">
        <div class="service-image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTL-JaZA2JRovvSmB5t5ghS4t2kIRFHLqEXsQ&s" alt="Security Monitoring">
        </div>
        <div class="service-content">
          <h3>Security Monitoring</h3>
          <p>Advanced security systems to ensure the safety of inmates, staff, and visitors.</p>
          <a href="#" class="btn learn-more" data-details="Security Monitoring includes...">Learn More</a>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="service-item">
        <div class="service-image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTL-JaZA2JRovvSmB5t5ghS4t2kIRFHLqEXsQ&s" alt="Rehabilitation Programs">
        </div>
        <div class="service-content">
          <h3>Rehabilitation Programs</h3>
          <p>Comprehensive programs to prepare inmates for reintegration into society.</p>
          <a href="#" class="btn learn-more" data-details="Rehabilitation Programs focus on...">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Pop-Up Modal -->
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 id="modal-title"></h3>
    <p id="modal-details"></p>
  </div>
</div>

<style>
  /* Services Section Styles */
  .services {
    padding: 80px 0;
    background: #f4f4f4;
    text-align: center;
  }

  .services h2 {
    font-size: 2.5rem;
    margin-bottom: 2rem;
    color: #333;
  }

  .service-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    padding: 0 1rem;
  }

  .service-item {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
  }

  .service-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }

  .service-image {
    position: relative;
    overflow: hidden;
    height: 200px;
  }

  .service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .service-item:hover .service-image img {
    transform: scale(1.1);
  }

  .service-content {
    padding: 1.5rem;
    text-align: left;
    flex: 1;
  }

  .service-content h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
  }

  .service-content p {
    font-size: 1rem;
    color: #666;
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }

  .btn {
    display: inline-block;
    background: #00ff00;
    color: #333;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    transition: background 0.3s ease;
  }

  .btn:hover {
    background: #00cc00;
  }

  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .modal-content {
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    max-width: 500px;
    width: 90%;
    position: relative;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 1.5rem;
    color: #333;
    cursor: pointer;
    transition: color 0.3s ease;
  }

  .close:hover {
    color: #00ff00;
  }

  #modal-title {
    font-size: 1.75rem;
    margin-bottom: 1rem;
    color: #333;
  }

  #modal-details {
    font-size: 1rem;
    color: #666;
    line-height: 1.6;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .service-grid {
      grid-template-columns: 1fr;
    }

    .service-item {
      max-width: 100%;
    }
  }
</style>

<script>
  // JavaScript for Modal
  const modal = document.getElementById('modal');
  const modalTitle = document.getElementById('modal-title');
  const modalDetails = document.getElementById('modal-details');
  const closeBtn = document.querySelector('.close');

  // Add event listeners to all "Learn More" buttons
  document.querySelectorAll('.learn-more').forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      modalTitle.textContent = button.parentElement.querySelector('h3').textContent;
      modalDetails.textContent = button.getAttribute('data-details');
      modal.style.display = 'flex';
    });
  });

  // Close modal when clicking the close button
  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  // Close modal when clicking outside the modal
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
</script>