<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>prison information management system</title>

        <meta charset="UTF-8">
        <meta name="description" content="Free Admin Dashboard Template Build with Bulma.io By nafplann">
        <meta name="keywords" content="Bulma,CSS,Admin,Template,Free,Download">
        <meta name="language" content="en-EN">
        <meta name="author" content="Abdul Manaf">
        <meta name="google-adsense-account" content="ca-pub-7864475889913507">

        <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css" integrity="sha512-dC0G5HMA6hLr/E1TM623RN6qK+sL8sz5vB+Uc68J7cBon68bMfKcvbkg6OqlfGHo1nMmcCxO5AinnRTDhWbWsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css" integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
    @include('includes.nav')

        <div class="columns" id="app-content">
        @include('includes.menu')


            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Dashboard</h4>
        <span class="separator"></span>
        <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="#">General</a></li>
                <li class="is-active"><a href="#" aria-current="page">Dashboard</a></li>
            </ul>
        </nav>
    </div>

    <div class="content-body">
        <div class="columns">
            <div class="column">
                <div class="box quick-stats has-background-primary has-text-white">
                    <div class="quick-stats-icon">
                        <span class="icon is-large">
                            <i class="fa fa-3x fa-users"></i>
                        </span>
                    </div>
                    <div class="quick-stats-content">
                        <h3 class="title is-4">Prisoners</h3>
                        <div class="inlinesparkline-bar"></div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="box quick-stats has-background-info has-text-white">
                    <div class="quick-stats-icon">
                        <span class="icon is-large">
                            <i class="fa fa-3x fa-server"></i>
                        </span>
                    </div>
                    <div class="quick-stats-content">
                        <h3 class="title is-4">prisons</h3>
                        <div class="inlinesparkline-bar"></div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="box quick-stats has-background-danger has-text-white">
                    <div class="quick-stats-icon">
                        <span class="icon is-large">
                            <i class="fa fa-3x fa-chart-bar"></i>
                        </span>
                    </div>
                    <div class="quick-stats-content">
                        <h3 class="title is-4">police officers</h3>
                        <div class="inlinesparkline-line"></div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="box quick-stats has-background-warning has-text-white">
                    <div class="quick-stats-icon">
                        <span class="icon is-large">
                            <i class="fa fa-3x fa-bell"></i>
                        </span>
                    </div>
                    <div class="quick-stats-content">
                        <h3 class="title is-4">Alert</h3>
                        <div class="inlinesparkline-line"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="card mb-0">
                    <div class="card-content">
                        <p class="title is-4">Visits</p>
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="card mb-0">
                    <div class="card-content">
                        <p class="title is-4">Conversion</p>
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
            </div>
        </div>

        @include('includes.footer_js')
    </body>


</html>
