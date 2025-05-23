<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - View Requests</title>
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

        /* Header Styles */
        .pims-content-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .pims-content-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
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

        .pims-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .pims-card-content {
            padding: 1.5rem;
        }

        .pims-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-card-footer {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Request Details */
        .pims-request-detail {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .pims-request-detail strong {
            color: var(--pims-primary);
            font-weight: 600;
            min-width: 120px;
            display: inline-block;
        }

        /* Status Badges */
        .pims-status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pims-status-approved {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
        }

        .pims-status-pending {
            background-color: rgba(211, 84, 0, 0.1);
            color: var(--pims-warning);
        }

        .pims-status-rejected {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
        }

        /* Request ID Tag */
        .pims-request-id {
            background-color: var(--pims-accent);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
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
            font-size: 0.9rem;
        }

        .pims-btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
            border: none;
        }

        .pims-btn-primary:hover {
            background-color: var(--pims-primary);
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
            border: none;
        }

        .pims-btn-danger:hover {
            background-color: #a5281b;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

        .pims-pagination-list {
            display: flex;
            gap: 0.25rem;
            list-style: none;
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

            .pims-card-footer {
                flex-direction: column;
                align-items: flex-end;
            }
        }

        /* Delete Confirmation Modal */
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
            text-align: center;
        }

        .pims-modal-card-body i {
            font-size: 3rem;
            color: var(--pims-danger);
            margin-bottom: 1rem;
        }

        .pims-modal-card-foot {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('lawyer.menu')

        <div class="pims-content-area">
            <div class="pims-content-header">
                <h1 class="pims-content-title">
                    <i class="fas fa-clipboard-list"></i> View Requests
                </h1>
            </div>

            <!-- Request Cards -->
            <div class="pims-request-list">
                @foreach($requests as $request)
                <div class="pims-card">
                    <div class="pims-card-content">
                        <h3 class="pims-card-title">
                            <i class="fas fa-file-alt"></i>
                            {{ ucwords(str_replace('_', ' ', $request->request_type)) }}
                            <span class="pims-request-id">Request #{{ $request->id }}</span>
                        </h3>
                        
                        <div class="pims-request-details">
                            <p class="pims-request-detail">
                                <strong>Status:</strong>
                                <span class="pims-status-badge pims-status-{{ $request->status }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </p>
                            <p class="pims-request-detail">
                                <strong>Approved By:</strong> 
                                {{ $request->approved_by ?? 'N/A' }}
                            </p>
                            <p class="pims-request-detail">
                                <strong>Request Details:</strong> 
                                {{ $request->request_details }}
                            </p>
                            <p class="pims-request-detail">
                                <strong>Prisoner ID:</strong> 
                                {{ $request->prisoner_id }}
                            </p>
                            <p class="pims-request-detail">
                                <strong>Date Created:</strong> 
                                {{ \Carbon\Carbon::parse($request->created_at)->format('M d, Y H:i') }}
                            </p>
                            <p class="pims-request-detail">
                                <strong>Last Updated:</strong> 
                                {{ \Carbon\Carbon::parse($request->updated_at)->format('M d, Y H:i') }}
                            </p>
                        </div>
                    </div>
                    
                 
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pims-pagination">
                <!-- Previous Button -->
                @if($requests->currentPage() > 1)
                <a class="pims-pagination-link" href="{{ $requests->previousPageUrl() }}">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
                @else
                <a class="pims-pagination-link is-disabled" href="#">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
                @endif

                <!-- Page Numbers -->
                <ul class="pims-pagination-list">
                    @foreach($requests->getUrlRange(1, $requests->lastPage()) as $page => $url)
                    <li>
                        <a class="pims-pagination-link {{ $page == $requests->currentPage() ? 'is-current' : '' }}" 
                           href="{{ $url }}">
                            {{ $page }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                <!-- Next Button -->
                @if($requests->hasMorePages())
                <a class="pims-pagination-link" href="{{ $requests->nextPageUrl() }}">
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

    <!-- Delete Confirmation Modal -->
    <div class="pims-modal" id="pims-delete-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <i class="fas fa-trash-alt"></i>
                <p>Are you sure you want to delete <strong id="pims-delete-request-type"></strong> (Request #<span id="pims-delete-request-id"></span>)?</p>
                <p class="has-text-danger">This action cannot be undone.</p>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary pims-close-modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims-delete-form" method="POST" style="display: inline;">
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
            // Delete request functionality
            document.querySelectorAll('.pims-delete-request').forEach(button => {
                button.addEventListener('click', function() {
                    const requestId = this.getAttribute('data-id');
                    const requestType = this.getAttribute('data-type');
                    
                    document.getElementById('pims-delete-request-id').textContent = requestId;
                    document.getElementById('pims-delete-request-type').textContent = requestType;
                    document.getElementById('pims-delete-form').action = `/requests/${requestId}`;
                    
                    document.getElementById('pims-delete-modal').classList.add('is-active');
                });
            });

            // Close modal functionality
            document.querySelectorAll('.pims-modal-close, .pims-modal-background, .pims-close-modal').forEach(element => {
                element.addEventListener('click', function() {
                    document.getElementById('pims-delete-modal').classList.remove('is-active');
                });
            });

            // Edit request functionality
            document.querySelectorAll('.pims-edit-request').forEach(button => {
                button.addEventListener('click', function() {
                    const requestId = this.getAttribute('data-id');
                    // Implement edit functionality here
                    console.log('Editing request ID:', requestId);
                    // window.location.href = `/requests/${requestId}/edit`;
                });
            });
        });
    </script>
</body>
</html>