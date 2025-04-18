<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Visitor Request</title>
    
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

        .pims-content-area {
            flex: 1;
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
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

        .pims-card-header {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-card-body {
            padding: 1.25rem;
        }

        .pims-card-footer {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Form Styles */
        .pims-form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .pims-form-title {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--pims-primary);
            font-size: 1.75rem;
            font-weight: 600;
        }

        .pims-form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 1.25rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .pims-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-primary);
        }

        .pims-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 0.95rem;
            transition: var(--pims-transition);
        }

        .pims-input:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .pims-select {
            position: relative;
            width: 100%;
        }

        .pims-select select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 0.95rem;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1em;
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
            font-size: 0.95rem;
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
        }

        .pims-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Notification Styles */
        .pims-notification {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .pims-notification-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-notification-danger {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('visitor.menu')

        <div class="pims-content-area">
            <!-- Flash Messages -->
            @foreach (['success', 'error', 'warning', 'info'] as $msg)
                @if(session($msg))
                <div class="pims-notification pims-notification-{{ $msg === 'success' ? 'success' : ($msg === 'error' ? 'danger' : ($msg === 'warning' ? 'warning' : 'info')) }}">
                    {{ session($msg) }}
                </div>
                @endif
            @endforeach

            <div class="pims-form-container">
                <h1 class="pims-form-title">
                    <i class="fas fa-calendar-plus"></i> Request Visiting Time
                </h1>

                <form method="POST" action="{{ route('visitor.submitRequest') }}">
                    @csrf
                    <div class="pims-card">
                        <div class="pims-card-body">
                            <h2 class="pims-form-section-title">
                                <i class="fas fa-user-shield"></i> Prisoner Information
                            </h2>

                            <div class="pims-form-grid">
                                <div class="pims-form-group">
                                    <label class="pims-label">Prisoner First Name</label>
                                    <input class="pims-input" type="text" name="prisoner_firstname" placeholder="First Name" required>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-label">Prisoner Middle Name</label>
                                    <input class="pims-input" type="text" name="prisoner_middlename" placeholder="Middle Name" required>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-label">Prisoner Last Name</label>
                                    <input class="pims-input" type="text" name="prisoner_lastname" placeholder="Last Name" required>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-label">Select Prison</label>
                                    <div class="pims-select">
                                        <select name="prison_id" required>
                                            <option value="">-- Select Prison --</option>
                                            @foreach($prisons as $prison)
                                                <option value="{{ $prison->id }}">{{ $prison->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-label">Requested Visiting Date</label>
                                    <input class="pims-input" type="date" name="requested_date" required>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-label">Requested Visiting Time</label>
                                    <input class="pims-input" type="time" name="requested_time" required>
                                </div>
                            </div>
                        </div>

                        <div class="pims-card-footer">
                            <button type="reset" class="pims-btn pims-btn-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="pims-btn pims-btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit Request
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation could be added here
            console.log('Visitor request form loaded');
        });
    </script>
</body>
</html>