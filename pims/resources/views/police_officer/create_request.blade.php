<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Request Management</title>
    
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

        /* Header Styles */
        .pims-content-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .pims-content-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
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
            font-size: 0.95rem;
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .pims-textarea {
            min-height: 120px;
            resize: vertical;
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

        /* Button Styles */
        .pims-btn {
            padding: 0.6rem 1.25rem;
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

        .pims-btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        /* Notification Styles */
        .pims-notification {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .pims-notification-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        /* Grid Layout */
        .pims-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Hidden Fields */
        .pims-hidden {
            display: none;
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

            .pims-form-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Modal Styles */
        .pims-modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pims-modal.is-active {
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }

        .pims-modal-card {
            background: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .pims-modal.is-active .pims-modal-card {
            transform: translateY(0);
        }

        .pims-modal-card-head {
            padding: 1.25rem;
            background-color: var(--pims-primary);
            color: white;
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.2s ease;
            line-height: 1;
        }

        .pims-modal-close:hover {
            transform: rotate(90deg);
        }

        .pims-modal-card-body {
            padding: 1.5rem;
            overflow-y: auto;
        }

        .pims-modal-card-foot {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('police_officer.menu')

        <div class="pims-content-area">
            <div class="pims-content-header">
                <h1 class="pims-content-title">
                    <i class="fas fa-clipboard-list"></i> Request Management
                </h1>
            </div>

            <!-- Success Notification -->
            @if(session('success'))
            <div class="pims-notification pims-notification-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            <!-- Request Form -->
            <form method="POST" action="{{ route('requestsfrompolice.store') }}">
                @csrf
                <div class="pims-form-grid">
                    <!-- Request Information Card -->
                    <div class="pims-card">
                        <div class="pims-card-header">
                            <h2 class="pims-card-title">
                                <i class="fas fa-info-circle"></i> Request Information
                            </h2>
                        </div>
                        <div class="pims-card-body">
                            <!-- Prisoner Selection -->
                            <div class="pims-form-group">
                                <label class="pims-form-label">Prisoner</label>
                                <div class="pims-select">
                                    <select name="prisoner_id" class="pims-form-control" required>
                                        <option value="">Select Prisoner</option>
                                        @foreach ($prisoners as $prisoner)
                                        <option value="{{ $prisoner->id }}">
                                            {{ $prisoner->first_name }} {{ $prisoner->last_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Request Type -->
                            <div class="pims-form-group">
                                <label class="pims-form-label">Request Type</label>
                                <div class="pims-select">
                                    <select name="request_type" id="pims-request-type" class="pims-form-control" required>
                                        <option value="" disabled selected>Select a Request Type</option>
                                        <option value="case_review">Case Review Request</option>
                                        <option value="medical_assistance">Medical Assistance Request</option>
                                        <option value="prison_transfer">Prison Transfer Request</option>
                                        <option value="appeal_filing">Appeal Filing Request</option>
                                        <option value="visitation_approval">Visitation Approval Request</option>
                                        <option value="human_rights_violation">Report Human Rights Violation</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Hidden Fields -->
                            <input type="hidden" class="pims-hidden" name="approved_by">
                            <input type="hidden" name="status" value="pending">
                        </div>
                    </div>

                    <!-- Request Details Card -->
                    <div class="pims-card">
                        <div class="pims-card-header">
                            <h2 class="pims-card-title">
                                <i class="fas fa-align-left"></i> Request Details
                            </h2>
                        </div>
                        <div class="pims-card-body">
                            <div class="pims-form-group">
                                <label class="pims-form-label">Request Description</label>
                                <textarea class="pims-form-control pims-textarea" name="request_details" 
                                          placeholder="Provide details about the request" required></textarea>
                            </div>

                            <!-- Hidden Requester IDs -->
                            <input type="hidden" name="lawyer_id" value="{{ session('lawyer_id') }}">
                            <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                        </div>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="pims-btn-group">
                    <button class="pims-btn pims-btn-secondary" type="reset">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                    <button class="pims-btn pims-btn-primary" type="submit">
                        <i class="fas fa-paper-plane"></i> Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="pims-modal" id="pims-confirmation-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-check-circle"></i> Confirm Submission
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <p>Are you sure you want to submit this request? Please review all information before proceeding.</p>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary pims-close-modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button id="pims-confirm-submit" class="pims-btn pims-btn-primary">
                    <i class="fas fa-check"></i> Confirm
                </button>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission confirmation
            const form = document.querySelector('form');
            const confirmModal = document.getElementById('pims-confirmation-modal');
            const confirmSubmitBtn = document.getElementById('pims-confirm-submit');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                confirmModal.classList.add('is-active');
            });
            
            confirmSubmitBtn.addEventListener('click', function() {
                form.submit();
            });
            
            // Close modal functionality
            document.querySelectorAll('.pims-modal-close, .pims-modal-background, .pims-close-modal').forEach(element => {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.pims-modal').forEach(modal => {
                        modal.classList.remove('is-active');
                    });
                });
            });
            
            // Request type change handler
            const requestTypeSelect = document.getElementById('pims-request-type');
            requestTypeSelect.addEventListener('change', function() {
                // You can add dynamic behavior here based on request type
                console.log('Request type changed to:', this.value);
            });
        });
    </script>
</body>
</html>