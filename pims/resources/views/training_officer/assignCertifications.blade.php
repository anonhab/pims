<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Certification Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #f8961e;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
        }
        
        #app-content {
            min-height: calc(100vh - 52px);
            margin-top: 52px;
        }
        
        #page-content {
            padding: 2rem;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-left: 1px solid #eee;
        }
        
        .section {
            padding: 2rem 1.5rem;
        }
        
        .title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .card {
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            border: none;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .card .title {
            font-size: 1.25rem;
            color: var(--secondary-color);
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .label {
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .input, .textarea, .select select {
            border-radius: 6px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .input:focus, .textarea:focus, .select select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(72, 149, 239, 0.2);
        }
        
        .button.is-link {
            background-color: var(--primary-color);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .button.is-link:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .button.is-light {
            transition: all 0.3s ease;
        }
        
        .button.is-light:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }
        
        .notification {
            border-radius: 6px;
        }
        
        #prisoner-details {
            border-left: 4px solid var(--accent-color);
        }
        
        #completed-jobs, #completed-trainings {
            margin-bottom: 1.5rem;
        }
        
        #completed-jobs ul, #completed-trainings ul {
            list-style-type: none;
            padding-left: 0;
        }
        
        #completed-jobs li, #completed-trainings li {
            background-color: var(--light-color);
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-radius: 6px;
            border-left: 3px solid var(--success-color);
        }
        
        #completed-jobs strong, #completed-trainings strong {
            color: var(--secondary-color);
        }
        
        .field:not(:last-child) {
            margin-bottom: 1.25rem;
        }
        
        @media screen and (max-width: 768px) {
            #app-content {
                flex-direction: column;
            }
            
            #page-content {
                padding: 1rem;
            }
            
            .columns {
                flex-direction: column;
            }
            
            .column.is-half {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="columns" id="app-content">
        @include('training_officer.menu')
        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Certification Management</h1>

                    @if(session('success'))
                        <div class="notification is-success is-light">
                            <button class="delete"></button>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any()))
                        <div class="notification is-danger is-light">
                            <button class="delete"></button>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('training_officer.storeCertification') }}" method="POST">
                        @csrf
                        <div class="columns">
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Certification Information</p>
                                        <div class="field">
                                            <label class="label">Prisoner</label>
                                            <div class="control has-icons-left">
                                                <div class="select is-fullwidth">
                                                    <select name="prisoner_id" id="prisoner_id" required>
                                                        <option value="">Select Prisoner</option>
                                                        @foreach ($prisonerDetails as $prisoner)
                                                            <option value="{{ $prisoner['id'] }}">
                                                                {{ $prisoner['first_name'] }} {{ $prisoner['middle_name'] }} {{ $prisoner['last_name'] }}
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
                                            <label class="label">Certification Type</label>
                                            <div class="control has-icons-left">
                                                <div class="select is-fullwidth">
                                                    <select name="certification_type" required>
                                                        <option value="">Select Type</option>
                                                        <option value="job_completion">Job Completion</option>
                                                        <option value="training_program_completion">Training Program Completion</option>
                                                    </select>
                                                </div>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-certificate"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Certification Details</label>
                                            <div class="control">
                                                <textarea class="textarea" name="certification_details" placeholder="Enter additional details (optional)" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label">Issued By</label>
                                            <div class="control has-icons-left">
                                                <input class="input" type="text" value="{{ session('first_name') }} {{ session('last_name') }}" readonly>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-user-tie"></i>
                                                </span>
                                                <input type="hidden" name="issued_by" value="{{ session('user_id') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Certification Details</p>
                                        <div class="field">
                                            <label class="label">Issued Date</label>
                                            <div class="control has-icons-left">
                                                <input class="input" type="date" name="issued_date" required>
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="prisoner-details" class="card mt-4" style="display: none;">
                            <div class="card-content">
                                <p class="title is-4">Prisoner Completed Activities</p>
                                <div id="completed-jobs"></div>
                                <div id="completed-trainings"></div>
                                <div id="error-message" class="notification is-danger is-light is-hidden">
                                    <button class="delete"></button>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-grouped is-grouped-right mt-4">
                            <div class="control">
                                <button class="button is-link is-medium" type="submit">
                                    <span class="icon">
                                        <i class="fas fa-paper-plane"></i>
                                    </span>
                                    <span>Submit</span>
                                </button>
                            </div>
                            <div class="control">
                                <button class="button is-light is-medium" type="reset">
                                    <span class="icon">
                                        <i class="fas fa-undo"></i>
                                    </span>
                                    <span>Reset</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Close notifications
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;
                
                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
            
            // Prisoner select functionality
            const prisonerSelect = document.getElementById('prisoner_id');
            if (prisonerSelect) {
                prisonerSelect.addEventListener('change', function () {
                    const prisonerId = this.value;
                    const detailsDiv = document.getElementById('prisoner-details');
                    const jobsDiv = document.getElementById('completed-jobs');
                    const trainingsDiv = document.getElementById('completed-trainings');
                    const errorDiv = document.getElementById('error-message');
                    const errorMessage = errorDiv.querySelector('p');

                    detailsDiv.style.display = 'none';
                    jobsDiv.innerHTML = '';
                    trainingsDiv.innerHTML = '';
                    errorDiv.classList.add('is-hidden');
                    errorMessage.textContent = '';

                    if (!prisonerId) {
                        return;
                    }

                    jobsDiv.innerHTML = '<p class="has-text-centered"><i class="fas fa-spinner fa-pulse"></i> Loading prisoner jobs...</p>';
                    trainingsDiv.innerHTML = '<p class="has-text-centered"><i class="fas fa-spinner fa-pulse"></i> Loading prisoner trainings...</p>';

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
                            errorDiv.classList.remove('is-hidden');
                            errorMessage.textContent = data.error;
                            return;
                        }

                        detailsDiv.style.display = 'block';
                        
                        if (data.completed_jobs.length) {
                            jobsDiv.innerHTML = `
                                <p class="has-text-weight-semibold mb-2"><i class="fas fa-briefcase"></i> Completed Jobs:</p>
                                <div class="columns is-multiline">
                                    ${data.completed_jobs.map(job => `
                                        <div class="column is-12">
                                            <div class="box">
                                                <p class="has-text-weight-semibold">${job.job_title}</p>
                                                <p class="has-text-grey">${job.job_description}</p>
                                                <p class="has-text-info is-size-7"><i class="fas fa-calendar-check"></i> Completed on: ${job.completed_date}</p>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            `;
                        } else {
                            jobsDiv.innerHTML = '<p class="has-text-grey"><i class="fas fa-info-circle"></i> No completed jobs found.</p>';
                        }
                        
                        if (data.completed_trainings.length) {
                            trainingsDiv.innerHTML = `
                                <p class="has-text-weight-semibold mb-2"><i class="fas fa-graduation-cap"></i> Completed Trainings:</p>
                                <div class="columns is-multiline">
                                    ${data.completed_trainings.map(training => `
                                        <div class="column is-12">
                                            <div class="box">
                                                <p class="has-text-weight-semibold">${training.training_title}</p>
                                                <p class="has-text-info is-size-7"><i class="fas fa-calendar-check"></i> Completed on: ${training.completed_date}</p>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            `;
                        } else {
                            trainingsDiv.innerHTML = '<p class="has-text-grey"><i class="fas fa-info-circle"></i> No completed trainings found.</p>';
                        }
                    })
                    .catch(error => {
                        errorDiv.classList.remove('is-hidden');
                        errorMessage.textContent = 'Failed to fetch prisoner details. Please try again.';
                        console.error('Error:', error);
                    });
                });
            }
        });
    </script>
</body>
</html>