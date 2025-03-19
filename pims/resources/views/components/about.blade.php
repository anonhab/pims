@section('content')
<section id="about" class="about">
  <div class="container">
    <h2>About the System</h2>
    <p class="about-description">
      The Prison Information Management System is designed to meet the growing needs of correctional facilities in the Central Ethiopia Region, including the Gurage, Silte, Kambata Tambaro, Halaba, Hadiya zones, and the Yem Special Woreda. These areas have experienced an increase in criminal activity, resulting in a higher number of inmates in various prisons. Currently, the region's prison system faces challenges in managing and tracking inmate data, rehabilitation programs, and security measures effectively due to outdated and partially manual methods.
    </p>
    <div class="stats">
      <div class="stat">
        <div class="stat-icon">
          <i class="fas fa-users"></i>
        </div>
        <span class="number">15,000+</span>
        <span class="label">Inmates Managed</span>
      </div>
      <div class="stat">
        <div class="stat-icon">
          <i class="fas fa-shield-alt"></i>
        </div>
        <span class="number">100+</span>
        <span class="label">Facilities Secured</span>
      </div>
      <div class="stat">
        <div class="stat-icon">
          <i class="fas fa-chart-line"></i>
        </div>
        <span class="number">95%</span>
        <span class="label">Efficiency Improvement</span>
      </div>
    </div>
  </div>
</section>

<style>
  /* About Section Styles */
  .about {
    padding: 80px 0;
    background: #fff;
    text-align: center;
  }

  .about h2 {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
    color: #333;
  }

  .about-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    max-width: 800px;
    margin: 0 auto 3rem auto;
  }

  .stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
  }

  .stat {
    background: #f4f4f4;
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    width: 250px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .stat:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  .stat-icon {
    font-size: 2.5rem;
    color: #00ff00;
    margin-bottom: 1rem;
    transition: transform 0.3s ease;
  }

  .stat:hover .stat-icon {
    transform: scale(1.2);
  }

  .number {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    display: block;
    margin-bottom: 0.5rem;
  }

  .label {
    font-size: 1rem;
    color: #666;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .stats {
      flex-direction: column;
      align-items: center;
    }

    .stat {
      width: 100%;
      max-width: 300px;
    }
  }
</style>