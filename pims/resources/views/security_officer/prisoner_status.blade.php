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
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-gray: #ecf0f1;
            --dark-gray: #7f8c8d;
        }

        /* Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        /* Layout */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
        }

        .pims-report-container {
            flex-grow: 1;
            padding: 25px;
            background-color: #f9f9f9;
        }

        .pims-report-title {
            font-size: 2rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            color: var(--primary-color);
        }

        .pims-report-title i {
            margin-right: 15px;
            color: var(--secondary-color);
        }

        /* Enhanced Tabs Styling */
        .pims-tabs {
            display: flex;
            margin-bottom: 25px;
            border-bottom: 2px solid #ddd;
            position: relative;
        }

        .pims-tablink {
            background-color: transparent;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 12px 25px;
            margin-right: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 600;
            color: var(--dark-gray);
            position: relative;
            font-size: 1rem;
        }

        .pims-tablink i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .pims-tablink.active {
            border-bottom-color: var(--secondary-color);
            color: var(--primary-color);
            background-color: rgba(52, 152, 219, 0.1);
        }

        .pims-tablink:hover:not(.active) {
            background-color: rgba(52, 152, 219, 0.05);
            color: var(--primary-color);
        }

        .pims-tablink.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--secondary-color);
        }

        /* Enhanced Cards Styling */
        .pims-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .pims-appointment-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .pims-appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 10px;
            font-size: 1.3rem;
        }

        .card-body {
            padding: 20px;
        }

        .card-field {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
        }

        .card-label {
            font-weight: 600;
            width: 120px;
            color: var(--primary-color);
        }

        .card-value {
            color: #555;
            flex: 1;
            word-break: break-word;
        }

        .card-footer {
            padding: 15px;
            background-color: var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e0e0e0;
        }

        /* Enhanced Status Badges */
        .pims-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .pims-status-pending {
            background-color: var(--warning-color);
            color: #fff;
        }

        .pims-status-approved {
            background-color: var(--success-color);
            color: white;
        }

        .pims-status-rejected {
            background-color: var(--danger-color);
            color: white;
        }

        /* Enhanced Buttons */
        .pims-btn {
            padding: 8px 16px;
            font-size: 0.9rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .pims-btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }

        .pims-btn-secondary {
            background-color: var(--dark-gray);
            color: white;
        }

        .pims-btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .pims-btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .pims-btn-small {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .pims-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Enhanced Modal Styling */
        .pims-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
            backdrop-filter: blur(3px);
        }

        .pims-modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .pims-modal-title {
            margin: 0;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .pims-modal-close {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--dark-gray);
            cursor: pointer;
            background: none;
            border: none;
            transition: color 0.2s;
        }

        .pims-modal-close:hover {
            color: var(--danger-color);
        }

        .pims-form-group {
            margin-bottom: 20px;
        }

        .pims-form-label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
        }

        .pims-form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .pims-form-control:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        textarea.pims-form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.pims-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 12px;
        }

        /* Alert Styles */
        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .alert-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(39, 174, 96, 0.2);
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(231, 76, 60, 0.2);
        }

        /* Responsive Styling */
        @media (max-width: 992px) {
            .pims-card-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .pims-tabs {
                flex-wrap: wrap;
            }
            
            .pims-tablink {
                padding: 10px 15px;
                font-size: 0.95rem;
                margin-bottom: 5px;
            }
            
            .pims-card-grid {
                grid-template-columns: 1fr;
            }
            
            .pims-modal-content {
                width: 95%;
                margin: 15% auto;
                padding: 20px;
            }

            .card-field {
                flex-direction: column;
                gap: 5px;
            }

            .card-label {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .pims-report-container {
                padding: 15px;
            }

            .pims-report-title {
                font-size: 1.7rem;
            }

            .card-footer {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
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
                            <button class="pims-btn pims-btn-small {{ $appointment->status == 'Pending' ? 'pims-btn-primary' : 'pims-btn-secondary' }}"
                                onclick="openStatusModal('{{ $appointment->id }}', 'medical', '{{ $appointment->status }}')">
                                <i class="fas fa-{{ $appointment->status == 'Pending' ? 'edit' : 'eye' }}"></i>
                                {{ $appointment->status == 'Pending' ? 'Update' : 'View' }}
                            </button>
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
                                    {{ $appointment->prisoner->firstname }} {{ $appointment->prisoner->middlename }} {{ $appointment->prisoner->lastname }} ({{ $appointment->prisoner->id }})
                                </span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Date:</span>
                                <span class="card-value">{{ date('M d, Y h:i A', strtotime($appointment->appointment_date)) }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Lawyer:</span>
                                <span class="card-value">{{ $appointment->lawyer->name }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Case Type:</span>
                                <span class="card-value">{{ $appointment->case_type ?? 'Not specified' }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="pims-status-badge 
                                {{ $appointment->status == 'Pending' ? 'pims-status-pending' : 
                                ($appointment->status == 'Approved' ? 'pims-status-approved' : 'pims-status-rejected') }}">
                                <i class="fas fa-{{ $appointment->status == 'Pending' ? 'clock' : ($appointment->status == 'Approved' ? 'check' : 'times') }}"></i>
                                {{ $appointment->status }}
                            </span>
                            <button class="pims-btn pims-btn-small {{ $appointment->status == 'Pending' ? 'pims-btn-primary' : 'pims-btn-secondary' }}"
                                onclick="openStatusModal('{{ $appointment->id }}', 'lawyer', '{{ $appointment->status }}')">
                                <i class="fas fa-{{ $appointment->status == 'Pending' ? 'edit' : 'eye' }}"></i>
                                {{ $appointment->status == 'Pending' ? 'Update' : 'View' }}
                            </button>
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
                <button class="pims-modal-close" onclick="closeModal('prisonerModal')">&times;</button>
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
                <a href="#" id="viewPrisonerLink" class="pims-btn pims-btn-success w-100">
                    <i class="fas fa-eye"></i> View Prisoner Details
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced Tab Management with LocalStorage Persistence
        document.addEventListener('DOMContentLoaded', function() {
            // Check for saved tab in localStorage
            const savedTab = localStorage.getItem('activeAppointmentTab');
            
            // If there's a saved tab and it exists on the page, activate it
            if (savedTab && document.getElementById(savedTab)) {
                openSavedTab(savedTab);
            } else {
                // Default to first tab if no saved tab
                const firstTab = document.querySelector('.pims-tablink');
                if (firstTab) {
                    firstTab.click();
                }
            }
            
            // Add event listeners for all tabs
            document.querySelectorAll('.pims-tablink').forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab') || 
                                 this.getAttribute('onclick').match(/'([^']+)'/)[1];
                    localStorage.setItem('activeAppointmentTab', tabId);
                });
            });
        });

        function openSavedTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.pims-report-content').forEach(content => {
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
            const tabButton = document.querySelector(`.pims-tablink[data-tab="${tabId}"], 
                                                   .pims-tablink[onclick*="${tabId}"]`);
            if (tabButton) {
                tabButton.classList.add('active');
            }
        }

        // Tab switching function
        function openReportTab(evt, reportName) {
            // Hide all report contents
            document.querySelectorAll('.pims-report-content').forEach(el => {
                el.style.display = 'none';
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.pims-tablink').forEach(el => {
                el.classList.remove('active');
            });
            
            // Show the selected report content
            const tabContent = document.getElementById(reportName);
            if (tabContent) {
                tabContent.style.display = 'block';
                // Smooth scroll to top of the content
                tabContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            
            // Add active class to the clicked tab
            if (evt && evt.currentTarget) {
                evt.currentTarget.classList.add('active');
            }
            
            // Store the active tab in localStorage
            localStorage.setItem('activeAppointmentTab', reportName);
        }

        // Modal Functions
        function openStatusModal(appointmentId, appointmentType, currentStatus) {
            document.getElementById('appointment_id').value = appointmentId;
            document.getElementById('appointment_type').value = appointmentType;
            document.getElementById('status').value = currentStatus.toLowerCase();
            
            // Reset notes field
            document.getElementById('notes').value = '';
            
            showModal('statusModal');
        }

        function openPrisonerModal(firstName, middleName, lastName) {
            document.getElementById('verifyFirstName').value = firstName;
            document.getElementById('verifyMiddleName').value = middleName;
            document.getElementById('verifyLastName').value = lastName;
            
            // Hide previous verification results
            document.getElementById('verificationResult').style.display = 'none';
            document.getElementById('viewPrisonerBtn').style.display = 'none';
            
            showModal('prisonerModal');
        }

        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = ''; // Restore scrolling
            }
        }

        // Close modal when clicking outside content
        window.onclick = function(event) {
            if (event.target.classList.contains('pims-modal')) {
                closeModal(event.target.id);
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const openModal = document.querySelector('.pims-modal[style="display: block;"]');
                if (openModal) {
                    closeModal(openModal.id);
                }
            }
        });

        // Enhanced Prisoner Verification
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
                
                if (data.success) {
                    showVerificationResult(data.message, true);
                    if (data.prisoner_id) {
                        // Show view prisoner button with link
                        const viewBtn = document.getElementById('viewPrisonerBtn');
                        const viewLink = document.getElementById('viewPrisonerLink');
                        viewLink.href = `/prisoners/${data.prisoner_id}`;
                        viewBtn.style.display = 'block';
                    }
                } else {
                    showVerificationResult(data.message || 'Verification failed', false);
                }
            } catch (error) {
                showVerificationResult('Error verifying prisoner: ' + error.message, false);
            }
        }

        function showVerificationResult(message, isSuccess) {
            const resultDiv = document.getElementById('verificationResult');
            resultDiv.textContent = message;
            resultDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'}`;
            resultDiv.style.display = 'block';
            
            // Scroll to the result
            resultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Enhanced Form Submission with Fetch
        document.getElementById('statusForm').addEventListener('submit', async function(e) {
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
                    closeModal('statusModal');
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