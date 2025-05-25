<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Request Evaluation</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
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

        /* Request Card Styles */
        .pims-request-card {
            transition: var(--pims-transition);
            margin-bottom: 1.5rem;
        }

        .pims-request-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .pims-request-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-field-label {
            font-weight: 600;
            color: var(--pims-primary);
            margin-right: 0.5rem;
        }

        .pims-field-value {
            color: var(--pims-text-dark);
        }

        .pims-detail-item {
            margin-bottom: 0.75rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .pims-evaluation-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
            min-height: 100px;
            resize: vertical;
        }

        .pims-evaluation-textarea:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
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

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover {
            background-color: #219653;
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

        .pims-btn-outline-primary {
            background-color: transparent;
            border: 1px solid var(--pims-accent);
            color: var(--pims-accent);
        }

        .pims-btn-outline-primary:hover {
            background-color: var(--pims-accent);
            color: white;
        }

        /* Status Badges */
        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pims-status-approved {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
        }

        .pims-status-rejected {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
        }

        .pims-status-pending {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }

        /* Modal Styles */
        .pims-modal-header {
            background-color: var(--pims-primary);
            color: white;
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
        }

        .pims-modal-title {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-prisoner-image {
            border-radius: 50%;
            border: 3px solid var(--pims-accent);
            object-fit: cover;
            width: 150px;
            height: 150px;
            margin-bottom: 1rem;
        }

        .pims-prisoner-detail-label {
            font-weight: 600;
            color: var(--pims-primary);
            min-width: 120px;
        }

        /* Toast Styles */
        .pims-toast-container {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 1100;
        }

        .pims-toast {
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            border: none;
        }

        .pims-toast-header {
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
            font-weight: 600;
        }

        .pims-toast-success .pims-toast-header {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-toast-error .pims-toast-header {
            background-color: var(--pims-danger);
            color: white;
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

            .pims-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pims-detail-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .pims-prisoner-detail-label {
                min-width: auto;
            }
        }
    </style>
</head>


<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('discipline_officer.menu')

        <div class="pims-content-area">
            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-clipboard-list"></i> Pending Requests
                    </h2>
                </div>
                <div class="pims-card-body">
                    @if($requests->isNotEmpty())
                        @foreach($requests as $request)
                            <div class="pims-card pims-request-card" data-pims-request-id="{{ $request->id }}">
                                <div class="pims-card-body">
                                    <h5 class="pims-request-title">
                                        <i class="fas fa-file-alt"></i> Request Information
                                    </h5>
                                    
                                    <div class="pims-detail-item">
                                        <span class="pims-field-label">Request Type:</span>
                                        <span class="pims-field-value">{{ $request->request_type }}</span>
                                    </div>
                                    
                                    <div class="pims-detail-item">
                                        <span class="pims-field-label">Prisoner ID:</span>
                                        <span class="pims-field-value">{{ $request->prisoner_id }}</span>
                                        <button class="pims-btn pims-btn-outline-primary pims-btn-sm pims-view-prisoner-details ms-2" 
                                                data-pims-id="{{ $request->prisoner_id }}">
                                            <i class="fas fa-eye"></i> View Details
                                        </button>
                                    </div>
                                    
                                    <div class="pims-detail-item" style="flex-direction: column; align-items: flex-start;">
                                        <span class="pims-field-label">Request Details:</span>
                                        <div class="pims-field-value p-3 bg-light rounded" style="width: 100%;">
                                            {{ $request->request_details }}
                                        </div>
                                    </div>
                                    
                                    <div class="pims-detail-item" style="flex-direction: column; align-items: flex-start;">
                                        <label class="pims-field-label">Evaluation:</label>
                                        <textarea class="pims-evaluation-textarea" 
                                                  placeholder="Enter your evaluation comments here..." 
                                                  required></textarea>
                                    </div>
                                    
                                    <input type="hidden" class="pims-request-id" value="{{ $request->id }}">
                                    
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button class="pims-btn pims-btn-success pims-btn-action pims-btn-approve" disabled>
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <button class="pims-btn pims-btn-danger pims-btn-action pims-btn-reject" disabled>
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                        <button class="pims-btn pims-btn-primary pims-btn-action pims-btn-transfer" disabled>
                                            <i class="fas fa-exchange-alt"></i> Transfer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="pims-card">
                            <div class="pims-card-body text-center py-4">
                                <i class="fas fa-info-circle fa-2x mb-3" style="color: var(--pims-accent);"></i>
                                <h5 class="pims-card-title">No Pending Requests</h5>
                                <p class="text-muted">There are currently no pending requests to evaluate.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Prisoner Details Modal -->
    <div class="modal fade" id="pims-prisoner-detail-modal" tabindex="-1" aria-labelledby="pims-prisoner-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pims-modal-header">
                    <h5 class="modal-title pims-modal-title" id="pims-prisoner-modal-label">
                        <i class="fas fa-user-tag"></i> Prisoner Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="pims-prisoner-image" src="" alt="Prisoner Image" class="pims-prisoner-image">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">ID:</span>
                                <span id="pims-prisoner-id">-</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Full Name:</span>
                                <span id="pims-prisoner-name">-</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Date of Birth:</span>
                                <span id="pims-prisoner-dob">-</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Gender:</span>
                                <span id="pims-prisoner-gender">-</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Marital Status:</span>
                                <span id="pims-prisoner-marital">-</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Crime Committed:</span>
                                <span id="pims-prisoner-crime">-</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Status:</span>
                                <span id="pims-prisoner-status">-</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Sentence Period:</span>
                                <span id="pims-prisoner-sentence">- to -</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Emergency Contact:</span>
                                <span id="pims-prisoner-emergency">-</span>
                            </div>
                            <div class="pims-detail-item">
                                <span class="pims-prisoner-detail-label">Facility:</span>
                                <span id="pims-prisoner-facility">-</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="pims-btn pims-btn-secondary" data-bs-dismiss="modal">
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
            document.querySelectorAll('.pims-evaluation-textarea').forEach(textarea => {
                const card = textarea.closest('.pims-request-card');
                const approveBtn = card.querySelector('.pims-btn-approve');
                const rejectBtn = card.querySelector('.pims-btn-reject');
                const transferBtn = card.querySelector('.pims-btn-transfer');
                
                textarea.addEventListener('input', () => {
                    const evaluation = textarea.value.trim();
                    approveBtn.disabled = rejectBtn.disabled = transferBtn.disabled = evaluation === '';
                });
            });
            
            // Prisoner details modal
            document.querySelectorAll('.pims-view-prisoner-details').forEach(button => {
                button.addEventListener('click', async function() {
                    const prisonerId = this.getAttribute('data-pims-id');
                    const modalElement = document.getElementById('pims-prisoner-detail-modal');
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
                            <div class="text-center">
                                <img src="${data.inmate_image ? `/storage/${data.inmate_image}` : 'https://via.placeholder.com/300x300?text=No+Image'}" 
                                     alt="${data.first_name ? `${data.first_name} ${data.last_name}'s Image` : 'Prisoner Image'}" 
                                     class="pims-prisoner-image">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">ID:</span>
                                        <span>${data.id || '-'}</span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Full Name:</span>
                                        <span>${[data.first_name, data.middle_name, data.last_name].filter(Boolean).join(' ') || '-'}</span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Date of Birth:</span>
                                        <span>${data.dob || '-'}</span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Gender:</span>
                                        <span>${data.gender || '-'}</span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Marital Status:</span>
                                        <span>${data.marital_status || '-'}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Crime Committed:</span>
                                        <span>${data.crime_committed || '-'}</span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Status:</span>
                                        <span>${data.status || '-'}</span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Sentence Period:</span>
                                        <span>${data.time_serve_start || '-'} to ${data.time_serve_end || '-'}</span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Emergency Contact:</span>
                                        <span>${data.emergency_contact_name ? 
                                            `${data.emergency_contact_name} (${data.emergency_contact_relation}) - ${data.emergency_contact_number}` : 
                                            '-'}
                                        </span>
                                    </div>
                                    <div class="pims-detail-item">
                                        <span class="pims-prisoner-detail-label">Facility:</span>
                                        <span>${data.prison_id ? `Prison ${data.prison_id}` : '-'}${data.room_id ? `, Room ${data.room_id}` : ''}</span>
                                    </div>
                                </div>
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
            
            // Handle request approval/rejection/transfer
            document.querySelectorAll('.pims-request-card').forEach(card => {
                const approveBtn = card.querySelector('.pims-btn-approve');
                const rejectBtn = card.querySelector('.pims-btn-reject');
                const transferBtn = card.querySelector('.pims-btn-transfer');
                
                approveBtn.addEventListener('click', async () => {
                    await pimsHandleRequestAction(card, 'approve');
                });
                
                rejectBtn.addEventListener('click', async () => {
                    await pimsHandleRequestAction(card, 'reject');
                });
                
                transferBtn.addEventListener('click', async () => {
                    await pimsHandleRequestAction(card, 'transfer');
                });
            });
            
            async function pimsHandleRequestAction(card, action) {
                const requestId = card.querySelector('.pims-request-id').value;
                const textarea = card.querySelector('.pims-evaluation-textarea');
                const evaluation = textarea.value.trim();
                
                if (!evaluation) {
                    pimsShowToast('error', 'Please provide an evaluation before submitting!');
                    return;
                }
                
                const actionVerb = action === 'approve' ? 'approved' : action === 'reject' ? 'rejected' : 'transferred';
                const btnClass = action === 'approve' ? 'success' : action === 'reject' ? 'danger' : 'primary';
                
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
                        pimsShowToast('success', `Request ${actionVerb} successfully!`);
                        
                        // Update UI
                        card.style.opacity = '0.7';
                        card.querySelector('.pims-btn-approve').disabled = true;
                        card.querySelector('.pims-btn-reject').disabled = true;
                        card.querySelector('.pims-btn-transfer').disabled = true;
                        card.querySelector('.pims-evaluation-textarea').readOnly = true;
                        
                        // Change button to show status
                        const buttonsDiv = card.querySelector('.d-flex');
                        buttonsDiv.innerHTML = `
                            <span class="pims-status-badge pims-status-${action} p-2">
                                <i class="fas fa-${action === 'approve' ? 'check' : action === 'reject' ? 'times' : 'exchange-alt'} me-1"></i>
                                Request ${actionVerb}
                            </span>
                        `;
                    } else {
                        throw new Error(data.message || 'Action failed');
                    }
                } catch (error) {
                    console.error(`Error ${action}ing request:`, error);
                    pimsShowToast('error', `Failed to ${action} request: ${error.message || 'Unknown error'}`);
                }
            }
            
            function pimsShowToast(type, message) {
                const toastContainer = document.createElement('div');
                toastContainer.className = 'pims-toast-container';
                
                const toast = document.createElement('div');
                toast.className = `pims-toast pims-toast-${type}`;
                toast.innerHTML = `
                    <div class="pims-toast-header">
                        <strong class="me-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                `;
                
                toastContainer.appendChild(toast);
                document.body.appendChild(toastContainer);
                
                // Remove toast after 3 seconds
                setTimeout(() => {
                    toastContainer.remove();
                }, 3000);
            }
        });
    </script>
</body>
</html>