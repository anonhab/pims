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
        <!-- Sidebar Logo/Brand -->
        <div class="sidebar-brand flex items-center p-4 bg-gray-800 border-b border-gray-700">
            <i class="fas fa-user-shield text-2xl mr-2"></i>
            <span class="sidebar-brand-text text-lg font-bold">PIMS System</span>
        </div>

        <!-- Sidebar Menu -->
        <aside class="sidebar-menu flex-1 overflow-y-auto">
            <ul class="sidebar-menu-list space-y-2 p-4">
                <!-- Dashboard -->
                <li class="sidebar-menu-item">
                    <a href="/sdashboard" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Visitor Management -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="sidebar-menu-text">Visitor Management</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('security.registerVisitor') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">Register Visitor</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('security_officer.viewvisitors') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Visitors</a>
                        </li>
                    </ul>
                </li>

                <!-- Monitor -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <span class="sidebar-menu-text">Monitor</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="/viewprisonerstatus" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">Monitor Prisoner Status</a>
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