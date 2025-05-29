document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebarMain');
    const collapseBtn = document.getElementById('sidebarCollapse');
    const preloader = document.getElementById('preloader');

    // Initialize sidebar state
    function initSidebar() {
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        if (isCollapsed) {
            sidebar.classList.add('sidebar-collapsed');
            updateCollapseButton(true);
        } else {
            sidebar.classList.remove('sidebar-collapsed');
            updateCollapseButton(false);
        }
    }

    // Update collapse button state
    function updateCollapseButton(isCollapsed) {
        if (!collapseBtn) return;
        
        const icon = collapseBtn.querySelector('i');
        const text = collapseBtn.querySelector('span');
        
        if (isCollapsed) {
            icon.classList.replace('fa-chevron-left', 'fa-chevron-right');
        } else {
            icon.classList.replace('fa-chevron-right', 'fa-chevron-left');
        }
    }

    // Toggle submenus
    function setupSubmenus() {
        document.querySelectorAll('.sidebar-has-submenu').forEach(item => {
            const link = item.querySelector('.sidebar-menu-link');
            const submenu = item.querySelector('.sidebar-submenu');
            const arrow = item.querySelector('.sidebar-menu-arrow i');
            
            link.addEventListener('click', (e) => {
                // Only prevent default if sidebar is expanded
                if (!sidebar.classList.contains('sidebar-collapsed')) {
                    e.preventDefault();
                    
                    // Close all other open submenus
                    document.querySelectorAll('.sidebar-submenu').forEach(menu => {
                        if (menu !== submenu) {
                            menu.classList.remove('sidebar-submenu-open');
                            const otherArrow = menu.closest('.sidebar-has-submenu').querySelector('.sidebar-menu-arrow i');
                            if (otherArrow) otherArrow.classList.replace('fa-angle-up', 'fa-angle-down');
                        }
                    });
                    
                    // Toggle current submenu
                    submenu.classList.toggle('sidebar-submenu-open');
                    arrow.classList.toggle('fa-angle-down');
                    arrow.classList.toggle('fa-angle-up');
                }
            });
        });
    }

    // Toggle sidebar collapse
    function setupCollapseButton() {
        if (!collapseBtn) return;
        
        collapseBtn.addEventListener('click', () => {
            const isCollapsed = !sidebar.classList.contains('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-collapsed');
            updateCollapseButton(isCollapsed);
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });
    }

    // Preloader functions
    function setupPreloader() {
        if (!preloader) return;
        
        const allLinks = document.querySelectorAll('a[href]:not([href="#"]):not([target="_blank"])');
        
        allLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                if (link.hasAttribute('download') || 
                    (link.hostname && link.hostname !== window.location.hostname)) {
                    return;
                }
                
                e.preventDefault();
                showPreloader();
                
                setTimeout(() => {
                    window.location.href = link.href;
                }, 800);
            });
        });
        
        window.addEventListener('load', () => {
            setTimeout(hidePreloader, 500);
        });
    }

    function showPreloader() {
        if (preloader) {
            preloader.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function hidePreloader() {
        if (preloader) {
            preloader.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Initialize everything
    initSidebar();
    setupSubmenus();
    setupCollapseButton();
    setupPreloader();
});