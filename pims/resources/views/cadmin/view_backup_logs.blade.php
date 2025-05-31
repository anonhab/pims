<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backup Logs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('includes.head')
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- PIMS Custom Styles -->
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
            padding-top: 70px;
            display: flex;
            min-height: 100vh;
        }

        .pims-menu {
            width: 250px;
            background-color: var(--pims-primary);
            color: white;
            padding: 20px;
            border-radius: var(--pims-border-radius);
            margin-right: 20px;
            box-shadow: var(--pims-box-shadow);
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

        .pims-page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            margin-bottom: 1.5rem;
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
        }

        .pims-card-header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        .pims-table-container {
            overflow-x: auto;
        }

        .pims-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: var(--pims-border-radius);
            overflow: hidden;
        }

        .pims-table th {
            background-color: var(--pims-primary);
            color: white;
            font-weight: 500;
            text-align: left;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .pims-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .pims-table tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .pims-alert {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .pims-alert-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

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

        .pims-btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
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
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.7);
            
            transition: all 0.3s ease;
        }

        .pims-modal.active .pims-modal-container {
            transform: scale(1);
            opacity: 1;
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.75rem;
            cursor: pointer;
            color: var(--pims-secondary);
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

        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .pims-menu {
                width: 100%;
                margin-right: 0;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 768px) {
            .pims-table th:nth-child(4),
            .pims-table td:nth-child(4) {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="pims-app-container">
        @include('cadmin.menu')

        <main class="pims-main-content">
            <div class="pims-content-container">
                <h1 class="pims-page-title">
                    <i class="fas fa-database"></i> Backup Logs
                </h1>

                @if (session('error'))
                    <div class="pims-alert pims-alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="pims-card">
                    <div class="pims-card-body">
                        <div class="pims-table-container">
                            <table class="pims-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Initiated By</th>
                                        <th>Backup Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($backups as $backup)
                                        <tr>
                                            <td>{{ $backup->id }}</td>
                                            <td>{{ $backup->initiated_by ?? 'Unknown' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($backup->backup_date)->format('M d, Y H:i') }}</td>
                                            <td>{{ ucfirst($backup->backup_status) }}</td>
                                            <td>
                                                <button class="pims-btn pims-btn-sm pims-btn-primary" onclick="pimsShowDetails({{ $backup->id }})">
                                                    <i class="fas fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="pims-text-center">No backup logs found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Details -->
    <div class="pims-modal" id="pims-details-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h5 class="pims-modal-title">Backup Details</h5>
                <button class="pims-modal-close">&times;</button>
            </div>
            <div class="pims-modal-body" id="pims-details-content">
                <!-- Populated by JS -->
            </div>
            <div class="pims-modal-footer">
                <button class="pims-btn pims-btn-secondary pims-modal-close-btn">Close</button>
            </div>
        </div>
    </div>

    <script>
        function pimsShowDetails(id) {
            const backups = @json($backups);
            const backup = backups.find(b => b.id === id);

            if (backup) {
                const details = `
                    <div class="pims-detail-item">
                        <strong>ID:</strong>
                        <span>${backup.id}</span>
                    </div>
                    <div class="pims-detail-item">
                        <strong>Initiated By:</strong>
                        <span>${backup.initiated_by || 'Unknown'}</span>
                    </div>
                    <div class="pims-detail-item">
                        <strong>Backup Date:</strong>
                        <span>${new Date(backup.backup_date).toLocaleString()}</span>
                    </div>
                    <div class="pims-detail-item">
                        <strong>Status:</strong>
                        <span>${backup.backup_status.charAt(0).toUpperCase() + backup.backup_status.slice(1)}</span>
                    </div>
                `;
                document.getElementById('pims-details-content').innerHTML = details;
                document.getElementById('pims-details-modal').classList.add('active');
            }
        }

        // Close modal handlers
        document.querySelectorAll('.pims-modal-close, .pims-modal-close-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('pims-details-modal').classList.remove('active');
            });
        });

        // Click outside modal to close
        window.onclick = function(event) {
            if (event.target.classList.contains('pims-modal')) {
                event.target.classList.remove('active');
            }
        };
    </script>
    
    @include('includes.footer_js')
</body>
</html>