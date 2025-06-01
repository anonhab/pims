<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <title>PIMS - Prisoner Appointments</title>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pims9-primary: #2c3e50;
            --pims9-secondary: #2c3e50;
            --pims9-accent: #3498db;
            --pims9-light: #ecf0f1;
            --pims9-lighter: #f8f9fa;
            --pims9-danger: #e74c3c;
            --pims9-success: #2ecc71;
            --pims9-warning: #f39c12;
            --pims9-border-radius: 8px;
            --pims9-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims9-transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims9-primary);
            line-height: 1.6;
        }

        .pims9-app-container {
            padding-top: 70px;
            display: flex;
            min-height: 100vh;
        }

        .pims9-menu {
            width: 250px;
            background-color: var(--pims9-primary);
            color: white;
            padding: 20px;
            border-radius: var(--pims9-border-radius);
            margin-right: 20px;
            box-shadow: var(--pims9-box-shadow);
            transition: var(--pims9-transition);
        }

        .pims9-menu a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pims9-menu a:hover {
            background-color: var(--pims9-secondary);
        }

        .pims9-main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 250px;
            transition: var(--pims9-transition);
        }

        .pims9-content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .pims9-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .pims9-page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims9-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims9-page-title i {
            color: var(--pims9-accent);
        }

        .pims9-tabs {
            display: flex;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 20px;
        }

        .pims9-tablink {
            background-color: var(--pims9-lighter);
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 500;
            color: #6c757d;
            cursor: pointer;
            border-radius: 4px 4px 0 0;
            margin-right: 5px;
            transition: var(--pims9-transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pims9-tablink:hover {
            background-color: #e9ecef;
            color: var(--pims9-primary);
        }

        .pims9-tablink.active {
            background-color: var(--pims9-accent);
            color: #fff;
            font-weight: 600;
        }

        .pims9-report-content {
            display: none;
        }

        .pims9-report-content[style*="display: block"] {
            display: block;
        }

        .pims9-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .pims9-card {
            background: white;
            border-radius: var(--pims9-border-radius);
            box-shadow: var(--pims9-box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: transform 0.3s;
        }

        .pims9-card:hover {
            transform: translateY(-5px);
        }

        .pims9-card-header {
            background: linear-gradient(135deg, var(--pims9-primary) 0%, var(--pims9-secondary) 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims9-card-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
        }

        .pims9-card-body {
            padding: 1.5rem;
        }

        .pims9-card-field {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .pims9-card-label {
            font-weight: 600;
            color: var(--pims9-secondary);
            flex: 0 0 100px;
        }

        .pims9-card-value {
            flex: 1;
            color: var(--pims9-primary);
            text-align: right;
        }

        .pims9-card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims9-status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .pims9-status-pending {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--pims9-warning);
        }

        .pims9-status-approved {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims9-success);
        }

        .pims9-status-rejected {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims9-danger);
        }

        .pims9-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: var(--pims9-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims9-transition);
            border: none;
            font-size: 0.9rem;
            gap: 0.5rem;
        }

        .pims9-btn-small {
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
        }

        .pims9-btn-primary {
            background-color: var(--pims9-accent);
            color: white;
        }

        .pims9-btn-primary:hover {
            background-color: #2980b9;
        }

        .pims9-btn-secondary {
            background-color: var(--pims9-secondary);
            color: white;
        }

        .pims9-btn-secondary:hover {
            background-color: #2c3e50;
        }

        .pims9-btn-success {
            background-color: var(--pims9-success);
            color: white;
        }

        .pims9-btn-success:hover {
            background-color: #25a25a;
        }

        .pims9-alert {
            padding: 1rem;
            border-radius: var(--pims9-border-radius);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .pims9-alert-info {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--pims9-accent);
            border-left: 4px solid var(--pims9-accent);
        }

        .pims9-alert-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims9-success);
            border-left: 4px solid var(--pims9-success);
        }

        .pims9-alert-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims9-danger);
            border-left: 4px solid var(--pims9-danger);
        }

        .pims9-modal {
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

        .pims9-modal.active {
            display: flex;
        }

        .pims9-modal-container {
            background-color: white;
            border-radius: var(--pims9-border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.7);
            transition: all 0.3s ease;
        }

        .pims9-modal.active .pims9-modal-container {
            transform: scale(1);
            opacity: 1;
        }

        .pims9-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims9-modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pims9-primary);
        }

        .pims9-modal-close {
            background: none;
            border: none;
            font-size: 1.75rem;
            cursor: pointer;
            color: var(--pims9-secondary);
        }

        .pims9-modal-body {
            padding: 1.5rem;
        }

        .pims9-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .pims9-form-group {
            margin-bottom: 1rem;
        }

        .pims9-form-label {
            font-weight: 600;
            color: var(--pims9-secondary);
            display: block;
            margin-bottom: 0.5rem;
        }

        .pims9-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims9-border-radius);
            font-size: 0.95rem;
            color: var(--pims9-primary);
            transition: var(--pims9-transition);
        }

        .pims9-form-control:focus {
            outline: none;
            border-color: var(--pims9-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        textarea.pims9-form-control {
            resize: vertical;
            min-height: 100px;
        }

        .pims9-spinner {
            width: 3rem;
            height: 3rem;
            border: 0.25rem solid rgba(52, 152, 219, 0.2);
            border-top-color: var(--pims9-accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            to8 {
                transform: rotate(360deg);
            }
        }

        /* Bootstrap Modal Customization */
        .modal-content {
            border-radius: var(--pims9-border-radius);
            border: none;
            box-shadow: var(--pims9-box-shadow);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--pims9-primary) 0%, var(--pims9-secondary) 100%);
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
             .pims9-app-container{
                padding-left:70px;
            }
            .pims9-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .pims9-menu {
                width: 100%;
                margin-right: 0;
                margin-bottom: 20px;
            }

            .pims9-tabs {
                flex-direction: column;
                border-bottom: none;
            }

            .pims9-tablink {
                border-radius: var(--pims9-border-radius);
                margin-bottom: 5px;
            }
        }

        @media (max-width: 768px) {
             .pims9-app-container{
                padding-left:70px;
            }
            .pims9-card-grid {
                grid-template-columns: 1fr;
            }

            .pims9-card-field {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .pims9-card-label {
                flex: none;
            }

            .pims9-card-value {
                text-align: left;
            }
        }

        @media (max-width: 576px) {
             .pims9-app-container{
                padding-left:70px;
            }
            .pims9-page-title {
                font-size: 1.5rem;
            }

            .pims9-modal-container {
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')
@include('security_officer.menu')
    <div class="pims9-app-container">
        <main class="pims9-main-content">
            <div class="pims9-content-container">
                <h1 class="pims9-page-title">
                    <i class="fas fa-calendar-alt"></i> Prisoner Appointments
                </h1>

                <div class="pims9-tabs">
                    <button class="pims9-tablink active" onclick="pims9OpenReportTab(event, 'pims9MedicalAppointments')" data-tab="pims9MedicalAppointments">
                        <i class="fas fa-stethoscope"></i> Medical
                    </button>
                    <button class="pims9-tablink" onclick="pims9OpenReportTab(event, 'pims9LawyerAppointments')" data-tab="pims9LawyerAppointments">
                        <i class="fas fa-balance-scale"></i> Lawyer
                    </button>
                    <button class="pims9-tablink" onclick="pims9OpenReportTab(event, 'pims9VisitorAppointments')" data-tab="pims9VisitorAppointments">
                        <i class="fas fa-user-friends"></i> Visitor
                    </button>
                </div>

                <!-- Medical Appointments -->
                <div id="pims9MedicalAppointments" class="pims9-report-content" style="display: block;">
                    @if(count($medicalAppointments) > 0)
                    <div class="pims9-card-grid">
                        @foreach ($medicalAppointments as $appointment)
                        <div class="pims9-card">
                            <div class="pims9-card-header">
                                <i class="fas fa-stethoscope"></i>
                                <h3>Medical Appointment</h3>
                            </div>
                            <div class="pims9-card-body">
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Prisoner:</span>
                                    <span class="pims9-card-value">
                                        {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->middle_name }} {{ $appointment->prisoner->last_name }} ({{ $appointment->prisoner->id }})
                                    </span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Date:</span>
                                    <span class="pims9-card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Doctor:</span>
                                    <span class="pims9-card-value">{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Reason:</span>
                                    <span class="pims9-card-value">{{ $appointment->reason ?? 'Not specified' }}</span>
                                </div>
                            </div>
                            <div class="pims9-card-footer">
                                <span class="pims9-status-badge 
                                    {{ $appointment->status == 'Pending' ? 'pims9-status-pending' : 
                                    ($appointment->status == 'completed' ? 'pims9-status-approved' : 'pims9-status-rejected') }}">
                                    <i class="fas fa-{{ $appointment->status == 'scheduled' ? 'clock' : ($appointment->status == 'completed' ? 'check' : 'times') }}"></i>
                                    {{ $appointment->status }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="pims9-alert pims9-alert-info">
                        <i class="fas fa-info-circle"></i> No medical appointments found.
                    </div>
                    @endif
                </div>

                <!-- Lawyer Appointments -->
                <div id="pims9LawyerAppointments" class="pims9-report-content">
                    @if(count($lawyerAppointments) > 0)
                    <div class="pims9-card-grid">
                        @foreach ($lawyerAppointments as $appointment)
                        <div class="pims9-card">
                            <div class="pims9-card-header">
                                <i class="fas fa-balance-scale"></i>
                                <h3>Legal Consultation</h3>
                            </div>
                            <div class="pims9-card-body">
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Prisoner:</span>
                                    <span class="pims9-card-value">
                                        {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->middle_name }} {{ $appointment->prisoner->last_name }} ({{ $appointment->prisoner->id }})
                                    </span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Date:</span>
                                    <span class="pims9-card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Lawyer:</span>
                                    <span class="pims9-card-value">{{ $appointment->lawyer->first_name }} {{ $appointment->lawyer->last_name }}</span>
                                </div>
                            </div>
                            <div class="pims9-card-footer">
                                <span class="pims9-status-badge 
                                    {{ $appointment->status == 'Pending' ? 'pims9-status-pending' : 
                                    ($appointment->status == 'completed' ? 'pims9-status-approved' : 'pims9-status-rejected') }}">
                                    <i class="fas fa-{{ $appointment->status == 'scheduled' ? 'clock' : ($appointment->status == 'completed' ? 'check' : 'times') }}"></i>
                                    {{ $appointment->status }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="pims9-alert pims9-alert-info">
                        <i class="fas fa-info-circle"></i> No lawyer appointments found.
                    </div>
                    @endif
                </div>

                <!-- Visitor Appointments -->
                <div id="pims9VisitorAppointments" class="pims9-report-content">
                    @if(count($visitorAppointments) > 0)
                    <div class="pims9-card-grid">
                        @foreach ($visitorAppointments as $appointment)
                        <div class="pims9-card">
                            <div class="pims9-card-header">
                                <i class="fas fa-user-friends"></i>
                                <h3>Visitor Appointment</h3>
                            </div>
                            <div class="pims9-card-body">
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Prisoner:</span>
                                    <span class="pims9-card-value">
                                        {{ $appointment->prisoner_firstname }} {{ $appointment->prisoner_middlename }} {{ $appointment->prisoner_lastname }}
                                        <button class="pims9-btn pims9-btn-small pims9-btn-success pims9-ms-2" 
                                                onclick="pims9OpenPrisonerModal(
                                                    '{{ $appointment->prisoner_firstname }}',
                                                    '{{ $appointment->prisoner_middlename }}',
                                                    '{{ $appointment->prisoner_lastname }}',
                                                    '{{ $appointment->prisoner_id }}'
                                                )">
                                            <i class="fas fa-search"></i> Verify
                                        </button>
                                    </span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Visitor:</span>
                                    <span class="pims9-card-value">{{ $appointment->visitor->first_name }} {{ $appointment->visitor->last_name }}</span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Date:</span>
                                    <span class="pims9-card-value">{{ date('M d, Y', strtotime($appointment->requested_date)) }}</span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Time:</span>
                                    <span class="pims9-card-value">{{ date('h:i A', strtotime($appointment->requested_time)) }}</span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Relationship:</span>
                                    <span class="pims9-card-value">{{ $appointment->visitor->relationship ?? 'Not specified' }}</span>
                                </div>
                                <div class="pims9-card-field">
                                    <span class="pims9-card-label">Note:</span>
                                    <span class="pims9-card-value">{{ $appointment->note ?? 'No notes' }}</span>
                                </div>
                            </div>
                            <div class="pims9-card-footer">
                                <span class="pims9-status-badge 
                                    {{ $appointment->status == 'pending' ? 'pims9-status-pending' : 
                                    ($appointment->status == 'approved' ? 'pims9-status-approved' : 'pims9-status-rejected') }}">
                                    <i class="fas fa-{{ $appointment->status == 'pending' ? 'clock' : ($appointment->status == 'approved' ? 'check' : 'times') }}"></i>
                                    {{ ucfirst($appointment->status) }}
                                </span>
                                <button class="pims9-btn pims9-btn-small {{ $appointment->status == 'pending' ? 'pims9-btn-primary' : 'pims9-btn-secondary' }}"
                                        onclick="pims9OpenStatusModal('{{ $appointment->id }}', 'visitor', '{{ $appointment->status }}')">
                                    <i class="fas fa-{{ $appointment->status == 'pending' ? 'edit' : 'eye' }}"></i>
                                    {{ $appointment->status == 'pending' ? 'Update' : 'View' }}
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="pims9-alert pims9-alert-info">
                        <i class="fas fa-info-circle"></i> No visitor appointments found.
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Status Update Modal -->
    <div id="pims9StatusModal" class="pims9-modal">
        <div class="pims9-modal-container">
            <div class="pims9-modal-header">
                <h3 class="pims9-modal-title">Update Appointment Status</h3>
                <button class="pims9-modal-close" onclick="pims9CloseModal('pims9StatusModal')">×</button>
            </div>
            <form id="pims9StatusForm" method="POST" action="{{ route('updateAppointmentStatus') }}">
                @csrf
                <input type="hidden" id="pims9AppointmentId" name="appointment_id">
                <input type="hidden" id="pims9AppointmentType" name="appointment_type">
                
                <div class="pims9-form-group">
                    <label class="pims9-form-label" for="pims9Status">Status</label>
                    <select class="pims9-form-control" id="pims9Status" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                
                <div class="pims9-form-group">
                    <label class="pims9-form-label" for="pims9Notes">Notes (Optional)</label>
                    <textarea class="pims9-form-control" id="pims9Notes" name="notes" rows="4" placeholder="Add any additional notes or reasons for the status change"></textarea>
                </div>
                
                <div class="pims9-modal-footer">
                    <button type="button" class="pims9-btn pims9-btn-secondary" onclick="pims9CloseModal('pims9StatusModal')">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="pims9-btn pims9-btn-primary">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Prisoner Verification Modal -->
    <div id="pims9PrisonerModal" class="pims9-modal">
        <div class="pims9-modal-container">
            <div class="pims9-modal-header">
                <h3 class="pims9-modal-title">Verify Prisoner Details</h3>
                <button class="pims9-modal-close" onclick="pims9CloseModal('pims9PrisonerModal')">×</button>
            </div>
            <div class="pims9-modal-body">
                <div class="pims9-form-group">
                    <label class="pims9-form-label">First Name</label>
                    <input type="text" class="pims9-form-control" id="pims9VerifyFirstName" readonly>
                </div>
                <div class="pims9-form-group">
                    <label class="pims9-form-label">Middle Name</label>
                    <input type="text" class="pims9-form-control" id="pims9VerifyMiddleName" readonly>
                </div>
                <div class="pims9-form-group">
                    <label class="pims9-form-label">Last Name</label>
                    <input type="text" class="pims9-form-control" id="pims9VerifyLastName" readonly>
                </div>
                <input type="hidden" id="pims9VerifyPrisonerId">
                <div id="pims9VerificationResult" class="pims9-alert" style="display: none;"></div>
                <div class="pims9-modal-footer">
                    <button type="button" class="pims9-btn pims9-btn-secondary" onclick="pims9CloseModal('pims9PrisonerModal')">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button class="pims9-btn pims9-btn-primary" onclick="pims9VerifyPrisoner()">
                        <i class="fas fa-check-circle"></i> Verify
                    </button>
                </div>
                <!-- View Prisoner Button (initially hidden) -->
                <div id="pims9ViewPrisonerBtn" class="pims9-text-center pims9-mt-3" style="display: none;">
                    <button class="pims9-btn pims9-btn-success pims9-w-100" id="pims9ViewPrisonerLink">
                        <i class="fas fa-eye"></i> View Prisoner Details
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Inmate Details Modal -->
    <div class="modal fade" id="pims9InmateModal" tabindex="-1" aria-labelledby="pims9InmateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pims9InmateModalLabel">Inmate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="pims9InmateDetails">
                    <!-- JSON data will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Configurable base URL for API requests (adjust as needed)
    const PIMS9_BASE_URL = ''; // e.g., '/api' or 'https://yourdomain.com/api'

    document.addEventListener('DOMContentLoaded', function () {
        // Tab Management with LocalStorage Persistence
        const pims9SavedTab = localStorage.getItem('pims9ActiveAppointmentTab');
        if (pims9SavedTab && document.getElementById(pims9SavedTab)) {
            pims9OpenSavedTab(pims9SavedTab);
        } else {
            const pims9FirstTab = document.querySelector('.pims9-tablink');
            if (pims9FirstTab) pims9FirstTab.click();
        }

        document.querySelectorAll('.pims9-tablink').forEach(tab => {
            tab.addEventListener('click', function () {
                const pims9TabId = this.getAttribute('data-tab') || 
                                 this.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
                if (pims9TabId) localStorage.setItem('pims9ActiveAppointmentTab', pims9TabId);
            });
        });

        // Initialize Bootstrap modal
        const inmateModal = new bootstrap.Modal(document.getElementById('pims9InmateModal'));

        // View Prisoner Button Event Listener
        const pims9ViewPrisonerBtn = document.getElementById('pims9ViewPrisonerLink');
        if (pims9ViewPrisonerBtn) {
            pims9ViewPrisonerBtn.addEventListener('click', async function () {
                const pims9PrisonerId = document.getElementById('pims9ViewPrisonerBtn').dataset.id;
                if (!pims9PrisonerId) {
                    alert('No prisoner ID found. Please verify the prisoner again.');
                    return;
                }

                try {
                    // Show loading state
                    document.getElementById('pims9InmateDetails').innerHTML = `
                        <div class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Loading inmate details...</p>
                        </div>
                    `;
                    
                    // Construct the endpoint URL (adjust '/inmate/' if needed)
                    const pims9Endpoint = `${PIMS9_BASE_URL}/prisoners/${pims9PrisonerId}`;
                    const pims9Res = await fetch(pims9Endpoint);
                    
                    if (!pims9Res.ok) {
                        if (pims9Res.status === 404) {
                            throw new Error(`Inmate with ID ${pims9PrisonerId} not found`);
                        }
                        throw new Error(`HTTP error! Status: ${pims9Res.status}`);
                    }
                    
                    const pims9Data = await pims9Res.json();

                    // Validate required fields
                    if (!pims9Data.first_name || !pims9Data.last_name) {
                        throw new Error('Incomplete inmate data received');
                    }

                    const pims9Details = `
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="/storage/${pims9Data.inmate_image || 'default.jpg'}" alt="Inmate Image" class="img-thumbnail mb-3" width="150">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Name:</strong> ${pims9Data.first_name} ${pims9Data.middle_name || ''} ${pims9Data.last_name}</p>
                                <p><strong>ID:</strong> ${pims9Data.id || 'N/A'}</p>
                                <p><strong>DOB:</strong> ${pims9Data.dob || 'N/A'}</p>
                                <p><strong>Gender:</strong> ${pims9Data.gender || 'N/A'}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Address:</strong> ${(pims9Data.address || 'N/A').replace(/\r\n/g, '<br>')}</p>
                                <p><strong>Marital Status:</strong> ${pims9Data.marital_status || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Crime:</strong> ${pims9Data.crime_committed || 'N/A'}</p>
                                <p><strong>Status:</strong> ${pims9Data.status || 'N/A'}</p>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Emergency Contact:</strong> ${pims9Data.emergency_contact_name || 'N/A'} (${pims9Data.emergency_contact_relation || 'N/A'}) - ${pims9Data.emergency_contact_number || 'N/A'}</p>
                        <p><strong>Prison Name:</strong> ${pims9Data.prison_name || 'N/A'}</p>
                    `;
                    
                    document.getElementById('pims9InmateDetails').innerHTML = pims9Details;
                    
                    // Close verification modal and show inmate modal
                    pims9CloseModal('pims9PrisonerModal');
                    inmateModal.show();
                } catch (error) {
                    console.error('Error fetching inmate data:', error);
                    document.getElementById('pims9InmateDetails').innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> Failed to load inmate data: ${error.message}
                        </div>
                    `;
                    inmateModal.show();
                }
            });
        }

        // Status Form Submission
        const statusForm = document.getElementById('pims9StatusForm');
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
                        alertDiv.className = 'pims9-alert pims9-alert-success';
                        alertDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${data.message || 'Status updated successfully!'}`;
                        document.querySelector('.pims9-content-container').prepend(alertDiv);
                        
                        // Remove the alert after 3 seconds
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 3000);
                        
                        // Close modal and refresh the page after a short delay
                        setTimeout(() => {
                            pims9CloseModal('pims9StatusModal');
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

    function pims9OpenSavedTab(pims9TabId) {
        document.querySelectorAll('.pims9-report-content').forEach(content => {
            content.style.display = 'none';
        });
        document.querySelectorAll('.pims9-tablink').forEach(tab => {
            tab.classList.remove('active');
        });
        const pims9TabContent = document.getElementById(pims9TabId);
        if (pims9TabContent) pims9TabContent.style.display = 'block';
        const pims9TabButton = document.querySelector(`.pims9-tablink[data-tab="${pims9TabId}"], .pims9-tablink[onclick*="${pims9TabId}"]`);
        if (pims9TabButton) pims9TabButton.classList.add('active');
    }

    function pims9OpenReportTab(pims9Evt, pims9ReportName) {
        document.querySelectorAll('.pims9-report-content').forEach(el => {
            el.style.display = 'none';
        });
        document.querySelectorAll('.pims9-tablink').forEach(el => {
            el.classList.remove('active');
        });
        const pims9TabContent = document.getElementById(pims9ReportName);
        if (pims9TabContent) {
            pims9TabContent.style.display = 'block';
            pims9TabContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        if (pims9Evt?.currentTarget) pims9Evt.currentTarget.classList.add('active');
        localStorage.setItem('pims9ActiveAppointmentTab', pims9ReportName);
    }

    function pims9OpenStatusModal(pims9AppointmentId, pims9AppointmentType, pims9CurrentStatus) {
        document.getElementById('pims9AppointmentId').value = pims9AppointmentId;
        document.getElementById('pims9AppointmentType').value = pims9AppointmentType;
        document.getElementById('pims9Status').value = pims9CurrentStatus.toLowerCase();
        document.getElementById('pims9Notes').value = '';
        pims9ShowModal('pims9StatusModal');
    }

    function pims9OpenPrisonerModal(pims9FirstName, pims9MiddleName, pims9LastName) {
        document.getElementById('pims9VerifyFirstName').value = pims9FirstName || '';
        document.getElementById('pims9VerifyMiddleName').value = pims9MiddleName || '';
        document.getElementById('pims9VerifyLastName').value = pims9LastName || '';
        document.getElementById('pims9VerificationResult').style.display = 'none';
        document.getElementById('pims9ViewPrisonerBtn').style.display = 'none';
        pims9ShowModal('pims9PrisonerModal');
    }

    function pims9ShowModal(pims9ModalId) {
        const pims9Modal = document.getElementById(pims9ModalId);
        if (pims9Modal) {
            pims9Modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function pims9CloseModal(pims9ModalId) {
        const pims9Modal = document.getElementById(pims9ModalId);
        if (pims9Modal) {
            pims9Modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    window.onclick = function (pims9Event) {
        if (pims9Event.target.classList.contains('pims9-modal')) {
            pims9CloseModal(pims9Event.target.id);
        }
    };

    document.addEventListener('keydown', function (pims9Event) {
        if (pims9Event.key === 'Escape') {
            const pims9OpenModal = document.querySelector('.pims9-modal.active');
            if (pims9OpenModal) pims9CloseModal(pims9OpenModal.id);
        }
    });

    async function pims9VerifyPrisoner() {
        const pims9FirstName = document.getElementById('pims9VerifyFirstName').value.trim();
        const pims9MiddleName = document.getElementById('pims9VerifyMiddleName').value.trim();
        const pims9LastName = document.getElementById('pims9VerifyLastName').value.trim();

        if (!pims9FirstName || !pims9LastName) {
            pims9ShowVerificationResult('Please provide at least first and last name', false);
            return;
        }

        const verifyBtn = document.querySelector('#pims9PrisonerModal .pims9-btn-primary');
        const originalBtnText = verifyBtn.innerHTML;
        
        try {
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';

            const pims9Response = await fetch('/verify-prisoner', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    first_name: pims9FirstName,
                    middle_name: pims9MiddleName,
                    last_name: pims9LastName
                })
            });

            const pims9Data = await pims9Response.json();

            if (pims9Data.success && pims9Data.prisoner_id) {
                pims9ShowVerificationResult(pims9Data.message || 'Prisoner verified successfully', true);
                const pims9ViewBtn = document.getElementById('pims9ViewPrisonerBtn');
                pims9ViewBtn.dataset.id = pims9Data.prisoner_id;
                pims9ViewBtn.style.display = 'block';
            } else {
                pims9ShowVerificationResult(pims9Data.message || 'Verification failed. No matching prisoner found.', false);
            }
        } catch (pims9Error) {
            console.error('Verification error:', pims9Error);
            pims9ShowVerificationResult('Error verifying prisoner: ' + pims9Error.message, false);
        } finally {
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = originalBtnText;
        }
    }

    function pims9ShowVerificationResult(pims9Message, pims9IsSuccess) {
        const pims9ResultDiv = document.getElementById('pims9VerificationResult');
        pims9ResultDiv.innerHTML = `<i class="fas ${pims9IsSuccess ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${pims9Message}`;
        pims9ResultDiv.className = `pims9-alert ${pims9IsSuccess ? 'pims9-alert-success' : 'pims9-alert-danger'}`;
        pims9ResultDiv.style.display = 'block';
        pims9ResultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
</script>
</body>
</html>