<!DOCTYPE html>
<html>
@include('includes.head')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Inspector Dashboard</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
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
            --pims-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Main Content Area */
        #pims-page-content {
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            padding-top:90px;
            min-height: calc(100vh - var(--pims-nav-height));
            transition: var(--pims-transition);
        }

        /* Dashboard Grid Layout */
        .pims-dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Summary Cards */
        .pims-summary-card {
            grid-column: span 3;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            transition: var(--pims-transition);
            border-left: 4px solid var(--pims-accent);
            animation: fadeInUp 0.6s ease;
        }

        .pims-summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .pims-summary-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .pims-summary-content {
            flex: 1;
        }

        .pims-summary-title {
            font-size: 0.9rem;
            color: #7f8c8d;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .pims-summary-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-summary-change {
            font-size: 0.8rem;
            display: flex;
            align-items: center;
        }

        .pims-summary-change.positive {
            color: var(--pims-success);
        }

        .pims-summary-change.negative {
            color: var(--pims-danger);
        }

        /* Main Chart Area */
        .pims-chart-card {
            grid-column: span 8;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            animation: fadeIn 0.8s ease;
        }

        .pims-chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .pims-chart-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-chart-actions {
            display: flex;
            gap: 0.5rem;
        }

        .pims-chart-period {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background-color: #f0f2f5;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--pims-transition);
        }

        .pims-chart-period.active {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-chart-container {
            height: 300px;
            position: relative;
        }

        /* Side Stats */
        .pims-stats-card {
            grid-column: span 4;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            animation: fadeInRight 0.8s ease;
        }

        .pims-stats-header {
            margin-bottom: 1.5rem;
        }

        .pims-stats-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-stats-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .pims-stats-item:last-child {
            border-bottom: none;
        }

        .pims-stats-label {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .pims-stats-value {
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-stats-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Recent Activity */
        .pims-activity-card {
            grid-column: span 6;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            animation: fadeInUp 0.8s ease;
        }

        .pims-activity-header {
            margin-bottom: 1.5rem;
        }

        .pims-activity-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-activity-list {
            list-style: none;
        }

        .pims-activity-item {
            display: flex;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 2rem;
        }

        .pims-activity-item:last-child {
            border-bottom: none;
        }

        .pims-activity-icon {
            position: absolute;
            left: 0;
            top: 1.25rem;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
        }

        .pims-activity-content {
            flex: 1;
        }

        .pims-activity-time {
            font-size: 0.75rem;
            color: #95a5a6;
            margin-bottom: 0.25rem;
        }

        .pims-activity-text {
            font-size: 0.9rem;
        }

        .pims-activity-user {
            font-weight: 600;
            color: var(--pims-primary);
        }

        /* Prisoner Distribution */
        .pims-distribution-card {
            grid-column: span 6;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            animation: fadeInUp 0.8s ease;
        }

        .pims-distribution-header {
            margin-bottom: 1.5rem;
        }

        .pims-distribution-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-distribution-container {
            display: flex;
            height: 250px;
        }

        .pims-distribution-chart {
            flex: 1;
            position: relative;
        }

        .pims-distribution-legend {
            width: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .pims-legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .pims-legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            margin-right: 0.75rem;
        }

        .pims-legend-label {
            font-size: 0.85rem;
            color: var(--pims-text-dark);
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .pims-summary-card {
                grid-column: span 6;
            }
            
            .pims-chart-card,
            .pims-stats-card {
                grid-column: span 12;
            }
        }

        @media (max-width: 768px) {
            #pims-page-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .pims-dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .pims-summary-card,
            .pims-chart-card,
            .pims-stats-card,
            .pims-activity-card,
            .pims-distribution-card {
                grid-column: span 1;
            }
            
            .pims-summary-card {
                flex-direction: column;
                text-align: center;
            }
            
            .pims-summary-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .pims-distribution-container {
                flex-direction: column;
                height: auto;
            }
            
            .pims-distribution-legend {
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                margin-top: 1rem;
            }
            
            .pims-legend-item {
                margin: 0.5rem;
            }
        }

        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from { 
                opacity: 0;
                transform: translateX(20px);
            }
            to { 
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body>
    <!-- NAV -->
    @include('includes.nav')

    <!-- Sidebar -->
    @include('inspector.menu')

    <!-- Main Content -->
    <div id="pims-page-content">
        <!-- Welcome Header -->
        <div class="pims-dashboard-grid">
            <div class="pims-chart-card" style="grid-column: span 12;">
                <div class="pims-chart-header">
                    <h1 class="pims-chart-title">
                        <i class="fas fa-tachometer-alt"></i> Inspector Dashboard
                    </h1>
                </div>
                <p>Welcome back, Inspector. Here's what's happening in your prison today.</p>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="pims-dashboard-grid">
            <div class="pims-summary-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <div class="pims-summary-icon" style="background-color: var(--pims-accent);">
                    <i class="fas fa-user-lock"></i>
                </div>
                <div class="pims-summary-content">
                    <div class="pims-summary-title">Total Prisoners</div>
                    <div class="pims-summary-value">{{ $prisonerCount }}</div>
                </div>
            </div>

            <div class="pims-summary-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="pims-summary-icon" style="background-color: var(--pims-success);">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="pims-summary-content">
                    <div class="pims-summary-title">Released This Month</div>
                    <div class="pims-summary-value">{{ $releasedThisMonth }}</div>
                </div>
            </div>

            <div class="pims-summary-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <div class="pims-summary-icon" style="background-color: var(--pims-warning);">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="pims-summary-content">
                    <div class="pims-summary-title">Active Cases</div>
                    <div class="pims-summary-value">{{ $activeCases }}</div>
                </div>
            </div>

            <div class="pims-summary-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <div class="pims-summary-icon" style="background-color: var(--pims-danger);">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="pims-summary-content">
                    <div class="pims-summary-title">Security Incidents</div>
                    <div class="pims-summary-value">{{ $securityIncidents }}</div>
                </div>
            </div>
        </div>

        <!-- Main Chart and Stats -->
        <div class="pims-dashboard-grid">
            <div class="pims-chart-card">
                <div class="pims-chart-header">
                    <h2 class="pims-chart-title">Prison Population Trend</h2>
                </div>
                <div class="pims-chart-container">
                    <canvas id="populationTrendChart"></canvas>
                </div>
            </div>

            <div class="pims-stats-card">
                <div class="pims-stats-header">
                    <h2 class="pims-stats-title">Quick Statistics</h2>
                </div>
                
                <div class="pims-stats-item">
                    <span class="pims-stats-label">Average Sentence Length</span>
                    <span class="pims-stats-value">7.2 years</span>
                </div>
                
                <div class="pims-stats-item">
                    <span class="pims-stats-label">Prison Capacity</span>
                    <span class="pims-stats-value">{{ round(($prisonerCount / $prisonCapacity) * 100) }}% full</span>
                </div>
                
                <div class="pims-stats-item">
                    <span class="pims-stats-label">New Admissions (30 days)</span>
                    <span class="pims-stats-value">{{ $newAdmissions }}</span>
                </div>
                
                <div class="pims-stats-item">
                    <span class="pims-stats-label">Medical Cases</span>
                    <span class="pims-stats-value">{{ $medicalCases }}</span>
                </div>
                
                <div class="pims-stats-item">
                    <span class="pims-stats-label">Staff Count</span>
                    <span class="pims-stats-value">{{ $staffCount }}</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity and Distribution -->
        <div class="pims-dashboard-grid">
            <div class="pims-activity-card">
                <div class="pims-activity-header">
                    <h2 class="pims-activity-title">Recent Activity</h2>
                </div>
                
                <ul class="pims-activity-list">
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon" style="background-color: var(--pims-success);">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="pims-activity-content">
                            <div class="pims-activity-time">10 minutes ago</div>
                            <div class="pims-activity-text">
                                <span class="pims-activity-user">John Doe</span> was released after completing sentence
                            </div>
                        </div>
                    </li>
                    
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon" style="background-color: var(--pims-accent);">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="pims-activity-content">
                            <div class="pims-activity-time">1 hour ago</div>
                            <div class="pims-activity-text">
                                New prisoner <span class="pims-activity-user">Michael Brown</span> registered (ID: {{ $latestPrisonerId }})
                            </div>
                        </div>
                    </li>
                    
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon" style="background-color: var(--pims-info);">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="pims-activity-content">
                            <div class="pims-activity-time">3 hours ago</div>
                            <div class="pims-activity-text">
                                Case <span class="pims-activity-user">#CR-2023-0456</span> assigned to lawyer <span class="pims-activity-user">Sarah Johnson</span>
                            </div>
                        </div>
                    </li>
                    
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon" style="background-color: var(--pims-warning);">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="pims-activity-content">
                            <div class="pims-activity-time">Yesterday</div>
                            <div class="pims-activity-text">
                                Security alert in <span class="pims-activity-user">Block B</span> resolved
                            </div>
                        </div>
                    </li>
                    
                    <li class="pims-activity-item">
                        <div class="pims-activity-icon" style="background-color: var(--pims-danger);">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <div class="pims-activity-content">
                            <div class="pims-activity-time">Yesterday</div>
                            <div class="pims-activity-text">
                                Medical emergency for <span class="pims-activity-user">Prisoner #{{ $medicalEmergencyId }}</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="pims-distribution-card">
                <div class="pims-distribution-header">
                    <h2 class="pims-distribution-title">Crime Distribution</h2>
                </div>
                
                <!--  -->
            </div>
        </div>
    </div>

    @include('includes.footer_js')
    
    <script>
        // Population Trend Chart
        const populationCtx = document.getElementById('populationTrendChart').getContext('2d');
        const populationChart = new Chart(populationCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Prison Population',
                    data: [420, 435, 450, 445, 460, 475, 490, 485, 500, 510, 525, 530],
                    borderColor: 'rgba(41, 128, 185, 1)',
                    backgroundColor: 'rgba(41, 128, 185, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgba(41, 128, 185, 1)',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 400,
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });

        // Crime Distribution Chart
        const crimeCtx = document.getElementById('crimeDistributionChart').getContext('2d');
        const crimeChart = new Chart(crimeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Theft', 'Assault', 'Drug Possession', 'Fraud', 'Murder', 'Other'],
                datasets: [{
                    data: [
                      
                    ],
                    backgroundColor: [
                        'rgba(52, 152, 219, 0.8)',
                        'rgba(231, 76, 60, 0.8)',
                        'rgba(46, 204, 113, 0.8)',
                        'rgba(243, 156, 18, 0.8)',
                        'rgba(155, 89, 182, 0.8)',
                        'rgba(26, 188, 156, 0.8)'
                    ],
                    borderColor: [
                        'rgba(52, 152, 219, 1)',
                        'rgba(231, 76, 60, 1)',
                        'rgba(46, 204, 113, 1)',
                        'rgba(243, 156, 18, 1)',
                        'rgba(155, 89, 182, 1)',
                        'rgba(26, 188, 156, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return `${label}: ${value}%`;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });

        // Period selector functionality
        document.querySelectorAll('.pims-chart-period').forEach(period => {
            period.addEventListener('click', function() {
                document.querySelectorAll('.pims-chart-period').forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                
                // In a real app, you would update the chart data here based on the selected period
            });
        });

        // Animate cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.pims-summary-card, .pims-chart-card, .pims-stats-card, .pims-activity-card, .pims-distribution-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>