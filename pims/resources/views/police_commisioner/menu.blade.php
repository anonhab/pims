<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS Sidebar</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Preloader Component -->
    @include('components.preloader')

    <div class="sidebar-container fixed top-0 left-0 h-full w-20 bg-gray-900 text-white shadow-2xl transition-all duration-300 sidebar-collapsed" id="sidebarMain">
       
        <!-- Sidebar Menu -->
        <aside class="sidebar-menu flex-1 overflow-y-auto">
            <ul class="sidebar-menu-list space-y-2 p-4">
                <br><br>
                <!-- Dashboard -->
                <li class="sidebar-menu-item">
                    <a href="/cdashboard" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                 <!-- Prisoner Management -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-users-cog"></i>
                        </span>
                        <span class="sidebar-menu-text">Prisoner Management</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('prisoner.showAll') }}"  class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Prisoner Profile</a>
                        </li>
                    </ul>
                </li>

                <!-- Process Request -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-building"></i>
                        </span>
                        <span class="sidebar-menu-text">Execute Requests</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('commisinerControler.evaluate_request') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Requests</a>
                        </li>
                    </ul>
                </li>

                <!-- Report Generation -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-user-lock"></i>
                        </span>
                        <span class="sidebar-menu-text">Release Prisoner</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('commisioner.release_prisoner') }}"  class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">Release Prisonere</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('commisioner.releasedprisoners') }}"  class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Releases</a>
                        </li>
                    </ul>
                </li>

                
            </ul>

            <!-- Collapse Button -->
            <div class="sidebar-collapse-btn p-4 bg-gray-800 border-t border-gray-700 flex items-center cursor-pointer" id="sidebarCollapse">
                <i class="fas fa-chevron-right mr-2"></i>
                <span>Expand Menu</span>
            </div>
        </aside>
    </div>

    <!-- Custom JS -->
    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>