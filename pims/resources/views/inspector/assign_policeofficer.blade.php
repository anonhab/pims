<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Police Assignments Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #34495e;
            --accent: #3498db;
            --light: #ecf0f1;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f1c40f;
            --radius: 8px;
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
            --font-size-base: clamp(0.9rem, 2vw, 1rem);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            color: var(--primary);
            font-size: var(--font-size-base);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        #pims-page-content {
            padding: clamp(1rem, 3vw, 2rem);
            margin-left: 250px;
            min-height: 100vh;
            transition: var(--transition);
        }

        .pims-content-header {
            margin-bottom: 2rem;
        }

        .pims-content-title {
            font-size: clamp(1.5rem, 4vw, 1.75rem);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-content-title i {
            color: var(--accent);
        }

        .pims-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .pims-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-search-input {
            max-width: 300px;
        }

        .pims-form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: var(--font-size-base);
            transition: var(--transition);
        }

        .pims-form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .control.has-icons-left {
            position: relative;
        }

        .icon.is-left {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }

        .pims-card-actions {
            display: flex;
            gap: 0.75rem;
        }

        .pims-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .pims-btn-primary:hover {
            background: #2980b9;
        }

        .pims-btn-secondary {
            background: var(--secondary);
            color: #fff;
        }

        .pims-btn-secondary:hover {
            background: #2c3e50;
        }

        .pims-btn-danger {
            background: var(--danger);
            color: #fff;
        }

        .pims-btn-danger:hover {
            background: #c0392b;
        }

        .pims-btn-light {
            background: var(--light);
            color: var(--secondary);
        }

        .pims-btn-light:hover {
            background: #dfe6e9;
        }

        .pims-card-content {
            padding: 1.5rem;
        }

        .pims-empty-state {
            text-align: center;
            padding: 2rem;
        }

        .pims-empty-state i {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .pims-empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .pims-empty-state p {
            color: var(--secondary);
        }

        .pims-assignment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .pims-assignment-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .pims-assignment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .pims-assignment-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            text-align: center;
        }

        .pims-assignment-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .pims-assignment-date {
            font-size: 0.95rem;
            opacity: 0.8;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .pims-assignment-body {
            padding: 1.5rem;
        }

        .pims-assignment-detail {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .pims-assignment-detail strong {
            color: var(--secondary);
        }

        .pims-assignment-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            padding: 1rem;
            border-top: 1px solid #eee;
        }

        .pims-footer-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.9rem;
        }

        .pims-footer-btn.edit {
            background: var(--accent);
            color: #fff;
        }

        .pims-footer-btn.edit:hover {
            background: #2980b9;
        }

        .pims-footer-btn.delete {
            background: var(--danger);
            color: #fff;
        }

        .pims-footer-btn.delete:hover {
            background: #c0392b;
        }

        .pims-modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.5);
        }

        .pims-modal.is-active {
            display: flex;
        }

        .pims-modal-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {  transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-title i {
            color: var(--accent);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--secondary);
            transition: var(--transition);
        }

        .pims-modal-close:hover {
            color: var(--primary);
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary);
        }

        .pims-form-input, .pims-form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: var(--font-size-base);
            transition: var(--transition);
        }

        .pims-form-input:focus, .pims-form-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .pims-confirm-icon {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .pims-confirm-icon i {
            font-size: 3rem;
            color: var(--danger);
        }

        .pims-confirm-message {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 992px) {
            #pims-page-content { margin-left: 0; }
            .pims-assignment-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
        }

        @media (max-width: 768px) {
            .pims-card-header { flex-direction: column; align-items: flex-start; }
            .pims-search-input { max-width: 100%; }
            .pims-card-actions { width: 100%; justify-content: flex-end; }
        }

        @media (max-width: 480px) {
            .pims-assignment-footer { flex-direction: column; }
            .pims-assignment-footer .pims-footer-btn { width: 100%; }
            .pims-modal-footer { flex-direction: column; }
            .pims-modal-footer .pims-btn { width: 100%; }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    @include('inspector.menu')
    <div id="pims-page-content">
        <div class="pims-content-header">
            <h1 class="pims-content-title">
                <i class="fas fa-user-lock" aria-hidden="true"></i> Police Assignments Management
            </h1>
        </div>

        <div class="pims-card">
            <div class="pims-card-header">
                <div class="pims-search-input">
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="pims-form-input" id="pims-search-assignment" type="text" placeholder="Search assignments..." aria-label="Search assignments">
                            <span class="icon is-left">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="pims-card-actions">
                    <button class="pims-btn pims-btn-primary pims-create-btn" aria-label="Create new assignment">
                        <i class="fas fa-plus" aria-hidden="true"></i> New Assignment
                    </button>
                    <button class="pims-btn pims-btn-secondary" id="pims-reload-assignments" aria-label="Reload assignments">
                        <i class="fas fa-sync-alt" aria-hidden="true"></i> Reload
                    </button>
                </div>
            </div>

            <div class="pims-card-content">
                @if($assignments->isEmpty())
                    <div class="pims-empty-state">
                        <i class="fas fa-clipboard-list fa-3x" aria-hidden="true"></i>
                        <h3>No Assignments Found</h3>
                        <p>Create your first assignment by clicking the "New Assignment" button</p>
                    </div>
                @else
                    <div class="pims-assignment-grid">
                        @foreach($assignments as $assignment)
                            <div class="pims-assignment-card">
                                <div class="pims-assignment-header">
                                    <h3 class="pims-assignment-title">Assignment #{{ $assignment->assignment_id }}</h3>
                                    <p class="pims-assignment-date">
                                        <i class="fas fa-calendar" aria-hidden="true"></i> {{ $assignment->assignment_date  }}
                                    </p>
                                </div>
                                <div class="pims-assignment-body">
                                    <div class="pims-assignment-detail">
                                        <strong>Prisoner ID:</strong> {{ optional($assignment->prisoner)->id ?? 'Not assigned' }}
                                    </div>
                                    <div class="pims-assignment-detail">
                                        <strong>Prisoner Name:</strong> {{ optional($assignment->prisoner)->first_name ?? 'Not assigned' }}
                                    </div>
                                    <div class="pims-assignment-detail">
                                        <strong>Officer Name:</strong> {{ optional($assignment->officer)->first_name ?? 'Not assigned' }}
                                    </div>
                                    <div class="pims-assignment-detail">
                                        <strong>Assigned By:</strong> {{ optional($assignment->assignedBy)->first_name ?? 'Unknown' }}
                                    </div>
                                </div>
                                <div class="pims-assignment-footer">
                                    <button class="pims-footer-btn edit pims-edit-btn"
                                            data-id="{{ $assignment->assignment_id }}"
                                            data-prisoner-id="{{ $assignment->prisoner_id }}"
                                            data-officer-id="{{ $assignment->officer_id }}"
                                            data-assignment-date="{{ $assignment->assignment_date  }}"
                                            aria-label="Edit assignment {{ $assignment->assignment_id }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i> Edit
                                    </button>
                                    <button class="pims-footer-btn delete pims-delete-btn"
                                            data-id="{{ $assignment->assignment_id }}"
                                            aria-label="Delete assignment {{ $assignment->assignment_id }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i> Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="pims-assignment-form" class="pims-modal" role="dialog" aria-labelledby="create-modal-title" aria-hidden="true">
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <h2 class="pims-modal-title" id="create-modal-title">
                    <i class="fas fa-plus" aria-hidden="true"></i> New Assignment
                </h2>
                <button class="pims-modal-close" aria-label="Close create modal">×</button>
            </header>
            <form id="pims-create-form" action="{{ route('inspector.police.assignments.store') }}" method="POST">
                @csrf
                <section class="pims-modal-body">
                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-create-prisoner">Prisoner</label>
                        <select class="pims-form-select" name="prisoner_id" id="pims-create-prisoner" required>
                            <option value="">Select Prisoner</option>
                            @foreach($prisoners as $prisoner)
                                <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }} {{ $prisoner->last_name }} (ID: {{ $prisoner->id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-create-officer">Officer</label>
                        <select class="pims-form-select" name="officer_id" id="pims-create-officer" required>
                            <option value="">Select Officer</option>
                            @foreach($officers as $officer)
                                <option value="{{ $officer->user_id }}">{{ $officer->first_name }} {{ $officer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">
                    <input type="hidden" name="assigned_by" value="{{ session('user_id') }}">
                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-create-date">Assignment Date</label>
                        <input type="date" name="assignment_date" id="pims-create-date" class="pims-form-input" required>
                    </div>
                </section>
                <footer class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-light pims-close-modal" aria-label="Cancel create">Cancel</button>
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save" aria-hidden="true"></i> Save Assignment
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <div id="pims-edit-form" class="pims-modal" role="dialog" aria-labelledby="edit-modal-title" aria-hidden="true">
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <h2 class="pims-modal-title" id="edit-modal-title">
                    <i class="fas fa-edit" aria-hidden="true"></i> Edit Assignment
                </h2>
                <button class="pims-modal-close" aria-label="Close edit modal">×</button>
            </header>
            <form id="pims-edit-assignment-form" method="POST">
                @csrf
                <input type="hidden" name="assignment_id" id="pims-edit-id">
                <section class="pims-modal-body">
                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-edit-prisoner">Prisoner</label>
                        <select class="pims-form-select" name="prisoner_id" id="pims-edit-prisoner" required>
                            <option value="">Select Prisoner</option>
                            @foreach($prisoners as $prisoner)
                                <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }} {{ $prisoner->last_name }} (ID: {{ $prisoner->id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-edit-officer">Officer</label>
                        <select class="pims-form-select" name="officer_id" id="pims-edit-officer" required>
                            <option value="">Select Officer</option>
                            @foreach($officers as $officer)
                                <option value="{{ $officer->user_id }}">{{ $officer->first_name }} {{ $officer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">
                    <input type="hidden" name="assigned_by" value="{{ session('user_id') }}">
                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-edit-date">Assignment Date</label>
                        <input type="date" name="assignment_date" id="pims-edit-date" class="pims-form-input" required>
                    </div>
                </section>
                <footer class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-light pims-close-modal" aria-label="Cancel edit">Cancel</button>
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save" aria-hidden="true"></i> Update Assignment
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <div id="pims-delete-modal" class="pims-modal" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <h2 class="pims-modal-title" id="delete-modal-title">
                    <i class="fas fa-exclamation-triangle" aria-hidden="true"></i> Confirm Deletion
                </h2>
                <button class="pims-modal-close" aria-label="Close delete modal">×</button>
            </header>
            <section class="pims-modal-body">
                <div class="pims-confirm-icon">
                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </div>
                <p class="pims-confirm-message">
                    Are you sure you want to delete assignment <strong id="pims-delete-id"></strong>? This action cannot be undone.
                </p>
            </section>
            <footer class="pims-modal-footer">
                <button type="button" class="pims-btn pims-btn-light pims-close-modal" aria-label="Cancel delete">Cancel</button>
                <form id="pims-delete-form" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="pims-btn pims-btn-danger">
                        <i class="fas fa-trash" aria-hidden="true"></i> Delete Assignment
                    </button>
                </form>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'CSRF token missing. Please check application setup.' });
                return;
            }

            const createModal = document.getElementById('pims-assignment-form');
            const editModal = document.getElementById('pims-edit-form');
            const deleteModal = document.getElementById('pims-delete-modal');

            const closeAllModals = () => {
                createModal.classList.remove('is-active');
                editModal.classList.remove('is-active');
                deleteModal.classList.remove('is-active');
                createModal.setAttribute('aria-hidden', 'true');
                editModal.setAttribute('aria-hidden', 'true');
                deleteModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            document.querySelectorAll('.pims-create-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    createModal.classList.add('is-active');
                    createModal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                    document.getElementById('pims-create-prisoner').focus();
                });
            });

            document.querySelectorAll('.pims-edit-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    const id = btn.dataset.id;
                    document.getElementById('pims-edit-id').value = id;
                    document.getElementById('pims-edit-prisoner').value = btn.dataset.prisonerId || '';
                    document.getElementById('pims-edit-officer').value = btn.dataset.officerId || '';
                    document.getElementById('pims-edit-date').value = btn.dataset.assignmentDate || '';
                    document.getElementById('pims-edit-assignment-form').action = `{{ route('inspector.police.assignments.update', ':id') }}`.replace(':id', id);
                    editModal.classList.add('is-active');
                    editModal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                    document.getElementById('pims-edit-prisoner').focus();
                });
            });

            document.querySelectorAll('.pims-delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    document.getElementById('pims-delete-id').textContent = btn.dataset.id;
                    document.getElementById('pims-delete-form').action = `{{ route('inspector.police.assignments.destroy', ':id') }}`.replace(':id', btn.dataset.id);
                    deleteModal.classList.add('is-active');
                    deleteModal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                });
            });

            document.querySelectorAll('.pims-modal-close, .pims-close-modal').forEach(btn => {
                btn.addEventListener('click', closeAllModals);
            });

            window.addEventListener('click', e => {
                if (e.target.classList.contains('pims-modal')) {
                    closeAllModals();
                }
            });

            document.getElementById('pims-create-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;

                try {
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                    const result = await response.json();
                    if (response.ok) {
                        closeAllModals();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Assignment created successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to create assignment');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Something went wrong!'
                    });
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });

            document.getElementById('pims-edit-assignment-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                submitBtn.disabled = true;

                try {
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData);
                    const response = await fetch(form.action, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                    const result = await response.json();
                    if (response.ok) {
                        closeAllModals();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Assignment updated successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to update assignment');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Something went wrong!'
                    });
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });

            document.getElementById('pims-delete-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                submitBtn.disabled = true;

                try {
                    const response = await fetch(form.action, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });
                    const result = await response.json();
                    if (response.ok) {
                        closeAllModals();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Assignment deleted successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to delete assignment');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Something went wrong!'
                    });
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });

            document.getElementById('pims-reload-assignments').addEventListener('click', () => {
                window.location.reload();
            });

            const debounce = (fn, delay) => {
                let timeout;
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => fn(...args), delay);
                };
            };

            document.getElementById('pims-search-assignment').addEventListener('input', debounce(() => {
                const searchTerm = document.getElementById('pims-search-assignment').value.toLowerCase();
                document.querySelectorAll('.pims-assignment-card').forEach(card => {
                    const text = card.textContent.toLowerCase();
                    card.style.display = text.includes(searchTerm) ? 'block' : 'none';
                });
            }, 300));

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && (createModal.classList.contains('is-active') || editModal.classList.contains('is-active') || deleteModal.classList.contains('is-active'))) {
                    closeAllModals();
                }
            });
        });
    </script>
</body>
</html>