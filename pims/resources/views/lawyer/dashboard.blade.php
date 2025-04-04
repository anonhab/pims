<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Lawyer Dashboard</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --pims-primary: #1a2a3a;
            --pims-secondary: #2c3e50;
            --pims-accent: #2980b9;
            --pims-danger: #c0392b;
            --pims-success: #27ae60;
            --pims-warning: #d35400;
            --pims-info: #3498db;
            --pims-text-light: #ecf0f1;
            --pims-text-dark: #2c3e50;
            --pims-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-border-radius: 8px;
            --pims-nav-height: 60px;
            --pims-sidebar-width: 250px;
            --pims-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-text-dark);
            line-height: 1.6;
        }

        /* Layout Structure */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--pims-nav-height);
        }

        .pims-sidebar {
            width: var(--pims-sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: var(--pims-nav-height);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 900;
            transition: var(--pims-transition);
        }

        .pims-content-area {
            flex: 1;
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        /* Header Styles */
        .pims-content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .pims-content-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-welcome-message {
            font-size: 0.95rem;
            color: var(--pims-secondary);
        }

        /* Stats Grid */
        .pims-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Stat Card */
        .pims-stat-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            transition: var(--pims-transition);
            position: relative;
            overflow: hidden;
        }

        .pims-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .pims-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background-color: var(--pims-accent);
        }

        .pims-stat-card.active::before {
            background-color: var(--pims-success);
        }

        .pims-stat-card.pending::before {
            background-color: var(--pims-warning);
        }

        .pims-stat-card.urgent::before {
            background-color: var(--pims-danger);
        }

        .pims-stat-card.info::before {
            background-color: var(--pims-info);
        }

        .pims-stat-title {
            font-size: 0.9rem;
            color: var(--pims-secondary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-stat-change {
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims-stat-change.positive {
            color: var(--pims-success);
        }

        .pims-stat-change.negative {
            color: var(--pims-danger);
        }

        /* Charts Grid */
        .pims-charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 1024px) {
            .pims-charts-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Chart Card */
        .pims-chart-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        .pims-chart-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .pims-chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .pims-chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-chart-period {
            font-size: 0.8rem;
            color: var(--pims-secondary);
        }

        .pims-chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Recent Activity */
        .pims-activity-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        .pims-activity-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .pims-activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .pims-activity-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-activity-list {
            list-style: none;
        }

        .pims-activity-item {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            gap: 1rem;
        }

        .pims-activity-item:last-child {
            border-bottom: none;
        }

        .pims-activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(41, 128, 185, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pims-accent);
            flex-shrink: 0;
        }

        .pims-activity-content {
            flex: 1;
        }

        .pims-activity-description {
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .pims-activity-time {
            font-size: 0.8rem;
            color: var(--pims-secondary);
        }

        .pims-activity-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .pims-activity-badge.new {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
        }

        .pims-activity-badge.urgent {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-sidebar {
                transform: translateX(-100%);
            }

            .pims-sidebar.is-active {
                transform: translateX(0);
            }

            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('lawyer.menu')

        <div class="pims-content-area">
            <!-- Dashboard Header -->
            <div class="pims-content-header">
                <div>
                    <h1 class="pims-content-title">
                        <i class="fas fa-tachometer-alt"></i> Lawyer Dashboard
                    </h1>
                   
                </div>
                <div>
                    <button class="pims-btn pims-btn-primary">
                        <i class="fas fa-plus"></i> New Case
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="pims-stats-grid">
                <div class="pims-stat-card active">
                    <div class="pims-stat-title">
                        <i class="fas fa-briefcase"></i> Active Cases
                    </div>
                    <div class="pims-stat-value">24</div>
                    <div class="pims-stat-change positive">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </div>
                </div>

                <div class="pims-stat-card pending">
                    <div class="pims-stat-title">
                        <i class="fas fa-clock"></i> Pending Appointments
                    </div>
                    <div class="pims-stat-value">8</div>
                    <div class="pims-stat-change negative">
                        <i class="fas fa-arrow-down"></i> 3 from last week
                    </div>
                </div>

                <div class="pims-stat-card urgent">
                    <div class="pims-stat-title">
                        <i class="fas fa-exclamation-circle"></i> Urgent Matters
                    </div>
                    <div class="pims-stat-value">5</div>
                    <div class="pims-stat-change positive">
                        <i class="fas fa-arrow-up"></i> 2 new today
                    </div>
                </div>

                <div class="pims-stat-card info">
                    <div class="pims-stat-title">
                        <i class="fas fa-calendar-check"></i> Upcoming Hearings
                    </div>
                    <div class="pims-stat-value">3</div>
                    <div class="pims-stat-change">
                        Next: Tomorrow, 10:30 AM
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="pims-charts-grid">
                <!-- Main Chart -->
                <div class="pims-chart-card">
                    <div class="pims-chart-header">
                        <h3 class="pims-chart-title">Case Activity (Last 30 Days)</h3>
                        <span class="pims-chart-period">June 1 - June 30</span>
                    </div>
                    <div class="pims-chart-container">
                        <canvas id="pims-case-activity-chart"></canvas>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="pims-chart-card">
                    <div class="pims-chart-header">
                        <h3 class="pims-chart-title">Case Distribution</h3>
                        <span class="pims-chart-period">By Category</span>
                    </div>
                    <div class="pims-chart-container">
                        <canvas id="pims-case-distribution-chart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="pims-activity-card">
                <div class="pims-activity-header">
                    <h3 class="pims-activity-title">Recent Activity</h3>
                    <button class="pims-btn pims-btn-secondary pims-btn-sm">
                        View All
                    </button>
                </div>
                <ul class="pims-activity-list">
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="pims-activity-content">
                            <p class="pims-activity-description">
                                New case filed: <strong>State vs. Johnson</strong>
                                <span class="pims-activity-badge new">New</span>
                            </p>
                            <p class="pims-activity-time">Today, 9:42 AM</p>
                        </div>
                    </li>
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="pims-activity-content">
                            <p class="pims-activity-description">
                                Court hearing scheduled for <strong>Smith case</strong>
                            </p>
                            <p class="pims-activity-time">Yesterday, 3:15 PM</p>
                        </div>
                    </li>
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="pims-activity-content">
                            <p class="pims-activity-description">
                                Urgent motion filed in <strong>Doe appeal</strong>
                                <span class="pims-activity-badge urgent">Urgent</span>
                            </p>
                            <p class="pims-activity-time">Yesterday, 11:20 AM</p>
                        </div>
                    </li>
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="pims-activity-content">
                            <p class="pims-activity-description">
                                Client consultation completed: <strong>Williams</strong>
                            </p>
                            <p class="pims-activity-time">June 28, 2:00 PM</p>
                        </div>
                    </li>
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="pims-activity-content">
                            <p class="pims-activity-description">
                                Court ruling received for <strong>Anderson case</strong>
                            </p>
                            <p class="pims-activity-time">June 27, 4:30 PM</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Case Activity Chart (Line)
            const caseActivityCtx = document.getElementById('pims-case-activity-chart').getContext('2d');
            const caseActivityChart = new Chart(caseActivityCtx, {
                type: 'line',
                data: {
                    labels: ['Jun 1', 'Jun 5', 'Jun 10', 'Jun 15', 'Jun 20', 'Jun 25', 'Jun 30'],
                    datasets: [
                        {
                            label: 'New Cases',
                            data: [3, 5, 2, 6, 4, 7, 5],
                            borderColor: 'rgba(41, 128, 185, 1)',
                            backgroundColor: 'rgba(41, 128, 185, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Closed Cases',
                            data: [1, 3, 2, 4, 3, 5, 4],
                            borderColor: 'rgba(39, 174, 96, 1)',
                            backgroundColor: 'rgba(39, 174, 96, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 2
                            }
                        }
                    }
                }
            });

            // Case Distribution Chart (Doughnut)
            const caseDistributionCtx = document.getElementById('pims-case-distribution-chart').getContext('2d');
            const caseDistributionChart = new Chart(caseDistributionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Criminal', 'Civil', 'Family', 'Corporate', 'Other'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            'rgba(41, 128, 185, 0.8)',
                            'rgba(39, 174, 96, 0.8)',
                            'rgba(211, 84, 0, 0.8)',
                            'rgba(155, 89, 182, 0.8)',
                            'rgba(149, 165, 166, 0.8)'
                        ],
                        borderColor: [
                            'rgba(41, 128, 185, 1)',
                            'rgba(39, 174, 96, 1)',
                            'rgba(211, 84, 0, 1)',
                            'rgba(155, 89, 182, 1)',
                            'rgba(149, 165, 166, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%',
                }
            });
        });
    </script>
</body>
</html>