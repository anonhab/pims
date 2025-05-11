<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - View Certifications</title>
    
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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
            line-height: 1.6;
        }

        /* Layout Structure */
        .pims-app-container {
            display: flex;
            min-height: 100vh;
            padding-top: var(--pims-nav-height);
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
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background-color: var(--pims-secondary);
            color: white;
            border-top-left-radius: var(--pims-border-radius);
            border-top-right-radius: var(--pims-border-radius);
        }

        .pims-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
        }

        .pims-card-body {
            padding: 1.25rem;
        }

        .pims-card-footer {
            padding: 0.75rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
        }

        /* Filter Controls */
        .pims-card-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.02);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
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
            background-color: #2472a4;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-secondary {
            background-color: #ecf0f1;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #d5dbdb;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Status Badge */
        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: var(--pims-border-radius);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pims-status-issued {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-status-revoked {
            background-color: var(--pims-danger);
            color: white;
        }

        /* Notification Styles */
        .pims-notification {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-notification-error {
            background: #f8d7da;
            color: #721c24;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-grid {
                grid-template-columns: 1fr;
            }

            .pims-card-filter {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('training_officer.menu')

        <div class="pims-content-area">
            <!-- Success Notification -->
            @if(session('success'))
                <div class="pims-notification pims-notification-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Error Notification -->
            @if(session('error'))
                <div class="pims-notification pims-notification-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <div class="pims-card">
                <div class="pims-card-filter">
                    <!-- Search and reload controls -->
                    <div class="pims-form-group" style="flex-grow: 1;">
                        <div class="control has-icons-left">
                            <input class="pims-form-control" id="pims-table-search" type="text" placeholder="Search certifications...">
                            <span class="icon is-left">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="pims-form-group">
                        <button class="pims-btn pims-btn-secondary" id="pims-table-reload">
                            <i class="fas fa-sync-alt"></i> Reload
                        </button>
                    </div>
                </div>

                <div class="pims-card-body">
                    <!-- Card Layout for Certifications -->
                    @if($certifications->isEmpty())
                        <p class="pims-content-text">No certifications found.</p>
                    @else
                        <div class="pims-grid">
                            @foreach($certifications as $certification)
                            <div class="pims-certification-card">
                                <div class="pims-card">
                                    <header class="pims-card-header">
                                        <h3 class="pims-card-title">
                                            <i class="fas fa-certificate"></i> 
                                            {{ $certification->certification_type === 'job_completion' ? 'Job Completion' : 'Training Program Completion' }}
                                        </h3>
                                    </header>
                                    <div class="pims-card-body">
                                        <div class="pims-content-text">
                                            <strong><i class="fas fa-user"></i> Prisoner:</strong> 
                                            {{ trim(implode(' ', array_filter([
                                                $certification->prisoner->first_name,
                                                $certification->prisoner->middle_name,
                                                $certification->prisoner->last_name
                                            ]))) }}
                                        </div>
                                        <div class="pims-content-text">
                                            <strong><i class="fas fa-user-tie"></i> Issued By:</strong> 
                                            {{ trim($certification->issuedBy->first_name . ' ' . $certification->issuedBy->last_name) }}
                                        </div>
                                        <div class="pims-content-text">
                                            <strong><i class="fas fa-calendar-day"></i> Issued Date:</strong> 
                                            {{ $certification->issued_date->format('Y-m-d') }}
                                        </div>
                                        <div class="pims-content-text">
                                            <strong><i class="fas fa-info-circle"></i> Status:</strong>
                                            <span class="pims-status-badge pims-status-{{ $certification->status }}">
                                                {{ ucfirst($certification->status) }}
                                            </span>
                                        </div>
                                        <div class="pims-meta-text">
                                            <small><i class="fas fa-clock"></i> Created: {{ $certification->created_at->format('Y-m-d H:i') }}</small><br>
                                            <small><i class="fas fa-sync-alt"></i> Updated: {{ $certification->updated_at->format('Y-m-d H:i') }}</small>
                                        </div>
                                    </div>
                                    <footer class="pims-card-footer">
                                        <a href="{{ route('training.viewCertificate', $certification->id) }}" class="pims-btn pims-btn-primary">
                                            <i class="fas fa-eye"></i> View Certificate
                                        </a>
                                    </footer>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('pims-table-search');
            const certificationCards = document.querySelectorAll('.pims-certification-card');

            searchInput.addEventListener('input', function() {
                const filter = searchInput.value.toLowerCase();
                certificationCards.forEach(card => {
                    const prisoner = card.querySelector('.pims-content-text strong:contains("Prisoner")')?.nextSibling.textContent.toLowerCase() || '';
                    const type = card.querySelector('.pims-card-title')?.textContent.toLowerCase() || '';
                    const issuedBy = card.querySelector('.pims-content-text strong:contains("Issued By")')?.nextSibling.textContent.toLowerCase() || '';
                    card.style.display = prisoner.includes(filter) || type.includes(filter) || issuedBy.includes(filter) ? '' : 'none';
                });
            });

            // Reload button
            document.getElementById('pims-table-reload').addEventListener('click', () => {
                window.location.reload();
            });
        });
    </script>
</body>
</html>