<!DOCTYPE html>
<html>
@include('includes.head')

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
                    <h2 class="pims-page-title">Account Management</h2>
                    <div class="pims-page-actions">
                        <div class="pims-search-box">
                            <input type="text" id="pims-account-search" class="pims-search-input" placeholder="Search accounts...">
                            <i class="fas fa-search pims-search-icon"></i>
                        </div>
                        <a href="{{ route('saccount.add') }}" class="pims-button pims-button-primary">
                            <i class="fas fa-plus"></i> Create Account
                        </a>
                    </div>
                </div>

                <!-- Accounts Grid -->
                <div class="pims-accounts-grid">
                    @if($accounts->isEmpty())
                    <div class="pims-empty-state">
                        <i class="fas fa-user-slash pims-empty-icon"></i>
                        <h3>No Accounts Found</h3>
                        <p>There are currently no accounts in the system.</p>
                        <a href="{{ route('saccount.add') }}" class="pims-button pims-button-primary">
                            <i class="fas fa-plus"></i> Create New Account
                        </a>
                    </div>
                    @else
                    @foreach($accounts as $account)
                    <div class="pims-account-card" data-searchable="{{ strtolower($account->first_name.' '.$account->last_name.' '.$account->email.' '.$account->phone_number.' '.($account->prison ? $account->prison->name : '').' '.($account->role ? $account->role->name : '')) }}">
                        <div class="pims-account-header">
                            <h3 class="pims-account-name">{{ $account->first_name }} {{ $account->last_name }}</h3>
                            <span class="pims-account-role">{{ $account->role ? $account->role->name : 'N/A' }}</span>
                        </div>
                        
                        <div class="pims-account-image">
                            @if($account->user_image)
                            <img src="{{ asset('storage/' . $account->user_image) }}" alt="User Image">
                            @else
                            <img src="{{ asset('default-profile.png') }}" alt="Default Image">
                            @endif
                        </div>
                        
                        <div class="pims-account-details">
                            <div class="pims-detail-item">
                                <i class="fas fa-user-tag"></i>
                                <span>{{ $account->username }}</span>
                            </div>
                            <div class="pims-detail-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $account->email }}</span>
                            </div>
                            <div class="pims-detail-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $account->phone_number ?: 'N/A' }}</span>
                            </div>
                            <div class="pims-detail-item">
                                <i class="fas fa-building"></i>
                                <span>{{ $account->prison ? $account->prison->name : 'N/A' }}</span>
                            </div>
                        </div>
                        
                        <div class="pims-account-actions">
                            <button class="pims-button pims-button-edit pims-edit-btn"
                                data-id="{{ $account->user_id }}"
                                data-first-name="{{ $account->first_name }}"
                                data-last-name="{{ $account->last_name }}"
                                data-email="{{ $account->email }}"
                                data-phone="{{ $account->phone_number }}"
                                data-address="{{ $account->address }}"
                                data-role-id="{{ $account->role_id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            
                            <form action="{{ route('saccount.destroy', $account->user_id) }}" method="POST" class="pims-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="pims-button pims-button-danger" onclick="return confirm('Are you sure you want to delete this account?');">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
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
                    <span class="pims-pagination-link pims-disabled">
                        <i class="fas fa-chevron-left"></i> Previous
                    </span>
                    @endif
                    
                    <div class="pims-pagination-pages">
                        @foreach($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="pims-pagination-link {{ $page == $accounts->currentPage() ? 'pims-active' : '' }}">
                            {{ $page }}
                        </a>
                        @endforeach
                    </div>
                    
                    @if($accounts->hasMorePages())
                    <a href="{{ $accounts->nextPageUrl() }}" class="pims-pagination-link">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                    @else
                    <span class="pims-pagination-link pims-disabled">
                        Next <i class="fas fa-chevron-right"></i>
                    </span>
                    @endif
                </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Edit Account Modal -->
    <div class="pims-modal" id="pims-edit-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <h3 class="pims-modal-title">Edit Account</h3>
                <button class="pims-modal-close" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </header>
            
            <form id="pims-edit-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" id="pims-edit-user-id">
                
                <div class="pims-modal-body">
                    <div class="pims-form-group">
                        <label class="pims-form-label">First Name</label>
                        <input type="text" name="first_name" id="pims-edit-first-name" class="pims-form-input" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Last Name</label>
                        <input type="text" name="last_name" id="pims-edit-last-name" class="pims-form-input" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Email</label>
                        <input type="email" name="email" id="pims-edit-email" class="pims-form-input" required>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Phone Number</label>
                        <input type="text" name="phone_number" id="pims-edit-phone" class="pims-form-input">
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Address</label>
                        <textarea name="address" id="pims-edit-address" class="pims-form-textarea"></textarea>
                    </div>
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Role</label>
                        <select name="role_id" id="pims-edit-role" class="pims-form-select" required>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <footer class="pims-modal-footer">
                    <button type="submit" class="pims-button pims-button-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <button type="button" class="pims-button pims-button-secondary pims-modal-close">
                        Cancel
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <style>
        :root {
            --pims-primary: #2c3e50;
            --pims-secondary: #34495e;
            --pims-accent: #3498db;
            --pims-success: #2ecc71;
            --pims-danger: #e74c3c;
            --pims-warning: #f39c12;
            --pims-light: #ecf0f1;
            --pims-dark: #2c3e50;
            --pims-border-radius: 8px;
            --pims-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-transition: all 0.3s ease;
        }
        
        /* Layout */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            background-color: #f5f7fa;
            padding-top:60px;
        }
        
        .pims-main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 250px; /* Match sidebar width */
            transition: var(--pims-transition);
        }
        
        .pims-content-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Header */
        .pims-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .pims-page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-dark);
            margin: 0;
        }
        
        .pims-page-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        /* Search Box */
        .pims-search-box {
            position: relative;
            width: 300px;
        }
        
        .pims-search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
        }
        
        .pims-search-input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .pims-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }
        
        /* Buttons */
        .pims-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.25rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-family: inherit;
            font-size: 1rem;
            gap: 0.5rem;
        }
        
        .pims-button-primary {
            background-color: var(--pims-accent);
            color: white;
        }
        
        .pims-button-primary:hover {
            background-color: #2980b9;
        }
        
        .pims-button-edit {
            background-color: var(--pims-warning);
            color: white;
        }
        
        .pims-button-edit:hover {
            background-color: #e67e22;
        }
        
        .pims-button-danger {
            background-color: var(--pims-danger);
            color: white;
        }
        
        .pims-button-danger:hover {
            background-color: #c0392b;
        }
        
        .pims-button-secondary {
            background-color: var(--pims-light);
            color: var(--pims-dark);
        }
        
        .pims-button-secondary:hover {
            background-color: #dfe6e9;
        }
        
        /* Accounts Grid */
        .pims-accounts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        /* Account Card */
        .pims-account-card {
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            transition: var(--pims-transition);
            display: flex;
            flex-direction: column;
        }
        
        .pims-account-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .pims-account-header {
            padding: 1.25rem 1.25rem 0.75rem;
            border-bottom: 1px solid #eee;
        }
        
        .pims-account-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0 0 0.25rem;
            color: var(--pims-dark);
        }
        
        .pims-account-role {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background-color: var(--pims-light);
            color: var(--pims-secondary);
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .pims-account-image {
            padding: 1.25rem;
            text-align: center;
        }
        
        .pims-account-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--pims-light);
        }
        
        .pims-account-details {
            padding: 0 1.25rem 1.25rem;
            flex-grow: 1;
        }
        
        .pims-detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }
        
        .pims-detail-item i {
            width: 24px;
            color: var(--pims-accent);
            margin-right: 0.75rem;
        }
        
        .pims-account-actions {
            display: flex;
            padding: 1rem;
            border-top: 1px solid #eee;
            gap: 0.75rem;
        }
        
        .pims-delete-form {
            flex-grow: 1;
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
        
        .pims-empty-icon {
            font-size: 3rem;
            color: #bdc3c7;
            margin-bottom: 1rem;
        }
        
        .pims-empty-state h3 {
            font-size: 1.5rem;
            color: var(--pims-dark);
            margin-bottom: 0.5rem;
        }
        
        .pims-empty-state p {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
        }
        
        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.75rem;
            margin-top: 2rem;
        }
        
        .pims-pagination-link {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            background-color: white;
            color: var(--pims-dark);
            text-decoration: none;
            box-shadow: var(--pims-box-shadow);
            transition: var(--pims-transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .pims-pagination-link:hover {
            background-color: var(--pims-light);
        }
        
        .pims-pagination-link.pims-active {
            background-color: var(--pims-accent);
            color: white;
        }
        
        .pims-pagination-link.pims-disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .pims-pagination-pages {
            display: flex;
            gap: 0.5rem;
        }
        
        /* Modal */
        .pims-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 1rem;
        }
        
        .pims-modal.is-active {
            display: flex;
        }
        
        .pims-modal-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .pims-modal-card {
            position: relative;
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            animation: modalFadeIn 0.3s ease;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pims-modal-header {
            padding: 1.25rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .pims-modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            color: var(--pims-dark);
        }
        
        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #95a5a6;
            transition: var(--pims-transition);
        }
        
        .pims-modal-close:hover {
            color: var(--pims-danger);
        }
        
        .pims-modal-body {
            padding: 1.25rem;
            overflow-y: auto;
            flex-grow: 1;
        }
        
        .pims-modal-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }
        
        /* Form Elements */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }
        
        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }
        
        .pims-form-input, .pims-form-select, .pims-form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
        }
        
        .pims-form-input:focus, .pims-form-select:focus, .pims-form-textarea:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .pims-form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%232c3e50' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
        }
        
        .pims-form-textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .pims-page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .pims-page-actions {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
            }
            
            .pims-search-box {
                width: 100%;
            }
            
            .pims-accounts-grid {
                grid-template-columns: 1fr;
            }
            
            .pims-pagination {
                flex-wrap: wrap;
            }
            
            .pims-pagination-pages {
                order: 1;
                width: 100%;
                justify-content: center;
                margin: 0.5rem 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('pims-account-search');
            const accountCards = document.querySelectorAll('.pims-account-card');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                accountCards.forEach(card => {
                    const searchableText = card.dataset.searchable;
                    if (searchableText.includes(searchTerm)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
            
            // Edit modal functionality
            const editModal = document.getElementById('pims-edit-modal');
            const editButtons = document.querySelectorAll('.pims-edit-btn');
            const closeModalButtons = document.querySelectorAll('.pims-modal-close');
            const editForm = document.getElementById('pims-edit-form');
            
            // Open modal with account data
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('pims-edit-user-id').value = this.dataset.id;
                    document.getElementById('pims-edit-first-name').value = this.dataset.firstName;
                    document.getElementById('pims-edit-last-name').value = this.dataset.lastName;
                    document.getElementById('pims-edit-email').value = this.dataset.email;
                    document.getElementById('pims-edit-phone').value = this.dataset.phone;
                    document.getElementById('pims-edit-address').value = this.dataset.address;
                    document.getElementById('pims-edit-role').value = this.dataset.roleId;
                    
                    editForm.action = `/saccount/update/${this.dataset.id}`;
                    editModal.classList.add('is-active');
                });
            });
            
            // Close modal
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    editModal.classList.remove('is-active');
                });
            });
            
            // Close modal when clicking outside
            editModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('is-active');
                }
            });
            
            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && editModal.classList.contains('is-active')) {
                    editModal.classList.remove('is-active');
                }
            });
        });
    </script>

    @include('includes.footer_js')
</body>
</html>