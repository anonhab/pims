
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Medical Appointment Records</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #34495e;
            --accent: #3498db;
            --light: #ecf0f1;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f1c40f;
            --radius: 8px;
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
            --font-size-base: clamp(0.9rem, 2vw, 1rem);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            color: var(--primary);
            font-size: var(--font-size-base);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        #pims-app-content {
            min-height: 100vh;
        }

        #pims-page-content {
            padding: clamp(1rem, 3vw, 2rem);
        }

        .pims-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .pims-card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .pims-card-header-title {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-card-content {
            padding: 1.5rem;
        }

        .pims-filter-controls {
            margin-bottom: 1.5rem;
        }

        .pims-search-input .input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: var(--font-size-base);
            transition: var(--transition);
        }

        .pims-search-input .input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .control.has-icons-left {
            position: relative;
        }

        .pims-icon.is-left {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }

        .buttons.is-right {
            display: flex;
            justify-content: flex-end;
        }

        .pims-button {
            padding: 0.5rem 1rem;
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

        .pims-button-success {
            background: var(--success);
            color: #fff;
        }

        .pims-button-success:hover {
            background: #27ae60;
        }

        .pims-page {
            display: none;
        }

        .pims-page.active {
            display: grid;
        }

        .appointment-card {
            transition: var(--transition);
        }

        .appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .pims-card-footer {
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
        }

        .pims-card-footer-item {
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pims-status-tag {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: auto;
        }

        .pims-status-pending {
            background: var(--warning);
            color: #fff;
        }

        .pims-status-scheduled {
            background: var(--accent);
            color: #fff;
        }

        .pims-status-completed {
            background: var(--success);
            color: #fff;
        }

        .pims-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .pims-page-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            background: #fff;
            cursor: pointer;
            transition: var(--transition);
        }

        .pims-page-btn:hover {
            background: var(--light);
        }

        .pims-page-btn.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .pims-page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pims-page-ellipsis {
            padding: 0.5rem;
        }

        .pims-modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.5);
        }

        .pims-modal.is-active {
            display: flex;
        }

        .pims-modal-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pims-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pims-modal-title i {
            color: var(--accent);
        }

        .pims-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--secondary);
            transition: var(--transition);
        }

        .pims-modal-close:hover {
            color: var(--primary);
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

        .pims-form-group {
            margin-bottom: 1.25rem;
        }

        .pims-form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary);
        }

        .pims-form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: var(--font-size-base);
            transition: var(--transition);
        }

        .pims-form-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        @media (max-width: 992px) {
            #pims-page-content { padding: 1rem; }
            .columns { margin: 0; }
            .column.is-10 { width: 100%; }
        }

        @media (max-width: 768px) {
            .pims-filter-controls .columns { flex-direction: column; }
            .buttons.is-right { justify-content: center; }
            .pims-search-input { max-width: 100%; }
        }

        @media (max-width: 480px) {
            .pims-modal-footer { flex-direction: column; }
            .pims-modal-footer .pims-button { width: 100%; }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="columns" id="pims-app-content">
        @include('medical_officer.menu')
        <div class="column is-10" id="pims-page-content">
            <section class="section">
                <div class="container">
                    <div class="pims-card">
                        <header class="pims-card-header">
                            <p class="pims-card-header-title">
                                <span class="pims-icon mr-2"><i class="fas fa-notes-medical" aria-hidden="true"></i></span>
                                Appointment Records
                            </p>
                        </header>
                        <div class="pims-card-content">
                            <div class="pims-filter-controls">
                                <div class="columns is-variable is-1">
                                    <div class="column is-9-tablet is-10-desktop">
                                        <div class="pims-search-input field">
                                            <div class="control has-icons-left">
                                                <input class="input" id="pims-appointment-search" type="text" placeholder="Search by prisoner name, record ID or created by..." aria-label="Search appointments">
                                                <span class="pims-icon is-left">
                                                    <i class="fas fa-search" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-3-tablet is-2-desktop has-text-right">
                                        <div class="buttons is-right">
                                            <a href="{{ route('medical.createAppointment') }}" class="pims-button pims-button-success" aria-label="Schedule new appointment">
                                                <span class="pims-icon is-small"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                <span>Schedule Appointment</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="pims-appointments-container">
                                <!-- Pages will be generated by JavaScript -->
                            </div>
                            <div class="pims-pagination">
                                <button class="pims-page-btn" id="pims-prev-btn" disabled aria-label="Previous page">Previous</button>
                                <div id="pims-page-numbers"></div>
                                <button class="pims-page-btn" id="pims-next-btn" aria-label="Next page">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div id="pims-edit-modal" class="pims-modal" role="dialog" aria-labelledby="edit-modal-title" aria-hidden="true">
        <div class="pims-modal-card">
            <header class="pims-modal-header">
                <h2 class="pims-modal-title" id="edit-modal-title">
                    <i class="fas fa-edit" aria-hidden="true"></i> Update Appointment Status
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
                    <button type="button" class="pims-button pims-button-light pims-close-modal" aria-label="Cancel edit">Cancel</button>
                    <button type="submit" class="pims-button pims-button-success">
                        <i class="fas fa-save" aria-hidden="true"></i> Update Status
                    </button>
                </footer>
            </form>
        </div>
    </div>

    @include('includes.footer_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
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
                        <div class="notification is-warning is-light has-text-centered" style="grid-column: 1/-1;">
                            No appointments found matching your search criteria.
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
                        card.className = 'pims-card appointment-card';
                        card.dataset.prisoner = appointment.prisonerLower;
                        card.dataset.record = appointment.id;
                        card.dataset.createdby = appointment.createdByLower;

                        card.innerHTML = `
                            <header class="pims-card-header">
                                <p class="pims-card-header-title">
                                    <span class="pims-icon mr-2"><i class="fas fa-calendar-check" aria-hidden="true"></i></span>
                                    Record #${appointment.id}
                                    <span class="pims-status-tag ${statusClass}">
                                        ${appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1)}
                                    </span>
                                </p>
                            </header>
                            <div class="pims-card-content">
                                <div class="content">
                                    <p><strong>Prisoner:</strong> ${appointment.prisoner || 'N/A'}</p>
                                    <p><strong>Doctor:</strong> ${appointment.doctor}</p>
                                    <p><strong>Date:</strong> ${appointment.date}</p>
                                    <p><strong>Diagnosis:</strong> ${appointment.diagnosis || 'N/A'}</p>
                                    <p><strong>Treatment:</strong> ${appointment.treatment || 'N/A'}</p>
                                    <p><strong>Created By:</strong> ${appointment.createdBy || 'N/A'}</p>
                                    <p><small class="has-text-grey">Created: ${appointment.createdAt}</small></p>
                                    <p><small class="has-text-grey">Updated: ${appointment.updatedAt}</small></p>
                                </div>
                            </div>
                            <footer class="pims-card-footer">
                                <button class="pims-card-footer-item has-text-warning pims-edit-btn"
                                        data-id="${appointment.id}"
                                        data-status="${appointment.status}"
                                        aria-label="Edit appointment ${appointment.id}">
                                    <span class="pims-icon"><i class="fas fa-edit" aria-hidden="true"></i></span>
                                    <span>Edit</span>
                                </button>
                            </footer>
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