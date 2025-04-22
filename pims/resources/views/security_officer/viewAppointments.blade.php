<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body class="has-background-light">
    <!-- Navigation -->
    @include('includes.nav')

    <div class="columns is-gapless is-mobile" id="app-content">
        @include('visitor.menu')

        <main class="column is-10" id="page-content">
            <section class="section">
                <!-- Page Header -->
                <div class="content-header">
                    <div class="level">
                        <div class="level-left">
                            <h1 class="title is-4">Visiting Requests</h1>
                        </div>
                        <div class="level-right">
                            <nav class="breadcrumb" aria-label="breadcrumbs">
                                <ul>
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="is-active"><a href="#" aria-current="page">Visiting Requests</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="content-body">
                    <div class="card">
                        <!-- Card Header with Controls -->
                        <header class="card-header">
                            <p class="card-header-title">
                                <span class="icon"><i class="fas fa-history"></i></span>
                                <span>Request History</span>
                            </p>
                            <div class="card-header-icon">
                                <div class="buttons has-addons">
                                    <button class="button is-small is-info" id="table-reload" aria-label="Reload data">
                                        <span class="icon">
                                            <i class="fas fa-sync-alt"></i>
                                        </span>
                                        <span>Refresh</span>
                                    </button>
                                </div>
                            </div>
                        </header>

                        <!-- Filter Controls -->
                        <div class="card-filter card-content">
                            <div class="field is-grouped is-grouped-multiline is-align-items-center">
                                <!-- Search Box -->
                                <div class="control is-expanded has-icons-left">
                                    <input class="input is-rounded" id="table-search" type="text" 
                                           placeholder="Search prisoner names..." aria-label="Search visiting requests">
                                    <span class="icon is-left">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                
                                <!-- Status Filter -->
                                <div class="control">
                                    <div class="select is-rounded">
                                        <select id="status-filter" aria-label="Filter by status">
                                            <option value="">All Statuses</option>
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Date Range Filter -->
                                <div class="control">
                                    <div class="field has-addons">
                                        <div class="control">
                                            <input type="date" id="date-from" class="input is-rounded" 
                                                   aria-label="Filter from date">
                                        </div>
                                        <div class="control">
                                            <a class="button is-static is-rounded">to</a>
                                        </div>
                                        <div class="control">
                                            <input type="date" id="date-to" class="input is-rounded" 
                                                   aria-label="Filter to date">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Records Per Page -->
                                <div class="control">
                                    <div class="select is-rounded">
                                        <select id="table-length" aria-label="Records per page">
                                            <option value="10">10 per page</option>
                                            <option value="25">25 per page</option>
                                            <option value="50">50 per page</option>
                                            <option value="100">100 per page</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Grid Section -->
                        <div class="card-content">
                            <!-- Notification Area -->
                            <div id="notification-area" class="is-hidden">
                                <div class="notification is-success">
                                    <button class="delete" aria-label="Dismiss notification"></button>
                                    <p id="notification-message"></p>
                                </div>
                            </div>
                            
                            <!-- Card Grid -->
                            <div class="columns is-multiline">
                                @forelse ($visitingRequests as $request)
                                    <div class="column is-one-third">
                                        <div class="card request-card">
                                            <div class="card-content">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <figure class="image is-48x48">
                                                            <span class="icon is-large has-text-grey-light">
                                                                <i class="fas fa-user fa-2x"></i>
                                                            </span>
                                                        </figure>
                                                    </div>
                                                    <div class="media-content">
                                                        <p class="title is-5">
                                                            {{ $request->prisoner_firstname }} 
                                                            {{ $request->prisoner_middlename }} 
                                                            {{ $request->prisoner_lastname }}
                                                        </p>
                                                        <p class="subtitle is-7">
                                                            {{ $request->prison->name ?? 'Unknown Facility' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="content">
                                                    <div class="field is-horizontal">
                                                        <div class="field-label is-normal">
                                                            <label class="label">Visit Date</label>
                                                        </div>
                                                        <div class="field-body">
                                                            <div class="field">
                                                                <div class="control">
                                                                    {{ \Carbon\Carbon::parse($request->requested_date)->format('M d, Y') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="field is-horizontal">
                                                        <div class="field-label is-normal">
                                                            <label class="label">Visit Time</label>
                                                        </div>
                                                        <div class="field-body">
                                                            <div class="field">
                                                                <div class="control">
                                                                    {{ \Carbon\Carbon::parse($request->requested_time)->format('h:i A') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="field is-horizontal">
                                                        <div class="field-label is-normal">
                                                            <label class="label">Status</label>
                                                        </div>
                                                        <div class="field-body">
                                                            <div class="field">
                                                                <div class="control">
                                                                    <span class="tag is-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }} is-light is-medium">
                                                                        <span class="icon">
                                                                            @if($request->status == 'pending')
                                                                                <i class="fas fa-clock"></i>
                                                                            @elseif($request->status == 'approved')
                                                                                <i class="fas fa-check-circle"></i>
                                                                            @else
                                                                                <i class="fas fa-times-circle"></i>
                                                                            @endif
                                                                        </span>
                                                                        <span>{{ ucfirst($request->status) }}</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    @if($request->status == 'rejected' && $request->rejection_reason)
                                                        <div class="field is-horizontal">
                                                            <div class="field-label is-normal">
                                                                <label class="label">Rejection Reason</label>
                                                            </div>
                                                            <div class="field-body">
                                                                <div class="field">
                                                                    <div class="control">
                                                                        <p class="has-text-danger">{{ $request->rejection_reason }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <footer class="card-footer">
                                                @if($request->status == 'rejected')
                                                    <a class="card-footer-item js-modal-trigger" 
                                                       data-target="resubmit-modal-{{ $request->id }}"
                                                       aria-haspopup="true"
                                                       aria-label="Resubmit request for {{ $request->prisoner_firstname }}">
                                                        <span class="icon">
                                                            <i class="fas fa-edit"></i>
                                                        </span>
                                                        <span>Resubmit</span>
                                                    </a>
                                                @elseif($request->status == 'approved')
                                                    <a class="card-footer-item has-text-success">
                                                        <span class="icon">
                                                            <i class="fas fa-check-circle"></i>
                                                        </span>
                                                        <span>Approved</span>
                                                    </a>
                                                @else
                                                    <a class="card-footer-item has-text-warning">
                                                        <span class="icon">
                                                            <i class="fas fa-clock"></i>
                                                        </span>
                                                        <span>Pending</span>
                                                    </a>
                                                @endif
                                                
                                              
                                            </footer>
                                        </div>
                                    </div>
                                @empty
                                    <div class="column is-full">
                                        <div class="notification is-light">
                                            No visiting requests found
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            
                            <!-- Pagination -->
                            @if ($visitingRequests->hasPages())
                                <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                                    <ul class="pagination-list">
                                        {{-- Previous Page Link --}}
                                        @if ($visitingRequests->onFirstPage())
                                            <li>
                                                <span class="pagination-previous is-disabled">Previous</span>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $visitingRequests->previousPageUrl() }}" 
                                                   class="pagination-previous" 
                                                   rel="prev">Previous</a>
                                            </li>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @foreach ($visitingRequests->getUrlRange(1, $visitingRequests->lastPage()) as $page => $url)
                                            <li>
                                                <a href="{{ $url }}" 
                                                   class="pagination-link {{ $visitingRequests->currentPage() == $page ? 'is-current' : '' }}" 
                                                   aria-label="Goto page {{ $page }}">
                                                    {{ $page }}
                                                </a>
                                            </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($visitingRequests->hasMorePages())
                                            <li>
                                                <a href="{{ $visitingRequests->nextPageUrl() }}" 
                                                   class="pagination-next" 
                                                   rel="next">Next</a>
                                            </li>
                                        @else
                                            <li>
                                                <span class="pagination-next is-disabled">Next</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Resubmission Modals -->
    @foreach ($visitingRequests as $request)
        @if($request->status == 'rejected')
            <div class="modal" id="resubmit-modal-{{ $request->id }}">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">
                            <span class="icon"><i class="fas fa-edit"></i></span>
                            <span>Resubmit Visiting Request</span>
                        </p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    
                    <section class="modal-card-body">
                        <form method="POST" action="{{ route('visitor.resubmitRequest', $request->id) }}" 
                              id="resubmit-form-{{ $request->id }}">
                            @csrf
                            
                            <div class="columns is-multiline">
                                <!-- Prisoner Information -->
                                <div class="column is-half">
                                    <div class="card">
                                        <div class="card-content">
                                            <h3 class="title is-5 has-text-primary">
                                                <span class="icon"><i class="fas fa-user"></i></span>
                                                <span>Prisoner Information</span>
                                            </h3>
                                            
                                            <div class="field">
                                                <label class="label">Requested Visiting Date</label>
                                                <div class="control">
                                                    <input class="input" type="date" name="requested_date" 
                                                           value="{{ old('requested_date', $request->requested_date) }}" 
                                                           required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Requested Visiting Time</label>
                                                <div class="control">
                                                    <input class="input" type="time" name="requested_time" 
                                                           value="{{ old('requested_time', $request->requested_time) }}" 
                                                           required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Prisoner First Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="prisoner_firstname" 
                                                           value="{{ old('prisoner_firstname', $request->prisoner_firstname) }}" 
                                                           required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Prisoner Middle Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="prisoner_middlename" 
                                                           value="{{ old('prisoner_middlename', $request->prisoner_middlename) }}">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Prisoner Last Name</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="prisoner_lastname" 
                                                           value="{{ old('prisoner_lastname', $request->prisoner_lastname) }}" 
                                                           required>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label class="label">Facility</label>
                                                <div class="control">
                                                    <div class="select is-fullwidth">
                                                        <select name="prison_id" required>
                                                            <option value="">Select Facility</option>
                                                            @foreach($prisons as $prison)
                                                                <option value="{{ $prison->id }}" 
                                                                    {{ old('prison_id', $request->prison_id) == $prison->id ? 'selected' : '' }}>
                                                                    {{ $prison->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Resubmission Details -->
                                <div class="column is-half">
                                    <div class="card">
                                        <div class="card-content">
                                            <h3 class="title is-5 has-text-primary">
                                                <span class="icon"><i class="fas fa-info-circle"></i></span>
                                                <span>Resubmission Details</span>
                                            </h3>
                                            
                                            <div class="field">
                                                <label class="label">Reason for Resubmission</label>
                                                <div class="control">
                                                    <textarea class="textarea" name="note" required 
                                                              placeholder="Explain why you're resubmitting this request">{{ old('note') }}</textarea>
                                                </div>
                                                <p class="help">Please provide details about any changes or corrections</p>
                                            </div>
                                            
                                            <div class="field">
                                                <label class="label">Previous Status</label>
                                                <div class="control">
                                                    <input class="input" type="text" value="Rejected" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="field">
                                                <label class="label">Original Submission</label>
                                                <div class="control">
                                                    <input class="input" type="text" 
                                                           value="{{ $request->created_at->format('M d, Y h:i A') }}" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="field">
                                                <label class="label">Rejection Reason</label>
                                                <div class="control">
                                                    <textarea class="textarea" readonly>{{ $request->note ?? 'Not specified' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                    
                    <footer class="modal-card-foot">
                        <button type="submit" form="resubmit-form-{{ $request->id }}" 
                                class="button is-primary is-fullwidth-mobile">
                            <span class="icon"><i class="fas fa-paper-plane"></i></span>
                            <span>Submit Resubmission</span>
                        </button>
                        <button type="button" class="button is-light js-modal-close is-fullwidth-mobile">
                            <span class="icon"><i class="fas fa-times"></i></span>
                            <span>Cancel</span>
                        </button>
                    </footer>
                </div>
            </div>
        @endif
    @endforeach

    @include('includes.footer_js')
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Modal Handling
            const modalFunctions = {
                openModal: ($el) => $el.classList.add('is-active'),
                closeModal: ($el) => $el.classList.remove('is-active'),
                closeAllModals: () => document.querySelectorAll('.modal').forEach(modal => modalFunctions.closeModal(modal))
            };

            // Modal Triggers
            document.querySelectorAll('.js-modal-trigger').forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const target = trigger.dataset.target;
                    modalFunctions.openModal(document.getElementById(target));
                });
            });

            // Modal Closers
            document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button.js-modal-close').forEach(closer => {
                closer.addEventListener('click', () => {
                    modalFunctions.closeModal(closer.closest('.modal'));
                });
            });

            // Keyboard Escape
            document.addEventListener('keydown', (event) => {
                if(event.key === 'Escape') modalFunctions.closeAllModals();
            });
            
            // Table Reload Button
            document.getElementById('table-reload')?.addEventListener('click', () => {
                window.location.reload();
            });

            // Initialize filters (placeholder for actual implementation)
            document.getElementById('status-filter')?.addEventListener('change', filterCards);
            document.getElementById('table-search')?.addEventListener('input', filterCards);
            document.getElementById('date-from')?.addEventListener('change', filterCards);
            document.getElementById('date-to')?.addEventListener('change', filterCards);
            
            function filterCards() {
                const statusFilter = document.getElementById('status-filter').value.toLowerCase();
                const searchQuery = document.getElementById('table-search').value.toLowerCase();
                const dateFrom = document.getElementById('date-from').value;
                const dateTo = document.getElementById('date-to').value;
                
                document.querySelectorAll('.request-card').forEach(card => {
                    const cardStatus = card.querySelector('.tag').textContent.toLowerCase();
                    const prisonerName = card.querySelector('.title').textContent.toLowerCase();
                    const visitDate = card.querySelector('.field:nth-child(2) .control').textContent.trim();
                    
                    // Convert visit date to comparable format (assuming format like "Jan 01, 2021")
                    const visitDateObj = new Date(visitDate);
                    const fromDateObj = dateFrom ? new Date(dateFrom) : null;
                    const toDateObj = dateTo ? new Date(dateTo) : null;
                    
                    let matches = true;
                    
                    // Status filter
                    if (statusFilter && !cardStatus.includes(statusFilter)) {
                        matches = false;
                    }
                    
                    // Search filter
                    if (searchQuery && !prisonerName.includes(searchQuery)) {
                        matches = false;
                    }
                    
                    // Date range filter
                    if (fromDateObj && visitDateObj < fromDateObj) {
                        matches = false;
                    }
                    
                    if (toDateObj && visitDateObj > toDateObj) {
                        matches = false;
                    }
                    
                    // Show/hide card based on filters
                    card.style.display = matches ? 'block' : 'none';
                });
            }
        });
    </script>
    
    <style>
        .request-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .request-card .card-content {
            flex-grow: 1;
        }
        
        .request-card .field-label {
            flex-grow: 1;
            flex-shrink: 0;
            flex-basis: 100px;
        }
        
        .request-card .field-body {
            flex-grow: 2;
        }
        
        .request-card .tag {
            font-size: 0.9rem;
        }
        
        .card-footer-item {
            transition: background-color 0.2s ease;
        }
    </style>
</body>
</html>