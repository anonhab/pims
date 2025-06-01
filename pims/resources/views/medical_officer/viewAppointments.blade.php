<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS - Medical Appointment Records</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --pims-primary: #0a192f; /* Navy blue */
            --pims-secondary: #172a45; /* Darker navy */
            --pims-accent:rgb(255, 174, 0); /* Teal accent */
            --pims-danger: #ff5555; /* Vibrant red */
            --pims-success:rgb(250, 168, 80); /* Vibrant green */
            --pims-warning: #ffb86c; /* Soft orange */
            --pims-info: #8be9fd; /* Light blue */
            --pims-text-light: #f8f8f2; /* Off white */
            --pims-text-dark: #282a36; /* Dark gray */
            --pims-card-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --pims-border-radius: 8px;
            --pims-nav-height: 70px;
            --pims-sidebar-width: 280px;
            --pims-transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-text-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            line-height: 1.6;
        }

        /* Main Content Area */
        #pims-page-content {
            margin-left: 0;
            padding: 2rem;
            padding-left: calc(var(--pims-sidebar-width) + 2rem);
            min-height: calc(100vh - var(--pims-nav-height));
            transition: var(--pims-transition);
            background-color: #f5f7fa;
            padding-top: 70px;
        }

        /* Dashboard Cards */
        .pims-dashboard-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            transition: var(--pims-transition);
            height: 100%;
            border-left: 4px solid var(--pims-accent);
            position: relative;
            overflow: hidden;
            padding: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .pims-dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        /* Stats Box */
        .pims-stats-box {
            background: linear-gradient(145deg, #ffffff 0%, #f7faff 100%);
            border-radius: var(--pims-border-radius);
            padding: 2rem;
            box-shadow: var(--pims-card-shadow);
            margin-top: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            transition: var(--pims-transition);
        }

        .pims-stats-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .pims-stats-box h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--pims-primary);
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            border-bottom: 2px solid rgba(100, 255, 218, 0.2);
        }

        .pims-stats-box h2 i {
            color: var(--pims-accent);
            background: linear-gradient(135deg, rgba(100, 255, 218, 0.15) 0%, rgba(100, 255, 218, 0.05) 100%);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        /* Section Title */
        .pims-section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--pims-primary);
            position: relative;
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            font-family: 'Inter', sans-serif;
        }

        .pims-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--pims-accent) 0%, rgba(100, 255, 218, 0) 100%);
            border-radius: 2px;
        }

        .pims-section-title i {
            margin-right: 12px;
            color: var(--pims-accent);
            background: rgba(100, 255, 218, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Status Tags */
        .pims-status-tag {
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .pims-status-pending {
            background-color: rgba(255, 184, 108, 0.1);
            color: var(--pims-warning);
        }

        .pims-status-scheduled {
            background-color: rgba(100, 255, 218, 0.1);
            color: var(--pims-accent);
        }

        .pims-status-completed {
            background-color: rgba(80, 250, 123, 0.1);
            color: var(--pims-success);
        }

        /* Button Styles */
        .pims-btn {
            padding: 0.5rem 1rem;
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

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: var(--pims-primary);
            font-weight: 700;
        }

        .pims-btn-primary:hover {
            background-color:rgb(255, 161, 46);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(100, 255, 218, 0.3);
        }

        .pims-btn-success {
            background-color: var(--pims-success);
            color: var(--pims-primary);
            font-weight: 700;
        }

        .pims-btn-success:hover {
            background-color: #40e06b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(80, 250, 123, 0.3);
        }

        /* Search Box */
        .pims-search-box {
            position: relative;
            flex-grow: 1;
        }

        .pims-search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--pims-border-radius);
            font-size: 0.9rem;
            transition: var(--pims-transition);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .pims-search-box input:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.2);
        }

        .pims-search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-accent);
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pims-page-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: white;
        }

        .pims-page-btn:hover {
            background-color: rgba(100, 255, 218, 0.1);
        }

        .pims-page-btn.active {
            background-color: var(--pims-accent);
            color: var(--pims-primary);
            border-color: var(--pims-accent);
        }

        .pims-page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal Styles */
        .pims-modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
        }

        .pims-modal.is-active {
            display: flex;
        }

        .pims-modal-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            animation: pims-modalFadeIn 0.3s ease;
        }

        @keyframes pims-modalFadeIn {
            from {  transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--pims-primary);
        }

        .pims-modal-title i {
            color: var(--pims-accent);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--pims-secondary);
            transition: var(--pims-transition);
        }

        .pims-modal-close:hover {
            color: var(--pims-primary);
        }

        .pims-modal-body {
            padding: 1.5rem;
        }

        .pims-modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Form Styles */
        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--pims-secondary);
        }

        .pims-form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--pims-border-radius);
            font-family: inherit;
            font-size: 0.9rem;
            transition: var(--pims-transition);
        }

        .pims-form-select:focus {
            outline: none;
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.2);
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .pims-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 992px) {
            #pims-page-content {
                padding-left: 2rem;
            }
        }

        @media (max-width: 768px) {
            .pims-grid {
                grid-template-columns: 1fr;
            }

            .pims-section-title {
                font-size: 1.5rem;
            }

            .pims-stats-box {
                padding: 1.5rem;
            }

            .pims-stats-box h2 {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .pims-modal-footer {
                flex-direction: column;
            }
            .pims-modal-footer .pims-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    @include('components.preloader')

    <!-- Navigation -->
    @include('includes.nav')

    <!-- Sidebar -->
    @include('medical_officer.menu')

    <!-- Main Content -->
    <div id="pims-page-content">
        <h1 class="pims-section-title">
            <i class="fas fa-notes-medical"></i> Appointment Records
        </h1>

        <!-- Notifications -->
        @if(session('success'))
            <div class="pims-notification pims-notification-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="pims-notification pims-notification-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <div class="pims-stats-box">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2><i class="fas fa-calendar-check"></i> Appointment Records</h2>
                <div style="display: flex; gap: 1rem;">
                    <div class="pims-search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="pims-appointment-search" placeholder="Search by prisoner name, record ID or created by...">
                    </div>
                    <a href="{{ route('medical.createAppointment') }}" class="pims-btn pims-btn-success" aria-label="Schedule new appointment">
                        <i class="fas fa-plus"></i> Schedule Appointment
                    </a>
                </div>
            </div>
            
            <div id="pims-appointments-container">
                <!-- Appointments will be loaded here by JavaScript -->
            </div>

            <div class="pims-pagination">
                <button class="pims-page-btn" id="pims-prev-btn" disabled aria-label="Previous page">
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <div id="pims-page-numbers"></div>
                <button class="pims-page-btn" id="pims-next-btn" aria-label="Next page">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Appointment Modal -->
    <div id="pims-edit-modal" class="pims-modal" role="dialog" aria-labelledby="pims-edit-modal-title" aria-hidden="true">
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <h2 class="pims-modal-title" id="pims-edit-modal-title">
                    <i class="fas fa-edit"></i> Update Appointment Status
                </h2>
                <button class="pims-modal-close" aria-label="Close edit modal">×</button>
            </header>
            <form id="pims-edit-form" method="POST">
                @csrf
                <input type="hidden" name="id" id="pims-edit-id">
                <section class="pims-modal-body">
                    <div class="pims-form-group">
                        <label class="pims-form-label" for="pims-edit-status">Status</label>
                        <select class="pims-form-select" name="status" id="pims-edit-status" required>
                            <option value="pending">Pending</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </section>
                <footer class="pims-modal-footer">
                    <button type="button" class="pims-btn pims-close-modal" aria-label="Cancel edit">Cancel</button>
                    <button type="submit" class="pims-btn pims-btn-success">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </footer>
            </form>
        </div>
    </div>

    @include('includes.footer_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'CSRF token missing. Please check application setup.' });
                return;
            }

            const appointments = [
                @foreach($appointments as $appointment)
                {
                    id: "{{ $appointment->id }}",
                    prisoner: "{{ $appointment->prisoner ? $appointment->prisoner->first_name . ' ' . $appointment->prisoner->last_name : '' }}",
                    prisonerLower: "{{ $appointment->prisoner ? strtolower($appointment->prisoner->first_name . ' ' . $appointment->prisoner->last_name) : '' }}",
                    doctor: "{{ $appointment->doctor ? $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name : 'N/A' }}",
                    date: "{{ $appointment->appointment_date->format('Y-m-d') }}",
                    diagnosis: "{{ $appointment->diagnosis }}",
                    treatment: "{{ $appointment->treatment }}",
                    createdBy: "{{ $appointment->createdBy ? $appointment->createdBy->first_name . ' ' . $appointment->createdBy->last_name : '' }}",
                    createdByLower: "{{ $appointment->createdBy ? strtolower($appointment->createdBy->first_name . ' ' . $appointment->createdBy->last_name) : '' }}",
                    status: "{{ $appointment->status }}",
                    createdAt: "{{ $appointment->created_at->format('Y-m-d H:i:s') }}",
                    updatedAt: "{{ $appointment->updated_at->format('Y-m-d H:i:s') }}"
                },
                @endforeach
            ];

            const cardsPerPage = 12;
            let currentPage = 1;
            let filteredAppointments = [...appointments];

            const container = document.getElementById('pims-appointments-container');
            const prevBtn = document.getElementById('pims-prev-btn');
            const nextBtn = document.getElementById('pims-next-btn');
            const pageNumbers = document.getElementById('pims-page-numbers');
            const searchInput = document.getElementById('pims-appointment-search');
            const editModal = document.getElementById('pims-edit-modal');

            function closeModal() {
                editModal.classList.remove('is-active');
                editModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            function initPagination() {
                renderAppointments();
                renderPageNumbers();
                updatePaginationButtons();
            }

            function renderAppointments() {
                container.innerHTML = '';
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);

                if (filteredAppointments.length === 0) {
                    container.innerHTML = `
                        <div class="pims-notification pims-notification-warning" style="grid-column: 1/-1; text-align: center;">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>No appointments found matching your search criteria.</div>
                        </div>
                    `;
                    return;
                }

                for (let i = 1; i <= totalPages; i++) {
                    const pageDiv = document.createElement('div');
                    pageDiv.className = `pims-page ${i === 1 ? 'active' : ''}`;
                    pageDiv.id = `pims-page-${i}`;
                    pageDiv.style.display = i === 1 ? 'grid' : 'none';
                    pageDiv.style.gridTemplateColumns = 'repeat(auto-fill, minmax(300px, 1fr))';
                    pageDiv.style.gap = '1.75rem';

                    const startIndex = (i - 1) * cardsPerPage;
                    const endIndex = Math.min(startIndex + cardsPerPage, filteredAppointments.length);
                    const pageAppointments = filteredAppointments.slice(startIndex, endIndex);

                    pageAppointments.forEach(appointment => {
                        const statusClass = appointment.status === 'pending' ? 'pims-status-pending' :
                                          (appointment.status === 'completed' ? 'pims-status-completed' : 'pims-status-scheduled');

                        const card = document.createElement('div');
                        card.className = 'pims-dashboard-card pims-appointment-card';
                        card.dataset.prisoner = appointment.prisonerLower;
                        card.dataset.record = appointment.id;
                        card.dataset.createdby = appointment.createdByLower;

                        card.innerHTML = `
                            <div class="pims-card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h3>Record #${appointment.id}</h3>
                            <p>${appointment.prisoner || 'N/A'}</p>
                            <div class="pims-card-footer">
                                <span><strong>Doctor:</strong> ${appointment.doctor}</span>
                                <span><strong>Date:</strong> ${appointment.date}</span>
                                <span class="pims-status-tag ${statusClass}">
                                    ${appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1)}
                                </span>
                            </div>
                            <div style="margin-top: 1rem;">
                                <button class="pims-btn pims-btn-primary pims-edit-btn"
                                        data-id="${appointment.id}"
                                        data-status="${appointment.status}"
                                        aria-label="Edit appointment ${appointment.id}">
                                    <i class="fas fa-edit"></i> Edit Status
                                </button>
                            </div>
                        `;

                        pageDiv.appendChild(card);
                    });

                    container.appendChild(pageDiv);
                }

                document.querySelectorAll('.pims-edit-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        const id = btn.dataset.id;
                        document.getElementById('pims-edit-id').value = id;
                        document.getElementById('pims-edit-status').value = btn.dataset.status;
                        document.getElementById('pims-edit-form').action = `{{ route('medical.appointments.update', ':id') }}`.replace(':id', id);
                        editModal.classList.add('is-active');
                        editModal.setAttribute('aria-hidden', 'false');
                        document.body.style.overflow = 'hidden';
                        document.getElementById('pims-edit-status').focus();
                    });
                });
            }

            function renderPageNumbers() {
                pageNumbers.innerHTML = '';
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);

                const startPage = Math.max(1, currentPage - 2);
                const endPage = Math.min(totalPages, currentPage + 2);

                if (startPage > 1) {
                    const firstBtn = document.createElement('button');
                    firstBtn.className = 'pims-page-btn';
                    firstBtn.textContent = '1';
                    firstBtn.setAttribute('aria-label', 'Page 1');
                    firstBtn.addEventListener('click', () => goToPage(1));
                    pageNumbers.appendChild(firstBtn);

                    if (startPage > 2) {
                        const ellipsis = document.createElement('span');
                        ellipsis.className = 'pims-page-ellipsis';
                        ellipsis.textContent = '...';
                        pageNumbers.appendChild(ellipsis);
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.className = `pims-page-btn ${i === currentPage ? 'active' : ''}`;
                    pageBtn.textContent = i;
                    pageBtn.setAttribute('aria-label', `Page ${i}`);
                    pageBtn.addEventListener('click', () => goToPage(i));
                    pageNumbers.appendChild(pageBtn);
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        const ellipsis = document.createElement('span');
                        ellipsis.className = 'pims-page-ellipsis';
                        ellipsis.textContent = '...';
                        pageNumbers.appendChild(ellipsis);
                    }

                    const lastBtn = document.createElement('button');
                    lastBtn.className = 'pims-page-btn';
                    lastBtn.textContent = totalPages;
                    lastBtn.setAttribute('aria-label', `Page ${totalPages}`);
                    lastBtn.addEventListener('click', () => goToPage(totalPages));
                    pageNumbers.appendChild(lastBtn);
                }
            }

            function updatePaginationButtons() {
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);

                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages || totalPages === 0;

                renderPageNumbers();
            }

            function goToPage(page) {
                const currentPageDiv = document.querySelector(`#pims-page-${currentPage}`);
                if (currentPageDiv) {
                    currentPageDiv.style.display = 'none';
                    currentPageDiv.classList.remove('active');
                }

                currentPage = page;
                const newPageDiv = document.querySelector(`#pims-page-${currentPage}`);
                if (newPageDiv) {
                    newPageDiv.style.display = 'grid';
                    newPageDiv.classList.add('active');
                }

                updatePaginationButtons();

                container.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    goToPage(currentPage - 1);
                }
            });

            nextBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);
                if (currentPage < totalPages) {
                    goToPage(currentPage + 1);
                }
            });

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                if (searchTerm === '') {
                    filteredAppointments = [...appointments];
                } else {
                    filteredAppointments = appointments.filter(app =>
                        app.prisonerLower.includes(searchTerm) ||
                        app.id.toString().includes(searchTerm) ||
                        app.createdByLower.includes(searchTerm)
                    );
                }

                currentPage = 1;
                initPagination();
            });

            document.querySelectorAll('.pims-modal-close, .pims-close-modal').forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            window.addEventListener('click', e => {
                if (e.target.classList.contains('pims-modal')) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && editModal.classList.contains('is-active')) {
                    closeModal();
                }
            });

            document.getElementById('pims-edit-form').addEventListener('submit', async e => {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
                submitBtn.disabled = true;

                try {
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData);
                    const response = await fetch(form.action, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                    const result = await response.json();
                    if (response.ok) {
                        closeModal();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Appointment status updated successfully!',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => window.location.reload());
                    } else {
                        throw new Error(result.message || 'Failed to update appointment status');
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Something went wrong!'
                    });
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });

            initPagination();
        });
    </script>
</body>
</html>