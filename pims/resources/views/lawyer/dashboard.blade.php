<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Dashboard</title>
    @include('includes.head')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }
        .dashboard-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            text-align: center;
        }
        .dashboard-card .icon {
            font-size: 32px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    @include('includes.nav')
    <div class="columns" id="app-content">
        @include('lawyer.menu')
        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <h1 class="title">Lawyer Dashboard Overview</h1>
                    <div class="columns is-multiline">
                        @php
                            $dashboardItems = [
                                ['icon' => 'fa-user-check', 'count' => $totalMyPrisoners ?? 0, 'label' => 'My Assigned Prisoners'],
                                ['icon' => 'fa-paper-plane', 'count' => $totalRequests ?? 0, 'label' => 'Total Requests'],
                                ['icon' => 'fa-clock', 'count' => $pendingRequests ?? 0, 'label' => 'Pending Requests'],
                            ];
                        @endphp
                        @foreach($dashboardItems as $item)
                            <div class="column is-4">
                                <div class="dashboard-card">
                                    <span class="icon">
                                        <i class="fa {{ $item['icon'] }} fa-2x"></i>
                                    </span>
                                    <h2 class="title">{{ $item['count'] }}</h2>
                                    <p class="subtitle">{{ $item['label'] }}</p>
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
