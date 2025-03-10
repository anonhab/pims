<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Navigation | Hoverable Sidebar Menu</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'><link rel="stylesheet" href="css/style.css">
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prison Information Management System</title>

    <meta name="description" content="Free Admin Dashboard Template Build with Bulma.io By nafplann">
    <meta name="keywords" content="Bulma,CSS,Admin,Template,Free,Download">
    <meta name="language" content="en-EN">
    <meta name="author" content="Abdul Manaf">
    <meta name="google-adsense-account" content="ca-pub-7864475889913507">

    <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css"
        integrity="sha512-dC0G5HMA6hLr/E1TM623RN6qK+sL8sz5vB+Uc68J7cBon68bMfKcvbkg6OqlfGHo1nMmcCxO5AinnRTDhWbWsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css"
        integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="sidebar">
  <div class="logo-details">
    <i class='bx bxl-c-plus-plus icon'></i>
    <div class="logo_name">CodingStella</div>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <ul class="nav-list">
    <li>
      <i class='bx bx-search'></i>
      <input type="text" placeholder="Search...">
      <span class="tooltip">Search</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-grid-alt'></i>
        <span class="links_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-user'></i>
        <span class="links_name">User</span>
      </a>
      <span class="tooltip">User</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-chat'></i>
        <span class="links_name">Messages</span>
      </a>
      <span class="tooltip">Messages</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-pie-chart-alt-2'></i>
        <span class="links_name">Analytics</span>
      </a>
      <span class="tooltip">Analytics</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-folder'></i>
        <span class="links_name">File Manager</span>
      </a>
      <span class="tooltip">Files</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-cart-alt'></i>
        <span class="links_name">Order</span>
      </a>
      <span class="tooltip">Order</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-heart'></i>
        <span class="links_name">Saved</span>
      </a>
      <span class="tooltip">Saved</span>
    </li>
    <li>
      <a href="#">
        <i class='bx bx-cog'></i>
        <span class="links_name">Setting</span>
      </a>
      <span class="tooltip">Setting</span>
    </li>
    <li class="profile">
      <div class="profile-details">
        <img src="https://drive.google.com/uc?export=view&id=1ETZYgPpWbbBtpJnhi42_IR3vOwSOpR4z" alt="profileImg">
        <div class="name_job">
          <div class="name">Stella Army</div>
          <div class="job">Web designer</div>
        </div>
      </div>
      <i class='bx bx-log-out' id="log_out"></i>
    </li>
  </ul>
</div>
<section class="home-section">

                <div class="columns is-multiline">
                    <div class="column is-3">
                        <a href="{{ route('account.show_all') }}" class="box quick-stats has-background-primary has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-cog"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Central Administrators</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('prisoner.showAll') }}" class="box quick-stats has-background-danger has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-secret"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Inspectors</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="#lawyer-link" class="box quick-stats has-background-info has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-tie"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Lawyers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('medical.createAppointment') }}" class="box quick-stats has-background-warning has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-md"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Medical Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="#police-commissioner-link" class="box quick-stats has-background-success has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-shield"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Police Commissioners</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route ('police.allocateRoom') }}" class="box quick-stats has-background-link has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Police Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('security.registerVisitor') }}" class="box quick-stats has-background-grey-dark has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-lock"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Security Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('saccount.show_all') }}" class="box quick-stats has-background-dark has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-cog"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">System Admins</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('training.assignCertifications') }}" class="box quick-stats has-background-info has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-graduate"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Training Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('visitor.createVisitingRequest') }}" class="box quick-stats has-background-warning has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-friends"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Visitors</h3>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="columns is-multiline">
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Visitors</p>
                                <input type="color" id="color1" value="#4bc0c0" class="mb-3" />
                                <canvas id="chart1" aria-label="Visitors Chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Prisoners</p>
                                <input type="color" id="color2" value="#ff6384" class="mb-3" />
                                <canvas id="chart2" aria-label="Prisoners Chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Prisons</p>
                                <input type="color" id="color3" value="#36a2eb" class="mb-3" />
                                <canvas id="chart3" aria-label="Prisons Chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Staffs</p>
                                <input type="color" id="color4" value="#ff9f40" class="mb-3" />
                                <canvas id="chart4" aria-label="Staffs Chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
          
</section>
<!-- partial -->
  <script  src="js/script.js"></script>

</body>
</html>