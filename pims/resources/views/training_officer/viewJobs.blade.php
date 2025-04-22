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
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
        }

        .pims-card-body {
            padding: 1.25rem;
        }

        .pims-card-footer {
            padding: 0.75rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
        }

        /* Filter Controls */
        .pims-card-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.02);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
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

        .pims-form-textarea {
            min-height: 120px;
            resize: vertical;
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
            background-color: #2472a4;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #a5281b;
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

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover {
            background-color: #219653;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Status Badge */
        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: var(--pims-border-radius);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pims-status-completed {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-status-terminated {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-status-active {
            background-color: var(--pims-warning);
            color: white;
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
            opacity: 0;
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
            max-width: 600px;
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

            .pims-grid {
                grid-template-columns: 1fr;
            }

            .pims-card-filter {
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

            <div class="pims-card">
                <div class="pims-card-filter">
                    <!-- Search and other controls -->
                    <div class="pims-form-group" style="flex-grow: 1;">
                        <div class="control has-icons-left">
                            <input class="pims-form-control" id="pims-table-search" type="text" placeholder="Search for jobs...">
                            <span class="icon is-left">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="pims-form-group">
                        <button class="pims-btn pims-btn-secondary" id="pims-table-reload">
                            <i class="fas fa-sync-alt"></i> Reload
                        </button>
                    </div>
                </div>

                <div class="pims-card-body">
                    <!-- Card Layout for Jobs -->
                    <div class="pims-grid">
                        @foreach($jobs as $job)
                        <div class="pims-job-card">
                            <div class="pims-card">
                                <header class="pims-card-header">
                                    <h3 class="pims-card-title">
                                        <i class="fas fa-briefcase"></i> {{ $job->job_title }}
                                    </h3>
                                </header>
                                <div class="pims-card-body">
                                    <div class="pims-content-text">
                                        <strong><i class="fas fa-id-card"></i> Prisoner ID:</strong> {{ $job->prisoner_id }}
                                    </div>
                                    <div class="pims-content-text">
                                        <strong><i class="fas fa-user-tie"></i> Assigned By:</strong> {{ $job->assigned_by }}
                                    </div>
                                    <div class="pims-content-text">
                                        <strong><i class="fas fa-align-left"></i> Description:</strong> 
                                        {{ Str::limit($job->job_description, 100) }}
                                    </div>
                                    <div class="pims-content-text">
                                        <strong><i class="fas fa-calendar-day"></i> Assigned Date:</strong> {{ $job->assigned_date }}
                                    </div>
                                    <div class="pims-content-text">
                                        <strong><i class="fas fa-info-circle"></i> Status:</strong>
                                        <span class="pims-status-badge pims-status-{{ $job->status }}">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                    </div>
                                    <div class="pims-meta-text">
                                        <small><i class="fas fa-clock"></i> Created: {{ $job->created_at->format('Y-m-d H:i') }}</small><br>
                                        <small><i class="fas fa-sync-alt"></i> Updated: {{ $job->updated_at->format('Y-m-d H:i') }}</small>
                                    </div>
                                </div>
                                <footer class="pims-card-footer">
                                    <button class="pims-btn pims-btn-primary pims-edit-button"
                                        data-id="{{ $job->id }}"
                                        data-job-title="{{ $job->job_title }}"
                                        data-prisoner-id="{{ $job->prisoner_id }}"
                                        data-assigned-by="{{ $job->assigned_by }}"
                                        data-job-description="{{ $job->job_description }}"
                                        data-assigned-date="{{ $job->assigned_date }}"
                                        data-status="{{ $job->status }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('jobs.destroyjob', $job->id) }}" method="POST" class="pims-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="pims-btn pims-btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </footer>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')

    <!-- Create Job Modal -->
    <div class="pims-modal" id="pims-create-record-modal">
        <div class="pims-modal-content">
            <header class="pims-modal-header">
                <h3 class="pims-modal-title"><i class="fas fa-plus-circle"></i> Create New Job</h3>
                <button class="pims-modal-close" id="pims-close-modal-button">&times;</button>
            </header>
            <section class="pims-modal-body">
                <form id="pims-create-record-form" action="{{ route('job.assign') }}" method="POST">
                    @csrf
                    <div class="pims-form-group">
                        <label class="pims-form-label">Job Title</label>
                        <input class="pims-form-control" type="text" name="job_title" placeholder="Enter job title" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Prisoner ID</label>
                        <input class="pims-form-control" type="text" name="prisoner_id" placeholder="Enter prisoner ID" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned By</label>
                        <input class="pims-form-control" type="text" name="assigned_by" placeholder="Enter assigned by" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Job Description</label>
                        <textarea class="pims-form-control pims-form-textarea" name="job_description" placeholder="Enter job description" required></textarea>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned Date</label>
                        <input class="pims-form-control" type="date" name="assigned_date" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Status</label>
                        <select class="pims-form-control" name="status" required>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>
                </form>
            </section>
            <footer class="pims-modal-footer">
                <button class="pims-btn pims-btn-secondary" id="pims-cancel-modal-button">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="pims-btn pims-btn-success" type="submit" form="pims-create-record-form">
                    <i class="fas fa-save"></i> Save Job
                </button>
            </footer>
        </div>
    </div>

    <!-- Edit Job Modal -->
    <div class="pims-modal" id="pims-edit-job-modal">
        <div class="pims-modal-content">
            <header class="pims-modal-header">
                <h3 class="pims-modal-title"><i class="fas fa-edit"></i> Edit Job</h3>
                <button class="pims-modal-close" id="pims-close-edit-modal-button">&times;</button>
            </header>
            <section class="pims-modal-body">
                <form id="pims-edit-job-form" method="POST" action="{{ route('jobs.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="job_id" id="pims-edit-job-id">

                    <div class="pims-form-group">
                        <label class="pims-form-label">Job Title</label>
                        <input class="pims-form-control" type="text" name="job_title" id="pims-edit-job-title" required>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Prisoner ID</label>
                        <input class="pims-form-control" type="text" name="prisoner_id" id="pims-edit-prisoner-id" required>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned By</label>
                        <input class="pims-form-control" type="text" name="assigned_by" id="pims-edit-assigned-by" value="{{ session('user_id') }}" readonly>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Job Description</label>
                        <textarea class="pims-form-control pims-form-textarea" name="job_description" id="pims-edit-job-description" required></textarea>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned Date</label>
                        <input class="pims-form-control" type="date" name="assigned_date" id="pims-edit-assigned-date" required>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Status</label>
                        <select class="pims-form-control" name="status" id="pims-edit-status" required>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>
                </form>
            </section>
            <footer class="pims-modal-footer">
                <button class="pims-btn pims-btn-secondary" id="pims-cancel-edit-modal-button">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="pims-btn pims-btn-success" type="submit" form="pims-edit-job-form">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create Job Modal Handling
            const pimsCreateRecordButton = document.getElementById('pims-create-record-button');
            const pimsCloseModalButton = document.getElementById('pims-close-modal-button');
            const pimsCancelModalButton = document.getElementById('pims-cancel-modal-button');
            const pimsCreateRecordModal = document.getElementById('pims-create-record-modal');

            // Open create modal
            pimsCreateRecordButton.addEventListener('click', () => {
                pimsCreateRecordModal.classList.add('pims-modal-active');
            });

            // Close create modal
            pimsCloseModalButton.addEventListener('click', () => {
                pimsCreateRecordModal.classList.remove('pims-modal-active');
            });

            pimsCancelModalButton.addEventListener('click', () => {
                pimsCreateRecordModal.classList.remove('pims-modal-active');
            });

            // Edit Job Modal Handling
            const pimsEditButtons = document.querySelectorAll('.pims-edit-button');
            const pimsEditModal = document.getElementById('pims-edit-job-modal');
            const pimsCloseEditModalButton = document.getElementById('pims-close-edit-modal-button');
            const pimsCancelEditModalButton = document.getElementById('pims-cancel-edit-modal-button');

            pimsEditButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const jobId = button.dataset.id;
                    const form = document.getElementById('pims-edit-job-form');

                    // Set form action with job ID
                    form.action = `/jobs/${jobId}`;

                    // Populate form fields
                    document.getElementById('pims-edit-job-title').value = button.dataset.jobTitle;
                    document.getElementById('pims-edit-prisoner-id').value = button.dataset.prisonerId;
                    document.getElementById('pims-edit-assigned-by').value = button.dataset.assignedBy;
                    document.getElementById('pims-edit-job-description').value = button.dataset.jobDescription;
                    document.getElementById('pims-edit-assigned-date').value = button.dataset.assignedDate;
                    document.getElementById('pims-edit-status').value = button.dataset.status;

                    pimsEditModal.classList.add('pims-modal-active');
                });
            });

            // Close edit modal
            pimsCloseEditModalButton.addEventListener('click', () => {
                pimsEditModal.classList.remove('pims-modal-active');
            });

            pimsCancelEditModalButton.addEventListener('click', () => {
                pimsEditModal.classList.remove('pims-modal-active');
            });

            // Delete Confirmation
            const pimsDeleteForms = document.querySelectorAll('.pims-delete-form');
            pimsDeleteForms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    if (!confirm('Are you sure you want to delete this job?')) {
                        e.preventDefault();
                    }
                });
            });

            // Reload button
            document.getElementById('pims-table-reload').addEventListener('click', () => {
                window.location.reload();
            });
        });
    </script>
</body>
</html>