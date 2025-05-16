<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Assigned Training Programs</title>

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
            transition: var(--pims-transition);
            border-left: 4px solid var(--pims-accent);
            height: 100%;
            display: flex;
            flex-direction: column;
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
            flex-grow: 1;
        }

        .pims-card-footer {
            padding: 0.75rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between; /* Changed to space-between for edit/unassign buttons */
        }

        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .pims-content-text {
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .pims-content-text strong {
            color: var(--pims-primary);
            font-weight: 600;
        }

        .pims-meta-text {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-top: 1rem;
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

        .pims-status-in-progress {
            background-color: var(--pims-warning);
            color: white;
        }

        .pims-notification {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .pims-notification-success {
            background-color: rgba(39, 174, 96, 0.2);
            border-left: 4px solid var(--pims-success);
            color: var(--pims-success);
        }

        .pims-notification-warning {
            background-color: rgba(211, 84, 0, 0.2);
            border-left: 4px solid var(--pims-warning);
            color: var(--pims-warning);
        }

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
        }

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover {
            background-color: #219653;
            transform: translateY(-2px);
        }

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
        .program-edit-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1100;
            transition: var(--pims-transition);
        }

        .program-edit-modal-active {
            display: flex;
            opacity: 1;
            visibility: visible;
        }

        .program-edit-modal-content {
            background-color: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: var(--pims-transition);
        }

        .program-edit-modal-active .program-edit-modal-content {
            transform: translateY(0);
        }

        .program-edit-modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .program-edit-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .program-edit-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #7f8c8d;
        }

        .program-edit-modal-body {
            padding: 1.5rem;
        }

        .program-edit-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
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

        @media (max-width: 768px) {
            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')

    <div class="pims-app-container">
        @include('training_officer.menu')

        <div class="pims-content-area">
            @if(session('success'))
            <div class="pims-notification pims-notification-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            <div class="pims-page-header">
                <h1 class="pims-page-title">
                    <i class="fas fa-chalkboard-teacher"></i> Assigned Training Programs
                </h1>
            </div>

            <div class="pims-grid">
                @forelse ($assignments as $assignment)
                <div class="pims-assignment-card">
                    <div class="pims-card">
                        <header class="pims-card-header">
                            <p class="pims-card-title">
                                @if($assignment->trainingProgram)
                                <i class="fas fa-graduation-cap"></i> {{ $assignment->trainingProgram->name }}
                                @else
                                <i class="fas fa-exclamation-circle"></i> Not assigned
                                @endif
                            </p>
                        </header>
                        <div class="pims-card-body">
                            <div class="pims-content">
                                <p class="pims-content-text"><strong><i class="fas fa-id-card"></i> Prisoner ID:</strong> {{ $assignment->prisoner_id }}</p>
                                <p class="pims-content-text"><strong><i class="fas fa-graduation-cap"></i> Program ID:</strong> {{ $assignment->training_id }}</p>
                                <p class="pims-content-text"><strong><i class="fas fa-align-left"></i> Description:</strong>
                                    @if($assignment->trainingProgram)
                                    {{ Str::limit($assignment->trainingProgram->description, 100) }}
                                    @else
                                    Not assigned
                                    @endif
                                </p>
                                <p class="pims-content-text"><strong><i class="fas fa-user-tie"></i> Assigned By:</strong> {{ $assignment->assigned_by }}</p>
                                <p class="pims-content-text">
                                    <strong><i class="fas fa-calendar-day"></i> Assigned Date:</strong> {{ $assignment->assigned_date }}
                                </p>
                                <p class="pims-content-text">
                                    <strong><i class="fas fa-calendar-check"></i> End Date:</strong> {{ $assignment->end_date }}
                                </p>
                                <p class="pims-content-text"><strong><i class="fas fa-info-circle"></i> Status:</strong>
                                    <span class="pims-status-badge pims-status-{{ $assignment->status === 'completed' ? 'completed' : 'in-progress' }}">
                                        {{ ucfirst($assignment->status) }}
                                    </span>
                                </p>
                                <p class="pims-content-text"><strong><i class="fas fa-calendar-alt"></i> Dates:</strong>
                                    @if($assignment->trainingProgram)
                                    {{ $assignment->trainingProgram->start_date }} to {{ $assignment->trainingProgram->end_date }}
                                    @else
                                    Not assigned
                                    @endif
                                </p>
                                <p class="pims-content-text"><strong><i class="fas fa-building"></i> Prison ID:</strong>
                                    @if($assignment->trainingProgram)
                                    {{ $assignment->trainingProgram->prison_id }}
                                    @else
                                    Not assigned
                                    @endif
                                </p>
                                <p class="pims-meta-text">
                                    <small><i class="fas fa-clock"></i> Created: {{ $assignment->created_at->format('Y-m-d') }}</small><br>
                                    <small><i class="fas fa-sync-alt"></i> Updated: {{ $assignment->updated_at->format('Y-m-d') }}</small>
                                </p>
                            </div>
                        </div>
                        <footer class="pims-card-footer">
                            <button class="pims-btn pims-btn-primary program-edit-button"
                                    data-id="{{ $assignment->id }}"
                                    data-prisoner-id="{{ $assignment->prisoner_id }}"
                                    data-training-id="{{ $assignment->training_id }}"
                                    data-assigned-by="{{ $assignment->assigned_by }}"
                                    data-assigned-date="{{ $assignment->assigned_date }}"
                                    data-end-date="{{ $assignment->end_date }}"
                                    data-status="{{ $assignment->status }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('assign_training.unassign', $assignment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="pims-btn pims-btn-danger">
                                    <i class="fas fa-user-minus"></i> Unassign
                                </button>
                            </form>
                        </footer>
                    </div>
                </div>
                @empty
                <div class="pims-empty-state">
                    <div class="pims-notification pims-notification-warning">
                        <i class="fas fa-exclamation-triangle"></i> No training assignments found.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Edit Assignment Modal -->
    <div class="program-edit-modal" id="program-edit-modal">
        <div class="program-edit-modal-content">
            <header class="program-edit-modal-header">
                <h3 class="program-edit-modal-title"><i class="fas fa-edit"></i> Edit Training Assignment</h3>
                <button class="program-edit-modal-close" id="program-close-edit-modal-button">×</button>
            </header>
            <section class="program-edit-modal-body">
                <form id="program-edit-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="program-edit-id">
                    <div class="pims-form-group">
                        <label class="pims-form-label">Prisoner ID</label>
                        <input class="pims-form-control" type="text" name="prisoner_id" id="program-edit-prisoner-id" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Training Program ID</label>
                        <input class="pims-form-control" type="text" name="training_id" id="program-edit-training-id" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned By</label>
                        <input class="pims-form-control" type="text" name="assigned_by" id="program-edit-assigned-by" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Assigned Date</label>
                        <input class="pims-form-control" type="date" name="assigned_date" id="program-edit-assigned-date" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">End Date</label>
                        <input class="pims-form-control" type="date" name="end_date" id="program-edit-end-date" required>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Status</label>
                        <select class="pims-form-control" name="status" id="program-edit-status" required>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </form>
            </section>
            <footer class="program-edit-modal-footer">
                <button class="pims-btn pims-btn-secondary" id="program-cancel-edit-modal-button">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="pims-btn pims-btn-success" type="submit" form="program-edit-form">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, initializing training assignment functionality');

        // Edit Assignment Modal Handling
        const editButtons = document.querySelectorAll('.program-edit-button');
        const editModal = document.getElementById('program-edit-modal');
        const closeEditModalButton = document.getElementById('program-close-edit-modal-button');
        const cancelEditModalButton = document.getElementById('program-cancel-edit-modal-button');
        const editForm = document.getElementById('program-edit-form');

        if (editButtons.length === 0) {
            console.warn('No program edit buttons found');
        }

        editButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Program edit button clicked for assignment ID:', button.dataset.id);

                // Populate form fields
                editForm.action = `/program-assignments/${button.dataset.id}`;
                document.getElementById('program-edit-id').value = button.dataset.id;
                document.getElementById('program-edit-prisoner-id').value = button.dataset.prisonerId || '';
                document.getElementById('program-edit-training-id').value = button.dataset.trainingId || '';
                document.getElementById('program-edit-assigned-by').value = button.dataset.assignedBy || '';
                document.getElementById('program-edit-assigned-date').value = button.dataset.assignedDate || '';
                document.getElementById('program-edit-end-date').value = button.dataset.endDate || '';
                document.getElementById('program-edit-status').value = button.dataset.status || 'in-progress';

                console.log('Program edit form populated, action set to:', editForm.action);

                // Show modal
                editModal.classList.add('program-edit-modal-active');
                console.log('Program edit modal opened');
            });
        });

        if (closeEditModalButton) {
            closeEditModalButton.addEventListener('click', () => {
                editModal.classList.remove('program-edit-modal-active');
                console.log('Program edit modal closed');
            });
        }

        if (cancelEditModalButton) {
            cancelEditModalButton.addEventListener('click', () => {
                editModal.classList.remove('program-edit-modal-active');
                console.log('Program edit modal cancelled');
            });
        }

        // Unassign Confirmation
        const unassignForms = document.querySelectorAll('form[action*="unassign"]');
        unassignForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!confirm('Are you sure you want to unassign this training program?')) {
                    e.preventDefault();
                    console.log('Unassign cancelled');
                } else {
                    console.log('Unassign confirmed');
                }
            });
        });
    });
    </script>
</body>
</html>