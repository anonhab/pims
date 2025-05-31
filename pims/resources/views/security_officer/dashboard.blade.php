<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PIMS - Security Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --pims-primary: #0a192f;
            --pims-secondary: #172a45;
            --pims-accent: #64ffda;
            --pims-danger: #ff5555;
            --pims-success: #50fa7b;
            --pims-warning: #ffb86c;
            --pims-text-light: #f8f8f2;
            --pims-text-dark: #282a36;
            --pims-card-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --pims-border-radius: 8px;
            --pims-nav-height: 70px;
            --pims-sidebar-width: 280px;
            --pims-transition: all 0.4s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: var(--pims-text-dark);
            line-height: 1.6;
        }

        .pims-app-container {
            display: flex;
            min-height: 100vh;
        }

        #pims-panel-container {
            margin-left: var(--pims-sidebar-width);
            padding: 1.5rem;
            transition: var(--pims-transition);
            background-color: #f5f7fa;
            width: 100%;
        }

        .pims-card {
            background: white;
            border-radius: var(--pims-border-radius);
            box-shadow: var(--pims-card-shadow);
            padding: 1.5rem;
            border-left: 4px solid var(--pims-accent);
            margin-bottom: 1.5rem;
        }

        .pims-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .pims-card-icon {
            font-size: 2rem;
            color: var(--pims-accent);
            background: rgba(100, 255, 218, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pims-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--pims-primary);
        }

        .pims-card p {
            font-size: 2rem;
            font-weight: 700;
            color: var(--pims-secondary);
        }

        .pims-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .pims-stats-box {
            background: white;
            border-radius: var(--pims-border-radius);
            padding: 2rem;
            box-shadow: var(--pims-card-shadow);
            margin-top: 2rem;
        }

        .pims-stats-box h2 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--pims-primary);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .pims-stats-box ul {
            list-style: none;
            padding: 0;
        }

        .pims-stats-box li {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .pims-status-tag {
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .pims-status-tag.approved { background-color: rgba(80, 250, 123, 0.1); color: var(--pims-success); }
        .pims-status-tag.pending { background-color: rgba(255, 184, 108, 0.1); color: var(--pims-warning); }
        .pims-status-tag.rejected { background-color: rgba(255, 85, 85, 0.1); color: var(--pims-danger); }

        .pims-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--pims-border-radius);
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: var(--pims-transition);
        }

        .pims-btn-primary {
            background-color: var(--pims-accent);
            color: var(--pims-primary);
        }

        .pims-btn-primary:hover {
            background-color: #52e8ca;
            transform: translateY(-2px);
        }

        .pims-search-box {
            position: relative;
        }

        .pims-search-box input {
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--pims-border-radius);
            width: 100%;
        }

        .pims-search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--pims-accent);
        }

        .pims-modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            transition: opacity 0.3s ease;
        }

        .pims-modal.is-active {
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }

        .pims-modal-card {
            background: white;
            border-radius: var(--pims-border-radius);
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .pims-modal-card-head {
            padding: 1.5rem;
            background: rgba(100, 255, 218, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pims-modal-close {
            background: none;
            border: none;
            color: var(--pims-primary);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .pims-modal-card-body {
            padding: 2rem;
        }

        .pims-modal-card-foot {
            padding: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
        }

        .pims-form-group {
            margin-bottom: 1rem;
        }

        .pims-form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .pims-form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--pims-border-radius);
        }

        .pims-notification {
            padding: 1rem;
            border-radius: var(--pims-border-radius);
            margin-bottom: 1rem;
        }

        .pims-notification-success { background: rgba(80, 250, 123, 0.1); border-left: 4px solid var(--pims-success); }
        .pims-notification-error { background: rgba(255, 85, 85, 0.1); border-left: 4px solid var(--pims-danger); }

        @media (max-width: 768px) {
            #pims-panel-container {
                margin-left: 0;
                padding: 1rem;
            }
            .pims-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="pims-app-container">
        @include('security_officer.menu')

        <div id="pims-panel-container">
            <h1 class="pims-section-title"><i class="fas fa-shield-alt"></i> Security Dashboard</h1>

            <!-- Notifications -->
            @if(session('success'))
            <div class="pims-notification pims-notification-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif
            @if($errors->any())
            <div class="pims-notification pims-notification-error">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
            @endif

            <!-- Dashboard Cards -->
            <div class="pims-grid">
                <div class="pims-card">
                    <div class="pims-card-icon"><i class="fas fa-users"></i></div>
                    <h3>Visitors Today</h3>
                    <p>{{ $visitorsToday ?? 0 }}</p>
                    <div class="pims-card-footer"><i class="fas fa-user-plus"></i> Currently in facility</div>
                </div>
                <div class="pims-card">
                    <div class="pims-card-icon"><i class="fas fa-clock"></i></div>
                    <h3>Pending Approvals</h3>
                    <p>{{ $pendingApprovals ?? 0 }}</p>
                    <div class="pims-card-footer"><i class="fas fa-exclamation-circle"></i> Require review</div>
                </div>
               
                <div class="pims-card">
                    <div class="pims-card-icon"><i class="fas fa-user-md"></i></div>
                    <h3>Pending Medical Appointments</h3>
                    <p>{{ $pendingMedicalAppointments ?? 0 }}</p>
                    <div class="pims-card-footer"><i class="fas fa-stethoscope"></i> Awaiting approval</div>
                </div>
                <div class="pims-card">
                    <div class="pims-card-icon"><i class="fas fa-briefcase"></i></div>
                    <h3>Pending Lawyer Appointments</h3>
                    <p>{{ $pendingLawyerAppointments ?? 0 }}</p>
                    <div class="pims-card-footer"><i class="fas fa-gavel"></i> Awaiting approval</div>
                </div>
                <div class="pims-card">
                    <div class="pims-card-icon"><i class="fas fa-user-friends"></i></div>
                    <h3>Pending Visitor Appointments</h3>
                    <p>{{ $pendingVisitorAppointments ?? 0 }}</p>
                    <div class="pims-card-footer"><i class="fas fa-user-check"></i> Awaiting approval</div>
                </div>
                <div class="pims-card">
                    <div class="pims-card-icon"><i class="fas fa-user"></i></div>
                    <h3>Total Visitors</h3>
                    <p>{{ $totalVisitors ?? 0 }}</p>
                    <div class="pims-card-footer"><i class="fas fa-users"></i> Registered visitors</div>
                </div>
            </div>

            <!-- Recent Visitors -->
            <div class="pims-stats-box">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2><i class="fas fa-history"></i> Recent Visitors</h2>
                    <div style="display: flex; gap: 1rem;">
                        <div class="pims-search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="pims-table-search" placeholder="Search visitors...">
                        </div>
                        <button class="pims-btn pims-btn-primary" id="pims-table-reload"><i class="fas fa-sync-alt"></i> Reload</button>
                        <button   id="pims-verify-prisoner"></button>
                    </div>
                </div>
                <ul>
                @forelse($visitors as $visitor)
    <li>
        <i class="fas fa-user" style="color: var(--pims-accent);"></i>
        <div style="flex-grow: 1;">
            @php
                $visit = $visitor->visits->first();
            @endphp

            <span>
                <strong>{{ $visitor->first_name }} {{ $visitor->last_name }}</strong> - Visiting Prisoner:
                {{ $visit->prisoner_firstname }} {{ $visit->prisoner_middlename ?? '' }} {{ $visit->prisoner_lastname }}
            </span>

            <span class="pims-status-tag {{ strtolower($visit->status ?? 'pending') }}">
                {{ $visit->status ?? 'Pending' }}
            </span>
        </div>
        <span class="pims-activity-time">{{ $visit->visit_time ?? now()->format('Y-m-d H:i') }}</span>
        <button class="pims-btn pims-btn-primary pims-view-visitor" data-id="{{ $visitor->id }}"><i class="fas fa-eye"></i> View</button>
    </li>
@empty
    <li>No recent visitors found.</li>
@endforelse

                </ul>
                <canvas id="visitorTrendsChart" style="margin-top: 2rem; max-height: 400px;"></canvas>
            </div>
        </div>

        <!-- Visitor Details Modal -->
        <div class="pims-modal" id="pims-view-visitor-modal">
            <div class="pims-modal-card">
                <header class="pims-modal-card-head">
                    <h2 class="pims-modal-card-title"><i class="fas fa-user"></i> Visitor Details</h2>
                    <button class="pims-modal-close" data-modal="pims-view-visitor-modal"><i class="fas fa-times"></i></button>
                </header>
                <section class="pims-modal-card-body">
                    <div class="pims-card">
                        <div class="pims-card-body">
                            <p><strong>Name:</strong> <span id="pims-view-visitor-name">N/A</span></p>
                            <p><strong>Status:</strong> <span id="pims-view-status">N/A</span></p>
                            <p><strong>Phone Number:</strong> <span id="pims-view-phone-number">N/A</span></p>
                            <p><strong>Relationship:</strong> <span id="pims-view-relationship">N/A</span></p>
                            <p><strong>Address:</strong> <span id="pims-view-address">N/A</span></p>
                            <p><strong>ID Number:</strong> <span id="pims-view-id-number">N/A</span></p>
                        </div>
                    </div>
                </section>
                <footer class="pims-modal-card-foot">
                    <button class="pims-btn pims-btn-primary" data-modal="pims-view-visitor-modal">Close</button>
                </footer>
            </div>
        </div>

        <!-- Prisoner Verification Modal -->
        <div class="pims-modal" id="pims-verify-prisoner-modal">
            <div class="pims-modal-card">
                <header class="pims-modal-card-head">
                    <h2 class="pims-modal-card-title"><i class="fas fa-user-check"></i> Verify Prisoner</h2>
                    <button class="pims-modal-close" data-modal="pims-verify-prisoner-modal"><i class="fas fa-times"></i></button>
                </header>
                <section class="pims-modal-card-body">
                    <form id="pims-verify-prisoner-form">
                        <div class="pims-form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" required>
                        </div>
                        <div class="pims-form-group">
                            <label for="middle_name">Middle Name (Optional)</label>
                            <input type="text" id="middle_name" name="middle_name">
                        </div>
                        <div class="pims-form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required>
                        </div>
                        <div id="pims-verify-message" class="pims-notification" style="display: none;"></div>
                        <button type="submit" class="pims-btn pims-btn-primary">Verify</button>
                    </form>
                </section>
                <footer class="pims-modal-card-foot">
                    <button class="pims-btn pims-btn-primary" data-modal="pims-verify-prisoner-modal">Close</button>
                </footer>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Functions
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'flex';
                    modal.classList.add('is-active');
                    console.log(`Opened modal: ${modalId}`);
                } else {
                    console.error(`Modal ${modalId} not found`);
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('is-active');
                    modal.style.display = 'none';
                    console.log(`Closed modal: ${modalId}`);
                } else {
                    console.error(`Modal ${modalId} not found`);
                }
            }

            // Modal Close Buttons
            document.querySelectorAll('.pims-modal-close, .pims-btn[data-modal]').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    closeModal(this.getAttribute('data-modal'));
                });
            });

            // Close Modal on Outside Click
            document.querySelectorAll('.pims-modal').forEach(modal => {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeModal(modal.id);
                    }
                });
            });

            // View Visitor Details
            document.querySelectorAll('.pims-view-visitor').forEach(button => {
                button.addEventListener('click', function() {
                    const visitorId = this.getAttribute('data-id');
                    fetch(`/security/visitors/${visitorId}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Failed to fetch visitor');
                            return response.json();
                        })
                        .then(data => {
                            document.getElementById('pims-view-visitor-name').textContent = `${data.first_name} ${data.last_name}` || 'N/A';
                            document.getElementById('pims-view-status').textContent = data.visits?.[0]?.status || 'N/A';
                            document.getElementById('pims-view-phone-number').textContent = data.phone_number || 'N/A';
                            document.getElementById('pims-view-relationship').textContent = data.relationship || 'N/A';
                            document.getElementById('pims-view-address').textContent = data.address || 'N/A';
                            document.getElementById('pims-view-id-number').textContent = data.identification_number || 'N/A';
                            openModal('pims-view-visitor-modal');
                        })
                        .catch(error => {
                            console.error('Error fetching visitor data:', error);
                            alert('Failed to load visitor details.');
                        });
                });
            });

            // Prisoner Verification
            document.getElementById('pims-verify-prisoner').addEventListener('click', () => {
                openModal('pims-verify-prisoner-modal');
            });

            document.getElementById('pims-verify-prisoner-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('/security/verify', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Verification failed');
                        return response.json();
                    })
                    .then(data => {
                        const messageDiv = document.getElementById('pims-verify-message');
                        messageDiv.style.display = 'block';
                        messageDiv.className = `pims-notification pims-notification-${data.success ? 'success' : 'error'}`;
                        messageDiv.textContent = data.message;
                        if (data.success) {
                            console.log(`Prisoner verified: ${data.prisoner.full_name}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error verifying prisoner:', error);
                        const messageDiv = document.getElementById('pims-verify-message');
                        messageDiv.style.display = 'block';
                        messageDiv.className = 'pims-notification pims-notification-error';
                        messageDiv.textContent = 'Failed to verify prisoner';
                    });
            });

            // Search Visitors
            document.getElementById('pims-table-search')?.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                document.querySelectorAll('.pims-stats-box ul li').forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(filter) ? '' : 'none';
                });
            });

            // Reload Button
            document.getElementById('pims-table-reload')?.addEventListener('click', () => {
                window.location.reload();
            });

            // Chart.js for Visitor Trends
            const ctx = document.getElementById('visitorTrendsChart')?.getContext('2d');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [{
                            label: 'Visitors This Week',
                            data: [
                                {{ $monData ?? 0 }},
                                {{ $tueData ?? 0 }},
                                {{ $wedData ?? 0 }},
                                {{ $thuData ?? 0 }},
                                {{ $friData ?? 0 }},
                                {{ $satData ?? 0 }},
                                {{ $sunData ?? 0 }}
                            ],
                            backgroundColor: 'rgba(100, 255, 218, 0.2)',
                            borderColor: 'rgba(100, 255, 218, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'top' },
                            title: { display: true, text: 'Visitor Trends (Weekly)' }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: { display: true, text: 'Number of Visitors' }
                            },
                            x: {
                                title: { display: true, text: 'Day' }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>