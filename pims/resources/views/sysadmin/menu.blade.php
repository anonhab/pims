@include('components.preloader')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
<script src="{{ asset('js/menu.js') }}"></script>
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
                <a href="/sdashboard" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="pims-menu-text">Dashboard</span>
                </a>
            </li>

            <!-- Account Management -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <span class="pims-menu-text">Account Management</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('saccount.add') }}" class="pims-submenu-link">Create Account</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('saccount.show_all') }}" class="pims-submenu-link">View Account Details</a>
                    </li>
                </ul>
            </li>

            <!-- Report Generation -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-chart-line"></i>
                    </span>
                    <span class="pims-menu-text">Report Generation</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="/sysadmin/generate_report" class="pims-submenu-link">Generate Report</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="/sysadmin/view_reports" class="pims-submenu-link">View Generated Reports</a>
                    </li>
                </ul>
            </li>

            <!-- Backup and Recovery -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-database"></i>
                    </span>
                    <span class="pims-menu-text">Backup and Recovery</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-menu-item">
                        <a href="#" class="pims-menu-link" id="initiateBackupBtn" onclick="initiateBackup()">Initiate Backup</a>
                    </li>
                    <li class="pims-menu-item">
                        <a href="/view_backup_recovery_logs" class="pims-menu-link">View Backup/Recovery Logs</a>
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
