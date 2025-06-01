<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Visiting Requests</title>
    
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

        .pims-content-area {
            flex: 1;
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
        }

        /* Page Header */
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
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-breadcrumb {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .pims-breadcrumb a {
            color: var(--pims-accent);
            text-decoration: none;
            transition: var(--pims-transition);
        }

        .pims-breadcrumb a:hover {
            color: var(--pims-primary);
            text-decoration: underline;
        }

        .pims-breadcrumb-separator {
            margin: 0 0.5rem;
            color: #7f8c8d;
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

        .pims-card-footer {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Filter Controls */
        .pims-filter-controls {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: center;
            padding: 1rem;
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
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

        /* Request Cards Grid */
        .pims-requests-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .pims-request-card {
            transition: var(--pims-transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pims-request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .pims-request-media {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .pims-request-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: rgba(41, 128, 185, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--pims-accent);
            font-size: 1.25rem;
        }

        .pims-request-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 0.25rem;
        }

        .pims-request-subtitle {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .pims-request-detail {
            margin-bottom: 1rem;
        }

        .pims-detail-row {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .pims-detail-label {
            flex: 0 0 120px;
            font-weight: 500;
            color: var(--pims-primary);
        }

        .pims-detail-value {
            flex: 1;
        }

        .pims-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            gap: 0.5rem;
        }

        .pims-status-pending {
            background-color: rgba(211, 84, 0, 0.1);
            color: var(--pims-warning);
        }

        .pims-status-approved {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
        }

        .pims-status-rejected {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
        }

        /* Request Card Footer */
        .pims-request-footer {
            margin-top: auto;
            display: flex;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding-top: 1rem;
        }

        .pims-request-action {
            flex: 1;
            text-align: center;
            padding: 0.5rem;
            color: var(--pims-accent);
            font-weight: 500;
            text-decoration: none;
            transition: var(--pims-transition);
            border-radius: var(--pims-border-radius);
        }

        .pims-request-action:hover {
            background-color: rgba(41, 128, 185, 0.1);
        }

        .pims-request-action i {
            margin-right: 0.5rem;
        }

        /* Button Styles */
        .pims-btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.95rem;
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

        .pims-btn-secondary {
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
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

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
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
            max-width: 800px;
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-requests-grid {
                grid-template-columns: 1fr;
            }

            .pims-filter-controls {
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
        @include('visitor.menu')

        <div class="pims-content-area">
            <!-- Page Header -->
            <div class="pims-page-header">
                <h1 class="pims-page-title">
                    <i class="fas fa-history"></i> Visiting Requests
                </h1>
                <div class="pims-breadcrumb">
                    <a href="#">Dashboard</a>
                    <span class="pims-breadcrumb-separator">/</span>
                    <span>Visiting Requests</span>
                </div>
            </div>

            <!-- Flash Messages -->
            @foreach (['success', 'error', 'warning', 'info'] as $msg)
                @if(session($msg))
                <div class="pims-notification pims-notification-{{ $msg === 'success' ? 'success' : ($msg === 'error' ? 'danger' : ($msg === 'warning' ? 'warning' : 'info')) }}">
                    {{ session($msg) }}
                </div>
                @endif
            @endforeach

            <!-- Main Card -->
            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-list"></i> Request History
                    </h2>
                    <button id="pims-table-reload" class="pims-btn pims-btn-secondary pims-btn-sm">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>

                <!-- Filter Controls -->
                <div class="pims-card-body">
                    <div class="pims-filter-controls">
                        <div class="pims-search">
                            <i class="fas fa-search pims-search-icon"></i>
                            <input type="text" id="pims-table-search" class="pims-search-input" 
                                   placeholder="Search prisoner names...">
                        </div>

                        <div class="pims-filter-select">
                            <select id="pims-status-filter" class="pims-search-input">
                                <option value="">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="field has-addons">
                            <div class="control">
                                <input type="date" id="pims-date-from" class="pims-search-input" 
                                       placeholder="From date">
                            </div>
                            <div class="control">
                                <a class="pims-btn pims-btn-secondary">to</a>
                            </div>
                            <div class="control">
                                <input type="date" id="pims-date-to" class="pims-search-input" 
                                       placeholder="To date">
                            </div>
                        </div>
                    </div>

                    <!-- Requests Grid -->
                    <div class="pims-requests-grid" id="pims-requests-container">
                        @forelse ($visitingRequests as $request)
                            <div class="pims-request-card pims-card" 
                                 data-status="{{ $request->status }}"
                                 data-search="{{ strtolower($request->prisoner_firstname.' '.$request->prisoner_middlename.' '.$request->prisoner_lastname) }}"
                                 data-date="{{ $request->requested_date }}">
                                <div class="pims-card-body">
                                    <div class="pims-request-media">
                                        <div class="pims-request-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <h3 class="pims-request-title">
                                                {{ $request->prisoner_firstname }} 
                                                {{ $request->prisoner_middlename }} 
                                                {{ $request->prisoner_lastname }}
                                            </h3>
                                            <p class="pims-request-subtitle">
                                                {{ $request->prison->name ?? 'Unknown Facility' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="pims-request-detail">
                                        <div class="pims-detail-row">
                                            <span class="pims-detail-label">Visit Date:</span>
                                            <span class="pims-detail-value">
                                                {{ \Carbon\Carbon::parse($request->requested_date)->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <div class="pims-detail-row">
                                            <span class="pims-detail-label">Visit Time:</span>
                                            <span class="pims-detail-value">
                                                {{ \Carbon\Carbon::parse($request->requested_time)->format('h:i A') }}
                                            </span>
                                        </div>
                                        <div class="pims-detail-row">
                                            <span class="pims-detail-label">Status:</span>
                                            <span class="pims-detail-value">
                                                <span class="pims-status-badge pims-status-{{ $request->status }}">
                                                    <i class="fas fa-{{ $request->status == 'pending' ? 'clock' : ($request->status == 'approved' ? 'check-circle' : 'times-circle') }}"></i>
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </span>
                                        </div>
                                        @if($request->status == 'rejected' && $request->rejection_reason)
                                            <div class="pims-detail-row">
                                                <span class="pims-detail-label">Reason:</span>
                                                <span class="pims-detail-value has-text-danger">
                                                    {{ $request->rejection_reason }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="pims-request-footer">
                                    @if($request->status == 'rejected')
                                        <a class="pims-request-action js-modal-trigger" 
                                           data-target="pims-resubmit-modal-{{ $request->id }}">
                                            <i class="fas fa-edit"></i> Resubmit
                                        </a>
                                    @elseif($request->status == 'approved')
                                        <span class="pims-request-action has-text-success">
                                            <i class="fas fa-check-circle"></i> Approved
                                        </span>
                                    @else
                                        <span class="pims-request-action has-text-warning">
                                            <i class="fas fa-clock"></i> Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="pims-card" style="grid-column: 1 / -1;">
                                <div class="pims-card-body has-text-centered">
                                    <div class="pims-request-avatar" style="margin: 0 auto 1rem; width: 64px; height: 64px;">
                                        <i class="fas fa-inbox" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h3 class="pims-request-title">No visiting requests found</h3>
                                    <p class="pims-request-subtitle">You haven't made any visiting requests yet</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($visitingRequests->hasPages())
                        <div class="pims-pagination">
                            {{-- Previous Page Link --}}
                            @if ($visitingRequests->onFirstPage())
                                <span class="pims-pagination-link is-disabled">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </span>
                            @else
                                <a href="{{ $visitingRequests->previousPageUrl() }}" class="pims-pagination-link">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($visitingRequests->getUrlRange(1, $visitingRequests->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="pims-pagination-link {{ $visitingRequests->currentPage() == $page ? 'is-current' : '' }}">
                                    {{ $page }}
                                </a>
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($visitingRequests->hasMorePages())
                                <a href="{{ $visitingRequests->nextPageUrl() }}" class="pims-pagination-link">
                                    Next <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="pims-pagination-link is-disabled">
                                    Next <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Resubmission Modals -->
    @foreach ($visitingRequests as $request)
        @if($request->status == 'rejected')
            <div class="pims-modal" id="pims-resubmit-modal-{{ $request->id }}">
                <div class="pims-modal-card">
                    <header class="pims-modal-card-head">
                        <p class="pims-modal-card-title">
                            <i class="fas fa-edit"></i> Resubmit Visiting Request
                        </p>
                        <button class="pims-modal-close">&times;</button>
                    </header>
                    
                    <section class="pims-modal-card-body">
                        <form method="POST" action="{{ route('visitor.resubmitRequest', $request->id) }}" 
                              id="pims-resubmit-form-{{ $request->id }}">
                            @csrf
                            
                            <div class="columns is-multiline">
                                <!-- Prisoner Information -->
                                <div class="column is-half">
                                    <div class="pims-card">
                                        <div class="pims-card-body">
                                            <h3 class="pims-card-title">
                                                <i class="fas fa-user"></i> Prisoner Information
                                            </h3>
                                            
                                            <div class="pims-form-group">
                                                <label class="pims-label">Requested Visiting Date</label>
                                                <input class="pims-input" type="date" name="requested_date" 
                                                       value="{{ old('requested_date', $request->requested_date) }}" 
                                                       required>
                                            </div>

                                            <div class="pims-form-group">
                                                <label class="pims-label">Requested Visiting Time</label>
                                                <input class="pims-input" type="time" name="requested_time" 
                                                       value="{{ old('requested_time', $request->requested_time) }}" 
                                                       required>
                                            </div>

                                            <div class="pims-form-group">
                                                <label class="pims-label">Prisoner First Name</label>
                                                <input class="pims-input" type="text" name="prisoner_firstname" 
                                                       value="{{ old('prisoner_firstname', $request->prisoner_firstname) }}" 
                                                       required>
                                            </div>

                                            <div class="pims-form-group">
                                                <label class="pims-label">Prisoner Middle Name</label>
                                                <input class="pims-input" type="text" name="prisoner_middlename" 
                                                       value="{{ old('prisoner_middlename', $request->prisoner_middlename) }}">
                                            </div>

                                            <div class="pims-form-group">
                                                <label class="pims-label">Prisoner Last Name</label>
                                                <input class="pims-input" type="text" name="prisoner_lastname" 
                                                       value="{{ old('prisoner_lastname', $request->prisoner_lastname) }}" 
                                                       required>
                                            </div>

                                            <div class="pims-form-group">
                                                <label class="pims-label">Facility</label>
                                                <div class="pims-select">
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
                                
                                <!-- Resubmission Details -->
                                <div class="column is-half">
                                    <div class="pims-card">
                                        <div class="pims-card-body">
                                            <h3 class="pims-card-title">
                                                <i class="fas fa-info-circle"></i> Resubmission Details
                                            </h3>
                                            
                                            <div class="pims-form-group">
                                                <label class="pims-label">Reason for Resubmission</label>
                                                <textarea class="pims-input" name="note" required 
                                                          placeholder="Explain why you're resubmitting this request">{{ old('note') }}</textarea>
                                                <p class="pims-request-subtitle">Please provide details about any changes or corrections</p>
                                            </div>
                                            
                                            <div class="pims-form-group">
                                                <label class="pims-label">Previous Status</label>
                                                <input class="pims-input" type="text" value="Rejected" readonly>
                                            </div>
                                            
                                            <div class="pims-form-group">
                                                <label class="pims-label">Original Submission</label>
                                                <input class="pims-input" type="text" 
                                                       value="{{ $request->created_at->format('M d, Y h:i A') }}" readonly>
                                            </div>
                                            
                                            <div class="pims-form-group">
                                                <label class="pims-label">Rejection Reason</label>
                                                <textarea class="pims-input" readonly>{{ $request->rejection_reason ?? 'Not specified' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                    
                    <footer class="pims-modal-card-foot">
                        <button type="button" class="pims-btn pims-btn-secondary pims-modal-close">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" form="pims-resubmit-form-{{ $request->id }}" 
                                class="pims-btn pims-btn-primary">
                            <i class="fas fa-paper-plane"></i> Submit Resubmission
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
                openModal: (target) => {
                    document.getElementById(target).classList.add('is-active');
                },
                closeModal: (modal) => {
                    modal.classList.remove('is-active');
                },
                closeAllModals: () => {
                    document.querySelectorAll('.pims-modal').forEach(modal => {
                        modalFunctions.closeModal(modal);
                    });
                }
            };

            // Modal Triggers
            document.querySelectorAll('.js-modal-trigger').forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const target = trigger.dataset.target;
                    modalFunctions.openModal(target);
                });
            });

            // Modal Closers
            document.querySelectorAll('.pims-modal-close').forEach(closer => {
                closer.addEventListener('click', () => {
                    modalFunctions.closeModal(closer.closest('.pims-modal'));
                });
            });

            // Close modal when clicking on background
            document.querySelectorAll('.pims-modal').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modalFunctions.closeModal(modal);
                    }
                });
            });

            // Keyboard Escape
            document.addEventListener('keydown', (event) => {
                if(event.key === 'Escape') modalFunctions.closeAllModals();
            });
            
            // Table Reload Button
            document.getElementById('pims-table-reload')?.addEventListener('click', () => {
                window.location.reload();
            });

            // Filter functionality
            function filterRequests() {
                const statusFilter = document.getElementById('pims-status-filter').value.toLowerCase();
                const searchQuery = document.getElementById('pims-table-search').value.toLowerCase();
                const dateFrom = document.getElementById('pims-date-from').value;
                const dateTo = document.getElementById('pims-date-to').value;
                
                document.querySelectorAll('#pims-requests-container .pims-request-card').forEach(card => {
                    const cardStatus = card.dataset.status;
                    const searchText = card.dataset.search;
                    const visitDate = card.dataset.date;
                    
                    let matches = true;
                    
                    // Status filter
                    if (statusFilter && cardStatus !== statusFilter) {
                        matches = false;
                    }
                    
                    // Search filter
                    if (searchQuery && !searchText.includes(searchQuery)) {
                        matches = false;
                    }
                    
                    // Date range filter
                    if (dateFrom && visitDate < dateFrom) {
                        matches = false;
                    }
                    
                    if (dateTo && visitDate > dateTo) {
                        matches = false;
                    }
                    
                    // Show/hide card based on filters
                    card.style.display = matches ? 'flex' : 'none';
                });
            }

            // Attach event listeners for filters
            document.getElementById('pims-status-filter')?.addEventListener('change', filterRequests);
            document.getElementById('pims-table-search')?.addEventListener('input', filterRequests);
            document.getElementById('pims-date-from')?.addEventListener('change', filterRequests);
            document.getElementById('pims-date-to')?.addEventListener('change', filterRequests);
        });
    </script>
</body>
</html>