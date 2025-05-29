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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
        }

        .pims-app-container {
            padding-top: 70px;
            display: flex;
            min-height: 100vh;
        }

        .pims-menu {
            width: 250px;
            background-color: var(--pims-primary);
            color: white;
            padding: 20px;
            border-radius: var(--pims-border-radius);
            margin-right: 20px;
            box-shadow: var(--pims-box-shadow);
            transition: var(--pims-transition);
        }

        .pims-menu a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pims-menu a:hover {
            background-color: var(--pims-secondary);
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

        .pims-tabs {
            display: flex;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 20px;
        }

        .pims-tablink {
            background-color: var(--pims-lighter);
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 500;
            color: #6c757d;
            cursor: pointer;
            border-radius: 4px 4px 0 0;
            margin-right: 5px;
            transition: var(--pims-transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pims-tablink:hover {
            background-color: #e9ecef;
            color: var(--pims-primary);
        }

        .pims-tablink.active {
            background-color: var(--pims-accent);
            color: #fff;
            font-weight: 600;
        }

        .pims-report-content {
            display: none;
        }

        .pims-report-content[style*="display: block"] {
            display: block;
        }

        .pims-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: transform 0.3s;
        }

        .pims-card:hover {
            transform: translateY(-5px);
        }

        .pims-card-header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-card-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        .pims-card-field {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .pims-card-label {
            font-weight: 600;
            color: var(--pims-secondary);
            flex: 0 0 100px;
        }

        .pims-card-value {
            flex: 1;
            color: var(--pims-primary);
            text-align: right;
        }

        .pims-card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .pims-status-pending {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--pims-warning);
        }

        .pims-status-approved {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
        }

        .pims-status-rejected {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
        }

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

        .pims-btn-small {
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
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

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover {
            background-color: #25a25a;
        }

        .pims-alert {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .pims-alert-info {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--pims-accent);
            border-left: 4px solid var(--pims-accent);
        }

        .pims-alert-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-alert-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

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
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.7);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .pims-modal.active .pims-modal-container {
            transform: scale(1);
            opacity: 1;
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.75rem;
            cursor: pointer;
            color: var(--pims-secondary);
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .pims-form-group {
            margin-bottom: 1rem;
        }

        .pims-form-label {
            font-weight: 600;
            color: var(--pims-secondary);
            display: block;
            margin-bottom: 0.5rem;
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 0.95rem;
            color: var(--pims-primary);
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        textarea.pims-form-control {
            resize: vertical;
            min-height: 100px;
        }

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
            to {
                transform: rotate(360deg);
            }
        }

        /* Bootstrap Modal Customization */
        .modal-content {
            border-radius: var(--pims-border-radius);
            border: none;
            box-shadow: var(--pims-box-shadow);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close {
            filter: invert(1);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
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
                border-radius: var(--pims-border-radius);
                margin-bottom: 5px;
            }
        }

        @media (max-width: 768px) {
            .pims-card-grid {
                grid-template-columns: 1fr;
            }

            .pims-card-field {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .pims-card-label {
                flex: none;
            }

            .pims-card-value {
                text-align: left;
            }
        }

        @media (max-width: 576px) {
            .pims-page-title {
                font-size: 1.5rem;
            }

            .pims-modal-container {
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

        <main class="pims-main-content">
            <div class="pims-content-container">
                <h1 class="pims-page-title">
                    <i class="fas fa-calendar-alt"></i> Prisoner Appointments
                </h1>

                <div class="pims-tabs">
                    <button class="pims-tablink active" onclick="pimsOpenReportTab(event, 'pimsMedicalAppointments')" data-tab="pimsMedicalAppointments">
                        <i class="fas fa-stethoscope"></i> Medical
                    </button>
                    <button class="pims-tablink" onclick="pimsOpenReportTab(event, 'pimsLawyerAppointments')" data-tab="pimsLawyerAppointments">
                        <i class="fas fa-balance-scale"></i> Lawyer
                    </button>
                    <button class="pims-tablink" onclick="pimsOpenReportTab(event, 'pimsVisitorAppointments')" data-tab="pimsVisitorAppointments">
                        <i class="fas fa-user-friends"></i> Visitor
                    </button>
                </div>

                <!-- Medical Appointments -->
                <div id="pimsMedicalAppointments" class="pims-report-content" style="display: block;">
                    @if(count($medicalAppointments) > 0)
                    <div class="pims-card-grid">
                        @foreach ($medicalAppointments as $appointment)
                        <div class="pims-card">
                            <div class="pims-card-header">
                                <i class="fas fa-stethoscope"></i>
                                <h3>Medical Appointment</h3>
                            </div>
                            <div class="pims-card-body">
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Prisoner:</span>
                                    <span class="pims-card-value">
                                        {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->middle_name }} {{ $appointment->prisoner->last_name }} ({{ $appointment->prisoner->id }})
                                    </span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Date:</span>
                                    <span class="pims-card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Doctor:</span>
                                    <span class="pims-card-value">{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Reason:</span>
                                    <span class="pims-card-value">{{ $appointment->reason ?? 'Not specified' }}</span>
                                </div>
                            </div>
                            <div class="pims-card-footer">
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
                    <div class="pims-alert pims-alert-info">
                        <i class="fas fa-info-circle"></i> No medical appointments found.
                    </div>
                    @endif
                </div>

                <!-- Lawyer Appointments -->
                <div id="pimsLawyerAppointments" class="pims-report-content">
                    @if(count($lawyerAppointments) > 0)
                    <div class="pims-card-grid">
                        @foreach ($lawyerAppointments as $appointment)
                        <div class="pims-card">
                            <div class="pims-card-header">
                                <i class="fas fa-balance-scale"></i>
                                <h3>Legal Consultation</h3>
                            </div>
                            <div class="pims-card-body">
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Prisoner:</span>
                                    <span class="pims-card-value">
                                        {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->middle_name }} {{ $appointment->prisoner->last_name }} ({{ $appointment->prisoner->id }})
                                    </span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Date:</span>
                                    <span class="pims-card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Lawyer:</span>
                                    <span class="pims-card-value">{{ $appointment->lawyer->first_name }} {{ $appointment->lawyer->last_name }}</span>
                                </div>
                            </div>
                            <div class="pims-card-footer">
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
                    <div class="pims-alert pims-alert-info">
                        <i class="fas fa-info-circle"></i> No lawyer appointments found.
                    </div>
                    @endif
                </div>

                <!-- Visitor Appointments -->
                <div id="pimsVisitorAppointments" class="pims-report-content">
                    @if(count($visitorAppointments) > 0)
                    <div class="pims-card-grid">
                        @foreach ($visitorAppointments as $appointment)
                        <div class="pims-card">
                            <div class="pims-card-header">
                                <i class="fas fa-user-friends"></i>
                                <h3>Visitor Appointment</h3>
                            </div>
                            <div class="pims-card-body">
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Prisoner:</span>
                                    <span class="pims-card-value">
                                        {{ $appointment->prisoner_firstname }} {{ $appointment->prisoner_middlename }} {{ $appointment->prisoner_lastname }}
                                        <button class="pims-btn pims-btn-small pims-btn-success pims-ms-2" 
                                                onclick="pimsOpenPrisonerModal(
                                                    '{{ $appointment->prisoner_firstname }}',
                                                    '{{ $appointment->prisoner_middlename }}',
                                                    '{{ $appointment->prisoner_lastname }}',
                                                    '{{ $appointment->prisoner_id }}'
                                                )">
                                            <i class="fas fa-search"></i> Verify
                                        </button>
                                    </span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Visitor:</span>
                                    <span class="pims-card-value">{{ $appointment->visitor->first_name }} {{ $appointment->visitor->last_name }}</span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Date:</span>
                                    <span class="pims-card-value">{{ date('M d, Y', strtotime($appointment->requested_date)) }}</span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Time:</span>
                                    <span class="pims-card-value">{{ date('h:i A', strtotime($appointment->requested_time)) }}</span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Relationship:</span>
                                    <span class="pims-card-value">{{ $appointment->visitor->relationship ?? 'Not specified' }}</span>
                                </div>
                                <div class="pims-card-field">
                                    <span class="pims-card-label">Note:</span>
                                    <span class="pims-card-value">{{ $appointment->note ?? 'No notes' }}</span>
                                </div>
                            </div>
                            <div class="pims-card-footer">
                                <span class="pims-status-badge 
                                    {{ $appointment->status == 'pending' ? 'pims-status-pending' : 
                                    ($appointment->status == 'approved' ? 'pims-status-approved' : 'pims-status-rejected') }}">
                                    <i class="fas fa-{{ $appointment->status == 'pending' ? 'clock' : ($appointment->status == 'approved' ? 'check' : 'times') }}"></i>
                                    {{ ucfirst($appointment->status) }}
                                </span>
                                <button class="pims-btn pims-btn-small {{ $appointment->status == 'pending' ? 'pims-btn-primary' : 'pims-btn-secondary' }}"
                                        onclick="pimsOpenStatusModal('{{ $appointment->id }}', 'visitor', '{{ $appointment->status }}')">
                                    <i class="fas fa-{{ $appointment->status == 'pending' ? 'edit' : 'eye' }}"></i>
                                    {{ $appointment->status == 'pending' ? 'Update' : 'View' }}
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="pims-alert pims-alert-info">
                        <i class="fas fa-info-circle"></i> No visitor appointments found.
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Status Update Modal -->
    <div id="pimsStatusModal" class="pims-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3 class="pims-modal-title">Update Appointment Status</h3>
                <button class="pims-modal-close" onclick="pimsCloseModal('pimsStatusModal')">×</button>
            </div>
            <form id="pimsStatusForm" method="POST" action="{{ route('updateAppointmentStatus') }}">
                @csrf
                <input type="hidden" id="pimsAppointmentId" name="appointment_id">
                <input type="hidden" id="pimsAppointmentType" name="appointment_type">
                
                <div class="pims-form-group">
                    <label class="pims-form-label" for="pimsStatus">Status</label>
                    <select class="pims-form-control" id="pimsStatus" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                
                <div class="pims-form-group">
                    <label class="pims-form-label" for="pimsNotes">Notes (Optional)</label>
                    <textarea class="pims-form-control" id="pimsNotes" name="notes" rows="4" placeholder="Add any additional notes or reasons for the status change"></textarea>
                </div>
                
                <div class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pimsStatusModal')">
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
    <div id="pimsPrisonerModal" class="pims-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3 class="pims-modal-title">Verify Prisoner Details</h3>
                <button class="pims-modal-close" onclick="pimsCloseModal('pimsPrisonerModal')">×</button>
            </div>
            <div class="pims-modal-body">
                <div class="pims-form-group">
                    <label class="pims-form-label">First Name</label>
                    <input type="text" class="pims-form-control" id="pimsVerifyFirstName" readonly>
                </div>
                <div class="pims-form-group">
                    <label class="pims-form-label">Middle Name</label>
                    <input type="text" class="pims-form-control" id="pimsVerifyMiddleName" readonly>
                </div>
                <div class="pims-form-group">
                    <label class="pims-form-label">Last Name</label>
                    <input type="text" class="pims-form-control" id="pimsVerifyLastName" readonly>
                </div>
                <input type="hidden" id="pimsVerifyPrisonerId">
                <div id="pimsVerificationResult" class="pims-alert" style="display: none;"></div>
                <div class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pimsPrisonerModal')">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button class="pims-btn pims-btn-primary" onclick="pimsVerifyPrisoner()">
                        <i class="fas fa-check-circle"></i> Verify
                    </button>
                </div>
                <!-- View Prisoner Button (initially hidden) -->
                <div id="pimsViewPrisonerBtn" class="pims-text-center pims-mt-3" style="display: none;">
                    <button class="pims-btn pims-btn-success pims-w-100" id="pimsViewPrisonerLink">
                        <i class="fas fa-eye"></i> View Prisoner Details
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Inmate Details Modal -->
    <div class="modal fade" id="pimsInmateModal" tabindex="-1" aria-labelledby="pimsInmateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pimsInmateModalLabel">Inmate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="pimsInmateDetails">
                    <!-- JSON data will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Configurable base URL for API requests (adjust as needed)
    const PIMS_BASE_URL = ''; // e.g., '/api' or 'https://yourdomain.com/api'

    document.addEventListener('DOMContentLoaded', function () {
        // Tab Management with LocalStorage Persistence
        const pimsSavedTab = localStorage.getItem('pimsActiveAppointmentTab');
        if (pimsSavedTab && document.getElementById(pimsSavedTab)) {
            pimsOpenSavedTab(pimsSavedTab);
        } else {
            const pimsFirstTab = document.querySelector('.pims-tablink');
            if (pimsFirstTab) pimsFirstTab.click();
        }

        document.querySelectorAll('.pims-tablink').forEach(tab => {
            tab.addEventListener('click', function () {
                const pimsTabId = this.getAttribute('data-tab') || 
                                 this.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
                if (pimsTabId) localStorage.setItem('pimsActiveAppointmentTab', pimsTabId);
            });
        });

        // Initialize Bootstrap modal
        const inmateModal = new bootstrap.Modal(document.getElementById('pimsInmateModal'));

        // View Prisoner Button Event Listener
        const pimsViewPrisonerBtn = document.getElementById('pimsViewPrisonerLink');
        if (pimsViewPrisonerBtn) {
            pimsViewPrisonerBtn.addEventListener('click', async function () {
                const pimsPrisonerId = document.getElementById('pimsViewPrisonerBtn').dataset.id;
                if (!pimsPrisonerId) {
                    alert('No prisoner ID found. Please verify the prisoner again.');
                    return;
                }

                try {
                    // Show loading state
                    document.getElementById('pimsInmateDetails').innerHTML = `
                        <div class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Loading inmate details...</p>
                        </div>
                    `;
                    
                    // Construct the endpoint URL (adjust '/inmate/' if needed)
                    const pimsEndpoint = `${PIMS_BASE_URL}/prisoners/${pimsPrisonerId}`;
                    const pimsRes = await fetch(pimsEndpoint);
                    
                    if (!pimsRes.ok) {
                        if (pimsRes.status === 404) {
                            throw new Error(`Inmate with ID ${pimsPrisonerId} not found`);
                        }
                        throw new Error(`HTTP error! Status: ${pimsRes.status}`);
                    }
                    
                    const pimsData = await pimsRes.json();

                    // Validate required fields
                    if (!pimsData.first_name || !pimsData.last_name) {
                        throw new Error('Incomplete inmate data received');
                    }

                    const pimsDetails = `
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="/storage/${pimsData.inmate_image || 'default.jpg'}" alt="Inmate Image" class="img-thumbnail mb-3" width="150">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Name:</strong> ${pimsData.first_name} ${pimsData.middle_name || ''} ${pimsData.last_name}</p>
                                <p><strong>ID:</strong> ${pimsData.id || 'N/A'}</p>
                                <p><strong>DOB:</strong> ${pimsData.dob || 'N/A'}</p>
                                <p><strong>Gender:</strong> ${pimsData.gender || 'N/A'}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Address:</strong> ${(pimsData.address || 'N/A').replace(/\r\n/g, '<br>')}</p>
                                <p><strong>Marital Status:</strong> ${pimsData.marital_status || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Crime:</strong> ${pimsData.crime_committed || 'N/A'}</p>
                                <p><strong>Status:</strong> ${pimsData.status || 'N/A'}</p>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Emergency Contact:</strong> ${pimsData.emergency_contact_name || 'N/A'} (${pimsData.emergency_contact_relation || 'N/A'}) - ${pimsData.emergency_contact_number || 'N/A'}</p>
                        <p><strong>Prison Name:</strong> ${pimsData.prison_name || 'N/A'}</p>
                    `;
                    
                    document.getElementById('pimsInmateDetails').innerHTML = pimsDetails;
                    
                    // Close verification modal and show inmate modal
                    pimsCloseModal('pimsPrisonerModal');
                    inmateModal.show();
                } catch (error) {
                    console.error('Error fetching inmate data:', error);
                    document.getElementById('pimsInmateDetails').innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> Failed to load inmate data: ${error.message}
                        </div>
                    `;
                    inmateModal.show();
                }
            });
        }

        // Status Form Submission
        const statusForm = document.getElementById('pimsStatusForm');
        if (statusForm) {
            statusForm.addEventListener('submit', async function (e) {
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
                        // Show success message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'pims-alert pims-alert-success';
                        alertDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${data.message || 'Status updated successfully!'}`;
                        document.querySelector('.pims-content-container').prepend(alertDiv);
                        
                        // Remove the alert after 3 seconds
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 3000);
                        
                        // Close modal and refresh the page after a short delay
                        setTimeout(() => {
                            pimsCloseModal('pimsStatusModal');
                            window.location.reload();
                        }, 500);
                    } else {
                        alert(data.message || 'Failed to update status');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error updating status: ' + error.message);
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            });
        }
    });

    function pimsOpenSavedTab(pimsTabId) {
        document.querySelectorAll('.pims-report-content').forEach(content => {
            content.style.display = 'none';
        });
        document.querySelectorAll('.pims-tablink').forEach(tab => {
            tab.classList.remove('active');
        });
        const pimsTabContent = document.getElementById(pimsTabId);
        if (pimsTabContent) pimsTabContent.style.display = 'block';
        const pimsTabButton = document.querySelector(`.pims-tablink[data-tab="${pimsTabId}"], .pims-tablink[onclick*="${pimsTabId}"]`);
        if (pimsTabButton) pimsTabButton.classList.add('active');
    }

    function pimsOpenReportTab(pimsEvt, pimsReportName) {
        document.querySelectorAll('.pims-report-content').forEach(el => {
            el.style.display = 'none';
        });
        document.querySelectorAll('.pims-tablink').forEach(el => {
            el.classList.remove('active');
        });
        const pimsTabContent = document.getElementById(pimsReportName);
        if (pimsTabContent) {
            pimsTabContent.style.display = 'block';
            pimsTabContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        if (pimsEvt?.currentTarget) pimsEvt.currentTarget.classList.add('active');
        localStorage.setItem('pimsActiveAppointmentTab', pimsReportName);
    }

    function pimsOpenStatusModal(pimsAppointmentId, pimsAppointmentType, pimsCurrentStatus) {
        document.getElementById('pimsAppointmentId').value = pimsAppointmentId;
        document.getElementById('pimsAppointmentType').value = pimsAppointmentType;
        document.getElementById('pimsStatus').value = pimsCurrentStatus.toLowerCase();
        document.getElementById('pimsNotes').value = '';
        pimsShowModal('pimsStatusModal');
    }

    function pimsOpenPrisonerModal(pimsFirstName, pimsMiddleName, pimsLastName) {
        document.getElementById('pimsVerifyFirstName').value = pimsFirstName || '';
        document.getElementById('pimsVerifyMiddleName').value = pimsMiddleName || '';
        document.getElementById('pimsVerifyLastName').value = pimsLastName || '';
        document.getElementById('pimsVerificationResult').style.display = 'none';
        document.getElementById('pimsViewPrisonerBtn').style.display = 'none';
        pimsShowModal('pimsPrisonerModal');
    }

    function pimsShowModal(pimsModalId) {
        const pimsModal = document.getElementById(pimsModalId);
        if (pimsModal) {
            pimsModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function pimsCloseModal(pimsModalId) {
        const pimsModal = document.getElementById(pimsModalId);
        if (pimsModal) {
            pimsModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    window.onclick = function (pimsEvent) {
        if (pimsEvent.target.classList.contains('pims-modal')) {
            pimsCloseModal(pimsEvent.target.id);
        }
    };

    document.addEventListener('keydown', function (pimsEvent) {
        if (pimsEvent.key === 'Escape') {
            const pimsOpenModal = document.querySelector('.pims-modal.active');
            if (pimsOpenModal) pimsCloseModal(pimsOpenModal.id);
        }
    });

    async function pimsVerifyPrisoner() {
        const pimsFirstName = document.getElementById('pimsVerifyFirstName').value.trim();
        const pimsMiddleName = document.getElementById('pimsVerifyMiddleName').value.trim();
        const pimsLastName = document.getElementById('pimsVerifyLastName').value.trim();

        if (!pimsFirstName || !pimsLastName) {
            pimsShowVerificationResult('Please provide at least first and last name', false);
            return;
        }

        const verifyBtn = document.querySelector('#pimsPrisonerModal .pims-btn-primary');
        const originalBtnText = verifyBtn.innerHTML;
        
        try {
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';

            const pimsResponse = await fetch('/verify-prisoner', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    first_name: pimsFirstName,
                    middle_name: pimsMiddleName,
                    last_name: pimsLastName
                })
            });

            const pimsData = await pimsResponse.json();

            if (pimsData.success && pimsData.prisoner_id) {
                pimsShowVerificationResult(pimsData.message || 'Prisoner verified successfully', true);
                const pimsViewBtn = document.getElementById('pimsViewPrisonerBtn');
                pimsViewBtn.dataset.id = pimsData.prisoner_id;
                pimsViewBtn.style.display = 'block';
            } else {
                pimsShowVerificationResult(pimsData.message || 'Verification failed. No matching prisoner found.', false);
            }
        } catch (pimsError) {
            console.error('Verification error:', pimsError);
            pimsShowVerificationResult('Error verifying prisoner: ' + pimsError.message, false);
        } finally {
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = originalBtnText;
        }
    }

    function pimsShowVerificationResult(pimsMessage, pimsIsSuccess) {
        const pimsResultDiv = document.getElementById('pimsVerificationResult');
        pimsResultDiv.innerHTML = `<i class="fas ${pimsIsSuccess ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${pimsMessage}`;
        pimsResultDiv.className = `pims-alert ${pimsIsSuccess ? 'pims-alert-success' : 'pims-alert-danger'}`;
        pimsResultDiv.style.display = 'block';
        pimsResultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
</script>
</body>
</html>