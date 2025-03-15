<!DOCTYPE html>
<html lang="en">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* Dashboard Overview Cards */
        .dashboard-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .dashboard-card .card-header {
            background-color: #4e73df;
            color: #fff;
            font-size: 18px;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .dashboard-card .card-body {
            padding: 20px;
            font-size: 32px;
            text-align: center;
            font-weight: bold;
        }

        .card-body .is-size-3 {
            font-size: 2rem;
        }

        .dashboard-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* Recent Activity Section */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f0f0f0;
            padding: 15px;
            font-size: 18px;
            color: #333;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 20px;
        }

        .card-body ul {
            list-style: none;
            padding-left: 0;
        }

        .card-body ul li {
            padding: 8px 0;
            font-size: 16px;
        }

        .card-body ul li strong {
            font-weight: bold;
        }

        .card-body ul li a {
            color: #4e73df;
            transition: color 0.3s ease;
        }

        .card-body ul li a:hover {
            color: #1e3c72;
        }

        /* Quick Actions Section */
        .card ul {
            list-style: none;
            padding-left: 0;
        }

        .card ul li {
            padding: 10px 0;
        }

        .card ul li a {
            display: inline-block;
            color: #4e73df;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .card ul li a:hover {
            color: #1e3c72;
        }

        /* Scrollable Recent Activity */
        .card-body {
            padding: 20px;
        }

        .scrollable {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            #app-content {
                flex-direction: column;
            }

            #sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 10px;
            }

            #page-content {
                margin-left: 0;
            }

            .dashboard-card, .card {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .menu-list > li > a {
                font-size: 14px;
            }

            .submenu li a {
                font-size: 12px;
            }

            .dashboard-card, .card {
                margin-bottom: 10px;
            }

            .card-header {
                font-size: 16px;
            }

            .card-body {
                font-size: 18px;
            }
        }
    </style>
    @include('includes.head')

    <body>
        <!-- NAV -->
        @include('includes.nav')

        <div class="columns" id="app-content">
            <!-- Sidebar Menu -->
            @include('inspector.menu')

            <!-- Main Content -->
            <div class="column is-10" id="page-content">
                <!-- Dashboard Overview Section -->
                <section class="section">
                <div class="column is-10">
            <section class="section">
                <div class="container">
                    <h1 class="title">Dashboard Overview</h1>
                    
                    <!-- Stats Cards -->
                    <div class="columns is-multiline">
                        @php
                            $dashboardItems = [
                                ['icon' => 'fa-user-injured', 'count' => $totalPrisoners ?? 0, 'label' => 'Total Prisoners'],
                                ['icon' => 'fa-user-tie', 'count' => $totalLawyers ?? 0, 'label' => 'Total Lawyers'],
                                ['icon' => 'fa-briefcase', 'count' => $totalAssignments ?? 0, 'label' => 'Total Assignments'],
                                ['icon' => 'fa-balance-scale', 'count' => $activeCases ?? 0, 'label' => 'Active Cases'],
                                ['icon' => 'fa-calendar-check', 'count' => $visitingRequests ?? 0, 'label' => 'Pending Visiting Requests'],
                                ['icon' => 'fa-file-alt', 'count' => $totalReports ?? 0, 'label' => 'Generated Reports'],
                            ];
                        @endphp

                        @foreach($dashboardItems as $item)
                            <div class="column is-4">
                                <div class="card">
                                    <div class="card-content has-text-centered">
                                        <span class="icon is-large">
                                            <i class="fa {{ $item['icon'] }} fa-2x"></i>
                                        </span>
                                        <h2 class="title">{{ $item['count'] }}</h2>
                                        <p class="subtitle">{{ $item['label'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Data Visualization -->
                    <div class="box">
                        <h2 class="title is-4">Statistics Overview</h2>
                        <canvas id="statsChart"></canvas>
                    </div>

                    <!-- Recent Assignments Table -->
                    <div class="box">
                        <h2 class="title is-4">Recent Assignments</h2>
                        <table class="table is-fullwidth is-striped is-hoverable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Prisoner</th>
                                    <th>Lawyer</th>
                                    <th>Assigned By</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAssignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->assignment_id }}</td>
                                        <td>{{ optional($assignment->prisoner)->pid ?? 'N/A' }}</td>
                                        <td>{{ optional($assignment->lawyer)->first_name ?? 'N/A' }}</td>
                                        <td>{{ optional($assignment->assignedBy)->first_name ?? 'N/A' }}</td>
                                        <td>{{ $assignment->assignment_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
                </section>
            </div>
        </div>

        @include('includes.footer_js')
    </body>
</html>
