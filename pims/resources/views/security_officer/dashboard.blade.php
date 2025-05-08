<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Security Officer Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Sidebar Variables (from provided sidebar CSS) */
        :root {
            --pims-sidebar-width: 250px;
            --pims-sidebar-collapsed-width: 70px;
            --pims-sidebar-bg: #2c3e50;
            --pims-sidebar-text: #d1d4d7;
            --pims-sidebar-text-hover: white;
            --pims-sidebar-accent: #007bff;
            --pims-sidebar-border: rgba(255, 255, 255, 0.1);
            --pims-sidebar-submenu-bg: rgba(0, 0, 0, 0.2);
            --pims-sidebar-transition: all 0.3s ease;
            --pims-primary: #007bff;
            --pims-secondary: #2c3e50;
            --pims-success: #28a745;
            --pims-warning: #ffc107;
            --pims-danger: #dc3545;
            --pims-text-light: #d1d4d7;
        }

        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
            margin: 0;
        }

        /* Main Layout */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            margin-top: 70px; /* Offset for fixed sidebar */
        }

        /* Sidebar Container (from provided code) */
        .pims-sidebar-container {
            width: var(--pims-sidebar-width);
            height: 100vh;
            background-color: var(--pims-sidebar-bg);
            position: fixed;
            left: 0;
            top: 70px;
            z-index: 900;
            transition: var(--pims-sidebar-transition);
            border-right: 1px solid var(--pims-sidebar-border);
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .pims-sidebar-container.pims-collapsed {
            width: var(--pims-sidebar-collapsed-width);
        }

        .pims-sidebar-container.pims-collapsed .pims-brand-text,
        .pims-sidebar-container.pims-collapsed .pims-menu-text,
        .pims-sidebar-container.pims-collapsed .pims-menu-arrow,
        .pims-sidebar-container.pims-collapsed .pims-collapse-btn span {
            display: none;
        }

        .pims-sidebar-container.pims-collapsed .pims-menu-link {
            justify-content: center;
            padding: 12px 0;
        }

        .pims-sidebar-container.pims-collapsed .pims-menu-icon {
            margin-right: 0;
            font-size: 1.1rem;
        }

        .pims-sidebar-container.pims-collapsed .pims-has-submenu.active .pims-submenu {
            position: absolute;
            left: 100%;
            top: 0;
            width: 200px;
            background-color: var(--pims-sidebar-bg);
            border-radius: 0 5px 5px 0;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .pims-sidebar-brand {
            display: flex;
            align-items: center;
            padding: 20px 15px;
            color: white;
            border-bottom: 1px solid var(--pims-sidebar-border);
            position: relative;
        }

        .pims-brand-icon {
            font-size: 1.5rem;
            color: var(--pims-sidebar-accent);
            margin-right: 10px;
        }

        .pims-brand-text {
            font-weight: 600;
            font-size: 1.1rem;
            transition: var(--pims-sidebar-transition);
        }

        .pims-close-sidebar {
            position: absolute;
            right: 15px;
            cursor: pointer;
            display: none;
        }

        .pims-menu {
            padding: 15px 0;
        }

        .pims-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pims-menu-item {
            position: relative;
        }

        .pims-menu-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--pims-sidebar-text);
            text-decoration: none;
            transition: var(--pims-sidebar-transition);
            border-left: 3px solid transparent;
        }

        .pims-menu-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--pims-sidebar-text-hover);
            border-left: 3px solid var(--pims-sidebar-accent);
        }

        .pims-menu-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--pims-sidebar-text-hover);
            border-left: 3px solid var(--pims-sidebar-accent);
        }

        .pims-menu-icon {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            font-size: 0.9rem;
            transition: var(--pims-sidebar-transition);
        }

        .pims-menu-text {
            flex-grow: 1;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--pims-sidebar-transition);
        }

        .pims-menu-arrow {
            transition: var(--pims-sidebar-transition);
        }

        .pims-has-submenu.active .pims-menu-arrow {
            transform: rotate(180deg);
        }

        .pims-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: var(--pims-sidebar-submenu-bg);
        }

        .pims-has-submenu.active .pims-submenu {
            max-height: 500px;
        }

        .pims-submenu-item {
            border-left: 3px solid transparent;
        }

        .pims-submenu-link {
            display: block;
            padding: 10px 15px 10px 50px;
            color: var(--pims-sidebar-text);
            text-decoration: none;
            font-size: 0.85rem;
            transition: var(--pims-sidebar-transition);
        }

        .pims-submenu-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--pims-sidebar-text-hover);
            padding-left: 55px;
        }

        .pims-collapse-btn {
            display: flex;
            align-items: center;
            padding: 15px;
            color: var(--pims-sidebar-text);
            cursor: pointer;
            transition: var(--pims-sidebar-transition);
            border-top: 1px solid var(--pims-sidebar-border);
            margin-top: 15px;
        }

        .pims-collapse-btn:hover {
            color: var(--pims-sidebar-text-hover);
            background-color: rgba(255, 255, 255, 0.05);
        }

        .pims-collapse-btn i {
            margin-right: 10px;
        }

        .pims-sidebar-container.pims-collapsed .pims-collapse-btn i {
            transform: rotate(180deg);
            margin-right: 0;
        }

        .pims-sidebar-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: var(--pims-sidebar-accent);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: none;
        }

        /* Dashboard Styles */
        .pims-dashboard-container {
            flex: 1;
            padding: 20px;
            margin-left: var(--pims-sidebar-width);
            transition: margin-left var(--pims-sidebar-transition);
        }

        .pims-sidebar-container.pims-collapsed ~ .pims-dashboard-container {
            margin-left: var(--pims-sidebar-collapsed-width);
        }

        .pims-dashboard-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--pims-secondary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Summary Cards */
        .pims-summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .pims-summary-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .pims-summary-card:hover {
            transform: translateY(-5px);
        }

        .pims-summary-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--pims-primary);
        }

        .pims-summary-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--pims-secondary);
            margin-bottom: 10px;
        }

        .pims-summary-card .pims-stat {
            font-size: 2rem;
            font-weight: 700;
            color: var(--pims-primary);
        }

        /* Quick Actions */
        .pims-actions-section {
            margin-bottom: 30px;
        }

        .pims-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .pims-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            background-color: var(--pims-primary);
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .pims-action-btn:hover {
            background-color: #0056b3;
        }

        .pims-action-btn i {
            margin-right: 8px;
        }

        /* Recent Activity */
        .pims-recent-activity {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .pims-recent-activity h2 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--pims-secondary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pims-activity-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pims-activity-table th,
        .pims-activity-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-size: 0.9rem;
        }

        .pims-activity-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--pims-secondary);
        }

        .pims-activity-table td {
            color: #333;
        }

        .pims-status-badge {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .pims-status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .pims-status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .pims-status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Alerts */
        .alert {
            padding: 12px;
            border-radius: 4px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .pims-sidebar-container {
                transform: translateX(-100%);
                top: 0;
                height: 100vh;
                z-index: 1200;
                width: 280px;
            }

            .pims-sidebar-container.pims-active {
                transform: translateX(0);
            }

            .pims-close-sidebar {
                display: block;
            }

            .pims-sidebar-toggle {
                display: flex;
            }

            .pims-collapse-btn {
                display: none;
            }

            .pims-dashboard-container {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .pims-summary-grid {
                grid-template-columns: 1fr;
            }

            .pims-actions-grid {
                grid-template-columns: 1fr;
            }

            .pims-activity-table {
                font-size: 0.85rem;
            }

            .pims-activity-table th,
            .pims-activity-table td {
                padding: 8px;
            }
        }

        @media (max-width: 576px) {
            .pims-dashboard-title {
                font-size: 1.5rem;
            }

            .pims-summary-card .pims-stat {
                font-size: 1.5rem;
            }

            .pims-activity-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
 
<body>
    <!-- Preloader (Assuming included component) -->
    @include('components.preloader')
    @include('includes.nav')

    <!-- Sidebar -->
    <div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar3">
        <!-- Sidebar Toggle Button (visible on mobile) -->
        <div class="pims-sidebar-toggle" id="pimsSidebarToggle3">
            <i class="fas fa-bars"></i>
        </div>
        
        <!-- Sidebar Logo/Brand -->
        <div class="pims-sidebar-brand">
            <i class="fas fa-user-shield pims-brand-icon"></i>
            <span class="pims-brand-text">PIMS System</span>
            <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar3"></i>
        </div>

        <!-- Sidebar Menu -->
        <aside class="pims-menu">
            <ul class="pims-menu-list">
                <!-- Dashboard -->
                <li class="pims-menu-item">
                    <a href="/sdashboard" class="pims-menu-link active">
                        <span class="pims-menu-icon">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="pims-menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Visitor Management -->
                <li class="pims-menu-item pims-has-submenu">
                    <a href="#" class="pims-menu-link">
                        <span class="pims-menu-icon">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="pims-menu-text">Visitor Management</span>
                        <span class="pims-menu-arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="pims-submenu">
                        <li class="pims-submenu-item">
                            <a href="{{ route('security.registerVisitor') }}" class="pims-submenu-link">Register Visitor</a>
                        </li>
                        <li class="pims-submenu-item">
                            <a href="{{ route('security_officer.viewvisitors') }}" class="pims-submenu-link">View Visitors</a>
                        </li>
                    </ul>
                </li>

                <!-- Monitor -->
                <li class="pims-menu-item pims-has-submenu">
                    <a href="#" class="pims-menu-link">
                        <span class="pims-menu-icon">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <span class="pims-menu-text">Monitor</span>
                        <span class="pims-menu-arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="pims-submenu">
                        <li class="pims-submenu-item">
                            <a href="/viewprisonerstatus" class="pims-submenu-link">Monitor Prisoner Status</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Collapse Button (Desktop) -->
            <div class="pims-collapse-btn" id="pimsCollapseBtn3">
                <i class="fas fa-chevron-left"></i>
                <span>Collapse Menu</span>
            </div>
        </aside>
    </div>

    <!-- Dashboard Content -->
    <div class="pims-app-container">
        <div class="pims-dashboard-container">
            <h1 class="pims-dashboard-title">
                <i class="fas fa-home"></i> Security Officer Dashboard
            </h1>

            <!-- Summary Cards -->
            <div class="pims-summary-grid">
                <div class="pims-summary-card">
                    <i class="fas fa-stethoscope"></i>
                    <h3>Pending Medical Appointments</h3>
                    <div class="pims-stat">{{ $pendingMedicalAppointments ?? 5 }}</div>
                </div>
                <div class="pims-summary-card">
                    <i class="fas fa-balance-scale"></i>
                    <h3>Pending Lawyer Appointments</h3>
                    <div class="pims-stat">{{ $pendingLawyerAppointments ?? 3 }}</div>
                </div>
                <div class="pims-summary-card">
                    <i class="fas fa-user-friends"></i>
                    <h3>Pending Visitor Appointments</h3>
                    <div class="pims-stat">{{ $pendingVisitorAppointments ?? 7 }}</div>
                </div>
                <div class="pims-summary-card">
                    <i class="fas fa-users"></i>
                    <h3>Total Visitors</h3>
                    <div class="pims-stat">{{ $totalVisitors ?? 25 }}</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="pims-actions-section">
                <h2 class="pims-dashboard-title">
                    <i class="fas fa-bolt"></i> Quick Actions
                </h2>
                <div class="pims-actions-grid">
                    <a href="{{ route('security.registerVisitor') }}" class="pims-action-btn">
                        <i class="fas fa-user-plus"></i> Register Visitor
                    </a>
                    <a href="{{ route('security_officer.viewvisitors') }}" class="pims-action-btn">
                        <i class="fas fa-users"></i> View Visitors
                    </a>
                    <a href="/viewprisonerstatus" class="pims-action-btn">
                        <i class="fas fa-chart-line"></i> Monitor Prisoner Status
                    </a>
                    <a href="#" class="pims-action-btn" onclick="openPrisonerModal('', '', '')">
                        <i class="fas fa-search"></i> Verify Prisoner
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="pims-recent-activity">
                <h2>
                    <i class="fas fa-history"></i> Recent Activity
                </h2>
                @if(count($recentActivities ?? []) > 0)
                <table class="pims-activity-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentActivities ?? [] as $activity)
                        <tr>
                            <td>{{ date('M d, Y h:i A', strtotime($activity->created_at ?? now())) }}</td>
                            <td>{{ $activity->type ?? 'Unknown' }}</td>
                            <td>{{ $activity->details ?? 'No details' }}</td>
                            <td>
                                <span class="pims-status-badge pims-status-{{ strtolower($activity->status ?? 'pending') }}">
                                    <i class="fas fa-{{ ($activity->status ?? 'pending') == 'pending' ? 'clock' : (($activity->status ?? 'pending') == 'approved' ? 'check' : 'times') }}"></i>
                                    {{ ucfirst($activity->status ?? 'pending') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No recent activity found.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Prisoner Verification Modal (from previous context) -->
    <div id="prisonerModal" class="pims-modal">
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h3 class="pims-modal-title">Verify Prisoner Details</h3>
                <button class="pims-modal-close" onclick="closeModal('prisonerModal')">×</button>
            </div>
            <div class="pims-form-group">
                <label class="pims-form-label">First Name</label>
                <input type="text" class="pims-form-control" id="verifyFirstName">
            </div>
            <div class="pims-form-group">
                <label class="pims-form-label">Middle Name</label>
                <input type="text" class="pims-form-control" id="verifyMiddleName">
            </div>
            <div class="pims-form-group">
                <label class="pims-form-label">Last Name</label>
                <input type="text" class="pims-form-control" id="verifyLastName">
            </div>
            <div id="verificationResult" class="alert" style="display: none;"></div>
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="pims-btn pims-btn-secondary" onclick="closeModal('prisonerModal')">
                    <i class="fas fa-times"></i> Close
                </button>
                <button class="pims-btn pims-btn-primary" onclick="verifyPrisoner()">
                    <i class="fas fa-check-circle"></i> Verify
                </button>
            </div>
            <div id="viewPrisonerBtn" class="mt-3 text-center" style="display: none;">
                <button class="pims-btn pims-btn-success w-100" id="viewPrisonerLink">
                    <i class="fas fa-eye"></i> View Prisoner Details
                </button>
            </div>
        </div>
    </div>

    <!-- Inmate Details Modal -->
    <div class="modal fade" id="inmateModal" tabindex="-1" aria-labelledby="inmateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inmateModalLabel">Inmate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="inmateDetails">
                    <!-- JSON data populated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Sidebar Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Script (from provided code)
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.pims-menu-link, .pims-submenu-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                        if (!this.parentElement.classList.contains('pims-has-submenu') || 
                            (window.innerWidth <= 1024 || document.getElementById('pimsSidebar3').classList.contains('pims-collapsed'))) {
                            // Show preloader immediately
                            // Assuming PimsPreloader is defined
                            if (typeof PimsPreloader !== 'undefined') PimsPreloader.show();
                            e.preventDefault();
                            const targetUrl = this.getAttribute('href');
                            setTimeout(() => {
                                window.location.href = targetUrl;
                            }, 50);
                        }
                    }
                });
            });

            document.querySelectorAll('#pimsSidebar3 .pims-has-submenu > .pims-menu-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (window.innerWidth > 1024 || !document.getElementById('pimsSidebar3').classList.contains('pims-collapsed')) {
                        e.preventDefault();
                        const parent = this.parentElement;
                        parent.classList.toggle('active');
                        Array.from(parent.parentElement.children).forEach(item => {
                            if (item !== parent) item.classList.remove('active');
                        });
                    }
                });
            });

            document.getElementById('pimsSidebarToggle3').addEventListener('click', function() {
                document.getElementById('pimsSidebar3').classList.toggle('pims-active');
            });

            document.getElementById('pimsCloseSidebar3').addEventListener('click', function(e) {
                e.stopPropagation();
                document.getElementById('pimsSidebar3').classList.remove('pims-active');
            });

            document.addEventListener('click', function(e) {
                const sidebar = document.getElementById('pimsSidebar3');
                const toggleBtn = document.getElementById('pimsSidebarToggle3');
                if (window.innerWidth <= 1024 && 
                    !sidebar.contains(e.target) && 
                    e.target !== toggleBtn &&
                    !toggleBtn.contains(e.target) &&
                    sidebar.classList.contains('pims-active')) {
                    sidebar.classList.remove('pims-active');
                }
            });

            document.getElementById('pimsCollapseBtn3').addEventListener('click', function() {
                document.getElementById('pimsSidebar3').classList.toggle('pims-collapsed');
            });

            const currentUrl = window.location.href;
            document.querySelectorAll('#pimsSidebar3 .pims-menu-link, #pimsSidebar3 .pims-submenu-link').forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                    let parent = link.closest('.pims-has-submenu');
                    while (parent) {
                        parent.classList.add('active');
                        parent = parent.parentElement.closest('.pims-has-submenu');
                    }
                }
            });

            function checkScreenSize3() {
                if (window.innerWidth <= 1200 && window.innerWidth > 1024) {
                    document.getElementById('pimsSidebar3').classList.add('pims-collapsed');
                } else if (window.innerWidth > 1200) {
                    document.getElementById('pimsSidebar3').classList.remove('pims-collapsed');
                }
            }

            window.addEventListener('resize', checkScreenSize3);
            checkScreenSize3();
        });

        // Dashboard Script (including prisoner verification)
        const BASE_URL = ''; // Adjust if needed (e.g., '/api')
        document.addEventListener('DOMContentLoaded', function () {
            const viewPrisonerBtn = document.getElementById('viewPrisonerLink');
            if (viewPrisonerBtn) {
                viewPrisonerBtn.addEventListener('click', async function () {
                    const prisonerId = document.getElementById('viewPrisonerBtn').dataset.id;
                    console.log('View Prisoner clicked, ID:', prisonerId);
                    if (!prisonerId) {
                        alert('No prisoner ID found. Please verify the prisoner again.');
                        return;
                    }

                    try {
                        const endpoint = `${BASE_URL}/prisoners/${prisonerId}`;
                        console.log('Fetching from:', endpoint);
                        const res = await fetch(endpoint);
                        if (!res.ok) {
                            if (res.status === 404) {
                                throw new Error(`Inmate with ID ${prisonerId} not found`);
                            }
                            throw new Error(`HTTP error! Status: ${res.status}`);
                        }
                        const data = await res.json();
                        console.log('Fetched inmate data:', data);

                        if (!data.first_name || !data.last_name) {
                            throw new Error('Incomplete inmate data received');
                        }

                        const details = `
                            <img src="/storage/${data.inmate_image || 'default.jpg'}" alt="Inmate Image" class="img-thumbnail mb-3" width="150">
                            <p><strong>Name:</strong> ${data.first_name} ${data.middle_name || ''} ${data.last_name}</p>
                            <p><strong>DOB:</strong> ${data.dob || 'N/A'}</p>
                            <p><strong>Gender:</strong> ${data.gender || 'N/A'}</p>
                            <p><strong>Address:</strong> ${(data.address || 'N/A').replace(/\r\n/g, '<br>')}</p>
                            <p><strong>Marital Status:</strong> ${data.marital_status || 'N/A'}</p>
                            <p><strong>Crime:</strong> ${data.crime_committed || 'N/A'}</p>
                            <p><strong>Status:</strong> ${data.status || 'N/A'}</p>
                            <p><strong>Time Served:</strong> ${data.time_serve_start || 'N/A'} - ${data.time_serve_end || 'N/A'}</p>
                            <hr>
                            <p><strong>Emergency Contact:</strong> ${data.emergency_contact_name || 'N/A'} (${data.emergency_contact_relation || 'N/A'}) - ${data.emergency_contact_number || 'N/A'}</p>
                            <p><strong>Prison Name:</strong> ${data.prison_name || 'N/A'}</p>
                            <p><strong>Created:</strong> ${data.created_at || 'N/A'}</p>
                            <p><strong>Updated:</strong> ${data.updated_at || 'N/A'}</p>
                        `;
                        document.getElementById('inmateDetails').innerHTML = details;

                        closeModal('prisonerModal');
                        const modal = new bootstrap.Modal(document.getElementById('inmateModal'), {
                            backdrop: 'static',
                            keyboard: true
                        });
                        modal.show();
                    } catch (error) {
                        console.error('Error fetching inmate data:', error);
                        alert(`Failed to load inmate data: ${error.message}`);
                    }
                });
            }

            function openPrisonerModal(firstName, middleName, lastName) {
                document.getElementById('verifyFirstName').value = firstName || '';
                document.getElementById('verifyMiddleName').value = middleName || '';
                document.getElementById('verifyLastName').value = lastName || '';
                document.getElementById('verificationResult').style.display = 'none';
                document.getElementById('viewPrisonerBtn').style.display = 'none';
                showModal('prisonerModal');
            }

            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            }

            window.onclick = function (event) {
                if (event.target.classList.contains('pims-modal')) {
                    closeModal(event.target.id);
                }
            };

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    const openModal = document.querySelector('.pims-modal[style="display: block;"]');
                    if (openModal) closeModal(openModal.id);
                }
            });

            async function verifyPrisoner() {
                const firstName = document.getElementById('verifyFirstName').value.trim();
                const middleName = document.getElementById('verifyMiddleName').value.trim();
                const lastName = document.getElementById('verifyLastName').value.trim();

                if (!firstName || !lastName) {
                    showVerificationResult('Please provide at least first and last name', false);
                    return;
                }

                try {
                    const response = await fetch('/verify-prisoner', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            first_name: firstName,
                            middle_name: middleName,
                            last_name: lastName
                        })
                    });

                    const data = await response.json();
                    console.log('Verification response:', data);

                    if (data.success && data.prisoner_id) {
                        showVerificationResult(data.message || 'Prisoner verified successfully', true);
                        const viewBtn = document.getElementById('viewPrisonerBtn');
                        viewBtn.dataset.id = data.prisoner_id;
                        viewBtn.style.display = 'block';
                        console.log('View button shown with ID:', data.prisoner_id);
                    } else {
                        showVerificationResult(data.message || 'Verification failed', false);
                    }
                } catch (error) {
                    console.error('Verification error:', error);
                    showVerificationResult('Error verifying prisoner: ' + error.message, false);
                }
            }

            function showVerificationResult(message, isSuccess) {
                const resultDiv = document.getElementById('verificationResult');
                resultDiv.textContent = message;
                resultDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'}`;
                resultDiv.style.display = 'block';
                resultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>