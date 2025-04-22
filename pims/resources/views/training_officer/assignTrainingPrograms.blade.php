<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Assign Training Program</title>
    
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
        }

        .pims-card-body {
            padding: 1.25rem;
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            transition: var(--pims-transition);
        }

        .pims-form-control:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
            outline: none;
        }

        .pims-select {
            width: 100%;
            position: relative;
        }

        .pims-select select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            background-color: white;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%232c3e50' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
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
            background-color: var(--pims-primary);
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pims-btn-secondary {
            background-color: #f0f2f5;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #e0e3e7;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Error Styles */
        .pims-error {
            border-color: var(--pims-danger) !important;
        }

        .pims-error-message {
            color: var(--pims-danger);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .pims-content-area {
                margin-left: 0;
                padding: 1rem;
            }
            
            .pims-form-columns {
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
            <div class="pims-card">
                <div class="pims-card-header">
                    <h2 class="pims-card-title">
                        <i class="fas fa-chalkboard-teacher"></i> Assign Training Program
                    </h2>
                </div>
                <div class="pims-card-body">
                    <form action="{{ route('assign_training.store') }}" method="POST">
                        @csrf

                        <div class="pims-form-columns" style="display: flex; gap: 1.5rem;">
                            <!-- Assignment Information -->
                            <div class="pims-form-column" style="flex: 1;">
                                <div class="pims-card">
                                    <div class="pims-card-body">
                                        <h3 class="pims-card-title" style="font-size: 1.1rem; margin-bottom: 1rem;">
                                            <i class="fas fa-info-circle"></i> Assignment Information
                                        </h3>

                                        <!-- Prisoner -->
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Prisoner</label>
                                            <div class="pims-select">
                                                <select name="prisoner_id" class="pims-form-control @error('prisoner_id') pims-error @enderror" required>
                                                    <option value="">Select a Prisoner</option>
                                                    @foreach($prisoners as $prisoner)
                                                        <option value="{{ $prisoner->id }}" {{ old('prisoner_id') == $prisoner->id ? 'selected' : '' }}>
                                                            {{ $prisoner->first_name }} (ID: {{ $prisoner->id }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('prisoner_id')
                                                <p class="pims-error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Training Program -->
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Training Program</label>
                                            <div class="pims-select">
                                                <select name="training_id" class="pims-form-control @error('training_id') pims-error @enderror" required>
                                                    <option value="">Select a Program</option>
                                                    @foreach($programs as $program)
                                                        <option value="{{ $program->id }}" {{ old('training_id') == $program->id ? 'selected' : '' }}>
                                                            {{ $program->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('training_id')
                                                <p class="pims-error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Assigned By -->
                                        <input type="hidden" name="assigned_by" value="{{ session('user_id') }}">

                                        <!-- Assigned Date -->
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Assigned Date</label>
                                            <input type="date" name="assigned_date" class="pims-form-control @error('assigned_date') pims-error @enderror" 
                                                   value="{{ old('assigned_date') }}" required>
                                            @error('assigned_date')
                                                <p class="pims-error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="pims-form-group">
                                            <label class="pims-form-label">Status</label>
                                            <div class="pims-select">
                                                <select name="status" class="pims-form-control @error('status') pims-error @enderror" required>
                                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                            @error('status')
                                                <p class="pims-error-message">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="pims-form-actions" style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                            <button type="reset" class="pims-btn pims-btn-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="pims-btn pims-btn-primary">
                                <i class="fas fa-save"></i> Assign Program
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>