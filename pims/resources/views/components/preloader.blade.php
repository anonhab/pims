<div class="pims-preloader" id="pimsPreloader">
    <div class="pims-preloader-content">
        <div class="pims-three-dots">
            <div class="pims-dot"></div>
            <div class="pims-dot"></div>
            <div class="pims-dot"></div>
        </div>
        <div class="pims-preloader-text">Loading<span class="pims-loading-dots">...</span></div>
        <br/><br/><br/>
        <div class="pims-cancel-text">Click anywhere to cancel</div>
    </div>
</div>

<style>
    /* Preloader Variables */
    :root {
        --pims-preloader-bg: rgba(255, 255, 255, 0.92);
        --pims-preloader-accent: #d35400;
        --pims-preloader-text: #333;
        --pims-preloader-zindex: 9999;
        --pims-dot-size: 14px;
        --pims-dot-spacing: 10px;
    }

    /* Preloader Container */
    .pims-preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--pims-preloader-bg);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: var(--pims-preloader-zindex);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.4s;
        cursor: pointer;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
    }

    .pims-preloader.active {
        opacity: 1;
        visibility: visible;
    }

    .pims-preloader.cancelling {
        opacity: 0;
        transition: opacity 0.3s ease-out;
    }

    /* Preloader Content */
    .pims-preloader-content {
        text-align: center;
        transform: translateY(-20%);
        user-select: none;
        position: relative;
    }

    /* Three Dots Animation */
    .pims-three-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(var(--pims-dot-size) * 2);
        margin-bottom: 24px;
    }

    .pims-dot {
        width: var(--pims-dot-size);
        height: var(--pims-dot-size);
        border-radius: 50%;
        background-color: var(--pims-preloader-accent);
        margin: 0 var(--pims-dot-spacing);
        animation: pims-bounce 1.4s infinite ease-in-out both;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .pims-dot:nth-child(1) {
        animation-delay: -0.32s;
    }

    .pims-dot:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes pims-bounce {
        0%, 80%, 100% { 
            transform: translateY(8px) scale(0.95);
            opacity: 0.7;
        } 
        40% { 
            transform: translateY(-8px) scale(1);
            opacity: 1;
        }
    }

    /* Preloader Text */
    .pims-preloader-text {
        color: var(--pims-preloader-text);
        font-size: 1.2rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        margin-top: 8px;
    }

    .pims-loading-dots::after {
        content: '...';
        animation: pims-ellipsis 1.8s infinite;
        display: inline-block;
        width: 1.5em;
        text-align: left;
    }

    @keyframes pims-ellipsis {
        0% { content: '.'; }
        33% { content: '..'; }
        66% { content: '...'; }
    }

    /* Cancel Text */
    .pims-cancel-text {
        position: absolute;
        bottom: -30px;
        left: 0;
        right: 0;
        color: var(--pims-preloader-text);
        font-size: 0.9rem;
        opacity: 0.7;
        animation: pims-fade-in 0.5s ease 1.5s forwards;
        opacity: 0;
    }

    @keyframes pims-fade-in {
        to { opacity: 0.7; }
    }

    /* Ripple Effect */
    .pims-ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(211, 84, 0, 0.15);
        transform: scale(0);
        animation: pims-ripple 0.6s linear;
        pointer-events: none;
    }

    @keyframes pims-ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>

<script>
// Enhanced preloader with click-to-cancel
document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('pimsPreloader');
    let isActive = false;
    let navigationTimeout = null;
    let currentHref = null;
    
    // Show preloader
    function show() {
        if (isActive) return;
        preloader.classList.remove('cancelling');
        preloader.classList.add('active');
        isActive = true;
    }
    
    // Hide preloader
    function hide() {
        if (!isActive) return;
        preloader.classList.remove('active');
        isActive = false;
        if (navigationTimeout) {
            clearTimeout(navigationTimeout);
            navigationTimeout = null;
        }
    }
    
    // Cancel preloader with animation
    function cancel() {
        if (!isActive) return;
        
        // Add ripple effect
        const ripple = document.createElement('div');
        ripple.classList.add('pims-ripple');
        ripple.style.left = (event.clientX - preloader.getBoundingClientRect().left) + 'px';
        ripple.style.top = (event.clientY - preloader.getBoundingClientRect().top) + 'px';
        preloader.appendChild(ripple);
        
        // Remove ripple after animation
        setTimeout(() => {
            ripple.remove();
        }, 600);
        
        // Cancel navigation and hide
        preloader.classList.add('cancelling');
        setTimeout(() => {
            hide();
            preloader.classList.remove('cancelling');
        }, 300);
    }
    
    // Expose to global scope
    window.PimsPreloader = { show, hide };
    
    // Handle click to cancel
    preloader.addEventListener('click', cancel);
    
    // Handle sidebar navigation clicks
    document.querySelectorAll('#pimsSidebar3 .pims-menu-item > .pims-menu-link[href]:not([href="#"])').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            currentHref = this.href;
            show();
            
            // Small delay to ensure preloader shows before navigation
            navigationTimeout = setTimeout(() => {
                window.location.href = currentHref;
            }, 50);
        });
    });
    
    // Handle submenu navigation clicks
    document.querySelectorAll('#pimsSidebar3 .pims-submenu-item > .pims-submenu-link[href]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            currentHref = this.href;
            show();
            
            navigationTimeout = setTimeout(() => {
                window.location.href = currentHref;
            }, 50);
        });
    });
    
    // Hide preloader when page fully loads
    window.addEventListener('load', hide);
    
    // Hide preloader if it's still showing when DOM is ready
    hide();
});
</script>