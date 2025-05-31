<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Job Management</title>
    
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
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background-color: var(--pims-secondary);
            color: white;
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
        }

        .pims-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: white;
        }

        .pims-card-body {
            padding: 1.5rem;
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
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
        }

        .pims-form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1em;
        }

        .pims-form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Button Styles */
        .pims-btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

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
            background-color: #2472a4;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-secondary {
            background-color: #ecf0f1;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #d5dbdb;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Grid Layout */
        .pims-form-columns {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .pims-form-column {
            flex: 1;
        }

        /* Page Header */
        .pims-page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .pims-page-title {
            font-size: 1.75rem;
            color: var(--pims-primary);
            margin-bottom: 0.5rem;
        }

        /* Modal Styles */
        .pims-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            
            visibility: hidden;
            transition: var(--pims-transition);
        }

        .pims-modal-active {
            opacity: 1;
            visibility: visible;
        }

        .pims-modal-content {
            background-color: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: var(--pims-transition);
        }

        .pims-modal-active .pims-modal-content {
            transform: translateY(0);
        }

        .pims-modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #7f8c8d;
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
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
        @include('training_officer.menu')

        <div class="pims-content-area">
            <!-- Success Notification -->
            @if(session('success'))
                <div class="pims-notification pims-notification-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="pims-page-header">
                <h1 class="pims-page-title">
                    <i class="fas fa-briefcase"></i> Job Management
                </h1>
            </div>

            <form method="POST" action="{{ route('job.assign') }}">
                @csrf
                <div class="pims-form-columns">
                    <!-- Job Information -->
                    <div class="pims-form-column">
                        <div class="pims-card">
                            <header class="pims-card-header">
                                <h2 class="pims-card-title">Job Information</h2>
                            </header>
                            <div class="pims-card-body">
                                <div class="pims-form-group">
                                    <label class="pims-form-label">Prisoner</label>
                                    <select class="pims-form-control pims-form-select" name="prisoner_id" required>
                                        <option value="">Select Prisoner</option>
                                        @foreach($prisoners as $prisoner)
                                            <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Job Title</label>
                                    <select class="pims-form-control pims-form-select" name="job_title" required>
                                        <option value="">Select Job Title</option>
                                        <option value="Cleaner">Cleaner</option>
                                        <option value="Cook">Cook</option>
                                        <option value="Gardener">Gardener</option>
                                        <option value="Maintenance Worker">Maintenance Worker</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Assignment Details -->
                    <div class="pims-form-column">
                        <div class="pims-card">
                            <header class="pims-card-header">
                                <h2 class="pims-card-title">Assignment Details</h2>
                            </header>
                            <div class="pims-card-body">
                                <div class="pims-form-group">
                                    <label class="pims-form-label">Assignment Date</label>
                                    <input class="pims-form-control" type="date" name="assigned_date" required>
                                </div>
                                <div class="pims-form-group">
                                    <label class="pims-form-label">End Date</label>
                                    <input class="pims-form-control" type="date" name="end_date" required>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Job Description</label>
                                    <textarea class="pims-form-control pims-form-textarea" name="job_description" placeholder="Enter job description or details about the job assignment"></textarea>
                                </div>

                                <div class="pims-form-group">
                                    <label class="pims-form-label">Status</label>
                                    <select class="pims-form-control pims-form-select" name="status" required>
                                        <option value="active">Active</option>
                                        <option value="completed">Completed</option>
                                        <option value="terminated">Terminated</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit and Reset Button -->
                <div class="pims-btn-group">
                    <button type="reset" class="pims-btn pims-btn-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                </div>
            </form>

            <!-- Confirmation Modal -->
            <div class="pims-modal" id="pims-confirmation-modal">
                <div class="pims-modal-content">
                    <header class="pims-modal-header">
                        <h3 class="pims-modal-title">Confirm Job Assignment</h3>
                        <button class="pims-modal-close" onclick="closeModal()">&times;</button>
                    </header>
                    <div class="pims-modal-body">
                        <p>Are you sure you want to assign this job to the selected prisoner?</p>
                    </div>
                    <footer class="pims-modal-footer">
                        <button class="pims-btn pims-btn-secondary" onclick="closeModal()">Cancel</button>
                        <button class="pims-btn pims-btn-primary" id="pims-confirm-submit">Confirm</button>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        // Form submission with confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const confirmModal = document.getElementById('pims-confirmation-modal');
            const confirmSubmit = document.getElementById('pims-confirm-submit');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                openModal();
            });
            
            confirmSubmit.addEventListener('click', function() {
                form.submit();
            });
        });

        function openModal() {
            const modal = document.getElementById('pims-confirmation-modal');
            modal.classList.add('pims-modal-active');
        }

        function closeModal() {
            const modal = document.getElementById('pims-confirmation-modal');
            modal.classList.remove('pims-modal-active');
        }
    </script>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const assignedDateInput = document.querySelector('input[name="assigned_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');
        const form = assignedDateInput.closest('form');

        form.addEventListener('submit', function (e) {
            const assignedDate = new Date(assignedDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (assignedDate && endDate && assignedDate >= endDate) {
                e.preventDefault();
                alert("Assigned Date must be earlier than End Date.");
            }
        });
    });
</script>
</body>
</html>