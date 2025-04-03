<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Prison Management</title>
    
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

        /* Prison Card Styles */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-prison-card {
            transition: var(--pims-transition);
        }

        .pims-prison-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-prison-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-prison-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .pims-prison-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims-prison-detail strong {
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

        .pims-select {
            width: 100%;
            position: relative;
        }

        .pims-select select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            background-color: white;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%232c3e50' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
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
            opacity: 0;
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
            max-width: 600px;
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

        /* Search and Filter */
        .pims-search-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            align-items: center;
        }

        .pims-search {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .pims-search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
            font-size: 0.9rem;
        }

        .pims-search-input:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .pims-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
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

            .pims-grid {
                grid-template-columns: 1fr;
            }

            .pims-search-filter {
                flex-direction: column;
                align-items: stretch;
            }

            .pims-search {
                width: 100%;
            }
        }
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
                        <i class="fas fa-building"></i> Prison Facilities Management
                    </h2>
                    <div class="pims-card-actions">
                        <button id="pims-open-modal" class="pims-btn pims-btn-primary">
                            <i class="fas fa-plus"></i> Add Prison
                        </button>
                        <button id="pims-table-reload" class="pims-btn pims-btn-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="pims-card-body">
                    <!-- Search and Filter -->
                    <div class="pims-search-filter">
                        <div class="pims-search">
                            <i class="fas fa-search pims-search-icon"></i>
                            <input type="text" id="pims-prison-search" class="pims-search-input" 
                                   placeholder="Search prisons by name or location...">
                        </div>
                    </div>

                    <!-- Prison Cards Grid -->
                    <div class="pims-grid" id="pims-prison-grid">
                        @foreach($prisons as $prison)
                        <div class="pims-prison-card" data-searchable="{{ strtolower($prison->name) }} {{ strtolower($prison->location) }}">
                            <div class="pims-card">
                                <div class="pims-card-body">
                                    <div class="media" style="display: flex; align-items: center; margin-bottom: 1rem;">
                                        <div class="media-content">
                                            <p class="pims-prison-title">{{ $prison->name }}</p>
                                            <p class="pims-prison-subtitle">{{ $prison->location }}</p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p class="pims-prison-detail"><strong>Capacity:</strong> {{ $prison->capacity }}</p>
                                        <p class="pims-prison-detail"><strong>Status:</strong> 
                                            <span class="pims-status-badge">Active</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="pims-card-footer" style="padding: 1rem; border-top: 1px solid rgba(0, 0, 0, 0.05);">
                                    <div class="buttons" style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                        <button class="pims-btn pims-btn-primary pims-btn-sm pims-edit-prison"
                                                data-id="{{ $prison->id }}"
                                                data-name="{{ $prison->name }}"
                                                data-location="{{ $prison->location }}"
                                                data-capacity="{{ $prison->capacity }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="pims-btn pims-btn-danger pims-btn-sm pims-delete-prison"
                                                data-id="{{ $prison->id }}"
                                                data-name="{{ $prison->name }}">
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
                        <!-- Previous Button -->
                        @if($prisons->currentPage() > 1)
                        <a class="pims-pagination-link" href="{{ $prisons->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @else
                        <a class="pims-pagination-link is-disabled" href="#">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @endif

                        <!-- Page Numbers -->
                        @foreach($prisons->getUrlRange(1, $prisons->lastPage()) as $page => $url)
                        <a class="pims-pagination-link {{ $page == $prisons->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                            {{ $page }}
                        </a>
                        @endforeach

                        <!-- Next Button -->
                        @if($prisons->hasMorePages())
                        <a class="pims-pagination-link" href="{{ $prisons->nextPageUrl() }}">
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

    <!-- Add Prison Modal -->
    <div class="pims-modal" id="pims-add-prison-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-plus-circle"></i> Add New Prison Facility
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <form action="{{ route('prison.store') }}" method="POST">
                @csrf
                <section class="pims-modal-card-body">
                    <div class="pims-form-group">
                        <label class="pims-form-label">Prison Name</label>
                        <input type="text" name="name" class="pims-form-control" required placeholder="Enter prison facility name">
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Location</label>
                        <div class="pims-select">
                            <select name="location" class="pims-form-control" required>
                                <option value="">Select Location</option>
                                <option value="Addis Ababa">Addis Ababa</option>
                                <option value="Bahir Dar">Bahir Dar</option>
                                <option value="Gondar">Gondar</option>
                                <option value="Adama">Adama</option>
                                <option value="Hawassa">Hawassa</option>
                            </select>
                        </div>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Capacity</label>
                        <input type="number" name="capacity" class="pims-form-control" required placeholder="Enter maximum inmate capacity">
                    </div>
                </section>
                <footer class="pims-modal-card-foot">
                    <button type="button" class="pims-btn pims-btn-secondary pims-close-modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save"></i> Save Prison
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Edit Prison Modal -->
    <div class="pims-modal" id="pims-edit-prison-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-edit"></i> Edit Prison Facility
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <form id="pims-edit-prison-form" method="POST">
                @csrf
                @method('PUT')
                <section class="pims-modal-card-body">
                    <input type="hidden" name="id" id="pims-edit-prison-id">
                    
                    <div class="pims-form-group">
                        <label class="pims-form-label">Prison Name</label>
                        <input type="text" name="name" id="pims-edit-prison-name" class="pims-form-control" required>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Location</label>
                        <div class="pims-select">
                            <select name="location" id="pims-edit-prison-location" class="pims-form-control" required>
                                <option value="">Select Location</option>
                                <option value="Addis Ababa">Addis Ababa</option>
                                <option value="Bahir Dar">Bahir Dar</option>
                                <option value="Gondar">Gondar</option>
                                <option value="Adama">Adama</option>
                                <option value="Hawassa">Hawassa</option>
                            </select>
                        </div>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label">Capacity</label>
                        <input type="number" name="capacity" id="pims-edit-prison-capacity" class="pims-form-control" required>
                    </div>
                </section>
                <footer class="pims-modal-card-foot">
                    <button type="button" class="pims-btn pims-btn-secondary pims-close-modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save"></i> Update Prison
                    </button>
                </footer>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="pims-modal" id="pims-delete-prison-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card" style="max-width: 400px;">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <div style="text-align: center;">
                    <div style="font-size: 2.5rem; color: var(--pims-danger); margin-bottom: 1rem;">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <p style="margin-bottom: 1.5rem;">
                        Are you sure you want to delete <strong id="pims-delete-prison-name"></strong>?
                        This action cannot be undone.
                    </p>
                </div>
            </section>
            <footer class="pims-modal-card-foot" style="justify-content: center;">
                <button class="pims-btn pims-btn-secondary pims-close-modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims-delete-prison-form" method="POST" style="display: inline;">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal elements
            const addModal = document.getElementById('pims-add-prison-modal');
            const editModal = document.getElementById('pims-edit-prison-modal');
            const deleteModal = document.getElementById('pims-delete-prison-modal');
            const closeButtons = document.querySelectorAll('.pims-modal-close, .pims-close-modal');
            
            // Open Add Modal
            document.getElementById('pims-open-modal').addEventListener('click', function() {
                addModal.classList.add('is-active');
            });
            
            // Open Edit Modal
            document.querySelectorAll('.pims-edit-prison').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonId = this.getAttribute('data-id');
                    const prisonName = this.getAttribute('data-name');
                    const prisonLocation = this.getAttribute('data-location');
                    const prisonCapacity = this.getAttribute('data-capacity');
                    
                    document.getElementById('pims-edit-prison-id').value = prisonId;
                    document.getElementById('pims-edit-prison-name').value = prisonName;
                    document.getElementById('pims-edit-prison-location').value = prisonLocation;
                    document.getElementById('pims-edit-prison-capacity').value = prisonCapacity;
                    
                    document.getElementById('pims-edit-prison-form').action = `/prisons/${prisonId}`;
                    editModal.classList.add('is-active');
                });
            });
            
            // Open Delete Modal
            document.querySelectorAll('.pims-delete-prison').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonId = this.getAttribute('data-id');
                    const prisonName = this.getAttribute('data-name');
                    
                    document.getElementById('pims-delete-prison-name').textContent = prisonName;
                    document.getElementById('pims-delete-prison-form').action = `/prisons/${prisonId}`;
                    deleteModal.classList.add('is-active');
                });
            });
            
            // Close Modals
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    addModal.classList.remove('is-active');
                    editModal.classList.remove('is-active');
                    deleteModal.classList.remove('is-active');
                });
            });
            
            // Close modal when clicking outside
            [addModal, editModal, deleteModal].forEach(modal => {
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
            
            // Search functionality for prison cards
            document.getElementById('pims-prison-search').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const prisonCards = document.querySelectorAll('#pims-prison-grid .pims-prison-card');
                
                prisonCards.forEach(card => {
                    const searchableText = card.getAttribute('data-searchable');
                    if (searchableText.includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>