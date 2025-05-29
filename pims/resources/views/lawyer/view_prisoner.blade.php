<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Prisoner Management</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
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

        /* Prisoner Card Styles */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .pims-prisoner-card {
            transition: var(--pims-transition);
        }

        .pims-prisoner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-prisoner-image {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            display: block;
            border: 3px solid white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .pims-prisoner-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
            text-align: center;
        }

        .pims-prisoner-detail {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .pims-prisoner-detail strong {
            color: var(--pims-primary);
            font-weight: 600;
        }

        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .pims-status-active {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
        }

        .pims-status-inactive {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
        }

        .pims-status-other {
            background-color: rgba(41, 128, 185, 0.1);
            color: var(--pims-accent);
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

        /* Card Footer */
        .pims-card-footer {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Notification Styles */
        .pims-notification {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .pims-notification-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-notification-danger {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

        .pims-notification-warning {
            background-color: rgba(211, 84, 0, 0.1);
            color: var(--pims-warning);
            border-left: 4px solid var(--pims-warning);
        }

        .pims-notification-info {
            background-color: rgba(41, 128, 185, 0.1);
            color: var(--pims-accent);
            border-left: 4px solid var(--pims-accent);
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

        .pims-filter-select {
            min-width: 180px;
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

        /* No Data Message */
        .pims-no-data {
            text-align: center;
            color: var(--pims-danger);
            font-size: 1.1rem;
            font-weight: 500;
            padding: 2rem;
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('lawyer.menu')

        <div class="pims-content-area">
            <!-- Flash Messages -->
            <div class="pims-card">
                <div class="pims-card-body">
                    @foreach (['success', 'error', 'warning', 'info'] as $msg)
                    @if(session($msg))
                    <div class="pims-notification pims-notification-{{ $msg === 'success' ? 'success' : ($msg === 'error' ? 'danger' : ($msg === 'warning' ? 'warning' : 'info')) }}">
                        {{ session($msg) }}
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-user-shield"></i>MY PRISONER
                    </h2>
                    <div class="pims-card-actions">
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
                            <input type="text" id="pims-prisoner-search" class="pims-search-input" 
                                   placeholder="Search prisoners by name or crime...">
                        </div>
                    </div>

                    <!-- Prisoner Cards Grid -->
                    <div class="pims-grid" id="pims-prisoner-grid">
                        @foreach ($prisoners as $prisoner)
                        <div class="pims-prisoner-card" 
                             data-status="{{ $prisoner->status }}"
                             data-searchable="{{ strtolower($prisoner->first_name) }} {{ strtolower($prisoner->middle_name) }} {{ strtolower($prisoner->last_name) }} {{ strtolower($prisoner->crime_committed) }}">
                            <div class="pims-card">
                                <div class="pims-card-body" style="text-align: center;">
                                    <img src="{{ asset('storage/' . $prisoner->inmate_image) }}" 
                                         alt="Prisoner Image" 
                                         class="pims-prisoner-image">
                                    <p class="pims-prisoner-title">
                                        {{ $prisoner->first_name }} {{ $prisoner->middle_name }} {{ $prisoner->last_name }}
                                    </p>
                                    
                                    <p class="pims-prisoner-detail">
                                        <strong>Status:</strong> 
                                        <span class="pims-status-badge pims-status-{{ $prisoner->status == 'Active' ? 'active' : ($prisoner->status == 'Inactive' ? 'inactive' : 'other') }}">
                                            {{ $prisoner->status }}
                                        </span>
                                    </p>
                                    <p class="pims-prisoner-detail">
                                        <strong>Prison:</strong> {{ optional($prisoner->prison)->name ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="pims-card-footer">
                                    <button class="pims-btn pims-btn-primary pims-btn-sm pims-view-prisoner"
                                            data-id="{{ $prisoner->id }}"
                                            data-name="{{ $prisoner->first_name }} {{ $prisoner->middle_name }} {{ $prisoner->last_name }}"
                                            data-crime="{{ $prisoner->crime_committed }}"
                                            data-sex="{{ $prisoner->gender }}"
                                            data-status="{{ $prisoner->status }}"
                                            data-image="{{ asset('storage/' . $prisoner->inmate_image) }}">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pims-pagination">
                        <!-- Previous Button -->
                        @if($prisoners->currentPage() > 1)
                        <a class="pims-pagination-link" href="{{ $prisoners->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @else
                        <a class="pims-pagination-link is-disabled" href="#">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                        @endif

                        <!-- Page Numbers -->
                        @foreach($prisoners->getUrlRange(1, $prisoners->lastPage()) as $page => $url)
                        <a class="pims-pagination-link {{ $page == $prisoners->currentPage() ? 'is-current' : '' }}" href="{{ $url }}">
                            {{ $page }}
                        </a>
                        @endforeach

                        <!-- Next Button -->
                        @if($prisoners->hasMorePages())
                        <a class="pims-pagination-link" href="{{ $prisoners->nextPageUrl() }}">
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

    <!-- View Prisoner Modal -->
    <div class="pims-modal" id="pims-view-prisoner-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-user"></i> Prisoner Details
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <div class="columns">
                    <div class="column is-6">
                        <p class="pims-prisoner-detail"><strong>Name:</strong> <span id="pims-view-name"></span></p>
                        <p class="pims-prisoner-detail"><strong>Crime Committed:</strong> <span id="pims-view-crime"></span></p>
                        <p class="pims-prisoner-detail"><strong>Gender:</strong> <span id="pims-view-sex"></span></p>
                        <p class="pims-prisoner-detail"><strong>Status:</strong> <span id="pims-view-status"></span></p>
                    </div>
                    <div class="column is-6 has-text-centered">
                        <img id="pims-view-image" src="#" alt="Inmate Image" class="pims-prisoner-image">
                    </div>
                </div>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary pims-close-modal">
                    <i class="fas fa-times"></i> Close
                </button>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal functionality
            document.querySelectorAll('.pims-view-prisoner').forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('pims-view-name').textContent = this.dataset.name;
                    document.getElementById('pims-view-crime').textContent = this.dataset.crime;
                    document.getElementById('pims-view-sex').textContent = this.dataset.sex;
                    document.getElementById('pims-view-status').textContent = this.dataset.status;
                    document.getElementById('pims-view-image').src = this.dataset.image;
                    
                    document.getElementById('pims-view-prisoner-modal').classList.add('is-active');
                });
            });

            // Close modals
            document.querySelectorAll('.pims-modal-close, .pims-modal-background, .pims-close-modal').forEach(element => {
                element.addEventListener('click', function() {
                    document.getElementById('pims-view-prisoner-modal').classList.remove('is-active');
                });
            });

            // Table reload
            document.getElementById('pims-table-reload').addEventListener('click', function() {
                window.location.reload();
            });

            // Search and filter functionality
            const searchInput = document.getElementById('pims-prisoner-search');
            const statusFilter = document.getElementById('pims-status-filter');
            const prisonerCards = document.querySelectorAll('#pims-prisoner-grid .pims-prisoner-card');
            const prisonerGrid = document.getElementById('pims-prisoner-grid');

            function filterPrisoners() {
                const searchTerm = searchInput.value.toLowerCase();
                const status = statusFilter.value;
                let visibleCards = 0;

                prisonerCards.forEach(card => {
                    const searchableText = card.getAttribute('data-searchable');
                    const prisonerStatus = card.getAttribute('data-status');
                    
                    const matchesSearch = searchableText.includes(searchTerm);
                    const matchesStatus = status === '' || prisonerStatus === status;

                    if (matchesSearch && matchesStatus) {
                        card.style.display = '';
                        visibleCards++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show 'No Data Found' if no prisoners match
                let noDataMessage = prisonerGrid.querySelector('.pims-no-data');
                if (!noDataMessage && visibleCards === 0) {
                    noDataMessage = document.createElement('div');
                    noDataMessage.className = 'pims-no-data';
                    noDataMessage.textContent = 'No prisoners found matching your criteria';
                    prisonerGrid.appendChild(noDataMessage);
                } else if (noDataMessage && visibleCards > 0) {
                    noDataMessage.remove();
                }
            }

            // Attach event listeners
            searchInput.addEventListener('input', filterPrisoners);
            statusFilter.addEventListener('change', filterPrisoners);
        });
    </script>
</body>
</html>