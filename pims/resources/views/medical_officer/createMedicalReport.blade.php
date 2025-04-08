<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Medical Reports</title>
    
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


        /* Layout Structure */
        .pims-app-container {

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

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
            font-family: inherit;
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .pims-textarea {
            min-height: 120px;
            resize: vertical;
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

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: var(--pims-primary);
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

        .pims-btn-light {
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
        }

        .pims-btn-light:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn.is-loading {
            position: relative;
            color: transparent !important;
            pointer-events: none;
        }

        .pims-btn.is-loading::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: pims-spin 0.6s linear infinite;
        }

        @keyframes pims-spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Modal Styles */
        .pims-modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pims-modal.is-active {
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }

        .pims-modal-card {
            background: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .pims-modal.is-active .pims-modal-card {
            transform: translateY(0);
        }

        .pims-modal-card-head {
            padding: 1.25rem;
            background-color: rgba(41, 128, 185, 0.1);
            color: var(--pims-primary);
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-modal-close {
            background: none;
            border: none;
            color: var(--pims-primary);
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.2s ease;
            line-height: 1;
        }

        .pims-modal-close:hover {
            transform: rotate(90deg);
        }

        .pims-modal-card-body {
            padding: 1.5rem;
            overflow-y: auto;
        }

        .pims-modal-card-foot {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        /* Notification Styles */
        .pims-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 350px;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .pims-notification.is-active {
            transform: translateY(0);
            opacity: 1;
        }

        .pims-notification-success {
            background-color: rgba(39, 174, 96, 0.9);
            color: white;
        }

        .pims-notification-danger {
            background-color: rgba(192, 57, 43, 0.9);
            color: white;
        }

        .pims-notification-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Breadcrumb */
        .pims-breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 0.75rem 0;
            margin-bottom: 1.5rem;
        }

        .pims-breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--pims-accent);
            font-weight: 500;
        }

        .pims-breadcrumb-item:not(:last-child)::after {
            content: ">";
            color: #95a5a6;
        }

        .pims-breadcrumb-item.is-active {
            color: var(--pims-primary);
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

            .pims-modal-card {
                width: 95%;
            }
        }
    </style>
</head>

<body class="pims-app-container">
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('medical_officer.menu')

        <div class="pims-content-area">
            <div class="pims-breadcrumb">
                <span class="pims-breadcrumb-item">Medical Officer</span>
                <span class="pims-breadcrumb-item is-active">Medical Reports</span>
            </div>

            <!-- Include jsPDF from CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
            <!-- Include html2canvas for better PDF generation -->
            <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-file-medical"></i> Medical Report Management
                    </h2>
                </div>
                <div class="pims-card-body">
                    <div class="pims-card" style="background-color: rgba(41, 128, 185, 0.1); border-left-color: var(--pims-accent);">
                        <div class="pims-card-body">
                            <button class="pims-modal-close" style="position: absolute; right: 1rem; top: 1rem;"></button>
                            <p>
                                <i class="fas fa-info-circle"></i> Please fill out all required fields to generate a complete medical report. 
                                The report will be automatically saved as PDF upon submission.
                            </p>
                        </div>
                    </div>

                    <form id="pims-medical-report-form" action="{{ route('medical-reports.store') }}" method="POST">
                        @csrf
                        <div class="pims-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin: 1.5rem 0;">
                            <!-- Report Information -->
                            <div class="pims-card">
                                <div class="pims-card-header">
                                    <h3 class="pims-card-title">
                                        <i class="fas fa-info-circle"></i> Report Information
                                    </h3>
                                </div>
                                <div class="pims-card-body">
                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Prisoner <span style="color: var(--pims-danger);">*</span></label>
                                        <div style="position: relative;">
                                            <div class="pims-form-control" style="padding-left: 2.25rem;">
                                                <select name="prisoner_id" id="pims-prisoner-select" required style="width: 100%; border: none; background: transparent; font-family: inherit;">
                                                    <option value="">Select Prisoner</option>
                                                    @foreach($prisoners as $prisoner)
                                                    <option value="{{ $prisoner->id }}" 
                                                            data-pims-fullname="{{ $prisoner->first_name }} {{ $prisoner->last_name }}">
                                                        {{ $prisoner->first_name }} {{ $prisoner->last_name }} (ID: {{ $prisoner->id }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Appointment <span style="color: var(--pims-danger);">*</span></label>
                                        <div style="position: relative;">
                                            <div class="pims-form-control" style="padding-left: 2.25rem;">
                                                <select name="appointment_id" id="pims-appointment-select" style="width: 100%; border: none; background: transparent; font-family: inherit;">
                                                    <option value="">Select Appointment</option>
                                                    @foreach($appointments as $appointment)
                                                    <option value="{{ $appointment->id }}" 
                                                            data-pims-prisoner="{{ $appointment->prisoner_id }}"
                                                            data-pims-diagnosis="{{ $appointment->diagnosis }}"
                                                            data-pims-treatment="{{ $appointment->treatment }}"
                                                            data-pims-status="{{ $appointment->status }}"
                                                            data-pims-date="{{ $appointment->appointment_date }}">
                                                        Appointment #{{ $appointment->id }} - {{ date('M d, Y', strtotime($appointment->appointment_date)) }} ({{ ucfirst($appointment->status) }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                                <i class="fas fa-calendar-check"></i>
                                            </span>
                                        </div>
                                        <p style="font-size: 0.85rem; color: #7f8c8d; margin-top: 0.25rem;">Select an appointment to load its details</p>
                                    </div>

                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Medical Officer</label>
                                        <div style="position: relative;">
                                            <input class="pims-form-control" type="text" value="{{ session('first_name') }} {{ session('last_name') }}" disabled style="padding-left: 2.25rem;">
                                            <input type="hidden" name="doctor_id" value="{{ session('user_id') }}">
                                            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                                <i class="fas fa-user-md"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Report Date <span style="color: var(--pims-danger);">*</span></label>
                                        <div style="position: relative;">
                                            <input class="pims-form-control" type="date" name="report_date" required value="{{ date('Y-m-d') }}" style="padding-left: 2.25rem;">
                                            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Follow-Up Needed</label>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <input type="checkbox" name="follow_up" id="pims-follow-up-checkbox" style="width: auto;">
                                            <label for="pims-follow-up-checkbox">Yes, schedule a follow-up</label>
                                        </div>
                                    </div>

                                    <div class="pims-form-group" id="pims-follow-up-date-field" style="display: none;">
                                        <label class="pims-form-label">Follow-Up Date</label>
                                        <div style="position: relative;">
                                            <input class="pims-form-control" type="date" name="follow_up_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" style="padding-left: 2.25rem;">
                                            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%);">
                                                <i class="fas fa-calendar-check"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Medical Report Details -->
                            <div class="pims-card">
                                <div class="pims-card-header">
                                    <h3 class="pims-card-title">
                                        <i class="fas fa-file-medical"></i> Medical Details
                                    </h3>
                                </div>
                                <div class="pims-card-body">
                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Diagnosis <span style="color: var(--pims-danger);">*</span></label>
                                        <textarea class="pims-form-control pims-textarea" name="diagnosis" id="pims-diagnosis-field" required placeholder="Enter detailed diagnosis..."></textarea>
                                    </div>

                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Treatment <span style="color: var(--pims-danger);">*</span></label>
                                        <textarea class="pims-form-control pims-textarea" name="treatment" id="pims-treatment-field" required placeholder="Describe treatment provided..."></textarea>
                                    </div>

                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Medications <span style="color: var(--pims-danger);">*</span></label>
                                        <textarea class="pims-form-control pims-textarea" name="medications" id="pims-medications-field" required placeholder="List prescribed medications with dosage..."></textarea>
                                    </div>

                                    <div class="pims-form-group">
                                        <label class="pims-form-label">Additional Notes</label>
                                        <textarea class="pims-form-control pims-textarea" name="notes" id="pims-notes-field" placeholder="Any additional observations or recommendations..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Button -->
                        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                            <button class="pims-btn pims-btn-light" type="reset" id="pims-reset-btn">
                                <i class="fas fa-undo"></i> Reset Form
                            </button>
                            <button class="pims-btn pims-btn-primary" type="button" id="pims-generate-pdf-btn">
                                <i class="fas fa-file-pdf"></i> Preview & Generate PDF
                            </button>
                            <button class="pims-btn pims-btn-success" type="submit" id="pims-submit-btn">
                                <i class="fas fa-save"></i> Save Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="pims-modal" id="pims-preview-modal">
        <div class="pims-modal-card" style="width: 80%; max-width: 800px;">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-file-medical"></i> Medical Report Preview
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body" id="pims-report-preview">
                <!-- Preview content will be inserted here -->
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-primary" id="pims-download-pdf-btn">
                    <i class="fas fa-download"></i> Download PDF
                </button>
                <button class="pims-btn pims-btn-light" id="pims-close-preview-btn">
                    <i class="fas fa-times"></i> Close
                </button>
            </footer>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="pims-notification-container"></div>

    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const prisonerSelect = document.getElementById('pims-prisoner-select');
            const appointmentSelect = document.getElementById('pims-appointment-select');
            const diagnosisField = document.getElementById('pims-diagnosis-field');
            const treatmentField = document.getElementById('pims-treatment-field');
            const medicationsField = document.getElementById('pims-medications-field');
            const notesField = document.getElementById('pims-notes-field');
            const followUpCheckbox = document.getElementById('pims-follow-up-checkbox');
            const followUpDateField = document.getElementById('pims-follow-up-date-field');
            const resetBtn = document.getElementById('pims-reset-btn');
            const generatePdfBtn = document.getElementById('pims-generate-pdf-btn');
            const submitBtn = document.getElementById('pims-submit-btn');
            const form = document.getElementById('pims-medical-report-form');
            const previewModal = document.getElementById('pims-preview-modal');

            // Toggle follow-up date field
            followUpCheckbox.addEventListener('change', function() {
                followUpDateField.style.display = this.checked ? 'block' : 'none';
                if (this.checked) {
                    const tomorrow = new Date();
                    tomorrow.setDate(tomorrow.getDate() + 1);
                    document.querySelector('input[name="follow_up_date"]').min = tomorrow.toISOString().split('T')[0];
                }
            });

            // Filter appointments when prisoner is selected
            prisonerSelect.addEventListener('change', function() {
                const prisonerId = this.value;
                const options = appointmentSelect.options;
                
                // First reset all options to hidden
                for (let i = 0; i < options.length; i++) {
                    options[i].style.display = 'none';
                    options[i].disabled = true;
                }
                
                // Show default option
                options[0].style.display = '';
                options[0].disabled = false;
                
                if (prisonerId) {
                    // Show only appointments for selected prisoner
                    for (let i = 1; i < options.length; i++) {
                        if (options[i].dataset.pimsPrisoner === prisonerId) {
                            options[i].style.display = '';
                            options[i].disabled = false;
                        }
                    }
                    
                    // If no appointments found, show message
                    if ([...options].filter(opt => opt.style.display === '').length === 1) {
                        const option = document.createElement('option');
                        option.textContent = 'No appointments found for this prisoner';
                        option.disabled = true;
                        appointmentSelect.appendChild(option);
                    }
                }
            });

            // Load appointment data when selected
            appointmentSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    diagnosisField.value = selectedOption.dataset.pimsDiagnosis || '';
                    treatmentField.value = selectedOption.dataset.pimsTreatment || '';
                    
                    // Set the appointment date as default report date
                    if (selectedOption.dataset.pimsDate) {
                        document.querySelector('input[name="report_date"]').value = selectedOption.dataset.pimsDate.split(' ')[0];
                    }
                }
            });

            // Reset form handler
            resetBtn.addEventListener('click', function() {
                // Reset appointment select to show all options
                const options = appointmentSelect.options;
                for (let i = 0; i < options.length; i++) {
                    options[i].style.display = '';
                    options[i].disabled = false;
                }
                
                // Remove any dynamically added "no appointments" message
                const lastOption = options[options.length - 1];
                if (lastOption.textContent.includes('No appointments found')) {
                    appointmentSelect.removeChild(lastOption);
                }
                
                appointmentSelect.selectedIndex = 0;
            });

            // Generate PDF button handler
            generatePdfBtn.addEventListener('click', function() {
                // First validate the form
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                
                generatePdfBtn.classList.add('is-loading');
                pimsGenerateReportPreview();
                previewModal.classList.add('is-active');
                generatePdfBtn.classList.remove('is-loading');
            });

            // Close modal handlers
            document.querySelectorAll('#pims-preview-modal .pims-modal-close, #pims-close-preview-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    previewModal.classList.remove('is-active');
                });
            });

            // Download PDF handler
            document.getElementById('pims-download-pdf-btn').addEventListener('click', function() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                // Get form values
                const prisonerText = prisonerSelect.options[prisonerSelect.selectedIndex].dataset.pimsFullname;
                const prisonerId = prisonerSelect.value;
                const appointmentId = appointmentSelect.value;
                const appointmentOption = appointmentSelect.options[appointmentSelect.selectedIndex];
                const doctor = form.querySelector('input[name="doctor_id"]').value;
                const reportDate = form.report_date.value;
                const followUp = form.follow_up.checked ? 'Yes' : 'No';
                const followUpDate = form.follow_up.checked ? form.follow_up_date.value : 'N/A';
                const diagnosis = form.diagnosis.value;
                const treatment = form.treatment.value;
                const medications = form.medications.value;
                const notes = form.notes.value || 'None';
                const appointmentDate = appointmentOption.dataset.pimsDate ? new Date(appointmentOption.dataset.pimsDate).toLocaleDateString() : 'N/A';
                const appointmentStatus = appointmentOption.dataset.pimsStatus || 'N/A';

                // Set document properties
                doc.setProperties({
                    title: `Medical Report - ${prisonerText}`,
                    subject: 'Prisoner Medical Report',
                    author: 'Prison Management System',
                    keywords: 'medical, report, prisoner',
                    creator: 'Prison Management System'
                });

                // Add header with logo
                doc.setFontSize(18);
                doc.setTextColor(40, 53, 147);
                doc.text('PRISON MEDICAL REPORT', 105, 20, { align: 'center' });
                doc.setDrawColor(40, 53, 147);
                doc.setLineWidth(0.5);
                doc.line(20, 25, 190, 25);

                // Prisoner and appointment info
                doc.setFontSize(12);
                doc.text(`Prisoner: ${prisonerText} (ID: ${prisonerId})`, 20, 35);
                doc.text(`Appointment: #${appointmentId} (${appointmentStatus})`, 20, 45);
                doc.text(`Appointment Date: ${appointmentDate}`, 20, 55);
                doc.text(`Medical Officer: ${doctor}`, 120, 35);
                doc.text(`Report Date: ${reportDate}`, 120, 45);
                doc.text(`Follow-Up Needed: ${followUp}`, 120, 55);
                
                if (followUp === 'Yes') {
                    doc.text(`Follow-Up Date: ${followUpDate}`, 120, 65);
                }

                // Medical details
                doc.setFontSize(14);
                doc.setTextColor(40, 53, 147);
                doc.text('Diagnosis:', 20, 80);
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0);
                doc.text(doc.splitTextToSize(diagnosis, 170), 20, 85);

                let y = 85 + doc.splitTextToSize(diagnosis, 170).length * 7 + 10;
                doc.setFontSize(14);
                doc.setTextColor(40, 53, 147);
                doc.text('Treatment:', 20, y);
                y += 5;
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0);
                doc.text(doc.splitTextToSize(treatment, 170), 20, y);

                y += doc.splitTextToSize(treatment, 170).length * 7 + 10;
                doc.setFontSize(14);
                doc.setTextColor(40, 53, 147);
                doc.text('Medications:', 20, y);
                y += 5;
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0);
                doc.text(doc.splitTextToSize(medications, 170), 20, y);

                y += doc.splitTextToSize(medications, 170).length * 7 + 10;
                doc.setFontSize(14);
                doc.setTextColor(40, 53, 147);
                doc.text('Additional Notes:', 20, y);
                y += 5;
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0);
                doc.text(doc.splitTextToSize(notes, 170), 20, y);

                // Footer
                doc.setFontSize(10);
                doc.setTextColor(100, 100, 100);
                doc.text('Generated by Prison Management System', 105, y + 20, { align: 'center' });
                doc.text(new Date().toLocaleString(), 105, y + 25, { align: 'center' });

                // Save the PDF
                doc.save(`Medical_Report_${prisonerText.replace(/ /g, '_')}_${reportDate}.pdf`);
                previewModal.classList.remove('is-active');
                pimsShowNotification('Medical report PDF generated successfully!', 'success');
            });

            // Form submission handler
            form.addEventListener('submit', function(e) {
                // The form will submit normally to your route
                submitBtn.classList.add('is-loading');
            });

            // Generate report preview
            function pimsGenerateReportPreview() {
                const prisonerText = prisonerSelect.options[prisonerSelect.selectedIndex].dataset.pimsFullname;
                const prisonerId = prisonerSelect.value;
                const appointmentId = appointmentSelect.value;
                const appointmentOption = appointmentSelect.options[appointmentSelect.selectedIndex];
                const doctor = form.querySelector('input[name="doctor_id"]').value;
                const reportDate = form.report_date.value;
                const followUp = form.follow_up.checked ? 'Yes' : 'No';
                const followUpDate = form.follow_up.checked ? form.follow_up_date.value : 'N/A';
                const diagnosis = form.diagnosis.value;
                const treatment = form.treatment.value;
                const medications = form.medications.value;
                const notes = form.notes.value || 'None';
                const appointmentDate = appointmentOption.dataset.pimsDate ? new Date(appointmentOption.dataset.pimsDate).toLocaleDateString() : 'N/A';
                const appointmentStatus = appointmentOption.dataset.pimsStatus || 'N/A';

                const previewHTML = `
                    <div class="pims-card">
                        <div class="pims-card-header">
                            <h3 class="pims-card-title" style="text-align: center; color: var(--pims-accent);">
                                <i class="fas fa-file-medical"></i> PRISON MEDICAL REPORT
                            </h3>
                        </div>
                        <div class="pims-card-body">
                            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                                <div>
                                    <p><strong>Prisoner:</strong> ${prisonerText} (ID: ${prisonerId})</p>
                                    <p><strong>Appointment:</strong> #${appointmentId} (${appointmentStatus})</p>
                                    <p><strong>Appointment Date:</strong> ${appointmentDate}</p>
                                </div>
                                <div>
                                    <p><strong>Medical Officer:</strong> ${doctor}</p>
                                    <p><strong>Report Date:</strong> ${reportDate}</p>
                                    <p><strong>Follow-Up Needed:</strong> ${followUp}</p>
                                    ${followUp === 'Yes' ? `<p><strong>Follow-Up Date:</strong> ${followUpDate}</p>` : ''}
                                </div>
                            </div>
                            
                            <div style="margin-top: 1.5rem;">
                                <h4 style="color: var(--pims-accent); border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-bottom: 0.5rem;">Diagnosis</h4>
                                <p>${diagnosis.replace(/\n/g, '<br>')}</p>
                                
                                <h4 style="color: var(--pims-accent); border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin: 1rem 0 0.5rem 0;">Treatment</h4>
                                <p>${treatment.replace(/\n/g, '<br>')}</p>
                                
                                <h4 style="color: var(--pims-accent); border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin: 1rem 0 0.5rem 0;">Medications</h4>
                                <p>${medications.replace(/\n/g, '<br>')}</p>
                                
                                <h4 style="color: var(--pims-accent); border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin: 1rem 0 0.5rem 0;">Additional Notes</h4>
                                <p>${notes.replace(/\n/g, '<br>')}</p>
                            </div>
                            
                            <div style="margin-top: 2rem; text-align: center; color: #7f8c8d; font-size: 0.85rem;">
                                <p>Generated by Prison Management System on ${new Date().toLocaleString()}</p>
                            </div>
                        </div>
                    </div>
                `;
                
                document.getElementById('pims-report-preview').innerHTML = previewHTML;
            }

            // Notification function
            function pimsShowNotification(message, type = 'success') {
                const container = document.getElementById('pims-notification-container');
                const notification = document.createElement('div');
                notification.className = `pims-notification pims-notification-${type}`;
                notification.innerHTML = `
                    <span>${message}</span>
                    <button class="pims-notification-close">&times;</button>
                `;
                
                container.appendChild(notification);
                
                // Show notification
                setTimeout(() => {
                    notification.classList.add('is-active');
                }, 10);
                
                // Close button
                notification.querySelector('.pims-notification-close').addEventListener('click', () => {
                    notification.classList.remove('is-active');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                });
                
                // Auto-remove after 5 seconds
                setTimeout(() => {
                    notification.classList.remove('is-active');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 5000);
            }
        });
    </script>
</body>
</html>