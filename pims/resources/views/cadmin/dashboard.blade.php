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
    <!-- Navigation -->
    @include('includes.nav')

    <div class="columns" id="app-content">
        <!-- Sidebar Menu -->
        @include('cadmin.menu')

        <!-- Main Content -->
        <div class="column is-10" id="page-content">
            <section class="section">
                <div class="container">
                    <h1 class="title">Dashboard Overview</h1>

                    <div class="columns is-multiline">
                        <!-- Account Management -->
                        <div class="column is-4">
                            <div class="dashboard-card">
                                <div class="icon">👤</div>
                                <h3>Total Accounts</h3>
                                <p>50</p>
                            </div>
                        </div>

                        <!-- Prisoner Management -->
                        <div class="column is-4">
                            <div class="dashboard-card">
                                <div class="icon">🚔</div>
                                <h3>Total Prisoners</h3>
                                <p>125</p>
                            </div>
                        </div>

                        <!-- Report Generation -->
                        <div class="column is-4">
                            <div class="dashboard-card">
                                <div class="icon">📄</div>
                                <h3>Reports Generated</h3>
                                <p>32</p>
                            </div>
                        </div>

                        <!-- Backup & Recovery -->
                        <div class="column is-4">
                            <div class="dashboard-card">
                                <div class="icon">💾</div>
                                <h3>Backups Available</h3>
                                <p>5</p>
                            </div>
                        </div>

                        <!-- Prison Management -->
                        <div class="column is-4">
                            <div class="dashboard-card">
                                <div class="icon">🏢</div>
                                <h3>Total Prisons</h3>
                                <p>10</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Visualization -->
                    <div class="box">
                        <h2 class="title is-4">Statistics Overview</h2>
                        <canvas id="statsChart"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>
