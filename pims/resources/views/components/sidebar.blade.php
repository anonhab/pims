<div class="pims-sidebar-container is-hidden-mobile" id="pimsSidebar">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="pims-sidebar-toggle" id="pimsSidebarToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Logo/Brand -->
    <div class="pims-sidebar-brand">
        <i class="fas fa-user-lock pims-brand-icon"></i>
        <span class="pims-brand-text">PIMS Admin</span>
        <i class="fas fa-times pims-close-sidebar" id="pimsCloseSidebar"></i>
    </div>

    <!-- Sidebar Menu -->
    <aside class="pims-menu">
        <ul class="pims-menu-list">
            {{ $slot }}
        </ul>
        
        <!-- Collapse Button (Desktop) -->
        <div class="pims-collapse-btn" id="pimsCollapseBtn">
            <i class="fas fa-chevron-left"></i>
            <span>Collapse Menu</span>
        </div>
    </aside>
</div>

@push('styles')
<style>
    /* All your existing CSS styles go here */
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

    /* ... rest of your CSS ... */
</style>
@endpush

@push('scripts')
<script>
    // All your existing JavaScript goes here
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

    // ... rest of your JavaScript ...
    
</script>
@endpush