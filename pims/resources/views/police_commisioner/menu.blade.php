@include('components.preloader')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
<script src="{{ asset('js/menu.js') }}"></script>
<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar2">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggle2">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-user-lock pims-brand-icon"></i>
        <span class="pims-brand-text">PIMS User</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar2"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="/cdashboard" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="pims-menu-text">Dashboard</span>
                </a>
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
                        <a href="{{ route('prisoner.showAll') }}" class="pims-submenu-link">View Prisoner Profile</a>
                    </li>
                </ul>
            </li>

            <!-- Process Request -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-paper-plane"></i>
                    </span>
                    <span class="pims-menu-text">Execute Requests</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('commisinerControler.evaluate_request') }}"  class="pims-submenu-link">View Requests</a>
                    </li>
                </ul>
            </li>

            <!-- Report Generation -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-chart-line"></i>
                    </span>
                    <span class="pims-menu-text">Release Prisoner</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                <li class="pims-submenu-item">
                        <a href="{{ route('commisioner.release_prisoner') }}" class="pims-submenu-link">Release Prisoner</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('commisioner.releasedprisoners') }}" class="pims-submenu-link">View Releases</a>
                    </li>
                </ul>
            </li>
        </ul>
        
        <!-- Collapse Button (Desktop) -->
        <div class="pims-collapse-btn" id="pimsCollapseBtn2">
            <i class="fas fa-chevron-left"></i>
            <span>Collapse Menu</span>
        </div>
    </aside>
</div>
