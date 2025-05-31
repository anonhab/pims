<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Account Management</title>
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

        .app-container {
            display: flex;
            min-height: 100vh;
            padding-top: 70px;
        }

        .main-content {
            flex: 1;
            padding: clamp(1rem, 3vw, 2rem);
            margin-left: 250px;
            transition: var(--transition);
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: clamp(1.5rem, 4vw, 1.75rem);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-title i {
            color: var(--accent);
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .search-filter {
            margin-bottom: 2rem;
        }

        .search-box {
            max-width: 400px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .account-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
            overflow: hidden;
        }

        .account-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .card-header {
            padding: 1.5rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            border: 3px solid #fff;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .user-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-role {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .info-item i {
            width: 24px;
            color: var(--accent);
            margin-right: 0.75rem;
        }

        .card-footer {
            display: flex;
            border-top: 1px solid #eee;
            padding: 1rem;
            gap: 0.5rem;
        }

        .btn {
            flex: 1;
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
        }

        .btn-outline:hover {
            background: rgba(52,152,219,0.1);
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .btn-light {
            background: var(--light);
            color: var(--secondary);
        }

        .btn-light:hover {
            background: #dfe6e9;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--secondary);
            margin-bottom: 1.5rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .pagination-link {
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pagination-link:hover:not(.disabled) {
            background: var(--light);
        }

        .pagination-link.active {
            background: var(--accent);
            color: #fff;
        }

        .pagination-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-pages {
            display: flex;
            gap: 0.25rem;
        }

        .modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.5);
        }

        .modal.active {
            display: flex;
        }

        .modal-container {
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
            from { transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .modal-header i {
            color: var(--accent);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--secondary);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--primary);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: var(--font-size-base);
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .confirm-modal .modal-container {
            max-width: 400px;
        }

        .confirm-icon {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .confirm-icon i {
            font-size: 3rem;
            color: var(--danger);
        }

        .confirm-message {
            text-align: center;
            margin-bottom: 2rem;
        }

        .confirm-message h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .error-text {
            color: var(--danger);
            font-size: 0.9rem;
            margin-top: 0.5rem;
            display: none;
        }

        @media (max-width: 992px) {
            .main-content { margin-left: 0; }
            .cards-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
        }

        @media (max-width: 768px) {
            .search-box { max-width: 100%; }
            .pagination { flex-direction: column; gap: 1rem; }
            .pagination-pages { order: -1; }
        }

        @media (max-width: 480px) {
            .card-footer { flex-direction: column; }
            .card-footer .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="app-container">
        @include('includes.nav')
        @include('sysadmin.menu')
        <main class="main-content">
            <div class="content-container">
                <div class="page-header">
                    <h2 class="page-title">
                        <i class="fas fa-user-shield" aria-hidden="true"></i> Account Management
                    </h2>
                    <div class="header-actions">
                        <a href="{{ route('saccount.add') }}" class="btn btn-primary">
                            <i class="fas fa-plus" aria-hidden="true"></i> Create New Account
                        </a>
                    </div>
                </div>

                <div class="search-filter">
                    <div class="search-box">
                        <input type="text" id="search-input" class="form-control" placeholder="Search by name, email, phone..." aria-label="Search accounts">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="cards-grid">
                    @if($accounts->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-user-slash" aria-hidden="true"></i>
                            <h3>No Accounts Found</h3>
                            <p>There are currently no accounts in the system</p>
                            <a href="{{ route('saccount.add') }}" class="btn btn-primary">
                                <i class="fas fa-plus" aria-hidden="true"></i> Create First Account
                            </a>
                        </div>
                    @else
                        @foreach($accounts as $account)
                            <div class="account-card">
                                <div class="card-header">
                                    <div class="user-avatar">
                                        <img src="{{ $account->user_image ? asset('storage/' . $account->user_image) : asset('default-profile.png') }}"
                                             alt="Profile image for {{ $account->first_name }} {{ $account->last_name }}"
                                             loading="lazy">
                                    </div>
                                    <h3 class="user-name">{{ $account->first_name }} {{ $account->last_name }}</h3>
                                    <span class="user-role">{{ $account->role ? $account->role->name : 'N/A' }}</span>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <i class="fas fa-envelope" aria-hidden="true"></i>
                                        <span>{{ $account->email }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-phone" aria-hidden="true"></i>
                                        <span>{{ $account->phone_number ?: 'N/A' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-building" aria-hidden="true"></i>
                                        <span>{{ $account->prison ? $account->prison->name : 'N/A' }}</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-venus-mars" aria-hidden="true"></i>
                                        <span>{{ $account->gender }}</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-outline edit-btn"
                                            data-id="{{ $account->user_id }}"
                                            data-first-name="{{ $account->first_name }}"
                                            data-last-name="{{ $account->last_name }}"
                                            data-email="{{ $account->email }}"
                                            data-phone="{{ $account->phone_number }}"
                                            data-address="{{ $account->address }}"
                                            data-role-id="{{ $account->role_id }}"
                                            data-dob="{{ $account->dob ? $account->dob->format('Y-m-d') : '' }}"
                                            data-gender="{{ $account->gender }}"
                                            data-prison-id="{{ $account->prison_id }}"
                                            aria-label="Edit account for {{ $account->first_name }} {{ $account->last_name }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i> Edit
                                    </button>
                                    <button class="btn btn-light change-password-btn"
                                            data-id="{{ $account->user_id }}"
                                            data-name="{{ $account->first_name }} {{ $account->last_name }}"
                                            aria-label="Change password for {{ $account->first_name }} {{ $account->last_name }}">
                                        <i class="fas fa-key" aria-hidden="true"></i> Change Password
                                    </button>
                                    <button class="btn btn-danger delete-btn"
                                            data-id="{{ $account->user_id }}"
                                            data-name="{{ $account->first_name }} {{ $account->last_name }}"
                                            aria-label="Delete account for {{ $account->first_name }} {{ $account->last_name }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i> Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if($accounts->hasPages())
                    <nav class="pagination" aria-label="Pagination">
                        @if($accounts->currentPage() > 1)
                            <a href="{{ $accounts->previousPageUrl() }}" class="pagination-link" aria-label="Previous page">
                                <i class="fas fa-chevron-left" aria-hidden="true"></i> Previous
                            </a>
                        @else
                            <span class="pagination-link disabled" aria-disabled="true">
                                <i class="fas fa-chevron-left" aria-hidden="true"></i> Previous
                            </span>
                        @endif
                        <div class="pagination-pages">
                            @foreach($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
                                <a href="{{ $url }}"
                                   class="pagination-link {{ $page == $accounts->currentPage() ? 'active' : '' }}"
                                   aria-current="{{ $page == $accounts->currentPage() ? 'page' : 'false' }}"
                                   aria-label="Page {{ $page }}">{{ $page }}</a>
                            @endforeach
                        </div>
                        @if($accounts->hasMorePages())
                            <a href="{{ $accounts->nextPageUrl() }}" class="pagination-link" aria-label="Next page">
                                Next <i class="fas fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled" aria-disabled="true">
                                Next <i class="fas fa-chevron-right" aria-hidden="true"></i>
                            </span>
                        @endif
                    </nav>
                @endif
            </div>
        </main>
    </div>

    <!-- Edit Account Modal -->
    <div class="modal" id="edit-modal" role="dialog" aria-labelledby="edit-modal-title" aria-hidden="true">
        <div class="modal-container">
            <div class="modal-header">
                <h3 id="edit-modal-title">
                    <i class="fas fa-user-edit" aria-hidden="true"></i> Edit Account
                </h3>
                <button class="modal-close" aria-label="Close edit modal">×</button>
            </div>
            <form id="edit-form" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="user_id" id="edit-user-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-first-name">First Name</label>
                        <input type="text" name="first_name" id="edit-first-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-last-name">Last Name</label>
                        <input type="text" name="last_name" id="edit-last-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-phone">Phone Number</label>
                        <input type="text" name="phone_number" id="edit-phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="edit-dob">Date of Birth</label>
                        <input type="date" name="dob" id="edit-dob" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="edit-gender">Gender</label>
                        <select name="gender" id="edit-gender" class="form-control" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-address">Address</label>
                        <textarea name="address" id="edit-address" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-role">Role</label>
                        <select name="role_id" id="edit-role" class="form-control" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-prison">Prison</label>
                        <select name="prison_id" id="edit-prison" class="form-control">
                            <option value="">None</option>
                            @foreach($prisons as $prison)
                                <option value="{{ $prison->id }}">{{ $prison->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light modal-close-btn" aria-label="Cancel edit">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal" id="change-password-modal" role="dialog" aria-labelledby="change-password-modal-title" aria-hidden="true">
        <div class="modal-container">
            <div class="modal-header">
                <h3 id="change-password-modal-title">
                    <i class="fas fa-key" aria-hidden="true"></i> Change Password
                </h3>
                <button class="modal-close" aria-label="Close change password modal">×</button>
            </div>
            <form id="change-password-form" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="user_id" id="change-password-user-id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" name="new_password" id="new-password" class="form-control" required minlength="8">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm-password" class="form-control" required minlength="8">
                    </div>
                    <p class="error-text" id="password-error">Passwords do not match or are too short (minimum 8 characters).</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light modal-close-btn" aria-label="Cancel change password">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="save-password-btn">Save Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal confirm-modal" id="delete-modal" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
        <div class="modal-container">
            <div class="modal-header">
                <h3 id="delete-modal-title">
                    <i class="fas fa-exclamation-triangle" aria-hidden="true"></i> Confirm Deletion
                </h3>
                <button class="modal-close" aria-label="Close delete modal">×</button>
            </div>
            <div class="modal-body">
                <div class="confirm-icon">
                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </div>
                <div class="confirm-message">
                    <h4>Delete Account?</h4>
                    <p>Are you sure you want to delete <strong id="delete-name"></strong>? This action cannot be undone.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light modal-close-btn" aria-label="Cancel delete">Cancel</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'CSRF token missing. Please check application setup.' });
                return;
            }

            const debounce = (fn, delay) => {
                let timeout;
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => fn(...args), delay);
                };
            };

            const editModal = document.getElementById('edit-modal');
            const changePasswordModal = document.getElementById('change-password-modal');
            const deleteModal = document.getElementById('delete-modal');

            const closeAllModals = () => {
                editModal.classList.remove('active');
                changePasswordModal.classList.remove('active');
                deleteModal.classList.remove('active');
                editModal.setAttribute('aria-hidden', 'true');
                changePasswordModal.setAttribute('aria-hidden', 'true');
                deleteModal.setAttribute('aria-hidden', 'true');
            };

            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(() => {
                    const searchTerm = searchInput.value.toLowerCase();
                    document.querySelectorAll('.account-card').forEach(card => {
                        const name = card.querySelector('.user-name').textContent.toLowerCase();
                        const email = card.querySelector('.info-item:nth-child(1) span').textContent.toLowerCase();
                        const phone = card.querySelector('.info-item:nth-child(2) span').textContent.toLowerCase();
                        const prison = card.querySelector('.info-item:nth-child(3) span').textContent.toLowerCase();
                        card.style.display = (name.includes(searchTerm) || email.includes(searchTerm) 
                            || phone.includes(searchTerm) || prison.includes(searchTerm)) ? 'block' : 'none';
                    });
                }, 300));
            }

            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    document.getElementById('edit-user-id').value = btn.dataset.id;
                    document.getElementById('edit-first-name').value = btn.dataset.firstName;
                    document.getElementById('edit-last-name').value = btn.dataset.lastName;
                    document.getElementById('edit-email').value = btn.dataset.email;
                    document.getElementById('edit-phone').value = btn.dataset.phone || '';
                    document.getElementById('edit-dob').value = btn.dataset.dob || '';
                    document.getElementById('edit-gender').value = btn.dataset.gender || '';
                    document.getElementById('edit-address').value = btn.dataset.address || '';
                    document.getElementById('edit-role').value = btn.dataset.roleId || '';
                    document.getElementById('edit-prison').value = btn.dataset.prisonId || '';
                    editModal.classList.add('active');
                    editModal.setAttribute('aria-hidden', 'false');
                    document.getElementById('edit-first-name').focus();
                });
            });

            document.querySelectorAll('.change-password-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    document.getElementById('change-password-user-id').value = btn.dataset.id;
                    document.getElementById('new-password').value = '';
                    document.getElementById('confirm-password').value = '';
                    document.getElementById('password-error').style.display = 'none';
                    changePasswordModal.classList.add('active');
                    changePasswordModal.setAttribute('aria-hidden', 'false');
                    document.getElementById('new-password').focus();
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    document.getElementById('delete-name').textContent = btn.dataset.name;
                    document.getElementById('delete-form').action = `/saccount/${btn.dataset.id}`;
                    deleteModal.classList.add('active');
                    deleteModal.setAttribute('aria-hidden', 'false');
                });
            });

            document.querySelectorAll('.modal-close, .modal-close-btn').forEach(btn => {
                btn.addEventListener('click', closeAllModals);
            });

            window.addEventListener('click', e => {
                if (e.target.classList.contains('modal')) {
                    closeAllModals();
                }
            });

            document.getElementById('edit-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
                const userId = document.getElementById('edit-user-id').value;
                try {
                    const formData = new FormData(form);
                    formData.delete('_method');
                    const data = Object.fromEntries(formData);
                    data._method = 'PUT';
                    const response = await fetch(`/saccount/${userId}`, {
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
                            text: 'Account updated successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to update account');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message.includes('405') 
                            ? 'Update operation not supported. Please ensure backend supports PUT method.'
                            : error.message || 'Something went wrong!'
                    });
                }
            });

            document.getElementById('change-password-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
                const userId = document.getElementById('change-password-user-id').value;
                const newPassword = document.getElementById('new-password').value;
                const confirmPassword = document.getElementById('confirm-password').value;
                const passwordError = document.getElementById('password-error');

                if (newPassword.length < 8 || newPassword !== confirmPassword) {
                    passwordError.style.display = 'block';
                    return;
                }

                try {
                    const formData = new FormData(form);
                    formData.delete('_method');
                    const data = Object.fromEntries(formData);
                    data._method = 'PUT';
                    const response = await fetch(`/sysaccount/change-password/${userId}`, {
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
                }
            });

            document.getElementById('delete-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
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
                            text: 'Account deleted successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to delete account');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message.includes('405') 
                            ? 'Delete operation not supported. Please ensure backend supports DELETE method.'
                            : error.message || 'Something went wrong!'
                    });
                }
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && (editModal.classList.contains('active') || changePasswordModal.classList.contains('active') || deleteModal.classList.contains('active'))) {
                    closeAllModals();
                }
            });
        });
    </script>
    @include('includes.footer_js')
</body>
</html>