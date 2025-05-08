<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Prisoner Appointments</title>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
/* General Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
}

/* App Container */
.pims-app-container {
    display: flex;
    min-height: 100vh;
    padding: 20px;
}

/* Sidebar Menu (Assuming included from security_officer.menu) */
.pims-menu {
    width: 250px;
    background-color: #2c3e50;
    color: #fff;
    padding: 20px;
    border-radius: 8px;
    margin-right: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.pims-menu a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 10px;
    margin-bottom: 5px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.pims-menu a:hover {
    background-color: #34495e;
}

/* Report Container */
.pims-report-container {
    flex: 1;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.pims-report-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Tabs */
.pims-tabs {
    display: flex;
    border-bottom: 2px solid #e0e0e0;
    margin-bottom: 20px;
}

.pims-tablink {
    background-color: #f8f9fa;
    border: none;
    padding: 12px 20px;
    font-size: 1rem;
    font-weight: 500;
    color: #6c757d;
    cursor: pointer;
    border-radius: 4px 4px 0 0;
    margin-right: 5px;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pims-tablink:hover {
    background-color: #e9ecef;
    color: #2c3e50;
}

.pims-tablink.active {
    background-color: #007bff;
    color: #fff;
    font-weight: 600;
}

/* Report Content */
.pims-report-content {
    display: none;
}

.pims-report-content[style*="display: block"] {
    display: block;
}

/* Card Grid */
.pims-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Appointment Card */
.pims-appointment-card {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s;
}

.pims-appointment-card:hover {
    transform: translateY(-5px);
}

.card-header {
    background-color: #f8f9fa;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 1px solid #e0e0e0;
}

.card-header h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}

.card-body {
    padding: 15px;
}

.card-field {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 0.95rem;
}

.card-label {
    font-weight: 600;
    color: #6c757d;
    flex: 0 0 100px;
}

.card-value {
    flex: 1;
    color: #333;
    text-align: right;
}

.card-footer {
    padding: 15px;
    border-top: 1px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Status Badges */
.pims-status-badge {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
}

.pims-status-pending {
    background-color: #fff3cd;
    color: #856404;
}

.pims-status-approved {
    background-color: #d4edda;
    color: #155724;
}

.pims-status-rejected {
    background-color: #f8d7da;
    color: #721c24;
}

/* Buttons */
.pims-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.pims-btn-small {
    padding: 6px 12px;
    font-size: 0.85rem;
}

.pims-btn-primary {
    background-color: #007bff;
    color: #fff;
}

.pims-btn-primary:hover {
    background-color: #0056b3;
}

.pims-btn-secondary {
    background-color: #6c757d;
    color: #fff;
}

.pims-btn-secondary:hover {
    background-color: #545b62;
}

.pims-btn-success {
    background-color: #28a745;
    color: #fff;
}

.pims-btn-success:hover {
    background-color: #218838;
}

/* Alerts */
.alert {
    padding: 12px;
    border-radius: 4px;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
}

/* Modal Styles */
.pims-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1050;
    overflow: auto;
}

.pims-modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.pims-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.pims-modal-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2c3e50;
}

.pims-modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #6c757d;
    cursor: pointer;
    transition: color 0.3s;
}

.pims-modal-close:hover {
    color: #dc3545;
}

.pims-form-group {
    margin-bottom: 15px;
}

.pims-form-label {
    font-weight: 600;
    color: #2c3e50;
    display: block;
    margin-bottom: 5px;
}

.pims-form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 0.95rem;
    color: #333;
}

.pims-form-control[readonly] {
    background-color: #e9ecef;
}

.pims-form-control:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

textarea.pims-form-control {
    resize: vertical;
    min-height: 100px;
}

/* Bootstrap Modal Customization */
.modal-content {
    border-radius: 8px;
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e0e0e0;
}

.modal-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2c3e50;
}

.modal-body {
    padding: 20px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .pims-app-container {
        flex-direction: column;
    }

    .pims-menu {
        width: 100%;
        margin-right: 0;
        margin-bottom: 20px;
    }

    .pims-tabs {
        flex-direction: column;
        border-bottom: none;
    }

    .pims-tablink {
        border-radius: 4px;
        margin-bottom: 5px;
    }
}

@media (max-width: 576px) {
    .pims-report-title {
        font-size: 1.5rem;
    }

    .pims-appointment-card {
        font-size: 0.9rem;
    }

    .card-field {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .card-label {
        flex: none;
    }

    .card-value {
        text-align: left;
    }

    .pims-modal-content {
        margin: 20% auto;
        width: 95%;
    }
}
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('security_officer.menu')

        <div class="pims-report-container">
            <h1 class="pims-report-title">
                <i class="fas fa-calendar-alt"></i> Prisoner Appointments
            </h1>

            <div class="pims-tabs">
                <button class="pims-tablink active" onclick="openReportTab(event, 'medicalAppointments')" data-tab="medicalAppointments">
                    <i class="fas fa-stethoscope"></i> Medical
                </button>
                <button class="pims-tablink" onclick="openReportTab(event, 'lawyerAppointments')" data-tab="lawyerAppointments">
                    <i class="fas fa-balance-scale"></i> Lawyer
                </button>
                <button class="pims-tablink" onclick="openReportTab(event, 'visitorAppointments')" data-tab="visitorAppointments">
                    <i class="fas fa-user-friends"></i> Visitor
                </button>
            </div>

            <!-- Medical Appointments -->
            <div id="medicalAppointments" class="pims-report-content" style="display: block;">
                @if(count($medicalAppointments) > 0)
                <div class="pims-card-grid">
                    @foreach ($medicalAppointments as $appointment)
                    <div class="pims-appointment-card">
                        <div class="card-header">
                            <i class="fas fa-stethoscope"></i>
                            <h3>Medical Appointment</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-field">
                                <span class="card-label">Prisoner:</span>
                                <span class="card-value">
                                    {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->middle_name }} {{ $appointment->prisoner->last_name }} ({{ $appointment->prisoner->id }})
                                </span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Date:</span>
                                <span class="card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Doctor:</span>
                                <span class="card-value">{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Reason:</span>
                                <span class="card-value">{{ $appointment->reason ?? 'Not specified' }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="pims-status-badge 
                                {{ $appointment->status == 'Pending' ? 'pims-status-pending' : 
                                ($appointment->status == 'Approved' ? 'pims-status-approved' : 'pims-status-rejected') }}">
                                <i class="fas fa-{{ $appointment->status == 'Pending' ? 'clock' : ($appointment->status == 'Approved' ? 'check' : 'times') }}"></i>
                                {{ $appointment->status }}
                            </span>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No medical appointments found.
                </div>
                @endif
            </div>

            <!-- Lawyer Appointments -->
            <div id="lawyerAppointments" class="pims-report-content">
                @if(count($lawyerAppointments) > 0)
                <div class="pims-card-grid">
                    @foreach ($lawyerAppointments as $appointment)
                    <div class="pims-appointment-card">
                        <div class="card-header">
                            <i class="fas fa-balance-scale"></i>
                            <h3>Legal Consultation</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-field">
                                <span class="card-label">Prisoner:</span>
                                <span class="card-value">
                                    {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->middle_name }} {{ $appointment->prisoner->last_name }} ({{ $appointment->prisoner->id }})
                                </span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Date:</span>
                                <span class="card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Lawyer:</span>
                                <span class="card-value">{{ $appointment->lawyer->first_name }} {{ $appointment->lawyer->last_name }} </span>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <span class="pims-status-badge 
                                {{ $appointment->status == 'Pending' ? 'pims-status-pending' : 
                                ($appointment->status == 'Approved' ? 'pims-status-approved' : 'pims-status-rejected') }}">
                                <i class="fas fa-{{ $appointment->status == 'Pending' ? 'clock' : ($appointment->status == 'Approved' ? 'check' : 'times') }}"></i>
                                {{ $appointment->status }}
                            </span>
                           
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No lawyer appointments found.
                </div>
                @endif
            </div>

            <!-- Visitor Appointments -->
            <div id="visitorAppointments" class="pims-report-content">
                @if(count($visitorAppointments) > 0)
                <div class="pims-card-grid">
                    @foreach ($visitorAppointments as $appointment)
                    <div class="pims-appointment-card">
                        <div class="card-header">
                            <i class="fas fa-user-friends"></i>
                            <h3>Visitor Appointment</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-field">
                                <span class="card-label">Prisoner:</span>
                                <span class="card-value">
                                    {{ $appointment->prisoner_firstname }} {{ $appointment->prisoner_middlename }} {{ $appointment->prisoner_lastname }}
                                    <button class="pims-btn pims-btn-small pims-btn-success ms-2" 
                                            onclick="openPrisonerModal(
                                                '{{ $appointment->prisoner_firstname }}',
                                                '{{ $appointment->prisoner_middlename }}',
                                                '{{ $appointment->prisoner_lastname }}'
                                            )">
                                        <i class="fas fa-search"></i> Verify
                                    </button>
                                </span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Visitor:</span>
                                <span class="card-value">{{ $appointment->visitor->first_name }} {{ $appointment->visitor->last_name }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Date:</span>
                                <span class="card-value">{{ date('M d, Y', strtotime($appointment->requested_date)) }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Time:</span>
                                <span class="card-value">{{ date('h:i A', strtotime($appointment->requested_time)) }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Relationship:</span>
                                <span class="card-value">{{ $appointment->visitor->relationship ?? 'Not specified' }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Note:</span>
                                <span class="card-value">{{ $appointment->note ?? 'No notes' }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="pims-status-badge 
                                {{ $appointment->status == 'pending' ? 'pims-status-pending' : 
                                ($appointment->status == 'approved' ? 'pims-status-approved' : 'pims-status-rejected') }}">
                                <i class="fas fa-{{ $appointment->status == 'pending' ? 'clock' : ($appointment->status == 'approved' ? 'check' : 'times') }}"></i>
                                {{ ucfirst($appointment->status) }}
                            </span>
                            <button class="pims-btn pims-btn-small {{ $appointment->status == 'pending' ? 'pims-btn-primary' : 'pims-btn-secondary' }}"
                                    onclick="openStatusModal('{{ $appointment->id }}', 'visitor', '{{ $appointment->status }}')">
                                <i class="fas fa-{{ $appointment->status == 'pending' ? 'edit' : 'eye' }}"></i>
                                {{ $appointment->status == 'pending' ? 'Update' : 'View' }}
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No visitor appointments found.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="pims-modal">
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h3 class="pims-modal-title">Update Appointment Status</h3>
                <button class="pims-modal-close" onclick="closeModal('statusModal')">&times;</button>
            </div>
            <form id="statusForm" method="POST" action="{{ route('updateAppointmentStatus') }}">
                @csrf
                <input type="hidden" id="appointment_id" name="appointment_id">
                <input type="hidden" id="appointment_type" name="appointment_type">
                
                <div class="pims-form-group">
                    <label class="pims-form-label" for="status">Status</label>
                    <select class="pims-form-control" id="status" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                
                <div class="pims-form-group">
                    <label class="pims-form-label" for="notes">Notes (Optional)</label>
                    <textarea class="pims-form-control" id="notes" name="notes" rows="4" placeholder="Add any additional notes or reasons for the status change"></textarea>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="closeModal('statusModal')">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="pims-btn pims-btn-primary">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>

     <!-- Prisoner Verification Modal -->
     <div id="prisonerModal" class="pims-modal">
        <div class="pims-modal-content">
            <div class="pims-modal-header">
                <h3 class="pims-modal-title">Verify Prisoner Details</h3>
                <button class="pims-modal-close" onclick="closeModal('prisonerModal')">×</button>
            </div>
            <div class="pims-form-group">
                <label class="pims-form-label">First Name</label>
                <input type="text" class="pims-form-control" id="verifyFirstName" readonly>
            </div>
            <div class="pims-form-group">
                <label class="pims-form-label">Middle Name</label>
                <input type="text" class="pims-form-control" id="verifyMiddleName" readonly>
            </div>
            <div class="pims-form-group">
                <label class="pims-form-label">Last Name</label>
                <input type="text" class="pims-form-control" id="verifyLastName" readonly>
            </div>
            <div id="verificationResult" class="alert" style="display: none;"></div>
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="pims-btn pims-btn-secondary" onclick="closeModal('prisonerModal')">
                    <i class="fas fa-times"></i> Close
                </button>
                <button class="pims-btn pims-btn-primary" onclick="verifyPrisoner()">
                    <i class="fas fa-check-circle"></i> Verify
                </button>
            </div>
            <!-- View Prisoner Button (initially hidden) -->
            <div id="viewPrisonerBtn" class="mt-3 text-center" style="display: none;">
                <button class="pims-btn pims-btn-success w-100" id="viewPrisonerLink">
                    <i class="fas fa-eye"></i> View Prisoner Details
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap Inmate Details Modal -->
    <div class="modal fade" id="inmateModal" tabindex="-1" aria-labelledby="inmateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inmateModalLabel">Inmate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="inmateDetails">
                    <!-- JSON data will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Configurable base URL for API requests (adjust as needed)
        const BASE_URL = ''; // e.g., '/api' or 'https://yourdomain.com/api'

        document.addEventListener('DOMContentLoaded', function () {
            // Tab Management with LocalStorage Persistence
            const savedTab = localStorage.getItem('activeAppointmentTab');
            if (savedTab && document.getElementById(savedTab)) {
                openSavedTab(savedTab);
            } else {
                const firstTab = document.querySelector('.pims-tablink');
                if (firstTab) firstTab.click();
            }

            document.querySelectorAll('.pims-tablink').forEach(tab => {
                tab.addEventListener('click', function () {
                    const tabId = this.getAttribute('data-tab') || 
                                 this.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
                    if (tabId) localStorage.setItem('activeAppointmentTab', tabId);
                });
            });

            // View Prisoner Button Event Listener
            const viewPrisonerBtn = document.getElementById('viewPrisonerLink');
            if (viewPrisonerBtn) {
                viewPrisonerBtn.addEventListener('click', async function () {
                    const prisonerId = document.getElementById('viewPrisonerBtn').dataset.id;
                    console.log('View Prisoner clicked, ID:', prisonerId); // Debug
                    if (!prisonerId) {
                        alert('No prisoner ID found. Please verify the prisoner again.');
                        return;
                    }

                    try {
                        // Construct the endpoint URL (adjust '/inmate/' if needed)
                        const endpoint = `${BASE_URL}/prisoners/${prisonerId}`;
                        console.log('Fetching from:', endpoint); // Debug
                        const res = await fetch(endpoint);
                        if (!res.ok) {
                            if (res.status === 404) {
                                throw new Error(`Inmate with ID ${prisonerId} not found`);
                            }
                            throw new Error(`HTTP error! Status: ${res.status}`);
                        }
                        const data = await res.json();
                        console.log('Fetched inmate data:', data); // Debug

                        // Validate required fields
                        if (!data.first_name || !data.last_name) {
                            throw new Error('Incomplete inmate data received');
                        }

                        const details = `
                            <img src="/storage/${data.inmate_image || 'default.jpg'}" alt="Inmate Image" class="img-thumbnail mb-3" width="150">
                            <p><strong>Name:</strong> ${data.first_name} ${data.middle_name || ''} ${data.last_name}</p>
                            <p><strong>DOB:</strong> ${data.dob || 'N/A'}</p>
                            <p><strong>Gender:</strong> ${data.gender || 'N/A'}</p>
                            <p><strong>Address:</strong> ${(data.address || 'N/A').replace(/\r\n/g, '<br>')}</p>
                            <p><strong>Marital Status:</strong> ${data.marital_status || 'N/A'}</p>
                            <p><strong>Crime:</strong> ${data.crime_committed || 'N/A'}</p>
                            <p><strong>Status:</strong> ${data.status || 'N/A'}</p>
                            <p><strong>Time Served:</strong> ${data.time_serve_start || 'N/A'} - ${data.time_serve_end || 'N/A'}</p>
                            <hr>
                            <p><strong>Emergency Contact:</strong> ${data.emergency_contact_name || 'N/A'} (${data.emergency_contact_relation || 'N/A'}) - ${data.emergency_contact_number || 'N/A'}</p>
                            <p><strong>Prison Name:</strong> ${data.prison_name || 'N/A'}</p>
                            <p><strong>Created:</strong> ${data.created_at || 'N/A'}</p>
                            <p><strong>Updated:</strong> ${data.updated_at || 'N/A'}</p>
                        `;
                        document.getElementById('inmateDetails').innerHTML = details;

                        // Close verification modal and show inmate modal
                        closeModal('prisonerModal');
                        const modal = new bootstrap.Modal(document.getElementById('inmateModal'), {
                            backdrop: 'static',
                            keyboard: true
                        });
                        modal.show();
                    } catch (error) {
                        console.error('Error fetching inmate data:', error);
                        alert(`Failed to load inmate data: ${error.message}`);
                    }
                });
            } else {
                console.error('viewPrisonerLink element not found');
            }
        });

        function openSavedTab(tabId) {
            document.querySelectorAll('.pims-report-content').forEach(content => {
                content.style.display = 'none';
            });
            document.querySelectorAll('.pims-tablink').forEach(tab => {
                tab.classList.remove('active');
            });
            const tabContent = document.getElementById(tabId);
            if (tabContent) tabContent.style.display = 'block';
            const tabButton = document.querySelector(`.pims-tablink[data-tab="${tabId}"], .pims-tablink[onclick*="${tabId}"]`);
            if (tabButton) tabButton.classList.add('active');
        }

        function openReportTab(evt, reportName) {
            document.querySelectorAll('.pims-report-content').forEach(el => {
                el.style.display = 'none';
            });
            document.querySelectorAll('.pims-tablink').forEach(el => {
                el.classList.remove('active');
            });
            const tabContent = document.getElementById(reportName);
            if (tabContent) {
                tabContent.style.display = 'block';
                tabContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            if (evt?.currentTarget) evt.currentTarget.classList.add('active');
            localStorage.setItem('activeAppointmentTab', reportName);
        }

        function openStatusModal(appointmentId, appointmentType, currentStatus) {
            document.getElementById('appointment_id').value = appointmentId;
            document.getElementById('appointment_type').value = appointmentType;
            document.getElementById('status').value = currentStatus.toLowerCase();
            document.getElementById('notes').value = '';
            showModal('statusModal');
        }

        function openPrisonerModal(firstName, middleName, lastName) {
            document.getElementById('verifyFirstName').value = firstName || '';
            document.getElementById('verifyMiddleName').value = middleName || '';
            document.getElementById('verifyLastName').value = lastName || '';
            document.getElementById('verificationResult').style.display = 'none';
            document.getElementById('viewPrisonerBtn').style.display = 'none';
            showModal('prisonerModal');
        }

        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        window.onclick = function (event) {
            if (event.target.classList.contains('pims-modal')) {
                closeModal(event.target.id);
            }
        };

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                const openModal = document.querySelector('.pims-modal[style="display: block;"]');
                if (openModal) closeModal(openModal.id);
            }
        });

        async function verifyPrisoner() {
            const firstName = document.getElementById('verifyFirstName').value.trim();
            const middleName = document.getElementById('verifyMiddleName').value.trim();
            const lastName = document.getElementById('verifyLastName').value.trim();

            if (!firstName || !lastName) {
                showVerificationResult('Please provide at least first and last name', false);
                return;
            }

            try {
                const response = await fetch('/verify-prisoner', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        first_name: firstName,
                        middle_name: middleName,
                        last_name: lastName
                    })
                });

                const data = await response.json();
                console.log('Verification response:', data); // Debug

                if (data.success && data.prisoner_id) {
                    showVerificationResult(data.message || 'Prisoner verified successfully', true);
                    const viewBtn = document.getElementById('viewPrisonerBtn');
                    viewBtn.dataset.id = data.prisoner_id;
                    viewBtn.style.display = 'block';
                    console.log('View button shown with ID:', data.prisoner_id); // Debug
                } else {
                    showVerificationResult(data.message || 'Verification failed', false);
                }
            } catch (error) {
                console.error('Verification error:', error);
                showVerificationResult('Error verifying prisoner: ' + error.message, false);
            }
        }

        function showVerificationResult(message, isSuccess) {
            const resultDiv = document.getElementById('verificationResult');
            resultDiv.textContent = message;
            resultDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'}`;
            resultDiv.style.display = 'block';
            resultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        document.getElementById('statusForm')?.addEventListener('submit', async function (e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();
                if (data.success) {
                    alert('Status updated successfully!');
                    closeModal('statusModal');
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to update status');
                }
            } catch (error) {
                alert('Error updating status: ' + error.message);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
        });
    </script>
</body>
</html>