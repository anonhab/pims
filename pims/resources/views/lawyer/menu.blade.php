@include('components.preloader')
<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-user-lock pims-brand-icon"></i>
        <span class="pims-brand-text">PIMS Lawyer</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="{{ route('mylawyer.ldashboard') }}" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-home"></i> <!-- Better dashboard icon -->
                    </span>
                    <span class="pims-menu-text">Dashboard</span>
                </a>
            </li>

            <!-- My Prisoners -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-user-shield"></i> <!-- More appropriate prisoner icon -->
                    </span>
                    <span class="pims-menu-text">My Prisoners</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('mylawyer.myprisoners') }}" class="pims-submenu-link">View Prisoner Profile</a>
                    </li>
                </ul>
            </li>

            <!-- Request -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-file-contract"></i> <!-- Better request icon -->
                    </span>
                    <span class="pims-menu-text">Request</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('mylawyer.createrequest')}}" class="pims-submenu-link">Create/Update Request</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('mylawyer.viewrequest') }}" class="pims-submenu-link">View Requests</a>
                    </li>
                </ul>
            </li>

            <!-- Appointment -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-calendar-check"></i> <!-- Better appointment icon -->
                    </span>
                    <span class="pims-menu-text">Appointment</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('mylawyer.createlegalappo') }}" class="pims-submenu-link">Create/Update Appointment</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('mylawyer.viewappointment') }}" class="pims-submenu-link">View Appointment Details</a>
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