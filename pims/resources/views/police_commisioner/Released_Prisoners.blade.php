<!DOCTYPE html>
<html>

@include('includes.head')
<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #eef2ff;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --danger-color: #f72585;
        --dark-color: #1a1a2e;
        --light-color: #f8f9fa;
        --border-color: #dee2e6;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    body {
        background-color: #f9fafb;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #333;
        line-height: 1.6;
    }

    /* Card styling */
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: var(--transition);
    }

    .card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    /* Header */
    .card-header {
        padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-weight: 600;
        font-size: 1.25rem;
        border-bottom: none;
    }

    /* Table styling */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background-color: var(--primary-light);
        color: var(--primary-color);
        font-weight: 600;
        border: none;
        padding: 1rem;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid var(--border-color);
    }

    .table tbody tr:first-child td {
        border-top: none;
    }

    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    /* Badge styling */
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
        border-radius: 8px;
        font-size: 0.8em;
    }

    .bg-success {
        background-color: #2ecc71 !important;
    }

    /* Buttons and links */
    .btn {
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        border-radius: 8px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
    }

    .btn-view {
        color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.1);
        border: none;
    }

    .btn-view:hover {
        background-color: rgba(67, 97, 238, 0.2);
        color: var(--secondary-color);
    }

    .btn-view i {
        font-size: 0.9em;
    }

    /* Alert messages */
    .alert {
        margin-bottom: 1.5rem;
        border-radius: 8px;
        padding: 1rem 1.5rem;
        font-size: 0.95rem;
        border: none;
    }

    .alert-success {
        background-color: rgba(46, 204, 113, 0.15);
        color: #27ae60;
    }

    /* Empty state */
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        color: #adb5bd;
        margin-bottom: 1rem;
    }

    /* Page spacing */
    .container {
        padding-bottom: 3rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table thead {
            display: none;
        }

        .table, .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table td {
            padding: 0.75rem;
            text-align: right;
            position: relative;
            border-top: none;
            border-bottom: 1px solid var(--border-color);
        }

        .table td:before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            top: 0.75rem;
            font-weight: 600;
            color: var(--primary-color);
            text-align: left;
        }

        .table td:last-child {
            border-bottom: none;
        }

        .badge {
            float: right;
        }
    }
</style>

<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('police_commisioner.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Prisoners</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Released Prisoners</a></li>
                    </ul>
                </nav>
                <h2 class="title is-4">Released Prisoners Management</h2>
            </div>

            <div class="container mt-5">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Released Prisoners Registry</h5>
                        <div class="header-actions">
                            <button class="btn btn-sm" style="background-color: var(--primary-light); color: var(--primary-color);">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Released Prisoners Table -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Prisoner ID</th>
                                        <th>Release Date</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($releasedPrisoners as $index => $prisoner)
                                    <tr>
                                        <td data-label="#">{{ $index + 1 }}</td>
                                        <td data-label="Full Name">{{ $prisoner->first_name }} {{ $prisoner->last_name }}</td>
                                        <td data-label="Prisoner ID">{{ $prisoner->id }}</td>
                                        <td data-label="Release Date">{{ \Carbon\Carbon::parse($prisoner->release_date)->format('M d, Y') }}</td>
                                        <td data-label="Reason">
                                            <span class="text-capitalize">{{ str_replace('_', ' ', $prisoner->release_reason) }}</span>
                                        </td>
                                        <td data-label="Status">
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i> Released
                                            </span>
                                        </td>
                                        <td data-label="Actions">
                                            <button class="btn btn-view btn-sm" onclick="viewPrisonerDetails('{{ $prisoner->id }}')">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <i class="fas fa-box-open"></i>
                                                <h5>No released prisoners found</h5>
                                                <p class="mt-2">There are currently no prisoners marked as released in the system.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($releasedPrisoners->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    @if($releasedPrisoners->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                                    </li>
                                    @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $releasedPrisoners->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    @endif

                                    @foreach(range(1, $releasedPrisoners->lastPage()) as $i)
                                    <li class="page-item {{ $releasedPrisoners->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $releasedPrisoners->url($i) }}">{{ $i }}</a>
                                    </li>
                                    @endforeach

                                    @if($releasedPrisoners->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $releasedPrisoners->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                    @else
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                                    </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for prisoner details -->
    <div class="modal fade" id="prisonerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prisoner Release Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="prisonerDetailsContent">
                    <!-- Content will be loaded here via AJAX -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printReleaseDocument()">
                        <i class="fas fa-print me-2"></i> Print Release
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<!-- JS Section -->
<script>
    // View prisoner details
    function viewPrisonerDetails(prisonerId) {
        // In a real application, this would be an AJAX call to fetch prisoner details
        console.log(`Viewing details for prisoner ID: ${prisonerId}`);
        
        // Show loading state
        const modalContent = document.getElementById('prisonerDetailsContent');
        modalContent.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
        
        // Open modal
        const modal = new bootstrap.Modal(document.getElementById('prisonerModal'));
        modal.show();
        
        // Simulate AJAX delay
        setTimeout(() => {
            // This would be replaced with actual data from your backend
            const mockData = {
                id: prisonerId,
                name: "John Doe",
                age: 42,
                crime: "Burglary",
                sentence: "5 years",
                releaseDate: "2023-06-15",
                releaseReason: "Sentence Completed",
                notes: "Prisoner has completed rehabilitation program successfully.",
                image: "/path/to/image.jpg"
            };
            
            // Update modal content
            modalContent.innerHTML = `
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="mb-3" style="width: 150px; height: 150px; background-color: #eee; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user fa-3x text-muted"></i>
                        </div>
                        <h5>${mockData.name}</h5>
                        <p class="text-muted">Prisoner ID: ${mockData.id}</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="col-6">
                                <p><strong>Age:</strong> ${mockData.age}</p>
                                <p><strong>Crime:</strong> ${mockData.crime}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Original Sentence:</strong> ${mockData.sentence}</p>
                                <p><strong>Release Date:</strong> ${new Date(mockData.releaseDate).toLocaleDateString()}</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>Release Details</h6>
                            <p><strong>Reason:</strong> <span class="text-capitalize">${mockData.releaseReason.replace('_', ' ')}</span></p>
                            <p><strong>Notes:</strong> ${mockData.notes}</p>
                        </div>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> This prisoner has been successfully released from custody.
                        </div>
                    </div>
                </div>
            `;
        }, 800);
    }

    // Print release document
    function printReleaseDocument() {
        console.log("Printing release document...");
        // In a real app, this would open a print dialog with a formatted document
        window.print();
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
</body>

</html>