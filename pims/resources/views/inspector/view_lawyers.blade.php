<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Lawyer Management</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pims-primary: #1a2c3a;
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

        .pims-card-filter {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Lawyer Card Styles */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-lawyer-card {
            transition: var(--pims-transition);
        }

        .pims-lawyer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-lawyer-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-lawyer-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-lawyer-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims-lawyer-detail strong {
            color: var(--pims-primary);
            font-weight: 600;
        }

        .pims-lawyer-footer {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
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

        .pims-btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
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
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-text {
            background: transparent;
            color: var(--pims-accent);
        }

        .pims-btn-text:hover {
            background-color: rgba(41, 128, 185, 0.1);
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
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
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
            transition: opacity 0.3s ease, backdrop-filter 0.3s ease;
            backdrop-filter: blur(0px);
            overflow-y: auto;
            padding: 2rem 0;
        }

        .pims-modal.is-active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            opacity: 1;
            backdrop-filter: blur(3px);
        }

        .pims-modal-card {
            background: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            transform: translateY(-20px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .pims-modal.is-active .pims-modal-card {
            transform: translateY(0);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .pims-modal-card-head {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(41, 128, 185, 0.15) 0%, rgba(41, 128, 185, 0.1) 100%);
            color: var(--pims-primary);
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(41, 128, 185, 0.2);
        }

        .pims-modal-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .pims-modal-close {
            background: none;
            border: none;
            color: var(--pims-primary);
            font-size: 1.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            line-height: 1;
            padding: 0.5rem;
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pims-modal-close:hover {
            transform: rotate(90deg);
            background-color: rgba(41, 128, 185, 0.1);
        }

        .pims-modal-card-body {
            padding: 2rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .pims-modal-card-foot {
            padding: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            background-color: #f8f9fa;
        }

        /* Empty State */
        .pims-empty-state {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            color: var(--pims-text-dark);
            grid-column: 1 / -1;
        }

        /* Error Text */
        .pims-error-text {
            color: var(--pims-danger);
            font-size: 0.9rem;
            margin-top: 0.5rem;
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

            .pims-card-filter {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims-grid {
                grid-template-columns: 1fr;
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
                        <i class="fas fa-user-tie"></i> Lawyer Management
                    </h2>
                    <div class="pims-card-actions">
                        <button id="pims-reload-lawyers" class="pims-btn pims-btn-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                
                <div class="pims-card-filter">
                    <div class="pims-form-group" style="flex-grow: 1; max-width: 300px;">
                        <div class="control has-icons-left">
                            <input class="pims-form-control" id="pims-search-lawyer" type="text" placeholder="Search lawyers...">
                            <span class="icon is-left" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="pims-card-body">
                    <!-- Lawyer Cards Grid -->
                    <div class="pims-grid">
                        @if($lawyers->isEmpty())
                            <div class="pims-empty-state">
                                <i class="fas fa-user-tie" style="font-size: 3rem; color: var(--pims-accent); margin-bottom: 1rem;"></i>
                                <h3 class="pims-card-title">No lawyers found</h3>
                            </div>
                        @else
                            @foreach($lawyers as $lawyer)
                            <div class="pims-lawyer-card">
                                <div class="pims-card">
                                    <div class="pims-card-body">
                                        <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <div class="media-content">
                                                <p class="pims-lawyer-title">{{ $lawyer->first_name }} {{ $lawyer->last_name }}</p>
                                                <p class="pims-lawyer-subtitle">
                                                    <i class="fas fa-envelope"></i> {{ $lawyer->email }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p class="pims-lawyer-detail"><strong>Law Firm:</strong> {{ $lawyer->law_firm ?? 'N/A' }}</p>
                                            <p class="pims-lawyer-detail"><strong>License Number:</strong> {{ $lawyer->license_number }}</p>
                                            <p class="pims-lawyer-detail"><strong>Cases Handled:</strong> {{ $lawyer->cases_handled }}</p>
                                            <p class="pims-lawyer-detail"><strong>Contact:</strong> {{ $lawyer->contact_info }}</p>
                                            <p class="pims-lawyer-detail"><strong>Date of Birth:</strong> {{ $lawyer->date_of_birth }}</p>
                                        </div>
                                    </div>
                                    <div class="pims-lawyer-footer">
                                        <button class="pims-btn pims-btn-text pims-btn-sm pims-edit-lawyer"
                                            data-id="{{ $lawyer->lawyer_id }}"
                                            data-firstname="{{ $lawyer->first_name }}"
                                            data-lastname="{{ $lawyer->last_name }}"
                                            data-email="{{ $lawyer->email }}"
                                            data-lawfirm="{{ $lawyer->law_firm }}"
                                            data-license="{{ $lawyer->license_number }}"
                                            data-cases="{{ $lawyer->cases_handled }}"
                                            data-contact="{{ $lawyer->contact_info }}"
                                            data-dob="{{ $lawyer->date_of_birth }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="pims-btn pims-btn-secondary pims-btn-sm pims-change-password-lawyer"
                                            data-id="{{ $lawyer->lawyer_id }}"
                                            data-name="{{ $lawyer->first_name }} {{ $lawyer->last_name }}">
                                            <i class="fas fa-key"></i> Change Password
                                        </button>
                                        @if(isset($lawyer->lawyer_id))
                                        <form action="{{ route('lawyers.destroy', $lawyer->lawyer_id) }}" method="POST" class="pims-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pims-btn pims-btn-danger pims-btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Lawyer Modal -->
    <div class="pims-modal" id="pims-edit-lawyer-modal">
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-user-edit"></i> Edit Lawyer
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-edit-lawyer-modal')">×</button>
            </header>
            <section class="pims-modal-card-body">
                <form id="pims-edit-lawyer-form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="lawyer_id" id="pims-lawyer-id">

                    <div class="pims-form-group">
                        <label class="pims-form-label">First Name</label>
                        <input class="pims-form-control" type="text" name="first_name" id="pims-edit-first-name" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Last Name</label>
                        <input class="pims-form-control" type="text" name="last_name" id="pims-edit-last-name" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Email</label>
                        <input class="pims-form-control" type="email" name="email" id="pims-edit-email" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Law Firm</label>
                        <input class="pims-form-control" type="text" name="law_firm" id="pims-edit-law-firm">
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">License Number</label>
                        <input class="pims-form-control" type="text" name="license_number" id="pims-edit-license-number" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Cases Handled</label>
                        <input class="pims-form-control" type="number" name="cases_handled" id="pims-edit-cases-handled" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Contact Info</label>
                        <input class="pims-form-control" type="text" name="contact_info" id="pims-edit-contact" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Date of Birth</label>
                        <input class="pims-form-control" type="date" name="date_of_birth" id="pims-edit-dob" required>
                    </div>
                </form>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-edit-lawyer-modal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" form="pims-edit-lawyer-form" class="pims-btn pims-btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </footer>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="pims-modal" id="pims-change-password-modal">
        <div class="pims-modal-card" style="max-width: 400px;">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-key"></i> Change Password
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-change-password-modal')">×</button>
            </header>
            <section class="pims-modal-card-body">
                <form id="pims-change-password-form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="lawyer_id" id="pims-change-password-lawyer-id">
                    <div class="pims-form-group">
                        <label class="pims-form-label">New Password</label>
                        <input class="pims-form-control" type="password" name="new_password" id="pims-new-password" required minlength="8">
                    </div>
                    <div class="pims-form-group">
                        <label class="pims-form-label">Confirm Password</label>
                        <input class="pims-form-control" type="password" name="confirm_password" id="pims-confirm-password" required minlength="8">
                    </div>
                    <p class="pims-error-text" id="pims-password-error">Passwords do not match or are too short (minimum 8 characters).</p>
                </form>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-change-password-modal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" form="pims-change-password-form" class="pims-btn pims-btn-primary">
                    <i class="fas fa-save"></i> Save Password
                </button>
            </footer>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="pims-modal" id="pims-confirm-delete-modal">
        <div class="pims-modal-card" style="max-width: 400px;">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-confirm-delete-modal')">×</button>
            </header>
            <section class="pims-modal-card-body">
                <div style="text-align: center;">
                    <div class="pims-confirm-icon">
                        <i class="fas fa-trash-alt" style="font-size: 2.5rem; color: var(--pims-danger);"></i>
                    </div>
                    <p class="pims-confirm-message">
                        Are you sure you want to delete this lawyer? This action cannot be undone.
                    </p>
                </div>
            </section>
            <footer class="pims-modal-card-foot" style="justify-content: center;">
                <button class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-confirm-delete-modal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims-confirm-delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pims-btn pims-btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'CSRF token missing. Please check application setup.' });
                return;
            }

            // Initialize edit buttons
            document.querySelectorAll('.pims-edit-lawyer').forEach(button => {
                button.addEventListener('click', function() {
                    const lawyerId = this.getAttribute('data-id');
                    
                    document.getElementById('pims-lawyer-id').value = lawyerId;
                    document.getElementById('pims-edit-first-name').value = this.getAttribute('data-firstname');
                    document.getElementById('pims-edit-last-name').value = this.getAttribute('data-lastname');
                    document.getElementById('pims-edit-email').value = this.getAttribute('data-email');
                    document.getElementById('pims-edit-law-firm').value = this.getAttribute('data-lawfirm');
                    document.getElementById('pims-edit-license-number').value = this.getAttribute('data-license');
                    document.getElementById('pims-edit-cases-handled').value = this.getAttribute('data-cases');
                    document.getElementById('pims-edit-contact').value = this.getAttribute('data-contact');
                    document.getElementById('pims-edit-dob').value = this.getAttribute('data-dob');
                    
                    document.getElementById('pims-edit-lawyer-form').action = `/lawyers/${lawyerId}`;
                    document.getElementById('pims-edit-lawyer-modal').classList.add('is-active');
                });
            });

            // Initialize change password buttons
            document.querySelectorAll('.pims-change-password-lawyer').forEach(button => {
                button.addEventListener('click', function() {
                    const lawyerId = this.getAttribute('data-id');
                    document.getElementById('pims-change-password-lawyer-id').value = lawyerId;
                    document.getElementById('pims-new-password').value = '';
                    document.getElementById('pims-confirm-password').value = '';
                    document.getElementById('pims-password-error').style.display = 'none';
                    document.getElementById('pims-change-password-form').action = `/lawyers/change-password/${lawyerId}`;
                    document.getElementById('pims-change-password-modal').classList.add('is-active');
                });
            });

            // Initialize delete buttons
            document.querySelectorAll('.pims-delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    document.getElementById('pims-confirm-delete-form').action = this.action;
                    document.getElementById('pims-confirm-delete-modal').classList.add('is-active');
                });
            });

            // Search functionality
            document.getElementById('pims-search-lawyer').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const lawyerCards = document.querySelectorAll('.pims-lawyer-card');
                lawyerCards.forEach(card => {
                    const cardText = card.textContent.toLowerCase();
                    card.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
                });
            });

            // Refresh button
            document.getElementById('pims-reload-lawyers').addEventListener('click', function() {
                window.location.reload();
            });

            // Handle edit form submission
            document.getElementById('pims-edit-lawyer-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
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
                        pimsCloseModal('pims-edit-lawyer-modal');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Lawyer updated successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to update lawyer');
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
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> Save Changes';
                    submitBtn.disabled = false;
                }
            });

            // Handle change password form submission
            document.getElementById('pims-change-password-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
                const newPassword = document.getElementById('pims-new-password').value;
                const confirmPassword = document.getElementById('pims-confirm-password').value;
                const passwordError = document.getElementById('pims-password-error');

                if (newPassword.length < 8 || newPassword !== confirmPassword) {
                    passwordError.style.display = 'block';
                    return;
                }

                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
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
                        pimsCloseModal('pims-change-password-modal');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Password updated successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to update password');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message.includes('405') 
                            ? 'Password change operation not supported. Please ensure backend supports PUT method.'
                            : error.message || 'Something went wrong!'
                    });
                } finally {
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> Save Password';
                    submitBtn.disabled = false;
                }
            });

            // Handle delete form submission
            document.getElementById('pims-confirm-delete-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
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
                        pimsCloseModal('pims-confirm-delete-modal');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Lawyer deleted successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to delete lawyer');
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
                    submitBtn.innerHTML = '<i class="fas fa-trash"></i> Delete';
                    submitBtn.disabled = false;
                }
            });
        });

        function pimsCloseModal(modalId) {
            document.getElementById(modalId).classList.remove('is-active');
        }
    </script>
</body>
</html>