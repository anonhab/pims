@include('components.preloader')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
<script src="{{ asset('js/menu.js') }}"></script>
<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-user-lock pims-brand-icon"></i>
        <span class="pims-brand-text">PIMS displine officer</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="/ddashboard" class="pims-menu-link">
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
                    <span class="pims-menu-text">Prisoners</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    
                    <li class="pims-submenu-item">
                        <a href="{{ route('prisoner.showprisoners') }}" class="pims-submenu-link">View Prisoner Profile</a>
                    </li>
                </ul>
            </li>

            <!-- Request Management -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    <span class="pims-menu-text">Request Management</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('discipline_officer.evaluate_request') }}" class="pims-submenu-link">Evaluate Request</a>
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
