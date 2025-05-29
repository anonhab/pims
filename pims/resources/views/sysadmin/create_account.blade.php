<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Create Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS -->
    <style>
        :root {
            --pims-primary: #2c3e50;
            --pims-secondary: #34495e;
            --pims-accent: #3498db;
            --pims-light: #ecf0f1;
            --pims-success: #2ecc71;
            --pims-danger: #e74c3c;
            --pims-border-radius: 8px;
            --pims-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
        }
        
        /* Main Layout */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            padding-top:60px;
        }
        
        /* Content Area */
        .pims-main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 250px; /* Matches sidebar width */
            transition: var(--pims-transition);
        }
        
        /* Form Container */
        .pims-form-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Form Steps */
        .pims-form-steps {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .pims-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 1.5rem;
            position: relative;
        }
        
        .pims-step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--pims-light);
            color: var(--pims-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 0.5rem;
            border: 2px solid var(--pims-light);
            transition: var(--pims-transition);
        }
        
        .pims-step.active .pims-step-number {
            background-color: var(--pims-accent);
            color: white;
            border-color: var(--pims-accent);
        }
        
        .pims-step.completed .pims-step-number {
            background-color: var(--pims-success);
            color: white;
            border-color: var(--pims-success);
        }
        
        .pims-step-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }
        
        .pims-step.active .pims-step-label {
            color: var(--pims-accent);
            font-weight: 600;
        }
        
        .pims-step.completed .pims-step-label {
            color: var(--pims-success);
        }
        
        .pims-step-connector {
            position: absolute;
            top: 20px;
            left: -50%;
            width: 100%;
            height: 2px;
            background-color: var(--pims-light);
            z-index: -1;
        }
        
        .pims-step-connector.active {
            background-color: var(--pims-accent);
        }
        
        .pims-step-connector.completed {
            background-color: var(--pims-success);
        }
        
        /* Form Sections */
        .pims-form-section {
            display: none;
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .pims-form-section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pims-section-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .pims-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
        }
        
        .pims-section-title i {
            margin-right: 0.75rem;
            color: var(--pims-accent);
        }
        
        .pims-section-description {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        
        /* Form Grid */
        .pims-form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        /* Form Fields */
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
        
        .pims-form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%232c3e50' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
        }
        
        .pims-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        /* File Upload */
        .pims-file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .pims-file-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
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
            text-align: center;
            transition: var(--pims-transition);
        }
        
        .pims-file-label:hover {
            border-color: var(--pims-accent);
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .pims-file-icon {
            font-size: 2rem;
            color: var(--pims-accent);
            margin-bottom: 0.5rem;
        }
        
        .pims-file-text {
            font-size: 0.9rem;
            color: var(--pims-secondary);
        }
        
        .pims-file-name {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: var(--pims-success);
            font-weight: 500;
        }
        
        /* Form Navigation */
        .pims-form-nav {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }
        
        .pims-btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-family: inherit;
            font-size: 1rem;
        }
        
        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }
        
        .pims-btn-primary:hover {
            background-color: #2980b9;
        }
        
        .pims-btn-outline {
            background-color: transparent;
            border: 1px solid var(--pims-accent);
            color: var(--pims-accent);
        }
        
        .pims-btn-outline:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
        
        .pims-btn-light {
            background-color: var(--pims-light);
            color: var(--pims-secondary);
        }
        
        .pims-btn-light:hover {
            background-color: #dfe6e9;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .pims-form-grid {
                grid-template-columns: 1fr;
            }
            
            .pims-main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .pims-step {
                padding: 0 0.75rem;
            }
            
            .pims-step-label {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="pims-app-container">
        <!-- Navigation will be included here -->
        @include('includes.nav')
        
        <!-- Sidebar will be included here -->
        @include('sysadmin.menu')
        
        <main class="pims-main-content">
            <div class="pims-form-container">
                <form action="{{ route('accounts.store') }}" method="POST" enctype="multipart/form-data" id="accountForm">
                    @csrf
                    
                    <!-- Form Steps -->
                    <div class="pims-form-steps">
                        <div class="pims-step active" id="step1-indicator">
                            <div class="pims-step-number">1</div>
                            <span class="pims-step-label">Account Information</span>
                            <div class="pims-step-connector"></div>
                        </div>
                        
                        <div class="pims-step" id="step2-indicator">
                            <div class="pims-step-number">2</div>
                            <span class="pims-step-label">Personal Information</span>
                            <div class="pims-step-connector"></div>
                        </div>
                    </div>
                    
                    <!-- Step 1: Account Information -->
                    <div class="pims-form-section active" id="step1">
                        <div class="pims-section-header">
                            <h2 class="pims-section-title">
                                <i class="fas fa-user-circle"></i> Account Information
                            </h2>
                            <p class="pims-section-description">
                                Please provide the basic account credentials and role assignment.
                            </p>
                        </div>
                        
                        <div class="pims-form-grid">
                            <div class="pims-form-group">
                                <label for="username" class="pims-form-label">Username</label>
                                <input type="text" id="username" name="username" class="pims-form-control" placeholder="Enter username" required>
                            </div>
                            
                            <div class="pims-form-group">
                                <label for="password" class="pims-form-label">Password</label>
                                <input type="password" id="password" name="password" class="pims-form-control" placeholder="Enter password" required>
                            </div>
                            
                            <div class="pims-form-group">
                                <label for="role_id" class="pims-form-label">Role</label>
                                <select id="role_id" name="role_id" class="pims-form-control pims-form-select" required>
                                    <option value="" disabled selected>Select a role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">
                        </div>
                        
                        <div class="pims-form-nav">
                            <div></div> <!-- Empty div for spacing -->
                            <button type="button" class="pims-btn pims-btn-primary" onclick="nextStep()">Continue <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Personal Information -->
                    <div class="pims-form-section" id="step2">
                        <div class="pims-section-header">
                            <h2 class="pims-section-title">
                                <i class="fas fa-id-card"></i> Personal Information
                            </h2>
                            <p class="pims-section-description">
                                Please provide the personal details for this account.
                            </p>
                        </div>
                        
                        <div class="pims-form-grid">
                            <div class="pims-form-group">
                                <label for="first_name" class="pims-form-label">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="pims-form-control" placeholder="Enter first name" required>
                            </div>
                            
                            <div class="pims-form-group">
                                <label for="last_name" class="pims-form-label">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="pims-form-control" placeholder="Enter last name" required>
                            </div>
                            
                            <div class="pims-form-group">
                                <label for="email" class="pims-form-label">Email</label>
                                <input type="email" id="email" name="email" class="pims-form-control" placeholder="Enter email address" required>
                            </div>
                            
                            <div class="pims-form-group">
                                <label for="phone_number" class="pims-form-label">Phone Number</label>
                                <input type="tel" id="phone_number" name="phone_number" class="pims-form-control" placeholder="Enter phone number">
                            </div>
                            
                            <div class="pims-form-group">
                                <label for="dob" class="pims-form-label">Date of Birth</label>
                                <input type="date" id="dob" name="dob" class="pims-form-control" required>
                            </div>
                            
                            <div class="pims-form-group">
                                <label for="gender" class="pims-form-label">Gender</label>
                                <select id="gender" name="gender" class="pims-form-control pims-form-select" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>
                            
                            <div class="pims-form-group" style="grid-column: span 2;">
                                <label for="address" class="pims-form-label">Address</label>
                                <textarea id="address" name="address" class="pims-form-control pims-textarea" placeholder="Enter address" required></textarea>
                            </div>
                        </div>
                        
                        <div class="pims-form-group" style="margin-top: 1.5rem;">
                            <label class="pims-form-label">User Image</label>
                            <div class="pims-file-upload">
                                <input type="file" id="user_image" name="user_image" class="pims-file-input" required>
                                <label for="user_image" class="pims-file-label">
                                    <div>
                                        <i class="fas fa-cloud-upload-alt pims-file-icon"></i>
                                        <div class="pims-file-text">Click to upload profile image</div>
                                        <div class="pims-file-name" id="file-name"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="pims-form-nav">
                            <button type="button" class="pims-btn pims-btn-outline" onclick="prevStep()">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <div>
                                <button type="reset" class="pims-btn pims-btn-light">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                                <button type="submit" class="pims-btn pims-btn-primary">
                                    <i class="fas fa-save"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Form step navigation
        function nextStep() {
            // Validate step 1 first
            const step1Valid = validateStep1();
            if (step1Valid) {
                document.getElementById('step1').classList.remove('active');
                document.getElementById('step2').classList.add('active');
                
                document.getElementById('step1-indicator').classList.remove('active');
                document.getElementById('step1-indicator').classList.add('completed');
                document.getElementById('step2-indicator').classList.add('active');
                
                document.querySelector('#step1-indicator .pims-step-connector').classList.add('completed');
            }
        }
        
        function prevStep() {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step1').classList.add('active');
            
            document.getElementById('step2-indicator').classList.remove('active');
            document.getElementById('step1-indicator').classList.add('active');
            document.getElementById('step1-indicator').classList.remove('completed');
            
            document.querySelector('#step1-indicator .pims-step-connector').classList.remove('completed');
        }
        
        function validateStep1() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role_id').value;
            
            if (!username || !password || !role) {
                Swal.fire({
                    icon: 'error',
                    title: 'Incomplete Information',
                    text: 'Please fill in all required fields in the Account Information section',
                    confirmButtonColor: '#3498db'
                });
                return false;
            }
            
            return true;
        }
        
        // File upload display
        document.getElementById('user_image').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file selected';
            document.getElementById('file-name').textContent = fileName;
        });
        
        // Form submission handling
        document.getElementById('accountForm').addEventListener('submit', function(e) {
            // You can add additional validation here if needed
            // Form will submit normally if all is well
        });
    </script>
</body>
</html>