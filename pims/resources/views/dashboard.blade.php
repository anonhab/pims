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
        }
        
        .columns {
            display: flex;
            flex-wrap: wrap;
            margin: -0.75rem;
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
                @foreach([['account.show_all', 'Central Administrators', 'user-cog', 'primary', 85],
                          ['prisoner.showAll', 'Inspectors', 'user-secret', 'danger', 80],
                          ['mylawyer.myprisoner', 'Lawyers', 'user-tie', 'info', 68],
                          ['commisioner.comissioner', 'Commisioner', 'user-tie', 'info', 55, 'Legal representation'],
                          ['medical.createAppointment', 'Medical Officers', 'user-md', 'warning', 60],
                          ['police.allocateRoom', 'Police Officers', 'user', 'link', 78],
                          ['security.registerVisitor', 'Security Officers', 'user-lock', 'grey-dark', 50],
                          ['saccount.show_all', 'System Admins', 'user-cog', 'dark', 70],
                          ['training.assignCertifications', 'Training Officers', 'user-graduate', 'info', 60],
                          ['visitor.createVisitingRequest', 'Visitors', 'user-friends', 'warning', 15]] as $role)
                <div class="column is-3">
                    <a href="{{ route($role[0]) }}" class="box quick-stats has-background-{{ $role[3] }} has-text-white" aria-label="{{ $role[1] }}">
                        <div class="quick-stats-icon">
                            <span class="icon is-large"><i class="fa fa-3x fa-{{ $role[2] }}" aria-hidden="true"></i></span>
                        </div>
                        <div class="quick-stats-content">
                            <h3 class="title is-4">{{ $role[1] }}</h3>
                            <div class="progress-container">
                                <div class="progress-label">
                                    <span>Progress</span>
                                    <span>{{ $role[4] }}%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $role[4] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                
                <!-- New Discipline Officers Section -->
                <div class="column is-3">
                    <a href="{{ route('discipline_officer.evaluate_request') }}" class="box quick-stats has-background-info has-text-white">
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