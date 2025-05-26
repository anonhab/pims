<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Appointment Management</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pims-primary: #0a192f; /* Navy blue */
            --pims-secondary: #172a45; /* Darker navy */
            --pims-accent: #64ffda; /* Teal accent */
            --pims-danger: #ff5555; /* Vibrant red */
            --pims-success: #50fa7b; /* Vibrant green */
            --pims-warning: #ffb86c; /* Soft orange */
            --pims-info: #8be9fd; /* Light blue */
            --pims-text-light: #f8f8f2; /* Off white */
            --pims-text-dark: #282a36; /* Dark gray */
            --pims-card-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --pims-border-radius: 8px;
            --pims-nav-height: 70px;
            --pims-sidebar-width: 280px;
            --pims-transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-text-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            line-height: 1.6;
        }

        /* Main Content Area */
        #pims-page-content {
            margin-left: 0;
            padding: 2rem;
            padding-left: calc(var(--pims-sidebar-width) + 2rem);
            min-height: calc(100vh - var(--pims-nav-height));
            transition: var(--pims-transition);
            background-color: #f5f7fa;
            padding-top: 70px;
        }

        /* Section Title */
        .pims-section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--pims-primary);
            position: relative;
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }

        .pims-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--pims-accent);
            border-radius: 2px;
        }

        .pims-section-title i {
            margin-right: 12px;
            color: var(--pims-accent);
            background: rgba(100, 255, 218, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Form Card Styles */
        .pims-form-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: var(--pims-transition);
            border-left: 4px solid var(--pims-accent);
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
        }

        .pims-form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        /* Form Elements */
        .pims-form-group {
            margin-bottom: 1.5rem;
        }

        .pims-form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--pims-secondary);
            font-size: 0.95rem;
        }

        .pims-form-input,
        .pims-form-select,
        .pims-form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
            font-size: 0.9rem;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .pims-form-input:focus,
        .pims-form-select:focus,
        .pims-form-textarea:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.2);
        }

        .pims-form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Button Styles */
        .pims-btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: var(--pims-primary);
            font-weight: 700;
        }

        .pims-btn-primary:hover {
            background-color: #52e8ca;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(100, 255, 218, 0.3);
        }

        /* Grid Layout */
        .pims-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* Form Actions */
        .pims-form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        /* Input with Icon */
        .pims-input-with-icon {
            position: relative;
        }

        .pims-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-accent);
        }

        .pims-input-with-icon .pims-form-input {
            padding-left: 2.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .pims-form-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        @media (max-width: 992px) {
            #pims-page-content {
                padding-left: 2rem;
            }
        }

        @media (max-width: 768px) {
            .pims-form-grid {
                grid-template-columns: 1fr;
            }

            .pims-section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    @include('components.preloader')

    <!-- Navigation -->
    @include('includes.nav')

    <!-- Sidebar -->
    @include('medical_officer.menu')

    <!-- Main Content -->
    <div id="pims-page-content">
        <h1 class="pims-section-title">
            <i class="fas fa-calendar-plus"></i> Appointment Management
        </h1>

        <!-- Notifications -->
        @if(session('success'))
            <div class="pims-notification pims-notification-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="pims-notification pims-notification-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <div class="pims-form-card">
            <form method="POST" action="{{ route('appointments.store') }}" id="pims-appointment-form">
                @csrf
                <div class="pims-form-grid">
                    <!-- Prisoner Selection -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Prisoner</label>
                        <select name="prisoner_id" class="pims-form-input" required>
                            <option value="">-- Select Prisoner --</option>
                            @foreach($prisoners as $prisoner)
                                <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }} {{ $prisoner->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Doctor Information -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Doctor</label>
                        <div class="pims-input-with-icon">
                            <span class="pims-input-icon">
                                <i class="fas fa-user-md"></i>
                            </span>
                            <input class="pims-form-input" type="text" value="{{ session('first_name') }} {{ session('last_name') }}" disabled>
                            <input type="hidden" name="doctor_id" value="{{ session('user_id') }}">
                        </div>
                    </div>

                    <!-- Appointment Date -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Appointment Date</label>
                        <input type="datetime-local" name="appointment_date" class="pims-form-input" required>
                    </div>

                    <!-- Status Selection -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Status</label>
                        <select name="status" class="pims-form-input" required>
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Diagnosis Textarea -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Diagnosis</label>
                        <textarea class="pims-form-textarea" name="diagnosis"></textarea>
                    </div>

                    <!-- Treatment Textarea -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Treatment</label>
                        <textarea class="pims-form-textarea" name="treatment"></textarea>
                    </div>
                </div>

                <!-- Form Submit Button -->
                <div class="pims-form-actions">
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save"></i> Save Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('includes.footer_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Form Validation
            document.getElementById("pims-appointment-form").addEventListener("submit", function(event) {
                let form = event.target;
                let status = form.querySelector('[name="status"]').value;
                let appointmentDate = new Date(form.querySelector('[name="appointment_date"]').value);
                let now = new Date();

                // Check if appointment date is today or in the future
                if (appointmentDate < now) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Date',
                        text: 'Appointment date must be today or in the future.',
                        confirmButtonColor: '#64ffda'
                    });
                    event.preventDefault();
                    return;
                }

                // Check if status is valid
                if (!['scheduled', 'completed', 'cancelled'].includes(status)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Status',
                        text: 'Status must be one of scheduled, completed, or cancelled.',
                        confirmButtonColor: '#64ffda'
                    });
                    event.preventDefault();
                    return;
                }
            });

            // Google Analytics
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-4TVE6RNN41');
        });
    </script>
</body>
</html>