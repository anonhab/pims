<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
@include('components.preloader')
<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggle">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-user-lock pims-brand-icon"></i>
        <span class="pims-brand-text">PIMS Admin</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="{{ route('cadmin.dashboard') }}" class="pims-menu-link">
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
                        <a href="{{ route('account.add') }}" class="pims-submenu-link">Create Account</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('account.show_all') }}" class="pims-submenu-link">View Account Details</a>
                    </li>
                </ul>
            </li>

            <!-- Prisoner Management -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-user-check"></i>
                    </span>
                    <span class="pims-menu-text">Prisoner Management</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('cprisoner.showAll') }}" class="pims-submenu-link">View Prisoner Profile</a>
                    </li>
                </ul>
            </li>
            <!-- Prison Management -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-building"></i>
                    </span>
                    <span class="pims-menu-text">Prison Management</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('prison.add') }}" class="pims-submenu-link">Add/Update Prison</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('prison.view') }}" class="pims-submenu-link">View Prison Details</a>
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
                        <a href="{{ route('cadmin.generate') }}" class="pims-submenu-link">Generate Report</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="/view_reports" class="pims-submenu-link">View Generated Reports</a>
                    </li>
                </ul>
            </li>

            <!-- Backup    -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-database"></i>
                    </span>
                    <span class="pims-menu-text">Backup   </span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="#" class="pims-submenu-link" id="initiateBackupBtn" onclick="initiateBackup()">Initiate Backup</a>
                    </li>
                    <li class="pims-menu-item">
                        <a href="/view_backup" class="pims-menu-link">View Backup Logs</a>
                    </li>
                </ul>
            </li>


        </ul>

        <!-- Collapse Button (Desktop) -->
        <div class="pims-collapse-btn" id="pimsCollapseBtn">
            <i class="fas fa-chevron-left"></i>
            <span>Collapse Menu</span>
        </div>
    </aside>
</div>
<script src="{{ asset('js/menu.js') }}"></script>
