<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Released Prisoners</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pims-primary: #2c3e50;
            --pims-secondary: #34495e;
            --pims-accent: #3498db;
            --pims-light: #ecf0f1;
            --pims-lighter: #f8f9fa;
            --pims-danger: #e74c3c;
            --pims-success: #2ecc71;
            --pims-warning: #f39c12;
            --pims-border-radius: 8px;
            --pims-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
        }

        /* Main Layout */
        .pims-app-container {
            padding-top: 70px;
            display: flex;
            min-height: 100vh;
        }

        .pims-main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 250px;
            transition: var(--pims-transition);
        }

        .pims-content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Styles */
        .pims-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .pims-page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-page-title i {
            color: var(--pims-accent);
        }

        .pims-breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .pims-breadcrumb li {
            display: flex;
            align-items: center;
        }

        .pims-breadcrumb li:not(:last-child)::after {
            content: '/';
            margin: 0 0.5rem;
            color: var(--pims-secondary);
        }

        .pims-breadcrumb a {
            color: var(--pims-accent);
            text-decoration: none;
            transition: var(--pims-transition);
        }

        .pims-breadcrumb a:hover {
            color: var(--pims-primary);
        }

        .pims-breadcrumb .pims-active {
            color: var(--pims-primary);
            font-weight: 500;
        }

        /* Card Styles */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .pims-card-header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-card-header h5 {
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        /* Table Styles */
        .pims-table-container {
            overflow-x: auto;
        }

        .pims-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: var(--pims-border-radius);
            overflow: hidden;
        }

        .pims-table th {
            background-color: var(--pims-primary);
            color: white;
            font-weight: 500;
            text-align: left;
            padding: 1rem;
        }

        .pims-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .pims-table tr:last-child td {
            border-bottom: none;
        }

        .pims-table tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        /* Status Badges */
        .pims-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .pims-badge-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
        }

        /* Button Styles */
        .pims-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-size: 0.9rem;
            gap: 0.5rem;
        }

        .pims-btn i {
            font-size: 0.9em;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: #2980b9;
        }

        .pims-btn-secondary {
            background-color: var(--pims-secondary);
            color: white;
        }

        .pims-btn-secondary:hover {
            background-color: #2c3e50;
        }

        .pims-btn-light {
            background-color: var(--pims-light);
            color: var(--pims-secondary);
        }

        .pims-btn-light:hover {
            background-color: #dfe6e9;
        }

        .pims-btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
        }

        /* Alert Styles */
        .pims-alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--pims-border-radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-alert-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-alert i {
            font-size: 1.25rem;
        }

        /* Empty State */
        .pims-empty-state {
            text-align: center;
            padding: 2rem;
        }

        .pims-empty-state i {
            font-size: 3rem;
            color: var(--pims-accent);
            margin-bottom: 1rem;
        }

        .pims-empty-state h5 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--pims-primary);
        }

        .pims-empty-state p {
            color: var(--pims-secondary);
        }

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .pims-pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 0.5rem;
        }

        .pims-pagination-item {
            display: flex;
        }

        .pims-pagination-link {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            color: var(--pims-primary);
            text-decoration: none;
            transition: var(--pims-transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-pagination-link:hover {
            background-color: var(--pims-light);
        }

        .pims-pagination-link.active {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-pagination-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal Styles */
        .pims-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .pims-modal.active {
            display: flex;
        }

        .pims-modal-container {
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--pims-secondary);
            transition: var(--pims-transition);
        }

        .pims-modal-close:hover {
            color: var(--pims-primary);
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Details Grid */
        .pims-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .pims-detail-item {
            margin-bottom: 1rem;
        }

        .pims-detail-item strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--pims-secondary);
            font-weight: 500;
        }

        .pims-detail-item span {
            display: block;
            padding: 0.5rem;
            background-color: var(--pims-lighter);
            border-radius: var(--pims-border-radius);
        }

        .pims-inmate-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            background-color: var(--pims-light);
            padding: 1rem;
        }

        /* Loading Spinner */
        .pims-spinner {
            width: 3rem;
            height: 3rem;
            border: 0.25rem solid rgba(52, 152, 219, 0.2);
            border-top-color: var(--pims-accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
            
            .pims-table th, 
            .pims-table td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .pims-page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .pims-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .pims-table th:nth-child(4),
            .pims-table td:nth-child(4),
            .pims-table th:nth-child(5),
            .pims-table td:nth-child(5) {
                display: none;
            }
            
            .pims-details-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .pims-table th:nth-child(3),
            .pims-table td:nth-child(3),
            .pims-table th:nth-child(6),
            .pims-table td:nth-child(6) {
                display: none;
            }
            
            .pims-modal-container {
                width: 95%;
                max-height: 85vh;
            }
        }
    </style>
</head>
<body>
    <div class="pims-app-container">
        <!-- Navigation -->
        @include('includes.nav')
        
        <!-- Sidebar -->
        @include('police_commisioner.menu')
        
        <main class="pims-main-content">
            <div class="pims-content-container">
             
                
                <!-- Page Header -->
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-user-check"></i> Released Prisoners Management
                    </h2>
                </div>
                
                <!-- Main Card -->
                <div class="pims-card">
                    <div class="pims-card-header">
                        <h5>Released Prisoners Registry</h5>
                        <button class="pims-btn pims-btn-light pims-btn-sm">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                    
                    <div class="pims-card-body">
                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="pims-alert pims-alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                        @endif
                        
                        <!-- Released Prisoners Table -->
                        <div class="pims-table-container">
                            <table class="pims-table">
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
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $prisoner->first_name }} {{ $prisoner->last_name }}</td>
                                        <td>{{ $prisoner->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($prisoner->release_date)->format('M d, Y') }}</td>
                                        <td>
                                            <span class="text-capitalize">{{ str_replace('_', ' ', $prisoner->release_reason) }}</span>
                                        </td>
                                        <td>
                                            <span class="pims-badge pims-badge-success">
                                                <i class="fas fa-check-circle"></i> Released
                                            </span>
                                        </td>
                                        <td>
                                            <button class="pims-btn pims-btn-outline pims-btn-sm pims-view-prisoner" 
                                                    data-id="{{ $prisoner->id }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="pims-empty-state">
                                                <i class="fas fa-box-open"></i>
                                                <h5>No released prisoners found</h5>
                                                <p>There are currently no prisoners marked as released in the system.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        @if($releasedPrisoners->hasPages())
                        <div class="pims-pagination">
                            <ul class="pims-pagination-list">
                                @if($releasedPrisoners->onFirstPage())
                                <li class="pims-pagination-item">
                                    <span class="pims-pagination-link disabled">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                                @else
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->previousPageUrl() }}" class="pims-pagination-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                @endif
                                
                                @foreach(range(1, $releasedPrisoners->lastPage()) as $i)
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->url($i) }}" 
                                       class="pims-pagination-link {{ $releasedPrisoners->currentPage() == $i ? 'active' : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                                @endforeach
                                
                                @if($releasedPrisoners->hasMorePages())
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->nextPageUrl() }}" class="pims-pagination-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                                @else
                                <li class="pims-pagination-item">
                                    <span class="pims-pagination-link disabled">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Prisoner Details Modal -->
    <div class="pims-modal" id="pims-prisoner-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h5><i class="fas fa-user"></i> Prisoner Release Details</h5>
                <button class="pims-modal-close">&times;</button>
            </div>
            
            <div class="pims-modal-body" id="pims-prisoner-details-content">
                <div class="pims-spinner"></div>
            </div>
            
            <div class="pims-modal-footer">
                <button class="pims-btn pims-btn-secondary pims-modal-close-btn">Close</button>
                <button class="pims-btn pims-btn-primary" onclick="pimsPrintReleaseDocument()">
                    <i class="fas fa-print"></i> Print Release
                </button>
            </div>
        </div>
    </div>

    <script>
        // View prisoner details
        function pimsViewPrisonerDetails(prisonerId) {
            const modal = document.getElementById('pims-prisoner-modal');
            const content = document.getElementById('pims-prisoner-details-content');
            
            // Show loading state
            content.innerHTML = '<div class="pims-spinner"></div>';
            
            // Open modal
            modal.classList.add('active');
            
            // Simulate AJAX call (replace with actual API call)
            setTimeout(() => {
                // Mock data - replace with actual data from your backend
                const mockData = {
                    id: prisonerId,
                    firstName: "John",
                    lastName: "Doe",
                    age: 42,
                    crime: "Burglary",
                    sentence: "5 years",
                    releaseDate: "2023-06-15",
                    releaseReason: "Sentence Completed",
                    notes: "Prisoner has completed rehabilitation program successfully.",
                    image: "default-profile.png"
                };
                
                // Update modal content
                content.innerHTML = `
                    <div class="pims-details-grid">
                        <div style="text-align: center;">
                            <div class="pims-inmate-image">
                                <i class="fas fa-user fa-3x" style="color: var(--pims-secondary);"></i>
                            </div>
                            <h4 style="margin-top: 1rem;">${mockData.firstName} ${mockData.lastName}</h4>
                            <p style="color: var(--pims-secondary);">Prisoner ID: ${mockData.id}</p>
                        </div>
                        
                        <div>
                            <div class="pims-detail-item">
                                <strong>Age</strong>
                                <span>${mockData.age}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Crime</strong>
                                <span>${mockData.crime}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Original Sentence</strong>
                                <span>${mockData.sentence}</span>
                            </div>
                        </div>
                        
                        <div>
                            <div class="pims-detail-item">
                                <strong>Release Date</strong>
                                <span>${new Date(mockData.releaseDate).toLocaleDateString()}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Release Reason</strong>
                                <span class="text-capitalize">${mockData.releaseReason.replace('_', ' ')}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Notes</strong>
                                <span>${mockData.notes}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pims-alert pims-alert-success" style="margin-top: 1.5rem;">
                        <i class="fas fa-check-circle"></i>
                        This prisoner has been successfully released from custody.
                    </div>
                `;
            }, 800);
        }
        
        // Print release document
        function pimsPrintReleaseDocument() {
            console.log("Printing release document...");
            // In a real app, this would open a print dialog with a formatted document
            window.print();
        }
        
        // Initialize modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            // View buttons
            document.querySelectorAll('.pims-view-prisoner').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');
                    pimsViewPrisonerDetails(prisonerId);
                });
            });
            
            // Close modal buttons
            document.querySelectorAll('.pims-modal-close, .pims-modal-close-btn').forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('pims-prisoner-modal').classList.remove('active');
                });
            });
            
            // Close when clicking outside modal
            document.getElementById('pims-prisoner-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });
        });
    </script>
    
    @include('includes.footer_js')
</body>
</html>