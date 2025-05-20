<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Information Management System - Released Prisoners</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        :root {
            --primary: #1e3a8a; /* Navy */
            --secondary: #0d9488; /* Teal */
            --accent: #f472b6; /* Coral */
            --light: #f9fafb; /* Off-white */
            --success: #10b981; /* Emerald */
            --warning: #f59e0b; /* Amber */
            --danger: #ef4444; /* Red */
            --radius: 10px;
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 20px rgba(0,0,0,0.12);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font-size-base: clamp(0.9rem, 1.8vw, 0.95rem);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(145deg, #e5e7eb 0%, #f3f4f6 100%);
            color: var(--primary);
            font-size: var(--font-size-base);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        .pims-app-container {
            display: flex;
            min-height: 100vh;
        }

        .pims-main-content {
            flex-grow: 1;
            padding: clamp(1.5rem, 4vw, 2rem);
            margin-left: 250px;
            transition: var(--transition);
        }

        .pims-content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .pims-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .pims-page-title {
            font-size: clamp(1.8rem, 5vw, 2rem);
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-page-title i {
            color: var(--accent);
            font-size: 1.6rem;
        }

        .pims-search-container {
            display: flex;
            gap: 0.75rem;
            max-width: 400px;
            width: 100%;
        }

        .pims-search-input {
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: var(--font-size-base);
            transition: var(--transition);
            background: #fff;
            width: 100%;
        }

        .pims-search-input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(13,148,136,0.2);
        }

        .pims-search-container i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1rem;
        }

        .pims-btn {
            padding: 0.65rem 1.25rem;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-btn-primary {
            background: var(--secondary);
            color: #fff;
        }

        .pims-btn-primary:hover {
            background: #0f766e;
            transform: translateY(-2px);
        }

        .pims-btn-secondary {
            background: var(--light);
            color: var(--primary);
            border: 1px solid #d1d5db;
        }

        .pims-btn-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .pims-btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }

        .pims-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .pims-card-header {
            padding: 1.25rem;
            background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
            color: #fff;
        }

        .pims-card-header h5 {
            font-size: 1.4rem;
            font-weight: 600;
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
            background: #fff;
            border-radius: var(--radius);
            overflow: hidden;
        }

        .pims-table th {
            background: var(--primary);
            color: #fff;
            font-weight: 500;
            text-align: left;
            padding: 0.75rem 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .pims-table td {
            padding: 0.65rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .pims-table tr {
            transition: var(--transition);
            animation: fadeIn 0.5s ease;
        }

        .pims-table tr:hover {
            background: rgba(13,148,136,0.05);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pims-badge-success {
            background: var(--success);
            color: #fff;
        }

        .pims-alert {
            padding: 1rem;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .pims-alert-success {
            background: rgba(16,185,129,0.2);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .pims-alert-danger {
            background: rgba(239,68,68,0.2);
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }

        .pims-empty-state {
            text-align: center;
            padding: 2rem;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .pims-empty-state i {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 0.75rem;
        }

        .pims-empty-state h5 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .pims-empty-state p {
            color: var(--primary);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        .pims-modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(3px);
        }

        .pims-modal.active {
            display: flex;
        }

        .pims-modal-container {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            max-width: 900px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.25rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-header h5 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-modal-header h5 i {
            color: var(--accent);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.4rem;
            cursor: pointer;
            color: var(--primary);
            transition: var(--transition);
        }

        .pims-modal-close:hover {
            color: var(--secondary);
            transform: scale(1.2);
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .pims-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .pims-detail-item {
            margin-bottom: 1rem;
        }

        .pims-detail-item strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--primary);
            font-weight: 500;
        }

        .pims-detail-item span {
            display: block;
            padding: 0.65rem;
            background: var(--light);
            border-radius: var(--radius);
            word-break: break-word;
            font-size: 0.9rem;
        }

        .pims-inmate-image img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--light);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .pims-inmate-image img:hover {
            transform: scale(1.05);
        }

        .pims-spinner {
            width: 2.5rem;
            height: 2.5rem;
            border: 0.2rem solid rgba(13,148,136,0.2);
            border-top-color: var(--secondary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .pims-pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .pims-pagination-list {
            display: flex;
            list-style: none;
            gap: 0.5rem;
        }

        .pims-pagination-item {
            display: inline-flex;
        }

        .pims-pagination-link {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: var(--radius);
            background: #fff;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .pims-pagination-link:hover {
            background: var(--secondary);
            color: #fff;
            border-color: var(--secondary);
        }

        .pims-pagination-link.active {
            background: var(--secondary);
            color: #fff;
            border-color: var(--secondary);
        }

        .pims-pagination-link.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media print {
            body, .pims-app-container, .pims-main-content, .pims-content-container {
                background: #fff;
                margin: 0;
                padding: 0;
            }
            .pims-modal, .pims-modal-header, .pims-modal-footer, .pims-nav, .pims-menu {
                display: none;
            }
            .pims-modal-container, .pims-modal-body {
                display: block;
                box-shadow: none;
                border: none;
                width: 100%;
                max-width: none;
                padding: 1rem;
            }
            .pims-details-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }
            .pims-inmate-image img {
                width: 120px;
                height: 120px;
            }
            .pims-alert {
                border: 1px solid var(--success);
            }
        }

        @media (max-width: 992px) {
            .pims-main-content {
                margin-left: 0;
                padding: 1rem;
            }
            .pims-search-container {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .pims-page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .pims-table th:nth-child(4), .pims-table td:nth-child(4),
            .pims-table th:nth-child(5), .pims-table td:nth-child(5) {
                display: none;
            }
            .pims-details-grid {
                grid-template-columns: 1fr;
            }
            .pims-search-container {
                flex-direction: column;
                align-items: stretch;
            }
            .pims-btn-primary {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .pims-table th:nth-child(3), .pims-table td:nth-child(3) {
                display: none;
            }
            .pims-inmate-image img {
                width: 120px;
                height: 120px;
            }
            .pims-page-title {
                font-size: 1.6rem;
            }
            .pims-btn-sm {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }
            .pims-pagination-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
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
                        <i class="fas fa-user-check" aria-hidden="true"></i> Released Prisoners Management
                    </h2>
                </div>

                <div class="pims-search-container">
                    <div style="position: relative; flex: 1;">
                        <input type="text" class="pims-search-input" id="pims-search" placeholder="Search by name or ID..." aria-label="Search released prisoners">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </div>
                    <button class="pims-btn pims-btn-primary" onclick="clearSearch()">
                        <i class="fas fa-times" aria-hidden="true"></i> Clear
                    </button>
                </div>

                <div class="pims-card">
                    <div class="pims-card-header">
                        <h5>Released Prisoners Registry</h5>
                    </div>
                    <div class="pims-card-body">
                        @if(session('success'))
                        <div class="pims-alert pims-alert-success">
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
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
                                        <td>
                                            {{ \Carbon\Carbon::hasFormat($prisoner->time_serve_end, 'Y-m-d') || strtotime($prisoner->time_serve_end)
                                                ? \Carbon\Carbon::parse($prisoner->time_serve_end)->format('M d, Y')
                                                : $prisoner->time_serve_end }}
                                        </td>
                                        <td class="text-capitalize">{{ $prisoner->crime_committed }}</td>
                                        <td>
                                            <span class="pims-badge pims-badge-success">
                                                <i class="fas fa-check-circle" aria-hidden="true"></i> {{ ucfirst($prisoner->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="pims-btn pims-btn-sm pims-btn-primary pims-view-prisoner"
                                                    data-id="{{ $prisoner->id }}"
                                                    aria-label="View details for {{ $prisoner->first_name }} {{ $prisoner->last_name }}">
                                                <i class="fas fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="pims-empty-state">
                                                <i class="fas fa-box-open" aria-hidden="true"></i>
                                                <h5>No Released Prisoners Found</h5>
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
                                    <span class="pims-pagination-link disabled" aria-disabled="true">
                                        <i class="fas fa-chevron-left" aria-hidden="true"></i>
                                    </span>
                                </li>
                                @else
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->previousPageUrl() }}" class="pims-pagination-link" aria-label="Previous page">
                                        <i class="fas fa-chevron-left" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @endif

                                @foreach(range(1, $releasedPrisoners->lastPage()) as $i)
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->url($i) }}"
                                       class="pims-pagination-link {{ $releasedPrisoners->currentPage() == $i ? 'active' : '' }}"
                                       aria-label="Page {{ $i }}">
                                        {{ $i }}
                                    </a>
                                </li>
                                @endforeach

                                @if($releasedPrisoners->hasMorePages())
                                <li class="pims-pagination-item">
                                    <a href="{{ $releasedPrisoners->nextPageUrl() }}" class="pims-pagination-link" aria-label="Next page">
                                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @else
                                <li class="pims-pagination-item">
                                    <span class="pims-pagination-link disabled" aria-disabled="true">
                                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
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

    <div class="pims-modal" id="pims-prisoner-modal" role="dialog" aria-labelledby="prisoner-modal-title" aria-hidden="true">
        <div class="pims-modal-container">
            <div class="pims-modal-header">
                <h5 id="prisoner-modal-title">
                    <i class="fas fa-user" aria-hidden="true"></i> Prisoner Release Details
                </h5>
                <button class="pims-modal-close" aria-label="Close modal">×</button>
            </div>
            <div class="pims-modal-body" id="pims-prisoner-details-content">
                <div class="pims-spinner"></div>
            </div>
            <div class="pims-modal-footer">
                <button class="pims-btn pims-btn-secondary pims-modal-close-btn" aria-label="Close">
                    <i class="fas fa-times" aria-hidden="true"></i> Close
                </button>
                <button class="pims-btn pims-btn-primary" onclick="pimsPrintReleaseDocument()" aria-label="Print release document">
                    <i class="fas fa-print" aria-hidden="true"></i> Print Release
                </button>
            </div>
        </div>
    </div>

    <script>
        async function pimsViewPrisonerDetails(prisonerId) {
            const modal = document.getElementById('pims-prisoner-modal');
            const content = document.getElementById('pims-prisoner-details-content');

            content.innerHTML = '<div class="pims-spinner"></div>';
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            try {
                const response = await fetch(`/prisonershow/${prisonerId}`);
                if (!response.ok) throw new Error('Failed to fetch prisoner details');
                const data = await response.json();

                const releaseStatus = data.status?.replace('_', ' ') || 'N/A';
                const maritalStatus = data.marital_status?.replace('_', ' ') || 'N/A';
                const crimeCommitted = data.crime_committed || 'N/A';
                const timeServeStart = data.time_serve_start ? new Date(data.time_serve_start).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' }) : 'N/A';
                const timeServeEnd = data.time_serve_end ? new Date(data.time_serve_end).toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' }) : 'N/A';
                const address = data.address?.replace(/\r\n/g, ', ') || 'N/A';
                const emergencyContact = data.emergency_contact_name 
                    ? `${data.emergency_contact_name} (${data.emergency_contact_relation}) - ${data.emergency_contact_number}` 
                    : 'N/A';
                const inmateImagePath = data.inmate_image ? `/storage/${data.inmate_image}` : '/images/default-profile.png';

                content.innerHTML = `
                    <div class="pims-details-grid">
                        <div style="text-align: center;">
                            <div class="pims-inmate-image">
                                <img src="${inmateImagePath}" alt="Inmate Image for ${data.first_name || ''} ${data.last_name || ''}" onerror="this.src='/images/default-profile.png'">
                            </div>
                            <h4 style="margin-top: 1rem;">${data.first_name || ''} ${data.last_name || ''}</h4>
                            <p style="color: var(--primary); opacity: 0.7;">Prisoner ID: ${data.id || 'N/A'}</p>
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
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        This prisoner has been successfully released from custody.
                    </div>
                `;
            } catch (error) {
                console.error('Error loading prisoner details:', error);
                content.innerHTML = `
                    <div class="pims-alert pims-alert-danger">
                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
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
                            body { font-family: 'Poppins', sans-serif; padding: 2rem; color: #1e3a8a; }
                            .pims-details-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; }
                            .pims-detail-item { margin-bottom: 1rem; }
                            .pims-detail-item strong { display: block; margin-bottom: 0.25rem; font-weight: 500; }
                            .pims-detail-item span { display: block; padding: 0.65rem; background: #f9fafb; border-radius: 10px; font-size: 0.9rem; }
                            .pims-inmate-image img { width: 120px; height: 120px; border-radius: 50%; border: 3px solid #f9fafb; }
                            .pims-alert { padding: 1rem; background: rgba(16,185,129,0.2); border: 1px solid #10b981; border-radius: 10px; color: #10b981; }
                            h4 { font-size: 1.4rem; margin: 1rem 0 0.5rem; }
                            p { font-size: 0.9rem; }
                            @media print {
                                body { padding: 1rem; }
                            }
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
            const rows = document.querySelectorAll('#pims-prisoners-table tbody tr:not(.pims-empty-state)');

            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const id = row.cells[2].textContent.toLowerCase();
                row.style.display = (name.includes(searchTerm) || id.includes(searchTerm)) ? '' : 'none';
            });

            const emptyState = document.querySelector('.pims-empty-state');
            if (emptyState) {
                const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
                emptyState.style.display = visibleRows.length === 0 && searchTerm ? 'block' : 'none';
            }
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
                    const modal = document.getElementById('pims-prisoner-modal');
                    modal.classList.remove('active');
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                });
            });

            document.getElementById('pims-prisoner-modal').addEventListener('click', e => {
                if (e.target === e.currentTarget) {
                    e.target.classList.remove('active');
                    e.target.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
            });

            document.getElementById('pims-search').addEventListener('input', searchPrisoners);

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && document.getElementById('pims-prisoner-modal').classList.contains('active')) {
                    document.getElementById('pims-prisoner-modal').classList.remove('active');
                    document.getElementById('pims-prisoner-modal').setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
    @include('includes.footer_js')
</body>
</html>