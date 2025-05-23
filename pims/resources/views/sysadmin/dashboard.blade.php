 

@include('includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Secure Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js for data visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --pims-primary: #1a2a3a;
            /* Darker blue for more authority */
            --pims-secondary: #2c3e50;
            --pims-accent: #2980b9;
            /* Slightly darker blue */
            --pims-danger: #c0392b;
            /* Darker red */
            --pims-success: #27ae60;
            /* Darker green */
            --pims-warning: #d35400;
            /* Darker orange */
            --pims-text-light: #ecf0f1;
            --pims-text-dark: #2c3e50;
            --pims-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            --pims-border-radius: 6px;
            --pims-nav-height: 60px;
            --pims-sidebar-width: 250px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            color: white;
            z-index: 1000;
            display: flex;
            align-items: center;
            top: 0;
        }

        /* Sidebar Styles */
        .sidbar {
            position: fixed;
            top: var(--pims-nav-height);
            left: 0;
            width: var(--pims-sidebar-width);
            height: calc(100vh - var(--pims-nav-height));
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            overflow-y: auto;
            z-index: 900;
            transition: all 0.3s ease;
        }

        /* Main Content Area */
        #pims-page-content {
            margin-left: 0;
            padding: 1.5rem;
            padding-left: 300px;
            min-height: calc(100vh - var(--pims-nav-height));
            transition: all 0.3s ease;
            background-color: #f0f2f5;
        }

        /* Dashboard Cards */
        .pims-dashboard-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            transition: all 0.3s ease;
            height: 100%;
            border-left: 4px solid var(--pims-accent);
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
        }

        .pims-dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-dashboard-card .pims-card-icon {
            font-size: 1.8rem;
            margin-bottom: 0.75rem;
            color: var(--pims-accent);
        }

        .pims-dashboard-card h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--pims-primary);
            letter-spacing: 0.5px;
        }

        .pims-dashboard-card p {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--pims-secondary);
            margin-bottom: 0;
            letter-spacing: -0.5px;
        }

        .pims-dashboard-card .pims-card-footer {
            font-size: 0.75rem;
            color: #7f8c8d;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Security Elements */
        .pims-security-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--pims-primary);
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.65rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .pims-security-badge.alert {
            background-color: var(--pims-danger);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.4);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(231, 76, 60, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(231, 76, 60, 0);
            }
        }

        /* Stats Box */
        .pims-stats-box {
            background: white;
            border-radius: var(--pims-border-radius);
            padding: 1.25rem;
            box-shadow: var(--pims-card-shadow);
            margin-top: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
        }

        .pims-stats-box h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--pims-primary);
            border-bottom: 1px solid #eee;
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pims-stats-box h2 i {
            color: var(--pims-accent);
        }

        /* Chart Container */
        .pims-chart-container {
            position: relative;
            height: 300px;
            margin-top: 1rem;
        }

        /* Recent Activity */
        .pims-activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pims-activity-item {
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            transition: background 0.2s ease;
        }

        .pims-activity-item:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .pims-activity-item:last-child {
            border-bottom: none;
        }

        .pims-activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--pims-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
            font-size: 0.9rem;
        }

        .pims-activity-details {
            flex-grow: 1;
        }

        .pims-activity-details strong {
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-activity-time {
            font-size: 0.7rem;
            color: #7f8c8d;
            margin-top: 0.2rem;
            font-family: 'Courier New', monospace;
        }

        /* Status Tags */
        .pims-status-tag {
            font-size: 0.7rem;
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-status-tag.critical {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--pims-danger);
        }

        .pims-status-tag.completed {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--pims-success);
        }

        .pims-status-tag.system {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--pims-accent);
        }

        /* System Alert */
        .pims-system-alert {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 0.85rem 1.25rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--pims-danger);
        }

        .pims-system-alert .alert-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pims-system-alert .alert-icon {
            font-size: 1.2rem;
            color: var(--pims-danger);
        }

        .pims-system-alert .alert-close {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s ease;
        }

        .pims-system-alert .alert-close:hover {
            opacity: 1;
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        /* Section Title */
        .pims-section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--pims-primary);
            position: relative;
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .pims-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--pims-accent);
        }

        .pims-section-title i {
            margin-right: 10px;
            color: var(--pims-accent);
        }
    </style>

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

 
    @include('sysadmin.menu')

        
            <!-- Main Content -->
            <div id="pims-page-content">
                <h1 class="pims-section-title">
                    <i class="fas fa-shield-alt"></i> Security Dashboard
                </h1>

                <div class="pims-system-alert">
                    <div class="alert-content">
                        <i class="fas fa-exclamation-triangle alert-icon"></i>
                        <div>
                            <strong>SECURITY ALERT:</strong> 3 unauthorized access attempts detected in the last 24 hours
                        </div>
                    </div>
                    <button class="alert-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="pims-grid">
                    <!-- Account Management -->
                    <div class="pims-dashboard-card">
                        <span class="pims-security-badge">SECURED</span>
                        <div class="pims-card-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3>Admin Accounts</h3>
                        <p>24</p>
                        <div class="pims-card-footer">
                            <i class="fas fa-check-circle" style="color: var(--pims-success);"></i> All accounts secured
                        </div>
                    </div>

                    <!-- Prisoner Management -->
                    <div class="pims-dashboard-card">
                        <span class="pims-security-badge alert">ALERT</span>
                        <div class="pims-card-icon">
                            <i class="fas fa-user-lock"></i>
                        </div>
                        <h3>Prisoner Count</h3>
                        <p>1,245</p>
                        <div class="pims-card-footer">
                            <i class="fas fa-exclamation-triangle" style="color: var(--pims-warning);"></i> 5 transfers pending
                        </div>
                    </div>

                    <!-- Report Generation -->
                    <div class="pims-dashboard-card">
                        <span class="pims-security-badge">ENCRYPTED</span>
                        <div class="pims-card-icon">
                            <i class="fas fa-file-shield"></i>
                        </div>
                        <h3>Secure Reports</h3>
                        <p>187</p>
                        <div class="pims-card-footer">
                            <i class="fas fa-sync-alt" style="color: var(--pims-accent);"></i> 3 reports in progress
                        </div>
                    </div>

                    <!-- Backup & Recovery -->
                    <div class="pims-dashboard-card">
                        <span class="pims-security-badge">PROTECTED</span>
                        <div class="pims-card-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3>System Backups</h3>
                        <p>12</p>
                        <div class="pims-card-footer">
                            <i class="fas fa-clock" style="color: var(--pims-accent);"></i> Next backup in 3h 22m
                        </div>
                    </div>
                </div>

                <!-- Data Visualization -->
                <div class="pims-stats-box">
                    <h2><i class="fas fa-chart-line"></i> Security Activity</h2>
                    <div class="pims-chart-container">
                        <canvas id="pims-stats-chart"></canvas>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="pims-stats-box mt-4">
                    <h2><i class="fas fa-history"></i> Recent Security Events</h2>
                    <ul class="pims-activity-list">
                        <li class="pims-activity-item">
                            <div class="pims-activity-icon">
                                <i class="fas fa-user-times"></i>
                            </div>
                            <div class="pims-activity-details">
                                <strong>Unauthorized access attempt</strong> - Blocked IP: 192.168.1.45
                                <div class="pims-activity-time">2023-11-15 14:32:45 UTC</div>
                            </div>
                            <span class="pims-status-tag critical">Critical</span>
                        </li>
                        <li class="pims-activity-item">
                            <div class="pims-activity-icon">
                                <i class="fas fa-file-export"></i>
                            </div>
                            <div class="pims-activity-details">
                                <strong>Sensitive report exported</strong> - Monthly prisoner transfer log
                                <div class="pims-activity-time">2023-11-15 12:18:22 UTC</div>
                            </div>
                            <span class="pims-status-tag completed">Audited</span>
                        </li>
                        <li class="pims-activity-item">
                            <div class="pims-activity-icon">
                                <i class="fas fa-key"></i>
                            </div>
                            <div class="pims-activity-details">
                                <strong>Admin credentials rotated</strong> - User: mjohnson
                                <div class="pims-activity-time">2023-11-15 09:45:11 UTC</div>
                            </div>
                            <span class="pims-status-tag completed">Completed</span>
                        </li>
                        <li class="pims-activity-item">
                            <div class="pims-activity-icon">
                                <i class="fas fa-server"></i>
                            </div>
                            <div class="pims-activity-details">
                                <strong>Database maintenance</strong> - Security patches applied
                                <div class="pims-activity-time">2023-11-14 23:15:37 UTC</div>
                            </div>
                            <span class="pims-status-tag system">System</span>
                        </li>
                    </ul>
                </div>
            </div>
             

            
</body>
<script>
                // Initialize Chart
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('pims-stats-chart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00', '23:59'],
                            datasets: [{
                                    label: 'Security Events',
                                    data: [2, 5, 8, 12, 7, 4, 3],
                                    backgroundColor: 'rgba(231, 76, 60, 0.1)',
                                    borderColor: 'rgba(231, 76, 60, 1)',
                                    borderWidth: 2,
                                    tension: 0.3,
                                    fill: true
                                },
                                {
                                    label: 'Authorized Logins',
                                    data: [15, 30, 45, 60, 45, 30, 15],
                                    backgroundColor: 'rgba(46, 204, 113, 0.1)',
                                    borderColor: 'rgba(46, 204, 113, 1)',
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
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        font: {
                                            weight: '600'
                                        }
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: 'rgba(26, 42, 58, 0.9)',
                                    titleFont: {
                                        weight: 'bold'
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        drawBorder: false,
                                        color: 'rgba(0,0,0,0.05)'
                                    },
                                    ticks: {
                                        stepSize: 10
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    }
                                }
                            },
                            elements: {
                                point: {
                                    radius: 4,
                                    hoverRadius: 6
                                }
                            }
                        }
                    });

                    // Close alert
                    document.querySelector('.alert-close').addEventListener('click', () => {
                        document.querySelector('.pims-system-alert').style.display = 'none';
                    });

                    // Make security badge pulse
                    const alertBadge = document.querySelector('.pims-security-badge.alert');
                    if (alertBadge) {
                        setInterval(() => {
                            alertBadge.style.opacity = alertBadge.style.opacity === '0.8' ? '1' : '0.8';
                        }, 1000);
                    }
                });
            </script>

    @include('includes.footer_js')
</html>