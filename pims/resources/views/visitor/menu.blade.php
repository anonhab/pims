@include('components.preloader')
<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebarVisitor">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggleVisitor">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-user-clock pims-brand-icon"></i>
        <span class="pims-brand-text">PIMS Visitor</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebarVisitor"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            <!-- Dashboard -->
            <li class="pims-menu-item">
                <a href="/vdashboard" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="pims-menu-text">Dashboard</span>
                </a>
            </li>

            <!-- Visitor Menu -->
            <li class="pims-menu-item pims-has-submenu">
                <a href="#" class="pims-menu-link">
                    <span class="pims-menu-icon">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="pims-menu-text">Visitor Menu</span>
                    <span class="pims-menu-arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <ul class="pims-submenu">
                    <li class="pims-submenu-item">
                        <a href="/createVisiting" class="pims-submenu-link">Create Visiting Time Requests</a>
                    </li>
                    <li class="pims-submenu-item">
                        <a href="/visitorvisiting-requests" class="pims-submenu-link">My Visiting Time Requests</a>
                    </li>
                </ul>
            </li>
        </ul>
        
        <!-- Collapse Button (Desktop) -->
        <div class="pims-collapse-btn" id="pimsCollapseBtnVisitor">
            <i class="fas fa-chevron-left"></i>
            <span>Collapse Menu</span>
        </div>
    </aside>
</div>

<!-- Full Screen Preloader -->
<div class="pims-fullscreen-loader" id="pimsFullscreenLoader">
    <div class="pims-loader-content">
        <div class="pims-loader-spinner"></div>
        <div class="pims-loader-text">Loading...</div>
    </div>
</div>

<style>
    /* Sidebar Variables */
    :root {
        --pims-sidebar-width: 250px;
        --pims-sidebar-collapsed-width: 70px;
        --pims-sidebar-bg: #2c3e50;
        --pims-sidebar-text: #bdc3c7;
        --pims-sidebar-text-hover: white;
        --pims-sidebar-accent: #3498db;
        --pims-sidebar-border: rgba(255, 255, 255, 0.1);
        --pims-sidebar-submenu-bg: rgba(0, 0, 0, 0.2);
        --pims-sidebar-transition: all 0.3s ease;
    }

    /* Full Screen Loader Styles */
    .pims-fullscreen-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(44, 62, 80, 0.85);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .pims-fullscreen-loader.active {
        opacity: 1;
        visibility: visible;
    }

    .pims-loader-content {
        text-align: center;
    }

    .pims-loader-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        border-top-color: var(--pims-sidebar-accent);
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }

    .pims-loader-text {
        color: white;
        font-size: 1rem;
        font-weight: 500;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
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
    document.querySelectorAll('#pimsSidebarVisitor .pims-has-submenu > .pims-menu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (window.innerWidth > 1024 || !document.getElementById('pimsSidebarVisitor').classList.contains('pims-collapsed')) {
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
    document.getElementById('pimsSidebarToggleVisitor').addEventListener('click', function() {
        document.getElementById('pimsSidebarVisitor').classList.toggle('pims-active');
    });

    // Close sidebar when clicking X
    document.getElementById('pimsCloseSidebarVisitor').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('pimsSidebarVisitor').classList.remove('pims-active');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('pimsSidebarVisitor');
        const toggleBtn = document.getElementById('pimsSidebarToggleVisitor');
        
        if (window.innerWidth <= 1024 && 
            !sidebar.contains(e.target) && 
            e.target !== toggleBtn &&
            !toggleBtn.contains(e.target) &&
            sidebar.classList.contains('pims-active')) {
            sidebar.classList.remove('pims-active');
        }
    });

    // Toggle collapsed state on desktop
    document.getElementById('pimsCollapseBtnVisitor').addEventListener('click', function() {
        document.getElementById('pimsSidebarVisitor').classList.toggle('pims-collapsed');
    });

    // Mark active menu item based on current URL
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.href;
        document.querySelectorAll('#pimsSidebarVisitor .pims-menu-link, #pimsSidebarVisitor .pims-submenu-link').forEach(link => {
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
            document.getElementById('pimsSidebarVisitor').classList.add('pims-collapsed');
        } else if (window.innerWidth > 1200) {
            document.getElementById('pimsSidebarVisitor').classList.remove('pims-collapsed');
        }
    }

    window.addEventListener('resize', checkScreenSize);
    checkScreenSize();

    // Show preloader when menu items are clicked
    document.querySelectorAll('#pimsSidebarVisitor .pims-menu-link[href], #pimsSidebarVisitor .pims-submenu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            // Don't show preloader for submenu toggle clicks
            if (!this.classList.contains('pims-menu-link') || 
                (this.classList.contains('pims-menu-link') && !this.parentElement.classList.contains('pims-has-submenu'))) {
                
                const loader = document.getElementById('pimsFullscreenLoader');
                loader.classList.add('active');
                
                // Hide loader when navigation completes (fallback in case page doesn't change)
                setTimeout(() => {
                    loader.classList.remove('active');
                }, 3000);
            }
        });
    });
</script>