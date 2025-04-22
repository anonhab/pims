<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        }

        /* Main Content Styles */
        .pims-content-container {
            margin-left: var(--pims-sidebar-width);
            padding: 2rem;
            padding-top:70px;
            min-height: 100vh;
            background-color: #f5f7fa;
            transition: all 0.3s ease;
        }

        .pims-content-header {
            margin-bottom: 2rem;
        }

        .pims-title {
            color: var(--pims-primary);
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .pims-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--pims-accent);
            border-radius: 2px;
        }

        /* Form Card Styles */
        .pims-form-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pims-form-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
        .pims-form-select select,
        .pims-form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: all 0.3s ease;
            font-size: 1rem;
            background-color: #fff;
        }

        .pims-form-input:focus,
        .pims-form-select select:focus,
        .pims-form-textarea:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .pims-form-select {
            position: relative;
            display: block;
        }

        .pims-form-select::after {
            border-color: var(--pims-accent);
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
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: #2472a4;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-icon {
            margin-right: 0.5rem;
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
            color: var(--pims-secondary);
        }

        .pims-input-with-icon .pims-form-input {
            padding-left: 2.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-content-container {
                margin-left: 0;
                padding: 1.5rem;
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
    
    <div class="pims-app-container" id="pimsAppContainer">
        @include('medical_officer.menu')

        <div class="pims-content-container" id="pimsPageContent">
            <div class="pims-content-header">
                <h1 class="pims-title">Appointment Management</h1>
            </div>

            <section class="pims-section">
                <div class="pims-container">
                    <form method="POST" action="{{ route('appointments.store') }}" class="pims-form-card" id="pimsAppointmentForm">
                        @csrf
                        <div class="pims-form-grid">
                            <!-- Prisoner Selection -->
                            <div class="pims-form-group">
                                <label class="pims-form-label">Prisoner</label>
                                <div class="pims-form-select">
                                    <select name="prisoner_id" class="pims-form-input" required>
                                        <option value="">-- Select Prisoner --</option>
                                        @foreach($prisoners as $prisoner)
                                            <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }} {{ $prisoner->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                <div class="pims-form-select">
                                    <select name="status" class="pims-form-input" required>
                                        <option value="scheduled">Scheduled</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
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
                                <span class="pims-btn-icon"><i class="fas fa-save"></i></span>
                                <span>Save Appointment</span>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4TVE6RNN41"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-4TVE6RNN41');

        // Form Validation
        document.getElementById("pimsAppointmentForm").addEventListener("submit", function(event) {
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
                    confirmButtonColor: var(--pims-accent)
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
                    confirmButtonColor: var(--pims-accent)
                });
                event.preventDefault();
                return;
            }
        });
    </script>

    @include('includes.footer_js')
</body>
</html>