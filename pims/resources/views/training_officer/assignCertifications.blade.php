<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Certification Management</title>
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

        .pims-app-container {
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

        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pims-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
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

        .pims-form-group {
            margin-bottom: 1.5rem;
        }

        .pims-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--pims-secondary);
        }

        .pims-input, .pims-textarea, .pims-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 0.9rem;
            transition: var(--pims-transition);
        }

        .pims-input:focus, .pims-textarea:focus, .pims-select:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .pims-select-wrapper {
            position: relative;
        }

        .pims-select-wrapper i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-secondary);
        }

        .pims-select {
            padding-left: 2.5rem;
        }

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
            font-size: 0.9rem;
            gap: 0.5rem;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
        }

        .pims-btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .pims-btn-secondary {
            background-color: var(--pims-light);
            color: var(--pims-secondary);
        }

        .pims-btn-secondary:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        .pims-notification {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--pims-border-radius);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .pims-notification-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-notification-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

        .pims-notification-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: inherit;
        }

        .pims-prisoner-details {
            border-left: 4px solid var(--pims-accent);
            margin-top: 1.5rem;
        }

        .pims-activity-box {
            background-color: var(--pims-lighter);
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-radius: var(--pims-border-radius);
            border-left: 3px solid var(--pims-success);
        }

        .pims-activity-title {
            font-weight: 600;
            color: var(--pims-secondary);
            margin-bottom: 0.25rem;
        }

        .pims-activity-date {
            font-size: 0.8rem;
            color: var(--pims-accent);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims-text-center {
            text-align: center;
        }

        .pims-spinner {
            width: 1.5rem;
            height: 1.5rem;
            border: 0.25rem solid rgba(52, 152, 219, 0.2);
            border-top-color: var(--pims-accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .pims-hidden {
            display: none !important;
        }

        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .pims-columns {
                flex-direction: column;
            }
            
            .pims-column-half {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="pims-app-container">
        @include('training_officer.menu')
        <main class="pims-main-content">
            <div class="pims-content-container">
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-certificate"></i> Certification Management
                    </h2>
                </div>

                @if(session('success'))
                    <div class="pims-notification pims-notification-success">
                        <div>
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                        <button class="pims-notification-close">&times;</button>
                    </div>
                @endif

                @if($errors->any()))
                    <div class="pims-notification pims-notification-danger">
                        <div>
                            <i class="fas fa-exclamation-circle"></i>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button class="pims-notification-close">&times;</button>
                    </div>
                @endif

                <form action="{{ route('training_officer.storeCertification') }}" method="POST">
                    @csrf
                    <div class="pims-columns">
                        <div class="pims-column-half">
                            <div class="pims-card">
                                <div class="pims-card-header">
                                    <h5>Certification Information</h5>
                                </div>
                                <div class="pims-card-body">
                                    <div class="pims-form-group">
                                        <label class="pims-label">Prisoner</label>
                                        <div class="pims-select-wrapper">
                                            <i class="fas fa-user"></i>
                                            <select class="pims-select" name="prisoner_id" id="pims-prisoner-id" required>
                                                <option value="">Select Prisoner</option>
                                                @foreach ($prisonerDetails as $prisoner)
                                                    <option value="{{ $prisoner['id'] }}">
                                                        {{ $prisoner['first_name'] }} {{ $prisoner['middle_name'] }} {{ $prisoner['last_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pims-form-group">
                                        <label class="pims-label">Certification Type</label>
                                        <div class="pims-select-wrapper">
                                            <i class="fas fa-certificate"></i>
                                            <select class="pims-select" name="certification_type" required>
                                                <option value="">Select Type</option>
                                                <option value="job_completion">Job Completion</option>
                                                <option value="training_program_completion">Training Program Completion</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pims-form-group">
                                        <label class="pims-label">Certification Details</label>
                                        <textarea class="pims-textarea" name="certification_details" placeholder="Enter additional details (optional)" rows="3"></textarea>
                                    </div>
                                    <div class="pims-form-group">
                                        <label class="pims-label">Issued By</label>
                                        <div class="pims-select-wrapper">
                                            <i class="fas fa-user-tie"></i>
                                            <input class="pims-input" type="text" value=" &nbsp;&nbsp; &nbsp;{{ session('first_name') }} {{ session('last_name') }}" readonly>
                                            <input type="hidden" name="issued_by" value="{{ session('user_id') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pims-column-half">
                            <div class="pims-card">
                                <div class="pims-card-header">
                                    <h5>Certification Details</h5>
                                </div>
                                <div class="pims-card-body">
                                    <div class="pims-form-group">
                                        <label class="pims-label">Issued Date</label>
                                        <div class="pims-select-wrapper">
            
                                            <input class="pims-input" type="date" name="issued_date" required></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pims-prisoner-details" class="pims-card pims-prisoner-details pims-hidden">
                        <div class="pims-card-header">
                            <h5>Prisoner Completed Activities</h5>
                        </div>
                        <div class="pims-card-body">
                            <div id="pims-completed-jobs"></div>
                            <div id="pims-completed-trainings"></div>
                            <div id="pims-error-message" class="pims-notification pims-notification-danger pims-hidden">
                                <div>
                                    <i class="fas fa-exclamation-circle"></i>
                                    <p></p>
                                </div>
                                <button class="pims-notification-close">&times;</button>
                            </div>
                        </div>
                    </div>
                    <div class="pims-form-group pims-text-center" style="margin-top: 2rem;">
                        <button class="pims-btn pims-btn-primary" type="submit">
                            <i class="fas fa-paper-plane"></i> Submit
                        </button>
                        <button class="pims-btn pims-btn-secondary" type="reset">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Close notifications
            (document.querySelectorAll('.pims-notification-close') || []).forEach(($close) => {
                $close.addEventListener('click', () => {
                    $close.parentNode.classList.add('pims-hidden');
                });
            });
            
            // Prisoner select functionality
            const prisonerSelect = document.getElementById('pims-prisoner-id');
            if (prisonerSelect) {
                prisonerSelect.addEventListener('change', function () {
                    const prisonerId = this.value;
                    const detailsDiv = document.getElementById('pims-prisoner-details');
                    const jobsDiv = document.getElementById('pims-completed-jobs');
                    const trainingsDiv = document.getElementById('pims-completed-trainings');
                    const errorDiv = document.getElementById('pims-error-message');
                    const errorMessage = errorDiv.querySelector('p');

                    detailsDiv.classList.add('pims-hidden');
                    jobsDiv.innerHTML = '';
                    trainingsDiv.innerHTML = '';
                    errorDiv.classList.add('pims-hidden');
                    errorMessage.textContent = '';

                    if (!prisonerId) {
                        return;
                    }

                    jobsDiv.innerHTML = '<div class="pims-text-center"><div class="pims-spinner"></div><p>Loading prisoner jobs...</p></div>';
                    trainingsDiv.innerHTML = '<div class="pims-text-center"><div class="pims-spinner"></div><p>Loading prisoner trainings...</p></div>';

                    fetch('{{ route('training_officer.getPrisonerDetails') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ prisoner_id: prisonerId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            errorDiv.classList.remove('pims-hidden');
                            errorMessage.textContent = data.error;
                            return;
                        }

                        detailsDiv.classList.remove('pims-hidden');
                        
                        if (data.completed_jobs.length) {
                            jobsDiv.innerHTML = `
                                <h6 class="pims-activity-title"><i class="fas fa-briefcase"></i> Completed Jobs:</h6>
                                <div class="pims-columns">
                                    ${data.completed_jobs.map(job => `
                                        <div class="pims-activity-box">
                                            <p class="pims-activity-title">${job.job_title}</p>
                                            <p class="pims-text-muted">${job.job_description}</p>
                                            <p class="pims-activity-date">
                                                <i class="fas fa-calendar-check"></i> Completed on: ${job.completed_date}
                                            </p>
                                        </div>
                                    `).join('')}
                                </div>
                            `;
                        } else {
                            jobsDiv.innerHTML = '<p class="pims-text-muted"><i class="fas fa-info-circle"></i> No completed jobs found.</p>';
                        }
                        
                        if (data.completed_trainings.length) {
                            trainingsDiv.innerHTML = `
                                <h6 class="pims-activity-title"><i class="fas fa-graduation-cap"></i> Completed Trainings:</h6>
                                <div class="pims-columns">
                                    ${data.completed_trainings.map(training => `
                                        <div class="pims-activity-box">
                                            <p class="pims-activity-title">${training.training_title}</p>
                                            <p class="pims-activity-date">
                                                <i class="fas fa-calendar-check"></i> Completed on: ${training.completed_date}
                                            </p>
                                        </div>
                                    `).join('')}
                                </div>
                            `;
                        } else {
                            trainingsDiv.innerHTML = '<p class="pims-text-muted"><i class="fas fa-info-circle"></i> No completed trainings found.</p>';
                        }
                    })
                    .catch(error => {
                        errorDiv.classList.remove('pims-hidden');
                        errorMessage.textContent = 'Failed to fetch prisoner details. Please try again.';
                        console.error('Error:', error);
                    });
                });
            }
        });
    </script>
</body>
</html>