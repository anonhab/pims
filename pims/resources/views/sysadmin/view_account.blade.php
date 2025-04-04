<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Accounts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pims-primary: #2c3e50;
            --pims-secondary: #34495e;
            --pims-accent: #3498db;
            --pims-light: #ecf0f1;
            --pims-lighter: #f8f9fa;
            --pims-danger: #e74c3c;
            --pims-success: #2ecc71;
            --pims-warning: #f39c12;
            --pims-border-radius: 8px;
            --pims-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
        }

        /* Main Layout */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
        }

        .pims-main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 250px;
            transition: var(--pims-transition);
        }

        .pims-content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Styles */
        .pims-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .pims-page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-page-title i {
            color: var(--pims-accent);
        }

        .pims-header-actions {
            display: flex;
            gap: 1rem;
        }

        /* Search Styles */
        .pims-search-filter {
            margin-bottom: 2rem;
        }

        .pims-search-box {
            max-width: 400px;
        }

        .pims-search-control {
            position: relative;
        }

        .pims-search-control input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-search-control input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .pims-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-secondary);
        }

        /* Cards Grid */
        .pims-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .pims-account-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            transition: var(--pims-transition);
        }

        .pims-account-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .pims-card-header {
            padding: 1.5rem;
            text-align: center;
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
        }

        .pims-user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            border: 3px solid white;
            overflow: hidden;
        }

        .pims-user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pims-user-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .pims-user-role {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        .pims-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .pims-info-item:last-child {
            margin-bottom: 0;
        }

        .pims-info-item i {
            width: 24px;
            color: var(--pims-accent);
            margin-right: 0.75rem;
        }

        .pims-card-footer {
            display: flex;
            border-top: 1px solid #eee;
            padding: 1rem;
        }

        .pims-card-footer .pims-btn {
            flex: 1;
            margin: 0 0.25rem;
        }

        /* Button Styles */
        .pims-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-size: 0.9rem;
            gap: 0.5rem;
        }

        .pims-btn i {
            font-size: 0.9em;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: #2980b9;
        }

        .pims-btn-outline {
            background-color: transparent;
            border: 1px solid var(--pims-accent);
            color: var(--pims-accent);
        }

        .pims-btn-outline:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #c0392b;
        }

        .pims-btn-light {
            background-color: var(--pims-light);
            color: var(--pims-secondary);
        }

        .pims-btn-light:hover {
            background-color: #dfe6e9;
        }

        /* Empty State */
        .pims-empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
        }

        .pims-empty-state i {
            font-size: 3rem;
            color: var(--pims-accent);
            margin-bottom: 1rem;
        }

        .pims-empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--pims-primary);
        }

        .pims-empty-state p {
            color: var(--pims-secondary);
            margin-bottom: 1.5rem;
        }

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pims-pagination-link {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            color: var(--pims-primary);
            text-decoration: none;
            transition: var(--pims-transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-pagination-link:hover:not(.disabled) {
            background-color: var(--pims-light);
        }

        .pims-pagination-link.active {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-pagination-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pims-pagination-pages {
            display: flex;
            gap: 0.25rem;
        }

        /* Modal Styles */
        .pims-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .pims-modal.active {
            display: flex;
        }

        .pims-modal-container {
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
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
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-header i {
            color: var(--pims-accent);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--pims-secondary);
            transition: var(--pims-transition);
        }

        .pims-modal-close:hover {
            color: var(--pims-primary);
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

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        /* Delete Confirmation Modal */
        .pims-confirm-modal .pims-modal-container {
            max-width: 400px;
        }

        .pims-confirm-icon {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .pims-confirm-icon i {
            font-size: 3rem;
            color: var(--pims-danger);
        }

        .pims-confirm-message {
            text-align: center;
            margin-bottom: 2rem;
        }

        .pims-confirm-message h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--pims-primary);
        }

        .pims-confirm-message p {
            color: var(--pims-secondary);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
            
            .pims-cards-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .pims-page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .pims-search-box {
                max-width: 100%;
            }
            
            .pims-pagination {
                flex-direction: column;
                gap: 1rem;
            }
            
            .pims-pagination-pages {
                order: -1;
            }
            
            .pims-modal-container {
                width: 95%;
            }
        }

        @media (max-width: 480px) {
            .pims-card-footer {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .pims-card-footer .pims-btn {
                width: 100%;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="pims-app-container">
        <!-- Navigation -->
        @include('includes.nav')
        
        <!-- Sidebar -->
        @include('sysadmin.menu')
        
        <main class="pims-main-content">
            <div class="pims-content-container">
                <!-- Page Header -->
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-user-shield"></i> Account Management
                    </h2>
                    <div class="pims-header-actions">
                        <a href="{{ route('saccount.add') }}" class="pims-btn pims-btn-primary">
                            <i class="fas fa-plus"></i> Create New Account
                        </a>
                    </div>
                </div>
                
                <!-- Search and Filters -->
                <div class="pims-search-filter">
                    <div class="pims-search-box">
                        <div class="pims-search-control">
                            <input type="text" id="pims-table-search" class="pims-form-control" placeholder="Search by name, email, phone...">
                            <i class="fas fa-search pims-search-icon"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Accounts Grid -->
                <div class="pims-cards-grid">
                    @if($accounts->isEmpty())
                    <div class="pims-empty-state">
                        <i class="fas fa-user-slash"></i>
                        <h3>No Accounts Found</h3>
                        <p>There are currently no accounts in the system</p>
                        <a href="{{ route('saccount.add') }}" class="pims-btn pims-btn-primary">
                            <i class="fas fa-plus"></i> Create First Account
                        </a>
                    </div>
                    @else
                    @foreach($accounts as $account)
                    <div class="pims-account-card">
                        <div class="pims-card-header">
                            <div class="pims-user-avatar">
                                @if($account->user_image)
                                <img src="{{ asset('storage/' . $account->user_image) }}" alt="User Image">
                                @else
                                <img src="{{ asset('default-profile.png') }}" alt="Default Image">
                                @endif
                            </div>
                            <h3 class="pims-user-name">{{ $account->first_name }} {{ $account->last_name }}</h3>
                            <span class="pims-user-role">{{ $account->role ? $account->role->name : 'N/A' }}</span>
                        </div>
                        
                        <div class="pims-card-body">
                            <div class="pims-info-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $account->email }}</span>
                            </div>
                            <div class="pims-info-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $account->phone_number ?: 'N/A' }}</span>
                            </div>
                            <div class="pims-info-item">
                                <i class="fas fa-building"></i>
                                <span>{{ $account->prison ? $account->prison->name : 'N/A' }}</span>
                            </div>
                            <div class="pims-info-item">
                                <i class="fas fa-venus-mars"></i>
                                <span>{{ $account->gender }}</span>
                            </div>
                        </div>
                        
                        <div class="pims-card-footer">
                            <button class="pims-btn pims-btn-outline pims-edit-btn"
                                data-id="{{ $account->user_id }}"
                                data-first-name="{{ $account->first_name }}"
                                data-last-name="{{ $account->last_name }}"
                                data-email="{{ $account->email }}"
                                data-phone="{{ $account->phone_number }}"
                                data-address="{{ $account->address }}"
                                data-role-id="{{ $account->role_id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            
                            <button class="pims-btn pims-btn-danger pims-delete-btn"
                                data-id="{{ $account->user_id }}"
                                data-name="{{ $account->first_name }} {{ $account->last_name }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                
                <!-- Pagination -->
                @if($accounts->hasPages())
                <div class="pims-pagination">
                    @if($accounts->currentPage() > 1)
                    <a href="{{ $accounts->previousPageUrl() }}" class="pims-pagination-link">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                    @else
                    <span class="pims-pagination-link disabled">
                        <i class="fas fa-chevron-left"></i> Previous
                    </span>
                    @endif
                    
                    <div class="pims-pagination-pages">
                        @foreach($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="pims-pagination-link {{ $page == $accounts->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                        @endforeach
                    </div>
                    
                    @if($accounts->hasMorePages())
                    <a href="{{ $accounts->nextPageUrl() }}" class="pims-pagination-link">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                    @else
                    <span class="pims-pagination-link disabled">
                        Next <i class="fas fa-chevron-right"></i>
                    </span>
                    @endif
                </div>
                @endif
            </div>
        </main>
    </div>
    
    <!-- Edit Modal -->
    <div class="pims-modal" id="pims-edit-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3><i class="fas fa-user-edit"></i> Edit Account</h3>
                <button class="pims-modal-close">&times;</button>
            </div>
            
            <form id="pims-edit-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" id="pims-edit-user-id">
                
                <div class="pims-modal-body">
                    <div class="pims-form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="pims-edit-first-name" class="pims-form-control" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="pims-edit-last-name" class="pims-form-control" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="pims-edit-email" class="pims-form-control" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" id="pims-edit-phone" class="pims-form-control">
                    </div>
                    
                    <div class="pims-form-group">
                        <label>Address</label>
                        <textarea name="address" id="pims-edit-address" class="pims-form-control" required></textarea>
                    </div>
                    
                    <div class="pims-form-group">
                        <label>Role</label>
                        <select name="role_id" id="pims-edit-role" class="pims-form-control" required>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-light pims-modal-close-btn">Cancel</button>
                    <button type="submit" class="pims-btn pims-btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="pims-modal pims-confirm-modal" id="pims-delete-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h3>
                <button class="pims-modal-close">&times;</button>
            </div>
            
            <div class="pims-modal-body">
                <div class="pims-confirm-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <div class="pims-confirm-message">
                    <h4>Delete Account?</h4>
                    <p>Are you sure you want to delete <strong id="pims-delete-name"></strong>? This action cannot be undone.</p>
                </div>
            </div>
            
            <div class="pims-modal-footer">
                <button type="button" class="pims-btn pims-btn-light pims-modal-close-btn">Cancel</button>
                <form id="pims-delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pims-btn pims-btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('pims-table-search');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const cards = document.querySelectorAll('.pims-account-card');
                    
                    cards.forEach(card => {
                        const name = card.querySelector('.pims-user-name').textContent.toLowerCase();
                        const email = card.querySelector('.pims-info-item:nth-child(1) span').textContent.toLowerCase();
                        const phone = card.querySelector('.pims-info-item:nth-child(2) span').textContent.toLowerCase();
                        const prison = card.querySelector('.pims-info-item:nth-child(3) span').textContent.toLowerCase();
                        
                        if (name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm) || prison.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
            
            // Modal functionality
            const editModal = document.getElementById('pims-edit-modal');
            const deleteModal = document.getElementById('pims-delete-modal');
            const closeButtons = document.querySelectorAll('.pims-modal-close, .pims-modal-close-btn');
            
            // Edit button handlers
            document.querySelectorAll('.pims-edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('pims-edit-user-id').value = this.dataset.id;
                    document.getElementById('pims-edit-first-name').value = this.dataset.firstName;
                    document.getElementById('pims-edit-last-name').value = this.dataset.lastName;
                    document.getElementById('pims-edit-email').value = this.dataset.email;
                    document.getElementById('pims-edit-phone').value = this.dataset.phone;
                    document.getElementById('pims-edit-address').value = this.dataset.address;
                    document.getElementById('pims-edit-role').value = this.dataset.roleId;
                    
                    // Set the form action with the correct route
                    document.getElementById('pims-edit-form').action = `/saccount/${this.dataset.id}`;
                    
                    editModal.classList.add('active');
                });
            });
            
            // Delete button handlers
            document.querySelectorAll('.pims-delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('pims-delete-name').textContent = this.dataset.name;
                    // Set the form action with the correct route
                    document.getElementById('pims-delete-form').action = `/saccount/${this.dataset.id}`;
                    deleteModal.classList.add('active');
                });
            });
            
            // Close modal handlers
            closeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    editModal.classList.remove('active');
                    deleteModal.classList.remove('active');
                });
            });
            
            // Close when clicking outside modal
            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('pims-modal')) {
                    editModal.classList.remove('active');
                    deleteModal.classList.remove('active');
                }
            });
            
            // Handle form submissions
            document.getElementById('pims-edit-form')?.addEventListener('submit', function(e) {
                // Form will submit normally with PUT method
            });
            
            document.getElementById('pims-delete-form')?.addEventListener('submit', function(e) {
                // Form will submit normally with DELETE method
            });
        });
    </script>
    
    @include('includes.footer_js')
</body>
</html>