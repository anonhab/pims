@include('components.preloader')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
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

        <!-- Collapse Button (Desktop) -->
        <div class="pims-collapse-btn" id="pimsCollapseBtn3">
            <i class="fas fa-chevron-left"></i>
            <span>Collapse Menu</span>
        </div>
    </aside>
</div>
<script src="{{ asset('js/menu.js') }}"></script>