<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Prisoner Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* Page Header */
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

        /* Tabs */
        .pims-tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 2rem;
        }

        .pims-tablink {
            padding: 0.75rem 1.5rem;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            color: var(--pims-secondary);
            border-bottom: 3px solid transparent;
            transition: var(--pims-transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-tablink:hover {
            color: var(--pims-primary);
        }

        .pims-tablink.active {
            color: var(--pims-accent);
            border-bottom-color: var(--pims-accent);
        }

        /* Cards Grid */
        .pims-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .pims-appointment-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            transition: var(--pims-transition);
        }

        .pims-appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .pims-card-header {
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-card-header i {
            font-size: 1.25rem;
        }

        .pims-card-header h3 {
            font-size: 1.1rem;
            font-weight: 500;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        .pims-card-field {
            display: flex;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .pims-card-field:last-child {
            margin-bottom: 0;
        }

        .pims-card-label {
            font-weight: 500;
            min-width: 100px;
            color: var(--pims-primary);
        }

        .pims-card-value {
            color: var(--pims-secondary);
            flex-grow: 1;
        }

        .pims-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
        }

        /* Status Badges */
        .pims-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            gap: 0.5rem;
        }

        .pims-status-pending {
            background-color: rgba(243, 156, 18, 0.1);
            color: var(--pims-warning);
        }

        .pims-status-approved {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--pims-success);
        }

        .pims-status-rejected {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--pims-danger);
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
            font-size: 0.875rem;
            gap: 0.5rem;
        }

        .pims-btn i {
            font-size: 0.8em;
        }

        .pims-btn-small {
            padding: 0.35rem 0.75rem;
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
            background-color: var(--pims-light);
            color: var(--pims-secondary);
        }

        .pims-btn-secondary:hover {
            background-color: #dfe6e9;
        }

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover {
            background-color: #27ae60;
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #c0392b;
        }

        /* Alert Styles */
        .pims-alert {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-alert-info {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--pims-accent);
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
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-header i {
            color: var(--pims-accent);
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

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .pims-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .pims-cards-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .pims-tabs {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 0.5rem;
            }

            .pims-form-grid {
                grid-template-columns: 1fr;
            }

            .pims-modal-container {
                width: 95%;
            }
        }

        @media (max-width: 480px) {
            .pims-card-footer {
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start;
            }

            .pims-modal-footer {
                flex-direction: column;
            }

            .pims-modal-footer .pims-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="pims-app-container">
        <!-- Navigation -->
        @include('includes.nav')

        <!-- Sidebar -->
        @include('security_officer.menu')<main class="pims-main-content">
            <div class="pims-content-container">

                <!-- Page Header -->
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-calendar-alt"></i> Prisoner Appointments
                    </h2>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                <div class="pims-alert pims-alert-info">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
                @endif

                <div class="pims-report-container">
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
                                            {{ $appointment->prisoner->firstname }} {{ $appointment->prisoner->middlename }} {{ $appointment->prisoner->lastname }} ({{ $appointment->prisoner->id }})
                                        </span>
                                    </div>
                                    <div class="card-field">
                                        <span class="card-label">Date:</span>
                                        <span class="card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                                    </div>
                                    <div class="card-field">
                                        <span class="card-label">Doctor:</span>
                                        <span class="card-value">{{ $appointment->doctor->name }}</span>
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

                </div>
            </div>
        </main>

    </div>
    @endif

    <!-- Tabs -->
    <div class="pims-tabs">
        <button class="pims-tablink active" onclick="pimsOpenTab(event, 'pims-medical-appointments')" data-tab="pims-medical-appointments">
            <i class="fas fa-stethoscope"></i> Medical
        </button>
        <button class="pims-tablink" onclick="pimsOpenTab(event, 'pims-lawyer-appointments')" data-tab="pims-lawyer-appointments">
            <i class="fas fa-balance-scale"></i> Lawyer
        </button>
        <button class="pims-tablink" onclick="pimsOpenTab(event, 'pims-visitor-appointments')" data-tab="pims-visitor-appointments">
            <i class="fas fa-user-friends"></i> Visitor
        </button>
    </div>

    <!-- Medical Appointments -->
    <div id="pims-medical-appointments" class="pims-tab-content" style="display: block;">
        @if(count($medicalAppointments) > 0)
        <div class="pims-cards-grid">
            @foreach ($medicalAppointments as $appointment)
            <div class="pims-appointment-card">
                <div class="pims-card-header">
                    <i class="fas fa-stethoscope"></i>
                    <h3>Medical Appointment</h3>
                </div>
                <div class="pims-card-body">
                    <div class="pims-card-field">
                        <span class="pims-card-label">Prisoner:</span>
                        <span class="pims-card-value">
                            {{ $appointment->prisoner->firstname }} {{ $appointment->prisoner->middlename }} {{ $appointment->prisoner->lastname }} ({{ $appointment->prisoner->id }})
                        </span>
                    </div>
                    <div class="pims-card-field">
                        <span class="pims-card-label">Date:</span>
                        <span class="pims-card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                    </div>
                    <div class="pims-card-field">
                        <span class="pims-card-label">Doctor:</span>
                        <span class="pims-card-value">{{ $appointment->doctor->name }}</span>
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
                    <button class="pims-btn pims-btn-small {{ $appointment->status == 'Pending' ? 'pims-btn-primary' : 'pims-btn-secondary' }}"
                        onclick="pimsOpenStatusModal('{{ $appointment->id }}', 'medical', '{{ $appointment->status }}')">
                        <i class="fas fa-{{ $appointment->status == 'Pending' ? 'edit' : 'eye' }}"></i>
                        {{ $appointment->status == 'Pending' ? 'Update' : 'View' }}
                    </button>
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
    <div id="pims-lawyer-appointments" class="pims-tab-content">
        @if(count($lawyerAppointments) > 0)
        <div class="pims-cards-grid">
            @foreach ($lawyerAppointments as $appointment)
            <div class="pims-appointment-card">
                <div class="pims-card-header">
                    <i class="fas fa-balance-scale"></i>
                    <h3>Legal Consultation</h3>
                </div>
                <div class="pims-card-body">
                    <div class="pims-card-field">
                        <span class="pims-card-label">Prisoner:</span>
                        <span class="pims-card-value">
                            {{ $appointment->prisoner->firstname }} {{ $appointment->prisoner->middlename }} {{ $appointment->prisoner->lastname }} ({{ $appointment->prisoner->id }})
                        </span>
                    </div>
                    <div class="pims-card-field">
                        <span class="pims-card-label">Date:</span>
                        <span class="pims-card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                    </div>
                    <div class="pims-card-field">
                        <span class="pims-card-label">Lawyer:</span>
                        <span class="pims-card-value">{{ $appointment->lawyer->name }}</span>
                    </div>
                    <div class="pims-card-field">
                        <span class="pims-card-label">Case Type:</span>
                        <span class="pims-card-value">{{ $appointment->case_type ?? 'Not specified' }}</span>
                    </div>
                </div>
                <div class="pims-card-footer">
                    <span class="pims-status-badge 
                    {{ $appointment->status == 'Pending' ? 'pims-status-pending' : 
                    ($appointment->status == 'Approved' ? 'pims-status-approved' : 'pims-status-rejected') }}">
                        <i class="fas fa-{{ $appointment->status == 'Pending' ? 'clock' : ($appointment->status == 'Approved' ? 'check' : 'times') }}"></i>
                        {{ $appointment->status }}
                    </span>
                    <button class="pims-btn pims-btn-small {{ $appointment->status == 'Pending' ? 'pims-btn-primary' : 'pims-btn-secondary' }}"
                        onclick="pimsOpenStatusModal('{{ $appointment->id }}', 'lawyer', '{{ $appointment->status }}')">
                        <i class="fas fa-{{ $appointment->status == 'Pending' ? 'edit' : 'eye' }}"></i>
                        {{ $appointment->status == 'Pending' ? 'Update' : 'View' }}
                    </button>
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
    <div id="pims-visitor-appointments" class="pims-tab-content">
        @if(count($visitorAppointments) > 0)
        <div class="pims-cards-grid">
            @foreach ($visitorAppointments as $appointment)
            <div class="pims-appointment-card">
                <div class="pims-card-header">
                    <i class="fas fa-user-friends"></i>
                    <h3>Visitor Appointment</h3>
                </div>
                <div class="pims-card-body">
                    <div class="pims-card-field">
                        <span class="pims-card-label">Prisoner:</span>
                        <span class="pims-card-value">
                            {{ $appointment->prisoner_firstname }} {{ $appointment->prisoner_middlename }} {{ $appointment->prisoner_lastname }}
                            <button class="pims-btn pims-btn-small pims-btn-success"
                                onclick="pimsOpenPrisonerModal(
                                                    '{{ $appointment->prisoner_firstname }}',
                                                    '{{ $appointment->prisoner_middlename }}',
                                                    '{{ $appointment->prisoner_lastname }}'
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
    <div id="pims-status-modal" class="pims-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3><i class="fas fa-calendar-check"></i> Update Appointment Status</h3>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-status-modal')">&times;</button>
            </div>
            <form id="pims-status-form" method="POST" action="{{ route('updateAppointmentStatus') }}">
                @csrf
                <div class="pims-modal-body">
                    <input type="hidden" id="pims-appointment-id" name="appointment_id">
                    <input type="hidden" id="pims-appointment-type" name="appointment_type">

                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-status">Status</label>
                        <select class="pims-form-control" id="pims-status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-notes">Notes (Optional)</label>
                        <textarea class="pims-form-control" id="pims-notes" name="notes" rows="4" placeholder="Add any additional notes or reasons for the status change"></textarea>
                    </div>
                </div>

                <div class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-status-modal')">
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
    <div id="pims-prisoner-modal" class="pims-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3><i class="fas fa-user-shield"></i> Verify Prisoner Details</h3>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-prisoner-modal')">&times;</button>
            </div>
            <div class="pims-modal-body">
                <div class="pims-form-group">
                    <label class="pims-form-label">First Name</label>
                    <input type="text" class="pims-form-control" id="pims-verify-firstname" readonly>
                </div>
                <div class="pims-form-group">
                    <label class="pims-form-label">Middle Name</label>
                    <input type="text" class="pims-form-control" id="pims-verify-middlename" readonly>
                </div>
                <div class="pims-form-group">
                    <label class="pims-form-label">Last Name</label>
                    <input type="text" class="pims-form-control" id="pims-verify-lastname" readonly>
                </div>
                <div id="pims-verification-result" class="pims-alert" style="display: none;"></div>
            </div>
            <div class="pims-modal-footer">
                <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-prisoner-modal')">
                    <i class="fas fa-times"></i> Close
                </button>
                <button class="pims-btn pims-btn-primary" onclick="pimsVerifyPrisoner()">
                    <i class="fas fa-check-circle"></i> Verify
                </button>
            </div>
<!-- View Prisoner Button (initially hidden) -->
<div id="viewPrisonerBtn" class="mt-3 text-center" style="display: none;">
    <a href="#" id="viewPrisonerLink" class="pims-btn pims-btn-success w-100">
        <i class="fas fa-eye"></i> View Prisoner Details
    </a>
</div>

    </div>
    </div>

    <!-- Prisoner Details Modal -->
    <div id="pims-prisoner-details-modal" class="pims-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3><i class="fas fa-user-tag"></i> Prisoner Details</h3>
                <button class="pims-modal-close" onclick="pimsCloseModal('pims-prisoner-details-modal')">&times;</button>
            </div>
            <div class="pims-modal-body" id="pims-prisoner-details-body">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="pims-modal-footer">
                <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseModal('pims-prisoner-details-modal')">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>

   <!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Call this when you know which prisoner to view (e.g., after selecting a row)
    function showViewPrisonerButton(prisonerId) {
        $('#viewPrisonerLink').data('id', prisonerId); // set prisoner ID
        $('#viewPrisonerBtn').show(); // show the button
    }
    $(document).ready(function() {
        $('#viewPrisonerLink').click(function(e) {
            e.preventDefault();

            const prisonerId = $(this).data('id');

            $.ajax({
                url: '/prisoners/' + prisonerId,
                type: 'GET',
                success: function(data) {
                    $('#viewPrisonerImage').attr('src', '/' + data.inmate_image);
                    $('#viewPrisonerFullName').text(data.first_name + ' ' + data.middle_name + ' ' + data.last_name);
                    $('#viewPrisonerDOB').text(data.dob);
                    $('#viewPrisonerGender').text(data.gender);
                    $('#viewPrisonerAddress').text(data.address);
                    $('#viewPrisonerMaritalStatus').text(data.marital_status);
                    $('#viewPrisonerCrime').text(data.crime_committed);
                    $('#viewPrisonerStatus').text(data.status);
                    $('#viewPrisonerStart').text(data.time_serve_start);
                    $('#viewPrisonerEnd').text(data.time_serve_end);
                    $('#viewPrisonerEmergency').text(
                        data.emergency_contact_name + ' (' + data.emergency_contact_relation + ') - ' + data.emergency_contact_number
                    );
                    $('#viewPrisonerPrisonName').text(data.prison_name);

                    $('#viewPrisonerModal').modal('show'); // show NEW modal
                },
                error: function() {
                    alert('Failed to load prisoner info.');
                }
            });
        });
    });
</script>

        <script>
            // Tab Management
            document.addEventListener('DOMContentLoaded', function() {
                // Check for saved tab in localStorage
                const savedTab = localStorage.getItem('pims-active-appointment-tab');

                // If there's a saved tab and it exists on the page, activate it
                if (savedTab && document.getElementById(savedTab)) {
                    pimsOpenSavedTab(savedTab);
                } else {
                    // Default to first tab if no saved tab
                    const firstTab = document.querySelector('.pims-tablink');
                    if (firstTab) {
                        firstTab.click();
                    }
                }
            });

            function pimsOpenSavedTab(tabId) {
                // Hide all tab contents
                document.querySelectorAll('.pims-tab-content').forEach(content => {
                    content.style.display = 'none';
                });

                // Remove active class from all tabs
                document.querySelectorAll('.pims-tablink').forEach(tab => {
                    tab.classList.remove('active');
                });

                // Show the saved tab content
                const tabContent = document.getElementById(tabId);
                if (tabContent) {
                    tabContent.style.display = 'block';
                }

                // Activate the corresponding tab button
                const tabButton = document.querySelector(`.pims-tablink[data-tab="${tabId}"]`);
                if (tabButton) {
                    tabButton.classList.add('active');
                }
            }

            function pimsOpenTab(evt, tabId) {
                // Hide all tab contents
                document.querySelectorAll('.pims-tab-content').forEach(tab => {
                    tab.style.display = 'none';
                });

                // Remove active class from all tabs
                document.querySelectorAll('.pims-tablink').forEach(tab => {
                    tab.classList.remove('active');
                });

                // Show the selected tab content
                document.getElementById(tabId).style.display = 'block';

                // Add active class to the clicked tab
                evt.currentTarget.classList.add('active');

                // Store the active tab in localStorage
                localStorage.setItem('pims-active-appointment-tab', tabId);
            }

            // Modal Functions
            function pimsOpenStatusModal(appointmentId, appointmentType, currentStatus) {
                document.getElementById('pims-appointment-id').value = appointmentId;
                document.getElementById('pims-appointment-type').value = appointmentType;
                document.getElementById('pims-status').value = currentStatus.toLowerCase();
                document.getElementById('pims-notes').value = '';

                pimsShowModal('pims-status-modal');
            }

            function pimsOpenPrisonerModal(firstName, middleName, lastName) {
                document.getElementById('pims-verify-firstname').value = firstName;
                document.getElementById('pims-verify-middlename').value = middleName;
                document.getElementById('pims-verify-lastname').value = lastName;

                // Hide previous verification results
                document.getElementById('pims-verification-result').style.display = 'none';
                document.getElementById('pims-view-prisoner-btn').style.display = 'none';

                pimsShowModal('pims-prisoner-modal');
            }

            function pimsShowModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }

            function pimsCloseModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }

            // Close modal when clicking outside content
            window.addEventListener('click', function(event) {
                if (event.target.classList.contains('pims-modal')) {
                    const openModal = document.querySelector('.pims-modal.active');
                    if (openModal) {
                        pimsCloseModal(openModal.id);
                    }
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const openModal = document.querySelector('.pims-modal.active');
                    if (openModal) {
                        pimsCloseModal(openModal.id);
                    }
                }
            });

           // Enhanced Prisoner Verification
async function pimsVerifyPrisoner() {
    const firstName = document.getElementById('pims-verify-firstname').value.trim();
    const middleName = document.getElementById('pims-verify-middlename').value.trim();
    const lastName = document.getElementById('pims-verify-lastname').value.trim();

    if (!firstName || !lastName) {
        pimsShowVerificationResult('Please provide at least first and last name', false);
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

        if (data.success) {
            pimsShowVerificationResult(data.message, true);
            if (data.prisoner_id) {
                // Show view prisoner button with link
                const viewBtn = document.getElementById('pims-view-prisoner-btn');
                const viewLink = document.getElementById('pims-view-prisoner-link');
                viewLink.href = `/prisoners/${data.prisoner_id}`;
                viewBtn.style.display = 'block';
            }
        } else {
            pimsShowVerificationResult(data.message || 'Verification failed', false);
        }
    } catch (error) {
        pimsShowVerificationResult('Error verifying prisoner: ' + error.message, false);
    }
}


            function pimsShowVerificationResult(message, isSuccess) {
                const resultDiv = document.getElementById('pims-verification-result');
                resultDiv.innerHTML = `<i class="fas ${isSuccess ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i> ${message}`;
                resultDiv.className = `pims-alert ${isSuccess ? 'pims-alert-info' : 'pims-alert-danger'}`;
                resultDiv.style.display = 'flex';

                // Scroll to the result
                resultDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            // Enhanced Form Submission with Fetch
            document.getElementById('pims-status-form').addEventListener('submit', async function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;

                // Show loading state
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
                        alert('Status updated successfully!');
                        // Close modal
                        pimsCloseModal('pims-status-modal');
                        // Reload the page to see changes
                        window.location.reload();
                    } else {
                        alert(data.message || 'Failed to update status');
                    }
                } catch (error) {
                    alert('Error updating status: ' + error.message);
                } finally {
                    // Restore button state
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            });
        </script>

        @include('includes.footer_js')
</body>

</html>