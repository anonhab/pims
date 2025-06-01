<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
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

        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 1.5rem;
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

        .pims-card-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.02);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

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

        .pims-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            display: inline-flex;
            align-items: center;
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
        }

        .pims-btn-secondary {
            background-color: #ecf0f1;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #d5dbdb;
            transform: translateY(-2px);
        }

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover {
            background-color: #219653;
            transform: translateY(-2px);
        }

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

        .pims-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            transition: var(--pims-transition);
        }

        .pims-modal-active {
            display: flex;
            opacity: 1;
            visibility: visible;
        }

        .job-edit-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1100; /* Higher z-index to avoid overlap */
            transition: var(--pims-transition);
        }

        .job-edit-modal-active {
            display: flex;
            opacity: 1;
            visibility: visible;
        }

        .pims-modal-content,
        .job-edit-modal-content {
            background-color: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: var(--pims-transition);
        }

        .pims-modal-active .pims-modal-content,
        .job-edit-modal-active .job-edit-modal-content {
            transform: translateY(0);
        }

        .pims-modal-header,
        .job-edit-modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title,
        .job-edit-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-modal-close,
        .job-edit-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #7f8c8d;
        }

        .pims-modal-body,
        .job-edit-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer,
        .job-edit-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .pims-notification-success {
            background-color: var(--pims-success);
            color: white;
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

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
                <div class="pims-notification-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Create Job Button -->
            <button class="pims-btn pims-btn-primary" id="pims-create-record-button" style="margin-bottom: 1rem;">
                <i class="fas fa-plus-circle"></i> Create New Job
            </button>

            <div class="pims-card">
                <div class="pims-card-filter">
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
                    <div class="pims-grid">
                        @forelse($jobs as $job)
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
                                            <strong><i class="fas fa-calendar-day"></i> End Date:</strong> {{ $job->end_date ?? 'N/A' }}
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
                                        <button class="pims-btn pims-btn-primary job-edit-button"
                                                data-id="{{ $job->id }}"
                                                data-job-title="{{ htmlentities($job->job_title) }}"
                                                data-prisoner-id="{{ $job->prisoner_id }}"
                                                data-assigned-by="{{ $job->assigned_by }}"
                                                data-job-description="{{ htmlentities($job->job_description) }}"
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
                        @empty
                            <div class="pims-content-text">No jobs found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Job Modal -->
    <div class="pims-modal" id="pims-create-record-modal">
        <div class="pims-modal-content">
            <header class="pims-modal-header">
                <h3 class="pims-modal-title"><i class="fas fa-plus-circle"></i> Create New Job</h3>
                <button class="pims-modal-close" id="pims-close-modal-button">×</button>
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

    <!-- Edit Job Modal (Unique) -->
    <div class="job-edit-modal" id="job-edit-modal">
        <div class="job-edit-modal-content">
            <header class="job-edit-modal-header">
                <h3 class="job-edit-modal-title"><i class="fas fa-edit"></i> Edit Job</h3>
                <button class="job-edit-modal-close" id="job-close-edit-modal-button">×</button>
            </header>
            <section class="job-edit-modal-body">
                <form id="job-edit-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="job-edit-job-id">
                    <div class="pims-form-group">
                        <label class="pims-form-label">Job Title</label>
                        <input class="pims-form-control" type="text" name="job_title" id="job-edit-job-title" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Prisoner ID</label>
                        <input class="pims-form-control" type="text" name="prisoner_id" id="job-edit-prisoner-id" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned By</label>
                        <input class="pims-form-control" type="text" name="assigned_by" id="job-edit-assigned-by" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Job Description</label>
                        <textarea class="pims-form-control pims-form-textarea" name="job_description" id="job-edit-job-description" required></textarea>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned Date</label>
                        <input class="pims-form-control" type="date" name="assigned_date" id="job-edit-assigned-date" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Status</label>
                        <select class="pims-form-control" name="status" id="job-edit-status" required>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>
                </form>
            </section>
            <footer class="job-edit-modal-footer">
                <button class="pims-btn pims-btn-secondary" id="job-cancel-edit-modal-button">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="pims-btn pims-btn-success" type="submit" form="job-edit-form">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, initializing job management functionality');

        // Create Job Modal Handling (unchanged)
        const createButton = document.getElementById('pims-create-record-button');
        const createModal = document.getElementById('pims-create-record-modal');
        const closeCreateModalButton = document.getElementById('pims-close-modal-button');
        const cancelCreateModalButton = document.getElementById('pims-cancel-modal-button');

        if (createButton) {
            createButton.addEventListener('click', () => {
                createModal.classList.add('pims-modal-active');
                console.log('Create modal opened');
            });
        } else {
            console.error('Create button not found');
        }

        if (closeCreateModalButton) {
            closeCreateModalButton.addEventListener('click', () => {
                createModal.classList.remove('pims-modal-active');
                console.log('Create modal closed');
            });
        }

        if (cancelCreateModalButton) {
            cancelCreateModalButton.addEventListener('click', () => {
                createModal.classList.remove('pims-modal-active');
                console.log('Create modal cancelled');
            });
        }

        // Edit Job Modal Handling (unique)
        const editButtons = document.querySelectorAll('.job-edit-button');
        const editModal = document.getElementById('job-edit-modal');
        const closeEditModalButton = document.getElementById('job-close-edit-modal-button');
        const cancelEditModalButton = document.getElementById('job-cancel-edit-modal-button');
        const editForm = document.getElementById('job-edit-form');

        if (editButtons.length === 0) {
            console.warn('No job edit buttons found');
        }

        editButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Job edit button clicked for job ID:', button.dataset.id);

                // Populate form fields
                editForm.action = `/jobs/${button.dataset.id}`;
                document.getElementById('job-edit-job-id').value = button.dataset.id;
                document.getElementById('job-edit-job-title').value = button.dataset.jobTitle || '';
                document.getElementById('job-edit-prisoner-id').value = button.dataset.prisonerId || '';
                document.getElementById('job-edit-assigned-by').value = button.dataset.assignedBy || '';
                document.getElementById('job-edit-job-description').value = button.dataset.jobDescription || '';
                document.getElementById('job-edit-assigned-date').value = button.dataset.assignedDate || '';
                document.getElementById('job-edit-status').value = button.dataset.status || 'active';

                console.log('Job edit form populated, action set to:', editForm.action);

                // Show modal
                editModal.classList.add('job-edit-modal-active');
                console.log('Job edit modal opened');
            });
        });

        if (closeEditModalButton) {
            closeEditModalButton.addEventListener('click', () => {
                editModal.classList.remove('job-edit-modal-active');
                console.log('Job edit modal closed');
            });
        }

        if (cancelEditModalButton) {
            cancelEditModalButton.addEventListener('click', () => {
                editModal.classList.remove('job-edit-modal-active');
                console.log('Job edit modal cancelled');
            });
        }

        // Delete Confirmation
        const deleteForms = document.querySelectorAll('.pims-delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!confirm('Are you sure you want to delete this job?')) {
                    e.preventDefault();
                    console.log('Delete cancelled');
                } else {
                    console.log('Delete confirmed');
                }
            });
        });

        // Reload Button
        const reloadButton = document.getElementById('pims-table-reload');
        if (reloadButton) {
            reloadButton.addEventListener('click', () => {
                window.location.reload();
                console.log('Page reloaded');
            });
        }

        // Search Functionality (fixed to handle null elements)
        const searchInput = document.getElementById('pims-table-search');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const jobCards = document.querySelectorAll('.pims-job-card');
                jobCards.forEach(card => {
                    const titleElement = card.querySelector('.pims-card-title');
                    if (titleElement) {
                        const title = titleElement.textContent.toLowerCase();
                        card.style.display = title.includes(searchTerm) ? '' : 'none';
                    } else {
                        console.warn('No title element found in job card:', card);
                        card.style.display = 'none';
                    }
                });
                console.log('Search term:', searchTerm);
            });
        } else {
            console.warn('Search input not found');
        }
    });
    </script>
</body>
</html>