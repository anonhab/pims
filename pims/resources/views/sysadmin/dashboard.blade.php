<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    @include('includes.head')

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

        .dashboard-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <!-- NAV -->
    @include('includes.nav')

    <div class="columns" id="app-content">
        <!-- Sidebar Menu -->
        @include('sysadmin.menu')

        <!-- Main Content -->
        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <h1 class="title">Dashboard Overview</h1>

                    <!-- Stats Cards -->
                    <div class="columns is-multiline">
                        @php
                            $dashboardItems = [
                                ['icon' => 'fa-user-injured', 'count' => $totalPrisoners ?? 0, 'label' => 'Total Prisoners'],
                                ['icon' => 'fa-user-tie', 'count' => $totalLawyers ?? 0, 'label' => 'Total Lawyers'],
                                
                                ['icon' => 'fa-user-tie', 'count' => $totalJobs ??
                                0, 'label' => 'Total Jobs'],
                                
                                ['icon' => 'fa-user-tie', 'count' => $totalPrisoners
                                ?? 0, 'label' => 'Total Prison'],
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
                                    <th>Prisoner ID</th>
                                    <th>Prisoner name</th>
                                    <th>Lawyer</th>
                                    <th>Assigned By</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAssignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->assignment_id }}</td>
                                        <td>{{ optional($assignment->prisoner)->id ?? 'N/A' }}</td>
                                        <td>{{ optional($assignment->prisoner)->first_name ?? 'N/A' }}</td>
                                        <td>{{ optional($assignment->lawyer)->first_name ?? 'N/A' }}</td>
                                        <td>Inspector {{ optional($assignment->assignedBy)->user_id ?? 'N/A' }} {{ optional($assignment->assignedBy)->first_name ?? 'N/A' }}</td>
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

    @include('includes.footer_js')
</body>
</html>
