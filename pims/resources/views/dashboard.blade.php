<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pims</title>
    <title>pims</title>
    <title>pims</title>
    <meta name="description" content="Free Admin Dashboard Template Build with Bulma.io By nafplann">
    <meta name="keywords" content="Bulma,CSS,Admin,Template,Free,Download">
    <meta name="language" content="en-EN">
    <meta name="author" content="Abdul Manaf">
    <meta name="google-adsense-account" content="ca-pub-7864475889913507">

    <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css"
        integrity="sha512-dC0G5HMA6hLr/E1TM623RN6qK+sL8sz5vB+Uc68J7cBon68bMfKcvbkg6OqlfGHo1nMmcCxO5AinnRTDhWbWsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css"
        integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    @include('includes.nav')

    <main class="columns" id="app-content">
        @include('includes.menu')

        <div class="column is-10" id="page-content">
            <header class="content-header">
                <h4 class="title is-4">Dashboard</h4>
                <span class="separator"></span>
                <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="#">General</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Dashboard</a></li>
                    </ul>
                </nav>
            </header>

            <section class="content-body">
                <div class="columns is-multiline">
                    <div class="column is-3">
                        <a href="{{ route('account.show_all') }}" class="box quick-stats has-background-primary has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-cog"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Central Administrators</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('prisoner.showAll') }}" class="box quick-stats has-background-danger has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-secret"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Inspectors</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('mylawyer.myprisoner') }}" class="box quick-stats has-background-info has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-tie"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Lawyers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('medical.createAppointment') }}" class="box quick-stats has-background-warning has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-md"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Medical Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="#police-commissioner-link" class="box quick-stats has-background-success has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-shield"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Police Commissioners</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route ('police.allocateRoom') }}" class="box quick-stats has-background-link has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Police Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('security.registerVisitor') }}" class="box quick-stats has-background-grey-dark has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-lock"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Security Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('saccount.show_all') }}" class="box quick-stats has-background-dark has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-cog"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">System Admins</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('training.assignCertifications') }}" class="box quick-stats has-background-info has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-graduate"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Training Officers</h3>
                            </div>
                        </a>
                    </div>
                    <div class="column is-3">
                        <a href="{{ route('visitor.createVisitingRequest') }}" class="box quick-stats has-background-warning has-text-white">
                            <div class="quick-stats-icon">
                                <span class="icon is-large"><i class="fa fa-3x fa-user-friends"></i></span>
                            </div>
                            <div class="quick-stats-content">
                                <h3 class="title is-4">Visitors</h3>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="columns is-multiline">
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Visitors</p>
                                <input type="color" id="color1" value="#4bc0c0" class="mb-3" />
                                <canvas id="chart1" aria-label="Visitors Chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Prisoners</p>
                                <input type="color" id="color2" value="#ff6384" class="mb-3" />
                                <canvas id="chart2" aria-label="Prisoners Chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Prisons</p>
                                <input type="color" id="color3" value="#36a2eb" class="mb-3" />
                                <canvas id="chart3" aria-label="Prisons Chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card mb-0">
                            <div class="card-content">
                                <p class="title is-4">Staffs</p>
                                <input type="color" id="color4" value="#ff9f40" class="mb-3" />
                                <canvas id="chart4" aria-label="Staffs Chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example static data for the charts (Visitors, Prisoners, Prisons, Staffs)
        const chartData = [{
                date: '2025-01-01',
                visitors: 1200,
                prisoners: 50,
                prisons: 3,
                staffs: 10
            },
            {
                date: '2025-01-02',
                visitors: 1500,
                prisoners: 55,
                prisons: 3,
                staffs: 12
            },
            {
                date: '2025-01-03',
                visitors: 1600,
                prisoners: 53,
                prisons: 3,
                staffs: 11
            },
            {
                date: '2025-01-04',
                visitors: 1800,
                prisoners: 60,
                prisons: 3,
                staffs: 15
            },
            {
                date: '2025-01-05',
                visitors: 2000,
                prisoners: 58,
                prisons: 3,
                staffs: 14
            },
            {
                date: '2025-01-06',
                visitors: 2100,
                prisoners: 62,
                prisons: 4,
                staffs: 16
            },
            {
                date: '2025-01-07',
                visitors: 2500,
                prisoners: 65,
                prisons: 4,
                staffs: 18
            },
        ];

        // Extract data for the charts
        const dates = chartData.map(item => item.date);
        const visitors = chartData.map(item => item.visitors);
        const prisoners = chartData.map(item => item.prisoners);
        const prisons = chartData.map(item => item.prisons);
        const staffs = chartData.map(item => item.staffs);

        // Function to update chart color based on color picker input
        function updateChartColor(chart, color) {
            chart.data.datasets[0].borderColor = color;
            chart.update();
        }

        // Create the Visitors Chart (chart1)
        const ctx1 = document.getElementById('chart1').getContext('2d');
        const chart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Visitors',
                    data: visitors,
                    borderColor: '#4bc0c0', // Default color
                    tension: 0.1
                }]
            }
        });

        // Create the Prisoners Chart (chart2)
        const ctx2 = document.getElementById('chart2').getContext('2d');
        const chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Prisoners',
                    data: prisoners,
                    borderColor: '#ff6384', // Default color
                    tension: 0.1
                }]
            }
        });

        // Create the Prisons Chart (chart3)
        const ctx3 = document.getElementById('chart3').getContext('2d');
        const chart3 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Prisons',
                    data: prisons,
                    borderColor: '#36a2eb', // Default color
                    tension: 0.1
                }]
            }
        });

        // Create the Staffs Chart (chart4)
        const ctx4 = document.getElementById('chart4').getContext('2d');
        const chart4 = new Chart(ctx4, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Staffs',
                    data: staffs,
                    borderColor: '#ff9f40', // Default color
                    tension: 0.1
                }]
            }
        });

        // Event listeners to change colors dynamically
        document.getElementById('color1').addEventListener('input', function(e) {
            updateChartColor(chart1, e.target.value);
        });
        document.getElementById('color2').addEventListener('input', function(e) {
            updateChartColor(chart2, e.target.value);
        });
        document.getElementById('color3').addEventListener('input', function(e) {
            updateChartColor(chart3, e.target.value);
        });
        document.getElementById('color4').addEventListener('input', function(e) {
            updateChartColor(chart4, e.target.value);
        });
    </script>
</body>

</html>