<!DOCTYPE html>
<html>
@include('includes.head')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Assignments Management</title>
    
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

        /* Main Content Area */
        #pims-page-content {
            margin-left: var(--pims-sidebar-width);
            padding: 2rem;
            min-height: calc(100vh - var(--pims-nav-height));
            transition: all 0.3s ease;
            background-color: #f0f2f5;
        }

        /* Content Header */
        .pims-content-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-content-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
        }

        .pims-content-title i {
            margin-right: 0.75rem;
            color: var(--pims-accent);
        }

        /* Card Styles */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .pims-card-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-card-filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            width: 100%;
        }

        .pims-card-content {
            padding: 1.5rem;
        }

        /* Assignment Cards */
        .pims-assignment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .pims-assignment-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--pims-accent);
        }

        .pims-assignment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .pims-assignment-header {
            padding: 1.25rem;
            background-color: var(--pims-primary);
            color: white;
        }

        .pims-assignment-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .pims-assignment-date {
            font-size: 0.875rem;
            opacity: 0.8;
            display: flex;
            align-items: center;
        }

        .pims-assignment-date i {
            margin-right: 0.5rem;
        }

        .pims-assignment-body {
            padding: 1.25rem;
        }

        .pims-assignment-detail {
            margin-bottom: 0.75rem;
            font-size: 0.9375rem;
        }

        .pims-assignment-detail strong {
            color: var(--pims-primary);
            margin-right: 0.5rem;
        }

        /* Updated Footer with Buttons */
        .pims-assignment-footer {
            display: flex;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 0.75rem;
            gap: 0.5rem;
        }

        .pims-footer-btn {
            flex: 1;
            padding: 0.5rem;
            text-align: center;
            font-weight: 500;
            border: none;
            border-radius: var(--pims-border-radius);
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .pims-footer-btn.edit {
            background-color: rgba(41, 128, 185, 0.1);
            color: var(--pims-accent);
        }

        .pims-footer-btn.edit:hover {
            background-color: rgba(41, 128, 185, 0.2);
        }

        .pims-footer-btn.delete {
            background-color: rgba(255, 25, 0, 0.1);
            color: var(--pims-danger);
        }

        .pims-footer-btn.delete:hover {
            background-color: rgba(217, 22, 0, 0.2);
        }

        /* Form Styles */
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

        /* Button Styles */
        .pims-btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #a53126;
        }

        /* Search Input */
        .pims-search-input {
            position: relative;
            flex-grow: 1;
            max-width: 400px;
        }

        .pims-search-input .control {
            width: 100%;
        }

        .pims-search-input .icon {
            pointer-events: none;
        }

        /* Modal Styles */
        .pims-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .pims-modal.is-active {
            display: flex;
        }

        .pims-modal-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            animation: pimsModalFadeIn 0.3s ease;
        }

        @keyframes pimsModalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pims-modal-header {
            padding: 1.5rem;
            background-color: var(--pims-primary);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .pims-modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            line-height: 1;
        }

        .pims-modal-body {
            padding: 1.5rem;
            overflow-y: auto;
            flex-grow: 1;
        }

        .pims-modal-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .pims-form-group {
            margin-bottom: 1.5rem;
        }

        .pims-form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--pims-secondary);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #pims-page-content {
                margin-left: 0;
                padding: 1rem;
            }

            .pims-assignment-grid {
                grid-template-columns: 1fr;
            }

            .pims-card-filter {
                flex-direction: column;
                align-items: stretch;
            }

            .pims-search-input {
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <!-- NAV -->
    @include('includes.nav')

    <!-- Sidebar -->
    @include('inspector.menu')

    <!-- Main Content -->
    <div id="pims-page-content">
        <div class="pims-content-header">
            <h1 class="pims-content-title">
                <i class="fas fa-user-lock"></i> Assignments Management
            </h1>
        </div>

        <div class="pims-card">
            <div class="pims-card-header">
                <div class="pims-search-input">
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="pims-form-input" id="pims-search-assignment" type="text" placeholder="Search assignments...">
                            <span class="icon is-left">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="pims-card-actions">
                    <button class="pims-btn pims-btn-primary" onclick="pimsOpenForm()">
                        <i class="fas fa-plus"></i> New Assignment
                    </button>
                    <button class="pims-btn pims-btn-secondary" id="pims-reload-assignments">
                        <i class="fas fa-refresh"></i> Reload
                    </button>
                </div>
            </div>

            <div class="pims-card-content">
                @if($assignments->isEmpty())
                    <div class="pims-empty-state">
                        <i class="fas fa-clipboard-list fa-3x"></i>
                        <h3>No Assignments Found</h3>
                        <p>Create your first assignment by clicking the "New Assignment" button</p>
                    </div>
                @else
                    <div class="pims-assignment-grid">
                        @foreach($assignments as $assignment)
                        <div class="pims-assignment-card">
                            <div class="pims-assignment-header">
                                <h3 class="pims-assignment-title">Assignment #{{ $assignment->id }}</h3>
                                <p class="pims-assignment-date">
                                    <i class="fas fa-calendar"></i> {{ $assignment->assignment_date }}
                                </p>
                            </div>
                            
                            <div class="pims-assignment-body">
                                <div class="pims-assignment-detail">
                                    <strong>Prisoner ID:</strong>
                                    {{ optional($assignment->prisoner)->id ?? 'Not assigned' }}
                                </div>
                                
                                <div class="pims-assignment-detail">
                                    <strong>Prisoner Name:</strong>
                                    {{ optional($assignment->prisoner)->first_name ?? 'Not assigned' }}
                                </div>
                                
                                <div class="pims-assignment-detail">
                                    <strong>Lawyer Name:</strong>
                                    {{ optional($assignment->lawyer)->first_name ?? 'Not assigned' }}
                                </div>
                                
                                <div class="pims-assignment-detail">
                                    <strong>Assigned By:</strong>
                                    {{ optional($assignment->assignedBy)->first_name ?? 'Unknown' }}
                                </div>
                            </div>
                            
                            <div class="pims-assignment-footer">
                                <button class="pims-footer-btn edit" onclick="pimsOpenEditForm({{ $assignment->id }})">
                                    Edit
                                </button>
                                <button class="pims-footer-btn delete" onclick="return pimsConfirmDelete()">
                                    Delete
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Assignment Form Modal -->
    <div id="pims-assignment-form" class="pims-modal">
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <h2 class="pims-modal-title">New Assignment</h2>
                <button class="pims-modal-close" onclick="pimsCloseForm()">&times;</button>
            </header>
            
            <form action="{{ route('assignments.store') }}" method="POST">
                @csrf
                <section class="pims-modal-body">
                    <!-- Select Prisoner -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Prisoner</label>
                        <select class="pims-form-select" name="prisoner_id" required>
                            <option value="">Select Prisoner</option>
                            @foreach($prisoners as $prisoner)
                                <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }} {{ $prisoner->last_name }} (ID: {{ $prisoner->id }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Lawyer -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Lawyer</label>
                        <select class="pims-form-select" name="lawyer_id" required>
                            <option value="">Select Lawyer</option>
                            @foreach($lawyer as $lawyers)
                                <option value="{{ $lawyers->lawyer_id }}">{{ $lawyers->first_name }} {{ $lawyers->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">
                    <input type="hidden" name="assigned_by" value="{{ session('user_id') }}">

                    <!-- Assignment Date -->
                    <div class="pims-form-group">
                        <label class="pims-form-label">Assignment Date</label>
                        <input type="date" name="assignment_date" class="pims-form-input" required>
                    </div>
                </section>

                <footer class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-btn-secondary" onclick="pimsCloseForm()">Cancel</button>
                    <button type="submit" class="pims-btn pims-btn-primary">Save Assignment</button>
                </footer>
            </form>
        </div>
    </div>

    @include('includes.footer_js')
    
    <script>
        // Assignment Form Modal Functions
        function pimsOpenForm() {
            document.getElementById("pims-assignment-form").classList.add("is-active");
        }

        function pimsCloseForm() {
            document.getElementById("pims-assignment-form").classList.remove("is-active");
        }

        function pimsOpenEditForm(assignmentId) {
            // You would implement edit functionality here
            alert('Edit assignment with ID: ' + assignmentId);
        }

        // Confirm Delete Function
        function pimsConfirmDelete() {
            return confirm('Are you sure you want to delete this assignment?');
        }

        // Close modal when clicking outside
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("pims-assignment-form");
            
            modal.addEventListener("click", function(e) {
                if (e.target === modal) {
                    pimsCloseForm();
                }
            });

            // Reload button functionality
            document.getElementById("pims-reload-assignments").addEventListener("click", function() {
                window.location.reload();
            });

            // Search functionality
            const searchInput = document.getElementById("pims-search-assignment");
            searchInput.addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                const assignmentCards = document.querySelectorAll(".pims-assignment-card");
                
                assignmentCards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    </script>
</body>
</html>