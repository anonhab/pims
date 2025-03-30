<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Security & Incident Reports Dashboard</title>
  @include('includes.head')
  <style>
 
    .container {
      width: 90%;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #1a1a2e;
      margin-bottom: 20px;
    }
    /* Tab Styles */
    .tabs {
      display: flex;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .tablink {
      flex: 1;
      background: #1a1a2e;
      color: white;
      padding: 10px;
      cursor: pointer;
      border: none;
      text-align: center;
      transition: background 0.3s;
    }
    .tablink.active, .tablink:hover {
      background: #28a745;
    }
    .reportContent {
      display: none;
    }
    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: space-between;
      margin-bottom: 20px;
    }
    .actions input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      min-width: 200px;
    }
    .btn {
      padding: 10px 15px;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }
    .btn.export {
      background: #28a745;
    }
    .btn.pdf {
      background: #dc3545;
    }
    .btn:hover {
      opacity: 0.8;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }
    thead {
      background: #1a1a2e;
      color: white;
    }
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    tbody tr:nth-child(odd) {
      background-color: #f9f9f9;
    }
    tbody tr:hover {
      background: #f1f1f1;
    }
    @media screen and (max-width: 768px) {
      .actions {
        flex-direction: column;
      }
      .tablink {
        font-size: 14px;
        padding: 8px;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  @include('includes.nav')

  <div class="columns" id="app-content">
    @include('cadmin.menu')
    <div class="container">
      <h1>Report dashboard</h1>
      <div class="tabs">
        <button class="tablink active" onclick="openReport(event, 'disciplinary')">Disciplinary Action Report</button>
        <button class="tablink" onclick="openReport(event, 'incident')">Incident Report</button>
        <button class="tablink" onclick="openReport(event, 'visitorLog')">Visitor Log Report</button>
        <button class="tablink" onclick="openReport(event, 'restrictedVisitors')">Restricted Visitors Report</button>
      </div>

      <!-- Disciplinary Action Report -->
      <div id="disciplinary" class="reportContent" style="display: block;">
        <div class="actions">
          <input type="text" id="searchDisciplinary" placeholder="Search..." onkeyup="searchTable('disciplinaryTable', 'searchDisciplinary')">
          <button class="btn export" onclick="exportCSV('disciplinaryTable', 'Disciplinary_Action_Report.csv')">Export CSV</button>
          <button class="btn pdf" onclick="exportPDF('disciplinaryTable', 'Disciplinary_Action_Report.pdf')">Export PDF</button>
        </div>
        <table id="disciplinaryTable">
          <thead>
            <tr>
              <th>Prisoner ID</th>
              <th>Name</th>
              <th>Violation</th>
              <th>Date</th>
              <th>Action Taken</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2001</td>
              <td>John Doe</td>
              <td>Contraband</td>
              <td>2025-03-01</td>
              <td>Warning Issued</td>
            </tr>
            <tr>
              <td>2002</td>
              <td>Jane Smith</td>
              <td>Fighting</td>
              <td>2025-03-05</td>
              <td>Solitary Confinement</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Incident Report -->
      <div id="incident" class="reportContent">
        <div class="actions">
          <input type="text" id="searchIncident" placeholder="Search..." onkeyup="searchTable('incidentTable', 'searchIncident')">
          <button class="btn export" onclick="exportCSV('incidentTable', 'Incident_Report.csv')">Export CSV</button>
          <button class="btn pdf" onclick="exportPDF('incidentTable', 'Incident_Report.pdf')">Export PDF</button>
        </div>
        <table id="incidentTable">
          <thead>
            <tr>
              <th>Incident ID</th>
              <th>Description</th>
              <th>Date</th>
              <th>Location</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>3001</td>
              <td>Fight in yard</td>
              <td>2025-03-02</td>
              <td>Main Yard</td>
              <td>Resolved</td>
            </tr>
            <tr>
              <td>3002</td>
              <td>Contraband found</td>
              <td>2025-03-06</td>
              <td>Cell Block B</td>
              <td>Under Investigation</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Visitor Log Report -->
      <div id="visitorLog" class="reportContent">
        <div class="actions">
          <input type="text" id="searchVisitorLog" placeholder="Search..." onkeyup="searchTable('visitorLogTable', 'searchVisitorLog')">
          <button class="btn export" onclick="exportCSV('visitorLogTable', 'Visitor_Log_Report.csv')">Export CSV</button>
          <button class="btn pdf" onclick="exportPDF('visitorLogTable', 'Visitor_Log_Report.pdf')">Export PDF</button>
        </div>
        <table id="visitorLogTable">
          <thead>
            <tr>
              <th>Visitor ID</th>
              <th>Name</th>
              <th>Prisoner Visited</th>
              <th>Date</th>
              <th>Relationship</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>4001</td>
              <td>Mark Johnson</td>
              <td>John Doe</td>
              <td>2025-03-03</td>
              <td>Friend</td>
            </tr>
            <tr>
              <td>4002</td>
              <td>Susan Brown</td>
              <td>Jane Smith</td>
              <td>2025-03-04</td>
              <td>Family</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Restricted Visitors Report -->
      <div id="restrictedVisitors" class="reportContent">
        <div class="actions">
          <input type="text" id="searchRestricted" placeholder="Search..." onkeyup="searchTable('restrictedTable', 'searchRestricted')">
          <button class="btn export" onclick="exportCSV('restrictedTable', 'Restricted_Visitors_Report.csv')">Export CSV</button>
          <button class="btn pdf" onclick="exportPDF('restrictedTable', 'Restricted_Visitors_Report.pdf')">Export PDF</button>
        </div>
        <table id="restrictedTable">
          <thead>
            <tr>
              <th>Visitor ID</th>
              <th>Name</th>
              <th>Reason</th>
              <th>Date Banned</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>5001</td>
              <td>Robert Lee</td>
              <td>Previous misconduct</td>
              <td>2025-02-25</td>
              <td>Banned</td>
            </tr>
            <tr>
              <td>5002</td>
              <td>Emily Davis</td>
              <td>Security risk</td>
              <td>2025-03-01</td>
              <td>Banned</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- jsPDF Library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script>
    // Tab switching function
    function openReport(evt, reportName) {
      let i, reportContent, tablinks;
      reportContent = document.getElementsByClassName("reportContent");
      for (i = 0; i < reportContent.length; i++) {
        reportContent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
      }
      document.getElementById(reportName).style.display = "block";
      evt.currentTarget.classList.add("active");
    }

    // Search function for any table
    function searchTable(tableId, inputId) {
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
    function exportCSV(tableId, fileName) {
      let table = document.getElementById(tableId);
      let rows = Array.from(table.rows);
      let csvContent = "data:text/csv;charset=utf-8,";

      rows.forEach(row => {
        let cols = Array.from(row.cells).map(cell => cell.innerText);
        csvContent += cols.join(",") + "\n";
      });

      let encodedUri = encodeURI(csvContent);
      let link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", fileName);
      document.body.appendChild(link);
      link.click();
    }

    // Export table to PDF using jsPDF
    function exportPDF(tableId, fileName) {
      const { jsPDF } = window.jspdf;
      let doc = new jsPDF();
      let reportTitle = fileName.replace(".pdf", "").replace(/_/g, " ");
      doc.text(reportTitle, 10, 10);

      let table = document.getElementById(tableId);
      let rows = Array.from(table.rows);
      let startY = 20;
      rows.forEach(row => {
        let cols = Array.from(row.cells).map(cell => cell.innerText);
        doc.text(cols.join(" | "), 10, startY);
        startY += 10;
      });
      doc.save(fileName);
    }
  </script>

  @include('includes.footer_js')
</body>
</html>
