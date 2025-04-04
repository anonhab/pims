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
            @include('medical_officer.menu')

            <!-- Main Content -->
            <div class="column is-10" id="page-content">
                <!-- Dashboard Overview Section -->
                <section class="section">
                    <h1 class="title">Dashboard</h1>

                    <div class="columns is-multiline">
                        <!-- Dashboard Overview Cards -->
                        <div class="column is-3">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <p class="card-header-title">Total Prisoners</p>
                                </div>
                                <div class="card-body">
                                    <p class="is-size-3">125</p>
                                </div>
                            </div>
                        </div>

                        <div class="column is-3">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <p class="card-header-title">Pending Requests</p>
                                </div>
                                <div class="card-body">
                                    <p class="is-size-3">25</p>
                                </div>
                            </div>
                        </div>

                        <div class="column is-3">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <p class="card-header-title">Upcoming Appointments</p>
                                </div>
                                <div class="card-body">
                                    <p class="is-size-3">8</p>
                                </div>
                            </div>
                        </div>

                        <div class="column is-3">
                            <div class="card dashboard-card">
                                <div class="card-header">
                                    <p class="card-header-title">Total Visitors Today</p>
                                </div>
                                <div class="card-body">
                                    <p class="is-size-3">45</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- More Detailed Overview -->
                    <div class="columns">
                        <div class="column is-6">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Recent Activity</p>
                                </div>
                                <div class="card-body scrollable">
                                    <ul>
                                     
                                        <!-- Add more items here to test scrolling -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="column is-6">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Quick Actions</p>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li><a href="{{ route('prisoner.add') }}">Add/Update Prisoner</a></li>
                                        <li><a href="{{ route('view.requests') }}">View Pending Requests</a></li>
                                        <li><a href="{{ route('view.appointments') }}">View Appointments</a></li>
                                        <li><a href="/view_visitor_registrations">View Visitor Registrations</a></li>
                                        <li><a href="{{ route('room.allocate') }}">Allocate Room</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @include('includes.footer_js')
    </body>
</html>
