<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Release Prisoner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        /* Header Styles */
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

        /* Card Styles */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .pims-card-header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 1.25rem 1.5rem;
        }

        .pims-card-header h5 {
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.5rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }

        .pims-form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--pims-transition);
            background-color: white;
            cursor: pointer;
        }

        .pims-form-select:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .pims-form-check {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .pims-form-check-input {
            margin-right: 0.75rem;
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
        }

        .pims-form-check-label {
            cursor: pointer;
        }

        /* Button Styles */
        .pims-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-size: 1rem;
            gap: 0.5rem;
        }

        .pims-btn i {
            font-size: 0.9em;
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
            background-color: #27ae60;
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #c0392b;
        }

        /* Alert Messages */
        .pims-alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--pims-border-radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
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

        .pims-alert-warning {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--pims-warning);
            border-left: 4px solid var(--pims-warning);
        }

        .pims-alert-info {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--pims-accent);
            border-left: 4px solid var(--pims-accent);
        }

        .pims-alert-hidden {
            display: none;
        }

        /* Action Buttons */
        .pims-action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .pims-action-buttons {
                flex-direction: column;
                gap: 1rem;
            }
            
            .pims-btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .pims-card-body {
                padding: 1rem;
            }
            
            .pims-page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="pims-app-container">
        <!-- Navigation -->
        @include('includes.nav')
        
        <!-- Sidebar -->
        @include('police_commisioner.menu')
        
        <main class="pims-main-content">
            <div class="pims-content-container">
                <!-- Page Header -->
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-user-check"></i> Release Prisoner
                    </h2>
                </div>
                
                <!-- Main Card -->
                <div class="pims-card">
                    <div class="pims-card-header">
                        <h5>Release Prisoners</h5>
                    </div>
                    
                    <div class="pims-card-body">
                        <!-- System Message -->
                        <div id="pims-system-message" class="pims-alert pims-alert-hidden"></div>
                        
                        <!-- Prisoner Selection -->
                        <div class="pims-form-group">
                            <label for="pims-prisoner-select" class="pims-form-label">Select Prisoner</label>
                            <select id="pims-prisoner-select" class="pims-form-select">
                                <option value="">-- Select a Prisoner --</option>
                                <option value="1">John Doe - #P102</option>
                                <option value="2">Jane Smith - #P103</option>
                                <option value="3">Ali Yusuf - #P104</option>
                            </select>
                        </div>
                        
                        <!-- Legal Requirements Checklist -->
                        <div class="pims-form-group">
                            <h6 style="margin-bottom: 1rem; font-weight: 500; color: var(--pims-primary);">Verify Legal Requirements</h6>
                            
                            <div class="pims-form-check">
                                <input class="pims-form-check-input" type="checkbox" id="pims-sentence-completed">
                                <label class="pims-form-check-label" for="pims-sentence-completed">Sentence Completed</label>
                            </div>
                            
                            <div class="pims-form-check">
                                <input class="pims-form-check-input" type="checkbox" id="pims-no-pending-cases">
                                <label class="pims-form-check-label" for="pims-no-pending-cases">No Pending Legal Cases</label>
                            </div>
                            
                            <div class="pims-form-check">
                                <input class="pims-form-check-input" type="checkbox" id="pims-behavior-approved">
                                <label class="pims-form-check-label" for="pims-behavior-approved">Good Behavior Report Available</label>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="pims-action-buttons">
                            <button class="pims-btn pims-btn-secondary" onclick="window.history.back()">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </button>
                            <button class="pims-btn pims-btn-success" onclick="pimsAttemptRelease()">
                                <i class="fas fa-check-circle"></i> Release Prisoner
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function pimsAttemptRelease() {
            const sentence = document.getElementById('pims-sentence-completed').checked;
            const cases = document.getElementById('pims-no-pending-cases').checked;
            const behavior = document.getElementById('pims-behavior-approved').checked;
            const prisoner = document.getElementById('pims-prisoner-select').value;
            const messageBox = document.getElementById('pims-system-message');

            // Reset message box
            messageBox.className = 'pims-alert pims-alert-hidden';
            messageBox.innerHTML = '';

            if (!prisoner) {
                pimsShowMessage('Please select a prisoner.', 'danger');
                return;
            }

            if (sentence && cases && behavior) {
                // Simulate release success (in a real app, you would submit a form or use AJAX here)
                pimsShowMessage('Prisoner released successfully and system updated.', 'success');
                
                // Reset form
                document.getElementById('pims-prisoner-select').value = '';
                document.getElementById('pims-sentence-completed').checked = false;
                document.getElementById('pims-no-pending-cases').checked = false;
                document.getElementById('pims-behavior-approved').checked = false;
            } else {
                // Ineligible for release
                pimsShowMessage('Prisoner is not eligible for release. Please check all conditions.', 'warning');
            }
        }

        function pimsShowMessage(message, type) {
            const box = document.getElementById('pims-system-message');
            box.textContent = message;
            box.className = `pims-alert pims-alert-${type}`;
            
            // Add appropriate icon
            const icon = document.createElement('i');
            switch(type) {
                case 'success':
                    icon.className = 'fas fa-check-circle';
                    break;
                case 'danger':
                    icon.className = 'fas fa-exclamation-circle';
                    break;
                case 'warning':
                    icon.className = 'fas fa-exclamation-triangle';
                    break;
                default:
                    icon.className = 'fas fa-info-circle';
            }
            
            box.prepend(icon);
        }
    </script>
    
    @include('includes.footer_js')
</body>
</html>