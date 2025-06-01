<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <title>PIMS - Lawyer Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js for data visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- External Menu CSS -->
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">

    <style>
        :root {
            --pims-primary: #0a192f;
            --pims-secondary: #172a45;
            --pims-accent: #64ffda;
            --pims-danger: #ff5555;
            --pims-success: #50fa7b;
            --pims-warning: #ffb86c;
            --pims-info: #8be9fd;
            --pims-text-light: #f8f8f2;
            --pims-text-dark: #282a36;
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
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-text-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            line-height: 1.6;
        }

       

        #pims-page-content {
            margin-left: 0;
            padding: 2rem;
              padding-left: 300px;
            transition: var(--pims-transition);
            background-color: #f5f7fa;
            padding-top: 70px;
        }

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

        .pims-security-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--pims-primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.7rem;
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
            0% { box-shadow: 0 0 0 0 rgba(255, 85, 85, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(255, 85, 85, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 85, 85, 0); }
        }

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

        .pims-system-alert {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-left: 4px solid var(--pims-danger);
            position: relative;
            overflow: hidden;
        }

        .pims-system-alert .alert-content {
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 1;
        }

        .pims-system-alert .alert-icon {
            font-size: 1.5rem;
            color: var(--pims-danger);
            flex-shrink: 0;
        }

        .pims-system-alert .alert-close {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s ease;
            z-index: 1;
            padding: 0.5rem;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pims-system-alert .alert-close:hover {
            opacity: 1;
            background: rgba(255,255,255,0.2);
        }

        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .pims-section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--pims-primary);
            position: relative;
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
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

        .pims-chart-container {
            position: relative;
            height: 350px;
            margin-top: 1.5rem;
        }

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
    /* Adjust main content padding for mobile */
    #pims-page-content {
        padding-left: 90px !important;
    }

    /* Keep all other mobile styles */
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

    .pims-stats-box li {
        flex-direction: column;
        align-items: flex-start;
        padding: 1rem;
    }

    .pims-stats-box li .pims-activity-time {
        margin-left: 0;
        margin-top: 0.5rem;
    }
}
    </style>
</head>
<body>
    @include('includes.nav')
    @include('lawyer.menu')

    <div id="pims-page-content">
        <h1 class="pims-section-title">
            <i class="fas fa-briefcase"></i> Lawyer Dashboard
        </h1>

        @if(session('success'))
            <div class="pims-system-alert" style="border-left-color: var(--pims-success);">
                <div class="alert-content">
                    <i class="fas fa-check-circle alert-icon" style="color: var(--pims-success);"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button class="alert-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="pims-system-alert">
                <div class="alert-content">
                    <i class="fas fa-exclamation-triangle alert-icon"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button class="alert-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div class="pims-grid">
            <div class="pims-dashboard-card">
                <span class="pims-security-badge">ACTIVE</span>
                <div class="pims-card-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3>Active Clients</h3>
                <p>{{ $activeClients }}</p>
                <div class="pims-card-footer">
                    <i class="fas fa-check-circle" style="color: var(--pims-success);"></i> All profiles up to date
                </div>
            </div>

            <div class="pims-dashboard-card">
                <span class="pims-security-badge {{ $pendingRequests > 0 ? 'alert' : '' }}">PENDING</span>
                <div class="pims-card-icon">
                    <i class="fas fa-file-contract"></i>
                </div>
                <h3>Pending Requests</h3>
                <p>{{ $pendingRequests }}</p>
                <div class="pims-card-footer">
                    <i class="fas fa-exclamation-triangle" style="color: var(--pims-warning);"></i>
                    {{ $pendingRequests > 0 ? "$pendingRequests pending action" : "No pending requests" }}
                </div>
            </div>

            <div class="pims-dashboard-card">
                <span class="pims-security-badge">SCHEDULED</span>
                <div class="pims-card-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Approved Requests</h3>
                <p>{{ $approvedRequests }}</p>
                <div class="pims-card-footer">
                    <i class="fas fa-clock" style="color: var(--pims-accent);"></i>
                    {{ $recentAppointments->first() ? 'Next at ' . $recentAppointments->first()->appointment_date->format('H:i') : 'No upcoming appointments' }}
                </div>
            </div>

            <div class="pims-dashboard-card">
                <span class="pims-security-badge"></span>
                <div class="pims-card-icon">
                    <i class="fas fa-file-shield"></i>
                </div>
                <h3>Rejected Requests</h3>
                <p>{{ $rejectedRequests }}</p>
                <div class="pims-card-footer">
                    <i class="fas fa-sync-alt" style="color: var(--pims-accent);"></i> All requests processed
                </div>
            </div>
        </div>

      
        
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Preloader
    const preloader = document.querySelector('.pims-progress');
    if (preloader) {
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500); // Increased timeout for better visibility
    }

    // Request Status Distribution Chart
    const requestStatusCanvas = document.getElementById('pims-request-status-box');
    if (requestStatusCanvas) {
        const requestStatusChart = new Chart(requestStatusCanvas.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    label: 'Requests',
                    data: [
                        {{ $requestStatusChartData['pending'] }},
                        {{ $requestStatusChartData['approved'] }},
                        {{ $requestStatusChartData['rejected'] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 184, 108, 0.7)',
                        'rgba(80, 250, 123, 0.7)',
                        'rgba(255, 85, 85, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 184, 108, 1)',
                        'rgba(80, 250, 123, 1)',
                        'rgba(255, 85, 85, 1)'
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
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { weight: '600' }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(10, 25, 47, 0.9)',
                        titleFont: { weight: 'bold' }
                    }
                }
            }
        });
    }

    // Case Activity Chart (Line)
    const caseActivityCanvas = document.getElementById('case-activity-chart');
    if (caseActivityCanvas) {
        const caseActivityChart = new Chart(caseActivityCanvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($caseTrendsChartData['labels']),
                datasets: [{
                    label: 'Requests',
                    data: @json($caseTrendsChartData['requests']),
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
                        ticks: { stepSize: 2 }
                    },
                    x: {
                        grid: { display: false, drawBorder: false }
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
    }

    // Search functionality
    const searchInput = document.getElementById('input-search-appointments');
    const appointmentItems = document.querySelectorAll('.pims-stats-box li');
    if (searchInput && appointmentItems.length) {
        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            appointmentItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }

    // Refresh button
    const refreshButton = document.getElementById('btn-pims-btn-refresh');
    if (refreshButton) {
        refreshButton.addEventListener('click', () => {
            window.location.reload();
        });
    }

    // Close alert
    const alertCloses = document.querySelectorAll('.alert-close');
    alertCloses.forEach(btn => {
        btn.addEventListener('click', () => {
            const alert = btn.closest('.pims-system-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        });
    });

    // Pulse effect for alert
    const alertBadges = document.querySelectorAll('.pims-security-badge.alert');
    alertBadges.forEach(badge => {
        setInterval(() => {
            badge.style.opacity = badge.style.opacity === '0.8' ? '1' : '0.8';
        }, 1000);
    });
});
    </script>
</body>
</html>