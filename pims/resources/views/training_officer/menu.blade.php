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



    // Toggle submenus
    document.querySelectorAll('.pims-has-submenu > .pims-menu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (window.innerWidth > 1024 || !document.getElementById('pimsSidebar').classList.contains('pims-collapsed')) {
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

    // Mobile sidebar toggle
    document.getElementById('pimsSidebarToggle').addEventListener('click', function() {
        document.getElementById('pimsSidebar').classList.toggle('pims-active');
    });

    // Close sidebar when clicking X
    document.getElementById('pimsCloseSidebar').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('pimsSidebar').classList.remove('pims-active');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('pimsSidebar');
        const toggleBtn = document.getElementById('pimsSidebarToggle');
        
        if (window.innerWidth <= 1024 && 
            !sidebar.contains(e.target) && 
            e.target !== toggleBtn &&
            !toggleBtn.contains(e.target) &&
            sidebar.classList.contains('pims-active')) {
            sidebar.classList.remove('pims-active');
        }
    });

    // Toggle collapsed state on desktop
    document.getElementById('pimsCollapseBtn').addEventListener('click', function() {
        document.getElementById('pimsSidebar').classList.toggle('pims-collapsed');
    });

    // Mark active menu item based on current URL
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.href;
        document.querySelectorAll('.pims-menu-link, .pims-submenu-link').forEach(link => {
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

    // Auto-collapse on smaller screens
    function checkScreenSize() {
        if (window.innerWidth <= 1200 && window.innerWidth > 1024) {
            document.getElementById('pimsSidebar').classList.add('pims-collapsed');
        } else if (window.innerWidth > 1200) {
            document.getElementById('pimsSidebar').classList.remove('pims-collapsed');
        }
    }

    window.addEventListener('resize', checkScreenSize);
    checkScreenSize();
</script>