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
    padding: 0;
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
}

/* Sidebar Styles */
.sidbar {
    position: fixed;
    top: var(--pims-nav-height);
    left: 0;
    width: var(--pims-sidebar-width);
    height: calc(100vh - var(--pims-nav-height));
    background: white;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
    overflow-y: auto;
    z-index: 900;
    transition: var(--pims-transition);
    border-right: 1px solid rgba(0, 0, 0, 0.05);
}

/* Main Content Area */
#pims-page-content {
    margin-left: 0;
    padding: 2rem;
    padding-left: calc(var(--pims-sidebar-width) + 2rem);
    min-height: calc(100vh - var(--pims-nav-height));
    transition: var(--pims-transition);
    background-color: #f5f7fa;
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

.pims-dashboard-card .pims-card-footer {
    font-size: 0.8rem;
    color: #7f8c8d;
    margin-top: 1rem;
    display: flex;
    align-items: center;
    gap: 8px;
    padding-top: 0.5rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

/* Security Elements */
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
    0% {
        box-shadow: 0 0 0 0 rgba(255, 85, 85, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(255, 85, 85, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 85, 85, 0);
    }
}

/* Stats Box */
.pims-stats-box {
    background: white;
    border-radius: var(--pims-border-radius);
    padding: 1.5rem;
    box-shadow: var(--pims-card-shadow);
    margin-top: 1.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
    border: 1px solid rgba(0, 0, 0, 0.03);
}

.pims-stats-box h2 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--pims-primary);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    padding-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.pims-stats-box h2 i {
    color: var(--pims-accent);
    background: rgba(100, 255, 218, 0.1);
    width: 40px;
    height: 40px;
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

/* Stats Box for Recent Security Events */
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

.pims-stats-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at top left, rgba(100, 255, 218, 0.05), transparent 70%);
    pointer-events: none;
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

.pims-stats-box li strong {
    color: var(--pims-primary);
    font-weight: 700;
    letter-spacing: 0.3px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
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

.pims-status-tag.critical {
    background-color: rgba(255, 85, 85, 0.1);
    color: var(--pims-danger);
}

.pims-status-tag.completed {
    background-color: rgba(80, 250, 123, 0.1);
    color: var(--pims-success);
}

.pims-status-tag.system {
    background-color: rgba(139, 233, 253, 0.1);
    color: var(--pims-info);
}

/* System Alert */
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

.pims-system-alert::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
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
    
    .sidbar {
        transform: translateX(-100%);
    }
    
    .sidbar.active {
        transform: translateX(0);
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


         <div class="pims-grid">
    <!-- Account Management -->
    <div class="pims-dashboard-card">
        <span class="pims-security-badge"></span>
        <div class="pims-card-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h3>Staff Accounts</h3>
        <p>{{ number_format($adminCount) }}</p>
        <div class="pims-card-footer">
            <i class="fas fa-check-circle" style="color: var(--pims-success);"></i> All accounts 
        </div>
    </div>

    <!-- Prisoner Management -->
    <div class="pims-dashboard-card">
      
        <h3>Prisoner Count</h3>
        <p>{{ number_format($prisonerCount) }}</p>
        <div class="pims-card-footer">
            <i class="fas fa-exclamation-triangle" style="color: var(--pims-warning);"></i> {{ $pendingTransfers }} transfers pending
        </div>
    </div>

    <!-- Report Generation -->
    <div class="pims-dashboard-card">
        <span class="pims-security-badge"></span>
        <div class="pims-card-icon">
            <i class="fas fa-file-shield"></i>
        </div>
        <h3>Secure Reports</h3>
        <p>{{ number_format($reportCount) }}</p>
        <div class="pims-card-footer">
            <i class="fas fa-sync-alt" style="color: var(--pims-accent);"></i> {{ $reportsInProgress }} reports in progress
        </div>
    </div>

    
</div>

         <!-- Data Visualization -->
         <div class="pims-stats-box">
    <h2><i class="fas fa-users"></i> Prisoner Statistics</h2>
    <div class="pims-chart-container">
        <canvas id="pims-stats-chart"></canvas>
    </div>
</div>

      
     </div>



 </body>
 <script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('pims-stats-chart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Counts',
                data: @json($chartData['data']),
                backgroundColor: [
                    'rgba(100, 255, 218, 0.6)', // Prisons (teal)
                    'rgba(46, 204, 113, 0.6)',  // Total Prisoners (green)
                    'rgba(52, 152, 219, 0.6)',  // Male Prisoners (blue)
                    'rgba(231, 76, 60, 0.6)'    // Female Prisoners (red)
                ],
                borderColor: [
                    'rgba(100, 255, 218, 1)',
                    'rgba(46, 204, 113, 1)',
                    'rgba(52, 152, 219, 1)',
                    'rgba(231, 76, 60, 1)'
                ],
                borderWidth: 1
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
                    backgroundColor: 'rgba(26, 42, 58, 0.9)',
                    titleFont: { weight: 'bold' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' },
                    ticks: { stepSize: 10 }
                },
                x: {
                    grid: { display: false, drawBorder: false }
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

 </html>