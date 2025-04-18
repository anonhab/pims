<div class="pims-preloader" id="pimsPreloader">
    <div class="pims-preloader-content">
        <div class="pims-three-dots">
            <div class="pims-dot"></div>
            <div class="pims-dot"></div>
            <div class="pims-dot"></div>
        </div>
        <div class="pims-preloader-text">Loading<span class="pims-loading-dots">...</span></div>
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

    /* Preloader Content */
    .pims-preloader-content {
        text-align: center;
        transform: translateY(-20%);
        user-select: none;
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

    /* Ripple Effect */
    .pims-ripple-effect {
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        :root {
            --pims-dot-size: 12px;
            --pims-dot-spacing: 8px;
        }
        
        .pims-preloader-text {
            font-size: 1.1rem;
        }
        
        .pims-three-dots {
            margin-bottom: 20px;
        }
    }
</style>

<script>
    // Professional Preloader Controller with enhanced features
    (function() {
        const preloader = document.getElementById('pimsPreloader');
        let isActive = false;
        let clickHandler = null;
        let backButtonTimer = null;
        let minimumShowTime = 300; // Minimum show time in ms
        let backButtonTimeout = 2000; // 2 seconds for back button
        
        // Create ripple effect on click
        function createRipple(event) {
            const ripple = document.createElement('span');
            ripple.classList.add('pims-ripple-effect');
            
            const rect = preloader.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            preloader.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        }
        
        // Show preloader
        function show() {
            if (isActive) return;
            
            clearTimeout(backButtonTimer);
            preloader.classList.add('active');
            isActive = true;
            
            // Add click handler
            clickHandler = function(e) {
                createRipple(e);
                hide();
                
                // Cancel any ongoing navigation
                if (typeof window.stop === 'function') {
                    window.stop();
                }
            };
            
            preloader.addEventListener('click', clickHandler);
        }
        
        // Hide preloader
        function hide() {
            if (!isActive) return;
            
            clearTimeout(backButtonTimer);
            
            // Remove click handler first
            if (clickHandler) {
                preloader.removeEventListener('click', clickHandler);
                clickHandler = null;
            }
            
            // Ensure minimum show time
            setTimeout(() => {
                preloader.classList.remove('active');
                isActive = false;
            }, minimumShowTime);
        }
        
        // Handle back/forward navigation
        window.addEventListener('popstate', function() {
            if (isActive) {
                // Hide after 2 seconds if still active
                backButtonTimer = setTimeout(hide, backButtonTimeout);
            }
        });
        
        // Handle page load completion
        window.addEventListener('load', function() {
            hide();
        });
        
        // Handle DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide if still showing
            if (isActive) {
                hide();
            }
            
            // Handle link clicks
            document.addEventListener('click', function(e) {
                let target = e.target;
                while (target && target !== document) {
                    if (target.tagName === 'A' && target.href && !target.href.startsWith('javascript:') && target.href !== '#') {
                        // Skip submenu toggles and non-navigation links
                        if (!target.closest('.pims-has-submenu') || 
                            (window.innerWidth <= 1024 || document.getElementById('pimsSidebar')?.classList.contains('pims-collapsed'))) {
                            
                            e.preventDefault();
                            show();
                            
                            // Allow a small delay for the preloader to appear
                            setTimeout(() => {
                                window.location.href = target.href;
                            }, 50);
                        }
                    }
                    target = target.parentNode;
                }
            }, true);
        });
        
        // Handle Livewire if present
        if (typeof Livewire !== 'undefined') {
            Livewire.hook('message.sent', () => {
                show();
            });
            
            Livewire.hook('message.processed', () => {
                hide();
            });
        }
        
        // Expose public API
        window.PimsPreloader = {
            show: show,
            hide: hide,
            isActive: () => isActive
        };
    })();
</script>