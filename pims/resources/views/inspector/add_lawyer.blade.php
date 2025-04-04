<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Lawyer Registration</title>
    
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
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-card-body {
            padding: 1.25rem;
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
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
            font-family: inherit;
            font-size: 0.95rem;
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        /* Button Styles */
        .pims-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.9rem;
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

        .pims-btn-light {
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
        }

        .pims-btn-light:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Section Styles */
        .pims-section {
            padding: 1.5rem;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 1.5rem;
        }

        .pims-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-divider {
            height: 1px;
            background-color: rgba(0, 0, 0, 0.1);
            margin: 1.25rem 0;
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

            .pims-form-columns {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('inspector.menu')

        <div class="pims-content-area">
            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-user-tie"></i> Lawyer Registration
                    </h2>
                </div>
                
                <div class="pims-card-body">
                    <form method="POST" action="{{ route('lawyers.lstore') }}" enctype="multipart/form-data" class="pims-form">
                        @csrf

                        <div class="pims-form-columns" style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
                            <!-- Left Column -->
                            <div class="pims-form-column" style="flex: 1; min-width: 300px;">
                                <div class="pims-form-group">
                                    <label class="pims-form-label">First Name</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="text" name="first_name" placeholder="Enter first name" required>
                                    </div>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Last Name</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="text" name="last_name" placeholder="Enter last name" required>
                                    </div>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Date of Birth</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="date" name="date_of_birth" required>
                                    </div>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Contact Information</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="text" name="contact_info" placeholder="Phone number" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="pims-form-column" style="flex: 1; min-width: 300px;">
                                <div class="pims-form-group">
                                    <label class="pims-form-label">Email Address</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="email" name="email" placeholder="Enter email address" required>
                                    </div>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Password</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="password" name="password" placeholder="Enter password" required>
                                    </div>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">License Number</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="text" name="license_number" placeholder="Enter license number" required>
                                    </div>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Law Firm</label>
                                    <div class="control">
                                        <input class="pims-form-control" type="text" name="law_firm" placeholder="Enter law firm name">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Full Width Fields -->
                        <div class="pims-form-group">
                            <label class="pims-form-label">Profile Image</label>
                            <div class="control">
                                <input class="pims-form-control" type="file" name="profile_image" accept="image/*" required>
                                <small class="pims-form-help">Accepted formats: JPG, PNG, GIF. Max size: 2MB</small>
                            </div>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Cases Handled</label>
                            <div class="control">
                                <input class="pims-form-control" type="number" name="cases_handled" placeholder="Enter number of cases handled" required>
                            </div>
                        </div>

                        <input type="hidden" name="prison" value="{{ session('prison_id') }}">

                        <!-- Form Actions -->
                        <div class="pims-form-actions" style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                            <button class="pims-btn pims-btn-light" type="reset">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button class="pims-btn pims-btn-primary" type="submit">
                                <i class="fas fa-save"></i> Register Lawyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation can be added here
            const form = document.querySelector('.pims-form');
            
            form.addEventListener('submit', function(e) {
                // Add any client-side validation if needed
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>