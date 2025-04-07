<!DOCTYPE html>
@include('includes.head')

<body class="has-background-light">

    <!-- NAV -->
    @include('includes.nav')
    <div class="columns is-gapless" id="app-content">
        @include('medical_officer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">Medical Officer</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Medical Reports</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Include jsPDF from CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
            <!-- Include html2canvas for better PDF generation -->
            <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

            <section class="section">
                <div class="container">
                    <div class="level">
                        <div class="level-left">
                            <h1 class="title has-text-primary">Medical Report Management</h1>
                        </div>
                        
                    </div>

                    <div class="notification is-info is-light">
                        <button class="delete"></button>
                        Please fill out all required fields to generate a complete medical report. The report will be automatically saved as PDF upon submission.
                    </div>

                    <form id="medicalReportForm" action="{{ route('medical-reports.store') }}" method="POST">
                        @csrf
                        <div class="columns">
                            <!-- Report Information -->
                            <div class="column is-half">
                                <div class="card has-shadow">
                                    <header class="card-header">
                                        <p class="card-header-title has-text-primary">
                                            <span class="icon"><i class="fas fa-info-circle"></i></span>
                                            <span>Report Information</span>
                                        </p>
                                    </header>
                                    <div class="card-content">
                                        <div class="field">
                                            <label class="label">Prisoner <span class="has-text-danger">*</span></label>
                                            <div class="control has-icons-left">
                                                <div class="select is-fullwidth">
                                                    <select name="prisoner_id" id="prisonerSelect" required class="is-capitalized">
                                                        <option value="">Select Prisoner</option>
                                                        @foreach($prisoners as $prisoner)
                                                        <option value="{{ $prisoner->id }}" 
                                                                data-fullname="{{ $prisoner->first_name }} {{ $prisoner->last_name }}">
                                                            {{ $prisoner->first_name }} {{ $prisoner->last_name }} (ID: {{ $prisoner->id }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Appointment <span class="has-text-danger">*</span></label>
                                            <div class="control has-icons-left">
                                                <div class="select is-fullwidth">
                                                    <select name="appointment_id" id="appointmentSelect"  >
                                                        <option value="">Select Appointment</option>
                                                        @foreach($appointments as $appointment)
                                                        <option value="{{ $appointment->id }}" 
                                                                data-prisoner="{{ $appointment->prisoner_id }}"
                                                                data-diagnosis="{{ $appointment->diagnosis }}"
                                                                data-treatment="{{ $appointment->treatment }}"
                                                                data-status="{{ $appointment->status }}"
                                                                data-date="{{ $appointment->appointment_date }}">
                                                            Appointment #{{ $appointment->id }} - {{ date('M d, Y', strtotime($appointment->appointment_date)) }} ({{ ucfirst($appointment->status) }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-calendar-check"></i>
                                                </span>
                                            </div>
                                            <p class="help">Select an appointment to load its details</p>
                                        </div>

                                        <div class="field">
                                            <label class="label">Medical Officer</label>
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" value="{{ session('first_name') }} {{ session('last_name') }}" disabled>
                                                <input type="hidden" name="doctor_id" value="{{ session('user_id') }}">
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-user-md"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Report Date <span class="has-text-danger">*</span></label>
                                            <div class="control has-icons-left">
                                                <input class="input" type="date" name="report_date" required value="{{ date('Y-m-d') }}">
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Follow-Up Needed</label>
                                            <div class="control">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="follow_up" id="followUpCheckbox">
                                                    Yes, schedule a follow-up
                                                </label>
                                            </div>
                                        </div>

                                        <div class="field" id="followUpDateField" style="display: none;">
                                            <label class="label">Follow-Up Date</label>
                                            <div class="control has-icons-left">
                                                <input class="input" type="date" name="follow_up_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-calendar-check"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Medical Report Details -->
                            <div class="column is-half">
                                <div class="card has-shadow">
                                    <header class="card-header">
                                        <p class="card-header-title has-text-primary">
                                            <span class="icon"><i class="fas fa-file-medical"></i></span>
                                            <span>Medical Details</span>
                                        </p>
                                    </header>
                                    <div class="card-content">
                                        <div class="field">
                                            <label class="label">Diagnosis <span class="has-text-danger">*</span></label>
                                            <div class="control">
                                                <textarea class="textarea" name="diagnosis" id="diagnosisField" required placeholder="Enter detailed diagnosis..." rows="4"></textarea>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Treatment <span class="has-text-danger">*</span></label>
                                            <div class="control">
                                                <textarea class="textarea" name="treatment" id="treatmentField" required placeholder="Describe treatment provided..." rows="4"></textarea>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Medications <span class="has-text-danger">*</span></label>
                                            <div class="control">
                                                <textarea class="textarea" name="medications" id="medicationsField" required placeholder="List prescribed medications with dosage..." rows="4"></textarea>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Additional Notes</label>
                                            <div class="control">
                                                <textarea class="textarea" name="notes" id="notesField" placeholder="Any additional observations or recommendations..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Button -->
                        <div class="field is-grouped is-grouped-right mt-5">
                            <div class="control">
                                <button class="button is-light" type="reset" id="resetBtn">
                                    <span class="icon"><i class="fas fa-undo"></i></span>
                                    <span>Reset Form</span>
                                </button>
                            </div>
                            <div class="control">
                                <button class="button is-primary" type="button" id="generatePdfBtn">
                                    <span class="icon"><i class="fas fa-file-pdf"></i></span>
                                    <span>Preview & Generate PDF</span>
                                </button>
                                <button class="button is-success" type="submit" id="submitBtn">
                                    <span class="icon"><i class="fas fa-save"></i></span>
                                    <span>Save Report</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Preview Modal -->
            <div class="modal" id="previewModal">
                <div class="modal-background"></div>
                <div class="modal-card" style="width: 80%; max-width: 800px;">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Medical Report Preview</p>
                        <button class="delete" aria-label="close"></button>
                    </header>
                    <section class="modal-card-body" id="reportPreview">
                        <!-- Preview content will be inserted here -->
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-primary" id="downloadPdfBtn">Download PDF</button>
                        <button class="button" id="closePreviewBtn">Close</button>
                    </footer>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // DOM Elements
                    const prisonerSelect = document.getElementById('prisonerSelect');
                    const appointmentSelect = document.getElementById('appointmentSelect');
                    const diagnosisField = document.getElementById('diagnosisField');
                    const treatmentField = document.getElementById('treatmentField');
                    const medicationsField = document.getElementById('medicationsField');
                    const notesField = document.getElementById('notesField');
                    const followUpCheckbox = document.getElementById('followUpCheckbox');
                    const followUpDateField = document.getElementById('followUpDateField');
                    const resetBtn = document.getElementById('resetBtn');
                    const generatePdfBtn = document.getElementById('generatePdfBtn');
                    const submitBtn = document.getElementById('submitBtn');
                    const form = document.getElementById('medicalReportForm');

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
                                if (options[i].dataset.prisoner === prisonerId) {
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
                            diagnosisField.value = selectedOption.dataset.diagnosis || '';
                            treatmentField.value = selectedOption.dataset.treatment || '';
                            
                            // Set the appointment date as default report date
                            if (selectedOption.dataset.date) {
                                document.querySelector('input[name="report_date"]').value = selectedOption.dataset.date.split(' ')[0];
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
                        generateReportPreview();
                        document.getElementById('previewModal').classList.add('is-active');
                        generatePdfBtn.classList.remove('is-loading');
                    });

                    // Close modal handlers
                    document.querySelectorAll('#previewModal .delete, #closePreviewBtn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            document.getElementById('previewModal').classList.remove('is-active');
                        });
                    });

                    // Download PDF handler
                    document.getElementById('downloadPdfBtn').addEventListener('click', function() {
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();
                        
                        // Get form values
                        const prisonerText = prisonerSelect.options[prisonerSelect.selectedIndex].dataset.fullname;
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
                        const appointmentDate = appointmentOption.dataset.date ? new Date(appointmentOption.dataset.date).toLocaleDateString() : 'N/A';
                        const appointmentStatus = appointmentOption.dataset.status || 'N/A';

                        // Set document properties
                        doc.setProperties({
                            title: `Medical Report - ${prisonerText}`,
                            subject: 'Prisoner Medical Report',
                            author: 'Prison Management System',
                            keywords: 'medical, report, prisoner',
                            creator: 'Prison Management System'
                        });

                        // Add header
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
                        doc.text('Diagnosis:', 20, 80);
                        doc.setFontSize(12);
                        doc.text(doc.splitTextToSize(diagnosis, 170), 20, 85);

                        let y = 85 + doc.splitTextToSize(diagnosis, 170).length * 7 + 10;
                        doc.setFontSize(14);
                        doc.text('Treatment:', 20, y);
                        y += 5;
                        doc.setFontSize(12);
                        doc.text(doc.splitTextToSize(treatment, 170), 20, y);

                        y += doc.splitTextToSize(treatment, 170).length * 7 + 10;
                        doc.setFontSize(14);
                        doc.text('Medications:', 20, y);
                        y += 5;
                        doc.setFontSize(12);
                        doc.text(doc.splitTextToSize(medications, 170), 20, y);

                        y += doc.splitTextToSize(medications, 170).length * 7 + 10;
                        doc.setFontSize(14);
                        doc.text('Additional Notes:', 20, y);
                        y += 5;
                        doc.setFontSize(12);
                        doc.text(doc.splitTextToSize(notes, 170), 20, y);

                        // Footer
                        doc.setFontSize(10);
                        doc.setTextColor(100, 100, 100);
                        doc.text('Generated by Prison Management System', 105, y + 20, { align: 'center' });
                        doc.text(new Date().toLocaleString(), 105, y + 25, { align: 'center' });

                        // Save the PDF
                        doc.save(`Medical_Report_${prisonerText.replace(/ /g, '_')}_${reportDate}.pdf`);
                        document.getElementById('previewModal').classList.remove('is-active');
                        showNotification('Medical report PDF generated successfully!', 'success');
                    });

                    // Form submission handler
                    form.addEventListener('submit', function(e) {
                        // The form will submit normally to your route
                        submitBtn.classList.add('is-loading');
                    });

                    // Generate report preview
                    function generateReportPreview() {
                        const prisonerText = prisonerSelect.options[prisonerSelect.selectedIndex].dataset.fullname;
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
                        const appointmentDate = appointmentOption.dataset.date ? new Date(appointmentOption.dataset.date).toLocaleDateString() : 'N/A';
                        const appointmentStatus = appointmentOption.dataset.status || 'N/A';

                        const previewHTML = `
                            <div class="box">
                                <h2 class="title is-4 has-text-centered has-text-primary">PRISON MEDICAL REPORT</h2>
                                <hr>
                                
                                <div class="columns">
                                    <div class="column">
                                        <p><strong>Prisoner:</strong> ${prisonerText} (ID: ${prisonerId})</p>
                                        <p><strong>Appointment:</strong> #${appointmentId} (${appointmentStatus})</p>
                                        <p><strong>Appointment Date:</strong> ${appointmentDate}</p>
                                        <p><strong>Medical Officer:</strong> ${doctor}</p>
                                    </div>
                                    <div class="column">
                                        <p><strong>Report Date:</strong> ${reportDate}</p>
                                        <p><strong>Follow-Up Needed:</strong> ${followUp}</p>
                                        ${followUp === 'Yes' ? `<p><strong>Follow-Up Date:</strong> ${followUpDate}</p>` : ''}
                                    </div>
                                </div>
                                
                                <div class="content">
                                    <h4 class="title is-5">Diagnosis</h4>
                                    <p>${diagnosis.replace(/\n/g, '<br>')}</p>
                                    
                                    <h4 class="title is-5 mt-4">Treatment</h4>
                                    <p>${treatment.replace(/\n/g, '<br>')}</p>
                                    
                                    <h4 class="title is-5 mt-4">Medications</h4>
                                    <p>${medications.replace(/\n/g, '<br>')}</p>
                                    
                                    <h4 class="title is-5 mt-4">Additional Notes</h4>
                                    <p>${notes.replace(/\n/g, '<br>')}</p>
                                </div>
                                
                                <hr>
                                <p class="has-text-grey is-size-7 has-text-centered">
                                    Generated by Prison Management System on ${new Date().toLocaleString()}
                                </p>
                            </div>
                        `;
                        
                        document.getElementById('reportPreview').innerHTML = previewHTML;
                    }

                    // Notification function
                    function showNotification(message, type = 'success') {
                        const notification = document.createElement('div');
                        notification.className = `notification is-${type} is-light`;
                        notification.style.position = 'fixed';
                        notification.style.bottom = '20px';
                        notification.style.right = '20px';
                        notification.style.zIndex = '100';
                        
                        notification.innerHTML = `
                            <button class="delete"></button>
                            ${message}
                        `;
                        
                        document.body.appendChild(notification);
                        
                        notification.querySelector('.delete').addEventListener('click', () => {
                            notification.remove();
                        });
                        
                        setTimeout(() => {
                            notification.remove();
                        }, 5000);
                    }
                });
            </script>

        </div>
    </div>

    @include('includes.footer_js')
</body>

</html>