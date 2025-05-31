<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prison Information Management System - Released Prisoners</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .pims-search-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .pims-search-input {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--pims-border-radius);
            font-size: 0.9rem;
            width: 300px;
            transition: var(--pims-transition);
        }

        .pims-search-input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
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

        .pims-card-header h5 {
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0;
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

        .pims-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .pims-badge-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
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

        .pims-btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
        }

        .pims-alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--pims-border-radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-alert-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--pims-success);
            border-left: 4px solid var(--pims-success);
        }

        .pims-empty-state {
            text-align: center;
            padding: 2rem;
        }

        .pims-empty-state i {
            font-size: 3rem;
            color: var(--pims-accent);
            margin-bottom: 1rem;
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
            max-width: 900px;
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

        .pims-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .pims-detail-item {
            margin-bottom: 1.5rem;
        }

        .pims-detail-item strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--pims-secondary);
            font-weight: 500;
        }

        .pims-detail-item span {
            display: block;
            padding: 0.75rem;
            background-color: var(--pims-lighter);
            border-radius: var(--pims-border-radius);
            word-break: break-word;
        }

        .pims-inmate-image img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--pims-light);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .pims-inmate-image img:hover {
            transform: scale(1.05);
        }

        .pims-spinner {
            width: 3rem;
            height: 3rem;
            border: 0.25rem solid rgba(52, 152, 219, 0.2);
            border-top-color: var(--pims-accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .pims-search-input {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .pims-page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .pims-table th:nth-child(4),
            .pims-table td:nth-child(4),
            .pims-table th:nth-child(5),
            .pims-table td:nth-child(5) {
                display: none;
            }

            .pims-details-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .pims-table th:nth-child(3),
            .pims-table td:nth-child(3) {
                display: none;
            }

            .pims-inmate-image img {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="pims-app-container">
        @include('includes.nav')
        @include('police_commisioner.menu')
        <main class="pims-main-content">
            <div class="pims-content-container">
                <div class="pims-page-header">
                    <h2 class="pims-page-title">
                        <i class="fas fa-user-check"></i> Released Prisoners Management
                    </h2>
                </div>

                <div class="pims-search-container">
                    <input type="text" class="pims-search-input" id="pims-search" placeholder="Search by name or ID...">
                    <button class="pims-btn pims-btn-primary" onclick="clearSearch()">
                        <i class="fas fa-times"></i> Clear
                    </button>
                </div>

                <div class="pims-card">
                    <div class="pims-card-header">
                        <h5>Released Prisoners Registry</h5>
                    </div>
                    <div class="pims-card-body">
                        @if(session('success'))
                        <div class="pims-alert pims-alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="pims-table-container">
                            <table class="pims-table" id="pims-prisoners-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Prisoner ID</th>
                                        <th>Release Date</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($releasedPrisoners as $index => $prisoner)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $prisoner->first_name }} {{ $prisoner->middle_name }} {{ $prisoner->last_name }}</td>
                                        <td>{{ $prisoner->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($prisoner->time_serve_end)->format('M d, Y') }}</td>
                                        <td class="text-capitalize">{{ $prisoner->crime_committed }}</td>
                                        <td>
                                            <span class="pims-badge pims-badge-success">
                                                <i class="fas fa-check-circle"></i> {{ ucfirst($prisoner->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="pims-btn pims-btn-primary pims-btn-sm pims-view-prisoner"
                                                data-id="{{ $prisoner->id }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="pims-empty-state">
                                                <i class="fas fa-box-open"></i>
                                                <h5>No released prisoners found</h5>
                                                <p>There are currently no prisoners marked as released in the system.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($releasedPrisoners->hasPages())
                        <div class="pims-pagination">
                            <ul class="pims-pagination-list">
                                @if($releasedPrisoners->onFirstPage())
                                <li class="pims-pagination-item">
                                    <span class="pims-pagination-link disabled">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                                @else
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->previousPageUrl() }}" class="pims-pagination-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                @endif

                                @foreach(range(1, $releasedPrisoners->lastPage()) as $i)
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->url($i) }}"
                                        class="pims-pagination-link {{ $releasedPrisoners->currentPage() == $i ? 'active' : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                                @endforeach

                                @if($releasedPrisoners->hasMorePages())
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->nextPageUrl() }}" class="pims-pagination-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                                @else
                                <li class="pims-pagination-item">
                                    <span class="pims-pagination-link disabled">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="pims-modal" id="pims-prisoner-modal">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h5><i class="fas fa-user"></i> Prisoner Release Details</h5>
                <button class="pims-modal-close">×</button>
            </div>
            <div class="pims-modal-body" id="pims-prisoner-details-content">
                <div class="pims-spinner"></div>
            </div>
            <div class="pims-modal-footer">
                <button class="pims-btn pims-btn-secondary pims-modal-close-btn">Close</button>
                <button class="pims-btn pims-btn-primary" onclick="pimsPrintReleaseDocument()">
                    <i class="fas fa-print"></i> Print Release
                </button>
            </div>
        </div>
    </div>

    <script>
        // Enhanced view prisoner details
        async function pimsViewPrisonerDetails(prisonerId) {
            const modal = document.getElementById('pims-prisoner-modal');
            const content = document.getElementById('pims-prisoner-details-content');

            content.innerHTML = '<div class="pims-spinner"></div>';
            modal.classList.add('active');

            try {
                const response = await fetch(`/prisonershow/${prisonerId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();

                const releaseStatus = data.status?.replace('_', ' ') || 'N/A';
                const maritalStatus = data.marital_status?.replace('_', ' ') || 'N/A';
                const crimeCommitted = data.crime_committed || 'N/A';
                const timeServeStart = data.time_serve_start ? new Date(data.time_serve_start).toLocaleDateString() : 'N/A';
                const timeServeEnd = data.time_serve_end ? new Date(data.time_serve_end).toLocaleDateString() : 'N/A';
                const address = data.address?.replace(/\r\n/g, ', ') || 'N/A';
                const emergencyContact = data.emergency_contact_name 
                    ? `${data.emergency_contact_name} (${data.emergency_contact_relation}) - ${data.emergency_contact_number}` 
                    : 'N/A';
                const inmateImagePath = data.inmate_image ? `/storage/${data.inmate_image}` : '/images/default-profile.png';

                content.innerHTML = `
                    <div class="pims-details-grid">
                        <div style="text-align: center;">
                            <div class="pims-inmate-image">
                                <img src="${inmateImagePath}" alt="Inmate Image" onerror="this.src='/images/default-profile.png'">
                            </div>
                            <h4 style="margin-top: 1rem;">${data.first_name || ''} ${data.last_name || ''}</h4>
                            <p style="color: var(--pims-secondary);">Prisoner ID: ${data.id || 'N/A'}</p>
                        </div>
                        <div>
                            <div class="pims-detail-item">
                                <strong>Age</strong>
                                <span>${calculateAge(data.dob)}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Crime Committed</strong>
                                <span>${crimeCommitted}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Original Sentence</strong>
                                <span>${timeServeStart} to ${timeServeEnd}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Gender</strong>
                                <span>${data.gender || 'N/A'}</span>
                            </div>
                        </div>
                        <div>
                            <div class="pims-detail-item">
                                <strong>Status</strong>
                                <span class="text-capitalize">${releaseStatus}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Marital Status</strong>
                                <span class="text-capitalize">${maritalStatus}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Address</strong>
                                <span>${address}</span>
                            </div>
                            <div class="pims-detail-item">
                                <strong>Emergency Contact</strong>
                                <span>${emergencyContact}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pims-alert pims-alert-success" style="margin-top: 1.5rem;">
                        <i class="fas fa-check-circle"></i>
                        This prisoner has been successfully released from custody.
                    </div>
                `;
            } catch (error) {
                console.error('Error loading prisoner details:', error);
                content.innerHTML = `
                    <div class="pims-alert pims-alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        Error loading prisoner details. Please try again later.
                    </div>
                `;
            }
        }

        function calculateAge(dob) {
            if (!dob) return 'N/A';
            const birthDate = new Date(dob);
            const ageDifMs = Date.now() - birthDate.getTime();
            const ageDate = new Date(ageDifMs);
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }

        function pimsPrintReleaseDocument() {
            const printContent = document.getElementById('pims-prisoner-details-content').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Prisoner Release Document</title>
                        <style>
                            body { font-family: 'Poppins', sans-serif; padding: 2rem; }
                            .pims-details-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; }
                            .pims-detail-item { margin-bottom: 1rem; }
                            .pims-detail-item strong { display: block; margin-bottom: 0.25rem; }
                            .pims-detail-item span { display: block; padding: 0.75rem; background: #f8f9fa; border-radius: 8px; }
                            .pims-inmate-image img { width: 180px; height: 180px; border-radius: 50%; }
                            .pims-alert { padding: 1rem; background: rgba(46, 204, 113, 0.2); border-radius: 8px; }
                        </style>
                    </head>
                    <body>
                        <h2>Prisoner Release Document</h2>
                        ${printContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        function searchPrisoners() {
            const searchTerm = document.getElementById('pims-search').value.toLowerCase();
            const rows = document.querySelectorAll('#pims-prisoners-table tbody tr');

            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const id = row.cells[2].textContent.toLowerCase();
                row.style.display = (name.includes(searchTerm) || id.includes(searchTerm)) ? '' : 'none';
            });
        }

        function clearSearch() {
            const searchInput = document.getElementById('pims-search');
            searchInput.value = '';
            searchPrisoners();
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.pims-view-prisoner').forEach(button => {
                button.addEventListener('click', () => {
                    const prisonerId = button.getAttribute('data-id');
                    pimsViewPrisonerDetails(prisonerId);
                });
            });

            document.querySelectorAll('.pims-modal-close, .pims-modal-close-btn').forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById('pims-prisoner-modal').classList.remove('active');
                });
            });

            document.getElementById('pims-prisoner-modal').addEventListener('click', e => {
                if (e.target === e.currentTarget) {
                    e.currentTarget.classList.remove('active');
                }
            });

            document.getElementById('pims-search').addEventListener('input', searchPrisoners);
        });
    </script>
    @include('includes.footer_js')
</body>
</html>