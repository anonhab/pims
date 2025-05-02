<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Prisoners</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .pims-header-actions {
            display: flex;
            gap: 1rem;
        }

        /* Card Styles */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Search Styles */
        .pims-search-filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-search-box {
            flex: 1;
            min-width: 250px;
        }

        .pims-search-control {
            position: relative;
        }

        .pims-search-control input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 1rem;
            transition: var(--pims-transition);
        }

        .pims-search-control input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .pims-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-secondary);
        }

        /* Table Styles */
        .pims-table-container {
            overflow-x: auto;
        }

        .pims-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: var(--pims-border-radius);
            overflow: hidden;
            box-shadow: var(--pims-box-shadow);
        }

        .pims-table th {
            background-color: var(--pims-primary);
            color: white;
            font-weight: 500;
            text-align: left;
            padding: 1rem;
        }

        .pims-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .pims-table tr:last-child td {
            border-bottom: none;
        }

        .pims-table tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        /* Status Tags */
        .pims-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .pims-tag-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
        }

        .pims-tag-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
        }

        .pims-tag-info {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--pims-accent);
        }

        /* Button Styles */
        .pims-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            font-size: 0.9rem;
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

        .pims-btn-outline {
            background-color: transparent;
            border: 1px solid var(--pims-accent);
            color: var(--pims-accent);
        }

        .pims-btn-outline:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #c0392b;
        }

        .pims-btn-light {
            background-color: var(--pims-light);
            color: var(--pims-secondary);
        }

        .pims-btn-light:hover {
            background-color: #dfe6e9;
        }

        .pims-btn-text {
            background: none;
            border: none;
            color: var(--pims-accent);
            padding: 0.25rem;
        }

        .pims-btn-text:hover {
            color: var(--pims-primary);
        }

        /* Action Dropdown */
        .pims-action-select {
            padding: 0.5rem;
            border-radius: var(--pims-border-radius);
            border: 1px solid #ddd;
            font-family: inherit;
            font-size: 0.9rem;
            background-color: white;
            cursor: pointer;
            transition: var(--pims-transition);
        }

        .pims-action-select:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        /* Modal Styles */
        .pims-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .pims-modal.active {
            display: flex;
        }

        .pims-modal-container {
            background-color: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-header i {
            color: var(--pims-accent);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--pims-secondary);
            transition: var(--pims-transition);
        }

        .pims-modal-close:hover {
            color: var(--pims-primary);
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Prisoner Details Grid */
        .pims-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .pims-detail-item {
            margin-bottom: 1rem;
        }

        .pims-detail-item strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--pims-secondary);
            font-weight: 500;
        }

        .pims-detail-item span {
            display: block;
            padding: 0.5rem;
            background-color: var(--pims-lighter);
            border-radius: var(--pims-border-radius);
        }

        .pims-inmate-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
        }

        /* Flash Messages */
        .pims-flash-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--pims-border-radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-flash-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-flash-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

        .pims-flash-warning {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--pims-warning);
            border-left: 4px solid var(--pims-warning);
        }

        .pims-flash-info {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--pims-accent);
            border-left: 4px solid var(--pims-accent);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
            
            .pims-table th, 
            .pims-table td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .pims-page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .pims-search-box {
                width: 100%;
            }
            
            .pims-details-grid {
                grid-template-columns: 1fr;
            }
            
            .pims-table th:nth-child(4),
            .pims-table td:nth-child(4),
            .pims-table th:nth-child(5),
            .pims-table td:nth-child(5) {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .pims-table th:nth-child(3),
            .pims-table td:nth-child(3),
            .pims-table th:nth-child(6),
            .pims-table td:nth-child(6) {
                display: none;
            }
            
            .pims-modal-container {
                width: 95%;
                max-height: 85vh;
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
                        <i class="fas fa-user-lock"></i> Prisoner Management
                    </h2>
                </div>
                
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="pims-flash-message pims-flash-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="pims-flash-message pims-flash-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
                @endif

                @if(session('warning'))
                <div class="pims-flash-message pims-flash-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('warning') }}
                </div>
                @endif

                @if(session('info'))
                <div class="pims-flash-message pims-flash-info">
                    <i class="fas fa-info-circle"></i>
                    {{ session('info') }}
                </div>
                @endif
                
                <!-- Search and Filters -->
                <div class="pims-card">
                    <div class="pims-search-filter">
                        <div class="pims-search-box">
                            <div class="pims-search-control">
                                <input type="text" id="pims-table-search" class="pims-form-control" placeholder="Search prisoners...">
                                <i class="fas fa-search pims-search-icon"></i>
                            </div>
                        </div>
                        <div class="pims-header-actions">
                            <button class="pims-btn pims-btn-light" id="pims-table-reload">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>
                    </div>
                    
                    <!-- Prisoners Table -->
                    <div class="pims-table-container">
                        <table class="pims-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Sex</th>
                                    <th>Crime</th>
                                    <th>Status</th>
                                    <th class="pims-hidden-data">Prison ID</th>
                                    <th class="pims-hidden-data">DOB</th>
                                    <th class="pims-hidden-data">Address</th>
                                    <th class="pims-hidden-data">Marital Status</th>
                                    <th class="pims-hidden-data">Time Start</th>
                                    <th class="pims-hidden-data">Time End</th>
                                    <th class="pims-hidden-data">Emergency Contact</th>
                                    <th class="pims-hidden-data">Contact Relation</th>
                                    <th class="pims-hidden-data">Contact Number</th>
                                    <th class="pims-hidden-data">Image</th>
                                    <th class="pims-hidden-data">Created At</th>
                                    <th class="pims-hidden-data">Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prisoners as $index => $prisoner)
                                <tr id="pims-prisoner-row-{{ $prisoner->prisoner_id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $prisoner->first_name }}</td>
                                    <td>{{ $prisoner->middle_name }}</td>
                                    <td>{{ $prisoner->last_name }}</td>
                                    <td>{{ $prisoner->sex }}</td>
                                    <td>{{ $prisoner->crime_committed }}</td>
                                    <td>
                                        @if ($prisoner->status == 'Active')
                                        <span class="pims-tag pims-tag-success">Active</span>
                                        @elseif ($prisoner->status == 'Inactive')
                                        <span class="pims-tag pims-tag-danger">Inactive</span>
                                        @elseif ($prisoner->status == 'Released')
                                        <span class="pims-tag pims-tag-info">Released</span>
                                        @endif
                                    </td>
                                    <td class="pims-hidden-data">{{ $prisoner->prison_id }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->dob }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->address }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->marital_status }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->time_serve_start }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->time_serve_end }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->emergency_contact_name }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->emergency_contact_relation }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->emergency_contact_number }}</td>
                                    <td class="pims-hidden-data">{{ asset('storage/' . $prisoner->inmate_image) }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->created_at }}</td>
                                    <td class="pims-hidden-data">{{ $prisoner->updated_at }}</td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <button class="pims-btn pims-btn-text pims-view-prisoner" data-id="{{ $prisoner->prisoner_id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="pims-btn pims-btn-text">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <select class="pims-action-select pims-prisoner-status" data-id="{{ $prisoner->prisoner_id }}">
                                                <option value="Active" {{ $prisoner->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $prisoner->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                <option value="Released" {{ $prisoner->status == 'Released' ? 'selected' : '' }}>Released</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- View Prisoner Modal -->
    <div class="pims-modal" id="pims-view-prisoner-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h3><i class="fas fa-user"></i> Prisoner Details</h3>
                <button class="pims-modal-close">&times;</button>
            </div>
            
            <div class="pims-modal-body">
                <div class="pims-details-grid">
                    <div>
                        <div class="pims-detail-item">
                            <strong>Prisoner ID</strong>
                            <span id="pims-view-prisoner-id"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>First Name</strong>
                            <span id="pims-view-first-name"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Middle Name</strong>
                            <span id="pims-view-middle-name"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Last Name</strong>
                            <span id="pims-view-last-name"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Date of Birth</strong>
                            <span id="pims-view-dob"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Sex</strong>
                            <span id="pims-view-sex"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Marital Status</strong>
                            <span id="pims-view-marital-status"></span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="pims-detail-item">
                            <strong>Prison ID</strong>
                            <span id="pims-view-prison-id"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Crime Committed</strong>
                            <span id="pims-view-crime-committed"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Status</strong>
                            <span id="pims-view-status"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Time Serve Start</strong>
                            <span id="pims-view-time-serve-start"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Time Serve End</strong>
                            <span id="pims-view-time-serve-end"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Address</strong>
                            <span id="pims-view-address"></span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="pims-detail-item">
                            <strong>Emergency Contact</strong>
                            <span id="pims-view-emergency-contact-name"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Contact Relation</strong>
                            <span id="pims-view-emergency-contact-relation"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Contact Number</strong>
                            <span id="pims-view-emergency-contact-number"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Created At</strong>
                            <span id="pims-view-created-at"></span>
                        </div>
                        <div class="pims-detail-item">
                            <strong>Updated At</strong>
                            <span id="pims-view-updated-at"></span>
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 1.5rem; text-align: center;">
                    <img id="pims-view-inmate-image" src="#" alt="Inmate Image" class="pims-inmate-image">
                </div>
            </div>
            
            <div class="pims-modal-footer">
                <button class="pims-btn pims-btn-light" id="pims-close-modal">Close</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('pims-table-search');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('.pims-table tbody tr');
                    
                    rows.forEach(row => {
                        const visibleText = row.textContent.toLowerCase();
                        if (visibleText.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
            
            // Refresh button
            document.getElementById('pims-table-reload')?.addEventListener('click', function() {
                window.location.reload();
            });
            
            // Modal functionality
            const viewModal = document.getElementById('pims-view-prisoner-modal');
            const closeButtons = document.querySelectorAll('.pims-modal-close, #pims-close-modal');
            
            // View prisoner details
            document.querySelectorAll('.pims-view-prisoner').forEach(button => {
                button.addEventListener('click', function() {
                    const prisonerId = this.getAttribute('data-id');
                    const prisonerRow = document.getElementById(`pims-prisoner-row-${prisonerId}`);
                    
                    if (prisonerRow) {
                        const cells = prisonerRow.querySelectorAll('td');
                        const hiddenData = prisonerRow.querySelectorAll('.pims-hidden-data');
                        
                        document.getElementById('pims-view-prisoner-id').textContent = cells[0].textContent;
                        document.getElementById('pims-view-first-name').textContent = cells[1].textContent;
                        document.getElementById('pims-view-middle-name').textContent = cells[2].textContent;
                        document.getElementById('pims-view-last-name').textContent = cells[3].textContent;
                        document.getElementById('pims-view-sex').textContent = cells[4].textContent;
                        document.getElementById('pims-view-crime-committed').textContent = cells[5].textContent;
                        document.getElementById('pims-view-status').textContent = cells[6].textContent.trim();
                        
                        // Hidden data
                        document.getElementById('pims-view-prison-id').textContent = hiddenData[0].textContent;
                        document.getElementById('pims-view-dob').textContent = hiddenData[1].textContent;
                        document.getElementById('pims-view-address').textContent = hiddenData[2].textContent;
                        document.getElementById('pims-view-marital-status').textContent = hiddenData[3].textContent;
                        document.getElementById('pims-view-time-serve-start').textContent = hiddenData[4].textContent;
                        document.getElementById('pims-view-time-serve-end').textContent = hiddenData[5].textContent;
                        document.getElementById('pims-view-emergency-contact-name').textContent = hiddenData[6].textContent;
                        document.getElementById('pims-view-emergency-contact-relation').textContent = hiddenData[7].textContent;
                        document.getElementById('pims-view-emergency-contact-number').textContent = hiddenData[8].textContent;
                        document.getElementById('pims-view-created-at').textContent = hiddenData[9].textContent;
                        document.getElementById('pims-view-updated-at').textContent = hiddenData[10].textContent;
                        
                        // Set image
                        const imageUrl = hiddenData[9].textContent;
                        document.getElementById('pims-view-inmate-image').src = imageUrl.includes('http') ? imageUrl : 'default-profile.png';
                        
                        viewModal.classList.add('active');
                    }
                });
            });
            
            // Close modal
            closeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    viewModal.classList.remove('active');
                });
            });
            
            // Close when clicking outside modal
            viewModal.addEventListener('click', (e) => {
                if (e.target === viewModal) {
                    viewModal.classList.remove('active');
                }
            });
            
            // Status change handler
            document.querySelectorAll('.pims-prisoner-status').forEach(select => {
                select.addEventListener('change', function() {
                    const prisonerId = this.getAttribute('data-id');
                    const newStatus = this.value;
                    
                    fetch(`/prisoner/${prisonerId}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ status: newStatus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const row = document.getElementById(`pims-prisoner-row-${prisonerId}`);
                            const statusCell = row.querySelector('td:nth-child(7)');
                            
                            // Update status tag
                            statusCell.innerHTML = '';
                            const tag = document.createElement('span');
                            tag.className = 'pims-tag ';
                            
                            if (newStatus === 'Active') tag.className += 'pims-tag-success';
                            else if (newStatus === 'Inactive') tag.className += 'pims-tag-danger';
                            else if (newStatus === 'Released') tag.className += 'pims-tag-info';
                            
                            tag.textContent = newStatus;
                            statusCell.appendChild(tag);
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated',
                                text: `Prisoner status changed to ${newStatus}`,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Update Failed',
                                text: data.message || 'Failed to update status'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while updating status'
                        });
                    });
                });
            });
        });
    </script>
    
    @include('includes.footer_js')
</body>
</html>