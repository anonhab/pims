<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | PIMS - Central Ethiopia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Error Page Specific Styles */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --text-color: #333;
            --text-light: #7f8c8d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f9f9f9;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .logo-text h1 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 0;
        }

        .logo-text span {
            font-size: 0.9rem;
            color: var(--text-light);
            display: block;
        }

        /* Error Content Styles */
        .error-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 0;
            text-align: center;
        }

        .error-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .error-icon {
            font-size: 5rem;
            color: var(--accent-color);
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 3rem;
            color: var(--dark-color);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .error-subtitle {
            font-size: 1.5rem;
            color: var(--text-light);
            margin-bottom: 30px;
            font-weight: 400;
        }

        .error-message {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-btns {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            background: var(--secondary-color);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-accent {
            background: var(--accent-color);
        }

        .btn-accent:hover {
            background: #c0392b;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-outline:hover {
            background: var(--secondary-color);
            color: white;
        }

        /* Footer Styles */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer-bottom {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        /* Animation */
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .error-icon {
            animation: floating 3s ease-in-out infinite;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .error-title {
                font-size: 2.5rem;
            }
            
            .error-subtitle {
                font-size: 1.2rem;
            }
            
            .error-btns {
                flex-direction: column;
                align-items: center;
            }
            
            .error-content {
                padding: 30px 20px;
            }
        }

        @media (max-width: 576px) {
            .error-title {
                font-size: 2rem;
            }
            
            .error-icon {
                font-size: 4rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
    @include('includes.nav')
    </header>

    <!-- Error Content -->
    <main class="error-container">
        <div class="container">
            <div class="error-content">
                <div class="error-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h1 class="error-title">404</h1>
                <h2 class="error-subtitle">Page Not Found</h2>
                <p class="error-message">
                    The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                    Please check the URL or navigate back to our homepage.
                </p>
                <div class="error-btns">
                    <a href="/" class="btn btn-accent">
                        <i class="fas fa-home"></i> Return Home
                    </a>
                    <a href="/contact" class="btn btn-outline">
                        <i class="fas fa-envelope"></i> Contact Support
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Prison Information Management System - Central Ethiopia. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple console message for debugging
        console.log('Error 404: The requested page was not found');
        
        // Track this error if you have analytics
        if (typeof ga !== 'undefined') {
            ga('send', 'event', 'Error', '404', window.location.pathname);
        }
    </script>
</body>

</html>