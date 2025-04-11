<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Prisoner Appointments</title>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
     
     <!-- Bootstrap CSS (Add this in the <head> section) -->
 
<!-- Bootstrap JS (Add this before closing </body> tag) -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Basic Layout */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
        }

        .pims-report-container {
            flex-grow: 1;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .pims-report-title {
            font-size: 2rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .pims-report-title i {
            margin-right: 10px;
        }

        /* Tabs Styling */
        .pims-tabs {
            display: flex;
            margin-bottom: 20px;
        }

        .pims-tablink {
            background-color: #ddd;
            border: 1px solid #ccc;
            padding: 10px 20px;
            margin-right: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .pims-tablink i {
            margin-right: 5px;
        }

        .pims-tablink.active {
            background-color: #007bff;
            color: white;
        }

        .pims-tablink:hover {
            background-color: #ccc;
        }

        /* Cards Styling */
        .pims-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .pims-appointment-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 10px;
        }

        .card-body {
            padding: 15px;
        }

        .card-field {
            display: flex;
            margin-bottom: 10px;
        }

        .card-label {
            font-weight: bold;
            width: 120px;
        }

        .card-value {
            color: #555;
        }

        .card-footer {
            padding: 10px;
            background-color: #f1f1f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .pims-status-pending {
            background-color: #ffcc00;
            color: #6a5b3c;
        }

        .pims-status-approved {
            background-color: #28a745;
            color: white;
        }

        .pims-status-rejected {
            background-color: #dc3545;
            color: white;
        }

        .pims-btn {
            padding: 6px 12px;
            font-size: 0.9rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .pims-btn-primary {
            background-color: #007bff;
            color: white;
        }

        .pims-btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .pims-btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .pims-btn-small {
            padding: 4px 8px;
            font-size: 0.8rem;
        }

        .pims-btn:hover {
            opacity: 0.8;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal h2 {
            margin-bottom: 20px;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            opacity: 0.8;
        }

        /* Card Text Search */
        .pims-appointment-card {
            display: block;
        }

        .pims-appointment-card.hidden {
            display: none;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .pims-tabs {
                flex-direction: column;
            }

            .pims-appointment-card {
                width: 100%;
            }
        }
    </style>
</head>
<!-- Modal Styles -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

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
                <button class="pims-tablink active" onclick="pimsOpenReport(event, 'medicalAppointments')">
                    <i class="fas fa-stethoscope"></i> Medical
                </button>
                <button class="pims-tablink" onclick="pimsOpenReport(event, 'lawyerAppointments')">
                    <i class="fas fa-balance-scale"></i> Lawyer
                </button>
                <button class="pims-tablink" onclick="pimsOpenReport(event, 'visitorAppointments')">
                    <i class="fas fa-user-friends"></i> Visitor
                </button>
            </div>

            <!-- Medical Appointments -->
            <div id="medicalAppointments" class="pims-report-content" style="display: block;">
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
                                <span class="card-value">{{ $appointment->appointment_date }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Doctor:</span>
                                <span class="card-value">{{ $appointment->doctor->name }}</span>
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
                                onclick="updateStatus(this)">
                                <i class="fas fa-{{ $appointment->status == 'Pending' ? 'edit' : 'eye' }}"></i>
                                {{ $appointment->status == 'Pending' ? 'Update' : 'View' }}
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Lawyer Appointments -->
            <div id="lawyerAppointments" class="pims-report-content">
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
                                <span class="card-value">{{ $appointment->appointment_date }}</span>
                            </div>
                            <div class="card-field">
                                <span class="card-label">Lawyer:</span>
                                <span class="card-value">{{ $appointment->lawyer->name }}</span>
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
                                onclick="updateStatus(this)">
                                <i class="fas fa-{{ $appointment->status == 'Pending' ? 'edit' : 'eye' }}"></i>
                                {{ $appointment->status == 'Pending' ? 'Update' : 'View' }}
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
 <!-- Visitor Appointments -->
<div id="visitorAppointments" class="pims-report-content">
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
                        {{ $appointment->prisoner_firstname }} {{ $appointment->prisoner_middlename }} {{ $appointment->prisoner_lastname }} ({{ $appointment->prison->name }})
                        <!-- Add a button to check prisoner and open modal -->
                        <button data-bs-toggle="modal" data-bs-target="#checkPrisonerModal" onclick="openPrisonerModal(
                            '{{ $appointment->prisoner_firstname }}',
                            '{{ $appointment->prisoner_middlename }}',
                            '{{ $appointment->prisoner_lastname }}'
                        )">Check Prisoner</button>
                    </span>
                </div>
                <div class="card-field">
                    <span class="card-label">Visitor:</span>
                    <span class="card-value">{{ $appointment->visitor->first_name }} {{ $appointment->visitor->last_name }}</span>
                </div>
                <div class="card-field">
                    <span class="card-label">Date:</span>
                    <span class="card-value">{{ $appointment->requested_date }}</span>
                </div>
                <div class="card-field">
                    <span class="card-label">Time:</span>
                    <span class="card-value">{{ $appointment->requested_time }}</span>
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
                    <i class="fas fa-{{ $appointment->status == 'Pending' ? 'clock' : ($appointment->status == 'Approved' ? 'check' : 'times') }}"></i>
                    {{ $appointment->status }}
                </span>
                <button class="pims-btn pims-btn-small {{ $appointment->status == 'pending' ? 'pims-btn-primary' : 'pims-btn-danger' }}"
                        onclick="openStatusModal('{{ $appointment->id }}', '{{ $appointment->status }}')">
                    <i class="fas fa-{{ $appointment->status == 'Pending' ? 'edit' : 'search' }}"></i>
                    {{ $appointment->status == 'Pending' ? 'Update' : 'Review' }}
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal for Changing Status -->
<div id="statusModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeStatusModal()">&times;</span>
        <h2>Change Appointment Status</h2>
        <form id="statusForm" method="POST" action="{{ route('updateAppointmentStatus') }}">
            @csrf
            <input type="hidden" id="appointment_id" name="appointment_id">
            <div class="form-group">
                <label for="status">Select Status</label>
                <select id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <button type="submit" class="pims-btn pims-btn-primary">Update Status</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="checkPrisonerModal" tabindex="-1" aria-labelledby="checkPrisonerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkPrisonerModalLabel">Check Prisoner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="modalFirstName">First Name:</label>
                    <input type="text" id="modalFirstName" class="form-control" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label for="modalMiddleName">Middle Name:</label>
                    <input type="text" id="modalMiddleName" class="form-control" placeholder="Enter Middle Name">
                </div>
                <div class="form-group">
                    <label for="modalLastName">Last Name:</label>
                    <input type="text" id="modalLastName" class="form-control" placeholder="Enter Last Name">
                </div>

                <!-- Hidden fields to store the original data -->
                <input type="hidden" id="originalFirstName">
                <input type="hidden" id="originalMiddleName">
                <input type="hidden" id="originalLastName">

                <!-- Result Message -->
                <div id="resultMessage" class="mt-2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="checkButton" onclick="comparePrisonerDetails()">Check</button>
            </div>
        </div>
    </div>
</div>

<!-- Button to trigger modal -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkPrisonerModal" onclick="openPrisonerModal('John', 'Doe', 'Smith')">Check Prisoner</button>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components like modals) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- <script>
    // Function to open the modal and populate it with prisoner data
    function openPrisonerModal(prisonerFirstName, prisonerMiddleName, prisonerLastName) {
        // Set the values in the modal inputs
        document.getElementById('modalFirstName').value = prisonerFirstName;
        document.getElementById('modalMiddleName').value = prisonerMiddleName;
        document.getElementById('modalLastName').value = prisonerLastName;

        // Store the original data in hidden fields for comparison
        document.getElementById('originalFirstName').value = prisonerFirstName;
        document.getElementById('originalMiddleName').value = prisonerMiddleName;
        document.getElementById('originalLastName').value = prisonerLastName;

        // Clear previous result message
        document.getElementById('resultMessage').innerHTML = '';
    }

    // Function to compare the entered data with the original data
    function comparePrisonerDetails() {
        const enteredFirstName = document.getElementById('modalFirstName').value.trim();
        const enteredMiddleName = document.getElementById('modalMiddleName').value.trim();
        const enteredLastName = document.getElementById('modalLastName').value.trim();

        // Send an AJAX request to validate the prisoner data with the backend
        fetch('{{ route('validatePrisoner') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                first_name: enteredFirstName,
                middle_name: enteredMiddleName,
                last_name: enteredLastName
            })
        })
        .then(response => response.json())
        .then(data => {
            // Display feedback based on response
            const resultMessage = document.getElementById('resultMessage');
            if (data.status === 'success') {
                resultMessage.textContent = data.message;
                resultMessage.style.color = "green";
            } else {
                resultMessage.textContent = data.message;
                resultMessage.style.color = "red";
            }
        })
        .catch(error => {
            console.error('Error validating prisoner:', error);
            alert('There was an error validating the prisoner data.');
        });
    }

    // Optional: Close the modal programmatically
    function closeModal() {
        var myModal = new bootstrap.Modal(document.getElementById('checkPrisonerModal'));
        myModal.hide();
    }
</script> -->



    <script>
        // Tab switching function
        function pimsOpenReport(evt, reportName) {
            let i, reportContent, tablinks;
            reportContent = document.getElementsByClassName("pims-report-content");
            for (i = 0; i < reportContent.length; i++) {
                reportContent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("pims-tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(reportName).style.display = "block";
            evt.currentTarget.classList.add("active");
        }

        // Update status function (placeholder)
        function updateStatus(button) {
            const card = button.closest('.pims-appointment-card');
            const prisonerName = card.querySelector('.card-field:nth-child(1) .card-value').textContent.trim();
            alert(`Update status for ${prisonerName}`);
            // Implement your actual status update logic here
        }

        // Search functionality would need to be adapted for card view
        function pimsSearchCards(searchTerm) {
            const cards = document.querySelectorAll('.pims-appointment-card');
            searchTerm = searchTerm.toLowerCase();

            cards.forEach(card => {
                const cardText = card.textContent.toLowerCase();
                if (cardText.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
    

    @include('includes.footer_js')
</body>

</html>