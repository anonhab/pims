@include('components.preloader')
<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-chalkboard-teacher pims-brand-icon"></i>
        <span class="pims-brand-text">Training System</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="/tdashboard" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="pims-menu-text">Dashboard</span>
                </a>
            </li>
            
            <!-- Training Programs -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                    <span class="pims-menu-text">Training Programs</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('training.viewTrainingPrograms') }}" class="pims-submenu-link">Training Programs</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('training.assignTrainingPrograms') }}" class="pims-submenu-link">Assign Training Programs</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('training.viewassignedTrainingPrograms') }}" class="pims-submenu-link">View Assigned Programs</a>
                    </li>
                </ul>
            </li>

            <!-- Jobs -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-briefcase"></i>
                    </span>
                    <span class="pims-menu-text">Jobs</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('training.assignjobs') }}" class="pims-submenu-link">Assign Jobs</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('training.viewJobs') }}" class="pims-submenu-link">View Jobs</a>
                    </li>
                </ul>
            </li>

            <!-- Certification Management -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-certificate"></i>
                    </span>
                    <span class="pims-menu-text">Certification Management</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('training.assignCertifications') }}" class="pims-submenu-link">Assign Certification to Prisoner</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('training.viewCertifications') }}" class="pims-submenu-link">View Certifications</a>
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
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
<script src="{{ asset('js/menu.js') }}"></script>