<!DOCTYPE html>
@include('includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PIMS - Prisoner Management</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --pims-primary: #1a2a3a;
        /* Darker blue for more authority */
        --pims-secondary: #2c3e50;
        --pims-accent: #2980b9;
        /* Slightly darker blue */
        --pims-danger: #c0392b;
        /* Darker red */
        --pims-success: #27ae60;
        /* Darker green */
        --pims-warning: #d35400;
        /* Darker orange */
        --pims-text-light: #ecf0f1;
        --pims-text-dark: #2c3e50;
        --pims-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        --pims-border-radius: 6px;
        --pims-nav-height: 60px;
        --pims-sidebar-width: 250px;
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
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    /* Header Styles */
    .header {
        color: white;
        z-index: 1000;
        display: flex;
        align-items: center;
        top: 0;
    }

    /* Sidebar Styles */
    .sidbar {
        position: fixed;
        top: var(--pims-nav-height);
        left: 0;
        width: var(--pims-sidebar-width);
        height: calc(100vh - var(--pims-nav-height));
        background: white;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        overflow-y: auto;
        z-index: 900;
        transition: all 0.3s ease;
    }

    /* Main Content Area */
    #pims-page-content {
        margin-left: 0;
        padding: 1.5rem;
        padding-left: 300px;
        padding-top: 100px;
        min-height: calc(100vh - var(--pims-nav-height));
        transition: all 0.3s ease;
        background-color: #f0f2f5;
    }


    /* Form Styles */
    .pims-form-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .pims-form-section {
        margin-bottom: 2rem;
    }

    .pims-form-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--pims-primary);
        position: relative;
        padding-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .pims-form-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: var(--pims-accent);
    }

    .pims-form-title i {
        margin-right: 10px;
        color: var(--pims-accent);
    }

    .pims-form-card {
        background: white;
        border-radius: var(--pims-border-radius);
        box-shadow: var(--pims-card-shadow);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--pims-accent);
    }

    .pims-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .pims-form-group {
        margin-bottom: 1.25rem;
    }

    .pims-form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--pims-secondary);
    }

    .pims-form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: var(--pims-border-radius);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .pims-form-input:focus {
        border-color: var(--pims-accent);
        box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.1);
        outline: none;
    }

    .pims-form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: var(--pims-border-radius);
        font-size: 1rem;
        background-color: white;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1em;
    }

    .pims-form-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: var(--pims-border-radius);
        font-size: 1rem;
        min-height: 100px;
        resize: vertical;
    }

    .pims-file-upload {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .pims-file-input {
        position: absolute;
        left: 0;
        top: 0;
        
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .pims-file-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        border: 2px dashed #ddd;
        border-radius: var(--pims-border-radius);
        background-color: #f9f9f9;
        text-align: center;
        transition: all 0.3s ease;
    }

    .pims-file-label:hover {
        border-color: var(--pims-accent);
        background-color: rgba(41, 128, 185, 0.05);
    }

    .pims-file-icon {
        margin-right: 0.75rem;
        color: var(--pims-accent);
        font-size: 1.5rem;
    }

    .pims-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    .pims-btn {
        padding: 0.75rem 1.5rem;
        border-radius: var(--pims-border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }

    .pims-btn-primary {
        background-color: var(--pims-accent);
        color: white;
    }

    .pims-btn-primary:hover {
        background-color: #2472a4;
        transform: translateY(-2px);
    }

    .pims-btn-secondary {
        background-color: #ecf0f1;
        color: var(--pims-secondary);
    }

    .pims-btn-secondary:hover {
        background-color: #dfe6e9;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #pims-page-content {
            margin-left: 0;
            padding: 1rem;
        }

        .pims-form-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 100px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
        border-radius: 8px;
    }

    .modal-header,
    .modal-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        margin: 0;
    }

    .modal-close {
        background: transparent;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .modal-footer button {
        padding: 8px 16px;
        font-size: 16px;
        cursor: pointer;
    }
</style>

<body>
    <!-- NAV -->
    @include('includes.nav')

    <!-- Sidebar -->
    @include('inspector.menu')

    <!-- Main Content -->
    <div id="pims-page-content">
        <div class="pims-form-container">
            <h1 class="pims-form-title">
                <i class="fas fa-user-lock"></i> Prisoner Registration
            </h1>

            <form action="{{ route('prisoners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">

                <div class="pims-form-grid">
                    <!-- Personal Information -->
                    <div class="pims-form-card">
                        <h2 class="pims-form-title is-size-4">
                            <i class="fas fa-id-card"></i> Personal Information
                        </h2>

                        <div class="pims-form-group">
                            <label class="pims-form-label">First Name</label>
                            <input class="pims-form-input" type="text" name="first_name" placeholder="Enter first name" required>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Middle Name</label>
                            <input class="pims-form-input" type="text" name="middle_name" placeholder="Enter middle name">
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Last Name</label>
                            <input class="pims-form-input" type="text" name="last_name" placeholder="Enter last name" required>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Birthday</label>
                            <input class="pims-form-input" type="date" name="dob" required>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Sex</label>
                            <select class="pims-form-select" name="sex" required>
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- Additional Personal Info -->
                    <div class="pims-form-card">
                        <h2 class="pims-form-title is-size-4">
                            <i class="fas fa-info-circle"></i> Additional Information
                        </h2>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Address</label>
                            <textarea class="pims-form-textarea" name="address" placeholder="Enter address" required></textarea>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Marital Status</label>
                            <select class="pims-form-select" name="marital_status" required>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Inmate Image</label>
                            <div class="pims-file-upload">
                                <input class="pims-file-input" type="file" name="inmate_image" required>
                                <label class="pims-file-label">
                                    <i class="fas fa-camera pims-file-icon"></i>
                                    <span>Click to upload inmate photo</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Case Details -->
                <div class="pims-form-card">
                    <h2 class="pims-form-title is-size-4">
                        <i class="fas fa-gavel"></i> Case Details
                    </h2>

                    <div class="pims-form-grid">
                    <div class="pims-form-group">
    <label class="pims-form-label">Crime Committed</label>
    <select class="pims-form-select" name="crime_committed" id="crime_committed" required>
        <option value="" disabled selected>Select Offense</option>
        <option value="Theft">Theft</option>
        <option value="Assault">Assault</option>
        <option value="Drug Possession">Drug Possession</option>
        <option value="Fraud">Fraud</option>
        <option value="Murder">Murder</option>
        <option value="Burglary">Burglary</option>
        <option value="Vandalism">Vandalism</option>
        <option value="Robbery">Robbery</option>
        <option value="Domestic Violence">Domestic Violence</option>
        <option value="Rape">Rape</option>
        <option value="Arson">Arson</option>
        <option value="Money Laundering">Money Laundering</option>
        <option value="Kidnapping">Kidnapping</option>
        <option value="Tax Evasion">Tax Evasion</option>
        <option value="Embezzlement">Embezzlement</option>
        <option value="Corruption">Corruption</option>
        <option value="Hate Crimes">Hate Crimes</option>
        <option value="Smuggling">Smuggling</option>
        <option value="Child Abuse">Child Abuse</option>
        <option value="Bribery">Bribery</option>
        <option value="Counterfeiting">Counterfeiting</option>
        <option value="Terrorism">Terrorism</option>
        <option value="Sexual Harassment">Sexual Harassment</option>
        <option value="Public Disorder">Public Disorder</option>
        <option value="Other">Other (for any crime not listed above)</option>
    </select>
</div>

<!-- Input field for custom crime, hidden by default -->
<div class="pims-form-group" id="other-crime-group" style="display: none;">
    <label class="pims-form-label">Please specify the crime</label>
    <input type="text" class="pims-form-input" name="other_crime" id="other_crime" placeholder="Enter crime">
</div>



                        <div class="pims-form-group">
                            <label class="pims-form-label">Status</label>
                            <select class="pims-form-select" name="status" required>
                                <option value="active" selected hidden>Active</option>
                            </select>

                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Time Serve Start</label>
                            <input class="pims-form-input" type="date" name="time_serve_start" id="time_serve_start" required onchange="openModal()">
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Time Serve Ends</label>
                            <input class="pims-form-input" type="text" name="time_serve_end" id="time_serve_end" required readonly>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="pims-form-card">
                    <h2 class="pims-form-title is-size-4">
                        <i class="fas fa-phone-alt"></i> Emergency Contact
                    </h2>

                    <div class="pims-form-grid">
                        <div class="pims-form-group">
                            <label class="pims-form-label">Name</label>
                            <input class="pims-form-input" type="text" name="emergency_contact_name" placeholder="Enter emergency contact name" required>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Relation</label>
                            <input class="pims-form-input" type="text" name="emergency_contact_relation" placeholder="Enter relation" required>
                        </div>

                        <div class="pims-form-group">
                            <label class="pims-form-label">Contact #</label>
                            <input class="pims-form-input" type="tel" name="emergency_contact_number" placeholder="Enter contact number" required>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pims-form-actions">
                    <button class="pims-btn pims-btn-secondary" type="reset">Reset</button>
                    <button class="pims-btn pims-btn-primary" type="submit">Register Prisoner</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div id="sentenceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Enter Sentence Duration</h2>
                <button class="modal-close" onclick="closeModal()">×</button>
            </div>
            <div>
                <label for="durationInput">Enter duration in years, or type "life" or "death":</label>
                <input type="text" id="durationInput" class="pims-form-input" placeholder="e.g., 10 or life or death">
            </div>
            <div class="modal-footer">
                <button onclick="setEndDate()">Set End Date</button>
                <button onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>
    <script>
    // JavaScript to show input field when "Other" is selected
    document.getElementById('crime_committed').addEventListener('change', function() {
        var otherOption = this.value === 'Other';
        var otherCrimeGroup = document.getElementById('other-crime-group');
        otherCrimeGroup.style.display = otherOption ? 'block' : 'none';
    });
</script>

    <script>
        // Open the modal when the "Time Serve Start" date is selected
        function openModal() {
            const modal = document.getElementById("sentenceModal");
            modal.style.display = "block";
        }

        // Close the modal
        function closeModal() {
            const modal = document.getElementById("sentenceModal");
            modal.style.display = "none";
        }

        // Set the end date based on the input
        function setEndDate() {
            const startDate = document.getElementById("time_serve_start").value;
            const endDateField = document.getElementById("time_serve_end");
            const durationInput = document.getElementById("durationInput").value;

            if (!startDate || !durationInput) return;

            let endDate = new Date(startDate);

            if (durationInput.toLowerCase() === "life") {
                endDateField.value = "Life Sentence";
                endDateField.readOnly = true;
                closeModal();
                return;
            }
            if (durationInput.toLowerCase() === "death") {
                endDateField.value = "Death Sentence";
                endDateField.readOnly = true;
                closeModal();
                return;
            }

            let years = parseInt(durationInput);
            if (isNaN(years) || years <= 0) {
                alert("Invalid input! Please enter a valid number of years.");
                return;
            }

            endDate.setFullYear(endDate.getFullYear() + years);
            endDateField.value = endDate.toISOString().split("T")[0];
            endDateField.readOnly = true;
            closeModal();
        }
    </script>


    @include('includes.footer_js')

    <script>
        // File upload preview (optional enhancement)
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.querySelector('.pims-file-input');
            const fileLabel = document.querySelector('.pims-file-label span');

            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        fileLabel.textContent = this.files[0].name;
                    }
                });
            }
        });
    </script>
</body>

</html>