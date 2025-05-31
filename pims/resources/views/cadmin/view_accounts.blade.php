<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Account Management</title>
    
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-card-body {
            padding: 1.25rem;
        }

        /* Account Card Styles */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-account-card {
            transition: var(--pims-transition);
        }

        .pims-account-card:hover {
            transform: translateY(-5px);
        }

        .pims-account-image {
            border-radius: 50%;
            border: 3px solid var(--pims-accent);
            object-fit: cover;
        }

        .pims-account-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-account-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .pims-account-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims-account-detail strong {
            color: var(--pims-primary);
            font-weight: 600;
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
            max-width: 500px;
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

        /* Confirmation Dialog */
        .pims-confirm-dialog .pims-modal-card {
            max-width: 400px;
            text-align: center;
        }

        .pims-confirm-icon {
            font-size: 2.5rem;
            color: var(--pims-danger);
            margin-bottom: 1rem;
        }

        .pims-confirm-message {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .pims-confirm-buttons {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .pims-pagination-link {
            padding: 0.5rem 0.75rem;
            border-radius: var(--pims-border-radius);
            border: 1px solid #ddd;
            color: var(--pims-primary);
            font-weight: 600;
            transition: var(--pims-transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims-pagination-link:hover {
            background-color: var(--pims-accent);
            color: white;
            border-color: var(--pims-accent);
            transform: translateY(-2px);
        }

        .pims-pagination-link.is-current {
            background-color: var(--pims-primary);
            color: white;
            border-color: var(--pims-primary);
        }

        .pims-pagination-link.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Status Badges */
        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-status-active {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--pims-success);
        }

        .pims-status-inactive {
            background-color: rgba(149, 165, 166, 0.1);
            color: #95a5a6;
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

            .pims-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Utility Classes */
        .pims-mt-1 { margin-top: 0.5rem; }
        .pims-mt-2 { margin-top: 1rem; }
        .pims-mt-3 { margin-top: 1.5rem; }
        .pims-mb-1 { margin-bottom: 0.5rem; }
        .pims-mb-2 { margin-bottom: 1rem; }
        .pims-mb-3 { margin-bottom: 1.5rem; }
        .pims-text-center { text-align: center; }
        .pims-text-danger { color: var(--pims-danger); }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('cadmin.menu')

        <div class="pims-content-area">
            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-user-shield"></i> Account Management
                    </h2>
                    <div class="pims-card-actions">
                        <a href="{{ route('account.add') }}" class="pims-btn pims-btn-primary">
                            <i class="fas fa-plus"></i> Create Account
                        </a>
                        <button id="pims-table-reload" class="pims-btn pims-btn-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="pims-card-body">
                    <!-- Search and Filter -->
                    <div class="pims-mb-3">
                        <div class="field is-grouped is-grouped-right">
                            <div class="control has-icons-left" style="flex-grow: 1; max-width: 300px;">
                                <input class="pims-form-control" id="pims-table-search" type="text" placeholder="Search accounts...">
                                <span class="icon is-left" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <div class="control">
                                <div class="select">
                                    <select id="pims-table-length" class="pims-form-control">
                                        <option value="10">Show 10</option>
                                        <option value="25">Show 25</option>
                                        <option value="50">Show 50</option>
                                        <option value="100">Show 100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Cards Grid -->
                    <div class="pims-grid">
                        @foreach($accounts as $account)
                        <div class="pims-account-card">
                            <div class="pims-card">
                                <div class="pims-card-body">
                                    <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                        <div class="media-left" style="margin-right: 1rem;">
                                            <figure class="image is-48x48">
                                                @if($account->user_image)
                                                    <img src="{{ asset('storage/' . $account->user_image) }}" alt="User Image" class="pims-account-image" style="width: 48px; height: 48px;">
                                                @else
                                                    <img src="{{ asset('default-profile.png') }}" alt="Default Image" class="pims-account-image" style="width: 48px; height: 48px;">
                                                @endif
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <p class="pims-account-title">{{ $account->username }}</p>
                                            <p class="pims-account-subtitle">{{ $account->role ? $account->role->name : 'N/A' }}</p>
                                            <span class="pims-status-badge pims-status-active">Active</span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p class="pims-account-detail"><strong>Prison:</strong> {{ $account->prison ? $account->prison->name : 'N/A' }}</p>
                                        <p class="pims-account-detail"><strong>Name:</strong> {{ $account->first_name }} {{ $account->last_name }}</p>
                                        <p class="pims-account-detail"><strong>Email:</strong> {{ $account->email }}</p>
                                        <p class="pims-account-detail"><strong>Phone:</strong> {{ $account->phone_number }}</p>
                                    </div>
                                </div>
                                <div class="pims-card-footer" style="padding: 1rem; border-top: 1px solid rgba(0, 0, 0, 0.05);">
                                    <div class="buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                        <button class="pims-btn pims-btn-primary pims-btn-sm pims-edit-btn"
                                            data-id="{{ $account->user_id }}"
                                            data-first-name="{{ $account->first_name }}"
                                            data-last-name="{{ $account->last_name }}"
                                            data-email="{{ $account->email }}"
                                            data-phone="{{ $account->phone_number }}"
                                            data-address="{{ $account->address }}"
                                            data-role-id="{{ $account->role_id }}"
                                            data-role-name="{{ $account->role ? $account->role->name : 'N/A' }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="pims-btn pims-btn-secondary pims-btn-sm pims-change-password-btn"
                                            data-id="{{ $account->user_id }}"
                                            data-username="{{ $account->username }}">
                                            <i class="fas fa-key"></i> Change Password
                                        </button>
                                        <button class="pims-btn pims-btn-danger pims-btn-sm pims-delete-btn"
                                            data-id="{{ $account->user_id }}"
                                            data-username="{{ $account->username }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pims-pagination">
                        @if($accounts->currentPage() > 1)
                        <a class="pims-pagination-link" href="{{ $accounts->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @else
                        <a class="pims-pagination-link is-disabled" href="#">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @endif

                        @foreach($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
                        <a class="pims-pagination-link {{ $page == $accounts->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                            {{ $page }}
                        </a>
                        @endforeach

                        @if($accounts->hasMorePages())
                        <a class="pims-pagination-link" href="{{ $accounts->nextPageUrl() }}">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                        @else
                        <a class="pims-pagination-link is-disabled" href="#">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Account Modal -->
    <div class="pims-modal" id="pims-edit-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-user-edit"></i> Edit Account
                </p>
                <button class="pims-modal-close">×</button>
            </header>
            <form id="pims-edit-form" method="POST">
                @csrf
                @method('PUT')
                <section class="pims-modal-card-body">
                    <input type="hidden" name="user_id" id="pims-edit-user-id">
                    <div class="pims-form-group">
                        <label for="pims-edit-first-name" class="pims-form-label">First Name</label>
                        <input class="pims-form-control" type="text" name="first_name" id="pims-edit-first-name" required>
                    </div>
                    <div class="pims-form-group">
                        <label for="pims-edit-last-name" class="pims-form-label">Last Name</label>
                        <input class="pims-form-control" type="text" name="last_name" id="pims-edit-last-name" required>
                    </div>
                    <div class="pims-form-group">
                        <label for="pims-edit-email" class="pims-form-label">Email</label>
                        <input class="pims-form-control" type="email" name="email" id="pims-edit-email" required>
                    </div>
                    <div class="pims-form-group">
                        <label for="pims-edit-phone" class="pims-form-label">Phone Number</label>
                        <input class="pims-form-control" type="text" name="phone_number" id="pims-edit-phone">
                    </div>
                    <div class="pims-form-group">
                        <label for="pims-edit-address" class="pims-form-label">Address</label>
                        <input class="pims-form-control" type="text" name="address" id="pims-edit-address">
                    </div>
                    <div class="pims-form-group">
                        <label for="pims-edit-role" class="pims-form-label">Role</label>
                        <select class="pims-form-control" name="role_id" id="pims-edit-role">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </section>
                <footer class="pims-modal-card-foot">
                    <button type="button" class="pims-btn pims-btn-secondary pims-close-modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="pims-btn pims-btn-primary pims-save-btn">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="pims-modal" id="pims-change-password-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-key"></i> Change Password
                </p>
                <button class="pims-modal-close">×</button>
            </header>
            <form id="pims-change-password-form" method="POST">
                @csrf
                @method('put')
                <section class="pims-modal-card-body">
                    <input type="hidden" name="user_id" id="pims-change-password-user-id">
                    <div class="pims-form-group">
                        <label for="pims-new-password" class="pims-form-label">New Password</label>
                        <input class="pims-form-control" type="password" name="new_password" id="pims-new-password" required minlength="8">
                    </div>
                    <div class="pims-form-group">
                        <label for="pims-confirm-password" class="pims-form-label">Confirm Password</label>
                        <input class="pims-form-control" type="password" name="confirm_password" id="pims-confirm-password" required minlength="8">
                    </div>
                    <p class="pims-text-danger pims-mt-1" id="pims-password-error" style="display: none;">
                        Passwords do not match or are too short (minimum 8 characters).
                    </p>
                </section>
                <footer class="pims-modal-card-foot">
                    <button type="button" class="pims-btn pims-btn-secondary pims-close-modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="pims-btn pims-btn-primary pims-save-password-btn">
                        <i class="fas fa-save"></i> Save Password
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="pims-modal pims-confirm-dialog" id="pims-delete-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims-modal-close">×</button>
            </header>
            <section class="pims-modal-card-body">
                <div class="pims-confirm-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <p class="pims-confirm-message">
                    Are you sure you want to delete account <strong id="pims-delete-username"></strong>? 
                    This action cannot be undone.
                </p>
            </section>
            <footer class="pims-modal-card-foot">
                <div class="pims-confirm-buttons">
                    <button type="button" class="pims-btn pims-btn-secondary pims-close-modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <form id="pims-delete-form" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="pims-btn pims-btn-danger">
                            <i class="fas fa-trash"></i> Delete Account
                        </button>
                    </form>
                </div>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Account Modal
            const editButtons = document.querySelectorAll('.pims-edit-btn');
            const editModal = document.getElementById('pims-edit-modal');
            const editForm = document.getElementById('pims-edit-form');

            // Delete Confirmation Modal
            const deleteModal = document.getElementById('pims-delete-modal');
            const deleteForm = document.getElementById('pims-delete-form');
            const deleteUsername = document.getElementById('pims-delete-username');

            // Change Password Modal
            const changePasswordButtons = document.querySelectorAll('.pims-change-password-btn');
            const changePasswordModal = document.getElementById('pims-change-password-modal');
            const changePasswordForm = document.getElementById('pims-change-password-form');
            const passwordError = document.getElementById('pims-password-error');
            const newPasswordInput = document.getElementById('pims-new-password');
            const confirmPasswordInput = document.getElementById('pims-confirm-password');

            // Close Modal Buttons
            const closeModalButtons = document.querySelectorAll('.pims-modal-close, .pims-close-modal');
            let currentDeleteUrl = '';

            // Initialize edit buttons
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.id;
                    const firstName = this.dataset.firstName;
                    const lastName = this.dataset.lastName;
                    const email = this.dataset.email;
                    const phone = this.dataset.phone;
                    const address = this.dataset.address;
                    const roleId = this.dataset.roleId;

                    document.getElementById('pims-edit-user-id').value = userId;
                    document.getElementById('pims-edit-first-name').value = firstName;
                    document.getElementById('pims-edit-last-name').value = lastName;
                    document.getElementById('pims-edit-email').value = email;
                    document.getElementById('pims-edit-phone').value = phone;
                    document.getElementById('pims-edit-address').value = address;
                    document.getElementById('pims-edit-role').value = roleId;

                    editForm.action = `/saccount/update/${userId}`;
                    editModal.classList.add('is-active');
                });
            });

            // Initialize change password buttons
            changePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.id;
                    document.getElementById('pims-change-password-user-id').value = userId;
                    changePasswordForm.action = `/saccount/change-password/${userId}`;
                    changePasswordModal.classList.add('is-active');
                    newPasswordInput.value = '';
                    confirmPasswordInput.value = '';
                    passwordError.style.display = 'none';
                });
            });

            // Initialize delete buttons
            document.querySelectorAll('.pims-delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.id;
                    const username = this.dataset.username;
                    deleteUsername.textContent = username;
                    currentDeleteUrl = `/caccount/${userId}`;
                    deleteModal.classList.add('is-active');
                });
            });

            // Handle edit form submission
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = this.querySelector('.pims-save-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;
                this.submit();
            });

            // Handle change password form submission
            changePasswordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const newPassword = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (newPassword.length < 8 || newPassword !== confirmPassword) {
                    passwordError.style.display = 'block';
                    return;
                }

                const submitBtn = this.querySelector('.pims-save-password-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;
                this.submit();
            });

            // Handle delete form submission
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                submitBtn.disabled = true;
                this.action = currentDeleteUrl;
                this.submit();
            });

            // Close modals
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    editModal.classList.remove('is-active');
                    changePasswordModal.classList.remove('is-active');
                    deleteModal.classList.remove('is-active');
                });
            });

            // Close modal when clicking outside
            [editModal, changePasswordModal, deleteModal].forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.classList.remove('is-active');
                    }
                });
            });

            // Table Reload
            document.getElementById('pims-table-reload').addEventListener('click', function() {
                window.location.reload();
            });

            // Table Search
            document.getElementById('pims-table-search').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const accountCards = document.querySelectorAll('.pims-account-card');
                accountCards.forEach(card => {
                    const cardText = card.textContent.toLowerCase();
                    card.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
                });
            });

            // Table Length
            document.getElementById('pims-table-length').addEventListener('change', function() {
                const url = new URL(window.location.href);
                url.searchParams.set('length', this.value);
                window.location.href = url.toString();
            });
        });
    </script>
</body>
</html>