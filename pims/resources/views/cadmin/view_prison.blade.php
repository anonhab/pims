<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Prison Facilities Management</title>
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

        .content-area {
            flex: 1;
            padding: clamp(1rem, 3vw, 2rem);
            margin-left: 250px;
            transition: var(--transition);
        }

        .card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-title {
            font-size: clamp(1.5rem, 4vw, 1.75rem);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-title i {
            color: var(--accent);
        }

        .card-actions {
            display: flex;
            gap: 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .search-filter {
            margin-bottom: 2rem;
        }

        .search {
            max-width: 400px;
            position: relative;
        }

        .search input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .search input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .search i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .prison-card .card {
            transition: var(--transition);
        }

        .prison-card:hover .card {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .prison-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .prison-subtitle {
            color: var(--secondary);
            font-size: 0.95rem;
        }

        .prison-detail {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .status-badge {
            display: inline-block;
            background: var(--success);
            color: #fff;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .card-footer {
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #eee;
            padding: 1rem;
            gap: 0.5rem;
        }

        .btn {
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

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-secondary {
            background: var(--secondary);
            color: #fff;
        }

        .btn-secondary:hover {
            background: #2c3e50;
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
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

        .pagination-link:hover:not(.is-disabled) {
            background: var(--light);
        }

        .pagination-link.is-current {
            background: var(--accent);
            color: #fff;
        }

        .pagination-link.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
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

        .modal.is-active {
            display: flex;
        }

        .modal-card {
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

        .modal-card-head {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .modal-card-title i {
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

        .modal-card-body {
            padding: 1.5rem;
        }

        .modal-card-foot {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
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

        .select select {
            width: 100%;
        }

        @media (max-width: 992px) {
            .content-area { margin-left: 0; }
            .grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
        }

        @media (max-width: 768px) {
            .search { max-width: 100%; }
            .pagination { flex-direction: column; gap: 1rem; }
        }

        @media (max-width: 480px) {
            .card-footer { flex-direction: column; }
            .card-footer .btn { width: 100%; }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="app-container">
        @include('cadmin.menu')
        <div class="content-area">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-building" aria-hidden="true"></i> Prison Facilities Management
                    </h2>
                    <div class="card-actions">
                        <button id="open-add-modal" class="btn btn-primary">
                            <i class="fas fa-plus" aria-hidden="true"></i> Add Prison
                        </button>
                        <button id="table-reload" class="btn btn-secondary">
                            <i class="fas fa-sync-alt" aria-hidden="true"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="search-filter">
                        <div class="search">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input type="text" id="prison-search" class="form-control" placeholder="Search prisons by name or location..." aria-label="Search prisons">
                        </div>
                    </div>
                    <div class="grid" id="prison-grid">
                        @foreach($prisons as $prison)
                            <div class="prison-card" data-searchable="{{ strtolower($prison->name) }} {{ strtolower($prison->location) }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <div>
                                                <p class="prison-title">{{ $prison->name }}</p>
                                                <p class="prison-subtitle">{{ $prison->location }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="prison-detail"><strong>Capacity:</strong> {{ $prison->capacity }}</p>
                                            <p class="prison-detail"><strong>Status:</strong> 
                                                <span class="status-badge">Active</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary btn-sm edit-prison"
                                                data-id="{{ $prison->id }}"
                                                data-name="{{ $prison->name }}"
                                                data-location="{{ $prison->location }}"
                                                data-capacity="{{ $prison->capacity }}"
                                                aria-label="Edit prison {{ $prison->name }}">
                                            <i class="fas fa-edit" aria-hidden="true"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-prison"
                                                data-id="{{ $prison->id }}"
                                                data-name="{{ $prison->name }}"
                                                aria-label="Delete prison {{ $prison->name }}">
                                            <i class="fas fa-trash" aria-hidden="true"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav class="pagination" aria-label="Pagination">
                        @if($prisons->currentPage() > 1)
                            <a class="pagination-link" href="{{ $prisons->previousPageUrl() }}" aria-label="Previous page">
                                <i class="fas fa-chevron-left" aria-hidden="true"></i> Previous
                            </a>
                        @else
                            <span class="pagination-link is-disabled" aria-disabled="true">
                                <i class="fas fa-chevron-left" aria-hidden="true"></i> Previous
                            </span>
                        @endif
                        @foreach($prisons->getUrlRange(1, $prisons->lastPage()) as $page => $url)
                            <a class="pagination-link {{ $page == $prisons->currentPage() ? 'is-current' : '' }}"
                               href="{{ $url }}"
                               aria-current="{{ $page == $prisons->currentPage() ? 'page' : 'false' }}"
                               aria-label="Page {{ $page }}">{{ $page }}</a>
                        @endforeach
                        @if($prisons->hasMorePages())
                            <a class="pagination-link" href="{{ $prisons->nextPageUrl() }}" aria-label="Next page">
                                Next <i class="fas fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        @else
                            <span class="pagination-link is-disabled" aria-disabled="true">
                                Next <i class="fas fa-chevron-right" aria-hidden="true"></i>
                            </span>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="add-prison-modal" role="dialog" aria-labelledby="add-modal-title" aria-hidden="true">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title" id="add-modal-title">
                    <i class="fas fa-plus-circle" aria-hidden="true"></i> Add New Prison Facility
                </p>
                <button class="modal-close" aria-label="Close add modal">×</button>
            </header>
            <form action="{{ route('prison.store') }}" method="POST">
                @csrf
                <section class="modal-card-body">
                    <div class="form-group">
                        <label class="form-label" for="add-prison-name">Prison Name</label>
                        <input type="text" name="name" id="add-prison-name" class="form-control" required placeholder="Enter prison facility name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="add-prison-location">Location</label>
                        <select name="location" id="add-prison-location" class="form-control" required>
                            <option value="">Select Location</option>
                            <option value="Addis Ababa">Addis Ababa</option>
                            <option value="Bahir Dar">Bahir Dar</option>
                            <option value="Gondar">Gondar</option>
                            <option value="Adama">Adama</option>
                            <option value="Hawassa">Hawassa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="add-prison-capacity">Capacity</label>
                        <input type="number" name="capacity" id="add-prison-capacity" class="form-control" required placeholder="Enter maximum inmate capacity">
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button type="button" class="btn btn-secondary close-modal" aria-label="Cancel add">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Prison</button>
                </footer>
            </form>
        </div>
    </div>

    <div class="modal" id="edit-prison-modal" role="dialog" aria-labelledby="edit-modal-title" aria-hidden="true">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title" id="edit-modal-title">
                    <i class="fas fa-edit" aria-hidden="true"></i> Edit Prison Facility
                </p>
                <button class="modal-close" aria-label="Close edit modal">×</button>
            </header>
            <form id="edit-prison-form" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="edit-prison-id">
                <section class="modal-card-body">
                    <div class="form-group">
                        <label class="form-label" for="edit-prison-name">Prison Name</label>
                        <input type="text" name="name" id="edit-prison-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-prison-location">Location</label>
                        <select name="location" id="edit-prison-location" class="form-control" required>
                            <option value="">Select Location</option>
                            <option value="Addis Ababa">Addis Ababa</option>
                            <option value="Bahir Dar">Bahir Dar</option>
                            <option value="Gondar">Gondar</option>
                            <option value="Adama">Adama</option>
                            <option value="Hawassa">Hawassa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-prison-capacity">Capacity</label>
                        <input type="number" name="capacity" id="edit-prison-capacity" class="form-control" required>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button type="button" class="btn btn-secondary close-modal" aria-label="Cancel edit">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Prison</button>
                </footer>
            </form>
        </div>
    </div>

    <div class="modal" id="delete-prison-modal" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
        <div class="modal-card" style="max-width: 400px;">
            <header class="modal-card-head">
                <p class="modal-card-title" id="delete-modal-title">
                    <i class="fas fa-exclamation-triangle" aria-hidden="true"></i> Confirm Deletion
                </p>
                <button class="modal-close" aria-label="Close delete modal">×</button>
            </header>
            <section class="modal-card-body">
                <div style="text-align: center;">
                    <div style="font-size: 2.5rem; color: var(--danger); margin-bottom: 1rem;">
                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                    </div>
                    <p style="margin-bottom: 1.5rem;">
                        Are you sure you want to delete <strong id="delete-prison-name"></strong>?
                        This action cannot be undone.
                    </p>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button type="button" class="btn btn-secondary close-modal" aria-label="Cancel delete">Cancel</button>
                <form id="delete-prison-form" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </footer>
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

            const addModal = document.getElementById('add-prison-modal');
            const editModal = document.getElementById('edit-prison-modal');
            const deleteModal = document.getElementById('delete-prison-modal');

            const closeAllModals = () => {
                addModal.classList.remove('is-active');
                editModal.classList.remove('is-active');
                deleteModal.classList.remove('is-active');
                addModal.setAttribute('aria-hidden', 'true');
                editModal.setAttribute('aria-hidden', 'true');
                deleteModal.setAttribute('aria-hidden', 'true');
            };

            document.getElementById('open-add-modal').addEventListener('click', () => {
                closeAllModals();
                addModal.classList.add('is-active');
                addModal.setAttribute('aria-hidden', 'false');
                document.getElementById('add-prison-name').focus();
            });

            document.querySelectorAll('.edit-prison').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    document.getElementById('edit-prison-id').value = btn.dataset.id;
                    document.getElementById('edit-prison-name').value = btn.dataset.name;
                    document.getElementById('edit-prison-location').value = btn.dataset.location;
                    document.getElementById('edit-prison-capacity').value = btn.dataset.capacity;
                    document.getElementById('edit-prison-form').action = `/prisons/${btn.dataset.id}`;
                    editModal.classList.add('is-active');
                    editModal.setAttribute('aria-hidden', 'false');
                    document.getElementById('edit-prison-name').focus();
                });
            });

            document.querySelectorAll('.delete-prison').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeAllModals();
                    document.getElementById('delete-prison-name').textContent = btn.dataset.name;
                    document.getElementById('delete-prison-form').action = `/prisons/${btn.dataset.id}`;
                    deleteModal.classList.add('is-active');
                    deleteModal.setAttribute('aria-hidden', 'false');
                });
            });

            document.querySelectorAll('.modal-close, .close-modal').forEach(btn => {
                btn.addEventListener('click', closeAllModals);
            });

            window.addEventListener('click', e => {
                if (e.target.classList.contains('modal')) {
                    closeAllModals();
                }
            });

            document.getElementById('table-reload').addEventListener('click', () => {
                window.location.reload();
            });

            const searchInput = document.getElementById('prison-search');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(() => {
                    const searchTerm = searchInput.value.toLowerCase();
                    document.querySelectorAll('#prison-grid .prison-card').forEach(card => {
                        const searchableText = card.getAttribute('data-searchable');
                        card.style.display = searchableText.includes(searchTerm) ? '' : 'none';
                    });
                }, 300));
            }

           
          
        });
    </script>
</body>
</html>