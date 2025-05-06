<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Police Commissioner Dashboard</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Application CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --pims-primary: #007bff;
            --pims-secondary: #6c757d;
            --pims-success: #28a745;
            --pims-text-light: #f8f9fa;
            --pims-accent: #17a2b8;
            --pims-bg: #f4f6f9;
            --pims-card-bg: #ffffff;
            --pims-border: #dee2e6;
            --pims-transition: all 0.3s ease;
        }

        body {
            background: var(--pims-bg);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .pims-app-container {
            margin-left: var(--pims-sidebar-width);
            padding: 20px;
            transition: var(--pims-transition);
        }

        .pims-app-container.collapsed {
            margin-left: var(--pims-sidebar-collapsed-width);
        }

        .pims-main-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .pims-page-header {
            margin-bottom: 20px;
        }

        .pims-page-title {
            font-size: 1.8rem;
            color: var(--pims-secondary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pims-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .pims-stat-card {
            background: var(--pims-card-bg);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .pims-stat-card i {
            font-size: 2rem;
            color: var(--pims-primary);
            margin-bottom: 10px;
        }

        .pims-stat-card h6 {
            font-size: 1rem;
            color: var(--pims-secondary);
            margin: 0 0 10px;
        }

        .pims-stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--pims-primary);
        }

        .pims-card {
            background: var(--pims-card-bg);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .pims-card-header {
            padding: 15px 20px;
            border-bottom: 1px solid var(--pims-border);
        }

        .pims-card-header h5 {
            margin: 0;
            font-size: 1.2rem;
            color: var(--pims-secondary);
        }

        .pims-card-body {
            padding: 20px;
        }

        .pims-table-container {
            overflow-x: auto;
        }

        .pims-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pims-table th, .pims-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--pims-border);
        }

        .pims-table th {
            background: var(--pims-bg);
            color: var(--pims-secondary);
            font-weight: 600;
        }

        .pims-table td {
            color: var(--pims-secondary);
        }

        .pims-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--pims-transition);
        }

        .pims-btn-primary {
            background: var(--pims-primary);
            color: var(--pims-text-light);
            border: none;
        }

        .pims-btn-primary:hover {
            background: #0056b3;
        }

        .pims-btn i {
            margin-right: 8px;
        }

        .pims-quick-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .pims-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--pims-primary);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 1024px) {
            .pims-app-container {
                margin-left: 0;
            }
            .pims-app-container.collapsed {
                margin-left: 0;
            }
            .pims-main-content {
                padding: 10px;
            }
        }

        @media (max-width: 768px) {
            .pims-stats-grid {
                grid-template-columns: 1fr;
            }
            .pims-quick-links {
                flex-direction: column;
            }
            .pims-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    @include('includes.nav')
    @include('components.preloader')

    <div class="pims-app-container" id="pimsAppContainer">
        @include('police_commisioner.menu')

        <main class="pims-main-content" id="pimsMainContent" role="main">
            <div class="pims-page-header">
                <h2 class="pims-page-title">
                    <i class="fas fa-home" aria-hidden="true"></i> Dashboard
                </h2>
            </div>

            <div class="pims-stats-grid" role="region" aria-label="Dashboard Statistics">
                <div class="pims-stat-card" aria-labelledby="totalPrisonersLabel">
                    <i class="fas fa-users" aria-hidden="true"></i>
                    <h6 id="totalPrisonersLabel">Total Prisoners</h6>
                    <div class="pims-stat-value" id="totalPrisoners">{{ $totalPrisoners }}</div>
                </div>

                <div class="pims-stat-card" aria-labelledby="releasedThisMonthLabel">
                    <i class="fas fa-user-check" aria-hidden="true"></i>
                    <h6 id="releasedThisMonthLabel">Released This Month</h6>
                    <div class="pims-stat-value" id="releasedThisMonth">{{ $releasedThisMonth }}</div>
                </div>

                <div class="pims-stat-card" aria-labelledby="pendingRequestsLabel">
                    <i class="fas fa-paper-plane" aria-hidden="true"></i>
                    <h6 id="pendingRequestsLabel">Pending Requests</h6>
                    <div class="pims-stat-value" id="pendingRequests">{{ $pendingRequests }}</div>
                </div>
            </div>

            <div class="pims-card">
                <div class="pims-card-header">
                    <h5>Recent Activities</h5>
                </div>

                <div class="pims-card-body">
                    <div class="pims-table-container">
                        <table class="pims-table" role="grid">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Activity</th>
                                    <th>Prisoner</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="recentActivities">
                                <tr>
                                    <td colspan="4">
                                        <div class="pims-spinner"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pims-quick-links">
                        
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('pimsSidebar2');
            const appContainer = document.getElementById('pimsAppContainer');

            const updateContentMargin = () => {
                if (sidebar && sidebar.classList.contains('pims-collapsed')) {
                    appContainer.classList.add('collapsed');
                } else {
                    appContainer.classList.remove('collapsed');
                }
            };

            if (sidebar) {
                sidebar.addEventListener('transitionend', updateContentMargin);
                updateContentMargin();
            }

          
            const fetchActivities = async () => {
                const tbody = document.getElementById('recentActivities');
                try {
                    const response = await fetch('/api/recent-activities?limit=5', {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    if (!response.ok) throw new Error(`HTTP error: ${response.status}`);
                    const activities = await response.json();
                    tbody.innerHTML = activities.length
                        ? activities.map(activity => `
                            <tr>
                                <td>${new Date(activity.date).toLocaleDateString()}</td>
                                <td>${activity.description}</td>
                                <td>${activity.prisonerName}</td>
                                <td>
                                    <a href="/activity/${activity.id}" class="pims-btn pims-btn-primary pims-btn-sm">
                                        <i class="fas fa-eye" aria-hidden="true"></i> View
                                    </a>
                                </td>
                            </tr>`).join('')
                        : `<tr><td colspan="4">No recent activities found.</td></tr>`;
                } catch (error) {
                    console.error('Error fetching activities:', error);
                    tbody.innerHTML = `<tr><td colspan="4">Error loading activities.</td></tr>`;
                }
            };

            // Preloader on navigation
            document.querySelectorAll('.pims-btn-primary').forEach(link => {
                link.addEventListener('click', (e) => {
                    if (link.getAttribute('href')) {
                        e.preventDefault();
                        PimsPreloader.show();
                        setTimeout(() => {
                            window.location.href = link.getAttribute('href');
                        }, 50);
                    }
                });
            });

            fetchStats();
            fetchActivities();
        });
    </script>
</body>

</html>