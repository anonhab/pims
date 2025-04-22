<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
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
            --pims-card-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --pims-border-radius: 12px;
            --pims-nav-height: 70px;
            --pims-sidebar-width: 280px;
            --pims-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /* Full Screen Layout */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #pims-app-content {
            display: flex;
            min-height: calc(100vh - var(--pims-nav-height));
            margin-top: var(--pims-nav-height);
        }

        #pims-page-content {
            flex: 1;
            padding: 2rem;
            background-color: #f5f7fa;
            overflow-y: auto;
            height: calc(100vh - var(--pims-nav-height));
        }

        /* Card Styles */
        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            transition: var(--pims-transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: none;
            position: relative;
        }

        .pims-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .pims-card-header {
            background: linear-gradient(135deg, var(--pims-secondary), var(--pims-primary));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }


        .pims-card:hover .pims-card-header::before {
            right: 100%;
        }

        .pims-card-header-title {
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            position: relative;
            margin: 0;
        }

        .pims-card-content {
            padding: 1.5rem;
            flex-grow: 1;
            background: white;
        }

        .pims-card-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            background: #f9f9f9;
        }

        .pims-card-footer-item {
            flex: 1;
            padding: 1rem;
            text-align: center;
            color: var(--pims-accent);
            transition: var(--pims-transition);
            font-weight: 500;
            text-decoration: none;
        }

        .pims-card-footer-item:hover {
            background-color: rgba(41, 128, 185, 0.1);
            color: var(--pims-primary);
        }

        /* Status Tags */
        .pims-status-tag {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.9rem;
            border-radius: 50px;
            display: inline-block;
            margin-left: 0.75rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Content Styling */
        .content p {
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }

        .content strong {
            color: var(--pims-primary);
            font-weight: 600;
        }

        .has-text-grey {
            color: #777;
            font-size: 0.85rem;
        }

        /* Grid Layout */
        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.75rem;
            margin-bottom: 2rem;
        }

        /* Pagination */
        .pims-pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.75rem;
            align-items: center;
        }

        .pims-page-btn {
            padding: 0.75rem 1.25rem;
            border-radius: var(--pims-border-radius);
            background-color: white;
            border: 1px solid #e0e0e0;
            color: var(--pims-text-dark);
            transition: var(--pims-transition);
            cursor: pointer;
            font-weight: 500;
            min-width: 100px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .pims-page-btn:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .pims-page-btn.active {
            background: linear-gradient(135deg, var(--pims-accent), var(--pims-primary));
            color: white;
            border-color: transparent;
        }

        .pims-page-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        /* Search and Filter */
        .pims-filter-controls {
            margin-bottom: 2.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
        }

        .pims-search-input input {
            border: 1px solid #e0e0e0;
            transition: var(--pims-transition);
        }

        .pims-search-input input:focus {
            border-color: var(--pims-accent);
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.2);
        }

        /* Button Styles */
        .pims-button {
            padding: 0.75rem 1.5rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--pims-transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .pims-button-success {
            background: #d35400;
            color: white;
        }

        .pims-button-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(46, 204, 113, 0.3);
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .pims-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            #pims-page-content {
                padding: 1.5rem;
            }
            
            .pims-grid {
                grid-template-columns: 1fr;
            }
            
            .pims-card-footer {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- START NAV -->
    @include('includes.nav')
    <!-- END NAV -->

    <div class="columns" id="pims-app-content">
        @include('medical_officer.menu')

        <div class="column is-10" id="pims-page-content">
            <section class="section">
                <div class="container">
                    <div class="pims-card">
                        <header class="pims-card-header">
                            <p class="pims-card-header-title">
                                <span class="pims-icon mr-2"><i class="fas fa-notes-medical"></i></span>
                                Appointment Records
                            </p>
                        </header>

                        <div class="pims-card-content">
                            <!-- Filter/Search Controls -->
                            <div class="pims-filter-controls">
                                <div class="columns is-variable is-1">
                                    <div class="column is-9-tablet is-10-desktop">
                                        <div class="pims-search-input field">
                                            <div class="control has-icons-left">
                                                <input class="input" id="pims-appointment-search" type="text" placeholder="Search by prisoner name, record ID or created by...">
                                                <span class="pims-icon is-left">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-3-tablet is-2-desktop has-text-right">
                                        <div class="buttons is-right">
                                            <a href="{{ route('medical.createAppointment') }}" class="pims-button pims-button-success">
                                                <span class="pims-icon is-small"><i class="fa fa-plus"></i></span>
                                                <span>Schedule Appointment</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointments Card Grid -->
                            <div id="pims-appointments-container">
                                <!-- Pages will be generated by JavaScript -->
                            </div>

                            <!-- Pagination Controls -->
                            <div class="pims-pagination">
                                <button class="pims-page-btn" id="pims-prev-btn" disabled>Previous</button>
                                <div id="pims-page-numbers"></div>
                                <button class="pims-page-btn" id="pims-next-btn">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample data - replace with your actual appointment data
            const appointments = [
                @foreach($appointments as $appointment)
                {
                    id: "{{ $appointment->id }}",
                    prisoner: "{{ $appointment->prisoner ? $appointment->prisoner->first_name . ' ' . $appointment->prisoner->last_name : '' }}",
                    prisonerLower: "{{ $appointment->prisoner ? strtolower($appointment->prisoner->first_name . ' ' . $appointment->prisoner->last_name) : '' }}",
                    doctor: "{{ $appointment->doctor ? $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name : 'N/A' }}",
                    date: "{{ $appointment->appointment_date }}",
                    diagnosis: "{{ $appointment->diagnosis }}",
                    treatment: "{{ $appointment->treatment }}",
                    createdBy: "{{ $appointment->createdBy ? $appointment->createdBy->first_name . ' ' . $appointment->createdBy->last_name : '' }}",
                    createdByLower: "{{ $appointment->createdBy ? strtolower($appointment->createdBy->first_name . ' ' . $appointment->createdBy->last_name) : '' }}",
                    status: "{{ $appointment->status }}",
                    createdAt: "{{ $appointment->created_at }}",
                    updatedAt: "{{ $appointment->updated_at }}"
                },
                @endforeach
            ];

            // Configuration
            const cardsPerPage = 12; // 4 columns x 3 rows
            let currentPage = 1;
            let filteredAppointments = [...appointments];

            // DOM Elements
            const container = document.getElementById('pims-appointments-container');
            const prevBtn = document.getElementById('pims-prev-btn');
            const nextBtn = document.getElementById('pims-next-btn');
            const pageNumbers = document.getElementById('pims-page-numbers');
            const searchInput = document.getElementById('pims-appointment-search');

            // Initialize the view
            function initPagination() {
                renderAppointments();
                renderPageNumbers();
                updatePaginationButtons();
            }

            // Render appointment cards
            function renderAppointments() {
                container.innerHTML = '';
                
                // Calculate total pages
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);
                
                if (filteredAppointments.length === 0) {
                    container.innerHTML = `
                        <div class="notification is-warning is-light has-text-centered" style="grid-column: 1/-1;">
                            No appointments found matching your search criteria.
                        </div>
                    `;
                    return;
                }
                
                // Create pages
                for (let i = 1; i <= totalPages; i++) {
                    const pageDiv = document.createElement('div');
                    pageDiv.className = `pims-page ${i === 1 ? 'active' : ''}`;
                    pageDiv.id = `pims-page-${i}`;
                    pageDiv.style.display = i === 1 ? 'grid' : 'none';
                    pageDiv.style.gridTemplateColumns = 'repeat(auto-fill, minmax(300px, 1fr))';
                    pageDiv.style.gap = '1.75rem';
                    
                    // Get appointments for this page
                    const startIndex = (i - 1) * cardsPerPage;
                    const endIndex = Math.min(startIndex + cardsPerPage, filteredAppointments.length);
                    const pageAppointments = filteredAppointments.slice(startIndex, endIndex);
                    
                    // Create cards for this page
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
                                    <span class="pims-icon mr-2"><i class="fas fa-calendar-check"></i></span>
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
                                <a href="#" class="pims-card-footer-item has-text-warning">
                                    <span class="pims-icon"><i class="fas fa-edit"></i></span>
                                    <span>Edit</span>
                                </a>
                            </footer>
                        `;
                        
                        pageDiv.appendChild(card);
                    });
                    
                    container.appendChild(pageDiv);
                }
            }

            // Render page numbers
            function renderPageNumbers() {
                pageNumbers.innerHTML = '';
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);
                
                // Show up to 5 page numbers around current page
                const startPage = Math.max(1, currentPage - 2);
                const endPage = Math.min(totalPages, currentPage + 2);
                
                if (startPage > 1) {
                    const firstBtn = document.createElement('button');
                    firstBtn.className = 'pims-page-btn';
                    firstBtn.textContent = '1';
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
                    lastBtn.addEventListener('click', () => goToPage(totalPages));
                    pageNumbers.appendChild(lastBtn);
                }
            }

            // Update pagination buttons
            function updatePaginationButtons() {
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);
                
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages || totalPages === 0;
                
                // Re-render page numbers to update active state
                renderPageNumbers();
            }

            // Go to specific page
            function goToPage(page) {
                // Hide current page
                const currentPageDiv = document.querySelector(`#pims-page-${currentPage}`);
                if (currentPageDiv) {
                    currentPageDiv.style.display = 'none';
                    currentPageDiv.classList.remove('active');
                }
                
                // Show new page
                currentPage = page;
                const newPageDiv = document.querySelector(`#pims-page-${currentPage}`);
                if (newPageDiv) {
                    newPageDiv.style.display = 'grid';
                    newPageDiv.classList.add('active');
                }
                
                updatePaginationButtons();
                
                // Smooth scroll to top of container
                container.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            // Previous page
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    goToPage(currentPage - 1);
                }
            });

            // Next page
            nextBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(filteredAppointments.length / cardsPerPage);
                if (currentPage < totalPages) {
                    goToPage(currentPage + 1);
                }
            });

            // Search functionality
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

            // Initialize
            initPagination();
        });
    </script>
</body>
</html>