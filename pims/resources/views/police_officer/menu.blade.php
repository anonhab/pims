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
        <span class="pims-brand-text">PIMS Police Officer</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="/pdashboard" class="pims-menu-link">
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
                        <a href="{{ route('prisoner.showAll') }}" class="pims-submenu-link">View Prisoner Profile</a>
                    </li>
                </ul>
            </li>

            <!-- Lawyer Management -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-gavel"></i>
                    </span>
                    <span class="pims-menu-text">Room Allocation</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="{{ route('room.show') }}" class="pims-submenu-link">View Rooms</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('room.allocate') }}" class="pims-submenu-link">Allocate room</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('room.assign') }}" class="pims-submenu-link">View allocations</a>
                    </li>
                </ul>
                @php
    use App\Models\PolicePrisonerAssignment;
    $isAssigned = PolicePrisonerAssignment::where('officer_id', session('user_id'))->exists();
@endphp

            <!-- Conditionally Display Request Menu -->
            @if($isAssigned)
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
                        <a href="{{ route('createrequestpolice')}}" class="pims-submenu-link">Create/Update Request</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('viewrequestpolice') }}" class="pims-submenu-link">View Requests</a>
                    </li>
                </ul>
            </li>
            @endif
            
        </ul>
        
        <!-- Collapse Button (Desktop) -->
        <div class="pims-collapse-btn" id="pimsCollapseBtn">
            <i class="fas fa-chevron-left"></i>
            <span>Collapse Menu</span>
        </div>
    </aside>
</div>
<script src="{{ asset('js/menu.js') }}"></script>