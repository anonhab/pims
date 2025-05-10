<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Assigned Training Programs</title>

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
            height: 100%;
            display: flex;
            flex-direction: column;
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
            flex-grow: 1;
        }

        .pims-card-footer {
            padding: 0.75rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: center;
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        /* Content Styles */
        .pims-content-text {
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .pims-content-text strong {
            color: var(--pims-primary);
            font-weight: 600;
        }

        .pims-meta-text {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-top: 1rem;
        }

        /* Status Badge */
        .pims-status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: var(--pims-border-radius);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pims-status-completed {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-status-in-progress {
            background-color: var(--pims-warning);
            color: white;
        }

        /* Notification Styles */
        .pims-notification {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .pims-notification-success {
            background-color: rgba(39, 174, 96, 0.2);
            border-left: 4px solid var(--pims-success);
            color: var(--pims-success);
        }

        .pims-notification-warning {
            background-color: rgba(211, 84, 0, 0.2);
            border-left: 4px solid var(--pims-warning);
            color: var(--pims-warning);
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
            width: 100%;
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

        /* Page Header */
        .pims-page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .pims-page-title {
            font-size: 1.75rem;
            color: var(--pims-primary);
            margin-bottom: 0.5rem;
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

            <div class="pims-page-header">
                <h1 class="pims-page-title">
                    <i class="fas fa-chalkboard-teacher"></i> Assigned Training Programs
                </h1>
            </div>

            <div class="pims-grid">
                @forelse ($assignments as $assignment)
                <div class="pims-assignment-card">
                    <div class="pims-card">
                        <header class="pims-card-header">
                            <p class="pims-card-title">
                                @if($assignment->trainingProgram)
                                <i class="fas fa-graduation-cap"></i> {{ $assignment->trainingProgram->name }}
                                @else
                                <i class="fas fa-exclamation-circle"></i> Not assigned
                                @endif
                            </p>
                        </header>
                        <div class="pims-card-body">
                            <div class="pims-content">
                                <p class="pims-content-text"><strong><i class="fas fa-id-card"></i> Prisoner ID:</strong> {{ $assignment->prisoner_id }}</p>
                                <p class="pims-content-text"><strong><i class="fas fa-graduation-cap"></i> Program ID:</strong> {{ $assignment->training_id }}</p>
                                <p class="pims-content-text"><strong><i class="fas fa-align-left"></i> Description:</strong>
                                    @if($assignment->trainingProgram)
                                    {{ Str::limit($assignment->trainingProgram->description, 100) }}
                                    @else
                                    Not assigned
                                    @endif
                                </p>
                                <p class="pims-content-text"><strong><i class="fas fa-user-tie"></i> Assigned By:</strong> {{ $assignment->assigned_by }}</p>
                                <p class="pims-content-text">
                                    <strong><i class="fas fa-calendar-day"></i> Assigned Date:</strong> {{ $assignment->assigned_date }}
                                </p>
                                <p class="pims-content-text">
                                    <strong><i class="fas fa-calendar-check"></i> End Date:</strong> {{ $assignment->end_date }}
                                </p>

                                <p class="pims-content-text"><strong><i class="fas fa-info-circle"></i> Status:</strong>
                                    <span class="pims-status-badge pims-status-{{ $assignment->status === 'completed' ? 'completed' : 'in-progress' }}">
                                        {{ ucfirst($assignment->status) }}
                                    </span>
                                </p>
                                <p class="pims-content-text"><strong><i class="fas fa-calendar-alt"></i> Dates:</strong>
                                    @if($assignment->trainingProgram)
                                    {{ $assignment->trainingProgram->start_date }} to {{ $assignment->trainingProgram->end_date }}
                                    @else
                                    Not assigned
                                    @endif
                                </p>
                                <p class="pims-content-text"><strong><i class="fas fa-building"></i> Prison ID:</strong>
                                    @if($assignment->trainingProgram)
                                    {{ $assignment->trainingProgram->prison_id }}
                                    @else
                                    Not assigned
                                    @endif
                                </p>
                                <p class="pims-meta-text">
                                    <small><i class="fas fa-clock"></i> Created: {{ $assignment->created_at->format('Y-m-d') }}</small><br>
                                    <small><i class="fas fa-sync-alt"></i> Updated: {{ $assignment->updated_at->format('Y-m-d') }}</small>
                                </p>
                            </div>
                        </div>
                        <footer class="pims-card-footer">
                            <form action="{{ route('assign_training.unassign', $assignment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="pims-btn pims-btn-danger">
                                    <span class="icon">
                                        <i class="fas fa-user-minus"></i>
                                    </span>
                                    <span>Unassign</span>
                                </button>
                            </form>
                        </footer>
                    </div>
                </div>
                @empty
                <div class="pims-empty-state">
                    <div class="pims-notification pims-notification-warning">
                        <i class="fas fa-exclamation-triangle"></i> No training assignments found.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('includes.footer_js')
</body>

</html>