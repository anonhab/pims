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