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
                        <a href="{{ route('saccount.add') }}" class="pims-submenu-link">Create Account</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="{{ route('saccount.show_all') }}" class="pims-submenu-link">View Account Details</a>
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
                        <a href="/sysadmin/generate_report" class="pims-submenu-link">Generate Report</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="/sysadmin/view_reports" class="pims-submenu-link">View Generated Reports</a>
                    </li>
                </ul>
            </li>

            <!-- Backup and Recovery -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-database"></i>
                    </span>
                    <span class="pims-menu-text">Backup and Recovery</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-menu-item">
                        <a href="#" class="pims-menu-link" id="initiateBackupBtn" onclick="initiateBackup()">Initiate Backup</a>
                    </li>
                    <li class="pims-menu-item">
                        <a href="/view_backup_recovery_logs" class="pims-menu-link">View Backup/Recovery Logs</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Collapse Button (Desktop) -->
        <div class="pims-collapse-btn" id="pimsCollapseBtn3">
            <i class="fas fa-chevron-left"></i>
            <span>Collapse Menu</span>
        </div>
    </aside>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add click handlers to all menu links
        document.querySelectorAll('.pims-menu-link, .pims-submenu-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Only show preloader for actual navigation links
                if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                    // Don't prevent default if it's a submenu toggle
                    if (!this.parentElement.classList.contains('pims-has-submenu') ||
                        (window.innerWidth <= 1024 || document.getElementById('pimsSidebar').classList.contains('pims-collapsed'))) {

                        // Show preloader immediately
                        PimsPreloader.show();

                        // Add a small delay before navigation to ensure preloader shows
                        e.preventDefault();
                        const targetUrl = this.getAttribute('href');

                        setTimeout(() => {
                            window.location.href = targetUrl;
                        }, 50);
                    }
                }
            });
        });

        // Handle AJAX navigation if you're using it
        if (typeof Livewire !== 'undefined') {
            Livewire.hook('message.sent', () => {
                PimsPreloader.show();
            });

            Livewire.hook('message.processed', () => {
                setTimeout(PimsPreloader.hide, 500);
            });
        }
    });




    // Toggle submenus for third sidebar
    document.querySelectorAll('#pimsSidebar3 .pims-has-submenu > .pims-menu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (window.innerWidth > 1024 || !document.getElementById('pimsSidebar3').classList.contains('pims-collapsed')) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('active');

                // Close other open submenus at the same level
                Array.from(parent.parentElement.children).forEach(item => {
                    if (item !== parent) {
                        item.classList.remove('active');
                    }
                });
            }
        });
    });

    // Mobile sidebar toggle for third sidebar
    document.getElementById('pimsSidebarToggle3').addEventListener('click', function() {
        document.getElementById('pimsSidebar3').classList.toggle('pims-active');
    });

    // Close sidebar when clicking X for third sidebar
    document.getElementById('pimsCloseSidebar3').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('pimsSidebar3').classList.remove('pims-active');
    });

    // Close sidebar when clicking outside on mobile for third sidebar
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('pimsSidebar3');
        const toggleBtn = document.getElementById('pimsSidebarToggle3');

        if (window.innerWidth <= 1024 &&
            !sidebar.contains(e.target) &&
            e.target !== toggleBtn &&
            !toggleBtn.contains(e.target) &&
            sidebar.classList.contains('pims-active')) {
            sidebar.classList.remove('pims-active');
        }
    });

    // Toggle collapsed state on desktop for third sidebar
    document.getElementById('pimsCollapseBtn3').addEventListener('click', function() {
        document.getElementById('pimsSidebar3').classList.toggle('pims-collapsed');
    });

    // Mark active menu item based on current URL for third sidebar
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.href;
        document.querySelectorAll('#pimsSidebar3 .pims-menu-link, #pimsSidebar3 .pims-submenu-link').forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
                let parent = link.closest('.pims-has-submenu');
                while (parent) {
                    parent.classList.add('active');
                    parent = parent.parentElement.closest('.pims-has-submenu');
                }
            }
        });
    });

    // Auto-collapse on smaller screens for third sidebar
    function checkScreenSize3() {
        if (window.innerWidth <= 1200 && window.innerWidth > 1024) {
            document.getElementById('pimsSidebar3').classList.add('pims-collapsed');
        } else if (window.innerWidth > 1200) {
            document.getElementById('pimsSidebar3').classList.remove('pims-collapsed');
        }
    }

    window.addEventListener('resize', checkScreenSize3);
    checkScreenSize3();
</script>