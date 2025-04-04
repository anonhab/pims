<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PIMS - Security & Incident Reports</title>
  @include('includes.head')
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

    .pims-sidebar {
      width: var(--pims-sidebar-width);
      background: white;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
      position: fixed;
      top: var(--pims-nav-height);
      left: 0;
      bottom: 0;
      overflow-y: auto;
      z-index: 900;
      transition: var(--pims-transition);
    }

    .pims-content-area {
      flex: 1;
      margin-left: var(--pims-sidebar-width);
      padding: 1.5rem;
      transition: var(--pims-transition);
    }

    /* Report Container */
    .pims-report-container {
      width: 95%;
      margin: 0 auto;
      background: white;
      padding: 1.5rem;
      border-radius: var(--pims-border-radius);
      box-shadow: var(--pims-card-shadow);
    }

    .pims-report-title {
      text-align: center;
      color: var(--pims-primary);
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
      font-weight: 600;
    }

    /* Tab Styles */
    .pims-tabs {
      display: flex;
      flex-wrap: wrap;
      margin-bottom: 1.5rem;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .pims-tablink {
      flex: 1;
      background: var(--pims-secondary);
      color: white;
      padding: 0.75rem;
      cursor: pointer;
      border: none;
      text-align: center;
      transition: var(--pims-transition);
      font-weight: 600;
      min-width: 150px;
    }

    .pims-tablink.active, .pims-tablink:hover {
      background: var(--pims-accent);
    }

    .pims-report-content {
      display: none;
      animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Action Bar */
    .pims-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      align-items: center;
    }

    .pims-search {
      flex: 1;
      min-width: 250px;
      position: relative;
    }

    .pims-search-input {
      width: 100%;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      border: 1px solid #ddd;
      border-radius: var(--pims-border-radius);
      transition: var(--pims-transition);
      font-size: 0.9rem;
    }

    .pims-search-input:focus {
      border-color: var(--pims-accent);
      box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
      outline: none;
    }

    .pims-search-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #7f8c8d;
    }

    /* Button Styles */
    .pims-btn {
      padding: 0.75rem 1.25rem;
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

    .pims-btn-export {
      background-color: var(--pims-success);
      color: white;
    }

    .pims-btn-pdf {
      background-color: var(--pims-danger);
      color: white;
    }

    .pims-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      opacity: 0.9;
    }

    /* Table Styles */
    .pims-report-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      margin-bottom: 1.5rem;
    }

    .pims-report-table thead {
      background: var(--pims-primary);
      color: white;
    }

    .pims-report-table th, 
    .pims-report-table td {
      padding: 0.75rem 1rem;
      text-align: left;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .pims-report-table tbody tr:nth-child(odd) {
      background-color: #f9f9f9;
    }

    .pims-report-table tbody tr:hover {
      background: rgba(41, 128, 185, 0.05);
    }

    /* Status Badges */
    .pims-status-badge {
      display: inline-block;
      padding: 0.25rem 0.5rem;
      border-radius: 1rem;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
    }

    .pims-status-resolved {
      background-color: rgba(46, 204, 113, 0.1);
      color: var(--pims-success);
    }

    .pims-status-pending {
      background-color: rgba(241, 196, 15, 0.1);
      color: var(--pims-warning);
    }

    .pims-status-banned {
      background-color: rgba(231, 76, 60, 0.1);
      color: var(--pims-danger);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .pims-sidebar {
        transform: translateX(-100%);
      }

      .pims-sidebar.is-active {
        transform: translateX(0);
      }

      .pims-content-area {
        margin-left: 0;
        padding: 1rem;
      }

      .pims-tabs {
        flex-direction: column;
      }

      .pims-tablink {
        width: 100%;
      }

      .pims-actions {
        flex-direction: column;
        align-items: stretch;
      }

      .pims-search {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  @include('includes.nav')

  <div class="pims-app-container">
    @include('cadmin.menu')

    <div class="pims-content-area">
      <div class="pims-report-container">
        <h1 class="pims-report-title">
          <i class="fas fa-file-alt"></i> Security & Incident Reports
        </h1>
        
        <div class="pims-tabs">
          <button class="pims-tablink active" onclick="pimsOpenReport(event, 'disciplinary')">
            <i class="fas fa-gavel"></i> Disciplinary Actions
          </button>
          <button class="pims-tablink" onclick="pimsOpenReport(event, 'incident')">
            <i class="fas fa-exclamation-triangle"></i> Incident Reports
          </button>
          <button class="pims-tablink" onclick="pimsOpenReport(event, 'visitorLog')">
            <i class="fas fa-users"></i> Visitor Logs
          </button>
          <button class="pims-tablink" onclick="pimsOpenReport(event, 'restrictedVisitors')">
            <i class="fas fa-ban"></i> Restricted Visitors
          </button>
        </div>

        <!-- Disciplinary Action Report -->
        <div id="disciplinary" class="pims-report-content" style="display: block;">
          <div class="pims-actions">
            <div class="pims-search">
              <i class="fas fa-search pims-search-icon"></i>
              <input type="text" id="pimsSearchDisciplinary" class="pims-search-input" 
                     placeholder="Search disciplinary actions..." 
                     onkeyup="pimsSearchTable('pimsDisciplinaryTable', 'pimsSearchDisciplinary')">
            </div>
            <div class="pims-action-buttons">
              <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsDisciplinaryTable', 'PIMS_Disciplinary_Actions.csv')">
                <i class="fas fa-file-csv"></i> Export CSV
              </button>
              <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsDisciplinaryTable', 'PIMS_Disciplinary_Actions.pdf')">
                <i class="fas fa-file-pdf"></i> Export PDF
              </button>
            </div>
          </div>
          <table class="pims-report-table" id="pimsDisciplinaryTable">
            <thead>
              <tr>
                <th>Prisoner ID</th>
                <th>Name</th>
                <th>Violation</th>
                <th>Date</th>
                <th>Action Taken</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2001</td>
                <td>John Doe</td>
                <td>Contraband possession</td>
                <td>2025-03-01</td>
                <td>Warning issued</td>
                <td><span class="pims-status-badge pims-status-resolved">Resolved</span></td>
              </tr>
              <tr>
                <td>2002</td>
                <td>Jane Smith</td>
                <td>Assault on another inmate</td>
                <td>2025-03-05</td>
                <td>Solitary confinement (7 days)</td>
                <td><span class="pims-status-badge pims-status-pending">Pending</span></td>
              </tr>
              <tr>
                <td>2003</td>
                <td>Michael Brown</td>
                <td>Refusing orders</td>
                <td>2025-03-10</td>
                <td>Privileges suspended</td>
                <td><span class="pims-status-badge pims-status-resolved">Resolved</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Incident Report -->
        <div id="incident" class="pims-report-content">
          <div class="pims-actions">
            <div class="pims-search">
              <i class="fas fa-search pims-search-icon"></i>
              <input type="text" id="pimsSearchIncident" class="pims-search-input" 
                     placeholder="Search incidents..." 
                     onkeyup="pimsSearchTable('pimsIncidentTable', 'pimsSearchIncident')">
            </div>
            <div class="pims-action-buttons">
              <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsIncidentTable', 'PIMS_Incident_Reports.csv')">
                <i class="fas fa-file-csv"></i> Export CSV
              </button>
              <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsIncidentTable', 'PIMS_Incident_Reports.pdf')">
                <i class="fas fa-file-pdf"></i> Export PDF
              </button>
            </div>
          </div>
          <table class="pims-report-table" id="pimsIncidentTable">
            <thead>
              <tr>
                <th>Incident ID</th>
                <th>Description</th>
                <th>Date</th>
                <th>Location</th>
                <th>Severity</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>3001</td>
                <td>Fight in recreation yard</td>
                <td>2025-03-02</td>
                <td>Main Yard</td>
                <td>Medium</td>
                <td><span class="pims-status-badge pims-status-resolved">Resolved</span></td>
              </tr>
              <tr>
                <td>3002</td>
                <td>Contraband found in cell</td>
                <td>2025-03-06</td>
                <td>Cell Block B</td>
                <td>High</td>
                <td><span class="pims-status-badge pims-status-pending">Under Investigation</span></td>
              </tr>
              <tr>
                <td>3003</td>
                <td>Attempted escape</td>
                <td>2025-03-08</td>
                <td>Perimeter Fence</td>
                <td>Critical</td>
                <td><span class="pims-status-badge pims-status-pending">Ongoing</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Visitor Log Report -->
        <div id="visitorLog" class="pims-report-content">
          <div class="pims-actions">
            <div class="pims-search">
              <i class="fas fa-search pims-search-icon"></i>
              <input type="text" id="pimsSearchVisitorLog" class="pims-search-input" 
                     placeholder="Search visitor logs..." 
                     onkeyup="pimsSearchTable('pimsVisitorLogTable', 'pimsSearchVisitorLog')">
            </div>
            <div class="pims-action-buttons">
              <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsVisitorLogTable', 'PIMS_Visitor_Logs.csv')">
                <i class="fas fa-file-csv"></i> Export CSV
              </button>
              <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsVisitorLogTable', 'PIMS_Visitor_Logs.pdf')">
                <i class="fas fa-file-pdf"></i> Export PDF
              </button>
            </div>
          </div>
          <table class="pims-report-table" id="pimsVisitorLogTable">
            <thead>
              <tr>
                <th>Visitor ID</th>
                <th>Name</th>
                <th>Prisoner Visited</th>
                <th>Date</th>
                <th>Time</th>
                <th>Relationship</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>4001</td>
                <td>Mark Johnson</td>
                <td>John Doe (2001)</td>
                <td>2025-03-03</td>
                <td>14:30 - 15:15</td>
                <td>Friend</td>
              </tr>
              <tr>
                <td>4002</td>
                <td>Susan Brown</td>
                <td>Jane Smith (2002)</td>
                <td>2025-03-04</td>
                <td>10:00 - 10:45</td>
                <td>Sister</td>
              </tr>
              <tr>
                <td>4003</td>
                <td>David Wilson</td>
                <td>Michael Brown (2003)</td>
                <td>2025-03-07</td>
                <td>13:15 - 14:00</td>
                <td>Attorney</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Restricted Visitors Report -->
        <div id="restrictedVisitors" class="pims-report-content">
          <div class="pims-actions">
            <div class="pims-search">
              <i class="fas fa-search pims-search-icon"></i>
              <input type="text" id="pimsSearchRestricted" class="pims-search-input" 
                     placeholder="Search restricted visitors..." 
                     onkeyup="pimsSearchTable('pimsRestrictedTable', 'pimsSearchRestricted')">
            </div>
            <div class="pims-action-buttons">
              <button class="pims-btn pims-btn-export" onclick="pimsExportCSV('pimsRestrictedTable', 'PIMS_Restricted_Visitors.csv')">
                <i class="fas fa-file-csv"></i> Export CSV
              </button>
              <button class="pims-btn pims-btn-pdf" onclick="pimsExportPDF('pimsRestrictedTable', 'PIMS_Restricted_Visitors.pdf')">
                <i class="fas fa-file-pdf"></i> Export PDF
              </button>
            </div>
          </div>
          <table class="pims-report-table" id="pimsRestrictedTable">
            <thead>
              <tr>
                <th>Visitor ID</th>
                <th>Name</th>
                <th>Reason</th>
                <th>Date Banned</th>
                <th>Ban Duration</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>5001</td>
                <td>Robert Lee</td>
                <td>Attempted to pass contraband</td>
                <td>2025-02-25</td>
                <td>Permanent</td>
                <td><span class="pims-status-badge pims-status-banned">Active</span></td>
              </tr>
              <tr>
                <td>5002</td>
                <td>Emily Davis</td>
                <td>Security risk identified</td>
                <td>2025-03-01</td>
                <td>1 Year</td>
                <td><span class="pims-status-badge pims-status-banned">Active</span></td>
              </tr>
              <tr>
                <td>5003</td>
                <td>James Wilson</td>
                <td>Violent behavior during visit</td>
                <td>2025-03-09</td>
                <td>6 Months</td>
                <td><span class="pims-status-badge pims-status-banned">Active</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- jsPDF Library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script>
    // Tab switching function
    function pimsOpenReport(evt, reportName) {
      let i, reportContent, tablinks;
      reportContent = document.getElementsByClassName("pims-report-content");
      for (i = 0; i < reportContent.length; i++) {
        reportContent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("pims-tablink");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
      }
      document.getElementById(reportName).style.display = "block";
      evt.currentTarget.classList.add("active");
    }

    // Search function for any table
    function pimsSearchTable(tableId, inputId) {
      let input = document.getElementById(inputId).value.toUpperCase();
      let table = document.getElementById(tableId);
      let tr = table.getElementsByTagName("tr");

      for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td");
        let found = false;
        for (let j = 0; j < td.length; j++) {
          if (td[j]) {
            let txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(input) > -1) {
              found = true;
              break;
            }
          }
        }
        tr[i].style.display = found ? "" : "none";
      }
    }

    // Export table to CSV
    function pimsExportCSV(tableId, fileName) {
      let table = document.getElementById(tableId);
      let rows = Array.from(table.rows);
      let csvContent = "data:text/csv;charset=utf-8,";

      // Add headers
      let headers = Array.from(rows[0].cells).map(cell => cell.innerText);
      csvContent += headers.join(",") + "\n";

      // Add data rows
      for (let i = 1; i < rows.length; i++) {
        if (rows[i].style.display !== "none") {
          let cols = Array.from(rows[i].cells).map(cell => cell.innerText);
          csvContent += cols.join(",") + "\n";
        }
      }

      let encodedUri = encodeURI(csvContent);
      let link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", fileName);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      
      // Show success notification
      pimsShowNotification('CSV exported successfully: ' + fileName, 'success');
    }

    // Export table to PDF using jsPDF
    function pimsExportPDF(tableId, fileName) {
      const { jsPDF } = window.jspdf;
      let doc = new jsPDF();
      
      // Add title
      let reportTitle = fileName.replace(".pdf", "").replace(/_/g, " ");
      doc.setFontSize(16);
      doc.setTextColor(40, 40, 40);
      doc.text(reportTitle, 14, 15);
      
      // Add current date
      doc.setFontSize(10);
      doc.setTextColor(100, 100, 100);
      doc.text("Generated on: " + new Date().toLocaleDateString(), 14, 22);
      
      // Add table data
      doc.setFontSize(10);
      doc.setTextColor(0, 0, 0);
      
      let table = document.getElementById(tableId);
      let rows = Array.from(table.rows);
      let startY = 30;
      let pageHeight = doc.internal.pageSize.height - 20;
      
      // Add headers
      doc.setFont(undefined, 'bold');
      let headers = Array.from(rows[0].cells).map(cell => cell.innerText);
      doc.text(headers.join(" | "), 14, startY);
      startY += 7;
      doc.setFont(undefined, 'normal');
      
      // Add data rows
      for (let i = 1; i < rows.length; i++) {
        if (rows[i].style.display !== "none") {
          if (startY > pageHeight) {
            doc.addPage();
            startY = 20;
          }
          
          let cols = Array.from(rows[i].cells).map(cell => cell.innerText);
          doc.text(cols.join(" | "), 14, startY);
          startY += 7;
        }
      }
      
      doc.save(fileName);
      
      // Show success notification
      pimsShowNotification('PDF exported successfully: ' + fileName, 'success');
    }

    // Show notification function
    function pimsShowNotification(message, type) {
      const notification = document.createElement('div');
      notification.className = `pims-notification pims-notification-${type}`;
      notification.innerHTML = `
        <div class="pims-notification-content">
          <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
          <span>${message}</span>
        </div>
      `;
      
      document.body.appendChild(notification);
      
      // Show notification
      setTimeout(() => {
        notification.classList.add('show');
      }, 10);
      
      // Hide after 5 seconds
      setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 5000);
    }

    // Add notification styles dynamically
    const notificationStyles = document.createElement('style');
    notificationStyles.innerHTML = `
      .pims-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: white;
        padding: 15px 20px;
        border-radius: var(--pims-border-radius);
        box-shadow: var(--pims-card-shadow);
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 10000;
        max-width: 350px;
      }
      .pims-notification.show {
        transform: translateY(0);
        opacity: 1;
      }
      .pims-notification-success {
        border-left: 4px solid var(--pims-success);
      }
      .pims-notification-error {
        border-left: 4px solid var(--pims-danger);
      }
      .pims-notification-content {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .pims-notification-content i {
        font-size: 1.2rem;
      }
      .pims-notification-success i {
        color: var(--pims-success);
      }
      .pims-notification-error i {
        color: var(--pims-danger);
      }
    `;
    document.head.appendChild(notificationStyles);
  </script>

  @include('includes.footer_js')
</body>
</html>