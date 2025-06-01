<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - System Admin View Reports</title>
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
        }

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

        .pims-content-area {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-box-shadow);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

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
            padding: 1.25rem 1.5rem;
        }

        .pims-card-header h5 {
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0;
        }

        .pims-card-body {
            padding: 1.5rem;
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

        .pims-alert-danger {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--pims-danger);
            border-left: 4px solid var(--pims-danger);
        }

        .pims-search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pims-search-box {
            position: relative;
            width: 300px;
            max-width: 100%;
        }

        .pims-search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-secondary);
        }

        .pims-search-input {
            width: 100%;
            padding: 0.75rem 0.75rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 0.9rem;
            transition: var(--pims-transition);
        }

        .pims-search-input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .pims-action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
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

        .pims-btn-export {
            background-color: var(--pims-success);
            color: white;
        }

        .pims-btn-export:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }

        .pims-btn-pdf {
            background-color: var(--pims-danger);
            color: white;
        }

        .pims-btn-pdf:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
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
            box-shadow: var(--pims-box-shadow);
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

        .pims-btn-view {
            background-color: var(--pims-accent);
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .pims-btn-view:hover {
            background-color: #2980b9;
        }

        .pims-text-center {
            text-align: center;
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
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h5 {
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
        }

        @media (max-width: 768px) {
            .pims-search-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .pims-search-box {
                width: 100%;
            }
            
            .pims-action-buttons {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="pims-app-container">
        @include('sysadmin.menu')
        <main class="pims-main-content">
            <div class="pims-content-container">
                <div class="pims-content-area">
                    <h2 class="pims-page-title">
                        <i class="fas fa-file-alt"></i> Prison Management System - View Reports
                    </h2>
                    
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
                            <i class="fas fa-exclamation-circle"></i>
                            No prison assigned to this session.
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="pims-alert pims-alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="pims-search-container">
                        <div class="pims-search-box">
                            <i class="fas fa-search pims-search-icon"></i>
                            <input type="text" id="pims-search-reports" class="pims-search-input"
                                   placeholder="Search reports..."
                                   onkeyup="pimsSearchTable('pims-reports-table', 'pims-search-reports')">
                        </div>
                        <div class="pims-action-buttons">
                            <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pims-reports-table', 'PIMS_Reports_List.csv')">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </button>
                            <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pims-reports-table', 'PIMS_Reports_List.pdf')">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    
                    <div class="pims-table-container">
                        <table class="pims-table" id="pims-reports-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Generated By</th>
                                    <th>Report Type</th>
                                    <th>Generated Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="pims-reports-body">
                                @forelse ($reports as $report)
                                    <tr>
                                        <td>{{ $report['id'] }}</td>
                                        <td>{{ $report['generated_by'] }}</td>
                                        <td>{{ $report['report_type'] }}</td>
                                        <td>{{ $report['created_at'] }}</td>
                                        <td>
                                            <button class="pims-btn pims-btn-view" onclick="pimsShowReportDetails({{ $report['id'] }})">
                                                <i class="fas fa-eye"></i> View Details
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="pims-text-center">No reports found for this prison.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Report Details -->
    <div class="pims-modal" id="pims-report-details-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h5><i class="fas fa-file-alt"></i> Report Details</h5>
                <button class="pims-modal-close">&times;</button>
            </div>
            <div class="pims-modal-body" id="pims-report-details-content">
                <!-- Report details will be populated here -->
            </div>
            <div class="pims-modal-footer">
                <button class="pims-btn pims-btn-export" onclick="pimsExportReportCSV()">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button class="pims-btn pims-btn-pdf" onclick="pimsExportReportPDF()">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
                <button class="pims-btn pims-btn-secondary pims-modal-close-btn">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const pimsReportsData = @json($reports);
        const pimsPrisonName = "{{ $prison->name ?? 'Unknown Prison' }}";
        const pimsCurrentDate = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        function pimsShowReportDetails(reportId) {
            const report = pimsReportsData.find(r => r.id === reportId);
            if (!report) {
                alert('Report not found.');
                return;
            }

            const content = report.content;
            let html = `
                <h5>${content.intro.title}</h5>
                <p><strong>Report Type:</strong> ${content.intro.report_type}</p>
                <p><strong>Selected Prison:</strong> ${content.intro.selected_prisons}</p>
                <p><strong>Generated Date:</strong> ${content.intro.generated_date}</p>
                <hr>
                <div class="pims-table-container">
                    <table class="pims-table" id="pims-report-details-table">
                        <thead>
                            <tr>
                                ${content.table[0].map(header => `<th>${header}</th>`).join('')}
                            </tr>
                        </thead>
                        <tbody>
                            ${content.table.slice(1).map(row => `
                                <tr>
                                    ${row.map(cell => `<td>${cell}</td>`).join('')}
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            `;
            document.getElementById('pims-report-details-content').innerHTML = html;
            document.getElementById('pims-report-details-modal').classList.add('active');
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
                    `"Prison Management System Reports List"`,
                    `"Prison,${pimsPrisonName}"`,
                    `"Generated Date,${pimsCurrentDate}"`,
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
                header.innerHTML = `
                    <h2 style="color: var(--pims-primary); margin-bottom: 10px;">Prison Management System Reports List</h2>
                    <p style="color: var(--pims-secondary); margin-bottom: 5px;"><strong>Prison:</strong> ${pimsPrisonName}</p>
                    <p style="color: var(--pims-secondary);"><strong>Generated Date:</strong> ${pimsCurrentDate}</p>
                    <hr style="margin: 15px 0; border-color: #eee;">
                `;
                pdfContainer.appendChild(header);
                const tableClone = table.cloneNode(true);
                tableClone.style.width = '100%';
                tableClone.style.borderCollapse = 'collapse';
                tableClone.style.fontSize = '12px';
                tableClone.querySelectorAll('th, td').forEach(cell => {
                    cell.style.border = '1px solid #eee';
                    cell.style.padding = '8px';
                });
                tableClone.querySelectorAll('th').forEach(th => {
                    th.style.background = 'var(--pims-primary)';
                    th.style.color = 'white';
                    th.style.fontWeight = '500';
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

        function pimsExportReportCSV() {
            try {
                const reportTable = document.getElementById('pims-report-details-table');
                if (!reportTable) {
                    console.error('Report details table not found.');
                    alert('Error: Report details table not found.');
                    return;
                }
                const modalContent = document.getElementById('pims-report-details-content');
                const reportInfo = modalContent.querySelectorAll('p');
                const reportType = reportInfo[0].textContent.replace('Report Type: ', '');
                const selectedPrison = reportInfo[1].textContent.replace('Selected Prison: ', '');
                const generatedDate = reportInfo[2].textContent.replace('Generated Date: ', '');
                let csv = [
                    `"Prison Management System Report"`,
                    `"Report Type,${reportType}"`,
                    `"Selected Prison,${selectedPrison}"`,
                    `"Generated Date,${generatedDate}"`,
                    `""`
                ];
                const rows = reportTable.querySelectorAll('tr');
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
                });
                const csvContent = csv.join('\n');
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `PIMS_Report_${reportType.replace(/\s+/g, '_')}.csv`;
                link.click();
                console.log('Report CSV exported successfully.');
            } catch (error) {
                console.error('Error exporting report CSV:', error.message);
                alert('Failed to export report CSV. Check the console for details.');
            }
        }

        function pimsExportReportPDF() {
            try {
                const modalContent = document.getElementById('pims-report-details-content');
                if (!modalContent) {
                    console.error('Report details content not found.');
                    alert('Error: Report details content not found.');
                    return;
                }
                const pdfContainer = document.createElement('div');
                pdfContainer.style.padding = '20px';
                pdfContainer.style.background = '#fff';
                pdfContainer.style.fontFamily = "'Poppins', sans-serif";
                const contentClone = modalContent.cloneNode(true);
                contentClone.querySelectorAll('table').forEach(table => {
                    table.style.width = '100%';
                    table.style.borderCollapse = 'collapse';
                    table.style.fontSize = '12px';
                    table.querySelectorAll('th, td').forEach(cell => {
                        cell.style.border = '1px solid #eee';
                        cell.style.padding = '8px';
                    });
                    table.querySelectorAll('th').forEach(th => {
                        th.style.background = 'var(--pims-primary)';
                        th.style.color = 'white';
                        th.style.fontWeight = '500';
                    });
                });
                pdfContainer.appendChild(contentClone);
                const reportType = contentClone.querySelector('p').textContent.replace('Report Type: ', '');
                const opt = {
                    margin: [10, 10, 10, 10],
                    filename: `PIMS_Report_${reportType.replace(/\s+/g, '_')}.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };
                html2pdf().set(opt).from(pdfContainer).save();
                console.log('Report PDF exported successfully.');
            } catch (error) {
                console.error('Error exporting report PDF:', error.message);
                alert('Failed to export report PDF. Check the console for details.');
            }
        }

        // Close modal functionality
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.pims-modal-close, .pims-modal-close-btn').forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById('pims-report-details-modal').classList.remove('active');
                });
            });

            document.getElementById('pims-report-details-modal').addEventListener('click', e => {
                if (e.target === e.currentTarget) {
                    e.currentTarget.classList.remove('active');
                }
            });
        });
    </script>
    @include('includes.footer_js')
</body>
</html>