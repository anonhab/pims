<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Lawyer Management</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pims9-primary: #1a2a3a;
            --pims9-secondary: #2c3e50;
            --pims9-accent: #2980b9;
            --pims9-danger: #c0392b;
            --pims9-success: #27ae60;
            --pims9-warning: #d35400;
            --pims9-text-light: #ecf0f1;
            --pims9-text-dark: #2c3e50;
            --pims9-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            --pims9-border-radius: 6px;
            --pims9-nav-height: 60px;
            --pims9-sidebar-width: 250px;
            --pims9-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--pims9-text-dark);
            line-height: 1.6;
        }

        /* Layout Structure */
        .pims9-app-container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--pims9-nav-height);
        }

        .pims9-sidebar {
            width: var(--pims9-sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: var(--pims9-nav-height);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 900;
            transition: var(--pims9-transition);
        }

        .pims9-content-area {
            flex: 1;
            margin-left: var(--pims9-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims9-transition);
        }

        /* Card Styles */
        .pims9-card {
            background: white;
            border-radius: var(--pims9-border-radius);
            box-shadow: var(--pims9-card-shadow);
            margin-bottom: 1.5rem;
            transition: var(--pims9-transition);
            border-left: 4px solid var(--pims9-accent);
        }

        .pims9-card-header {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims9-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims9-primary);
        }

        .pims9-card-body {
            padding: 1.25rem;
        }

        .pims9-card-filter {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Lawyer Card Styles */
        .pims9-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims9-lawyer-card {
            transition: var(--pims9-transition);
        }

        .pims9-lawyer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims9-lawyer-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims9-primary);
            margin-bottom: 0.25rem;
        }

        .pims9-lawyer-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims9-lawyer-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims9-lawyer-detail strong {
            color: var(--pims9-primary);
            font-weight: 600;
        }

        .pims9-lawyer-footer {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Button Styles */
        .pims9-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims9-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims9-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.9rem;
        }

        .pims9-btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .pims9-btn-primary {
            background-color: var(--pims9-accent);
            color: white;
        }

        .pims9-btn-primary:hover {
            background-color: var(--pims9-primary);
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims9-btn-danger {
            background-color: var(--pims9-danger);
            color: white;
        }

        .pims9-btn-danger:hover {
            background-color: #a5281b;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims9-btn-secondary {
            background-color: #f0f2f5;
            color: var(--pims9-text-dark);
        }

        .pims9-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims9-btn-text {
            background: transparent;
            color: var(--pims9-accent);
        }

        .pims9-btn-text:hover {
            background-color: rgba(41, 128, 185, 0.1);
        }

        /* Form Styles */
        .pims9-form-group {
            margin-bottom: 1.25rem;
        }

        .pims9-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims9-primary);
        }

        .pims9-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims9-border-radius);
            transition: var(--pims9-transition);
        }

        .pims9-form-control:focus {
            border-color: var(--pims9-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        /* Modal Styles */
        .pims9-modal {
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

        .pims9-modal.is-active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            opacity: 1;
            backdrop-filter: blur(3px);
        }

        .pims9-modal-card {
            background: white;
            border-radius: var(--pims9-border-radius);
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

        .pims9-modal.is-active .pims9-modal-card {
            transform: translateY(0);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .pims9-modal-card-head {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(41, 128, 185, 0.15) 0%, rgba(41, 128, 185, 0.1) 100%);
            color: var(--pims9-primary);
            border-top-left-radius: var(--pims9-border-radius);
            border-top-right-radius: var(--pims9-border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(41, 128, 185, 0.2);
        }

        .pims9-modal-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .pims9-modal-close {
            background: none;
            border: none;
            color: var(--pims9-primary);
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

        .pims9-modal-close:hover {
            transform: rotate(90deg);
            background-color: rgba(41, 128, 185, 0.1);
        }

        .pims9-modal-card-body {
            padding: 2rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .pims9-modal-card-foot {
            padding: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            background-color: #f8f9fa;
        }

        /* Empty State */
        .pims9-empty-state {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: var(--pims9-border-radius);
            box-shadow: var(--pims9-card-shadow);
            color: var(--pims9-text-dark);
            grid-column: 1 / -1;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims9-app-container{
                padding-left:70px;
            }
            .pims9-sidebar {
                transform: translateX(-100%);
            }

            .pims9-sidebar.is-active {
                transform: translateX(0);
            }

            .pims9-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims9-card-filter {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims9-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')
@include('inspector.menu')
    <div class="pims9-app-container">
        

        <div class="pims9-content-area">
            <div class="pims9-card">
                <div class="pims9-card-header">
                    <h2 class="pims9-card-title">
                        <i class="fas fa-user-tie"></i> Lawyer Management
                    </h2>
                    <div class="pims9-card-actions">
                        <button id="pims9-reload-lawyers" class="pims9-btn pims9-btn-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                
                <div class="pims9-card-filter">
                    <div class="pims9-form-group" style="flex-grow: 1; max-width: 300px;">
                        <div class="control has-icons-left">
                            <input class="pims9-form-control" id="pims9-search-lawyer" type="text" placeholder="Search lawyers...">
                            <span class="icon is-left" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="pims9-card-body">
                    <!-- Lawyer Cards Grid -->
                    <div class="pims9-grid">
                        @if($lawyers->isEmpty())
                            <div class="pims9-empty-state">
                                <i class="fas fa-user-tie" style="font-size: 3rem; color: var(--pims9-accent); margin-bottom: 1rem;"></i>
                                <h3 class="pims9-card-title">No lawyers found</h3>
                            </div>
                        @else
                            @foreach($lawyers as $lawyer)
                            <div class="pims9-lawyer-card">
                                <div class="pims9-card">
                                    <div class="pims9-card-body">
                                        <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <div class="media-content">
                                                <p class="pims9-lawyer-title">{{ $lawyer->first_name }} {{ $lawyer->last_name }}</p>
                                                <p class="pims9-lawyer-subtitle">
                                                    <i class="fas fa-envelope"></i> {{ $lawyer->email }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p class="pims9-lawyer-detail"><strong>Law Firm:</strong> {{ $lawyer->law_firm ?? 'N/A' }}</p>
                                            <p class="pims9-lawyer-detail"><strong>License Number:</strong> {{ $lawyer->license_number }}</p>
                                            <p class="pims9-lawyer-detail"><strong>Cases Handled:</strong> {{ $lawyer->cases_handled }}</p>
                                            <p class="pims9-lawyer-detail"><strong>Contact:</strong> {{ $lawyer->contact_info }}</p>
                                            <p class="pims9-lawyer-detail"><strong>Date of Birth:</strong> {{ $lawyer->date_of_birth }}</p>
                                        </div>
                                    </div>
                                    <div class="pims9-lawyer-footer">
                                        <button class="pims9-btn pims9-btn-text pims9-btn-sm pims9-edit-lawyer"
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

                                        @if(isset($lawyer->lawyer_id))
                                        <form action="{{ route('lawyers.destroy', $lawyer->lawyer_id) }}" method="POST" class="pims9-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pims9-btn pims9-btn-danger pims9-btn-sm">
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
    <div class="pims9-modal" id="pims9-edit-lawyer-modal">
        <div class="pims9-modal-card">
            <header class="pims9-modal-card-head">
                <p class="pims9-modal-card-title">
                    <i class="fas fa-user-edit"></i> Edit Lawyer
                </p>
                <button class="pims9-modal-close" onclick="pimsCloseModal('pims9-edit-lawyer-modal')">×</button>
            </header>
            <section class="pims9-modal-card-body">
                <form id="pims9-edit-lawyer-form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="lawyer_id" id="pims9-lawyer-id">

                    <div class="pims9-form-group">
                        <label class="pims9-form-label">First Name</label>
                        <input class="pims9-form-control" type="text" name="first_name" id="pims9-edit-first-name" required>
                    </div>
                    
                    <div class="pims9-form-group">
                        <label class="pims9-form-label">Last Name</label>
                        <input class="pims9-form-control" type="text" name="last_name" id="pims9-edit-last-name" required>
                    </div>
                    
                    <div class="pims9-form-group">
                        <label class="pims9-form-label">Email</label>
                        <input class="pims9-form-control" type="email" name="email" id="pims9-edit-email" required>
                    </div>
                    
                    <div class="pims9-form-group">
                        <label class="pims9-form-label">Law Firm</label>
                        <input class="pims9-form-control" type="text" name="law_firm" id="pims9-edit-law-firm">
                    </div>
                    
                    <div class="pims9-form-group">
                        <label class="pims9-form-label">License Number</label>
                        <input class="pims9-form-control" type="text" name="license_number" id="pims9-edit-license-number" required>
                    </div>
                    
                    <div class="pims9-form-group">
                        <label class="pims9-form-label">Cases Handled</label>
                        <input class="pims9-form-control" type="number" name="cases_handled" id="pims9-edit-cases-handled" required>
                    </div>
                    
                    <div class="pims9-form-group">
                        <label class="pims9-form-label">Contact Info</label>
                        <input class="pims9-form-control" type="text" name="contact_info" id="pims9-edit-contact" required>
                    </div>
                    
                    <div class="pims9-form-group">
                        <label class="pims9-form-label">Date of Birth</label>
                        <input class="pims9-form-control" type="date" name="date_of_birth" id="pims9-edit-dob" required>
                    </div>
                </form>
            </section>
            <footer class="pims9-modal-card-foot">
                <button class="pims9-btn pims9-btn-secondary" onclick="pimsCloseModal('pims9-edit-lawyer-modal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" form="pims9-edit-lawyer-form" class="pims9-btn pims9-btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </footer>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="pims9-modal" id="pims9-confirm-delete-modal">
        <div class="pims9-modal-card" style="max-width: 400px;">
            <header class="pims9-modal-card-head">
                <p class="pims9-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims9-modal-close" onclick="pimsCloseModal('pims9-confirm-delete-modal')">×</button>
            </header>
            <section class="pims9-modal-card-body">
                <div style="text-align: center;">
                    <div class="pims9-confirm-icon">
                        <i class="fas fa-trash-alt" style="font-size: 2.5rem; color: var(--pims9-danger);"></i>
                    </div>
                    <p class="pims9-confirm-message">
                        Are you sure you want to delete this lawyer? This action cannot be undone.
                    </p>
                </div>
            </section>
            <footer class="pims9-modal-card-foot" style="justify-content: center;">
                <button class="pims9-btn pims9-btn-secondary" onclick="pimsCloseModal('pims9-confirm-delete-modal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims9-confirm-delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pims9-btn pims9-btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize edit buttons
            document.querySelectorAll('.pims9-edit-lawyer').forEach(button => {
                button.addEventListener('click', function() {
                    const lawyerId = this.getAttribute('data-id');
                    
                    document.getElementById('pims9-lawyer-id').value = lawyerId;
                    document.getElementById('pims9-edit-first-name').value = this.getAttribute('data-firstname');
                    document.getElementById('pims9-edit-last-name').value = this.getAttribute('data-lastname');
                    document.getElementById('pims9-edit-email').value = this.getAttribute('data-email');
                    document.getElementById('pims9-edit-law-firm').value = this.getAttribute('data-lawfirm');
                    document.getElementById('pims9-edit-license-number').value = this.getAttribute('data-license');
                    document.getElementById('pims9-edit-cases-handled').value = this.getAttribute('data-cases');
                    document.getElementById('pims9-edit-contact').value = this.getAttribute('data-contact');
                    document.getElementById('pims9-edit-dob').value = this.getAttribute('data-dob');
                    
                    document.getElementById('pims9-edit-lawyer-form').action = `/lawyers/${lawyerId}`;
                    document.getElementById('pims9-edit-lawyer-modal').classList.add('is-active');
                });
            });

            // Initialize delete buttons
            document.querySelectorAll('.pims9-delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    document.getElementById('pims9-confirm-delete-form').action = this.action;
                    document.getElementById('pims9-confirm-delete-modal').classList.add('is-active');
                });
            });

            // Search functionality
            document.getElementById('pims9-search-lawyer').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const lawyerCards = document.querySelectorAll('.pims9-lawyer-card');

                lawyerCards.forEach(card => {
                    const cardText = card.textContent.toLowerCase();
                    card.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
                });
            });

            // Refresh button
            document.getElementById('pims9-reload-lawyers').addEventListener('click', function() {
                window.location.reload();
            });

            // Handle form submissions
            document.getElementById('pims9-edit-lawyer-form').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;
            });

            document.getElementById('pims9-confirm-delete-form').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                submitBtn.disabled = true;
            });
        });

        function pimsCloseModal(modalId) {
            document.getElementById(modalId).classList.remove('is-active');
        }
    </script>
</body>
</html>