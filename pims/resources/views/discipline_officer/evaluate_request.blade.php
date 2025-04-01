<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Management System - Request Evaluation</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #1a2a3a;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --sidebar-width: 250px;
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
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        /* Main Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar/Navigation */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            color: white;
            position: fixed;
            height: 100vh;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            background-color: var(--secondary-color);
            text-align: center;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .nav-item {
            margin-bottom: 5px;
        }
        
        .nav-link {
            color: var(--light-color);
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: var(--accent-color);
            color: white;
        }
        
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 20px;
            background-color: #f5f6fa;
        }
        
        /* Top Navigation */
        .top-nav {
            background-color: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        /* Content Styling */
        .content-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .page-title {
            color: var(--dark-color);
            margin-bottom: 25px;
            font-weight: 600;
            border-bottom: 2px solid var(--light-color);
            padding-bottom: 10px;
        }
        
        /* Request Cards */
        .request-card {
            border-left: 4px solid var(--accent-color);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }
        
        .request-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .request-title {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .field-label {
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .field-value {
            background-color: var(--light-color);
            padding: 8px 12px;
            border-radius: 5px;
        }
        
        .evaluation-textarea {
            min-height: 120px;
            border: 2px solid #ddd;
            transition: border-color 0.3s;
        }
        
        .evaluation-textarea:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        /* Buttons */
        .btn-action {
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-approve {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-reject {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Modal Styling */
        .prisoner-detail-item {
            margin-bottom: 12px;
        }
        
        .prisoner-detail-label {
            font-weight: 600;
            color: var(--secondary-color);
            display: inline-block;
            width: 160px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h4>Prison Management</h4>
                <p class="mb-0">Discipline Officer</p>
            </div>
            
            <ul class="nav flex-column sidebar-menu">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-tasks"></i> Request Evaluation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-shield"></i> Prisoner Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-clipboard-list"></i> Incident Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-calendar-alt"></i> Schedule
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-file-alt"></i> Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="#">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        @include('includes.nav')

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Top Navigation -->
            <div class="top-nav">
               
            </div>
            
            <!-- Page Content -->
            <div class="content-card">
                <h2 class="page-title">Pending Requests</h2>
                
                @if($requests->isNotEmpty())
                    @foreach($requests as $request)
                        <div class="card request-card mb-4" data-request-id="{{ $request->id }}">
                            <div class="card-body">
                                <h5 class="card-title request-title">Request Information</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p class="prisoner-detail-item">
                                            <span class="field-label">Request Type:</span>
                                            <span class="field-value">{{ $request->request_type }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="prisoner-detail-item">
                                            <span class="field-label">Prisoner ID:</span>
                                            <span class="field-value">{{ $request->prisoner_id }}</span>
                                            <button class="btn btn-sm btn-outline-primary view-prisoner-details ms-2" 
                                                    data-id="{{ $request->prisoner_id }}">
                                                <i class="fas fa-eye"></i> View Details
                                            </button>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="field-label">Request Details:</p>
                                    <div class="field-value p-3">{{ $request->request_details }}</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="field-label">Evaluation:</label>
                                    <textarea class="form-control evaluation-textarea" 
                                              placeholder="Enter your evaluation comments here..." 
                                              required></textarea>
                                </div>
                                
                                <input type="hidden" class="request-id" value="{{ $request->id }}">
                                
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-success btn-action btn-approve" disabled>
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button class="btn btn-danger btn-action btn-reject" disabled>
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No pending requests at the moment.
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Prisoner Details Modal -->
    <div class="modal fade" id="prisonerDetailModal" tabindex="-1" aria-labelledby="prisonerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="prisonerModalLabel">
                        <i class="fas fa-user-tag"></i> Prisoner Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">ID:</span>
                                <span id="prisoner-id">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Full Name:</span>
                                <span id="prisoner-name">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Date of Birth:</span>
                                <span id="prisoner-dob">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Gender:</span>
                                <span id="prisoner-gender">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Marital Status:</span>
                                <span id="prisoner-marital">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Crime Committed:</span>
                                <span id="prisoner-crime">-</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Status:</span>
                                <span id="prisoner-status">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Time Serve Start:</span>
                                <span id="prisoner-start">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Time Serve End:</span>
                                <span id="prisoner-end">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Address:</span>
                                <span id="prisoner-address">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Emergency Contact:</span>
                                <span id="prisoner-emergency">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Room ID:</span>
                                <span id="prisoner-room">-</span>
                            </p>
                            <p class="prisoner-detail-item">
                                <span class="prisoner-detail-label">Prison ID:</span>
                                <span id="prisoner-prison">-</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <img id="prisoner-image" src="" alt="Prisoner Image" 
                             class="img-thumbnail" style="max-height: 250px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Enable/Disable evaluation buttons based on textarea input
            document.querySelectorAll('.evaluation-textarea').forEach(textarea => {
                const card = textarea.closest('.request-card');
                const approveBtn = card.querySelector('.btn-approve');
                const rejectBtn = card.querySelector('.btn-reject');
                
                textarea.addEventListener('input', () => {
                    const evaluation = textarea.value.trim();
                    approveBtn.disabled = rejectBtn.disabled = evaluation === '';
                });
            });
            
            // Prisoner details modal
            document.querySelectorAll('.view-prisoner-details').forEach(button => {
                button.addEventListener('click', async function() {
                    const prisonerId = this.getAttribute('data-id');
                    const modalElement = document.getElementById('prisonerDetailModal');
                    const modal = new bootstrap.Modal(modalElement);
                    
                    // Show loading state
                    const modalBody = modalElement.querySelector('.modal-body');
                    modalBody.innerHTML = `
                        <div class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3">Loading prisoner details...</p>
                        </div>
                    `;
                    
                    modal.show();
                    
                    try {
                        // Fetch prisoner details
                        const response = await fetch(`/prisoners/${prisonerId}`);
                        
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        
                        const data = await response.json();
                        
                        // Update modal with prisoner data
                        modalBody.innerHTML = `
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">ID:</span>
                                        <span>${data.id || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Full Name:</span>
                                        <span>${[data.first_name, data.middle_name, data.last_name].filter(Boolean).join(' ') || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Date of Birth:</span>
                                        <span>${data.dob || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Gender:</span>
                                        <span>${data.gender || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Marital Status:</span>
                                        <span>${data.marital_status || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Crime Committed:</span>
                                        <span>${data.crime_committed || '-'}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Status:</span>
                                        <span>${data.status || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Time Serve Start:</span>
                                        <span>${data.time_serve_start || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Time Serve End:</span>
                                        <span>${data.time_serve_end || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Address:</span>
                                        <span>${data.address || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Emergency Contact:</span>
                                        <span>${data.emergency_contact_name ? 
                                            `${data.emergency_contact_name} (${data.emergency_contact_relation}) - ${data.emergency_contact_number}` : 
                                            '-'}
                                        </span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Room ID:</span>
                                        <span>${data.room_id || '-'}</span>
                                    </p>
                                    <p class="prisoner-detail-item">
                                        <span class="prisoner-detail-label">Prison ID:</span>
                                        <span>${data.prison_id || '-'}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <img src="${data.inmate_image ? `/storage/${data.inmate_image}` : 'https://via.placeholder.com/300x300?text=No+Image'}" 
                                     alt="${data.first_name ? `${data.first_name} ${data.last_name}'s Image` : 'Prisoner Image'}" 
                                     class="img-thumbnail" style="max-height: 250px;">
                            </div>
                        `;
                    } catch (error) {
                        console.error('Error fetching prisoner details:', error);
                        modalBody.innerHTML = `
                            <div class="alert alert-danger">
                                <h5 class="alert-heading">Error Loading Details</h5>
                                <p>${error.message || 'Failed to load prisoner details'}</p>
                                <hr>
                                <p class="mb-0">Please try again later or contact support.</p>
                            </div>
                        `;
                    }
                });
            });
            
            // Handle request approval/rejection
            document.querySelectorAll('.request-card').forEach(card => {
                const approveBtn = card.querySelector('.btn-approve');
                const rejectBtn = card.querySelector('.btn-reject');
                const textarea = card.querySelector('.evaluation-textarea');
                
                approveBtn.addEventListener('click', async () => {
                    await handleRequestAction(card, 'approve');
                });
                
                rejectBtn.addEventListener('click', async () => {
                    await handleRequestAction(card, 'reject');
                });
            });
            
            async function handleRequestAction(card, action) {
                const requestId = card.querySelector('.request-id').value;
                const textarea = card.querySelector('.evaluation-textarea');
                const evaluation = textarea.value.trim();
                
                if (!evaluation) {
                    alert('Please provide an evaluation before submitting!');
                    return;
                }
                
                const actionVerb = action === 'approve' ? 'approved' : 'rejected';
                const emoji = action === 'approve' ? '✅' : '❌';
                const btnClass = action === 'approve' ? 'success' : 'danger';
                
                try {
                    const response = await fetch(`/${action}-request/${requestId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ evaluation: evaluation })
                    });
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Show success message
                        const toast = document.createElement('div');
                        toast.className = `position-fixed bottom-0 end-0 p-3`;
                        toast.innerHTML = `
                            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header bg-${btnClass} text-white">
                                    <strong class="me-auto">Success</strong>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    ${emoji} Request ${actionVerb} successfully!
                                </div>
                            </div>
                        `;
                        document.body.appendChild(toast);
                        
                        // Remove toast after 3 seconds
                        setTimeout(() => {
                            toast.remove();
                        }, 3000);
                        
                        // Update UI
                        card.style.opacity = '0.7';
                        card.querySelector('.btn-approve').disabled = true;
                        card.querySelector('.btn-reject').disabled = true;
                        card.querySelector('.evaluation-textarea').readOnly = true;
                        
                        // Change button to show status
                        const buttonsDiv = card.querySelector('.d-flex');
                        buttonsDiv.innerHTML = `
                            <span class="badge bg-${btnClass} p-2">
                                <i class="fas fa-${action === 'approve' ? 'check' : 'times'} me-1"></i>
                                Request ${actionVerb}
                            </span>
                        `;
                    } else {
                        throw new Error(data.message || 'Action failed');
                    }
                } catch (error) {
                    console.error(`Error ${action}ing request:`, error);
                    
                    // Show error message
                    const toast = document.createElement('div');
                    toast.className = `position-fixed bottom-0 end-0 p-3`;
                    toast.innerHTML = `
                        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-danger text-white">
                                <strong class="me-auto">Error</strong>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Failed to ${action} request: ${error.message || 'Unknown error'}
                            </div>
                        </div>
                    `;
                    document.body.appendChild(toast);
                    
                    // Remove toast after 5 seconds
                    setTimeout(() => {
                        toast.remove();
                    }, 5000);
                }
            }
        });
    </script>
</body>
</html>