<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - System Admin Report Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-primary);
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
        }

        .pims-app-container {
            max-width: 1400px;
            margin: 0 auto;
            padding-top: 70px;
        }

        .pims-content-area {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 30px;
            margin-bottom: 20px;
        }

        .pims-report-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .pims-report-title i {
            color: var(--pims-accent);
        }

        .pims-form {
            background: var(--pims-lighter);
            border-radius: var(--pims-border-radius);
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 2rem;
            box-shadow: var(--pims-box-shadow);
        }

        .pims-form label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--pims-secondary);
            margin-bottom: 0.5rem;
            display: block;
        }

        .pims-form select, 
        .pims-form input {
            width: 250px;
            padding: 0.75rem;
            border: 1px solid #d1d9e6;
            border-radius: var(--pims-border-radius);
            font-size: 0.9rem;
            background: #fff;
            transition: var(--pims-transition);
        }

        .pims-form select:focus, 
        .pims-form input:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            outline: none;
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
        }

        .pims-btn-secondary {
            background-color: var(--pims-secondary);
            color: white;
        }

        .pims-btn-secondary:hover {
            background-color: #2c3e50;
        }

        .pims-btn-success {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-success:hover {
            background-color: #27ae60;
        }

        .pims-btn-danger {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-danger:hover {
            background-color: #c0392b;
        }

        .pims-btn:disabled {
            background: #b0bec5;
            cursor: not-allowed;
        }

        .pims-tabs {
            display: flex;
            border-bottom: 2px solid var(--pims-light);
            margin-bottom: 1.5rem;
            overflow-x: auto;
        }

        .pims-tablink {
            padding: 0.75rem 1.5rem;
            background: var(--pims-light);
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--pims-secondary);
            transition: var(--pims-transition);
            white-space: nowrap;
        }

        .pims-tablink:hover, 
        .pims-tablink.pims-active {
            background: var(--pims-accent);
            color: white;
            border-radius: var(--pims-border-radius) var(--pims-border-radius) 0 0;
        }

        .pims-report-content {
            display: none;
        }

        .pims-report-content.pims-active {
            display: block;
        }

        .pims-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-search {
            position: relative;
            width: 300px;
            max-width: 100%;
        }

        .pims-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #90a4ae;
            font-size: 1rem;
        }

        .pims-search-input {
            width: 100%;
            padding: 0.75rem 0.75rem 0.75rem 2.5rem;
            border: 1px solid #d1d9e6;
            border-radius: var(--pims-border-radius);
            font-size: 0.9rem;
            transition: var(--pims-transition);
        }

        .pims-search-input:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            outline: none;
        }

        .pims-action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .pims-report-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            border-radius: var(--pims-border-radius);
            overflow: hidden;
            box-shadow: var(--pims-box-shadow);
        }

        .pims-report-table th, 
        .pims-report-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--pims-light);
            font-size: 0.85rem;
        }

        .pims-report-table th {
            background: var(--pims-primary);
            color: white;
            font-weight: 500;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .pims-report-table tbody tr:hover {
            background: rgba(52, 152, 219, 0.05);
        }

        .pims-status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims-status-resolved { 
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
        }
        .pims-status-pending { 
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--pims-warning);
        }
        .pims-status-banned { 
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
        }

        .pims-alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--pims-border-radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-alert-warning {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--pims-warning);
            border-left: 4px solid var(--pims-warning);
        }

        .pims-alert i {
            font-size: 1.25rem;
        }

        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .pims-card-header {
            background: linear-gradient(135deg, var(--pims-primary) 0%, var(--pims-secondary) 100%);
            color: white;
            padding: 1rem 1.5rem;
        }

        .pims-card-header h5 {
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
        }

        .pims-card-body {
            padding: 1.5rem;
        }

        .pims-card-body p {
            margin-bottom: 0.5rem;
        }

        .pims-card-body strong {
            font-weight: 500;
            color: var(--pims-secondary);
        }

        @media (max-width: 992px) {
            .pims-form {
                flex-direction: column;
                align-items: stretch;
            }
            
            .pims-form select, 
            .pims-form input {
                width: 100%;
            }
            
            .pims-actions {
                flex-direction: column;
                align-items: stretch;
            }
            
            .pims-search {
                width: 100%;
            }
            
            .pims-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
            }
            
            .pims-report-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 768px) {
            .pims-app-container {
                padding-top: 60px;
            }
            
            .pims-content-area {
                padding: 1.5rem;
            }
            
            .pims-report-title {
                font-size: 1.5rem;
            }
            
            .pims-tablink {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .pims-content-area {
                padding: 1rem;
            }
            
            .pims-action-buttons {
                width: 100%;
            }
            
            .pims-action-buttons .pims-btn {
                flex-grow: 1;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    @include('sysadmin.menu')
    <div class="pims-app-container">
        <div class="pims-content-area">
            <div class="pims-report-container">
                <h1 class="pims-report-title">
                    <i class="fas fa-file-alt"></i> System Admin Reports
                </h1>
                
                @if (isset($prison))
                <div class="pims-card">
                    <div class="pims-card-header">
                        <h5>Prison: {{ $prison->name }}</h5>
                    </div>
                    <div class="pims-card-body">
                        <p><strong>Location:</strong> {{ $prison->location }}</p>
                        <p><strong>Capacity:</strong> {{ $prison->capacity }}</p>
                        <p><strong>Status:</strong> Operational</p>
                    </div>
                </div>
                @else
                <div class="pims-alert pims-alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    No prison assigned to this session.
                </div>
                @endif
                
                <div class="pims-form">
                    <div>
                        <label for="pims-reportType">Report Type</label>
                        <select id="pims-reportType">
                            <option value="all_accounts">All Accounts</option>
                            <option value="staff">Staff</option>
                            <option value="prisoners">Prisoners</option>
                            <option value="all_prisons">Prison Details</option>
                        </select>
                    </div>
                    <button id="pims-generateReportBtn" class="pims-btn pims-btn-primary" onclick="pimsGenerateReport()">
                        <i class="fas fa-play"></i> Generate Report
                    </button>
                  
                </div>
                
                <div class="pims-tabs">
                    <button class="pims-tablink pims-active" onclick="pimsOpenReport(event, 'pims-allAccounts')">
                        <i class="fas fa-gavel"></i> All Accounts
                    </button>
                    <button class="pims-tablink" onclick="pimsOpenReport(event, 'pims-staffInPrison')">
                        <i class="fas fa-exclamation-triangle"></i> Staff in Prison
                    </button>
                    <button class="pims-tablink" onclick="pimsOpenReport(event, 'pims-prisonersInPrison')">
                        <i class="fas fa-users"></i> Prisoners in Prison
                    </button>
                    <button class="pims-tablink" onclick="pimsOpenReport(event, 'pims-allPrisons')">
                        <i class="fas fa-building"></i> Prison Details
                    </button>
                </div>
                
                <div id="pims-allAccounts" class="pims-report-content pims-active">
                    <div class="pims-actions">
                        <div class="pims-search">
                            <i class="fas fa-search pims-search-icon"></i>
                            <input type="text" id="pims-searchAllAccounts" class="pims-search-input" 
                                   placeholder="Search all accounts..." 
                                   onkeyup="pimsSearchTable('pims-allAccountsTable', 'pims-searchAllAccounts')">
                        </div>
                        <div class="pims-action-buttons">
                            <button class="pims-btn pims-btn-success" onclick="pimsExportCSV('pims-allAccountsTable', 'PIMS_All_Accounts.csv')">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </button>
                            <button class="pims-btn pims-btn-danger" onclick="pimsExportPDF('pims-allAccountsTable', 'PIMS_All_Accounts.pdf')">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    <table class="pims-report-table" id="pims-allAccountsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Prison</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="pims-allAccountsBody">
                        </tbody>
                    </table>
                </div>
                
                <div id="pims-staffInPrison" class="pims-report-content">
                    <div class="pims-actions">
                        <div class="pims-search">
                            <i class="fas fa-search pims-search-icon"></i>
                            <input type="text" id="pims-searchStaff" class="pims-search-input" 
                                   placeholder="Search staff..." 
                                   onkeyup="pimsSearchTable('pims-staffTable', 'pims-searchStaff')">
                        </div>
                        <div class="pims-action-buttons">
                            <button class="pims-btn pims-btn-success" onclick="pimsExportCSV('pims-staffTable', 'PIMS_Staff.csv')">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </button>
                            <button class="pims-btn pims-btn-danger" onclick="pimsExportPDF('pims-staffTable', 'PIMS_Staff.pdf')">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    <table class="pims-report-table" id="pims-staffTable">
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Prison</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="pims-staffBody">
                        </tbody>
                    </table>
                </div>
                
                <div id="pims-prisonersInPrison" class="pims-report-content">
                    <div class="pims-actions">
                        <div class="pims-search">
                            <i class="fas fa-search pims-search-icon"></i>
                            <input type="text" id="pims-searchPrisoners" class="pims-search-input" 
                                   placeholder="Search prisoners..." 
                                   onkeyup="pimsSearchTable('pims-prisonersTable', 'pims-searchPrisoners')">
                        </div>
                        <div class="pims-action-buttons">
                            <button class="pims-btn pims-btn-success" onclick="pimsExportCSV('pims-prisonersTable', 'PIMS_Prisoners.csv')">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </button>
                            <button class="pims-btn pims-btn-danger" onclick="pimsExportPDF('pims-prisonersTable', 'PIMS_Prisoners.pdf')">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    <table class="pims-report-table" id="pims-prisonersTable">
                        <thead>
                            <tr>
                                <th>Prisoner ID</th>
                                <th>Name</th>
                                <th>Prison</th>
                                <th>Sentence</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="pims-prisonersBody">
                        </tbody>
                    </table>
                </div>
                
                <div id="pims-allPrisons" class="pims-report-content">
                    <div class="pims-actions">
                        <div class="pims-search">
                            <i class="fas fa-search pims-search-icon"></i>
                            <input type="text" id="pims-searchPrisons" class="pims-search-input" 
                                   placeholder="Search prison..." 
                                   onkeyup="pimsSearchTable('pims-prisonsTable', 'pims-searchPrisons')">
                        </div>
                        <div class="pims-action-buttons">
                            <button class="pims-btn pims-btn-success" onclick="pimsExportCSV('pims-prisonsTable', 'PIMS_Prison.csv')">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </button>
                            <button class="pims-btn pims-btn-danger" onclick="pimsExportPDF('pims-prisonsTable', 'PIMS_Prison.pdf')">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    <table class="pims-report-table" id="pims-prisonsTable">
                        <thead>
                            <tr>
                                <th>Prison ID</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Capacity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="pims-prisonsBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const PIMS_BASE_URL = 'http://127.0.0.1:8000/';
        const PIMS_CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const PIMS_CURRENT_USER = "{{ session('user_name') ?? 'Unknown User' }}";
        let PIMS_lastReportRequest = 0;
        const PIMS_DEBOUNCE_MS = 1000;

        async function pimsInitiateBackup() {
            const btn = document.getElementById('pims-initiateBackupBtn');
            btn.disabled = true;
            let percent = 0;
            const progressInterval = setInterval(() => {
                percent += Math.floor(Math.random() * 10) + 5;
                if (percent >= 100) {
                    percent = 100;
                    clearInterval(progressInterval);
                }
                btn.textContent = `Backing Up... (${PIMS_CURRENT_USER}) ${percent}%`;
            }, 300);

            try {
                const response = await fetch(`${PIMS_BASE_URL}sinitiate_backup`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': PIMS_CSRF_TOKEN
                    }
                });

                if (!response.ok) {
                    const data = await response.json();
                    throw new Error(data.error || 'Backup failed');
                }

                const filename = response.headers.get('Content-Disposition')?.match(/filename="(.+)"/)?.[1] || 'backup.sql';
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = filename;
                a.click();
                window.URL.revokeObjectURL(url);
                alert('Backup downloaded: ' + filename);
            } catch (error) {
                console.error('Backup error:', error.message);
                alert('Backup failed: ' + error.message);
            } finally {
                clearInterval(progressInterval);
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-download"></i> Initiate Backup';
            }
        }

        function pimsGetReportTypeEnum(reportType) {
            const mapping = {
                all_accounts: 'all_accounts',
                staff: 'staff',
                prisoners: 'prisoners',
                all_prisons: 'all_prisons'
            };
            return mapping[reportType] || 'all_accounts';
        }

        function pimsGetReportTypeName(reportType) {
            const names = {
                all_accounts: 'All Accounts',
                staff: 'Staff',
                prisoners: 'Prisoners',
                all_prisons: 'Prison Details'
            };
            return names[reportType] || reportType;
        }

        function pimsGetSelectedPrisonNames() {
            return "{{ $prison->name ?? 'Unknown Prison' }}";
        }

        async function pimsTrackReport(reportType, content) {
            try {
                const response = await fetch(`${PIMS_BASE_URL}sreports/store`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': PIMS_CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        report_type: pimsGetReportTypeEnum(reportType),
                        content: JSON.stringify(content)
                    })
                });
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(`HTTP ${response.status}: ${errorData.error || 'Failed to track report'}`);
                }
                console.log('Report tracked successfully:', reportType);
            } catch (error) {
                console.error('Error tracking report:', error.message);
            }
        }

        async function pimsGenerateReport() {
            const now = Date.now();
            if (now - PIMS_lastReportRequest < PIMS_DEBOUNCE_MS) {
                console.log('Debounced report generation attempt');
                return;
            }
            PIMS_lastReportRequest = now;

            const generateBtn = document.getElementById('pims-generateReportBtn');
            generateBtn.disabled = true;
            generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';

            try {
                const reportType = document.getElementById('pims-reportType').value;
                const params = new URLSearchParams();
                params.append('report_type', reportType);

                console.log('Generating report:', { reportType });

                const response = await fetch(`${PIMS_BASE_URL}sreports?${params.toString()}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': PIMS_CSRF_TOKEN
                    }
                });
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(`HTTP ${response.status}: ${errorData.error || 'Failed to fetch report data'}`);
                }
                const data = await response.json();

                document.getElementById('pims-allAccountsBody').innerHTML = '';
                document.getElementById('pims-staffBody').innerHTML = '';
                document.getElementById('pims-prisonersBody').innerHTML = '';
                document.getElementById('pims-prisonsBody').innerHTML = '';

                const intro = {
                    title: 'Prison Management System Report',
                    report_type: pimsGetReportTypeName(reportType),
                    selected_prisons: pimsGetSelectedPrisonNames(),
                    generated_date: new Date().toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })
                };

                switch (reportType) {
                    case 'all_accounts':
                        const allAccountsBody = document.getElementById('pims-allAccountsBody');
                        (data.staff || []).forEach(staff => {
                            allAccountsBody.innerHTML += `
                                <tr>
                                    <td>${staff.id}</td>
                                    <td>${staff.name}</td>
                                    <td>${staff.role}</td>
                                    <td>${staff.prison || 'None'}</td>
                                    <td><span class="pims-status-badge pims-status-resolved">${staff.status}</span></td>
                                </tr>
                            `;
                        });
                        (data.prisoners || []).forEach(prisoner => {
                            allAccountsBody.innerHTML += `
                                <tr>
                                    <td>${prisoner.id}</td>
                                    <td>${prisoner.name}</td>
                                    <td>${prisoner.role}</td>
                                    <td>${prisoner.prison || 'None'}</td>
                                    <td><span class="pims-status-badge pims-status-pending">${prisoner.status}</span></td>
                                </tr>
                            `;
                        });
                        pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="pims-allAccounts"]') }, 'pims-allAccounts');
                        break;
                    case 'staff':
                        const staffBody = document.getElementById('pims-staffBody');
                        (data || []).forEach(staff => {
                            staffBody.innerHTML += `
                                <tr>
                                    <td>${staff.id}</td>
                                    <td>${staff.name}</td>
                                    <td>${staff.role}</td>
                                    <td>${staff.prison || 'None'}</td>
                                    <td><span class="pims-status-badge pims-status-resolved">${staff.status}</span></td>
                                </tr>
                            `;
                        });
                        pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="pims-staffInPrison"]') }, 'pims-staffInPrison');
                        break;
                    case 'prisoners':
                        const prisonersBody = document.getElementById('pims-prisonersBody');
                        (data || []).forEach(prisoner => {
                            prisonersBody.innerHTML += `
                                <tr>
                                    <td>${prisoner.id}</td>
                                    <td>${prisoner.name}</td>
                                    <td>${prisoner.prison || 'None'}</td>
                                    <td>${prisoner.sentence}</td>
                                    <td><span class="pims-status-badge pims-status-pending">${prisoner.status}</span></td>
                                </tr>
                            `;
                        });
                        pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="pims-prisonersInPrison"]') }, 'pims-prisonersInPrison');
                        break;
                    case 'all_prisons':
                        const prisonsBody = document.getElementById('pims-prisonsBody');
                        (data || []).forEach(prison => {
                            const statusClass = prison.status === "Operational" ? "pims-status-resolved" : "pims-status-pending";
                            prisonsBody.innerHTML += `
                                <tr>
                                    <td>${prison.id}</td>
                                    <td>${prison.name}</td>
                                    <td>${prison.location}</td>
                                    <td>${prison.capacity}</td>
                                    <td><span class="pims-status-badge ${statusClass}">${prison.status}</span></td>
                                </tr>
                            `;
                        });
                        pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="pims-allPrisons"]') }, 'pims-allPrisons');
                        break;
                    default:
                        alert('Invalid report type selected.');
                }
            } catch (error) {
                console.error('Error generating report:', error.message);
                alert(`Failed to generate report: ${error.message}. Check the console for details.`);
            } finally {
                generateBtn.disabled = false;
                generateBtn.innerHTML = '<i class="fas fa-play"></i> Generate Report';
            }
        }

        function pimsOpenReport(event, reportName) {
            document.querySelectorAll('.pims-report-content').forEach(content => {
                content.classList.remove('pims-active');
            });
            document.querySelectorAll('.pims-tablink').forEach(tab => {
                tab.classList.remove('pims-active');
            });
            document.getElementById(reportName).classList.add('pims-active');
            event.currentTarget.classList.add('pims-active');
        }

        function pimsSearchTable(tableId, inputId) {
            const input = document.getElementById(inputId);
            const filter = input.value.toLowerCase();
            const table = document.getElementById(tableId);
            const tr = table.getElementsByTagName('tr');
            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < td.length; j++) {
                    if (td[j] && td[j].textContent.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
                tr[i].style.display = match ? '' : 'none';
            }
        }

        function pimsExportCSV(tableId, filename) {
            try {
                const table = document.getElementById(tableId);
                if (!table) {
                    console.error('Table not found:', tableId);
                    alert('Error: Table not found for export.');
                    return;
                }
                const reportType = document.getElementById('pims-reportType').value;
                const reportTypeName = pimsGetReportTypeName(reportType);
                const prisonNames = pimsGetSelectedPrisonNames();
                const currentDate = new Date().toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                let csv = [
                    `"Prison Management System Report"`,
                    `"Report Type,${reportTypeName}"`,
                    `"Selected Prison,${prisonNames}"`,
                    `"Generated Date,${currentDate}"`,
                    `""`
                ];
                const rows = table.querySelectorAll('tr');
                const tableData = [];
                rows.forEach(row => {
                    const cols = row.querySelectorAll('th, td');
                    const rowData = Array.from(cols).map(col => {
                        let text = col.textContent.trim();
                        if (text.includes('"') || text.includes(',')) {
                            text = `"${text.replace(/"/g, '""')}"`;
                        }
                        return text;
                    });
                    csv.push(rowData.join(','));
                    tableData.push(rowData);
                });
                const content = {
                    intro: {
                        title: 'Prison Management System Report',
                        report_type: reportTypeName,
                        selected_prisons: prisonNames,
                        generated_date: currentDate
                    },
                    table: tableData
                };
                pimsTrackReport(reportType, content);
                const csvContent = csv.join('\n');
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = filename;
                link.click();
                console.log('CSV exported successfully:', filename);
            } catch (error) {
                console.error('Error exporting CSV:', error.message);
                alert('Failed to export CSV. Check the console for details.');
            }
        }

        function pimsExportPDF(tableId, filename) {
            try {
                const table = document.getElementById(tableId);
                if (!table) {
                    console.error('Table not found:', tableId);
                    alert('Error: Table not found for export.');
                    return;
                }
                const reportType = document.getElementById('pims-reportType').value;
                const reportTypeName = pimsGetReportTypeName(reportType);
                const prisonNames = pimsGetSelectedPrisonNames();
                const currentDate = new Date().toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                const pdfContainer = document.createElement('div');
                pdfContainer.style.padding = '20px';
                pdfContainer.style.background = '#fff';
                pdfContainer.style.fontFamily = "'Poppins', sans-serif";
                const header = document.createElement('div');
                header.className = 'pims-pdf-header';
                header.innerHTML = `
                    <h1>Prison Management System Report</h1>
                    <p><strong>Report Type:</strong> ${reportTypeName}</p>
                    <p><strong>Selected Prison:</strong> ${prisonNames}</p>
                    <p><strong>Generated Date:</strong> ${currentDate}</p>
                `;
                pdfContainer.appendChild(header);
                const tableClone = table.cloneNode(true);
                tableClone.style.width = '100%';
                tableClone.style.borderCollapse = 'collapse';
                tableClone.style.fontSize = '12px';
                tableClone.querySelectorAll('th, td').forEach(cell => {
                    cell.style.border = '1px solid #e0e7ff';
                    cell.style.padding = '8px';
                });
                tableClone.querySelectorAll('th').forEach(th => {
                    th.style.background = '#2c3e50';
                    th.style.color = '#fff';
                    th.style.fontWeight = '500';
                });
                tableClone.querySelectorAll('.pims-status-badge').forEach(badge => {
                    badge.style.padding = '4px 8px';
                    badge.style.borderRadius = '10px';
                    badge.style.color = '#fff';
                });
                pdfContainer.appendChild(tableClone);
                const rows = table.querySelectorAll('tr');
                const tableData = [];
                rows.forEach(row => {
                    const cols = row.querySelectorAll('th, td');
                    const rowData = Array.from(cols).map(col => col.textContent.trim());
                    tableData.push(rowData);
                });
                const content = {
                    intro: {
                        title: 'Prison Management System Report',
                        report_type: reportTypeName,
                        selected_prisons: prisonNames,
                        generated_date: currentDate
                    },
                    table: tableData
                };
                pimsTrackReport(reportType, content);
                const opt = {
                    margin: [10, 10, 10, 10],
                    filename: filename,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };
                html2pdf().set(opt).from(pdfContainer).save();
                console.log('PDF exported successfully:', filename);
            } catch (error) {
                console.error('Error exporting PDF:', error.message);
                alert('Failed to export PDF. Check the console for details.');
            }
        }
    </script>
    @include('includes.footer_js')
</body>
</html>