<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prison Information Management System</title>
    <!-- External CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <!-- Navigation -->
    @include('includes.nav')

    <main class="columns" id="app-content">
        <!-- Side Menu -->
        @include('includes.menu')

        <!-- Main Content -->
        <div class="column is-10" id="page-content">
            <!-- Header Section -->
            <header class="content-header">
                <h4 class="title is-4">Dashboard</h4>
                <!-- Breadcrumb Navigation -->
                <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">General</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Dashboard</a></li>
                    </ul>
                </nav>
            </header>

            <!-- Content Body -->
            <section class="content-body">
                <!-- Quick Stats Section -->
                <div class="columns is-multiline">
                    @foreach([['account.show_all', 'Central Administrators', 'user-cog', 'primary'],
                              ['prisoner.showAll', 'Inspectors', 'user-secret', 'danger'],
                              ['mylawyer.myprisoner', 'Lawyers', 'user-tie', 'info'],
                              ['medical.createAppointment', 'Medical Officers', 'user-md', 'warning'],
                              ['police.allocateRoom', 'Police Officers', 'user', 'link'],
                              ['security.registerVisitor', 'Security Officers', 'user-lock', 'grey-dark'],
                              ['saccount.show_all', 'System Admins', 'user-cog', 'dark'],
                              ['training.assignCertifications', 'Training Officers', 'user-graduate', 'info'],
                              ['visitor.createVisitingRequest', 'Visitors', 'user-friends', 'warning']] as $role)
                    <div class="column is-3">
                        <a href="{{ route($role[0]) }}" class="box quick-stats has-background-{{ $role[3] }} has-text-white" aria-label="{{ $role[1] }}">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-{{ $role[2] }}" aria-hidden="true"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">{{ $role[1] }}</h3>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Charts Section -->
                <div class="columns is-multiline">
                    @foreach([['Visitors', 'chart1', '#4bc0c0'], ['Prisoners', 'chart2', '#ff6384'],
                              ['Prisons', 'chart3', '#36a2eb'], ['Staffs', 'chart4', '#ff9f40']] as $chart)
                    <div class="column is-6">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">{{ $chart[0] }}</p>
                                <!-- Color Picker for Chart Customization -->
                                <label for="color-{{ $chart[1] }}" class="is-sr-only">Choose color for {{ $chart[0] }} chart</label>
                                <input type="color" id="color-{{ $chart[1] }}" value="{{ $chart[2] }}" class="mb-3" aria-label="Choose color for {{ $chart[0] }} chart" />
                                <!-- Chart Canvas -->
                                <canvas id="{{ $chart[1] }}" aria-label="{{ $chart[0] }} Chart" role="img"></canvas>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>

    <!-- External JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fetch Chart Data from Server
            fetch('/chart-data')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(chartData => {
                    const dates = chartData.map(item => item.date);
                    const categories = ['Visitors', 'Prisoners', 'Prisons', 'Staffs'];
                    const colors = ['#4bc0c0', '#ff6384', '#36a2eb', '#ff9f40'];

                    // Initialize Charts
                    categories.forEach((category, index) => {
                        const ctx = document.getElementById(`chart${index + 1}`).getContext('2d');
                        const chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: dates,
                                datasets: [{
                                    label: category,
                                    data: chartData.map(item => item[category.toLowerCase()]),
                                    borderColor: colors[index],
                                    tension: 0.1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                }
                            }
                        });

                        // Update Chart Color Dynamically
                        document.getElementById(`color-chart${index + 1}`).addEventListener('change', (e) => {
                            chart.data.datasets[0].borderColor = e.target.value;
                            chart.update();
                        });
                    });
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                    
                });
        });
    </script>
</body>

</html>