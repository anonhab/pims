<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Base Styles */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        #app-content {
            padding: 20px;
            margin: 50px;
        }

        .columns {
            display: flex;
            flex-wrap: wrap;
            margin-left: 17%;
            align-items: center;
        }

        .column {
            display: block;
            flex-basis: 0;
            flex-grow: 1;
            flex-shrink: 1;
            padding: 0.75rem;
        }

        .column.is-3 {
            flex: none;
            width: 25%;
        }

        .is-multiline {
            flex-wrap: wrap;
        }

        /* Box Styles */
        .box {
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 3px rgba(10, 10, 10, 0.1), 0 0 0 1px rgba(10, 10, 10, 0.1);
            display: block;
            padding: 1.25rem;
            transition: transform 0.2s ease;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        /* Quick Stats Styles */
        .quick-stats {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%;
            text-decoration: none;
        }

        .quick-stats-icon {
            margin-bottom: 1rem;
        }

        .quick-stats-content {
            width: 100%;
        }

        .title {
            color: inherit;
            font-weight: 600;
            line-height: 1.125;
            margin-bottom: 0;
        }

        .title.is-4 {
            font-size: 1.5rem;
        }

        .icon {
            align-items: center;
            display: inline-flex;
            justify-content: center;
            height: 1.5rem;
            width: 1.5rem;
        }

        .icon.is-large {
            height: 3rem;
            width: 3rem;
        }

        /* Progress Bar Styles */
        .progress-container {
            width: 100%;
            margin-top: 1rem;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.25rem;
            font-size: 0.75rem;
        }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.3);
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            background-color: white;
            transition: width 0.5s ease;
        }

        /* Color Classes */
        .has-background-primary {
            background-color: #00d1b2 !important;
        }

        .has-background-danger {
            background-color: #ff3860 !important;
        }

        .has-background-info {
            background-color: #209cee !important;
        }

        .has-background-warning {
            background-color: #ffdd57 !important;
        }

        .has-background-link {
            background-color: #3273dc !important;
        }

        .has-background-grey-dark {
            background-color: #363636 !important;
        }

        .has-background-dark {
            background-color: #0a0a0a !important;
        }

        .has-text-white {
            color: white !important;
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 1023px) {
            .column.is-3 {
                width: 33.3333%;
            }
        }

        @media screen and (max-width: 768px) {
            .column.is-3 {
                width: 50%;
            }
        }

        @media screen and (max-width: 480px) {
            .column.is-3 {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->


    <main class="columns" id="app-content">
        <!-- Content Body -->
        <section class="content-body">
            <!-- Quick Stats Section -->
            <div class="columns is-multiline">
            <div class="column is-3">
    <a href="{{ route('account.show_all') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Central Administrators">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-cog" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Central Administrators</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>85%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 85%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('prisoner.showAll') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Inspectors">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-secret" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Inspectors</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>80%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('mylawyer.myprisoner') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Lawyers">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-tie" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Lawyers</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>68%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 68%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('commisioner.comissioner') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Commisioner">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-tie" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Commisioner</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>55%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 55%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('medical.createAppointment') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Medical Officers">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-md" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Medical Officers</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>60%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 60%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('police.allocateRoom') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Police Officers">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Police Officers</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>88%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 88%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('security.registerVisitor') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Security Officers">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-lock" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Security Officers</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>50%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 50%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('saccount.show_all') }}" class="box quick-stats has-background-dark has-text-white" aria-label="System Admins">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-cog" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">System Admins</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>70%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 70%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('training.assignCertifications') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Training Officers">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-graduate" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Training Officers</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>60%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 60%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="column is-3">
    <a href="{{ route('visitor.createVisitingRequest') }}" class="box quick-stats has-background-dark has-text-white" aria-label="Visitors">
        <div class="quick-stats-icon">
            <span class="icon is-large"><i class="fa fa-3x fa-user-friends" aria-hidden="true"></i></span>
        </div>
        <div class="quick-stats-content">
            <h3 class="title is-4">Visitors</h3>
            <div class="progress-container">
                <div class="progress-label">
                    <span>Progress</span>
                    <span>15%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 15%;"></div>
                </div>
            </div>
        </div>
    </a>
</div>


                <!-- New Discipline Officers Section -->
                <div class="column is-3">
                    <a href="{{ route('discipline_officer.evaluate_request') }}" class="box quick-stats has-background-dark has-text-white">
                        <div class="quick-stats-icon">
                            <span class="icon is-large"><i class="fa fa-3x fa-user-shield"></i></span>
                        </div>
                        <div class="quick-stats-content">
                            <h3 class="title is-4">Discipline Officers</h3>
                            <div class="progress-container">
                                <div class="progress-label">
                                    <span>Progress</span>
                                    <span>65%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- External JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>

</html>