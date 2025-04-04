<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-user-lock pims-brand-icon"></i>
        <span class="pims-brand-text">PIMS displin</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="/idashboard" class="pims-menu-link">
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
                        <a href="{{ route('prisoner.show_allforin') }}" class="pims-submenu-link">View Prisoner Profile</a>
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
                        <a href="/discipline_officer/view_requests" class="pims-submenu-link">View Requests</a>
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


<style>
    /* Sidebar Variables */
    :root {
        --pims-sidebar-width: 250px;
        --pims-sidebar-collapsed-width: 70px;
        --pims-sidebar-bg: var(--pims-secondary);
        --pims-sidebar-text: var(--pims-text-light);
        --pims-sidebar-text-hover: white;
        --pims-sidebar-accent: var(--pims-accent);
        --pims-sidebar-border: rgba(255, 255, 255, 0.1);
        --pims-sidebar-submenu-bg: rgba(0, 0, 0, 0.2);
        --pims-sidebar-transition: all 0.3s ease;
    }

    /* Sidebar Container */
    .pims-sidebar-container {
        width: var(--pims-sidebar-width);
        height: 100vh;
        background-color: var(--pims-sidebar-bg);
        position: fixed;
        left: 0;
        top: 70px;
        z-index: 900;
        transition: var(--pims-sidebar-transition);
        border-right: 1px solid var(--pims-sidebar-border);
        overflow-y: auto;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Collapsed State */
    .pims-sidebar-container.pims-collapsed {
        width: var(--pims-sidebar-collapsed-width);
    }

    .pims-sidebar-container.pims-collapsed .pims-brand-text,
    .pims-sidebar-container.pims-collapsed .pims-menu-text,
    .pims-sidebar-container.pims-collapsed .pims-menu-arrow,
    .pims-sidebar-container.pims-collapsed .pims-collapse-btn span {
        display: none;
    }

    .pims-sidebar-container.pims-collapsed .pims-menu-link {
        justify-content: center;
        padding: 12px 0;
    }

    .pims-sidebar-container.pims-collapsed .pims-menu-icon {
        margin-right: 0;
        font-size: 1.1rem;
    }

    .pims-sidebar-container.pims-collapsed .pims-has-submenu.active .pims-submenu {
        position: absolute;
        left: 100%;
        top: 0;
        width: 200px;
        background-color: var(--pims-sidebar-bg);
        border-radius: 0 5px 5px 0;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar Brand */
    .pims-sidebar-brand {
        display: flex;
        align-items: center;
        padding: 20px 15px;
        color: white;
        border-bottom: 1px solid var(--pims-sidebar-border);
        position: relative;
    }

    .pims-brand-icon {
        font-size: 1.5rem;
        color: var(--pims-sidebar-accent);
        margin-right: 10px;
    }

    .pims-brand-text {
        font-weight: 600;
        font-size: 1.1rem;
        transition: var(--pims-sidebar-transition);
    }

    .pims-close-sidebar {
        position: absolute;
        right: 15px;
        cursor: pointer;
        display: none;
    }

    /* Menu Styles */
    .pims-menu {
        padding: 15px 0;
    }

    .pims-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pims-menu-item {
        position: relative;
    }

    .pims-menu-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: var(--pims-sidebar-text);
        text-decoration: none;
        transition: var(--pims-sidebar-transition);
        border-left: 3px solid transparent;
    }

    .pims-menu-link:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: var(--pims-sidebar-text-hover);
        border-left: 3px solid var(--pims-sidebar-accent);
    }

    .pims-menu-link.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--pims-sidebar-text-hover);
        border-left: 3px solid var(--pims-sidebar-accent);
    }

    .pims-menu-icon {
        width: 24px;
        text-align: center;
        margin-right: 12px;
        font-size: 0.9rem;
        transition: var(--pims-sidebar-transition);
    }

    .pims-menu-text {
        flex-grow: 1;
        font-size: 0.9rem;
        font-weight: 500;
        transition: var(--pims-sidebar-transition);
    }

    .pims-menu-arrow {
        transition: var(--pims-sidebar-transition);
    }

    .pims-has-submenu.active .pims-menu-arrow {
        transform: rotate(180deg);
    }

    /* Submenu Styles */
    .pims-submenu {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background-color: var(--pims-sidebar-submenu-bg);
    }

    .pims-has-submenu.active .pims-submenu {
        max-height: 500px;
    }

    .pims-submenu-item {
        border-left: 3px solid transparent;
    }

    .pims-submenu-link {
        display: block;
        padding: 10px 15px 10px 50px;
        color: var(--pims-sidebar-text);
        text-decoration: none;
        font-size: 0.85rem;
        transition: var(--pims-sidebar-transition);
    }

    .pims-submenu-link:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: var(--pims-sidebar-text-hover);
        padding-left: 55px;
    }

    /* Collapse Button */
    .pims-collapse-btn {
        display: flex;
        align-items: center;
        padding: 15px;
        color: var(--pims-sidebar-text);
        cursor: pointer;
        transition: var(--pims-sidebar-transition);
        border-top: 1px solid var(--pims-sidebar-border);
        margin-top: 15px;
    }

    .pims-collapse-btn:hover {
        color: var(--pims-sidebar-text-hover);
        background-color: rgba(255, 255, 255, 0.05);
    }

    .pims-collapse-btn i {
        margin-right: 10px;
    }

    .pims-sidebar-container.pims-collapsed .pims-collapse-btn i {
        transform: rotate(180deg);
        margin-right: 0;
    }

    /* Mobile Toggle Button - Bottom Right */
    .pims-sidebar-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background-color: var(--pims-sidebar-accent);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        display: none;
    }

    /* Responsive Styles */
    @media (max-width: 1024px) {
        .pims-sidebar-container {
            transform: translateX(-100%);
            top: 0;
            height: 100vh;
            z-index: 1200;
            width: 280px;
        }

        .pims-sidebar-container.pims-active {
            transform: translateX(0);
        }

        .pims-close-sidebar {
            display: block;
        }

        .pims-sidebar-toggle {
            display: flex;
        }

        .pims-collapse-btn {
            display: none;
        }
    }

    @media (min-width: 1025px) {
        .pims-sidebar-toggle {
            display: none;
        }
    }
</style>

<script>
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