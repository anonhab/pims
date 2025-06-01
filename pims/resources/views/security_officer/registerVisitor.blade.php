<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <title>Prison Information Management System - Visitor Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pims-primary: #2c3e50;
            --pims-secondary: #34495e;
            --pims-accent: #3498db;
            --pims-light: #ecf0f1;
            --pims-lighter: #f8f9fa;
            --pims-danger: #e74c3c;
            --pims-success: #2ecc71;
            --pims-warning: #f39c12;
            --pims-border-radius: 8px;
            --pims-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
        }

        /* Main Layout */
        .pims-app-container {
            padding-top: 70px;
            display: flex;
            min-height: 100vh;
        }

        .pims-main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 250px;
            transition: var(--pims-transition);
        }

        .pims-content-container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Form Card */
        .pims-form-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .pims-form-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            text-align: center;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .pims-form-title i {
            color: var(--pims-accent);
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.5rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        /* Button Styles */
        .pims-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-size: 1rem;
            gap: 0.5rem;
        }

        .pims-btn i {
            font-size: 0.9em;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .pims-form-actions {
            display: flex;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
            margin-top: 2rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
             .pims9-app-container{
                padding-left:70px;
            }
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
             .pims-app-container{
                padding-left:70px;
            }
            .pims-form-card {
                padding: 1.5rem;
            }
            
            .pims-form-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
             .pims-app-container{
                padding-left:70px;
            }
            .pims-form-card {
                padding: 1rem;
            }
            
            .pims-form-actions {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .pims-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
     @include('includes.nav')
        
        <!-- Sidebar -->
        @include('security_officer.menu')
    <div class="pims-app-container">
        <!-- Navigation -->
       
        
        <main class="pims-main-content">
            <div class="pims-content-container">
                <!-- Registration Form Card -->
                <div class="pims-form-card">
                    <h1 class="pims-form-title">
                        <i class="fas fa-user-plus"></i> Visitor Registration
                    </h1>
                    
                    <form action="{{ route('visitor.register.submit') }}" method="POST" class="pims-form">
                        @csrf

                        <div class="pims-form-group">
                            <label for="pims-first-name" class="pims-form-label">First Name</label>
                            <input type="text" id="pims-first-name" name="first_name" required class="pims-form-control">
                        </div>

                        <div class="pims-form-group">
                            <label for="pims-last-name" class="pims-form-label">Last Name</label>
                            <input type="text" id="pims-last-name" name="last_name" required class="pims-form-control">
                        </div>

                        <div class="pims-form-group">
                            <label for="pims-phone-number" class="pims-form-label">Phone Number</label>
                            <input type="text" id="pims-phone-number" name="phone_number" required class="pims-form-control">
                        </div>

                        <div class="pims-form-group">
                            <label for="pims-relationship" class="pims-form-label">Relationship</label>
                            <input type="text" id="pims-relationship" name="relationship" required class="pims-form-control">
                        </div>

                        <div class="pims-form-group">
                            <label for="pims-address" class="pims-form-label">Address</label>
                            <input type="text" id="pims-address" name="address" required class="pims-form-control">
                        </div>

                        <div class="pims-form-group">
                            <label for="pims-id-number" class="pims-form-label">ID Number</label>
                            <input type="text" id="pims-id-number" name="identification_number" required class="pims-form-control">
                        </div>

                        <div class="pims-form-group">
                            <label for="pims-email" class="pims-form-label">Email</label>
                            <input type="email" id="pims-email" name="email" required class="pims-form-control">
                        </div>

                        <div class="pims-form-group">
                            <label for="pims-password" class="pims-form-label">Password</label>
                            <input type="password" id="pims-password" name="password" required class="pims-form-control">
                        </div>

                        <div class="pims-form-actions">
                            <button type="submit" class="pims-btn pims-btn-primary">
                                <i class="fas fa-user-plus"></i> Register Visitor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    @include('includes.footer_js')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation can be added here
            const form = document.querySelector('.pims-form');
            
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Add validation logic here
                    // Example: Check if passwords match, etc.
                });
            }
        });
    </script>
</body>
</html>