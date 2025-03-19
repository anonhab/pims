<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    @include('includes.head')

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

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
    @include('includes.nav')

    <div class="columns" id="app-content">
        @include('sysadmin.menu')

        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <h1 class="title">Dashboard Overview</h1>

                    <div class="columns is-multiline">
                        @php
                            $dashboardItems = [
                                ['icon' => 'fa-user', 'count' => $totalAccounts ?? 0, 'label' => 'Total Accounts'],
                                ['icon' => 'fa-chart-line', 'count' => $totalReports ?? 0, 'label' => 'Generated Reports'],
                                ['icon' => 'fa-database', 'count' => $totalBackups ?? 0, 'label' => 'Backup Logs'],
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
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>
