<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Visitor Dashboard</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js for data visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --pims-primary: #0a192f; /* Navy blue */
            --pims-secondary: #172a45; /* Darker navy */
            --pims-accent: #64ffda; /* Teal accent */
            --pims-danger: #ff5555; /* Vibrant red */
            --pims-success: #50fa7b; /* Vibrant green */
            --pims-warning: #ffb86c; /* Soft orange */
            --pims-info: #8be9fd; /* Light blue */
            --pims-text-light: #f8f8f2; /* Off white */
            --pims-text-dark: #282a36; /* Dark gray */
            --pims-card-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --pims-border-radius: 8px;
            --pims-nav-height: 70px;
            --pims-sidebar-width: 280px;
            --pims-transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-text-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            z-index: 1000;
            display: flex;
            align-items: center;
            top: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            height: var(--pims-nav-height);
        }

        /* Main Content Area */
        #pims-page-content {
            margin-left: 0;
            padding: 2rem;
            padding-left: calc(var(--pims-sidebar-width) + 2rem);
            min-height: calc(100vh - var(--pims-nav-height));
            transition: var(--pims-transition);
            background-color: #f5f7fa;
            padding-top: 70px;
        }

        /* Dashboard Cards */
        .pims-dashboard-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            transition: var(--pims-transition);
            height: 100%;
            border-left: 4px solid var(--pims-accent);
            position: relative;
            overflow: hidden;
            padding: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .pims-dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .pims-dashboard-card .pims-card-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--pims-accent);
            background: rgba(100, 255, 218, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pims-dashboard-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--pims-primary);
            letter-spacing: 0.5px;
        }

        .pims-dashboard-card p {
            font-size: 2rem;
            font-weight: 700;
            color: var(--pims-secondary);
            margin-bottom: 0;
            letter-spacing: -0.5px;
            font-family: 'Inter', sans-serif;
        }

        .pims-card-footer {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Stats Box */
        .pims-stats-box {
            background: linear-gradient(145deg, #ffffff 0%, #f7faff 100%);
            border-radius: var(--pims-border-radius);
            padding: 2rem;
            box-shadow: var(--pims-card-shadow);
            margin-top: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            transition: var(--pims-transition);
        }

        .pims-stats-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .pims-stats-box h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--pims-primary);
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            border-bottom: 2px solid rgba(100, 255, 218, 0.2);
        }

        .pims-stats-box h2 i {
            color: var(--pims-accent);
            background: linear-gradient(135deg, rgba(100, 255, 218, 0.15) 0%, rgba(100, 255, 218, 0.05) 100%);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .pims-stats-box h2:hover i {
            transform: scale(1.1);
        }

        /* Recent Activity List */
        .pims-stats-box ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pims-stats-box li {
            padding: 1.25rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: background 0.3s ease, transform 0.2s ease;
            position: relative;
            border-radius: 6px;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .pims-stats-box li:hover {
            background: linear-gradient(90deg, rgba(100, 255, 218, 0.05) 0%, rgba(100, 255, 218, 0.02) 100%);
            transform: translateX(5px);
        }

        .pims-stats-box li:last-child {
            border-bottom: none;
        }

        .pims-stats-box li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: var(--pims-accent);
            border-radius: 0 4px 4px 0;
            opacity: 0.2;
            transition: opacity 0.3s ease;
        }

        .pims-stats-box li:hover::before {
            opacity: 0.8;
        }

        .pims-stats-box li span {
            font-weight: 600;
            color: var(--pims-primary);
            font-size: 0.95rem;
        }

        .pims-stats-box li .pims-activity-time {
            font-size: 0.85rem;
            color: #6b7280;
            font-family: 'Roboto Mono', monospace;
            background: rgba(0, 0, 0, 0.02);
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            margin-left: auto;
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* Section Title */
        .pims-section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--pims-primary);
            position: relative;
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            font-family: 'Inter', sans-serif;
        }

        .pims-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--pims-accent) 0%, rgba(100, 255, 218, 0) 100%);
            border-radius: 2px;
        }

        .pims-section-title i {
            margin-right: 12px;
            color: var(--pims-accent);
            background: rgba(100, 255, 218, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Chart Container */
        .pims-chart-container {
            position: relative;
            height: 350px;
            margin-top: 1.5rem;
        }

        /* Status Tags */
        .pims-status-tag {
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .pims-status-tag.pending {
            background-color: rgba(255, 184, 108, 0.1);
            color: var(--pims-warning);
        }

        .pims-status-tag.approved {
            background-color: rgba(80, 250, 123, 0.1);
            color: var(--pims-success);
        }

        .pims-status-tag.rejected {
            background-color: rgba(255, 85, 85, 0.1);
            color: var(--pims-danger);
        }

        .pims-status-tag.completed {
            background-color: rgba(139, 233, 253, 0.1);
            color: var(--pims-info);
        }

        /* Button Styles */
        .pims-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.9rem;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: var(--pims-primary);
            font-weight: 700;
        }

        .pims-btn-primary:hover {
            background-color: #52e8ca;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(100, 255, 218, 0.3);
        }

        .pims-btn-secondary {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* Search Box */
        .pims-search-box {
            position: relative;
            flex-grow: 1;
        }

        .pims-search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--pims-border-radius);
            font-size: 0.9rem;
            transition: var(--pims-transition);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .pims-search-box input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.2);
        }

        .pims-search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-accent);
        }

        /* Notification Styles */
        .pims-notification {
            padding: 1rem 1.5rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--pims-card-shadow);
            position: relative;
            overflow: hidden;
        }

        .pims-notification::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .pims-notification-success {
            background: rgba(80, 250, 123, 0.1);
            border-left: 4px solid var(--pims-success);
        }

        .pims-notification-error {
            background: rgba(255, 85, 85, 0.1);
            border-left: 4px solid var(--pims-danger);
        }

        .pims-notification i {
            font-size: 1.2rem;
        }

        .pims-notification-success i {
            color: var(--pims-success);
        }

        .pims-notification-error i {
            color: var(--pims-danger);
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .pims-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 992px) {
            #pims-page-content {
                padding-left: 2rem;
            }
        }

        @media (max-width: 768px) {
            .pims-grid {
                grid-template-columns: 1fr;
            }

            .pims-section-title {
                font-size: 1.5rem;
            }

            .pims-dashboard-card p {
                font-size: 1.75rem;
            }

            .pims-stats-box {
                padding: 1.5rem;
            }

            .pims-stats-box h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    @include('components.preloader')

    <!-- Navigation -->
    @include('includes.nav')

    <!-- Sidebar -->
    @include('visitor.menu')

    <!-- Main Content -->
    <div id="pims-page-content">
        <h1 class="pims-section-title">
            <i class="fas fa-user-clock"></i> Visitor Dashboard
        </h1>

        <!-- Notifications -->
        @if(session('success'))
            <div class="pims-notification pims-notification-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="pims-notification pims-notification-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <!-- Dashboard Cards -->
        <div class="pims-grid">
            <!-- Upcoming Visits -->
            <div class="pims-dashboard-card">
                <div class="pims-card-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Upcoming Visits</h3>
                <p>3</p>
                <div class="pims-card-footer">
                    <i class="fas fa-clock" style="color: var(--pims-warning);"></i> 1 visit tomorrow
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="pims-dashboard-card">
                <div class="pims-card-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <h3>Pending Requests</h3>
                <p>2</p>
                <div class="pims-card-footer">
                    <i class="fas fa-exclamation-circle" style="color: var(--pims-danger);"></i> 1 awaiting approval
                </div>
            </div>

            <!-- Total Visits -->
            <div class="pims-dashboard-card">
                <div class="pims-card-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3>Total Visits</h3>
                <p>12</p>
                <div class="pims-card-footer">
                    <i class="fas fa-chart-line" style="color: var(--pims-success);"></i> 3 this month
                </div>
            </div>
        </div>

        <!-- Recent Visits Chart -->
        <div class="pims-stats-box">
            <h2><i class="fas fa-chart-line"></i> Monthly Visits</h2>
            <div class="pims-chart-container">
                <canvas id="pims-visits-chart"></canvas>
            </div>
        </div>

        <!-- Recent Visit Requests -->
        <div class="pims-stats-box">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2><i class="fas fa-list"></i> Recent Visit Requests</h2>
                <div style="display: flex; gap: 1rem;">
                    <div class="pims-search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="pims-visit-search" placeholder="Search requests...">
                    </div>
                    <a href="/createVisiting" class="pims-btn pims-btn-primary">
                        <i class="fas fa-plus"></i> New Request
                    </a>
                </div>
            </div>
            
            <ul>
                <li>
                    <i class="fas fa-calendar-day" style="color: var(--pims-success);"></i>
                    <div style="flex-grow: 1;">
                        <span>
                            <strong>John Smith</strong> - Scheduled for May 28, 2025
                        </span>
                        <span class="pims-status-tag approved">
                            Approved
                        </span>
                    </div>
                    <span class="pims-activity-time">
                        10:00 AM - 11:00 AM
                    </span>
                    <button class="pims-btn pims-btn-secondary" style="margin-left: 1rem;">
                        <i class="fas fa-file-download"></i> Pass
                    </button>
                </li>
                <li>
                    <i class="fas fa-hourglass-half" style="color: var(--pims-warning);"></i>
                    <div style="flex-grow: 1;">
                        <span>
                            <strong>Michael Johnson</strong> - Requested for June 2, 2025
                        </span>
                        <span class="pims-status-tag pending">
                            Pending
                        </span>
                    </div>
                    <span class="pims-activity-time">
                        Submitted: May 22, 2025
                    </span>
                    <a href="/visitorvisiting-requests" class="pims-btn pims-btn-secondary" style="margin-left: 1rem;">
                        <i class="fas fa-eye"></i> View
                    </a>
                </li>
                <li>
                    <i class="fas fa-calendar-times" style="color: var(--pims-danger);"></i>
                    <div style="flex-grow: 1;">
                        <span>
                            <strong>Robert Williams</strong> - Requested for May 20, 2025
                        </span>
                        <span class="pims-status-tag rejected">
                            Rejected
                        </span>
                    </div>
                    <span class="pims-activity-time">
                        Reason: Invalid ID
                    </span>
                    <button class="pims-btn pims-btn-secondary" style="margin-left: 1rem;">
                        <i class="fas fa-redo"></i> Resubmit
                    </button>
                </li>
                <li>
                    <i class="fas fa-check-circle" style="color: var(--pims-info);"></i>
                    <div style="flex-grow: 1;">
                        <span>
                            <strong>Sarah Davis</strong> - Completed on May 15, 2025
                        </span>
                        <span class="pims-status-tag completed">
                            Completed
                        </span>
                    </div>
                    <span class="pims-activity-time">
                        02:00 PM - 03:00 PM
                    </span>
                    <button class="pims-btn pims-btn-secondary" style="margin-left: 1rem;">
                        <i class="fas fa-file-alt"></i> Details
                    </button>
                </li>
            </ul>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preloader
            const preloader = document.querySelector('.pims-preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 1000);
            }

            // Monthly Visits Chart (Line)
            const visitsChart = new Chart(
                document.getElementById('pims-visits-chart').getContext('2d'), 
                {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Approved Visits',
                            data: [2, 3, 1, 2, 3, 2, 1, 2, 3, 4, 2, 3],
                            backgroundColor: 'rgba(100, 255, 218, 0.1)',
                            borderColor: 'rgba(100, 255, 218, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: { weight: '600' }
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(10, 25, 47, 0.9)',
                                titleFont: { weight: 'bold' }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' },
                                ticks: {
                                    stepSize: 1
                                }
                            },
                            x: {
                                grid: { display: false, drawBorder: false }
                            }
                        },
                        elements: {
                            point: { radius: 4, hoverRadius: 6 }
                        }
                    }
                }
            );

            // Search functionality for visits
            const searchInput = document.getElementById('pims-visit-search');
            const visitItems = document.querySelectorAll('.pims-stats-box li');

            searchInput.addEventListener('input', function() {
                const filter = searchInput.value.toLowerCase();
                visitItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(filter) ? '' : 'none';
                });
            });

            // Show fullscreen loader when navigating
            document.querySelectorAll('a[href^="/"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') !== '#') {
                        document.getElementById('pimsFullscreenLoader').classList.add('active');
                    }
                });
            });
        });
    </script>
</body>
</html>