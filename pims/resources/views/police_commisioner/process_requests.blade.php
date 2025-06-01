<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Execute Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta name="description" content="Commissioner portal for executing approved prisoner requests">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .badge-approved {
            background-color: var(--primary-color);
        }

        .badge-in-progress {
            background-color: var(--warning-color);
            color: #212529;
        }

        .badge-completed {
            background-color: var(--success-color);
        }

        .badge-cancelled {
            background-color: var(--danger-color);
        }

        .action-btn {
            min-width: 100px;
        }

        .table th {
            font-weight: 600;
            background-color: #f1f5f9;
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
            color: var(--secondary-color);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }
        
        .request-details-modal .modal-body {
            padding: 1.5rem;
        }
        
        .detail-row {
            margin-bottom: 1rem;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--secondary-color);
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-tasks me-2"></i>Execute Requests
            </h5>
            <div>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-filter me-1"></i> Showing Approved Requests Only
                </span>
            </div>
        </div>

        <div class="card-body">

            <!-- Success / Error Messages -->
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Approved Requests Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Request Title</th>
                            <th>Type</th>
                            <th>Requested By</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($approvedRequests as $index => $request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $request->id }}">
                                        {{ $request->title }}
                                        <i class="fas fa-info-circle ms-1 text-primary"></i>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ ucfirst($request->type) }}
                                    </span>
                                </td>
                                <td>{{ $request->requested_by }}</td>
                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($request->status === 'completed')
                                        <span class="badge status-badge badge-completed">
                                            <i class="fas fa-check-circle me-1"></i> Completed
                                        </span>
                                    @elseif($request->status === 'in_progress')
                                        <span class="badge status-badge badge-in-progress">
                                            <i class="fas fa-spinner me-1"></i> In Progress
                                        </span>
                                    @elseif($request->status === 'cancelled')
                                        <span class="badge status-badge badge-cancelled">
                                            <i class="fas fa-times-circle me-1"></i> Cancelled
                                        </span>
                                    @else
                                        <span class="badge status-badge badge-approved">
                                            <i class="fas fa-thumbs-up me-1"></i> Approved
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if($request->status === 'approved')
                                            <form action="{{ route('requests.start', $request->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning action-btn">
                                                    <i class="fas fa-play me-1"></i> Start
                                                </button>
                                            </form>

                                            <button type="button" class="btn btn-sm btn-outline-danger action-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cancelModal{{ $request->id }}">
                                                <i class="fas fa-ban me-1"></i> Cancel
                                            </button>
                                            
                                            <!-- Cancel Confirmation Modal -->
                                            <div class="modal fade" id="cancelModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Confirm Cancellation</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to cancel this request?</p>
                                                            <p><strong>Request:</strong> {{ $request->title }}</p>
                                                            <p><strong>Type:</strong> {{ ucfirst($request->type) }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="{{ route('requests.cancel', $request->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-ban me-1"></i> Confirm Cancel
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @elseif($request->status === 'in_progress')
                                            <button type="button" class="btn btn-sm btn-success action-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#completeModal{{ $request->id }}">
                                                <i class="fas fa-check-circle me-1"></i> Complete
                                            </button>
                                            
                                            <!-- Complete Confirmation Modal -->
                                            <div class="modal fade" id="completeModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h5 class="modal-title">Mark Request as Completed</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Confirm that this request has been fully executed:</p>
                                                            <p><strong>Request:</strong> {{ $request->title }}</p>
                                                            <div class="mb-3">
                                                                <label for="completionNotes{{ $request->id }}" class="form-label">Completion Notes (Optional):</label>
                                                                <textarea class="form-control" id="completionNotes{{ $request->id }}" rows="3" name="notes"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form action="{{ route('requests.complete', $request->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="fas fa-check-circle me-1"></i> Mark Complete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @else
                                            <span class="text-muted">No actions available</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Request Details Modal -->
                            <div class="modal fade request-details-modal" id="detailsModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Request Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="detail-row">
                                                <div class="detail-label">Title</div>
                                                <div>{{ $request->title }}</div>
                                            </div>
                                            
                                            <div class="detail-row">
                                                <div class="detail-label">Type</div>
                                                <div>
                                                    <span class="badge bg-info text-dark">
                                                        {{ ucfirst($request->type) }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="detail-row">
                                                <div class="detail-label">Requested By</div>
                                                <div>{{ $request->requested_by }}</div>
                                            </div>
                                            
                                            <div class="detail-row">
                                                <div class="detail-label">Date Requested</div>
                                                <div>{{ $request->created_at->format('M d, Y h:i A') }}</div>
                                            </div>
                                            
                                            <div class="detail-row">
                                                <div class="detail-label">Status</div>
                                                <div>
                                                    @if($request->status === 'completed')
                                                        <span class="badge status-badge badge-completed">
                                                            <i class="fas fa-check-circle me-1"></i> Completed
                                                        </span>
                                                    @elseif($request->status === 'in_progress')
                                                        <span class="badge status-badge badge-in-progress">
                                                            <i class="fas fa-spinner me-1"></i> In Progress
                                                        </span>
                                                    @elseif($request->status === 'cancelled')
                                                        <span class="badge status-badge badge-cancelled">
                                                            <i class="fas fa-times-circle me-1"></i> Cancelled
                                                        </span>
                                                    @else
                                                        <span class="badge status-badge badge-approved">
                                                            <i class="fas fa-thumbs-up me-1"></i> Approved
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="detail-row">
                                                <div class="detail-label">Description</div>
                                                <div>{{ $request->description ?? 'No description provided' }}</div>
                                            </div>
                                            
                                            @if($request->status === 'completed' && $request->completion_notes)
                                                <div class="detail-row">
                                                    <div class="detail-label">Completion Notes</div>
                                                    <div>{{ $request->completion_notes }}</div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h5>No Approved Requests Found</h5>
                                        <p class="mb-0">There are currently no approved requests awaiting execution.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($approvedRequests->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $approvedRequests->links() }}
                </div>
            @endif
        </div>
        
        <div class="card-footer text-muted">
            <small>
                <i class="fas fa-info-circle me-1"></i> 
                Showing {{ $approvedRequests->count() }} approved requests
                @if($approvedRequests->total() > $approvedRequests->count())
                    of {{ $approvedRequests->total() }} total
                @endif
            </small>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Auto-focus on textarea when complete modal is shown
        document.querySelectorAll('[data-bs-target^="#completeModal"]').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-bs-target');
                const modal = document.querySelector(modalId);
                modal.addEventListener('shown.bs.modal', function() {
                    const textarea = this.querySelector('textarea');
                    if (textarea) {
                        textarea.focus();
                    }
                });
            });
        });
    });
</script>

</body>
</html>