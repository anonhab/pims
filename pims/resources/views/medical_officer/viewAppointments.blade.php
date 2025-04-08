<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
    <style>
        :root {
            --pims-primary: #1a2a3a;
            --pims-secondary: #2c3e50;
            --pims-accent: #d35400; /* Primary accent color */
            --pims-danger: #c0392b;
            --pims-success: #27ae60;
            --pims-warning: #e67e22;
            --pims-text-light: #ecf0f1;
            --pims-text-dark: #2c3e50;
            --pims-card-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --pims-border-radius: 6px;
            --pims-nav-height: 60px;
            --pims-sidebar-width: 250px;
        }

        /* Full layout styling */
        #pims-app-content {
            display: flex;
            min-height: calc(100vh - var(--pims-nav-height));
        }

        #pims-page-content {
            flex: 1;
            padding: 2rem;
            background-color: #f5f7fa;
        }

        /* Card styling */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .pims-card-filter {
            padding: 1.5rem;
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .pims-card-content {
            padding: 0;
        }

        /* Table styling */
        .pims-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pims-table thead th {
            background-color: var(--pims-secondary);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .pims-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            vertical-align: middle;
        }

        .pims-table tbody tr:hover {
            background-color: rgba(211, 84, 0, 0.05);
        }

        /* Action buttons */
        .pims-action-group {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .pims-action-btn {
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .pims-action-btn:hover {
            background-color: rgba(211, 84, 0, 0.1);
            color: var(--pims-accent);
        }

        /* Form controls */
        .pims-input {
            border-radius: var(--pims-border-radius);
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .pims-input:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.2);
        }

        .pims-select {
            border-radius: var(--pims-border-radius);
        }

        .pims-select:focus {
            border-color: var(--pims-accent);
        }

        /* Buttons */
        .pims-btn {
            border-radius: var(--pims-border-radius);
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: white;
            border: none;
        }

        .pims-btn-primary:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(211, 84, 0, 0.2);
        }

        .pims-btn-secondary {
            background-color: white;
            border: 1px solid #ddd;
            color: var(--pims-text-dark);
        }

        .pims-btn-secondary:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
        }

        /* Icons */
        .pims-icon {
            color: var(--pims-accent);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .pims-card-filter {
                flex-direction: column;
                align-items: stretch;
            }
            
            #pims-page-content {
                padding: 1rem;
            }
            
            .pims-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="pims-app-content">
        @include('medical_officer.menu')

        <div class="column is-10" id="pims-page-content">
            <div class="pims-content-header"></div>

            <div class="pims-content-body">
                <div class="pims-card">
                    <div class="pims-card-filter">
                        <!-- Search and other controls -->
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="pims-input" id="pims-table-search" type="text" placeholder="Search for records...">
                                <span class="icon is-left">
                                    <i class="fa fa-search pims-icon"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="pims-select select">
                                <select id="pims-table-length">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="field has-addons">
                            <p class="control">
                                <a class="pims-btn pims-btn-primary" href="#">
                                    <span class="icon is-small">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span>Create Record</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="pims-btn pims-btn-secondary" id="pims-table-reload">
                                    <span class="icon is-small">
                                        <i class="fa fa-refresh"></i>
                                    </span>
                                    <span>Reload</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="pims-card-content">
                        <!-- Table Section -->
                        <table class="pims-table is-hoverable is-bordered is-fullwidth" id="pims-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Appointment</th>
                                    <th>Medical Officer</th>
                                    <th>Report Date</th>
                                    <th>Findings</th>
                                    <th>Recommendations</th>
                                    <th class="has-text-centered">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>John Doe - 15/05/2023</td>
                                    <td>Dr. Smith</td>
                                    <td>16/05/2023</td>
                                    <td>High blood pressure detected.</td>
                                    <td>Prescribed medication and follow-up in 2 weeks.</td>
                                    <td class="has-text-centered">
                                        <div class="pims-action-group">
                                            <a href="#" class="pims-action-btn">
                                                <span class="icon">
                                                    <i class="fa fa-edit pims-icon"></i>
                                                </span>
                                            </a>
                                            <a class="pims-action-btn pims-action-delete" data-id="1">
                                                <span class="icon">
                                                    <i class="fa fa-trash pims-icon"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith - 20/08/2023</td>
                                    <td>Dr. Johnson</td>
                                    <td>21/08/2023</td>
                                    <td>Injury healing well, no signs of infection.</td>
                                    <td>Continue current treatment and monitor progress.</td>
                                    <td class="has-text-centered">
                                        <div class="pims-action-group">
                                            <a href="#" class="pims-action-btn">
                                                <span class="icon">
                                                    <i class="fa fa-edit pims-icon"></i>
                                                </span>
                                            </a>
                                            <a class="pims-action-btn pims-action-delete" data-id="2">
                                                <span class="icon">
                                                    <i class="fa fa-trash pims-icon"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 3 -->
                                <tr>
                                    <td>3</td>
                                    <td>Bob Johnson - 10/12/2023</td>
                                    <td>Dr. Brown</td>
                                    <td>11/12/2023</td>
                                    <td>Mild tooth decay detected.</td>
                                    <td>Recommended dental cleaning and fluoride treatment.</td>
                                    <td class="has-text-centered">
                                        <div class="pims-action-group">
                                            <a href="#" class="pims-action-btn">
                                                <span class="icon">
                                                    <i class="fa fa-edit pims-icon"></i>
                                                </span>
                                            </a>
                                            <a class="pims-action-btn pims-action-delete" data-id="3">
                                                <span class="icon">
                                                    <i class="fa fa-trash pims-icon"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('pims-table-search');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#pims-datatable tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });

            // Reload button
            document.getElementById('pims-table-reload').addEventListener('click', function() {
                window.location.reload();
            });

            // Delete button functionality
            document.querySelectorAll('.pims-action-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const recordId = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this record?')) {
                        // Here you would typically make an AJAX call to delete the record
                        console.log('Deleting record with ID:', recordId);
                        this.closest('tr').style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>