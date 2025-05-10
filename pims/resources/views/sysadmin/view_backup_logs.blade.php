<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - System Admin View Backup/Recovery Logs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e6e9f0 0%, #eef1f5 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .pims-app-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .pims-content-area {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 20px;
        }
        .pims-report-title {
            font-size: 28px;
            font-weight: 600;
            color: #1a237e;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }
        .pims-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
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
            font-size: 16px;
        }
        .pims-search-input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid #d1d9e6;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .pims-search-input:focus {
            border-color: #3f51b5;
            box-shadow: 0 0 8px rgba(63, 81, 181, 0.2);
            outline: none;
        }
        .pims-action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .pims-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s;
        }
        .pims-btn-export {
            background: #2ecc71;
            color: #fff;
        }
        .pims-btn-export:hover {
            background: #27ae60;
        }
        .pims-btn-pdf {
            background: #e74c3c;
            color: #fff;
        }
        .pims-btn-pdf:hover {
            background: #c0392b;
        }
        .pims-report-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .pims-report-table th, .pims-report-table td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #e0e7ff;
            font-size: 13px;
        }
        .pims-report-table th {
            background: #e8eaf6;
            color: #1a237e;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .pims-report-table tbody tr:hover {
            background: #f8fafc;
        }
        .pims-status-badge {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            color: #fff;
            display: inline-block;
        }
        .pims-status-completed { background: #2ecc71; }
        .pims-status-failed { background: #e74c3c; }
        .pims-status-in_progress { background: #f1c40f; }
        .pims-pdf-header {
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }
        .pims-pdf-header h1 {
            font-size: 18px;
            font-weight: 600;
            color: #1a237e;
            margin-bottom: 10px;
        }
        .pims-pdf-header p {
            font-size: 12px;
            color: #34495e;
            margin: 5px 0;
        }
        .modal-content {
            border-radius: 10px;
        }
        .modal-header {
            background: #e8eaf6;
            color: #1a237e;
        }
        @media (max-width: 768px) {
            .pims-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .pims-search {
                width: 100%;
            }
            .pims-report-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="pims-app-container">
        @include('sysadmin.menu')
        <div class="pims-content-area">
            <h1 class="pims-report-title">
                <i class="fas fa-database"></i> Prison Management System - View Backup/Recovery Logs
            </h1>
            @if (isset($prison))
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Prison: {{ $prison->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Location:</strong> {{ $prison->location }}</p>
                        <p><strong>Capacity:</strong> {{ $prison->capacity }}</p>
                        <p><strong>Status:</strong> Operational</p>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    No prison assigned to this session.
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="pims-actions">
                <div class="pims-search">
                    <i class="fas fa-search pims-search-icon"></i>
                    <input type="text" id="pimsSearchBackups" class="pims-search-input"
                           placeholder="Search backups..."
                           onkeyup="pimsSearchTable('pimsBackupsTable', 'pimsSearchBackups')">
                </div>
                <div class="pims-action-buttons">
                    <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsBackupsTable', 'PIMS_Backup_Logs.csv')">
                        <i class="fas fa-file-csv"></i> Export CSV
                    </button>
                    <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsBackupsTable', 'PIMS_Backup_Logs.pdf')">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>
            <table class="pims-report-table" id="pimsBackupsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Initiated By</th>
                        <th>Prison</th>
                        <th>Backup Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="backupsBody">
                    @forelse ($backups as $backup)
                        <tr>
                            <td>{{ $backup['id'] }}</td>
                            <td>{{ $backup['initiated_by'] }}</td>
                            <td>{{ $backup['prison_name'] }}</td>
                            <td>{{ $backup['backup_date'] }}</td>
                            <td>
                                <span class="pims-status-badge pims-status-{{ str_replace('_', '-', strtolower($backup['backup_status'])) }}">
                                    {{ $backup['backup_status'] }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="showBackupDetails({{ $backup['id'] }})">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No backup logs found for this prison.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Backup Details -->
    <div class="modal fade" id="backupDetailsModal" tabindex="-1" role="dialog" aria-labelledby="backupDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backupDetailsModalLabel">Backup Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="backupDetailsContent">
                    <!-- Backup details will be populated here -->
                </div>
                <div class="modal-footer">
                    <button class="pims-btn pims-btn-export" onclick="exportBackupCSV()">
                        <i class="fas fa-file-csv"></i> Export CSV
                    </button>
                    <button class="pims-btn pims-btn-pdf" onclick="exportBackupPDF()">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const backupsData = @json($backups);
        const prisonName = "{{ $prison->name ?? 'Unknown Prison' }}";
        const currentDate = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        function showBackupDetails(backupId) {
            const backup = backupsData.find(b => b.id === backupId);
            if (!backup) {
                alert('Backup not found.');
                return;
            }

            let html = `
                <h5>Backup Log #${backup.id}</h5>
                <p><strong>Initiated By:</strong> ${backup.initiated_by}</p>
                <p><strong>Prison:</strong> ${backup.prison_name}</p>
                <p><strong>Backup Date:</strong> ${backup.backup_date}</p>
                <p><strong>Status:</strong> ${backup.backup_status}</p>
            `;
            document.getElementById('backupDetailsContent').innerHTML = html;
            $('#backupDetailsModal').modal('show');
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
                let csv = [
                    `"Prison Management System Backup Logs"`,
                    `"Prison,${prisonName}"`,
                    `"Generated Date,${currentDate}"`,
                    `""`
                ];
                const rows = table.querySelectorAll('tr');
                rows.forEach(row => {
                    const cols = row.querySelectorAll('th, td');
                    const rowData = Array.from(cols)
                        .slice(0, -1) // Exclude Actions column
                        .map(col => {
                            let text = col.textContent.trim();
                            if (text.includes('"') || text.includes(',')) {
                                text = `"${text.replace(/"/g, '""')}"`;
                            }
                            return text;
                        });
                    if (rowData.length > 0) {
                        csv.push(rowData.join(','));
                    }
                });
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
                const pdfContainer = document.createElement('div');
                pdfContainer.style.padding = '20px';
                pdfContainer.style.background = '#fff';
                pdfContainer.style.fontFamily = "'Poppins', sans-serif";
                const header = document.createElement('div');
                header.className = 'pims-pdf-header';
                header.innerHTML = `
                    <h1>Prison Management System Backup Logs</h1>
                    <p><strong>Prison:</strong> ${prisonName}</p>
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
                    th.style.background = '#e8eaf6';
                    th.style.color = '#1a237e';
                    th.style.fontWeight = '600';
                });
                const actionCells = tableClone.querySelectorAll('td:last-child, th:last-child');
                actionCells.forEach(cell => cell.remove());
                pdfContainer.appendChild(tableClone);
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

        function exportBackupCSV() {
            try {
                const modalContent = document.getElementById('backupDetailsContent');
                if (!modalContent) {
                    console.error('Backup details content not found.');
                    alert('Error: Backup details content not found.');
                    return;
                }
                const backupInfo = modalContent.querySelectorAll('p');
                const backupId = modalContent.querySelector('h5').textContent.replace('Backup Log #', '');
                const initiatedBy = backupInfo[0].textContent.replace('Initiated By: ', '');
                const prison = backupInfo[1].textContent.replace('Prison: ', '');
                const backupDate = backupInfo[2].textContent.replace('Backup Date: ', '');
                const status = backupInfo[3].textContent.replace('Status: ', '');
                let csv = [
                    `"Prison Management System Backup Log"`,
                    `"Backup ID,${backupId}"`,
                    `"Initiated By,${initiatedBy}"`,
                    `"Prison,${prison}"`,
                    `"Backup Date,${backupDate}"`,
                    `"Status,${status}"`,
                    `""`
                ];
                const csvContent = csv.join('\n');
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `PIMS_Backup_${backupId}.csv`;
                link.click();
                console.log('Backup CSV exported successfully.');
            } catch (error) {
                console.error('Error exporting backup CSV:', error.message);
                alert('Failed to export backup CSV. Check the console for details.');
            }
        }

        function exportBackupPDF() {
            try {
                const modalContent = document.getElementById('backupDetailsContent');
                if (!modalContent) {
                    console.error('Backup details content not found.');
                    alert('Error: Backup details content not found.');
                    return;
                }
                const pdfContainer = document.createElement('div');
                pdfContainer.style.padding = '20px';
                pdfContainer.style.background = '#fff';
                pdfContainer.style.fontFamily = "'Poppins', sans-serif";
                const contentClone = modalContent.cloneNode(true);
                contentClone.style.fontSize = '12px';
                pdfContainer.appendChild(contentClone);
                const opt = {
                    margin: [10, 10, 10, 10],
                    filename: `PIMS_Backup_${contentClone.querySelector('h5').textContent.replace('Backup Log #', '')}.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };
                html2pdf().set(opt).from(pdfContainer).save();
                console.log('Backup PDF exported successfully.');
            } catch (error) {
                console.error('Error exporting backup PDF:', error.message);
                alert('Failed to export backup PDF. Check the console for details.');
            }
        }
    </script>
</body>
</html>