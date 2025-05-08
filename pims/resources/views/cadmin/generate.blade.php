<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PIMS - Dynamic Report Generator</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f6f9;
    }
    .pims-app-container {
      max-width: 1200px;
      margin: 0 auto;
    }
    .pims-content-area {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .pims-report-title {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }
    .pims-tabs {
      display: flex;
      border-bottom: 1px solid #ddd;
      margin-bottom: 20px;
    }
    .pims-tablink {
      padding: 10px 20px;
      background: #f1f1f1;
      border: none;
      cursor: pointer;
      font-size: 16px;
      color: #555;
    }
    .pims-tablink.active, .pims-tablink:hover {
      background: #007bff;
      color: #fff;
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
    }
    .pims-search {
      position: relative;
      width: 300px;
    }
    .pims-search-icon {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
    }
    .pims-search-input {
      width: 100%;
      padding: 8px 8px 8px 35px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .pims-action-buttons {
      display: flex;
      gap: 10px;
    }
    .pims-btn {
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }
    .pims-btn-export {
      background: #28a745;
      color: #fff;
    }
    .pims-btn-pdf {
      background: #dc3545;
      color: #fff;
    }
    .pims-report-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .pims-report-table th, .pims-report-table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    .pims-report-table th {
      background: #f8f9fa;
      font-weight: bold;
    }
    .pims-status-badge {
      padding: 5px 10px;
      border-radius: 12px;
      font-size: 12px;
      color: #fff;
    }
    .pims-status-resolved { background: #28a745; }
    .pims-status-pending { background: #ffc107; }
    .pims-status-banned { background: #dc3545; }
    .pims-form {
      margin-bottom: 20px;
      padding: 20px;
      background: #f8f9fa;
      border-radius: 8px;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: flex-end;
    }
    .pims-form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .pims-form select, .pims-form input {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      width: 200px;
    }
    .pims-form select[multiple] {
      height: 100px;
    }
    .pims-form button {
      padding: 8px 16px;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="pims-app-container">
    <div class="pims-content-area">
      <div class="pims-report-container">
        <h1 class="pims-report-title">
          <i class="fas fa-file-alt"></i> Prison Management System - Dynamic Reports
        </h1>

        <div class="pims-form">
          <div>
            <label for="prisonSelect">Select Prisons:</label>
            <select id="prisonSelect" multiple>
              <!-- Populated dynamically -->
            </select>
          </div>
          <div>
            <label for="reportType">Report Type:</label>
            <select id="reportType">
              <option value="all_accounts">All Accounts</option>
              <option value="staff">Staff</option>
              <option value="prisoners">Prisoners</option>
              <option value="all_prisons">All Prisons</option>
            </select>
          </div>
          <button onclick="generateReport()">Generate Report</button>
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
            <i class="fas fa-building"></i> All Prisons
          </button>
        </div>

        <!-- All Accounts -->
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
              <!-- Data populated dynamically -->
            </tbody>
          </table>
        </div>

        <!-- Staff in Prison -->
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
              <!-- Data populated dynamically -->
            </tbody>
          </table>
        </div>

        <!-- Prisoners in Prison -->
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
          <table class="pims-report-table" id="pimsPrisonsTable">
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
              <!-- Data populated dynamically -->
            </tbody>
          </table>
        </div>

        <!-- All Prisons -->
        <div id="allPrisons" class="pims-report-content">
          <div class="pims-actions">
            <div class="pims-search">
              <i class="fas fa-search pims-search-icon"></i>
              <input type="text" id="pimsSearchPrisons" class="pims-search-input" 
                     placeholder="Search prisons..." 
                     onkeyup="pimsSearchTable('pimsPrisonsTable', 'pimsSearchPrisons')">
            </div>
            <div class="pims-action-buttons">
              <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsPrisonsTable', 'PIMS_All_Prisons.csv')">
                <i class="fas fa-file-csv"></i> Export CSV
              </button>
              <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsPrisonsTable', 'PIMS_All_Prisons.pdf')">
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
              <!-- Data populated dynamically -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
    // Base URL for routes
    const BASE_URL = 'http://127.0.0.1:8000/';

    // Set up CSRF token for fetch requests (for future POST requests)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Populate prison dropdown on page load
    async function loadPrisonDropdown() {
      try {
        const response = await fetch(`${BASE_URL}prisons`, {
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          }
        });
        if (!response.ok) {
          const errorData = await response.json().catch(() => ({}));
          throw new Error(`HTTP ${response.status}: ${errorData.error || 'Failed to fetch prisons'}`);
        }
        const prisons = await response.json();
        const prisonSelect = document.getElementById('prisonSelect');
        prisonSelect.innerHTML = '';
        prisons.forEach(prison => {
          prisonSelect.innerHTML += `<option value="${prison.id}">${prison.name}</option>`;
        });
      } catch (error) {
        console.error('Error loading prison dropdown:', error.message);
        alert(`Failed to load prison list: ${error.message}. Check the console for details.`);
      }
    }

    // Generate dynamic report based on filters
    async function generateReport() {
      const prisonSelect = document.getElementById('prisonSelect');
      const reportType = document.getElementById('reportType').value;

      // Get selected prison IDs
      const prisonIds = Array.from(prisonSelect.selectedOptions).map(option => option.value);

      // Build query parameters
      const params = new URLSearchParams();
      if (prisonIds.length > 0) {
        params.append('prison_ids', prisonIds.join(','));
      }
      params.append('report_type', reportType);

      try {
        const response = await fetch(`${BASE_URL}reports?${params.toString()}`, {
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

        // Clear all tables
        document.getElementById('allAccountsBody').innerHTML = '';
        document.getElementById('staffBody').innerHTML = '';
        document.getElementById('prisonersBody').innerHTML = '';
        document.getElementById('prisonsBody').innerHTML = '';

        // Populate table based on report type
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
                  <td>Prisoner</td>
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
      const table = document.getElementById(tableId);
      const rows = table.querySelectorAll('tr');
      let csv = [];
      for (let row of rows) {
        let cols = row.querySelectorAll('th, td');
        let rowData = [];
        for (let col of cols) {
          rowData.push(`"${col.textContent.trim()}"`);
        }
        csv.push(rowData.join(','));
      }
      const csvContent = csv.join('\n');
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = filename;
      link.click();
    }

    function pimsExportPDF(tableId, filename) {
      const element = document.getElementById(tableId);
      html2pdf().from(element).save(filename);
    }

    // Initialize prison dropdown on page load
    window.onload = () => {
      loadPrisonDropdown();
    };
  </script>
</body>
</html>