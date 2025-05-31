<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Add New Prison</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pims-primary: #1a2a3a;
            --pims-secondary: #2c3e50;
            --pims-accent: #2980b9;
            --pims-danger: #c0392b;
            --pims-success: #27ae60;
            --pims-warning: #d35400;
            --pims-text-light: #ecf0f1;
            --pims-text-dark: #2c3e50;
            --pims-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            --pims-border-radius: 6px;
            --pims-nav-height: 60px;
            --pims-sidebar-width: 250px;
            --pims-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
            line-height: 1.6;
        }

        /* Layout Structure */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--pims-nav-height);
        }

        .pims-sidebar {
            width: var(--pims-sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: var(--pims-nav-height);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 900;
            transition: var(--pims-transition);
        }

        .pims-content-area {
            flex: 1;
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        /* Form Container */
        .pims-form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Card Styles */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 1.5rem;
            transition: var(--pims-transition);
            border-left: 4px solid var(--pims-accent);
        }

        .pims-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-card-header {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pims-card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.5rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
            font-size: 1rem;
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .pims-select {
            width: 100%;
            position: relative;
        }

        .pims-select select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            background-color: white;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%232c3e50' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
        }

        .pims-select select:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        /* Button Styles */
        .pims-btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            font-size: 1rem;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: var(--pims-primary);
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-secondary {
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
            border: 1px solid #ddd;
        }

        .pims-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-form-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-sidebar {
                transform: translateX(-100%);
            }

            .pims-sidebar.is-active {
                transform: translateX(0);
            }

            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-form-container {
                padding: 0 1rem;
            }

            .pims-form-actions {
                flex-direction: column;
                align-items: center;
            }

            .pims-btn {
                width: 100%;
            }
        }

        /* Notification Styles */
        .pims-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 15px 20px;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            transform: translateY(100px);
            
            transition: all 0.3s ease;
            z-index: 10000;
            max-width: 350px;
            border-left: 4px solid var(--pims-success);
        }

        .pims-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .pims-notification-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pims-notification-content i {
            font-size: 1.2rem;
            color: var(--pims-success);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('cadmin.menu')

        <div class="pims-content-area">
            <div class="pims-form-container">
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="pims-notification show">
                    <div class="pims-notification-content">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="pims-notification show" style="border-left-color: var(--pims-danger);">
                    <div class="pims-notification-content">
                        <i class="fas fa-exclamation-circle" style="color: var(--pims-danger);"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                </div>
                @endif

                <form action="{{ route('prison.store') }}" method="POST">
                    @csrf
                    <div class="pims-card">
                        <div class="pims-card-header">
                            <h1 class="pims-card-title">
                                <i class="fas fa-building"></i> Add New Prison Facility
                            </h1>
                        </div>
                        <div class="pims-card-body">
                            <div class="pims-form-group">
                                <label for="name" class="pims-form-label">Prison Name</label>
                                <input type="text" id="name" name="name" class="pims-form-control" 
                                       placeholder="Enter prison facility name" required>
                                <small class="pims-form-help">Enter the official name of the prison facility</small>
                            </div>

                            <div class="pims-form-group">
                                <label for="location" class="pims-form-label">Location</label>
                                <div class="pims-select">
    <select id="location" name="location" class="pims-form-control" required>
        <option value="">Select Location</option>

        <!-- Hadiya Zone -->
        <optgroup label="Hadiya Zone">
            <option value="Central Ethiopia, Hosaena">Hosaena (Capital)</option>
            <option value="Central Ethiopia, Shone">Shone</option>
            <option value="Central Ethiopia, Gimbichu">Gimbichu</option>
            <option value="Central Ethiopia, Homecho">Homecho</option>
        </optgroup>

        <!-- Kembata Tembaro Zone -->
        <optgroup label="Kembata Tembaro Zone">
            <option value="Central Ethiopia, Durame">Durame (Capital)</option>
            <option value="Central Ethiopia, Damboya">Damboya</option>
            <option value="Central Ethiopia, Angacha">Angacha</option>
            <option value="Central Ethiopia, Kedida Gamela">Kedida Gamela</option>
        </optgroup>

        <!-- Gurage Zone -->
        <optgroup label="Gurage Zone">
            <option value="Central Ethiopia, Butajira">Butajira (Major Town)</option>
            <option value="Central Ethiopia, Wolkite">Wolkite (Administrative Center)</option>
            <option value="Central Ethiopia, Emdibir">Emdibir</option>
            <option value="Central Ethiopia, Agenna">Agenna</option>
        </optgroup>

        <!-- Silte Zone -->
        <optgroup label="Silte Zone">
            <option value="Central Ethiopia, Worabe">Worabe (Capital)</option>
            <option value="Central Ethiopia, Kibet">Kibet</option>
            <option value="Central Ethiopia, Kutere">Kutere</option>
            <option value="Central Ethiopia, Qebena">Qebena</option>
        </optgroup>

        <!-- Halaba Zone -->
        <optgroup label="Halaba Zone">
            <option value="Central Ethiopia, Alaba Kulito">Alaba Kulito (Capital)</option>
            <option value="Central Ethiopia, Besheno">Besheno</option>
            <option value="Central Ethiopia, Dore Bafeno">Dore Bafeno</option>
        </optgroup>

        <!-- Special Woredas -->
        <optgroup label="Special Woredas">
            <option value="Central Ethiopia, Yem Special Woreda">Fofa (Yem Special Woreda Capital)</option>
            <option value="Central Ethiopia, Alaba Special Woreda">Alaba Kulito (Alaba Special)</option>
            <option value="Central Ethiopia, Siltie Special Woreda">Worabe (Silte Special)</option>
        </optgroup>
    </select>
</div>

                                <small class="pims-form-help">Select the region where the prison is located</small>
                            </div>

                            <div class="pims-form-group">
                                <label for="capacity" class="pims-form-label">Maximum Capacity</label>
                                <input type="number" id="capacity" name="capacity" class="pims-form-control" 
                                       placeholder="Enter maximum inmate capacity" required>
                                <small class="pims-form-help">Enter the total number of inmates the facility can hold</small>
                            </div>
                        </div>
                    </div>

                    <div class="pims-form-actions">
                        <button type="submit" class="pims-btn pims-btn-primary">
                            <i class="fas fa-save"></i> Save Prison Facility
                        </button>
                        <button type="reset" class="pims-btn pims-btn-secondary">
                            <i class="fas fa-undo"></i> Reset Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('includes.footer_js')
    <script>
        // Auto-hide notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.pims-notification');
            
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 5000);
            });

            // Focus on first input field
            const firstInput = document.querySelector('input[type="text"]');
            if (firstInput) {
                firstInput.focus();
            }
        });
    </script>
</body>
</html>