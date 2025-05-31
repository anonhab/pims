<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - View Appointments</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    
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

        /* Header Styles */
        .pims-content-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .pims-content-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
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

        .pims-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .pims-card-header {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            padding: 1.5rem;
        }

        .pims-card-footer {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Appointment Details */
        .pims-appointment-detail {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            display: flex;
            flex-wrap: wrap;
        }

        .pims-appointment-detail strong {
            color: var(--pims-primary);
            font-weight: 600;
            min-width: 150px;
            display: inline-block;
        }

        /* Status Badges */
        .pims-status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pims-status-scheduled {
            background-color: rgba(41, 128, 185, 0.1);
            color: var(--pims-accent);
        }

        .pims-status-completed {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--pims-success);
        }

        .pims-status-cancelled {
            background-color: rgba(192, 57, 43, 0.1);
            color: var(--pims-danger);
        }

        .pims-status-pending {
            background-color: rgba(211, 84, 0, 0.1);
            color: var(--pims-warning);
        }

        /* Appointment ID Tag */
        .pims-appointment-id {
            background-color: var(--pims-accent);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
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
            font-size: 0.9rem;
            border: none;
        }

        .pims-btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
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

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #a5281b;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-warning {
            background-color: var(--pims-warning);
            color: white;
        }

        .pims-btn-warning:hover {
            background-color: #b3470d;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .pims-pagination-link {
            padding: 0.5rem 0.75rem;
            border-radius: var(--pims-border-radius);
            border: 1px solid #ddd;
            color: var(--pims-primary);
            font-weight: 600;
            transition: var(--pims-transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims-pagination-link:hover {
            background-color: var(--pims-accent);
            color: white;
            border-color: var(--pims-accent);
            transform: translateY(-2px);
        }

        .pims-pagination-link.is-current {
            background-color: var(--pims-primary);
            color: white;
            border-color: var(--pims-primary);
        }

        .pims-pagination-link.is-disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        .pims-pagination-list {
            display: flex;
            gap: 0.25rem;
            list-style: none;
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

            .pims-appointment-detail strong {
                min-width: 100%;
                margin-bottom: 0.25rem;
            }

            .pims-card-footer {
                flex-direction: column;
                align-items: flex-end;
            }
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
            max-width: 500px;
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
            background-color: var(--pims-primary);
            color: white;
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
            color: white;
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
        }

        .pims-modal-card-foot {
            padding: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        /* Empty State */
        .pims-empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--pims-primary);
        }

        .pims-empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--pims-accent);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('includes.nav')

    <div class="pims-app-container">
        @include('lawyer.menu')

        <div class="pims-content-area">
            <div class="pims-content-header">
                <h1 class="pims-content-title">
                    <i class="fas fa-calendar-alt"></i> View Appointments
                </h1>
            </div>

            <!-- Appointment Cards -->
            <div class="pims-appointment-list">
                @if(!empty($appointments) && is_countable($appointments) && count($appointments) > 0)
                    @foreach($appointments as $appointment)
                    <div class="pims-card">
                        <div class="pims-card-header">
                            <h2 class="pims-card-title">
                                <i class="fas fa-calendar-day"></i>
                                Appointment #{{ $appointment->id }}
                                <span class="pims-appointment-id">ID: {{ $appointment->id }}</span>
                            </h2>
                            <span class="pims-status-badge pims-status-{{ strtolower($appointment->status) }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                        
                        <div class="pims-card-body">
                            <div class="pims-appointment-details">
                                <p class="pims-appointment-detail">
                                    <strong>Prisoner:</strong>
                                    {{ $appointment->prisoner->first_name }} {{ $appointment->prisoner->last_name }} (ID: {{ $appointment->prisoner_id }})
                                </p>
                                <p class="pims-appointment-detail">
                                    <strong>Lawyer:</strong>
                                    {{ $appointment->lawyer->name }} (ID: {{ $appointment->lawyer_id }})
                                </p>
                                <p class="pims-appointment-detail">
                                    <strong>Appointment Date:</strong>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y H:i') }}
                                </p>
                                <p class="pims-appointment-detail">
                                    <strong>Created At:</strong>
                                    {{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y H:i') }}
                                </p>
                                <p class="pims-appointment-detail">
                                    <strong>Notes:</strong>
                                    {{ $appointment->notes }}
                                </p>
                            </div>
                        </div>
                        
                        
                    </div>
                    @endforeach
                @else
                    <div class="pims-empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h3>No Appointments Found</h3>
                        <p>You don't have any scheduled appointments yet.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(!empty($appointments) && $appointments->count() > 0)
            <div class="pims-pagination">
                <!-- Previous Button -->
                @if($appointments->currentPage() > 1)
                <a class="pims-pagination-link" href="{{ $appointments->previousPageUrl() }}">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
                @else
                <a class="pims-pagination-link is-disabled" href="#">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
                @endif

                <!-- Page Numbers -->
                <ul class="pims-pagination-list">
                    @foreach($appointments->getUrlRange(1, $appointments->lastPage()) as $page => $url)
                    <li>
                        <a class="pims-pagination-link {{ $page == $appointments->currentPage() ? 'is-current' : '' }}" 
                           href="{{ $url }}">
                            {{ $page }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                <!-- Next Button -->
                @if($appointments->hasMorePages())
                <a class="pims-pagination-link" href="{{ $appointments->nextPageUrl() }}">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
                @else
                <a class="pims-pagination-link is-disabled" href="#">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="pims-modal" id="pims-delete-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <p>Are you sure you want to delete this appointment?</p>
                <p class="has-text-danger">This action cannot be undone.</p>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary pims-close-modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims-delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pims-btn pims-btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </footer>
        </div>
    </div>

    <!-- Cancel Confirmation Modal -->
    <div class="pims-modal" id="pims-cancel-modal">
        <div class="pims-modal-background"></div>
        <div class="pims-modal-card">
            <header class="pims-modal-card-head">
                <p class="pims-modal-card-title">
                    <i class="fas fa-exclamation-circle"></i> Confirm Cancellation
                </p>
                <button class="pims-modal-close">&times;</button>
            </header>
            <section class="pims-modal-card-body">
                <p>Are you sure you want to cancel this appointment?</p>
                <p>You can add a cancellation reason below:</p>
                <textarea class="pims-form-control pims-textarea mt-2" id="pims-cancel-reason" placeholder="Cancellation reason (optional)"></textarea>
            </section>
            <footer class="pims-modal-card-foot">
                <button class="pims-btn pims-btn-secondary pims-close-modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="pims-cancel-form" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="CANCELLED">
                    <input type="hidden" name="notes" id="pims-cancel-notes">
                    <button type="submit" class="pims-btn pims-btn-warning">
                        <i class="fas fa-times-circle"></i> Confirm Cancel
                    </button>
                </form>
            </footer>
        </div>
    </div>

    @include('includes.footer_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete appointment functionality
            document.querySelectorAll('.pims-delete-appointment').forEach(button => {
                button.addEventListener('click', function() {
                    const appointmentId = this.getAttribute('data-id');
                    document.getElementById('pims-delete-form').action = `/appointments/${appointmentId}`;
                    document.getElementById('pims-delete-modal').classList.add('is-active');
                });
            });

            // Cancel appointment functionality
            document.querySelectorAll('.pims-cancel-appointment').forEach(button => {
                button.addEventListener('click', function() {
                    const appointmentId = this.getAttribute('data-id');
                    document.getElementById('pims-cancel-form').action = `/appointments/${appointmentId}`;
                    document.getElementById('pims-cancel-modal').classList.add('is-active');
                });
            });

            // Update cancellation notes
            document.getElementById('pims-cancel-reason').addEventListener('input', function() {
                document.getElementById('pims-cancel-notes').value = this.value;
            });

            // Close modal functionality
            document.querySelectorAll('.pims-modal-close, .pims-modal-background').forEach(element => {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.pims-modal').forEach(modal => {
                        modal.classList.remove('is-active');
                    });
                });
            });

            // Edit appointment functionality
            document.querySelectorAll('.pims-edit-appointment').forEach(button => {
                button.addEventListener('click', function() {
                    const appointmentId = this.getAttribute('data-id');
                    window.location.href = `/appointments/${appointmentId}/edit`;
                });
            });
        });
    </script>
</body>
</html>