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
</br></br>
                <!-- Dashboard -->
                <li class="sidebar-menu-item">
                    <a href="{{ route('cadmin.dashboard') }}"  class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                 <!-- Account Management -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="sidebar-menu-text">Account Management</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('account.add') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">Create Account</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('account.show_all') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Account Details</a>
                        </li>
                    </ul>
                </li>

                <!-- Prison Management -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <span class="sidebar-menu-text">Prison Management</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('prison.add') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">Add/Update Prison</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a  href="{{ route('prison.view') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Prison Details</a>
                        </li>
                    </ul>
                </li>

                
                <!-- Prison Management -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <span class="sidebar-menu-text">Prisoner Management</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('cprisoner.showAll') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Prisoner Profile</a>
                        </li>
                    </ul>
                </li>

                <!-- Report Generation -->
                <li class="sidebar-menu-item sidebar-has-submenu">
                    <a href="#" class="sidebar-menu-link flex items-center p-3 rounded-lg text-gray-200 hover:text-white transition-all duration-200">
                        <span class="sidebar-menu-icon mr-3">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <span class="sidebar-menu-text">Report Generation</span>
                        <span class="sidebar-menu-arrow ml-auto">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="sidebar-submenu pl-6 space-y-2">
                        <li class="sidebar-submenu-item">
                            <a href="{{ route('cadmin.generate') }}" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">Generate Report</a>
                        </li>
                        <li class="sidebar-submenu-item">
                            <a href="/view_reports" class="sidebar-submenu-link text-gray-300 hover:text-white text-sm p-2 block">View Generated Reports</a>
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