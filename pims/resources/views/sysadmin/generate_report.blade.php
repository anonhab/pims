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
      .pims-form {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      }
      .pims-form label {
        font-size: 14px;
        font-weight: 500;
        color: #34495e;
        margin-bottom: 8px;
        display: block;
      }
      .pims-form select, .pims-form input {
        width: 250px;
        padding: 10px;
        border: 1px solid #d1d9e6;
        border-radius: 6px;
        font-size: 14px;
        background: #fff;
        transition: border-color 0.3s, box-shadow 0.3s;
      }
      .pims-form select:focus, .pims-form input:focus {
        border-color: #3f51b5;
        box-shadow: 0 0 8px rgba(63, 81, 181, 0.2);
        outline: none;
      }
      .pims-form button {
        padding: 10px 24px;
        background: #3f51b5;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
      }
      .pims-form button:hover:not(:disabled) {
        background: #303f9f;
      }
      .pims-form button:disabled {
        background: #b0bec5;
        cursor: not-allowed;
      }
      .pims-tabs {
        display: flex;
        border-bottom: 2px solid #e0e7ff;
        margin-bottom: 25px;
        overflow-x: auto;
      }
      .pims-tablink {
        padding: 12px 24px;
        background: #e8eaf6;
        border: none;
        cursor: pointer;
        font-size: 15px;
        font-weight: 500;
        color: #3f51b5;
        transition: all 0.3s;
        white-space: nowrap;
      }
      .pims-tablink:hover, .pims-tablink.active {
        background: #3f51b5;
        color: #fff;
        border-radius: 6px 6px 0 0;
      }
      .pims-report-content {
        display: none;
      }
      .pims-report-content.active {
        display: block;
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
      .pims-status-resolved { background: #2ecc71; }
      .pims-status-pending { background: #f1c40f; }
      .pims-status-banned { background: #e74c3c; }
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
      @media (max-width: 768px) {
        .pims-form {
          flex-direction: column;
          align-items: stretch;
        }
        .pims-form select, .pims-form input {
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
    </style>
  </head>
  <body>
    @include('includes.nav')
    <div class="pims-app-container">
      @include('sysadmin.menu')
      <div class="pims-content-area">
        <div class="pims-report-container">
          <h1 class="pims-report-title">
            <i class="fas fa-file-alt"></i> Prison Management System - System Admin Reports
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
          <div class="pims-form">
            <div>
              <label for="reportType">Report Type</label>
              <select id="reportType">
                <option value="all_accounts">All Accounts</option>
                <option value="staff">Staff</option>
                <option value="prisoners">Prisoners</option>
                <option value="all_prisons">Prison Details</option>
              </select>
            </div>
            <button id="generateReportBtn" onclick="generateReport()">
              <i class="fas fa-play"></i> Generate Report
            </button>
            <button id="initiateBackupBtn" class="btn btn-primary" onclick="initiateBackup()">
              <i class="fas fa-download"></i> Initiate Backup
            </button>
          </div>
          <div class="pims-tabs">
            <button class="pims-tablink active" onclick="pimsOpenReport(event, 'allAccounts')">
              <i class="fas fa-gavel"></i> All Accounts
            </button>
            <button class="pims-tablink" onclick="pimsOpenReport(event, 'staffInPrison')">
              <i class="fas fa-exclamation-triangle"></i> Staff in Prison
            </button>
            <button class="pims-tablink" onclick="pimsOpenReport(event, 'prisonersInPrison')">
              <i class="fas fa-users"></i> Prisoners in Prison
            </button>
            <button class="pims-tablink" onclick="pimsOpenReport(event, 'allPrisons')">
              <i class="fas fa-building"></i> Prison Details
            </button>
          </div>
          <div id="allAccounts" class="pims-report-content active">
            <div class="pims-actions">
              <div class="pims-search">
                <i class="fas fa-search pims-search-icon"></i>
                <input type="text" id="pimsSearchAllAccounts" class="pims-search-input" 
                       placeholder="Search all accounts..." 
                       onkeyup="pimsSearchTable('pimsAllAccountsTable', 'pimsSearchAllAccounts')">
              </div>
              <div class="pims-action-buttons">
                <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsAllAccountsTable', 'PIMS_All_Accounts.csv')">
                  <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsAllAccountsTable', 'PIMS_All_Accounts.pdf')">
                  <i class="fas fa-file-pdf"></i> Export PDF
                </button>
              </div>
            </div>
            <table class="pims-report-table" id="pimsAllAccountsTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Prison</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="allAccountsBody">
              </tbody>
            </table>
          </div>
          <div id="staffInPrison" class="pims-report-content">
            <div class="pims-actions">
              <div class="pims-search">
                <i class="fas fa-search pims-search-icon"></i>
                <input type="text" id="pimsSearchStaff" class="pims-search-input" 
                       placeholder="Search staff..." 
                       onkeyup="pimsSearchTable('pimsStaffTable', 'pimsSearchStaff')">
              </div>
              <div class="pims-action-buttons">
                <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsStaffTable', 'PIMS_Staff.csv')">
                  <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsStaffTable', 'PIMS_Staff.pdf')">
                  <i class="fas fa-file-pdf"></i> Export PDF
                </button>
              </div>
            </div>
            <table class="pims-report-table" id="pimsStaffTable">
              <thead>
                <tr>
                  <th>Staff ID</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Prison</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="staffBody">
              </tbody>
            </table>
          </div>
          <div id="prisonersInPrison" class="pims-report-content">
            <div class="pims-actions">
              <div class="pims-search">
                <i class="fas fa-search pims-search-icon"></i>
                <input type="text" id="pimsSearchPrisoners" class="pims-search-input" 
                       placeholder="Search prisoners..." 
                       onkeyup="pimsSearchTable('pimsPrisonersTable', 'pimsSearchPrisoners')">
              </div>
              <div class="pims-action-buttons">
                <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsPrisonersTable', 'PIMS_Prisoners.csv')">
                  <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsPrisonersTable', 'PIMS_Prisoners.pdf')">
                  <i class="fas fa-file-pdf"></i> Export PDF
                </button>
              </div>
            </div>
            <table class="pims-report-table" id="pimsPrisonersTable">
              <thead>
                <tr>
                  <th>Prisoner ID</th>
                  <th>Name</th>
                  <th>Prison</th>
                  <th>Sentence</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="prisonersBody">
              </tbody>
            </table>
          </div>
          <div id="allPrisons" class="pims-report-content">
            <div class="pims-actions">
              <div class="pims-search">
                <i class="fas fa-search pims-search-icon"></i>
                <input type="text" id="pimsSearchPrisons" class="pims-search-input" 
                       placeholder="Search prison..." 
                       onkeyup="pimsSearchTable('pimsPrisonsTable', 'pimsSearchPrisons')">
              </div>
              <div class="pims-action-buttons">
                <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsPrisonsTable', 'PIMS_Prison.csv')">
                  <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsPrisonsTable', 'PIMS_Prison.pdf')">
                  <i class="fas fa-file-pdf"></i> Export PDF
                </button>
              </div>
            </div>
            <table class="pims-report-table" id="pimsPrisonsTable">
              <thead>
                <tr>
                  <th>Prison ID</th>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Capacity</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="prisonsBody">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
      const BASE_URL = 'http://127.0.0.1:8000/';
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const CURRENT_USER = "{{ session('user_name') ?? 'Unknown User' }}";
      let lastReportRequest = 0;
      const DEBOUNCE_MS = 1000;

      async function initiateBackup() {
          const btn = document.getElementById('initiateBackupBtn');
          btn.disabled = true;
          let percent = 0;
          const progressInterval = setInterval(() => {
              percent += Math.floor(Math.random() * 10) + 5;
              if (percent >= 100) {
                  percent = 100;
                  clearInterval(progressInterval);
              }
              btn.textContent = `Backing Up... (${CURRENT_USER}) ${percent}%`;
          }, 300);

          try {
              const response = await fetch(`${BASE_URL}sinitiate_backup`, {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': csrfToken
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
              btn.textContent = 'Initiate Backup';
          }
      }

      function getReportTypeEnum(reportType) {
        const mapping = {
          all_accounts: 'daily',
          staff: 'monthly',
          prisoners: 'annual',
          all_prisons: 'incident'
        };
        return mapping[reportType] || 'daily';
      }

      function getReportTypeName(reportType) {
        const names = {
          all_accounts: 'All Accounts',
          staff: 'Staff',
          prisoners: 'Prisoners',
          all_prisons: 'Prison Details'
        };
        return names[reportType] || reportType;
      }

      function getSelectedPrisonNames() {
        return "{{ $prison->name ?? 'Unknown Prison' }}";
      }

      async function trackReport(reportType, content) {
        try {
          const response = await fetch(`${BASE_URL}sreports/store`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
              report_type: getReportTypeEnum(reportType),
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

      async function generateReport() {
        const now = Date.now();
        if (now - lastReportRequest < DEBOUNCE_MS) {
          console.log('Debounced report generation attempt');
          return;
        }
        lastReportRequest = now;

        const generateBtn = document.getElementById('generateReportBtn');
        generateBtn.disabled = true;
        generateBtn.textContent = 'Generating...';

        try {
          const reportType = document.getElementById('reportType').value;
          const params = new URLSearchParams();
          params.append('report_type', reportType);

          console.log('Generating report:', { reportType });

          const response = await fetch(`${BASE_URL}sreports?${params.toString()}`, {
            headers: {
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            }
          });
          if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(`HTTP ${response.status}: ${errorData.error || 'Failed to fetch report data'}`);
          }
          const data = await response.json();

          document.getElementById('allAccountsBody').innerHTML = '';
          document.getElementById('staffBody').innerHTML = '';
          document.getElementById('prisonersBody').innerHTML = '';
          document.getElementById('prisonsBody').innerHTML = '';

          const intro = {
            title: 'Prison Management System Report',
            report_type: getReportTypeName(reportType),
            selected_prisons: getSelectedPrisonNames(),
            generated_date: new Date().toLocaleDateString('en-US', {
              year: 'numeric',
              month: 'long',
              day: 'numeric'
            })
          };

          switch (reportType) {
            case 'all_accounts':
              const allAccountsBody = document.getElementById('allAccountsBody');
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
              pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="allAccounts"]') }, 'allAccounts');
              break;
            case 'staff':
              const staffBody = document.getElementById('staffBody');
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
              pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="staffInPrison"]') }, 'staffInPrison');
              break;
            case 'prisoners':
              const prisonersBody = document.getElementById('prisonersBody');
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
              pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="prisonersInPrison"]') }, 'prisonersInPrison');
              break;
            case 'all_prisons':
              const prisonsBody = document.getElementById('prisonsBody');
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
              pimsOpenReport({ currentTarget: document.querySelector('button[onclick*="allPrisons"]') }, 'allPrisons');
              break;
            default:
              alert('Invalid report type selected.');
          }
        } catch (error) {
          console.error('Error generating report:', error.message);
          alert(`Failed to generate report: ${error.message}. Check the console for details.`);
        } finally {
          generateBtn.disabled = false;
          generateBtn.textContent = 'Generate Report';
        }
      }

      function pimsOpenReport(event, reportName) {
        document.querySelectorAll('.pims-report-content').forEach(content => {
          content.classList.remove('active');
        });
        document.querySelectorAll('.pims-tablink').forEach(tab => {
          tab.classList.remove('active');
        });
        document.getElementById(reportName).classList.add('active');
        event.currentTarget.classList.add('active');
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
          const reportType = document.getElementById('reportType').value;
          const reportTypeName = getReportTypeName(reportType);
          const prisonNames = getSelectedPrisonNames();
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
          trackReport(reportType, content);
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
          const reportType = document.getElementById('reportType').value;
          const reportTypeName = getReportTypeName(reportType);
          const prisonNames = getSelectedPrisonNames();
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
            th.style.background = '#e8eaf6';
            th.style.color = '#1a237e';
            th.style.fontWeight = '600';
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
          trackReport(reportType, content);
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
  </body>
  </html>