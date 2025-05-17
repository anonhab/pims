<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Visitor Management</title>
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
            --warning: #f1c40f;
            --success: #2ecc71;
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

        .pims-app-container {
            display: flex;
            min-height: 100vh;
        }

        .pims-main-content {
            flex: 1;
            padding: clamp(1rem, 3vw, 2rem);
            margin-left: 250px;
            transition: var(--transition);
        }

        .pims-content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .pims-page-header {
            margin-bottom: 2rem;
        }

        .pims-page-title {
            font-size: clamp(1.5rem, 4vw, 1.75rem);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-page-title i {
            color: var(--accent);
        }

        .pims-alert-success {
            background: var(--success);
            color: #fff;
            padding: 1rem;
            border-radius: var(--radius);
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .pims-empty-state {
            text-align: center;
            padding: 2rem;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
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
            margin-bottom: 1rem;
        }

        .pims-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .pims-visitor-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
            overflow: hidden;
        }

        .pims-visitor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .pims-card-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            text-align: center;
        }

        .pims-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .pims-card-subtitle {
            font-size: 0.95rem;
            opacity: 0.8;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        .pims-info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .pims-info-label {
            font-weight: 500;
            color: var(--secondary);
        }

        .pims-card-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            padding: 1rem;
            border-top: 1px solid #eee;
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
            text-decoration: none;
        }

        .pims-btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .pims-btn-primary:hover {
            background: #2980b9;
        }

        .pims-btn-warning {
            background: var(--warning);
            color: var(--primary);
        }

        .pims-btn-warning:hover {
            background: #e1b107;
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

        .pims-form-actions {
            margin-top: 2rem;
            text-align: right;
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

        .pims-modal.active {
            display: flex;
        }

        .pims-modal-container {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-header i {
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

        .pims-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.25rem;
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

        .pims-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: var(--font-size-base);
            transition: var(--transition);
        }

        .pims-form-control:focus {
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
            .pims-main-content { margin-left: 0; }
            .pims-cards-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
        }

        @media (max-width: 768px) {
            .pims-form-grid { grid-template-columns: 1fr; }
            .pims-card-footer { flex-direction: column; }
            .pims-card-footer .pims-btn { width: 100%; }
        }

        @media (max-width: 480px) {
            .pims-info-item { flex-direction: column; align-items: flex-start; gap: 0.25rem; }
            .pims-modal-footer { flex-direction: column; }
            .pims-modal-footer .pims-btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="pims-app-container">
        @include('includes.nav')
        @include('security_officer.menu')
        <main class="pims-main-content">
            <div class="pims-content-container">
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-users" aria-hidden="true"></i> Visitor Management
                    </h2>
                </div>

                @if (session('success'))
                    <div class="pims-alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="pims-cards-grid">
                    @if($visitors->isEmpty())
                        <div class="pims-empty-state">
                            <i class="fas fa-user-slash" aria-hidden="true"></i>
                            <h3>No Visitors Found</h3>
                            <p>There are currently no visitors in the system.</p>
                            <a href="{{ route('security_officer.registerVisitor') }}" class="pims-btn pims-btn-primary">
                                <i class="fas fa-user-plus" aria-hidden="true"></i> Register First Visitor
                            </a>
                        </div>
                    @else
                        @foreach ($visitors as $visitor)
                            <div class="pims-visitor-card">
                                <div class="pims-card-header">
                                    <h3 class="pims-card-title">{{ $visitor->first_name }} {{ $visitor->last_name }}</h3>
                                    <p class="pims-card-subtitle">ID: {{ $visitor->id }}</p>
                                </div>
                                <div class="pims-card-body">
                                    <div class="pims-info-item">
                                        <span class="pims-info-label">Phone:</span>
                                        <span>{{ $visitor->phone_number ?: 'N/A' }}</span>
                                    </div>
                                    <div class="pims-info-item">
                                        <span class="pims-info-label">Relationship:</span>
                                        <span>{{ $visitor->relationship ?: 'N/A' }}</span>
                                    </div>
                                    <div class="pims-info-item">
                                        <span class="pims-info-label">Address:</span>
                                        <span>{{ $visitor->address ?: 'N/A' }}</span>
                                    </div>
                                    <div class="pims-info-item">
                                        <span class="pims-info-label">ID Number:</span>
                                        <span>{{ $visitor->identification_number ?: 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="pims-card-footer">
                                    <button class="pims-btn pims-btn-warning pims-edit-btn"
                                            data-id="{{ $visitor->id }}"
                                            data-first-name="{{ $visitor->first_name }}"
                                            data-last-name="{{ $visitor->last_name }}"
                                            data-phone-number="{{ $visitor->phone_number }}"
                                            data-relationship="{{ $visitor->relationship }}"
                                            data-address="{{ $visitor->address }}"
                                            data-identification-number="{{ $visitor->identification_number }}"
                                            aria-label="Edit visitor {{ $visitor->id }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i> Edit
                                    </button>
                                    <button class="pims-btn pims-btn-danger pims-delete-btn"
                                            data-id="{{ $visitor->id }}"
                                            aria-label="Delete visitor {{ $visitor->id }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i> Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="pims-form-actions">
                    <a href="{{ route('security_officer.registerVisitor') }}" 
                       class="pims-btn pims-btn-primary"
                       aria-label="Register new visitor">
                        <i class="fas fa-user-plus" aria-hidden="true"></i> Register New Visitor
                    </a>
                </div>
            </div>
        </main>
    </div>

    <div class="pims-modal" id="pims-edit-modal" role="dialog" aria-labelledby="edit-modal-title" aria-hidden="true">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3 id="edit-modal-title"><i class="fas fa-user-edit" aria-hidden="true"></i> Edit Visitor</h3>
                <button class="pims-modal-close" aria-label="Close edit modal">×</button>
            </div>
            <form id="pims-edit-form" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="pims-edit-id">
                <div class="pims-modal-body">
                    <div class="pims-form-grid">
                        <div class="pims-form-group">
                            <label for="pims-edit-first-name" class="pims-form-label">First Name</label>
                            <input type="text" name="first_name" id="pims-edit-first-name" required class="pims-form-control">
                        </div>
                        <div class="pims-form-group">
                            <label for="pims-edit-last-name" class="pims-form-label">Last Name</label>
                            <input type="text" name="last_name" id="pims-edit-last-name" required class="pims-form-control">
                        </div>
                        <div class="pims-form-group">
                            <label for="pims-edit-phone-number" class="pims-form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="pims-edit-phone-number" required class="pims-form-control">
                        </div>
                        <div class="pims-form-group">
                            <label for="pims-edit-relationship" class="pims-form-label">Relationship</label>
                            <input type="text" name="relationship" id="pims-edit-relationship" required class="pims-form-control">
                        </div>
                        <div class="pims-form-group">
                            <label for="pims-edit-address" class="pims-form-label">Address</label>
                            <input type="text" name="address" id="pims-edit-address" required class="pims-form-control">
                        </div>
                        <div class="pims-form-group">
                            <label for="pims-edit-identification-number" class="pims-form-label">ID Number</label>
                            <input type="text" name="identification_number" id="pims-edit-identification-number" required class="pims-form-control">
                        </div>
                    </div>
                </div>
                <div class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-light pims-close-modal" aria-label="Cancel edit">
                        Cancel
                    </button>
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save" aria-hidden="true"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="pims-modal" id="pims-delete-modal" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3 id="delete-modal-title"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i> Confirm Deletion</h3>
                <button class="pims-modal-close" aria-label="Close delete modal">×</button>
            </div>
            <div class="pims-modal-body">
                <div class="pims-confirm-icon">
                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </div>
                <p class="pims-confirm-message">
                    Are you sure you want to delete visitor with ID <strong id="pims-delete-id"></strong>? This action cannot be undone.
                </p>
            </div>
            <div class="pims-modal-footer">
                <button type="button" class="pims-btn pims-btn-light pims-close-modal" aria-label="Cancel delete">
                    Cancel
                </button>
                <form id="pims-delete-form" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="pims-btn pims-btn-danger">
                        <i class="fas fa-trash" aria-hidden="true"></i> Delete Visitor
                    </button>
                </form>
            </div>
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

            const editModal = document.getElementById('pims-edit-modal');
            const deleteModal = document.getElementById('pims-delete-modal');

            const closeAllModals = () => {
                editModal.classList.remove('active');
                deleteModal.classList.remove('active');
                editModal.setAttribute('aria-hidden', 'true');
                deleteModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            document.querySelectorAll('.pims-edit-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    const id = btn.dataset.id;
                    document.getElementById('pims-edit-id').value = id;
                    document.getElementById('pims-edit-first-name').value = btn.dataset.firstName;
                    document.getElementById('pims-edit-last-name').value = btn.dataset.lastName;
                    document.getElementById('pims-edit-phone-number').value = btn.dataset.phoneNumber || '';
                    document.getElementById('pims-edit-relationship').value = btn.dataset.relationship || '';
                    document.getElementById('pims-edit-address').value = btn.dataset.address || '';
                    document.getElementById('pims-edit-identification-number').value = btn.dataset.identificationNumber || '';
                    document.getElementById('pims-edit-form').action = `{{ route('security_officer.updateVisitor', ':id') }}`.replace(':id', id);
                    editModal.classList.add('active');
                    editModal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                    document.getElementById('pims-edit-first-name').focus();
                });
            });

            document.querySelectorAll('.pims-delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    document.getElementById('pims-delete-id').textContent = btn.dataset.id;
                    document.getElementById('pims-delete-form').action = `{{ route('security_officer.deleteVisitor', ':id') }}`.replace(':id', btn.dataset.id);
                    deleteModal.classList.add('active');
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

            document.getElementById('pims-edit-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                submitBtn.disabled = true;

                try {
                    const formData = new FormData(form);
                    formData.delete('_method');
                    const data = Object.fromEntries(formData);
                    data._method = 'PUT';
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
                            text: 'Visitor updated successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to update visitor');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message.includes('405') 
                            ? 'Update operation not supported. Please ensure backend supports PUT method.'
                            : error.message || 'Something went wrong!'
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
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ _method: 'DELETE' })
                    });
                    const result = await response.json();
                    if (response.ok) {
                        closeAllModals();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Visitor deleted successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to delete visitor');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message.includes('405') 
                            ? 'Delete operation not supported. Please ensure backend supports DELETE method.'
                            : error.message || 'Something went wrong!'
                    });
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && (editModal.classList.contains('active') || deleteModal.classList.contains('active'))) {
                    closeAllModals();
                }
            });
        });
    </script>
</body>
</html>