<style>
    /* Preloader Container */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(26, 32, 44, 0.98); /* Darker background */
        backdrop-filter: blur(10px);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        
        transition: opacity 0.5s ease, visibility 0.5s;
        visibility: hidden;
    }

    #preloader.active {
        opacity: 1;
        visibility: visible;
    }

    /* Preloader Content */
    .preloader-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2rem;
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    /* Spinner */
    .preloader-spinner {
        position: relative;
        width: 120px;
        height: 120px;
    }

    .preloader-spinner-outer {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 8px solid transparent;
        border-top-color: rgba(211, 84, 0, 0.8); /* Orange main color */
        border-radius: 50%;
        animation: spin 1.8s linear infinite;
        box-shadow: 0 0 25px rgba(211, 84, 0, 0.3); /* Orange glow */
    }

    .preloader-spinner-middle {
        position: absolute;
        width: 80px;
        height: 80px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 6px solid transparent;
        border-top-color: rgba(211, 84, 0, 0.6); /* Orange with less opacity */
        border-radius: 50%;
        animation: spinReverse 1.5s linear infinite;
    }

    .preloader-spinner-inner {
        position: absolute;
        width: 50px;
        height: 50px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 4px solid transparent;
        border-top-color: rgba(211, 84, 0, 1); /* Solid orange */
        border-radius: 50%;
        animation: spin 1.2s linear infinite;
    }

    .preloader-spinner-dot {
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #d35400; /* Solid orange */
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(211, 84, 0, 0.8); /* Orange glow */
    }

    /* Text */
    .preloader-text {
        text-align: center;
    }

    .preloader-text-main {
        font-size: 1.75rem;
        font-weight: 600;
        background: linear-gradient(90deg, #d35400, #f8f8f2, #d35400); /* Orange gradient */
        background-size: 200% auto;
        color: transparent;
        background-clip: text;
        -webkit-background-clip: text;
        animation: textShine 3s linear infinite;
        margin-bottom: 0.5rem;
    }

    .preloader-text-sub {
        font-size: 1rem;
        color: rgba(248, 248, 242, 0.7);
        letter-spacing: 0.05em;
    }

    /* Progress Bar */
    .preloader-progress {
        width: 300px;
        height: 6px;
        background-color: rgba(40, 40, 40, 0.5); /* Darker track */
        border-radius: 3px;
        overflow: hidden;
        margin-top: 1rem;
    }

    .preloader-progress-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #d35400, #e67e22); /* Orange gradient */
        border-radius: 3px;
        box-shadow: 0 0 15px rgba(211, 84, 0, 0.6); /* Orange glow */
        transition: width 0.3s ease;
    }

    /* Animations */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes spinReverse {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(-360deg); }
    }

    @keyframes textShine {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }
</style>

<div id="preloader">
    <div class="preloader-content">
        <!-- Spinner -->
        <div class="preloader-spinner">
            <div class="preloader-spinner-outer"></div>
            <div class="preloader-spinner-middle"></div>
            <div class="preloader-spinner-inner"></div>
            <div class="preloader-spinner-dot"></div>
        </div>
        
        <!-- Text -->
        <div class="preloader-text">
            <div class="preloader-text-main">Loading PIMS System</div>
        </div>
        
        <!-- Progress Bar -->
        <div class="preloader-progress">
            <div class="preloader-progress-fill"></div>
        </div>
    </div>
</div>

<script>
    // Update progress bar
    const progressFill = document.querySelector('.preloader-progress-fill');
    let progress = 0;
    const progressInterval = setInterval(() => {
        progress += Math.random() * 10;
        if (progress > 100) progress = 100;
        progressFill.style.width = `${progress}%`;
        
        if (progress === 100) {
            clearInterval(progressInterval);
        }
    }, 300);
</script>