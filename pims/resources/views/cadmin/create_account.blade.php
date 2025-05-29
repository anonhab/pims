<!DOCTYPE html>
<html>

@include('includes.head')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
        }
 


        /* Header Styles */
     
        /* Sidebar Styles */
        .sidbar {
            position: fixed;
            top: var(--pims-nav-height);
            left: 0;
            width: var(--pims-sidebar-width);
            height: calc(100vh - var(--pims-nav-height));
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            overflow-y: auto;
            z-index: 900;
            transition: all 0.3s ease;
        }

      /* Main Content Area */
        #page-content {
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            padding-top: calc(var(--pims-nav-height) + 1.5rem);
            min-height: 100vh;
            transition: all 0.3s ease;
            background-color: #f0f2f5;
        }

       

        /* Multi-step form */
        .form-steps {
            display: none;
        }

        .form-steps.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Progress indicator */
        .progress-steps {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #ddd;
            z-index: 1;
        }

        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
            padding: 0 1.5rem;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            color: #666;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .step-label {
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
        }

        .step-indicator.active .step-number {
            background-color: var(--pims-accent);
            color: white;
        }

        .step-indicator.completed .step-number {
            background-color: var(--pims-success);
            color: white;
        }

        .step-indicator.active .step-label,
        .step-indicator.completed .step-label {
            color: var(--pims-primary);
            font-weight: 600;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .card-content {
            padding: 1.5rem;
        }

        .title {
            color: var(--pims-primary);
            margin-bottom: 1.5rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--pims-accent);
        }

        /* Form Elements */
        .field {
            margin-bottom: 1.25rem;
        }

        .label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--pims-secondary);
        }

        .input, .select select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .input:focus, .select select:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .select {
            display: block;
            width: 100%;
        }

        .select:not(.is-multiple):not(.is-loading)::after {
            border-color: var(--pims-accent);
        }

        /* File Upload */
        .file {
            display: flex;
            align-items: center;
        }

        .file-label {
            width: 100%;
        }

        .file-cta {
            background-color: var(--pims-primary);
            color: white;
            border-radius: var(--pims-border-radius);
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .file-cta:hover {
            background-color: var(--pims-secondary);
        }

        .file-icon {
            margin-right: 0.5rem;
        }

        /* Buttons */
        .button {
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .button.is-link {
            background-color: var(--pims-accent);
            color: white;
        }

        .button.is-link:hover {
            background-color: #2472a4;
            transform: translateY(-2px);
        }

        .button.is-light {
            background-color: #ecf0f1;
            color: var(--pims-text-dark);
        }

        .button.is-light:hover {
            background-color: #d5dbdb;
            transform: translateY(-2px);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        
        /* Responsive Layout */
        .columns {
            display: flex;
            flex-wrap: wrap;
            margin-left: -0.75rem;
            margin-right: -0.75rem;
            margin-top: -0.75rem;
        }

        .column {
            padding: 0.75rem;
            flex: 1;
            min-width: 0;
        }

        .is-half {
            flex: none;
            width: 50%;
        }

        .is-centered {
            justify-content: center;
        }

        @media (max-width: 768px) {
            .is-half {
                width: 100%;
            }

            #page-content {
                margin-left: 0;
                padding-left: 1.5rem;
            }

            .sidbar {
                transform: translateX(-100%);
            }

            .sidbar.is-active {
                transform: translateX(0);
            }
        }

        /* Form Validation Indicators */
        .is-danger {
            border-color: var(--pims-danger) !important;
        }

        .help.is-danger {
            color: var(--pims-danger);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
    </style>
<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="app-content">
        @include('cadmin.menu')

        <div class="column is-10" id="page-content">
        <section class="section">
            <div class="container">
                <!-- Progress Steps -->
                <div class="progress-steps">
                    <div class="step-indicator active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Account Info</div>
                    </div>
                    <div class="step-indicator" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Personal Info</div>
                    </div>
                </div>

                <form id="accountForm" action="{{ route('accounts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Step 1: Account Information -->
                    <div class="form-steps active" id="step1">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Account Information</p>

                                <div class="field">
                                    <label class="label">Username</label>
                                    <div class="control">
                                        <input class="input" type="text" name="username" placeholder="Enter username" required>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Password</label>
                                    <div class="control">
                                        <input class="input" type="password" name="password" placeholder="Enter password" required>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Prison</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="prison_id" required>
                                                <option value="" disabled selected>Select a prison</option>
                                                @foreach ($prisons as $prison)
                                                <option value="{{ $prison->id }}">
                                                    {{ $prison->name }} 
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="field">
                                    <label class="label">Role</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="role_id" required>
                                                <option value="" disabled selected>Select a role</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div></div> <!-- Empty div for spacing -->
                            <div class="control">
                                <button type="button" class="button is-link next-step" data-next="step2">Next <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Personal Information -->
                    <div class="form-steps" id="step2">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Personal Information</p>

                                <div class="field">
                                    <label class="label">First Name</label>
                                    <div class="control">
                                        <input class="input" type="text" name="first_name" placeholder="Enter first name" required>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Last Name</label>
                                    <div class="control">
                                        <input class="input" type="text" name="last_name" placeholder="Enter last name" required>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control">
                                        <input class="input" type="email" name="email" placeholder="Enter email address" required>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Phone Number</label>
                                    <div class="control">
                                        <input class="input" type="tel" name="phone_number" placeholder="Enter phone number">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Date of Birth</label>
                                    <div class="control">
                                        <input class="input" type="date" name="dob" required>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Gender</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="gender" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Address</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="address" required>
                                                <option value="" disabled selected>Select an address</option>
                                                <option value="Bahir Dar, Amhara-Mirab Gojam">Bahir Dar, Amhara-Mirab Gojam</option>
                                                <option value="Addis Ababa, Bole">Addis Ababa, Bole</option>
                                                <option value="Dire Dawa">Dire Dawa</option>
                                                <option value="Gonder">Gonder</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">User Image</p>
                                <div class="field">
                                    <div class="file has-name is-fullwidth">
                                        <label class="file-label">
                                            <input class="file-input" type="file" name="user_image" required>
                                            <span class="file-cta">
                                                <span class="file-icon">
                                                    <i class="fa fa-upload"></i>
                                                </span>
                                                <span class="file-label">
                                                    Upload Image…
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="control">
                                <button type="button" class="button is-light prev-step" data-prev="step1"><i class="fas fa-arrow-left"></i> Previous</button>
                            </div>
                            <div class="control">
                                <button class="button is-link" type="submit">Create Account</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>


    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4TVE6RNN41"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form step navigation
            const nextButtons = document.querySelectorAll('.next-step');
            const prevButtons = document.querySelectorAll('.prev-step');
            const steps = document.querySelectorAll('.form-steps');
            const stepIndicators = document.querySelectorAll('.step-indicator');
            
            // File input name display
            const fileInputs = document.querySelectorAll('.file-input');
            fileInputs.forEach(input => {
                input.addEventListener('change', (e) => {
                    const fileName = e.target.files[0]?.name || 'No file selected';
                    const fileLabel = e.target.nextElementSibling.querySelector('.file-label');
                    fileLabel.textContent = fileName;
                });
            });

            // Next button functionality
            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const currentStep = button.closest('.form-steps');
                    const nextStepId = button.getAttribute('data-next');
                    const nextStep = document.getElementById(nextStepId);
                    
                    // Validate current step before proceeding
                    let isValid = true;
                    const inputs = currentStep.querySelectorAll('input[required], select[required]');
                    inputs.forEach(input => {
                        if (!input.value) {
                            input.classList.add('is-danger');
                            isValid = false;
                        } else {
                            input.classList.remove('is-danger');
                        }
                    });
                    
                    if (isValid) {
                        currentStep.classList.remove('active');
                        nextStep.classList.add('active');
                        
                        // Update step indicators
                        const currentStepNum = parseInt(currentStep.id.replace('step', ''));
                        stepIndicators.forEach(indicator => {
                            const stepNum = parseInt(indicator.getAttribute('data-step'));
                            indicator.classList.remove('active', 'completed');
                            
                            if (stepNum < currentStepNum + 1) {
                                indicator.classList.add('completed');
                            } else if (stepNum === currentStepNum + 1) {
                                indicator.classList.add('active');
                            }
                        });
                        
                        // Scroll to top of form
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    } else {
                        showNotification('Please fill all required fields', 'error');
                    }
                });
            });

            // Previous button functionality
            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const currentStep = button.closest('.form-steps');
                    const prevStepId = button.getAttribute('data-prev');
                    const prevStep = document.getElementById(prevStepId);
                    
                    currentStep.classList.remove('active');
                    prevStep.classList.add('active');
                    
                    // Update step indicators
                    const currentStepNum = parseInt(currentStep.id.replace('step', ''));
                    stepIndicators.forEach(indicator => {
                        const stepNum = parseInt(indicator.getAttribute('data-step'));
                        indicator.classList.remove('active', 'completed');
                        
                        if (stepNum < currentStepNum) {
                            indicator.classList.add('completed');
                        } else if (stepNum === currentStepNum) {
                            indicator.classList.add('active');
                        }
                    });
                    
                    // Scroll to top of form
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });

           
       

        });
    </script>
      @include('includes.footer_js')
</body>
</html>
